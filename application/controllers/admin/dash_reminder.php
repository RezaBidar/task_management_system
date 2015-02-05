<?php 
class dash_reminder extends Admin_Controller{
    
    public function __construct(){
        parent::__construct() ;
        
        $this->load->model('m_user') ;
        $this->load->model('m_reminder') ;
    }
    
    
    public function add_reminder(){
        
        $rule = array(
            "type" => array(
                "field" => "type" ,
                "label" => "نوع" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "start_date" => array(
                "field" => "start_time" ,
                "label" => "تاریخ شروع" ,
                "rules" => "required|xss_clean|trim"
            ),
            "duration" => array(
                "field" => "duration" ,
                "label" => "مدت" ,
                "rules" => "required|xss_clean|trim"
            ),
            "title" => array(
                "field" => "title" ,
                "label" => "عنوان" ,
                "rules" => "required|xss_clean|trim"
            ),
            "text" => array(
                "field" => "text" ,
                "label" => "متن" ,
                "rules" => "required|xss_clean|trim"
            ),
            
        );
        $this->form_validation->set_rules($rule);
        if($this->form_validation->run() == TRUE){
            $data = array(
                'type' => $this->input->post('type') ,
                'start_time' => date('Y-m-d H:i:s') ,
                'duration' => $this->input->post('duration') ,
                'title' => $this->input->post('title') ,
                'text' => $this->input->post('text') ,
               
            );
        
            //remove empty indexes  .. in faghat vase insert estefade mishavad va shayad dar ayande asan hazfesh kardam :D
            foreach ($data as $key => $val) if(strlen($val) == 0) unset($data[$key]) ;
        
            $this->m_reminder->save($data);
            //             redirect('admin/dashboard');
            echo $this->db->last_query();
        }
        
        $this->data["title"] = "اضافه کردن یادآوری" ;
        
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/add_reminder' , $this->data);
        $this->load->view('admin/components/footer');
    }
    
    public function reminder_list($reminder_id = NULL , $group_id = NULL){
        
        if($reminder_id == NULL){
            
        }elseif($group_id == NULL){
            
        }else{
            
        }
    }
    
}