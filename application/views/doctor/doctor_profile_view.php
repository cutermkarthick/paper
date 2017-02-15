<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 15, 2014                 =
// Filename: doctor_profile_view.php        =
// Copyright of Fluent Technologies            =
// Displays doctor profile                  =
//==============================================
?>
<div class="main-container">
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

<div class=" row-fluid">
<h1 style="float:left; margin:5px 0px 0px 10px;"><?php echo date("F j, Y");   ?></h1>
<div style="float:right" class="btn-group">

<button class="btn">Month</button>
<button class="btn">Week</button>
<button class="btn btn btn-info">Day</button>
</div>

</div>
<div class="row-fluid">
<table class="table table-bordered patoent_table">
<thead style="width:100%; background:#39F; color:#FFF;">
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
        echo "<tr><td>$row->appt_time</td>";
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
<div class="clearfix"> </div>
</div>

</div>

<div class="span4">

<div class="m-widget dashbord_box">
<div class="m-widget-header">
<h3> <a href="message.html">Mail Box</a> </h3>
</div>

<div class="span2">
<div style="margin-top:0px;" class="home_icon"> <i class="fa fa-envelope-o"></i> </div> 
</div>
<div class="span9">
<div class="m-widget-body">
<table class="table table-striped table-condensed">
							 <tbody>
<tr style=" border:1px #ccc solid; padding:5px 0px;">
<td><a href="message.html">Inbox <span class="badge">1</span></a></td>
<td><a href="message.html">Sent <span class="badge badge-success">2</span> </a></td>

</tr>

</tbody>
</table>
</div>
</div>

<div class="clearfix"> </div>
</div>


<div class="clearfix"> </div>


<div class="m-widget dashbord_box">
<div class="m-widget-header">
<h3> <a href="patients.html">New Patients</a> </h3>
</div>
<div class="span2">
<div style="margin-top:0px;" class="home_icon"> <i class="fa fa-user"></i> </div> 
</div>
<div class="span9">
<div class="m-widget-body">
<table class="table table-striped table-condensed">
<tr style=" border:1px #ccc solid; padding:5px 0px;">
	<td><a href="patients.html">No Insurance  <span class="badge">1</span></a></td>
	<td><a href="patients.html">Insurance <span class="badge badge-success">2</span> </a></td>
	
</tr>

</tbody>
</table>
</div>
</div>
<div class="clearfix"> </div>
</div>


<div class="clearfix"> </div>


<div class="m-widget dashbord_box">
<div class="m-widget-header">
<h3> <a href="appointment.html">Appt. Requests</a> </h3>
</div>
<div class="span2">
<div style="margin-top:0px;" class="home_icon"> <i class="fa fa-user"></i> </div> 
</div>
<div class="span9">
<div class="m-widget-body">
<table class="table table-striped table-condensed">
<tr style=" border:1px #ccc solid; padding:5px 0px;">
	<td><a href="appointment.html">Pending <span class="badge">1</span></a></td>
	<td><a href="appointment.html">Confirmed<span class="badge badge-success">2</span> </a></td>
	<td><a href="appointment.html">Rejected<span class="badge badge-success">2</span> </a></td>
</tr>

</tbody>
</table>
</div>
</div>
<div class="clearfix"> </div>
</div>


<div class="clearfix"> </div>
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
			<li> <a href="report.html">Aging </a> </li>  
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



</div>
</div>    





</section>
</div>
</div>
<!--    <div class="clearfix">
<div style="position:fixed; bottom:0px;" class="footer">

<span>Copyright &copy; 2014, Paperless Dentists. All Rights Reserved	Terms Of Use </span>

</div>
</div>
</body>
</html>-->
