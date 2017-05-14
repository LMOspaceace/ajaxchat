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
		'ACP_AJAX_CHAT'								=> 'Чат',
		'ACP_AJAX_CHAT_EXPLAIN'						=> 'Здесь вы можете изменить настройки чата.',
		'AJAX_CHAT_SETTINGS'						=> 'Настройки чата',
		'DISPLAY_AJAX_CHAT'							=> 'Включить чат',
		'INDEX_DISPLAY_AJAX_CHAT'					=> 'Отображать чат на главной странице конференции',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'			=> 'Установка параметра «Отключено» отключит чат только на главной странице конференции',
		'WHOIS_CHATTING'							=> 'Включить список «Кто в чате»',
		'WHOIS_CHATTING_EXPLAIN'					=> 'Установка параметра «Отключено» отключит список «Кто в чате» независимо от настроек в Личном разделе пользователей',
		'AJAX_CHAT_POSTS'							=> 'Информационные сообщения',
		'FORUM_POSTS_AJAX_CHAT'						=> 'Отображать информацию о новых сообщениях на форуме в чате',
		'FORUM_POSTS_AJAX_CHAT_TOPIC'				=> 'Отображать информацию о новых темах на форуме в чате',
		'FORUM_POSTS_AJAX_CHAT_REPLY'				=> 'Отображать информацию о новых ответах на форуме в чате',
		'FORUM_POSTS_AJAX_CHAT_EDIT'				=> 'Отображать информацию о редактировании сообщений на форуме в чате',
		'FORUM_POSTS_AJAX_CHAT_QUOTE'				=> 'Отображать информацию о новых ответах с цитатой на форуме в чате',
		'ARCHIVE_AMOUNT_AJAX_CHAT'					=> 'Сообщений в архиве',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'			=> 'Количество отображаемых сообщений в архиве от 5 до 500. Значение по умолчанию: 200.',
		'POPUP_AMOUNT_AJAX_CHAT'					=> 'Сообщений в отдельном окне',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'			=> 'Количество отображаемых сообщений в отдельном окне от 5 до 150. Значение по умолчанию: 60.',
		'INDEX_AMOUNT_AJAX_CHAT'					=> 'Сообщений на главной странице конференции',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'			=> 'Количество отображаемых сообщений на главной странице конференции от 5 до 150. Значение по умолчанию: 60.',
		'CHAT_AMOUNT_AJAX_CHAT'						=> 'Сообщений в чате',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'				=> 'Количество отображаемых сообщений в чате от 5 до 150. Значение по умолчанию: 60.',
		'AJAX_CHAT_RULES'							=> 'Правила чата',
//Not uses		'RULES_AJAX_CHAT'							=> 'Insert a simple rule for chat',
		'RULES_AJAX_CHAT_EXPLAIN'					=> 'Здесь вы можете ввести правила чата или URL страницы/сообщения с правилами.',
		'AJAX_CHAT_LOCATION'						=> 'Местонахождение чата',
		'LOCATION_AJAX_CHAT_OVERRIDE'				=> 'Замена пользовательских настроек',
		'LOCATION_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Включение этой опции заменяет настройки пользователя в Личном разделе',
		'VIEWFORUM_AJAX_CHAT_OVERRIDE'				=> 'Замена пользовательских настроек отображения чата при просмотре форумов',
		'VIEWFORUM_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Включение этой опции заменяет настройки пользователя в Личном разделе при просмотре форумов',
		'VIEWTOPIC_AJAX_CHAT_OVERRIDE'				=> 'Замена пользовательских настроек отображения чата при просмотре тем',
		'VIEWTOPIC_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Включение этой опции заменяет настройки пользователя в Личном разделе при просмотре тем',
		'LOCATION_AJAX_CHAT'						=> 'Позиция в верхней части на главной странице конференции',
		'LOCATION_AJAX_CHAT_EXPLAIN'				=> 'При установке параметра в значение «Нет» чат будет отображаться в нижней части на главной странице конференции.',
		'TIME_SETTING_AJAX_CHAT'					=> 'Формат времени',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'			=> 'Этот параметр заменяет настройки в Личном разделе. Оставьте поле пустым, чтобы использовать пользовательские настройки.',
		'ACL_U_AJAXCHAT_BBCODE'						=> 'Может использовать ББкоды в чате',
		'ACL_U_AJAXCHAT_POST'						=> 'Может отвечать в чате',
		'ACL_U_AJAXCHAT_VIEW'						=> 'Может просматривать чат',
		'ACL_U_AJAXCHAT_EDIT'						=> 'Может редактировать все сообщения в чате',
		'ACL_M_AJAXCHAT_DELETE'						=> 'Может удалять сообщения в чате',
		'STATUS_ONLINE_CHAT'						=> 'Статус «В сети»',
		'STATUS_ONLINE_CHAT_EXPLAIN'				=> 'Время установки статуса «В сети» в секундах. Значение по умолчанию: 0.',
		'STATUS_IDLE_CHAT'							=> 'Статус «Отошел»',
		'STATUS_IDLE_CHAT_EXPLAIN'					=> 'Время установки статуса «Отошел» в секундах. Значение по умолчанию: 300.',
		'STATUS_OFFLINE_CHAT'						=> 'Статус «Не в сети»',
		'STATUS_OFFLINE_CHAT_EXPLAIN'				=> 'Время установки статуса «Не в сети» в секундах. Значение по умолчанию: 1800.',
		'REFRESH_ONLINE_CHAT'						=> 'Обновление чата у пользователей со статусом «В сети»',
		'REFRESH_ONLINE_CHAT_EXPLAIN'				=> 'Время обновления чата у пользователей со статусом «В сети» в секундах. Значение по умолчанию: 5.',
		'REFRESH_IDLE_CHAT'							=> 'Обновление чата у пользователей со статусом «Отошел»',
		'REFRESH_IDLE_CHAT_EXPLAIN'					=> 'Время обновления чата у пользователей со статусом «Отошел» в секундах. Значение по умолчанию: 60.',
		'REFRESH_OFFLINE_CHAT'						=> 'Обновление чата у пользователей со статусом «Не в сети»',
		'REFRESH_OFFLINE_CHAT_EXPLAIN'				=> 'Время обновления чата у пользователей со статусом «Не в сети» в секундах. Значение по умолчанию: 300.',
		'AJAX_CHAT_PRUNE'							=> 'Параметры очистки сообщений',
		'PRUNE_AJAX_CHAT'							=> 'Включить автоочистку',
		'PRUNE_AJAX_CHAT_EXPLAIN'					=> 'Выключите для ручной очистки сообщений.',
		'PRUNE_KEEP_AJAX_CHAT'						=> 'Количество последних сообщений, которые будут сохранены',
		'PRUNE_NOW'									=> 'Очистить сейчас',
		'PRUNE_LOG_AJAXCHAT'						=> 'Очистка сообщений чата',
		'PRUNE_LOG_AJAXCHAT_AUTO'					=> 'Автоматическая очистка сообщений чата',
		'PRUNE_CHAT_SUCCESS'						=> 'Очистка сообщений прошла успешно!',
		'CONFIRM_PRUNE_AJAXCHAT'					=> 'Вы уверены, что хотите выполнить очистку сообщений чата?',
		'TRUNCATE_NOW'								=> 'Полная очистка',
		'TRUNCATE_NOW_EXPLAIN'						=> 'Удаляет все сообщения из базы данных.',
		'CONFIRM_TRUNCATE_AJAXCHAT'					=> 'Вы уверены, что хотите удалить все сообщения чата из базы данных?',
		'TRUNCATE_LOG_AJAXCHAT'						=> 'Удалены все сообщения чата',
		'TRUNCATE_CHAT_SUCCESS'						=> 'Все сообщения чата были удалены.',
		'CHAT_COUNTER'								=> 'Количество сообщений в базе данных',
		'ROLE_MOD_CHAT'								=> 'Модератор чата',
		'ROLE_MOD_CHAT_EXPLAIN'						=> 'Роль модератора чата.',
		'AJAX_CHAT_NAV_LINK'						=> 'Отображать ссылку на чат в шапке конференции',
		'AJAX_CHAT_NAV_LINK_EXPLAIN'				=> 'Отображать ссылку на чат в меню шапки конференции после ссылки на FAQ.',
		'AJAX_CHAT_QUICK_LINK'						=> 'Отображать ссылку на чат в меню «Ссылки»',
		'AJAX_CHAT_QUICK_LINK_EXPLAIN'				=> 'Отображать ссылку на чат в раскрывающемся меню «Ссылки» в шапке конференции',
		'AJAX_CHAT_UPDATED_SETTINGS'				=> 'Обновление настроек чата',
		'AJAX_CHAT_LAYOUT'							=> 'Отображение чата',
		'AJAX_CHAT_INPUT_FULL'						=> 'Вывод всех доступных кнопок чата',
		'AJAX_CHAT_INPUT_FULL_EXPLAIN'				=> 'Отключение этой опции оставит только кнопку «Отправить» и поле ввода сообщения.',
		'AJAX_CHAT_CHATROW_FULL'					=> 'Минимальная высота сообщения',
		'AJAX_CHAT_CHATROW_FULL_EXPLAIN'			=> 'При включении этой опции высота сообщений будет минимальной для отображения большего количества сообщений.',
	)
);
