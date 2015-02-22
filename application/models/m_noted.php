<?php

class m_noted extends MY_Model{

    protected $_table_name = 'noted' ;
    protected $_prefix = 'ntd_' ;
    protected $_primary_key = 'ntd_id' ;
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
    
    public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
        $table = new My_Table() ;
    
        $thead = array(
            'عنوان',
            'متن',
        );
        $tbody = array(
            'rmd_title' ,
            'rmd_text'
        );
    
        
        
        $where = array(
            "wiw_user_id" => $this->session->userdata('id'),
        );
        
        $this->db->join('reminder' , 'rmd_id = ntd_reminder_id');
        $this->db->join('parent' , 'prt_id = ntd_parent_child_id');
        $this->db->join('who_is_where' , 'wiw_id = prt_employee_id');
        $data = $this->get_by($where , FALSE , FALSE) ;
        
//         var_dump($this->db->last_query()) ;
    
    
        return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
    }
    
    /**
     * tamame reminderhaii ke marbood be in karbar mibashad ra barmigardanad
     * @param unknown $wiw_user_id
     */
    public function getUserReminder($wiw_user_id){
        $this->db->join('reminder' , 'rmd_id = ntd_reminder_id') ;
        $this->db->join('parent' , 'prt_id = ntd_parent_child_id');
        $this->db->where('prt_employee_id' , $wiw_user_id);
        $this->db->where('rmd_start_time <=' , date('Y-m-d H:i:s'));
        return $this->get();
    }
}

?>