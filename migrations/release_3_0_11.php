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

use phpbb\db\migration\migration;

class release_3_0_11 extends migration
{
	static public function depends_on()
	{
		return array(
			'\spaceace\ajaxchat\migrations\add_permissions',
		);
	}
	public function update_data()
	{
		return array(
			// Add permissions
			array('permission.add', array('u_ajaxchat_edit', true)),
			// Set permissions
			array('permission.permission_set', array('REGISTERED', 'u_ajaxchat_edit', 'group')),
			// Add new ACP setting for rule link
			array('config.add', array('rule_link_ajax_chat', '')),
		);
	}

	public function update_schema()
	{
		return array(
			'add_tables' => array(
				$this->table_prefix . 'ajax_chat_rules'		  => array(
					'COLUMNS'		=> array(
						'chat_rules'		=> array('MTEXT_UNI', ''),
						'bbcode_uid'		=> array('VCHAR:8', ''),
						'bbcode_bitfield'	=> array('VCHAR:255', ''),
						'bbcode_options'	=> array('UINT:11', 7),
					),
				),
			),
			'add_columns' => array(
				$this->table_prefix . 'users' => array(
					'user_ajax_chat_autocomplete'	=> array('UINT:1', 0),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables' => array(
				$this->table_prefix . 'ajax_chat_rules',
			),
			'drop_columns' => array(
				$this->table_prefix . 'users' => array(
					'user_ajax_chat_autocomplete',
				),
			),
		);
	}
}
