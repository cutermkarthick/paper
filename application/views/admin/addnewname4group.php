<?
//==============================================
// Author: FSI                                 =
// Date-written = Feb 20, 2015                 =
// Filename: add_healthhistory.php             =
// Copyright of Fluent Technologies            =
// Entry for new History                       =
//==============================================
?>
<html>
<head>
<style>
.black_overlay
{
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1050;
	-moz-opacity: 0.7;
	opacity:.70;
	filter: alpha(opacity=70);
}
.white_content 
{        
	position: absolute;
	top: 25%;
	left: 25%;
	width: 30%;
	height: 25%;
	padding: 10px;
	background-color: white;
	z-index:1051;
	overflow: auto;
}
.white_content1 
{        
	position: absolute;
	top: 8%;      
	width: 95%;
	height: 80%;        
	background-color: white;
	z-index:1051;
	overflow: auto;
}
#close
{
    float:right;
}
</style>

<script language=javascript>
function SubmitEmp(etype) 
{
        var type=document.getElementById('type').value;   
        var seltype=document.getElementById('seltype').value;   
        var ind = document.getElementById('emp').selectedIndex;
	var emp = document.forms['form_dropdown'].emp[ind].text;
	var emparr=document.forms['form_dropdown'].emp[ind].value;	

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
		if(seltype == 'doctor')
		{
		  document.getElementById('doctor_seg').style.display="";
		  document.getElementById('doctor_seg1').style.display="";
		  document.getElementById('patient_seg').style.display="none";
		  document.getElementById('patient_seg1').style.display="none";
		}
		else
		{
		  document.getElementById('doctor_seg').style.display="none";
		  document.getElementById('doctor_seg1').style.display="none";
		  document.getElementById('patient_seg').style.display="";
		  document.getElementById('patient_seg1').style.display="";
		}
	}
        else if(type == 'group_name')
	{
if(emp == 'New Group')
{
document.getElementById('newgroup').style.display="";
document.getElementById('newgroup1').style.display="";
document.getElementById('group_pos').style.display="";
document.getElementById('group_pos1').style.display="";
document.getElementById('newgroup_pos').style.display="none";
document.getElementById('newgroup_pos1').style.display="none";

$.get("<?php echo base_url();?>admin_ctrl/showgrouppos/"+document.forms[0].link2clinic.value, function(msg) 
		{
		   $('#show_before').html(msg);
		});	
} 
else
{
  document.getElementById('newgroup').style.display="none";
  document.getElementById('newgroup1').style.display="none";
  document.getElementById('group_pos').style.display="none";
  document.getElementById('group_pos1').style.display="none";
  document.getElementById('newgroup_pos').style.display="";
  document.getElementById('newgroup_pos1').style.display="";

 $.get("<?php echo base_url();?>admin_ctrl/showgroup/"+document.forms[0].link2clinic.value+'/'+empdet[0], function (msg) 
		{
		   $('#showgroup_before').html(msg);
		});	
}
		document.forms[0].group_name.value = emp;
		document.forms[0].group_id.value = empdet[0];
	}
        document.getElementById('light').style.display='none';
        document.getElementById('fade').style.display='none';
}
</script>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
<script language="javascript" src="<?php echo base_url();?>js/crypt.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/meda.css" />

<html>
<head>
<title>Add New Name for <?= $group_name ?></title>
</head>

<form method='POST' action="<?php echo base_url();?>admin_ctrl/enterhealth_history"  name='form-horizontal2' >
<div id="light" class="white_content">
<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';
document.getElementById('fade').style.display='none'" id="close">Close</a>

<table  border=0 >
<tr><td width='50%' valign='top'>

<table class="table table-bordered"  width='100%'>
<tbody>


<tr bgcolor="#FFFFFF">
<th style='border:1px #ccc solid;'>Group</th>
<td style='border:1px #ccc solid;'><span class="tabletext"><input style="width:60% !important" type="text" name="group_name" size=20 value="">
<input type="hidden" name="group_id" id='group_id' value=NULL></td>
<th  id='newgroup' style="border:1px #ccc solid;display: none">Group Name</th>
<td id='newgroup1' style='border:1px #ccc solid;display: none' ><input type='text'  placeholder="Group Name" value=""  name='newgroup_name'></td>
<th  id='group_pos' style="display: none">Show Group Before</th>
<td id='group_pos1'>
<div id='show_before'></div>
</td>
</tr>

<tr bgcolor="#FFFFFF">
<th  id='newgroup' style="border:1px #ccc solid;">Name</th>
<td id='newgroup1' style='border:1px #ccc solid;' ><input type='text'  placeholder="Condition" value=""  name='cond_name'></td>
<th  id='newgroup_pos'>Display Sequence</th>
<td id='newgroup_pos1'><input type='text' name='disp_seq' value=''></td>
</tr>

<div id="attachmentloader"></div>
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
</table>

<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
<button id='search' style="width:7%;" onclick="check_req_fields4healthhisory()" class="btn btn-info" type="button"> 
<i></i>Submit</button>
<div id="fade" class="black_overlay"></div>
</form>
</html>
