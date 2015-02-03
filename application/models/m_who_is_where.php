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
    
}

?>