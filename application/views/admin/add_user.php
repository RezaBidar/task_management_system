<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>
<h1><span class="glyphicon glyphicon-plus-sign"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h1>
<br>
<?php 
echo btform::form_open();

echo btform::form_input('کد پرسنلی' , array('name' => 'employee_id' , 'class' => 'form-control' )) ;
echo btform::form_input('نام' , array('name' => 'fname' , 'class' => 'form-control' )) ;
echo btform::form_input('نام خانوادگی' , array('name' => 'lname' , 'class' => 'form-control' )) ;
echo btform::form_input('نام کاربری' , array('name' => 'username' , 'class' => 'form-control' )) ;
echo btform::form_input('کلمه عبور' , array('name' => 'password' , 'class' => 'form-control' )) ;
echo btform::form_input('ایمیل' , array('name' => 'email' , 'class' => 'form-control' )) ;
echo btform::form_select('جنسیت', 'gender', array('male' => 'مرد' , 'female' => 'زن') , '' , 'class="form-control"') ;
echo btform::form_input('شماره تلفن' , array('name' => 'tel' , 'class' => 'form-control' )) ;
echo btform::form_input('شماره موبایل' , array('name' => 'mobile' , 'class' => 'form-control' )) ;
echo btform::form_textarea("آدرس" , array("name" => "address" , "class" => "form-control" ));
echo btform::form_upload("عکس",array("name" => "avatar", "class"=>"form-control" ));
echo btform::form_select('نوع کاربر', 'type', array('0' => 'کارمند' , '10' => 'ادمین') , '' , 'class="form-control"') ;
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , "ذخیره");
echo btform::form_close();

var_dump(validation_errors()) ;
?>

</div>
</div>