<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 04, 2014                 =
// Filename: add_doctor.php                    =
// Copyright of Fluent Technologies            =
// Entry for new Doctor                        =
//==============================================
?>
<div class="main-container" style="margin-top:20px">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:3px 0px;"class="page-header">

</div>

<div class="row-fluid">
<div class="m-widget dashbord_box" >
<div class="m-widget-header">
<h3>Add New Doctor</h3>
</div>

<form method='POST' action="<?php echo base_url();?>admin_ctrl/enterdoctor"  name='form-horizontal2' >
<table  border=0 >
<tr><td width='50%' valign='top'>

<table class="table table-bordered"  width='100%'>
<tbody>
<tr>
<th width='20%' style='border:1px #ccc solid;'>First Name</th>
<td width='20%'  style='border:1px #ccc solid;'><input type='text'  placeholder="First Name" value=""  name='fname'></td>
<th width='10%' style='border:1px #ccc solid;'>Last Name</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Last Name" 
value=""  name='lname'></td>
</tr>

<tr>
<th width='15%' style='border:1px #ccc solid;'>Address1</th>
<td width='20%' style='border:1px #ccc solid;' ><input type='text'  placeholder="Address1" 
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
<td width='20%' style='border:1px #ccc solid;' colspan=3><input type='text'  placeholder="Zip Code" 
value=""  name='zip' id='zip' onkeyup="check4num4zip()"></td>
</tr>

<tr>
<th width='20%' style='border:1px #ccc solid;'>Phone</th>
<td style="border:1px #ccc solid;"><input name="phone1" id="phone1" type="" value="" style="margin-left:10px;width:30px;height:20px;margin-left:-3px" onkeypress="javascript:number_validation(this,1)">&nbsp;-
<input name="phone2" id="phone2" type="" value="" 
style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation(this,2)"/>&nbsp;-<input name="phone3" id="phone3" type="" value="" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation(this,3)"/>
</td>
<th width='20%' style='border:1px #ccc solid;'>Email#</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Email" 
value=""  name='email'></td>
</tr>
</table>

<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
<input type='hidden' name='clinicid' id='clinicid' value="<?echo $clinicid; ?>">
<button id='search' style="width:7%;" onclick="check_req_fields4doc()" class="btn btn-info" type="button"> 
<i></i>Submit</button>
</form>
</html>
