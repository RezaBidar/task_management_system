<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_comment extends CI_Migration {

    public function up()
    {
        $prefix = "cmt" ;
        $table_name = $this->db->dbprefix("comment");
  
        $this->db->query("
            CREATE TABLE {$table_name} (
            {$prefix}_id INT(14) UNSIGNED NOT NULL AUTO_INCREMENT ,
            {$prefix}_title VARCHAR(200) NOT NULL ,
            {$prefix}_text TEXT NOT NULL ,
            {$prefix}_creator_id INT(14) UNSIGNED NOT NULL ,
            {$prefix}_created_time DATETIME NOT NULL ,
            {$prefix}_modified_time DATETIME NOT NULL ,
            CONSTRAINT comment_pk PRIMARY KEY ({$prefix}_id),
            CONSTRAINT comment_fk_user_creator FOREIGN KEY ({$prefix}_creator_id) REFERENCES {$this->db->dbprefix("user")} (usr_id) ON DELETE RESTRICT ON UPDATE CASCADE     
            ) ENGINE=INNODB
            DEFAULT CHARSET = utf8
            DEFAULT COLLATE = utf8_unicode_ci
            ;"
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('comment');
    }
}

