<html>
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

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
<h3>Patient Details</h3>
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
<td style="color:#333333;"><?= $row->reason ?></td>

<th width='15%'>Remarks</th>
<td width='20%'  style="color:#333333;"><?= $row->remarks ?></td>
</tr>

<?
$options = array(
                  'Pending'  => 'Pending',
                  'Confirmed'    => 'Confirmed',
                );
?>
<tr>
<th width='10%'>Status</th>
<td style="color:#333333;"><?= $row->status ?></td>

</tr>
</tbody>

</table>
</div>
</html>
