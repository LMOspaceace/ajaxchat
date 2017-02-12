<?php

/**
 *
 * Ajax Chat extension for phpBB.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace spaceace\ajaxchat\controller;

use phpbb\user;
use phpbb\template\template;
use phpbb\db\driver\driver_interface as db_driver;
use phpbb\auth\auth;
use phpbb\request\request;
use phpbb\controller\helper;
use phpbb\config\db;
use phpbb\path_helper;
use phpbb\extension\manager;
use Symfony\Component\DependencyInjection\Container;

/**
 * Main Chat Controller
 *
 * @version 0.3.15-BETA
 * @package spaceace\ajaxchat
 * @author Kevin Roy <royk@myraytech.net>
 * @author Spaceace <spaceace@livemembersonly.com>
 */
class chat
{

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\extension\manager "Extension Manager" */
	protected $ext_manager;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/** @var \Symfony\Component\DependencyInjection\Container "Service Container" */
	protected $container;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\config\db */
	protected $config;

	/** @var core.root_path */
	protected $root_path;

	/** @var core.php_ext */
	protected $php_ext;

	/** @var string */
	protected $table_prefix;

	/** @var int */
	protected $default_delay = 15;

	/** @var int */
	protected $session_time = 300;

	/** @var array */
	protected $times = [];

	/** @var int */
	protected $last_time = 0;

	/** @var array */
	protected $delay = [];

	/** @var int */
	protected $last_id = 0;

	/** @var int */
	protected $last_post = 0;

	/** @var int */
	protected $read_interval;

	/** @var int */
	protected $count = 0;

	/** @var bool */
	protected $get = false;

	/** @var bool */
	protected $init = false;

	/** @var string */
	protected $mode;

	/** @var string */
	protected $ext_path;

	/** @var string */
	protected $ext_path_web;

	/**
	 * Constructor
	 *
	 * @param template		$template
	 * @param user			$user
	 * @param db_driver		$db
	 * @param auth			$auth
	 * @param request		$request
	 * @param helper		$helper
	 * @param db			$config
	 * @param manager		$ext_manager
	 * @param path_helper	$path_helper
	 * @param Container		$container
	 * @param string		$table_prefix
	 * @param string		$root_path
	 * @param string		$php_ext
	 */
	public function __construct(template $template, user $user, db_driver $db, auth $auth, request $request, helper $helper, db $config, manager $ext_manager, path_helper $path_helper, Container $container, $table_prefix, $root_path, $php_ext)
	{
		$this->template		 = $template;
		$this->user			 = $user;
		$this->db			 = $db;
		$this->auth			 = $auth;
		$this->request		 = $request;
		$this->helper		 = $helper;
		$this->config		 = $config;
		$this->root_path	 = $root_path;
		$this->php_ext		 = $php_ext;
		$this->ext_manager	 = $ext_manager;
		$this->path_helper	 = $path_helper;
		$this->container	 = $container;
		$this->table_prefix	 = $table_prefix;
		$this->user->add_lang('posting');
		$this->user->add_lang_ext('spaceace/ajaxchat', 'ajax_chat');
		// sets desired status times
		$this->times		 = [
			'online'	 => $this->config['status_online_chat'],
			'idle'		 => $this->config['status_idle_chat'],
			'offline'	 => $this->config['status_offline_chat'],
		];
		//set delay for each status
		$this->delay		 = [
			'online'	 => $this->config['delay_online_chat'],
			'idle'		 => $this->config['delay_idle_chat'],
			'offline'	 => $this->config['delay_offline_chat'],
		];

		if (!defined('CHAT_TABLE'))
		{
			$chat_table = $this->table_prefix . 'ajax_chat';
			define('CHAT_TABLE', $chat_table);
		}

		if (!defined('CHAT_SESSIONS_TABLE'))
		{
			$chat_session_table = $this->table_prefix . 'ajax_chat_sessions';
			define('CHAT_SESSIONS_TABLE', $chat_session_table);
		}

		$this->ext_path		 = $this->ext_manager->get_extension_path('spaceace/ajaxchat', true);
		$this->ext_path_web	 = $this->path_helper->update_web_root_path($this->ext_path);

		//fixes smilies and avatar not loading properly on index page
		if (!defined('PHPBB_USE_BOARD_URL_PATH'))
		{
			define('PHPBB_USE_BOARD_URL_PATH', true);
		}
	}

	/**
	 * Edit permission function
	 *
	 *
	 */
	public function can_edit_message($author_id)
	{
	return $this->user->data['user_type'] == USER_FOUNDER
		|| $this->auth->acl_get('a_')
		|| $this->auth->acl_get('m_')
		|| $this->auth->acl_get('u_ajaxchat_edit') && $this->user->data['user_id'] == $author_id;
	}

	public function index()
	{
		// Sets a few variables
		$bbcode_status	 = ($this->config['allow_bbcode'] && $this->config['auth_bbcode_pm'] && $this->auth->acl_get('u_ajaxchat_bbcode')) ? true : false;
		$smilies_status	 = ($this->config['allow_smilies'] && $this->config['auth_smilies_pm'] && $this->auth->acl_get('u_pm_smilies')) ? true : false;
		$img_status		 = ($this->config['auth_img_pm'] && $this->auth->acl_get('u_pm_img')) ? true : false;
		$flash_status	 = ($this->config['auth_flash_pm'] && $this->auth->acl_get('u_pm_flash')) ? true : false;
		$url_status		 = ($this->config['allow_post_links']) ? true : false;
		$quote_status	 = true;

		$sql	 = 'SELECT user_lastpost FROM ' . CHAT_SESSIONS_TABLE . ' WHERE user_id = ' . (int) $this->user->data['user_id'];
		$result	 = $this->db->sql_query($sql);
		$row	 = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if ($this->get_status($row['user_lastpost']) === 'online')
		{
			$refresh = $this->config['refresh_online_chat'];
		}
		else if ($this->get_status($row['user_lastpost']) === 'idle')
		{
			$refresh = $this->config['refresh_idle_chat'];
		}
		else if ($this->user->data['user_id'] === ANONYMOUS || $this->get_status($row['user_lastpost']) === 'offline')
		{
			$refresh = $this->config['refresh_offline_chat'];
		}
		else
		{
			$refresh = $this->config['refresh_offline_chat'];
		}

		if ($this->user->data['user_id'] === ANONYMOUS || $row['user_lastpost'] === null)
		{
			$last_post = '0';
		}
		else
		{
			$last_post = $row['user_lastpost'];
		}

		add_form_key('ajax_chat_post');

		//Assign the features template variable
		$this->template->assign_vars([
			'BBCODE_STATUS'		 => ($bbcode_status) ? sprintf($this->user->lang['BBCODE_IS_ON'], '<a href="' . append_sid("{$this->root_path}faq.$this->php_ext", 'mode=bbcode') . '">', '</a>') : sprintf($this->user->lang['BBCODE_IS_OFF'], '<a href="' . append_sid("{$this->root_path}faq.$this->php_ext", 'mode=bbcode') . '">', '</a>'),
			'IMG_STATUS'		 => ($img_status) ? $this->user->lang['IMAGES_ARE_ON'] : $this->user->lang['IMAGES_ARE_OFF'],
			'FLASH_STATUS'		 => ($flash_status) ? $this->user->lang['FLASH_IS_ON'] : $this->user->lang['FLASH_IS_OFF'],
			'SMILIES_STATUS'	 => ($smilies_status) ? $this->user->lang['SMILIES_ARE_ON'] : $this->user->lang['SMILIES_ARE_OFF'],
			'URL_STATUS'		 => ($url_status) ? $this->user->lang['URL_IS_ON'] : $this->user->lang['URL_IS_OFF'],
			'S_LINKS_ALLOWED'	 => $url_status,
			'S_COMPOSE_PM'		 => true,
			'S_BBCODE_ALLOWED'	 => $bbcode_status,
			'S_SMILIES_ALLOWED'	 => $smilies_status,
			'S_BBCODE_IMG'		 => $img_status,
			'S_BBCODE_FLASH'	 => $flash_status,
			'S_BBCODE_QUOTE'	 => $quote_status,
			'S_BBCODE_URL'		 => $url_status,
			'REFRESH_TIME'		 => $refresh,
			'LAST_ID'			 => $this->last_id,
			'LAST_POST'			 => $last_post,
			'TIME'				 => time(),
			'L_VERSION'			 => '3.0.22',
			'STYLE_PATH'		 => generate_board_url() . '/styles/' . $this->user->style['style_path'],
			'EXT_STYLE_PATH'	 => $this->ext_path_web . 'styles/',
			'FILENAME'			 => $this->helper->route('spaceace_ajaxchat_chat'),
			'S_CHAT'			 => (!$this->get) ? true : false,
			'S_GET_CHAT'		 => ($this->get) ? true : false,
		]);

		// Generate smiley listing
		if (!function_exists('generate_smilies'))
		{
			include($this->root_path . 'includes/functions_posting.' . $this->php_ext);
		}

		generate_smilies('inline', 0);

		// Build custom bbcodes array
		if (!function_exists('display_custom_bbcodes'))
		{
			include($this->root_path . 'includes/functions_display.' . $this->php_ext);
		}

		display_custom_bbcodes();

		$this->whois_online();
		return;
	}

	/**
	 * Default onload read Action
	 *
	 * @return multi
	 */
	public function defaultAction($page)
	{
		//Sets message amount depending on page being used
		if ($page === 'popup')
		{
			$chat_message_total		= $this->config['ajax_chat_popup_amount'];
		}

		if ($page === 'chat')
		{
			$chat_message_total		= $this->config['ajax_chat_chat_amount'];
		}

		if ($page === 'archive')
		{
			$chat_message_total		= $this->config['ajax_chat_archive_amount'];
		}

		// sets a few variables before the actions
		$this->mode			 = $this->request->variable('mode', 'default');
		$this->last_id		 = $this->request->variable('last_id', 0);
		$this->last_time	 = $this->request->variable('last_time', 0);
		$this->post_time	 = $this->request->variable('last_post', 0);
		$this->read_interval = $this->request->variable('read_interval', 5000);

		$sql	 = 'SELECT c.*, p.post_visibility, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height
			FROM ' . CHAT_TABLE . ' as c
			LEFT JOIN ' . USERS_TABLE . ' as u ON c.user_id = u.user_id
			LEFT JOIN ' . POSTS_TABLE . ' as p ON c.post_id = p.post_id
			WHERE c.message_id > ' . (int) $this->last_id . '
			ORDER BY c.message_id DESC';
		$result	 = $this->db->sql_query_limit($sql, (int) $chat_message_total);
		$rows	 = $this->db->sql_fetchrowset($result);

		foreach ($rows as $row)
		{
			if ($row['forum_id'] && !$row['post_visibility'] == ITEM_APPROVED && !$this->auth->acl_get('m_approve', $row['forum_id']))
			{
				continue;
			}

			if ($row['forum_id'] && !$this->auth->acl_get('f_read', $row['forum_id']))
			{
				continue;
			}

			$avatar				 = [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => $row['user_avatar_height'],
				'avatar_width'	 => $row['user_avatar_width'],
			];
			$avatar_thumb		 = [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => 20,
				'avatar_width'	 => '',
			];
			$row['avatar']		 = ($this->user->optionget('viewavatars')) ? phpbb_get_avatar($avatar, '') : '';
			$row['avatar_thumb'] = ($this->user->optionget('viewavatars')) ? phpbb_get_avatar($avatar_thumb, '') : '';

			if ($this->count++ == 0)
			{
				$this->last_id = $row['message_id'];
			}

			if ($this->config['ajax_chat_time_setting'])
			{
				$time = $this->config['ajax_chat_time_setting'];
			}
			else
			{
				$time = $this->user->data['user_dateformat'];
			}

			$this->template->assign_block_vars('chatrow', [
				'MESSAGE_ID'		 => $row['message_id'],
				'USERNAME_FULL'		 => $this->clean_username(get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST'])),
				'USERNAME_A'		 => $row['username'],
				'USER_COLOR'		 => $row['user_colour'],
				'MESSAGE'			 => generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
				'TIME'				 => $this->user->format_date($row['time'], $time),
				'CLASS'				 => ($row['message_id'] % 2) ? 1 : 2,
				'USER_AVATAR'		 => $row['avatar'],
				'USER_AVATAR_THUMB'	 => $row['avatar_thumb'],
				'S_AJAXCHAT_EDIT'	 => $this->can_edit_message($row['user_id']),
				'U_EDIT'			 => $this->helper->route('spaceace_ajaxchat_edit', array('chat_id' => $row['message_id'])),
			]);
		}
		$this->db->sql_freeresult($result);

		if ($this->user->data['user_type'] == USER_FOUNDER || $this->user->data['user_type'] == USER_NORMAL)
		{
			$sql	 = 'SELECT *
				FROM ' . CHAT_SESSIONS_TABLE . '
				WHERE user_id = ' . (int) $this->user->data['user_id'];
			$result	 = $this->db->sql_query($sql);
			$row	 = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if ($row['user_id'] != $this->user->data['user_id'])
			{
				$sql_ary = [
					'user_id'			 => $this->user->data['user_id'],
					'username'			 => $this->user->data['username'],
					'user_colour'		 => $this->user->data['user_colour'],
					'user_login'		 => time(),
					'user_lastupdate'	 => time(),
				];
				$sql	 = 'INSERT INTO ' . CHAT_SESSIONS_TABLE . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
				$this->db->sql_query($sql);
			}
			else
			{
				$sql_ary = [
					'username'			 => $this->user->data['username'],
					'user_colour'		 => $this->user->data['user_colour'],
					'user_login'		 => time(),
					'user_lastupdate'	 => time(),
				];
				$sql	 = 'UPDATE ' . CHAT_SESSIONS_TABLE . '
					SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE user_id = ' .  (int) $this->user->data['user_id'];
				$this->db->sql_query($sql);
			}
		}

		$this->index();
		return $this->helper->render('chat_body.html', $this->user->lang['CHAT_EXPLAIN']);
	}

	/**
	 * grabs the list of the active users participating in chat
	 *
	 * @return boolean|null
	 */
	private function whois_online()
	{
		$check_time = time() - $this->session_time;

		$sql_ary = [
			'username'			 => $this->user->data['username'],
			'user_colour'		 => $this->user->data['user_colour'],
			'user_lastupdate'	 => time(),
		];
		$sql	 = 'UPDATE ' . CHAT_SESSIONS_TABLE . '
			SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
			WHERE user_id = ' . (int) $this->user->data['user_id'];
		$this->db->sql_query($sql);

		$sql = 'DELETE FROM ' . CHAT_SESSIONS_TABLE . ' WHERE user_lastupdate <  ' . (int) $check_time;
		$this->db->sql_query($sql);

		$sql	 = 'SELECT *
			FROM ' . CHAT_SESSIONS_TABLE . '
			WHERE user_lastupdate > ' . (int) $check_time . '
			ORDER BY username ASC';
		$result	 = $this->db->sql_query($sql);

		$status_time = time();
		while ($row		 = $this->db->sql_fetchrow($result))
		{
			if ($this->check_hidden($row['user_id']) === false)
			{
				continue;
			}
			if ($row['user_id'] == $this->user->data['user_id'])
			{
				$this->last_post = $row['user_lastpost'];
				$login_time		 = $row['user_login'];
				$status_time	 = ($this->last_post > $login_time) ? $this->last_post : $login_time;
			}
			$status = $this->get_status($row['user_lastpost']);
			$this->template->assign_block_vars('whoisrow', [
				'USERNAME_FULL'	 => $this->clean_username(get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST'])),
				'USER_COLOR'	 => $row['user_colour'],
				'USER_STATUS'	 => $status,
			]);
		}
		$this->db->sql_freeresult($result);

		$this->template->assign_vars([
			'LAST_TIME'		 => time(),
			'S_WHOISONLINE'	 => true,
		]);
		return false;
	}

	/**
	 * Calculate the status of each user
	 *
	 * @param int $last
	 * @return string
	 */
	private function get_status($last)
	{
		$status = 'online';
		if ($last < (time() - $this->times['offline']))
		{
			$status = 'offline';
		}
		else if ($last < (time() - $this->times['idle']))
		{
			$status = 'idle';
		}
		return $status;
	}

	/**
	 * Cleans the username
	 *
	 * @param string $user
	 * @return string
	 */
	private function clean_username($user)
	{
		if (strpos($user, '---') !== false)
		{
			$user = str_replace('---', '–––', $user);
			clean_username($user);
		}
		return $user;
	}

	/**
	 * Refresher Read action
	 *
	 * @return boolean|null
	 */
	public function readAction()
	{
		// sets a few variables before the actions
		$this->mode			 = $this->request->variable('mode', 'default');
		$this->last_id		 = $this->request->variable('last_id', 0);
		$this->last_time	 = $this->request->variable('last_time', 0);
		$this->post_time	 = $this->request->variable('last_post', 0);
		$this->read_interval     = $this->request->variable('read_interval', 5000);

		$chat_message_total  = "";

		$sql	 = 'SELECT c.*, p.post_visibility, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height
			FROM ' . CHAT_TABLE . ' as c
			LEFT JOIN ' . USERS_TABLE . ' as u ON c.user_id = u.user_id
			LEFT JOIN ' . POSTS_TABLE . ' as p ON c.post_id = p.post_id
			WHERE c.message_id > ' . (int) $this->last_id . '
			ORDER BY c.message_id DESC';
		$result	 = $this->db->sql_query_limit($sql, (int) $chat_message_total);
		$rows	 = $this->db->sql_fetchrowset($result);

		// No new messages check
		if (!sizeof($rows))
		{
					$this->template->assign_vars([
						'S_READ'     => true
						]);

					$this->index();
					return $this->helper->render('chat_body_readadd.html', $this->user->lang['CHAT_EXPLAIN']);
		}

		foreach ($rows as $row)
		{
			if ($row['forum_id'] && !$row['post_visibility'] == ITEM_APPROVED && !$this->auth->acl_get('m_approve', $row['forum_id']))
			{
				continue;
			}

			if ($row['forum_id'] && !$this->auth->acl_get('f_read', $row['forum_id']))
			{
				continue;
			}

			$avatar				 = [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => $row['user_avatar_height'],
				'avatar_width'	 => $row['user_avatar_width'],
			];
			$avatar_thumb		 = [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => 20,
				'avatar_width'	 => '',
			];
			$row['avatar']		 = ($this->user->optionget('viewavatars')) ? phpbb_get_avatar($avatar, '') : '';
			$row['avatar_thumb'] = ($this->user->optionget('viewavatars')) ? phpbb_get_avatar($avatar_thumb, '') : '';

			if ($this->count++ === 0)
			{
				if ($row['message_id'] !== null)
				{
					$this->last_id = $row['message_id'];
				}
				else
				{
					$this->last_id = 0;
				}
				$this->template->assign_vars([
					'SOUND_ENABLED'	 => true,
					'SOUND_FILE'	 => 'sound',
					'S_READ'		 => true,
				]);
			}

			if ($this->config['ajax_chat_time_setting'])
			{
				$time = $this->config['ajax_chat_time_setting'];
			}
			else
			{
				$time = $this->user->data['user_dateformat'];
			}

			$this->template->assign_block_vars('chatrow', [
				'MESSAGE_ID'		 => $row['message_id'],
				'USERNAME_FULL'		 => $this->clean_username(get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST'])),
				'USERNAME_A'		 => $row['username'],
				'USER_COLOR'		 => $row['user_colour'],
				'MESSAGE'			 => generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
				'U_EDIT'			 => $this->helper->route('spaceace_ajaxchat_edit', array('chat_id' => $row['message_id'])),
				'TIME'				 => $this->user->format_date($row['time'], $time),
				'S_AJAXCHAT_EDIT'	 => $this->can_edit_message($row['user_id']),
				'CLASS'				 => ($row['message_id'] % 2) ? 1 : 2,
				'USER_AVATAR'		 => $row['avatar'],
				'USER_AVATAR_THUMB'	 => $row['avatar_thumb'],
			]);
		}

		if ((time() - 60) > $this->last_time)
		{
			$sql_ary = [
				'username'			 => $this->user->data['username'],
				'user_colour'		 => $this->user->data['user_colour'],
				'user_lastupdate'	 => time(),
			];
			$sql	 = 'UPDATE ' . CHAT_SESSIONS_TABLE . '
				SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
				WHERE user_id = ' . (int) $this->user->data['user_id'];
			$result	 = $this->db->sql_query($sql);
		}

		$this->get = true;
		$this->index();
		return $this->helper->render('chat_body_readadd.html', $this->user->lang['CHAT_EXPLAIN']);
	}

	/**
	 * Edit Action
	 *
	 * $return boolean|null
	 */
	public function editAction($chat_id)
	{
		// sets a few variables before the actions
		$this->mode			 = $this->request->variable('mode', 'default');
		$this->last_id		 = $chat_id;
		$this->last_time	 = $this->request->variable('last_time', 0);
		$this->post_time	 = $this->request->variable('last_post', 0);
		$this->read_interval = $this->request->variable('read_interval', 5000);
		$submit				 = $this->request->is_set_post('submit');

		$sql	= 'SELECT message, user_id, bbcode_uid, bbcode_bitfield, bbcode_options
			FROM ' . CHAT_TABLE . '
			WHERE message_id = ' . (int) $chat_id;
		$result	 = $this->db->sql_query($sql);
		$row	 = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if (!$row || ($this->user->data['user_type'] !== USER_FOUNDER && !$this->auth->acl_get('u_ajaxchat_edit') && $this->user->data['user_id'] !== $row['user_id']))
		{
			throw new \phpbb\exception\http_exception(403, 'NO_EDIT_PERMISSION');
		}

		if ($submit)
		{
			$text	 = $this->request->variable('message', '', true);
			$uid = $bitfield = $flags = '';
			$errors	 = generate_text_for_storage($text, $uid, $bitfield, $flags, true, true, true);
			if (sizeof($errors))
			{
				$this->template->assign_vars(array(
					'PARSE_ERRORS' => implode('<br>', $errors),
				));
			}
			else
			{
				$sql_ary = [
					'message'			 => $text,
					'bbcode_uid'		 => $uid,
					'bbcode_bitfield'	 => $bitfield,
					'bbcode_options'	 => $flags
				];
				$sql	 = 'UPDATE ' . CHAT_TABLE . '
						SET ' . $this->db->sql_build_array('UPDATE', $sql_ary)
						. ' WHERE message_id = ' . (int) $chat_id;
				$this->db->sql_query($sql);

				$sql	 = 'SELECT c.*, p.post_visibility, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height
					FROM ' . CHAT_TABLE . ' as c
					LEFT JOIN ' . USERS_TABLE . ' as u ON c.user_id = u.user_id
					LEFT JOIN ' . POSTS_TABLE . ' as p ON c.post_id = p.post_id
					WHERE c.message_id = ' . (int) $chat_id . '
					ORDER BY c.message_id DESC';
				$result	 = $this->db->sql_query($sql);
				$row	 = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				if ($row['forum_id'] && !$row['post_visibility'] == ITEM_APPROVED && !$this->auth->acl_get('m_approve', $row['forum_id']))
				{
					return;
				}

				if ($row['forum_id'] && !$this->auth->acl_get('f_read', $row['forum_id']))
				{
					return;
				}

				$avatar				 = [
					'avatar'		 => $row['user_avatar'],
					'avatar_type'	 => $row['user_avatar_type'],
					'avatar_height'	 => $row['user_avatar_height'],
					'avatar_width'	 => $row['user_avatar_width'],
				];
				$avatar_thumb		 = [
					'avatar'		 => $row['user_avatar'],
					'avatar_type'	 => $row['user_avatar_type'],
					'avatar_height'	 => 20,
					'avatar_width'	 => '',
				];
				$row['avatar']		 = ($this->user->optionget('viewavatars')) ? phpbb_get_avatar($avatar, '') : '';
				$row['avatar_thumb'] = ($this->user->optionget('viewavatars')) ? phpbb_get_avatar($avatar_thumb, '') : '';

				if ($this->count++ === 0)
				{
					if ($row['message_id'] !== null)
					{
						$this->last_id = $row['message_id'];
					}
					else
					{
						$this->last_id = 0;
					}
					$this->template->assign_vars([
						'SOUND_ENABLED'	 => true,
						'SOUND_FILE'	 => 'sound',
						'S_READ'		 => true,
					]);
				}

				if ($this->config['ajax_chat_time_setting'])
				{
					$time = $this->config['ajax_chat_time_setting'];
				}
				else
				{
					$time = $this->user->data['user_dateformat'];
				}

				$this->template->assign_block_vars('chatrow', [
					'MESSAGE_ID'		 => $row['message_id'],
					'USERNAME_FULL'		 => $this->clean_username(get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST'])),
					'USERNAME_A'		 => $row['username'],
					'USER_COLOR'		 => $row['user_colour'],
					'MESSAGE'			 => generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
					'TIME'				 => $this->user->format_date($row['time'], $time),
					'CLASS'				 => ($row['message_id'] % 2) ? 1 : 2,
					'USER_AVATAR'		 => $row['avatar'],
					'USER_AVATAR_THUMB'	 => $row['avatar_thumb'],
					'S_AJAXCHAT_EDIT'	 => $this->can_edit_message($row['user_id']),
					'U_EDIT'			 => $this->helper->route('spaceace_ajaxchat_edit', array('chat_id' => $row['message_id'])),
				]);

				$this->template->assign_vars([
					'STYLE_PATH'		=> generate_board_url() . '/styles/' . $this->user->style['style_path'],
					'S_BBCODE_ALLOWED'	=> ($this->config['allow_bbcode'] && $this->config['auth_bbcode_pm'] && $this->auth->acl_get('u_ajaxchat_bbcode')) ? true : false,
				]);

			}
			return $this->helper->render('chat_body_readadd.html', $this->user->lang['CHAT_EXPLAIN']);

		}
		else
		{
			$text = generate_text_for_edit($row['message'], $row['bbcode_uid'], $row['bbcode_options']);

			$this->template->assign_vars([
				'MESSAGE'			 => $text['text'],
				'CHAT_ID'			 => $chat_id,
				'S_AJAXCHAT_EDIT'	 => $this->can_edit_message($row['user_id']),
			]);

			$this->index();
			return $this->helper->render('chat_edit.html');
		}
	}

	/**
	 * Add & read action
	 *
	 * @return boolean|null
	 */
	public function addAction()
	{
		if (!$this->auth->acl_get('u_ajaxchat_post') && $this->user->data['user_type'] !== USER_FOUNDER)
		{
			return;
		}

		// sets a few variables before the actions
		$this->mode			 = $this->request->variable('mode', 'default');
		$this->last_id		 = $this->request->variable('last_id', 0);
		$this->last_time	 = $this->request->variable('last_time', 0);
		$this->post_time	 = $this->request->variable('last_post', 0);
		$this->read_interval = $this->request->variable('read_interval', 5000);
		$chat_message_total  = "";
		$this->get	 = true;
		$message	 = $this->request->variable('message', '', true);

		if (!$message)
		{
			return;
		}
		$this->$message;
		$uid			 = $bitfield		 = $options		 = '';
		$allow_bbcode	 = $this->auth->acl_get('u_ajaxchat_bbcode');
		$allow_urls		 = $allow_smilies	 = true;
		generate_text_for_storage($message, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

		$sql_ary = [
			'chat_id'			 => 1,
			'user_id'			 => $this->user->data['user_id'],
			'username'			 => $this->user->data['username'],
			'user_colour'		 => $this->user->data['user_colour'],
			'message'			 => str_replace('\'', '&rsquo;', $message),
			'bbcode_bitfield'	 => $bitfield,
			'bbcode_uid'		 => $uid,
			'bbcode_options'	 => $options,
			'time'				 => time(),
		];
		$sql	 = 'INSERT INTO ' . CHAT_TABLE . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
		$this->db->sql_query($sql);

		$sql_ary2	 = [
			'username'			 => $this->user->data['username'],
			'user_colour'		 => $this->user->data['user_colour'],
			'user_lastpost'		 => time(),
			'user_lastupdate'	 => time(),
		];
		$sql	 = 'UPDATE ' . CHAT_SESSIONS_TABLE . '
			SET ' . $this->db->sql_build_array('UPDATE', $sql_ary2) . '
			WHERE user_id = ' . (int) $this->user->data['user_id'];
		$result		 = $this->db->sql_query($sql);

		$sql	 = 'SELECT c.*, p.post_visibility, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height
			FROM ' . CHAT_TABLE . ' as c
			LEFT JOIN ' . USERS_TABLE . ' as u ON c.user_id = u.user_id
			LEFT JOIN ' . POSTS_TABLE . ' as p ON c.post_id = p.post_id
			WHERE c.message_id > ' . (int) $this->last_id . '
			ORDER BY c.message_id DESC';
		$result	 = $this->db->sql_query_limit($sql, (int) $chat_message_total);
		$rows	 = $this->db->sql_fetchrowset($result);

		if (!sizeof($rows) && ((time() - 60) < $this->last_time))
		{
					$this->template->assign_vars([
						'S_READ'     => true
						]);

					$this->index();
					return $this->helper->render('chat_body_readadd.html', $this->user->lang['CHAT_EXPLAIN']);
		}

		foreach ($rows as $row)
		{
			if ($row['forum_id'] && !$row['post_visibility'] == ITEM_APPROVED && !$this->auth->acl_get('m_approve', $row['forum_id']))
			{
				continue;
			}

			if ($row['forum_id'] && !$this->auth->acl_get('f_read', $row['forum_id']))
			{
				continue;
			}

			$avatar				 = [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => $row['user_avatar_height'],
				'avatar_width'	 => $row['user_avatar_width'],
			];
			$avatar_thumb		 = [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => 20,
				'avatar_width'	 => '',
			];
			$row['avatar']		 = ($this->user->optionget('viewavatars')) ? phpbb_get_avatar($avatar, '') : '';
			$row['avatar_thumb'] = ($this->user->optionget('viewavatars')) ? phpbb_get_avatar($avatar_thumb, '') : '';

			if ($this->count++ == 0)
			{
				$this->last_id = $row['message_id'];
				$this->template->assign_vars([
					'SOUND_ENABLED'	 => true,
					'SOUND_FILE'	 => 'soundout',
					'S_ADD'			 => true,
				]);
			}

			if ($this->config['ajax_chat_time_setting'])
			{
				$time = $this->config['ajax_chat_time_setting'];
			}
			else
			{
				$time = $this->user->data['user_dateformat'];
			}

			$this->template->assign_block_vars('chatrow', [
				'MESSAGE_ID'		 => $row['message_id'],
				'USERNAME_FULL'		 => $this->clean_username(get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST'])),
				'USERNAME_A'		 => $row['username'],
				'USER_COLOR'		 => $row['user_colour'],
				'MESSAGE'			 => generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
				'TIME'				 => $this->user->format_date($row['time'], $time),
				'CLASS'				 => ($row['message_id'] % 2) ? 1 : 2,
				'USER_AVATAR'		 => $row['avatar'],
				'USER_AVATAR_THUMB'	 => $row['avatar_thumb'],
				'S_AJAXCHAT_EDIT'	 => $this->can_edit_message($row['user_id']),
				'U_EDIT'			 => $this->helper->route('spaceace_ajaxchat_edit', array('chat_id' => $row['message_id'])),
			]);
		}
		$this->db->sql_freeresult($result);
		$this->index();
		return $this->helper->render('chat_body_readadd.html', $this->user->lang['CHAT_EXPLAIN']);
	}

	/**
	 * Post deletion method
	 *
	 * @return boolean|null
	 */
	public function delAction()
	{
		$this->get	 = true;
		$chat_id	 = $this->request->variable('chat_id', 0);
		if (!$chat_id)
		{
			return;
		}

		if (!$this->auth->acl_get('a_') && !$this->auth->acl_get('m_ajaxchat_delete'))
		{
			return;
		}

		$sql = 'DELETE FROM ' . CHAT_TABLE . ' WHERE message_id = ' . (int) $chat_id;
		$this->db->sql_query($sql);
		return;
	}

	public function check_hidden($uid)
	{
		$sql	 = 'SELECT session_viewonline '
				. 'FROM ' . SESSIONS_TABLE . ' '
				. 'WHERE session_user_id = ' . (int) $uid;
		$result	 = $this->db->sql_query($sql);
		$hidden	 = $this->db->sql_fetchrow($result);
		return (bool) $hidden['session_viewonline'];
	}

	/**
	 * Quote function
	 *
	 */
	public function chat_quote()
	{
		$this->get	 = true;
		$chat_id	 = $this->request->variable('chat_id', 0);
		if (!$chat_id)
		{
			return;
		}

		$sql	 = 'SELECT username, message, bbcode_uid, bbcode_bitfield, bbcode_options
			FROM ' . CHAT_TABLE . '
			WHERE message_id = ' . (int) $chat_id;
		$result	 = $this->db->sql_query($sql);
		$row	 = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if ($row)
		{
			$patterns		 = [
				'/\[color2=#[a-fA-F0-9]{6}\]/',
				'/\[\/color2\]/',
			];
			$replacement	 = [
				'',
				'',
			];
			$texts				= generate_text_for_edit($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']);
			$cleaned_text		= preg_replace($patterns, $replacement, html_entity_decode($texts['text'], ENT_QUOTES));

			$new_text = '[quote="' . $row['username'] . '"] ' . $cleaned_text . ' [/quote]--!--';
			$this->index();
			$this->template->assign_vars([
				'CHAT_QUOTE_TEXT'			=> $new_text,
			]);
			return $this->helper->render('chat_quote.html');
		}
	}

}
