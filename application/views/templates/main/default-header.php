<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">

        <title>Daly IMS</title>
        <link href="<?php echo base_url(); ?>assets/css/css-family=Open+Sans-400,300,600,400italic,700,800.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>assets/css/css-family=Raleway-100.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>assets/css/css-family=Open+Sans+Condensed-300,700.css" rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.default.css" type="text/css" />

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/jquery.ui.css" />

        <!-- Font awesome -->
        <link href="<?php echo base_url(); ?>assets/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.gritter.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/nanoscroller.css"  />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-switch.css"  />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/slider.css"  />

        <!-- including external js scripts-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
        <!-- end of external js scripts-->

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/extjs4.0.7/resources/css/ext-all-gray.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/extjs4.0.7/ext-all.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/qrcode/qrutility.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/qrcode/llqrcode.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/qrcode/qrreader.js"></script>
        <link href="<?php echo base_url(); ?>assets/extjs4.0.7/ux/extbox/style.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/extjs4.0.7/ux/extbox/extbox.js"></script>
        <script type="text/javascript">
            Ext.Loader.setConfig({enabled: true, disableCaching: false});
            Ext.Ajax.disableCaching = false;
            Ext.Loader.setPath('Ext.ux', '<?php echo base_url(); ?>assets/extjs4.0.7/ux');
        </script>
        <?php
        // last notifications fetch val to reset
        $_SESSION['lastread'] = 0;
        ?>
        <style>
            body > *.x-menu .x-menu-item-disabled.x-hmenu-sort-asc, body > *.x-menu div.x-menu-item-disabled.x-hmenu-sort-desc{
                display: none;    height: 0;    margin: 0;    padding: 0;    visibility: hidden;    width: 0;
            }
            body > *.x-menu .x-menu-item-disabled.x-hmenu-sort-asc + div.x-menu-item-disabled.x-hmenu-sort-desc + div.x-menu-item-separator{
                display: none;    margin: 0;    padding: 0;    height: 0;    visibility: hidden;    width: 0;
            }
        </style>

    </head>
    <body>
        <?php
        $this->load->helper('role');
        $avatar_url = base_url() . "assets/img/admin2.jpg";
        if ($this->session->userdata[APP_PFIX . 'admin']['profile_pic'] != '') {
            $avatar_url = base_url() . "assets/uploads/user/" . $this->session->userdata[APP_PFIX . 'admin']['profile_pic'];
        }
        $my_role = get_user_role($this->session->userdata[APP_PFIX . 'admin']['adminid']);
        $onlyadmin = '';
        if (!in_array('1', $my_role)) {
            $onlyadmin = 'hide ';
        }
        ?>
        <div id="head-nav" class="navbar navbar-default navbar-fixed-top">

            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="fa fa-gear"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img class="img-responsive" src="<?php echo base_url(); ?>assets/img/logos/logo.png"></a>

                </div>

                <!-- Search Bar -->
                <div class="tsearch visible-xs">

                    <form id="searchorderform1" class="searchformheader" method="post"><input type="text" id="searchorder1" required value="" pattern="SO[0-9]{7}" placeholder="Sales Order ID"></form>
                    <div class="pull-right">
                        <a class="x-extbox qrsearch" href="<?php echo site_url('dashboard/searchscanqr') ?>" title="Search By Scanning QR Code">
                            <img src="<?php echo base_url(); ?>assets/img/qrsearch-xs.png">
                        </a>
                        <span class="notification_li">
                            <a href="#" class="notificationLink" title="Show Notifications"><span class="notification_count">0</span></a>
                            <div class="notificationContainer">
                                <div class="notificationTitle">Notifications</div>
                                <div class="notificationsBody">
                                </div>
                                <div class="notificationFooter"><a rel='more' href="<?php echo site_url('dashboard/notifications') ?>">ALL</a></div>
                            </div>
                        </span>
                        <a class="scanme visible-xs x-extbox" href="<?php echo site_url('dashboard/scanqr') ?>" title="Scan QR Code"><i class="x-extbox fa fa-qrcode"></i></a>
                    </div>
                </div>
                <!-- End of Search Bar -->

                <div class="navbar-collapse collapse">

                    <!-- Top navigation bar -->
                    <ul class="nav navbar-nav">
                        <li class="<?php if ($page == 'dashboard') echo 'active'; ?>"><a href="<?php echo site_url('dashboard'); ?>">Dashboard</a></li>
                        <li class="<?php
                        echo $onlyadmin;
                        if ($page == 'user' || $page == 'rbac')
                            echo 'active';
                        ?>"><a  href="<?php echo site_url('user') ?>">User Management</a></li>
                        <!-- <li class="<?php
                        echo $onlyadmin;
                        if ($page == 'team')
                            echo 'active';
                        ?>"><a href="<?php echo site_url('team'); ?>">Teams</a></li> -->
                        <li class="<?php
                        echo $onlyadmin;
                        if ($page == 'userassign' || $page == 'team' || $page == 'project' || $page == 'location')
                            echo 'active';
                        ?>"><a href="<?php echo site_url('userassign'); ?>">Team Assignment</a></li>
                        
<!--                        <li class="<?php
                        echo $onlyadmin;
                        if ($page == 'soassign')
                            echo 'active';
                        ?>"><a href="<?php echo site_url('soassign'); ?>">SO Assignment</a></li>-->
                        <li class="<?php
                        echo $onlyadmin;
                        if ($page == 'soassign')
                            echo 'active';
                        ?>"><a href="<?php echo site_url('soassign/saleslinetoteam'); ?>">SO Assignment</a></li>
                        
                        <li class="<?php
                        echo $onlyadmin;
                        if ($page == 'priorityassign')
                            echo 'active';
                        ?>"><a href="<?php echo site_url('priorityassign'); ?>">Priority Assignment</a></li>

                        <li class="<?php
                        echo $onlyadmin;
                        if ($page == 'productionstatus')
                            echo 'active';
                        ?>"><a href="<?php echo site_url('productionstatus') ?>">Production Status</a></li>
                        <li class="<?php
                        echo $onlyadmin;
                        if ($page == 'build')
                            echo 'active';
                        ?>"><a href="<?php echo site_url('build/assignsalesorder') ?>">Build</a></li>

                    </ul><!-- End of Top navigation bar -->

                    <!-- User Account setting-->
                    <ul class="nav navbar-nav navbar-right user-nav">

                        <li style="width: 100px">
                            <form class="hidden-xs searchformheader" id="searchorderform2" method="post"><input type="text" required id="searchorder2" value="" pattern="SO[0-9]{7}" placeholder="Sales Order ID"></form>
                        </li>

                        <li class="qrsearch hidden-xs">
                            <a class="x-extbox" href="<?php echo site_url('dashboard/searchscanqr') ?>" title="Search By Scanning QR Code">
                                <img src="<?php echo base_url(); ?>assets/img/qrsearch.png">
                            </a>
                        </li>

                        <li class="notification_li hidden-xs">
                            <a href="#" class="notificationLink" title="Show Notifications"><span class="notification_count">0</span></a>
                            <div class="notificationContainer">
                                <div class="notificationTitle">Notifications</div>
                                <div class="notificationsBody">
                                </div>
                                <div class="notificationFooter"><a rel='more' href="<?php echo site_url('dashboard/notifications') ?>">ALL</a></div>
                            </div>
                        </li>
                        
                        <li class="scanme hidden-xs">
                            <a class="x-extbox" href="<?php echo site_url('dashboard/scanqr') ?>" title="Scan QR Code">
                                <i class="x-extbox fa fa-qrcode"></i>
                            </a>
                        </li>

                        <li class="dropdown profile_menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img style="width:10%;" alt="Avatar" src="<?php echo $avatar_url; ?>"  /><span><?php echo $this->session->userdata[APP_PFIX . 'admin']['fname'] . ' ' . $this->session->userdata[APP_PFIX . 'admin']['lname']; ?></span> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('user/edit/' . $this->session->userdata[APP_PFIX . 'admin']['adminid']); ?>">Edit Profile</a></li>

                                <!--                                <li><a href="#">Help</a></li>-->
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('dashboard/logout'); ?>">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul><!-- User Account setting-->

                </div><!--/.nav-collapse animate-collapse -->
            </div>
        </div>
        <div id="cl-wrapper" class="fixed-menu">
