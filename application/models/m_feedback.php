<?php

class m_feedback extends MY_Model{
    protected $_table_name = 'feedback' ;
    protected $_prefix = 'fbk_' ;
    protected $_primary_key = 'fbk_id' ;
    
    protected $_timestamp = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_ip = TRUE ;
    
    public function getSeenMessage($task_id){
        
        $user_id = $this->session->userdata('id') ;
        
        $query = "SELECT * FROM `{$this->db->dbprefix('feedback')}`
            WHERE `fbk_id` IN
            (SELECT `wds_feedback_id` FROM `{$this->db->dbprefix('who_did_see')}`
            WHERE `wds_user_id` = {$user_id} ) AND `fbk_task_id` = {$task_id}";
    }
    
    public function getNotSeenMessage($task_id){
        
        $user_id = $this->session->userdata('id') ;
        
        $query = "SELECT * FROM `{$this->db->dbprefix('feedback')}` 
            WHERE `fbk_id` NOT IN 
            (SELECT `wds_feedback_id` FROM `{$this->db->dbprefix('who_did_see')}` 
            WHERE `wds_user_id` = {$user_id} ) AND `fbk_task_id` = {$task_id}" ;
        
    }
    
    
}

?>