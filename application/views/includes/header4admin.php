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
<script type='text/javascript'>
$(document).ready(function() 
{
var parameter =  url.split('/').pop();

}
</script>
        
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
				<a class="brand m-brand" href="<?php echo base_url("").'/admin_ctrl' ?>" style="width:100%"> <img src="<?php echo base_url()."img/logo.png" ?>" > </a>
				
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		        </button>
		        
				<div class="nav-collapse collapse" >

					 
                     
                     <div  class="pull-right span2" style="margin-top: -53px; margin-right: 18px;">
                         <div class="btn-group pull-right">
                            <a href="#" data-toggle="dropdown" class="btn dropdown-toggle">
                                <i class="icon-user"></i> Profile
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon-user"></i>Profile</a></li>
                                <li><a href="#"><i class="icon-cog"></i>Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url();?>login"><i class="icon-off"></i>111</a></li>
                            </ul>
                        </div>
                     </div>
                     <div class="pull-right span3 header_links"
                      style="margin-top: -48px; margin-right: 18px;">
                         <ul>
                         	<li> <h1>Mr <?= $this->session->userdata('userid') ?></h1></li>
                            <li> <h2><?= $this->session->userdata('clinic') ?></h2></li>
                            
                            
                         </ul>
                     </div>
                     
	          	</div>
			</div>
		</div>
	</div>
	<div class="m-top"></div>
	<aside class="sidebar">
		<ul class="nav nav-tabs nav-stacked">
			<li class="active">
				<a href="<?php echo base_url("").'admin_ctrl' ?>">
					<div>
						<div class="ico">
							<i class="fa fa-home"></i> 
						</div>
						<div class="title">
							Home
						</div>
					</div>

					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="">
                            <a href="<?php echo base_url().'admin_ctrl/patients' ?>">
					<span class="badge badge-important m-badge-notification">6</span>
					<div>
						<div class="ico">
							<i class="fa fa-users"></i> 
						</div>
						<div class="title">
							Patients 
						</div>
					</div>

					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			 
			<li class="">
				<a href="<?php echo base_url("admin_ctrl")."/appointments"?>">
					<div>
						<div class="ico">
							<i class="fa fa-file-text"></i>
						</div>
						<div class="title">
							Appointments
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="">
				<a href="<?php echo base_url("admin_ctrl")."/messages" ?>" >
					<div>
						<div class="ico">
							<i class="fa fa-envelope-o"></i>
						</div>
						<div class="title">
							Message
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			<li class="">
				<a href="<?php echo base_url("admin_ctrl")."/reports" ?>" >
					<div>
						<div class="ico">
							<i class="fa fa-file-text-o"></i>
						</div>
						<div class="title">
							Reports
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>
<li class="">
				<a href="<?php echo base_url("admin_ctrl")."/admin" ?>" >
					<div>
						<div class="ico">
							<i class="fa fa-file-text-o"></i>
						</div>
						<div class="title">
							Admin
						</div>
					</div>
					<div class="arrow">
						<div class="bubble-arrow-border"></div>
						<div class="bubble-arrow"></div>
					</div>
				</a>
			</li>

			 


	    </ul>
	</aside>
	<div class="m-sidebar-collapsed">
		<ul class="nav nav-pills">
			
		</ul>

		<div class="arrow-border">
			<div class="arrow-inner"></div>
		</div>
	</div>
