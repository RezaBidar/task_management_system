<?php
class dash_comment extends Admin_Controller{

	public function __construct(){
		parent::__construct() ;

		$this->load->model('m_comment') ;
		$this->load->model('m_user') ;
	}
	
	public function add_comment(){

		$rule = array(
				"title" => array(
						"field" => "title" ,
						"label" => "عنوان" ,
						"rules" => "required|xss_clean|trim"
				) ,
				"text" => array(
						"field" => "text" ,
						"label" => "متن" ,
						"rules" => "required|xss_clean|trim"
				),
		
		);
		$this->form_validation->set_rules($rule);
		if($this->form_validation->run() == TRUE){
			$data = array(
					'title' => $this->input->post('title') ,
					'text' => $this->input->post('text') ,
					 
			);
		
		
			$this->m_comment->save($data);
			$this->data["message"] = 'نظر شما با موفقیت ثبت شد' ;
		}
		
		$this->data["title"] = "نظرات و پیشنهادات" ;
		
		$this->load->view('admin/components/header');
		$this->load->view('admin/components/navbar' , $this->data);
		$this->load->view('admin/add_comment' , $this->data);
		$this->load->view('admin/components/footer');
		
	}
	
	public function view_comment($comment_id = NULL){
		if($comment_id == NULL){
			$this->data["table"] = $this->m_comment->getTable('admin/dash_comment/view_comment');
			$view = 'show_list' ;
		}else{
			$comment_object = $this->m_comment->get($comment_id);
			$this->data["comment"] = array(
				'title' => $comment_object->cmt_title ,
				'text' => $comment_object->cmt_text ,
				'creator' => $this->m_user->getUserFullName($comment_object->cmt_creator_id) ,
				'time' => jdate('Y-m-d H:i:s' , strtotime($comment_object->cmt_created_time)) , 	
			);
			$view = 'view_comment' ;
		}
		

		$this->load->view('admin/components/header');
		$this->load->view('admin/components/navbar' , $this->data);
		$this->load->view('admin/'.$view , $this->data);
		$this->load->view('admin/components/footer');
	}
}