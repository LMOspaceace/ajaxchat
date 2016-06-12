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
		'ACP_AJAX_CHAT'								=> 'Ajax Chat',
		'ACP_AJAX_CHAT_EXPLAIN'						=> 'Hier kunt u de Ajax Chat instellingen aanpassen.',
		'AJAX_CHAT_SETTINGS'						=> 'Ajax Chat Instellingen',
		'DISPLAY_AJAX_CHAT'							=> 'Inschakelen Ajax Chat',
		'INDEX_DISPLAY_AJAX_CHAT'					=> 'Inschakelen Ajax Chat op index pagina',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'			=> 'Instelling tot "Uitschakelen ajax chat op "Index Pagina".',
		'WHOIS_CHATTING'							=> 'Inschakelen: Wie is er online in de chat',
		'WHOIS_CHATTING_EXPLAIN'					=> 'instelling "Uitschakelen" zet het uit wie is er online in de chat ongeacht de gebruikers instellingen.',
		'AJAX_CHAT_POSTS'							=> 'Forum post instellingen',
		'FORUM_POSTS_AJAX_CHAT'						=> 'Inschakelen Nieuwe Onderwerpen en berichten van het forum in de chatbox',
		'FORUM_POSTS_AJAX_CHAT_TOPIC'				=> 'Inschakelen van de nieuwe onderwerpen weer te geven in de chat',
		'FORUM_POSTS_AJAX_CHAT_REPLY'				=> 'Inschakelen van de antwoorden van het onderwerp weer te geven in de chat',
		'FORUM_POSTS_AJAX_CHAT_EDIT'				=> 'Inschakelen van bewerkte posten weer te geven in de chat',
		'FORUM_POSTS_AJAX_CHAT_QUOTE'				=> 'Inschakelen quoted posten weer te geven in de chat',
		'ARCHIVE_AMOUNT_AJAX_CHAT'					=> 'Archive berichten',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'			=> 'Hoeveelheid berichten archiveren om weer te geven. Tussen 5 en 500. Standaard is 200.',
		'POPUP_AMOUNT_AJAX_CHAT'					=> 'Popup berichten',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'			=> 'Hoeveelheid pop-up berichten om weer te geven. Tussen 5 en 150. Standaard is 60.',
		'INDEX_AMOUNT_AJAX_CHAT'					=> 'Index chat berichten',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'			=> 'Hoeveelheid of chat berichten weer te geven in index. Tussen 5 and 150. Standaard is 60.',
		'CHAT_AMOUNT_AJAX_CHAT'						=> 'Chat berichten',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'				=> 'Hoeveelheid chatberichten weer te geven. Tussen 5 en 150. Standaard is 60.',
		'AJAX_CHAT_RULES'							=> 'Chat regels',
		'RULES_AJAX_CHAT'							=> 'Invoegen van een simpele regel voor chat',
		'RULES_AJAX_CHAT_EXPLAIN'					=> 'Hier bent u in staat de regels voor chat hier invoeren. Of u kunt het invoeren van een URL van een pagina/post met uw chatregels.',
		'AJAX_CHAT_LOCATION'						=> 'Chat locatie',
		'LOCATION_AJAX_CHAT_OVERRIDE'				=> 'Overschrijven gebruikers chat positie',
		'LOCATION_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Inschakelen van deze instelling zal negeren van het standpunt van de chat instellen in de UCP evenals de UCP optie verwijderen.',
		'VIEWFORUM_AJAX_CHAT_OVERRIDE'				=> 'Overschrijven gebruikers bekijk forum instelling',
		'VIEWFORUM_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Inschakelen van deze instelling zal voorrang op de instelling van de forum chat in de UCP evenals de UCP optie verwijderen.',
		'VIEWTOPIC_AJAX_CHAT_OVERRIDE'				=> 'Overschrijven gebruikers bekijk topic instelling',
		'VIEWTOPIC_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Inschakelen van deze instelling zal voorrang op de instelling viewtopic chat in de UCP evenals de UCP optie verwijderen.',
		'LOCATION_AJAX_CHAT'						=> 'Chat positie bovenin index pagina',
		'LOCATION_AJAX_CHAT_EXPLAIN'				=> 'Dit ingestelt op zal "Nee" Zet de chat aan de onderkant van de index-pagina.',
		'TIME_SETTING_AJAX_CHAT'					=> 'Tijd instelling',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'			=> 'Deze instelling overschrijft de instelling van de gebruiker op datum formaat. Leeg laten om te gebruiken van gebruikersinstellingen.',
		'ACL_U_AJAXCHAT_BBCODE'						=> 'Bbcode kunt gebruiken in chat',
		'ACL_U_AJAXCHAT_POST'						=> 'Kan berichten plaatsen in chat',
		'ACL_U_AJAXCHAT_VIEW'						=> 'Kan chat bekijken',
		'ACL_U_AJAXCHAT_EDIT'						=> 'Kan alle chat berichten wijzigen',
		'ACL_M_AJAXCHAT_DELETE'						=> 'Kan posts in chat verwijderen',
		'STATUS_ONLINE_CHAT'						=> 'Online status',
		'STATUS_ONLINE_CHAT_EXPLAIN'				=> 'Hiermee stelt u gebruikers onlinestatus tijd in seconden.Standaard is 0.',
		'STATUS_IDLE_CHAT'							=> 'Inactief status',
		'STATUS_IDLE_CHAT_EXPLAIN'					=> 'Zet gebruikers inactieve status tijd in seconden. Standaard is 300.',
		'STATUS_OFFLINE_CHAT'						=> 'Offline status',
		'STATUS_OFFLINE_CHAT_EXPLAIN'				=> 'Zet gebruikers offline status tijd in seconden. Standaard is 1800.',
		'REFRESH_ONLINE_CHAT'						=> 'Online ververssnelheid',
		'REFRESH_ONLINE_CHAT_EXPLAIN'				=> 'Zet gebruikers online ververssnelheid in seconden. Standaard is 5.',
		'REFRESH_IDLE_CHAT'							=> 'Inactieve ververssnelheid',
		'REFRESH_IDLE_CHAT_EXPLAIN'					=> 'Zet gebruikers inactieve ververssnelheid in seconden.Standaard is 60.',
		'REFRESH_OFFLINE_CHAT'						=> 'Offline ververssnelheid',
		'REFRESH_OFFLINE_CHAT_EXPLAIN'				=> 'Zet gebruikers offline ververssnelheid in seconden. Standaard is 300.',
		'AJAX_CHAT_PRUNE'							=> 'Snoeien instellingen',
		'PRUNE_AJAX_CHAT'							=> 'Auto snoeien berichten',
		'PRUNE_AJAX_CHAT_EXPLAIN'					=> 'Uitschakelen word dit ingesteld op handmatige modus.',
		'PRUNE_KEEP_AJAX_CHAT'						=> 'Nummer of berichten om te houden',
		'PRUNE_NOW'									=> 'Snoeien Nu',
		'PRUNE_LOG_AJAXCHAT'						=> 'Gesnoeid chat table',
		'PRUNE_LOG_AJAXCHAT_AUTO'					=> 'Automatische chat tabel snoeien',
		'PRUNE_CHAT_SUCCESS'						=> 'Chat table successvol gesnoeid!',
		'CONFIRM_PRUNE_AJAXCHAT'					=> 'Bevestigen dat u werkelijk wilt snoeien van de chat-database.',
		'TRUNCATE_NOW'								=> 'Inkorten Nu',
		'CONFIRM_TRUNCATE_AJAXCHAT'					=> 'Bevestigen dat u werkelijk wilt inkorten van de chat-database.',
		'TRUNCATE_LOG_AJAXCHAT'						=> 'Inkorten chat table',
		'TRUNCATE_CHAT_SUCCESS'						=> 'Chat table ingekort',
		'CHAT_COUNTER'								=> 'Nummer of chat berichten in database',
		'ROLE_MOD_CHAT'								=> 'Ajax Chat moderator',
		'ROLE_MOD_CHAT_EXPLAIN'						=> 'Ajax Chat rol voor moderators.',
		'AJAX_CHAT_NAV_LINK'						=> 'Weergeven Chat Center link op menubar',
		'AJAX_CHAT_NAV_LINK_EXPLAIN'				=> 'Weergeven Chat Center link on menubar na de FAQ link.',
		'AJAX_CHAT_QUICK_LINK'						=> 'Weergeven Chat Center link in Snelle Links',
		'AJAX_CHAT_QUICK_LINK_EXPLAIN'				=> 'Weergeven Chat Center link in de Snelle Links drop menu.',
		'AJAX_CHAT_UPDATED_SETTINGS'				=> 'Updated Ajax Chat instellingen',
		'AJAX_CHAT_LAYOUT'							=> 'Chat Layout',
		'AJAX_CHAT_INPUT_FULL'						=> 'Chat invoer met alle beschikbare knoppen',
		'AJAX_CHAT_INPUT_FULL_EXPLAIN'				=> 'Het uitschakelen van dit zal verlaten alleen de "Submit" knop en bericht inputbox waardoor het een zeer basic input als een shoutbox.',
		'AJAX_CHAT_CHATROW_FULL'					=> 'kort bericht hoogte',
		'AJAX_CHAT_CHATROW_FULL_EXPLAIN'			=> 'Dit uit te schakelen, wordt de chat bericht hoogte ingesteld op zijn oorspronkelijke hoogte. Waardoor dit zal bericht hoogte zo kort mogelijk terwijl het passend meer berichten in het oog hebben.',
	)
);
