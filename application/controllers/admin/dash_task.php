<?php 
class dash_task extends Admin_Controller{
    
    public function __construct(){
        parent::__construct() ;
        
        $this->load->model('m_user') ;
        $this->load->model('m_task') ;
        $this->load->model('m_group') ;
        $this->load->model('m_duty') ;
        $this->load->model('m_feedback') ;
        $this->load->model('m_who_is_where') ;
        $this->load->model('m_who_did_see') ;
        $this->load->model('m_parent') ;
    }
    
    
    public function add_task(){
        
        $rule = array(
            "group_id" => array(
                "field" => "group_id" ,
                "label" => "نام گروه" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "employee_prt_id" => array(
                "field" => "employee_prt_id[]" ,
                "label" => "کار رو کی انجام بده" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "priority" => array(
                "field" => "priority" ,
                "label" => "درجه اهمیت" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "start_date" => array(
                "field" => "start_time" ,
                "label" => "تاریخ شروع" ,
                "rules" => "required|xss_clean|trim"
            ),
            "end_date" => array(
                "field" => "end_time" ,
                "label" => "تاریخ پایان" ,
                "rules" => "required|xss_clean|trim"
            ),
            "warning_date" => array(
                "field" => "warning_date" ,
                "label" => "چند ساعت قبل آلارم بده" ,
                "rules" => "required|xss_clean|trim"
            ),
            "title" => array(
                "field" => "title" ,
                "label" => "عنوان" ,
                "rules" => "required|xss_clean|trim"
            ),
            "description" => array(
                "field" => "description" ,
                "label" => "توضیحات" ,
                "rules" => "required|xss_clean|trim"
            ),
            
        );
        $this->form_validation->set_rules($rule);
        if($this->form_validation->run() == TRUE){
           
            $data = array(
                'group_id' => $this->input->post('group_id') ,
                'priority' => $this->input->post('pariority') ,
                'start_time' => date('Y-m-d H:i:s') ,
                'end_time' => date('Y-m-d H:i:s', strtotime('+1 year')) , //next year
                'warning_date' => $this->input->post('warning_date') ,
                'title' => $this->input->post('title') ,
                'description' => $this->input->post('description') ,
               
            );
        
            //remove empty indexes  .. in faghat vase insert estefade mishavad va shayad dar ayande asan hazfesh kardam :D
            foreach ($data as $key => $val) if(strlen($val) == 0) unset($data[$key]) ;
        
            $this->db->trans_start();
            $task_id = $this->m_task->save($data);
            
            foreach ($this->input->post('employee_prt_id') as $parent_id){
                $data = array(
                    'parent_child_id' => $parent_id ,
                    'task_id' => $task_id
                );
                $this->m_duty->save($data) ;
            }
            
            $this->db->trans_complete();
//             redirect('admin/dashboard');
//             echo $this->db->last_query();
        }
        
        $this->data["title"] = "اضافه کردن وظیفه" ;
        $group_list = $this->m_group->get() ;
        foreach ($group_list as $key => $val){
            $this->data["group_list"][$val->grp_id] = $val->grp_name ;
        }
        
        $this->data["users_url"] = site_url("admin/dash_task/get_my_employee_by_group");
        
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/add_task' , $this->data);
        $this->load->view('admin/components/footer');
    }
    
    
    /**
     * baraye ajax estefade mishe
     * @param int $group_id
     */
    public function get_my_employee_by_group($group_id){
        $master_wiw_id = $this->m_who_is_where->getWiwId($this->session->userdata('id') , $group_id) ;
        $data = $this->m_parent->getUserByMasterWiwId($master_wiw_id) ;
        
        $answer = array() ;
        foreach ($data as $key => $val){
            $answer[$val->prt_id] = $val->usr_fname . " " . $val->usr_lname ;    
        }
        
        echo json_encode($answer) ;
    }
    
    /**
     * didane taskhaii ke ijad shode
     * @param int $group_id
     */
    public function task_list($group_id = NULL , $task_id = NULL){
        
        if($group_id == NULL){
            $this->data["table"] = $this->m_group->getTable(NULL , NULL , "admin/dash_task/task_list");
            $view = 'show_list' ;
        }else if($task_id == NULL) {
            $this->data["table"] = $this->m_task->getTableByGroup($group_id , NULL , NULL , "admin/dash_task/task_list/" . $group_id);
            $view = 'show_list' ;
        }else{
            $this->data["seen_message"] = $this->m_feedback->getSeenMessage($task_id);
            $this->data["not_seen_message"] = $this->m_feedback->getNotSeenMessage($task_id);
            
            $this->data["employee_list"] = $this->m_duty->getUserByTaskId($task_id);
            
            
            $task_object = $this->m_task->get_by(array('id' => $task_id) , TRUE);
            $this->data["task"] = array(
                    'id' => $task_object->tsk_id ,
                    'title' => $task_object->tsk_title ,
                    'description' => $task_object->tsk_description    
            );
            $view = 'task_view' ;
        }
        
        //load views
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/' . $view , $this->data);
        $this->load->view('admin/components/footer');
    }
    
    /**
     * baraye ezafe kardane karbar be task
     * @param string $task_id
     * @param string $group_id
     */
    public function add_duty($task_id = NULL , $group_id = NULL){
        $view = NULL ;
    
        if($task_id == NULL){
            $this->data["table"] = $this->m_task->getTable(NULL , NULL , "admin/dash_task/add_duty");
            $view = 'show_list' ;
        }elseif($group_id == NULL){
            $this->data["table"] = $this->m_group->getTable(NULL , NULL , "admin/dash_task/add_duty/" . $task_id);
            $view = 'show_list' ;
        }else {
            $this->data["task_id"] = $task_id ;
            $this->data["master_id"] = $this->m_who_is_where->getWiwId($this->session->userdata('id') , $group_id);
            $this->data["membered"] = $this->m_user->getUserByDuty($task_id , $this->data["master_id"] , 'member') ;
            $this->data["not_membered"] = $this->m_user->getUserByDuty($task_id , $this->data["master_id"]) ;
            $this->data["add_url"] = base_url('admin/dash_task/add_to_duty/');
            $this->data["remove_url"] = base_url('admin/dash_task/delete_from_duty/');
            $view = 'add_duty' ;
        }
    
    
        //load views
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/' . $view , $this->data);
        $this->load->view('admin/components/footer');
    }
    
    /**
     * 
     * @param unknown $task_id
     * @param unknown $parent_id
     */
    public function delete_from_duty($task_id , $parent_id){
    
        $where = array(
            'parent_child_id' => $parent_id ,
            'task_id' => $task_id
        );
        $row = $this->m_duty->get_by($where , TRUE) ;
    
        if(!is_object($row)) return ;
    
        if($this->m_duty->delete($row->dty_id)){
            echo "deleted" ;
        }else{
            echo "not deleted" ;
        }
    
    }
    
    /**
     * 
     * @param unknown $task_id
     * @param unknown $parent_id
     */
    public function add_to_duty($task_id , $parent_id){
    
        $data = array(
            'parent_child_id' => $parent_id ,
            'task_id' => $task_id
        );
        $insert_id = $this->m_duty->save($data) ;
        echo $insert_id ;
    }
    
    /**
     * show my tasks ,,, task haii ke be in karbar elsagh shode ast
     */
    public function my_duty_list(){
    
        $this->data["table"] = $this->m_duty->getTable();
    
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/show_list' , $this->data);
        $this->load->view('admin/components/footer');
    
    }
    
    /**
     * ijade task baraye khod
     */
    public function add_my_task(){
        
    }
    
    /**
     * task haii ke afrade zirmajmooe ijad kardand va niaz be taiid darad
     */
    public function need_accept_task(){
        
    }
    
}