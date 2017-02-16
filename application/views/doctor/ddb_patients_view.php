<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 20, 2014                 =
// Filename: ddb_patients_view.php             =
// Copyright of Fluent Technologies            =
// Displays patient info                       =
//==============================================
?>
<div class="main-container" style="margin-top:37px">
<div class="container-fluid">
<section>
<?php
$attributes = array('class' => 'form-horizontal_4', 'name'=>'form-horizontal_4','id' => 'listappts', 'style' => 'padding-top:0px;');
echo form_open('doctor_ctrl/patients', $attributes);
?>       
<div style="margin-top:15px;" class="row-fluid">
<div class="span12 m-widget">
<div class="row-fluid">
<div style="background:#FFF;margin-top:10px; margin-bottom:10px;width:100%" class="patients_info2 span5">
<div class="input-append">
<input type="text" class="input-xlarge search-query" name='patient' value="<? echo $search_patient ?>" placeholder="First Name" size=20 style='width:20%'>
<input type="text" class="input-xlarge search-query" name='patient_lastname' value="<? echo $search_patient_lname ?>" placeholder="Last Name" size=20 style='width:20%'>
<?
$options = array(                  
                  'insurance'  => 'Insurance',
                  'no_insurance'    => 'No Insurance',
                   'all'  => 'All',
                );
$js = 'id="insurance"';
echo form_dropdown('insurance', $options, $insurance,$js);
?>

<!---------field for common search----------->


<input type="text" class="input-xlarge search-query" name='commonsearch' placeholder="Or Search anything" size=20 style='width:20%' value="<?php echo $commonsearch; ?>" >

<!---------field for common search- ends---------->
<button type="submit" class="btn" onclick='check_session()'><i class="fa fa-search"></i> Search Patients</button>
<input type='hidden' name='check_search' id='check_search' value=''>
</form>
</div>
</div>
<?php 
$flash_message=$this->session->flashdata('flashMessage');
if(isset($flash_message))
{
   echo "<div style='color:red;'>$flash_message</div>";
}
?>
<div class="control-group" style="margin-right:10px">
<ul class="patients_rightnav">
<li>
<?php
$type = $this->session->userdata('type') ; 
if($type =='doctor')
{
?>
<button id='search' style="width:7%;float:right;text-align:center" onclick='location.href="<?php echo base_url();?>doctor_ctrl/getnew_patient"'
 class="btn  btn-info" type="button"> 
<i ></i>ADD</button>
<?php } ?>
</li>
</ul>
</div>

<div class="row-fluid">
<table class="table table-bordered patient_table"
style="table-layout: fixed;width:98.8% !important;" id='csample'>
<thead style="width:100%; background:#43B5CB; color:#FFF;">
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Male/Female </th>
<th>Patient Since</th>
<th>Last Visit Date</th>
<th>Last Visit For</th>
<th>Next Visit Due</th>
<th>Insurance</th>
</tr>

</thead>
</table>
<?
$attr=array('class' => 'form-horizontal120','name' => 'form-horizontal120');
echo form_open_multipart('doctor_ctrl/patients_info',$attr);
?>

<div width='100%' style="height:500px; overflow-x:hidden;overflow-y:scroll;border:;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody style="width:100%;">
<input type='hidden' name='val' id='val' value=''>
<?php 
date_default_timezone_set('America/Los_Angeles');

if (isset($patients))
{  
$i=1;                                             
foreach($patients as $k=>$p) 
{
	if($p['next_visit_due'] != '')
$next_visit_due=date_format(date_create($p['next_visit_due']), 'M j, Y h:i a');
	else
	$next_visit_due='';
?>

	<tr onclick=
"javascript:getpatiet_id(<?= $i ?>);">     
	<th><?php echo $p['first_name'];?></th>
	<th><?php echo $p['last_name'];?></th>
	<th><?php echo $p['gender'];?></th>
	<th><?php echo $p['patient_since'];?></th>
	<th><?php echo $p['last_visit'];?></th>
	<th><?php echo $p['reason_last_visit'];?></th>
	<th><?php echo $next_visit_due;?></th>
	<th><?php echo $p['insurance'];?></th>
	<input type='hidden' name="recnum<?= $i ?>" id="recnum<?= $i ?>"  
	value="<?= $k ?>">
	</tr>  

<? $i++;
}
}?>
</tbody>
</table>
</div>



</div>






</div>

</div>
</section>




</div>
</div>
<!--    <div class="clearfix">
<div class="footer">

<span>Copyright &copy; 2014, Paperless Dentists. All Rights Reserved	Terms Of Use </span>

</div>
</div>
</body>
</html>-->
