<?php

class m_reminder extends MY_Model{

    protected $_table_name = 'reminder' ;
    protected $_prefix = 'rmd_' ;
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
    
}

?>