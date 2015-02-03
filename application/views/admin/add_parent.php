<?php defined('BASEPATH') OR exit('No direct script access allowed')?>

<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>
<h1><span class="glyphicon glyphicon-plus-sign"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h1>
<br>


<div class="col-md-5 col-lg-5 col-sm-9">
    <h4>در گروه</h4>
    
    <div class="form-inline form-group">
        <input class="form-control" placeholder="کد پرسنلی" type="text" />
        <button class="btn btn-primary">جست و جو</button>
    </div>
    <select name="membered" id="membered" class="form-control  admin_multi_select" multiple>
    <?php foreach ($membered as $key => $val) echo "<option value='{$key}'>{$val["name"]} - {$val["employee_id"]} </option>" ;?>
    </select>
    <div class="form-group">
        <button class="btn btn-danger"  id="remove_from_group_btn">حذف کردن</button>
    </div>
</div>

<div class="col-md-5 col-lg-5 col-sm-9">
    <h4>خارج از گروه</h4>
    <div class="form-inline form-group">
        <input class="form-control" placeholder="کد پرسنلی" type="text" id="in_group_search_field" />
        <button class="btn btn-primary" id="in_group_search_btn" >جست و جو</button>
    </div>
    
    <select name="not_membered" id="not_membered" class="form-control  admin_multi_select" multiple>
    <?php foreach ($not_membered as $key => $val) echo "<option value='{$key}'>{$val["name"]} - {$val["employee_id"]} </option>" ;?>
    </select>
    
    <div class="form-group">
        <button class="btn btn-success" id="add_to_group_btn">اضافه کردن</button>
    </div>
</div>

<?php 
echo btform::form_hidden("group_id" , $group_id) ;
echo btform::form_hidden("base_url" , $base_url) ;
?>
</div>
</div>