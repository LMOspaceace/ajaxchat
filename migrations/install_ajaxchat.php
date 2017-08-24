<?php

/**
 *
 * Ajax Chat extension for phpBB.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace spaceace\ajaxchat\migrations;

class install_ajaxchat extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v311');
	}

	public function update_data()
	{
		return array(
			// Add configs
			array('config.add', array('display_ajax_chat', '1')),
			array('config.add', array('ajax_chat_input_full', '1')),
			array('config.add', array('ajax_chat_chatrow_full', '1')),
			array('config.add', array('whois_chatting', '1')),
			array('config.add', array('location_ajax_chat', '1')),
			array('config.add', array('location_ajax_chat_override', '0')),
			array('config.add', array('viewforum_ajax_chat', '1')),
			array('config.add', array('viewforum_ajax_chat_override', '0')),
			array('config.add', array('viewtopic_ajax_chat', '1')),
			array('config.add', array('viewtopic_ajax_chat_override', '0')),
			array('config.add', array('ajax_chat_archive_amount', '200')),
			array('config.add', array('ajax_chat_popup_amount', '60')),
			array('config.add', array('ajax_chat_index_amount', '60')),
			array('config.add', array('ajax_chat_chat_amount', '60')),
			array('config.add', array('ajax_chat_time_setting', 'D g:i a')),
			array('config.add', array('index_display_ajax_chat', '1')),
			array('config.add', array('ajax_chat_forum_posts', '1')),
			array('config.add', array('ajax_chat_forum_topic', '1')),
			array('config.add', array('ajax_chat_forum_reply', '0')),
			array('config.add', array('ajax_chat_forum_edit', '0')),
			array('config.add', array('ajax_chat_forum_quote', '0')),
			array('config.add', array('status_online_chat', '0')),
			array('config.add', array('status_idle_chat', '300')),
			array('config.add', array('status_offline_chat', '1800')),
			array('config.add', array('refresh_online_chat', '5')),
			array('config.add', array('refresh_idle_chat', '60')),
			array('config.add', array('refresh_offline_chat', '300')),
			array('config.add', array('prune_ajax_chat', '0')),
			array('config.add', array('prune_keep_ajax_chat', '300')),
			array('config.add', array('ajax_chat_nav_link', '1')),
			array('config.add', array('ajax_chat_quick_link', '0')),
			array('config_text.add', array('chat_rules_text', '')),
			array('config_text.add', array('chat_rules_uid', '')),
			array('config_text.add', array('chat_rules_bitfield', '')),
			array('config_text.add', array('chat_rules_options', OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS)),
			// Add chat bbcode part 1
			array('custom', array(array($this, 'update_chat_bbcodes'))),
			// Add the cron
			array('config.add', array('prune_ajax_chat_last_gc', 0)), // last run
			array('config.add', array('prune_ajax_chat_gc', (60 * 60 * 24))), // seconds between run; 1 day
			// Create permission role for chat moderation
			array('permission.role_add', array('ROLE_MOD_CHAT', 'm_', 'ROLE_MOD_CHAT_EXPLAIN')),
			// Add permissions
			array('permission.add', array('u_ajaxchat_view', true)),
			array('permission.add', array('u_ajaxchat_post', true)),
			array('permission.add', array('u_ajaxchat_bbcode', true)),
			array('permission.add', array('m_ajaxchat_delete', true)),
			array('permission.add', array('u_ajaxchat_edit', true)),
			// Set permissions
			array('permission.permission_set', array('REGISTERED', 'u_ajaxchat_view', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_ajaxchat_post', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_ajaxchat_bbcode', 'group')),
			array('permission.permission_set', array('ROLE_MOD_CHAT', 'm_ajaxchat_delete')),
			array('permission.permission_set', array('GUESTS', 'u_ajaxchat_view', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_ajaxchat_edit', 'group')),
			// Add ACP module
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_AJAX_CHAT'
			)),
			array('module.add', array(
				'acp',
				'ACP_AJAX_CHAT',
				array(
					'module_basename'	=> '\spaceace\ajaxchat\acp\ajaxchat_module',
					'modes'				=> array('settings'),
				),
			)),
			// Add UCP module
			array('module.add', array(
				'ucp',
				'',
				'USER_AJAXCHAT'
			)),
			array('module.add', array(
				'ucp',
				'USER_AJAXCHAT',
				array(
					'module_basename'	 => '\spaceace\ajaxchat\ucp\ucp_ajaxchat_module',
					'modes'				 => array('settings'),
				),
			)),
		);
	}

	// Add chat bbcode part2
	public function update_chat_bbcodes()
	{
		$bbcode_data = array(
			'color2=' => array(
				'bbcode_helpline'	=> '',
				'bbcode_match'		=> '[color2={COLOR}]{TEXT}[/color2]',
				'bbcode_tpl'		=> '<div style="color: {COLOR}">{TEXT}</div>',
			),
		);

		global $request, $user;
		$acp_manager = new \spaceace\ajaxchat\core\acp_manager($this->db, $request, $user, $this->phpbb_root_path, $this->php_ext);
		$acp_manager->install_bbcodes($bbcode_data);
	}

	// Add chat DB tables and columns
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'ajax_chat'	=> array(
					'COLUMNS'		=> array(
						'message_id'		=> array('UINT:11', null, 'auto_increment', 0),
						'chat_id'			=> array('UINT:11', 0),
						'user_id'			=> array('UINT:11', 0),
						'username'			=> array('VCHAR:255', ''),
						'user_colour'		=> array('VCHAR:6', ''),
						'message'			=> array('MTEXT_UNI', ''),
						'bbcode_uid'		=> array('VCHAR:8', ''),
						'bbcode_bitfield'	=> array('VCHAR:255', ''),
						'bbcode_options'	=> array('UINT:11', 7),
						'time'				=> array('UINT:11', 0),
						'forum_id'			=> array('UINT:8', 0),
						'post_id'			=> array('UINT:12', 0),
					),
					'PRIMARY_KEY'	=> 'message_id',
				),
				$this->table_prefix . 'ajax_chat_sessions'	=> array(
					'COLUMNS'		=> array(
						'user_id'				=> array('UINT:8', 0),
						'username'				=> array('VCHAR:255', ''),
						'user_colour'			=> array('VCHAR:6', ''),
						'user_login'			=> array('UINT:11', 0),
						'user_firstpost'		=> array('UINT:11', 0),
						'user_lastpost'			=> array('UINT:11', 0),
						'user_lastupdate'		=> array('UINT:11', 0),
						'session_viewonline'	=> array('BOOL', 1),
					),
					'PRIMARY_KEY'	=> 'user_id',
				),
			),
			'add_columns'	=> array(
				$this->table_prefix . 'users' => array(
					'user_ajax_chat_view'			=> array('UINT:1', 1),
					'user_ajax_chat_avatars'		=> array('UINT:1', 1),
					'user_ajax_chat_position'		=> array('UINT:1', 1),
					'user_ajax_chat_viewforum'		=> array('UINT:1', 0),
					'user_ajax_chat_viewtopic'		=> array('UINT:1', 0),
					'user_ajax_chat_sound'			=> array('UINT:1', 1),
					'user_ajax_chat_avatar_hover'	=> array('UINT:1', 1),
					'user_ajax_chat_onlinelist'		=> array('UINT:1', 1),
					'user_ajax_chat_autocomplete'	=> array('UINT:1', 0),
					'user_ajax_chat_messages_down'	=> array('UINT:1', 1),
				),
			),
		);
	}

	// Remove chat tables and columns
	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'ajax_chat',
				$this->table_prefix . 'ajax_chat_sessions',
			),
			'drop_columns'	=> array(
				$this->table_prefix . 'users' => array(
					'user_ajax_chat_view',
					'user_ajax_chat_avatars',
					'user_ajax_chat_position',
					'user_ajax_chat_viewforum',
					'user_ajax_chat_viewtopic',
					'user_ajax_chat_sound',
					'user_ajax_chat_avatar_hover',
					'user_ajax_chat_onlinelist',
					'user_ajax_chat_autocomplete',
					'user_ajax_chat_messages_down',
				),
			),
		);
	}
}
