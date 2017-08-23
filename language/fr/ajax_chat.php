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
		'CHAT_ARCHIVE'					=> 'Archive',
		'CHAT_ARCHIVE_EXPLAIN'			=> 'Fenêtre des messages archivés de la messagerie instantanée',
		'CHAT_POPUP'					=> 'Pop-up',
		'CHAT_POPUP_EXPLAIN'			=> 'Fenêtre pop-up de la messagerie instantanée',
		'CHAT_RULE'						=> 'Règles de la messagerie instantanée : ',
		'CHAT_RULE_EXPLAIN'				=> 'Merci d’être courtois dans vos propos.',
		'CHAT_NEW_POST'					=> 'a répondu à : %s',
		'CHAT_NEW_TOPIC'				=> 'a créé un nouveau sujet : %s',
		'CHAT_POST_EDIT'				=> 'a modifié : %s',
		'CHAT_NEW_QUOTE'				=> 'a répondu en citant à : %s',
		'CHAT_EDIT'						=> 'Modifier le message',
		'CHAT_QUOTE'					=> 'Citer le message',
		'EMPTY'							=> 'Erreur : un message doit être saisi.',
		'GUEST_MESSAGE'					=> '<strong>Il est nécessaire de se connecter au forum pour utiliser la messagerie instantanée.</strong>',
		'MESSAGE'						=> 'Message',
		'PAGE_TITLE'					=> 'Messagerie instantanée du forum',
		'RESPOND'						=> 'Répondre à :',
		'UNIT'							=> 'secondes',
		'UPDATES'						=> 'Mises à jour toutes les',
		'CHAT'							=> 'Messagerie instantanée',
		'CHAT_EXPLAIN'					=> 'Messagerie instantanée',
		'WHOIS_CHATTING'				=> 'Qui est en ligne',
		'CHAT_FONT_COLOR'				=> 'Couleur de la police de caractère',
		'SELECT_COLOR'					=> 'Choisir une couleur pour la police de caractère de la messagerie instantanée.',
		'CHAT_SUBMIT_MESSAGE'			=> 'Envoyer un message',
		'DELETE_CHAT_MESSAGE'			=> 'Effacer un message',
		'BBCODES'			 			=> 'BBCodes',
		'IE_NO_AJAX'					=> 'Votre navigateur ne supporte pas le language AJAX.',
		'UPGRADE_BROWSER'				=> 'Statut : impossible de créer l’objet JavaScript XmlHttpRequest. Veuillez mettre à jour votre navigateur.',
		'NO_POST_IN_CHAT'				=> 'Des permissions sont nécessaires pour utiliser la messagerie instantanée.',
		'NO_EDIT_PERMISSION'			=> 'Des permissions sont nécessaires pour modifier ce message de la messagerie instantanée.',
		'DELETE_CHAT_COOKIE'			=> 'Supprimer le cookie',
		'DELETE_CHAT_COOKIE_EXPLAIN'	=> 'Le bouton ci-dessous réinitialise la couleur par défaut de la police.',
		// @copyright line. No translations below this line.
		// Removing this from the template files will result in support no longer given.
		'DETAILS'				=> '<a href="http://www.livemembersonly.com" style="font-weight: bold;">AJAX Chat &copy; 2015</a> <strong style="color: #AA0000;">Live Members Only</strong>',
	)
);
