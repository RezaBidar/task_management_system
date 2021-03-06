<?php
$config['admin_menu'] = array(
    "داشبورد" => array("address" => "admin/dashboard" ,
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
             "انتصاب شخص به گروه" => array("address" => "admin/dash_group/add_employee" ,
                 "icon" =>"glyphicon glyphicon-user" ,
                 "active" =>FALSE ) ,
             "ساختار درختی شرکت" => array("address" => "admin/dash_parent/add_parent" ,
                 "icon" =>"glyphicon glyphicon-user" ,
                 "active" =>FALSE )
              
          )) ,
    "وظیفه" => array("address" => "admin/dashboard" ,
         "icon" =>"glyphicon glyphicon-tasks" ,
         "active" =>FALSE ,
         "submenu" => array(
            "اضافه کردن وظیفه" => array("address" => "admin/dash_task/add_task" ,
                "icon" =>"glyphicon glyphicon-tasks" ,
                "active" =>FALSE) ,
            "وظیفه های ایجاد شده" => array("address" => "admin/dash_task/add_duty" ,
                "icon" =>"glyphicon glyphicon-tasks" ,
                "active" =>FALSE) ,
            "وظیفه های مربوط به خود" => array("address" => "admin/dash_task/my_duty_list" ,
                "icon" =>"glyphicon glyphicon-tasks" ,
                "active" =>FALSE) ,
             "ایچاد وظیفه برای خود" => array("address" => "admin/dash_task/add_my_task" ,
                 "icon" =>"glyphicon glyphicon-tasks" ,
                 "active" =>FALSE) ,
             "وظیفه های نیاز به تایید" => array("address" => "admin/dash_task/need_accept_task" ,
                 "icon" =>"glyphicon glyphicon-tasks" ,
                 "active" =>FALSE) ,
             "لیست وظایف ایجاد شده" => array("address" => "admin/dash_task/task_list" ,
                 "icon" =>"glyphicon glyphicon-tasks" ,
                 "active" =>FALSE) ,
         )) ,
    "یادآوری" => array("address" => "admin/dashboard" ,
         "icon" =>"glyphicon glyphicon-bullhorn" ,
         "active" =>FALSE ,
         "submenu" => array(
             "اضافه کردن یادآوری" => array("address" => "admin/dash_reminder/add_reminder" ,
                 "icon" =>"glyphicon glyphicon-bullhorn" ,
                 "active" =>FALSE) ,
             "یادآوری های ایجاد شده" => array("address" => "admin/dash_reminder/add_noted" ,
                 "icon" =>"glyphicon glyphicon-bullhorn" ,
                 "active" =>FALSE) ,
             "یادآوری های مربوط به خود" => array("address" => "admin/dash_reminder/my_reminder_list" ,
                 "icon" =>"glyphicon glyphicon-bullhorn" ,
                 "active" =>FALSE) ,
         )
    ),
	"انتقادات و پیشنهادات" => array("address" => "admin/dash_comment/add_comment" ,
			"icon" =>"glyphicon glyphicon-comment" ,
			"active" =>FALSE ,
			"submenu" => array(
					"ارسال نظر" => array("address" => "admin/dash_comment/add_comment" ,
							"icon" =>"glyphicon glyphicon-comment" ,
							"active" =>FALSE) ,
					"مشاهده نظرات" => array("address" => "admin/dash_comment/view_comment" ,
							"icon" =>"glyphicon glyphicon-comment" ,
							"active" =>FALSE) ,
			)
	)
   );


$config["user_menu"] = array(
    "داشبورد" => array("address" => "admin/dashboard/overview" ,
         "icon" =>"glyphicon glyphicon-home" ,
         "active" =>FALSE) ,
    "وظیفه" => array("address" => "admin/dashboard" ,
         "icon" =>"glyphicon glyphicon-tasks" ,
         "active" =>FALSE ,
         "submenu" => array(
            "اضافه کردن وظیفه" => array("address" => "admin/dash_task/add_task" ,
                "icon" =>"glyphicon glyphicon-plus-sign" ,
                "active" =>FALSE) ,
             "لیست وظایف ایجاد شده" => array("address" => "admin/dash_task/task_list" ,
                 "icon" =>"glyphicon glyphicon-check" ,
                 "active" =>FALSE) ,
         )) ,
    "یادآوری" => array("address" => "admin/dashboard" ,
         "icon" =>"glyphicon glyphicon-bullhorn" ,
         "active" =>FALSE ,
         "submenu" => array(
             "اضافه کردن یادآوری" => array("address" => "admin/dash_reminder/add_reminder" ,
                 "icon" =>"glyphicon glyphicon-plus-sign" ,
                 "active" =>FALSE) ,
             "انتصاب یاداوری به شخص" => array("address" => "admin/dash_reminder/add_noted" ,
                 "icon" =>"glyphicon glyphicon-hand-left" ,
                 "active" =>FALSE) ,
         )
    ),
	"انتقادات و پیشنهادات" => array("address" => "admin/dash_comment/add_comment" ,
			"icon" =>"glyphicon glyphicon-comment" ,
			"active" =>FALSE ,
			"submenu" => array(
					"ارسال نظر" => array("address" => "admin/dash_comment/add_comment" ,
							"icon" =>"glyphicon glyphicon-send" ,
							"active" =>FALSE) ,
			)
	)
   );