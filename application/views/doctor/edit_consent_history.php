<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 15, 2015                 =
// Filename: edit_consent_history.php          =
// Copyright of Fluent Technologies            =
// edit consent details for a patient          =
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
<script src="<?echo base_url()?>signature-pad/build/jquery.signaturepad.min.js">
</script>
<script>
$(document).ready(function() 
{
	
/*
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

alert("<?= count($signature) ?>");
*/
<?
if(count($signature )> 0)
{
	?>
      var sig = '<?php echo $treatment_to_be->signature ?>';
      $('.sigPad4treat').signaturePad({displayOnly : true}).regenerate(sig);
	 /* $('.signdentist').signaturePad({displayOnly : true}).regenerate(sig);
	  $('.signwitness').signaturePad({displayOnly : true}).regenerate(sig);*/
    document.forms['form-horizontal120'].output4treatment.value='';
<?}
else
{?>
   $('.sigPad4treat').signaturePad({drawOnly : true});
   $('.signdentist').signaturePad({drawOnly : true});
   $('.signwitness').signaturePad({drawOnly : true});
<?}?>
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
</script>

<Style type="text/css">
.form-horizontal2 .control-label {
	padding-left: 4% !important ;
}
</style>
<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal100','name'=>'form-horizontal120');
echo form_open_multipart('doctor_ctrl/insert_consent',$attr);
?>

<input name="link2patient" id="link2patient" type="hidden" value="<? echo $link2patient ?>">
<input name="login" id="login" type="hidden" value="doctor">

<div class="row row-centered topbuffer">
<div>

<div class="alert alert-danger alert-dismissable hide error-summary-top-consent"></div>
<div class="span12" style="border:0px;width:90% !important;margin-left:60px">
<div class="panel-group" id="accordion">

<?
$i =0;
$signarr = array();
$typearr = array();
foreach($patient_consent as $c)
{
	$i = $i+ 1 ;
	$collapse = "collapse" .$i ;
	?>

	<div class="panel panel-primary sigPad4treat ">
	<div class="panel-heading text-center">
	<h3 class="panel-title">
	<a class="collapseOtherPanels collapsed" data-toggle="collapse" data-parent="#accordion" 
	onclick="getaccordian('<?php echo $collapse?>')"><?= $c->name ?></a>
	</h3>
	</div>
	<div id="<?php echo $collapse ;?>" class="panel-collapse collapse" style="height: 0px;">
	<div class="panel-body">
	<div class="row">
	<div class="col-sm-12">
	<p class="form-control-static text-left" style="Text-align:left !important"><?= $c->consent_text ?></p>

	<?php 
		if($c->recnum ==15  )
		{
			?>
	
	<p class="form-control-static text-left" style="Text-align:left !important">I understand that treatment risks can include, but are not limited to the following:</p>
	<ul class="form-control-static text-left" style="Text-align:left !important">
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
		<?php }?>

	<?php
	if($c->recnum == 18)
	{
	?>
	<ul class="form-control-static text-left" style="text-align:left">
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
	<?php 
	}
	?>
							
		
	</div>
	<div class="topslimbuffer">&nbsp;</div>
	</div>
	
	<?php
	if($c->tooth_num_flag =='yes')
	{ ?>
	<div class="row form-group">
	<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Tooth</label>
	<div class="col-sm-6"  style="display:block;clear:none">
	<input type="text" id="tooth" name="tooth<?=$i?>" value="" width="5%">	
	</div>
	</div>
	
	
	<?php	
	}	
	?>
	
	<?php
	if($c->tooth_shade_flag =='yes')
	{ ?>
	<div class="row form-group">
	<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Shade</label>
	<div class="col-sm-6"  style="display:block;clear:none">
	<input type="text" id="shade" name="shade<?=$i?>" value="" width="5%">	
	</div>
	</div>

	<?php	
	}	
	?>
	<input type="hidden" id="type" name="type<?=$i?>" value="<?php echo $c->name ;?>">
	
	
	
	<div class="row form-group">
	<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
	<div id="treatment_signature_div">
	 <div class="sig sigWrapper"  
	style="margin-left:200px;display:block;clear:none">
	    <div class="typed"></div>
	    <canvas class="pad" width="400" height="55"></canvas>
	    <input type="hidden" name="output4treatment<?=$i?>"  class="output" value=''>
	  </div>
	 </div>
	</div>

	<br>
	<div class="row form-group">
	<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
	<div class="col-sm-6"  style=" margin-left:5%;display:block;clear:none">
	<input type="text" class="form-control input-sm pull-right consent_patient_name" 
	style="margin-right:433px;margin-top:-25px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
	</div>
	</div>
	<div class="row row-centered topbottombuffer">
	<div class="col-xs-12 col-md-8  col-centered">
	<div class="row row-centered spaced">
	<div class="col col-centered">
	<div class="btn-toolbar">
	<a href="#clear" class="btn btn-success btn-lg clear_signature clearButton" id="btnClearTreatmentSignature" attached_input="treatment_signature_div" style="margin-left:100px" >Clear Signature</a>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div></div>
	
	
	</div>
<?}?>

<!--
<div class="row form-group">	
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper"  
style="margin-left:200px;display:block;clear:none">
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
<a class="btn btn-success btn-lg clear_signature clearButton" id="btnClearTreatmentSignature" attached_input="treatment_signature_div" style="margin-left:100px" href="#clear">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
-->




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

<div class="panel sigPad1 sigPad4treat">
<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Patient Signature</label>
<div id="user_signature_div" class="sigPad4treat">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output4patientsign"  id="output4patientsign" class="output">
  </div>
 </div>
</div>

<br>
<div class="row form-group">
<label for="consent_patient_name" class="col-sm-3 control-label" style="float:left;width:25%">Patient</label>
<div   style=" margin-left:5%;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:61%;margin-top:-25px" value="<? echo $query->fname?>&nbsp;&nbsp;<? echo $query->middle_initial?>&nbsp;&nbsp;<? echo $query->lname?>" autocomplete="off" placeholder="Patient" readonly="readonly">
</div>
</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a  href="#clear" class="btn btn-success btn-lg clear_signature clearButton" id="btnClearCancelSignature" attached_input="user_signature_div">Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="panel sigPad1 signdentist">
<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Dentist Signature</label>
<div id="dentist_signature_div" class="signdentist">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden"  id="output4dentistsign" name="output4dentistsign" class="output">
  </div>
 </div>
</div><br>
<div class="row form-group">
<label for="consent_doctor_name" class="col-sm-3 control-label" style="float:left;width:25%">Doctor</label>
<?
$doc  = $this->doctor_model->getdocname($this->session->userdata('doctor_id'));
$docid=$doc->recnum;
$docname=$doc->fullname;
?>
<div style="margin-left:5%;display:block;clear:none">
<input type="text" class="form-control input-sm pull-right consent_patient_name" 
style="margin-right:61%;margin-top:-25px" value="<? echo $docname ?>">
<input type="hidden" name="consent_doctor_name" id='consent_doctor_name' 
value="<?echo $docid?>">
</div>
</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a  href="#clear" class="btn btn-success btn-lg clear_signature clearButton" id="btnClearCancelSignature" attached_input="dentist_signature_div" >Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="panel  sigPad1 signwitness">
<div class="row form-group">
<label for="treatment_signature" class="col-sm-3 control-label" style="float:left;width:25%">Witness Signature</label>
<div id="witness_signature_div" class="signwitness">
    <div class="sig sigWrapper current"  style=" margin-left:200px;display:block;clear:none">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" id="output4witnesssign" name="output4witnesssign" class="output">
  </div>
 </div>
</div><br>
<div class="row form-group">
<label for="witness" class="col-sm-3 control-label" style="float:left;width:25%">Witness</label>
<div  style=" margin-left:200px;display:block;clear:none;float:left">
<input style="margin-right:420px;margin-top:-25px" type="text" class="form-control input-sm pull-right" id="witness" name="witness" value="" autocomplete="off" placeholder="Witness">
</div>
</div>
<div class="row row-centered topbottombuffer">
<div class="col-xs-12 col-md-8  col-centered">
<div class="row row-centered spaced">
<div class="col col-centered">
<div class="btn-toolbar">
<a href="#clear" class="btn btn-success btn-lg clear_signature clearButton" id="btnClearCancelSignature" attached_input="witness_signature_div" >Clear Signature</a>
</div>
</div>
</div>
</div>
</div>
</div>

<?
$patient_id =$this->session->userdata('patient_id');
$res = $this->patient_model->health_infoDetails($patient_id);


if(!empty($res))
{
foreach($res as $key =>$h)
{
	
   if($h == 'yes' && $key != 'under_physician_care')
   {
	$val=$key;
	break;
   }
   else
   {
	$val ='';   
   } 
}
}
else
{
$val ='';	
}	
?>
<input type='hidden' name='health_iss' id='health_iss' value=
"<?echo  $val ?>">
<input type='hidden' name='param' id='param' value=''>


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
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

