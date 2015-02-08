<?php

class m_duty extends MY_Model{

    protected $_table_name = 'duty' ;
    protected $_prefix = 'dty_' ;
    protected $_primary_key = 'dty_id' ;
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
    
    public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
        $table = new My_Table() ;
    
        $thead = array(
            'عنوان',
            'توضیحات',
        );
        $tbody = array(
            'tsk_title' ,
            'tsk_description'
        );
    
    
    
        $where = array(
            "wiw_user_id" => $this->session->userdata('id'),
        );
    
        $this->db->join('task' , 'tsk_id = dty_task_id');
        $this->db->join('parent' , 'prt_id = dty_parent_child_id');
        $this->db->join('who_is_where' , 'wiw_id = prt_employee_id');
        $data = $this->get_by($where , FALSE , FALSE) ;
    
        //         var_dump($this->db->last_query()) ;
//         var_dump($data) ;
    
        return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
    }
        
}

?>