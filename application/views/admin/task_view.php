<?php defined('BASEPATH') OR exit('No direct script access allowed');
echo form_hidden("url" , $url) ;
echo form_hidden("wiw_id" , $wiw_id) ;
echo form_hidden("task_id" , $task_id) ;
?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<h1><span class="glyphicon glyphicon-send"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h1>
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
      <?php echo $task["description"]?>
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
<?php foreach ($not_seen_message as $id => $feedback):?>
                                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                
                                                    <img class="media-object img-circle " style="max-height:40px;"  src="<?php echo btform::show_pic($feedback["avatar"])?>" />
                                                    <small class="text-muted"><?php echo $feedback["name"] . " | " . $feedback["time"]?></small>
                                                
                                                <div class="media-body" >
                                                        <p class="alert alert-warning"><?php echo $feedback["text"]?></p>
                                                   
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
            </div>
        </div>
    </div>
    <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
               USERS
            </div>
            <div class="panel-body">
                <ul class="media-list">
<?php foreach ($employee_list as $id => $employee):?>
                                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="<?php echo btform::show_pic($employee["avatar"])?>" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5><?php echo $employee["name"]?></h5>
                                                    
                                                   <small class="text-muted">تاریخ آخرین لوگین</small>
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