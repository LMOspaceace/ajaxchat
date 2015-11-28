<?php

/**
 *
 * Ajax Chat extension for the phpBB Forum Software package.
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
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge(
	$lang, array(
		'CHAT_ARCHIVE'					=> 'Archive',
		'CHAT_ARCHIVE_EXPLAIN'			=> 'Chat Archive',
		'CHAT_POPUP'					=> 'Popup',
		'CHAT_POPUP_EXPLAIN'			=> 'Chat Popup',
		'CHAT_RULE'						=> 'Chat Rule: ',
		'CHAT_RULE_EXPLAIN'				=> 'Keep it clean. No profanity please.',
		'CHAT_NEW_POST'					=> 'has replied to: <a href="%1$s">%2$s</a>',
		'CHAT_NEW_TOPIC'				=> 'has started a new topic: <a href="%1$s">%2$s</a>',
		'CHAT_POST_EDIT'				=> 'has edited: <a href="%1$s">%2$s</a>',
		'CHAT_NEW_QUOTE'				=> 'has replied with a quote to: <a href="%1$s">%2$s</a>',
		'EMPTY'							=> 'Error: You must insert a message.',
		'GUEST_MESSAGE'					=> '<strong>You must be a Registered User to use chat.</strong>',
		'MESSAGE'						=> 'Message',
		'PAGE_TITLE'					=> 'Forum Chat',
		'RESPOND'						=> 'Respond to user',
		'UNIT'							=> 'Seconds',
		'UPDATES'						=> 'Updates every',
		'CHAT'							=> 'Chat',
		'CHAT_EXPLAIN'					=> 'Chat Center',
		'WHOIS_CHATTING'				=> 'Who is chatting',
		'CHAT_FONT_COLOR'				=> 'Chat font colour',
		'SELECT_COLOR'					=> 'Select your chat font colour',
		'CHAT_SUBMIT_MESSAGE'			=> 'Submit Message',
		'DELETE_CHAT_MESSAGE'			=> 'Delete chat message',
		'BBCODES'			 			=> 'BBCodes',
		'IE_NO_AJAX'					=> 'Your version of Internet Explorer does not support AJAX.',
		'UPGRADE_BROWSER'				=> 'Status: Could not create XmlHttpRequest Object.	Consider upgrading your browser.',
		'NO_POST_IN_CHAT'				=> 'You do not have permission to post in chat.',
		'DELETE_CHAT_COOKIE'			=> 'Delete cookie',
		'DELETE_CHAT_COOKIE_EXPLAIN'	=> 'This button deletes the font colour hold cookie.',
	)
);
