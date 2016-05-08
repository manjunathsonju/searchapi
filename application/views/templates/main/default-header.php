<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">

        <title>Search Api</title>
        <link href="<?php echo base_url(); ?>assets/css/css-family=Open+Sans-400,300,600,400italic,700,800.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>assets/css/css-family=Raleway-100.css" rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>assets/css/css-family=Open+Sans+Condensed-300,700.css" rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.default.css" type="text/css" />

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js" ></script>
        
  
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
        

         <style>
      html, body {
        height: 10000%;
        margin: 0;
        padding: 0;
      }
     /* #map {
        height: 2000%;
        visibility: true;
      }*/

       html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
     
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #map {
                position:relative;
                float:left;
                width:944px;
                height:600px;
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
               
                <!-- End of Search Bar -->

                <div class="navbar-collapse collapse">

                </div><!--/.nav-collapse animate-collapse -->
            </div>
        </div>
        <div id="cl-wrapper" class="fixed-menu">
