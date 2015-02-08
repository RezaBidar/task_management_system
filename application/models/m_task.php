<?php
class m_task extends MY_Model{
    
    protected $_table_name = 'task' ;
    protected $_prefix = 'tsk_' ;
    protected $_primary_key = 'tsk_id' ;
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
}

?>