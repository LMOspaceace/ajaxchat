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

class update_bbcodes extends \phpbb\db\migration\migration
{

	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'update_chat_bbcodes'))),
			array('config.remove', array('modx_version')),
		);
	}

	public function update_chat_bbcodes()
	{
		$bbcode_data = array(
			'color2=' => array(
				'bbcode_helpline'	=> '',
				'bbcode_match'		=> '[color2={COLOR}]{TEXT}[/color2]',
				'bbcode_tpl'		=> '<span style="color: {COLOR}">{TEXT}</span>',
			),
		);

		global $request, $user;
		$acp_manager = new \spaceace\ajaxchat\core\acp_manager($this->db, $request, $user, $this->phpbb_root_path, $this->php_ext);
		$acp_manager->install_bbcodes($bbcode_data);
	}
}
