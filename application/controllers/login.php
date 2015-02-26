<?php

/**
 *
 * @author ReZaBiDaR
 *        
 */
class Login extends MY_Controller {
	
	/**
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/*
	 * index page of login
	 */
	public function index(){
		//echo md5("pnetms" . config_item('encryption_key')) ;
		$this->load->model('m_user');
		$this->data = array() ;
		$this->m_user->loggedin() && $this->m_user->logout();
		$rules = $this->m_user->rule;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE){
		    
			if($this->m_user->login()){
			   // if(true || preg_match("/^(". site_url("admin") .").*/", $_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER'] ;
			     redirect('admin/dashboard/overview');
			}else{
    		    $this->data['error']['wrong_user'] = 'نام کاربری یا کلمه عبور اشتباه وارد شده است' ;
		    }
			//echo $this->db->last_query();
		}
		
		//var_dump($this->session->userdata);
		$this->load->view('login' , $this->data);
		
	}
}

?>