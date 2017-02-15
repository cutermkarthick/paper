<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 10, 2015                 =
// Filename: update_profile.php                =
// Copyright of Fluent Technologies            =
// update patient profile in doctor login      =
//==============================================
?>
<!DOCTYPE html>
<html>
<head>
<body>
<link rel="stylesheet" type="text/css" href="css/meda.css" />
<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/style.css" />

<link rel="stylesheet"
 href="<?echo base_url()?>signature-pad/build/jquery.signaturepad.css">
<script src="<?echo base_url()?>signature-pad/build/flashcanvas.js"></script>
<script src="<?echo base_url()?>signature-pad/build/json2.min.js"></script>
<script src="<?echo base_url()?>signature-pad/jquery.signaturepad.js"></script>
<script src="<?echo base_url()?>signature-pad/build/jquery.signaturepad.min.js"></script>
<script type='text/javascript'>
var url=(window.location.href);
var parameter =  url.split('/').pop();
$(document).ready(function () 
{
      document.getElementById('param').value=parameter;
      $('.sigPad4doc').signaturePad({drawOnly : true});
});
function getpatient_info()
{
window.location="<?php echo base_url();?>doctor_ctrl/getpatient_info";
}
function getdentalhis_details(recnum)
{
window.location="<?php echo base_url();?>doctor_ctrl/dental_historydetails/"+recnum;
}

$(document).ready(function () 
{
$("#myTab li#home1").removeClass("active");
$("#home").css({"display": "none"});
$("#profile").css({"display": "none"});
$("#dropdown1").css({"display":  "none"});
$("#dropdown2").css({"display": "none"});
$("#dropdown3").css({"display": "none"});
alert(parameter);
if(parameter == 'home1'  || parameter == 'profile' )
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
else if(parameter == 'familymember' )
{
$("#myTab li#familymember").addClass("active");
$("#dropdown3").css({"display" :"inline" });
$("#dropdown3").addClass("active in");
} 
$('html, body').animate({ scrollTop: 0 }, 20);	
});

function switcher()
{
var img;
img=document.getElementbyId('img_switcher');
}
</script>
	
<?
$style=' "background-color:#DFDFDF;" readonly ';
?>


<div class="main-container">
<div class="container-fluid">
<section>
<div style="margin-top:10px;" class="row-fluid">
<div class="m-widget-header">
<div class="span12 sub_title">
<h1> Patients info   </h1>
</div>
</div>
</div>	

<div style="margin-top:9px;" class="row-fluid">
<div class="span9 m-widget">
<div class="row-fluid">
<div class="span2">
<div class="patients_pic">
<?
echo '<img id="img_switcher"  src="'.$query->img_location.'">';
?>
</div>
</div>

<div class="patients_info span5">
<h1 style=" margin-bottom:10px;">John Smith</h1>
<p> Name: <?= $query->fullname ?></p>
<p> Address: <?= $query->addr1 ?></p>
<p> <?= $query->addr2 ?></p>
<p> <?= $query->city .''.$query->state.",". $query->zip ?></p>

<p><a href="#?"> <i class="fa fa-refresh"></i>  Updates </a></p>
</div>

<input type='hidden' name='health_iss' id='health_iss' value=
"<?echo  $health_iss ?>">

</div>

<div style="margin-top:30px;" class="row-fluid">
<div class="span4 patients_info">
<h1>PERSONAL INFO </h1>                                
<UL>
<LI>Cell Phone:<?= $query->cell_phone ?></LI>
<LI>Home Phone: <?= $query->home_phone ?>
<LI>Work Phone: <?= $query->work_phone ?></LI>
<LI>Date of Birth: <?= $query->dob ?></LI>
<LI>Email: <?= $query->email ?></LI>
</UL>
</div>

<div class="span4 patients_info">
<h1>PRIMARY INSURANCE INFO </h1>

<UL>
<LI>Employer: <?= $insur->name_of_insured ?></LI>
<LI>Company :<?= $insur->insurance_company ?></LI>
<LI>Group Id: <?= $insur->group_id ?></LI>
<LI>Member Id: <?= $insur->member_id  ?></LI>
</UL>
</div>                            


<div class="span4 patients_info">
<h1>EMERGENCY  </h1>                                
<UL>                                	 
<LI>Emergency Contact: <?= $emer->home_phone ?> </LI>
<LI> Emergency Cell phone:  <?= $emer->cell_phone ?></LI>
<LI> Referred By: <?= $query->referred_by ?></LI>
<LI>Referred To: </LI>
</UL>
</div>  
</div>                        
</div>

</div>

</section>
<div style="margin-top:30px;" class="row-fluid">

<div class="m-widget-body">                                   
<ul style="margin-bottom:-1px;" class="nav nav-tabs" id="myTab">
<li id='home1' class="active"><a data-toggle="tab" href="<?echo base_url()?>doctor_ctrl/getpatient_info/<?=$recnum?>#home">Personal Info===</a></li>
<li id='profile1' class=""><a data-toggle="tab" href="<?echo base_url()?>doctor_ctrl/getpatient_info/<?=$recnum?>#profile">Emergency Info</a></li>
<li class="" id='myTab_profile'  onclick="getPaging('#dropdown1')"><a data-toggle="tab" href="#dropdown1">Health History</a></li>
<li id='dropdown21' class="" onclick="getPaging('#dropdown2')"><a data-toggle="tab" href="#dropdown2">Insurance Info</a></li>
<li id='dropdown41' class="" onclick="getPaging('#dental_history')"><a data-toggle="tab" href="#dental_history">Dental History</a></li>
<li id='dropdown31' class="" onclick="getPaging('#dropdown3')"><a data-toggle="tab" href="#dropdown3">Consent Info</a></li>
</ul>

<div class="tab-content" id="myTabContent">


<div  id="home" class="tab-pane fade active in">

<div class="row-fluid patient_history">
<h1>Personal Details</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">

<form class="form-horizontal2 sigPad1">
<div class="control-group">
<label class="control-label" for="inputEmail">Email :</label>
<div class="controls">
<?php echo form_input(array('id' => 'email', 'name' => 'email','placeholder' => 'Email','style'=>$style,'value'=>"$query->email")); ?>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Photo: </label>
<div class="controls">
<ul class="thumbnails m-media-container">
<li class="span3">
<div class="caption">
<p style="margin-top:5px 0px;">
<?
echo '<img src="'.$query->img_location.'">';
?>
</p>
</div>
</li>
</ul>
</div>
</div> 


<div class="control-group">
<label class="control-label" for="inputEmail"> Name</label>
<div class="controls"> 
<?php echo form_input(array('id' => 'fname', 'name' => 'fname','placeholder' => 'Name','style'=>$style,'value'=>$query->fname)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
<div class="controls">  
<?php echo form_input(array('id' => 'middle_initial', 'name' => 'middle_initial','placeholder' => 'Middle Initial Or Name','style'=>$style,'value'=>$query->middle_initial)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Last Name</label>
<div class="controls">
<?php echo form_input(array('id' => 'lname', 'name' => 'lname','placeholder' => 'Last Name','style'=>$style,'value'=>$query->lname)); ?>
</div>
</div>
<?
$dddob=explode('-', $query->dob );
$dob=$dddob[1].'/'.$dddob[2].'/'.$dddob[0];
?>
<div class="control-group">
<label class="control-label" for="inputEmail">Date of Birth</label>
<div class="controls">
<?php echo form_input(array('id' => 'dob', 'name' => 'dob','placeholder' => 'DD/MM/YYYY','style'=>$style,'value'=>$query->dob)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Gender</label>
<div class="controls">
<label class="radio inline">
<?php
if( $query->gender  == 'M' ||  $query->gender == 'm')
{?>
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" checked>
Male
</label>

<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" disabled>
Female</label> 
<?}
else
{?>
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" disabled>
Male
</label>

<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" checked>
Female</label> 
<?}?>
</div>
</div>

<h1>Where do you live? </h1>
<div class="clearfix">  </div>

<br>
<div class="control-group">
<label class="control-label" for="inputEmail">Address:</label>
<div class="controls">
<?php echo form_input(array('id' => 'addr', 'name' => 'addr','placeholder' => 'Address','style'=>$style,'value'=>$query->addr1)); ?>
</div>
</div>



<div class="control-group">
<label class="control-label" for="inputEmail">Address2:</label>
<div class="controls">
<?php echo form_input(array('id' => 'addr2', 'name' => 'addr2','placeholder' => 'Address2','style'=>$style,'value'=>$query->addr2)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">City:</label>
<div class="controls">
<?php echo form_input(array('id' => 'city', 'name' => 'city','placeholder' => 'City Name','style'=>$style,'value'=>$query->city)); ?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">State:</label>
<div class="controls">  
<?php echo form_input(array('id' => 'state', 'name' => 'state','placeholder' => 'State','style'=>$style,'value'=>$query->state)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Zip:</label>
<div class="controls">
<?php echo form_input(array('id' => 'zip', 'name' => 'zip','placeholder' => 'ZIP','style'=>$style,'value'=>$query->zip)); ?>
</div>
</div>
<?
echo form_hidden('recnum', "$query->recnum");

?>


<h1>What is your contact Info ? </h1>
<div class="clearfix"></div>	 
<div class="alert alert-info">At least one of threee phones is required </div>
<div class="control-group">
<label class="control-label" for="inputEmail">Home Phone:</label>
<div class="controls">
<?php echo form_input(array('id' => 'home_phone', 'name' => 'home_phone','placeholder' => 'NO','style'=>$style,'value'=>$query->home_phone)); ?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Cell Phone:</label>
<div class="controls">
<?php echo form_input(array('id' => 'cell_phone', 'name' => 'cell_phone','placeholder' => 'NO','style'=>$style,'value'=>$query->cell_phone)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Work Phone:</label>
<div class="controls"> 
<?php echo form_input(array('id' => 'work_phone', 'name' => 'work_phone','placeholder' => 'NO','style'=>$style,'value'=>$query->work_phone)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Preferred method of Contact</label>
<div class="controls">
<?php echo form_input(array('id' => 'preferred_contact_mode', 'name' => 'preferred_contact_mode','placeholder' => 'NO','style'=>$style,'value'=>$query->preferred_contact_mode)); ?>		
</div>		
</div>	
</form>
</div> 

</div>

</div>


<div id="profile" class="tab-pane fade">

<div class="row-fluid patient_history">

<div style="margin-bottom:10px;" class="m-widget">

<?
$attr=array('class' => 'form-horizontal2 sigPad1');
echo form_open('patient_ctrl/insert_profile',$attr);
?>

<h1> Emergency Contact Person's Details</h1>
<br>
<div class="control-group">
<label class="control-label" for="inputEmail">First Name </label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_fname', 'name' => 'emer_fname','placeholder' => 'First Name','style'=>$style,'value'=>$emer->fname)); ?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_midname', 'name' => 'emer_midname','placeholder' => 'Middle Initial Or Name','style'=>$style,'value'=>$emer->middle_initial)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Last Name</label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_lname', 'name' => 'emer_lname','placeholder' => 'Last Name','style'=>$style,'value'=>$emer->lname)); ?>
</div>
</div>



<h1> Emergency Contact Person's Contact Info </h1>
<div class="alert alert-info">  At least one of three phones is required </div>
<div class="control-group">
<label class="control-label" for="inputEmail">Home phone </label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_homenum', 'name' => 'emer_homenum','placeholder' => 'Home phone','style'=>$style,'value'=>$emer->home_phone)); ?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Cell  phone</label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_cellnum', 'name' => 'emer_cellnum','placeholder' => 'Cell phone','style'=>$style,'value'=>$emer->cell_phone)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Work phone</label>
<div class="controls"> 
<?php echo form_input(array('id' => 'emer_worknum', 'name' => 'emer_worknum','placeholder' => 'Work phone','style'=>$style,'value'=>$emer->work_phone)); ?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Email</label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_email', 'name' => 'emer_email','placeholder' => 'Email','style'=>$style,'value'=>$emer->email)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Relationship</label>
<div class="controls">			
<?php echo form_input(array('id' => 'emer_relation', 'name' => 'emer_relation','placeholder' => 'Relationship','style'=>$style,'value'=>$emer->relationship)); ?>
</div>
</div>	


</form>

</div>




</div>
</div>




<div id="dropdown1" class="tab-pane fade">
<div><h1>

<img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" onclick='location.href="<?php echo base_url();?>doctor_ctrl/update_medicalhistory/<?= $recnum ?>" '>
</h1></div>
<br>
<br>
<div class="row-fluid patient_history">
<h1>Your Weight and height </h1>
<div class="clearfix">  </div>
<div style="margin-bottom:10px;" class="m-widget">

<form name="formConsent" id="formConsent" class="form-horizontal2 sigPad4doc" action="<?echo base_url()?>doctor_ctrl/" method="post" novalidate="novalidate">

<div class="control-group">
<label class="control-label" for="inputEmail">Height (in inches)</label>
<div class="controls">
<input type="text" placeholder="00" style=";background-color:#DDDDDD;" readonly="readonly"
style=";background-color:#DDDDDD;" readonly="readonly" name='height_inches' id='height_inches' value='<?= $query_health->height_inches?>'>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Weight (in pounds)</label>
<div class="controls">
<input type="text" placeholder="00" name='weight_lbs' id='weight_lbs' style=";background-color:#DDDDDD;" readonly="readonly" style=";background-color:#DDDDDD;" readonly="readonly" value='<?= $query_health->weight_lbs?>'>
</div>
</div>


<div class="clearfix">  </div> 

<h1>Your Health Status  </h1>

<div style="margin-bottom:10px;" class="m-widget">

<div class="control-group">
<label class="control-label" for="inputEmail"> Are you in good health</label>
<div class="controls">
<? 
if($query_health->are_you_in_good_health  == 'yes')
{?>
<label class="radio inline">
<input type="radio"  data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="yes" id="goodhealth_0" checked>
Yes
</label>					
<label class="radio inline">
<input type="radio" data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="no" id="goodhealth_1" disabled>
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="yes" id="are_you_in_good_health" disabled>
Yes
</label>					
<label class="radio inline">
<input type="radio" data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="no" id="are_you_in_good_health" checked>
No</label>
<?}?>				

</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Are you now under the care of a physician ?</label>
<div class="controls">					
<? 
if($query_health->under_physician_care   == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="yes" id="under_physician_care" checked>
Yes
</label>					
<label class="radio inline">
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="no" id="under_physician_care" disabled>
No</label>	
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="yes" id="under_physician_care" disabled>
Yes
</label>					
<label class="radio inline">
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="no" id="under_physician_care" checked>
No</label>
<?}?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Physician's Telephone</label>
<div class="controls">

<input class="input-large" type="text" placeholder="Pnone No" style=";background-color:#DDDDDD;" readonly="readonly" name='physician_phone' id='physician_phone'  value='<?=$query_health->physician_phone   ?>'>
</div>
</div>




<div class="control-group">
<label class="control-label" for="inputPassword"> Have you had any serious illness, operation or been hospitalized ? </label>
<div class="controls">
<?
if($query_health->illness_operation_hospitalized  == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='yes' checked>
Yes
</label>	

<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='no' disabled>
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='yes' disabled>
Yes
</label>	

<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='no' checked>
No</label>
<?}?>


</div>
</div>



</div>               	
<div class="clearfix">  </div> 

<h1>Do you use alcohol, tobaco, drugs?  </h1>

<div style="margin-bottom:10px;" class="m-widget">

<form class="form-horizontal2 sigPad1">
<div class="control-group">
<label class="control-label" for="inputEmail">Do you drinks alcholic beverages ? </label>
<div class="controls">
<?
if($query_health->alcoholic_consumption   == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" checked>
Yes
</label>

<label class="radio inline">
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="no" id="alcoholic_consumption" disabled>
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" disabled>
Yes
</label>

<label class="radio inline">
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="no" id="alcoholic_consumption" checked>
No</label>
<?}?>

</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">
Have you used any recreation drug in the last 6 months ?</label>
<div class="controls">
<?
if($query_health->recreation_drug_usage    == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="yes" id="recreation_drug_usage" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="no" id="recreation_drug_usage" disabled>
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="yes" id="recreation_drug_usage" disabled>
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="no" id="recreation_drug_usage" checked>
No</label>
<?}?>


</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">History of alcohol abuse ?</label>
<div class="controls">
<?
if($query_health->alcohol_abuse   == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="yes" id="alcohol_abuse" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="no" id="alcohol_abuse" disabled>
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="yes" id="alcohol_abuse" disabled>
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="no" id="alcohol_abuse" checked>
No</label>
<? }?>	

</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword"> 
Do you use smoke?  </label>
<div class="controls">
<?
if($query_health->smoke   == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="smoke" name="smoke" value="yes" id="smoke" checked>
Yes
</label>

<label class="radio inline">
<input type="radio" data-attr="smoke" name="smoke" value="no" id="smoke" disabled>
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="smoke" name="smoke" value="yes" id="smoke" disabled>
Yes
</label>

<label class="radio inline">
<input type="radio" data-attr="smoke" name="smoke" value="no" id="smoke" checked>
No</label>
<?}?>			

</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword"> 
Do you use tobacco?  </label>
<div class="controls">
<?
if($query_health->tobacco    == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="tobacco" name="tobacco" value="yes" id="tobacco" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="tobacco" name="tobacco" value="no" id="tobacco" disabled>
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="tobacco" name="tobacco" value="yes" id="tobacco" disabled>
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="tobacco" name="tobacco" value="no" id="tobacco" checked>
No</label>
<? }?>		

</div> 
</div>




</div>
<div class="clearfix">  </div> 

<h1>Your medical condition  </h1>

<p>Have you had currently have any of the following conditions? Check the ones that are applicable<br>

<strong>HEART CONDITION</strong>
</p>

<div style="margin-bottom:10px;" class="m-widget" >

<form class="form-horizontal2 sigPad1">

<div class="control-group">
<label class="control-label">
<?
if($query_health->high_bp    == 'yes')
{?>
<input type="checkbox" data-attr="high_bp" name="high_bp" id='high_bp' value="yes" checked disabled>
High Blood Pressure
<?}
else
{?>
<input type="checkbox" data-attr="high_bp" name="high_bp" id='high_bp' value="yes" disabled>
High Blood Pressure
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->low_bp     == 'yes')
{?>
<input type="checkbox" data-attr="low_bp" name="low_bp" value="yes" id="low_bp" checked disabled>
Low Blood Pressure
<?}
else
{?>
<input type="checkbox" data-attr="low_bp" name="low_bp " value="no" id="low_bp" disabled>
Low Blood Pressure
<?}?>
</label>
</div>
</div>



<div class="control-group">
<label class="control-label">
<?
if($query_health->angina_chest_pain      == 'yes')
{?>
<input type="checkbox" data-attr="angina_chest_pain" name="angina_chest_pain" value="yes" checked disabled>
Angina Chest Pain
<?}
else
{?>
<input type="checkbox" data-attr="angina_chest_pain" name="angina_chest_pain " value="no"  disabled>
Angina Chest Pain
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->fainiting  == 'yes')
{?>
<input type="checkbox" data-attr="fainiting" name="fainiting " value="yes" id='fainiting '  checked disabled>
Fainting
<?}
else
{?>
<input type="checkbox" data-attr="fainiting" name="fainiting " value="no" id='fainiting '  disabled>
Fainting
<?}?>
</label>
</div>
</div>



<div class="control-group">
<label class="control-label">
<?
if($query_health->irregular_heartbeat   == 'yes')
{?>
<input type="checkbox" data-attr="irregular_heartbeat" name="irregular_heartbeat" value="yes" id='irregular_heartbeat ' checked disabled>
Irregular Heartbeat
<?}
else
{?>
<input type="checkbox" data-attr="irregular_heartbeat" name="irregular_heartbeat " value="no" id='irregular_heartbeat ' disabled>
Irregular Heartbeat
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->heart_attack    == 'yes')
{?>
<input type="checkbox" data-attr="heart_attack" name="heart_attack" id='heart_attack'  value="yes" checked disabled>
Heart Attack
<?}
else
{?>
<input type="checkbox" data-attr="heart_attack" name="heart_attack" id='heart_attack'  value="no" disabled>
Heart Attack
<?}?>
</label>
</div>
</div>


<div class="control-group">
<label class="control-label">
<?
if($query_health->heart_bypass   == 'yes')
{?>
<input type="checkbox" data-attr="heart_bypass" name="heart_bypass" id='heart_bypass' value="yes" checked disabled>
Heart Bypass
<?}
else
{?>
<input type="checkbox" data-attr="heart_bypass" name="heart_bypass" id='heart_bypass' value="no" disabled>
Heart Bypass
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->pacemaker    == 'yes')
{?>
<input type="checkbox" data-attr="pacemaker" name="pacemaker" id='pacemaker' value="yes" checked disabled>
Pacemaker
<?}
else
{?>
<input type="checkbox" data-attr="pacemaker" name="pacemaker" id='pacemaker' value="no"  disabled disabled>
Pacemaker
<?}?>
</label>
</div>
</div>

<div class="control-group">
<label class="control-label">
<?
if($query_health->anemia   == 'yes')
{?>
<input type="checkbox" data-attr="anemia" name="anemia " value="yes" id='anemia'  checked disabled>
Anemla
<?}
else
{?>
<input type="checkbox" data-attr="anemia" name="anemia " value="no" id='anemia' disabled >
Anemla
<?}?>
</label>


</div>

<div class="control-group">
<p><strong>LIVER DI & EA & E</strong></p>
<label class="radio inline">
<?
if($query_health->hepatitis_a    == 'yes')
{?>
<input type="checkbox" data-attr="hepatitis_a" name="hepatitis_a" value="yes" id="hepatitis_a" checked disabled>
Hepatitis A
<?}
else
{?>
<input type="checkbox" data-attr="hepatitis_a" name="hepatitis_a" value="no" id="hepatitis_a" disabled>
Hepatitis A
<?}?>
</label>


<label class="radio inline">
<?
if($query_health->hepatitis_b  == 'yes')
{?>
<input type="checkbox" data-attr="hepatitis_b" name="hepatitis_b" value="yes" id="hepatitis_b " checked disabled>
Hepatitis B
<?}
else
{?>
<input type="checkbox" data-attr="hepatitis_b" name="hepatitis_b" value="no" id="hepatitis_b "  disabled>
Hepatitis B
<?}?>
</label>

<label class="radio inline">
<?
if($query_health->hepatitis_c   == 'yes')
{?>
<input type="checkbox" data-attr="hepatitis_c" name="hepatitis_c" value="yes" id="hepatitis_c" checked disabled>
Hepatitis C
<?}
else
{?>
<input type="checkbox" data-attr="hepatitis_c" name="hepatitis_c" value="no" id="hepatitis_c" disabled >
Hepatitis C
<?}?>
</label>
</div>

<div class="control-group">
<p><strong>IMMUNOSUPPRESSED / BLOOD DISEASE</strong></p>
<label class="control-label">
<?
if($query_health->hiv == 'yes')
{?>
<input type="checkbox" name="hiv" data-attr="hiv" id='hiv'  value="yes" checked disabled>
HIV-
<?}
else
{?>
<input type="checkbox" name="hiv" data-attr="hiv" id='hiv'  value="no" disabled>
HIV-
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->aids == 'yes')
{?>
<input type="checkbox" name="aids"  data-attr="aids" id='aids' value="yes" checked disabled>
AIDS
<?}
else
{?>
<input type="checkbox" name="aids"  data-attr="aids" id='aids' value="no" disabled>
AIDS
<?}?>

</label>
</div>
</div>

<div class="control-group">

<label class="control-label">
<?
if($query_health->std == 'yes')
{?>
<input type="checkbox" name="std" data-attr="std" value="yes" id='std' checked disabled>
Sexually Transmitted Disease
<?}
else
{?>
<input type="checkbox" name="std" data-attr="std" value="no" id='std' disabled>
Sexually Transmitted Disease
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->delay_in_healing == 'yes')
{?>
<input type="checkbox" data-attr="delay_in_healing" name="delay_in_healing" value="yes"  id='delay_in_healing' checked disabled>
Delay in Healing
<?}
else
{?>
<input type="checkbox" data-attr="delay_in_healing" name="delay_in_healing" value="no"  id='delay_in_healing' disabled>
Delay in Healing
<?}?>
</label>
</div>
</div>


<div class="control-group">
<p><strong>ORGAN CONDITION / DISEASE</strong></p>
<label class="control-label">
<?
if($query_health->pancreas_diabetes == 'yes')
{?>
<input type="checkbox" data-attr="pancreas_diabetes" name="pancreas_diabetes" value="yes"  id='pancreas_diabetes' checked disabled>
pancreas diabetes
<?}
else
{?>
<input type="checkbox" data-attr="pancreas_diabetes" name="pancreas_diabetes" value="no"  id='pancreas_diabetes' disabled>
pancreas diabetes
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->kidney_dialysis == 'yes')
{?>
<input type="checkbox" data-attr="kidney_dialysis" name="kidney_dialysis" value="yes"  id='kidney_dialysis' checked disabled>
Kidney / Dialysis
<?}
else
{?>
<input type="checkbox" data-attr="kidney_dialysis" name="kidney_dialysis" value="no"  id='kidney_dialysis' disabled>
Kidney / Dialysis
<?}?>
</label>
</div>
</div>

<div class="control-group">		 
<label class="control-label">
<?
if($query_health->eyes_glaucoma == 'yes')
{?>
<input type="checkbox" data-attr="eyes_glaucoma" name="eyes_glaucoma" value="yes" checked id='eyes_glaucoma' disabled>
Eyes / Glaucoma
<?}
else
{?>
<input type="checkbox" data-attr="eyes_glaucoma" name="eyes_glaucoma" value="no"  id='eyes_glaucoma' disabled>
Eyes / Glaucoma
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->thyroid == 'yes')
{?>
<input type="checkbox" data-attr="thyroid" name="thyroid" value="yes" id='thyroid' checked disabled>
Thyroid
<?}
else
{?>
<input type="checkbox" data-attr="thyroid" name="thyroid" value="no" id='thyroid'  disabled>
Thyroid
<?}?>

</label>
</div>
</div>

<div class="control-group">

<label class="control-label">
<?
if($query_health->neurology_epilepsy == 'yes')
{?>
<input type="checkbox" data-attr="neurology_epilepsy" name="neurology_epilepsy" id='neurology_epilepsy' value="yes" checked disabled>
Neurology Epilepsy
<?}
else
{?>
<input type="checkbox" data-attr="neurology_epilepsy" name="neurology_epilepsy" id='neurology_epilepsy' value="no" disabled>
Neurology Epilepsy
<?}?>
</label>
</div>


<div class="control-group">
<p><strong>CANCER</strong></p>
<label class="control-label">
<?
if($query_health->cancer_location == 'yes')
{?>
<input type="checkbox" data-attr="cancer_location" name="cancer_location" id='cancer_location' value="yes" checked disabled>
Cancer Location
<?}
else
{?>
<input type="checkbox" data-attr="cancer_location" name="cancer_location" id='cancer_location' value="no" disabled>
Cancer Location
<?}?>
</label>


<div class="controls">
<div class='radio inline'>
<input class="input-large" type="text" placeholder="Location" value='<?= $query_health->cancer_location_name ?>' disabled>
</div>
</div>
</div>
<div class="control-group">
<label class="control-label">
<?
if($query_health->surgery == 'yes')
{?>
<input type="checkbox" data-attr="surgery" name="surgery" id='surgery'  value="yes" checked disabled>
Surgery 
<?}
else
{?>
<input type="checkbox" data-attr="surgery" name="surgery" id='surgery'  value="no" disabled>
Surgery 
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->radiation  == 'yes')
{?>
<input type="checkbox" data-attr="radiation" name="radiation" value="yes" id='radiation' checked disabled>
Radiation
<?}
else
{?>
<input type="checkbox" data-attr="radiation" name="radiation" value="no" id='radiation' disabled>
Radiation
<?}?>

</label>
</div>
</div>


<div class="control-group">
<label class="control-label">
<?
if($query_health->chemotherapy  == 'yes')
{?>
<input type="checkbox" data-attr="chemotherapy" name="chemotherapy" value="yes" checked id='chemotherapy' disabled>
Chemotherapy
<?}
else
{?>
<input type="checkbox" data-attr="chemotherapy" name="chemotherapy" value="no"  id='chemotherapy' disabled>
Chemotherapy
<?}?>
</label>


</div>


<div class="control-group">
<p><strong>JOINT CONDITION</strong></p>
<label class="control-label">
<?
if($query_health->jaw_joints_pain  == 'yes')
{?>
<input type="checkbox" data-attr="jaw_joints_pain" name="jaw_joints_pain" value="yes"  id='jaw_joints_pain' checked disabled>
Clicking / Pain in jaw joints when eating
<?}
else
{?>	 
<input type="checkbox" data-attr="jaw_joints_pain" name="jaw_joints_pain" value="no"  id='jaw_joints_pain' disabled>
Clicking / Pain in jaw joints when eating
<?}?>
</label>
<div class="controls">
<label class="radio inline">
<?
if($query_health->arthritis  == 'yes')
{?>
<input type="checkbox" data-attr="arthritis" name="arthritis" id='arthritis'  value="yes" checked disabled>
Arthritis
<?}
else
{?>
<input type="checkbox" data-attr="arthritis" name="arthritis" id='arthritis'  value="no" disabled>
Arthritis
<?}?>
</label>
</div>  


</div>


<div class="control-group">
<label class="control-label">
<?
if($query_health->arthritis_knee_replacement  == 'yes')
{?>
<input type="checkbox" data-attr="arthritis_knee_replacement" name="arthritis_knee_replacement" value="yes" checked disabled>
Arthritis Knee Replacement
<?}
else
{?>
<input type="checkbox" data-attr="arthritis_knee_replacement" name="arthritis_knee_replacement" value="no" disabled>
Arthritis Knee Replacement
<?}?>
</label>
<div class="controls">
<label class="radio inline">
<?
if($query_health->arthritis_hip_replacement  == 'yes')
{?>
<input type="checkbox" data-attr="arthritis_hip_replacement" name="arthritis_hip_replacement" value="yes" checked id='arthritis_hip_replacement' disabled>
Arthritis Hip Replacement
<?}
else
{?>
<input type="checkbox" data-attr="arthritis_hip_replacement" name="arthritis_hip_replacement" value="no"  id='arthritis_hip_replacement' disabled>
Arthritis Hip Replacement
<?}?>
</label>
</div>  
</div>

<div class="control-group">
<label class="control-label">
<?
if($query_health->swollen_ankles  == 'yes')
{?>
<input type="checkbox" data-attr="swollen_ankles" name="swollen_ankles" id='swollen_ankles'  value="yes" checked disabled>
Swollen Ankles
<?}
else
{?>
<input type="checkbox" data-attr="swollen_ankles" name="swollen_ankles" id='swollen_ankles '  value="no" disabled>
Swollen Ankles
<?}?>
</label>

</div>

<div class="control-group">
<label class="control-label">

Other
</label>
<div class="controls">
<div class='radio inline'>
<input class="input-large" type="text" placeholder="..."  id='other' name='other'  data-attr="other" value='<?= $query_health->other ?>' disabled>
</div>
</div>  

<div class="form-group">
<label for="treatment_signature" class="control-label" style="float:left;width:25%">Initials</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:380px;display:block;clear:none;width:400px">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output" class="output">
  </div>
 </div>
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearTreatmentSignature" attached_input="treatment_signature_div" style="margin-left:100px" href="#clear">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>




</div>	</div>	
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg" id="btnSubmitConsent" onclick='check_req_fieds4consent()'><i class="fa fa-check"></i> Save</a>
</div>
</div>
</div>

</form>
</div>




</div>
</div>


<div id="dropdown2" class="tab-pane fade">
<div class="row-fluid patient_history">
<div class="m-widget-body">
<form class="form-horizontal2 sigPad1">
<div class="row-fluid patient_history">
<h1>Insurance Details of  Primary Insured</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">


<div class="control-group">
<label class="control-label" for="inputPassword" style='  float: left;
width:350px;  padding-top: 5px;  text-align: left;'>Name of Primary Insured</label>
<div class="controls">
<input type="text"  placeholder="Name" value="<?= $insur->name_of_insured ?>" style=";background-color:#DDDDDD;" readonly="readonly">
</div>
</div>	

<div class="control-group">
<label class="control-label" for="inputPassword" style='  float: left;
width:350px;  padding-top: 5px;  text-align: left;'>Name Of The Patients </label>
<div class="controls">
<input type="text" placeholder="Name" value='<?= $query->fname ?>' style=";background-color:#DDDDDD;" readonly="readonly" >
</div>

</div> 
</form>

</div>


<div class="clearfix">  </div> 

<h1>Primary Insurance  </h1>

<div style="margin-bottom:10px;" class="m-widget">

<form class="form-horizontal2 sigPad1">
<div class="control-group">
<label class="control-label" for="inputPassword">Insurance Company </label>
<div class="controls">
<input type="text" placeholder=" Company Name" style=";background-color:#DDDDDD;" readonly="readonly" value='<?= $insur->insurance_company ?>'>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Group ID</label>
<div class="controls">
<input type="text" placeholder="ID" style=";background-color:#DDDDDD;" readonly="readonly" value='<?= $insur->group_id ?>'>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Member ID </label>
<div class="controls">
<input type="text" placeholder="ID" style=";background-color:#DDDDDD;" readonly="readonly" value='<?= $insur->member_id ?>'>
</div>
</div>



</form>

</div>

<div class="clearfix">  </div> 

<div class="well">
<ul class="thumbnails m-media-container">
<li class="span3">
<?
echo '<img id="img_switcher"  src="'.$insur->img1_location.'">';
?>
</li>
<li class="span3">
<?
echo '<img id="img_switcher"  src="'.$insur->img2_location.'">';
?>

</li>
</ul>
</div>
</div></div>
</div>
</div>
<!--end-->




<div id="dropdown3" class="tab-pane fade">
	<div class="row-fluid patient_history">
	<div class="m-widget-body">

	<div class="row-fluid patient_history">
	<h1>Patient Information/Informed Consent Form</h1>
	<div class="clearfix"></div>
	<div style="margin-bottom:10px;" class="m-widget">

	<div class="control-group" >
		<label class="control-label" for="inputPassword" style="width:100%">I have been informed by Dr. ___ that I have periodontal disease, and I agree to the following treatment that includes but is not limited to the following:
1) Nonsurgical periodontal therapy in either one appointment, or two to four separate appointments using:
· Ultrasonic scaling and tongue disinfection with irrigation
· Host modulation  Periostat Rx, literature, and verbal information
· Locally applied antimicrobials in all infected periodontal pockets
· Noninjectable periodontal gel
· Assessment of grinding or clenching habit
· Periodontal risk assessment
2) My treatment can be maintained with routine three-month periodontal maintenance visits with the hygienist
3) I am aware that some areas are more severely affected and referral to a periodontist may be necessary to achieve optimal oral and systemic health.
I am willing to undergo all recommendations and have a good understanding of my periodontal condition and my role in the success of my periodontal treatment.</label>
	<?
if($query->consent_aggrement == 'yes')	
{?>
<input type="checkbox" name="terms" id='terms' value="yes" checked>
<?}
else
{?>
<input type="checkbox" name="terms" id='terms' value="yes" >
<?}?>
&nbsp;&nbsp;&nbsp;I agree the Terms and Condition
	</div> 
	<!--</form>-->	
	</div>
</div>
</div>
</div>
</div>




<div id='dental_history' class="tab-pane fade">
<br>
<table class="table table-bordered patient_table" style="table-layout: fixed" id='csample' width='98%' border=1>
<thead style="width:100%; background:#43B5CB; color:#FFF;">
<tr>
<th>Doctor Name</th>
<th>Reason for Visit</th>
<th>Last visted Date</th>
<th>Last Dental Xray</th>
</tr>
</thead>
</table>

<div width='100%' style="height:300px; overflow-x:hidden;overflow-y:scroll;border:;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>

<tbody style="width:100%;">
<?
$i=0;
foreach($den_his as $p)
{
$last_dental_visit =date_format(date_create($p->last_dental_visit), 'M j, Y');
$date=date_format(date_create($p->last_dental_xray), 'M j, Y');
?>
<tr class='clickableRow' 
onclick="javascript:getdentalhis_details(<?echo $p->recnum ?>)">                                  
	<th><?php echo $p->formal_dentist;?></th>
	<th><?php echo $p->reason_today_visit?></th>
	<th><?php echo $last_dental_visit?></th>
	<th><?php echo $last_dental_visit?></th>
	</tr>
	<?php
        $i++;
}
/*echo <?php echo base_url()?>doctor_ctrl/dental_historydetails/<?echo $p->recnum ?>;
*/
?>
</tbody>
</table>
</div>
</table>
<input type='hidden' name='param' id='param' value=''>

</div>

</div>
</body>
</html>

