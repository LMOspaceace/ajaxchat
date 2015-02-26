<?php

/**
*
* Ajax Chat extension for phpBB.
*
* @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace spaceace\ajaxchat\event;

use phpbb\path_helper;
use phpbb\template\template;
use phpbb\user;
use phpbb\db\driver\driver_interface as db_driver;
use phpbb\auth\auth;
use phpbb\request\request;
use phpbb\controller\helper;
use phpbb\config\db;
use spaceace\ajaxchat\controller\shout;
/**
 * Event listener
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{

    protected $template;
    protected $user;
    protected $config;
    protected $path_helper;
    protected $phpbb_root_path;
    protected $php_ext;

    public function __construct(path_helper $path_helper, template $template, user $user, db_driver $db, auth $auth, request $request, helper $helper, db $config, $phpbb_root_path, $php_ext)
    {
        $this->path_helper     = $path_helper;
        $this->template        = $template;
        $this->user            = $user;
        $this->db              = $db;
        $this->auth            = $auth;
        $this->request         = $request;
        $this->helper          = $helper;
        $this->config          = $config;
        $this->phpbb_root_path = $phpbb_root_path;
        $this->php_ext         = $php_ext;
    }

    static public function getSubscribedEvents()
    {
        return array(
            'core.page_header'             => 'page_header',
            'core.permissions'             => 'add_permission',
            'core.index_modify_page_title' => 'index',
        );
    }

    public function page_header()
    {

        if ($this->config['display_ajax_chat'] === '1')
        {
            $this->template->assign_var('S_CHAT_ENABLED', true);
        }
		if ($this->config['whois_chatting'] === '1')
        {
            $this->template->assign_var('S_WHOIS_CHATTING', true);
        }
        $this->template->assign_vars(
                array(
                    'U_CHAT'                   => append_sid("/"),
                    'S_SHOUT'                  => true,
                    'CHAT_RULES'               => $this->config['rule_ajax_chat'],
                    'REFRESH_TIME'             => $this->config['refresh_ajax_chat'],
                    'S_AJAX_CHAT_VIEW'         => $this->user->data['user_ajax_chat_view'],
                    'S_AJAX_CHAT_AVATARS'      => $this->user->data['user_ajax_chat_avatars'],
                    'S_AJAX_CHAT_POSITION'     => $this->user->data['user_ajax_chat_position'],
                    'S_AJAX_CHAT_SOUND'        => $this->user->data['user_ajax_chat_sound'],
                    'S_AJAX_CHAT_AVATAR_HOVER' => $this->user->data['user_ajax_chat_avatar_hover'],
                    'S_AJAX_CHAT_ONLINELIST'   => $this->user->data['user_ajax_chat_onlinelist'],
                    'S_AJAXCHAT_VIEW'          => $this->auth->acl_get('u_ajaxchat_view'),
                    'S_AJAXCHAT_POST'          => $this->auth->acl_get('u_ajaxchat_post'),
                    'S_AJAXCHAT_BBCODE'        => $this->auth->acl_get('u_ajaxchat_bbcode'),
                    'M_AJAXCHAT_DELETE'        => $this->auth->acl_get('m_ajaxchat_delete'),
                )
        );
    }

    /**
     * Add administrative permissions
     *
     * @param object $event The event object
     * @return null
     * @access public
     */
    public function add_permission($event)
    {
        $permissions = $event['permissions'];

        $permissions['u_ajaxchat_view']   = array('lang' => 'ACL_U_AJAXCHAT_VIEW', 'cat' => 'misc');
        $permissions['u_ajaxchat_post']   = array('lang' => 'ACL_U_AJAXCHAT_POST', 'cat' => 'misc');
        $permissions['u_ajaxchat_bbcode'] = array('lang' => 'ACL_U_AJAXCHAT_BBCODE', 'cat' => 'misc');
        $permissions['m_ajaxchat_delete'] = array('lang' => 'ACL_M_AJAXCHAT_DELETE', 'cat' => 'misc');

        $event['permissions'] = $permissions;
    }

    public function index()
    {
        //\var_dump($event);
        $this->user->add_lang_ext('spaceace/ajaxchat', 'ajax_chat');
        $this->user->add_lang('posting');
        $shout = new shout($this->template, $this->user, $this->db, $this->auth, $this->request, $this->helper, $this->config, $this->phpbb_root_path, $this->php_ext);
        return $shout->index('read');
    }
}
