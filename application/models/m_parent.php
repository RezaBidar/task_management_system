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
}

?>