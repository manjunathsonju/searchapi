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
        
        <!-- end of external js scripts-->

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
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
       
        <div id="head-nav" class="navbar navbar-default navbar-fixed-top">

            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="fa fa-gear"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="#"><img class="img-responsive" src="<?php //echo base_url(); ?>assets/img/logos/logo.png"></a> -->

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
                    <!-- End of Top navigation bar -->

                    <!-- User Account setting-->
                    <!-- User Account setting-->

                </div><!--/.nav-collapse animate-collapse -->
            </div>
        </div>
        <div id="cl-wrapper" class="fixed-menu">
