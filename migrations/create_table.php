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

class create_table extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array();
	}

	public function update_schema()
	{
		return array(
			'add_tables' => array(
				$this->table_prefix . 'ajax_chat'		  => array(
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
					),
					'PRIMARY_KEY' => 'message_id',
				),
				$this->table_prefix . 'ajax_chat_sessions' => array(
					'COLUMNS'	 => array(
						'user_id'			=> array('UINT:8', 0),
						'username'			=> array('VCHAR:255', ''),
						'user_colour'		=> array('VCHAR:6', ''),
						'user_login'		=> array('UINT:11', 0),
						'user_firstpost'	=> array('UINT:11', 0),
						'user_lastpost'		=> array('UINT:11', 0),
						'user_lastupdate'	=> array('UINT:11', 0),
					),
					'PRIMARY_KEY' => 'user_id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables' => array(
				$this->table_prefix . 'ajax_chat',
				$this->table_prefix . 'ajax_chat_sessions',
			),
		);
	}
}
