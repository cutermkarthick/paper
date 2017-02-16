<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 10, 2014                 =
// Filename: new_patient_dashboard.php        =
// Copyright of Fluent Technologies            =
//==============================================
?>
<!doctype html>
<html>
<head>
<title>paperlessdentists</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<link rel="stylesheet" type="text/css" href="css/meda.css" />
<!--[if IE]><script type="text/javascript" src="scripts/jquery.bgiframe.js"></script><![endif]-->

<!-- jquery.datePicker.js -->
<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/chart.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<script type='text/javascript'>
$(function()
{
	$('#dob').datepicker();
});

var parameter = window.location.hash.substr(1);
$(document).ready(function () 
{	
 $('#myTab li').click(function()
 {
		$("#home").css({"display": "none"});
		$("#profile").css({"display": "none"});
        $("#dropdown1").css({"display":  "none"});
        $("#dropdown2").css({"display": "none"});
		$("#dropdown3").css({"display": "none"});
    
	param=this.id;
   if(param == 'home1')
   {
   $("#home").css({"display": "block"});
   $('#home').addClass('active in');
   }
   else if(param == 'profile1')
   {
   $("#profile").css({"display": "block"});
   $('#profile').addClass('active in');
   }
   else if(param == 'dropdown11')
   {
   $("#dropdown1").css({"display": "block"});
   $('#dropdown1').addClass('active in');
   }
   else if(param == 'dropdown21')
   {
   $("#dropdown2").css({"display": "block"});
   $('#dropdown2').addClass('active in');
   }
    else if(param == 'dropdown31')
	{
   $("#dropdown3").css({"display": "block"});
   $('#dropdown3').addClass('active in');
   }
      
});
		$("#myTab li#home1").removeClass("active");
		$("#home").css({"display": "none"});
		$("#profile").css({"display": "none"});
        $("#dropdown1").css({"display":  "none"});
        $("#dropdown2").css({"display": "none"});
		$("#dropdown3").css({"display": "none"});

        if(parameter == 'home1'  || parameter == '' )
        {
             $("#myTab li#home1").addClass("active");
			 $("#home").css({"display": "inline"});
			 $("#home").addClass("active in");
        }
        else if(parameter == 'profile1' )
        {
             $("#myTab li#profile1").addClass("active");
			 $("#profile").css({"display":"inline"});
			 $("#profile").addClass("active in"); 
        }
        else if(parameter == 'dropdown11' )
        {
             $("#myTab li#dropdown11").addClass("active");
			  $("#dropdown1").css({"display" : "inline"});	
			  $("#dropdown1").addClass("active in");
        } 
		 else if(parameter == 'dropdown21' )
        {
             $("#myTab li#dropdown21").addClass("active");
			  $("#dropdown2").css({"display" : "inline"});
			  $("#dropdown2").addClass("active in");
        }
		 else if(parameter == 'dropdown31' )
        {
             $("#myTab li#dropdown31").addClass("active");
			 $("#dropdown3").css({"display" :"inline" });
			 $("#dropdown3").addClass("active in");
        } 
		$('html, body').animate({ scrollTop: 0 }, 20);

    });
</script>


<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link rel="stylesheet" type="text/css" href="css/font_awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font_awesome/css/font-awesome.css"/>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="main-container">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:10px 0px;"class="sub_title row-fluid">

<div class="row-fluid">
<div class="span9">
<div class="m-widget dashbord_box">
<div class="row-fluid">
</div>

<div style="margin-top:30px;" class="row-fluid">
<div class="m-widget-body">
<ul style="margin-bottom:-1px;margin:0px" class="nav nav-tabs" id="myTab">
<li class="active" id='home1'><a data-toggle="tab" href="#home">Personal Info</a></li>
<li class="" id='profile1'><a data-toggle="tab" href="#profile">Emergency</a></li>
<li class="" id='dropdown11'><a data-toggle="tab" href="#dropdown1">Medical History </a></li>
<li class="" id='dropdown21'><a data-toggle="tab" href="#dropdown2"> Insurance Info</a></li>
<li class="" id='dropdown31'><a data-toggle="tab" href="#dropdown3">Family Member</a></li>  
</ul>

<div class="tab-content" id="myTabContent">
<div  id="home" class="tab-pane fade active in">
<div class="row-fluid patient_history">
<h1>Personal Details</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">
<form class="form-horizontal2" method="post" action="<?php echo base_url();?>patient_ctrl/insert_new_patient/personal">
<div class="control-group">
<br>
<label class="control-label" for="inputEmail">Email :</label>
<?php echo form_input(array('id' => 'email', 'name' => 'email','placeholder' => 'Email')); ?>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Photo: </label>
<div class="controls">
<ul class="thumbnails m-media-container">
<li class="span3">
<img class="img-polaroid" src="http://placehold.it/160x120" alt="" />
<div class="caption">
<p style="margin-top:5px 0px;">
<button class="btn  btn-success" type="button"> Upload Front</button>
</p>
</div>
</li>
</ul>
</div>
</div> 
	
	
	<div class="control-group">
	<label class="control-label" for="inputEmail"> Name</label>
		<div class="controls">
			 <?php echo form_input(array('id' => 'name', 'name' => 'name','placeholder' => 'Name')); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
		<div class="controls">
			<?php echo form_input(array('id' => 'mid_name', 'name' => 'mid_name','placeholder' => 'Middle Initial Or Name',)); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Last Name</label>
		<div class="controls"> 
				 <?php echo form_input(array('id' => 'last_name', 'name' => 'last_name','placeholder' => 'Last Name')); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Date of Birth</label>
		<div class="controls"> 
				 <?php 
				 echo form_input(array('id' => 'dob', 'name' => 'dob','placeholder' => 'DD/MM/YYYY','background-color'=>'#DDDDDD' ));
				 ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Gender</label>
		<div class="controls">
			<label class="checkbox inline">
					 <? echo form_checkbox('gender', 'male', FALSE);?>
					 Male
					  </label>
	
				
						<label class="checkbox inline">
					  <? echo form_checkbox('gender', 'female', FALSE);?>
					 Female</label>   
		</div>
	</div>
	
	<h1>Where do you live? </h1>
	<div class="clearfix">  </div>
	
	<br>
	<div class="control-group">
		<label class="control-label" for="inputEmail">Address:</label>
		<div class="controls"> 
			  <?php echo form_input(array('id' => 'address', 'name' => 'address','placeholder' => 'Address')); ?>
		</div>
	</div>
	
	
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Address2:</label>
		<div class="controls">
			 <?php echo form_input(array('id' => 'address2', 'name' => 'address2','placeholder' => 'Address2')); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">City:</label>
		<div class="controls">
			 <?php echo form_input(array('id' => 'city', 'name' => 'city','placeholder' => 'City Name')); ?>
		</div>
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">State:</label>
		<div class="controls"> 
			  <?php echo form_input(array('id' => 'state', 'name' => 'state','placeholder' => 'State')); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Zip:</label>
		<div class="controls">			 
			  <?php echo form_input(array('id' => 'zip', 'name' => 'zip','placeholder' => 'ZIP')); ?>
		</div>
	</div>
	
	 <h1>What is your contact Info ? </h1>
	<div class="clearfix">  </div>
		 
   <div class="alert alert-info">  At least one of three phones is required </div>
   
   <div class="control-group">
		<label class="control-label" for="inputEmail">Home Phone:</label>
		<div class="controls">			 
			  <?php echo form_input(array('id' => 'home_phone', 'name' => 'home_phone','placeholder' => 'No')); ?>
		</div>
	</div>
	 
	
	 <div class="control-group">
		<label class="control-label" for="inputEmail">Cell Phone:</label>
		<div class="controls"> 
			 <?php echo form_input(array('id' => 'cell_phone', 'name' => 'cell_phone','placeholder' => 'No')); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Work Phone:</label>
		<div class="controls">
			 <?php echo form_input(array('id' => 'work_phone', 'name' => 'work_phone','placeholder' => 'No')); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Preferred method of Contact</label>
		<div class="controls">
			 <?
              $options = array(
                  'email'  => 'Email',
                  'contact_num'    => ' Contact No',
                );
			   echo form_dropdown('prefered_contact', $options, 'email'); ?>

		</div>
	</div>

	
	
</div>
		<?php echo form_submit(array('id' => 'submit', 'value' => 'Submit'));?>
	</form>
 
	
	   
	
</div>

</div>


<div id="profile" class="tab-pane fade">
<div class="row-fluid patient_history">
 
<div style="margin-bottom:10px;" class="m-widget">

 <form class="form-horizontal2">
 
  <h1> Emergency Contact Person's Details </h1>
 <br>
	<div class="control-group">
		<label class="control-label" for="inputEmail">First Name </label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder="First Name "   value=''>   
		</div>
	</div>
	
	
	  <div class="control-group">
		<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder=" Middle Initial Or Name"  value=''>   
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Last Name</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder=" Last Name"  value=''>   
		</div>
	</div>
	
	
	
	<h1> Emergency Contact Person's Contact Info </h1>
 <div class="alert alert-info">  At least one of three phones is required </div>
	<div class="control-group">
		<label class="control-label" for="inputEmail">Home phone </label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder="Home phone " value='' >   
		</div>
	</div>
	
	
	  <div class="control-group">
		<label class="control-label" for="inputEmail">Cell  phone</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder=" Middle Initial Or Name"  value=''>   
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Work phone</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder="Work phone"  value=''>   
		</div>
	</div>
	
	
	 <div class="control-group">
		<label class="control-label" for="inputEmail">Email</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder="Email"  value=''>   
		</div>
	</div>
	
	
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Relationship</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder="Relationship"  value=''>   
		</div>
	</div>
	

	
	
	
	
	
	 
	
	
	 
	
	 
	
	</form>
	
	</div>
	
 
	   
	
</div>
</div>


<div id="dropdown1" class="tab-pane fade">
<div class="row-fluid patient_history">
<h1>Your Weight and height </h1>
<div class="clearfix">  </div>
<div style="margin-bottom:10px;" class="m-widget">

 <form class="form-horizontal2">
	<div class="control-group">
	<label class="control-label" for="inputEmail">Height ( in inches)</label>
	<div class="controls">
	<input type="text" placeholder="00" value=''>
	</div>
	</div>
	<div class="control-group">
	<label class="control-label" for="inputPassword">Weight (in pounds)</label>
	<div class="controls">
		<input type="text" placeholder="00" value=''>
	</div>
	</div> 
	</form>
	
	</div>
	
	
<div class="clearfix">  </div> 
	
 <h1>Your Health Status  </h1>

<div style="margin-bottom:10px;" class="m-widget">

 <form class="form-horizontal2">
	<div class="control-group">
	<label class="control-label" for="inputEmail"> Are you in good health</label>
	<div class="controls">
					<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_0" checked>
					  Yes
					  </label>
	
				
						<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_1" >
					  No</label>
				
	  
		 </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPassword">Are you now under the care of a physician ?</label>
		 <div class="controls">
					<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_0" checked>
					  Yes
					  </label>
	
				
						<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_1" >
					  No</label>
				
	  
		 </div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputPassword">Physician's Telephone</label>
		<div class="controls">
		
				   <input class="input-large" type="text" placeholder="Pnone No" value=''>
		</div>
	</div>
	
	
	
	
	<div class="control-group">
		<label class="control-label" for="inputPassword"> Have you had any serious illness, operation or been hospitalized ? </label>
		 <div class="controls">
					<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_0" >
					  Yes
					  </label>
	
				
						<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_1" checked>
					  No</label>
				
	  
		 </div>
	</div>
	
	</form>
	
	</div>
	







<div class="clearfix">  </div> 
	
 <h1>Do you use alcohol, tobaco, drugs?  </h1>

<div style="margin-bottom:10px;" class="m-widget">

 <form class="form-horizontal2">
	<div class="control-group">
	<label class="control-label" for="inputEmail">Do you drinks alcholic beverages ? </label>
	<div class="controls">
					<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_0" >
					  Yea
					  </label>
	
				
						<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_1" checked>
					  No</label>
				
	  
		 </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPassword">
Have you used any recreation drug in the last 6 months ?</label>
		<div class="controls">
					<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_0" checked>
					  Yea
					  </label>
	
				
						<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_1" >
					  No</label>
				
	  
		 </div>
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="inputPassword">History of alcohol abuse ?</label>
		 <div class="controls">
					<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_0" >
					  Yea
					  </label>
	
				
						<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_1" checked>
					  No</label>
				
	  
		 </div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputPassword"> 
		 Do you use smoke?  </label>
		<div class="controls">
					<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_0" checked>
					  Yea
					  </label>
	
				
						<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_1" >
					  No</label>
				
	  
		 </div>
	  </div>
	
	
	<div class="control-group">
		<label class="control-label" for="inputPassword"> 
		 Do you use tobacco?  </label>
		<div class="controls">
					<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_0" >
					  Yea
					  </label>
	
				
						<label class="checkbox inline">
					  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_1" checked>
					  No</label>
				
	  
		 </div> 
	 </div>
	
	
	
	</form>
	
	</div>
	
	
	
	
<div class="clearfix">  </div> 
	
 <h1>Your medical condition  </h1>
 
 <p>Have you had currently have any of the following conditions? Check the ones that are applicable<br>

	<strong>HEART CONDITION</strong>
 </p>

<div style="margin-bottom:10px;" class="m-widget">

 <form class="form-horizontal2">
	 
	 
	<div class="control-group">
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" >
			   High Blood Pressure
		  </label>
				
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" id="goodhealth_0" checked>
				 Low Blood Pressure
			</label>
		</div>
	</div>
	
	 
	
	<div class="control-group">
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" checked>
				Angina Chest Pain
		  </label>
				
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" >
				 Fainting
			</label>
		</div>
	</div>
	
	
	
	<div class="control-group">
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" >
				Irregular Heartbeat
		  </label>
				
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" checked>
				 Heart Attack
			</label>
		</div>
	</div>
	
	
	  <div class="control-group">
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" >
			   Heart Bypass
		  </label>
				
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" checked>
				Pacemaker
			</label>
		</div>
	</div>
	
	<div class="control-group">
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox">
			   Anemla
		  </label>
				
	 
	</div>
	
	<div class="control-group">
		 <p><strong>LIVER DI & EA & E</strong></p>
			<label class="checkbox inline">
			  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_0">
			  Hepatitis A
			  </label>

		
				<label class="checkbox inline">
			  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_1" >
			 Hepatitis B
			 </label>
			 
			 <label class="checkbox inline">
			  <input type="checkbox" name="good health" value="checkbox" id="goodhealth_1" >
			 Hepatitis C
			 </label>
	</div>
	
	 <div class="control-group">
	 <p><strong>IMMUNOSUPPRESSED / BLOOD DISEASE</strong></p>
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" >
			  HIV-
		  </label>
				
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" >
				AIDS
			</label>
		</div>
	</div>
	
	<div class="control-group">
	  
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" >
			 Sexually Transmitted Disease
		  </label>
				
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" >
				Delay in Healing
			</label>
		</div>
	</div>
	
	
	<div class="control-group">
			<p><strong>ORGAN CONDITION / DISEASE</strong></p>
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" checked>
			 pancreas diabetes
		  </label>
				
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" >
				Kidney / Dialysis
			</label>
		</div>
	</div>
	
	<div class="control-group">
		 
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" >
			Eyes / Glaucoma
		  </label>
				
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" checked>
				Thyroid
			</label>
		</div>
	</div>
	
	<div class="control-group">
		 
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox">
		   Neurology Epilepsy
		  </label>
   </div>
   
   
   <div class="control-group">
		 <p><strong>CANCER</strong></p>
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" >
		   Cancer Location
		  </label>
		  
				   
		<div class="controls">
			<input class="input-large" type="text" placeholder="Location">
		</div>
   </div>
	<div class="control-group">
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" checked>
			Surgery 
		  </label>
				
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" >
				Radiation
			</label>
		</div>
	</div>
	
	
	 <div class="control-group">
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" >
			Chemotherapy
		  </label>
				
		 
	</div>
	
	
	<div class="control-group">
		 <p><strong>JOINT CONDITION</strong></p>
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" checked>
		  Clicking / Pain in jaw joints when eating
		  </label>
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" checked>
				Arthritis
			</label>
		</div>  
				   
		 
   </div>
	
	
	 <div class="control-group">
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" >
		 Arthritis Knee Replacement
		  </label>
		<div class="controls">
			<label class="checkbox inline">
				<input type="checkbox" name="good health" value="checkbox" >
				Arthritis Hip Replacement
			</label>
		</div>  
   </div>
	
	 <div class="control-group">
		 <label class="control-label">
			 <input type="checkbox" name="good health" value="checkbox" >
		Swollen Ankles
		  </label>
		
   </div>
   
	<div class="control-group">
		 <label class="control-label">
			 
		Other
		  </label>
		<div class="controls">
			 <input class="input-large" type="text" placeholder="...">
		</div>  
   </div>
	
	
	</form>
	
	</div>
	
	
	   
	
</div>
</div>



<div id="dropdown3" class="tab-pane fade">
<div class="row-fluid patient_history">
 
<div style="margin-bottom:10px;" class="m-widget">

 <form class="form-horizontal2">
 
  <h1> Family Member Details</h1>
 
	<div class="control-group">
		<label class="control-label" for="inputEmail">First Name </label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder="First Name"  value=''>   
		</div>
	</div>
	
	
	  <div class="control-group">
		<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder=" Middle Initial Or Name" value=''>   
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Last Name</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder=" Last Name" value=''>   
		</div>
	</div>
	
	
	
	<h1> Family Member Contact Info </h1>
 <div class="alert alert-info">  At least one of three phones is required </div>
	<div class="control-group">
		<label class="control-label" for="inputEmail">Home phone </label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder="Home phone"  value=''>   
		</div>
	</div>
	
	
	  <div class="control-group">
		<label class="control-label" for="inputEmail">Cell phone</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder=" Middle Initial Or Name"  value=''>   
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Work phone</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder="Work phone"  value=''>   
		</div>
	</div>
	
	
	 <div class="control-group">
		<label class="control-label" for="inputEmail">Email</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder="Email"  value=''>   
		</div>
	</div>
	
	
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Relationship</label>
		<div class="controls">
			<input class="input-xlarge" type="text" placeholder="Relationship"  value=''>   
		</div>
	</div>
	

	
	
	
	
	
	 
	
	
	 
	
	 
	
	</form>
	
	</div>
	
 
	   
	
</div>
</div>

<div id="dropdown2" class="tab-pane fade">
<div class="row-fluid patient_history">

<div class="m-widget-body">

<div class="row-fluid patient_history">
<h1>Insurance Details of  Primary Insured </h1>
<div class="clearfix">  </div>
<div style="margin-bottom:10px;" class="m-widget">

 <form class="form-horizontal2">
	<div class="control-group">
	<label class="control-label" for="inputEmail">Name of Primary Insured</label>
	<div class="controls">
	<input type="text"  placeholder="Name" value='' >
	</div>
	</div>
	
	
	
	<div class="control-group">
		<label class="control-label" for="inputPassword">Name Of The Patients </label>
		<div class="controls">
		<input type="text" placeholder="Name" value=''  >
		</div>
	
	</div> 
	</form>
	
	</div>
	
	
<div class="clearfix">  </div> 
	
 <h1>Primary Insurance  </h1>

<div style="margin-bottom:10px;" class="m-widget">

 <form class="form-horizontal2">
	<div class="control-group">
	  <label class="control-label" for="inputPassword">Insurance Company </label>
   <div class="controls">
		<input type="text" placeholder=" Company Name"  value=''>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPassword">Group ID</label>
		<div class="controls">
		<input type="text" placeholder="ID" value=''>
		</div>
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="inputPassword">Member ID </label>
		<div class="controls">
		<input type="text" placeholder="ID"  value=''>
		</div>
	</div>
	
	 
	
	</form>
	
	</div>
	
<div class="clearfix">  </div> 

<div class="well">
	 <p>Upload photos/scanned image of insurance card
</p>
	<ul class="thumbnails m-media-container">
		<li class="span3">
			<img class="img-polaroid" src="http://placehold.it/160x120" alt="" />
			<div class="caption">
				<p style="margin-top:5px 0px;">
					<button class="btn  btn-success" type="button"> Upload Front</button>
				</p>
			</div>
		</li>
		<li class="span3">
			 
				<img class="img-polaroid" src="http://placehold.it/160x120" alt="" />
			
			
			<div class="caption">
				<p style="margin-top:5px 0px;">
					<button class="btn  btn-success" type="button">Upload back</button>
				</p>
			</div>
			
		 </li>
	</ul>
</div>






	


 
	
	   
	
</div>


	</div>
	
	




 
	
	   
	
</div>
</div>

</div>
</div>

</div> 





<div class="clearfix"> </div>
</div>

</div>

<div class="span3 m-widget">
<ul class="patients_rightnav">
<li>
<button class="btn btn-large btn-warning" type="button" onClick="location.href='p-appointment.html'"> <i class="fa fa-envelope-o"></i>  Request Appointment  </button>
</li>

<li>
<button class="btn btn-large btn-warning" type="button" onClick="location.href='patcient_message.html'"> <i class="fa fa-envelope-o"></i>  Send Message  </button>											
</li>
</ul>

<div class="clearfix"> </div>
<br>

<div class="clearfix"> </div>
<div class="patients_social">

<a href="http://facebook.com/fluentsoftinc" target="_blank"> <i class="fa fa-facebook"></i> </a> 


<a href="http://twitter.com/fluentsoftinc" target="_blank"><i class="fa fa-twitter"></i></a> 

</div>

</div>
</div>    





</section>
</div>
</div>
<div class="clearfix">
<div class="footer">

<span>Copyright &copy; 2014, Paperless Dentists. All Rights Reserved	Terms Of Use </span>

</div>
</div>
</body>
</html>
