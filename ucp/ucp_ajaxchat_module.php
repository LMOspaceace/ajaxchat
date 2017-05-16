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

class ucp_ajaxchat_module
{

	public $u_action;
	public $tpl_name;
	public $page_title;

	/** @var \phpbb\db\driver\driver_interface Database Connection Object */
	protected $db;

	/** @var \phpbb\config\db */
	protected $config;

	/** @var \phpbb\user User Object */
	protected $user;

	/** @var \phpbb\auth\auth Auth Object */
	protected $auth;

	/** @var \phpbb\template\template Template Object */
	protected $template;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string Installation root path */
	protected $root_path;

	/** @var string PHP file extension */
	protected $php_ext;

	public function __construct()
	{
		global $db, $config, $user, $auth, $template, $phpbb_root_path, $phpEx;
		global $request, $phpbb_container;
		$this->db			= $db;
		$this->config		= $config;
		$this->user			= $user;
		$this->auth			= $auth;
		$this->template		= $template;
		$this->request		= $request;
		$this->root_path	= $phpbb_root_path;
		$this->php_ext		= $phpEx;
		$this->users_table	= $phpbb_container->getParameter('tables.users');
	}

	public function main($id, $mode)
	{

		switch ($mode)
		{
			case 'settings':

				if (!$this->config['location_ajax_chat_override'])
				{
					$chat_position1		= $this->request->variable('ajax_chat_position', (bool) $this->user->data['user_ajax_chat_position']);
				}
				else
				{
					$chat_position1		= '0';
				}

				if (!$this->config['viewforum_ajax_chat_override'])
				{
					$chat_viewforum1		= $this->request->variable('ajax_chat_viewforum', (bool) $this->user->data['user_ajax_chat_viewforum']);
				}
				else
				{
					$chat_viewforum1		= '0';
				}

				if (!$this->config['viewtopic_ajax_chat_override'])
				{
					$chat_viewtopic1		= $this->request->variable('ajax_chat_viewtopic', (bool) $this->user->data['user_ajax_chat_viewtopic']);
				}
				else
				{
					$chat_viewtopic1		= '0';
				}

				$data = array(
					'user_ajax_chat_view'			=> $this->request->variable('ajax_chat_view', (bool) $this->user->data['user_ajax_chat_view']),
					'user_ajax_chat_avatars'		=> $this->request->variable('ajax_chat_avatars', (bool) $this->user->data['user_ajax_chat_avatars']),
					'user_ajax_chat_position'		=> $chat_position1,
					'user_ajax_chat_viewforum'		=> $chat_viewforum1,
					'user_ajax_chat_viewtopic'		=> $chat_viewtopic1,
					'user_ajax_chat_sound'			=> $this->request->variable('ajax_chat_sound', (bool) $this->user->data['user_ajax_chat_sound']),
					'user_ajax_chat_avatar_hover'	=> $this->request->variable('ajax_chat_avatar_hover', (bool) $this->user->data['user_ajax_chat_avatar_hover']),
					'user_ajax_chat_onlinelist'		=> $this->request->variable('ajax_chat_onlinelist', (bool) $this->user->data['user_ajax_chat_onlinelist']),
					'user_ajax_chat_autocomplete'	=> $this->request->variable('ajax_chat_autocomplete', (bool) $this->user->data['user_ajax_chat_autocomplete']),
					'user_ajax_chat_messages_down'	=> $this->request->variable('ajax_chat_messages_down', (bool) $this->user->data['user_ajax_chat_messages_down']),
				);

				$error  = array();
				$submit = $this->request->is_set_post('submit');

				add_form_key('ucp_ajax_chat');
				if ($submit)
				{
					if (!check_form_key('ucp_ajax_chat'))
					{
						$error[] = 'FORM_INVALID';
					}

					if (!$this->config['location_ajax_chat_override'])
					{
						$chat_position2		= $this->request->variable('ajax_chat_position', 0);
					}
					else
					{
						$chat_position2		= '0';
					}

					if (!$this->config['viewforum_ajax_chat_override'])
					{
						$chat_viewforum2		= $this->request->variable('ajax_chat_viewforum', 0);
					}
					else
					{
						$chat_viewforum2		= '0';
					}

					if (!$this->config['viewtopic_ajax_chat_override'])
					{
						$chat_viewtopic2		= $this->request->variable('ajax_chat_viewtopic', 0);
					}
					else
					{
						$chat_viewtopic2		= '0';
					}

					if (!sizeof($error))
					{
						$sql_ary = array(
							'user_ajax_chat_view'			=> $this->request->variable('ajax_chat_view', 0),
							'user_ajax_chat_avatars'		=> $this->request->variable('ajax_chat_avatars', 0),
							'user_ajax_chat_position'		=> $chat_position2,
							'user_ajax_chat_viewforum'		=> $chat_viewforum2,
							'user_ajax_chat_viewtopic'		=> $chat_viewtopic2,
							'user_ajax_chat_sound'			=> $this->request->variable('ajax_chat_sound', 0),
							'user_ajax_chat_sound'			=> $this->request->variable('ajax_chat_sound', 0),
							'user_ajax_chat_avatar_hover'	=> $this->request->variable('ajax_chat_avatar_hover', 0),
							'user_ajax_chat_onlinelist'		=> $this->request->variable('ajax_chat_onlinelist', 0),
							'user_ajax_chat_autocomplete'	=> $this->request->variable('ajax_chat_autocomplete', 0),
							'user_ajax_chat_messages_down'	=> $this->request->variable('ajax_chat_messages_down', 0),
						);

						if (sizeof($sql_ary))
						{
							$sql = 'UPDATE ' . $this->users_table . '
										SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
										WHERE user_id = ' . (int) $this->user->data['user_id'];
							$this->db->sql_query($sql);
						}

						meta_refresh(3, $this->u_action);
						$message = $this->user->lang['PROFILE_UPDATED'] . '<br /><br />' . sprintf($this->user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
						trigger_error($message);
					}

					// Replace "error" strings with their real, localised form
					$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);
				}

				$this->template->assign_vars(array(
					'ERROR'						=> (sizeof($error)) ? implode('<br />', $error) : '',
					'S_AJAX_CHAT_VIEW'			=> $data['user_ajax_chat_view'],
					'S_AJAX_CHAT_AVATARS'		=> $data['user_ajax_chat_avatars'],
					'S_AJAX_CHAT_POSITION'		=> $data['user_ajax_chat_position'],
					'S_AJAX_CHAT_VIEWFORUM'		=> $data['user_ajax_chat_viewforum'],
					'S_AJAX_CHAT_VIEWTOPIC'		=> $data['user_ajax_chat_viewtopic'],
					'S_AJAX_CHAT_SOUND'			=> $data['user_ajax_chat_sound'],
					'S_AJAX_CHAT_AVATAR_HOVER'	=> $data['user_ajax_chat_avatar_hover'],
					'S_AJAX_CHAT_ONLINELIST'	=> $data['user_ajax_chat_onlinelist'],
					'S_AJAX_CHAT_AUTOCOMPLETE'	=> $data['user_ajax_chat_autocomplete'],
					'S_AJAX_CHAT_MESSAGES_DOWN'	=> $data['user_ajax_chat_messages_down'],
				));
				break;
		}

		$this->template->assign_vars(array(
			'L_TITLE'	  => $this->user->lang['USER_AJAXCHAT_SETTINGS'],
			'S_UCP_ACTION' => $this->u_action
		));

		// Set desired template
		$this->tpl_name   = 'ucp_ajax_chat';
		$this->page_title = 'USER_AJAXCHAT_SETTINGS';
	}
}
