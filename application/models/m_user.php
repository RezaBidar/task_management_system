<?php
class m_user extends MY_Model{
    
    protected $_table_name = 'user' ;
    protected $_prefix = 'usr_' ;
    protected $_primary_key = 'usr_id';
    
    public $rule = array (
        'username' => array (
            'field' => 'username',
            'label' => 'username',
            'rules' => 'trim|required'
        ),
        'password' => array (
            'field' => 'password',
            'label' => 'password',
            'rules' => 'trim|required'
        )
    );
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
    
    protected $_username_pattern = "/^[A-Za-z0-9]{5-30}$/" ; //faghat alfanumeric ba size 5-30
    protected $_password_pattern = "/^[A-Za-z0-9]{5-30}$/" ; //faghat alfanumeric ba size 5-30
    
    /**
     * username password ro migire ba pattern moghayese mikone age too db mojod bood session ro set mikone
     * va last login dar table user update migardad
     * @return boolean
     */
    public function login(){
        $where = array(
            "password" => $this->hash($this->input->post('password')),
            "username" => $this->input->post('username')
        );
        
        $user = $this->get_by($where,true);
        
        $is_admin = ($user->usr_type == 10)? TRUE : FALSE ; //10 is admin 
        if(count($user)){
            $session_data = array(
                "fname" => $user->usr_fname,
                "lname"	=> $user->usr_lname,
                "username" => $user->usr_username,
                "admin"	=>  $is_admin ,
                "id" => $user->usr_id ,
                "loged_in" => TRUE
            );
            $this->session->set_userdata($session_data);
            
            //inja bayad last_login update shavad dar ayande
            //...
            
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * kole session ra pak va karbar gheedatan logout mishavad
     */
    public function logout(){
        $this->session->sess_destroy(array('fname' => '' ,
                                           'lnam' => '' ,
                                           'username' => '' , 
                                           'admin' =>'' , 
                                           'id' => '' , 
                                           'logged_in' => ''));
    }
    
    /**
     * chek mikone karbar login shode va session set shode ast aya
     * @return boolean
     */
    public function loggedIn(){
        return (bool) $this->session->userdata('loged_in');
    }
    
    /**
     * felan chon 2ta sath darim az is_admin estefade mikonim
     * @return bool
     */
    public function isAdmin(){
        return (bool) $this->session->userdata('admin') ;
    }
    
    /**
     * str ra gerefte va md5 tahvil midahad , baraye hash kardan password be kar miravad
     * @param string $input
     * @return string
     */
    public function hash($input){
        if(strlen($input) == 0) return '' ;
        return md5($input . config_item('encryption_key'));
    }
    
    /**
     * liste userHaii ra ke dar group_id mojood bashand ro barmigardoone 
     * agar $member false shod liste karmndani ke dar groohe $group_id nistand ro barmigardoone
     * agar employee_id set shavad faghat etelaate yek karmand ra barmigardanad
     * @param string $group_id
     * @param string $member
     * @return array
     */
    public function getUserObjectByGroup($group_id , $member = '' , $employee_id = ''){

        $in_or_notin = 'not in' ;
        $end_date = '' ;
        if($member != '') {
            $in_or_notin = 'in' ;
            $end_date = "and `wiw_end_date` IS NULL" ;
        }
        
        $and_employee = '' ;
        if($and_employee != '') $and_employee = 'AND `usr_id` = '. $employee_id ;
        
        $query = "select * from `{$this->db->dbprefix('user')}` where `{$this->db->dbprefix('user')}`.`usr_id` {$in_or_notin} 
(select `usr_id` from `{$this->db->dbprefix('user')}` left join `{$this->db->dbprefix('who_is_where')}` on `{$this->db->dbprefix('user')}`.`usr_id` = `{$this->db->dbprefix('who_is_where')}`.`wiw_user_id` 
        where `wiw_group_id` = ? {$end_date} ) {$and_employee}" ;
        
        $result = $this->db->query($query , array($group_id))->result();
        
        return $result ;
    }
    
    /**
     * 
     * @param unknown $group_id
     * @param string $member
     * @param string $employee_id
     * @return multitype:multitype:string NULL
     */
    public function getUserByGroup($group_id , $member = '' , $employee_id = ''){
        $result = $this->getUserObjectByGroup($group_id,$member,$employee_id) ;
        $answer = array() ;
        foreach($result as $key => $val){
            $answer[$val->usr_id] = array(
                'employee_id' => $val->usr_employee_id ,
                'name' => $val->usr_fname . ' ' . $val->usr_lname
            );
        }
        return $answer ;
    }
    
 /**
     * @param string $master_id /// dar vaghe wiw_master_id    
     * @param string $member
     * @param string $employee_id
     * @return unknown
     */
    public function getUserObjectByParent( $group_id , $master_id , $minion = ''){

        $in_or_notin = 'not in' ;
        if($minion != '') {
            $in_or_notin = 'in' ;
        }
        
        
        
//         $query =    "select * from `{$this->db->dbprefix('user')}`
//                     left join `{$this->db->dbprefix('who_is_where')}` on `{$this->db->dbprefix('who_is_where')}`.`wiw_user_id` = `{$this->db->dbprefix('user')}`.`usr_id`   
//                     where `wiw_group_id` = {$group_id} and `usr_id` != {$master_id} and 
//                     `{$this->db->dbprefix('user')}`.`usr_id` {$in_or_notin}
//                     (select `wiw_user_id` as `usr_id` from `{$this->db->dbprefix('parent')}` 
//                     left join `{$this->db->dbprefix('who_is_where')}` `wiw_e`
//                     on `{$this->db->dbprefix('parent')}`.`prt_employee_id` = `wiw_e`.`wiw_id`
//                     left join (select `wiw_id` , `wiw_user_id` as `master_id` from `{$this->db->dbprefix('who_is_where')}`) as `wiw_m` 
//                     on `{$this->db->dbprefix('parent')}`.`prt_master_id` = `wiw_m`.`wiw_id`
//                     where `master_id` = {$master_id} and `wiw_e`.`wiw_group_id` = {$group_id})  {$and_employee} " ;
        

//         $query =    "select * from `rz_who_is_where`
//                     left join `rz_user` on `rz_who_is_where`.`wiw_user_id` = `rz_user`.`usr_id`
//                     where `wiw_user_id` not in (select `wiw_user_id` from `rz_parent`
//                     left join `rz_who_is_where` on `rz_parent`.`prt_employee_id` = `rz_who_is_where`.`wiw_id`
//                     where `prt_master_id` = 16) and `wiw_group_id` = 3 and `wiw_id` = 16" ;
        

        $query =    "select * from `{$this->db->dbprefix('who_is_where')}`
                    left join `{$this->db->dbprefix('user')}` on `{$this->db->dbprefix('who_is_where')}`.`wiw_user_id` = `{$this->db->dbprefix('user')}`.`usr_id`
                    where `wiw_user_id` {$in_or_notin} (select `wiw_user_id` from `{$this->db->dbprefix('parent')}`
                    left join `{$this->db->dbprefix('who_is_where')}` on `{$this->db->dbprefix('parent')}`.`prt_employee_id` = `{$this->db->dbprefix('who_is_where')}`.`wiw_id`
                    where `prt_master_id` = {$master_id}) and `wiw_group_id` = {$group_id} and `wiw_id` != {$master_id} " ;
        
        $result = $this->db->query($query)->result();
        
        return $result ;        
    }
    
    
    /**
     * 
     * @param unknown $group_id
     * @param unknown $parent_id
     * @param string $member
     * @param string $employee_id
     * @return multitype:multitype:string NULL
     */
    public function getUserByParent($group_id ,$master_id , $member = '' ){
        $result = $this->getUserObjectByParent($group_id , $master_id ,$member) ;
        $answer = array() ;
        foreach($result as $key => $val){
            $answer[$val->wiw_id] = array(
                'employee_id' => $val->usr_employee_id ,
                'name' => $val->usr_fname . ' ' . $val->usr_lname
            );
        }
        return $answer ;
    }
    
    /**
     * @param string $master_id /// dar vaghe wiw_master_id
     * @param string $member
     * @param string $employee_id
     * @return unknown
     */
    public function getUserObjectByNoted( $reminder_id , $master_id , $minion = ''){
    
        $in_or_notin = 'not in' ;
        if($minion != '') {
            $in_or_notin = 'in' ;
        }
    
//         $query =   "select * from `rz_user` 
//                     join `rz_who_is_where` on `wiw_user_id` = `usr_id` 
//                     join `rz_parent` on `prt_employee_id` = `wiw_id` 
//                     where `usr_id` not in 
//                     (select `usr_id` from `rz_noted` 
//                      join `rz_parent` on `ntd_parent_child_id` = `prt_id` 
//                      join `rz_who_is_where` on `prt_employee_id` = `wiw_id` 
//                      join `rz_user` on `wiw_user_id` = `usr_id` 
//                      where `prt_master_id` = 21 and `ntd_reminder_id` = 1 ) 
//                     and `prt_master_id` = 21 " ;
        
        $query =   "select * from `{$this->db->dbprefix('user')}`
                    join `{$this->db->dbprefix('who_is_where')}` on `wiw_user_id` = `usr_id`
                    join `{$this->db->dbprefix('parent')}` on `prt_employee_id` = `wiw_id`
                    where `usr_id` {$in_or_notin}
                    (select `usr_id` from `{$this->db->dbprefix('noted')}`
                     join `{$this->db->dbprefix('parent')}` on `ntd_parent_child_id` = `prt_id`
                     join `{$this->db->dbprefix('who_is_where')}` on `prt_employee_id` = `wiw_id`
                     join `{$this->db->dbprefix('user')}` on `wiw_user_id` = `usr_id`
                     where `prt_master_id` = {$master_id} and `ntd_reminder_id` = {$reminder_id} )
                    and `prt_master_id` = {$master_id} " ;
        
    
        $result = $this->db->query($query)->result();
        
        return $result ;
    }
    
    
    /**
     *
     * @param unknown $group_id
     * @param unknown $parent_id
     * @param string $member
     * @param string $employee_id
     * @return multitype:multitype:string NULL
     */
    public function getUserByNoted($reminder_id ,$master_id , $member = '' ){
        $result = $this->getUserObjectByNoted($reminder_id , $master_id ,$member) ;
        
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
     * @param unknown $group_id
     * @param string $update_url
     * @param string $delete_url
     * @param string $select_url
     * @return string
     */
    public function getTable($group_id , $update_url = NULL , $delete_url = NULL , $select_url = NULL){
		
        $table = new My_Table() ;
		
        $thead = array(
            'کد پرسنلی' ,
            'نام',
			'نام خانوادگی',
                
		);
		$tbody = array(
		    'usr_employee_id' ,
		    'usr_fname' ,
		    'usr_lname'
		);
		
		$data = $this->getUserObjectByGroup($group_id , 'member') ;
		
		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
    }
}

?>