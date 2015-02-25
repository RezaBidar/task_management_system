<?php defined('BASEPATH') OR exit('No direct script access allowed')?>

<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>
<h3><span class="glyphicon glyphicon-retweet"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h3>

<?php if(isset($message_info)):?>
<div class="alert alert-info"><?php echo $message_info?></div>
<?php endif;?>

<br>


<div class="col-md-5 col-lg-5 col-sm-9">
    <h4>در گروه</h4>
    
    <div class="form-inline form-group">
        <input class="form-control" placeholder="کد پرسنلی" type="text" />
        <button class="btn btn-primary">جست و جو</button>
    </div>
    <select name="membered" id="membered" class="form-control  admin_multi_select" multiple>
    <?php foreach ($membered as $key => $val){ echo "<option value='{$key}'>{$val["name"]} - {$val["employee_id"]} </option>" ;}?>
    </select>
    <div class="form-group">
        <button class="btn btn-danger"  id="remove_from_btn">حذف کردن</button>
    </div>
</div>

<div class="col-md-5 col-lg-5 col-sm-9">
    <h4>خارج از گروه</h4>
    <div class="form-inline form-group">
        <input class="form-control" placeholder="کد پرسنلی" type="text" id="in_group_search_field" />
        <button class="btn btn-primary" id="in_group_search_btn" >جست و جو</button>
    </div>
    
    <select name="not_membered" id="not_membered" class="form-control  admin_multi_select" multiple>
    <?php foreach ($not_membered as $key => $val){ echo "<option value='{$key}'>{$val["name"]} - {$val["employee_id"]} </option>" ;}?>
    </select>
    
    <div class="form-group">
        <button class="btn btn-success" id="add_to_btn">اضافه کردن</button>
    </div>
</div>

<?php 
echo btform::form_hidden("first_param" , $reminder_id) ;
echo btform::form_hidden("base_url" , $base_url) ;
echo btform::form_hidden("add_url" , $add_url) ;
echo btform::form_hidden("remove_url" , $remove_url);
?>
</div>
</div>