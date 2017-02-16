<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 07, 2014                 =
// Filename: add_user.php                      =
// Copyright of Fluent Technologies            =
// Entry for new User                          =
//==============================================
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
<script language="javascript" src="<?php echo base_url();?>js/crypt.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/meda.css" />
<script type='text/javascript'>
function check_req_fields()
{
    var errmsg = '';
    if (document.forms[0].userid.value.length == 0 || 
        document.forms[0].password.value.length == 0) 
    {
         errmsg += 'Missing Email/Password\n';
    }
    if(document.forms[0].type.value == 'select')
    {
	errmsg += "Please Select the Type\n";
    }	

    if(document.forms[0].type.value == 'patient' && document.forms[0].link2patient.value == '')
    {
       errmsg += "Please Select the Patient\n";
    }


      if((document.forms[0].type.value == 'doctor' && document.forms[0].clinicname.value == '') ||
	(document.forms[0].type.value == 'patient' && document.forms[0].link2clinic.value == ''))
	{
	errmsg += "Please Select the Clinic Location\n";
	}	
    if (errmsg == '')
    {
	document.forms[0].password.value = calcMD5(document.forms[0].password.value);
	document.forms[0].submit();
    }
    else
    {
       alert (errmsg);
       return false;
    }
}

function GetAllEmps()
{
	
	var clinicid = document.getElementById('clinicid').value;
	//document.forms[0].doctor.value = '';
	//document.forms[0].link2doctor.value = '';
	document.forms[0].patient.value = '';
	document.forms[0].link2patient.value ='';
	//document.forms[0].link2clinic.value ='';
	document.getElementById('doctor_seg').style.display ='none';
	document.getElementById('doctor_seg1').style.display ='none';
	document.getElementById('patient_seg').style.display ='none';
	document.getElementById('patient_seg1').style.display ='none';
	if(document.forms[0].type.value == 'doctor')
	{
	  document.getElementById('clinic_seg').style.display='';
	  document.getElementById('clinic_seg1').style.display='';
	  document.getElementById('doctor_seg').style.display='';
	  document.getElementById('doctor_seg1').style.display='';
	}
	else
	{
	  document.getElementById('clinic_seg').style.display='';
	  document.getElementById('clinic_seg1').style.display='';
	}
	
	var param = 'user';
	var winWidth = 300;
	var winHeight = 200;
	var winLeft = (screen.width-winWidth)/2;
	var winTop = (screen.height-winHeight)/2;
	var ind = document.forms[0].type.value;
	var base_url = document.getElementById('base_url').value;
	//var link2clinic = document.forms[0].link2clinic.value;
	var clinicid = document.forms[0].clinicid.value;
	  
	if(ind == 'select')
	{
	   alert("Please Select the Type");
	   return false;
	}	

	if(ind == 'doctor')
		{
			$.get("<?php echo base_url();?>admin_ctrl/getdocdetails/"+document.getElementById('clinicid').value,function(msg) 
			{
		   if(msg !="")
			{
				msg = JSON.parse(msg) ;
				
				var options ='' ;
				options ="<select id='listofdocs' name='listofdocs'>" ;
				for(var i=0;i<msg.length ;i++)
				{
				options +="<option value='"+ msg[i].recnum +"'>"+ msg[i].fname + " " + msg[i].lname +"</option>" ;
				}
				options +="</select>";
				document.getElementById('docoptions').innerHTML = options;
			}
			
		}).error(function(){alert("error");}) ;	
		
		$.get("<?php echo base_url();?>admin_ctrl/getclinicdetails/"+document.getElementById('clinicid').value,function(msg) 
			{
		   if(msg !="")
			{
				msg = JSON.parse(msg) ;
				var clinicname1 = msg[0].clinicname ;
				document.getElementById('clinicname').value = clinicname1 ;
			}
			
		}).error(function(){alert("error");}) ;	
		
		
	}
	
}
</script>

<div class="main-container" style="margin-top:20px">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:3px 0px;"class="page-header">

</div>

<div class="row-fluid">
<div class="m-widget dashbord_box" >
<div class="m-widget-header">
<h3>Add New User</h3>
</div>
<form method='POST' action="<?php echo base_url();?>admin_ctrl/enteruser"  name='form-horizontal2' >

<input type="hidden" id="clinicid" name="clinicid" value="<?php echo $clinicid; ?>">
<table  border=0 >
<tr><td width='50%' valign='top'>
<?
$flash_message=$this->session->flashdata('flashMessage'); 
if(isset($flash_message))
{
   echo "<div style='color:red;'>$flash_message</div>";
}

?>
<table class="table table-bordered" width='100%'>
<tbody>


<tr>
<th width='10%' style='border:1px #ccc solid;'>User Id(Email)</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Email" value=""  name='userid'></td>
<th width='10%' style='border:1px #ccc solid;'>Password</th>
<td width='20%' style='border:1px #ccc solid;'><input type='password'  placeholder="Password" value=""  name='password'>
</td>
</tr>

<tr>
<th width='10%' style='border:1px #ccc solid;'>Type</th>
<td width='20%' colspan=3 style='border:1px #ccc solid;'>
<?
$options=array(
"select"=>"Select",
"doctor"=>'Doctor',
"patient"=>'Patient',
"operator"=>'Operator');
$attributes = 'id="type" onchange="GetAllEmps()"';
echo form_dropdown('type', $options,"select", $attributes);
?>
</td>
</tr>


<input type="hidden" name="status" id='status' value='Active'> 

<tr bgcolor="#FFFFFF">
<th width='10%' style='border:1px #ccc solid;display:none' id='clinic_seg'>Clinic Location</th>
<td style='border:1px #ccc solid;display:none' id='clinic_seg1'><span class="tabletext"><input type="text" name="clinicname"  id="clinicname" value ="" style="background-color:#DDDDDD;" readonly="readonly" size=20 >

<th width='10%' style='border:1px #ccc solid;display:none' id='doctor_seg'>Doctor</th>
<td id='doctor_seg1' style='border:1px #ccc solid;display:none'><span class="tabletext">
<div id="docoptions"></div>

			 
<div id="docdetails"></div>
</td>
<th width='10%' style='border:1px #ccc solid;display:none' id='patient_seg'>Patient</th>
<td id='patient_seg1' style='border:1px #ccc solid;display:none'><span class="tabletext"><input type="text" name="patient" style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="">
<img src="<?php echo base_url();?>img/get.png" alt="Get Doctor"  onclick="GetAllEmps('patient')" 
height='30px' style="vertical-align:top">
<input type="hidden" name="link2patient" value=NULL> </td>
</tr>

</table>
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
<button id='search' style="width:7%;" onclick="javascript: return check_req_fields()"class="btn btn-info" type="button"> 
<i></i>Submit</button>
</form>
</html>
