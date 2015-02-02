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
    <select name="cars" class="form-control  admin_multi_select" multiple>
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
      <option value="audi">Audi</option>
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
      <option value="audi">Audi</option>
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
      <option value="audi">Audi</option>
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
    </select>
    <div class="form-group">
        <button class="btn btn-danger">حذف کردن</button>
    </div>
</div>

<div class="col-md-5 col-lg-5 col-sm-9">
    <h4>در گروه</h4>
    <div class="form-inline form-group">
        <input class="form-control" placeholder="کد پرسنلی" type="text" id="in_group_search_field" />
        <button class="btn btn-primary" id="in_group_search_btn" >جست و جو</button>
    </div>
    
    <select name="cars" class="form-control  admin_multi_select" multiple>
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
      <option value="audi">Audi</option>
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
      <option value="audi">Audi</option>
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
      <option value="audi">Audi</option>
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
    </select>
    
    <div class="form-group">
        <button class="btn btn-success">اضافه کردن</button>
    </div>
</div>

</div>
</div>