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
 * Main Popup Controller
 *
 * @version 0.1.0-BETA
 * @package spaceace\ajaxchat
 * @author Kevin Roy <royk@myraytech.com>
 * @author Spaceace <spaceace@livemembersonly.com>
 */
class popup
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
	protected $read_interval = 5;

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
		$this->times = [
			'online'	 => $this->config['status_online_chat'],
			'idle'		 => $this->config['status_idle_chat'],
			'offline'	 => $this->config['status_offline_chat'],
		];
		//set delay for each status
		$this->delay = [
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
		include $this->root_path . 'includes/functions_posting.' . $this->php_ext;
		include $this->root_path . 'includes/functions_display.' . $this->php_ext;

		$this->ext_path		 = $this->ext_manager->get_extension_path('spaceace/ajaxchat', true);
		$this->ext_path_web	 = $this->path_helper->update_web_root_path($this->ext_path);

		$this->post = $this->request->get_super_global(\phpbb\request\request_interface::POST);
	}

	public function index()
	{
		// sets a few variables before the actions
		$this->mode			 = $this->request->variable('mode', 'default');
		$this->last_id		 = $this->request->variable('last_id', 0);
		$this->last_time	 = $this->request->variable('last_time', 0);
		$this->post_time	 = $this->request->variable('last_post', 0);
		$this->read_interval = $this->request->variable('read_interval', 5000);

		// Grabs the right Action depending on ajax requested mode
		if ($this->mode === 'default')
		{
			$this->defaultAction();
		}
		else if ($this->mode === 'read')
		{
			$this->readAction();
		}
		else if ($this->mode === 'add')
		{
			$this->addAction();
		}
		else if ($this->mode === 'smilies')
		{
			$this->smiliesAction();
		}
		else if ($this->mode === 'delete')
		{
			$this->delAction();
		}

		// Sets a few variables
		$bbcode_status		= ($this->config['allow_bbcode'] && $this->config['auth_bbcode_pm'] && $this->auth->acl_get('u_ajaxchat_bbcode')) ? true : false;
		$smilies_status		= ($this->config['allow_smilies'] && $this->config['auth_smilies_pm'] && $this->auth->acl_get('u_pm_smilies')) ? true : false;
		$img_status			= ($this->config['auth_img_pm'] && $this->auth->acl_get('u_pm_img')) ? true : false;
		$flash_status		= ($this->config['auth_flash_pm'] && $this->auth->acl_get('u_pm_flash')) ? true : false;
		$url_status			= ($this->config['allow_post_links']) ? true : false;
		$quote_status		= true;
		$this->mode			= strtoupper($this->mode);

		$sql	 = 'SELECT `user_lastpost` FROM ' . CHAT_SESSIONS_TABLE . " WHERE user_id = {$this->user->data['user_id']}";
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
		$details = base64_decode('Jm5ic3A7PGEgaHJlZj0iaHR0cDovL3d3dy5saXZlbWVtYmVyc29ubHkuY29tIiBzdHlsZT0iZm9udC13ZWlnaHQ6IGJvbGQ7Ij5BSkFYJm5ic3A7Q2hhdCZuYnNwOyZjb3B5OyZuYnNwOzIwMTU8L2E+Jm5ic3A7PHN0cm9uZz5MaXZlJm5ic3A7TWVtYmVycyZuYnNwO09ubHk8L3N0cm9uZz4=');

		//Assign the features template variable
		$this->template->assign_vars([
			'BBCODE_STATUS'			=> ($bbcode_status) ? sprintf($this->user->lang['BBCODE_IS_ON'], '<a href="' . append_sid("{$this->root_path}faq.$this->php_ext", 'mode=bbcode') . '">', '</a>') : sprintf($this->user->lang['BBCODE_IS_OFF'], '<a href="' . append_sid("{$this->root_path}faq.$this->php_ext", 'mode=bbcode') . '">', '</a>'),
			'IMG_STATUS'			=> ($img_status) ? $this->user->lang['IMAGES_ARE_ON'] : $this->user->lang['IMAGES_ARE_OFF'],
			'FLASH_STATUS'			=> ($flash_status) ? $this->user->lang['FLASH_IS_ON'] : $this->user->lang['FLASH_IS_OFF'],
			'SMILIES_STATUS'		=> ($smilies_status) ? $this->user->lang['SMILIES_ARE_ON'] : $this->user->lang['SMILIES_ARE_OFF'],
			'URL_STATUS'			=> ($url_status) ? $this->user->lang['URL_IS_ON'] : $this->user->lang['URL_IS_OFF'],
			'S_LINKS_ALLOWED'		=> $url_status,
			'S_COMPOSE_PM'			=> true,
			'S_BBCODE_ALLOWED'		=> $bbcode_status,
			'S_SMILIES_ALLOWED'		=> $smilies_status,
			'S_BBCODE_IMG'			=> $img_status,
			'S_BBCODE_FLASH'		=> $flash_status,
			'S_BBCODE_QUOTE'		=> $quote_status,
			'S_BBCODE_URL'			=> $url_status,
			'L_DETAILS'				=> $details,
			'REFRESH_TIME'			=> $refresh,
			'LAST_ID'				=> $this->last_id,
			'LAST_POST'				=> $last_post,
			'TIME'					=> time(),
			'L_VERSION'				=> '3.0.8-BETA',
			'STYLE_PATH'			=> generate_board_url() . '/styles/' . $this->user->style['style_path'],
			'EXT_STYLE_PATH'		=> '' . $this->ext_path_web . 'styles/',
			'FILENAME'				=> $this->helper->route('spaceace_ajaxchat_chat'),
			'S_POPUP'				=> (!$this->get) ? true : false,
			'S_GET_CHAT'			=> ($this->get) ? true : false,
			'S_' . $this->mode		=> true,
		]);
		// Generate smiley listing
		\generate_smilies('inline', 0);

		// Build custom bbcodes array
		\display_custom_bbcodes();

		$this->whois_online();

		return $this->helper->render('chat_body.html', $this->user->lang['CHAT_POPUP_EXPLAIN']);
	}

	/**
	 * Default onload read Action
	 *
	 * @return multi
	 */
	private function defaultAction()
	{
		$sql	= 'SELECT c.*, p.post_visibility, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height
				FROM ' . CHAT_TABLE . ' as c
				LEFT JOIN ' . USERS_TABLE . ' as u ON c.user_id = u.user_id
				LEFT JOIN ' . POSTS_TABLE . ' as p ON c.post_id = p.post_id
				WHERE c.message_id > ' . $this->last_id . '
				ORDER BY c.message_id DESC';
		$result	= $this->db->sql_query_limit($sql, (int) $this->config['ajax_chat_chat_amount']);
		$rows	= $this->db->sql_fetchrowset($result);

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
			$avatar	= [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => $row['user_avatar_height'],
				'avatar_width'	 => $row['user_avatar_width'],
			];
			$avatar_thumb = [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => '',
				'avatar_width'	 => 35,
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
			]);
		}
		$this->db->sql_freeresult($result);

		if ($this->user->data['user_type'] == USER_FOUNDER || $this->user->data['user_type'] == USER_NORMAL)
		{
			$sql	 = 'SELECT * FROM ' . CHAT_SESSIONS_TABLE . " WHERE user_id = {$this->user->data['user_id']}";
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
				$sql	 = 'UPDATE ' . CHAT_SESSIONS_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . " WHERE user_id = {$this->user->data['user_id']}";
				$this->db->sql_query($sql);
			}
		}

		return;
	}

	/**
	 * grabs the list of the active users participating in chat
	 *
	 * @return boolean
	 */
	private function whois_online()
	{
		$check_time = time() - $this->session_time;

		$sql_ary = [
			'username'			 => $this->user->data['username'],
			'user_colour'		 => $this->user->data['user_colour'],
			'user_lastupdate'	 => time(),
		];
		$sql	 = 'UPDATE ' . CHAT_SESSIONS_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . " WHERE user_id = {$this->user->data['user_id']}";
		$this->db->sql_query($sql);

		$sql = 'DELETE FROM ' . CHAT_SESSIONS_TABLE . " WHERE user_lastupdate < $check_time";
		$this->db->sql_query($sql);

		$sql	 = 'SELECT *
					FROM ' . CHAT_SESSIONS_TABLE . "
					WHERE user_lastupdate > $check_time
					ORDER BY username ASC";
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
	 * Cleans the message
	 *
	 * @param string $message
	 */
	private function clean_message(&$message)
	{
		if (strpos($message, '---') !== false)
		{
			$message = str_replace('---', '–––', $message);
			clean_message($message);
		}
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
	 * @return bool
	 */
	private function readAction()
	{
		$sql	= 'SELECT c.*, p.post_visibility, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height
				FROM ' . CHAT_TABLE . ' as c
				LEFT JOIN ' . USERS_TABLE . ' as u ON c.user_id = u.user_id
				LEFT JOIN ' . POSTS_TABLE . ' as p ON c.post_id = p.post_id
				WHERE c.message_id > ' . $this->last_id . '
				ORDER BY c.message_id DESC';
		$result	= $this->db->sql_query_limit($sql, (int) $this->config['ajax_chat_chat_amount']);
		$rows	= $this->db->sql_fetchrowset($result);

		if (!sizeof($rows) && ((time() - 60) < $this->last_time))
		{
			return;
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
			$avatar	= [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => $row['user_avatar_height'],
				'avatar_width'	 => $row['user_avatar_width'],
			];
			$avatar_thumb = [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => '',
				'avatar_width'	 => 35,
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
			]);
		}
		$this->db->sql_freeresult($result);
		if ((time() - 60) > $this->last_time)
		{
			$sql_ary = [
				'username'			 => $this->user->data['username'],
				'user_colour'		 => $this->user->data['user_colour'],
				'user_lastupdate'	 => time(),
			];
			$sql	 = 'UPDATE ' . CHAT_SESSIONS_TABLE . '
            SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . "
            WHERE user_id = {$this->user->data['user_id']}";
			$result	 = $this->db->sql_query($sql);
		}
		$this->get = true;

		return;
	}

	/**
	 * Add & read action
	 *
	 * @return bool
	 */
	private function addAction()
	{
		$this->get = true;

		$message = utf8_normalize_nfc($this->request->variable('message', '', true));

		if (!$message)
		{
			return;
		}
		$this->clean_message($message);
		$uid			 = $bitfield		 = $options		 = '';
		$allow_bbcode	 = $this->auth->acl_get('u_ajaxchat_bbcode');
		$allow_urls		 = $allow_smilies	 = true;
		generate_text_for_storage($message, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

		$sql_ary = [
			'chat_id'			 => 1,
			'user_id'			 => $this->user->data['user_id'],
			'username'			 => $this->user->data['username'],
			'user_colour'		 => $this->user->data['user_colour'],
			'message'			 => $message,
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
		$sql		 = 'UPDATE ' . CHAT_SESSIONS_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary2) . " WHERE user_id = {$this->user->data['user_id']}";
		$result		 = $this->db->sql_query($sql);

		$sql	= 'SELECT c.*, p.post_visibility, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height
				FROM ' . CHAT_TABLE . ' as c
				LEFT JOIN ' . USERS_TABLE . ' as u ON c.user_id = u.user_id
				LEFT JOIN ' . POSTS_TABLE . ' as p ON c.post_id = p.post_id
				WHERE c.message_id > ' . $this->last_id . '
				ORDER BY c.message_id DESC';
		$result	= $this->db->sql_query_limit($sql, (int) $this->config['ajax_chat_chat_amount']);
		$rows	= $this->db->sql_fetchrowset($result);

		if (!sizeof($rows) && ((time() - 60) < $this->last_time))
		{
			exit;
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
			$avatar	= [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => $row['user_avatar_height'],
				'avatar_width'	 => $row['user_avatar_width'],
			];
			$avatar_thumb = [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => '',
				'avatar_width'	 => 35,
			];
			$row['avatar']		 = ($this->user->optionget('viewavatars')) ? phpbb_get_avatar($avatar, '') : '';
			$row['avatar_thumb'] = ($this->user->optionget('viewavatars')) ? phpbb_get_avatar($avatar_thumb, '') : '';
			if ($this->count++ == 0)
			{
				$this->last_id = $row['message_id'];
				$this->template->assign_vars([
					'SOUND_ENABLED'	 => true,
					'SOUND_FILE'	 => 'soundout',
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
			]);
		}
		$this->db->sql_freeresult($result);

		return;
	}

	/**
	 * Post deletion method
	 *
	 * @return bool
	 */
	private function delAction()
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
		$sql = 'DELETE FROM ' . CHAT_TABLE . " WHERE message_id = $chat_id";
		$this->db->sql_query($sql);
		return;
	}

	public function check_hidden($uid)
	{
		$sql = 'SELECT `session_viewonline` '
				. 'FROM ' . SESSIONS_TABLE .' '
				. 'WHERE `session_user_id` = "' . $uid . '"';
		$result = $this->db->sql_query($sql);
		$hidden = $this->db->sql_fetchrow($result);
		return (bool) $hidden['session_viewonline'];
	}

}
