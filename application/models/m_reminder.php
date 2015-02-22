<?php

class m_reminder extends MY_Model{

    protected $_table_name = 'reminder' ;
    protected $_prefix = 'rmd_' ;
    protected $_primary_key = 'rmd_id' ;
    
    protected $_timestamp = TRUE ;
    protected $_creator_id = TRUE ;
    protected $_creator_ip = TRUE ;
    protected $_modifier_id = TRUE ;
    protected $_modifier_ip = TRUE ;
    
    
    
    public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
        $table = new My_Table() ;
        
        $thead = array(
            'عنوان',
            'متن',
        );
        $tbody = array(
            'rmd_title' ,
            'rmd_text'
        );
        
        $where = array(
            "creator_id" => $this->session->userdata('id'),  
        );
        $data = $this->get_by($where) ;
        
        
        return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
    }
    
    
    /**
     * age alan reminder bayad namayesh dade beshe true barmigardoone dar gheyre insoorat false
     */
    public function isReminderTime($reminder_object){
        $type = $reminder_object->rmd_type ; // fixed 0 - daily 1 - weekly 2 - monthly 3
        $duration = $reminder_object->rmd_duration ;
        
        //tarikhHa ro tooye araye split mikonim :D
        $now = preg_split('/[ \:\-]/ ', date('Y-m-d H:i:s'));
        $reminder_start_time = preg_split('/[ \:\-]/ ', $reminder_object->rmd_start_time);
        $reminder_end_time = $reminder_start_time;
        
        $reminder_week = date('w' , strtotime($reminder_object->rmd_start_time)) ;
        $now_week = date('w' , time()) ;
        
        //age duration az shab rad mikone 
        if($reminder_end_time[3] + $duration > 23) {
            $reminder_end_time[3] = 23 ; 
            $reminder_end_time[4] = 59 ;
            $reminder_end_time[5] = 59 ;
        }else {
            $reminder_end_time[3] = $reminder_end_time[3] + $duration ;
        }
        
        //age time shoroo az alan bishtar bashe .. ke albate in etefagh rokh nemide chon moghe query zadan lahaz shode
        if($this->greaterTime($reminder_start_time , $now)) return  FALSE ; 
        
        
        switch ($type){
            case 0 ://fixed    
                return TRUE ;
                break ;
            case 1 ://daily
                if($this->greaterTime($now, $reminder_start_time , 3) && $this->greaterTime($reminder_end_time, $now , 3)) return TRUE ;
                break;
            case 2 ://weekly
                if($reminder_week == $now_week && $this->greaterTime($now, $reminder_start_time , 3) && $this->greaterTime($reminder_end_time, $now , 3)) return TRUE ;
                break;
            case 3 ://monthly
                if($reminder_start_time[2] == $now[2] && $this->greaterTime($now, $reminder_start_time , 3) && $this->greaterTime($reminder_end_time, $now , 3)) return TRUE ;
                break;       
        }
        
        return FALSE ;
        
    }
    
    
    /**
     * if higher is bigger or equal return true else return false
     * chon formate arraye 0->sal ... 5->sanie ast -
     *  -mitavanim ba set kardan end va start faghat yek bazeye khas az parametrha ro morede barrasi gharar dahim
     * @param array $higher
     * @param array $lower
     * @param integer $offset
     * @return bool
     * @access private
     */
    private function greaterTime($higher , $lower , $start = 0 , $end = 5){
        for($i = $start ; $i <= $end ; $i++){
            if ($higher[$i] > $lower[$i]) return TRUE ;
            if ($higher[$i] < $lower[$i]) return FALSE ;
        }
        return TRUE ;// equal 
    }
    
    
    
}

?>