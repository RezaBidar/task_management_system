<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Reza Bidar">
    <link rel="icon" href="<?php echo site_url('img/fav.png')?>" type="image/gif" sizes="16x16">

    <title>نرم افزار مدیریت وظایف کارمندان</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url('css/bootstrap.min.css') ?>" rel="stylesheet">

    
    <!-- Custom CSS -->
    <link href="<?php echo site_url('css/sb-admin-2.css') ?>" rel="stylesheet">
    <link href="<?php echo site_url('css/admin.css') ?>" rel="stylesheet">

    
    <!-- Custom Fonts -->
    <link href="<?php echo site_url('font-awesome-4.1.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">

    
    <!-- MetisMenu CSS -->
    <link href="<?php echo site_url('css/plugins/metisMenu/metisMenu.min.css') ?>" rel="stylesheet">
    
    <!-- MetisMenu CSS -->
    <link href="<?php echo site_url('css/plugins/jalaliDatepicker/persian-datepicker-0.3.6.min.css') ?>" rel="stylesheet">

    
    <!-- multiselect -->
    <link href="<?php echo site_url('css/plugins/multiselect/bootstrap-multiselect.css') ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
 	
        <div class="row">
        
            <div class="col-md-4 col-md-offset-4">
                        <?php if(validation_errors() || (isset($error))):?>
                        <div class="alert alert-warning" style="margin-top:5px;">
                            <?php echo validation_errors()?>
                            <p><?php echo (isset($error['wrong_user'])) ? $error['wrong_user'] : '' ?></p>
                        </div>
                        <?php endif;?>
                <div class="login-panel panel panel-default">
                
                    <div class="panel-heading">
                        <h3 class="panel-title">فرم ورود</h3>
                    </div>
                    <div class="panel-body">
                        <form action="#" method="post" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="نام کاربری" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="رمز عبور" name="password" type="password" value="">
                                </div>
                                <!-- <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div> -->
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="لوگین" />
                            </fieldset>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo site_url('js/jquery-1.11.0.js') ?>"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo site_url('js/bootstrap.min.js') ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo site_url('js/plugins/metisMenu/metisMenu.min.js') ?>"></script>
    
    <!-- DataTables JavaScript -->
    <script src="<?php echo site_url('js/plugins/dataTables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo site_url('js/plugins/dataTables/dataTables.bootstrap.js') ?>"></script>
    
    <!-- star rating -->
    <script src="<?php echo site_url('js/plugins/raty/jquery.raty.js') ?>"></script>
    
    
    
    <!-- Jalali Date Picke library -->
    <script src="<?php echo site_url('js/plugins/jalaliDatepicker/persian-date.js') ?>"></script>
    <script src="<?php echo site_url('js/plugins/jalaliDatepicker/persian-datepicker-0.3.6.min.js') ?>"></script>
    
    
    <!-- multiselect library -->
    <script src="<?php echo site_url('js/plugins/multiselect/bootstrap-multiselect.js') ?>"></script>
    
    
    
    
    <!-- BootBox library -->
    <script src="<?php echo site_url('js/plugins/bootbox/bootbox.min.js') ?>" ></script>
    
    
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo site_url('js/sb-admin-2.js') ?>"></script>
    
    <!-- ReZaBiDaR custom javascripts  -->
    <script src="<?php echo site_url('js/custom.js') ?>" ></script>

</body>

</html>