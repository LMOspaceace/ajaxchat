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
use phpbb\extension\manager;
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

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\config\db */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\extension\manager "Extension Manager" */
	protected $ext_manager;

	/** @var core.php_ext */
	protected $php_ext;

	/** @var tables.ajax_chat */
	protected $ajax_chat_table;

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
	 * @param string		$php_ext
	 */
	public function __construct(template $template, user $user, db_driver $db, auth $auth, request $request,
								helper $helper, db $config, $config_text, manager $ext_manager,
								$php_ext, $ajax_chat_table, \spaceace\ajaxchat\controller\chat $chat)
	{
		$this->template			= $template;
		$this->user				= $user;
		$this->db				= $db;
		$this->auth				= $auth;
		$this->request			= $request;
		$this->helper			= $helper;
		$this->config			= $config;
		$this->config_text		= $config_text;
		$this->php_ext			= $php_ext;
		$this->ext_manager		= $ext_manager;
		$this->ajax_chat_table	= $ajax_chat_table;
		$this->chat				= $chat;

		$this->is_phpbb31	= phpbb_version_compare($config['version'], '3.1.0@dev', '>=') && phpbb_version_compare($config['version'], '3.2.0@dev', '<');
		$this->is_phpbb32	= phpbb_version_compare($config['version'], '3.2.0@dev', '>=') && phpbb_version_compare($config['version'], '3.3.0@dev', '<');

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
			$event['location_url'] = $this->helper->route('spaceace_ajaxchat_chat', array('tslash' => ''));
		}
	}

	/**
	 * Modifies the page header
	 */
	public function page_header()
	{
		if (!defined('PHPBB_USE_BOARD_URL_PATH'))
		{
			define('PHPBB_USE_BOARD_URL_PATH', true);
		}

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
				'U_CHAT'							=> $this->helper->route('spaceace_ajaxchat_chat', array('tslash' => '')),
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
		if (!$this->auth->acl_get('u_ajaxchat_view'))
		{
			return;
		}

		$this->user->add_lang('posting');

		$this->chat->defaultAction('index');
	}

	/**
	 * Adds message in chat when someone posts to the forum
	 *
	 *
	 *
	 */
	public function add_forum_id($event)
	{
		if (!$this->config['ajax_chat_forum_posts'] || !$this->auth->acl_get('f_noapprove', $event['forum_id']))
		{
			return;
		}

		if ($event['mode'] == 'post' && $this->config['ajax_chat_forum_topic'])
		{
			$mode_lang = 'CHAT_NEW_TOPIC';
		}
		else if ($event['mode'] == 'edit' && $this->config['ajax_chat_forum_edit'])
		{
			$mode_lang = 'CHAT_POST_EDIT';
		}
		else if ($event['mode'] == 'reply' && $this->config['ajax_chat_forum_reply'])
		{
			$mode_lang = 'CHAT_NEW_POST';
		}
		else if ($event['mode'] == 'quote' && $this->config['ajax_chat_forum_quote'])
		{
			$mode_lang = 'CHAT_NEW_QUOTE';
		}
		else
		{
			return;
		}

		$url = append_sid(generate_board_url() . '/viewtopic.' . $this->php_ext, 'f=' . $event['data']['forum_id'] . '&amp;t=' . $event['data']['topic_id'] . '&amp;p=' . $event['data']['post_id'] . '#p' . $event['data']['post_id']);
		$subject = ($event['post_data']['post_subject']) ? $event['post_data']['post_subject'] : $this->user->lang['POST_SUBJECT'];
		$message = $this->user->lang($mode_lang, '[url=' . $url . ']' . $subject . '[/url]');
		$message = '[i]' . $message . '[/i]';

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
		$sql = 'INSERT INTO ' . $this->ajax_chat_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
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
}
