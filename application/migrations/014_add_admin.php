<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_admin extends CI_Migration {

    public function up()
    {
        $this->db->query("UPDATE `rz_user` SET `usr_type` = '10' WHERE `usr_id` = 1");
        if($this->db->table_exists('user')){
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
    }

    public function down()
    {
        echo "no user" ;
    }
}
	