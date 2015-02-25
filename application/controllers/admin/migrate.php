<?php
class migrate extends CI_Controller{
    function index(){
        $this->load->library('migration');
        
        if ( ! $this->migration->current())
        {
            show_error($this->migration->error_string());
        }else {
            echo "db is up to date" ;
        }
    }    
}
