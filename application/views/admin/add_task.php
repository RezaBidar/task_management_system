<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>
<h1><span class="glyphicon glyphicon-plus-sign"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h1>
<br>

<?php 
echo btform::form_open();


echo btform::form_select('درجه اهمیت', 'priority', array(
                                             '0' => 'معمولی' ,
                                             '1' => 'مهم' ) , '' , 'class="form-control"') ;

echo btform::form_input('تاریخ شروع' , array('name' => 'start_time' , 'class' => 'form-control hasDatepicker' , 'id' => 'datepicker3' )) ;
echo btform::form_input('تاریخ پایان' , array('name' => 'end_time' , 'class' => 'form-control hasDatepicker' , 'id' => 'datepicker3' )) ;
echo btform::form_input('چند ساعت قبل الارم بده ' , array('name' => 'warning_date' , 'class' => 'form-control' , 'type' => 'number' , 'min' => '0' , 'max' => '10' , 'step' => '1' )) ;
echo btform::form_input('عنوان' , array('name' => 'title' , 'class' => 'form-control' )) ;
echo btform::form_textarea("متن" , array("name" => "description" , "class" => "form-control" ));
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , "ذخیره");
echo btform::form_close();

var_dump(validation_errors()) ;
?>

</div>
</div>