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

class ajaxchat_cron extends migration
{
	public function effectively_installed()
	{
		return isset($this->config['prune_ajax_chat_gc']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('prune_ajax_chat_last_gc', 0)), // last run
			array('config.add', array('prune_ajax_chat_gc', (60 * 60 * 24))), // seconds between run; 1 day
		);
	}
}