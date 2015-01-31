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
            {$prefix}_master_id INT(14) UNSIGNED NULL ,
            {$prefix}_employee_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            {$prefix}_created_time DATETIME NOT NULL ,
            {$prefix}_modifier_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_modifier_ip VARCHAR(15) NOT NULL ,
            {$prefix}_modified_time DATETIME NOT NULL ,
            CONSTRAINT noted_pk PRIMARY KEY ({$prefix}_id),
            CONSTRAINT duty_fk_user_master FOREIGN KEY ({$prefix}_master_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT duty_fk_user_employee FOREIGN KEY ({$prefix}_employee_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT duty_fk_task FOREIGN KEY ({$prefix}_task_id) REFERENCES {$this->db->dbprefix("task")} (tsk_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT duty_fk_user_creator FOREIGN KEY ({$prefix}_creator_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE 
                
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
	