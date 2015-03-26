<?php

/**
*
* Ajax Chat extension for phpBB.
*
* @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
* @license GNU General Public License, version 2 (GPL-2.0)
* French translation by stratege1401 (http://www.forum.fasx.org/phpbb/) & Galixte (http://www.galixte.com)
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
		'ADMIN_AJAXCHAT_SETTINGS'			=> 'Paramètres',
		'ACP_AJAX_CHAT_TITLE'				=> 'Messagerie instantanée Ajax',
		'ACP_AJAX_CHAT'						=> 'Messagerie instantanée Ajax',
		'AJAX_CHAT_SETTINGS'				=> 'Paramètres de la messagerie instantanée',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'		=> 'Ici vous pouvez modifier les paramètres de la messagerie instantanée.',
		'DISPLAY_AJAX_CHAT'					=> 'Activer la messagerie instantanée Ajax',
		'INDEX_DISPLAY_AJAX_CHAT'			=> 'Activer la messagerie instantanée Ajax sur la page index',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'	=> 'Si cette option est sur « Désactivé » l’affichage de la messagerie instantanée Ajax est uniquement supprimé de la page « index du forum ».',
		'WHOIS_CHATTING'					=> 'Activer la boite « Qui est en ligne »',
		'WHOIS_CHATTING_EXPLAIN'			=> 'Si cette option est sur « Désactivé » la boite « Qui est en ligne » sera désactivée quelque soit le paramètre de l’utilisateur.',
		'FORUM_POSTS_AJAX_CHAT'				=> 'Activer un forum pour écrire dans la messagerie instantanée à propos des nouveaux messages',
		'REFRESH_AJAX_CHAT'					=> 'Temps d’actualisation en secondes',
		'ARCHIVE_AMOUNT_AJAX_CHAT'			=> 'Messages archivés',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Nombres de messages archivés à afficher. Entre 5 et 500, et par défaut à 200.',
		'POPUP_AMOUNT_AJAX_CHAT'			=> 'Messages de la pop-up',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Nombres des messages de la pop-up à afficher. Entre 5 et 150, et par défaut à 60.',
		'INDEX_AMOUNT_AJAX_CHAT'			=> 'Messages sur l’index',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Nombres des messages sur l’index à afficher. Entre 5 et 150, et par défaut à 60.',
		'CHAT_AMOUNT_AJAX_CHAT'				=> 'Messages de la messagerie instantanée',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'		=> 'Nombres des messages de la messagerie instantanée à afficher. Entre 5 et 150, et par défaut à 60.',
		'RULE_AJAX_CHAT'					=> 'Définir une règle simple',
		'RULE_AJAX_CHAT_EXPLAIN'			=> 'Exemple : Restez polies, merci !',
		'TIME_SETTING_AJAX_CHAT'			=> 'Paramètre de la date',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'	=> 'Ce paramètre concerne le format de la date et va écraser celui de l’utilisateur. Laisser vide pour utiliser le paramètre de l’utilisateur.',
		'ACL_U_AJAXCHAT_BBCODE'				=> 'Peut utiliser les BBCodes dans la messagerie instantanée.',
		'ACL_U_AJAXCHAT_POST'				=> 'Peut écrire des messages dans la messagerie instantanée.',
		'ACL_U_AJAXCHAT_VIEW'				=> 'Peut voir la messagerie instantanée.',
		'ACL_M_AJAXCHAT_DELETE'				=> 'Peut supprimer les messages dans la messagerie instantanée.',
		'STATUS_ONLINE_CHAT'				=> 'Statut en ligne',
		'STATUS_ONLINE_CHAT_EXPLAIN'		=> 'Paramètre de la présence en ligne des utilisateurs en ligne. Par défaut à 0 (temps en secondes).',
		'STATUS_IDLE_CHAT'					=> 'Statut en veille',
		'STATUS_IDLE_CHAT_EXPLAIN'			=> 'Paramètre de la présence en ligne des utilisateurs en veille. Par défaut à 300 (temps en secondes).',
		'STATUS_OFFLINE_CHAT'				=> 'Statut hors-ligne',
		'STATUS_OFFLINE_CHAT_EXPLAIN'		=> 'Paramètre de la présence en ligne des utilisateurs déconnectés. Par défaut à 1800 (temps en secondes).',
		'REFRESH_ONLINE_CHAT'				=> 'Taux de rafraîchissement en ligne',
		'REFRESH_ONLINE_CHAT_EXPLAIN'		=> 'Paramètre du taux de rafraîchissement des utilisateurs en ligne. Par défaut à 5 (temps en secondes).',
		'REFRESH_IDLE_CHAT'					=> 'Taux de rafraîchissement en veille',
		'REFRESH_IDLE_CHAT_EXPLAIN'			=> 'Paramètre du taux de rafraîchissement des utilisateurs en veille. Par défaut à 60 (temps en secondes).',
		'REFRESH_OFFLINE_CHAT'				=> 'Taux de rafraîchissement hors-ligne',
		'REFRESH_OFFLINE_CHAT_EXPLAIN'		=> 'Paramètre du taux de rafraîchissement des utilisateurs déconnectés. Par défaut à 300 (temps en secondes).',
	)
);
