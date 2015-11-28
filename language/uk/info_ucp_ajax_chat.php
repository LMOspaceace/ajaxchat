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
		'CHAT_BOTTOM'                 => 'Знизу',
		'CHAT_TOP'                    => 'Зверху',
		'USER_AJAX_CHAT_VIEW'         => 'Відображати чат на головній сторінці',
		'USER_AJAX_CHAT_POSITION'     => 'Місце на головній для відображення чату',
		'USER_AJAX_CHAT_AVATARS'      => 'Відображати аватари в чаті',
		'USER_AJAX_CHAT_SOUND'        => 'Дозволити звуки в чаті',
		'USER_AJAX_CHAT_AVATAR_HOVER' => 'Показувати повний аватар при наведенні курсора',
		'USER_AJAX_CHAT_ONLINELIST'   => 'Відображати онлайн список у чаті',
		'USER_AJAXCHAT'					=> 'Ajax Chat',
		'USER_AJAXCHAT_SETTINGS'      => 'Ajax Chat налаштування',
		'NO_VIEW_CHAT'                => 'Ви не маєте дозволу для перегляду чату.',
	)
);
