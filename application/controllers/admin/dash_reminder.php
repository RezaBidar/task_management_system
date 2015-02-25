<?php 
class dash_reminder extends Admin_Controller{
    
    public function __construct(){
        parent::__construct() ;
        
        $this->load->model('m_user') ;
        $this->load->model('m_reminder') ;
        $this->load->model('m_group') ;
        $this->load->model('m_noted') ;
        $this->load->model('m_who_is_where') ;
    }
    
    
    public function add_reminder(){
        
        $rule = array(
            "type" => array(
                "field" => "type" ,
                "label" => "نوع" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "start_time" => array(
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
                'start_time' => convertMyJalaliToGregorian($this->input->post('start_time')) ,
                'duration' => $this->input->post('duration') ,
                'title' => $this->input->post('title') ,
                'text' => $this->input->post('text') ,
               
            );
        
            //remove empty indexes  .. in faghat vase insert estefade mishavad va shayad dar ayande asan hazfesh kardam :D
            foreach ($data as $key => $val) if(strlen($val) == 0) unset($data[$key]) ;
        
            $this->m_reminder->save($data);
            //             redirect('admin/dashboard');
            //echo $this->db->last_query();
            $this->data["message"] = 'یاداوری با موفقیت ایجاد شد' ;
        }
        
        $this->data["title"] = "اضافه کردن یادآوری" ;
        
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/add_reminder' , $this->data);
        $this->load->view('admin/components/footer');
    }
    
    public function add_noted($reminder_id = NULL , $group_id = NULL){
        $view = NULL ;
        $this->data["title"] = "انتصاب یاداوری به شخص" ;
        if($reminder_id == NULL){
            $this->data["table"] = $this->m_reminder->getTable(NULL , NULL , "admin/dash_reminder/add_noted");
            $this->data["message_info"] = 'لطفا از لیست یاداوری ها یاداوری مورد نظر را انتخاب کنید';
            $view = 'show_list' ;
        }elseif($group_id == NULL){
            $this->data["table"] = $this->m_group->getUserTable($this->data["user_id"] , NULL , NULL , "admin/dash_reminder/add_noted/" . $reminder_id);
            $this->data["message_info"] = 'لطفا گروه مربوطه را انتخاب کنید و در مرحله بعد اشخاص مورد نظر را انتخاب کنید';
            $view = 'show_list' ;
        }else {
            $this->data["message_info"] = "در این قسمت می توانید یاداوری مربوطه را به اشخاصی که در سیستم زیر مجموعه شما  و در گروه {$this->m_group->getGroupName($group_id)} عضو می باشند را انتصاب دهید و یا  از یاداوری حذف کنید ";
            $this->data["reminder_id"] = $reminder_id ;
            $this->data["master_id"] = $this->m_who_is_where->getWiwId($this->session->userdata('id') , $group_id);
            $this->data["membered"] = $this->m_user->getUserByNoted($reminder_id , $this->data["master_id"] , 'member') ;
            $this->data["not_membered"] = $this->m_user->getUserByNoted($reminder_id , $this->data["master_id"]) ;
            $this->data["add_url"] = base_url('admin/dash_reminder/add_to_noted/');
            $this->data["remove_url"] = base_url('admin/dash_reminder/delete_from_noted/');
            $view = 'add_noted' ;    
        }
        

        //load views
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/' . $view , $this->data);
        $this->load->view('admin/components/footer');
    }
    
    /**
     * 
     * @param unknown $reminder_id
     * @param unknown $parent_id
     */
    public function delete_from_noted($reminder_id , $parent_id){
    
        $where = array(
            'parent_child_id' => $parent_id ,
            'reminder_id' => $reminder_id
        );
        $row = $this->m_noted->get_by($where , TRUE) ;
    
        if(!is_object($row)) return ;
    
        if($this->m_noted->delete($row->ntd_id)){
            echo "deleted" ;
        }else{
            echo "not deleted" ;
        }
    
    }
    
    /**
     * 
     * @param unknown $reminder_id
     * @param unknown $parent_id
     */
    public function add_to_noted($reminder_id , $parent_id){
    
        $data = array(
            'parent_child_id' => $parent_id ,
            'reminder_id' => $reminder_id 
        );
        $insert_id = $this->m_noted->save($data) ;
        echo $insert_id ;
    }
    
    /**
     * show my reminder ,,, reminder haii ke be in karbar elsagh shode ast
     */
    public function my_reminder_list(){
        
        $this->data["table"] = $this->m_noted->getTable();
        
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/show_list' , $this->data);
        $this->load->view('admin/components/footer');
        
    }
    
    
}