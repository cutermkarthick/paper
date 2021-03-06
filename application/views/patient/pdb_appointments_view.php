<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 10, 2014                 =
// Filename: pdb_appointment_view.php          =
// Copyright of Fluent Technologies            =
// Displays list of Appointments.              =
//==============================================
?>
<head>
<script type='text/javascript'>
$(document).ready(function() 
{
$("#profile").css({"display": "none"});
});
var url=(window.location.href);
var parameter =  url.split('/').pop();
$(document).ready(function() 
{	
    if(parameter == 'profile')
	{
		$("#home").removeClass("active in");
        $("#profile").addClass("active in");
		$("#listappts").removeClass("active in");

		$("#myTab li").removeClass("active");
		$("#myTab li#profile1").addClass("active");
	}
});
function getPaging4appt(str)
{
$("#profile").css({"display": "none"});
$("#listappts").css({"display": "none"});
    if(str == 'profile')
	{
        $("#profile").addClass("active in");
		$("#listappts").removeClass("active in");

		$("#myTab li").removeClass("active");
		$("#myTab li#profile1").addClass("active");

		$("#profile").css({"display": "inline"});

	}
else
{
		$("#listappts").css({"display": "inline"});
        $("#profile").removeClass("active in");
		$("#listappts").addClass("active in");
}
}


function getduration(obj)
{
	var dur=obj.value;	
	var txt=$("#select_time :selected").text();	
	var element=document.getElementById('selected_time');
        //alert(txt+'==='+	element.options[txt].text);
	//alert($("#selected_time  option[value='" + txt +"']").text());

	var duration=parseInt(document.getElementById('select_duration').value);
	var cur=$("#selected_time  option[value='" + txt +"']").text();	
	
	/*
	if(cur<duration)
	{
	alert("Selected Time slot not available; Please select appropriate duration");
	document.getElementById("select_duration").value='';
		return false;
	}
	*/
}
function getajaxdetails(recnum)
{
  $.ajax({
        type: 'POST',
        url: "<?php echo base_url();?>patient_ctrl/getappointment/"+recnum,
        success:function(response){
           $('#ajax-content-container').html(response);
        }
});
}

function getLocation(obj)
{ 	
    var loc=obj.value;
	document.getElementById('location_name').value=$("#loc  option[value='" + loc +"']").text();
	$.get("<?php echo base_url();?>patient_ctrl/getdoc/"+loc, function (msg)
	{		
		op_slots = msg;
		var $select = $("#dct_name");
		$select.removeAttr("disabled");
		$select.find('option').remove();
		$.each(op_slots, function (key, value) 
		{
			$('<option>').val(key).text(value).appendTo($select);
		})
	})
}
function getPatientDetails(obj)
{
var ind = document.getElementById('dct_name').selectedIndex;
var name = document.forms[0].dct_name[ind].text;
var id=document.forms[0].dct_name[ind].value;
document.forms[0].doc_name.value=name;
document.forms[0].doc_id.value=id;

}
</script></head>
<div class="main-container">
<div class="container-fluid">
<section>
<?
$fullname='';
$fname='';
foreach($query_search as $row)
{
$fullname=$row->fname.' '.$row->lname;
$fname=$row->fname;
}
?>
<div style="margin-top:10px;" class="row-fluid">

<div class="m-widget-header">
<div class="span12  sub_title">
<h1> <i class="fa fa-file-text-o"></i>&nbsp;Appointments </h1>
<?php 
$flash_message=$this->session->flashdata('flashMessage');
if(isset($flash_message))
{
   echo "<div style='color:red;'>$flash_message<div>";
}
?>
</div>

</div>
</div>

<div style="margin-top:9px;" class="row-fluid">
<div class="span12 m-widget">
<div style="margin-top:0px;" class="row-fluid">

<div class="span7">
<div style="margin-top:0px;" class="row-fluid">

<div class="m-widget-body">


<ul style="margin-bottom:-1px;" class="nav nav-tabs" id="myTab">
<!--<li class="active"><a data-toggle="tab" href="#home">  New Requests    </a></li>-->
<li class="active"><a data-toggle="tab" onclick="javascript:getPaging4appt('listappts')">Search Appointments  </a></li>
<li class=""><a data-toggle="tab" 
onclick="javascript:getPaging4appt('profile')">Request Appointment  </a></li>
</ul>


<div class="tab-content" id="myTabContent">
<div  id="home" class="tab-pane fade active in">

<div class=" row-fluid">

<!--<div style="float:right" class="btn-group">

<button class="btn">Month</button>
<button class="btn">Week</button>
<button class="btn btn btn-info">Day</button>
</div>-->

</div>

<!--<div class="row-fluid">
<table class="table table-bordered patoent_table">
<thead style="width:100%; background:#39F; color:#FFF;">
<tr>
<th>Date</th>
<th>Time</th>
<th>Duration(hrs)</th>
<th>Patient</th>
<th>Doctor </th>
<th>Reason </th>
<th>Status</th>

</tr>
</thead>
<tbody style="width:100%;">
<?php   
//echo "Here";
foreach($query as $row)
    {
        echo "<tr><td>$row->appt_date</td>";
		echo "<td>$row->appt_time</td>";
		echo "<td>$row->appt_duration</td>";
		echo "<td>$row->fullname</td>";
		echo "<td>$row->doctor</td>";
		echo "<td>$row->reason</td>";
		echo "<td>$row->status</td>";
    }	
?>
</tbody>

</table>
</div>
</div>-->	

<div id="profile" class="tab-pane fade ">
<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Request an Appointment </h1>
<div class="clearfix">  </div>	 
<div class="span11 m-widget">
<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'myform_patient', 'style' => 'padding-top:20px;');
echo form_open('patient_ctrl/temp', $attributes);
?>
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>" >
<div class="control-group">
<?php
$attributes = array('class' => 'control-label');
echo form_label('Clinic:', 'inputPassword', $attributes);
?><?php echo form_error('location'); ?>
<div class="controls">

<!-----edited on march 30
previously was>>>
$locnames  = $this->doctor_model->fillLoclist($this->session->userdata('clinicid'),'patient');
------>
<?
$attributes1 = 'id="loc" class="input-xlarge" onChange="getLocation(this)" ';
$locnames  = $this->doctor_model->fillLoclist($this->session->userdata('clinicid'),'patient');

echo form_dropdown('location', $locnames,'',$attributes1);
?>
</div>
</div>

<div class="control-group">
<?php
$attributes = array('class' => 'control-label');
echo form_label('Doctor:', 'inputEmail', $attributes);
?>                                                    

<div class="controls">
<?php
$attributes = 'id="dct_name" class="input-xlarge" onChange="getPatientDetails(this)"';
$doctornames  = $this->doctor_model->fillDoctorlist('0');
$options = array(
	   'sel_op' => 'Select'
	);
if(is_array($doctornames))
{
   echo form_dropdown('dct_name', $doctornames,'',$attributes);
}
else
{
   echo form_dropdown('dct_name',$options,'',$attributes);
}
?>
</div> 
</div>
<input type='hidden' name='operatory' id='operatory' value='OP1'>
<input type='hidden' name='doc_id' id='doc_id' value=''>
<input type='hidden' name='doc_name' id='doc_name' value=''>

<div class="control-group">
<?php
$attributes = array('class' => 'control-label');
echo form_label('Date of Appointment:', 'inputPassword', $attributes);
?>  
<div class="controls">
<div class="date" id="dp3"  data-date="<?= date('Y-m-d') ?>" data-date-format="yyyy-mm-dd">
	<?php
	$data = array(
		'class' => 'input-xlarge',
		'type' => "text",
		'name' => "appt_date",
		'id'  => "appt_date",
		'size' => '16',	
		'readonly'=>'readonly',		
	);
	echo form_input($data);
	?>
	<span style="position:relative; left:-30px; z-index:1;" class="add-on">
		<i class="icon-th"></i>
	</span>
</div>
</div>
</div>



<div class="control-group">
<?php
$attributes = array('class' => 'control-label');
echo form_label('Time:', 'inputPassword', $attributes);
?>  
<div class="controls">
<?php
$options = array(
	   'sel_date' => 'Choose a Date ...'
	);
$attributes = 'id="select_time" class="input-xlarge" disabled="disabled" style="display:hidden" onChange="getdateval(this)" ';
echo form_dropdown('appt_time', $options,'sel_date', $attributes);
?>
</div>
</div>

<div class="control-group">
<?php
$attributes = array('class' => 'control-label');
echo form_label('Duration:', 'inputPassword', $attributes);
?>  
<div class="controls">
<?php
$options = array(
''=>'Select',
	'30' => '1/2 hr',
	'60' => '1 hr',
	'90' => '1 1/2 hr',
	'120' => '2 hrs',
);
$attributes1 = 'id="select_duration" onChange="getduration(this)" ';
echo form_dropdown('appt_duration', $options,'',$attributes1);
?>
</div>
</div>


<div class="control-group">
<?php
$attributes = array(
'class' => 'control-label'
);
echo form_label('Purpose:', 'inputPassword', $attributes);
?>                                                    

<div class="controls">
<?php
$options = array(
	'Consultation' => 'Consultation',
	// 'Preventive' => 'Preventive',
	// 'Deep Cleaning' => 'Deep Cleaning',
	// 'Filling' => 'Filling',
	// 'Root Canal' => 'Root Canal',
	// 'Extraction' => 'Extraction',
	// 'Implant' => 'Implant',
	// 'Reason' => 'Reason',
	'Other' => 'Other',
);
$attributes = 'id="select01" class="input-xlarge"';
echo form_dropdown('purpose', $options, 'small', $attributes);
?>
</div> 
</div>
<div class="control-group">
<?php
$attributes = array('class' => 'control-label');
echo form_label('Remarks:', 'inputPassword', $attributes);
?>
<div class="controls">
<?php
$data = array(
	'class' => 'input-xlarge',
	'type' => "text",
	'placeholder' => 'Remarks',
	'name' => 'remarks'
);
echo form_input($data);
?>	
</div>
</div>




<div class="control-group">
<?php
$attributes = array('class' => 'control-label');
echo form_label('Confirmation:', 'inputPassword', $attributes);
?>
<div class="controls">
<label class="checkbox inline">
	<?php
	$data = array(
		'class' => 'input-xlarge',
		'type' => "checkbox",
		'name' => 'sms_email',
		'id' => "optionsRadios1",
		'value' => '1',
		'checked' => TRUE,
	);
	echo form_input($data);
	?>
	SMS
</label>
<label class="checkbox inline">
	<?php
	$data = array(
		'class' => 'input-xlarge',
		'type' => "checkbox",
		'name' => 'email',
		'id' => "optionsRadios2",
		'value' => '1',
	);
	echo form_input($data);
	?>
	Email
</label>
</div>
</div>

<div class="controls">
<?php
$options = array(
);
$attributes = 'id="selected_time" class="input-xlarge" style="display:none" ';
echo form_dropdown('selected_time', $options, 'small', $attributes);
?><input type='hidden' name='location_name' id='location_name' value=''>
<input type='hidden' name='waittime[]' id='waittime' value=''>

<input type='hidden' name='status' id='status' value='Pending'>
<input type='hidden' name='patient_name' id='patient_name'
value='<?= $this->session->userdata('recnum') ?>'>
</div> 

<div style="margin-top:25px;" class="control-group">
<div class="controls">
<button id='next_r_prev'  style="float:left;position:relative;margin-left:5%;text-align:center" onclick="javascript:check_req_fields4newappt()" 
class="btn btn-large  btn-info" type="button"> 
<i ></i>Request Appointment</button>
</div>             
</div>      
<?php echo form_close(); ?>            
</div>
</div>
</div>

<div id="listappts" class="tab-pane fade active in">
<div class="row-fluid patient_history">
<h1>Search Appointments </h1>

<?php
$attributes = array('class' => 'form-horizontal', 'name'=>'form-horizontal_4','id' => 'listappts', 'style' => 'padding-top:0px;');
echo form_open('patient_ctrl/listapts', $attributes);
?>
<div style="margin-top:0px;" class="control-group">
<div class="controls" style="margin-left:100px">
<?
$options = array(                  
                  'Pending'  => 'Pending',
                  'Confirmed'    => 'Confirmed',
				  'Waitlist'    => 'Waitlist',
                   'all'  => 'All',
                );
$js = 'id="status"';
echo form_dropdown('status', $options, $status,$js);

$options1 = array(
             'all'  => 'All',
	'Consultation' => 'Consultation',
	'Preventive' => 'Preventive',
	'Deep Cleaning' => 'Deep Cleaning',
	'Filling' => 'Filling',
	'Root Canal' => 'Root Canal',
	'Extraction' => 'Extraction',
	'Implant' => 'Implant',
	'Reason' => 'Reason',
	'Other' => 'Other',
);
$attributes = 'id="reason"  style="height:20px;padding:0px" ';
$js = 'id="reason"';
?>
&nbsp;&nbsp;
<?
echo form_dropdown('reason', $options1, $reason,$js);
?>
&nbsp;&nbsp;
<span class="input-append date" id="dp4"  data-date="<?= date('Y-m-d') ?>" data-date-format="yyyy-mm-dd">
<?
$data = array(
	'type' => "text",
	'name' => "appt_date",
	'id'  => "appt_date",
	'size' => '6',	
	'placeholder' => 'Appt Date',
	'value' =>"$apptdate",
	'style'=>'width:100px;',
);
echo form_input($data);
?>
<span style="position:relative; left:-30px; z-index:1;" class="add-on">
		<i class="icon-th"></i>
	</span>
</span>
<input type='hidden' name='patientname' id='patientname' value="<?= $fname ?>">
<button id='search' style="width:15%;float:right;" onclick="document.forms['form-horizontal_4'].submit()" class="btn btn-info" type="button"> 
<i></i>Search</button>
</div>             
</div>      
<?php echo form_close(); ?>            
<table class="table table-bordered patient_table" style="table-layout: fixed" id='csample' width='98%'>
<tr style=" background:#39F; color:#FFF;">
<th width='15%'>Date</th>
<th width='15%'>Time</th>
<th width='10%'>Dur<br/>(hrs)</th>
<th width='20%'>Doctor</th>
<th width='20%'>Reason</th>
<th width='20%'>Status</th>
</tr>
</table>
<div width='100%' style="height:300px; overflow-x:hidden;overflow-y:scroll;border:;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>
<tbody style="width:100%;">
<?php   
foreach($query_search as $row)
{
	$format = '%d:%02d';
        $hours = floor($row->appt_duration / 60);
        $minutes = ($row->appt_duration % 60);
        $duration=sprintf($format, $hours, $minutes);
	$fullname=$row->fname.' '.$row->lname;
if($row->appt_date != '0000-00-00' && $row->appt_date != '' && $row->appt_date != 'NULL')
      {
              $datearr = explode('-', $row->appt_date);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $appt_date=date("M j, Y",$x);
      }
      $datearr1 = explode(':', $row->appt_time);
      $appt_time=$datearr1[0].":".$datearr1[1];

        echo "<tr><td width='15%'><a href='#' onclick='getajaxdetails($row->recnum)'>$appt_date</td>";
	echo "<td width='15%' >$appt_time</td>";
	echo "<td width='10%' >$duration</td>";	
	echo "<td width='20%'>$row->doctor</td>";
	echo "<td width='20%'>$row->reason</td>";
	echo "<td width='20%'>$row->status</td>";
}	
?>
</tbody>
</table>
</div>

<div id='ajax-content-container'>
</div>
</table>

</div>
</div>


</div>
</div>
</div>
</div>
</div>
<div class="span5">
<div class="row-fluid patient_history">
<h1>Appointment Calendar </h1>
<div id='calendar'></div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
