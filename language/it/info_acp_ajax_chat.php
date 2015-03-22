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
		'ADMIN_AJAXCHAT_SETTINGS'			=> 'Settaggi',
		'ACP_AJAX_CHAT_TITLE'				=> 'Ajax Chat',
		'ACP_AJAX_CHAT'						=> 'Ajax Chat',
		'AJAX_CHAT_SETTINGS'				=> 'Settaggi Ajax Chat',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'		=> 'Qui puoi editare i settaggi di Ajax Chat.',
		'DISPLAY_AJAX_CHAT'					=> 'Abilita Ajax Chat',
		'INDEX_DISPLAY_AJAX_CHAT'	=> 'Abilita Ajax Chat sulla pagina indice',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'	=> 'Settando questo a "Disabilita" spegnerai solo Ajax Chat nell\'indice della Board.',
		'WHOIS_CHATTING'					=> 'Abilita schermata Chi sta chattando',
		'WHOIS_CHATTING_EXPLAIN'			=> 'Settando questo a "Disabilitato" nasconderai la schermata Chi sta Chattando in chat senza riguardo verso i settaggi degli utenti.',
		'FORUM_POSTS_AJAX_CHAT'	=> 'Abilita il forum a postare in chat una notifica per i nuovi post',
		'REFRESH_AJAX_CHAT'					=> 'Aggiorna Chat ogni (tempo in secondi)',
		'ARCHIVE_AMOUNT_AJAX_CHAT'			=> 'Archivio messaggi',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Ammontare dell\'archivio messaggi da mostrare. Tra 5 e 500. Di default e\' 200.',
		'POPUP_AMOUNT_AJAX_CHAT'			=> 'Popup messaggi',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Ammontare di messaggi popup da visualizzare. Tra 5 e 150. Di default e\' 60.',
		'INDEX_AMOUNT_AJAX_CHAT'			=> 'Messaggi Chat Indice',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Ammontare di messaggi chat da visualizzare sulla pagina indice. Tra 5 e 150. Di default e\' 60.',
		'CHAT_AMOUNT_AJAX_CHAT'	=> 'Messaggi chat',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Ammontare di messaggi da visualizzare in chat. Tra 5 e 150. Di default e\' 60.',
		'RULE_AJAX_CHAT'					=> 'Inserisci una semplice regola per la chat',
		'RULE_AJAX_CHAT_EXPLAIN'			=> 'Esempio: Niente offese o linguaggio scorretto in chat!!!',
		'TIME_SETTING_AJAX_CHAT'	=> 'Settaggi Ora',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'	=> 'Questi settaggi Sovraintenderanno sui settaggi dell\'utente riguardo il formato orario. Lasciare vuoto per usare i settaggi utente.',
		'ACL_U_AJAXCHAT_BBCODE'				=> 'Puo\' usare il bbcode in chat',
		'ACL_U_AJAXCHAT_POST'				=> 'Puo\' postare messaggi in chat',
		'ACL_U_AJAXCHAT_VIEW'				=> 'Puo\' visualizzare la chat',
		'ACL_M_AJAXCHAT_DELETE'				=> 'Puo\' cancellare i post in chat',
		'STATUS_ONLINE_CHAT'	=> 'Stato Online',
		'STATUS_ONLINE_CHAT_EXPLAIN'	=> 'Setta lo stato di utenti online, in secondi. Di default e\' 0.',
		'STATUS_IDLE_CHAT'	=> 'Stato Inattivo',
		'STATUS_IDLE_CHAT_EXPLAIN'	=> 'Setta lo stato di utenti inattivi, in secondi. Di default e\' 300.',
		'STATUS_OFFLINE_CHAT'	=> 'Stato Offline',
		'STATUS_OFFLINE_CHAT_EXPLAIN'	=> 'Setta lo stato di utenti offline, in secondi. Di default e\' 1800.',
		'REFRESH_ONLINE_CHAT'	=> 'Frequenza di aggiornamento Online',
		'REFRESH_ONLINE_CHAT_EXPLAIN'	=> 'Imposta la frequenza di aggiornamento di utenti online, in secondi. Di default e\' 5.',
		'REFRESH_IDLE_CHAT'	=> 'Frequenza di aggiornamento Inattivi',
		'REFRESH_IDLE_CHAT_EXPLAIN'	=> 'Imposta la frequenza di aggiornamento di utenti inattivi, in secondi. Di default e\' 60.',
		'REFRESH_OFFLINE_CHAT'	=> 'Frequenza di aggiornamento Offline',
		'REFRESH_OFFLINE_CHAT_EXPLAIN'	=> 'Imposta la frequenza di aggiornamento di utenti offline, in secondi. Di default e\' 300.',
	)
);
