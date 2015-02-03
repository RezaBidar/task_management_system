<?php
class Admin_Controller extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		
		$this->load->model('m_user');
		
		//check if not logged redirect to login page
		!$this->m_user->loggedin() && redirect('login');
		
		// load menu for admin panel
		$this->data["menu"] = config_item("admin_menu");
		$this->data["base_url"] = base_url() ;
	}
}
