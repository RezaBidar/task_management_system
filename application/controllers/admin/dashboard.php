<?php 
class Dashboard extends Admin_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('m_who_is_where');
        $this->load->model('m_duty');
        $this->load->model('m_task');
    }
    
    public function index(){
        $this->data["menu"]["خانه"]["active"] = TRUE ;
		$this->load->view('admin/components/header');
		$this->load->view('admin/components/navbar' , $this->data);
		$this->load->view('admin/home' );
		$this->load->view('admin/components/footer');
    }
    
    
    public function overview(){
        //liste reminder ha
        $data = array();
        $groups = $this->m_who_is_where->wichGroupUserAdded($this->data["user_id"]);
        foreach($groups as $group_id => $group_name){
            $data[$group_id] = array(
                'group_name' => $group_name ,
                'my_on_process_duty' => 0 ,
                'my_not_started_duty' => 0 ,
                'created_on_process_task' => 0 ,
                'created_not_started_task' => 0 ,
                    
            );
            $task_object_list = $this->m_duty->getAllUserDuty($this->data["user_id"] , $group_id);
            foreach ($task_object_list as $key => $task_object){
                if($task_object->tsk_status == 1) $data[$group_id]["my_on_process_duty"]++ ;
                if($task_object->tsk_status == 0) $data[$group_id]["my_not_started_duty"]++ ;
            }
            
            $task_object_list = $this->m_task->getAllUserCreatedTask($this->data["user_id"] , $group_id);
            foreach ($task_object_list as $key => $task_object){
                if($task_object->tsk_status == 1) $data[$group_id]["created_on_process_task"]++ ;
                if($task_object->tsk_status == 0) $data[$group_id]["created_not_started_task"]++ ;
            }
            
            
             
        }
        var_dump($data);
        //
    }
    
    public function logout(){
        $this->m_user->logout();
        redirect('login');
    }
}