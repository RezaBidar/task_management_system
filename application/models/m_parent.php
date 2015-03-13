<?php

class m_parent extends MY_Model{
    
    protected $_table_name = 'parent' ;
    protected $_prefix = 'prt_' ;
    protected $_primary_key = 'prt_id';
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
    
    /**
     * 
     * @param unknown $master_wiw_id
     */
    public function getUserByMasterWiwId($master_wiw_id) {
       
        $this->db->join('who_is_where' , 'prt_employee_id = wiw_id') ;
        $this->db->join('user' , 'wiw_user_id = usr_id') ;
        
        $where = array(
            "master_id" => $master_wiw_id
        );
        
        return $this->get_by($where) ;
        
       
    }
    
    /**
     * check mikone in user daraye zir majmooe dar in grooh mibashad ya kheyr
     * @param int $wiw_id
     * @return boolean
     */
    public function hasChild($wiw_id){
        $this->db->where('prt_master_id' , $wiw_id);
        $employees = $this->get();
        if(sizeof($employees) > 0) return TRUE ;
        return FALSE ;
    }
}

?>