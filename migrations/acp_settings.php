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
	public function update_data()
	{
		return [
			['config.add', ['display_ajax_chat', '1']],
			['config.add', ['whois_chatting', '1']],
			['config.add', ['rule_ajax_chat', '']],
			['config.add', ['location_ajax_chat', '1']],
			['config.add', ['ajax_chat_archive_amount', '200']],
			['config.add', ['ajax_chat_popup_amount', '60']],
			['config.add', ['ajax_chat_index_amount', '60']],
			['config.add', ['ajax_chat_chat_amount', '60']],
			['config.add', ['ajax_chat_time_setting', 'D g:i a']],
			['config.add', ['index_display_ajax_chat', '1']],
			['config.add', ['ajax_chat_forum_posts', '1']],
			['config.add', ['ajax_chat_forum_topic', '1']],
			['config.add', ['ajax_chat_forum_reply', '0']],
			['config.add', ['ajax_chat_forum_edit', '0']],
			['config.add', ['default_color_ajax_chat', '333333']],
			['config.add', ['ajax_chat_chat_amount', '60']],
			['config.add', ['status_online_chat', '0']],
			['config.add', ['status_idle_chat', '300']],
			['config.add', ['status_offline_chat', '1800']],
			['config.add', ['refresh_online_chat', '5']],
			['config.add', ['refresh_idle_chat', '60']],
			['config.add', ['refresh_offline_chat', '300']],
			['config.add', ['prune_ajax_chat', '0']],
			['config.add', ['prune_keep_ajax_chat', '300']],
		];
	}
}
