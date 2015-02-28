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

use phpbb\db\migration\migration;

class add_permissions extends migration
{

	public function update_data()
	{
		return array(
			// Add permission
			array('permission.add', array('u_ajaxchat_view', true)),
			array('permission.add', array('u_ajaxchat_post', true)),
			array('permission.add', array('u_ajaxchat_bbcode', true)),
			array('permission.add', array('m_ajaxchat_delete', true)),
			// Set permissions
			array('permission.permission_set', array('REGISTERED', 'u_ajaxchat_view', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_ajaxchat_post', 'group')),
			array('permission.permission_set', array('REGISTERED', 'u_ajaxchat_bbcode', 'group')),
			array('permission.permission_set', array('ROLE_MOD_FULL', 'm_ajaxchat_delete')),
			array('permission.permission_set', array('GUESTS', 'u_ajaxchat_view', 'group')),
		);
	}
}
