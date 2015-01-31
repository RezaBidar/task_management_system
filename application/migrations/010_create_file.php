<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_File extends CI_Migration {

    public function up()
    {
        $prefix = "fil" ;
        $table_name = $this->db->dbprefix("file");
  
        $this->db->query("
            CREATE TABLE {$table_name} (
            {$prefix}_id INT(14) UNSIGNED NOT NULL AUTO_INCREMENT ,
            {$prefix}_content BLOB NOT NULL ,
            {$prefix}_size INT(10) NOT NULL ,
            {$prefix}_mime VARCHAR(10) NOT NULL ,
            {$prefix}_task_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            CONSTRAINT file_pk PRIMARY KEY ({$prefix}_id),
            CONSTRAINT file_fk_task FOREIGN KEY ({$prefix}_task_id) REFERENCES {$this->db->dbprefix("task")} (tsk_id) ON DELETE CASCADE ON UPDATE CASCADE 
            
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('file');
    }
}
	