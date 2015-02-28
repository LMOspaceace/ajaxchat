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

class ucp_ajaxchat_module extends \phpbb\db\migration\migration
{

	public function update_data()
	{
		return array(
			array('module.add', array(
					'ucp',
					'',
					'USER_AJAXCHAT_SETTINGS',
				)
			),
			array('module.add', array(
					'ucp',
					'USER_AJAXCHAT_SETTINGS',
					array(
						'module_basename'	=> '\spaceace\ajaxchat\ucp\ucp_ajaxchat_module',
						'modes'				=> array('settings'),
					),
				)
			),
		);
	}
}
