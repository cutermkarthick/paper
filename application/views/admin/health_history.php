<?
//====================================================
// Author: FSI                                       =
// Date-written = Feb 13, 2015                       =
// Filename: health_history.php                      =
// Copyright of Fluent Technologies                  =
// Health History for each patient view/Summary      =
//====================================================
?>
<script type='text/javascript'>
function getajaxdetails(recnum,group_recnum)
{
   $.ajax(
   {
        type: 'POST',
        url: "<?php echo base_url();?>admin_ctrl/gethealth_details/"+recnum+"/"+group_recnum,
        success:function(response)
        {
           $('#ajax-content-container').html(response);
        }
   });
}
</script>


<div class="main-container">
<div class="container-fluid">
<section>
<div style="border:0px; margin:3px 0px;"class="page-header">
</div>

<div class="row-fluid">
<div class="m-widget dashbord_box" >
<div class="m-widget-header" style="padding:0px">
<h3>List of Clinic
<button id='search' style="width:7%;float:right;" class="btn btn-info" type="button" 
onclick="window.location='<?php echo base_url()?>admin_ctrl/addhealth_history' "> 
<i></i>NEW</button>
</h3>
</div>
<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Search Clinic</h1>

<?php
$attributes = array('class' => 'form-horizontal_4', 'name'=>'form-horizontal_4','id' => 'listappts', 'style' => 'padding-top:0px;');
echo form_open('admin_ctrl/user', $attributes);
?>

<!--
<div style="margin-top:0px;" class="control-group">
<div class="controls" style='margin-left:0px'>
<?php
$data = array(
	'class' => 'input-xlarge',
	'type' => "text",
	'id' => "user_id",
	'name' => "user_id",
        'value' =>"$user_id",
	'placeholder' => 'Email',
	'maxlength'   => '100',
    'size'        => '15',
 'style'       => 'width:20%',
);
echo form_input($data);
?>
&nbsp;&nbsp;
<?php
$data = array(
	'class' => 'input-xlarge',
	'type' => "text",
	'id' => "type",
	'name' => "type",
        'value' =>"$type",
	'placeholder' => 'Type',
	'maxlength'   => '100',
        'size'        => '15',
        'style'       => 'width:20%',
);
echo form_input($data);
?>
&nbsp;&nbsp;
<?php
$data = array(
	'class' => 'input-xlarge',
	'type' => "text",
	'id' => "clinicname",
	'name' => "clinicname",
        'value' =>"$clinicname",
	'placeholder' => 'Clinic Name',
	'maxlength'   => '100',
        'size'        => '15',
        'style'       => 'width:20%',
);
echo form_input($data);
?>
&nbsp;&nbsp;
<?
$options = array(                  
                  'Active'  => 'Active',
                  'Inactive'  => 'Inactive',
                   'all'  => 'All',
                );
$js = 'id="status"';
echo form_dropdown('status', $options, $status,$js);
?>
<button id='search' style="width:7%;float:right;" onclick="document.forms['form-horizontal_4'].submit()" class="btn btn-info" type="button"> 

<i></i>Search</button>
</div>             
</div>    
-->  
<?php echo form_close(); ?>   
<table class="table table-bordered patient_table" style="table-layout: fixed" id='csample'>
<tr>
<td>

<table class="table table-bordered patient_table" style="table-layout: fixed;width:98.8% !important;" id='csample' >
<tr style=" background:#39F; color:#FFF;">
<th width='20%' style='border:1px #ccc solid;color:white'>Clinic Name</th>
<th width='30%' style='border:1px #ccc solid;color:white'>Condition Group</th>
<th width='20%' style='border:1px #ccc solid;color:white'>Condition</th>
</thead>
</tr>
</table>
<div width='100%' style="height:200px; overflow-x:hidden;overflow-y:scroll;border:1px solid #CCC ;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>
<?php  
$count=count($query);
$i=1;$prevclinic='';$mainmenu='';
foreach($query as $row)
{
echo "<tr>";
if($prevclinic == '' || $row->clinic != $prevclinic)
{
	echo "<td style='border:1px #ccc solid;' width='20%' nowrap ><a href='#' 
	onclick='getajaxdetails($row->link2clinic,$row->group_recnum)'>$row->clinic</td>";
}
else
{
        echo "<td style='border:1px #ccc solid;' width='20%' nowrap >&nbsp;</td>";
}
if($mainmenu == '' || $row->main_menu != $mainmenu)
{
   echo "<td width='30%' style='border:1px #ccc solid;'>$row->main_menu</td>";
}
else
{
   echo "<td width='30%' style='border:1px #ccc solid;'>&nbsp;</td>";
}
echo "<td width='20%' style='border:1px #ccc solid;'>
$row->sub_item</td>";

echo "</tr>";

	$i++;
$prevclinic=$row->clinic;
$mainmenu=$row->main_menu;
}
?>
</tbody>

</table>
</div>
</td></tr>
</table>

<div class="clearfix"> </div>
<div id='ajax-content-container'>
</div>
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
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
