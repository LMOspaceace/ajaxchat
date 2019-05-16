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
		'CHAT_BOTTOM'					=> 'Bottom',
		'CHAT_TOP'						=> 'Top',
		'USER_AJAX_CHAT_VIEW'			=> 'View chat on index page',
		'USER_AJAX_CHAT_POSITION'		=> 'Position on index to display chat',
		'USER_AJAX_CHAT_VIEWFORUM'		=> 'Display chat in forums',
		'USER_AJAX_CHAT_VIEWTOPIC'		=> 'Display chat in topics',
		'USER_AJAX_CHAT_AVATARS'		=> 'Display avatars in chat',
		'USER_AJAX_CHAT_SOUND'			=> 'Hear sounds in chat',
		'USER_AJAX_CHAT_AVATAR_HOVER'	=> 'Display full avatar image on hover',
		'USER_AJAX_CHAT_ONLINELIST'		=> 'View online list in chat',
		'USER_AJAX_CHAT_AUTOCOMPLETE'	=> 'Chat input box autocomplete',
		'USER_AJAXCHAT'					=> 'Ajax Chat',
		'USER_AJAXCHAT_SETTINGS'		=> 'Ajax Chat Settings',
		'NO_VIEW_CHAT'					=> 'You do not have permission to view chat.',
		'AJAX_CHAT_MESSAGES_DOWN'		=> 'Display newest chat messages in the top or bottom of chat. Also moves the inputbox to the top or bottom',
	)
);
