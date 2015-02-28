<?php

/**
*
* Ajax Chat extension for phpBB.
*
* @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
* @license GNU General Public License, version 2 (GPL-2.0)
* @polish translation by HPK
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
		'ADMIN_AJAXCHAT_SETTINGS'		=> 'Ustawienia',
		'ACP_AJAX_CHAT_TITLE'			=> 'Ajax Chat',
		'ACP_AJAX_CHAT'					=> 'Ajax Chat',
		'AJAX_CHAT_SETTINGS'			=> 'Ustawienia Ajax Chat',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'	=> 'Możesz tutaj zmieniać ustawienia Ajax Chat.',
		'DISPLAY_AJAX_CHAT'				=> 'Włącz Ajax Chat',
		'WHOIS_CHATTING'				=> 'Włącz wyświetlanie "Kto czatuje"',
		'WHOIS_CHATTING_EXPLAIN'		=> 'Wyłączenie tej opcji spowoduje nie wyświetlanie się okienka "Kto czatuje", bez względu na ustawienia indywidualne użytkowników.',
		'REFRESH_AJAX_CHAT'				=> 'Odświeżaj (w sekundach)',
		'RULE_AJAX_CHAT'				=> 'Wstaw zadadę użytkowania czatu',
		'RULE_AJAX_CHAT_EXPLAIN'		=> 'Przykład: Nie używaj wulgaryzmów!!!',
		'ACL_U_AJAXCHAT_BBCODE'			=> 'Można używać BBCode na czacie',
		'ACL_U_AJAXCHAT_POST'			=> 'Można pisać na czacie',
		'ACL_U_AJAXCHAT_VIEW'			=> 'Można widzieć czat',
		'ACL_M_AJAXCHAT_DELETE'			=> 'Można usuwać wiadomości na czacie',
	)
);
