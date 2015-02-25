<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>

<?php if(isset($message)):?>
<div class="alert alert-success"><?php echo $message?></div>
<?php endif;?>

<h3><span class="glyphicon glyphicon-plus-sign"></span> <?php if(isset($title)) echo $title; else echo "اضافه کردن وظیفه"?></h3>

<?php if(isset($message_info)):?>
<div class="alert alert-info"><?php echo $message_info?></div>
<?php endif;?>

<br>

<?php 
echo btform::form_open();

echo btform::form_select('گروه', 'group_id', $group_list , '' , 'class="form-control" id="group_list" ') ;
echo btform::form_select('کی انجام بده', 'employee_prt_id[]', array() , '' , 'class="form-control" id="user_list" multiple') ;
echo btform::form_select('درجه اهمیت', 'priority', array(
                                             '0' => 'معمولی' ,
                                             '1' => 'مهم' ) , '' , 'class="form-control"') ;

echo btform::form_input('تاریخ شروع' , array('name' => 'start_time' , 'class' => 'form-control datepicker')) ;
echo btform::form_input('موعد پایان' , array('name' => 'due_time' , 'class' => 'form-control datepicker')) ;
echo btform::form_input('چند ساعت قبل الارم بده ' , array('name' => 'warning_date' , 'class' => 'form-control' , 'type' => 'number' , 'min' => '0' , 'max' => '100' , 'step' => '1' )) ;
echo btform::form_input('عنوان' , array('name' => 'title' , 'class' => 'form-control' )) ;
echo btform::form_textarea("متن" , array("name" => "description" , "class" => "form-control" ));
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , "ذخیره");
echo btform::form_hidden("users_url" , $users_url) ;
echo btform::form_close();

var_dump(validation_errors()) ;
?>

</div>
</div>