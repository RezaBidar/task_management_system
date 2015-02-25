<?php defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>
<h3><span class="glyphicon glyphicon-floppy-saved"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h3>
<?php if(isset($message_info)):?>
<div class="alert alert-info"><?php echo $message_info?></div>
<?php endif;?>

<br>

<?php 
echo btform::form_open();


echo btform::form_select('وضعیت وظیفه', 'status', array(
    '' => '',
    '0' => 'انجام نشد' ,
    '1' => 'انجام شد' ) , '' , 'class="form-control"') ;
echo btform::form_input('تاریخ پایان' , array('name' => 'end_time' , 'class' => 'form-control datepicker')) ;
foreach ($employee_list as $duty_id => $employee) echo '<div class="form-group"><label> امتیاز '. $employee["name"] .'</label><div class="star_rate" id="'. $duty_id .'"></div></div>';
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , "ذخیره");
echo btform::form_hidden("base_url" , $base_url ) ;
echo btform::form_close();
echo "<br />" ;
var_dump(validation_errors()) ;
?>

</div>
</div>