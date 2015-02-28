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
		'ADMIN_AJAXCHAT_SETTINGS'		=> 'Instellingen',
		'ACP_AJAX_CHAT_TITLE'			=> 'Ajax Chat',
		'ACP_AJAX_CHAT'					=> 'Ajax Chat',
		'AJAX_CHAT_SETTINGS'			=> 'Ajax Chatinstellingen',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'	=> 'Hier kunt u de Ajax Chat instellingen aanpassen',
		'DISPLAY_AJAX_CHAT'				=> 'Inschakelen Ajax Chat',
		'WHOIS_CHATTING'				=> 'Inschakelen Wie is er online in de chat',
		'WHOIS_CHATTING_EXPLAIN'		=> 'instelling "Uitgeschakeld" zet het uit wie is er online in de chat ongeacht de gebruikers instellingen.',
		'REFRESH_AJAX_CHAT'				=> 'Vernieuwen van de tijd in seconden',
		'RULE_AJAX_CHAT'				=> 'Een chatregel voor chat invoegen',
		'RULE_AJAX_CHAT_EXPLAIN'		=> 'Voorbeeld: Geen aanstoonde of beledigende taal in de chat!!!',
		'ACL_U_AJAXCHAT_BBCODE'			=> 'Kan gebruik bbcode in chat',
		'ACL_U_AJAXCHAT_POST'			=> 'Kunnen berichten plaatsen in chat',
		'ACL_U_AJAXCHAT_VIEW'			=> 'Kan chat bekijken',
		'ACL_M_AJAXCHAT_DELETE'			=> 'Kan berichten verwijderen in chat',
	)
);
