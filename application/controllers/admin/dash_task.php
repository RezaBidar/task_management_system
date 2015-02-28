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
            "due_date" => array(
                "field" => "due_time" ,
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
                'priority' => $this->input->post('priority') ,
                'start_time' => convertMyJalaliToGregorian($this->input->post('start_time')) ,
                'due_time' => convertMyJalaliToGregorian($this->input->post('due_time')) , //next year
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
                    'task_id' => $task_id ,
                    'start_time' => $data["start_time"]
                );
                $this->m_duty->save($data) ;
            }
            
            $this->db->trans_complete();
            $this->data["message"] = 'وظیفه با موفقیت ایجاد شد' ;
        }
        
        $this->data["title"] = "اضافه کردن وظیفه" ;
        $group_list = $this->m_group->getUserGroup($this->data["user_id"]) ;
        $this->data["group_list"][""] = "" ;
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
        $this->data["title"] = 'وظایف ایجاد شده توسط شما' ;
        if($group_id == NULL){
            $this->data["table"] = $this->m_group->getUserTable($this->data["user_id"] , NULL , NULL , "admin/dash_task/task_list");
            $this->data["message_info"] = "لطفا گروه مورد نظر را انتخاب کنید" ;
            $view = 'show_list' ;
        }else if($task_id == NULL) {
            $this->data["table"] = $this->m_task->getTableByGroup($group_id , NULL , NULL , "admin/dash_task/task_list/" . $group_id);
            $this->data["message_info"] = "در این قسمت وظیفه های مربوط به گروه {$this->m_group->getGroupName($group_id)} را مشاهده میکنید که توسط شما ایجاد شده" ;
            $view = 'show_list' ;
        }else{
            $this->data["title"] = 'مشاهده وظیفه' ;
            $message_object = $this->m_feedback->getMessage($task_id);
            $this->data["message"] = array();
            foreach ($message_object as $key => $object)
                $this->data["message"][$object->fbk_id] = array(
                    'text' => $object->fbk_text ,
                    'name' => $object->usr_fname . " " . $object->usr_lname ,
                    'time' => $object->fbk_created_time ,
                    'avatar' => $object->usr_avatar ,
                    'warning' => ($object->fbk_type == 0) ? FALSE : TRUE ,
                    'wiw_id' => $object->wiw_id ,
                );
            
            $not_seen_message_object = $this->m_feedback->getNotSeenMessage($task_id);
            $rows = array() ;
            $now = date('Y-m-d H:i:s');
            foreach ($not_seen_message_object as $key => $object){
                $data = array(
                    'feedback_id' => $object->fbk_id ,
                    'user_id' => $this->data["user_id"] ,
                    'time' => $now ,
                );
                array_push($rows , $data) ;   
            }
            if(sizeof($rows) > 0){
                $this->m_who_did_see->insert_batch($rows) ;
            }
            
            $employee_list_object = $this->m_duty->getUserByTaskId($task_id);
            $this->data["employee_list"] = array() ;
            foreach ($employee_list_object as $key => $object)
                $this->data["employee_list"][$object->usr_id] = array(
                    'name' => $object->usr_fname . " " . $object->usr_lname ,
                    'avatar' => $object->usr_avatar ,
                    'duty_id' => $object->dty_id ,
                	'last_activity' => $object->usr_last_login ,
                );
            
            
            
            $task_object = $this->m_task->get_by(array('id' => $task_id) , TRUE);
            $this->data["task"] = array(
                    'id' => $task_object->tsk_id ,
                    'title' => $task_object->tsk_title ,
                    'description' => $task_object->tsk_description ,
                    'status' => $task_object->tsk_status ,
                    'status_changer' => $this->m_user->getUserFullName($task_object->tsk_status_changer) ,
                    'priority' => $task_object->tsk_priority ,
                    'due_time' => jdate('H:i:s  Y/m/d' ,strtotime($task_object->tsk_due_time)) ,
                    'start_time' => jdate('H:i:s  Y/m/d' ,strtotime($task_object->tsk_start_time)),
            		'creator_id' => $task_object->tsk_creator_id ,   
            );
            $view = 'task_view' ;
            
            $this->data["addfeedback_url"] = site_url('admin/dash_task/add_feedback');
            $this->data["changestatus_url"] = site_url('admin/dash_task/change_status');
            $this->data["whodidsee_url"] = site_url('admin/dash_task/who_did_see');
            
            $this->data["wiw_id"] = $this->m_who_is_where->getWiwId($this->data["user_id"] , $group_id) ;
            $this->data["master_wiw_id"] = $this->m_who_is_where->getWiwId($this->data["task"]["creator_id"] , $group_id) ;
            
            
            $master_object = $this->m_user->get($this->data["task"]["creator_id"]) ;
            $this->data["master"] = array(
            		'name' => $master_object->usr_fname . " " . $master_object->usr_lname ,
            		'avatar' => $master_object->usr_avatar ,
            		'last_activity' => $master_object->usr_last_login ,
            );
            
            
            $this->data["task_id"] = $task_id ;
            $this->data["group_id"] = $group_id ;
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
    public function my_duty_list($group_id = NULL){
    
        if($group_id == NULL){
            $this->data["table"] = $this->m_group->getTable(NULL , NULL , "admin/dash_task/my_duty_list");
            //$view = 'show_list' ;
        }else{
            $this->data["table"] = $this->m_duty->getTable(NULL , NULL , "admin/dash_task/task_list/" . $group_id);
        }
        
    
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/show_list' , $this->data);
        $this->load->view('admin/components/footer');
    
    }
    
    /**
     * add feedback by ajax
     */
    public function add_feedback(){
        $task_id = $this->input->post('task_id') ;
        $text = $this->input->post('text') ;
        $type = $this->input->post('type') ;
        $wiw_id = $this->input->post('wiw_id') ;
        if(!(is_numeric($task_id) && strlen($text) > 0)) {
            $this->output->set_status_header('406'); 
            return  ;
        }
        $data = array(
            'task_id' => $task_id ,
            'text' => $text ,
            'wiw_id' => $wiw_id ,
            'type' => $type ,
        );
        $this->m_feedback->save($data) ;
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
    
    public function end_task($task_id){
        $rule = array(
            "status" => array(
                "field" => "status" ,
                "label" => "نام گروه" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "rate" => array(
                "field" => "duty_score[]" ,
                "label" => "امتیاز" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "end_time" => array(
                "field" => "end_time" ,
                "label" => "تاریخ پایان" ,
                "rules" => "required|xss_clean|trim"
            ) 
        
        );
        $this->form_validation->set_rules($rule);
        if($this->form_validation->run() == TRUE){
             
            $data = array(
                'status' => $this->input->post('status') ,
                'end_time' => convertMyJalaliToGregorian($this->input->post('end_time')) ,
                 
            );
        
            
            $this->db->trans_start();
            $task_id = $this->m_task->save($data , $task_id);
        
            foreach ($this->input->post('duty_score') as $duty_id => $rate){
                $data = array(
                    'rate' => $rate ,
                    'end_time' => $data["end_time"]
                );
                $this->m_duty->save($data , $duty_id) ;
            }
        
            $this->db->trans_complete();
            
            redirect('admin/dash_task/my_created_task/' . $this->m_task->getTaskGroupId($task_id));
        }
        
        $employee_list_object = $this->m_duty->getUserByTaskId($task_id);
        foreach ($employee_list_object as $key => $object)
            $this->data["employee_list"][$object->dty_id] = array(
                'name' => $object->usr_fname . " " . $object->usr_lname ,
                'avatar' => $object->usr_avatar ,
            );
        
        $this->data["title"] = 'پایان وظیفه' ;
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/end_task' , $this->data);
        $this->load->view('admin/components/footer');
        
    }
    
    /**
     * page payane dutye yek nafar
     * group_id va task_id baraye redirect shodan niaz ast
     * @param unknown $group_id
     * @param unknown $task_id
     * @param unknown $duty_id
     */
    public function end_duty($group_id , $task_id , $duty_id){
        
        $rule = array(
            "end_time" => array(
                "field" => "end_time" ,
                "label" => "تاریخ پایان" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "duty_id" => array(
                "field" => "duty_id" ,
                "label" => "شماره" ,
                "rules" => "required|xss_clean|trim"
            ) ,
            "rate" => array(
                "field" => "duty_score[{$duty_id}]" ,
                "label" => "امتیاز" ,
                "rules" => "required|xss_clean|trim"
            ) ,
        
        );
        $this->form_validation->set_rules($rule);
        
        if($this->form_validation->run() == TRUE){
            $duty_score = $this->input->post("duty_score") ;    
            $data = array(
                'end_time' => convertMyJalaliToGregorian($this->input->post('end_time')) ,
                'rate' => $duty_score[$duty_id] ,
            );
            $this->m_duty->save($data , $this->input->post('duty_id')) ;
            
            redirect('admin/dash_task/task_list/' . $group_id . '/' . $task_id) ;
        }
        
        $employee = $this->m_duty->getUserByDutyId($duty_id);
        $this->data["title"] = "حذف " . $employee->usr_fname . " " . $employee->usr_lname . " از وظیفه";
        $this->data["duty_id"] = $duty_id ;
        
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/remove_duty' , $this->data);
        $this->load->view('admin/components/footer');
    }
    
    /**
     * liste afradi ke in feedback ro didand + time didan
     * @param int $feedback_id
     */
    public function who_seen_feedbak($feedback_id){
        
    }
    
    /**
     * in tabe baraye ajax esteefade mishavad va felan status ra be halate peygiri taghir midahad ;)
     */
    public function change_status(){
        $data = array(
            'status' => $this->input->post('status') ,
            'status_changer' => $this->data["user_id"] ,
        );
        $task_id = $this->input->post('task_id') ;
        
        $this->m_task->save($data , $task_id);
    }
    
    /**
     * dar in controller employee be task ezafe mishavad
     */
    public function add_employee($task_id){
    	$task = $this->m_task->get($task_id);
    	$now = date('Y-m-d H:i:s');
    	if($this->input->post('submit')){
    		
    		$this->db->trans_start();
    	
    		foreach ($this->input->post('parent_child_id') as $parent_id){
    			$data = array(
    					'task_id' => $task_id ,
    					'parent_child_id' => $parent_id ,
    					'start_time' => $now
    			);
    			$this->m_duty->save($data) ;
    		}
    	
    		$this->db->trans_complete();
    	
    		redirect('admin/dash_task/task_list/' . $task->tsk_group_id . '/' . $task_id);
    		
    	}
    	
    	$this->data["master_id"] = $this->m_who_is_where->getWiwId($this->session->userdata('id') , $task->tsk_group_id);
    	$this->data["membered"] = $this->m_duty->getUserByTask($task_id , $this->data["master_id"]) ;
    	 
    	//var_dump($this->data);
    	$this->load->view('admin/components/header');
    	$this->load->view('admin/components/navbar' , $this->data);
    	$this->load->view('admin/add_employee_to_task' , $this->data);
    	$this->load->view('admin/components/footer');
    }
    
    /**
     * in tabe baraye ajax estefade mishavad va ashkhasi ke feedbak ro dide bashand hamrah ba zamane didan barmigardanand
     */
    public function who_did_see(){
    	$feedback_id = $this->input->post('feedback_id') ;
    	$this->db->join('user' , 'usr_id = wds_user_id');
    	$users = $this->m_who_did_see->get_by(array('feedback_id' => $feedback_id)) ;
    	foreach ($users as $key => $user){
    		echo '<li>' . $user->usr_fname . ' ' . $user->usr_lname . ' -- ' . jdate('H:i:s  Y/m/d' ,strtotime($user->wds_time)) . '</li>' ; 
    	}
    }
    
    /**
     * liste taskha ro mide
     * @param int $group_id
     */
    public function my_tasks($group_id){
        $this->data["title"] = "لیست وظایفی که باید انجام دهم" ;
        $task_object_list = $this->m_duty->getAllUserDuty($this->data["user_id"] , $group_id);
        $data = array();
        foreach ($task_object_list as $key => $task_object){
            $data[$key] = (object) array(
                'tsk_id' => $task_object->tsk_id ,
                'title' => $task_object->tsk_title ,
                'description' => excerpts($task_object->tsk_description),
                'start_time' => jdate('Y-m-d H:i:s' , strtotime($task_object->tsk_start_time)),
                'due_time' => jdate('Y-m-d H:i:s' , strtotime($task_object->tsk_due_time)),
                'creator' => $this->m_user->getUserFullName($task_object->tsk_creator_id),
                'priority' => ($task_object->tsk_priority == 0)? '<span class="label label-info">عادی</span>' : '<span class="label label-danger">مهم</span>' ,
                'status' => ($task_object->tsk_status == 1)? '<span class="label label-warning">در حال پیگیری</span>' : '<span class="label label-default">عدم پیگیری</span>' ,
            );
        }
        $this->data["table"] = $this->m_task->getTableTask($data , NULL , NULL , "admin/dash_task/task_list/" . $group_id) ;
        
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/show_list', $this->data);
        $this->load->view('admin/components/footer');
        
        
    }
    
    
    /**
     * liste taskhaii ke karbar ijad karde va ghaedatan be onvane nazer mibashad
     * @param int $group_id
     */
    public function my_created_task($group_id){
        $this->data["title"] = "لیست وظایفی که من ایجاد کردم" ;
        $this->data["add_url"] = site_url('admin/dash_task/add_task');
        $task_object_list = $this->m_task->getAllUserCreatedTask($this->data["user_id"] , $group_id);
        $data = array();
        foreach ($task_object_list as $key => $task_object){
            $data[$key] = (object) array(
                'tsk_id' => $task_object->tsk_id ,
                'title' => $task_object->tsk_title ,
                'description' => excerpts($task_object->tsk_description),
                'start_time' => jdate('Y-m-d H:i:s' , strtotime($task_object->tsk_start_time)),
                'due_time' => jdate('Y-m-d H:i:s' , strtotime($task_object->tsk_due_time)),
                'creator' => $this->m_user->getUserFullName($task_object->tsk_creator_id),
                'priority' => ($task_object->tsk_priority == 0)? '<span class="label label-info">عادی</span>' : '<span class="label label-danger">مهم</span>' ,
                'status' => ($task_object->tsk_status == 1)? '<span class="label label-warning">در حال پیگیری</span>' : '<span class="label label-default">عدم پیگیری</span>' ,
            );
        }
        $this->data["table"] = $this->m_task->getTableTask($data , NULL , NULL , "admin/dash_task/task_list/" . $group_id) ;
        
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/show_list', $this->data);
        $this->load->view('admin/components/footer');
        
    }
}