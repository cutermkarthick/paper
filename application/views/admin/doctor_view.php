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
function getajaxdetails(recnum)
{
  $.ajax({
        type: 'POST',
        url: "<?php echo base_url();?>admin_ctrl/getdoctordetails/"+recnum,
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
<div class="m-widget dashbord_box" >
<div class="m-widget-header" style="padding:0px">
<h3>List of Doctors 
<button id='search' style="width:7%;float:right;" class="btn btn-info" type="button" 
onclick="window.location='<?php echo base_url()?>admin_ctrl/adddoctor' "> 
<i></i>NEW</button>
</h3>
</div>


<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Search Doctors </h1>

<?php
$attributes = array('class' => 'form-horizontal_4', 'name'=>'form-horizontal_4','id' => 'listappts', 'style' => 'padding-top:0px;');
echo form_open('admin_ctrl/doctor', $attributes);
?>
<div style="margin-top:0px;" class="control-group">
<div class="controls" style='margin-left:0px'>
<?php
$data = array(
	'class' => 'input-xlarge',
	'type' => "text",
	'id' => "docname",
	'name' => "docname",
        'value' =>"$docname",
	'placeholder' => 'Doctor Name',
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
<table class="table patient_table" style="table-layout: fixed" id='csample'>
<tr>
<td>
<table class="table table-bordered patient_table" style="table-layout: fixed;width:98.8% !important;" id='csample' >
<tr style=" background:#39F; color:#FFF;">
<th width='30%' style='border:1px #ccc solid;color:white'>Name</td>
<th width='20%' style='border:1px #ccc solid;color:white'>City</td>
<th width='20%' style='border:1px #ccc solid;color:white'>State</td>
<th width='20%' style='border:1px #ccc solid;color:white'>Status</td>
<th width='20%' style='border:1px #ccc solid;color:white'>Clinic Name</td>
<th width='20%' style='border:1px #ccc solid;color:white'>Clinic Location</td>
</tr>
</table>
<div width='100%' style="height:200px;
border: 1px solid #CCC; overflow-x:hidden;overflow-y:scroll;
margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>
<?php   
$prev_clinic='';
foreach($query as $row)
{
echo "<tr>";
    $name=$row->fname.' '.$row->lname;
	$clinic_name = $row->name ;
	$clinic_name  = wordwrap($clinic_name, 15, "<br>\n");
if($name!= $prev_clinic || $prev_clinic == '')
{
    echo "<td style='border:1px #ccc solid;' width='30%'><a href='#' onclick='getajaxdetails($row->recnum)'>$name</td>";
    echo "<td style='border:1px #ccc solid;' width='20%'>$row->city</td>";
    echo "<td style='border:1px #ccc solid;' width='20%'>$row->state</td>";
    echo "<td style='border:1px #ccc solid;' width='20%'>$row->status</td>";
    echo "<td style='border:1px #ccc solid;' width='20%' nowrap>$clinic_name</td>";
    echo "<td style='border:1px #ccc solid;' width='20%' nowrap>$row->site_id</td>";
}
else
{
echo "<td style='border:1px #ccc solid;' width='30%' colspan=4>&nbsp;</td>";
echo "<td style='border:1px #ccc solid;' width='20%' nowrap>$row->name</td>";
 echo "<td style='border:1px #ccc solid;' width='20%' nowrap>$row->site_id</td>";
    echo "</tr>";
}
$prev_clinic=$row->fname.' '.$row->lname;
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
