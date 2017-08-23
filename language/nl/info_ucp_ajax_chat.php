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
		'CHAT_BOTTOM'					=> 'Bodem',
		'CHAT_TOP'						=> 'Boven',
		'USER_AJAX_CHAT_VIEW'			=> 'Weergave chat op index pagina',
		'USER_AJAX_CHAT_POSITION'		=> 'Positie op index om chat weer te geven',
		'USER_AJAX_CHAT_VIEWFORUM'		=> 'Weergeven chat in forums',
		'USER_AJAX_CHAT_VIEWTOPIC'		=> 'Weergeven chat in topics',
		'USER_AJAX_CHAT_AVATARS'		=> 'Weergeven avatars in chat',
		'USER_AJAX_CHAT_SOUND'			=> 'Hoor geluid in chat',
		'USER_AJAX_CHAT_AVATAR_HOVER'	=> 'Volledige avatar afbeelding weergeven bij aanwijzen',
		'USER_AJAX_CHAT_ONLINELIST'		=> 'De online list weergave in chat',
		'USER_AJAX_CHAT_AUTOCOMPLETE'	=> 'Chat invoervak AutoAanvullen',
		'USER_AJAXCHAT'					=> 'Ajax Chat',
		'USER_AJAXCHAT_SETTINGS'		=> 'Ajax Chat Instellingen',
		'NO_VIEW_CHAT'					=> 'U hebt geen toestemming om te chat bekijken.',
		'AJAX_CHAT_MESSAGES_DOWN'		=> 'Nieuwste chatberichten weergeven in de boven- of onderkant van de chat. Ook gaat de inputbox naar de boven- of onderkant',
	)
);
