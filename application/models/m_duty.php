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
    
    /**
     * 
     * @param unknown $task_id
     */
    public function getUserByTaskId($task_id){

        $this->db->join('parent' , 'dty_parent_child_id = prt_id') ;
        $this->db->join('who_is_where' , 'prt_employee_id = wiw_id') ;
        $this->db->join('user' , 'wiw_user_id = usr_id') ;
        $this->db->where('dty_end_time IS NULL', null, false);
        
        $where = array(
            'dty_task_id' => $task_id   
        );
        
        return $this->get_by($where,FALSE,FALSE);
    }
    
    /**
     * return user info by duty id
     * @param unknown $duty_id
     */
    public function getUserByDutyId($duty_id){
        
        $this->db->join('parent' , 'dty_parent_child_id = prt_id') ;
        $this->db->join('who_is_where' , 'prt_employee_id = wiw_id') ;
        $this->db->join('user' , 'wiw_user_id = usr_id') ;
        $where = array(
            'id' => $duty_id
        );
        
        return $this->get_by($where,TRUE);
    }
    
    /**
     * @param string $master_id /// dar vaghe wiw_master_id
     * @param string $member
     * @param string $task_id
     * @return unknown
     */
    public function getUserObjectByTask( $task_id , $master_id){
    
    	
    
    	/*$query =   "select * from `rz_user`
    	 join `rz_who_is_where` on `wiw_user_id` = `usr_id`
    	join `rz_parent` on `prt_employee_id` = `wiw_id`
    	where `usr_id` in
    	(select `usr_id` from `rz_duty`
    			join `rz_parent` on `dty_parent_child_id` = `prt_id`
    			join `rz_who_is_where` on `prt_employee_id` = `wiw_id`
    			join `rz_user` on `wiw_user_id` = `usr_id`
    			where `prt_master_id` = 21 and `dty_task_id` = 1 )
    	and `prt_master_id` = 21 " ; */
    
    	$query =   "select * from `{$this->db->dbprefix('user')}`
    	join `{$this->db->dbprefix('who_is_where')}` on `wiw_user_id` = `usr_id`
    	join `{$this->db->dbprefix('parent')}` on `prt_employee_id` = `wiw_id`
    	where `usr_id` NOT IN
    	(select `usr_id` from `{$this->db->dbprefix('duty')}`
    	join `{$this->db->dbprefix('parent')}` on `dty_parent_child_id` = `prt_id`
    	join `{$this->db->dbprefix('who_is_where')}` on `prt_employee_id` = `wiw_id`
    	join `{$this->db->dbprefix('user')}` on `wiw_user_id` = `usr_id`
    	where `prt_master_id` = {$master_id} and `dty_task_id` = {$task_id} and `dty_end_time` IS NULL)
    	and `prt_master_id` = {$master_id} " ;

    	$result = $this->db->query($query)->result();
    	//echo $this->db->last_query();
    	//echo "reza" ;
    	return $result ;
    }
    
    /**
     *
     * @param unknown $task
     * @param unknown $master_id
     * @param string $member
     * @return multitype:multitype:string NULL
     */
    public function getUserByTask($task ,$master_id){
    	$result = $this->getUserObjectByTask($task , $master_id) ;
    
    	$answer = array() ;
    	foreach($result as $key => $val){
    		$answer[$val->prt_id] = array(
    				'employee_id' => $val->usr_employee_id ,
    				'name' => $val->usr_fname . ' ' . $val->usr_lname
    		);
    	}
    	return $answer ;
    }
    
    /**
     * 
     * @param string $group_id
     * @param string $user_id
     */
    public function getAllUserDuty($user_id , $group_id = NULL ){
        $this->db->join('task' , 'tsk_id = dty_task_id');
        $this->db->join('parent' , 'prt_id = dty_parent_child_id');
        $this->db->join('who_is_where' , 'wiw_id = prt_employee_id');
        
        $this->db->where('wiw_end_date IS NULL' , NULL , FALSE);
        $this->db->where('prt_end_date IS NULL' , NULL , FALSE);
        $this->db->where('dty_end_time IS NULL' , NULL , FALSE);
        $this->db->where('tsk_end_time IS NULL' , NULL , FALSE);
        $this->db->where('tsk_status <' , 2);
        $this->db->where('wiw_user_id' , $user_id);
        if($group_id) $this->db->where('tsk_group_id' , $group_id) ;
        
        return $this->get();
        
    }
    
    
        
}

?>