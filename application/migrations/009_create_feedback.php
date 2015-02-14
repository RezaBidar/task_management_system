<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Feedback extends CI_Migration {

    public function up()
    {
        $prefix = "fbk" ;
        $table_name = $this->db->dbprefix("feedback");
  
        $this->db->query("
            CREATE TABLE {$table_name} (
            {$prefix}_id INT(14) UNSIGNED NOT NULL AUTO_INCREMENT ,
            {$prefix}_text TEXT NOT NULL ,
            {$prefix}_send_time DATETIME NULL ,
            {$prefix}_type INT(4) DEFAULT 0 ,
            {$prefix}_task_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_wiw_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            {$prefix}_created_time DATETIME NOT NULL ,
            {$prefix}_modifier_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_modifier_ip VARCHAR(15) NOT NULL ,
            {$prefix}_modified_time DATETIME NOT NULL ,
            CONSTRAINT feedback_pk PRIMARY KEY ({$prefix}_id),
            CONSTRAINT feedback_fk_who_is_where FOREIGN KEY ({$prefix}_wiw_id) REFERENCES {$this->db->dbprefix("who_is_where")} (wiw_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT feedback_fk_task FOREIGN KEY ({$prefix}_task_id) REFERENCES {$this->db->dbprefix("task")} (tsk_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT feedback_fk_user_creator FOREIGN KEY ({$prefix}_creator_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
            CONSTRAINT feedback_fk_user_modifier FOREIGN KEY ({$prefix}_modifier_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE 
             
                
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('feedback');
    }
}
	