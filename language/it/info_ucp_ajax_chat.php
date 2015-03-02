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
		'CHAT_BOTTOM'					=> 'In basso',
		'CHAT_TOP'						=> 'In alto',
		'USER_AJAX_CHAT_VIEW'			=> 'Visualizza la chat sulla pagina index',
		'USER_AJAX_CHAT_POSITION'		=> 'Posizione in cui visualizzare la chat sulla pagina index',
		'USER_AJAX_CHAT_AVATARS'		=> 'Visualizza avatar in chat',
		'USER_AJAX_CHAT_SOUND'			=> 'Ascolta suoni chat',
		'USER_AJAX_CHAT_AVATAR_HOVER'	=> 'Visualizza l\'intero avatar in rilievo',
		'USER_AJAX_CHAT_ONLINELIST'		=> 'Guarda la lista online in chat',
		'USER_AJAXCHAT'					=> 'Ajax Chat',
		'USER_AJAXCHAT_SETTINGS'		=> 'Settaggi Ajax Chat',
		'NO_VIEW_CHAT'					=> 'Non hai il permesso di visualizzare la chat.',
	)
);
