<?php

/**
 *
 * Ajax Chat extension for phpBB.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace spaceace\ajaxchat\event;

use phpbb\template\template;
use phpbb\user;
use phpbb\db\driver\driver_interface as db_driver;
use phpbb\auth\auth;
use phpbb\request\request;
use phpbb\controller\helper;
use phpbb\config\db;
use phpbb\path_helper;
use phpbb\extension\manager;
use spaceace\ajaxchat\controller\chat;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 *
 * @package spaceace/ajaxchat
 */
class listener implements EventSubscriberInterface
{

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\config\db */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

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

	/** @var \spaceace\ajaxchat\controller\chat */
	protected $chat;

	/** @var bool */
	public $is_phpbb32;

	/** @var bool */
	public $is_phpbb31;

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
	public function __construct(template $template, user $user, db_driver $db, auth $auth, request $request, helper $helper, db $config, $config_text, manager $ext_manager, path_helper $path_helper, Container $container, $chat_table, $chat_session_table, $root_path, $php_ext, chat $chat)
	{
		$this->template				= $template;
		$this->user					= $user;
		$this->db					= $db;
		$this->auth					= $auth;
		$this->request				= $request;
		$this->helper				= $helper;
		$this->config				= $config;
		$this->config_text			= $config_text;
		$this->root_path			= $root_path;
		$this->php_ext				= $php_ext;
		$this->ext_manager			= $ext_manager;
		$this->path_helper			= $path_helper;
		$this->container			= $container;
		$this->chat_table			= $chat_table;
		$this->chat_session_table	= $chat_session_table;
		$this->chat					= $chat;
		$this->is_phpbb31			= phpbb_version_compare($config['version'], '3.1.0@dev', '>=') && phpbb_version_compare($config['version'], '3.2.0@dev', '<');
		$this->is_phpbb32			= phpbb_version_compare($config['version'], '3.2.0@dev', '>=') && phpbb_version_compare($config['version'], '3.3.0@dev', '<');

		$this->template->assign_vars(array(
			'IS_PHPBB31' => $this->is_phpbb31,
			'IS_PHPBB32' => $this->is_phpbb32,
		));
	}

	/**
	 * Decides what listener to use
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.viewonline_overwrite_location'		=> 'add_page_viewonline',
			'core.page_header'							=> 'page_header',
			'core.permissions'							=> 'add_permission',
			'core.index_modify_page_title'				=> 'index',
			'core.viewforum_get_topic_data'				=> 'index',
			'core.viewtopic_before_f_read_check'		=> 'index',
			'core.posting_modify_submit_post_after'		=> 'add_forum_id',
			'core.acp_users_prefs_modify_data'			=> 'acp_users_chat_settings_get', // For the ACP user setting
			'core.acp_users_prefs_modify_template_data'	=> 'acp_profile_ajax_chat_template', // For the ACP user setting
			'core.acp_users_prefs_modify_sql'			=> 'ucp_profile_ajax_chat_set', // For the ACP user setting
		);
	}

	/**
	 * Modifies viewonline to show who is on what page
	 */
	public function add_page_viewonline($event)
	{
		if (strrpos($event['row']['session_page'], 'app.' . $this->php_ext . '/chat') === 0)
		{
			$event['location'] = $this->user->lang('CHAT');
			$event['location_url'] = $this->helper->route('spaceace_ajaxchat_chat');
		}
	}

	/**
	 * Modifies the page header
	 */
	public function page_header()
	{

		$this->times = [
			'online'	 => $this->config['status_online_chat'],
			'idle'		 => $this->config['status_idle_chat'],
			'offline'	 => $this->config['status_offline_chat'],
		];

		$this->user->add_lang_ext('spaceace/ajaxchat', 'ajax_chat');

		// Get chat rules data from the config_text object
		$chat_rules_data = $this->config_text->get_array(array(
			'chat_rules_text',
			'chat_rules_uid',
			'chat_rules_bitfield',
			'chat_rules_options',
		));

		// Prepare chat rules for display
		$chat_rules = generate_text_for_display(
			$chat_rules_data['chat_rules_text'],
			$chat_rules_data['chat_rules_uid'],
			$chat_rules_data['chat_rules_bitfield'],
			$chat_rules_data['chat_rules_options']
		);

		// Declaring a few UCP switches and basic values
		$this->template->assign_vars(
			array(
				'U_CHAT'							=> $this->helper->route('spaceace_ajaxchat_chat'),
				'S_SHOUT'							=> true,
				'CHAT_RULES'						=> $chat_rules,
				'AJAX_CHAT_SCRIPT_PATH'				=> $this->config['script_path'],
				'AJAX_CHAT_COOKIE_NAME'				=> $this->config['cookie_name'].'_fonthold',
				'AJAX_CHAT_EXT_PATH'				=> $this->ext_manager->get_extension_path('spaceace/ajaxchat', true),
				'S_AJAX_CHAT_VIEW'					=> $this->user->data['user_ajax_chat_view'],
				'S_AJAX_CHAT_AVATARS'				=> $this->user->data['user_ajax_chat_avatars'],
				'S_AJAX_CHAT_POSITION'				=> $this->user->data['user_ajax_chat_position'],
				'S_AJAX_CHAT_VIEWFORUM'				=> $this->user->data['user_ajax_chat_viewforum'],
				'S_AJAX_CHAT_VIEWTOPIC'				=> $this->user->data['user_ajax_chat_viewtopic'],
				'S_AJAX_CHAT_SOUND'					=> $this->user->data['user_ajax_chat_sound'],
				'S_AJAX_CHAT_AVATAR_HOVER'			=> $this->user->data['user_ajax_chat_avatar_hover'],
				'S_AJAX_CHAT_ONLINELIST'			=> $this->user->data['user_ajax_chat_onlinelist'],
				'S_AJAX_CHAT_AUTOCOMPLETE'			=> $this->user->data['user_ajax_chat_autocomplete'],
				'S_AJAXCHAT_VIEW'					=> ($this->user->data['user_type'] === USER_FOUNDER || $this->auth->acl_get('u_ajaxchat_view')) ? true : false,
				'S_AJAXCHAT_POST'					=> ($this->user->data['user_type'] === USER_FOUNDER || $this->auth->acl_get('u_ajaxchat_post')) ? true : false,
				'S_AJAXCHAT_BBCODE'					=> ($this->user->data['user_type'] === USER_FOUNDER || $this->auth->acl_get('u_ajaxchat_bbcode')) ? true : false,
				'M_AJAXCHAT_DELETE'					=> ($this->user->data['user_type'] === USER_FOUNDER || $this->auth->acl_get('m_ajaxchat_delete')) ? true : false,
				'S_AJAX_CHAT_MESSAGES_DOWN'			=> $this->user->data['user_ajax_chat_messages_down'],
				'S_CHAT_ENABLED'					=> ($this->config['display_ajax_chat']) ? true : false,
				'S_CHAT_NAV_LINK'					=> ($this->config['ajax_chat_nav_link']) ? true : false,
				'S_CHAT_QUICK_LINK'					=> ($this->config['ajax_chat_quick_link']) ? true : false,
				'S_WHOIS_CHATTING'					=> ($this->config['whois_chatting']) ? true : false,
				'S_AJAX_CHAT_ACP_POSITION'			=> ($this->config['location_ajax_chat']) ? true : false,
				'S_AJAX_CHAT_POSITION_OVERRIDE'		=> ($this->config['location_ajax_chat_override']) ? true : false,
				'S_AJAX_CHAT_VIEWFORUM_OVERRIDE'	=> ($this->config['viewforum_ajax_chat_override']) ? true : false,
				'S_AJAX_CHAT_VIEWTOPIC_OVERRIDE'	=> ($this->config['viewtopic_ajax_chat_override']) ? true : false,
				'S_AJAX_CHAT_INPUT_FULL'			=> ($this->config['ajax_chat_input_full']) ? true : false,
				'S_AJAX_CHAT_CHATROW_FULL'			=> ($this->config['ajax_chat_chatrow_full']) ? true : false,
			)
		);

		if (!$this->config['index_display_ajax_chat'])
		{
			$this->template->assign_var('S_AJAX_CHAT_VIEW', $this->config['index_display_ajax_chat']);
		}
		
	}

	/**
	 * Add administrative permissions
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function add_permission($event)
	{
		$permissions = $event['permissions'];

		// Adds the required ucp and mcp permissions
		$permissions['u_ajaxchat_view']		 = array('lang' => 'ACL_U_AJAXCHAT_VIEW', 'cat' => 'misc');
		$permissions['u_ajaxchat_post']		 = array('lang' => 'ACL_U_AJAXCHAT_POST', 'cat' => 'misc');
		$permissions['u_ajaxchat_bbcode']	 = array('lang' => 'ACL_U_AJAXCHAT_BBCODE', 'cat' => 'misc');
		$permissions['u_ajaxchat_edit']		 = array('lang' => 'ACL_U_AJAXCHAT_EDIT', 'cat' => 'misc');
		$permissions['m_ajaxchat_delete']	 = array('lang' => 'ACL_M_AJAXCHAT_DELETE', 'cat' => 'misc');
		$event['permissions']				 = $permissions;
	}

	/**
	 * Modifies the forum index to add the chat
	 */
	public function index()
	{
		if ($this->config['prune_ajax_chat'] === true)
		{
			$this->prune();
		}
		if (!defined('PHPBB_USE_BOARD_URL_PATH'))
		{
			define('PHPBB_USE_BOARD_URL_PATH', true);
		}
		$this->user->add_lang('posting');
		$this->user->add_lang_ext('spaceace/ajaxchat', 'ajax_chat');

		$this->chat->request_variables();

		$this->times = [
			'online'	 => $this->config['status_online_chat'],
			'idle'		 => $this->config['status_idle_chat'],
			'offline'	 => $this->config['status_offline_chat'],
		];

		$sql = 'SELECT c.*, p.post_visibility, u.user_avatar, u.user_avatar_type, u.user_avatar_width, u.user_avatar_height
			FROM ' . $this->chat_table . ' as c
			LEFT JOIN ' . USERS_TABLE . ' as u ON c.user_id = u.user_id
			LEFT JOIN ' . POSTS_TABLE . ' as p ON c.post_id = p.post_id
			WHERE c.message_id > ' . (int) $this->last_id . '
			ORDER BY c.message_id DESC';
		$result	= $this->db->sql_query_limit($sql, (int) $this->config['ajax_chat_index_amount']);
		$rows	= $this->db->sql_fetchrowset($result);

		if (!sizeof($rows) && ((time() - 60) < $this->last_time))
		{
					$this->template->assign_vars([
						'S_READ'     => true
						]);

					$this->chat->index();
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

			$avatar	= [
				'avatar'		 => $row['user_avatar'],
				'avatar_type'	 => $row['user_avatar_type'],
				'avatar_height'	 => $row['user_avatar_height'],
				'avatar_width'	 => $row['user_avatar_width'],
			];
			$avatar_thumb = [
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
				'S_AJAXCHAT_EDIT'	 => $this->chat->can_edit_message($row['user_id']),
				'U_EDIT'			 => $this->helper->route('spaceace_ajaxchat_edit', array('chat_id' => $row['message_id'])),
			]);
		}

		$this->db->sql_freeresult($result);

		if ($this->user->data['user_type'] == USER_FOUNDER || $this->user->data['user_type'] == USER_NORMAL)
		{
			$sql	 = 'SELECT *
				FROM ' . $this->chat_session_table . '
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
				$sql = 'INSERT INTO ' . $this->chat_session_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
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
				$sql	 = 'UPDATE ' . $this->chat_session_table . '
					SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE user_id = ' . (int) $this->user->data['user_id'];
				$this->db->sql_query($sql);
			}
		}
		
		$this->chat->index();
	}

	/**
	 * Adds message in chat when someone posts to the forum
	 *
	 *
	 *
	 */
	public function add_forum_id($event)
	{
		if (!$this->config['ajax_chat_forum_posts'])
		{
			return;
		}

		$this->user->add_lang_ext('spaceace/ajaxchat', 'ajax_chat');

		if ($event['mode'] == 'reply' && $this->config['ajax_chat_forum_reply'])
		{
			$this->user->lang['CHAT_NEW_POST'];
		}
		else if ($event['mode'] == 'edit' && $this->config['ajax_chat_forum_edit'])
		{
			$this->user->lang['CHAT_POST_EDIT'];
		}
		else if ($event['mode'] == 'post' && $this->config['ajax_chat_forum_topic'])
		{
			$this->user->lang['CHAT_NEW_TOPIC'];
		}
		else if ($event['mode'] == 'quote' && $this->config['ajax_chat_forum_quote'])
		{
			$this->user->lang['CHAT_NEW_QUOTE'];
		}
		else
		{
			return;
		}

		$url = append_sid(generate_board_url() . '/viewtopic.' . $this->php_ext, 'f=' . $event['data']['forum_id'] . '&amp;t=' . $event['data']['topic_id'] . '&amp;p=' . $event['data']['post_id'] . '#p' . $event['data']['post_id']);
		$username = get_username_string('full', $this->user->data['user_id'], $this->user->data['username'], $this->user->data['user_colour']);
		if ($event['mode'] == 'post')
		{
			$message = $this->user->lang('CHAT_NEW_TOPIC', '[url=' . $url . ']' . $event['post_data']['post_subject'] . '[/url]');
		}
		else if ($event['mode'] == 'edit')
		{
			$message = $this->user->lang('CHAT_POST_EDIT', '[url=' . $url . ']' . $event['post_data']['post_subject'] . '[/url]');
		}
		else if ($event['mode'] == 'reply')
		{
			$message = $this->user->lang('CHAT_NEW_POST', '[url=' . $url . ']' . $event['post_data']['post_subject'] . '[/url]');
		}
		else if ($event['mode'] == 'quote')
		{
			$message = $this->user->lang('CHAT_NEW_QUOTE', '[url=' . $url . ']' . $event['post_data']['post_subject'] . '[/url]');
		}

		$uid = $bitfield = $options = '';
		$allow_bbcode = $allow_urls = $allow_smilies = true;
		generate_text_for_storage($message, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
		$sql_ary = array(
			'chat_id'			 => 0,
			'user_id'			 => $this->user->data['user_id'],
			'username'			 => $this->user->data['username'],
			'user_colour'		 => $this->user->data['user_colour'],
			'message'			 => $message,
			'bbcode_bitfield'	 => $bitfield,
			'bbcode_uid'		 => $uid,
			'bbcode_options'	 => $options,
			'time'				 => time(),
			'forum_id'			 => $event['forum_id'],
			'post_id'			 => $event['data']['post_id'],
		);
		$sql = 'INSERT INTO ' . $this->chat_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
		$this->db->sql_query($sql);
	}

	/**
	 * Get user's options and display them in ACP Prefs View page
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function acp_users_chat_settings_get($event)
	{
		$data = $event['data'];
		$user_row = $event['user_row'];
		$data = array_merge($data, array(
					'user_ajax_chat_view'			=> $this->request->variable('ajax_chat_view', (bool) $user_row['user_ajax_chat_view']),
					'user_ajax_chat_avatars'		=> $this->request->variable('ajax_chat_avatars', (bool) $user_row['user_ajax_chat_avatars']),
					'user_ajax_chat_position'		=> $this->request->variable('ajax_chat_position', (bool) $user_row['user_ajax_chat_position']),
					'user_ajax_chat_viewforum'		=> $this->request->variable('ajax_chat_viewforum', (bool) $user_row['user_ajax_chat_viewforum']),
					'user_ajax_chat_viewtopic'		=> $this->request->variable('ajax_chat_viewtopic', (bool) $user_row['user_ajax_chat_viewtopic']),
					'user_ajax_chat_sound'			=> $this->request->variable('ajax_chat_sound', (bool) $user_row['user_ajax_chat_sound']),
					'user_ajax_chat_avatar_hover'	=> $this->request->variable('ajax_chat_avatar_hover', (bool) $user_row['user_ajax_chat_avatar_hover']),
					'user_ajax_chat_onlinelist'		=> $this->request->variable('ajax_chat_onlinelist', (bool) $user_row['user_ajax_chat_onlinelist']),
					'user_ajax_chat_autocomplete'	=> $this->request->variable('ajax_chat_autocomplete', (bool) $user_row['user_ajax_chat_autocomplete']),
					'user_ajax_chat_messages_down'	=> $this->request->variable('ajax_chat_messages_down', (bool) $user_row['user_ajax_chat_messages_down']),
		));
		$event['data'] = $data;
	}

	/**
	 * Assign template data in the ACP
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function acp_profile_ajax_chat_template($event)
	{
		if ($this->config['display_ajax_chat'] === '1')
		{
			$this->template->assign_var('S_CHAT_ENABLED', true);
		}

		$this->user->add_lang_ext('spaceace/ajaxchat', 'info_ucp_ajax_chat');
		$data = $event['data'];
		$user_prefs_data = $event['user_prefs_data'];
		$user_prefs_data = array_merge($user_prefs_data, array(
			'S_AJAX_CHAT_VIEW'			=> $data['user_ajax_chat_view'],
			'S_AJAX_CHAT_AVATARS'		=> $data['user_ajax_chat_avatars'],
			'S_AJAX_CHAT_POSITION'		=> $data['user_ajax_chat_position'],
			'S_AJAX_CHAT_VIEWFORUM'		=> $data['user_ajax_chat_viewforum'],
			'S_AJAX_CHAT_VIEWTOPIC'		=> $data['user_ajax_chat_viewtopic'],
			'S_AJAX_CHAT_SOUND'			=> $data['user_ajax_chat_sound'],
			'S_AJAX_CHAT_AVATAR_HOVER'	=> $data['user_ajax_chat_avatar_hover'],
			'S_AJAX_CHAT_ONLINELIST'	=> $data['user_ajax_chat_onlinelist'],
			'S_AJAX_CHAT_AUTOCOMPLETE'	=> $data['user_ajax_chat_autocomplete'],
			'S_AJAX_CHAT_MESSAGES_DOWN'	=> $data['user_ajax_chat_messages_down'],
		));
		$event['user_prefs_data'] = $user_prefs_data;
	}

	/**
	 * Add user options' state into the sql_array
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function ucp_profile_ajax_chat_set($event)
	{
		$data = $event['data'];
		$sql_ary = $event['sql_ary'];
		$sql_ary = array_merge($sql_ary, array(
			'user_ajax_chat_view'			=> $event['data']['user_ajax_chat_view'],
			'user_ajax_chat_avatars'		=> $event['data']['user_ajax_chat_avatars'],
			'user_ajax_chat_position'		=> $event['data']['user_ajax_chat_position'],
			'user_ajax_chat_viewforum'		=> $event['data']['user_ajax_chat_viewforum'],
			'user_ajax_chat_viewtopic'		=> $event['data']['user_ajax_chat_viewtopic'],
			'user_ajax_chat_sound'			=> $event['data']['user_ajax_chat_sound'],
			'user_ajax_chat_avatar_hover'	=> $event['data']['user_ajax_chat_avatar_hover'],
			'user_ajax_chat_onlinelist'		=> $event['data']['user_ajax_chat_onlinelist'],
			'user_ajax_chat_autocomplete'	=> $event['data']['user_ajax_chat_autocomplete'],
			'user_ajax_chat_messages_down'	=> $event['data']['user_ajax_chat_messages_down'],
		));
		$event['sql_ary'] = $sql_ary;
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
	 * Checks if user is hidden
	 *
	 *
	 *
	 */
	public function check_hidden($uid)
	{
		$sql = 'SELECT session_viewonline '
			. 'FROM ' . SESSIONS_TABLE . ' '
			. 'WHERE session_user_id = ' . (int) $uid;
		$result	 = $this->db->sql_query($sql);
		$hidden	 = $this->db->sql_fetchrow($result);
		return (bool) $hidden['session_viewonline'];
	}

}
