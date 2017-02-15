<html>
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<link rel="stylesheet" type="text/css" href="css/meda.css" />
<div class="m-widget-header">
<h3>Edit User Details</h3>
</div>
<script type='text/javascript'>
function GetAllEmps(rt)
{
	var param = 'user';
	var winWidth = 300;
	var winHeight = 200;
	var winLeft = (screen.width-winWidth)/2;
	var winTop = (screen.height-winHeight)/2;
	var ind = 'clinic';
        var base_url = document.getElementById('base_url').value;
        var link2clinic = document.forms['form-horizontal20'].link2clinic.value;
		var clinicid= document.getElementById('clinicid').value ;
       
	if(ind == 'select')
	{
	   alert("Please Select the Type");
	   return false;
	}	
	$("#attachmentloader").load(base_url+"admin_ctrl/getallemp/"+ind+'/'+rt+'/'+link2clinic + clinicid  );
	      document.getElementById('light').style.display='block';
	      document.getElementById('fade').style.display='block';
	
}
</script>

<form method='POST' action="<?php echo base_url();?>admin_ctrl/updateuser"  name='form-horizontal20'>
<table  border=0>
<tr>
<td width='50%' valign='top'>

<table class="table table-bordered" width='100%'>
<tbody>
<tr>
<th width='20%' style='border:1px #ccc solid;'>Email#</th>
<td width='20%' style='border:1px #ccc solid;'><? echo $row->userid ?></td>
<th width='10%' style='border:1px #ccc solid;'>Type</th>
<td width='20%' style='border:1px #ccc solid;'colspan=3 ><? echo $row->type ?></td>
</tr>
<?

echo form_hidden('recnum', "$recnum");
$clinicnames  = $this->admin_model->clinic_infoDetails4disp($row->link2clinic);
if($row->type =='patient')
{
$patientnames  = $this->admin_model->patients_infoDetails($row->link2patient);?>
<tr>
<th width='10%' style='border:1px #ccc solid;'>Patient Name</th>
<?
$patientnames  = $this->admin_model->patients_infoDetails($row->link2patient);?>
<td width='20%' style='border:1px #ccc solid;'><? echo $patientnames[$row->link2patient] ?></td>
<th width='20%' style='border:1px #ccc solid;'>Status</th>
<td width='20%' style='border:1px #ccc solid;' colspan=3 >
<?
$options=array(
"Active"=>"Active",
"Inactive"=>'Inactive');
$attributes = 'id="status"';
echo form_dropdown('status', $options,$row->status,"select");
?>
</td>
</tr>
</tr>
<?
}
elseif($row->type =='doctor')
{
?>
<tr>
<th width='10%' style='border:1px #ccc solid;'>Doctor Name</th>
<?
$docnames  = $this->admin_model->doc_infoDetails($row->link2doctor);?>
<td width='20%'  style='border:1px #ccc solid;'><? echo $docnames[$row->link2doctor] ?></td>
</td>
<th width='20%' style='border:1px #ccc solid;'>Status</th>
<td width='20%' style='border:1px #ccc solid;' colspan=3 >
<?
$options=array(
"Active"=>"Active",
"Inactive"=>'Inactive');
$attributes = 'id="status"';
echo form_dropdown('status', $options,$row->status,"select");
?>
</td>
</tr>
<?
}?>
<div id="attachmentloader"></div>
<!--
<tr>
<th width='10%' style='border:1px #ccc solid;'>Clinic Names</th>
<td width='20%' style='border:1px #ccc solid;'><? echo $clinicnames->name ?></td>
<th width='10%' style='border:1px #ccc solid;'>Clinic Location</th>
<td width='20%' style='border:1px #ccc solid;'><? echo $clinicnames->site_id ?></td>
</tr>
-->
<?
$clinic=$clinicnames->name.' '.$clinicnames->site_id;
?>
<tr>
<th width='10%' style='border:1px #ccc solid;'>Clinic Location</th>
<td style='border:1px #ccc solid;' id='clinic_seg1'><span class="tabletext"><input type="text" name="clinic" id="clinic" style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="<?= $clinic ?>">
<img src="<?php echo base_url();?>img/get.png" alt="Get Clinic"  onclick="GetAllEmps('change_clinic')" height='30px' style="vertical-align:top">
<input type="hidden" name="link2clinic" id="link2clinic" 
value="<?= $row->link2clinic ?>"></td>
</td>
<th width='10%' style='border:1px #ccc solid;'>New Password</th>
<td style='border:1px #ccc solid;' id='clinic_seg1'><span class="tabletext">
<input type="password" name="password" id="password" size=20 value="">
</td>
</td>
</tr>

<input type="hidden" name="clinicid" id="clinicid" value="<?=$clinicid ;?>">

</table>
<button id='search' style="width:7%;" onclick="document.forms[1].submit()" class="btn btn-info" type="button"> 
<i></i>Submit</button>
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
</form>
</html>
