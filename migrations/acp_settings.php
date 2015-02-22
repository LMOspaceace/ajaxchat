<?php

/**
 *
 * Ajax Chat extension for phpBB.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace spaceace\ajaxchat\migrations;

class acp_settings extends \phpbb\db\migration\migration
{

    static public function depends_on()
    {
        return array();
    }

    public function update_data()
    {
        return array(
            array('config.add', array('display_ajax_chat', '1')),
            array('config.add', array('refresh_ajax_chat', '10')),
            array('config.add', array('rule_ajax_chat', '')),
        );
    }
}
