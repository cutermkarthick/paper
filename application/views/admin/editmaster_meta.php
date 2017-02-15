<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 09, 2014                 =
// Filename: editclinic_details.php            =
// Copyright of Fluent Technologies            =
// Edit clinic details                         =
//==============================================
?>
<html>
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css"/>
<script type="text/javascript" src="<?php echo base_url(). "js/jquery-1.7.1.min.js" ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
<script language="javascript" src="<?php echo base_url();?>js/jquery.js" />
<script language="javascript" src="<?php echo base_url();?>js/admin.js"></script>
<script type="text/javascript">

	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

</script>
<form method='POST' action="<?php echo base_url();?>admin_ctrl/updatemaster_meta"  name='form-horizontal5'>
<div class="container">
<ul class="tabs">
<li class="tab-link current" data-tab="tab-1">Health Info</li>
<li class="tab-link" data-tab="tab-2">Consent Info</li>
</ul>
<div id="tab-1" class="tab-content current">
<?
foreach($query as $q)
{
  $clinic_name=$q->clinic;
}
  $clinic_name=($clinic_name == '')?'DEFAULT':$clinic_name;
?>
<table  border=0 >
<tr><td width='50%' valign='top'>
<tr>
<td width='30%' valign='top'>
<div class="m-widget-header">
<h3 style="width:600px !important">Health History details for Clinic:<?= $clinic_name ?>
<button id='search' style="width:10%;float:right;" class="btn btn-info" type="button" 
onclick="window.location='<?php echo base_url()?>admin_ctrl/addnewmaster_meta/<?= $link2clinic?>/health_history'"> 
<i></i>NEW</button></h3>
</div>
<div id="attachmentloader"></div>
<table class="table table-striped table-condensed"  style="width:50% !important">
<tr>
<th style="border:1px #ccc solid;">Group</th>
<th width='40%' style="border:1px #ccc solid;">Names</th>
<th style="border:1px #ccc solid;">Display<br>Sequence</th>
<th style="border:1px #ccc solid;">Status</th>
</tr>
<?
$i=0;$prev_group='';
foreach($query as $row)
{?>
<tr>
<?
$group=($row->group != '')?$row->group:'DEFAULT';
if($group != $prev_group || $prev_group == '')
  echo "<td style='border:1px #ccc solid;' width='30%'>$row->group</td>";
else
echo "<td style='border:1px #ccc solid;' width='30%'>&nbsp;</td>";
?>
<td style='border:1px #ccc solid;'><input type='text'  style="width:100px !important" name="name<?= $i?>" 
value="<?= $row->name ?>" id="name<?= $i?>" ></td>
<td style='border:1px #ccc solid;'><input type='text'  style="width:100px !important" name="disp_seq<?= $i?>" 
value="<?= $row->disp_seq ?>" id="disp_seq<?= $i?>" ></td>


<td style='border:1px #ccc solid;'><input type='text'  style="width:100px !important;background-color:#DDDDDD;" readonly="readonly"  name="status<?= $row->recnum?>" 
value="<?= $row->status ?>" id="status<?= $row->recnum?>" ></td>


</tr>
<input type='hidden' name="rec<?= $i?>" value="<?= $row->recnum ?>">
<input type='hidden'  style="width:100px !important" name="group<?= $i?>" 
value="<?= $row->group ?>" id="group<?= $i?>" >
<input type='hidden'  style="width:100px !important" name="dispseq_<?= $i?>" 
value="<?= $row->disp_seq ?>" id="dispseq_<?= $i?>" >
	<? 
	$i++;
$prev_group=$row->group;
}?>
</td></tr></table></td></tr></table>
<br>
<button id='search' style="width:7%;" onclick="document.forms['form-horizontal5'].submit()"  class="btn btn-info" type="button"> 
<i></i>Submit</button>
</div>

<div id="tab-2" class="tab-content">
<?

foreach($query_consent as $q)
{
  $clinic_name=$q->clinic;
}
  $clinic_name=($clinic_name == '')?'DEFAULT':$clinic_name;
?>
<table  border=0 >
<tr><td width='50%' valign='top'>
<tr>
<td width='30%' valign='top'>

<div class="m-widget-header">
<h3 style="width:600px !important">Consent details for Clinic:<?= $clinic_name ?>
<button id='search' style="width:10%;float:right;" class="btn btn-info" type="button" onclick="window.location='<?php echo base_url()?>admin_ctrl/addnewmaster_consent/<?= $link2clinic?>/patient_consent'"> 
<i></i>NEW</button></h3></div>

<div id="attachmentloader"></div>
<table class="table table-striped table-condensed"  style="width:50% !important">
<tr>
<th width='40%' style="border:1px #ccc solid;">Names</th>
<th style="border:1px #ccc solid;">Text</th>
<th style="border:1px #ccc solid;">Display Sequence</th>
<th style="border:1px #ccc solid;">Tooth Flag</th>
<th style="border:1px #ccc solid;">Shade Flag</th>
<th style="border:1px #ccc solid;">Status</th>
</tr>
<?
$i=0;$prev_group='';$tooth_flag='';$shade_flag='';

$count=count($query_consent);
if($count >0)
{
	$tooth_flag='';$shade_flag='';

	foreach($query_consent as $row)
	{
	$checked1 ='';
	$checked2 ='';
	$tooth_flag ='';
	$shade_flag = '';
	
	$checked1 = $row->tooth_num_flag ;
	$checked2 = $row->tooth_shade_flag ;
	if($checked1 == 'yes')
	  $tooth_flag='checked';
	if($checked2 == 'yes')
	  $shade_flag='checked';
  
  
	?>
	<tr>
	<td style='border:1px #ccc solid;'><input type='text'  style="width:100px !important" name="name<?= $i?>" 
	value="<?= $row->name ?>" id="name<?= $i?>" ></td>

	<td style='border:1px #ccc solid;'>
	<textarea name="consent_text<?= $i?>" id="consent_text<?= $i?>"  size=20><?= $row->consent_text ?></textarea></td>

	<td style='border:1px #ccc solid;'><input type='text'  style="width:100px !important" name="disp_seq<?= $i?>" 
	value="<?= $row->disp_seq ?>" id="disp_seq<?= $i?>" ></td>

	<td style='border:1px #ccc solid;' ><input type="checkbox" name="tooth<?= $i?>" value="<?= $checked1?>" <?= $tooth_flag ?> id="tooth<?= $i?>"></td>
	<td style='border:1px #ccc solid;' ><input type="checkbox" name="shade<?= $i?>" value="<?= $checked2?>"  <?= $shade_flag ?>  id="shade<?= $i?>"></td>

	<td style='border:1px #ccc solid;'>
	<?
	$options=array(
	"Active"=>"Active",
	"Inactive"=>'Inactive');

	$attributes = 'id="status"';
	echo form_dropdown("status$row->recnum", $options,$row->status,"select");
	?>
	</td>
	</tr>
	<input type='hidden' name="rec<?= $i?>" value="<?= $row->recnum ?>">
	<input type='hidden'  style="width:100px !important" name="group<?= $i?>" 
	value="<?= $row->group ?>" id="group<?= $i?>" >
	<input type='hidden'  style="width:100px !important" name="dispseq_<?= $i?>" 
	value="<?= $row->disp_seq ?>" id="dispseq_<?= $i?>" >
		<? 
		$i++;
	$prev_group=$row->group;
	}
}?>
</table>
<button id='search' style="width:7%;" onclick="document.forms['form-horizontal5'].submit()"  class="btn btn-info" type="button"> 
<i></i>Submit</button>
</div>

</div>
<input type ='hidden' name='index' id='index' value="<?= $i?>">
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
</table>
</tbody>



</form>
</html>
