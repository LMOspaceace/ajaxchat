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

class update_table extends \phpbb\db\migration\migration
{
	public function update_schema()
	{
		return array(
			'add_columns' => array(
				$this->table_prefix . 'users' => array(
					'user_ajax_chat_view'			=> array('UINT:1', 1),
					'user_ajax_chat_avatars'		=> array('UINT:1', 1),
					'user_ajax_chat_position'		=> array('UINT:1', 1),
					'user_ajax_chat_sound'			=> array('UINT:1', 1),
					'user_ajax_chat_avatar_hover'	=> array('UINT:1', 1),
					'user_ajax_chat_onlinelist'		=> array('UINT:1', 1),
				),
			)
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				$this->table_prefix . 'users' => array(
					'user_ajax_chat_view',
					'user_ajax_chat_avatars',
					'user_ajax_chat_position',
					'user_ajax_chat_sound',
					'user_ajax_chat_avatar_hover',
					'user_ajax_chat_onlinelist',
				),
			)
		);
	}
}
