<?php
class m_who_is_where extends MY_Model{
    
    protected $_table_name = 'who_is_where' ;
    protected $_prefix = 'wiw_' ;
    protected $_primary_key = 'wiw_id';
    
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
    
    /**
     * 
     * @param string $user_id
     * @param string $group_id
     * @return string
     */
    public function  getWiwId($user_id , $group_id){
        $where = array(
            'user_id' => $user_id ,
            'group_id' => $group_id
        ) ;
        
        return $this->get_by($where , TRUE)->wiw_id ;
    }
    
}

?>