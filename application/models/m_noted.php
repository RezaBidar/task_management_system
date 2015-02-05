<?php

class m_noted extends MY_Model{

    protected $_table_name = 'noted' ;
    protected $_prefix = 'ntd_' ;
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
    
}

?>