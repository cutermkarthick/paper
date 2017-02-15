<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 05, 2014                 =
// Filename: addloc4clinic.php                 =
// Copyright of Fluent Technologies            =
// Add new location for a clinic               =
//==============================================
?>
<div class="container-fluid">
<section>
<div style=" border:0px; margin:3px 0px;"class="page-header">
</div>
<script language="javascript" src="<?php echo base_url();?>js/admin.js"></script>

<div class="row-fluid">
<div class="m-widget dashbord_box" >
<div class="m-widget-header">
<h3>Add New Location</h3>
</div>

<form method='POST' action="<?php echo base_url();?>admin_ctrl/enterclinic"  name='form-horizontal2' >
<table  border=0 >
<tr><td width='50%' valign='top'>

<table class="table table-striped table-condensed" >
<tbody>

<tr>
<th width='20%' style='border:1px #ccc solid;'>Clinic</th>
<td width='20%' ><?= $name ?></td>
<th width='10%' style='border:1px #ccc solid;'>Location</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Location" 
value=""  name='location' id='location'></td>
</tr>
<input type='hidden' value="<?echo $name ?>"  style='size=5' id='clinic' name='clinic'>
<tr>
<th width='15%' style='border:1px #ccc solid;'>Address1</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Address1" 
value=""  name='addr1'></td>
<th width='15%' style='border:1px #ccc solid;'>Address2</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Address2" 
value=""  name='addr2'></td>
</tr>


<tr>
<th width='20%' style='border:1px #ccc solid;'>City</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="City" 
value=""  name='city'></td>
<th width='10%' style='border:1px #ccc solid;'>State</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="State" 
value=""  name='state'></td>
</tr>


<tr>
<th width='20%' style='border:1px #ccc solid;'>Zip Code</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="ZipCode" 
value=""  name='zip'></td>
<th width='20%' style='border:1px #ccc solid;'>Phone</th>
<td style='border:1px #ccc solid;'><input name="phone1" id="phone1" type="" value='' style="width:30px;height:20px" onkeypress="javascript:number_validation(this,1)">&nbsp;-
<input name="phone2" id="phone2" type="" value='' style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation(this,2)"/>&nbsp;-<input name="phone3" id="phone3" type="" value='' style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation(this,3)"/>
</td>
</tr>

<tr>
<th width='20%' style='border:1px #ccc solid;'>Fax</th>
<td style='border:1px #ccc solid;'><input name="fax1" id="fax1" type="" value="" style="width:30px;height:20px" onkeypress="javascript:number_validation4fax(this,1)">&nbsp;-
<input name="fax2" id="fax2" type="" value="" 
style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4fax(this,2)"/>&nbsp;-<input name="fax3" id="fax3" type="" 
value="" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4fax(this,3)"/>
<th width='15%' style='border:1px #ccc solid;'>Website</th>
<td colspan=3 width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Website" 
value=""  name='website' id='website'>
</td>
</tr>

</table>

<td width='30%'>
<table class="table table-striped table-condensed"  width='100%'>
<tr style='margin-right:30%'>
<th width=10%' style='border:1px #ccc solid;'>Sl.No</th>
<th style='border:1px #ccc solid;' >Operatory Name</th>
<?
$i=1;
$flag=0;
$last_id=0;
while ($i<=5)
{
if($i == 1)
	  $op='OP1';
	else
	$op='';
printf('<tr bgcolor="#FFFFFF">');
		$op_name="op_name" . $i;
		$prevlinenum="prevlinenum".$i;
		$lirecnum="lirecnum".$i;
		echo form_hidden("$prevlinenum", "");
		echo form_hidden("$lirecnum", "");
	echo "<td style='border:1px #ccc solid;' width='10%' style=\"color:#333333;padding:2px\">$i</td>";
	echo "<td  style='border:1px #ccc solid;' align='center' style=\"color:#333333;padding:2px\">
<input type=\"text\"  placeholder='Name' value=\"$op\"  name='$op_name' id='$op_name'></td></tr>";   
$i++;
}
?>
</table>
</td></tr></tbody>
</table>
<button id='search' style="width:7%;" onclick="check_req_fields4clinic()" class="btn btn-info" type="button"> 
<i></i>Submit</button>
</form>
</html>
