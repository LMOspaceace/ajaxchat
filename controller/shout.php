<?php

/**
 *
 * Ajax Chat extension for phpBB.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace spaceace\ajaxchat\controller;

use phpbb\user;
use phpbb\template\template;
use phpbb\db\driver\driver_interface as db_driver;
use phpbb\auth\auth;
use phpbb\request\request;
use phpbb\controller\helper;
use phpbb\config\db;

//use spaceace\ajaxchat\controller\chat;

class shout
{

    /** @var \phpbb\template\template */
    protected $template;

    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /** @var \phpbb\auth\auth */
    protected $auth;

    /** @var \phpbb\request\request */
    protected $request;

    /** @var \phpbb\controller\helper */
    protected $helper;

    /** @var \phpbb\config\db */
    protected $config;

    /** @var core.root_path */
    protected $root_path;

    /** @var core.php_ext */
    protected $php_ext;

    /** @var int */
    protected $default_delay = 15;

    /** @var int */
    protected $session_time = 300;

    /** @var array */
    protected $times = [];

    /** @var int */
    protected $last_time;

    /** @var array */
    protected $delay = [];

    /** @var int * */
    protected $last_id;

    /** @var int */
    protected $count = 0;

    /** @var bool */
    protected $get = false;

    /** @var bool */
    protected $init = false;

    /** @var string */
    protected $mode;

    /** @var \spaceace\ajaxchat\controller\chat */
    protected $chat;

    /**
     * 
     * @param template $template
     * @param user $user
     * @param db_driver $db
     * @param auth $auth
     * @param request $request
     * @param helper $helper
     * @param db $config
     * @param type $root_path
     * @param type $php_ext
     */
    public function __construct(template $template, user $user, db_driver $db, auth $auth, request $request, helper $helper, db $config, $root_path, $php_ext)
    {
    	global $table_prefix;
        $this->template  = $template;
        $this->user      = $user;
        $this->db        = $db;
        $this->auth      = $auth;
        $this->request   = $request;
        $this->helper    = $helper;
        $this->config    = $config;
        $this->root_path = $root_path;
        $this->php_ext   = $php_ext;
        //$this->chat = new chat();
        $this->last_id   = $this->request->variable('last_id', 0);
        $this->last_post = $this->request->variable('last_post', 0);
        $this->last_time = $this->request->variable('last_time', 0);

        $this->times = [
            'online'  => 0,
            'idle'    => 300,
            'offline' => 1800,
        ];
        //set delay for each status
        $this->delay = [
            'online'  => 5,
            'idle'    => 60,
            'offline' => 300,
        ];
        if (!defined('CHAT_TABLE'))
        {
            define('CHAT_TABLE', $table_prefix.'ajax_chat');
        }
        if (!defined('CHAT_SESSIONS_TABLE'))
        {
            define('CHAT_SESSIONS_TABLE', $table_prefix.'ajax_chat_sessions');
        }
        include $this->root_path . 'includes/functions_posting.' . $this->php_ext;
    }

    public function index($mode)
    {
        $this->mode = $mode;
        $sql        = 'SELECT c.*, u.user_avatar, u.user_avatar_type
				FROM ' . CHAT_TABLE . ' as c
				LEFT JOIN ' . USERS_TABLE . ' as u
				ON c.user_id = u.user_id
				ORDER BY message_id DESC';
        $result     = $this->db->sql_query_limit($sql, 36);
        $rows       = $this->db->sql_fetchrowset($result);

        foreach ($rows as $row)
        {

            $row['avatar']       = ($this->user->optionget('viewavatars')) ? @get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']) : '';
            $row['avatar_thumb'] = ($this->user->optionget('viewavatars')) ? @get_user_avatar($row['user_avatar'], $row['user_avatar_type'], 35, 35) : '';
            if ($this->count++ == 0)
            {
                $this->last_id = $row['message_id'];
            }
            $this->template->assign_block_vars('chatrow', array(
                'MESSAGE_ID'        => $row['message_id'],
                'USERNAME_FULL'     => \get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
                'USERNAME_A'        => $row['username'],
                'USER_COLOR'        => $row['user_colour'],
                'MESSAGE'           => \generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
                'TIME'              => $this->user->format_date($row['time'], 'D g:i a'),
                'CLASS'             => ($row['message_id'] % 2) ? 1 : 2,
                'USER_AVATAR'       => $row['avatar'],
                'USER_AVATAR_THUMB' => $row['avatar_thumb'],
            ));
        }
        $this->db->sql_freeresult($result);

        if ($this->user->data['user_type'] == USER_FOUNDER || $this->user->data['user_type'] == USER_NORMAL)
        {
            $sql    = 'SELECT * FROM ' . CHAT_SESSIONS_TABLE . " WHERE user_id = {$this->user->data['user_id']}";
            $result = $this->db->sql_query($sql);
            $row    = $this->db->sql_fetchrow($result);
            $this->db->sql_freeresult($result);

            if ($row['user_id'] != $this->user->data['user_id'])
            {
                $sql_ary = array(
                    'user_id'         => $this->user->data['user_id'],
                    'username'        => $this->user->data['username'],
                    'user_colour'     => $this->user->data['user_colour'],
                    'user_login'      => time(),
                    'user_lastupdate' => time(),
                );
                $sql     = 'INSERT INTO ' . CHAT_SESSIONS_TABLE . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
                $this->db->sql_query($sql);
            } else
            {
                $sql_ary = array(
                    'username'        => $this->user->data['username'],
                    'user_colour'     => $this->user->data['user_colour'],
                    'user_lastupdate' => time(),
                    'user_login'      => time(),
                );
                $sql     = 'UPDATE ' . CHAT_SESSIONS_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . " WHERE user_id = {$this->user->data['user_id']}";
                $this->db->sql_query($sql);
            }
        }
        $this->whois_online();

        $bbcode_status  = ($this->config['allow_bbcode'] && $this->config['auth_bbcode_pm'] && $this->auth->acl_get('u_pm_bbcode')) ? true : false;
        $smilies_status = ($this->config['allow_smilies'] && $this->config['auth_smilies_pm'] && $this->auth->acl_get('u_pm_smilies')) ? true : false;
        $img_status     = ($this->config['auth_img_pm'] && $this->auth->acl_get('u_pm_img')) ? true : false;
        $flash_status   = ($this->config['auth_flash_pm'] && $this->auth->acl_get('u_pm_flash')) ? true : false;
        $url_status     = ($this->config['allow_post_links']) ? true : false;

        // Generate smiley listing
        \generate_smilies('inline', 0);

        $this->mode = strtoupper($this->mode);
        //Assign the features template variable
        $this->template->assign_vars(array(
            'BBCODE_STATUS'     => ($bbcode_status) ? sprintf($this->user->lang['BBCODE_IS_ON'], '<a href="' . append_sid("{$this->root_path}faq.$this->php_ext", 'mode=bbcode') . '">', '</a>') : sprintf($this->user->lang['BBCODE_IS_OFF'], '<a href="' . append_sid("{$this->root_path}faq.$this->php_ext", 'mode=bbcode') . '">', '</a>'),
            'IMG_STATUS'        => ($img_status) ? $this->user->lang['IMAGES_ARE_ON'] : $this->user->lang['IMAGES_ARE_OFF'],
            'FLASH_STATUS'      => ($flash_status) ? $this->user->lang['FLASH_IS_ON'] : $this->user->lang['FLASH_IS_OFF'],
            'SMILIES_STATUS'    => ($smilies_status) ? $this->user->lang['SMILIES_ARE_ON'] : $this->user->lang['SMILIES_ARE_OFF'],
            'URL_STATUS'        => ($url_status) ? $this->user->lang['URL_IS_ON'] : $this->user->lang['URL_IS_OFF'],
            'S_COMPOSE_PM'      => true,
            'S_BBCODE_ALLOWED'  => $bbcode_status,
            'S_SMILIES_ALLOWED' => $smilies_status,
            'S_BBCODE_IMG'      => $img_status,
            'S_BBCODE_FLASH'    => $flash_status,
            'S_BBCODE_QUOTE'    => false,
            'S_BBCODE_URL'      => $url_status,
            'TIME'              => time(),
            'FILENAME'          => append_sid("{$this->root_path}/ext/spaceace/ajaxchat/controller/shout.$this->php_ext"),
            'LAST_ID'           => $this->last_id,
            'S_' . $this->mode  => true,
        ));
        return;
    }

    public function whois_online()
    {
        $check_time = time() - $this->session_time;

        $sql_ary = array(
            'username'        => $this->user->data['username'],
            'user_colour'     => $this->user->data['user_colour'],
            'user_lastupdate' => time(),
        );
        $sql     = 'UPDATE ' . CHAT_SESSIONS_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . " WHERE user_id = {$this->user->data['user_id']}";
        $this->db->sql_query($sql);

        $sql = 'DELETE FROM ' . CHAT_SESSIONS_TABLE . " WHERE user_lastupdate < $check_time";
        $this->db->sql_query($sql);


        $sql    = 'SELECT *
		FROM ' . CHAT_SESSIONS_TABLE . "
		WHERE user_lastupdate > $check_time
		ORDER BY username ASC";
        $result = $this->db->sql_query($sql);

        $status_time = time();
        $this->template->assign_block_vars('soundrow', array(
            'SOUND' => '<object data="ext/spaceace/ajaxchat/styles/all/theme/sound.swf" type="application/x-shockwave-flash" width="0" height="0"><param name="movie" value="sound.swf" /></object>',
        ));

        while ($row = $this->db->sql_fetchrow($result))
        {
            if ($row['user_id'] == $this->user->data['user_id'])
            {
                $this->last_post = $row['user_lastpost'];
                $login_time      = $row['user_login'];
                $status_time     = ($this->last_post > $login_time) ? $this->last_post : $login_time;
            }
            $status     = $this->get_status($row['user_lastpost']);
            $this->template->assign_block_vars('whoisrow', array(
                'USERNAME_FULL' => get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST']),
                'USERNAME_A'    => $row['username'],
                'USER_COLOR'    => $row['user_colour'],
                'USER_STATUS'   => $status,
            ));
            $user_ary[] = $row['user_id'];
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars(array(
            'DELAY'         => ($status_time) ? $this->delay[$this->get_status($status_time)] : $this->delay['idle'],
            'LAST_TIME'     => time(),
            'S_WHOISONLINE' => true,
        ));
        return false;
    }

    function get_status($last)
    {
        $status = 'online';
        if ($last < (time() - $this->times['offline']))
        {
            $status = 'offline';
        } else if ($last < (time() - $this->times['idle']))
        {
            $status = 'idle';
        }
        return $status;
    }

}
