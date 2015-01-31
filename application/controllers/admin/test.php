<?php
class test extends CI_Controller {
    
    public function index(){
        echo "this is index funtion" ;
        
    }
    public function mypage($param){
        echo $param ;
    }
}

