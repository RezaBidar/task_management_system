<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Duty extends CI_Migration {

    public function up()
    {
        $prefix = "dty" ;
        $table_name = $this->db->dbprefix("duty");
  
        $this->db->query("
            CREATE TABLE {$table_name} (
            {$prefix}_id INT(14) UNSIGNED NOT NULL AUTO_INCREMENT ,
            {$prefix}_start_time DATETIME NOT NULL ,
            {$prefix}_end_time DATETIME NULL ,
            {$prefix}_rate INT(4) DEFAULT 0 ,
            {$prefix}_task_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_parent_child_id INT(14) UNSIGNED NULL ,
            {$prefix}_creator_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            {$prefix}_created_time DATETIME NOT NULL ,
            {$prefix}_modifier_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_modifier_ip VARCHAR(15) NOT NULL ,
            {$prefix}_modified_time DATETIME NOT NULL ,
            CONSTRAINT duty_pk PRIMARY KEY ({$prefix}_id),
            CONSTRAINT duty_fk_parent FOREIGN KEY ({$prefix}_parent_child_id) REFERENCES {$this->db->dbprefix("parent")} (prt_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT duty_fk_task FOREIGN KEY ({$prefix}_task_id) REFERENCES {$this->db->dbprefix("task")} (tsk_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT duty_fk_user_creator FOREIGN KEY ({$prefix}_creator_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
            CONSTRAINT duty_fk_user_modifier FOREIGN KEY ({$prefix}_modifier_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE 
                
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('duty');
    }
}
	