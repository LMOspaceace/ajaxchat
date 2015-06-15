<?php

/**
*
* Ajax Chat extension for phpBB.
*
* @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
* Swedish translation by Holger (https://www.maskinisten.net)
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
		'ADMIN_AJAXCHAT_SETTINGS'			=> 'Inställningar',
		'ACP_AJAX_CHAT_TITLE'				=> 'Ajax Chatt',
		'ACP_AJAX_CHAT'						=> 'Ajax Chatt',
		'AJAX_CHAT_SETTINGS'				=> 'Inställningar för Ajax Chatt',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'		=> 'Här kan du ändra inställningarna för Ajax Chatten.',
		'DISPLAY_AJAX_CHAT'					=> 'Aktivera Ajax Chatten',
		'INDEX_DISPLAY_AJAX_CHAT'			=> 'Visa Ajax Chatten på startsidan',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'	=> 'Deaktiveras denna inställning så döljs chatten endast på forumets startsida.',
		'WHOIS_CHATTING'					=> 'Aktivera rutan Vem chattar',
		'WHOIS_CHATTING_EXPLAIN'			=> 'Deaktiveras denna inställning så döljs rutan Vem chattar oberoende av användarens inställningar.',
		'FORUM_POSTS_AJAX_CHAT'				=> 'Aktivera visning av forumaktivitet (svar, nya trådar, mm) i chatten',
		'ARCHIVE_AMOUNT_AJAX_CHAT'			=> 'Arkiverade meddelanden',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Antal arkiverade meddelanden som skall visas. Mellan 5 och 500. Standard är 200.',
		'POPUP_AMOUNT_AJAX_CHAT'			=> 'Popup-meddelanden',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Antal popup-meddelanden som skall visas. Mellan 5 och 150. Standard är 60.',
		'INDEX_AMOUNT_AJAX_CHAT'			=> 'Chattmeddelanden på startsidan',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Antal meddelanden som skall visas på startsidan. Mellan 5 och 150. Standard är 60.',
		'CHAT_AMOUNT_AJAX_CHAT'				=> 'Chattmeddelanden',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'		=> 'Antal chattmeddelanden som skall visas. Mellan 5 och 150. Standard är 60.',
		'RULE_AJAX_CHAT'					=> 'Angen en enkel regel för chatten',
		'RULE_AJAX_CHAT_EXPLAIN'			=> 'Exempel: inga påhopp eller kränkande inlägg!',
		'LOCATION_AJAX_CHAT'				=> 'Chattens position uppe på startsidan',
		'LOCATION_AJAX_CHAT_EXPLAIN'		=> 'Inställningen "Nej" flyttar chatten till botten av startsidan.',
		'TIME_SETTING_AJAX_CHAT'			=> 'Tidsinställning',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'	=> 'Denna inställning skriver över användarinställningen för datumsformat. Lämna tomt för att använda användarinställningen.',
		'ACL_U_AJAXCHAT_BBCODE'				=> 'Kan använda bbcode i chatten',
		'ACL_U_AJAXCHAT_POST'				=> 'Kan skriva i chatten',
		'ACL_U_AJAXCHAT_VIEW'				=> 'Kan se chatten',
		'ACL_M_AJAXCHAT_DELETE'				=> 'Kan radera meddelanden i chatten',
		'STATUS_ONLINE_CHAT'				=> 'Onlinestatus',
		'STATUS_ONLINE_CHAT_EXPLAIN'		=> 'Inställning av användarens onlinestatustid efter antal sekunder. Standard är 0.',
		'STATUS_IDLE_CHAT'					=> 'Vilostatus',
		'STATUS_IDLE_CHAT_EXPLAIN'			=> 'Inställning av användarens vilostatustid efter antal sekunder. Standard är 300.',
		'STATUS_OFFLINE_CHAT'				=> 'Offlinestatus',
		'STATUS_OFFLINE_CHAT_EXPLAIN'		=> 'Inställning av användarens offlinestatustid efter antal sekunder. Standard är 1800.',
		'REFRESH_ONLINE_CHAT'				=> 'Online aktualiseringstid',
		'REFRESH_ONLINE_CHAT_EXPLAIN'		=> 'Inställning av användarens onlinestatustid efter antal sekunder. Standard är 5.',
		'REFRESH_IDLE_CHAT'					=> 'Viloaktualiseringstid',
		'REFRESH_IDLE_CHAT_EXPLAIN'			=> 'Inställning av användarens viloaktualiseringstid efter antal sekunder. Standard är 60.',
		'REFRESH_OFFLINE_CHAT'				=> 'Offline aktualiseringstid',
		'REFRESH_OFFLINE_CHAT_EXPLAIN'		=> 'Inställning av användarens offlinestatustid efter antal sekunder. Standard är 300.',
		'AJAX_CHAT_PRUNE'					=> 'Automatisk rensning',
		'PRUNE_AJAX_CHAT'					=> 'Automatisk rensning av meddelanden',
		'PRUNE_AJAX_CHAT_EXPLAIN'			=> 'Deaktivering av denna inställning leder till manuellt läge.',
		'PRUNE_KEEP_AJAX_CHAT'				=> 'Antal meddelanden som skall lämnas',
		'PRUNE_NOW'							=> 'Rensa nu',
		'PRUNE_LOG_AJAXCHAT'				=> 'Chatt-tabellen har rensats',
		'PRUNE_LOG_AJAXCHAT_AUTO'			=> 'Automatisk rensning av chatt-tabellen',
		'PRUNE_CHAT_SUCESS'					=> 'Chatt-tabellen har rensats',
		'CONFIRM_PRUNE_AJAXCHAT'			=> 'Bekräfta att du verkligen vill rensa chatt-tabellen.',
		'TRUNCATE_NOW'						=> 'Trunkera nu',
		'CONFIRM_TRUNCATE_AJAXCHAT'			=> 'Bekräfta att du verkligen vill trunkera chatt-tabellen.',
		'TRUNCATE_LOG_AJAXCHAT'				=> 'Trunkerade chatt-tabellen',
		'TRUNCATE_CHAT_SUCESS'				=> 'Chatt-tabellen har trunkerats',
		'CHAT_COUNTER'						=> 'Antal chatt-meddelanden i databasen',
		'ROLE_MOD_CHAT'						=> 'Ajax Chatt moderator',
		'ROLE_MOD_CHAT_EXPLAIN'				=> 'Ajax Chatt role för moderatorer.',
	)
);
