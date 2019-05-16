<?php

/**
 *
 * Ajax Chat extension for phpBB.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace spaceace\ajaxchat;

/**
* Extension class for custom enable/disable/purge actions
*/
class ext extends \phpbb\extension\base
{
	const AJAX_CHAT_VERSION = '3.0.26';

	public function is_enableable()
	{
		$config = $this->container->get('config');
		return (version_compare($config['version'], '3.1.0', '>=') && (version_compare(PHP_VERSION, '5.4.*', '>=')));
	}
}
