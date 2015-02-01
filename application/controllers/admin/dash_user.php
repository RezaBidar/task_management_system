<?php
class dash_user extends Admin_Controller{
    
    public function __construct(){
        parent::__construct() ;
        $this->load->model('m_user') ;
    }
    
    public function add_user(){
        $rule = array(
            "employee_id" => array(
                "field" => "employee_id" ,
                "label" => "کد پرسنلی" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "fname" => array(
                "field" => "fname" ,
                "label" => "نام" ,
                "rules" => "required|xss_clean|trim"
            ),
            "lname" => array(
                "field" => "lname" ,
                "label" => "نام خانوادگی" ,
                "rules" => "required|xss_clean|trim"
            ),
            "username" => array(
                "field" => "username" ,
                "label" => "نام کاربری" ,
                "rules" => "xss_clean|trim"
            ),
            "password" => array(
                "field" => "password" ,
                "label" => "کلمه عبور" ,
                "rules" => "xss_clean|trim"
            ),
            "email" => array(
                "field" => "email" ,
                "label" => "ایمیل" ,
                "rules" => "xss_clean|trim"
            ),
            "gender" => array(
                "field" => "gender" ,
                "label" => "جنسیت" ,
                "rules" => "required|xss_clean|trim"
            ),
            "tel" => array(
                "field" => "tel" ,
                "label" => "شماره تلفن" ,
                "rules" => "xss_clean|trim"
            ),
            "mobile" => array(
                "field" => "mobile" ,
                "label" => "شماره موبایل" ,
                "rules" => "xss_clean|trim"
            ),
            "address" => array(
                "field" => "address" ,
                "label" => "آدرس" ,
                "rules" => "xss_clean|trim"
            ),
            "avatar" => array(
                "field" => "avatar" ,
                "label" => "عکس" ,
                "rules" => "xss_clean|trim"
            ),
            "type" => array(
                "field" => "type" ,
                "label" => "نوع کارمند" ,
                "rules" => "required|xss_clean|trim"
            )
        );
         $this->form_validation->set_rules($rule);
        if($this->form_validation->run() == TRUE){
            $data = array(
                'employee_id' => $this->input->post('employee_id') ,
                'fname' => $this->input->post('fname') ,
                'lname' => $this->input->post('lname') ,
                'username' => $this->input->post('username') ,
                'password' => $this->m_user->hash( $this->input->post('password') ) ,
                'email' => $this->input->post('email') ,
                'gender' => $this->input->post('gender') ,
                'tel' => $this->input->post('tel') ,
                'mobile' => $this->input->post('mobile') ,
                'address' => $this->input->post('address') ,
                'type' => $this->input->post('type') ,
            );
            
            //remove empty indexes  .. in faghat vase insert estefade mishavad va shayad dar ayande asan hazfesh kardam :D
            foreach ($data as $key => $val) if(strlen($val) == 0) unset($data[$key]) ; 
            
            $this->m_user->save($data);
//             redirect('admin/dashboard');
            echo $this->db->last_query();
        }
        
        
        $this->data["title"] = "اضافه کردن کارمند" ;
        
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/add_user' , $this->data);
        $this->load->view('admin/components/footer');
    }
    
}