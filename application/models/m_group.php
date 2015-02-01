<?php

class m_group extends MY_Model
{
    protected $_table_name = 'group' ;
    protected $_prefix = 'grp_' ;
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
}

?>