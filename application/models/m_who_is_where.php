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
    
    /** 
     * liste groohai ra ke karbar dar an ast ra barmigardanad
     * @param integer $user_id
     * @return array 
     */
    public function wichGroupUserAdded($user_id){
        
        $this->db->join('group' , 'grp_id = wiw_group_id');
        
        $this->db->where('wiw_user_id' , $user_id);
        $this->db->where('wiw_end_date IS NULL' , NULL , FALSE) ;
        
        $group_list_object = $this->get();
        $group_list = array() ;
        foreach($group_list_object as $key => $group){
            $group_list[$group->wiw_group_id] = $group->grp_name ;
        }
        return $group_list ;
    }
    
}

?>