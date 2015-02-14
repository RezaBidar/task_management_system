<?php

class m_feedback extends MY_Model{
    protected $_table_name = 'feedback' ;
    protected $_prefix = 'fbk_' ;
    protected $_primary_key = 'fbk_id' ;
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
    
    public function getSeenMessage($task_id){
        
        $user_id = $this->session->userdata('id') ;
        
        $query = "SELECT * FROM `{$this->db->dbprefix('feedback')}`
            JOIN `{$this->db->dbprefix('who_is_where')}` ON `fbk_wiw_id` = `wiw_id`
            JOIN `{$this->db->dbprefix('user')}` ON `wiw_user_id` = `usr_id`
            WHERE `fbk_id` IN
            (SELECT `wds_feedback_id` FROM `{$this->db->dbprefix('who_did_see')}`
            WHERE `wds_user_id` = {$user_id} ) AND `fbk_task_id` = {$task_id}";
        
        return $this->db->query($query)->result() ;
    }
    
    public function getNotSeenMessage($task_id){

        /* "SELECT * FROM `rz_feedback`
         WHERE `fbk_id` IN
         (SELECT `wds_feedback_id` FROM `rz_who_did_see`
         WHERE `wds_user_id` = 1 ) AND `fbk_task_id` = 1" ;
         */
        
        $user_id = $this->session->userdata('id') ;
        
        $query = "SELECT * FROM `{$this->db->dbprefix('feedback')}`
            JOIN `{$this->db->dbprefix('who_is_where')}` ON `fbk_wiw_id` = `wiw_id`
            JOIN `{$this->db->dbprefix('user')}` ON `wiw_user_id` = `usr_id` 
            WHERE `fbk_id` NOT IN 
            (SELECT `wds_feedback_id` FROM `{$this->db->dbprefix('who_did_see')}` 
            WHERE `wds_user_id` = {$user_id} ) AND `fbk_task_id` = {$task_id}" ;
        
        return $this->db->query($query)->result() ;
        
       
        
    }
    
    
}

?>