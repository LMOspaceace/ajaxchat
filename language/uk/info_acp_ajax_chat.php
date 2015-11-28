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
		'ADMIN_AJAXCHAT_SETTINGS'		=> 'Налаштування',
		'ACP_AJAX_CHAT_TITLE'						=> 'Ajax Chat',
		'ACP_AJAX_CHAT'								=> 'Ajax Chat',
		'AJAX_CHAT_SETTINGS'			=> 'Налаштування Ajax Chat',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'	=> 'Тут ви можете налаштувати параметри Ajax Chat.',
		'DISPLAY_AJAX_CHAT'				=> 'Увімкнути Ajax Chat',
		'INDEX_DISPLAY_AJAX_CHAT'					=> 'Enable Ajax Chat on index page',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'			=> 'Setting this to "Disabled" will only turn off Ajax Chat on "Board Index".',
		'WHOIS_CHATTING'				=> 'Увімкнути блок "Хто у чаті"',
		'WHOIS_CHATTING_EXPLAIN'		=> 'Установка у "Вимкнено" відключає блок "Хто у чаті", незалежно від параметрів користувачів.',
		'AJAX_CHAT_POSTS'							=> 'Forum post settings',
		'FORUM_POSTS_AJAX_CHAT'						=> 'Enable forum to post in chat',
		'FORUM_POSTS_AJAX_CHAT_TOPIC'				=> 'Enable new topics to display in chat',
		'FORUM_POSTS_AJAX_CHAT_REPLY'				=> 'Enable topic replies to display in chat',
		'FORUM_POSTS_AJAX_CHAT_EDIT'				=> 'Enable edited posts to display in chat',
		'FORUM_POSTS_AJAX_CHAT_QUOTE'				=> 'Enable quoted posts to display in chat',
		'ARCHIVE_AMOUNT_AJAX_CHAT'		=> 'Архів повідомлень',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Кількість повідомлень у архіві  для відображення. Між 5 і 500. За замовчуванням 200.',
		'POPUP_AMOUNT_AJAX_CHAT'		=> 'Виринаючі повідомлення',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Кількість виринаючих повідомлень для відображення. Між 5 і 150. За замовчуванням 60.',
		'INDEX_AMOUNT_AJAX_CHAT'		=> 'Повідомлення чату',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Кількість повідомлень чату для відображення. Між 5 і 150. За замовчуванням 60.',
		'CHAT_AMOUNT_AJAX_CHAT'						=> 'Chat messages',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'				=> 'Amount of chat messages to display. Between 5 and 150. Default is 60.',
		'RULE_AJAX_CHAT'				=> 'Вставте прості правила для чату',
		'RULE_AJAX_CHAT_EXPLAIN'		=> 'Наприклад: Заборонено нецезурні та образливі вислови!!!',
		'AJAX_CHAT_LOCATION'						=> 'Chat location',
		'LOCATION_AJAX_CHAT_OVERRIDE'				=> 'Override user’s chat position',
		'LOCATION_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Enabling this setting will override the chat position setting in the UCP as well as remove the UCP option.',
		'LOCATION_AJAX_CHAT'						=> 'Chat position at the top of index page',
		'LOCATION_AJAX_CHAT_EXPLAIN'				=> 'Setting this to "No" will move the chat to the bottom of the index page.',
		'TIME_SETTING_AJAX_CHAT'					=> 'Time Setting',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'			=> 'This setting will override user setting on date format. Leave Blank to use User Settings.',
		'ACL_U_AJAXCHAT_BBCODE'			=> 'Використовувати ББ-коди в чаті',
		'ACL_U_AJAXCHAT_POST'			=> 'Може публікувати повідомлення в чаті',
		'ACL_U_AJAXCHAT_VIEW'			=> 'Може переглядати чат',
		'ACL_M_AJAXCHAT_DELETE'			=> 'Може видаляти повідомлення в чаті',
		'STATUS_ONLINE_CHAT'						=> 'Online status',
		'STATUS_ONLINE_CHAT_EXPLAIN'				=> 'Sets users online status time in seconds. Default is 0.',
		'STATUS_IDLE_CHAT'							=> 'Idle status',
		'STATUS_IDLE_CHAT_EXPLAIN'					=> 'Sets users idle status time in seconds. Default is 300.',
		'STATUS_OFFLINE_CHAT'						=> 'Offline status',
		'STATUS_OFFLINE_CHAT_EXPLAIN'				=> 'Sets users offline status time in seconds. Default is 1800.',
		'REFRESH_ONLINE_CHAT'						=> 'Online refresh rate',
		'REFRESH_ONLINE_CHAT_EXPLAIN'				=> 'Sets users online refresh rate in seconds. Default is 5.',
		'REFRESH_IDLE_CHAT'							=> 'Idle refresh rate',
		'REFRESH_IDLE_CHAT_EXPLAIN'					=> 'Sets users idle refresh rate in seconds. Default is 60.',
		'REFRESH_OFFLINE_CHAT'						=> 'Offline refresh rate',
		'REFRESH_OFFLINE_CHAT_EXPLAIN'				=> 'Sets users offline refresh rate in seconds. Default is 300.',
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
