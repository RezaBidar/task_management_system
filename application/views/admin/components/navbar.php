        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php site_url('admin/dashboard')?>"> ETMS <small class="text-muted"> سامانه  مدیریت وظابف کارمندان </small> </a>
                
                
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('admin/dashboard/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <p > نام : <?php echo $user_fullname ?></p>
                        </li>
                       	<?php 
                     
                       		foreach ($menu as $key => $val){
                       		    if(!isset($val["address"])) continue ;
								echo '<li>' . '<a href="' . site_url($val["address"]) . '" ';
								echo ($val["active"]) ? 'class="active" ' : '' ;
								echo '><i class="' . $val["icon"] . '"></i> ' . $key . '</a>' ;
                                /*<ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                                    <li>
                                        <a href="panels-wells.html">Panels and Wells</a>
                                    </li>
                                    <li>
                                        <a href="buttons.html">Buttons</a>
                                    </li>
                                    <li>
                                        <a href="notifications.html">Notifications</a>
                                    </li>
                                    <li>
                                        <a href="typography.html">Typography</a>
                                    </li>
                                    <li>
                                        <a href="icons.html"> Icons</a>
                                    </li>
                                    <li>
                                        <a href="grid.html">Grid</a>
                                    </li>
                                </ul>*/
                                
                                if(isset($val["submenu"]) && is_array($val["submenu"])){
                                    echo '<ul class="nav nav-second-level" >' ;
                                    foreach ($val["submenu"] as $_key => $_val){
                                        echo '<li>' . '<a href="' . site_url($_val["address"]) . '" ';
                                        echo ($_val["active"]) ? 'class="active" ' : '' ;
                                        echo '><i class="' . $_val["icon"] . '"></i> ' . $_key . '</a>' ;
                                    }
                                    echo '</ul>' ;
                                }
                                
                                echo '</li>';
						  	}
                       	
                       	?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
