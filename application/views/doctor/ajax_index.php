<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 18, 2015                 =
// Filename: ajax_index.php                    =
// Copyright of Fluent Technologies            =
//==============================================
?>
<html>
<head>

<form  method="post" action="<?php echo base_url();?>doctor_ctrl/update_appointment">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css"/>
<?

        date_default_timezone_set('America/Los_Angeles');
        $format = '%d:%d';
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
	  	$format = '%d:%02d';
        $hours = floor($row->appt_duration / 60);
        $minutes = ($row->appt_duration % 60);
        $duration=sprintf($format, $hours, $minutes);
		$fullname=$row->fname.' '.$row->lname;
        $doc_fullname=$row->doctor;
?>
<div class="m-widget dashbord_box" >
<div class="m-widget-header">
<h3>Appt Details</h3>
</div>
<table class="table table-bordered" width='100%'>
<tbody>
<tr>
<th width='10%'>Clinic</th>
<td width='20%' style="  color:#333333;"><?= $row->site_id ?></td>
<th width='10%' style="padding:2px">Operatory</th>
<td width='20%' style=" color:#333333;"><?= $row->operatory_num ?></td>
</tr>

<tr>
<th>Doctor</th>
<td style="color:#333333;"><?= $doc_fullname ?></td>
<th >Patient</th>
<td  style="color:#333333;p"><?= $fullname ?></td>
</tr>


<tr>
<th>Date/Time</th>
<td  style="color:#333333;"><?= $appt_date.'/'.$row->appt_time ?></td>
<input type="hidden" value="<?php echo $appt_date;?>" name="appt_date"/>

<input type="hidden" value="<?php echo $row->appt_date ;?>" name="appt_date1"  id="appt_date1"/>

<input type="hidden" value="<?php echo $row->link2doctor ;?>" name="doc_id"  id="doc_id"/>

<input type="hidden" value="<?php echo $row->link2clinic ;?>" name="clinicid"  id="clinicid"/>

<input type="hidden" value="<?php echo $row->link2operatory ;?>" name="operatory"  id="operatory"/>

<input type="hidden" value="<?php echo $row->appt_time;?>" name="appt_time"/>
<input type="hidden" value="<?php echo $row->appt_duration;?>" name="appt_duration"/>

<th>Dur(hrs)</th>
<td style="color:#333333;"><?= $duration ?></td>
</tr>
<?
$options1 = array(
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
$attributes = 'id="reason"  style="height:20px;padding:0px;width:150px" ';

?>
<tr>
<th>Purpose</th>
<td>
<?
echo form_dropdown('reason', $options1, $row->reason, $attributes);
?>
</td>
<th width='15%'>Remarks</th>
<td width='20%'  style="color:#333333;"><?= $row->remarks ?></td>
</tr>

<?
$options = array(
                  'Pending'  => 'Pending',
                  'Confirmed'    => 'Confirmed',
                  'Closed'    => 'Closed',
                  'Cancelled'    => 'Cancelled',
				  'Waitlist' => 'Waitlist',
                );
?>
<tr>
<th width='10%'>Status</th>
<td width='20%'>

<?
$style='style="height:20px;padding:0px;width:150px"';
echo form_dropdown('status', $options, $row->status,$style);?>
</td>
<td >
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
</td>
<td>
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
</td>
</tr>
<tr>
<td></td>
<td>
<?php echo form_submit(array('id' => 'submit', 'value' => 'Submit'));?>
</td>
<td></td><td></td>
</tr>
</tbody>
<?
	echo form_hidden('recnum', "$recnum");
?>
</table>
</div>
</form>

</html>
