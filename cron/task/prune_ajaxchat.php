<?php

/**
 *
 * Ajax Chat extension for phpBB.
 *
 * @copyright (c) 2015 spaceace <http://www.livemembersonly.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace spaceace\ajaxchat\cron\task;

/**
 * @ignore
 */
class prune_ajaxchat extends \phpbb\cron\task\base
{
	protected $config;
	protected $user;
	protected $db;
	protected $phpbb_log;
	protected $table_prefix;

	/**
	 * Constructor.
	 *
	 * @param string $phpbb_root_path The root path
	 * @param string $php_ext The PHP extension
	 * @param phpbb_config $config The config
	 * @param phpbb_db_driver $db The db connection
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, \phpbb\log\log $phpbb_log, $table_prefix)
	{
		$this->config = $config;
		$this->db = $db;
		$this->user = $user;
		$this->phpbb_log = $phpbb_log;
		$this->table_prefix	 = $table_prefix;
	}

	/**
	 * Runs this cron task.
	 *
	 * @return null
	 */
	public function run()
	{
		if (!defined('CHAT_TABLE'))
		{
			$chat_table = $this->table_prefix . 'ajax_chat';
			define('CHAT_TABLE', $chat_table);
		}
		$sql  = 'SELECT message_id
			FROM ' . CHAT_TABLE . '
			ORDER BY message_id DESC ';
		$result  = $this->db->sql_query_limit($sql, 1, $this->config['prune_keep_ajax_chat']);
		$row  = $this->db->sql_fetchfield('message_id');
		$this->db->sql_freeresult($result);
		$sql1 = 'DELETE FROM ' . CHAT_TABLE . '
			WHERE message_id <= ' . (int) $row;
		$this->db->sql_query($sql1);
		// Add the log to the ACP.
		$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'PRUNE_LOG_AJAXCHAT_AUTO', time());
		// Do not forget to update the configuration variable for last run time.
		$this->config->set('prune_ajax_chat_last_gc', time());
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
