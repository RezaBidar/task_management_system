<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Noted extends CI_Migration {

    public function up()
    {
        $prefix = "ntd" ;
        $table_name = $this->db->dbprefix("noted");
  
        $this->db->query("
            CREATE TABLE {$table_name} (
            {$prefix}_id INT(14) UNSIGNED NOT NULL AUTO_INCREMENT ,
            {$prefix}_reminder_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_master_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_employee_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            {$prefix}_created_time DATETIME NOT NULL ,
            {$prefix}_modifier_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_modifier_ip VARCHAR(15) NOT NULL ,
            {$prefix}_modified_time DATETIME NOT NULL ,
            CONSTRAINT noted_pk PRIMARY KEY ({$prefix}_id),
            CONSTRAINT noted_fk_user_master FOREIGN KEY ({$prefix}_master_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT noted_fk_user_employee FOREIGN KEY ({$prefix}_employee_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT noted_fk_user_reminder FOREIGN KEY ({$prefix}_reminder_id) REFERENCES {$this->db->dbprefix("reminder")} (rmd_id) ON DELETE CASCADE ON UPDATE CASCADE    
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('noted');
    }
}


	
	