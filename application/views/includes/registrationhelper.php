<!DOCTYPE html>
<html>
<head>
	<title>paperlessdentists</title>
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."css/bootstrap.css"?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."css/bootstrap-responsive.css"?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."css/style.css"?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."css/meda.css"?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(). "css/font_awesome/css/font-awesome.min.css" ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(). "css/font_awesome/css/font-awesome.css" ?>"/>
        <!--doctor_dashboard_view.php-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(). "css/update.css" ?>"/>-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'/>
         <!--ddb_appintments_view.php-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(). "css/ddb_appointments_view.css" ?>"/>     
     	<link rel='stylesheet' href="<?php echo base_url().'fullcalendar/fullcalendar.css' ?>" />
	<link rel='stylesheet'  href="<?php echo base_url().'fullcalendar/fullcalendar.print.css' ?>" media='print' />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."datepicker/css/datepicker.css" ?>" />

        
<!--############################################################# -->       
	<script type='text/javascript' src='http://www.google.com/jsapi'></script>	
	<script type="text/javascript" src="<?php echo base_url(). "js/jquery-1.7.1.min.js" ?>"></script>
        <script type="text/javascript" src="<?php echo base_url(). "js/main.js" ?>"></script>
        <script type="text/javascript" src="<?php echo base_url(). "js/bootstrap.min.js" ?>"></script>
        <script type="text/javascript" src="<?php echo base_url(). "js/chart.js" ?>"></script>
        <!--Dynamically Adding Javascript files.-->
        <?php if (isset($js_files)) { 
            foreach($js_files as $file){?>
                <script type="text/javascript" src="<?php echo base_url().$file ?>"></script>
                <?php
            }
        }?>    
</head>
<body>
	<div class="navbar navbar-fixed-top m-header">
		<div class="navbar-inner m-inner">
			<div class="container-fluid">
				<a class="brand m-brand" href="<?php echo base_url("").'/patient_ctrl' ?>" style="width:100%"> <img src="<?php echo base_url()."img/logo.png" ?>"> </a>
				
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		        </button>
		        
				<div class="nav-collapse collapse">

					 
                     
                  
                     
	          	</div>
			</div>
		</div>
	</div>
	<div class="m-top"></div>
	
	<div class="m-sidebar-collapsed">
		<ul class="nav nav-pills">
			
		</ul>

		<div class="arrow-border">
			<div class="arrow-inner"></div>
		</div>
	</div>
