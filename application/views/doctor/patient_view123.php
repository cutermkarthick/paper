<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 20, 2015                 =
// Filename: patient_view.php                  =
// Copyright of Fluent Technologies            =
// Displays patient information                =
//==============================================
?>
<!DOCTYPE html>
<html>
<head>
<body>
<link rel="stylesheet" type="text/css" href="css/meda.css" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/style.css" />
<link rel="stylesheet"  href="<?echo base_url()?>signature-pad/build/jquery.signaturepad.css">
<script src="<?echo base_url()?>signature-pad/build/flashcanvas.js"></script>
<script src="<?echo base_url()?>signature-pad/build/json2.min.js"></script>
<script src="<?echo base_url()?>signature-pad/jquery.signaturepad.js"></script>
<script src="<?echo base_url()?>signature-pad/build/jquery.signaturepad.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() 
{        
	$('.clickableRow').removeClass("highlight");
	<?
	if(count($den_his)  > 0)
	{?>
	    var dental_his="his_<?echo $den_his->recnum ?>";
	    $('#'+dental_his).addClass("highlight");
	<?}
	if(count($consent)  > 0)
	{?>
	  var consent_his="con_<?echo $consent[0]->recnum ?>";
	  $('#'+consent_his).addClass("highlight");
	<?}
        if(count($health_info)>0)
	{?>	  
            var health_his="hel_0";
	    $("#hel_0").addClass("highlight");
	<?}?>
var parameter ="<?echo $param  ?>";
$("#home1").removeClass("active");
$("#profile1").removeClass("active");
$("#dropdown21").removeClass("active");
$("#dropdown31").removeClass("active");
$("#dropdown31").removeClass("active");

$("#home").removeClass("active in");
$("#profile").removeClass("active in");
$("#dropdown1").removeClass("active in");
$("#dropdown2").removeClass("active in");
$("#dropdown3").removeClass("active in");
$("#dental_history").removeClass("active in");

$("input[data-attr='"+attr +"']").next().css("color", "#FFFFFF");
var health_iss = document.getElementById('health_iss').value;

if(parameter =='dropdown1')
{
	$("[id=myTab_profile]").addClass("active");
	$("#dropdown1").addClass("active in");
	$("#dropdown1").css({"display": "inline"});
        var offset=($("input[name="+health_iss+"]").offset().top-2800);

        if(health_iss == $("input[name="+health_iss+"]").attr("data-attr"))
	{
var attr=$("input[name="+health_iss+"]").attr("data-attr");
//$("input[data-attr='"+attr +"']").parent().css("color", "#FF0000");
$("input[data-attr='"+attr +"']").next().css("color", "#FF0000");
$('html').animate({scrollTop: offset},800,'swing');
	}
}
else
{
$("#home1").addClass("active");
$("#home").addClass("active in");
//$("input[data-attr='"+attr +"']").parent().css("bcolor", "#FFFFFF");
$("input[data-attr='"+attr +"']").next().css("color", "#FFFFFF");
}
});

$(document).ready(function () 
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
var count_all="<? echo count($consent)  ?>";
<?
if(count($treatment_to_be )  > 0)
{?>
      var sig = '<?php echo $treatment_to_be->signature ?>';
      $('.sigPad4treat').signaturePad({displayOnly : true}).regenerate(sig);

<?}

if(count($drugs_med )  > 0)
{?>
      var sig = '<?php echo $drugs_med ->signature ?>';
      $('.sigPad4drugs').signaturePad({displayOnly : true}).regenerate(sig);

<?}

if(count($changes_treat)  > 0)
{?>
var sig1 = '<?php echo $changes_treat->signature ?>';
  $('.sigPad4changes_treat').signaturePad({displayOnly : true}).regenerate(sig1);

<?}

if(count($extact)  > 0)
{?>
      var sig = '<?php echo $extact->signature ?>';
$('.sigPad4extract').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal130'].extract_tooth1.value='<?php echo $extact->toothnum1 ?>';
document.forms['form-horizontal130'].extract_tooth2.value='<?php echo $extact->toothnum2 ?>';
<?}

if(count($crown)  > 0)
{?>
      var sig = '<?php echo $crown->signature ?>';
      $('.sigPad4crown').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal130'].crown_tooth.value='<?php echo $crown->toothnum1 ?>';
document.forms['form-horizontal130'].shade_tooth4crown.value='<?php echo $crown->shade ?>';
<?}


if(count($denture) > 0)
{?>
      var sig = '<?php echo $denture->signature ?>';
      $('.sigPad4denture').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal130'].output4denture.value='';
document.forms['form-horizontal130'].denture_shade.value='<?php echo $denture->shade ?>';
<?}

if(count($endendontic)  > 0)
{?>
      var sig = '<?php echo $endendontic->signature ?>';
      $('.sigPad4endodontic').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['form-horizontal130'].endodontic_tooth.value=
'<?php echo $endendontic->toothnum1 ?>';
<?}

if(count($perio)  > 0)
{?>
      var sig = '<?php echo $perio->signature ?>';
      $('.sigPad4periodontal').signaturePad({displayOnly : true}).regenerate(sig);
<?}

if(count($filling)  > 0)
{?>
      var sig = '<?php echo $filling->signature ?>';
      $('.sigPad4filling').signaturePad({displayOnly : true}).regenerate(sig);
<?}

if(count($pedodontic)  > 0)
{?>
      var sig = '<?php echo $pedodontic->signature ?>';
      $('.sigPad4pedo').signaturePad({displayOnly : true}).regenerate(sig);
<?}

if(count($patient_sig) >0)
{?>
   var sig1 = '<?php echo $patient_sig->patient_signature ?>';
   var sig2 = '<?php echo $patient_sig->dentist_signature ?>';
   var sig3 = '<?php echo $patient_sig->witness_signature ?>';

$('.sigPad4patient').signaturePad({displayOnly : true}).regenerate(sig1);
$('.sigPad4dentist').signaturePad({displayOnly : true}).regenerate(sig2);
$('.sigPad4witness').signaturePad({displayOnly : true}).regenerate(sig3);
document.getElementById('witness').value=
'<?php echo $patient_sig->witness_name ?>';

<?}?>

if('<?php echo $query_health->signature ?>' != '')
{
      var sig = '<?php echo $query_health->signature ?>';
      $('.sigPad4doc').signaturePad({displayOnly : true}).regenerate(sig);
}
$("#home").css({"display": "none"});
$("#profile").css({"display": "none"});
$("#dropdown1").css({"display":  "none"});
$("#dropdown2").css({"display": "none"});
$("#dropdown3").css({"display": "none"});
$("#dental_history").css({"display": "none"});

$("#home").removeClass("active in");
$("#profile").removeClass("active in");
$("#dropdown1").removeClass("active in");
$("#dropdown2").removeClass("active in");
$("#dropdown3").removeClass("active in");
$("#dental_history").removeClass("active in");

$("#home1").removeClass("active");
$("#profile1").removeClass("active");
$("#dropdown11").removeClass("active");
$("#dropdown21").removeClass("active");
$("#dropdown31").removeClass("active");
$("#dropdown41").removeClass("active");

var url=(window.location.href);
//var parameter =  url.split('/').pop();
var parameter ="<? echo $param  ?>";

        if(parameter == 'home1'  || parameter == 'profile' || parameter == '')
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
        else if(parameter == 'dropdown11'  || parameter == 'dropdown1' )
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
        else if(parameter == 'dropdown41' )
        {
              $("#myTab li#dropdown41").addClass("active");
	      $("#dental_history").css({"display" : "inline"});
	      $("#dental_history").addClass("active in");
        }
	else if(parameter == 'dropdown3' )
        {
             $("#myTab li#dropdown31").addClass("active");
	     $("#dropdown3").css({"display" :"inline" });
	     $("#dropdown3").addClass("active in");
        }
});
var url=(window.location.href);
var parameter ="<? echo $param  ?>";
function getpatient_info()
{
   window.location="<?php echo base_url();?>doctor_ctrl/getpatient_info";
}
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
function editdentalhis_details(recnum)
{
   $.ajax(
   {
type: 'POST',
url: "<?php echo base_url();?>doctor_ctrl/update_dentalhistory/"+recnum+"/"+document.forms[0].recnum.value+"/"+document.getElementById('health_iss').value,
        success:function(response)
        {
           $('#dental_historydetails').html(response);
        }
   });
}
function editconsent_details(recnum)
{
   $.ajax(
   {
type: 'POST',
url: "<?php echo base_url();?>doctor_ctrl/update_consent/"+recnum,
        success:function(response)
        {
           $('#consent_details').html(response);
        }
   });
}
function getdentalhis_details(recnum)
{
	var dental_his='his_'+recnum;
	var consent_his='con_'+recnum;
	$('.clickableRow').removeClass("highlight");
	$('#'+dental_his).addClass("highlight");
	$('#'+consent_his).addClass("highlight");

	var dental_history_rec=document.getElementById('dental_history_rec').value;

	   $.ajax(
	   {
	type: 'POST',
	url: "<?php echo base_url();?>doctor_ctrl/dental_historydetails/"+recnum+"/"+dental_history_rec,
		success:function(response)
		{
		   $('#dental_historydetails').html(response);
		   $('#'+dental_his).addClass("highlight");
	           $('#'+consent_his).addClass("highlight");
		}
	   });
}

function gethealth_details(recnum,upd_num,val)
{

   var health_id='hel_'+val;
   $('.clickableRow').removeClass("highlight");
   $('#'+health_id).addClass("highlight");
   var med_history_rec=document.getElementById('med_history_rec').value;

   $.ajax(
   {
type: 'POST',
url: "<?php echo base_url();?>doctor_ctrl/gethealth_details/"+recnum+"/"+med_history_rec+"/"+upd_num,success:function(response)
        {
           $('#health_details').html(response);
           $('#'+health_id).addClass("highlight");
        }
   });
}

function edithealth_details(recnum)
{
   $.ajax(
   {
type: 'POST',
url: "<?php echo base_url();?>doctor_ctrl/edit_health_history/"+recnum+"/"+document.forms[0].recnum.value,
        success:function(response)
        {
           $('#health_details').html(response);
        }
   });
}

function save_acceptedval()
{
document.getElementById('dental_history_accept').value='accept';
document.forms['formdental_history'].param.value='dropdown41';
document.forms['formdental_history'].submit();
}
function save_acceptedhealthval()
{
  document.getElementById('health_history_accept').value='accept';
document.forms['formhealth_history'].param.value='dropdown11';
if(document.getElementById('output').value == '')
{
  alert("Please draw your Signature");
return false;
}
else
  document.forms['formhealth_history'].submit();
}




</script> 
	
<?
$style=' ';
$formal_dentist_style=' margin-right:350px;"background-color:#DFDFDF;" readonly ;';
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
</div>

<input type='hidden' name='health_iss' id='health_iss' value=
"<?echo  $health_iss ?>">

</div>
<?
$dddob=explode('-', $query->dob );
$dob=$dddob[1].'-'.$dddob[2].'-'.$dddob[0];
?>
<div style="margin-top:30px;" class="row-fluid">
<div class="span4 patients_info">
<h1>PERSONAL INFO </h1>                                
<UL>
<LI>Cell Phone:<?= $query->cell_phone ?></LI>
<LI>Home Phone: <?= $query->home_phone ?>
<LI>Work Phone: <?= $query->work_phone ?></LI>
<LI>Date of Birth: <?= $dob ?></LI>
<LI>Email: <?= $query->email ?></LI>
</UL>
</div>

<div class="span4 patients_info">
<h1>PRIMARY INSURANCE INFO</h1>
<UL>
<LI>Employer: <?= $insur->name_of_insured ?></LI>
<LI>Company :<?= $insur->insurance_company ?></LI>
<LI>Group Id: <?= $insur->group_id ?></LI>
<LI>Member Id: <?= $insur->member_id  ?></LI>
</UL>
</div>                            

<div class="span4 patients_info">
<h1>EMERGENCY</h1>                                
<UL>                                	 
<LI>Emergency Contact: <?= $emer->home_phone ?> </LI>
<LI> Emergency Cell phone:  <?= $emer->cell_phone ?></LI>
<LI> Referred By: <?= $query->referred_by ?></LI>
<LI>Referred To: </LI>
</UL>
</div>  
</div>                        
</div>
<div style="background:#eee;" class="span3 m-widget">
<ul class="patients_rightnav"  id='myTab_send'>
<?
if($this->session->userdata('msg_leftnav') != '')
{?>
<li>
<button class="btn btn-large btn-info" type="button" onclick='location.href="<?php echo base_url();?>doctor_ctrl/messages"' >  <i class="fa fa-envelope-o"></i>Send Message</button>
</li>    
<?}?>                           

<li><a data-toggle="tab" href="medical_alert">
<button class="btn btn-large btn-warning" type="button"> <i class="fa fa-exclamation-triangle"></i> Medical Alert</button>	
</a></li>

<li>
<button class="btn btn-large btn-info" type="button"> <i class="fa fa-stethoscope"></i>  Refer Patient  </button>									
</li>




</ul>




<div class="clearfix"> </div>
<div class="patients_social" id='patients_social'>
<a href="#"><i class="fa fa-tumblr"></i> </a> 

<a href="#"> <i class="fa fa-facebook"></i> </a> 


<a href="#"><i class="fa fa-twitter"></i></a> 

<a href="#"><i class="fa fa-google-plus"></i> </a>  

</div>
</div> 
</div>

</section>
<div style="margin-top:30px;" class="row-fluid">

<div class="m-widget-body">                                   

<ul style="margin-bottom:-1px;" class="nav nav-tabs" id="myTab">
<li id='home1' class="active" onclick="getPaging('#home')"><a data-toggle="tab" href="#home">Personal Info</a></li>
<li id='profile1' class="" onclick="getPaging('#profile')"><a data-toggle="tab" href="#profile">Emergency Info</a></li>
<li class="" id='dropdown11'  onclick="getPaging('#dropdown1')"><a data-toggle="tab" href="#dropdown1">Health History</a></li>
<li id='dropdown21' class="" onclick="getPaging('#dropdown2')"><a data-toggle="tab" href="#dropdown2">Insurance Info</a></li>
<li id='dropdown41' class="" onclick="getPaging('#dental_history')"><a data-toggle="tab" href="#dental_history">Dental History</a></li>
<li id='dropdown31' class="" onclick="getPaging('#dropdown3')"><a data-toggle="tab" href="#dropdown3">Consent Info</a></li>
</ul>
<div class="tab-content" id="myTabContent">
<?
$attr=array('class' => 'form-horizontal2','name' => 'form-horizontal2');
echo form_open_multipart('doctor_ctrl/update_profile',$attr);
?>

<div  id="home" class="tab-pane fade active in">
<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Personal Details</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">
<div class="control-group">
<label class="control-label" for="inputEmail">Email :</label>
<div class="controls">
<?php echo form_input(array('id' => 'email', 'name' => 'email','placeholder' => 'Email','style'=>$style,'value'=>"$query->email")); ?>
</div>
</div>
<input type='hidden' name='param' id='param' value=''>

<div class="control-group">
<label class="control-label" for="inputPassword">Photo: </label>
<div class="controls">
<ul class="thumbnails m-media-container">
<li class="span3">
<div class="caption">
<p style="margin-top:5px 0px;">
<?
echo '<img id="blah" src="'.$query->img_location.'">';
?>
<div class="caption">
<input type="file" name="userfile" class="ed" id="imgInp"><br/>
</div>
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
	<div class="input-append date" id="dp4" data-date="<?= date('Y-m-d') ?>" data-date-format="yyyy-mm-dd">
	<?php
	$data = array(
		'class' => 'input-large',
		'type' => "text",
		'name' => "dob",
		'id'  => "dob",
		'size' => '16',	
		'readonly'=>'readonly',
		'value'=>$dob,);
	echo form_input($data);
	?>
	<span style="position:relative; left:-30px; z-index:1;" class="add-on">
		<i class="icon-th"></i>
	</span>
</div></div>

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
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false">
Female</label> 
<?}
else
{?>
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false">
Male
</label>

<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" checked>
Female</label> 
<?}?>
</div>
</div>

<h1 style="font-weight:bold">Where do you live? </h1>
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
$h_m=$query->home_phone;
$h=explode('-',$h_m);
$c_m=$query->cell_phone;
$c=explode('-',$c_m);
$w_m=$query->work_phone;
$w=explode('-',$w_m);

$e_home=$emer->home_phone;
$e_h=explode('-',$e_home);

$e_cell=$emer->cell_phone;
$e_c=explode('-',$e_cell);

$e_work=$emer->work_phone;
$e_w=explode('-',$e_work);
		
?>


<h1 style="font-weight:bold">What is your contact Info ? </h1>
<div class="clearfix"></div>	 
<div class="alert alert-info">At least one of threee phones is required </div>
<div class="control-group">
<label class="control-label" for="inputEmail">Home Phone:</label>
<div class="controls">
<input name="home_phone1" id="home_phone1" type="" value="<?=$h[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation(this,1)">&nbsp;-
<input name="home_phone2" id="home_phone2" type="" value="<?=$h[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation(this,2)"/>&nbsp;-<input name="home_phone3" id="home_phone3" type="" value="<?=$h[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation(this,3)"/>
		</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Cell Phone:</label>
<div class="controls">
<input name="cell_phone4peronal1" id="cell_phone4peronal1" type="" value="<?=$c[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4cellphone(this,1)">&nbsp;-
<input name="cell_phone4peronal2" id="cell_phone4peronal2" type="" value="<?=$c[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4cellphone(this,2)"/>&nbsp;-<input name="cell_phone4peronal3" id="cell_phone4peronal3" type="" value="<?=$c[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4cellphone(this,3)"/>
		</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Work Phone:</label>
<div class="controls"> 
<input name="work_phone4peronal1" id="work_phone4peronal1" type="" value="<?=$w[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4workphone(this,1)">&nbsp;-
<input name="work_phone4peronal2" id="work_phone4peronal2" type="" value="<?=$w[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4workphone(this,2)"/>&nbsp;-<input name="work_phone4peronal3" id="work_phone4peronal3" type="" value="<?=$w[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4workphone(this,3)"/>
		</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Preferred method of Contact</label>
<div class="controls">
<?php echo form_input(array('id' => 'preferred_contact_mode', 'name' => 'preferred_contact_mode','placeholder' => 'NO','style'=>$style,'value'=>$query->preferred_contact_mode)); ?>		
</div>		
</div>	
</div> 

</div>
<ul class="patients_rightnav">
<li>
<div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:submitpatient_view('home1')"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div>
</li>
</ul>
</div>


<div id="profile" class="tab-pane fade">

<div class="row-fluid patient_history">

<div style="margin-bottom:10px;" class="m-widget">



<h1 style="font-weight:bold"> Emergency Contact Person's Details</h1>
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



<h1 style="font-weight:bold"> Emergency Contact Person's Contact Info </h1>
<div class="alert alert-info">  At least one of three phones is required </div>
<div class="control-group">
<label class="control-label" for="inputEmail">Home phone </label>
<div class="controls">
<input name="emer_homenum1" id="emer_homenum1" type="" value="<?=$e_h[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4emer_homephone(this,1)">&nbsp;-
<input name="emer_homenum2" id="emer_homenum2" type="" value="<?=$e_h[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4emer_homephone(this,2)"/>&nbsp;-<input name="emer_homenum3" id="emer_homenum3" type="" value="<?=$e_h[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4emer_homephone(this,3)"/>
		</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Cell  phone</label>
<div class="controls">
	<input name="emer_cellnum1" id="emer_cellnum1" type="" value="<?=$e_c[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4emer_cellphone(this,1)">&nbsp;-
<input name="emer_cellnum2" id="emer_cellnum2" type="" value="<?=$e_c[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4emer_cellphone(this,2)"/>&nbsp;-<input name="emer_cellnum3" id="emer_cellnum3" type="" value="<?=$e_c[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4emer_cellphone(this,3)"/>
		</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Work phone</label>
<div class="controls"> 
<input name="emer_worknum1" id="emer_worknum1" type="" value="<?=$e_w[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4emer_workphone(this,1)">&nbsp;-
<input name="emer_worknum2" id="emer_worknum2" type="" value="<?=$e_w[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4emer_workphone(this,2)"/>&nbsp;-<input name="emer_worknum3" id="emer_worknum3" type="" value="<?=$e_w[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4emer_workphone(this,3)"/>
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



</div>




</div>
<ul class="patients_rightnav">
<li>

<div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:submitpatient_view('profile1')"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div>

</li>
</ul>
</div>



<div id="dropdown2" class="tab-pane fade">
<div class="row-fluid patient_history">
<div class="m-widget-body">

<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Insurance Details of  Primary Insured</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">

<div class="control-group">
<label class="control-label" for="inputPassword" style='float: left;
width:350px;  padding-top: 5px;  text-align: left;'>Name of Primary Insured</label>
<div class="controls">
<input type="text"  name='name_of_insured' id='name_of_insured' placeholder="Name" value="<?= $insur->name_of_insured ?>" >
</div>
</div>	

<div class="control-group">
<label class="control-label" for="inputPassword" 
style='float: left; width:350px;  padding-top: 5px;  text-align: left;'>Name Of The Patients</label>
<div class="controls">
<input type="text" placeholder="Name" style="background-color='#DFDFDF' readonly" value='<?= $query->fname ?>'  >
</div>
</div> 
</div>

<div class="clearfix"></div> 
<h1 style="font-weight:bold">Primary Insurance</h1>
<div style="margin-bottom:10px;" class="m-widget">
<div class="control-group">
<label class="control-label" for="inputPassword">Insurance Company </label>
<div class="controls">
<input type="text" placeholder="Company Name" value="<?= $insur->insurance_company ?>" name='insurance_company' id='insurance_company'>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Group ID</label>
<div class="controls">
<input type="text" placeholder="ID" name='group_id'  id='group_id' value="<?= $insur->group_id ?>">
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Member ID </label>
<div class="controls">
<input type="text" placeholder="ID"  name='member_id' id='member_id' value="<?= $insur->member_id ?>">
</div>
</div>





</div>

<div class="clearfix">  </div> 

<div class="well">
	 <p>Upload photos/scanned image of insurance card
</p>
	<ul class="thumbnails m-media-container">
		<li class="span3">
<?
echo '<img id="insureoneimg"  src="'.$insur->img1_location.'">';
?>
<div class="caption">
<input type="file" name="ins1_userfile" class="ed" id="insureonebrowse"><br/>
</div>
</li>
<li>&nbsp;</li>
<li class="span3">
<?
echo '<img id="insuretwoimg"  src="'.$insur->img2_location.'">';
?>
<div class="caption">
<input type="file" name="ins2_userfile" class="ed" id="insuretwobrowse"><br/>
</div>
</li>
	</ul>
</div>
</div></div>
</div>
<ul class="patients_rightnav">
<li>

<div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:submitpatient_view('dropdown21')"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div>

</li>
</ul>
</div>

</form>



<div id="dropdown1" class="tab-pane fade">
<br>
<table class="table table-bordered patient_table" style="table-layout: fixed" id='csample' width='98%' border=1>
<thead style="width:100%; background:#43B5CB; color:#FFF;">
<tr>
<th>Doctor Name</th>
<th>Physician Phone</th>
<th>Have High BP?</th>
<th>Have Low BP?</th>
<th>Any Surgery Done?</th>
</tr>
</thead>
</table>

<div width='100%' style="height:150px; overflow-x:hidden;overflow-y:scroll;border:;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>

<tbody style="width:100%;">
<?
$doctornames  = $this->doctor_model->getdocname($this->session->userdata('doctor_id'));
$dcname=$doctornames->fullname;

$i=0;
$doc='';
$medhigh_con=array();
$medlow_con=array();
$health_rec=array();

$flag=0;
$prev_upd='';
$k=0;

foreach($health as $p)
{
   $recnum=$p->health_rec;  
   if($flag == 0)
   {
      $phone=$p->physician_phone;
      $sur_done=$p->surgery_done;    
   } 

   if($p->medical_condition == 'High Blood Pressure')
   {
     $medhigh_con[$k]=$p->condition_status;
   }
   if($p->medical_condition == 'Low Blood Pressure')
   {
     $medlow_con[$k]=$p->condition_status;
   }
   $mod[$i]=$p->modified_date;

   if($p->upd_num != $prev_upd)
   {
          sort($medhigh_con);
          sort($medlow_con);
          $health_rec[]=$recnum;
          $upd_num[]=$p->upd_num;
	  $i++; 
          $k++; $flag=0;      
   }
   $prev_upd=$p->upd_num;
}
$medhigh_con=array_values($medhigh_con);
$medlow_con=array_values($medlow_con);

for($j=0;$j<$i;$j++)
{
   $health_id='hel_'.$j;
?>
	<tr id="<?= $health_id?>" class='clickableRow' 
	onclick="javascript:gethealth_details('<?echo $health_rec[$j] ?>','<?echo $upd_num[$j] ?>','<?= $j ?>')">  
	<th><?php echo $dcname?></th>
	<th><?php echo $phone?></th>
	<th><?php echo $medhigh_con[$j]?></th>
	<th><?php echo $medlow_con[$j]?></th>
	<th><?php echo $sur_done?></th>
        </tr>
<?}?>
</tbody>
</table>
</div>
</table>
<?
if(!empty($query_health))
{?>
<input type='hidden' name='med_history_rec' id='med_history_rec' 
value="<?= $query_health->recnum ?>">
<?}
else
{?>
<input type='hidden' name='med_history_rec' id='med_history_rec' 
value="">
<?}

if(!empty($consent[0]))
{?>
<input name="consent_rec" id="consent_rec" type="hidden" value="<? echo $consent[0]->recnum ?>">
<?}
else
{?>
<input name="consent_rec" id="consent_rec" type="hidden" value="">
<?
}
?>
<div class="row-fluid patient_history" id='health_details'>
<?
if(count($query_health) >0)
{
	if($query_health->accept != 'accept')
	{?>
		<div>
		<h1>
		<img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" onclick="edithealth_details(<?echo $recnum ?>)">
		</h1>
		</div>
<?
}
?>
<br>
<br>
<h1 style="font-weight:bold">Your Weight and height</h1>
<div class="clearfix">
</div>
<div style="margin-bottom:10px;" class="m-widget">
<form name="formConsent" id="formConsent" class="form-horizontal2 sigPad4doc" action="<?echo base_url()?>doctor_ctrl/gethealth_details/<?=$recnum?>" method="post" novalidate="novalidate">
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

<h1 style="font-weight:bold">Your Health Status  </h1>

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
<input type="radio" data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="no" id="goodhealth_1" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="yes" id="are_you_in_good_health" onclick="return false">
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
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="no" id="under_physician_care" onclick="return false">
No</label>	
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="yes" id="under_physician_care" onclick="return false">
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
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='no' onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='yes' onclick="return false">
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

<h1 style="font-weight:bold">Do you use alcohol, tobaco, drugs?  </h1>

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
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="no" id="alcoholic_consumption" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" onclick="return false">
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
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="no" id="recreation_drug_usage" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="yes" id="recreation_drug_usage" onclick="return false">
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
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="no" id="alcohol_abuse" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="yes" id="alcohol_abuse" onclick="return false">
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
<input type="radio" data-attr="smoke" name="smoke" value="no" id="smoke" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="smoke" name="smoke" value="yes" id="smoke" onclick="return false">
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
<input type="radio" data-attr="tobacco" name="tobacco" value="no" id="tobacco" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="tobacco" name="tobacco" value="yes" id="tobacco" onclick="return false">
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

<h1 style="font-weight:bold">Your medical condition</h1>

<p>Have you had currently have any of the following conditions? Check the ones that are applicable<br>


<div style="margin-bottom:10px;" class="m-widget" >
<form class="form-horizontal2 sigPad1">
<div class="control-group">
<label class="control-label">
<table border=0>
<?
$prev_group='';$i=0;
foreach($med_his as $m)
{
        if($prev_group == '' || $prev_group != $m->group)
	{?>
           <tr><td><strong><?= $m->group ?></strong></p></td></tr>
        <?$i=0;
        }
	if($i%2 == 0 )
	{
	  echo "</tr><tr>";
	}
	if($m->condition_status == 'yes')
	{?>
	<td><div class="control-group">
	<label class="control-label" style="margin-left:20px !important">
	<input type="checkbox" id="name_<?= $i?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>" checked ><?= $m->medical_condition ?>
	</label>
	</div></td>
	<?
	}
	else
	{?>
	<td><div class="control-group">
	<label class="control-label" style="margin-left:20px !important">
	<input type="checkbox" id="name_<?= $i?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>"  ><?= $m->medical_condition ?>
	</label>
	</div></td>
	<?
}?>

	<input type='hidden'  style="width:100px !important" name="group<?= $i?>" 
	value="<?= $m->group ?>" id="group<?= $i?>">
	<input type='hidden'  style="width:100px !important" name="dispseq_<?= $i?>" 
	value="<?= $i ?>" id="dispseq_<?= $i?>">
<?
        $prev_group=$m->group;
        $i++;
}?>
</table>

<!--
<?
if($query_health->high_bp    == 'yes')
{?>
<input type="checkbox" data-attr="high_bp" name="high_bp" id='high_bp' value="yes" checked onclick="return false">
<span style="color:#FF0000">High Blood Pressure</span>
<?}
else
{?>
<input type="checkbox" data-attr="high_bp" name="high_bp" id='high_bp' value="yes" onclick="return false" >
High Blood Pressure
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->low_bp     == 'yes')
{?>
<input type="checkbox" data-attr="low_bp" name="low_bp" value="yes" id="low_bp" checked onclick="return false">
<span style="color:#FF0000">Low Blood Pressure</span>
<?}
else
{?>
<input type="checkbox" data-attr="low_bp" name="low_bp " value="no" id="low_bp" onclick="return false">
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
<input type="checkbox" data-attr="angina_chest_pain" name="angina_chest_pain" value="yes" checked onclick="return false">
<span style="color:#FF0000">Angina Chest Pain</span>
<?}
else
{?>
<input type="checkbox" data-attr="angina_chest_pain" name="angina_chest_pain " value="no"  onclick="return false">
Angina Chest Pain
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->fainiting  == 'yes')
{?>
<input type="checkbox" data-attr="fainiting" name="fainiting " value="yes" id='fainiting '  checked onclick="return false">
<span style="color:#FF0000">Fainting</span>
<?}
else
{?>
<input type="checkbox" data-attr="fainiting" name="fainiting " value="no" id='fainiting '  onclick="return false">
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
<input type="checkbox" data-attr="irregular_heartbeat" name="irregular_heartbeat" value="yes" id='irregular_heartbeat ' checked onclick="return false">
<span style="color:#FF0000">Irregular Heartbeat</span>
<?}
else
{?>
<input type="checkbox" data-attr="irregular_heartbeat" name="irregular_heartbeat " value="no" id='irregular_heartbeat ' onclick="return false">
Irregular Heartbeat
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->heart_attack    == 'yes')
{?>
<input type="checkbox" data-attr="heart_attack" name="heart_attack" id='heart_attack'  value="yes" checked onclick="return false">
<span style="color:#FF0000">Heart Attack<span>
<?}
else
{?>
<input type="checkbox" data-attr="heart_attack" name="heart_attack" id='heart_attack'  value="no" onclick="return false">
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
<input type="checkbox" data-attr="heart_bypass" name="heart_bypass" id='heart_bypass' value="yes" checked onclick="return false">
<span style="color:#FF0000">Heart Bypass</span>
<?}
else
{?>
<input type="checkbox" data-attr="heart_bypass" name="heart_bypass" id='heart_bypass' value="no" onclick="return false">
Heart Bypass
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->pacemaker    == 'yes')
{?>
<input type="checkbox" data-attr="pacemaker" name="pacemaker" id='pacemaker' value="yes" checked onclick="return false">
<span style="color:#FF0000">Pacemaker</span>
<?}
else
{?>
<input type="checkbox" data-attr="pacemaker" name="pacemaker" id='pacemaker' value="no"  onclick="return false" onclick="return false">
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
<input type="checkbox" data-attr="anemia" name="anemia " value="yes" id='anemia'  checked onclick="return false">
<span style="color:#FF0000">Anemla</span>
<?}
else
{?>
<input type="checkbox" data-attr="anemia" name="anemia " value="no" id='anemia' onclick="return false" >
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
<input type="checkbox" data-attr="hepatitis_a" name="hepatitis_a" value="yes" id="hepatitis_a" checked onclick="return false">
<span style="color:#FF0000">Hepatitis A</span>
<?}
else
{?>
<input type="checkbox" data-attr="hepatitis_a" name="hepatitis_a" value="no" id="hepatitis_a" onclick="return false">
Hepatitis A
<?}?>
</label>


<label class="radio inline">
<?
if($query_health->hepatitis_b  == 'yes')
{?>
<input type="checkbox" data-attr="hepatitis_b" name="hepatitis_b" value="yes" id="hepatitis_b " checked onclick="return false">
<span style="color:#FF0000">Hepatitis B</span>
<?}
else
{?>
<input type="checkbox" data-attr="hepatitis_b" name="hepatitis_b" value="no" id="hepatitis_b "  onclick="return false">
Hepatitis B
<?}?>
</label>

<label class="radio inline">
<?
if($query_health->hepatitis_c   == 'yes')
{?>
<input type="checkbox" data-attr="hepatitis_c" name="hepatitis_c" value="yes" id="hepatitis_c" checked onclick="return false">
<span style="color:#FF0000">Hepatitis C</span>
<?}
else
{?>
<input type="checkbox" data-attr="hepatitis_c" name="hepatitis_c" value="no" id="hepatitis_c" onclick="return false" >
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
<input type="checkbox" name="hiv" data-attr="hiv" id='hiv'  value="yes" checked onclick="return false">
<span style="color:#FF0000">HIV-</span>
<?}
else
{?>
<input type="checkbox" name="hiv" data-attr="hiv" id='hiv'  value="no" onclick="return false">
HIV-
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->aids == 'yes')
{?>
<input type="checkbox" name="aids"  data-attr="aids" id='aids' value="yes" checked onclick="return false">
<span style="color:#FF0000">AIDS</span>
<?}
else
{?>
<input type="checkbox" name="aids"  data-attr="aids" id='aids' value="no" onclick="return false">
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
<input type="checkbox" name="std" data-attr="std" value="yes" id='std' checked onclick="return false">
<span style="color:#FF0000">Sexually Transmitted Disease</span>
<?}
else
{?>
<input type="checkbox" name="std" data-attr="std" value="no" id='std' onclick="return false">
Sexually Transmitted Disease
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->delay_in_healing == 'yes')
{?>
<input type="checkbox" data-attr="delay_in_healing" name="delay_in_healing" value="yes"  id='delay_in_healing' checked onclick="return false">
<span style="color:#FF0000">Delay in Healing</span>
<?}
else
{?>
<input type="checkbox" data-attr="delay_in_healing" name="delay_in_healing" value="no"  id='delay_in_healing' onclick="return false">
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
<input type="checkbox" data-attr="pancreas_diabetes" name="pancreas_diabetes" value="yes"  id='pancreas_diabetes' checked onclick="return false">
<span style="color:#FF0000">pancreas diabetes</span>
<?}
else
{?>
<input type="checkbox" data-attr="pancreas_diabetes" name="pancreas_diabetes" value="no"  id='pancreas_diabetes' onclick="return false">
pancreas diabetes
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->kidney_dialysis == 'yes')
{?>
<input type="checkbox" data-attr="kidney_dialysis" name="kidney_dialysis" value="yes"  id='kidney_dialysis' checked onclick="return false">
<span style="color:#FF0000">Kidney / Dialysis</span>
<?}
else
{?>
<input type="checkbox" data-attr="kidney_dialysis" name="kidney_dialysis" value="no"  id='kidney_dialysis' onclick="return false">
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
<input type="checkbox" data-attr="eyes_glaucoma" name="eyes_glaucoma" value="yes" checked id='eyes_glaucoma' onclick="return false">
<span style="color:#FF0000">Eyes / Glaucoma</span>
<?}
else
{?>
<input type="checkbox" data-attr="eyes_glaucoma" name="eyes_glaucoma" value="no"  id='eyes_glaucoma' onclick="return false">
Eyes / Glaucoma
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->thyroid == 'yes')
{?>
<input type="checkbox" data-attr="thyroid" name="thyroid" value="yes" id='thyroid' checked onclick="return false">
<span style="color:#FF0000">Thyroid</span>
<?}
else
{?>
<input type="checkbox" data-attr="thyroid" name="thyroid" value="no" id='thyroid'  onclick="return false">
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
<input type="checkbox" data-attr="neurology_epilepsy" name="neurology_epilepsy" id='neurology_epilepsy' value="yes" checked onclick="return false">
<span style="color:#FF0000">Neurology Epilepsy</span>
<?}
else
{?>
<input type="checkbox" data-attr="neurology_epilepsy" name="neurology_epilepsy" id='neurology_epilepsy' value="no" onclick="return false">
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
<input type="checkbox" data-attr="cancer_location" name="cancer_location" id='cancer_location' value="yes" checked onclick="return false">
<span style="color:#FF0000">Cancer Location</span>
<?}
else
{?>
<input type="checkbox" data-attr="cancer_location" name="cancer_location" id='cancer_location' value="no" onclick="return false">
Cancer Location
<?}?>
</label>


<div class="controls">
<div class='radio inline'>
<input class="input-large" type="text" placeholder="Location" value='<?= $query_health->cancer_location_name ?>' onclick="return false">
</div>
</div>
</div>
<div class="control-group">
<label class="control-label">
<?
if($query_health->surgery == 'yes')
{?>
<input type="checkbox" data-attr="surgery" name="surgery" id='surgery'  value="yes" checked onclick="return false">
<span style="color:#FF0000">Surgery</span> 
<?}
else
{?>
<input type="checkbox" data-attr="surgery" name="surgery" id='surgery'  value="no" onclick="return false">
Surgery 
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->radiation  == 'yes')
{?>
<input type="checkbox" data-attr="radiation" name="radiation" value="yes" id='radiation' checked onclick="return false">
<span style="color:#FF0000">Radiation</span>
<?}
else
{?>
<input type="checkbox" data-attr="radiation" name="radiation" value="no" id='radiation' onclick="return false">
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
<input type="checkbox" data-attr="chemotherapy" name="chemotherapy" value="yes" checked id='chemotherapy' onclick="return false">
<span style="color:#FF0000">Chemotherapy</span>
<?}
else
{?>
<input type="checkbox" data-attr="chemotherapy" name="chemotherapy" value="no"  id='chemotherapy' onclick="return false">
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
<input type="checkbox" data-attr="jaw_joints_pain" name="jaw_joints_pain" value="yes"  id='jaw_joints_pain' checked onclick="return false">
<span style="color:#FF0000">Clicking / Pain in jaw joints when eating</span>
<?}
else
{?>	 
<input type="checkbox" data-attr="jaw_joints_pain" name="jaw_joints_pain" value="no"  id='jaw_joints_pain' onclick="return false">
Clicking / Pain in jaw joints when eating
<?}?>
</label>
<div class="controls">
<label class="radio inline">
<?
if($query_health->arthritis  == 'yes')
{?>
<input type="checkbox" data-attr="arthritis" name="arthritis" id='arthritis'  value="yes" checked onclick="return false">
<span style="color:#FF0000">Arthritis</span>
<?}
else
{?>
<input type="checkbox" data-attr="arthritis" name="arthritis" id='arthritis'  value="no" onclick="return false">
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
<input type="checkbox" data-attr="arthritis_knee_replacement" name="arthritis_knee_replacement" value="yes" checked onclick="return false">
<span style="color:#FF0000">Arthritis Knee Replacement</span>
<?}
else
{?>
<input type="checkbox" data-attr="arthritis_knee_replacement" name="arthritis_knee_replacement" value="no" onclick="return false">
Arthritis Knee Replacement
<?}?>
</label>
<div class="controls">
<label class="radio inline">
<?
if($query_health->arthritis_hip_replacement  == 'yes')
{?>
<input type="checkbox" data-attr="arthritis_hip_replacement" name="arthritis_hip_replacement" value="yes" checked id='arthritis_hip_replacement' onclick="return false">
<span style="color:#FF0000">Arthritis Hip Replacement</span>
<?}
else
{?>
<input type="checkbox" data-attr="arthritis_hip_replacement" name="arthritis_hip_replacement" value="no"  id='arthritis_hip_replacement' onclick="return false">
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
<input type="checkbox" data-attr="swollen_ankles" name="swollen_ankles" id='swollen_ankles'  value="yes" checked onclick="return false">
<span style="color:#FF0000">Swollen Ankles</span>
<?}
else
{?>
<input type="checkbox" data-attr="swollen_ankles" name="swollen_ankles" id='swollen_ankles '  value="no" onclick="return false">
Swollen Ankles
<?}?>
</label>
-->

</div>

<div class="control-group">
<label class="control-label">

Other
</label>
<div class="controls">
<div class='radio inline'>
<input class="input-large" type="text" placeholder="..."  id='other' name='other'  data-attr="other" value='<?= $query_health->other ?>' onclick="return false">
</div>
</div>  

<div class="form-group">
<label for="treatment_signature" class="control-label" style="float:left;width:25%">Your signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper"  style=" margin-left:380px;display:block;clear:none;width:400px">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output" class="output">
  </div>
 </div>
</div>
</div>

<?}
else
{?>
<div>
<h1>
<img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" onclick="edithealth_details(<?echo $recnum ?>)">
</h1>
</div>
<?}?>

</div>	
</div>	
</form>
</div>
</div>
</div>


<div id="dropdown3" class="tab-pane fade">
<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal100','name'=>'form-horizontal130');
echo form_open_multipart('doctor_ctrl/insert_consent',$attr);
?>

	<div class="row-fluid patient_history">
	<div class="m-widget-body">

	<div class="row-fluid patient_history">
	<h1 style="font-weight:bold">Patient Information/Informed Consent Form</h1>
	<div class="clearfix"></div>
	<div style="margin-bottom:10px;" class="m-widget">
<br>
<table class="table table-bordered patient_table" style="table-layout: fixed" id='csample' width='98%' border=1>
<thead style="width:100%; background:#43B5CB; color:#FFF;">
<tr>
<th>Doctor Name</th>
<th>Consent for</th>
<th>Patient Name</th>
<th>Consent Date</th>
</tr>
</thead>
</table>

<div width='100%' style="height:150px; overflow-x:hidden;overflow-y:scroll;border:;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>

<tbody style="width:100%;">
<?
$i=0;

foreach($consent as $p)
{
$data=array();
$consent_id='con_'.$p->recnum;
	$data['treatment_to_be_done']='Treatment to be Done';
	$data['drugs_and_medication']='Drugs and Medication';
	$data['changes_to_treatment_plan']='Changes to treatment plan';
	$data['extraction']="Extraction";
	$data['crowns']="Crowns";
	$data['dentures']="Dentures";
	$data['endodontic_treatment']="Endodontic Treatment";
	$data['periodontal_loss']="Periodontal Loss";
	$data['fillings']="Fillings";
	$data['pedodontics']="Pedodontics";

	$date =date_format(date_create($p->date), 'M j, Y');
	?>
	<tr class='clickableRow' id="<?= $consent_id ?>"
	onclick="javascript:getdentalhis_details(<?echo $p->recnum ?>)">                                  
	<th><?php echo $p->doc_fullname;?></th>
	<th><?php echo $data[$p->type]?></th>
	<th><?php echo $p->patient_fullname?></th>
	<th><?php echo $date?></th>
	</tr>
	<?php
	$i++;
}
?>
</tbody>
</table>
</div>
</table>
<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal90','name'=>'form-horizontal90');
echo form_open_multipart('patient_ctrl/insert_dental_history',$attr);
?>
<div class="row-fluid patient_history" id='consent_details'>
<?
if(count($consent) > 0 )
{?>
<div><h1>
<img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" 
 onclick="javascript:editconsent_details(<?echo $query->recnum ?>)">
</h1>
</div>
<?}
else
{?>
<div><h1>
<button id='search' style="width:7%;float:right;text-align:center" onclick="javascript:editconsent_details(<?echo $query->recnum ?>)"
 class="btn  btn-info" type="button"> 
<i ></i>ADD</button>

</h1>
</div>
<?}?>
<br><br>

<input name="link2patient" id="link2patient" type="hidden" value="<? echo $query->recnum ?>">
<?
if(count($consent) > 0)
{?>

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
style="margin-right:390px;margin-top:-25px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">



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
<input type="text" style="margin-right:390px;margin-top:-25px"  class="form-control input-sm pull-right consent_patient_name" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

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
style="margin-right:390px;margin-top:-25px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

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
style="margin-right:390px;margin-top:-25px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>


<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

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
style="margin-right:390px;margin-top:-25px"   value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>

</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

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
require relining approximately three to six months after initial placement and yearly thereafter. The cost for these relines is not included in the
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
style="margin-right:390px;margin-top:-25px"  value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>

</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

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
style="margin-right:390px;margin-top:-25px"  value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

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
style="margin-right:390px;margin-top:-25px"  value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

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
style="margin-right:390px;margin-top:-25px"  value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

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
style="margin-right:390px;margin-top:-25px"  value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>

<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

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

<div class="panel sigPad4patient">
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
<div  style=" margin-left:200px;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:520px;margin-top:-25px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

</div>
</div>
</div>
</div>
</div>
</div>

<br>

<div class="panel  sigPad4dentist">
<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Dentist Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4dentistsign" class="output">
  </div>
 </div>
</div>
<br>
<div class="row form-group">
<label for="consent_doctor_name" class="col-sm-3 control-label" style="float:left;width:25%">Doctor</label>
<?
$doc  = $this->doctor_model->getdocname($this->session->userdata('doctor_id'));
$docid=$doc->recnum;
$docname=$doc->fullname;
?>
<div  style=" margin-left:200px;display:block;clear:none;float:left">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:420px;margin-top:-25px" value="<? echo $docname ?>" readonly="readonly" >
<input type="hidden" name="consent_doctor_name" id='consent_doctor_name' 
value="<?echo $docid?>">
</div>
</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

</div>
</div>
</div>
</div>
</div>
</div>

<div class="panel  sigPad4witness">
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
<div  style=" margin-left:200px;display:block;clear:none;float:left">
<input style="margin-right:420px;margin-top:-25px" type="text" class="form-control input-sm pull-right" id="witness" name="witness" value="" autocomplete="off" placeholder="Witness" readonly="readonly">
</div>
</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">

</div>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>


<?}?>


	
</div>
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

<div width='100%' style="height:150px; overflow-x:hidden;overflow-y:scroll;border:;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>

<tbody style="width:100%;">
<?
$i=0;
foreach($denhisory as $p)
{
        $dental_his='his_'.$p->recnum;
	$last_dental_visit =date_format(date_create($p->last_dental_visit), 'M j, Y');
	$last_dental_xray =date_format(date_create($p->last_dental_xray), 'M j, Y');
	$date=date_format(date_create($p->last_dental_xray), 'M j, Y');
	?>
	<tr class='clickableRow' id="<?= $dental_his?>"
	onclick="javascript:getdentalhis_details(<?echo $p->recnum ?>)">                                  
	<th><?php echo $p->formal_dentist;?></th>
	<th><?php echo $p->reason_today_visit?></th>
	<th><?php echo $last_dental_visit?></th>
	<th><?php echo $last_dental_xray?></th>
	</tr>
	<?php
	$i++;
}
?>
</tbody>
</table>
</div>
</table>




<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal90','name'=>'form-horizontal90');
echo form_open_multipart('patient_ctrl/insert_dental_history',$attr);
?>
<input name="userId" class="dental_userId" type="hidden" value="23">
<div class="row-fluid patient_history" id='dental_historydetails'>
<?
if(count($den_his) > 0 && $den_his->accept != 'accept')
{?>
<div><h1>
<img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" 
 onclick="editdentalhis_details(<?echo $den_his->recnum ?>)">
</h1></div>
<?}
else if(count($den_his) == 0)
{?>
<div><h1>
<button id='search' style="width:7%;float:right;text-align:center" onclick="javascript:editdentalhis_details('1')"
 class="btn  btn-info" type="button"> 
<i ></i>ADD</button>

</h1></div>
<?}?>
<br><br>


<?
if(!empty($den_his))
{?>
<input type='hidden' name='dental_history_rec' id='dental_history_rec' 
value="<?= $den_his->recnum ?>">
<?}
else
{?>
<input type='hidden' name='dental_history_rec' id='dental_history_rec' 
value="">
<?}

if(count($den_his) > 0)
{?>
<div class="row row-centered topbuffer">
<div id="tabDentalInfo-top-column">
<span class="alert-block" id="error-summary-top-dental"></span>

<div class="panel panel-primary">
<div class="panel-heading text-center">
<h3 class="panel-title">Reason and recent visit</h3>
</div>
<div class="panel-body">

<div class="form-group">
<label for="reason_text" class="col-sm-7 control-label" style="width:200px;float:left">Reason for today's visit</label>
<div class="col-sm-9">
<textarea rows="3" style="margin-right:300px" class="form-control input-sm" id="reason_text" name="reason_text" autocomplete="off" readonly placeholder="Reason for today&#39;s visit"><?= $den_his->reason_today_visit ?></textarea>
</div>
</div>
<br>

<div class="form-group">
<label for="fomer_dentist_name" class="col-sm-7 control-label" style="width:200px;float:left">Former Dentist</label>
<div class="col-sm-5" >
<?php echo form_input(array('id' => 'former_dentist_name', 'name' => 'former_dentist_name','placeholder' => 'Last Name','style'=>$formal_dentist_style,'value'=>$den_his->formal_dentist)); ?>
</div>
</div>
<br>
<?
$dddob=explode('-', $den_his->last_dental_visit );
$last_exam=$dddob[1].'-'.$dddob[2].'-'.$dddob[0];
$dddob1=explode('-', $den_his->last_dental_xray);
$last_xray=$dddob1[1].'-'.$dddob1[2].'-'.$dddob1[0];
?>
<div class="form-group">
<label for="last_dental_date" class="col-sm-7 control-label" style="width:200px;float:left">Date of last dental exam</label>
<div class="col-sm-5" id="last-dental-date-container">

<div class="input-append date" id="dp4" data-date="<?= date('Y-m-d') ?>"  data-date-format="yyyy-mm-dd" style="margin-right:320px">
	<?php
	$data = array(
		'class' => 'input-large',
		'type' => "text",
		'name' => "last_dental_date",
		'id'  => "last_dental_date",
		'size' => '16',	
		'readonly'=>'readonly',
'value'=>  "$last_exam" ,
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
<label for="last_dental_date" class="col-sm-7 control-label" style="width:200px;float:left">Date of last dental X-Ray</label>
<div class="col-sm-5" id="last-dental-date-container">
	<div class="input-append date" id="dp5" data-date="<?= date('Y-m-d') ?>"  data-date-format="yyyy-mm-dd" style="margin-right:320px">
	<?php
	$data = array(
		'class' => 'input-large',
		'type' => "text",
		'name' => "last_dental_xray_date",
		'id'  => "last_dental_xray_date",
		'size' => '16',	
		'readonly'=>'readonly',
                'value'=>  "$last_xray",
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
<div class="col col-md-6 col-xs-6 col-centered col-top" style="float:left">

<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Bad breath</label>
<?
if($den_his->bad_breath == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="bad_breadth" id="bad_breadth_yes" value="yes" checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="bad_breadth" id="bad_breadth_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="bad_breadth" id="bad_breadth_yes" value="yes" onclick="return false"> Yes</label> <label class="radio-inline"><input type="radio" name="bad_breadth" id="bad_breadth_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>

<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Bleeding gums</label>
<?
if($den_his->bleeding_gums == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="bleeding_gums" id="bleeding_gums_yes" value="yes"  checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="bleeding_gums" id="bleeding_gumss_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="bleeding_gums" id="bleeding_gums_yes" value="yes" onclick="return false"> Yes</label> <label class="radio-inline"><input type="radio" name="bleeding_gums" id="bleeding_gumss_no" value="no"   checked="checked"> No </label>
<?}?>
</div>
</div>
<br>

<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Blisters on lips or mouth</label>
<?
if($den_his->blisters_teeth == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="blisters" id="blisters_yes" value="yes" checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="blisters" id="blisters_no" value="no"  onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="blisters" id="blisters_yes" value="yes" onclick="return false"> Yes</label> <label class="radio-inline"><input type="radio" name="blisters" id="blisters_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>

<?
if($den_his->burning_sensation == 'yes')
{?>
<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Burning sensation on tongue</label>

<label class="radio-inline"><input type="radio" name="burning" id="burning_yes" value="yes" checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="burning" id="burninge_no" value="no"  onclick="return false"> No </label>
</div>
<?}
else
{?>
<div class="form-group"><div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Burning sensation on tongue</label>

<label class="radio-inline"><input type="radio" name="burning" id="burning_yes" value="yes" onclick="return false"> Yes</label> <label class="radio-inline"><input type="radio" name="burning" id="burninge_no" value="no" checked="checked"> No </label>
</div>
<?}?>

</div>
<br>

<div class="form-group">
<?
if($den_his->chew_one_side == 'yes')
{?>
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px"> Chew on one side of mouth</label>

<label class="radio-inline"><input type="radio" name="chew_side" id="chew_side_yes" value="yes"
checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="chew_side" id="chew_side_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px"> Chew on one side of mouth</label>

<label class="radio-inline"><input type="radio" name="chew_side" id="chew_side_yes" value="yes"
onclick="return false"> Yes</label> <label class="radio-inline"><input type="radio" name="chew_side" id="chew_side_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>

<div class="form-group">
<?
if($den_his->chew_one_side == 'yes')
{?>
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Clicking or popping jaw</label>

<label class="radio-inline"><input type="radio" name="click_pop" id="click_pop_yes" checked="checked" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="click_pop" id="click_pop_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Clicking or popping jaw</label>

<label class="radio-inline"><input type="radio" name="click_pop" id="click_pop_yes" onclick="return false" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="click_pop" id="click_pop_no" value="no" checked="checked" > No </label>
<?}?>
</div>
</div>
<br>

<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Dry Mouth</label>
<?
if($den_his->dry_mouth== 'yes')
{?>
<label class="radio-inline"><input type="radio" checked="checked" name="dry_mouth" id="dry_mouth_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="dry_mouth" id="dry_mouth_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" onclick="return false" name="dry_mouth" id="dry_mouth_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="dry_mouth" id="dry_mouth_no" value="no" checked="checked" > No </label>
<?}?>
</div>
</div>
<br>


<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label"  style="width:200px">Fingernail biting</label>
<?
if($den_his->fingar_bitting == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="finger_bite" id="finger_bite_yes" value="yes" checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="finger_bite" id="finger_bite_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="finger_bite" id="finger_bite_yes" value="yes" onclick="return false"> Yes</label> <label class="radio-inline"><input type="radio" name="finger_bite" id="finger_bite_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>

<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Foreign object</label>
<?
if($den_his->foreign_object == 'yes')
{?>
<label class="radio-inline"><input type="radio" checked="checked" name="foreign" id="foreign_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="foreign" id="foreign_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="foreign" onclick="return false" id="foreign_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="foreign" id="foreign_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>


<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Grinding teeth</label>
<?
if($den_his->grinding_teeth == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="grind" checked="checked" id="grind_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="grind" id="grind_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="grind" id="grind_yes" value="yes" onclick="return false"> Yes</label> <label class="radio-inline"><input type="radio" name="grind" id="grind_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>



<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Gums swollen or tender</label>
<?
if($den_his->gum_swollen == 'yes')
{?>
<label class="radio-inline"><input checked="checked" type="radio" name="gums" id="gums_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="gums" id="gums_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="gums" id="gums_yes" onclick="return false" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="gums" id="gums_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>

<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Jaw pain or tiredness</label>
<?
if($den_his->jaw_pain == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="jaw_pain" checked="checked" id="jaw_pain_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="jaw_pain" id="jaw_pain_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="jaw_pain" id="jaw_pain_yes" onclick="return false" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="jaw_pain" id="jaw_pain_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>

</div>
<div class="col col-md-6 col-xs-6 col-centered col-top" style="float:right">

<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Lip or cheek biting</label>
<?
if($den_his->lip_cheek_bitting == 'yes')
{?>
<label class="radio-inline"><input checked="checked" type="radio" name="lip_cheek" id="lip_cheek_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="lip_cheek" id="lip_cheek_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="lip_cheek" onclick="return false" id="lip_cheek_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="lip_cheek" id="lip_cheek_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>




<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Loose teeth or broken fillings</label>
<?
if($den_his->loose_teeth== 'yes')
{?>
<label class="radio-inline"><input checked="checked" type="radio" name="lose" id="lose_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="lose" id="lose_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="lose" onclick="return false" id="lose_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="lose" id="lose_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>


<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Mouth breathing</label>
<?
if($den_his->mouth_breathing== 'yes')
{?>
<label class="radio-inline"><input type="radio" checked="checked" name="mouth_breath" id="mouth_breath_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="mouth_breath" id="mouth_breath_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" onclick="return false" name="mouth_breath" id="mouth_breath_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="mouth_breath" id="mouth_breath_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>

<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Mouth pain, brushing</label>
<?
if($den_his->mouth_pain == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="mouth_pain" checked="checked" id="mouth_pain_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="mouth_pain" id="mouth_pain_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" onclick="return false" name="mouth_pain" id="mouth_pain_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="mouth_pain" id="mouth_pain_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>



<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Orthodontic treatment</label>
<?
if($den_his->orthodontic_treatment == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="ortho" checked="checked" id="ortho_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="ortho" id="ortho_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="ortho" onclick="return false" id="ortho_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="ortho" id="ortho_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>



<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Pain around ear</label>
<?
if($den_his->pain_around_ears== 'yes')
{?>
<label class="radio-inline"><input type="radio" checked="checked" name="pain_ear" id="pain_ear_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="pain_ear" id="pain_ear_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="pain_ear" onclick="return false" id="pain_ear_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="pain_ear" id="pain_ear_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>
			


<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Perio treatment</label>
<?
if($den_his->perio_treatment== 'yes')
{?>
<label class="radio-inline"><input type="radio" checked="checked" name="perio" id="perio_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="perio" id="perio_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" onclick="return false" name="perio" id="perio_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="perio" id="perio_no" value="no" checked="checked"> No </label>

<?}?>
</div>
</div>
<br>


<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Sensitivity to cold</label>
<?
if($den_his->sensitivity_cold== 'yes')
{?>
<label class="radio-inline"><input type="radio" checked="checked" name="cold" id="cold_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="cold" id="cold_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="cold" onclick="return false" id="cold_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="cold" id="cold_no" value="no" checked="checked"> No </label>

<?}?>
</div>
</div>
<br>



<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Sensitivity to heat</label>
<?
if($den_his->sensitivity_heat== 'yes')
{?>
<label class="radio-inline"><input type="radio" checked="checked" name="heat" id="heat_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="heat" id="heat_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" onclick="return false" name="heat" id="heat_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="heat" id="heat_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>



<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Sensitivity to sweets</label>
<?
if($den_his->sensitivity_sweet== 'yes')
{?>
<label class="radio-inline"><input type="radio" checked="checked" name="sweets" id="sweets_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="sweets" id="sweets_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" onclick="return false" name="sweets" id="sweets_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="sweets" id="sweets_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>



<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Sensitivity when biting</label>
<?
if($den_his->sensitivity_bite== 'yes')
{?>
<label class="radio-inline"><input type="radio"  checked="checked" name="biting" id="biting_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="biting" id="biting_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input onclick="return false" type="radio" name="biting" id="biting_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="biting" id="biting_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>




<div class="form-group"
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Sores or growths in your mouth</label>
<?
if($den_his->sores_growth== 'yes')
{?>
<label class="radio-inline"><input type="radio" name="sores" checked="checked" id="sores_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="sores" id="sores_no" value="no" onclick="return false"> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="sores" onclick="return false" id="sores_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="sores" id="sores_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
</div>	<br>

<br><br><br>
<div class="form-group" style="width:0px !important">
<label for="brush_frequency" class="col-sm-7 control-label" style="width:200px;float:left">How often do you brush?</label>
<div class="col-sm-5" >
<input type="text" name="brush_frequency" id="brush_frequency" class="form-control input-sm" placeholder="Daily, twice a day" style="margin-right:300px"  readonly
value="<?echo  $den_his->brush_time ?>" >
</div>
</div>
<br>


<div class="form-group">
<label for="anything_else_dental" class="col-sm-7 control-label"  style="width:200px;float:left">Is there anything else we should know?</label>
<div class="col-sm-5">
<textarea rows="3" class="form-control input-sm" name="anything_else_dental" id="anything_else_dental" autocomplete="off" style="margin-right:300px" readonly><?echo  $den_his->other ?></textarea>
</div>
</div>
<?}?>
<input type='hidden' name='base_url' id='base_url' value="<?= base_url()  ?>">








											
</div>
</div>
</div>
</body>
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function readURLForInsureOne(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#insureoneimg').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function readURLForInsureTwo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#insuretwoimg').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){readURL(this);});
    $("#insureonebrowse").change(function(){readURLForInsureOne(this);});
    $("#insuretwobrowse").change(function(){readURLForInsureTwo(this);});
</script>
</html>

