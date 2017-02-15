<?
//==============================================
// Author: FSI                                 =
// Date-written = Feb 05, 2015                 =
// Filename: dental_historydetails.php         =
// Copyright of Fluent Technologies            =
// Displays dental History of a patient        =
//==============================================
?>
<div class="row-fluid patient_history" id='dental_historydetails'>
<?
$formal_dentist_style=' margin-right:280px;"background-color:#DFDFDF;" readonly ;';

if($den_his->accept != 'accept' &&  $dental_history_rec == $recnum)
{?>
<div><h1>
<img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" 
 onclick="editdentalhis_details(<?echo $recnum?>)">
</h1></div>
<?}?>
<br>
<br>

<input type='hidden' name='dental_history_rec' id='dental_history_rec' 
value="<?= $dental_history_rec  ?>">

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
<textarea rows="3" style="margin-right:250px" class="form-control input-sm" id="reason_text" name="reason_text" autocomplete="off" readonly placeholder="Reason for today&#39;s visit"><?= $den_his->reason_today_visit ?></textarea>
</div>
</div>
<br>

<div class="form-group">
<label for="fomer_dentist_name" class="col-sm-7 control-label" style="width:200px;float:left">Former Dentist</label>
<div class="col-sm-5" >
<?php 
echo form_input(array('id' => 'former_dentist_name', 'name' => 'former_dentist_name','placeholder' => 'Last Name',
'style'=>"$formal_dentist_style",'value'=>$den_his->formal_dentist)); 
?>
</div>
</div>
<br>
<?
$dddob=explode('-', $den_his->last_dental_visit );
$last_exam=$dddob[1].'-'.$dddob[2].'-'.$dddob[0];
$dddob1=explode('-', $den_his->last_dental_xray);
$last_xray=$dddob1[1].'-'.$dddob1[2].'-'.$dddob1[0];
?>
<input type='hidden' name='health_iss' id='health_iss' value=
"<?= $health_iss ?>">
<div class="form-group">
<label for="last_dental_date" class="col-sm-7 control-label" style="width:200px;float:left">Date of last dental exam</label>
<div class="col-sm-5" id="last-dental-date-container">

<div class="input-append date" id="dp4" data-date="<?= date('Y-m-d') ?>"  data-date-format="yyyy-mm-dd" style="margin-right:250px">
	<?php
	$data = array(
		'class' => 'input-large',
		'type' => "text",
		'name' => "last_dental_date",
		'id'  => "last_dental_date",
		'size' => '16',	
		'readonly'=>'readonly',
                'value'=>  "$last_exam",
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
	<div class="input-append date" id="dp5" data-date="<?= date('Y-m-d') ?>"  data-date-format="yyyy-mm-dd" style="margin-right:250px">
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
<label class="radio-inline"><input type="radio" name="bad_breadth" id="bad_breadth_yes" value="yes" checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="bad_breadth" id="bad_breadth_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="bad_breadth" id="bad_breadth_yes" value="yes" disabled> Yes</label> <label class="radio-inline"><input type="radio" name="bad_breadth" id="bad_breadth_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>

<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Bleeding gums</label>
<?
if($den_his->bleeding_gums == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="bleeding_gums" id="bleeding_gums_yes" value="yes"  checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="bleeding_gums" id="bleeding_gumss_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="bleeding_gums" id="bleeding_gums_yes" value="yes" disabled> Yes</label> <label class="radio-inline"><input type="radio" name="bleeding_gums" id="bleeding_gumss_no" value="no"   checked="checked"> No </label>
<?}?>
</div>
</div>

<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Blisters on lips or mouth</label>
<?
if($den_his->blisters_teeth == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="blisters" id="blisters_yes" value="yes" checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="blisters" id="blisters_no" value="no"  disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="blisters" id="blisters_yes" value="yes" disabled> Yes</label> <label class="radio-inline"><input type="radio" name="blisters" id="blisters_no" value="no" checked="checked"> No </label>
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
<label class="radio-inline"><input type="radio" name="burning" id="burning_yes" value="yes" checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="burning" id="burninge_no" value="no"  disabled> No </label>
</div>
<?}
else
{?>
<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Burning sensation on tongue</label>
<label class="radio-inline"><input type="radio" name="burning" id="burning_yes" value="yes" disabled> Yes</label> <label class="radio-inline"><input type="radio" name="burning" id="burninge_no" value="no" checked="checked"> No </label>
</div>
<?}?>

</div>
<br>

<div class="form-group">
<div class="col-sm-5">
<?
if($den_his->chew_one_side == 'yes')
{?>
<label class="col-sm-7 control-label" style="width:200px"> Chew on one side of mouth</label>
<label class="radio-inline"><input type="radio" name="chew_side" id="chew_side_yes" value="yes"
checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="chew_side" id="chew_side_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="col-sm-7 control-label" style="width:200px"> Chew on one side of mouth</label>
<label class="radio-inline"><input type="radio" name="chew_side" id="chew_side_yes" value="yes"
disabled> Yes</label> <label class="radio-inline"><input type="radio" name="chew_side" id="chew_side_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>

<div class="form-group">
<div class="col-sm-5">
<?
if($den_his->chew_one_side == 'yes')
{?>
<label class="col-sm-7 control-label" style="width:200px">Clicking or popping jaw</label>
<label class="radio-inline"><input type="radio" name="click_pop" id="click_pop_yes" checked="checked" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="click_pop" id="click_pop_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="col-sm-7 control-label" style="width:200px">Clicking or popping jaw</label>
<label class="radio-inline"><input type="radio" name="click_pop" id="click_pop_yes" disabled value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="click_pop" id="click_pop_no" value="no" checked="checked" > No </label>
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
<label class="radio-inline"><input type="radio" checked="checked" name="dry_mouth" id="dry_mouth_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="dry_mouth" id="dry_mouth_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" disabled name="dry_mouth" id="dry_mouth_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="dry_mouth" id="dry_mouth_no" value="no" checked="checked" > No </label>
<?}?>
</div>
</div>


<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label"  style="width:200px">Fingernail biting</label>
<?
if($den_his->fingar_bitting == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="finger_bite" id="finger_bite_yes" value="yes" checked="checked"> Yes</label> <label class="radio-inline"><input type="radio" name="finger_bite" id="finger_bite_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="finger_bite" id="finger_bite_yes" value="yes" disabled> Yes</label> <label class="radio-inline"><input type="radio" name="finger_bite" id="finger_bite_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>


<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Foreign object</label>
<?
if($den_his->foreign_object == 'yes')
{?>
<label class="radio-inline"><input type="radio" checked="checked" name="foreign" id="foreign_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="foreign" id="foreign_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="foreign" disabled id="foreign_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="foreign" id="foreign_no" value="no" checked="checked"> No </label>
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
<label class="radio-inline"><input type="radio" name="grind" checked="checked" id="grind_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="grind" id="grind_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="grind" id="grind_yes" value="yes" disabled> Yes</label> <label class="radio-inline"><input type="radio" name="grind" id="grind_no" value="no" checked="checked"> No </label>
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
<label class="radio-inline"><input checked="checked" type="radio" name="gums" id="gums_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="gums" id="gums_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="gums" id="gums_yes" disabled value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="gums" id="gums_no" value="no" checked="checked"> No </label>
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
<label class="radio-inline"><input type="radio" name="jaw_pain" checked="checked" id="jaw_pain_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="jaw_pain" id="jaw_pain_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="jaw_pain" id="jaw_pain_yes" disabled value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="jaw_pain" id="jaw_pain_no" value="no" checked="checked"> No </label>
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
<label class="radio-inline"><input checked="checked" type="radio" name="lip_cheek" id="lip_cheek_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="lip_cheek" id="lip_cheek_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="lip_cheek" disabled id="lip_cheek_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="lip_cheek" id="lip_cheek_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>





<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Loose teeth or broken fillings</label>
<?
if($den_his->loose_teeth== 'yes')
{?>
<label class="radio-inline"><input checked="checked" type="radio" name="lose" id="lose_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="lose" id="lose_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="lose" disabled id="lose_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="lose" id="lose_no" value="no" checked="checked"> No </label>
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
<label class="radio-inline"><input type="radio" checked="checked" name="mouth_breath" id="mouth_breath_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="mouth_breath" id="mouth_breath_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" disabled name="mouth_breath" id="mouth_breath_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="mouth_breath" id="mouth_breath_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>




<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Mouth pain, brushing</label>
<?
if($den_his->mouth_pain == 'yes')
{?>
<label class="radio-inline"><input type="radio" name="mouth_pain" checked="checked" id="mouth_pain_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="mouth_pain" id="mouth_pain_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" disabled name="mouth_pain" id="mouth_pain_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="mouth_pain" id="mouth_pain_no" value="no" checked="checked"> No </label>
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
<label class="radio-inline"><input type="radio" name="ortho" checked="checked" id="ortho_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="ortho" id="ortho_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="ortho" disabled id="ortho_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="ortho" id="ortho_no" value="no" checked="checked"> No </label>
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
<label class="radio-inline"><input type="radio" checked="checked" name="pain_ear" id="pain_ear_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="pain_ear" id="pain_ear_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="pain_ear" disabled id="pain_ear_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="pain_ear" id="pain_ear_no" value="no" checked="checked"> No </label>
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
<label class="radio-inline"><input type="radio" checked="checked" name="perio" id="perio_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="perio" id="perio_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" disabled name="perio" id="perio_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="perio" id="perio_no" value="no" checked="checked"> No </label>

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
<label class="radio-inline"><input type="radio" checked="checked" name="cold" id="cold_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="cold" id="cold_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="cold" disabled id="cold_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="cold" id="cold_no" value="no" checked="checked"> No </label>

<?}?>
</div>
</div>




<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Sensitivity to heat</label>
<?
if($den_his->sensitivity_heat== 'yes')
{?>
<label class="radio-inline"><input type="radio" checked="checked" name="heat" id="heat_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="heat" id="heat_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" disabled name="heat" id="heat_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="heat" id="heat_no" value="no" checked="checked"> No </label>
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
<label class="radio-inline"><input type="radio" checked="checked" name="sweets" id="sweets_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="sweets" id="sweets_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" disabled name="sweets" id="sweets_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="sweets" id="sweets_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>




<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Sensitivity when biting</label>
<?
if($den_his->sensitivity_bite== 'yes')
{?>
<label class="radio-inline"><input type="radio"  checked="checked" name="biting" id="biting_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="biting" id="biting_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input disabled type="radio" name="biting" id="biting_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="biting" id="biting_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>
<br>




<div class="form-group">
<div class="col-sm-5">
<label class="col-sm-7 control-label" style="width:200px">Sores or growths in your mouth</label>
<?
if($den_his->sores_growth== 'yes')
{?>
<label class="radio-inline"><input type="radio" name="sores" checked="checked" id="sores_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="sores" id="sores_no" value="no" disabled> No </label>
<?}
else
{?>
<label class="radio-inline"><input type="radio" name="sores" disabled id="sores_yes" value="yes"> Yes</label> <label class="radio-inline"><input type="radio" name="sores" id="sores_no" value="no" checked="checked"> No </label>
<?}?>
</div>
</div>



</div>	

<br><br><br>
<div class="form-group">
<div class="col-sm-5">
<label for="brush_frequency" class="col-sm-7 control-label" style="width:200px;text-align:right">How often do you brush?</label>
<input type="text" name="brush_frequency" id="brush_frequency" class="form-control input-sm" placeholder="Daily, twice a day" style="margin-right:250px"  readonly
value="<?echo  $den_his->brush_time ?>" >
</div>
</div>
<br>


<div class="form-group">
<div class="col-sm-5">
<label for="anything_else_dental" class="col-sm-7 control-label"  style="width:200px;text-align:right;">Is there anything else we should know?</label>
<textarea rows="3" class="form-control input-sm" name="anything_else_dental" id="anything_else_dental" autocomplete="off" style="margin-right:250px" readonly><?echo  $den_his->other ?></textarea>
</div>
</div>

</div>
