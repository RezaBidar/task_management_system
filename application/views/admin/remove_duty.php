<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>
<h3><span class="glyphicon glyphicon-remove"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h3>
<br>

<?php 
echo btform::form_open();



echo btform::form_input('تاریخ پایان' , array('name' => 'end_time' , 'class' => 'form-control datepicker')) ;
echo '<div class="form-group"><label>امتیاز</label><div class="star_rate" id="'. $duty_id .'"></div></div>';
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , "ذخیره");
echo btform::form_hidden("base_url" , $base_url ) ;
echo btform::form_hidden("duty_id" , $duty_id ) ;
echo btform::form_close();
echo "<br />" ;
var_dump(validation_errors()) ;
?>

</div>
</div>