<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 12, 2014                 =
// Filename: getallemps.php                    =
// Copyright of Fluent Technologies            =
// Dropdown for showing all the Doctor         =
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
        var type=document.forms['form_dropdown'].type.value; 
        var seltype=document.getElementById('seltype').value;   
        var ind = document.getElementById('emp').selectedIndex;
		var emp = document.forms['form_dropdown'].emp[ind].text;
		var emparr=document.forms['form_dropdown'].emp[ind].value;	

        var empdet = emparr.split("|");
		if(type == 'doctor')
		{
			$.get("<?php echo base_url();?>admin_ctrl/checkdoc4clinic/"+document.getElementById('link2clinic').value+'/'+empdet[0], function(msg) 
			{
		   if(msg >0)
			{
			alert("Doctor Exists for this Clinic");
			return false;
			}
		});
	}
    
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
	else if(type == 'change_clinic')
	{
	document.getElementById('clinic').value = emp;
	document.forms['form-horizontal20'].link2clinic.value = empdet[0];
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
<title>Doctor</title>
</head>

<?php

echo "REacghed" . $sel_type ;
echo $clinicid ;

/* if($sel_type == 'doctor' && $clinicid != '')
{
echo "REawched" ;    
$clinicname = $this->admin_model->clinic_name($clinicid);

} */
?>
<form name='form_dropdown'>
<input type='hidden' name='type' id='type' value="<?echo $sel_type ?>">
<div id="light" class="white_content">
<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';
document.getElementById('fade').style.display='none'" id="close">Close</a>
<?php
$attributes='id="emp"';
if($sel_type == 'doctor' && $type == 'doctor')
{    
  $docnames = $this->admin_model->doc_infoDetails4user();
  ?>
  <br>Please select the Doctor</b>
  <br>
  <tr>
  <br>
  <td><span class="tabletext">
  <?php 
       echo form_dropdown('emp',$docnames, '',$attributes);
  ?>
  </td>
  </tr>
  </table>
  <br>
<input type=button value="Submit" onclick=" javascript: return SubmitEmp(window.name)">
<?}
elseif($sel_type == 'patient' && $type == 'patient')
{     
 $patientnames  = $this->admin_model->getpatients4newuser($link2clinic);
 $list='';
 $listofpatients=array();

if(count($patientnames)>0)
{
        foreach($patientnames as $val)
        {
	  $list[$val->patient_recnum] = $val->fname." ".$val->lname;
	}
	$listofpatients = $list;
?>
<br>
Please select the Patient</b>
<br>
        <tr>
            <br>
            <td><span class="tabletext">
             <?php 
              echo form_dropdown('emp',$listofpatients,'', $attributes);
             ?>
            </td>
        </tr>

</table>
<br>
<input type=button value="Submit" onclick=" javascript: return SubmitEmp(window.name)">
<?}
else
{
echo "No Patients for the Selected Clinic";
}
}
elseif(($sel_type == 'clinic' ||$sel_type == 'change_clinic' ) && $type != 'admin')
{
	$docnames  = $this->admin_model->clinic_infoDetails('%');?>
	<br>Please select the Clinic</b><br>
	<tr>
	<td>
	<span class="tabletext">
	     <?php 
	      echo form_dropdown('emp',$docnames,'',$attributes);
	     ?>
	</td>
	</tr>
	</table>
	<input type=button value="Submit" onclick=" javascript: return SubmitEmp(window.name)">
<?
}
elseif($sel_type == 'group_name' && $link2clinic != 'NULL')
{
	$grp_name  = $this->admin_model->getgroup4healthdetails($link2clinic,'');
?>
	<br>Please select the Group</b><br>
	<tr>
	<td>
	<span class="tabletext">
	     <?php 
	      echo form_dropdown('emp',$grp_name,'',$attributes);
	     ?>
	</td>
	</tr>
	</table>
	<input type=button value="Submit" onclick="javascript: return SubmitEmp(window.name)">
<?
}
elseif($sel_type == 'group_name')
{
  echo  "<h1>Please Select the Clinic</h1>";
}
?>
<br>

<input type='hidden' name='seltype' id='seltype' value="<?echo $type ?>">
<input type='hidden' name='link2clinic' id='link2clinic' value="<?echo $link2clinic ?>">

</div>
<div id="fade" class="black_overlay"></div>
</form>
</html>
