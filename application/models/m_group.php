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
    
    /**
     * jadvale table haii ra miavarad ke dar an karbar ozv bashad
     * @param string $update_url
     * @param string $delete_url
     * @param string $select_url
     * @return string
     */
    public function getUserTable($user_id ,$update_url = NULL , $delete_url = NULL , $select_url = NULL){
    
        $table = new My_Table() ;
    
        $thead = array(
            'نام',
            'توضیحات',
        );
        $tbody = array(
            'grp_name' ,
            'grp_description'
        );
        
        $data = $this->getUserGroup($user_id);

    
        return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
    }
    
    /**
     * liste groohaii ke karbar dar an ozv hast ra barmigardanad
     */
     public function getUserGroup($user_id){
        $this->db->join('who_is_where' , 'wiw_group_id = grp_id');
        $this->db->where('wiw_user_id' , $user_id);
        $this->db->where('wiw_end_date IS NULL' , NULL , FALSE) ;
        return $this->get() ;
     }
     
     /**
      * name grooh ra bar migardanad
      * @param int $group_id
      */
     public function getGroupName($group_id){
         $data = $this->get($group_id);
         if($data == NULL) return NULL ; 
         return $data->grp_name ;
     }

}

?>