<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 07, 2014                 =
// Filename: doctor_dashborad_view.php        =
// Copyright of Fluent Technologies            =
// Displays list of patients.                  =
//==============================================
?>
<script type='text/javascript'>
function getdashboard_val(recnum)
{
    $.ajax({
        type: 'POST',
        url: "<?echo base_url() ?>doctor_ctrl/getapp_details/"+recnum,
        success:function(response){
           $('#ajax-content-container').html(response);
        }
});
}
</script>

<div class="main-container" style="margin-top:20px">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:3px 0px;"class="page-header">
</div>

<div class="row-fluid">
<div class="span8">
<div class="m-widget dashbord_box">
<div class="m-widget-header">
<h3>List of Appointments</h3>
</div>
<?php

	$curr_url = current_url() ;
    date_default_timezone_set('America/Los_Angeles');
   $dayofappt = $this->session->userdata('dayofappt');
   if ($dayofappt == 'curr')
   {
       $prevday = "Prev";
	   $nextday = "<a href=" . $curr_url ."/nextday>Next</a>";   
       //$date = date_create(date("Y-m-d"));
	   $date=date("Y-m-d");
       //date_add($date,date_interval_create_from_date_string("0 days"));
	   $new_date=strtotime("0 days", strtotime($date));
	   $thisday=date("F j, Y",$new_date);
       //$thisday = date_format(strtotime($date),"F j, Y");    
   }
   if($dayofappt == 'next')
   {
       $prevday = "<a href=" . $curr_url .">Prev</a>";
	   $nextday = "<a href=" . $curr_url ."/nextplusday>Next</a>";
	   $date=date('Y-m-d');
       //$date = date_create(date("Y-m-d"));
       //date_add($date,date_interval_create_from_date_string("1 days"));
       //$thisday = date_format($date,"F j, Y");   
	   $new_date=strtotime("+1 days", strtotime($date));
	   $thisday=date("F j, Y",$new_date);
   }
   if ($dayofappt == 'nextplus')
   {
       $prevday = "<a href=" . $curr_url ." /nextday>Prev</a>";
	   $nextday = "Next";
	   $date=date('Y-m-d');
       /*$date = date_create(date("Y-m-d"));
       date_add($date,date_interval_create_from_date_string("2 days"));
       $thisday = date_format($date,"F j, Y");    
	   */
	   $new_date=strtotime("+2 days", strtotime($date));
	   $thisday=date("F j, Y",$new_date);
   }
?>
<div class=" row-fluid">
<?
echo '<div style="float:right;margin:-25px 5px 0px 0px" class="btn-group">';
echo "$prevday&nbsp";
echo "&nbsp$nextday";
echo "</div>";
?>
<table class="m-widget dashbord_box">
<tr>
<td width='10%' nowrap>
<h1 style="font-size:14px;float:left; margin:5px 0px 0px 10px;"><?php echo $thisday;   ?></h1>
</td>
<?php
$totpendcount = 0;
if (count($totpend) > 0)
    {
		$totpendcount = $totpend->pendapptcount;
	}
$pendingappt = 0;
$confappt = 0;
$cancappt = 0;
$compappt = 0;
$waitappt = 0;

foreach($appt as $row)
{
    if ($row->status == 'Pending')
		$pendingappt += $row->apptcount;
	elseif ($row->status == 'Confirmed')
		$confappt += $row->apptcount;
	elseif ($row->status == 'Cancelled')
		$cancappt += $row->apptcount;
	elseif ($row->status == 'Completed')
		$compappt += $row->apptcount;
	elseif ($row->status == 'Waitlist')
		$waitappt += $row->apptcount;	
	else "" ;	
}
echo '<td width="90%" align="right">';
echo '<div style="margin:10px 0px 0px 0px" class="btn-group">';
echo "&nbsp&nbsp;Pending <span class=\"badge\">$pendingappt</span>";
echo "&nbsp&nbsp;Confirmed <span class=\"badge\">$confappt</span>";
echo "&nbsp&nbsp;Completed <span class=\"badge\">$compappt</span>";
echo "&nbsp&nbsp;Cancelled <span class=\"badge\">$cancappt</span>";
echo "&nbsp&nbsp;Waitlist <span class=\"badge\">$waitappt</span>";
echo "</div></td></tr></table>";
?>
</div>
<div class="row-fluid">
<table class="table table-bordered patoent_table">
<thead style="width:100%; background:#43B5CB; color:#FFF;">
<tr>
<th>Time </th>
<th>Duration (hrs)</th>
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
	    $format = '%d:%d';
        $hours = floor($row->appt_duration / 60);
        $minutes = ($row->appt_duration % 60);
        $duration=sprintf($format, $hours, $minutes);

		echo "<tr class='clickableRow' onclick='javascript:getdashboard_val($row->recnum)'>";
		echo "<td>$row->appt_time</td>";
		echo "<td>$duration</td>";
		echo "<td>$row->fullname</td>";
		echo "<td>$row->doctor</td>";
		echo "<td>$row->reason</td>";
		echo "<td>$row->status</td>";
}	
?>
</tbody>
</table>
</div>

<div id='ajax-content-container'>
</div>

<div class="clearfix"> </div>
</div>

</div>
<?
$home='';$profile='';$appts='';$msg='';$report='';
foreach($menu as $me)
{
  if($me->item_name == 'home')
	   $home=$me->item_name;
	if($me->item_name == 'profile')
	   $profile=$me->item_name;
	if($me->item_name == 'appts')
	   $appts=$me->item_name;
	if($me->item_name == 'msg')
	   $msg=$me->item_name;
	if($me->item_name == 'report')
	   $report=$me->item_name;
}
?>
<div class="span4">

<?php if($msg != '')
{ ?>
<div class="m-widget dashbord_box">
<div class="m-widget-header">
<h3>Mail Box</h3>
</div>

<div class="span2">
<div style="margin-top:0px;" class="home_icon"> <i class="fa fa-envelope-o"></i> </div> 
</div>
<div class="span9">
<div class="m-widget-body">
<table class="table table-striped table-condensed">
							 <tbody>
<tr style=" border:1px #ccc solid; padding:5px 0px;">
<td><a href="<?echo base_url()?>doctor_ctrl/messages">Inbox <span 
class="badge badge-success"><?= $count_read->count ?></span></a></td>
<td><a href="<?echo base_url()?>doctor_ctrl/messages">Priority<span 
class="badge badge-success"><?= $priority->count ?></span></a></td>
</tr>

</tbody>
</table>
</div>
</div>

<div class="clearfix"> </div>
</div>


<div class="clearfix"> </div>

<?php } ?>

<?php if($profile != '')
{ ?>

<div class="m-widget dashbord_box">
<div class="m-widget-header">
<h3>Insurance Details</h3>
</div>
<div class="span2">
<div style="margin-top:0px;" class="home_icon"> <i class="fa fa-user"></i> </div> 
</div>
<div class="span9">
<div class="m-widget-body">
<table class="table table-striped table-condensed">
<tr style=" border:1px #ccc solid; padding:5px 0px;">
	<td><a href="<?echo base_url()?>doctor_ctrl/patients/no_insurance">No Insurance  <span class="badge"><?= $no_insurance ?></span></a></td>
	<td><a href="<?echo base_url()?>doctor_ctrl/patients/insurance">Insurance <span class="badge badge-success"><?= $insurance?></span> </a></td>
	
</tr>

</tbody>
</table>
</div>
</div>
<div class="clearfix"> </div>
</div>


<div class="clearfix"> </div>
<?php } 

if($appts != ''){
?>

<div class="m-widget dashbord_box">
<div class="m-widget-header">
<h3>Appt. Requests</h3>
</div>
<div class="span2">
<div style="margin-top:0px;" class="home_icon"> <i class="fa fa-user"></i> </div> 
</div>
<div class="span9">
<div class="m-widget-body">
<table class="table table-striped table-condensed">
<tr style=" border:1px #ccc solid; padding:5px 0px;">
	<td align="center"><a href="<?echo base_url()?>doctor_ctrl/appointments">Pending <span class="badge"><?php echo count($pend_appt) ?></span></a></td>
<!--	<td><a href="appointment.html">Confirmed<span class="badge badge-success">2</span> </a></td>
	<td><a href="appointment.html">Rejected<span class="badge badge-success">2</span> </a></td>-->
</tr>

</tbody>
</table>
</div>
</div>
<div class="clearfix"> </div>
</div>


<div class="clearfix"> </div>
<?php }?>
<?php
if($report!='')
{
?>

<div class="m-widget dashbord_box">
<div class="m-widget-header">
<h3>Reports </h3>
</div>
<div class="span2">
<div style="margin-top:0px;" class="home_icon"> <i class="fa fa-file-text-o"></i> </div> 
</div>
<div class="span9">
<div class="m-widget-body">
<table class="table table-striped table-condensed">
							 <tbody>


<tr style=" border:1px #ccc solid; padding:5px 0px;">
	<td>
	
	<ul>
		   <li> <a href="report.html">Practice Health </a> 
			<li> <a href="report.html"> Patient Engagement </a> </li>
			<li> <a href="report.html">Ageing </a> </li>  
		</ul>
	
	
	
	</td> 
</tr>


</tbody>
</table>
</div>
</div>
<div class="clearfix"> </div>




</div>
<div class="clearfix"> </div>
<?php 
}
?>


</div>
</div>    





</section>
</div>

<!--    <div class="clearfix">
<div style="position:fixed; bottom:0px;" class="footer">

<span>Copyright &copy; 2014, Paperless Dentists. All Rights Reserved	Terms Of Use </span>

</div>
</div>
</body>
</html>-->
