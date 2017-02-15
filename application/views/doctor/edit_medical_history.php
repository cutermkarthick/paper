<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 30, 2014                 =
// Filename: edit_medical_history.php          =
// Copyright of Fluent Technologies            =
// Editing medical history for a patient       =
//==============================================
?>
<!doctype html>
<html>
<head>
<title>Paperless Dentists</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/style.css" />
<link rel="stylesheet" type="text/css" href="css/meda.css" />
<link rel="stylesheet"
 href="<?echo base_url()?>signature-pad/build/jquery.signaturepad.css">
<script src="<?echo base_url()?>signature-pad/build/flashcanvas.js"></script>
<script src="<?echo base_url()?>signature-pad/build/json2.min.js"></script>
<script src="<?echo base_url()?>signature-pad/jquery.signaturepad.js"></script>
<script src="<?echo base_url()?>signature-pad/build/jquery.signaturepad.min.js"></script>
<script type='text/javascript'>
$(document).ready(function () 
{
      $('.sigPad4doc').signaturePad({drawOnly : true});
});
</script>
<?
$attr=array('class' => 'form-horizontal2 sigPad4doc','id'=>'form-horizontal90','name'=>'form-horizontal90');
echo form_open_multipart('doctor_ctrl/alter_medical_history',$attr);
?>
<div class="alert alert-danger alert-dismissable hide dental_notification"></div>
<div class='span9' style="width:1000px !important">
<div class="m-widget dashbord_box">

<br>
<div class='container-fluid'>
<div class="span12" style="border:0px;width:90% !important;margin-left:100px !important">

<div class="row row-centered topbuffer">
<div id="tabDentalInfo-top-column">


<span class="alert-block" id="error-summary-top-dental"></span>

<div class="row-fluid patient_history">
<h1>Your Weight and height </h1>
<div class="clearfix">  </div>
<div style="margin-bottom:10px;" class="m-widget">

<form name="formConsent" id="formConsent" class="form-horizontal2 sigPad4doc" action="<?echo base_url()?>doctor_ctrl/" method="post" novalidate="novalidate">

<div class="control-group">
<label class="control-label" for="inputEmail">Height (in inches)</label>
<div class="controls">
<input type="text" placeholder="00" 
 name='height_inches' id='height_inches' value='<?= $query_health->height_inches?>'>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Weight (in pounds)</label>
<div class="controls">
<input type="text" placeholder="00" name='weight_lbs' id='weight_lbs'  value='<?= $query_health->weight_lbs?>'>
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
<input type="radio" data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="no" id="goodhealth_1" >
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="yes" id="are_you_in_good_health" >
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
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="no" id="under_physician_care" >
No</label>	
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="yes" id="under_physician_care" >
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

<input class="input-large" type="text" placeholder="Pnone No"  name='physician_phone' id='physician_phone'  value='<?=$query_health->physician_phone   ?>'>
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
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='no' >
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='yes' >
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
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="no" id="alcoholic_consumption" >
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" >
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
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="no" id="recreation_drug_usage" >
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="yes" id="recreation_drug_usage" >
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
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="no" id="alcohol_abuse" >
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="yes" id="alcohol_abuse" >
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
<input type="radio" data-attr="smoke" name="smoke" value="no" id="smoke" >
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="smoke" name="smoke" value="yes" id="smoke" >
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
<input type="radio" data-attr="tobacco" name="tobacco" value="no" id="tobacco" >
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="tobacco" name="tobacco" value="yes" id="tobacco" >
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

<h1>Your medical condition </h1>

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
<input type="checkbox" data-attr="high_bp" name="high_bp" id='high_bp' value="yes" checked >
High Blood Pressure
<?}
else
{?>
<input type="checkbox" data-attr="high_bp" name="high_bp" id='high_bp' value="yes" >
High Blood Pressure
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->low_bp     == 'yes')
{?>
<input type="checkbox" data-attr="low_bp" name="low_bp" value="yes" id="low_bp" checked >
Low Blood Pressure
<?}
else
{?>
<input type="checkbox" data-attr="low_bp" name="low_bp " value="no" id="low_bp" >
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
<input type="checkbox" data-attr="angina_chest_pain" name="angina_chest_pain" value="yes" checked >
Angina Chest Pain
<?}
else
{?>
<input type="checkbox" data-attr="angina_chest_pain" name="angina_chest_pain " value="no"  >
Angina Chest Pain
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->fainiting  == 'yes')
{?>
<input type="checkbox" data-attr="fainiting" name="fainiting " value="yes" id='fainiting '  checked >
Fainting
<?}
else
{?>
<input type="checkbox" data-attr="fainiting" name="fainiting " value="no" id='fainiting '  >
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
<input type="checkbox" data-attr="irregular_heartbeat" name="irregular_heartbeat" value="yes" id='irregular_heartbeat ' checked >
Irregular Heartbeat
<?}
else
{?>
<input type="checkbox" data-attr="irregular_heartbeat" name="irregular_heartbeat " value="no" id='irregular_heartbeat ' >
Irregular Heartbeat
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->heart_attack    == 'yes')
{?>
<input type="checkbox" data-attr="heart_attack" name="heart_attack" id='heart_attack'  value="yes" checked >
Heart Attack
<?}
else
{?>
<input type="checkbox" data-attr="heart_attack" name="heart_attack" id='heart_attack'  value="no" >
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
<input type="checkbox" data-attr="heart_bypass" name="heart_bypass" id='heart_bypass' value="yes" checked >
Heart Bypass
<?}
else
{?>
<input type="checkbox" data-attr="heart_bypass" name="heart_bypass" id='heart_bypass' value="no" >
Heart Bypass
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->pacemaker    == 'yes')
{?>
<input type="checkbox" data-attr="pacemaker" name="pacemaker" id='pacemaker' value="yes" checked >
Pacemaker
<?}
else
{?>
<input type="checkbox" data-attr="pacemaker" name="pacemaker" id='pacemaker' value="no"   >
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
<input type="checkbox" data-attr="anemia" name="anemia " value="yes" id='anemia'  checked >
Anemla
<?}
else
{?>
<input type="checkbox" data-attr="anemia" name="anemia " value="no" id='anemia'  >
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
<input type="checkbox" data-attr="hepatitis_a" name="hepatitis_a" value="yes" id="hepatitis_a" checked >
Hepatitis A
<?}
else
{?>
<input type="checkbox" data-attr="hepatitis_a" name="hepatitis_a" value="no" id="hepatitis_a" >
Hepatitis A
<?}?>
</label>


<label class="radio inline">
<?
if($query_health->hepatitis_b  == 'yes')
{?>
<input type="checkbox" data-attr="hepatitis_b" name="hepatitis_b" value="yes" id="hepatitis_b " checked >
Hepatitis B
<?}
else
{?>
<input type="checkbox" data-attr="hepatitis_b" name="hepatitis_b" value="no" id="hepatitis_b "  >
Hepatitis B
<?}?>
</label>

<label class="radio inline">
<?
if($query_health->hepatitis_c   == 'yes')
{?>
<input type="checkbox" data-attr="hepatitis_c" name="hepatitis_c" value="yes" id="hepatitis_c" checked >
Hepatitis C
<?}
else
{?>
<input type="checkbox" data-attr="hepatitis_c" name="hepatitis_c" value="no" id="hepatitis_c"  >
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
<input type="checkbox" name="hiv" data-attr="hiv" id='hiv'  value="yes" checked >
HIV-
<?}
else
{?>
<input type="checkbox" name="hiv" data-attr="hiv" id='hiv'  value="no" >
HIV-
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->aids == 'yes')
{?>
<input type="checkbox" name="aids"  data-attr="aids" id='aids' value="yes" checked >
AIDS
<?}
else
{?>
<input type="checkbox" name="aids"  data-attr="aids" id='aids' value="no" >
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
<input type="checkbox" name="std" data-attr="std" value="yes" id='std' checked >
Sexually Transmitted Disease
<?}
else
{?>
<input type="checkbox" name="std" data-attr="std" value="no" id='std' >
Sexually Transmitted Disease
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->delay_in_healing == 'yes')
{?>
<input type="checkbox" data-attr="delay_in_healing" name="delay_in_healing" value="yes"  id='delay_in_healing' checked >
Delay in Healing
<?}
else
{?>
<input type="checkbox" data-attr="delay_in_healing" name="delay_in_healing" value="no"  id='delay_in_healing' >
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
<input type="checkbox" data-attr="pancreas_diabetes" name="pancreas_diabetes" value="yes"  id='pancreas_diabetes' checked >
pancreas diabetes
<?}
else
{?>
<input type="checkbox" data-attr="pancreas_diabetes" name="pancreas_diabetes" value="no"  id='pancreas_diabetes' >
pancreas diabetes
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->kidney_dialysis == 'yes')
{?>
<input type="checkbox" data-attr="kidney_dialysis" name="kidney_dialysis" value="yes"  id='kidney_dialysis' checked >
Kidney / Dialysis
<?}
else
{?>
<input type="checkbox" data-attr="kidney_dialysis" name="kidney_dialysis" value="no"  id='kidney_dialysis' >
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
<input type="checkbox" data-attr="eyes_glaucoma" name="eyes_glaucoma" value="yes" checked id='eyes_glaucoma' >
Eyes / Glaucoma
<?}
else
{?>
<input type="checkbox" data-attr="eyes_glaucoma" name="eyes_glaucoma" value="no"  id='eyes_glaucoma' >
Eyes / Glaucoma
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->thyroid == 'yes')
{?>
<input type="checkbox" data-attr="thyroid" name="thyroid" value="yes" id='thyroid' checked >
Thyroid
<?}
else
{?>
<input type="checkbox" data-attr="thyroid" name="thyroid" value="no" id='thyroid'  >
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
<input type="checkbox" data-attr="neurology_epilepsy" name="neurology_epilepsy" id='neurology_epilepsy' value="yes" checked >
Neurology Epilepsy
<?}
else
{?>
<input type="checkbox" data-attr="neurology_epilepsy" name="neurology_epilepsy" id='neurology_epilepsy' value="no" >
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
<input type="checkbox" data-attr="cancer_location" name="cancer_location" id='cancer_location' value="yes" checked >
Cancer Location
<?}
else
{?>
<input type="checkbox" data-attr="cancer_location" name="cancer_location" id='cancer_location' value="no" >
Cancer Location
<?}?>
</label>


<div class="controls">
<div class='radio inline'>
<input class="input-large" type="text" placeholder="Location" value='<?= $query_health->cancer_location_name ?>' >
</div>
</div>
</div>
<div class="control-group">
<label class="control-label">
<?
if($query_health->surgery == 'yes')
{?>
<input type="checkbox" data-attr="surgery" name="surgery" id='surgery'  value="yes" checked >
Surgery 
<?}
else
{?>
<input type="checkbox" data-attr="surgery" name="surgery" id='surgery'  value="no" >
Surgery 
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->radiation  == 'yes')
{?>
<input type="checkbox" data-attr="radiation" name="radiation" value="yes" id='radiation' checked >
Radiation
<?}
else
{?>
<input type="checkbox" data-attr="radiation" name="radiation" value="no" id='radiation' >
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
<input type="checkbox" data-attr="chemotherapy" name="chemotherapy" value="yes" checked id='chemotherapy' >
Chemotherapy
<?}
else
{?>
<input type="checkbox" data-attr="chemotherapy" name="chemotherapy" value="no"  id='chemotherapy' >
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
<input type="checkbox" data-attr="jaw_joints_pain" name="jaw_joints_pain" value="yes"  id='jaw_joints_pain' checked >
Clicking / Pain in jaw joints when eating
<?}
else
{?>	 
<input type="checkbox" data-attr="jaw_joints_pain" name="jaw_joints_pain" value="no"  id='jaw_joints_pain' >
Clicking / Pain in jaw joints when eating
<?}?>
</label>
<div class="controls">
<label class="radio inline">
<?
if($query_health->arthritis  == 'yes')
{?>
<input type="checkbox" data-attr="arthritis" name="arthritis" id='arthritis'  value="yes" checked >
Arthritis
<?}
else
{?>
<input type="checkbox" data-attr="arthritis" name="arthritis" id='arthritis'  value="no" >
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
<input type="checkbox" data-attr="arthritis_knee_replacement" name="arthritis_knee_replacement" value="yes" checked >
Arthritis Knee Replacement
<?}
else
{?>
<input type="checkbox" data-attr="arthritis_knee_replacement" name="arthritis_knee_replacement" value="no" >
Arthritis Knee Replacement
<?}?>
</label>
<div class="controls">
<label class="radio inline">
<?
if($query_health->arthritis_hip_replacement  == 'yes')
{?>
<input type="checkbox" data-attr="arthritis_hip_replacement" name="arthritis_hip_replacement" value="yes" checked id='arthritis_hip_replacement' >
Arthritis Hip Replacement
<?}
else
{?>
<input type="checkbox" data-attr="arthritis_hip_replacement" name="arthritis_hip_replacement" value="no"  id='arthritis_hip_replacement' >
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
<input type="checkbox" data-attr="swollen_ankles" name="swollen_ankles" id='swollen_ankles'  value="yes" checked >
Swollen Ankles
<?}
else
{?>
<input type="checkbox" data-attr="swollen_ankles" name="swollen_ankles" id='swollen_ankles '  value="no" >
Swollen Ankles
<?}?>
</label>

</div>

<div class="control-group">
<label class="control-label">

Other
</label>

<input type="text" id="recnum" name="recnum" value="<?=$recnum;?>" >
<div class="controls">
<div class='radio inline'>
<input class="input-large" type="text" placeholder="..."  id='other' name='other'  data-attr="other" value='<?= $query_health->other ?>' >
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


