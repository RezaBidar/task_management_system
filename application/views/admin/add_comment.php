<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10"><br>
<?php if(isset($message)):?>
<div class="alert alert-success"><?php echo $message?></div>
<?php endif;?>

<h3><span class="glyphicon glyphicon-plus-sign"></span> <?php if(isset($title)) echo $title; else echo "اضافه کردن نظر"?></h3>
<br>


<div class="alert alert-info">
<p>لطفا در صورت مشاهده اشکال در سیستم یا اظهار نظر در رابطه با نقاط مختلف نرم افزار از فرم زیر استفاده کنید</p>
<p>اگر در قسمتی از سیستم به پیغام خطا برخوردید یا برای ارسال نظر نیاز به ارسال عکس داشتید لطفا عکس مورد نظر را در ساعت زیر آپلود کنید و لینک رو ارسال کنید</p>
<p><a href="http://upload7.ir/">upload7.ir</a></p>
</div>

<?php 
echo btform::form_open();
echo btform::form_input('عنوان' , array('name' => 'title' , 'class' => 'form-control' )) ;
echo btform::form_textarea("متن" , array("name" => "text" , "class" => "form-control" ));
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , "ذخیره");
echo btform::form_close();

?>

</div>
</div>