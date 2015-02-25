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
        'CHAT_BOTTOM'                 => 'Bas',
        'CHAT_TOP'                    => 'Haut',
        'USER_AJAX_CHAT_VIEW'         => 'Boite dialogue visible sur la page index',
        'USER_AJAX_CHAT_POSITION'     => 'Position sur index pour montrer la boite de Dialogue',
        'USER_AJAX_CHAT_AVATARS'      => 'Montrer les Avatars ',
        'USER_AJAX_CHAT_SOUND'        => 'Entendre les sons',
        'USER_AJAX_CHAT_AVATAR_HOVER' => 'Monteer l avatar entier par souris sur image',
        'USER_AJAX_CHAT_ONLINELIST'   => 'Voir liste des connectes',
        'USER_AJAXCHAT'               => 'Dialogue Ajax ',
        'USER_AJAXCHAT_SETTINGS'      => 'Paramétres Dialogue Ajax',
        'NO_VIEW_CHAT'                => 'Vous n\'avez pas les droits pour voir le Dialogue.',
    )
);
