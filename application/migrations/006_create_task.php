<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_task extends CI_Migration {

    public function up()
    {
        $prefix = "tsk" ;
        $table_name = $this->db->dbprefix("task");
  
        $this->db->query("
            CREATE TABLE {$table_name} (
            {$prefix}_id INT(14) UNSIGNED NOT NULL AUTO_INCREMENT ,
            {$prefix}_title VARCHAR(100) NOT NULL ,
            {$prefix}_description_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_end_report TEXT NULL ,
            {$prefix}_priority INT(4) NOT NULL ,
            {$prefix}_private_level INT(4) DEFAULT 0 ,
            {$prefix}_warning_date INT(4) DEFAULT 0 ,
            {$prefix}_status INT(4) DEFAULT 0 ,
            {$prefix}_status_changer INT(14) UNSIGNED NULL ,
            {$prefix}_start_time DATETIME NOT NULL ,
            {$prefix}_due_time DATETIME NOT NULL ,
            {$prefix}_end_time DATETIME NULL ,
            {$prefix}_group_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_sup_task_id INT(14) UNSIGNED NULL ,
            {$prefix}_creator_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            {$prefix}_created_time DATETIME NOT NULL ,
            {$prefix}_modifier_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_modifier_ip VARCHAR(15) NOT NULL ,
            {$prefix}_modified_time DATETIME NOT NULL ,
            CONSTRAINT task_pk PRIMARY KEY ({$prefix}_id),
            CONSTRAINT task_fk_user_creator FOREIGN KEY ({$prefix}_creator_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
            CONSTRAINT task_fk_user_status_changer FOREIGN KEY ({$prefix}_status_changer) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
            CONSTRAINT task_fk_group FOREIGN KEY ({$prefix}_group_id) REFERENCES {$this->db->dbprefix("group")} (grp_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT task_fk_user_modifier FOREIGN KEY ({$prefix}_modifier_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE   
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('task');
    }
}


	
