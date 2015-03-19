<?php

/**
*
* Ajax Chat extension for phpBB.
*
* @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/
/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge(
	$lang, array(
		'ADMIN_AJAXCHAT_SETTINGS'			=> 'Settings',
		'ACP_AJAX_CHAT_TITLE'				=> 'Ajax Chat',
		'ACP_AJAX_CHAT'						=> 'Ajax Chat',
		'AJAX_CHAT_SETTINGS'				=> 'Ajax Chat Settings',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'		=> 'Here you can adjust the Ajax Chat settings.',
		'DISPLAY_AJAX_CHAT'					=> 'Enable Ajax Chat',
		'INDEX_DISPLAY_AJAX_CHAT'			=> 'Enable Ajax Chat on index page',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'	=> 'Setting this to "Disabled" will only turn off Ajax Chat on "Board Index".',
		'WHOIS_CHATTING'					=> 'Enable Who is chatting box',
		'WHOIS_CHATTING_EXPLAIN'			=> 'Setting this to "Disabled" will turn off the Who is Chatting box in chat regardless of users settings.',
		'FORUM_POSTS_AJAX_CHAT'				=> 'Enable forum to post in chat about new posts',
		'REFRESH_AJAX_CHAT'					=> 'Refresh time in seconds',
		'ARCHIVE_AMOUNT_AJAX_CHAT'			=> 'Archive messages',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Amount of archive messages to display. Between 5 and 500. Default is 200.',
		'POPUP_AMOUNT_AJAX_CHAT'			=> 'Popup messages',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Amount of popup messages to display. Between 5 and 150. Default is 60.',
		'INDEX_AMOUNT_AJAX_CHAT'			=> 'Index chat messages',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Amount of chat messages to display on index. Between 5 and 150. Default is 60.',
		'CHAT_AMOUNT_AJAX_CHAT'				=> 'Chat messages',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'		=> 'Amount of chat messages to display. Between 5 and 150. Default is 60.',
		'RULE_AJAX_CHAT'					=> 'Insert a simple rule for chat',
		'RULE_AJAX_CHAT_EXPLAIN'			=> 'Example: No flaming or abusive language in chat!!!',
		'TIME_SETTING_AJAX_CHAT'			=> 'Time Setting',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'	=> 'This setting will override user setting on date format. Leave Blank to use User Settings.',
		'ACL_U_AJAXCHAT_BBCODE'				=> 'Can use bbcode in chat',
		'ACL_U_AJAXCHAT_POST'				=> 'Can post messages in chat',
		'ACL_U_AJAXCHAT_VIEW'				=> 'Can view chat',
		'ACL_M_AJAXCHAT_DELETE'				=> 'Can delete posts in chat',
		'STATUS_ONLINE_CHAT'				=> 'Online status',
		'STATUS_ONLINE_CHAT_EXPLAIN'		=> 'Sets users online status time in seconds. Default is 0.',
		'STATUS_IDLE_CHAT'					=> 'Idle status',
		'STATUS_IDLE_CHAT_EXPLAIN'			=> 'Sets users idle status time in seconds. Default is 300.',
		'STATUS_OFFLINE_CHAT'				=> 'Offline status',
		'STATUS_OFFLINE_CHAT_EXPLAIN'		=> 'Sets users offline status time in seconds. Default is 1800.',
		'DELAY_ONLINE_CHAT'					=> 'Online delay',
		'DELAY_ONLINE_CHAT_EXPLAIN'			=> 'Sets users online delay time in seconds. Default is 5.',
		'DELAY_IDLE_CHAT'					=> 'Idle delay',
		'DELAY_IDLE_CHAT_EXPLAIN'			=> 'Sets users idle delay time in seconds. Default is 60.',
		'DELAY_OFFLINE_CHAT'				=> 'Offline delay',
		'DELAY_OFFLINE_CHAT_EXPLAIN'		=> 'Sets users offline delay time in seconds. Default is 300.',
	)
);
