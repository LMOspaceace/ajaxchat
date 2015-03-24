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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge(
	$lang, array(
		'CHAT_ARCHIVE'			=> 'Archive',
		'CHAT_ARCHIVE_EXPLAIN'	=> 'Chat Archive',
		'CHAT_POPUP'			=> 'Popup',
		'CHAT_POPUP_EXPLAIN'	=> 'Chat Popup',
		'CHAT_RULE'				=> 'Chat Regel: ',
		'CHAT_RULE_EXPLAIN'		=> 'Hou het Netjes !!! .',
		'CHAT_NEW_POST'			=> 'Heeft gereageerd op: <a href="%1$s">%2$s</a>',
		'CHAT_NEW_TOPIC'		=> 'Heeft nieuw onderwerp geplaatst: <a href="%1$s">%2$s</a>',
		'CHAT_POST_EDIT'		=> 'Heeft bericht aangepast: <a href="%1$s">%2$s</a>',
		'EMPTY'					=> 'Error: U moet eerst een bericht plaatsen.',
		'GUEST_MESSAGE'			=> '<strong>U moet geregistreerd zijn om gebruik te maken van de chat.</strong>',
		'MESSAGE'				=> 'Bericht',
		'PAGE_TITLE'			=> 'Forum Chat',
		'RESPOND'				=> 'Reageren op gebruiker',
		'UNIT'					=> 'Seconds',
		'UPDATES'				=> 'Updates iedere',
		'CHAT'					=> 'Chat',
		'CHAT_EXPLAIN'			=> 'Chat Center',
		'WHOIS_CHATTING'		=> 'Wie is online:',
		'CHAT_FONT_COLOR'		=> 'Chat tekstkleur',
		'SELECT_COLOR'			=> 'Selecteer u chat tekstkleur',
		'CHAT_SUBMIT_MESSAGE'	=> 'Verzend bericht',
		'DELETE_CHAT_MESSAGE'	=> 'Verwijder chat bericht',
		'BBCODES'			 	=> 'BBCodes',
		'IE_NO_AJAX'			=> 'U versie of Internet Explorer heeft geen support AJAX.',
		'UPGRADE_BROWSER'		=> 'Status: Could not create XmlHttpRequest Object.	Consider upgrading your browser.',
		'NO_POST_IN_CHAT'		=> 'U heeft geen permissie om een bericht te plaatsen in chat.',
		// @copyright line. No translations below this line
		'DETAILS'				=> '<a href="http://www.livemembersonly.com" style="font-weight: bold;">AJAX Chat</a> &copy; 2015 <strong style="color: #AA0000;">Live Members Only</strong>',
	)
);
