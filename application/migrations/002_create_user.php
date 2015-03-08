<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_user extends CI_Migration {

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
            {$prefix}_employee_id VARCHAR(125) NOT NULL UNIQUE ,
            {$prefix}_email VARCHAR(255) NULL ,
            {$prefix}_gender ENUM('male' , 'female') ,
            {$prefix}_tel VARCHAR(20) NULL ,
            {$prefix}_mobile VARCHAR(20) NULL ,
            {$prefix}_avatar VARCHAR(255) NULL ,
            {$prefix}_type INT(4) DEFAULT 0 ,
            {$prefix}_address TEXT NULL ,
            {$prefix}_last_login DATETIME NULL ,
            {$prefix}_creator_id INT(14) UNSIGNED NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            {$prefix}_created_time DATETIME NOT NULL ,
            {$prefix}_modifier_id INT(14) UNSIGNED NULL ,
            {$prefix}_modifier_ip VARCHAR(15) NOT NULL ,
            {$prefix}_modified_time DATETIME NOT NULL ,
            CONSTRAINT user_unq UNIQUE ({$prefix}_username) ,
            CONSTRAINT user_pk PRIMARY KEY ({$prefix}_id) ,
            CONSTRAINT user_fk_user_creator FOREIGN KEY ({$prefix}_creator_id) REFERENCES {$this->db->dbprefix("user")} ({$prefix}_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
            CONSTRAINT user_fk_user_modifier FOREIGN KEY ({$prefix}_modifier_id) REFERENCES {$this->db->dbprefix("user")} ({$prefix}_id) ON DELETE RESTRICT ON UPDATE CASCADE  
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
        
        $this->db->where('usr_username','admin');
        
        $admin = $this->db->get('user')->row();
        if(sizeof($admin) == 0){
            $data = array(
                'usr_fname' => "مدیر",
                'usr_lname' => "سیستم",
                'usr_username' => "admin",
                'usr_type' => 10 ,
                'usr_password' => md5("pnetms" . config_item('encryption_key')) ,
                'usr_employee_id' => "1" ,
                'usr_creator_ip' => "1" ,
                'usr_created_time' => date('Y-m-d H:i:s') ,
                'usr_modifier_ip' => "1" ,
                'usr_modified_time' => date('Y-m-d H:i:s') ,
            );
            $this->db->insert('user' , $data) ;
        }
        
    }

    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}


	
	