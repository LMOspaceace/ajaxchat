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

class ucp_ajaxchat_info
{

	function module()
	{
		return array(
			'filename' => '\spaceace\ajaxchat\ucp\ucp_ajaxchat_module',
			'title'	=> 'USER_AJAXCHAT',
			'modes'	=> array(
				'settings' => array(
					'title' => 'USER_AJAXCHAT_SETTINGS',
					'auth'  => 'ext_spaceace/ajaxchat && acl_u_chgprofileinfo && acl_u_ajaxchat_view',
					'cat'   => array('USER_AJAXCHAT')
				),
			),
		);
	}
}
