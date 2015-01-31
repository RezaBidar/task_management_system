<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_User extends CI_Migration {

    public function up()
    {
        $prefix = "usr" ;
        $table_name = $this->db->dbprefix("user");
  
        $this->db->query("
            CREATE TABLE {$table_name} (
            {$prefix}_id INT(14) UNSIGNED NOT NULL AUTO_INCREMENT ,
            {$prefix}_fname VARCHAR(100) NOT NULL ,
            {$prefix}_lname VARCHAR(100) NULL ,
            {$prefix}_username VARCHAR(100) NULL ,
            {$prefix}_password VARCHAR(255) NULL ,
            {$prefix}_email VARCHAR(255) NULL ,
            {$prefix}_gender ENUM('male' , 'female') ,
            {$prefix}_tel VARCHAR(20) NULL ,
            {$prefix}_mobile VARCHAR(20) NULL ,
            {$prefix}_avatar VARCHAR(255) NULL ,
            {$prefix}_type INT(4) DEFAULT 0 ,
            {$prefix}_address TEXT NULL ,
            {$prefix}_last_login DATETIME NULL ,
            {$prefix}_creator_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            {$prefix}_created_time DATETIME NOT NULL ,
            {$prefix}_modifier_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_modifier_ip VARCHAR(15) NOT NULL ,
            {$prefix}_modified_time DATETIME NOT NULL ,
            CONSTRAINT user_pk PRIMARY KEY ({$prefix}_id) ,
            CONSTRAINT user_fk_user_creator FOREIGN KEY ({$prefix}_creator_id) REFERENCES {$this->db->dbprefix("user")} ({$prefix}_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
            CONSTRAINT user_fk_user_modifier FOREIGN KEY ({$prefix}_modifier_id) REFERENCES {$this->db->dbprefix("user")} ({$prefix}_id) ON DELETE RESTRICT ON UPDATE CASCADE  
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}


	
	