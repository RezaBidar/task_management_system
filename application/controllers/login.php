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
		
		$this->load->model('m_user');
		
		$this->m_user->loggedin() && $this->m_user->logout();
		$rules = $this->m_user->rule;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE){
		    
			if($this->m_user->login()){
			    
				redirect('admin/dashboard');
			}
			echo $this->db->last_query();
		}
		
		var_dump($this->session->userdata);
		$this->load->view('login');
		
	}
}

?>