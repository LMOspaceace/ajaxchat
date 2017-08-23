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
		'ACP_AJAX_CHAT'								=> 'Messagerie instantanée Ajax',
		'ACP_AJAX_CHAT_EXPLAIN'						=> 'Sur cette page il est possible de modifier les paramètres de la messagerie instantanée.',
		'AJAX_CHAT_SETTINGS'						=> 'Paramètres de la messagerie instantanée',
		'DISPLAY_AJAX_CHAT'							=> 'Activer la messagerie instantanée Ajax',
		'INDEX_DISPLAY_AJAX_CHAT'					=> 'Activer la messagerie instantanée Ajax sur  la page « Index » du forum',
		'INDEX_DISPLAY_AJAX_CHAT_EXPLAIN'			=> 'Si cette option est sur « Désactivé » l’affichage de la messagerie instantanée Ajax est uniquement supprimé de la page « Index » du forum.',
		'WHOIS_CHATTING'							=> 'Activer la boite « Qui est en ligne »',
		'WHOIS_CHATTING_EXPLAIN'					=> 'Si cette option est sur « Désactivé » la boite « Qui est en ligne » sera désactivée quelque soit le paramètre de l’utilisateur.',
		'AJAX_CHAT_POSTS'							=> 'Paramètres des messages du forum',
		'FORUM_POSTS_AJAX_CHAT'						=> 'Activer l’affichage des nouveaux messages sur le forum dans la messagerie instantanée',
		'FORUM_POSTS_AJAX_CHAT_TOPIC'				=> 'Activer l’affichage des nouveaux sujets',
		'FORUM_POSTS_AJAX_CHAT_REPLY'				=> 'Activer l’affichage des réponses aux sujets',
		'FORUM_POSTS_AJAX_CHAT_EDIT'				=> 'Activer l’affichage des messages modifiés',
		'FORUM_POSTS_AJAX_CHAT_QUOTE'				=> 'Activer l’affichage des citations de messages',
		'ARCHIVE_AMOUNT_AJAX_CHAT'					=> 'Messages archivés',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'			=> 'Nombres de messages à afficher dans la fenêtre des messages archivés. Entre 5 et 500, et par défaut à 200.',
		'POPUP_AMOUNT_AJAX_CHAT'					=> 'Messages dans la pop-up',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'			=> 'Nombres des messages à afficher dans la fenêtre pop-up. Entre 5 et 150, et par défaut à 60.',
		'INDEX_AMOUNT_AJAX_CHAT'					=> 'Messages sur la page « Index »',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'			=> 'Nombres des messages à afficher sur la page « Index » du forum. Entre 5 et 150, et par défaut à 60.',
		'CHAT_AMOUNT_AJAX_CHAT'						=> 'Messages de la messagerie instantanée',
		'CHAT_AMOUNT_AJAX_CHAT_EXPLAIN'				=> 'Nombres des messages à afficher sur la page dédiée à la messagerie instantanée. Entre 5 et 150, et par défaut à 60.',
		'AJAX_CHAT_RULES'							=> 'Règles de la messagerie instantanée',
		'RULES_AJAX_CHAT'							=> 'Définir une règle simple',
		'RULES_AJAX_CHAT_EXPLAIN'					=> 'Permet de saisir les règles pour la messagerie instantanée. Il est possible de saisir une adresse URL vers un sujet stipulant vos règles, telle que : page/message-contenant-vos-regles.',
		'AJAX_CHAT_LOCATION'						=> 'Emplacement de la messagerie instantanée',
		'LOCATION_AJAX_CHAT_OVERRIDE'				=> 'Outrepasser le choix de l’emplacement sur la page « Index »',
		'LOCATION_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Permet d’outrepasser le choix des utilisateurs concernant l’emplacement de la messagerie instantanée sur la page « Index » du forum. L’affichage de ce paramètre est supprimé dans l’UCP (Panneau de l’utilisateur).',
		'VIEWFORUM_AJAX_CHAT_OVERRIDE'				=> 'Outrepasser le choix de l’emplacement dans la vue des sujets',
		'VIEWFORUM_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Permet d’outrepasser le choix des utilisateurs concernant l’emplacement de la messagerie instantanée sur la vue des sujets (viewforum). L’affichage de ce paramètre est supprimé dans l’UCP (Panneau de l’utilisateur).',
		'VIEWTOPIC_AJAX_CHAT_OVERRIDE'				=> 'Outrepasser le choix de l’emplacement dans la vue des messages',
		'VIEWTOPIC_AJAX_CHAT_OVERRIDE_EXPLAIN'		=> 'Permet d’outrepasser le choix des utilisateurs concernant l’emplacement de la messagerie instantanée sur la vue des messages (viewtopic). L’affichage de ce paramètre est supprimé dans l’UCP (Panneau de l’utilisateur).',
		'LOCATION_AJAX_CHAT'						=> 'Emplacement de la messagerie sur la page « Index »',
		'LOCATION_AJAX_CHAT_EXPLAIN'				=> 'Permet d’afficher la messagerie instantanée en haut « Oui » ou en bas « Non » sur la page « Index » du forum.',
		'TIME_SETTING_AJAX_CHAT'					=> 'Outrepasser le choix de la date',
		'TIME_SETTING_AJAX_CHAT_EXPLAIN'			=> 'Permet d’outrepasser le choix des utilisateurs concernant le format de la date affichée dans la messagerie instantanée. Laisser vide pour ne pas outrepasser le paramètre des utilisateurs.',
		'ACL_U_AJAXCHAT_BBCODE'						=> 'Peut utiliser les BBCodes dans la messagerie instantanée.',
		'ACL_U_AJAXCHAT_POST'						=> 'Peut saisir des messages dans la messagerie instantanée.',
		'ACL_U_AJAXCHAT_VIEW'						=> 'Peut voir la messagerie instantanée.',
		'ACL_U_AJAXCHAT_EDIT'						=> 'Peut modifier tous les messages dans la messagerie instantanée.',
		'ACL_M_AJAXCHAT_DELETE'						=> 'Peut supprimer les messages dans la messagerie instantanée.',
		'STATUS_ONLINE_CHAT'						=> 'Statut en ligne',
		'STATUS_ONLINE_CHAT_EXPLAIN'				=> 'Paramètre de la présence en ligne des utilisateurs en ligne. Par défaut à 0 (temps en secondes).',
		'STATUS_IDLE_CHAT'							=> 'Statut en veille',
		'STATUS_IDLE_CHAT_EXPLAIN'					=> 'Paramètre de la présence en ligne des utilisateurs en veille. Par défaut à 300 (temps en secondes).',
		'STATUS_OFFLINE_CHAT'						=> 'Statut hors-ligne',
		'STATUS_OFFLINE_CHAT_EXPLAIN'				=> 'Paramètre de la présence en ligne des utilisateurs déconnectés. Par défaut à 1800 (temps en secondes).',
		'REFRESH_ONLINE_CHAT'						=> 'Taux de rafraîchissement en ligne',
		'REFRESH_ONLINE_CHAT_EXPLAIN'				=> 'Paramètre du taux de rafraîchissement des utilisateurs en ligne. Par défaut à 5 (temps en secondes).',
		'REFRESH_IDLE_CHAT'							=> 'Taux de rafraîchissement en veille',
		'REFRESH_IDLE_CHAT_EXPLAIN'					=> 'Paramètre du taux de rafraîchissement des utilisateurs en veille. Par défaut à 60 (temps en secondes).',
		'REFRESH_OFFLINE_CHAT'						=> 'Taux de rafraîchissement hors-ligne',
		'REFRESH_OFFLINE_CHAT_EXPLAIN'				=> 'Paramètre du taux de rafraîchissement des utilisateurs déconnectés. Par défaut à 300 (temps en secondes).',
		'AJAX_CHAT_PRUNE'							=> 'Paramètres de purge',
		'PRUNE_AJAX_CHAT'							=> 'Purger automatiquement les messages',
		'PRUNE_AJAX_CHAT_EXPLAIN'					=> 'En désactivant ce paramètre le mode manuel va s’activer.',
		'PRUNE_KEEP_AJAX_CHAT'						=> 'Nombre de messages à archiver',
		'PRUNE_NOW'									=> 'Purger maintenant',
		'PRUNE_LOG_AJAXCHAT'						=> 'Table de la messagerie purgée',
		'PRUNE_LOG_AJAXCHAT_AUTO'					=> 'Purge automatique de la table de la messagerie',
		'PRUNE_CHAT_SUCCESS'						=> 'La table de la messagerie a été purgée avec succès !',
		'CONFIRM_PRUNE_AJAXCHAT'					=> 'Merci de confirmer la purge des messages de la messagerie.',
		'TRUNCATE_NOW'								=> 'Vider la table maintenant',
		'CONFIRM_TRUNCATE_AJAXCHAT'					=> 'Merci de confirmer la suppression des données de la table de la messagerie.',
		'TRUNCATE_LOG_AJAXCHAT'						=> 'Table de la messagerie vidée',
		'TRUNCATE_CHAT_SUCCESS'						=> 'La table de la messagerie a été vidée avec succès !',
		'CHAT_COUNTER'								=> 'Nombre de messages de la messagerie dans la base de données',
		'ROLE_MOD_CHAT'								=> 'Modérateur de la messagerie instantanée',
		'ROLE_MOD_CHAT_EXPLAIN'						=> 'Rôle du modérateur de la messagerie instantanée.',
		'AJAX_CHAT_NAV_LINK'						=> 'Afficher le lien de la messagerie dans la barre de navigation',
		'AJAX_CHAT_NAV_LINK_EXPLAIN'				=> 'Permet d’afficher le lien de la messagerie instantanée dans la barre de navigation après le lien « FAQ ».',
		'AJAX_CHAT_QUICK_LINK'						=> 'Afficher le lien de la messagerie dans « Accès rapide »',
		'AJAX_CHAT_QUICK_LINK_EXPLAIN'				=> 'Permet d’afficher le lien de la messagerie instantanée dans le menu « Accès rapide ».',
		'AJAX_CHAT_UPDATED_SETTINGS'				=> 'Paramètres de la messagerie instantanée Ajax mis à jour',
		'AJAX_CHAT_LAYOUT'							=> 'Interface de la messagerie instantanée Ajax',
		'AJAX_CHAT_INPUT_FULL'						=> 'Afficher l’ensemble des boutons',
		'AJAX_CHAT_INPUT_FULL_EXPLAIN'				=> 'Permet d’activer l’affichage de tous les boutons de l’interface de la messagerie instantanée. Si désactivé, seuls le bouton « Envoyer » ainsi que le champ de saisie du texte seront affichés.',
		'AJAX_CHAT_CHATROW_FULL'					=> 'Hauteur de l’affichage des messages',
		'AJAX_CHAT_CHATROW_FULL_EXPLAIN'			=> 'Permet de maximiser le nombre de messages affichés dans la messagerie instantanée en limitant autant que faire se peut la hauteur de ces derniers. Si désactivé, la hauteur de l’affichage des messages sera celle par défaut.',
	)
);
