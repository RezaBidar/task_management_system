<?php defined('BASEPATH') OR exit('No direct script access allowed');
echo form_hidden("addfeedback_url" , $addfeedback_url) ;
echo form_hidden("changestatus_url" , $changestatus_url) ;
echo form_hidden("whodidsee_url" , $whodidsee_url) ;
echo form_hidden("wiw_id" , $wiw_id) ;
echo form_hidden("task_id" , $task_id) ;
?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<h3><span class="glyphicon glyphicon-send"></span> <?php if(isset($title)) echo $title; else echo "مشاهده وظیفه"?>
<?php if($wiw_id == $master_wiw_id):?> 
    <a href="<?php echo site_url('admin/dash_task/end_task/' . $task_id)?>"><span class=" btn  btn-primary">پایان وظیفه</span></a>
<?php endif;?>
    
</h3>
<br>


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <?php echo $task["title"]?>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      <?php echo nl2br($task["description"])?>
      </div>
    </div>
  </div>
  
  
</div>

<div class="col-md-8">
        
        <div class="panel panel-info">
            <div class="panel-heading">
                گزارش ها
            </div>
            <div class="panel-body">
<ul class="media-list">
<?php foreach ($message as $id => $feedback):?>
                                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                
                                                    <img class="media-object img-circle " style="max-height:40px;"  src="<?php echo btform::show_pic($feedback["avatar"])?>" />
                                                    <small class="text-muted"><?php echo $feedback["name"] . " | " . jdate('H:i:s  Y/m/d' , strtotime($feedback["time"]))?>
                                                    <?php if($wiw_id == $master_wiw_id):?>  
                                                    	<a href="#" id="wds_<?php echo $id //feedback_id this is in foreach ?>" class="who_did_see"><span class="glyphicon glyphicon-eye-open"></span></a>
                                                    <?php endif;?> 
                                                    </small>
                                                
                                                <div class="media-body" >
                                                    <?php if($feedback['wiw_id'] == $master_wiw_id):?>
                                                            <p class="alert <?php echo ($feedback["warning"]) ? "alert-danger" : "alert-warning"?>"><?php echo nl2br($feedback["text"])?></p>
                                                    <?php else :?>
                                                            <p class="alert <?php echo ($feedback["warning"]) ? "alert-danger" : "alert-message"?>"><?php echo nl2br($feedback["text"])?></p>
                                                    <?php endif;?>  
                                                            
                                                   
                                                    <hr />
                                                </div>
                                            </div>

                                        </div>
                                    </li>
     <?php endforeach;?>
                                </ul>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                                    <textarea class="form-control" rows="1" id="feedback_text" placeholder="گزارش دهید" autocomplete="off" ></textarea>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info" id="add_feedback" type="button">ارسال</button>
                                    </span>
                </div>
                <?php if($wiw_id == $master_wiw_id):?> 
                <?php echo btform::form_checkbox('اخطار' , array("name" => "type" , "value" => "1" , "id" => "feedback_warning"))?>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel <?php echo ($task["status"] == 1)? 'panel-warning' : 'panel-info' ?>">
            <div class="panel-heading">
                مشخصات وظیفه
            </div>
            <div class="panel-body">
                
                <p>تاریخ شروع : <?php echo $task["start_time"]?></p>
                <p>مهلت انجام : <?php echo $task["due_time"]?></p>
                <?php if($task["priority"] == 0):?>
                <p>نوع وظیفه: <span class="label label-info">عادی</span></p>
                <?php else :?>
                <p>نوع وظیفه: <span class="label label-danger">مهم</span></p>
                <?php endif;?>
                
                
                <?php if($task["status_changer"] != NULL):?>
                <p>تغییر دهنده حالت: <?php echo $task["status_changer"]?></p>
                <?php endif;?>
                
                <?php if($task["status"] == 1):?>
                <p>وضعیت انجام کار: <span class="label label-warning">در حال پیگیری</span></p>
                <?php else: ?>
                <p>وضعیت انجام کار: <span class="label label-default">عدم پیگیری</span></p>
                <button class="btn btn-warning" type="button" id="changetaskstatus">تغییر به حالت پیگیری</button>
                <?php endif;?>
            </div>
        </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
               افراد
               <?php if($wiw_id == $master_wiw_id):?> 
               <a href="<?php echo site_url('admin/dash_task/add_employee') . '/' . $task["id"]?>" class="btn btn-success btn-xs pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> افزودن</a>
               <?php endif;?>
            </div>
            <div class="panel-body">
                <ul class="media-list">
                			<li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="<?php echo btform::show_pic($master["avatar"])?>" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5><?php echo $master["name"]?> <span class="badge alert-info">ناظر</span> </h5>
                                                    <?php if($master["last_activity"]):?>
                                                   <small class="text-muted"><?php echo jdate('H:i:s  Y/m/d' , strtotime($master["last_activity"]))?></small>
                                                   <?php endif;?>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
<?php
foreach ($employee_list as $id => $employee):?>
                                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="<?php echo btform::show_pic($employee["avatar"])?>" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5><?php echo $employee["name"]?>
                                                    <?php if($wiw_id == $master_wiw_id):?> 
                                                    	 <a href="<?php echo site_url("admin/dash_task/end_duty/{$group_id}/{$task_id}/" . $employee["duty_id"] )?>" class="btn btn-danger btn-xs glyphicon glyphicon-remove" title="حذف"></a>
                                                   	<?php endif;?>
                                                    </h5>
                                                    <?php if($employee["last_activity"]):?>
                                                   <small class="text-muted"><?php echo jdate('H:i:s  Y/m/d' , strtotime($employee["last_activity"]))?></small>
                                                   <?php endif;?>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
<?php endforeach;?>
                                     </ul>
                </div>
            </div>
        
    </div>


</div>
</div>