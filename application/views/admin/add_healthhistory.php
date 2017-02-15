<?
//==============================================
// Author: FSI                                 =
// Date-written = Feb 20, 2015                 =
// Filename: add_healthhistory.php             =
// Copyright of Fluent Technologies            =
// Entry for new History                       =
//==============================================
?>
<div class="main-container">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:3px 0px;"class="page-header">
</div>
<script type='text/javascript'>
function GetAllEmps(rt)
{
	var param = 'user';
	var winWidth = 300;
	var winHeight = 200;
	var winLeft = (screen.width-winWidth)/2;
	var winTop = (screen.height-winHeight)/2;
        var base_url=document.getElementById('base_url').value;
	var ind='doctor';
        var link2clinic=document.forms[0].link2clinic.value;
$("#attachmentloader").load(base_url+"admin_ctrl/getallemp/"+ind+'/'+rt+'/'+link2clinic);
      document.getElementById('light').style.display='block';
      document.getElementById('fade').style.display='block';	
}
function SetEmp(emp,emparr,type) 
{
	var empdet = emparr.split("|");
	if(type == 'doctor')
	{
		document.forms[0].doctor.value = emp;
		document.forms[0].link2doctor.value = empdet[0];
	}
	else if(type == 'patient')
	{
		document.forms[0].patient.value = emp;
		document.forms[0].link2patient.value = empdet[0];
	}
	else if(type == 'clinic')
	{
		document.forms[0].clinic.value = emp;
		document.forms[0].link2clinic.value = empdet[0];
	}
}
</script>

<div class="row-fluid">
<div class="m-widget dashbord_box" >
<div class="m-widget-header">
<h3>Add New Health History</h3>
</div>

<form method='POST' action="<?php echo base_url();?>admin_ctrl/enterhealth_history"  name='form-horizontal2' >
<table  border=0 >
<tr><td width='50%' valign='top'>

<table class="table table-bordered"  width='100%'>
<tbody>
<tr bgcolor="#FFFFFF">
<th width='7%' style='border:1px #ccc solid;'>Clinic Location</th>
<td colspan=5 style='border:1px #ccc solid;'><span class="tabletext"><input type="text" name="clinic" style=";background-color:#DDDDDD;" 
readonly="readonly" size=20 value="">
<img src="<?php echo base_url();?>img/get.png" alt="Get Clinic"  onclick="GetAllEmps('clinic')" 
height='30px' style="vertical-align:top">
<input type="hidden" name="link2clinic" value=NULL></td>
</tr>

<tr bgcolor="#FFFFFF">
<th style='border:1px #ccc solid;'>Condition Group</th>
<td style='border:1px #ccc solid;'><span class="tabletext"><input style="width:60% !important" type="text" name="group_name" style=";background-color:#DDDDDD;" readonly="readonly" size=20 value=""><img src="<?php echo base_url();?>img/get.png" alt="Get Clinic"  onclick="GetAllEmps('group_name')" height='30px' style="vertical-align:top">
<input type="hidden" name="group_id" id='group_id' value=NULL></td>
<th  id='newgroup' style="border:1px #ccc solid;display: none">Group Name</th>
<td id='newgroup1' style='border:1px #ccc solid;display: none' ><input type='text'  placeholder="Group Name" value=""  name='newgroup_name'></td>
<th  id='group_pos' style="display: none">Show Group Before</th>
<td id='group_pos1'>
<div id='show_before'></div>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<th  id='newgroup' style="border:1px #ccc solid;">Condition</th>
<td id='newgroup1' style='border:1px #ccc solid;' ><input type='text'  placeholder="Condition" value=""  name='cond_name'></td>
<th  id='newgroup_pos' style="display: none">Show Condition Before </th>
<td id='newgroup_pos1' colspan=3>
<div id='showgroup_before'></div>
</td>
</tr>

<div id="attachmentloader"></div>
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
</table>

<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
<button id='search' style="width:7%;" onclick="check_req_fields4healthhisory()" class="btn btn-info" type="button"> 
<i></i>Submit</button>
</form>
</html>
