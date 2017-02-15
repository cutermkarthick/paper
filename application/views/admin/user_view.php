<?
//====================================================
// Author: FSI                                       =
// Date-written = Dec 16, 2014                       =
// Filename: user_view.php                           =
// Copyright of Fluent Technologies                  =
// User(Doctor/Patient based on type) view/Summary   =
//====================================================
?>
<script type='text/javascript'>
function getajaxdetails(recnum)
{
   $.ajax(
   {
        type: 'POST',
        url: "<?php echo base_url();?>admin_ctrl/getuserdetails/"+recnum,
        success:function(response)
        {
           $('#ajax-content-container').html(response);
        }
   });
}
</script>
<div class="main-container" style="margin-top:20px">
<div class="container-fluid">
<section>
<div style="border:0px; margin:3px 0px;"class="page-header">
</div>

<div class="row-fluid">
<div class="m-widget dashbord_box" >
<div class="m-widget-header" style="padding:0px">
<h3>List of Users
<button id='search' style="width:7%;float:right;" class="btn btn-info" type="button" 
onclick="window.location='<?php echo base_url()?>admin_ctrl/adduser' "> 
<i></i>NEW</button>
</h3>
</div>
<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Search User </h1>

<input type="hidden" id="clinicid" name="clinicid" value="<?php echo $clinicid?>">
<?php
$attributes = array('class' => 'form-horizontal_4', 'name'=>'form-horizontal_4','id' => 'listappts', 'style' => 'padding-top:0px;');
echo form_open('admin_ctrl/user', $attributes);
?>
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
<table class="table table-bordered patient_table" style="table-layout: fixed" id='csample'>
<tr>
<td>

<table class="table table-bordered patient_table" style="table-layout: fixed;width:98.8% !important;" id='csample' >
<tr style=" background:#39F; color:#FFF;">
<th width='25%' style='border:1px #ccc solid;color:white'>Email</th>
<th width='10%' style='border:1px #ccc solid;color:white'>Type</th>
<th width='20%' style='border:1px #ccc solid;color:white'>Doctor/Patient Name</th>
<th width='15%' style='border:1px #ccc solid;color:white'>Clinic Name</th>
<th width='20%' style='border:1px #ccc solid;color:white'>Clinic Location</th>
<th width='10%' style='border:1px #ccc solid;color:white'>Status</th>
</thead>
</tr>
</table>
<div width='100%' style="height:200px; overflow-x:hidden;overflow-y:scroll;border:1px solid #CCC ;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>
<?php  
$count=count($query);
$i=1;
foreach($query as $row)
{
$name=$row->fname." ".$row->lname;
echo "<tr style=''>";
echo "<td style='border:1px #ccc solid;' width='25%' nowrap ><a href='#' 
onclick='getajaxdetails($row->recnum)' >$row->userid</td>";
    echo "<td width='10%' style='border:1px #ccc solid;'>$row->type</td>";
 echo "<td width='20%' style='border:1px #ccc solid;'>$name</td>";
    echo "<td width='15%' style='border:1px #ccc solid;'>$row->name</td>";
echo "<td width='20%' style='border:1px #ccc solid;'>$row->site_id</td>";
echo "<td width='10%' style='border:1px #ccc solid;'>$row->status</td>";
    echo "</tr>";
$i++;
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
