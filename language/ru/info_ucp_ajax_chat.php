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
// Т ла╗ У Ф Е
//

$lang = array_merge(
	$lang, array(
		'CHAT_BOTTOM'					=> 'Внизу',
		'CHAT_TOP'						=> 'Вверху',
		'USER_AJAX_CHAT_VIEW'			=> 'Включить чат на главной странице конференции',
		'USER_AJAX_CHAT_POSITION'		=> 'Позиция на главной странице конференции для отображения чата',
		'USER_AJAX_CHAT_VIEWFORUM'		=> 'Включить чат при просмотре форумов',
		'USER_AJAX_CHAT_VIEWTOPIC'		=> 'Включить чат при просмотре тем',
		'USER_AJAX_CHAT_AVATARS'		=> 'Включить аватары в чате',
		'USER_AJAX_CHAT_SOUND'			=> 'Включить звук в чате',
		'USER_AJAX_CHAT_AVATAR_HOVER'	=> 'Отображать полноразмерные аватары в чате при наведении на миниатюры аватар',
		'USER_AJAX_CHAT_ONLINELIST'		=> 'Включить список «Кто в чате»',
		'USER_AJAX_CHAT_AUTOCOMPLETE'	=> 'Автозаполнение поля ввода в чате',
		'USER_AJAXCHAT'					=> 'Чат',
		'USER_AJAXCHAT_SETTINGS'		=> 'Настройки чата',
		'NO_VIEW_CHAT'					=> 'У вас нет права видеть чат.',
		'AJAX_CHAT_MESSAGES_DOWN'		=> 'Отображать новые сообщения вверху или внизу чата. Также перемещает поле ввода сообщения вверх или вниз',
	)
);
