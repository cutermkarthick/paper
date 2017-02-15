<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 04, 2014                 =
// Filename: add_doctor.php                    =
// Copyright of Fluent Technologies            =
// Entry for new Doctor                        =
//==============================================
?>
<div class="main-container">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:3px 0px;"class="page-header">
</div>
<?
if($type == 'health_history')
{
	foreach($query as $q)
	$clinic=$q->clinic;
	?>
	<div class="row-fluid">
	<div class="m-widget dashbord_box" >
	<div class="m-widget-header">
	<h3>Add New Health History Meta for Clinic:<?=$clinic ?></h3>
	</div>

	<form method='POST' action="<?php echo base_url();?>admin_ctrl/entermaster_meta"  name='form-horizontal2' >
	<table  border=0 >
	<tr><td width='50%' valign='top'>
	<?php 
	$flash_message=$this->session->flashdata('flashMessage');
	if(isset($flash_message))
	{
	   echo "<div style='color:red;'>$flash_message</div>";
	}
	?>
	<table class="table table-bordered"  width='100%'>
	<tbody>
	<tr bgcolor="#FFFFFF">
	<th style='border:1px #ccc solid;' width='20%'>Group</th>
	<td style='border:1px #ccc solid;'><span class="tabletext"><input  type="text" name="group_name" size=20 value="" placeholder="Group" style="width:200px !important">
	</td>
	<th  style="border:1px #ccc solid;" width='20%'>Name</th>
	<td  style='border:1px #ccc solid;' ><input type='text'  placeholder="Name" value=""  name='cond_name' style="width:200px !important"></td>
	</tr>

	<tr>
	<th  id='newgroup_pos' style="border:1px #ccc solid;">Display Sequence </th>
	<td colspan=3 ><input type='text' style="width:100px !important" name='disp_seq' value=''></td>
	</tr>

	<div id="attachmentloader"></div>
	<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
	</table>

	</table>
	<input type='hidden' name='link2clinic' id='link2clinic' value="<?= $link2clinic?>">

	<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
<button id='search' style="width:7%;" onclick="check_req_fields4healthhisory()" class="btn btn-info" type="button"><i></i>Submit</button>
<?}
else
{
$clinic='';
	foreach($query as $q)
	  $clinic=$q->clinic;
	?>
	<div class="row-fluid">
	<div class="m-widget dashbord_box" >
	<div class="m-widget-header">
	<h3>Add New Patient Consent for Clinic:<?=$clinic ?></h3>
	</div>

	<form method='POST' action="<?php echo base_url();?>admin_ctrl/enterconsent_meta"  name='form-horizontal3' >
	<table  border=0 >
	<tr><td width='50%' valign='top'>
	<?php 
	$flash_message=$this->session->flashdata('flashMessage');
	if(isset($flash_message))
	{
	   echo "<div style='color:red;'>$flash_message</div>";
	}?>
<table class="table table-bordered"  width='100%'>
<tbody>

<tr bgcolor="#FFFFFF">	
<th  style="border:1px #ccc solid;" width='20%'>Name</th>
<td  style='border:1px #ccc solid;' width='30%'><input type='text'  placeholder="Name" value="" name='cond_name' style="width:200px !important"></td>
<th  id='newgroup_pos' style="border:1px #ccc solid;">Display Sequence </th>
<td colspan=3 ><input type='text' style="width:100px !important" name='disp_seq' value=''></td>
</tr>

<tr bgcolor="#FFFFFF">
<th  style="border:1px #ccc solid;" width='20%'>Consent Text</th>
<td colspan=3>
<table width='100%' border=0>
<tr>
<td style="border-left:0px"><textarea 
 name="consent_text" id="consent_text" style="width:700px;height:200px"></textarea></td>
</tr>
</table>
</td>
</tr>

<tr bgcolor="#FFFFFF">	
<th  style="border:1px #ccc solid;" width='20%'>Tooth Flag</th>
<td style='border:1px #ccc solid;' ><input type="checkbox" name="tooth_flag" value="yes"  id="tooth_flag"></td>
<th  style="border:1px #ccc solid;" width='20%'>Shade Flag</th>
<td style='border:1px #ccc solid;' ><input type="checkbox" name="shade_flag" value="yes"  id="shade_flag"></td>
<div id="attachmentloader"></div>	
</table></table>	
<button id='search' style="width:7%;" onclick="check_req_fields4consent()" class="btn btn-info" type="button"> 
	<i></i>Submit</button>
<?}?>
<input type='hidden' name='link2clinic' id='link2clinic' value="<?= $link2clinic?>">
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
</form>
</html>
