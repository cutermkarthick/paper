<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 18, 2015                 =
// Filename: patient_profile_view.php          =
// Copyright of Fluent Technologies            =
// Displays patient Information                =
//==============================================
?>
<!DOCTYPE html>
<html>
<head>
<title>Paperless Dentists</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/style.css" />
<link rel="stylesheet" type="text/css" href="css/meda.css" />
<link href="https://www.paperlessdentists.com/portal/libs/custom/css/centered-cols.css" rel="stylesheet">
<link rel="stylesheet" href="<?echo base_url()?>signature-pad/build/jquery.signaturepad.css">
<script src="<?echo base_url()?>signature-pad/build/flashcanvas.js"></script>
<script src="<?echo base_url()?>signature-pad/build/json2.min.js"></script>
<script src="<?echo base_url()?>signature-pad/jquery.signaturepad.js"></script>
<script src="<?echo base_url()?>signature-pad/build/jquery.signaturepad.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() 
{
var count_treatment="<? echo count($treatment_to_be)  ?>";
var count_drugs_med="<? echo count($drugs_med)  ?>";
var count_changes_treat=parseInt("<? echo count($changes_treat)  ?>");
var count_extact="<? echo count($extact)  ?>";
var count_crown="<? echo count($crown)  ?>";
var count_denture="<? echo count($denture)  ?>";
var count_endendontic="<? echo count($endendontic)  ?>";
var count_perio="<? echo count($perio)  ?>";
var count_filling="<? echo count($filling)  ?>";
var count_pedodontic="<? echo count($pedodontic)  ?>";

<?
if(count($treatment_to_be )  > 0)
{?>
      var sig = '<?php echo $treatment_to_be->signature ?>';
      $('.sigPad4treat').signaturePad({displayOnly : true}).regenerate(sig);
    document.forms['form-horizontal120'].output4treatment.value='';
<?}
else
{?>
   $('.sigPad4treat').signaturePad({drawOnly : true});
<?}

if(count($drugs_med )  > 0)
{?>
      var sig = '<?php echo $drugs_med ->signature ?>';
      $('.sigPad4drugs').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal120'].output4drug_med.value='';
<?}
else
{?>
$('.sigPad4drugs').signaturePad({drawOnly : true});
<?}

if(count($changes_treat)  > 0)
{?>
var sig1 = '<?php echo $changes_treat->signature ?>';
  $('.sigPad4changes_treat').signaturePad({displayOnly : true}).regenerate(sig1);
document.forms['form-horizontal120'].output4treat_plan.value='';
<?}
else
{?>
$('.sigPad4changes_treat').signaturePad({drawOnly : true});
<?}

if(count($extact)  > 0)
{?>
      var sig = '<?php echo $extact->signature ?>';
$('.sigPad4extract').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal120'].output4extraction.value='';
<?}
else
{?>
$('.sigPad4extract').signaturePad({drawOnly : true});
<?}

if(count($crown)  > 0)
{?>
      var sig = '<?php echo $crown->signature ?>';
      $('.sigPad4crown').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal120'].output4crown.value='';
<?}
else
{?>
$('.sigPad4crown').signaturePad({drawOnly : true});
<?}

if(count($denture)  > 0)
{?>
      var sig = '<?php echo $denture->signature ?>';
      $('.sigPad4denture').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal120'].output4denture.value='';
<?}
else
{?>
$('.sigPad4denture').signaturePad({drawOnly : true});
<?}

if(count($endendontic)  > 0)
{?>
      var sig = '<?php echo $endodontic->signature ?>';
      $('.sigPad4endodontic').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal120'].output4endodontic.value='';
<?}
else
{?>
$('.sigPad4endodontic').signaturePad({drawOnly : true});
<?}

if(count($perio)  > 0)
{?>
      var sig = '<?php echo $perio->signature ?>';
      $('.sigPad4periodontal').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal120'].output4peridontal.value='';
<?}
else
{?>
$('.sigPad4periodontal').signaturePad({drawOnly : true});
<?}

if(count($filling)  > 0)
{?>
      var sig = '<?php echo $filling->signature ?>';
      $('.sigPad4filling').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal120'].output4filling.value='';
<?}
else
{?>
$('.sigPad4filling').signaturePad({drawOnly : true});
<?}

if(count($pedodontic)  > 0)
{?>
      var sig = '<?php echo $pedodontic->signature ?>';
      $('.sigPad4pedo').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal120'].output4pedodontic.value='';
<?}
else
{?>
$('.sigPad4pedo').signaturePad({drawOnly : true});
<?}?>
$('.sigPad1').signaturePad({drawOnly : true});
});

</script>

<style type="text/css">
html 
{
	/*position: relative;*/
	min-height: 100%;
}
body
{
	padding-top: 5px;
	padding-bottom: 5px;
	margin-top: 5px;
	margin-bottom: 15px;
}
.well-color
{
	color: #5a5a5a;
}

.topbuffer
{
	margin-top: 15px;
}

.topslimbuffer
{
	margin-top: 5px;
}

.topbottombuffer {
	margin-top: 5px;
	margin-bottom: 20px;
}

.toppaddedbuffer {
	margin-top: 15px;
	padding: 3px 3px 3px 3px;
}

.topslimpaddedbuffer {
	margin-top: 5px;
	padding: 3px 3px 3px 3px;
}

.bottomslimbuffer {
	margin-bottom: 5px;
}

.topbottompaddedbuffer {
	margin-top: 5px;
	margin-bottom: 15px;
	padding: 3px 3px 3px 3px;
}

.error-block {
	display: block;
	margin-top: 5px;
	margin-bottom: 10px;
	color: #ff0000;
}

.alert-block {
	display: block;
	margin-top: 5px;
	margin-bottom: 10px;
	color: #a94442;
	background-color: #f2dede;
	border-color: #ebccd1;
}

.spaced {
	margin: 10px 0;
}

#calendar {
	width: 100%;
	margin: 0 auto;
}

.icon-red {
	color: #ff0000;
}

#message {
	background-color: #FFFFFF;
	border: 1px solid #CCCCCC;
	border-collapse: separate;
	border-radius: 3px;
	box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.075) inset;
	box-sizing: content-box;
	height: 250px;
	max-height: 250px;
	outline: medium none;
	overflow: scroll;
	padding: 4px;
}

.ellipsis {
	text-overflow: ellipsis !important;
	overflow: hidden;
	white-space: nowrap;
	/*display: block;*/
	max-width: 200px;
}

.bold {
	font-weight: bold;
}

.form-color {
	background-color: #f5f5f5;
	border: 1px solid #ddd;
	padding-left: 2px;
}

.medicalAlert {
	color: red !important;
	font-weight: bold !important;
}


.cursor-pointer:hover {
	cursor: pointer;
    cursor: hand;
}


td.highlight {
	font-weight: bold;
	color: black;
}

td.unhighlight {
	font-weight: normal;
	color: black;
}

/** COLORFUL BADGES ***/

.badge-error {
  background-color: #b94a48;
}
.badge-error:hover {
  background-color: #953b39;
}
.badge-warning {
  background-color: #f89406;
}
.badge-warning:hover {
  background-color: #c67605;
}
.badge-success {
  background-color: #468847;
}
.badge-success:hover {
  background-color: #356635;
}
.badge-info {
  background-color: #3a87ad;
}
.badge-info:hover {
  background-color: #2d6987;
}
.badge-inverse {
  background-color: #333333;
}
.badge-inverse:hover {
  background-color: #1a1a1a;
}

#dentistSignature {
	color: darkblue;
	background-color: #f5f5f5;
	padding: 2px;
	border: 2px dotted #000;
}

#patientSignature {
	color: darkblue;
	background-color: #f5f5f5;
	padding: 2px;
	border: 2px dotted #000;
}

#signature {
	padding: 2px;
	margin: 1 1 1 1;
	border: 2px dotted #000;
}
.signature {
	color: darkblue;
	background-color: #f5f5f5;
	padding: 2px;
	border: 2px dotted #000;
}

/* Sticky footer styles
-------------------------------------------------- */
html,body {
	height: 100%;
	/* The html and body elements cannot have any padding or margin. */
}

/* Wrapper for page content to push down footer */
#wrap {
	min-height: 100%;
	height: auto !important;
	height: 100%;
	/* Negative indent footer by its height */
	margin: 0 auto -50px;
	/* Pad bottom by footer height */
	padding: 0 0 50px;
}

#footer {
	width: 100%;
	height : 50px;
}

</style>


<script type='text/javascript'>
var url=(window.location.href);

//var parameter =  url.split('/').pop();
var parameter = "<?echo $param  ?>";

var divid =  url.split('#').pop();

$(document).ready(function() 
{ 

$('#myTab li').click(function()  
{
$("#home").css({"display": "none"});
$("#profile").css({"display": "none"});
$("#dropdown1").css({"display":  "none"});
$("#dropdown2").css({"display": "none"});
$("#dropdown3").css({"display": "none"});
$("#consent").css({"display": "none"});
$("#dental_history").css({"display": "none"});

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
else if(param == 'familymember')
{
$("#dropdown3").css({"display": "block"});
$('#dropdown3').addClass('active in');
}   
else if(param == 'consent')
{
$("#consent").css({"display": "block"});
$('#consent').addClass('active in');
}  
else if(param == 'dental_history')
{
$("#dental_history").css({"display": "block"});
$('#dental_history').addClass('active in');
}   
});

$("#myTab li#home1").removeClass("active");
$("#home").css({"display": "none"});
$("#profile").css({"display": "none"});
$("#dropdown1").css({"display":  "none"});
$("#dropdown2").css({"display": "none"});
$("#dropdown3").css({"display": "none"});	
$("#consent").css({"display": "none"});
$("#dental_history").css({"display": "none"});

if(parameter == 'home1'  || parameter == 'profile' || parameter == ''  )
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
else if(parameter == 'consent' )
{
$("#myTab li#consent").addClass("active");
$("#consent").css({"display" :"inline" });
$("#consent").addClass("active in");
} 
else if(parameter == 'dental_history' )
{
$("#myTab li#dental_history").addClass("active");
$("#dental_history").css({"display" :"inline" });
$("#dental_history").addClass("active in");
}
$('html, body').animate({ scrollTop: 0 }, 20);	
});

function getaccordian(divid)
{
	if($('#'+divid).css("display") == "inline")
	{
	$('#'+divid).css({"display" :"none" });
	 $('#'+divid).removeClass("in");
	}
	else
	{
	 $('#'+divid).css({"display" :"inline" });
	 $('#'+divid).addClass("in");
	}
}

function getparam_value(param)
{
  document.forms['form-horizontal130'].param.value=param;
  document.forms['form-horizontal130'].submit();
}
function getupdate_profile(param)
{
document.forms['form-horizontal140'].param.value=param;
  document.forms['form-horizontal140'].submit();
}
function getfamily_id(value)
{
  document.forms['form-hor150'].value.value=value;
  document.forms['form-hor150'].submit();
}
</script>
<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal100','name'=>'form-horizontal140');
echo form_open_multipart('patient_ctrl/update_patient',$attr);
?>
<input type='hidden' name='param' id='param' value="<?echo $param ?>">
</form>

<?
$attr1 = array('class' => 'form-hor150','name'=>'form-hor150','id'=>'form-hor150');
echo form_open_multipart('patient_ctrl/family_info', $attr1);
?>
<input type='hidden' name='value' id='value' value=''>
</form>


<!---------------------changed on march 27 2015------------------------------------->


 <?
$style=' "background-color:#DFDFDF;" readonly ';

$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal100','name'=>'form-horizontal130');
echo form_open_multipart('patient_ctrl/update_profile',$attr);
?>
<input type='hidden' name='param' id='param' value="<?echo $param ?>">
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url (); ?>">

<link rel="stylesheet" type="text/css" href="css/font_awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font_awesome/css/font-awesome.css"/>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
</head>
<body>


<div class="main-container">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:10px 0px;"class="sub_title row-fluid">
<div class="span6"> <h1>Welcome to <?php echo $query->fullname ?> </h1></div> 

<div class="row-fluid">
<div class="span9">
<div class="m-widget dashbord_box">
<div class="row-fluid">
</div>
<?
//$str =array_pop( explode('/', $url) );
$str=$param;
?>
<div>
<?
if($str == 'home1' || $str == 'profile')
{?>
<h1 style='margin-top:4px;margin-right:4px'>Personal Info
<?}
elseif($str == 'profile1')
{?>
<h1>Emergency Info
<?}
elseif($str == 'dropdown11')
{?>
<h1>Health History
<?}
elseif($str == 'dropdown21')
{?>
<h1>Insurance Info
<?}
elseif($str == 'familymember')
{?>
<h1>Family Members
<?}
elseif($str == 'consent')
{?>
<h1>Consent Form
<?}
elseif($str == 'dental_history')
{?>
<h1>Dental History
<?}
if($str != 'familymember' && $str != 'consent' && $str != 'dental_history')
{?>
<img style='float:right' src="<?php echo base_url();?>img/edit.png" width="34" height="34" onclick="javascript:getupdate_profile('<?= $str ?>')">
<?}
?>
</h1></div>



<div class="m-widget-body">
<div class="tab-content" id="myTabContent">
<div  id="home" class="tab-pane fade active in">
<div class="row-fluid patient_history">
<h1>Personal Details dsfg</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">

<form class="form-horizontal2">
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
$dob=$dddob[1].'-'.$dddob[2].'-'.$dddob[0];
?>
<div class="control-group">
<label class="control-label" for="inputEmail">Date of Birth</label>
<div class="controls">
<?php echo form_input(array('id' => 'dob', 'name' => 'dob','placeholder' => 'DD/MM/YYYY','style'=>$style,'value'=>$dob)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Gender</label>
<div class="controls">
<label class="radio inline">
<?php
if( $query->gender  == 'M' ||  $query->gender == 'm')
{?>
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" checked>Male
</label>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false" >
Female</label>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false" >
Other</label>
 
<?}
else if( $query->gender  == 'F' ||  $query->gender == 'f')
{
?>
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false">
Male
</label>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" checked>
Female</label> 
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false" >
Other</label>

<?}
else 
{?>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false">
Male
</label>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false">
Female
</label>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" checked>
Other</label> 
	
<?php	
}
?>
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
<?
if ($pagename == 'patient_update')
{ 
echo form_submit(array('id' => 'submit', 'class' => 'btn btn-large btn-success', 'value' => 'Submit')); 
}      
?>	
</div></div>

<div id="profile" class="tab-pane fade">
<div class="row-fluid patient_history">

<div style="margin-bottom:10px;" class="m-widget">

<?
$attr=array('id' => 'form-horizontal2');
echo form_open_multipart('patient_ctrl/insert_profile',$attr);
?>
<input type='hidden' name='base_url' id='base_url' value="<?= base_url()  ?>">
<h1> Emergency Contact Person's Details</h1>
<br>
<div class="control-group">
<label class="control-label" for="inputEmail" style="  float: left;width:350px;  padding-top: 5px;  text-align: left;">First Name </label>
<div class="controls">

<?php 
if(!empty($query_emer))
{
echo form_input(array('id' => 'emer_fname', 'name' => 'emer_fname','placeholder' => 'First Name','style'=>$style,'value'=>$query_emer->fname));
}
else
{
echo form_input(array('id' => 'emer_fname', 'name' => 'emer_fname','placeholder' => 'First Name','style'=>$style,'value'=>''));	
}
	

 ?>

</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail" style="  float: left;width:350px;  padding-top: 5px;  text-align: left;"> Middle Initial Or Name</label>
<div class="controls">
<?php
if(!empty($query_emer))
{
 echo form_input(array('id' => 'emer_midname', 'name' => 'emer_midname','placeholder' => 'Middle Initial Or Name','style'=>$style,'value'=>$query_emer->middle_initial)); 
}
else 
{
echo form_input(array('id' => 'emer_midname', 'name' => 'emer_midname','placeholder' => 'Middle Initial Or Name','style'=>$style,'value'=>'')); 	
} 

 ?>

</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail" style="  float: left;width:350px;  padding-top: 5px;  text-align: left;">Last Name</label>
<div class="controls">
<?php 
if(!empty($query_emer))
{
echo form_input(array('id' => 'emer_lname', 'name' => 'emer_lname','placeholder' => 'Last Name','style'=>$style,'value'=>$query_emer->lname)); 
}
else
{
echo form_input(array('id' => 'emer_lname', 'name' => 'emer_lname','placeholder' => 'Last Name','style'=>$style,'value'=>'')); 	
}
?>
</div>
</div>



<h1> Emergency Contact Person's Contact Info </h1>
<div class="alert alert-info">  At least one of three phones is required </div>
<div class="control-group">
<label class="control-label" for="inputEmail" style="  float: left;width:350px;  padding-top: 5px;  text-align: left;">Home phone </label>
<div class="controls">
<?php 
if(!empty($query_emer))
{
echo form_input(array('id' => 'emer_homenum', 'name' => 'emer_homenum','placeholder' => 'Home phone','style'=>$style,'value'=>$query_emer->home_phone));
}
else
{
echo form_input(array('id' => 'emer_homenum', 'name' => 'emer_homenum','placeholder' => 'Home phone','style'=>$style,'value'=>''));	
}	

 ?>

</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail" style="  float: left;width:350px;  padding-top: 5px;  text-align: left;">Cell  phone</label>
<div class="controls">
<?php 
if(!empty($query_emer))
{
echo form_input(array('id' => 'emer_cellnum', 'name' => 'emer_cellnum','placeholder' => 'Cell phone','style'=>$style,'value'=>$query_emer->cell_phone));
}
else
{
echo form_input(array('id' => 'emer_cellnum', 'name' => 'emer_cellnum','placeholder' => 'Cell phone','style'=>$style,'value'=>''));	
}	
 ?>


</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail" style="  float: left;width:350px;  padding-top: 5px;  text-align: left;">Work phone</label>
<div class="controls"> 
<?php
if(!empty($query_emer))
{
 echo form_input(array('id' => 'emer_worknum', 'name' => 'emer_worknum','placeholder' => 'Work phone','style'=>$style,'value'=>$query_emer->work_phone)); 
}
else
{
echo form_input(array('id' => 'emer_worknum', 'name' => 'emer_worknum','placeholder' => 'Work phone','style'=>$style,'value'=>'')); 	
}	
 ?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail" style="  float: left;width:350px;  padding-top: 5px;  text-align: left;">Email</label>
<div class="controls">
<?php
if(!empty($query_emer))
{
 echo form_input(array('id' => 'emer_email', 'name' => 'emer_email','placeholder' => 'Email','style'=>$style,'value'=>$query_emer->email)); 
}
else
{
echo form_input(array('id' => 'emer_email', 'name' => 'emer_email','placeholder' => 'Email','style'=>$style,'value'=>'')); 	
}	
 ?>
 
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail" style="  float: left;width:350px;  padding-top: 5px;  text-align: left;">Relationship</label>
<div class="controls">			
<?php 
if(!empty($query_emer))
{
echo form_input(array('id' => 'emer_relation', 'name' => 'emer_relation','placeholder' => 'Relationship','style'=>$style,'value'=>$query_emer->relationship)); 
}
else
{
echo form_input(array('id' => 'emer_relation', 'name' => 'emer_relation','placeholder' => 'Relationship','style'=>$style,'value'=>'')); 	
}	
	
?>
</div>
</div>	


</form>

</div>




</div>
</div>
<div id="dropdown1" class="tab-pane fade">
<div class="row-fluid patient_history">

<?php

if(!empty($query_health))
{
	$height_inches = $query_health->height_inches ;
	$weight_lbs    = $query_health->weight_lbs ;
	$are_you_in_good_health  = $query_health->are_you_in_good_health ;
	$under_physician_care = $query_health->under_physician_care;
	$illness_operation_hospitalized = $query_health->illness_operation_hospitalized ;
	$alcoholic_consumption = $query_health->alcoholic_consumption ;
	$recreation_drug_usage = $query_health->recreation_drug_usage  ;
	$alcohol_abuse   = $query_health->alcohol_abuse ;
	$smoke  = $query_health->smoke;
	$tobacco = $query_health->tobacco ;
	$physician_phone = $query_health->physician_phone ;
	$other = $query_health->other ;
		
}
else
{
	$height_inches ='' ;
	$weight_lbs ='' ;
	$are_you_in_good_health ='' ;
	$under_physician_care ='' ;
	$illness_operation_hospitalized ='' ;
	$alcoholic_consumption ='' ;
	$recreation_drug_usage ='' ;
	$alcohol_abuse ='' ;
	$smoke ='' ;
	$tobacco ='' ;
	$physician_phone  ='';
	$other ='';
	
}	
?>


<h1>Your Weight and height </h1>
<div class="clearfix">  </div>
<div style="margin-bottom:10px;" class="m-widget">

<form class="form-horizontal2">
<div class="control-group">
<label class="control-label" for="inputEmail">Height (in inches)</label>
<div class="controls">
<input type="text" placeholder="00" style=";background-color:#DDDDDD;" readonly="readonly"
style=";background-color:#DDDDDD;" readonly="readonly" name='height_inches' id='height_inches' value='<?= $height_inches ?>'>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Weight (in pounds)</label>
<div class="controls">
<input type="text" placeholder="00" name='weight_lbs' id='weight_lbs' style=";background-color:#DDDDDD;" readonly="readonly" style=";background-color:#DDDDDD;" readonly="readonly" value='<?= $weight_lbs?>'>
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

<? 
if($are_you_in_good_health  == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="are_you_in_good_health" value="yes" id="goodhealth_0" checked>
Yes
</label>					
<label class="radio inline">
<input type="radio" name="are_you_in_good_health" value="no" id="goodhealth_1" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="are_you_in_good_health" value="yes" id="are_you_in_good_health" onclick="return false">
Yes
</label>					
<label class="radio inline">
<input type="radio" name="are_you_in_good_health" value="no" id="are_you_in_good_health" checked>
No</label>
<?}?>				

</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Are you now under the care of a physician ?</label>
<div class="controls">					
<? 
if($under_physician_care   == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="under_physician_care" value="yes" id="under_physician_care" checked>
Yes
</label>					
<label class="radio inline">
<input type="radio" name="under_physician_care" value="no" id="under_physician_care" onclick="return false">
No</label>	
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="under_physician_care" value="yes" id="under_physician_care" onclick="return false">
Yes
</label>					
<label class="radio inline">
<input type="radio" name="under_physician_care" value="no" id="under_physician_care" checked>
No</label>
<?}?>


</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Physician's Telephone</label>
<div class="controls">
<input class="input-large" type="text" placeholder="Phone No" style=";background-color:#DDDDDD;" readonly="readonly" name='physician_phone' id='physician_phone'  value='<?=$physician_phone   ?>'>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword"> Have you had any serious illness, operation or been hospitalized ? </label>
<div class="controls">
<?
if($illness_operation_hospitalized  == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='yes' checked>
Yes
</label>	

<label class="radio inline">
<input type="radio" name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='no' onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='yes' onclick="return false">
Yes
</label>	

<label class="radio inline">
<input type="radio" name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='no' checked>
No</label>
<?}?>


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
<?
if($alcoholic_consumption   == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" checked>
Yes
</label>

<label class="radio inline">
<input type="radio" name="alcoholic_consumption" value="no" id="alcoholic_consumption" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" onclick="return false">
Yes
</label>

<label class="radio inline">
<input type="radio" name="alcoholic_consumption" value="no" id="alcoholic_consumption" checked>
No</label>
<?}?>

</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">
Have you used any recreation drug in the last 6 months ?</label>
<div class="controls">
<?
if($recreation_drug_usage    == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="recreation_drug_usage" value="yes" id="recreation_drug_usage" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" name="recreation_drug_usage" value="no" id="recreation_drug_usage" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="recreation_drug_usage" value="yes" id="recreation_drug_usage" onclick="return false">
Yes
</label>				
<label class="radio inline">
<input type="radio" name="recreation_drug_usage" value="no" id="recreation_drug_usage" checked>
No</label>
<?}?>


</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">History of alcohol abuse ?</label>
<div class="controls">
<?
if($alcohol_abuse   == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="alcohol_abuse" value="yes" id="alcohol_abuse" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" name="alcohol_abuse" value="no" id="alcohol_abuse" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="alcohol_abuse" value="yes" id="alcohol_abuse" onclick="return false">
Yes
</label>				
<label class="radio inline">
<input type="radio" name="alcohol_abuse" value="no" id="alcohol_abuse" checked>
No</label>
<? }?>	

</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword"> 
Do you use smoke?  </label>
<div class="controls">
<?
if($smoke   == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="smoke" value="yes" id="smoke" checked>
Yes
</label>

<label class="radio inline">
<input type="radio" name="smoke" value="no" id="smoke" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="smoke" value="yes" id="smoke" onclick="return false">
Yes
</label>

<label class="radio inline">
<input type="radio" name="smoke" value="no" id="smoke" checked>
No</label>
<?}?>			

</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword"> 
Do you use tobacco?  </label>
<div class="controls">
<?
if($tobacco    == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="tobacco" value="yes" id="tobacco" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" name="tobacco" value="no" id="tobacco" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="tobacco" value="yes" id="tobacco" onclick="return false">
Yes
</label>				
<label class="radio inline">
<input type="radio" name="tobacco" value="no" id="tobacco" checked>
No</label>
<? }?>		

</div> 
</div>



</form>

</div>




<div class="clearfix">  </div> 

<h1>Your medical condition  </h1>

<p>Have you had currently have any of the following conditions? Check the ones that are applicable<br>
<!--
<strong>HEART CONDITION</strong>
</p>

<div style="margin-bottom:10px;" class="m-widget">

<form class="form-horizontal2">

<div class="control-group">
<label class="control-label">
<?
if($query_health->high_bp    == 'yes')
{?>
<input type="checkbox" name="high_bp" id='high_bp' value="yes" checked onclick="return false" >
<span style="color:#FF0000">High Blood Pressure</span>
<?}
else
{?>
<input type="checkbox" name="high_bp" id='high_bp' value="yes" onclick="return false" onclick="return false">
High Blood Pressure
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->low_bp     == 'yes')
{?>
<input type="checkbox" name="low_bp " value="yes" id="low_bp" checked onclick="return false">
<span style="color:#FF0000">Low Blood Pressure</span>
<?}
else
{?>
<input type="checkbox" name="low_bp " value="no" id="low_bp" onclick="return false">
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
<input type="checkbox" name="angina_chest_pain " value="yes" checked onclick="return false">
<span style="color:#FF0000">Angina Chest Pain</span>
<?}
else
{?>
<input type="checkbox" name="angina_chest_pain " value="no"  onclick="return false">
Angina Chest Pain
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->fainiting  == 'yes')
{?>
<input type="checkbox" name="fainiting " value="yes" id='fainiting '  checked onclick="return false">
<span style="color:#FF0000">Fainting</span>
<?}
else
{?>
<input type="checkbox" name="fainiting " value="no" id='fainiting '  onclick="return false">
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
<input type="checkbox" name="irregular_heartbeat " value="yes" id='irregular_heartbeat ' checked onclick="return false">
<span style="color:#FF0000">Irregular Heartbeat</span>
<?}
else
{?>
<input type="checkbox" name="irregular_heartbeat " value="no" id='irregular_heartbeat ' onclick="return false">
Irregular Heartbeat
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->heart_attack    == 'yes')
{?>
<input type="checkbox" name="heart_attack" id='heart_attack'  value="yes" checked onclick="return false">
<span style="color:#FF0000">Heart Attack</span>
<?}
else
{?>
<input type="checkbox" name="heart_attack" id='heart_attack'  value="no" onclick="return false">
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
<input type="checkbox" name="heart_bypass" id='heart_bypass' value="yes" checked onclick="return false">
<span style="color:#FF0000">Heart Bypass</span>
<?}
else
{?>
<input type="checkbox" name="heart_bypass" id='heart_bypass' value="no" onclick="return false">
Heart Bypass
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->pacemaker    == 'yes')
{?>
<input type="checkbox" name="pacemaker" id='pacemaker' value="yes" checked onclick="return false">
<span style="color:#FF0000">Pacemaker</span>
<?}
else
{?>
<input type="checkbox" name="pacemaker" id='pacemaker' value="no"  onclick="return false" onclick="return false">
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
<input type="checkbox" name="anemia " value="yes" id='anemia'  checked onclick="return false">
<span style="color:#FF0000">Anemla</span>
<?}
else
{?>
<input type="checkbox" name="anemia " value="no" id='anemia' onclick="return false" >
Anemla
<?}?>
</label>


</div>

<div class="control-group">
<p><strong>LIVER DI & EA & E</strong></p>
<label class="checkbox inline">
<?
if($query_health->hepatitis_a    == 'yes')
{?>
<input type="checkbox" name="hepatitis_a " value="yes" id="hepatitis_a" checked onclick="return false">
<span style="color:#FF0000">Hepatitis A</span>
<?}
else
{?>
<input type="checkbox" name="hepatitis_a " value="no" id="hepatitis_a" onclick="return false">
Hepatitis A
<?}?>
</label>


<label class="checkbox inline">
<?
if($query_health->hepatitis_b  == 'yes')
{?>
<input type="checkbox" name="hepatitis_b" value="yes" id="hepatitis_b " checked onclick="return false">
<span style="color:#FF0000">Hepatitis B</span>
<?}
else
{?>
<input type="checkbox" name="hepatitis_b" value="no" id="hepatitis_b "  onclick="return false">
Hepatitis B
<?}?>
</label>

<label class="checkbox inline">
<?
if($query_health->hepatitis_c   == 'yes')
{?>
<input type="checkbox" name="hepatitis_c" value="yes" id="hepatitis_c" checked onclick="return false">
<span style="color:#FF0000">Hepatitis C</span>
<?}
else
{?>
<input type="checkbox" name="hepatitis_c" value="no" id="hepatitis_c" onclick="return false" >
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
<input type="checkbox" name="hiv" id='hiv'  value="yes" checked onclick="return false">
<span style="color:#FF0000">HIV-</span>
<?}
else
{?>
<input type="checkbox" name="hiv" id='hiv'  value="no" onclick="return false">
HIV-
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->aids == 'yes')
{?>
<input type="checkbox" name="aids"  id='aids' value="yes" checked onclick="return false">
<span style="color:#FF0000">AIDS</span>
<?}
else
{?>
<input type="checkbox" name="aids"  id='aids' value="no" onclick="return false">
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
<input type="checkbox" name="std" value="yes" id='std' checked onclick="return false">
<span style="color:#FF0000">Sexually Transmitted Disease</span>
<?}
else
{?>
<input type="checkbox" name="std" value="no" id='std' onclick="return false">
Sexually Transmitted Disease
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->delay_in_healing == 'yes')
{?>
<input type="checkbox" name="delay_in_healing" value="yes"  id='delay_in_healing' checked onclick="return false">
<span style="color:#FF0000">Delay in Healing</span>
<?}
else
{?>
<input type="checkbox" name="delay_in_healing" value="no"  id='delay_in_healing' onclick="return false">
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
<input type="checkbox" name="pancreas_diabetes" value="yes"  id='pancreas_diabetes' checked onclick="return false">
<span style="color:#FF0000">pancreas diabetes</span>
<?}
else
{?>
<input type="checkbox" name="pancreas_diabetes" value="no"  id='pancreas_diabetes' onclick="return false">
pancreas diabetes
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->kidney_dialysis == 'yes')
{?>
<input type="checkbox" name="kidney_dialysis" value="yes"  id='kidney_dialysis' checked onclick="return false">
<span style="color:#FF0000">Kidney / Dialysis</span>
<?}
else
{?>
<input type="checkbox" name="kidney_dialysis" value="no"  id='kidney_dialysis' onclick="return false">
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
<input type="checkbox" name="eyes_glaucoma" value="yes" checked id='eyes_glaucoma' onclick="return false">
<span style="color:#FF0000">Eyes / Glaucoma</span>
<?}
else
{?>
<input type="checkbox" name="eyes_glaucoma" value="no"  id='eyes_glaucoma' onclick="return false">
Eyes / Glaucoma
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->thyroid == 'yes')
{?>
<input type="checkbox" name="thyroid" value="yes" id='thyroid' checked onclick="return false">
<span style="color:#FF0000">Thyroid</span>
<?}
else
{?>
<input type="checkbox" name="thyroid" value="no" id='thyroid'  onclick="return false">
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
<input type="checkbox" name="neurology_epilepsy" id='neurology_epilepsy' value="yes" checked onclick="return false">
<span style="color:#FF0000">Neurology Epilepsy</span>
<?}
else
{?>
<input type="checkbox" name="neurology_epilepsy" id='neurology_epilepsy' value="no" onclick="return false">
Neurology Epilepsy
<?}?>
</label>
</div>


<div class="control-group">
<p><strong>CANCER</strong></p>
<label class="control-label ">
<?
if($query_health->cancer_location == 'yes')
{?>
<input type="checkbox" name="cancer_location" id='cancer_location' value="yes" checked onclick="return false">
<span style="color:#FF0000">Cancer Location</span>
<?}
else
{?>
<input class='radio inline' type="checkbox" name="cancer_location" id='cancer_location' value="no" onclick="return false">
Cancer Location
<?}?>
</label>


<div class="controls">
<div class='radio inline'>
<input class="input-large radio inline" type="text" placeholder="Location" value='<?= $query_health->cancer_location_name ?>' onclick="return false">
</div>
</div>
</div>
<div class="control-group">
<label class="control-label">
<?
if($query_health->surgery == 'yes')
{?>
<input type="checkbox" name="surgery" id='surgery'  value="yes" checked onclick="return false">
<span style="color:#FF0000">Surgery</span> 
<?}
else
{?>
<input type="checkbox" name="surgery" id='surgery'  value="no" onclick="return false">
Surgery 
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->radiation  == 'yes')
{?>
<input type="checkbox" name="radiation" value="yes" id='radiation' checked onclick="return false">
<span style="color:#FF0000">Radiation</span>
<?}
else
{?>
<input type="checkbox" name="radiation" value="no" id='radiation' onclick="return false">
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
<input type="checkbox" name="chemotherapy" value="yes" checked id='chemotherapy' onclick="return false">
<span style="color:#FF0000">Chemotherapy</span>
<?}
else
{?>
<input type="checkbox" name="chemotherapy" value="no"  id='chemotherapy' onclick="return false">
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
<input type="checkbox" name="jaw_joints_pain" value="yes"  id='jaw_joints_pain' checked onclick="return false">
<span style="color:#FF0000">Clicking / Pain in jaw joints when eating</span>
<?}
else
{?>	 
<input type="checkbox" name="jaw_joints_pain" value="no"  id='jaw_joints_pain' onclick="return false">
Clicking / Pain in jaw joints when eating
<?}?>
</label>
<div class="controls">
<label class="radio inline">
<?
if($query_health->arthritis  == 'yes')
{?>
<input type="checkbox" name="arthritis" id='arthritis'  value="yes" checked onclick="return false">
<span style="color:#FF0000">Arthritis</span>
<?}
else
{?>
<input type="checkbox" name="arthritis" id='arthritis'  value="no" onclick="return false">
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
<input type="checkbox" name="arthritis_knee_replacement" value="yes" checked onclick="return false">
<span style="color:#FF0000">Arthritis Knee Replacement</span>
<?}
else
{?>
<input type="checkbox" name="arthritis_knee_replacement" value="no" onclick="return false">
Arthritis Knee Replacement
<?}?>
</label>
<div class="controls">
<label class="radio inline">
<?
if($query_health->arthritis_hip_replacement  == 'yes')
{?>
<input type="checkbox" name="arthritis_hip_replacement" value="yes" checked id='arthritis_hip_replacement' onclick="return false">
<span style="color:#FF0000">Arthritis Hip Replacement</span>
<?}
else
{?>
<input type="checkbox" name="arthritis_hip_replacement" value="no"  id='arthritis_hip_replacement' onclick="return false">
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
<input type="checkbox" name="swollen_ankles" id='swollen_ankles'  value="yes" checked onclick="return false">
<span style="color:#FF0000">Swollen Ankles</span>
<?}
else
{?>
<input type="checkbox" name="swollen_ankles" id='swollen_ankles '  value="no" onclick="return false">
Swollen Ankles
<?}?>
</label>
-->

<table border=0>
<?
$prev_group='';$i=0;$j=0;
foreach($med_his as $m)
{
        if($prev_group == '' || $prev_group != $m->group)
	{?>
           <tr><td><strong><?= $m->group ?></strong></p></td></tr>
           <?$j=0;
        }
        if($j%2 == 0)
	{
	  echo "</tr><tr>";
	}
$m_cond=str_replace(' ', '', $m->medical_condition);
	if($m->condition_status == 'yes')
	{
?>
		<td><div class="control-group">
		<label class="control-label" style="margin-left:20px !important">
		<input type="checkbox" id="<?= $m_cond ?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>" checked onclick="return false"
 >&nbsp;&nbsp;<?= $m->medical_condition ?>
		</label>
		</div></td>
	<?
	}
	else
	{?>
		<td><div class="control-group">
		<label class="control-label" style="margin-left:20px !important">
		<input type="checkbox" id="<?= $m_cond ?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>"  onclick="return false">&nbsp;&nbsp;<?= $m->medical_condition ?>
		</label>
		</div></td>
	<?
        }?>
	<input type='hidden'  style="width:100px !important" name="group<?= $i?>" 
	value="<?= $m->group ?>" id="group<?= $i?>"
	<input type='hidden'  style="width:100px !important" name="dispseq_<?= $i?>" 
	value="<?= $i ?>" id="dispseq_<?= $i?>">
<?
        $prev_group=$m->group;
        $i++;
$j++;
$upd_num=$m->upd_num;
}

?>

</table>
<input type='hidden' name='index' id='index' value="<?= $i ?>">


</div>

<div class="control-group">
<label class="control-label">

Other
</label>
<div class="controls ">
<div class='radio inline'>
<input class="input-large radio inline" type="text" placeholder="..."  id='other' name='other'   value='<?= $other ?>' onclick="return false">
</div>
</div>  





</div>	
</form>
</div>





<div id="dropdown3" class="tab-pane fade">
<div class="row-fluid patient_history">
<div style="margin-bottom:10px;" class="m-widget">
<div class="input-append">


<?php
$search_patients=$search_patients;
$search_patients_lname =$search_patients_lname;
$attributes = array('class' => 'form-horizontal_4', 'name'=>'form-horizontal_4','id' => 'listappts', 'style' => 'padding-top:0px;');
echo form_open_multipart('patient_ctrl/update_profile', $attributes);
?>  
<input type='hidden' name='param' id='param' value="<?echo $param ?>">
 
<input type="text" class="search-query" name='patient_name' 
value="<? echo $search_patients ?>" placeholder="First Name">
<input type="text" class="search-query" name='patient_lname' value="<? echo $search_patients_lname ?>" placeholder="Last Name">
<button type="submit" class="btn" onclick='check_session4family()'><i class="fa fa-search"></i> Search Patients</button>
<input type='hidden' name='check_search' id='check_search' value=''>
</form>
</div>

<div class="control-group">
<ul class="patients_rightnav">
<li>
<button id='search'   style="width:7%;float:right;text-align:left" onclick='location.href="<?php echo base_url();?>patient_ctrl/new_profile"  '  class="btn  btn-info" type="button"> 
<i ></i>ADD</button>
</li>
</ul>


<table class="table table-bordered patient_table" style="table-layout: fixed" id='csample' width='98%'>
<thead style="width:100%; background:#43B5CB; color:#FFF;">
<tr>
<th>First Name</th>
<th>M-Name</th>
<th>Last Name </th>
<th>Home Phone</th>
<th>RelationShip</th>
<th>Patient Name</th>
</tr>
</thead>
</table>


<div width='100%' style="height:400px; overflow-x:hidden;overflow-y:scroll;border:;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>

<tbody style="width:100%;">



<?
$i=0;
foreach($family_mem as $p)
{?>
<tr onclick="javascript:getfamily_id('<?= $p->patient_id?>');">  
<th><?php echo $p->fname;?></th>
<th><?php echo $p->middle_name;?></th>
<th><?php echo $p->lname;?></th>
<th><?php echo $p->home_phone;?></th>
<th><?php echo $p->relationship;?></th>
<th><?php echo $p->fullname;?></th>
</tr>
<?php
 $i++;
}?>
</tbody>
</table>
</div>
</table>




</div>

</div>

</div>
</div>



<div id="dropdown2" class="tab-pane fade">
<div class="row-fluid patient_history">
<div class="m-widget-body">
<form class="form-horizontal2">
<div class="row-fluid patient_history">
<h1>Insurance Details of  Primary Insured</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">

<?php
if(!empty($query_insur))
{
	$nameofinsured = $query_insur->name_of_insured  ;
	$insurance_company = $query_insur->insurance_company ;
	$group_id = $query_insur->group_id ;
	$member_id = $query_insur->member_id ;
	$img1_location = $query_insur->img1_location;
	$img2_location = $query_insur->img2_location;
}
else
{
	$nameofinsured ='';
	$insurance_company ='';
	$group_id ='';
	$member_id ='';
	$img1_location ='';
	$img2_location ='';
	
}
?>

<div class="control-group">
<label class="control-label" for="inputPassword" style='  float: left;
width:350px;  padding-top: 5px;  text-align: left;'>Name of Primary Insured</label>
<div class="controls">
<input type="text"  placeholder="Name" value="<?= $nameofinsured ?>" style=";background-color:#DDDDDD;" readonly="readonly">
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

<form class="form-horizontal2">
<div class="control-group">
<label class="control-label" for="inputPassword">Insurance Company </label>
<div class="controls">
<input type="text" placeholder=" Company Name" style=";background-color:#DDDDDD;" readonly="readonly" value='<?= $insurance_company ?>'>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Group ID</label>
<div class="controls">
<input type="text" placeholder="ID" style=";background-color:#DDDDDD;" readonly="readonly" value='<?= $group_id ?>'>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Member ID </label>
<div class="controls">
<input type="text" placeholder="ID" style=";background-color:#DDDDDD;" readonly="readonly" value='<?= $member_id ?>'>
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
<div class="caption">
<p style="margin-top:5px 0px;">
<?
echo '<img src="'.$img1_location.'">';
?>
</p>
</div>
</li>

<li class="span3">
<div class="caption">
<p style="margin-top:5px 0px;">
<?
echo '<img src="'.$img2_location.'">';
?>
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






<div id='consent'>
<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal100','name'=>'form-horizontal120');
echo form_open_multipart('patient_ctrl/insert_consent',$attr);
?>

<input name="link2patient" id="link2patient" type="hidden" value="<? echo $query->recnum ?>">
<input name="login" id="login" type="hidden" value="patient">

<div class="row row-centered topbuffer">
<div>

<div class="alert alert-danger alert-dismissable hide error-summary-top-consent"></div>
<div class="span12" style="border:0px;width:90% !important;margin-left:60px">
<div class="panel-group" id="accordion">

<div class="panel panel-primary sigPad4treat">
<div class="panel-heading text-center">
<h3 class="panel-title">
<a class="collapseOtherPanels collapsed" data-toggle="collapse" data-parent="#accordion" 
onclick="getaccordian('collapse1')">Treatment to be done</a>
</h3>
</div>
<div id="collapse1" class="panel-collapse collapse" style="height: 0px;">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">I understand that I will be receiving an examination that includes a sufficient number of dental x-rays that
may be necessary to complete my examination and any additional community appropriate diagnostic procedures that may be necessary to complete my dental
examination and treatment plan. T also understand that if there was a need for a referral to a specialist deemed necessary by my Dentist, then the cost
of this referral would be my responsibility.</p>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>



<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4treatment" class="output" value=''>
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:80px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
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
</div>
</div>
</div>


<div class="panel panel-primary sigPad4drugs">
<div class="panel-heading text-center">
<h3 class="panel-title">
<a class="collapseOtherPanels" data-toggle="collapse" data-parent="#accordion" onclick="getaccordian('collapse2')">Drugs and Medications</a>
</h3>
</div>
<div id="collapse2" class="panel-collapse collapse">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">I understand that antibiotics, analgesics and other medication can cause allergic reactions manifesting
clinical symptoms such as redness, swelling of tissues, pain, itching, vomiting, and/or anaphylactic shock severe allergic reaction. I understand that
it is my responsibility to inform my dentist of any allergy to specific medication to avoid possible adverse effects from medication that my dentist
will prescribe.</p>
<div class="topslimbuffer">&nbsp;</div>
<p class="form-control-static text-left">
<b>LOCAL ANESTHETICS:</b> The local anesthetic I am receiving may contain epinephrine that can cause a slight increase in the heart rate but will return
to normal. Common complications that can OMIT from local anesthetic but are not limited to be pain, swelling, and bruising. Rare serious complications
may occur that can include but are not limited to permanent numbness, abnormal sensation, transient blindness, and even death.
</p>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>
<div class="row form-group">
<label for="drugs_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="drugs_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4drug_med" class="output">
  </div>
 </div>
</div>
<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" style="margin-right:80px"  class="form-control input-sm pull-right consent_patient_name" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearDrugsSignature" attached_input="drugs_signature_div" href="#clear">Clear Signature</a>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="panel panel-primary sigPad4changes_treat">
<div class="panel-heading text-center">
<h3 class="panel-title">
<a class="collapseOtherPanels" data-toggle="collapse" data-parent="#accordion" onclick="getaccordian('collapse3')">Changes to Treatment Plan</a>
</h3>
</div>
<div id="collapse3" class="panel-collapse collapse">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">I understand that during treatment, it may be necessary to change or add procedures due to condition found
while working on the teeth that were not discovered during examination, the most common being root canal therapy following routine restorative
procedures. I give my permission to the Dentist to make any/all changes and additions as necessary once I have been informed of these changes and.
consented to them. I also understand that by not following my dentist's recommendation, delayed treatment can lead to but not limited to more
discomfort, increase the complexity of the treatment outcome, or eventual lost of teeth.</p>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>

<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4treat_plan" class="output">
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:80px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearChangesSignature" attached_input="changes_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="panel panel-primary sigPad4extract">
<div class="panel-heading text-center">
<h3 class="panel-title">
<a class="collapseOtherPanels collapsed" data-toggle="collapse" data-parent="#accordion" 
onclick="getaccordian('collapse4')">Extractions (Removal of Teeth)</a>
</h3>
</div>
<div id="collapse4" class="panel-collapse collapse" style="height: 0px;">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">I give my consent for the doctor to perform the extraction/surgery to treat and possibly correct my diseased
oral tissue, or other procedures deemed necessary or advisable as necessary to complete the planned operation/extraction. If left untreated, the risks
to my health may include, but are not limited to swelling, pain, infection, cyst formation, gum diseases, denial decay, malocclusion, premature loss of
teeth and/or bone. My Dentist has informed me of possible alternative methods of treatment.</p>
<p class="form-control-static text-left">Potential risks include, but are not limited, to the following:</p>
<ul class="form-control-static text-left">
<li class="form-control-static text-left">Post-operative discomfort; stretching ache corners of the mouth, with resultant cracking and bruising;
swelling; prolonged bleeding; tooth sensitivity to hot or cold; gum shrinkage possibly exposing crown margins; tooth looseness; delayed healing dry
socket and/or infection requiring prescriptions or additional treatment, i.e. surgery.</li>
<li class="form-control-static text-left">Injury to adjacent teeth, prosthesis, and/or restorations which may require additional treatment or
injury to other tissues not within the described surgical area.</li>
<li class="form-control-static text-left">Limitation of opening; stiffness of facial and/or neck muscles; change in bite or tempromandibular joint
(jaw joint) difficulty possibly requiring physical therapy or surgery.</li>
<li class="form-control-static text-left">Residual root fragments or bones spicules left when complete removal would require extensive surgery or
needless surgical complications.</li>
<li class="form-control-static text-left">Possible bone, and/or jaw fracture, or opening of the maxillary sinus requiring additional surgery.</li>
<li class="form-control-static text-left">Injury to the nerve underlying the teeth resulting in itching, numbness, or burning of the lip, chin,
gums, cheek, teeth, and/or tongue which may be temporary Or permanent.</li>
</ul>
<p class="form-control-static text-left">If any unforeseen condition should arise in the course of the operation/extraction, calling for the doctor's
judgment or for procedures in addition to or different from those now contemplated, I request and authorize the doctor to do whatever may deem
advisable, including referral to another dentist or specialist.</p>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>

<div class="row form-group">
<label for="extract_tooth" class="col-sm-3 control-label"style="float:left;width:25%;margin-right:10px"> Tooth#</label>
<input type="text" class="form-control" id="extract_tooth1" name="extract_tooth1" value="" autocomplete="off" placeholder="Tooth#"  style="width: 50px ! important; display: inherit ! important;margin-left:100px;">
<label for="extract_teeth" control-label="" class="col-sm-3 control-label" style="width:25%;margin-right:135px;float:right;margin-top:-35px">Teeth#</label>
<input type="text" class="form-control" id="extract_tooth2" name="extract_tooth2" value="" autocomplete="off" placeholder="Tooth#"  style="width:50px !important;display: inline;
margin-top:-35px;margin-right:135px;float:right">
</div>

<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4extraction" class="output">
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:80px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>


<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearExtractSignature" attached_input="extract_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="panel panel-primary sigPad4crown">
<div class="panel-heading text-center">
<h3 class="panel-title">
<a class="collapseOtherPanels" data-toggle="collapse" data-parent="#accordion" onclick="getaccordian('collapse5')">Crowns, Bridges and Caps</a>
</h3>
</div>
<div id="collapse5" class="panel-collapse collapse">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">I understand sometimes it is not possible to match the color of natural teeth exactly with artificial teeth.
I further understand I may be wearing temporary crowns, which may come off easily and could be aspirated, and I must be careful to ensure that they are
kept on until the permanent crowns are delivered. I understand that if my temporary crowns come off, then it is my responsibility to return to my
dentist to have it re-cemented. I realize the final opportunity to make changes in my new crown, bridge, or cap including shape, fit, size, and color)
will be before cementation. I understand if I do not return for my scheduled appointment for delivery of my crowns, or bridge, it may not fit properly,
and I will be responsible for any lab fees.</p>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>

<div class="row form-group">
<label for="extract_tooth" class="col-sm-3 control-label"style="float:left;width:25%;margin-right:10px"> Tooth#</label>
<input type="text" class="form-control" id="crown_tooth" name="crown_tooth" value="" autocomplete="off" placeholder="Tooth#"  style="width: 50px ! important; display: inherit ! important;margin-left:100px;">

<label for="extract_teeth" control-label="" class="col-sm-3 control-label" style="width:25%;margin-right:135px;float:right;margin-top:-35px">Shade</label>
<input type="text" class="form-control" id="shade_tooth4crown" name="shade_tooth4crown" value="" autocomplete="off" placeholder="Shade"  style="width:50px !important;display: inline;
margin-top:-35px;margin-right:135px;float:right">
</div>

<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4crown" class="output">
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:80px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>

</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearCrownSignature" attached_input="crown_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="panel panel-primary sigPad4denture">
<div class="panel-heading text-center">
<h3 class="panel-title">
<a class="collapseOtherPanels" data-toggle="collapse" data-parent="#accordion" onclick="getaccordian('collapse6')">Dentures - Complete or Partial</a>
</h3>
</div>
<div id="collapse6" class="panel-collapse collapse">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">I realize full or partial dentures are artificial, constructed of plastic, metal, and/or porcelain. The
problems of wearing these appliances have been explained to me, including looseness, soreness, and possible breakage. I realize the final opportunity to
make changes in my now denture including shape, fit, size, placement, and color) will be the "teeth in wax" try-In visit. I understand most dentures
require relining approximately three to six months after initial placement and Yesrly thereafter. The cost for these relines is not included in the
initial denture fee. I further understand that due to bone loss, lack of alveolar ridge support, muscle attachments and/or other complicating factors, I
may never be able to wear dentures to my satisfaction.</p>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>
<div class="row form-group">
<label for="denture_shade" class="col-sm-2 control-label" style="float:left;width:25%">Shade</label>
<div class="col-sm-6">
<input  type="text" class="form-control input-sm pull-right" id="denture_shade" name="denture_shade" value="" autocomplete="off" placeholder="Shade" style="width: 50px ! important; display: inherit ! important;margin-left:10px;float:left">
</div>
</div>
<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4denture" class="output">
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:80px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>

</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearDentureSignature" attached_input="denture_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="panel panel-primary sigPad4endodontic">
<div class="panel-heading text-center">
<h3 class="panel-title">
<a class="collapseOtherPanels" data-toggle="collapse" data-parent="#accordion" onclick="getaccordian('collapse7')">Endodontic Treatment (Root Canal)</a>
</h3>
</div>
<div id="collapse7" class="panel-collapse collapse">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">The purpose and method of root canal therapy have been explained to inc as well as consequences of
non-treatment and reasonable alternative treatments. I understand that following root canal therapy my tooth will be brittle and must be protected
against fracture by placement of a final restoration usually a crown cap) over the tooth. I also understand that sometimes root canal therapy may fail
and further treatment may be necessary that might include but not limited to retreannent, apicoectomy, or extraction.</p>
<p class="form-control-static text-left">I understand that treatment risks can include, but are not limited to the following:</p>
<ul class="form-control-static text-left">
<li class="form-control-static text-left">Post treatment discomfort, infection, restricted jaw opening.</li>
<li class="form-control-static text-left">Swelling of the gum area in the vicinity of the treated tooth or facial swelling, either of which may
persist for several days or longer.</li>
<li class="form-control-static text-left">Separation of root canal instruments during treatment, which may in the judgment of the Dentist be left
in the treated root canal or bone as part of the filling material; or it may require surgery for removal.</li>
<li class="form-control-static text-left">Perforation of the root canal which may require additional surgical treatment, or premature tooth loss
extraction.</li>
<li class="form-control-static text-left">Risk of temporary or permanent numbness in treatment vicinity.</li>
<li class="form-control-static text-left">The root canal filling material may be overfilled or underfilled, which may or may not affect the
success/outcome of the treatment.</li>
</ul>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>
<div class="row form-group">
<label for="denture_shade" class="col-sm-2 control-label" style="float:left;width:25%">Tooth#</label>
<div class="col-sm-6">
<input  type="text" class="form-control input-sm pull-right" id="endodontic_tooth" name="endodontic_tooth" value="" autocomplete="off" placeholder="Tooth#" style="width: 50px ! important; display: inherit ! important;margin-left:10px;float:left">
</div>
</div>


<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4endodontic" class="output">
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:80px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearCancelSignature" attached_input="canal_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="panel panel-primary sigPad4periodontal">
<div class="panel-heading text-center">
<h3 class="panel-title">
<a class="collapseOtherPanels" data-toggle="collapse" data-parent="#accordion" onclick="getaccordian('collapse8')">Periodontal Loss (Tissue &amp; Bone)</a>
</h3>
</div>
<div id="collapse8" class="panel-collapse collapse">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">I understand that the long term success of treatment and status of my oral condition depends on my efforts
at proper oral hygiene (i.e. brushing and flossing) and maintaining regular recall and maintenance visits. I understand that I have a serious condition
causing gum and bone inflammation and/or loss that can lead to loss of my teeth and other related systemic complications. The various treatment plans
have been explained to me, including non-surgical scaling and root .planning followed by local irrigation with oral medicaments and local delivery of
antibiotic, or gum surgery, or replacements and/or extractions. I also understand that although these treatments have a high degree of success, they
cannot be guaranteed. I understand that after following approved periodontal treatment there may still be a need for a referral In a Periodontist.</p>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>

<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4peridontal" class="output">
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:80px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearPeriodontalSignature" attached_input="periodontal_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="panel panel-primary  sigPad4filling">
<div class="panel-heading text-center">
<h3 class="panel-title">
<a class="collapseOtherPanels" data-toggle="collapse" data-parent="#accordion" onclick="getaccordian('collapse9')">Fillings</a>
</h3>
</div>
<div id="collapse9" class="panel-collapse collapse">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">I have been advised of the need for fillings, either silver or composite plastic. In cases where very little
tooth structure remains or existing tooth structure fractures off, I may need to receive more extensive treatment such as root canal therapy, post and
build-up, and crowns, which would necessitate a separate charge, I understand that my recently placed fillings may cause sonic sensitivity and
discomfort for duration and may be alleviated with time. However, I understand that if the symptom and sensitivity worsen, then I might need a RCT.</p>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>

<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4filling" class="output">
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:80px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearFillingsSignature" attached_input="fillings_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="panel panel-primary sigPad4pedo">
<div class="panel-heading text-center">
<h3 class="panel-title">
<a class="collapseOtherPanels collapsed" data-toggle="collapse" data-parent="#accordion" onclick="getaccordian('collapse10')">Pedodontics (Children's Dentistry)</a>
</h3>
</div>
<div id="collapse10" class="panel-collapse collapse" style="height: 0px;">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">I understand the following procedures are routinely used in conjunction with pediatric dentistry, as well as
being accepted procedures in the dental profession. As the parent or authorized caregiver, I understand and give consent that the following procedures
can be used on my child:</p>
<ul class="form-control-static text-left">
<li class="form-control-static text-left">POSITIVE REINFORCEMENT- Rewarding the child who portrays desirable behavior, by use of compliments,
verbal praises, or toys.</li>
<li class="form-control-static text-left">VOICE CONTROL- The attention Of a disruptive child is gained by changing the tone or increasing the
volume of the doctor's voice.</li>
<li class="form-control-static text-left">PHYSICAL RESTRAINT- As the parent or authorized caregiver, I have been informed in advance and have given
consent as it may be deemed necessary to restrain the child. Restraining the child's disruptive movements by holding down their hands, upper body,
head, rind/or legs by use of the dentist's or assistant's hand or arm, or by use of a special device referred to as a "papoose board". I understand
that with the use of local anesthetic for dental purposes, the possibility exists that the child may inadvertently bite their lip, tongue, and check
causing injury to occur.</li>
</ul>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>
<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4pedodontic" class="output">
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:80px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearPedodonticsSignature" attached_input="pedodontics_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="panel panel-primary">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<p class="form-control-static text-left">I understand that dentistry is not an exact science and that therefore, practitioners cannot guarantee
results. I acknowledge that no guarantee or assurance has been made by anyone regarding dental treatment, which I have requested and authorized. I have
read and clearly understood the consent form language, and by signing below I acknowledge this understanding and give my consent to perform the
above-indicated procedure[s]. My doctor has encouraged me to ask questions. I have had the opportunity to ask question and any and all of my questions
have been answered to my satisfaction.</p>
</div>
<div class="topslimbuffer">&nbsp;</div>
</div>

<div class="panel sigPad1">
<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Patient Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4patientsign" class="output">
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:80px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearCancelSignature" attached_input="user_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="panel  sigPad1">
<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Dentist Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4dentistsign" class="output">
  </div>
 </div>
</div><br>
<div class="row form-group">
<label for="consent_doctor_name" class="col-sm-3 control-label" style="float:left;width:25%">Doctor</label>
<div class="col-sm-6" style="display: inherit ! important;margin-left:100px">

<?
$attributes1 = 'id="consent_doctor_name" class="input-xlarge""  style="width:225px;margin-right:60px"';
$locnames  = $this->patient_model->getalldoctors4clinic();
echo form_dropdown('consent_doctor_name', $locnames,'',$attributes1);
?>
</div>
</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearCancelSignature" attached_input="user_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="panel  sigPad1">
<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Witness Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4witnesssign" class="output">
  </div>
 </div>
</div><br>
<div class="row form-group">
<label for="witness" class="col-sm-3 control-label" style="float:left;width:25%">Witness</label>
<div class="col-sm-6"  style=" margin-left:200px;display:block;clear:none;float:left">
<input style="margin-left:-10px" type="text" class="form-control input-sm pull-right" id="witness" name="witness" value="" autocomplete="off" placeholder="Witness">
</div>
</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearCancelSignature" attached_input="witness_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>










<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="alert alert-danger alert-dismissable hide error-summary-top-consent"></div>
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg" id="btnSubmitConsent" onclick="javascript:check_req_fieds4consent()"><i class="fa fa-check"></i> Save</a>
</div>
</div>
</div>
</div>
</div>

</div>
</div></div>

</div>
</div>
</form>


</div>










<div id='dental_history'>
<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal90','name'=>'form-horizontal90');
echo form_open_multipart('patient_ctrl/insert_dental_history',$attr);
?>

<input name="userId" class="dental_userId" type="hidden" value="23">

<div class="alert alert-danger alert-dismissable hide dental_notification"></div>
<div class="span12" style="border:0px;width:95% !important;margin-left:30px">

<div class="row row-centered topbuffer">
<div id="tabDentalInfo-top-column">



<div class="panel panel-primary">
<div class="panel-heading text-center">
<h3 class="panel-title">Reason and recent visit</h3>
</div>
<div class="panel-body">

<div class="form-group">
<label for="reason_text" class="col-sm-7 control-label" style="width:100px">Reason for today's visit</label>
<div class="col-sm-9">
<textarea rows="3" style="margin-right:-40px" class="form-control input-sm" id="reason_text" name="reason_text" autocomplete="off" placeholder="Reason for today&#39;s visit"></textarea>
</div>
</div>
<br>

<div class="form-group">
<label for="fomer_dentist_name" class="col-sm-7 control-label" style="width:100px">Former Dentist</label>
<div class="col-sm-5" style="margin-right:-25px" >

<input type="text" placeholder="Former Dentist" name='former_dentist_name' id='former_dentist_name' value=''>

</div>
</div>
<br>

<div class="form-group">
<label for="last_dental_date" class="col-sm-7 control-label" style="width:100px">Date of last dental exam</label>
<div class="col-sm-5" id="last-dental-date-container">

	<div class="date" id="dp4" 
data-date="<?= date('Y-m-d') ?>"  data-date-format="yyyy-mm-dd" style="margin-right:-27px">
	<?php
	$data = array(
		'class' => 'input-large',
		'type' => "text",
		'name' => "last_dental_date",
		'id'  => "last_dental_date",
		'size' => '16',	
		'readonly'=>'readonly',
	);
	echo form_input($data);
	?>
	<span style="position:relative; left:-30px; z-index:1;" class="add-on">
		<i class="icon-th"></i>
	</span>
</div>


</div>
</div>
<br>

<div class="form-group">
<label for="last_dental_date" class="col-sm-7 control-label" style="width:100px">Date of last dental X-Ray</label>
<div class="col-sm-5" id="last-dental-date-container">
	<div class="date" id="dp5" data-date="<?= date('Y-m-d') ?>"  data-date-format="yyyy-mm-dd" style="margin-right:-27px">
	<?php
	$data = array(
		'class' => 'input-large',
		'type' => "text",
		'name' => "last_dental_xray_date",
		'id'  => "last_dental_xray_date",
		'size' => '16',	
		'readonly'=>'readonly',
	);
	echo form_input($data);
	?>
	<span style="position:relative; left:-30px; z-index:1;" class="add-on">
		<i class="icon-th"></i>
	</span>
</div>

</div>
</div>
</div>
</div>

<div class="panel panel-primary">
<div class="panel-heading text-center">
<h3 class="panel-title"> Your Dental condition</h3>
</div>
<div class="panel-body">
<p class="text=left">Have you had or currently have any of the following conditions? Check the ones that are applicable</p>
<div class="col col-md-6 col-xs-6 col-centered col-top">

<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Bad breath</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="bad_breadth" id="bad_breadth_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="bad_breadth" id="bad_breadth_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>

<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Bleeding gums</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="bleeding_gums" id="bleeding_gums_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="bleeding_gums" id="bleeding_gumss_no" value="no" checked="checked"> No </label>
</div>
</div>
<br><br>
<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Blisters on lips or mouth</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="blisters" id="blisters_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="blisters" id="blisters_no" value="no" checked="checked"> No </label>
</div>
</div>
<br><br>

<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Burning sensation on tongue</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="burning" id="burning_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="burning" id="burninge_no" value="no" checked="checked"> No </label>
</div>
</div>
<br><br>

<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px"> Chew on one side of mouth</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="chew_side" id="chew_side_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="chew_side" id="chew_side_no" value="no" checked="checked"> No </label>
</div>
</div>
<br><br>

<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Clicking or popping jaw</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="click_pop" id="click_pop_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="click_pop" id="click_pop_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>

<div class="form-group">
<label class="col-sm-7 control-label" >Dry Mouth</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="dry_mouth" id="dry_mouth_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="dry_mouth" id="dry_mouth_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>

<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px" >Fingernail biting</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="finger_bite" id="finger_bite_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="finger_bite" id="finger_bite_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>

<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Foreign object</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="foreign" id="foreign_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="foreign" id="foreign_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>


<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Grinding teeth</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="grind" id="grind_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="grind" id="grind_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>



<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Gums swollen or tender</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="gums" id="gums_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="gums" id="gums_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>

<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Jaw pain or tiredness</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="jaw_pain" id="jaw_pain_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="jaw_pain" id="jaw_pain_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>

</div>
<div class="col col-md-6 col-xs-6 col-centered col-top">
<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Lip or cheek biting</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="lip_cheek" id="lip_cheek_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="lip_cheek" id="lip_cheek_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>




<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Loose teeth or broken fillings</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="lose" id="lose_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="lose" id="lose_no" value="no" checked="checked"> No </label>
</div>
</div>
<br><br>




<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Mouth breathing</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="mouth_breath" id="mouth_breath_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="mouth_breath" id="mouth_breath_no" value="no" checked="checked"> No </label>
</div>
</div><br><br>




<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Mouth pain, brushing</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="mouth_pain" id="mouth_pain_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="mouth_pain" id="mouth_pain_no" value="no" checked="checked"> No </label>
</div>
</div>
<br><br>



<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Orthodontic treatment</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="ortho" id="ortho_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="ortho" id="ortho_no" value="no" checked="checked"> No </label>
</div>
</div>
<br><br>



<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Pain around ear</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="pain_ear" id="pain_ear_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="pain_ear" id="pain_ear_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>
			


<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Perio treatment</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="perio" id="perio_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="perio" id="perio_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>


<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Sensitivity to cold</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="cold" id="cold_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="cold" id="cold_no" value="no" checked="checked"> No </label>
</div>
</div><br>




<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Sensitivity to heat</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="heat" id="heat_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="heat" id="heat_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>



<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Sensitivity to sweets</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="sweets" id="sweets_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="sweets" id="sweets_no" value="no" checked="checked"> No </label>
</div>
</div><br>




<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Sensitivity when biting</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="biting" id="biting_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="biting" id="biting_no" value="no" checked="checked"> No </label>
</div>
</div>
<br>




<div class="form-group">
<label class="col-sm-7 control-label" style="width:150px">Sores or growths in your mouth</label>
<div class="col-sm-5">
<label class="radio-inline"><input type="radio" name="sores" id="sores_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="sores" id="sores_no" value="no" checked="checked"> No </label>
</div>
</div>



</div>	
<Br/><br/>

<div class="form-group">
<label for="brush_frequency" class="col-sm-7 control-label" style=" margin-left:-4px;">How often do you brush?</label>
<div class="col-sm-5" >
<input type="text" style="margin-left: -80px;" name="brush_frequency" id="brush_frequency" class="form-control input-sm" placeholder="Daily, twice a day">
</div>
</div>
<br>


<div class="form-group">
<label for="anything_else_dental" class="col-sm-7 control-label"  style=" margin-left: -4px;">Is there anything else we should know?</label>
<div class="col-sm-5" >
<textarea rows="3" style="margin-left: -80px;" class="form-control input-sm" name="anything_else_dental" id="anything_else_dental" autocomplete="off"></textarea>
</div>
</div>
											
</div>
</div>







</div>

</div>



<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8 col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a class="btn btn-success btn-lg" id="btnDoneDental" 
onclick="javascript:check_req_fields4dental_history()"><i class="fa fa-check"></i> Save</a>
</div>
</div>
</div>
</div>
</div>
<div class="alert alert-dismissable hide dental_notification"></div>
</form>
</div></div>





<div class="clearfix"> </div>
</div>

</div>

<div class="span3 m-widget">
<ul class="patients_rightnav">
<?
if($this->session->userdata('appts_leftnav') != '')
{?>
<li>
<button class="btn btn-large btn-warning" type="button"
onClick='location.href="<?php echo base_url();?>patient_ctrl/appointments" '> <i class="fa fa-envelope-o"></i>  Request Appointment  </button>
</li>
<?
}
if($this->session->userdata('msg_leftnav') != '')
{?>
<li>
<button class="btn btn-large btn-warning" type="button" 
onClick='location.href="<?php echo base_url();?>patient_ctrl/messages"'> <i class="fa fa-envelope-o"></i>  Send Message  </button>											
</li>
<?}?>

</ul>
<div class="clearfix"> </div>
<br>
<ul class="patients_rightnav">


<li>
<button onclick="javascript:getparam_value('home1')"  
  class="btn btn-large btn-info" type="button"> <i class="fa fa-refresh"></i>Personal Info</button>
</li>

<li>
<button onclick="javascript:getparam_value('profile1')"  type="button" class="btn btn-large btn-info"> <i class="fa fa-refresh"></i>Emergency Info</button>
</li>

<li>
<button onclick="javascript:getparam_value('dropdown11')"   class="btn btn-large btn-info" type="button"><i class="fa fa-refresh"></i>Health History</button>											
</li>

<li>
<button onclick="javascript:getparam_value('dropdown21')" 
  class="btn btn-large btn-info" type="button"><i class="fa fa-refresh">
</i>Insurance Info
</button>											
</li>

<li>
<button onclick="javascript:getparam_value('familymember')"  class="btn btn-large btn-info" onclick=" location.href='profile.html#familymember'" type="button" ><i class="fa fa-refresh"></i> 
Family Member</button>
</li>

<li>
<button onclick="javascript:getparam_value('dental_history')"  class="btn btn-large btn-info" onclick="location.href='profile.html#dental_history'" type="button" ><i class="fa fa-refresh"></i> Dental History</button>
</li>


</ul>
<div class="clearfix"> </div>
<div class="patients_social">

<a href="http://facebook.com/paperlessdentists" target="_blank"> <i class="fa fa-facebook"></i> </a> 


<a href="http://twitter.com/PaperlessD" target="_blank"><i class="fa fa-twitter"></i></a> 

</div>

</div>
</div>    
</form>

</section>
</div>
</div>
<div class="clearfix">
<div class="footer">

<span>Copyright &copy; 2017, Fluentsoft Technologies. All Rights Reserved	Terms Of Use </span>

</div>
</div>
</body>
</html>
