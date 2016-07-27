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
		'CHAT_BOTTOM'					=> 'En bas',
		'CHAT_TOP'						=> 'En haut',
		'USER_AJAX_CHAT_VIEW'			=> 'Afficher la messagerie instantanée sur la page « Index » du forum',
		'USER_AJAX_CHAT_POSITION'		=> 'Emplacement de la messagerie instantanée sur la page « Index » du forum',
		'USER_AJAX_CHAT_VIEWFORUM'		=> 'Afficher la messagerie instantanée dans les forums',
		'USER_AJAX_CHAT_VIEWTOPIC'		=> 'Afficher la messagerie instantanée dans les sujets',
		'USER_AJAX_CHAT_AVATARS'		=> 'Afficher les avatars dans la messagerie instantanée',
		'USER_AJAX_CHAT_SOUND'			=> 'Activer les sons dans la messagerie instantanée',
		'USER_AJAX_CHAT_AVATAR_HOVER'	=> 'Afficher la taille réelle de l’avatar au survol de la souris dans la messagerie instantanée',
		'USER_AJAX_CHAT_ONLINELIST'		=> 'Voir la liste des utilisateurs en ligne dans la messagerie instantanée',
		'USER_AJAX_CHAT_AUTOCOMPLETE'	=> 'Activer l’autocomplétion dans le champ de saisie du texte de la messagerie instantanée',
		'USER_AJAXCHAT'					=> 'Messagerie instantanée Ajax',
		'USER_AJAXCHAT_SETTINGS'		=> 'Messagerie instantanée',
		'NO_VIEW_CHAT'					=> 'Des permissions sont nécessaires pour voir la messagerie instantanée.',
		'AJAX_CHAT_MESSAGES_DOWN'		=> 'Afficher en haut ou en bas, dans la messagerie instantanée, les nouveaux messages de la messagerie instantanée. Ce paramètre modifie aussi l’emplacement du champ de saisie du texte.',
	)
);
