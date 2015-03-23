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
		'INDEX_DISPLAY_AJAX_CHAT'			=> 'Ajax Chat auf der Index-Seite aktivieren',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'	=> 'Wenn Du hier auf auf "DEAKTIVIERT" stellst, wird nur der Ajax Chat auf der "Indexseite" abgeschaltet.',
		'WHOIS_CHATTING'				=> '"Wer ist online Box" aktivieren',
		'WHOIS_CHATTING_EXPLAIN'		=> 'Wenn Du dieses auf "Deaktivieren" stellst, unabhängig von den Einstellungen der Benutzer, wird die "Wer ist online Box" nicht angezeigt.',
		'FORUM_POSTS_AJAX_CHAT'				=> 'Aktiviere "Beiträge im Forum" um neue Beiträge im Chat anzeigen zu lassen',
		'REFRESH_AJAX_CHAT'				=> 'Aktuallisierungs-Zeit in Sekunden',
		'ARCHIVE_AMOUNT_AJAX_CHAT'			=> 'Archiv Nachrichten',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Anzahl von Archiv-Nachrichten anzeigen. Zwischen 5 und 500. Standardwert ist 200.',
		'POPUP_AMOUNT_AJAX_CHAT'			=> 'Popup-Nachrichten',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Anzahl von Popup-Nachrichten die angezeigt werden sollen. Zwischen 5 und 150. Standardwert ist 60.',
		'INDEX_AMOUNT_AJAX_CHAT'			=> 'Chat Nachrichten',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Anzahl von Chat Nachrichten die angezeigt werden sollen. Zwischen 5 und 150. Standardwert ist 60.',
		'CHAT_AMOUNT_AJAX_CHAT'				=> 'Chat-Nachrichten',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'		=> 'Anzahl der Chat-Nachrichten anzeigen. Zwischen 5 und 150. Standart ist 60.',
		'RULE_AJAX_CHAT'				=> 'Lege eine einfache Regel für den Chat an',
		'RULE_AJAX_CHAT_EXPLAIN'		=> 'Beispiel: Seit freundlich zu einander und keine Obszönitäten bitte.!!!',
		'TIME_SETTING_AJAX_CHAT'			=> 'Zeiteinstellung',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'	=> 'Diese Einstellung überschreibt die Benutzereinstellung des Datumsformats. Leer lassen, um Benutzereinstellungen zu verwenden.',
		'ACL_U_AJAXCHAT_BBCODE'			=> 'Kann bbcode im Chat verwenden',
		'ACL_U_AJAXCHAT_POST'			=> 'Kann Nachrichten im Chat schreiben',
		'ACL_U_AJAXCHAT_VIEW'			=> 'Kann den Chat sehen',
		'ACL_M_AJAXCHAT_DELETE'			=> 'Kann Nachrichten im Chat löschen',
		'STATUS_ONLINE_CHAT'				=> 'Online-Status',
		'STATUS_ONLINE_CHAT_EXPLAIN'		=> 'Legt die Benutzer Online-Status-Zeit in Sekunden fest. Standardwert ist 0.',
		'STATUS_IDLE_CHAT'					=> 'Ruhezustand',
		'STATUS_IDLE_CHAT_EXPLAIN'			=> 'Legt die Benutzer Ruhezustand-Zeit in Sekunden fest. Standardwert ist 300.',
		'STATUS_OFFLINE_CHAT'				=> 'Offline-Status',
		'STATUS_OFFLINE_CHAT_EXPLAIN'		=> 'Legt die Benutzer Offline-Status Zeit in Sekunden fest. Standardwert ist 1800.',
		'REFRESH_ONLINE_CHAT'				=> 'Online Aktualisierungsrate',
		'REFRESH_ONLINE_CHAT_EXPLAIN'		=> 'Legt die Benutzer online "Aktualisierungsrate in Sekunden fest. Standardwert ist 5.',
		'REFRESH_IDLE_CHAT'					=> 'Aktualisierungsrate im Leerlauf',
		'REFRESH_IDLE_CHAT_EXPLAIN'			=> 'Legt die Aktualisierungsrate im Leerlauf in Sekunden fest. Standardwert ist 60.',
		'REFRESH_OFFLINE_CHAT'				=> 'Offline Aktualisierungsrate',
		'REFRESH_OFFLINE_CHAT_EXPLAIN'		=> 'Legt die Benutzer offline Aktualisierungsrate in Sekunden fest. Standardwert ist 300.',
	)
);
