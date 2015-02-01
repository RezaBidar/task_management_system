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
    
}