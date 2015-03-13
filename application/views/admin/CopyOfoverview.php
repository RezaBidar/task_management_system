<?php 

?>
<!-- Page Content -->
        <div id="page-wrapper">
                <div class="container col-md-10 col-lg-10 col-sm-10">
                    <h3 class="page-header">داشبورد</h3>
                    
                    
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
                     
                     
                     <div class="panel panel-default " style="padding: 4px">
                        <!-- Default panel contents -->
                        <div class="panel-heading" style="margin-bottom: 5px">وظایف</div>
                        <div class="row">
                        <?php foreach ($task_list as $group_id => $group_status):?>
                          <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                              <div class="caption">
                                <h3><?php echo $group_status["group_name"]?></h3>
                                <p>وظایف من پیگیری نشده : <span class="badge"><?php echo $group_status["my_not_started_duty"]?></span></p>
                                <p>وظایف من در حال پیگیری : <span class="badge"><?php echo $group_status["my_on_process_duty"]?></span></p>
                                <p>وظایف زیردسته ها در حال پیگیری : <span class="badge"><?php echo $group_status["created_on_process_task"]?></span></p>
                                <p>وظایف زیردسته ها پیگیری نشده : <span class="badge"><?php echo $group_status["created_not_started_task"]?></span></p>
                                <p>
                                    <a href="<?php echo site_url('admin/dash_task/my_created_task/' . $group_id)?>" class="btn btn-taskview" role="button" data-toggle="tooltip" data-placement="bottom" 
                                    title="لیست وظایفی که شما برای دیگران ایجاد کردید" 
                                    >وظایف زیردسته ها</a>&nbsp;<a href="<?php echo site_url('admin/dash_task/my_tasks/' . $group_id)?>" class="btn btn-taskview" role="button" data-toggle="tooltip" data-placement="bottom" 
                                    title="لیست وظایفی که شما باید انجام دهید" 
                                    >وظایف من</a>
                                </p>
                              </div>
                            </div>
                          </div>
                       <?php endforeach;?>
                        </div>
                            
                     </div>
                </div>
                <!-- /.col-lg-12 -->
        </div>
        <!-- /#page-wrapper -->
