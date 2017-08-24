<?php

/**
 *
 * Ajax Chat extension for phpBB.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace spaceace\ajaxchat\acp;

use \spaceace\ajaxchat\ext;

class ajaxchat_module
{

	/** @var string The currenct action */
	public $u_action;

	/** @var \phpbb\config\config */
	public $new_config = [];

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	protected $phpbb_log;

	protected $root_path;

	public function main($id, $mode)
	{
		global $phpbb_container, $table_prefix, $phpbb_root_path, $phpEx, $phpbb_log, $root_path;

		// Initialization
		$this->auth		 = $phpbb_container->get('auth');
		$this->config	 = $phpbb_container->get('config');
		$this->config_text = $phpbb_container->get('config_text');
		$this->db		 = $phpbb_container->get('dbal.conn');
		$this->user		 = $phpbb_container->get('user');
		$this->template	 = $phpbb_container->get('template');
		$this->request	 = $phpbb_container->get('request');
		$this->ajax_chat_table	 = $phpbb_container->getParameter('tables.ajax_chat');
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
		$this->phpbb_log = $phpbb_log;
		$this->root_path	= $root_path;

		$this->id		 = $id;
		$this->mode		 = $mode;
		if ($this->request->variable('action', ''))
		{
		$this->action = $this->request->variable('action', '', true);
		}

		// Add the posting lang file needed by BBCodes
		$this->user->add_lang(array('posting'));

		$submit = ($this->request->is_set_post('submit')) ? true : false;
		$this->form_key	 = 'acp_ajax_chat';
		add_form_key($this->form_key);

		$display_vars = [
			'title'	 => 'ACP_AJAX_CHAT',
			'vars'	 => [
				'legend1'						=> 'AJAX_CHAT_SETTINGS',
				'display_ajax_chat'				=> ['lang' => 'DISPLAY_AJAX_CHAT', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => false],
				'index_display_ajax_chat'		=> ['lang' => 'INDEX_DISPLAY_AJAX_CHAT', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => true],
				'whois_chatting'				=> ['lang' => 'WHOIS_CHATTING', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => true],
				'ajax_chat_nav_link'			=> ['lang' => 'AJAX_CHAT_NAV_LINK', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => true],
				'ajax_chat_quick_link'			=> ['lang' => 'AJAX_CHAT_QUICK_LINK', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => true],
				'ajax_chat_archive_amount'		=> ['lang' => 'ARCHIVE_AMOUNT_AJAX_CHAT', 'validate' => 'int', 'type' => 'number:5:500', 'explain' => true],
				'ajax_chat_popup_amount'		=> ['lang' => 'POPUP_AMOUNT_AJAX_CHAT', 'validate' => 'int', 'type' => 'number:5:150', 'explain' => true],
				'ajax_chat_index_amount'		=> ['lang' => 'INDEX_AMOUNT_AJAX_CHAT', 'validate' => 'int', 'type' => 'number:5:150', 'explain' => true],
				'ajax_chat_chat_amount'			=> ['lang' => 'CHAT_AMOUNT_AJAX_CHAT', 'validate' => 'int', 'type' => 'number:5:150', 'explain' => true],
				'ajax_chat_time_setting'		=> ['lang' => 'TIME_SETTING_AJAX_CHAT', 'validate' => 'string', 'type' => 'text:10:20', 'explain' => true],
				'refresh_online_chat'			=> ['lang' => 'REFRESH_ONLINE_CHAT', 'validate' => 'int', 'type' => 'number:0:9999', 'explain' => true],
				'refresh_idle_chat'				=> ['lang' => 'REFRESH_IDLE_CHAT', 'validate' => 'int', 'type' => 'number:0:9999', 'explain' => true],
				'refresh_offline_chat'			=> ['lang' => 'REFRESH_OFFLINE_CHAT', 'validate' => 'int', 'type' => 'number:0:9999', 'explain' => true],
				'status_online_chat'			=> ['lang' => 'STATUS_ONLINE_CHAT', 'validate' => 'int', 'type' => 'number:0:9999', 'explain' => true],
				'status_idle_chat'				=> ['lang' => 'STATUS_IDLE_CHAT', 'validate' => 'int', 'type' => 'number:0:9999', 'explain' => true],
				'status_offline_chat'			=> ['lang' => 'STATUS_OFFLINE_CHAT', 'validate' => 'int', 'type' => 'number:0:9999', 'explain' => true],
				'legend2'						=> 'AJAX_CHAT_LAYOUT',
				'ajax_chat_input_full'			=> ['lang' => 'AJAX_CHAT_INPUT_FULL', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => true],
				'ajax_chat_chatrow_full'		=> ['lang' => 'AJAX_CHAT_CHATROW_FULL', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => true],
				'legend3'						=> 'AJAX_CHAT_LOCATION',
				'location_ajax_chat_override'	=> ['lang' => 'LOCATION_AJAX_CHAT_OVERRIDE', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => true],
				'location_ajax_chat'			=> ['lang' => 'LOCATION_AJAX_CHAT', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true],
				'viewforum_ajax_chat_override'	=> ['lang' => 'VIEWFORUM_AJAX_CHAT_OVERRIDE', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => true],
				'viewtopic_ajax_chat_override'	=> ['lang' => 'VIEWTOPIC_AJAX_CHAT_OVERRIDE', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => true],
				'legend4'						=> 'AJAX_CHAT_POSTS',
				'ajax_chat_forum_posts'			=> ['lang' => 'FORUM_POSTS_AJAX_CHAT', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => false],
				'ajax_chat_forum_topic'			=> ['lang' => 'FORUM_POSTS_AJAX_CHAT_TOPIC', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => false],
				'ajax_chat_forum_reply'			=> ['lang' => 'FORUM_POSTS_AJAX_CHAT_REPLY', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => false],
				'ajax_chat_forum_edit'			=> ['lang' => 'FORUM_POSTS_AJAX_CHAT_EDIT', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => false],
				'ajax_chat_forum_quote'			=> ['lang' => 'FORUM_POSTS_AJAX_CHAT_QUOTE', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => false],
				'legend5'						=> 'AJAX_CHAT_PRUNE',
				'prune_ajax_chat'				=> ['lang' => 'PRUNE_AJAX_CHAT', 'validate' => 'bool', 'type' => 'radio:enabled_enabled', 'explain' => true],
				'prune_keep_ajax_chat'			=> ['lang' => 'PRUNE_KEEP_AJAX_CHAT', 'validate' => 'int', 'type' => 'number', 'explain' => false],
				'prune_now'						=> ['lang' => 'PRUNE_NOW', 'validate' => 'bool', 'type' => 'custom', 'explain' => false, 'method' => 'prune_chat'],
				'truncate_now'					=> ['lang' => 'TRUNCATE_NOW', 'validate' => 'bool', 'type' => 'custom', 'explain' => true, 'method' => 'truncate_chat'],
				'ajax_chat_counter'				=> ['lang' => 'CHAT_COUNTER', 'validate' => 'bool', 'type' => 'custom', 'explain' => false, 'method' => 'chat_counter'],
				'legend6'						=> 'ACP_SUBMIT_CHANGES'
			],
		];

		//region Submit
		if ($submit)
		{
			$submit = $this->form_submition($display_vars);

			// If the submit was valid, so still submitted
			if ($submit)
			{
				trigger_error($this->user->lang('CONFIG_UPDATED') . adm_back_link($this->u_action), E_USER_NOTICE);
			}
		}
		//endregion

		$this->generate_stuff_for_cfg_template($display_vars);

		// Output page template file
		$this->tpl_name		 = 'ajax_chat';
		$this->page_title	 = $this->user->lang($display_vars['title']);
	}

	/**
	 * Counter for Ajax Chat messages.
	 */
	public function chat_counter()
	{
		$sql = 'SELECT COUNT(*)
			FROM ' . $this->ajax_chat_table . '';
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		$chat_counter	 = '<div style="width: 75px; height: auto; border: 1px solid #CCCCCC; text-align: right; padding: 0 2px; word-wrap: initial; overflow: hidden;">' . $row['COUNT(*)'] . '</div>';
		return $chat_counter;
	}

	/**
	 * Prune chat table function.
	 *
	 * @param string $value The value
	 * @param string $key The key
	 * @return string The formatted string of this item
	 */
	public function prune_chat($value, $key)
	{
		if (!confirm_box(true))
		{
			if (isset($this->action) && $this->action === 'prune_chat')
			{
				confirm_box(false, $this->user->lang['CONFIRM_PRUNE_AJAXCHAT'], build_hidden_fields([
					'i'		 => $this->id,
					'mode'	 => $this->mode,
					'action' => $this->action,
				]));
			}
		}
		else
		{
			if (!$this->auth->acl_get('a_board'))
			{
				trigger_error($this->user->lang['NO_AUTH_OPERATION'] . adm_back_link($this->u_action), E_USER_WARNING);
			}
			if ($this->action === 'prune_chat')
			{
				$sql = 'SELECT message_id
					FROM ' . $this->ajax_chat_table . '
					ORDER BY message_id DESC ';
				$result = $this->db->sql_query_limit($sql, 1, $this->config['prune_keep_ajax_chat']);
				$row = $this->db->sql_fetchfield('message_id');
				$this->db->sql_freeresult($result);
				$sql1 = 'DELETE FROM ' . $this->ajax_chat_table . '
					WHERE message_id <= ' . (int) $row;
				$result = $this->db->sql_query($sql1);

				if ($this->request->is_ajax() && $result)
				{
					// Add the log to the ACP
					$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'PRUNE_LOG_AJAXCHAT', time());
					$json_response = new \phpbb\json_response;
					$json_response->send(array(
						'MESSAGE_TITLE'	=> $this->user->lang('INFORMATION'),
						'MESSAGE_TEXT'	=> $this->user->lang('PRUNE_CHAT_SUCCESS'),
						'REFRESH_DATA'	=> array(
						'time'			=> 3,
						'url'			=> html_entity_decode($this->u_action)
						)
					));
				}
			}
		}
		$this->id = str_replace("\\", "-", $this->id);

		return '<a href="' . append_sid($this->u_action . '&amp;action=prune_chat') . '" data-ajax="true" data-refresh="true"><input class="button2" type="submit" id="' . $key . '_enable" name="' . $key . '_enable" value="' . $this->user->lang['PRUNE_NOW'] . '" /></a>';
	}

	/**
	 * Truncate chat table function.
	 *
	 * @param string $value The value
	 * @param string $key The key
	 * @return string The formatted string of this item
	 */
	public function truncate_chat($value, $key)
	{
		if (!confirm_box(true))
		{
			if (isset($this->action) && $this->action === 'truncate_chat')
			{
				confirm_box(false, $this->user->lang['CONFIRM_TRUNCATE_AJAXCHAT'], build_hidden_fields([
					'i'		 => $this->id,
					'mode'	 => $this->mode,
					'action' => $this->action,
				]));
			}
		}
		else
		{
			if (!$this->auth->acl_get('a_board'))
			{
				trigger_error($this->user->lang['NO_AUTH_OPERATION'] . adm_back_link($this->u_action), E_USER_WARNING);
			}
			if ($this->action === 'truncate_chat')
			{
				$sql1 = 'TRUNCATE ' . $this->ajax_chat_table;
				$result = $this->db->sql_query($sql1);
				if ($this->request->is_ajax() && $result)
				{
					// Add the log to the ACP
					$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'TRUNCATE_LOG_AJAXCHAT', time());
					$json_response = new \phpbb\json_response;
					$json_response->send(array(
						'MESSAGE_TITLE'	=> $this->user->lang('INFORMATION'),
						'MESSAGE_TEXT'	=> $this->user->lang('TRUNCATE_CHAT_SUCCESS'),
						'REFRESH_DATA'	=> array(
						'time'			=> 3,
						'url'			=> html_entity_decode($this->u_action)
						)
					));
				}
			}
		}
		$this->id = str_replace("\\", "-", $this->id);

		return '<a href="' . append_sid($this->u_action . '&amp;action=truncate_chat') . '" data-ajax="true" data-refresh="true"><input class="button2" type="submit" id="' . $key . '_enable" name="' . $key . '_enable" value="' . $this->user->lang['TRUNCATE_NOW'] . '" /></a>';
	}

	/**
	 * Abstracted method to do the submit part of the acp. Checks values, saves them
	 * and displays the message.
	 * If error happens, Error is shown and config not saved. (so this method quits and returns false.
	 *
	 * @param array $display_vars The display vars for this acp site
	 * @param array $special_functions Assoziative Array with config values where special functions should run on submit instead of simply save the config value. Array should contain 'config_value' => function ($this) { function code here }, or 'config_value' => null if no function should run.
	 * @return bool Submit valid or not.
	 */
	protected function form_submition($display_vars, $special_functions = [])
	{
		foreach ($this->config as $key => $value)
		{
			$this->new_config[$key] = $value;
		}
		$cfg_array			 = ($this->request->is_set('config')) ? $this->request->variable('config', ['' => ''], true) : $this->new_config;
		$error				 = isset($error) ? $error : [];

		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		// Get new chat rules text from the form
		$data['chat_rules_text'] = $this->request->variable('ajax_chat_rule_text', '', true);

		// Prepare chat rules text for storage
		generate_text_for_storage(
			$data['chat_rules_text'],
			$data['chat_rules_uid'],
			$data['chat_rules_bitfield'],
			$data['chat_rules_options'],
			!$this->request->variable('disable_bbcode', false),
			!$this->request->variable('disable_magic_url', false),
			!$this->request->variable('disable_smilies', false)
		);

		// Test if form key is valid
		if (!check_form_key($this->form_key))
		{
			$error[] = $this->user->lang['FORM_INVALID'];
		}

		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
			return false;
		}

		// Store the chat rules settings to the config_table in the database
		$this->config_text->set_array(array(
			'chat_rules_text'			=> $data['chat_rules_text'],
			'chat_rules_uid'			=> $data['chat_rules_uid'],
			'chat_rules_bitfield'		=> $data['chat_rules_bitfield'],
			'chat_rules_options'		=> $data['chat_rules_options'],
		));

		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			// We want to skip that, or run the function. (We do this before checking if there is a request value set for it,
			// cause maybe we want to run a function anyway, based on whatever. We can check stuff manually inside this function)
			if (is_array($special_functions) && array_key_exists($config_name, $special_functions))
			{
				$func = $special_functions[$config_name];
				if (isset($func) && is_callable($func))
				{
					$func();
				}
				continue;
			}
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}
			// Sets the config value
			$this->new_config[$config_name] = $cfg_array[$config_name];
			$this->config->set($config_name, $cfg_array[$config_name]);
		}
		// Add the log to the ACP
		$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'AJAX_CHAT_UPDATED_SETTINGS', time());
		return true;
	}

	/**
	 * Abstracted method to generate acp configuration pages out of a list of display vars, using
	 * the function build_cfg_template().
	 * Build configuration template for acp configuration pages
	 *
	 * @param array $display_vars The display vars for this acp site
	 */
	protected function generate_stuff_for_cfg_template($display_vars)
	{
		$this->new_config	 = $this->config;
		$cfg_array			 = ($this->request->is_set('config')) ? $this->request->variable('config', ['' => ''], true) : $this->new_config;
		$error				 = isset($error) ? $error : [];

		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$this->template->assign_block_vars('options', [
					'S_LEGEND'	 => true,
					'LEGEND'	 => (isset($this->user->lang[$vars])) ? $this->user->lang[$vars] : $vars]
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($this->user->lang[$vars['lang_explain']])) ? $this->user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($this->user->lang[$vars['lang'] . '_EXPLAIN'])) ? $this->user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}

			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$this->template->assign_block_vars('options', [
				'KEY'			 => $config_key,
				'TITLE'			 => (isset($this->user->lang[$vars['lang']])) ? $this->user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		 => $vars['explain'],
				'TITLE_EXPLAIN'	 => $l_explain,
				'CONTENT'		 => $content,
			]);
		}

		// Chat rules functions for ACP
		// Include files needed for displaying BBCodes
		if (!function_exists('display_custom_bbcodes'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}

		// Get chat rules data from the config_text table in the database
		$data = $this->config_text->get_array(array(
			'chat_rules_text',
			'chat_rules_uid',
			'chat_rules_bitfield',
			'chat_rules_options',
		));

		// Prepare the chat rules text for editing inside the textbox
		$ajax_chat_rule_text_edit = generate_text_for_edit($data['chat_rules_text'], $data['chat_rules_uid'], $data['chat_rules_options']);

		// Output data to the template
		$this->template->assign_vars([
			'S_ERROR'	 => (sizeof($error)) ? true : false,
			'ERROR_MSG'	 => implode('<br />', $error),

			'AJAX_CHAT_RULE_TEXT'		=> $ajax_chat_rule_text_edit['text'],

			'S_BBCODE_DISABLE_CHECKED'		=> !$ajax_chat_rule_text_edit['allow_bbcode'],
			'S_SMILIES_DISABLE_CHECKED'		=> !$ajax_chat_rule_text_edit['allow_smilies'],
			'S_MAGIC_URL_DISABLE_CHECKED'	=> !$ajax_chat_rule_text_edit['allow_urls'],

			'BBCODE_STATUS'			=> $this->user->lang('BBCODE_IS_ON', '<a href="' . append_sid("{$this->phpbb_root_path}faq.{$this->php_ext}", 'mode=bbcode') . '">', '</a>'),
			'SMILIES_STATUS'		=> $this->user->lang('SMILIES_ARE_ON'),
			'IMG_STATUS'			=> $this->user->lang('IMAGES_ARE_ON'),
			'FLASH_STATUS'			=> $this->user->lang('FLASH_IS_ON'),
			'URL_STATUS'			=> $this->user->lang('URL_IS_ON'),

			'S_BBCODE_ALLOWED'		=> true,
			'S_SMILIES_ALLOWED'		=> true,
			'S_BBCODE_IMG'			=> true,
			'S_BBCODE_FLASH'		=> true,
			'S_LINKS_ALLOWED'		=> true,
			'AJAX_CHAT_VERSION'		=> ext::AJAX_CHAT_VERSION,
			'U_ACTION'	 => $this->u_action]
		);

		// Assigning custom bbcodes
		display_custom_bbcodes();
	}
}
