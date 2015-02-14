<?php
class m_task extends MY_Model{
    
    protected $_table_name = 'task' ;
    protected $_prefix = 'tsk_' ;
    protected $_primary_key = 'tsk_id' ;
    
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
            'tsk_title' ,
            'tsk_description'
        );
    
        $where = array(
            "creator_id" => $this->session->userdata('id'),
        );
        $data = $this->get_by($where) ;
    
    
        return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
    }
    
    /**
     * return task_list by group_id
     * @param unknown $group_id
     * @param string $update_url
     * @param string $delete_url
     * @param string $select_url
     */
    public function getTableByGroup($group_id , $update_url = NULL , $delete_url = NULL , $select_url = NULL){
        $this->db->where('tsk_group_id' , $group_id) ;
        return $this->getTable($update_url , $delete_url , $select_url) ;
    }
}

?>