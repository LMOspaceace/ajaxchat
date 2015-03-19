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
// Český překlad: Komanche, offroadforum.cz
// Czech translation: Komanche, offroadforum.cz
//

$lang = array_merge(
	$lang, array(
		'ADMIN_AJAXCHAT_SETTINGS'			=> 'Nastavení',
		'ACP_AJAX_CHAT_TITLE'				=> 'Ajax Chat',
		'ACP_AJAX_CHAT'						=> 'Ajax Chat',
		'AJAX_CHAT_SETTINGS'				=> 'Nastavení Ajax Chatu',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'		=> 'Zde můžete měnit nastavení Ajax Chatu.',
		'DISPLAY_AJAX_CHAT'					=> 'Zapnout Ajax Chat',
		'INDEX_DISPLAY_AJAX_CHAT'			=> 'Zapnout Ajax Chat na úvodní stránce',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'	=> 'Při nastavení této volby na "Vypnuto" pouze vypne Ajax Chat na "Úvodní stránce".',
		'WHOIS_CHATTING'					=> 'Zapnout box "kdo chatuje"',
		'WHOIS_CHATTING_EXPLAIN'			=> 'Při nastavení této volby na "Vypnuto" se vypne box "kdo chatuje" nezávisle na uživatelském nastavení.',
		'FORUM_POSTS_AJAX_CHAT'				=> 'Zapnout zobrazování zpráv o nových příspěvcích na fóru do Chatu',
		'REFRESH_AJAX_CHAT'					=> 'Obnovování chatu v sekundách',
		'ARCHIVE_AMOUNT_AJAX_CHAT'			=> 'Archivní zprávy',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Množství archivních zpráv k zobrazení. Mezi 5 a 500. Výchozí hodnota je 200.',
		'POPUP_AMOUNT_AJAX_CHAT'			=> 'Vyskakovací zprávy',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Množství vyskakovacích zpráv k zobrazení. Mezi 5 a 150. Výchozí hodnota je 60.',
		'INDEX_AMOUNT_AJAX_CHAT'			=> 'Zprávy chatu na úvodní stránce',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Množství zpráv na úvodní stránce k zobrazení. Mezi 5 a 150. Výchozí hodnota je 60.',
		'CHAT_AMOUNT_AJAX_CHAT'				=> 'Zprávy Chatu',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'		=> 'Množství zpráv Chatu k zobrazení. Mezi 5 a 150. Výchozí hodnota je 60.',
		'RULE_AJAX_CHAT'					=> 'Napište jednoduchá pravidla Chatu',
		'RULE_AJAX_CHAT_EXPLAIN'			=> 'Například: Bez urážek a trolování (rozpoutávání zbytečných půtek)!!!',
		'TIME_SETTING_AJAX_CHAT'			=> 'Nastavení času',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'	=> 'Toto nastavení přepisuje uživatelské nastavení času. Nechte prázndé pro uživatelské nastavení.',
		'ACL_U_AJAXCHAT_BBCODE'				=> 'Může používat BB Kódy v Chatu',
		'ACL_U_AJAXCHAT_POST'				=> 'Může posílat zprávy v Chatu',
		'ACL_U_AJAXCHAT_VIEW'				=> 'Může zobrazit Chat',
		'ACL_M_AJAXCHAT_DELETE'				=> 'Může mazat příspěvky v chatu',
		'STATUS_ONLINE_CHAT'				=> 'Stav online',
		'STATUS_ONLINE_CHAT_EXPLAIN'		=> 'Nastaví stav uživatele jako online po určeném času v sekundách. Výchozí hodnota je 0.',
		'STATUS_IDLE_CHAT'					=> 'Stav nečinný',
		'STATUS_IDLE_CHAT_EXPLAIN'			=> 'Nastaví stav uživatele jako nečinný po určeném času v sekundách. Výchozí hodnota je 300.',
		'STATUS_OFFLINE_CHAT'				=> 'Stav offline',
		'STATUS_OFFLINE_CHAT_EXPLAIN'		=> 'Nastaví stav uživatele jako offline po určeném času v sekundách. Výchozí hodnota je 1800.',
		'DELAY_ONLINE_CHAT'					=> 'Online prodleva',
		'DELAY_ONLINE_CHAT_EXPLAIN'			=> 'Nastaví prodlevu změny stavu uživatele na online po určeném času v sekundách. Výchozí hodnota je 5.',
		'DELAY_IDLE_CHAT'					=> 'Nečinný prodleva',
		'DELAY_IDLE_CHAT_EXPLAIN'			=> 'Nastaví prodlevu změny stavu uživatele na nečinný po určeném času v sekundách. Výchozí hodnota je 60.',
		'DELAY_OFFLINE_CHAT'				=> 'Offline prodleva',
		'DELAY_OFFLINE_CHAT_EXPLAIN'		=> 'Nastaví prodlevu změny stavu uživatele na offline po určeném času v sekundách. Výchozí hodnota je 300.',
	)
);
