<?php defined('BASEPATH') OR exit('No direct script access allowed')?>

<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>
<h1><span class="glyphicon glyphicon-plus-sign"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h1>
<br>
<?php 
echo btform::form_open();

echo btform::form_input('نام' , array('name' => 'name' , 'class' => 'form-control' )) ;
echo btform::form_textarea("توضیحات" , array("name" => "description" , "class" => "form-control" ));
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , "ذخیره");
echo btform::form_close();

var_dump(validation_errors()) ;
?>

</div>
</div>