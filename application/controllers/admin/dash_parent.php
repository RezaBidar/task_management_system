<?php
class dash_parent extends Admin_Controller{

    public function __construct(){
        parent::__construct() ;

        $this->load->model('m_parent') ;
        $this->load->model('m_group') ;
        $this->load->model('m_user') ;
        $this->load->model('m_who_is_where') ;

    }
    
    /**
     * 
     * @param string $group_id
     * @param string $user_id
     */
    public function add_parent($group_id = NULL , $master_id = NULL){
        
        $view = NULL ;// esme view ke bayad load beshe
        
        //agar group id set nashode bashad liste groupHa namayesh dasde mishavad ta yeki ra entekhab konad
        if($group_id == NULL){
            $this->data["table"] = $this->m_group->getTable(NULL , NULL , "admin/dash_parent/add_parent");
            $view = 'show_list' ;
        }else if ($master_id == NULL){
            $this->data["table"] = $this->m_user->getTable($group_id , NULL , NULL , "admin/dash_parent/add_parent/" . $group_id);
            $view = 'show_list' ;
        }else {
            $this->data["master_id"] = $this->m_who_is_where->getWiwId($master_id , $group_id) ; 
            $this->data["group_id"] = $group_id ;
            $this->data["membered"] = $this->m_user->getUserByParent($group_id , $this->data["master_id"] , 'member') ;
            $this->data["not_membered"] = $this->m_user->getUserByParent($group_id , $this->data["master_id"]) ;
            $this->data["add_url"] = base_url('admin/dash_parent/add_to_parent/');
            $this->data["remove_url"] = base_url('admin/dash_parent/delete_from_parent/');
            $view = 'add_parent' ;
        }
        
        //load views
        $this->load->view('admin/components/header');
        $this->load->view('admin/components/navbar' , $this->data);
        $this->load->view('admin/' . $view , $this->data);
        $this->load->view('admin/components/footer');
    }
    
    /**
     * dar table parent radife ba $user_id va $masater_id ra delete mikonad
     * @param string $master_id
     * @param string $user_id
     */
    public function delete_from_parent($master_id , $user_id){

        $where = array(
            'employee_id' => $user_id ,
            'master_id' => $master_id
        );
        $row = $this->m_parent->get_by($where , TRUE) ;
    
        if(!is_object($row)) return ;
    
        if($this->m_parent->delete($row->prt_id)){
            echo "deleted" ;
        }else{
            echo "not deleted" ;
        }
    
    }
    
    /**
     * dar table parent radifi ba $master_id va $user_id ezafe mikonad
     * @param string $master_id
     * @param string $user_id
     */
    public function add_to_parent($master_id , $user_id){
        
//         $where = array(
//             'employee_id' => $user_id ,
//             'master_id' => $master_id
//         );
//         $row = $this->m_parent->get_by($where , TRUE) ;
        
//         if(is_object($row)) return ;
        
        
        $data = array(
            'employee_id' => $user_id ,
            'master_id' => $master_id ,
            'start_date' => date('Y-m-d H:i:s')
        );
        $insert_id = $this->m_parent->save($data) ;
        echo $insert_id ;
    }
}