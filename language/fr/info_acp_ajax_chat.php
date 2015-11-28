<?php

/**
 *
 * Ajax Chat extension for the phpBB Forum Software package.
 * French translation by stratege1401 (http://www.forum.fasx.org/phpbb/) & Galixte (http://www.galixte.com)
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
		'AJAX_CHAT_POSTS'							=> 'Forum post settings',
		'FORUM_POSTS_AJAX_CHAT'				=> 'Activer l’affichage des nouveaux messages sur le forum dans la messagerie instantanée',
		'FORUM_POSTS_AJAX_CHAT_TOPIC'				=> 'Enable new topics to display in chat',
		'FORUM_POSTS_AJAX_CHAT_REPLY'				=> 'Enable topic replies to display in chat',
		'FORUM_POSTS_AJAX_CHAT_EDIT'				=> 'Enable edited posts to display in chat',
		'FORUM_POSTS_AJAX_CHAT_QUOTE'				=> 'Enable quoted posts to display in chat',
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
		'AJAX_CHAT_LOCATION'						=> 'Chat location',
		'LOCATION_AJAX_CHAT_OVERRIDE'				=> 'Override user’s chat position',
		'LOCATION_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Enabling this setting will override the chat position setting in the UCP as well as remove the UCP option.',
		'LOCATION_AJAX_CHAT'				=> 'Emplacement de la messagerie en haut de la page de l’index',
		'LOCATION_AJAX_CHAT_EXPLAIN'		=> 'Pour afficher la messagerie en bas de la page de l’index du forum, paramétrer sur « Non ».',
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
		'AJAX_CHAT_PRUNE'					=> 'Paramètres de purge',
		'PRUNE_AJAX_CHAT'					=> 'Purger automatiquement les messages',
		'PRUNE_AJAX_CHAT_EXPLAIN'			=> 'En désactivant ce paramètre, le mode manuel va s’activer.',
		'PRUNE_KEEP_AJAX_CHAT'				=> 'Nombre de messages à archiver',
		'PRUNE_NOW'							=> 'Purger maintenant',
		'PRUNE_LOG_AJAXCHAT'				=> 'Table de la messagerie purgée',
		'PRUNE_LOG_AJAXCHAT_AUTO'			=> 'Purge automatique de la table de la messagerie',
		'PRUNE_CHAT_SUCESS'					=> 'La table de la messagerie a été purgée avec succès !',
		'CONFIRM_PRUNE_AJAXCHAT'			=> 'Veuillez confirmer la purge des messages de la messagerie.',
		'TRUNCATE_NOW'						=> 'Vider la table maintenant',
		'CONFIRM_TRUNCATE_AJAXCHAT'			=> 'Veuillez confirmer la suppression des données de la table de la messagerie.',
		'TRUNCATE_LOG_AJAXCHAT'				=> 'Table de la messagerie vidée',
		'TRUNCATE_CHAT_SUCESS'				=> 'La table de la messagerie a été vidée avec succès !',
		'CHAT_COUNTER'						=> 'Nombre de messages de la messagerie dans la base de données',
		'ROLE_MOD_CHAT'						=> 'Modérateur de la messagerie instantanée',
		'ROLE_MOD_CHAT_EXPLAIN'				=> 'Rôle du modérateur de la messagerie instantanée.',
	)
);
