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
		'CHAT_ARCHIVE'					=> 'Архив',
		'CHAT_ARCHIVE_EXPLAIN'			=> 'Архив чата',
		'CHAT_POPUP'					=> 'В отдельном окне',
		'CHAT_POPUP_EXPLAIN'			=> 'Чат в отдельном окне',
		'CHAT_RULE'						=> 'Правила чата',
		'CHAT_RULE_EXPLAIN'				=> 'Keep it clean. No profanity please.',
		'CHAT_NEW_POST'					=> 'добавил(а) сообщение: %s',
		'CHAT_NEW_TOPIC'				=> 'создал(а) новую тему: %s',
		'CHAT_POST_EDIT'				=> 'отредактировал(а) сообщение: %s',
		'CHAT_NEW_QUOTE'				=> 'ответил(а) с цитатой: %s',
		'CHAT_EDIT'						=> 'Редактировать сообщение',
		'CHAT_QUOTE'					=> 'Ответить с цитатой',
		'EMPTY'							=> 'Ошибка: вы должны ввести сообщение.',
		'GUEST_MESSAGE'					=> '<strong>Вы должны быть зарегистрированы, чтобы пользоваться чатом.</strong>',
		'MESSAGE'						=> 'Сообщение',
		'PAGE_TITLE'					=> 'Чат',
		'RESPOND'						=> 'Обратиться по никнейму',
		'UNIT'							=> 'секунд',
		'UPDATES'						=> 'Обновление каждые',
		'CHAT'							=> 'Чат',
		'CHAT_EXPLAIN'					=> 'Чат',
		'WHOIS_CHATTING'				=> 'Кто в чате',
		'CHAT_FONT_COLOR'				=> 'Цвет сообщений',
		'SELECT_COLOR'					=> 'Выберите ваш цвет сообщений в чате',
		'CHAT_SUBMIT_MESSAGE'			=> 'Отправить сообщение',
		'DELETE_CHAT_MESSAGE'			=> 'Удалить сообщение',
		'BBCODES'			 			=> 'ББкоды',
		'IE_NO_AJAX'					=> 'Ваша версия Internet Explorer не поддерживает AJAX.',
		'UPGRADE_BROWSER'				=> 'Статус: Невозможно создать XmlHttpRequest Object.	Обновите свой браузер.',
		'NO_POST_IN_CHAT'				=> 'Вы не можете отвечать в чате.',
		'NO_DEL_PERMISSION'				=> 'Вы не можете удалять сообщения в чате.',
		'NO_EDIT_PERMISSION'			=> 'Вы не можете редактировать это сообщение.',
		'NO_VIEW_PERMISSION'			=> 'У вас нет права видеть чат.',
		'DELETE_CHAT_COOKIE'			=> 'Удалить куки',
		'DELETE_CHAT_COOKIE_EXPLAIN'	=> 'Эта кнопка удаляет куки сохранения цвета.',
		// @copyright line. No translations below this line.
		// Removing this from the template files will result in support no longer given.
		'DETAILS'				=> '<a href="http://www.livemembersonly.com" style="font-weight: bold;">AJAX Chat &copy; 2015</a> <strong style="color: #AA0000;">Live Members Only</strong>',
	)
);
