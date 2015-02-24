<?php
class m_comment extends MY_Model{

    protected $_table_name = 'comment' ;
    protected $_prefix = 'cmt_' ;
    protected $_primary_key = 'cmt_id' ;
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    
    /**
     *
     * @param string $select_url
     * @return string
     */
    public function getTable($select_url = NULL){
    
    	$table = new My_Table() ;
    
    	$thead = array(
    			'عنوان',
    			'تاریخ' ,
    			'فرستنده'
    	);
    	$tbody = array(
    			'cmt_title' ,
    			'cmt_created_time' ,
    			'cmt_creator_id'
    	);
    
    	$data = $this->get() ;
    	
    	return $table->getView($thead, $tbody, $this->_primary_key, $data , NULL, NULL , $select_url );
    }
    
}
?>