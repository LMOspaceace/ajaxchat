<?php

/**
 *
 * Ajax Chat extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 * Übersetzt von franki (http://dieahnen.de/ahnenforum/)
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
		'CHAT_ARCHIVE'					=> 'Archiv',
		'CHAT_ARCHIVE_EXPLAIN'			=> 'Chat Archiv',
		'CHAT_POPUP'					=> 'Popup',
		'CHAT_POPUP_EXPLAIN'			=> 'Chat Popup',
		'CHAT_RULE'						=> 'Chat Regel: ',
		'CHAT_RULE_EXPLAIN'				=> 'Seit freundlich zu einander und keine Obszönitäten bitte.',
		'CHAT_NEW_POST'					=> 'hat geantwortet auf: %s',
		'CHAT_NEW_TOPIC'				=> 'hat ein neues Thema erstellt: %s',
		'CHAT_POST_EDIT'				=> 'wurde bearbeitet: %s',
		'CHAT_NEW_QUOTE'				=> 'has replied with a quote to: %s',
		'EMPTY'							=> 'Fehler: Du musst eine Nachricht einfügen.',
		'GUEST_MESSAGE'					=> '<strong>Du musst registriert sein um den Chat verwenden zu können.</strong>',
		'MESSAGE'						=> 'Nachricht',
		'PAGE_TITLE'					=> 'Forum Chat',
		'RESPOND'						=> 'Reagieren auf Benutzer',
		'UNIT'							=> 'Sekunden',
		'UPDATES'						=> 'Aktuallisierung alle',
		'CHAT'							=> 'Chat',
		'CHAT_EXPLAIN'					=> 'Chat Center',
		'WHOIS_CHATTING'				=> 'Wer ist online',
		'CHAT_FONT_COLOR'				=> 'Schriftfarbe',
		'SELECT_COLOR'					=> 'Wähle die Schriftfarbe',
		'CHAT_SUBMIT_MESSAGE'			=> 'Nachricht senden',
		'DELETE_CHAT_MESSAGE'			=> 'Nachricht löschen',
		'BBCODES'			 			=> 'BBCodes',
		'IE_NO_AJAX'					=> 'Deine Version vom Browser unterstützt kein AJAX.',
		'UPGRADE_BROWSER'				=> 'Status: Konnte kein XmlHttpRequest-Objekt erstellen.	Aktualisiere deinen Browser.',
		'NO_POST_IN_CHAT'				=> 'Du hast keine Berechtigung Nachrichten im Chat zu schreiben.',
		'DELETE_CHAT_COOKIE'			=> 'Cookies löschen',
		'DELETE_CHAT_COOKIE_EXPLAIN'	=> 'This button deletes the font colour hold cookie.',
	)
);
