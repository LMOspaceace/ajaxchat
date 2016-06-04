<?php

/**
 *
 * Ajax Chat extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 * @polish translation by HPK
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
		'CHAT_ARCHIVE'			=> 'Archiwum',
		'CHAT_ARCHIVE_EXPLAIN'		=> 'Archiwum',
		'CHAT_POPUP'			=> 'Nowe okno',
		'CHAT_POPUP_EXPLAIN'		=> 'Czat w nowym oknie',
		'CHAT_RULE'			=> 'Zasady czatowania: ',
		'CHAT_RULE_EXPLAIN'		=> 'Nie stosuj wulgaryzmów.',
		'CHAT_NEW_POST'			=> 'Nowa odpowiedź: %s',
		'CHAT_NEW_TOPIC'		=> 'Nowy temat: %s',
		'CHAT_POST_EDIT'		=> 'Edytowano: %s',
		'CHAT_NEW_QUOTE'		=> 'has replied with a quote to: %s',
		'EMPTY'				=> 'Błąd: Musisz wprowadzić wiadomość.',
		'GUEST_MESSAGE'			=> '<strong>Musisz się zarejestrować, by móc korzystać z czatu.</strong>',
		'MESSAGE'			=> 'Wiadomość',
		'PAGE_TITLE'			=> 'Czat forumowy',
		'RESPOND'			=> 'Odpowiedź użytkownikowi',
		'UNIT'				=> 'sekund',
		'UPDATES'			=> 'Aktualizowany co',
		'CHAT'				=> 'Czat',
		'CHAT_EXPLAIN'			=> 'Czat',
		'WHOIS_CHATTING'		=> 'Kto czatuje:',
		'CHAT_FONT_COLOR'		=> 'Kolor czcionki',
		'SELECT_COLOR'			=> 'Wybierz swój kolor czcionki:',
		'CHAT_SUBMIT_MESSAGE'		=> 'Wyślij wiadomość',
		'DELETE_CHAT_MESSAGE'		=> 'Usuń wiadomość',
		'BBCODES'			=> 'BBCode',
		'IE_NO_AJAX'			=> 'Twoja wersja Internet Explorer nie wspiera technologii AJAX.',
		'UPGRADE_BROWSER'		=> 'Status: Nie można utworzyć obiektu XmlHttpRequest. Rozważ zaktualizowanie swojej przeglądarki.',
		'NO_POST_IN_CHAT'		=> 'Nie posiadasz odpowiednich uprawnień, by móc pisać na czacie.',
		'DELETE_CHAT_COOKIE'		=> 'Usuń cookie',
		'DELETE_CHAT_COOKIE_EXPLAIN'	=> 'Tenm przycisk usuwa cookie zawierające kolor czcionki.',
	)
);
