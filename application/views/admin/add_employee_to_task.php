<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>
<h3><span class="glyphicon glyphicon-plus-sign"></span> <?php if(isset($title)) echo $title; else echo "اضافه کردن کارمند به وظیفه"?></h3>
<br>

<?php 

echo btform::form_open();

foreach ($membered as $prt_id => $user)
	echo btform::form_checkbox($user["name"] , array('name' => 'parent_child_id[' . $prt_id .']' , 'class' => '') , $prt_id);


echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , "ذخیره");
echo btform::form_close();

var_dump(validation_errors()) ;
?>

</div>
</div>