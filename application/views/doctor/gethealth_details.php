<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 30, 2014                 =
// Filename: ddb_messages_view.php             =
// Copyright of Fluent Technologies            =
// Displays mails for a doctor                 =
//==============================================
?>
<div class="row-fluid patient_history" id='health_details'>
<input type='hidden' name='med_history_rec' id='med_history_rec' 
value="<?= $med_history_rec; ?>">
<input type='hidden' name='health_iss' id='health_iss' value=
"<?echo $health_iss ?>">
<?

if($query_health->accept != 'accept' && $med_history_rec == $upd_num)
{?>
<div>
<h1>
<img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" onclick="edithealth_details(<?echo $recnum?>)">
</h1>
</div>
<?}?>
<br>
<br>
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

<h1>Your medical condition  </h1>

<p>Have you had currently have any of the following conditions? Check the ones that are applicable<br>
<div style="margin-bottom:10px;" class="m-widget" >
<form class="form-horizontal2 sigPad1">
<div class="control-group">
<label class="control-label">
<table border=0>
<?
$prev_group='';$i=0;$j=0;
foreach($master_meta as $m)
{
        if($prev_group == '' || $prev_group != $m->group)
	{?>
           <tr><td><strong><?= $m->group ?></strong></p></td></tr>
        <?$j=0;}
        if($j%2 == 0 )
	{
	  echo "</tr><tr>";
	}
$m_cond=str_replace(' ', '', $m->medical_condition);
	if($m->condition_status == 'yes')
	{?>
	<td><div class="control-group">
	<label class="control-label" style="margin-left:20px !important">
	<input type="checkbox" id="<?= $m_cond ?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>" checked >&nbsp;&nbsp;<?= $m->medical_condition ?>
	</label>
	</div></td>
	<?
	}
	else
	{?>
	<td><div class="control-group">
	<label class="control-label" style="margin-left:20px !important">
	<input type="checkbox" id="<?= $m_cond ?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>">&nbsp;&nbsp;<?= $m->medical_condition ?>
	</label>
	</div></td>
	<?}?>

<input type='hidden'  style="width:100px !important" name="group<?= $i?>" 
value="<?= $m->group ?>" id="group<?= $i?>">
<input type='hidden'  style="width:100px !important" name="dispseq_<?= $i?>" 
value="<?= $i ?>" id="dispseq_<?= $i?>">
<?
        $prev_group=$m->group;
        $i++;$j++;
}?>
</table>
<input type='hidden' name='base_url' id='base_url' value="<?= base_url()  ?>">
<input type='hidden' name='index' id='index' value="<?= $i ?>">
<!--
<strong>HEART CONDITION</strong>
</p>

<div style="margin-bottom:10px;" class="m-widget" >

<form class="form-horizontal2 sigPad1">

<div class="control-group">
<label class="control-label">
<?
if($query_health->high_bp    == 'yes')
{?>
<input type="checkbox" data-attr="high_bp" name="high_bp" id='high_bp' value="yes" checked onclick="return false">
High Blood Pressure
<?}
else
{?>
<input type="checkbox" data-attr="high_bp" name="high_bp" id='high_bp' value="yes" onclick="return false">
High Blood Pressure
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->low_bp     == 'yes')
{?>
<input type="checkbox" data-attr="low_bp" name="low_bp" value="yes" id="low_bp" checked onclick="return false">
Low Blood Pressure
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
Angina Chest Pain
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
Fainting
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
Irregular Heartbeat
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
Heart Attack
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
Heart Bypass
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
Pacemaker
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
Anemla
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
Hepatitis A
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
Hepatitis B
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
Hepatitis C
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
HIV-
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
AIDS
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
Sexually Transmitted Disease
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
Delay in Healing
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
pancreas diabetes
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
Kidney / Dialysis
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
Eyes / Glaucoma
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
Thyroid
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
Neurology Epilepsy
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
Cancer Location
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
Surgery 
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
Radiation
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
Chemotherapy
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
Clicking / Pain in jaw joints when eating
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
Arthritis
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
Arthritis Knee Replacement
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
Arthritis Hip Replacement
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
Swollen Ankles
<?}
else
{?>
<input type="checkbox" data-attr="swollen_ankles" name="swollen_ankles" id='swollen_ankles '  value="no" onclick="return false">
Swollen Ankles
<?}?>
</label>

</div>
-->

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
</div>
</div>	


</form>
</div>
