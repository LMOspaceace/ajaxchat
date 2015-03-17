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
		'ADMIN_AJAXCHAT_SETTINGS'		=> 'Налаштування',
		'ACP_AJAX_CHAT_TITLE'			=> 'Ajax Chat',
		'ACP_AJAX_CHAT'					=> 'Ajax Chat',
		'AJAX_CHAT_SETTINGS'			=> 'Налаштування Ajax Chat',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'	=> 'Тут ви можете налаштувати параметри Ajax Chat.',
		'DISPLAY_AJAX_CHAT'				=> 'Увімкнути Ajax Chat',
		'WHOIS_CHATTING'				=> 'Увімкнути блок "Хто у чаті"',
		'WHOIS_CHATTING_EXPLAIN'		=> 'Установка у "Вимкнено" відключає блок "Хто у чаті", незалежно від параметрів користувачів.',
		'REFRESH_AJAX_CHAT'				=> 'Час оновлення в секундах',
		'ARCHIVE_AMOUNT_AJAX_CHAT'		=> 'Архів повідомлень',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Кількість повідомлень у архіві  для відображення. Між 5 і 500. За замовчуванням 200.',
		'POPUP_AMOUNT_AJAX_CHAT'		=> 'Виринаючі повідомлення',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Кількість виринаючих повідомлень для відображення. Між 5 і 150. За замовчуванням 60.',
		'INDEX_AMOUNT_AJAX_CHAT'		=> 'Повідомлення чату',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Кількість повідомлень чату для відображення. Між 5 і 150. За замовчуванням 60.',
		'RULE_AJAX_CHAT'				=> 'Вставте прості правила для чату',
		'RULE_AJAX_CHAT_EXPLAIN'		=> 'Наприклад: Заборонено нецезурні та образливі вислови!!!',
		'ACL_U_AJAXCHAT_BBCODE'			=> 'Використовувати ББ-коди в чаті',
		'ACL_U_AJAXCHAT_POST'			=> 'Може публікувати повідомлення в чаті',
		'ACL_U_AJAXCHAT_VIEW'			=> 'Може переглядати чат',
		'ACL_M_AJAXCHAT_DELETE'			=> 'Може видаляти повідомлення в чаті',
	)
);
