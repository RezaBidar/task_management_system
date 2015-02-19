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
		$this->data["user_id"] = $this->session->userdata('id') ;
		$this->data["user_fullname"] = $this->session->userdata('fname') . " " . $this->session->userdata('lname') ;
		
		// Get the current logged in user (however your app does it)
// 		$user_id = $this->session->userdata('user_id');
		
		// You might want to validate that the user exists here
		
		// If you only want to update in intervals, check the last_activity.
		// You may need to load the date helper, or simply use time() instead.
// 		$time_since = now() - $this->session->userdata('last_activity');
// 		$interval = 300;
		
		// Do nothing if last activity is recent
// 		if ($time_since < $interval) return;
		
		// Update database
// 		$updated = $this->db
// 		->set('last_activity', now())
// 		->where('id', $user_id)
// 		->update('users');
		
// 		// Log errors if you please
// 		$updated or log_message('error', 'Failed to update last activity.');
	}
}
