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

class add_hidden_session_status extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\spaceace\ajaxchat\migrations\install_ajaxchat');
	}

	// Add hidden session status
	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'ajax_chat_sessions'	=> array(
						'session_viewonline'	=> array('BOOL', 1),
				),
			),
		);
	}
}
