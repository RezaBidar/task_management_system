<?php
class dash_group extends Admin_Controller{
    
    public function __construct(){
        parent::__construct() ;
        
        $this->load->model('m_group') ;
        
    }
    
    public function add_group(){
        $rule = array(
            "name" => array(
                "field" => "name" ,
                "label" => "نام" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "description" => array(
                "field" => "description" ,
                "label" => "توضیحات" ,
                "rules" => "xss_clean|trim"
            )
        );
        $this->form_validation->set_rules($rule);
        if($this->form_validation->run() == TRUE){
            $data = array(
                'name' => $this->input->post('name') ,
                'description' => $this->input->post('description')
            );
        
            //remove empty indexes  .. in faghat vase insert estefade mishavad va shayad dar ayande asan hazfesh kardam :D
            foreach ($data as $key => $val) if(strlen($val) == 0) unset($data[$key]) ;
        
            $this->m_group->save($data);
            //             redirect('admin/dashboard');
            echo $this->db->last_query();
        }
        
        
        
        $this->data["title"] = "اضافه کردن گروه" ;
        
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/add_group' , $this->data);
        $this->load->view('admin/components/footer');
    }
    

    /**
     * 
     * @param string $group_id
     */
    public function add_employee($group_id = NULL){
        $view = NULL ;// esme view ke bayad load beshe 
        
        //agar group id set nashode bashad liste groupHa namayesh dasde mishavad ta yeki ra entekhab konad
        if($group_id == NULL){
            $this->data["table"] = $this->m_group->getTable(NULL , NULL , "admin/dash_group/add_employee");
            $view = 'show_list' ;
        }else {
            $this->data["group_id"] = $group_id ;
            $view = 'add_to_group' ;
        }
        
        //load views
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/' . $view , $this->data);
        $this->load->view('admin/components/footer');
    }
    
    /**
     * 
     * @param string $group_id
     * @param string $member
     * @param string $employee_id
     */
    public function get_employee($group_id , $member = '' , $employee_id = ''){
        
        $result = $this->m_user->getUserByGroup($group_id , $member , $employee_id);
        //echo $this->db->last_query();
        $answer = array() ;
        foreach($result as $key => $val){
            $answer[$val->usr_id] = array(
                'employee_id' => $val->usr_employee_id ,
                'name' => $val->usr_fname . ' ' . $val->usr_lname 
            );
        }
        echo json_encode($answer) ;
    }
    
}