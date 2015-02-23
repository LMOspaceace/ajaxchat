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
use spaceace\ajaxchat\controller\popup;

/**
 * Main Controller
 * 
 * @version 1.0.0-DEV
 * @package spaceace\ajaxchat
 * @author Kevin Roy <royk@myraytech.com>
 * @author Spaceace <spaceace@livemembersonly.com>
 */
class chat
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
    
    /** @var string */
    protected $table_prefix;

    /** @var int */
    protected $default_delay = 15;

    /** @var int */
    protected $session_time = 300;

    /** @var array */
    protected $times = [];

    /** @var int */
    protected $last_time = 0;

    /** @var array */
    protected $delay = [];

    /** @var int */
    protected $last_id = 0;

    /** @var int */
    protected $last_post = 0;

    /** @var int */
    protected $read_interval = 5;

    /** @var int */
    protected $count = 0;

    /** @var bool */
    protected $get = false;

    /** @var bool */
    protected $init = false;

    /** @var string */
    protected $mode;

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
        $this->table_prefix = $table_prefix;
        $this->user->add_lang('posting');
        $this->user->add_lang_ext('spaceace/ajaxchat', 'ajax_chat');
        $this->times     = [
            'online'  => 0,
            'idle'    => 300,
            'offline' => 1800,
        ];
        //set delay for each status
        $this->delay     = [
            'online'  => 5,
            'idle'    => 60,
            'offline' => 300,
        ];
        if (!defined('CHAT_TABLE'))
        {
            define('CHAT_TABLE', $this->table_prefix.'ajax_chat');
        }
        if (!defined('CHAT_SESSIONS_TABLE'))
        {
            define('CHAT_SESSIONS_TABLE', $this->table_prefix.'ajax_chat_sessions');
        }
        include $this->root_path . 'includes/functions_posting.' . $this->php_ext;

        $this->post = $this->request->get_super_global(\phpbb\request\request_interface::POST);
    }

    public function index($mode)
    {
        $this->mode          = $mode;
        $this->last_id       = $this->request->variable('last_id', 0);
        $this->last_time     = $this->request->variable('last_time', 0);
        $this->post_time     = $this->request->variable('last_post', 0);
        $this->read_interval = $this->request->variable('read_interval', 5000);

        if ($this->mode === 'default')
        {
            $this->defaultAction();
        }
        elseif ($this->mode === 'read')
        {
            $this->readAction();
        }
        elseif ($this->mode === 'add')
        {
            $this->addAction();
        }
        elseif ($this->mode === 'smilies')
        {
            $this->smiliesAction();
        }
        elseif ($this->mode === 'delete')
        {
            $this->delAction();
        }
        elseif ($this->mode === 'popup')
        {
            $popup = new popup($this->template, $this->user, $this->db, $this->auth, $this->request, $this->helper, $this->config, $this->root_path, $this->php_ext);
            return $popup->index('read');
        }
        $bbcode_status  = ($this->config['allow_bbcode'] && $this->config['auth_bbcode_pm'] && $this->auth->acl_get('u_ajaxchat_bbcode')) ? true : false;
        $smilies_status = ($this->config['allow_smilies'] && $this->config['auth_smilies_pm'] && $this->auth->acl_get('u_pm_smilies')) ? true : false;
        $img_status     = ($this->config['auth_img_pm'] && $this->auth->acl_get('u_pm_img')) ? true : false;
        $flash_status   = ($this->config['auth_flash_pm'] && $this->auth->acl_get('u_pm_flash')) ? true : false;
        $url_status     = ($this->config['allow_post_links']) ? true : false;
        $this->mode     = strtoupper($this->mode);
        //Assign the features template variable
        $this->template->assign_vars([
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
            'LAST_ID'           => $this->last_id,
            'S_CHAT'            => (!$this->get) ? true : false,
            'S_GET_CHAT'        => ($this->get) ? true : false,
            'S_' . $this->mode  => true,
        ]);

        // Generate smiley listing
        \generate_smilies('inline', 0);

        // Build custom bbcodes array
        //\display_custom_bbcodes();
        $this->template->set_filenames([
            'body' => 'chat_body.html',
        ]);
        $this->whois_online();
        return $this->helper->render('chat_body.html');
    }

    private function defaultAction()
    {
        $sql    = 'SELECT c.*, u.user_avatar, u.user_avatar_type
            FROM ' . CHAT_TABLE . ' as c
            LEFT JOIN ' . USERS_TABLE . ' as u
            ON c.user_id = u.user_id
            ORDER BY message_id DESC';
        $result = $this->db->sql_query_limit($sql, 60);
        $rows   = $this->db->sql_fetchrowset($result);

        foreach ($rows as $row)
        {
            if ($row['forum_id'] && !$this->auth->acl_get('f_read', $row['forum_id']))
            {
                continue;
            }
            $row['avatar']       = ($this->user->optionget('viewavatars')) ? @get_user_avatar($this->root_path.$row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']) : '';
            $row['avatar_thumb'] = ($this->user->optionget('viewavatars')) ? @get_user_avatar($this->root_path.$row['user_avatar'], $row['user_avatar_type'], 35, 35) : '';
            if ($this->count++ == 0)
            {
                $this->last_id = $row['message_id'];
            }
            $this->template->assign_block_vars('chatrow', array(
                'MESSAGE_ID'        => $row['message_id'],
                'USERNAME_FULL'     => $this->clean_username(get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST'])),
                'USERNAME_A'        => $row['username'],
                'USER_COLOR'        => $row['user_colour'],
                'MESSAGE'           => generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
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
                    'user_login'      => time(),
                    'user_lastupdate' => time(),
                );
                $sql     = 'UPDATE ' . CHAT_SESSIONS_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . " WHERE user_id = {$this->user->data['user_id']}";
                $this->db->sql_query($sql);
            }
        }
        $this->whois_online();

        return;
    }

    private function whois_online()
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
        while ($row         = $this->db->sql_fetchrow($result))
        {
            if ($row['user_id'] == $this->user->data['user_id'])
            {
                $this->last_post = $row['user_lastpost'];
                $login_time      = $row['user_login'];
                $status_time     = ($this->last_post > $login_time) ? $this->last_post : $login_time;
            }
            $status = $this->get_status($row['user_lastpost']);
            $this->template->assign_block_vars('whoisrow', array(
                'USERNAME_FULL' => $this->clean_username(get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST'])),
                'USER_COLOR'    => $row['user_colour'],
                'USER_STATUS'   => $status,
            ));
        }
        $this->db->sql_freeresult($result);

        $this->template->assign_vars(array(
            'LAST_TIME'     => time(),
            'S_WHOISONLINE' => true,
        ));
        return false;
    }

    private function get_status($last)
    {
        $status = 'online';
        if ($last < (time() - $this->times['offline']))
        {
            $status = 'offline';
        }
        else
        if ($last < (time() - $this->times['idle']))
        {
            $status = 'idle';
        }
        return $status;
    }

    private function clean_message(&$message)
    {
        if (strpos($message, '---') !== false)
        {
            $message = str_replace('---', '–––', $message);
            clean_message($message);
        }
    }

    private function clean_username($user)
    {
        if (strpos($user, '---') !== false)
        {
            $user = str_replace('---', '–––', $user);
            clean_username($user);
        }
        return $user;
    }

    private function readAction()
    {
        $sql    = 'SELECT c.*, u.user_avatar, u.user_avatar_type
				FROM ' . CHAT_TABLE . ' as c
				LEFT JOIN ' . USERS_TABLE . ' as u
				ON c.user_id = u.user_id
				WHERE c.message_id > ' . $this->last_id . '
				ORDER BY message_id DESC';
        $result = $this->db->sql_query_limit($sql, 60);
        $rows   = $this->db->sql_fetchrowset($result);

        if (!sizeof($rows) && ((time() - 60) < $this->last_time))
        {
            exit;
        }
        foreach ($rows as $row)
        {

            $row['avatar']       = ($this->user->optionget('viewavatars')) ? @get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']) : '';
            $row['avatar_thumb'] = ($this->user->optionget('viewavatars')) ? @get_user_avatar($row['user_avatar'], $row['user_avatar_type'], 35, 35) : '';
            if ($this->count++ === 0)
            {
                if ($row['message_id'] !== null)
                {
                    $this->last_id = $row['message_id'];
                }
                else
                {
                    $this->last_id = 0;
                }
                $this->template->assign_block_vars('soundrow', array(
                    'SOUND' => '<div style="visibility: hidden; position: absolute;"><object data="ext/spaceace/ajaxchat/styles/all/theme/sounds/sound.swf" type="application/x-shockwave-flash"><param name="movie" value="ext/spaceace/ajaxchat/styles/all/theme/sounds/sound.swf" /></object></div>',
                ));
            }
            $this->template->assign_block_vars('chatrow', array(
                'MESSAGE_ID'        => $row['message_id'],
                'USERNAME_FULL'     => $this->clean_username(get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST'])),
                'USERNAME_A'        => $row['username'],
                'USER_COLOR'        => $row['user_colour'],
                'MESSAGE'           => generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
                'TIME'              => $this->user->format_date($row['time'], 'D g:i a'),
                'CLASS'             => ($row['message_id'] % 2) ? 1 : 2,
                'USER_AVATAR'       => $row['avatar'],
                'USER_AVATAR_THUMB' => $row['avatar_thumb'],
            ));
        }
        $this->db->sql_freeresult($result);
        if ((time() - 60) > $this->last_time)
        {
            $this->whois_online();
            $sql_ary = array(
                'username'        => $this->user->data['username'],
                'user_colour'     => $this->user->data['user_colour'],
                'user_lastupdate' => time(),
            );
            $sql     = 'UPDATE ' . CHAT_SESSIONS_TABLE . '
            SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . "
            WHERE user_id = {$this->user->data['user_id']}";
            $result  = $this->db->sql_query($sql);
        }
        $this->get      = true;
        $bbcode_status  = ($this->config['allow_bbcode'] && $this->config['auth_bbcode_pm'] && $this->auth->acl_get('u_ajaxchat_bbcode')) ? true : false;
        $smilies_status = ($this->config['allow_smilies'] && $this->config['auth_smilies_pm'] && $this->auth->acl_get('u_pm_smilies')) ? true : false;
        $img_status     = ($this->config['auth_img_pm'] && $this->auth->acl_get('u_pm_img')) ? true : false;
        $flash_status   = ($this->config['auth_flash_pm'] && $this->auth->acl_get('u_pm_flash')) ? true : false;
        $url_status     = ($this->config['allow_post_links']) ? true : false;
        $this->mode     = strtoupper($this->mode);
        //Assign the features template variable
        $this->template->assign_vars([
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
            'LAST_ID'           => $this->last_id,
            'LAST_POST'         => $this->last_post,
            'REFRESH_TIMER'     => $this->read_interval,
            'S_CHAT'            => (!$this->get) ? true : false,
            'S_GET_CHAT'        => ($this->get) ? true : false,
            'S_' . $this->mode  => true,
        ]);
        // Generate smiley listing
        \generate_smilies('inline', 0);

        // Build custom bbcodes array
        //\display_custom_bbcodes();
        return;
    }

    private function addAction()
    {
        if (!$this->user->data['is_registered'] || $this->user->data['user_type'] == USER_INACTIVE || $this->user->data['user_type'] == USER_IGNORE)
        {
            redirect(append_sid("{$this->root_path}ucp.$this->php_ext", 'mode=login'));
        }
        $this->get = true;

        $message = utf8_normalize_nfc($this->request->variable('message', '', true));

        if (!$message)
        {
            return;
        }
        $this->clean_message($message);
        $uid           = $bitfield      = $options       = '';
        $allow_bbcode  = $this->auth->acl_get('u_ajaxchat_bbcode');
        $allow_urls    = $allow_smilies = true;
        generate_text_for_storage($message, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

        $sql_ary = array(
            'chat_id'         => 1,
            'user_id'         => $this->user->data['user_id'],
            'username'        => $this->user->data['username'],
            'user_colour'     => $this->user->data['user_colour'],
            'message'         => $message,
            'bbcode_bitfield' => $bitfield,
            'bbcode_uid'      => $uid,
            'bbcode_options'  => $options,
            'time'            => time(),
        );
        $sql     = 'INSERT INTO ' . CHAT_TABLE . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
        $this->db->sql_query($sql);

        $sql_ary2 = array(
            'username'        => $this->user->data['username'],
            'user_colour'     => $this->user->data['user_colour'],
            'user_lastpost'   => time(),
            'user_lastupdate' => time(),
        );
        $sql      = 'UPDATE ' . CHAT_SESSIONS_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary2) . " WHERE user_id = {$this->user->data['user_id']}";
        $result   = $this->db->sql_query($sql);


        $sql    = 'SELECT c.*, u.user_avatar, u.user_avatar_type
				FROM ' . CHAT_TABLE . ' as c
				LEFT JOIN ' . USERS_TABLE . ' as u
				ON c.user_id = u.user_id
				WHERE c.message_id > ' . $this->last_id . '
				ORDER BY message_id DESC';
        $result = $this->db->sql_query_limit($sql, 60);
        $rows   = $this->db->sql_fetchrowset($result);

        if (!sizeof($rows) && ((time() - 60) < $this->last_time))
        {
            exit;
        }
        foreach ($rows as $row)
        {

            $row['avatar']       = ($this->user->optionget('viewavatars')) ? @get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $row['user_avatar_width'], $row['user_avatar_height']) : '';
            $row['avatar_thumb'] = ($this->user->optionget('viewavatars')) ? @get_user_avatar($row['user_avatar'], $row['user_avatar_type'], 35, 35) : '';
            if ($this->count++ == 0)
            {
                $this->last_id = $row['message_id'];
                $this->template->assign_block_vars('soundrow', array(
                    'SOUND' => '<div style="visibility: hidden; position: absolute;"><object data="soundout.swf" type="application/x-shockwave-flash"><param name="movie" value="soundout.swf" /></object></div>',
                ));
            }
            $this->template->assign_block_vars('chatrow', array(
                'MESSAGE_ID'        => $row['message_id'],
                'USERNAME_FULL'     => $this->clean_username(get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang['GUEST'])),
                'USERNAME_A'        => $row['username'],
                'USER_COLOR'        => $row['user_colour'],
                'MESSAGE'           => generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options']),
                'TIME'              => $this->user->format_date($row['time'], 'D g:i a'),
                'CLASS'             => ($row['message_id'] % 2) ? 1 : 2,
                'USER_AVATAR'       => $row['avatar'],
                'USER_AVATAR_THUMB' => $row['avatar_thumb'],
            ));
        }
        $this->db->sql_freeresult($result);

        /* if ($this->read_interval != $this->delay['online']) {
          $this->whois_online();
          } */
        return $this->readAction();
    }

    private function smiliesAction()
    {
        if (!$this->auth->acl_get('u_as_smilies'))
        {
            as_error($this->user->lang['NO_SMILIE_PERM']);
        }

        $sql    = 'SELECT *
				FROM ' . SMILIES_TABLE .
                ' WHERE display_on_posting = 1
				ORDER BY smiley_order';
        $result = $this->db->sql_query($sql);
        if ($result)
        {
            $num_smilies = 0;
            $rowset      = array();
            $last_url    = '';

            while ($row = $db->sql_fetchrow($result))
            {
                if ($row['smiley_url'] !== $last_url)
                {
                    echo "<smilies>\n
										<code>" . xml($row['code']) . "</code>\n
										<img>" . xml($this->root_path . $this->config['smilies_path'] . '/' . $row['smiley_url']) . "</img>\n
										<alt>" . xml($row['emotion']) . "</alt>\n
										</smilies>";
                }
                $last_url = $row['smiley_url'];
            }
            echo '</xml>';
			exit;
		}
		else
		{
			as_sql_error($sql, __LINE__, __FILE__);
		}
	}

	private function delAction()
	{
		$this->get = true;
		$chat_id   = $this->request->variable('chat_id', 0);

		if (!$chat_id)
		{
			return;
		}

		if (!$this->auth->acl_get('a_') && !$this->auth->acl_get('m_ajaxchat_delete'))
		{
			return;
		}
		$sql = 'DELETE FROM ' . CHAT_TABLE . " WHERE message_id = $chat_id";
		$this->db->sql_query($sql);
		return;
	}
}
