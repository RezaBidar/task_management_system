<?php
class m_who_did_see extends MY_Model{
    protected $_table_name = 'who_did_see' ;
    protected $_prefix = 'wds_' ;
    protected $_primary_key = 'wds_id';
    
    protected $_creator_ip = TRUE ;
    
    /**
     * user haii ke in feedback ro didand
     * @param int $feedback_id
     * @return array
     */
    public function getUsers($feedback_id){
        $this->db->join('user') ;
        $data = $this->get_by(array('feedback_id' => $feedback_id)) ;
        $asnwer = array();
        foreach ($data as $key => $user){
            $answer[$user->usr_id]["name"] = $user->usr_fname . " " . $user->usr_lname ;
            $answer[$user->usr_id]["time"] = $user->wds_time ;
        }
    }
}

?>