<?php

class m_group extends MY_Model
{
    protected $_table_name = 'group' ;
    protected $_prefix = 'grp_' ;
    protected $_primary_key = 'grp_id';
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
    
    
    /**
     * 
     * @param string $update_url
     * @param string $delete_url
     * @param string $select_url
     * @return string
     */
    public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
		
        $table = new My_Table() ;
		
        $thead = array(
				'نام',
				'توضیحات',
		);
		$tbody = array(
		    'grp_name' ,
		    'grp_description'
		);
		
		$data = $this->get() ;
		
		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
    }
}

?>