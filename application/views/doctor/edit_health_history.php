<script src="<?echo base_url()?>js/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/style.css" />

<link rel="stylesheet" href="<?echo base_url()?>signature-pad/build/jquery.signaturepad.css">
<script src="<?echo base_url()?>signature-pad/build/flashcanvas.js"></script>
<script src="<?echo base_url()?>signature-pad/build/json2.min.js"></script>
<script src="<?echo base_url()?>signature-pad/jquery.signaturepad.js"></script>
<script src="<?echo base_url()?>signature-pad/build/jquery.signaturepad.min.js">
</script>
<script type='text/javascript'>
$(document).ready(function() 
{
	
<?
if(count($query_health) >0)
{

	if($query_health->signature  != "")
	{?>
 var sig = '<?php echo $query_health->signature ?>';
$('.sigPad4health').signaturePad({displayOnly : true}).regenerate(sig);
document.forms['formhealth_history'].output.value='';
	<?}
	else
	{?>
	   $('.sigPad4health').signaturePad({drawOnly : true});
	<?}
}?>
});
</script>

<div class="row-fluid patient_history" id='health_details'>
<br>
<br>
<h1>Your Weight and height </h1>
<div class="clearfix">  </div>
<div style="margin-bottom:10px;" class="m-widget">


<?php
//added by udaya on July 8
if(!empty($health_history) || !empty($query_health))
{
	$height_inches = $query_health->height_inches;
	$weight_lbs    = $query_health->weight_lbs;
	$are_you_in_good_health  = $query_health->are_you_in_good_health ;
	$under_physician_care  = $query_health->under_physician_care ;
	$physician_phone       = $query_health->physician_phone  ;
	$illness_operation_hospitalized = $query_health->illness_operation_hospitalized  ;
	$alcoholic_consumption  = $query_health->alcoholic_consumption  ;
	$recreation_drug_usage  = $query_health->recreation_drug_usage  ;
	$alcohol_abuse          = $query_health->alcohol_abuse  ;
	$smoke                  = $query_health->smoke    ;
	$tobacco                = $query_health->tobacco  ;
	$other                  = $query_health->other    ; 
}
else
{
	$height_inches ='';
	$weight_lbs    = '';
	$are_you_in_good_health ='';
	$under_physician_care = '';
	$physician_phone  = '';
	$illness_operation_hospitalized = '';
	$alcoholic_consumption ='';
	$recreation_drug_usage ='';
	$alcohol_abuse ='';
	$smoke ='';
	$tobacco ='';
	$other ='';
}

?>

<form name="formhealth_history" id="formConsent"
  class="form-horizontal2 sigPad4health" action="<?echo base_url()?>doctor_ctrl/insert_healthhistory" method="post" novalidate="novalidate">
<div class="control-group">
<label class="control-label" for="inputEmail">Height (in inches)</label>
<div class="controls">
<input type="text" placeholder="00" 
 name='height_inches' id='height_inches' value='<?= $height_inches?>'>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Weight (in pounds)</label>
<div class="controls">
<input type="text" placeholder="00" name='weight_lbs' id='weight_lbs'   value='<?= $weight_lbs?>'>
</div>
</div>


<div class="clearfix">  </div> 

<h1>Your Health Status  </h1>

<div style="margin-bottom:10px;" class="m-widget">

<div class="control-group">
<label class="control-label" for="inputEmail"> Are you in good health</label>
<div class="controls">
<? 
if($are_you_in_good_health  == 'yes')
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
if($under_physician_care   == 'yes')
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

<?
if(!empty($health_history))
{
$p_m=$query_health->physician_phone;
$p_h=explode('-',$p_m);
}
else
{
$p_h = '';
$p_h[0] = '';
$p_h[1] = '';
$p_h[2] = '';

	
}
?>

<div class="control-group">
<label class="control-label" for="inputPassword">Physician's Telephone</label>
<div class="controls">		
<input name="physician_phone1" id="physician_phone1" type="" value="<?=$p_h[0]?>" 
style="width:30px;height:20px" 
onkeypress="javascript:number_validation4physician(this,1)">&nbsp;-
<input name="physician_phone2" id="physician_phone2" type="" value="<?=$p_h[1]?>"  style="margin-left:10px;width:30px;height:20px" 
onkeypress="javascript:number_validation4physician(this,2)"/>&nbsp;-<input name="physician_phone3" id="physician_phone3" type="" 
value="<?=$p_h[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4physician(this,3)"/>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword"> Have you had any serious illness, operation or been hospitalized ? </label>
<div class="controls">
<?
if($illness_operation_hospitalized  == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized"  id="illness_operation_hospitalized" value='yes' checked>
Yes
</label>	

<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" id="illness_operation_hospitalized" value='no' >
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized"  id="illness_operation_hospitalized" value='yes' >
Yes
</label>	

<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" id="illness_operation_hospitalized" value='no' checked>
No</label>
<?}?>


</div>
</div>



</div>               	
<div class="clearfix">  </div> 

<h1>Do you use alcohol, tobaco, drugs?  </h1>

<div style="margin-bottom:10px;" class="m-widget">

<div class="control-group">
<label class="control-label" for="inputEmail">Do you drinks alcholic beverages ? </label>
<div class="controls">
<?
if($alcoholic_consumption   == 'yes')
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
if($recreation_drug_usage    == 'yes')
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
if($alcohol_abuse   == 'yes')
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
if($smoke   == 'yes')
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
if($tobacco    == 'yes')
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



<input type='hidden' name='param' id='param' value=''>

<input type='hidden' name='med_history_rec' id='med_history_rec' 
value="<?= $med_history_rec ?>">
</div>
<div class="clearfix">  </div> 
<h1>Your medical condition </h1>
<p>Have you had currently have any of the following conditions? Check the ones that are applicable<br>
</p>

<div style="margin-bottom:10px;"  >

<div class="control-group">
<label class="control-label">

<table>
<?

if(!empty($master_meta))
{
$prev_group='';$i=0;$j=0;
foreach($master_meta as $m)
{
        if($prev_group == '' || $prev_group != $m->group)
	{?>
           <tr><td><strong><?= $m->group ?></strong></p><td></tr>
        <?$j=0;}
if($j%2 == 0 )
	{
	  echo "</tr><tr>";
	}
$m_cond=str_replace(' ', '', $m->medical_condition);
if($m->condition_status == 'yes')
{?>
<td>
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" id="<?= $m_cond ?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>" checked >&nbsp;&nbsp;<?= $m->medical_condition ?>
</label>
</td>
<?
}
else
{?>
<td>
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" id="<?= $m_cond ?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>"  >&nbsp;&nbsp;<?= $m->medical_condition ?>
</label>
</td>
<?}?>

<input type='hidden'  style="width:100px !important" name="group<?= $i?>" 
value="<?= $m->group ?>" id="group<?= $i?>">
<input type='hidden'  style="width:100px !important" name="name<?= $i?>" 
value="<?= $m->medical_condition ?>" id="name<?= $i?>" >
<input type='hidden'  style="width:100px !important" name="dispseq_<?= $i?>" 
value="<?= $i ?>" id="dispseq_<?= $i?>">
<input type ='hidden' name='recnum<?= $i?>' id='recnum<?= $i?>' value="<?=$m->recnum ?>">
<?
        $prev_group=$m->group;
        $upd_num=$m->upd_num;
        $i++;$j++;
}?>

</table>

<input type='hidden' name='health_iss' id='health_iss' value=
"<?echo $health_iss ?>">
<input type='hidden'  style="width:100px !important" name="upd_num" 
value="<?= $upd_num ?>" id="upd_num">
<input type='hidden' name='base_url' id='base_url' value="<?= base_url()  ?>">
<input type ='hidden' name='index' id='index' value="<?= $i?>">

<input type='hidden' name='med_history_rec' id='med_history_rec' 
value="<?= $med_history_rec; ?>">

<?php }
else
{
	
$prev_group='';$i=0;$j=0;
foreach($master_meta1 as $m)
{
	if($prev_group == '' || $prev_group != $m->group)
	{?>
	    <tr><td><strong><?= $m->group ?></strong></td></tr>
        <? $j=0;}
        if($j%2 == 0 )
	{
	  echo "</tr><tr>";
	}?>
	 </p>		 
<td><div class="control-group">
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" id="name_<?= $i?>" name="name_<?= $i?>" value="<?= $m->name ?>" >&nbsp;&nbsp;<?= $m->name ?>
</label>
</div></td>

<input type='hidden'  style="width:100px !important" name="group<?= $i?>" 
value="<?= $m->group ?>" id="group<?= $i?>" >
<input type='hidden'  style="width:100px !important" name="name<?= $i?>" 
value="<?= $m->name ?>" id="name<?= $i?>" >
<input type='hidden'  style="width:100px !important" name="dispseq_<?= $i?>" 
value="<?= $i ?>" id="dispseq_<?= $i?>" >

	<?
	$prev_group=$m->group;
$i++;$j++;
}?>
</table>
<input type ='hidden' name='index' id='index' value="<?= $i?>">
<?php }?>	
	
	
	
</div>

</div>
<div class="control-group">
<label class="control-label">

Other
</label>
<div class="controls">
<div class='radio inline'>
<input class="input-large" type="text" placeholder="..."  id='other' name='other'  data-attr="other" value='<?= $other ?>' >
</div>
</div>  



<label for="treatment_signature" class="control-label" style="float:left;width:25%">Draw your Signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper current"  style=" margin-left:380px;display:block;clear:none;width:400px">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55"></canvas>
    <input type="hidden" name="output" id="output" class="output">
  </div>
 </div>


</div>
<input type='hidden' name='link2patient' id='link2patient' value=
"<?= $link2patient ?>">
<input type='hidden' name='health_history_accept' id='health_history_accept' value="save">


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
<a class="btn btn-success btn-lg" id="btnSubmitConsent" onclick="javascript:submithealth_view()"><i class="fa fa-check"></i> Save</a>
<a class="btn btn-success btn-lg" id="btnSubmitConsent" onclick="save_acceptedhealthval()"><i class="fa fa-check"></i> ACCEPT</a>
</div>
</div>
</div>

</form>
</div>
