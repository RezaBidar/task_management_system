<?php defined('BASEPATH') OR exit('No direct script access allowed');

var_dump($task) ;
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
                RECENT CHAT HISTORY
            </div>
            <div class="panel-body">
<ul class="media-list">

                                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle " src="assets/img/user.png" />
                                                </a>
                                                <div class="media-body" >
                                                    Donec sit amet ligula enim. Duis vel condimentum massa.
              
              Donec sit amet ligula enim. Duis vel condimentum massa.Donec sit amet ligula enim. 
                                                    Duis vel condimentum massa.
                                                    Donec sit amet ligula enim. Duis vel condimentum massa.
                                                    <br />
                                                   <small class="text-muted">Alex Deo | 23rd June at 5:00pm</small>
                                                    <hr />
                                                </div>
                                            </div>

                                        </div>
                                    </li>
     <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle " src="assets/img/user.gif" />
                                                </a>
                                                <div class="media-body" >
                                                    Donec sit amet ligula enim. Duis vel condimentum massa.
              
              Donec sit amet ligula enim. Duis vel condimentum massa.Donec sit amet ligula enim. 
                                                    Duis vel condimentum massa.
                                                    Donec sit amet ligula enim. Duis vel condimentum massa.
                                                    <br />
                                                   <small class="text-muted">Jhon Rexa | 23rd June at 5:00pm</small>
                                                    <hr />
                                                </div>
                                            </div>

                                        </div>
                                    </li>
     <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle " src="assets/img/user.png" />
                                                </a>
                                                <div class="media-body" >
                                                    Donec sit amet ligula enim. Duis vel condimentum massa.
              
              Donec sit amet ligula enim. Duis vel condimentum massa.Donec sit amet ligula enim. 
                                                    Duis vel condimentum massa.
                                                    Donec sit amet ligula enim. Duis vel condimentum massa.
                                                    <br />
                                                   <small class="text-muted">Alex Deo | 23rd June at 5:00pm</small>
                                                    <hr />
                                                </div>
                                            </div>

                                        </div>
                                    </li>
     <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle " src="assets/img/user.gif" />
                                                </a>
                                                <div class="media-body" >
                                                    Donec sit amet ligula enim. Duis vel condimentum massa.
              
              Donec sit amet ligula enim. Duis vel condimentum massa.Donec sit amet ligula enim. 
                                                    Duis vel condimentum massa.
                                                    Donec sit amet ligula enim. Duis vel condimentum massa.
                                                    <br />
                                                   <small class="text-muted">Jhon Rexa | 23rd June at 5:00pm</small>
                                                    <hr />
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                                    <textarea class="form-control" placeholder="Enter Message" ></textarea>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info" type="button">SEND</button>
                                    </span>
                                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
               ONLINE USERS
            </div>
            <div class="panel-body">
                <ul class="media-list">

                                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="assets/img/user.png" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5>Alex Deo | User </h5>
                                                    
                                                   <small class="text-muted">Active From 3 hours</small>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
     <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="assets/img/user.gif" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5>Jhon Rexa | User </h5>
                                                    
                                                   <small class="text-muted">Active From 3 hours</small>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="assets/img/user.png" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5>Alex Deo | User </h5>
                                                    
                                                   <small class="text-muted">Active From 3 hours</small>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="assets/img/user.gif" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5>Jhon Rexa | User </h5>
                                                    
                                                   <small class="text-muted">Active From 3 hours</small>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                     <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="assets/img/user.png" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5>Alex Deo | User </h5>
                                                    
                                                   <small class="text-muted">Active From 3 hours</small>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
     <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="assets/img/user.gif" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5>Jhon Rexa | User </h5>
                                                    
                                                   <small class="text-muted">Active From 3 hours</small>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="assets/img/user.png" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5>Alex Deo | User </h5>
                                                    
                                                   <small class="text-muted">Active From 3 hours</small>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                    <li class="media">

                                        <div class="media-body">

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object img-circle" style="max-height:40px;" src="assets/img/user.gif" />
                                                </a>
                                                <div class="media-body" >
                                                    <h5>Jhon Rexa | User </h5>
                                                    
                                                   <small class="text-muted">Active From 3 hours</small>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                </div>
            </div>
        
    </div>


</div>
</div>