<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 12, 2014                 =
// Filename: editdoc_details.php               =
// Copyright of Fluent Technologies            =
// Edit Doctor Details                         =
//==============================================
?>
<html>
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<link rel="stylesheet" type="text/css" href="css/meda.css" />
<div class="m-widget-header">
<h3>Edit Doctor Details</h3>
</div>

<form method='POST' action="<?php echo base_url();?>admin_ctrl/updatedoctor"  name='form-horizontal2' >
<table  border=0 >
<tr><td width='50%' valign='top'>

<table class="table table-bordered"  width='100%'>
<tbody>
<?
$prevrecnum='';$clinic='';$clinic_name='';
foreach($query as $row)
{
if($prevrecnum == '' || $row->recnum != $prevrecnum ) 
{?>
<tr>
<th width='20%' style='border:1px #ccc solid;'>First Name</th>
<td width='20%'  style='border:1px #ccc solid;'><? echo $row->fname ?></td>
<th width='10%'style='border:1px #ccc solid;'>Last Name</th>
<td width='20%'  style='border:1px #ccc solid;'><? echo $row->lname ?></td>
</tr>

<tr>
<th width='15%' style='border:1px #ccc solid;'>Address1</th>
<td width='20%'  style='border:1px #ccc solid;'><? echo $row->addr1 ?></td>
<th width='15%' style='border:1px #ccc solid;'>Address2</th>
<td width='20%'  style='border:1px #ccc solid;'><? echo $row->addr2 ?></td>
</tr>

<tr>
<th width='20%' style='border:1px #ccc solid;'>City</th>
<td width='20%'  style='border:1px #ccc solid;'><? echo $row->city ?></td>
<th width='10%' style='border:1px #ccc solid;'>State</th>
<td width='20%'  style='border:1px #ccc solid;'><? echo $row->state ?></td>
</tr>

<tr>
<th width='20%' style='border:1px #ccc solid;'>Zip Code</th>
<td width='20%'  style='border:1px #ccc solid;'><? echo $row->zip ?></td>
<?
echo form_hidden('recnum', "$row->recnum");
}
$prevrecnum=$row->recnum;
$clinic .=$row->name.",";

$h_m=$row->phone;

$h=explode('-',$h_m);

}
$clinicarr=explode(",",$clinic);
for($i=0;$i<count($clinicarr)-1;$i++)
{
if($clinicarr[$i] != '')
   $clinic_name .=$clinicarr[$i].',<br>';
}

?>
<th width='20%' style='border:1px #ccc solid;'>Clinic Names</th>
<td width='20%' style='border:1px #ccc solid;'><? echo $clinic_name ?></td>
</tr>

<tr>
<th width='20%' style="border:1px #ccc solid;">Phone</th>
<td style="border:1px #ccc solid;"><input name="phone1" id="phone1" type="" value="<?=$h[0]?>" style="margin-left:10px;width:30px;height:20px;margin-left:-3px" onkeyup="javascript:number_validation(this,1)">&nbsp;-
<input name="phone2" id="phone2" type="" value="<?=$h[1]?>" 
style="margin-left:10px;width:30px;height:20px" onkeyup="javascript:number_validation(this,2)"/>&nbsp;-<input name="phone3" id="phone3" type="" value="<?=$h[2]?>" style="margin-left:10px;width:45px;height:20px " onkeyup="javascript:number_validation(this,3)"/>
</td>
<th width='20%' style='border:1px #ccc solid;'>Email#</th>
<td width='20%' style='border:1px #ccc solid;'><? echo $row->email ?></td>
</tr>

<tr>
<th width='20%' style='border:1px #ccc solid;'>Status</th>
<td width='20%' style='border:1px #ccc solid;' colspan=3 >
<?
$options=array(
"Active"=>"Active",
"Inactive"=>'Inactive');
$attributes = 'id="status"';
echo form_dropdown('status', $options,$row->status,"select");
?>
</td>
</tr>
</table>


<button id='search' style="width:7%;" onclick="document.forms[1].submit()" class="btn btn-info" type="button"> 
<i></i>Submit</button>
</form>
</html>
