	<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 09, 2014                 =
// Filename: doctor_view.php                    =
// Copyright of Fluent Technologies            =
// Displaying Doctor List                      =
//==============================================
?>
<script type='text/javascript'>
function getajaxdetails(link2clinic,clinic)
{
if(link2clinic == '')
link2clinic=0;
  $.ajax({
        type: 'POST',
        url: "<?php echo base_url();?>admin_ctrl/getmaster_meta/"+link2clinic,
        success:function(response){
           $('#ajax-content-container').html(response);
        }
});
}
</script>
<style>
.container{
			width: 'auto';
			margin: 0 auto;
		}
		ul.tabs{
			margin: 0px;
			padding: 0px;
			list-style: none;
		}
		ul.tabs li{
			background: none;
			color: #222;
			display: inline-block;
			padding: 10px 15px;
			cursor: pointer;
		}

		ul.tabs li.current{
			background: #ededed;
			color: #222;
		}

		.tab-content{
			display: none;
			background: #ededed;
			padding: 15px;
		}

		.tab-content.current{
			display: inherit;
		}

.main-container {height: auto !important;}
</style>
<div class="main-container" style="margin-top:20px">
<div class="container-fluid">

<div style="border:0px; margin:3px 0px;" class="page-header">
</div>

<div class="row-fluid">
<div class="m-widget dashbord_box" >

</h3>
<div class="m-widget-header" style="padding:0px">
<h3>Health History Meta Data
</h3>

</div>

<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Search Meta Group/Name</h1>
<?php
 $attributes = array('class' => 'form-horizontal_4', 'name'=>'form-horizontal_4','id' => 'listappts', 'style' => 'padding-top:0px;');
 echo form_open('admin_ctrl/master_health', $attributes);
?>
<div style="margin-top:0px;" class="control-group">
<div class="controls" style='margin-left:0px'>
<?php
$data = array(
	'class' => 'input-xlarge',
	'type' => "text",
	'id' => "grpname",
	'name' => "grpname",
        'value' =>"$grpname",
	'placeholder' => 'Group Name',
	'maxlength'   => '100',
        'size'        => '15',
        'style'       => 'width:20%',
);
echo form_input($data);
?>
<?php
$data = array(
	'class' => 'input-xlarge',
	'type' => "text",
	'id' => "name",
	'name' => "name",
        'value' =>"$name",
	'placeholder' => 'Name',
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
<?php echo form_close(); ?>  
<div id="attachmentloader"></div> 
<table class="table patient_table" style="table-layout: fixed" id='csample'>
<tr>
<td>
<table class="table table-bordered patient_table" style="table-layout: fixed;width:98.8% !important;" id='csample' >
<tr style=" background:#39F; color:#FFF;">
<th width='30%' style='border:1px #ccc solid;color:white'>Clinic</td>
<th width='30%' style='border:1px #ccc solid;color:white'>Group</td>
<th width='30%' style='border:1px #ccc solid;color:white'>Name</td>
<th width='20%' style='border:1px #ccc solid;color:white'>Display<br>Sequence</td>
<th width='20%' style='border:1px #ccc solid;color:white'>Status</td>
</tr>
</table>

<div width='100%' style="height:200px;
border: 1px solid #CCC; overflow-x:hidden;overflow-y:scroll;
margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>
<?php   
$prevgroup='';$prev_clinic='';
foreach($query as $row)
{
$clinic_name=($row->clinic != '')?$row->clinic:'DEFAULT';
echo "<tr>";
if($clinic_name != $prev_clinic || $prev_clinic == '')
echo "<td style='border:1px #ccc solid;' width='30%'><a href='#' onclick='getajaxdetails(\"$row->clinic_rec\",\"$row->clinic\")'>$clinic_name</td>";
else
echo "<td style='border:1px #ccc solid;' width='30%'>&nbsp;</td>";
if($row->group != $prevgroup || $prevgroup == '')
{
    echo "<td style='border:1px #ccc solid;' width='30%'>$row->group</td>";  
    echo "<td style='border:1px #ccc solid;' width='30%'>$row->name</td>";
echo "<td style='border:1px #ccc solid;' width='20%'>$row->disp_seq</td>";
    echo "<td style='border:1px #ccc solid;' width='20%'>$row->status</td>";
}
else
{
    echo "<td style='border:1px #ccc solid;' width='30%'>&nbsp;</td>";  
    echo "<td style='border:1px #ccc solid;' width='30%'>$row->name</td>";
echo "<td style='border:1px #ccc solid;' width='20%'>$row->disp_seq</td>";
    echo "<td style='border:1px #ccc solid;' width='20%'>$row->status</td>";
}?>
</tr>
<?
$prevgroup=$row->group;
$prev_clinic=$clinic_name;
}?>
</tbody>
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
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

