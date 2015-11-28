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
// Český překlad: Komanche, offroadforum.cz
// Czech translation: Komanche, offroadforum.cz
//

$lang = array_merge(
	$lang, array(
		'ADMIN_AJAXCHAT_SETTINGS'			=> 'Nastavení',
		'ACP_AJAX_CHAT_TITLE'						=> 'Ajax Chat',
		'ACP_AJAX_CHAT'								=> 'Ajax Chat',
		'AJAX_CHAT_SETTINGS'				=> 'Nastavení Ajax Chatu',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'		=> 'Zde můžete měnit nastavení Ajax Chatu.',
		'DISPLAY_AJAX_CHAT'					=> 'Zapnout Ajax Chat',
		'INDEX_DISPLAY_AJAX_CHAT'			=> 'Zapnout Ajax Chat na úvodní stránce',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'	=> 'Při nastavení této volby na "Vypnuto" pouze vypne Ajax Chat na "Úvodní stránce".',
		'WHOIS_CHATTING'					=> 'Zapnout box "kdo chatuje"',
		'WHOIS_CHATTING_EXPLAIN'			=> 'Při nastavení této volby na "Vypnuto" se vypne box "kdo chatuje" nezávisle na uživatelském nastavení.',
		'AJAX_CHAT_POSTS'							=> 'Forum post settings',
		'FORUM_POSTS_AJAX_CHAT'				=> 'Zapnout zobrazování zpráv o nových příspěvcích na fóru do Chatu',
		'FORUM_POSTS_AJAX_CHAT_TOPIC'				=> 'Enable new topics to display in chat',
		'FORUM_POSTS_AJAX_CHAT_REPLY'				=> 'Enable topic replies to display in chat',
		'FORUM_POSTS_AJAX_CHAT_EDIT'				=> 'Enable edited posts to display in chat',
		'FORUM_POSTS_AJAX_CHAT_QUOTE'				=> 'Enable quoted posts to display in chat',
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
		'AJAX_CHAT_LOCATION'						=> 'Chat location',
		'LOCATION_AJAX_CHAT_OVERRIDE'				=> 'Override user’s chat position',
		'LOCATION_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Enabling this setting will override the chat position setting in the UCP as well as remove the UCP option.',
		'LOCATION_AJAX_CHAT'						=> 'Chat position at the top of index page',
		'LOCATION_AJAX_CHAT_EXPLAIN'				=> 'Setting this to "No" will move the chat to the bottom of the index page.',
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
		'REFRESH_ONLINE_CHAT'					=> 'Online prodleva',
		'REFRESH_ONLINE_CHAT_EXPLAIN'			=> 'Nastaví prodlevu změny stavu uživatele na online po určeném času v sekundách. Výchozí hodnota je 5.',
		'REFRESH_IDLE_CHAT'					=> 'Nečinný prodleva',
		'REFRESH_IDLE_CHAT_EXPLAIN'			=> 'Nastaví prodlevu změny stavu uživatele na nečinný po určeném času v sekundách. Výchozí hodnota je 60.',
		'REFRESH_OFFLINE_CHAT'				=> 'Offline prodleva',
		'REFRESH_OFFLINE_CHAT_EXPLAIN'		=> 'Nastaví prodlevu změny stavu uživatele na offline po určeném času v sekundách. Výchozí hodnota je 300.',
		'AJAX_CHAT_PRUNE'							=> 'Prune Settings',
		'PRUNE_AJAX_CHAT'							=> 'Auto prune messages',
		'PRUNE_AJAX_CHAT_EXPLAIN'					=> 'Disabling will set this to manual mode.',
		'PRUNE_KEEP_AJAX_CHAT'						=> 'Number of messages to keep',
		'PRUNE_NOW'									=> 'Prune Now',
		'PRUNE_LOG_AJAXCHAT'						=> 'Pruned chat table',
		'PRUNE_LOG_AJAXCHAT_AUTO'					=> 'Automatic chat table pruning',
		'PRUNE_CHAT_SUCESS'							=> 'Chat table purged sucessfully!',
		'CONFIRM_PRUNE_AJAXCHAT'					=> 'Confirm that you really want to prune the chat database.',
		'TRUNCATE_NOW'								=> 'Truncate Now',
		'CONFIRM_TRUNCATE_AJAXCHAT'					=> 'Confirm that you really want to truncate the chat database.',
		'TRUNCATE_LOG_AJAXCHAT'						=> 'Truncated chat table',
		'TRUNCATE_CHAT_SUCESS'						=> 'Chat table truncated',
		'CHAT_COUNTER'								=> 'Number of chat messages in database',
		'ROLE_MOD_CHAT'								=> 'Ajax Chat moderator',
		'ROLE_MOD_CHAT_EXPLAIN'						=> 'Ajax Chat role for moderators.',
	)
);
