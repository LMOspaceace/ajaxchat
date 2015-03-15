<?php

/**
 *
 * Ajax Chat extension for phpBB.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace spaceace\ajaxchat\ucp;

class ajaxchat_info
{

    function module()
    {
        return [
            'filename' => '\spaceace\ajaxchat\ucp\ajaxchat_module',
            'title'    => 'USER_AJAXCHAT',
            'modes'    => [
                'settings' => [
                    'title' => 'ADMIN_AJAXCHAT_SETTINGS',
                    'auth'  => 'ext_spaceace\ajaxchat && acl_u_chgprofileinfo',
                    'cat'   => ['USER_AJAXCHAT']
                ],
            ],
        ];
    }

}