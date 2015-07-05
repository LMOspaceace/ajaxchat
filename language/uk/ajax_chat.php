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
		'CHAT_ARCHIVE'				=> 'Архів',
		'CHAT_ARCHIVE_EXPLAIN'		=> 'Архів чату',
		'CHAT_POPUP'				=> 'В плаваючому вікні',
		'CHAT_POPUP_EXPLAIN'		=> 'В плаваючому вікні',
		'CHAT_RULE'					=> 'Правила чату: ',
		'CHAT_RULE_EXPLAIN'			=> 'Тримайте його в чистоті. Без ненормативної лексики, будь ласка.',
		'EMPTY'						=> 'Помилка: Ви повинні додати повідомлення.',
		'GUEST_MESSAGE'				=> '<strong>Ви повинні бути зареєстрованим користувачем, щоб використовувати чат.</strong>',
		'MESSAGE'					=> 'Повідомлення',
		'PAGE_TITLE'				=> 'Форумний чат',
		'RESPOND'					=> 'Відповісти користувачеві',
		'UNIT'						=> 'с',
		'UPDATES'					=> 'Оновлювати кожні',
		'CHAT'						=> 'Чат',
		'CHAT_EXPLAIN'				=> 'Чат окремою вкладкою',
		'WHOIS_CHATTING'			=> 'Хто в чаті',
		'CHAT_FONT_COLOR'			=> 'Колір шрифту',
		'SELECT_COLOR'				=> 'Виберіть ваш колір шрифту у чаті',
		'CHAT_SUBMIT_MESSAGE'		=> 'Надіслати повідомлення',
		'DELETE_CHAT_MESSAGE'		=> 'Видалити повідомлення',
		'BBCODES'					=> 'ББ-коди',
		'IE_NO_AJAX'				=> 'Ваша версія Internet Explorer не підтримує AJAX.',
		'UPGRADE_BROWSER'			=> 'Статус: не можливо створити XmlHttpRequest Object. Оновіть ваш браузер.',
		'NO_POST_IN_CHAT'			=> 'Ви не маєте дозволу на читання чату.',
		// @copyright line. No translations below this line
		'DETAILS'					=> '<a href="http://www.livemembersonly.com" style="font-weight: bold;">AJAX Chat</a> &copy; 2015 <strong style="color: #AA0000;">Live Members Only</strong>',
	)
);
