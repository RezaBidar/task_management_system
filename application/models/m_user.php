<?php
class m_user extends MY_Model{
    
    protected $_table_name = 'user' ;
    protected $_prefix = 'usr_' ;
    
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
            "usr_password" => $this->hash($this->input->post('password')),
            "usr_username" => $this->input->post('username')
        );
        $user = $this->get_by($where,true);
        if(count($user)){
            $session_data = array(
                "fname" => $user->usr_fname,
                "lname"	=> $user->usr_lname,
                "username" => $user->usr_username,
                "admin"	=> ($user->usr_type == 10)? TRUE : FALSE,//10 is admin 
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
    public function is_admin(){
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
}

?>