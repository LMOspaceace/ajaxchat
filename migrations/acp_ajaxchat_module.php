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

class acp_ajaxchat_module extends migration
{
	public function update_data()
	{
		return array(
			array('module.add', array(
					'acp',
					'ACP_CAT_DOT_MODS',
					'ACP_AJAX_CHAT')),
			array('module.add', array(
					'acp',
					'ACP_AJAX_CHAT',
				array(
						'module_basename'	=> '\spaceace\ajaxchat\acp\ajaxchat_module',
						'modes'				=> array('settings'),
					),
				)
			),
		);
	}
}
