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
// Český překlad: Komanche, offroadforum.cz
// Czech translation: Komanche, offroadforum.cz
//

$lang = array_merge(
	$lang, array(
		'CHAT_ARCHIVE'			=> 'Archiv',
		'CHAT_ARCHIVE_EXPLAIN'	=> 'Archiv Chatu',
		'CHAT_POPUP'			=> 'Vyskakovací okno',
		'CHAT_POPUP_EXPLAIN'	=> 'Vyskakovací okno Chatu',
		'CHAT_RULE'				=> 'Pravidlo Chatu: ',
		'CHAT_RULE_EXPLAIN'		=> 'Chovejte se slušně, bez vulgarit prosím.',
		'CHAT_NEW_POST'			=> 'odpovídá na: <a href="%1$s">%2$s</a>',
		'CHAT_NEW_TOPIC'		=> 'začal nové téma: <a href="%1$s">%2$s</a>',
		'CHAT_POST_EDIT'		=> 'upravil: <a href="%1$s">%2$s</a>',
		'EMPTY'					=> 'Chyba: musíte něco napsat.',
		'GUEST_MESSAGE'			=> '<strong>Pro použití Chatu musíte být zaregistrován na fóru.</strong>',
		'MESSAGE'				=> 'Zpráva',
		'PAGE_TITLE'			=> 'Chat Fóra',
		'RESPOND'				=> 'Odpovědět uživateli',
		'UNIT'					=> 'Sekund',
		'UPDATES'				=> 'Aktualizace každých',
		'CHAT'					=> 'Chat',
		'CHAT_EXPLAIN'			=> 'Chat',
		'WHOIS_CHATTING'		=> 'Kdo chatuje',
		'CHAT_FONT_COLOR'		=> 'Barva písma Chatu',
		'SELECT_COLOR'			=> 'Vyberte barvu písma na Chatu',
		'CHAT_SUBMIT_MESSAGE'	=> 'Odeslat zprávu',
		'DELETE_CHAT_MESSAGE'	=> 'Smazat zprávu',
		'BBCODES'			 	=> 'BB Kódy',
		'IE_NO_AJAX'			=> 'Vaše verze Internet Exploreru nepodporuje AJAX.',
		'UPGRADE_BROWSER'		=> 'Stav: Nelze vytvořit XmlHttpRequest Object.	Zvažte instalaci novější verze prohlížeče.',
		'NO_POST_IN_CHAT'		=> 'Nemáte právo psát zprávy v Chatu.',
		// @copyright line. No translations below this line
		'DETAILS'				=> '<a href="http://www.livemembersonly.com" style="font-weight: bold;">AJAX Chat</a> &copy; 2015 <strong style="color: #AA0000;">Live Members Only</strong>',
	)
);
