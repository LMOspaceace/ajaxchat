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
		'ADMIN_AJAXCHAT_SETTINGS'			=> 'Instellingen',
		'ACP_AJAX_CHAT_TITLE'						=> 'Ajax Chat',
		'ACP_AJAX_CHAT'								=> 'Ajax Chat',
		'AJAX_CHAT_SETTINGS'						=> 'Ajax Chat Settings',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'		=> 'Hier kunt u de Ajax Chat instellingen aanpassen.',
		'DISPLAY_AJAX_CHAT'					=> 'Inschakelen Ajax Chat',
		'INDEX_DISPLAY_AJAX_CHAT'			=> 'Inschakelen Ajax Chat op de index pagina',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'	=> 'Instelling tot "Uitschakelen ajax chat op "Index Pagina".',
		'WHOIS_CHATTING'					=> 'Inschakelen Wie is er online in de chat',
		'WHOIS_CHATTING_EXPLAIN'			=> 'instelling "Uitschakelen" zet het uit wie is er online in de chat ongeacht de gebruikers instellingen.',
		'AJAX_CHAT_POSTS'							=> 'Forum post settings',
		'FORUM_POSTS_AJAX_CHAT'				=> 'Inschakelen Nieuwe Onderwerpen en berichten van het forum in de chatbox',
		'FORUM_POSTS_AJAX_CHAT_TOPIC'				=> 'Enable new topics to display in chat',
		'FORUM_POSTS_AJAX_CHAT_REPLY'				=> 'Enable topic replies to display in chat',
		'FORUM_POSTS_AJAX_CHAT_EDIT'				=> 'Enable edited posts to display in chat',
		'FORUM_POSTS_AJAX_CHAT_QUOTE'				=> 'Enable quoted posts to display in chat',
		'ARCHIVE_AMOUNT_AJAX_CHAT'			=> 'Archive berichten',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Hoeveelheid berichten archiveren om weer te geven. Tussen 5 en 500. Standaard is 200.',
		'POPUP_AMOUNT_AJAX_CHAT'			=> 'Popup berichten',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Hoeveelheid of popup berichten om weer te geven. Tussen 5 en 150. Standaard is 60.',
		'INDEX_AMOUNT_AJAX_CHAT'			=> 'Index chat berichten',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Hoeveelheid of chat berichten om weer te geven op index. Tussen 5 en 150. Standaard is 60.',
		'CHAT_AMOUNT_AJAX_CHAT'				=> 'Chat berichten',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'		=> 'Hoeveelheid of chat berichten om weer te geven. Tussen 5 en 150. Standaard is 60.',
		'RULE_AJAX_CHAT'					=> 'Een chatregel voor chat invoegen',
		'RULE_AJAX_CHAT_EXPLAIN'			=> 'Voorbeeld: Geen aanstoonde of beledigende taal in de chat!!!',
		'AJAX_CHAT_LOCATION'						=> 'Chat location',
		'LOCATION_AJAX_CHAT_OVERRIDE'				=> 'Override user’s chat position',
		'LOCATION_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Enabling this setting will override the chat position setting in the UCP as well as remove the UCP option.',
		'LOCATION_AJAX_CHAT'						=> 'Chat position at the top of index page',
		'LOCATION_AJAX_CHAT_EXPLAIN'				=> 'Setting this to "No" will move the chat to the bottom of the index page.',
		'TIME_SETTING_AJAX_CHAT'			=> 'Tijdinstelling',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'	=> 'Deze instelling zal gebruiker instelling op datumnotatie overschrijven . Laat leeg om gebruikersinstellingen te gebruiken.',
		'ACL_U_AJAXCHAT_BBCODE'				=> 'Kan bbcode gebruiken in chat',
		'ACL_U_AJAXCHAT_POST'				=> 'Kan berichten plaatsen in chat',
		'ACL_U_AJAXCHAT_VIEW'				=> 'Kan chat bekijken',
		'ACL_M_AJAXCHAT_DELETE'				=> 'Kan berichten verwijderen in chat',
		'STATUS_ONLINE_CHAT'						=> 'Online status',
		'STATUS_ONLINE_CHAT_EXPLAIN'		=> 'Zet gebruikers online status tijd in secondes. Standaard is 0.',
		'STATUS_IDLE_CHAT'					=> 'Inactieve status',
		'STATUS_IDLE_CHAT_EXPLAIN'			=> 'Zet gebruikers inactieve status tijd in secondes. Standaard is 300.',
		'STATUS_OFFLINE_CHAT'						=> 'Offline status',
		'STATUS_OFFLINE_CHAT_EXPLAIN'		=> 'Zet gebruikers offline status tijd in secondes. Standaard is 1800.',
		'REFRESH_ONLINE_CHAT'				=> 'Online refresh snelheid',
		'REFRESH_ONLINE_CHAT_EXPLAIN'		=> 'Zet gebruikers online refresh snelheid in secondes. Standaard is 5.',
		'REFRESH_IDLE_CHAT'					=> 'Inactieve refresh snelheid',
		'REFRESH_IDLE_CHAT_EXPLAIN'			=> 'Zet gebruikers inactief refresh snelheid in secondes. Standaard is 60.',
		'REFRESH_OFFLINE_CHAT'				=> 'Offline refresh snelheid',
		'REFRESH_OFFLINE_CHAT_EXPLAIN'		=> 'Zet gebruikers offline refresh snelheid in secondes. Standaard is 300.',
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
