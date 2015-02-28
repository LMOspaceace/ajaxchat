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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge(
        $lang, array(
            'CHAT_ARCHIVE'         => 'Archive',
            'CHAT_ARCHIVE_EXPLAIN' => 'Chat Archive',
            'CHAT_POPUP'           => 'Popup',
            'CHAT_POPUP_EXPLAIN'   => 'Chat Popup',
            'CHAT_RULE'            => 'Chat Regel: ',
            'CHAT_RULE_EXPLAIN'    => 'Hou het netjes.',
            'EMPTY'                => 'Error: U moet een bericht invoegen.',
            'GUEST_MESSAGE'        => '<strong>U moet een geregistereede gebruiker zijn voor de chat.</strong>',
            'MESSAGE'              => 'Bericht',
            'PAGE_TITLE'           => 'Forum Chat',
            'RESPOND'              => 'Reageren op gebruiker',
            'UNIT'                 => 'Seconde',
            'UPDATES'              => 'Updates elke',
            'CHAT'                 => 'Chat',
            'CHAT_EXPLAIN'         => 'Chat Center',
            'WHOIS_CHATTING'       => 'Online leden :',
            'CHAT_FONT_COLOR'      => 'Chat tekst kleur',
            'SELECT_COLOR'         => 'Selecteer u chat tekst kleur',
            'CHAT_SUBMIT_MESSAGE'  => 'Verzend bericht',
            'DELETE_CHAT_MESSAGE'  => 'Verwijder chat bericht',
            'BBCODES'              => 'BBCodes',
            'IE_NO_AJAX'           => 'uw versie van Internet Explorer biedt geen ondersteuning AJAX.',
            'UPGRADE_BROWSER'      => 'Status: Cound XmlHttpRequest Object niet maken. Overweeg upgrading je browser.',
            'NO_POST_IN_CHAT'      => 'U bent niet gemachtigd om te posten in chat.',
            // @copyright line. No translations below this line
            'DETAILS'              => '<a href="http://www.livemembersonly.com" style="font-weight: bold;">AJAX Chat</a> &copy; 2015 <strong style="color: #AA0000;">Live Members Only</strong>',
        )
);
