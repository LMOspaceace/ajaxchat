<?php

/**
*
* Ajax Chat extension for phpBB.
*
* @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
* @license GNU General Public License, version 2 (GPL-2.0)
* traduction FR par stratege1401 à www.forum.fasx.org/phpbb/
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
		'ACP_AJAX_CHAT_TITLE'				=> 'Boite Dialogue Ajax',
		'ACP_AJAX_CHAT'						=> 'Boite Dialogue Ajax',
		'AJAX_CHAT_SETTINGS'				=> 'paramètres Dialogue Ajax',
		'ACP_AJAX_CHAT_TITLE_EXPLAIN'		=> 'Ici vous pouvez modifier les paramètres de Dialogue Ajax.',
		'DISPLAY_AJAX_CHAT'					=> 'Activer le Dialogue Ajax',
		'WHOIS_CHATTING'					=> 'Activation de la boite "En Ligne"',
		'WHOIS_CHATTING_EXPLAIN'			=> 'Si "Désactivé", La boite "En Ligne" sera désactivé quelque soit le paramètre de l\'utilisateur.',
		'REFRESH_AJAX_CHAT'					=> 'Rafraichissement en secondes',
		'ARCHIVE_AMOUNT_AJAX_CHAT'			=> 'Archivage messages',
		'ARCHIVE_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Nombres de messages archivés à montrer:( entre 5 et 500 ), par default 200.',
		'POPUP_AMOUNT_AJAX_CHAT'			=> 'Popup messages',
		'POPUP_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Nombres des messages "pop-up" à montrer: ( entre 5 et 150 ), par default 60.',
		'INDEX_AMOUNT_AJAX_CHAT'			=> 'Messages dialogue',
		'INDEX_AMOUNT_AJAX_CHAT_EXPLAIN'	=> 'Nombres des messages "dialogue" à montrer: ( entre 5 et 150 ), par default 60..',
		'RULE_AJAX_CHAT'					=> 'Inserer une régle simple',
		'RULE_AJAX_CHAT_EXPLAIN'			=> 'Example: Restez polies, merci!!!',
		'ACL_U_AJAXCHAT_BBCODE'				=> 'Vous pouvez utiliser bbcode',
		'ACL_U_AJAXCHAT_POST'				=> 'Vous pouvez ecrire des messages',
		'ACL_U_AJAXCHAT_VIEW'				=> 'Vous pouvez voir des messages',
		'ACL_M_AJAXCHAT_DELETE'				=> 'Vous pouvez effacer des messages',
	)
);
