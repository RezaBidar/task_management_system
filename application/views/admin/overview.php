<?php 

?>
<!-- Page Content -->
        <div id="page-wrapper">
                <div class="container col-md-10 col-lg-10 col-sm-10">
                    <h3 class="page-header">داشبورد</h3>
                    
                     
                     <div class="panel panel-default " style="padding: 4px">
                        <!-- Default panel contents -->
                        <div class="panel-heading" style="margin-bottom: 5px">وظایف</div>
                        <div class="row">
                        <?php foreach ($task_list as $group_id => $group_status):?>
                          <div class="col-sm-6 col-md-6">
                            <div class="thumbnail">
                            <h3 ><span class="glyphicon glyphicon-chevron-left" style="color: green;"></span> <?php echo $group_status["group_name"]?></h3>
                              <div class="caption">
                                <h4>وظایف شما</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-default">در حال انجام : <span class="badge" style="background:#f97104;"><?php echo $group_status["my_on_process_duty"]?></span></button><br/>
                                        <button class="btn btn-default">غیر فعال : <span class="badge" style="background:gray;"><?php echo $group_status["my_not_started_duty"]?></span></button><br/>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="label label-info"><span class="badge"><?php echo tr_num(82,'fa')?></span> وظیفه دیده نشده</span>
                                        <span class="label label-warning"><span class="badge"><?php echo tr_num(11,'fa')?></span> گزارش دیده نشده</span>
                                        <span class="label label-danger"><span class="badge"><?php echo tr_num(5,'fa')?></span> اخطار دیده نشده</span>
                                    </div>
                                </div>    
                                <h4>وظایف زیردستان</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-default">در حال انجام : <span class="badge" style="background:#f97104;"><?php echo $group_status["created_on_process_task"]?></span></button>
                                        <button class="btn btn-default">غیر فعال : <span class="badge" style="background:gray;"><?php echo $group_status["created_not_started_task"]?></span></button>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="label label-info"><span class="badge"><?php echo tr_num(82,'fa')?></span> وظیفه دیده نشده</span>
                                        <span class="label label-warning"><span class="badge"><?php echo tr_num(11,'fa')?></span> گزارش دیده نشده</span>
                                        <span class="label label-danger"><span class="badge"><?php echo tr_num(5,'fa')?></span> اخطار دیده نشده</span>
                                    </div>
                                </div> 
                                <h4>وظایف دنبال شده</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-default">در حال انجام : <span class="badge" style="background:#f97104;"><?php echo $group_status["created_on_process_task"]?></span></button>
                                        <button class="btn btn-default">غیر فعال : <span class="badge" style="background:gray;"><?php echo $group_status["created_not_started_task"]?></span></button>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="label label-info"><span class="badge"><?php echo tr_num(82,'fa')?></span> وظیفه دیده نشده</span>
                                        <span class="label label-warning"><span class="badge"><?php echo tr_num(11,'fa')?></span> گزارش دیده نشده</span>
                                        <span class="label label-danger"><span class="badge"><?php echo tr_num(5,'fa')?></span> اخطار دیده نشده</span>
                                    </div>
                                </div> 
                              </div>
                            </div>
                          </div>
                       <?php endforeach;?>
                        </div>
                            
                     </div>
                     
                     <div class="panel panel-default " style="padding: 4px">
                      <!-- Default panel contents -->
                      <div class="panel-heading" style="margin-bottom: 5px">یاداوری ها</div>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      
                        <?php foreach ($reminder_list as $reminder_id => $reminder):?>
                          <div class="panel panel-reminder">
                            <div class="panel-heading" role="tab" id="heading<?php echo $reminder_id?>">
                              <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $reminder_id?>" aria-expanded="false" aria-controls="collapse<?php echo $reminder_id?>">
                                  <?php echo $reminder["master"] . ' : ' .$reminder["title"]?>
                                </a>
                              </h4>
                            </div>
                            <div id="collapse<?php echo $reminder_id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $reminder_id?>">
                              <div class="panel-body">
                                <?php echo nl2br($reminder["text"])?>
                              </div>
                            </div>
                          </div>
                          <?php endforeach;?>
                        </div>
                     </div><!-- panel -->
                     
                </div>
                <!-- /.col-lg-12 -->
        </div>
        <!-- /#page-wrapper -->
