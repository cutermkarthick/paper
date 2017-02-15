
<style>
    .black_overlay{

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
        width: 50%;
        height: 50%;
        padding: 16px;
        background-color: white;
        z-index:1051;
        overflow: auto;
    }
#close
{
float:right;
top:0px;
}
</style>
<div>

    <div id="light" class="white_content">


<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" id="close">Close</a>
<?
      $datearr = explode('-', $date);
      $d=$datearr[2];
      $m=$datearr[1];
      $y=$datearr[0];
      $x=mktime(0,0,0,$m,$d,$y);
      $ap_date=date("M j, Y",$x);
if(count($query) >0)
{?>
<h1>List of Appointments on <?= $ap_date ?></h1>
<table class="table table-bordered patient_table"> 
<tr>
<th>Time</th>
<th>Duration</th>
<th>Patient</th>
<th>Doctor</th>
<th>Purpose</th>
<th>Status</th>
</tr>
<?php 
foreach($query as $row)
{
      $format = '%d:%02d';
      $hours = floor($row->appt_duration / 60);
      $minutes = ($row->appt_duration % 60);
      $duration=sprintf($format, $hours, $minutes);
	

      $datearr1 = explode(':', $row->appt_time);
      $appt_time=$datearr1[0].":".$datearr1[1];
      echo "<tr>";
      echo "<td width='10%'>$appt_time</td>";
      echo "<td width='10%'>$duration</td>";
      echo "<td width='15%'>$row->fullname</td>";
      echo "<td width='15%'>$row->doctor</td>";
      echo "<td width='20%'>$row->reason</td>";
      echo "<td width='20%'>$row->status</td>";
}
?>
</table>
<?}
else
{?>
<h1>No Appointments on <?= $ap_date ?></h1>
<?}?>










</div>
    <div id="fade" class="black_overlay"></div>
</div>
