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

    /** @var \phpbb\user User Object */
    protected $user;

    /** @var \phpbb\auth\auth Auth Object */
    protected $auth;

    /** @var \phpbb\template\template Template Object */
    protected $template;

    /** @var \phpbb\request\request */
    protected $request;

    /** @var \phpbb\log\log Log Object */
    protected $log;

    /** @var string Installation root path */
    protected $root_path;

    /** @var string PHP file extension */
    protected $php_ext;

    public function __construct()
    {
        global $db, $user, $auth, $template, $phpbb_root_path, $phpEx;
        global $request, $phpbb_log;
        $this->db        = $db;
        $this->user      = $user;
        $this->auth      = $auth;
        $this->template  = $template;
        $this->request   = $request;
        $this->log       = $phpbb_log;
        $this->root_path = $phpbb_root_path;
        $this->php_ext   = $phpEx;
    }

    public function main($id, $mode)
    {

        switch ($mode)
        {
            case 'settings':
                $data = array(
                    'user_ajax_chat_view'         => $this->request->variable('user_ajax_chat_view', (bool) $this->user->data['user_ajax_chat_view']),
                    'user_ajax_chat_avatars'      => $this->request->variable('user_ajax_chat_avatars', (bool) $this->user->data['user_ajax_chat_avatars']),
                    'user_ajax_chat_position'     => $this->request->variable('user_ajax_chat_position', (bool) $this->user->data['user_ajax_chat_position']),
                    'user_ajax_chat_sound'        => $this->request->variable('user_ajax_chat_sound', (bool) $this->user->data['user_ajax_chat_sound']),
                    'user_ajax_chat_avatar_hover' => $this->request->variable('user_ajax_chat_avatar_hover', (bool) $this->user->data['user_ajax_chat_avatar_hover']),
                    'user_ajax_chat_onlinelist'   => $this->request->variable('user_ajax_chat_onlinelist', (bool) $this->user->data['user_ajax_chat_onlinelist']),
                );

                $error  = array();
                $submit = $this->request->variable('submit', false, false, \phpbb\request\request_interface::POST);

                add_form_key('ucp_ajax_chat');
                $post = $this->request->get_super_global(\phpbb\request\request_interface::POST);
                if ($submit)
                {
                    if (!check_form_key('ucp_ajax_chat'))
                    {
                        $error[] = 'FORM_INVALID';
                    }

                    if (!sizeof($error))
                    {
                        $sql_ary = array(
                            'user_ajax_chat_view'         => $post['ajax_chat_view'],
                            'user_ajax_chat_avatars'      => $post['ajax_chat_avatars'],
                            'user_ajax_chat_position'     => $post['ajax_chat_position'],
                            'user_ajax_chat_sound'        => $post['ajax_chat_sound'],
                            'user_ajax_chat_avatar_hover' => $post['ajax_chat_avatar_hover'],
                            'user_ajax_chat_onlinelist'   => $post['ajax_chat_onlinelist'],
                        );

                        if (sizeof($sql_ary))
                        {
                            $sql = 'UPDATE ' . USERS_TABLE . '
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
                    'ERROR'                    => (sizeof($error)) ? implode('<br />', $error) : '',
                    'S_AJAX_CHAT_VIEW'         => $data['user_ajax_chat_view'],
                    'S_AJAX_CHAT_AVATARS'      => $data['user_ajax_chat_avatars'],
                    'S_AJAX_CHAT_POSITION'     => $data['user_ajax_chat_position'],
                    'S_AJAX_CHAT_SOUND'        => $data['user_ajax_chat_sound'],
                    'S_AJAX_CHAT_AVATAR_HOVER' => $data['user_ajax_chat_avatar_hover'],
                    'S_AJAX_CHAT_ONLINELIST'   => $data['user_ajax_chat_onlinelist'],
                ));
                break;
        }

        $this->template->assign_vars(array(
            'L_TITLE'      => $this->user->lang['USER_AJAXCHAT_SETTINGS'],
            'S_UCP_ACTION' => $this->u_action
        ));

        // Set desired template
        $this->tpl_name   = 'ucp_ajax_chat';
        $this->page_title = 'USER_AJAXCHAT_SETTINGS';
    }
}
