<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_who_did_see extends CI_Migration {

    public function up()
    {
        $prefix = "wds" ;
        $table_name = $this->db->dbprefix("who_did_see");
  
        $this->db->query("
            CREATE TABLE {$table_name} (
            {$prefix}_id INT(14) UNSIGNED NOT NULL AUTO_INCREMENT ,
            {$prefix}_time DATETIME NOT NULL ,
            {$prefix}_user_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_feedback_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_creator_ip VARCHAR(15) NOT NULL ,
            CONSTRAINT who_did_see_pk PRIMARY KEY ({$prefix}_id),
            CONSTRAINT who_did_see_fk_user FOREIGN KEY ({$prefix}_user_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE CASCADE ON UPDATE CASCADE ,
            CONSTRAINT who_did_see_fk_feedback FOREIGN KEY ({$prefix}_feedback_id) REFERENCES {$this->db->dbprefix("feedback")} (fbk_id) ON DELETE CASCADE ON UPDATE CASCADE 
            
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('who_did_see');
    }
}
	