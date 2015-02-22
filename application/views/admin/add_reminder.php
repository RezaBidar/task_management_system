<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>
<h1><span class="glyphicon glyphicon-plus-sign"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h1>
<br>

<?php 
echo btform::form_open();


echo btform::form_select('نوع', 'type', array(
                                             '0' => 'ثابت' ,
                                             '1' => 'روزانه' ,
                                             '2' => 'هفنگی' , 
                                             '3' => 'ماهانه'
                                                            ) , '' , 'class="form-control"') ;

echo btform::form_input('تاریخ شروع' , array('name' => 'start_time' , 'class' => 'form-control datepicker' )) ;
echo btform::form_input('مدت زمان به ساعت' , array('name' => 'duration' , 'class' => 'form-control'  , 'type' => 'number' , 'min' => '1' , 'max' => '23' , 'step' => '1' )) ;
echo btform::form_input('موضوع' , array('name' => 'title' , 'class' => 'form-control' )) ;
echo btform::form_textarea("متن" , array("name" => "text" , "class" => "form-control" ));
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , "ذخیره");
echo btform::form_close();

var_dump(validation_errors()) ;
?>

</div>
</div>