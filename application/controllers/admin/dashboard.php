<?php 
class Dashboard extends Admin_Controller{
    
    public function index(){
        $this->data["menu"]["خانه"]["active"] = TRUE ;
		$this->load->view('admin/components/header');
		$this->load->view('admin/components/navbar' , $this->data);
		$this->load->view('admin/home' );
		$this->load->view('admin/components/footer');
    }
    
    public function logout(){
        $this->m_user->logout();
        redirect('login');
    }
}