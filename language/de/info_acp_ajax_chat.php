<?php

/**
 *
 * Ajax Chat extension for phpBB.
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

$lang = array_merge(
	$lang, array(
		'ADMIN_AJAXCHAT_SETTINGS'		=> 'Einstellungen',
		'ACP_AJAX_CHAT_TITLE'			=> 'Ajax Chat',
		'ACP_AJAX_CHAT'					=> 'Ajax Chat',
		'AJAX_CHAT_SETTINGS'			=> 'Ajax Chat Einstellungen',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'	=> 'Hier kannst Du die Ajax Chat-Einstellungen anpassen.',
		'DISPLAY_AJAX_CHAT'				=> 'Ajax Chat aktivieren',
		'WHOIS_CHATTING'				=> '"Wer ist online Box" aktivieren',
		'WHOIS_CHATTING_EXPLAIN'		=> 'Wenn Du dieses auf "Deaktivieren" stellst, unabhängig von den Einstellungen der Benutzer, wird die "Wer ist online Box" nicht angezeigt.',
		'REFRESH_AJAX_CHAT'				=> 'Aktuallisierungs-Zeit in Sekunden',
		'ARCHIVE_AMOUNT_AJAX_CHAT'			=> 'Archiv Nachrichten',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Anzahl von Archiv-Nachrichten anzeigen. Zwischen 5 und 500. Standardwert ist 200.',
		'POPUP_AMOUNT_AJAX_CHAT'			=> 'Popup-Nachrichten',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Anzahl von Popup-Nachrichten die angezeigt werden sollen. Zwischen 5 und 150. Standardwert ist 60.',
		'INDEX_AMOUNT_AJAX_CHAT'			=> 'Chat Nachrichten',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Anzahl von Chat Nachrichten die angezeigt werden sollen. Zwischen 5 und 150. Standardwert ist 60.',
		'RULE_AJAX_CHAT'				=> 'Lege eine einfache Regel für den Chat an',
		'RULE_AJAX_CHAT_EXPLAIN'		=> 'Beispiel: Seit freundlich zu einander und keine Obszönitäten bitte.!!!',
		'ACL_U_AJAXCHAT_BBCODE'			=> 'Kann bbcode im Chat verwenden',
		'ACL_U_AJAXCHAT_POST'			=> 'Kann Nachrichten im Chat schreiben',
		'ACL_U_AJAXCHAT_VIEW'			=> 'Kann den Chat sehen',
		'ACL_M_AJAXCHAT_DELETE'			=> 'Kann Nachrichten im Chat löschen',
	)
);
