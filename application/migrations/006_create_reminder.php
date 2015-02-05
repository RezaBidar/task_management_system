<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Reminder extends CI_Migration {

    public function up()
    {
        $prefix = "rmd" ;
        $table_name = $this->db->dbprefix("reminder");
  
        $this->db->query("
            CREATE TABLE {$table_name} (
            {$prefix}_id INT(14) UNSIGNED NOT NULL AUTO_INCREMENT ,
            {$prefix}_type INT(4) DEFAULT 0 ,
            {$prefix}_title VARCHAR(100) NOT NULL ,
            {$prefix}_text TEXT NOT NULL ,
            {$prefix}_duration INT(14) DEFAULT 1 ,
            {$prefix}_start_time DATETIME NOT NULL ,
            {$prefix}_creator_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            {$prefix}_created_time DATETIME NOT NULL ,
            {$prefix}_modifier_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_modifier_ip VARCHAR(15) NOT NULL ,
            {$prefix}_modified_time DATETIME NOT NULL ,
            CONSTRAINT reminder_pk PRIMARY KEY ({$prefix}_id),
            CONSTRAINT reminder_fk_user_creator FOREIGN KEY ({$prefix}_creator_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
            CONSTRAINT reminder_fk_user_modifier FOREIGN KEY ({$prefix}_modifier_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE    
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('reminder');
    }
}


	
