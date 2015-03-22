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

class acp_settings extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array();
	}

	public function update_data()
	{
		return array(
			array('config.add', array('display_ajax_chat', '1')),
			array('config.add', array('whois_chatting', '1')),
			array('config.add', array('rule_ajax_chat', '')),
			array('config.add', array('ajax_chat_archive_amount', '200')),
			array('config.add', array('ajax_chat_popup_amount', '60')),
			array('config.add', array('ajax_chat_index_amount', '60')),
			array('config.add', array('ajax_chat_chat_amount', '60')),
			array('config.add', array('ajax_chat_time_setting', 'D g:i a')),
			array('config.add', array('index_display_ajax_chat', '1')),
			array('config.add', array('ajax_chat_forum_posts', '1')),
			array('config.add', array('ajax_chat_chat_amount', '60')),
			array('config.add', array('status_online_chat', '0')),
			array('config.add', array('status_idle_chat', '300')),
			array('config.add', array('status_offline_chat', '1800')),
			array('config.add', array('refresh_online_chat', '5')),
			array('config.add', array('refresh_idle_chat', '60')),
			array('config.add', array('refresh_offline_chat', '300')),
		);
	}
}
