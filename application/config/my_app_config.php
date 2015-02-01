<?php
$config['admin_menu'] = array(
    "خانه" => array("address" => "admin/dashboard" ,
         "icon" =>"glyphicon glyphicon-home" ,
         "active" =>FALSE) ,
    "ساختار شرکت" => array("address" => "admin/dashboard" ,
         "icon" =>"glyphicon glyphicon-user" ,
         "active" =>FALSE ,
         "submenu" => array(
             "اضافه کردن کارمند" => array("address" => "admin/dash_user/add_user" ,
                 "icon" =>"glyphicon glyphicon-user" ,
                 "active" =>FALSE ) ,
             "اضافه کردن گروه" => array("address" => "admin/dash_group/add_group" ,
                 "icon" =>"glyphicon glyphicon-user" ,
                 "active" =>FALSE ) ,
             "انتصاب شخص به گروه" => array("address" => "admin/dashboard" ,
                 "icon" =>"glyphicon glyphicon-user" ,
                 "active" =>FALSE )
              
          )) ,
    "وظیفه" => array("address" => "admin/dashboard" ,
         "icon" =>"glyphicon glyphicon-tasks" ,
         "active" =>FALSE) ,
    "یادآوری" => array("address" => "admin/dashboard" ,
         "icon" =>"glyphicon glyphicon-bullhorn" ,
         "active" =>FALSE) 
   );