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
		'WHOIS_CHATTING'					=> 'Enable Who is chatting box',
		'WHOIS_CHATTING_EXPLAIN'			=> 'Setting this to "Disabled" will turn off the Who is Chatting box in chat regardless of users settings.',
		'REFRESH_AJAX_CHAT'					=> 'Refresh time in seconds',
		'ARCHIVE_AMOUNT_AJAX_CHAT'			=> 'Archive messages',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Amount of archive messages to display. Between 5 and 500. Default is 200.',
		'POPUP_AMOUNT_AJAX_CHAT'			=> 'Popup messages',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Amount of popup messages to display. Between 5 and 150. Default is 60.',
		'INDEX_AMOUNT_AJAX_CHAT'			=> 'Chat messages',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Amount of chat messages to display. Between 5 and 150. Default is 60.',
		'RULE_AJAX_CHAT'					=> 'Insert a simple rule for chat',
		'RULE_AJAX_CHAT_EXPLAIN'			=> 'Example: No flaming or abusive language in chat!!!',
		'ACL_U_AJAXCHAT_BBCODE'				=> 'Can use bbcode in chat',
		'ACL_U_AJAXCHAT_POST'				=> 'Can post messages in chat',
		'ACL_U_AJAXCHAT_VIEW'				=> 'Can view chat',
		'ACL_M_AJAXCHAT_DELETE'				=> 'Can delete posts in chat',
	)
);
