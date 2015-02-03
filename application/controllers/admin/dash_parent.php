<?php
class dash_parent extends Admin_Controller{

    public function __construct(){
        parent::__construct() ;

        $this->load->model('m_parent') ;
        $this->load->model('m_group') ;
        $this->load->model('m_user') ;

    }
    
    
    public function add_parent($group_id = NULL , $user_id = NULL){
        
        $view = NULL ;// esme view ke bayad load beshe
        
        //agar group id set nashode bashad liste groupHa namayesh dasde mishavad ta yeki ra entekhab konad
        if($group_id == NULL){
            $this->data["table"] = $this->m_group->getTable(NULL , NULL , "admin/dash_parent/add_parent");
            $view = 'show_list' ;
        }else if ($user_id == NULL){
            $this->data["table"] = $this->m_user->getTable($group_id , NULL , NULL , "admin/dash_parent/add_parent");
            $view = 'show_list' ;
        }else {
            $this->data["group_id"] = $group_id ;
            $this->data["membered"] = $this->m_user->getUserByGroup($group_id , 'member') ;
            $this->data["not_membered"] = $this->m_user->getUserByGroup($group_id) ;
            $view = 'add_parent' ;
        }
        
        //load views
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/' . $view , $this->data);
        $this->load->view('admin/components/footer');
    }
    
}