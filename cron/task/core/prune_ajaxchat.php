<?php

/**
 *
 * @package Inactive Users
 * @copyright (c) 2014 ForumHulp.com
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace spaceace\ajaxchat\cron\task\core;

/**
 * @ignore
 */
class prune_ajaxchat extends \phpbb\cron\task\base
{

	protected $user;
	protected $config;
	protected $config_text;
	protected $db;
	protected $log;
	protected $phpbb_root_path;
	protected $php_ext;

	/**
	 * Constructor.
	 *
	 * @param string $phpbb_root_path The root path
	 * @param string $php_ext The PHP extension
	 * @param phpbb_config $config The config
	 * @param phpbb_db_driver $db The db connection
	 */
	public function __construct(\phpbb\user $user, \phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\db\driver\driver_interface $db, \phpbb\log\log $log, $phpbb_root_path, $php_ext)
	{
		$this->user				 = $user;
		$this->config			 = $config;
		$this->config_text		 = $config_text;
		$this->db				 = $db;
		$this->log				 = $log;
		$this->phpbb_root_path	 = $phpbb_root_path;
		$this->php_ext			 = $php_ext;
	}

	/**
	 * Runs this cron task.
	 *
	 * @return null
	 */
	public function run()
	{
		$sql	 = 'SELECT message_id '
				. 'FROM ' . CHAT_TABLE . ' '
				. 'ORDER BY message_id DESC '
				. 'LIMIT 1';
		$result	 = $this->db->sql_query($sql);
		$row	 = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		$last_kept_id	 = ($row['message_id'] - $this->config['prune_keep_ajax_chat']);
		$sql1			 = 'DELETE FROM ' . CHAT_TABLE . ''
				. ' WHERE `message_id` <= ' . $last_kept_id . '';
		$this->db->sql_query($sql1);
		
		$this->log->add('admin', $this->user->data['user_id'], $this->user->data['session_ip'], $this->user->lang['PRUNE_LOG_AJAXCHAT_AUTO'], true,array());
	}

	/**
	 * Returns whether this cron task can run, given current board configuration.
	 *
	 * @return bool
	 */
	public function is_runnable()
	{
		return (bool) $this->config['prune_ajax_chat'];
	}

	/**
	 * Returns whether this cron task should run now, because enough time
	 * has passed since it was last run.
	 *
	 * @return bool
	 */
	public function should_run()
	{
		return $this->config['prune_ajax_chat_last_gc'] < time() - $this->config['prune_ajax_chat_gc'];
	}

}