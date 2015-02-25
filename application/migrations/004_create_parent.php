<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_parent extends CI_Migration {

    public function up()
    {
        $prefix = "prt" ;
        $table_name = $this->db->dbprefix("parent");
  
        $this->db->query("
            CREATE TABLE {$table_name} (
            {$prefix}_id INT(14) UNSIGNED NOT NULL AUTO_INCREMENT ,
            {$prefix}_master_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_employee_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_start_date DATETIME NOT NULL ,
            {$prefix}_end_date DATETIME NUlL ,
            {$prefix}_creator_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            {$prefix}_created_time DATETIME NOT NULL ,
            {$prefix}_modifier_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_modifier_ip VARCHAR(15) NOT NULL ,
            {$prefix}_modified_time DATETIME NOT NULL ,
            CONSTRAINT parent_pk PRIMARY KEY ({$prefix}_id),
            CONSTRAINT parent_fk_wiw_master FOREIGN KEY ({$prefix}_master_id) REFERENCES {$this->db->dbprefix("who_is_where")} (wiw_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT parent_fk_wiw_employee FOREIGN KEY ({$prefix}_employee_id) REFERENCES {$this->db->dbprefix("who_is_where")} (wiw_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT parent_fk_user_creator FOREIGN KEY ({$prefix}_creator_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE ,
            CONSTRAINT parent_fk_user_modifier FOREIGN KEY ({$prefix}_modifier_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE 
             
                
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('parent');
    }
}
	