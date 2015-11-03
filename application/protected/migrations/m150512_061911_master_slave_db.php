<?php

class m150512_061911_master_slave_db extends CDbMigration
{
    protected $filename = 'synchronization_settings.php';
	public function up()
	{
        $sql =      "
        SET FOREIGN_KEY_CHECKS=0;

        -- ----------------------------
        -- Table structure for tbl_forwarded_slave
        -- ----------------------------
        DROP TABLE IF EXISTS `tbl_forwarded_slave`;
        CREATE TABLE `tbl_forwarded_slave` (
          `forwarded_slave_id` bigint(20) NOT NULL AUTO_INCREMENT,
          `forwarded_slave_message_id` int(11) NOT NULL,
          `forwarded_slave_status` enum('sent','new') NOT NULL DEFAULT 'new',
          `forwarded_slave_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `forwarded_slave_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          PRIMARY KEY (`forwarded_slave_id`),
          KEY `fk_forwarded_slave_message__log_id` (`forwarded_slave_message_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


        SET FOREIGN_KEY_CHECKS=0;

            -- ----------------------------
            -- Table structure for listener_log_temp
            -- ----------------------------
            DROP TABLE IF EXISTS `listener_log_temp`;
            CREATE TABLE `listener_log_temp` (
              `temp_log_id` int(11) NOT NULL AUTO_INCREMENT,
              `listener_id` int(11) NOT NULL,
              `station_id_code` varchar(255) DEFAULT '0',
              `message` text NOT NULL,
              `measuring_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
              `is_processed` int(1) DEFAULT '0',
              `is_processing` int(1) DEFAULT '0',
              `source` varchar(15) NOT NULL DEFAULT '',
              `source_info` varchar(30) DEFAULT '',
              `from_master` int(1) DEFAULT '0',
              `synchronization_mode` enum('slave','none','master') DEFAULT 'none',
              `rewrite_prev_values` tinyint(1) DEFAULT '0',
              `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
              `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
              PRIMARY KEY (`temp_log_id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;

        ";

        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $command->execute();

        $content = "<?php
 return array (
  'SERVER_IP' =>
  array (
    'label' => 'Control Server IP',
    'value' => '95.170.145.180',
  ),
  'SERVER_PORT' =>
  array (
    'label' => 'Control listening port',
    'value' => '5901',
  ),
  'REMOTE_SERVER_IP' =>
  array (
    'label' => 'Control remote IP',
    'value' => '192.168.101.202',
  ),
  'REMOTE_SERVER_PORT' =>
  array (
    'label' => 'Control remote port',
    'value' => '5902',
  ),
  'SWITCH_VARIANT' =>
  array (
    'label' => 'Mode (Fixed, Flexible)',
    'value' => '1',
  ),
  'FLEXIBILITY_ROLE' =>
  array (
    'label' => 'Flexibility role',
    'value' => '1',
  ),
  'MAIN_ROLE' =>
  array (
    'label' => 'Main role',
    'value' => '1',
  ),
  'FOR_COMES_FORWARDING_MESSAGES_IP' =>
  array (
    'label' => 'Receiving messages IP',
    'value' => '95.170.145.180',
  ),
  'FOR_COMES_FORWARDING_MESSAGES_PORT' =>
  array (
    'label' => 'Receiving messages  PORT',
    'value' => '5910',
  ),
  'FOR_SEND_MESSAGES_TO_IP' =>
  array (
    'label' => 'Send messages IP',
    'value' => '192.168.101.202',
  ),
  'FOR_SEND_MESSAGES_PORT' =>
  array (
    'label' => 'Send messages  PORT',
    'value' => '5910',
  ),
  'PROCESS_STATUS' =>
  array (
    'label' => NULL,
    'value' => 'stopped',
  ),
  'LISTENER_ID_FROM_MASTER' => false,
  'MASTER_TCP_SERVER_COMMAND_PID' => false,
  'SYNS_STATUS_COMMAND_PID' => false,
  'IDENTIFICATOR' =>
  array (
    'label' => 'Identificator',
    'value' => 'DEMO1',
  ),
)
 ?>";
        file_put_contents(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.$this->filename,$content);
	}

	public function down()
	{
        $sql = " SET FOREIGN_KEY_CHECKS=0;
            DROP TABLE IF EXISTS `tbl_forwarded_slave`;
            DROP TABLE IF EXISTS `listener_log_temp`;
         ";
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $command->execute();

        if(is_file(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.$this->filename))
            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.$this->filename);
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}