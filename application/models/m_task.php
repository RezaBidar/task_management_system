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
    
    public function get($id=NULL,$single=NULL){
        $this->db->join('feedback' , 'fbk_id = tsk_description_id');
        return parent::get($id,$single);
    }
    
    public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
        $table = new My_Table() ;
    
        $thead = array(
            'عنوان',
        );
        $tbody = array(
            'tsk_title' ,
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
    
    /**
     * liste tamame taskhaii ke karbar sakhte va faAl hastand ra barmigadanad
     * @param integer $user_id
     * @param integer $group_id
     */
    public function getAllUserCreatedTask($user_id , $group_id = NULL){
        
        $this->db->where('tsk_creator_id' , $user_id);
        if($group_id) $this->db->where('tsk_group_id' , $group_id);
        $this->db->where('tsk_end_time IS NULL' , NULL , FALSE) ;
        
        return $this->get();
        
    }
    
    public function getTableTask($data ,$update_url = NULL , $delete_url = NULL , $select_url = NULL){
        $table = new My_Table() ;
    
        $thead = array(
            'عنوان',
            'تاریخ شروع',
            'مهلت انجام',
            'ناظر',
            'مهم/عادی',
            'وضیعیت'
            
        );
        $tbody = array(
            'title' ,
            'start_time' ,
            'due_time',
            'creator' ,
            'priority' ,
            'status'
        );
    
    
    
        return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
    }
    
    public function getTaskGroupId($task_id){
        
        return $this->get($task_id)->tsk_group_id;
    }
    
    
}

?>