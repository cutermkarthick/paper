<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 09, 2014                 =
// Filename: editclinic_details.php            =
// Copyright of Fluent Technologies            =
// Edit clinic details                         =
//==============================================
?>
<html>
<head>
<script type='text/javascript'>
$(document).ready(function()
{
$('ul.tabs li').click(function(){
	var tab_id = $(this).attr('data-tab');

	$('ul.tabs li').removeClass('current');
	$('.tab-content').removeClass('current');

	$(this).addClass('current');
	$("#"+tab_id).addClass('current');
});
});
</script>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
<script language="javascript" src="<?php echo base_url();?>js/admin.js"></script>
<div class="m-widget-header">
<h3>Edit Clinic Location Details</h3>
</div>

<form method='POST' action="<?php echo base_url();?>admin_ctrl/updateclinic"  name='form-horizontal2' >
<table  border=0>
<tr><td width='50%' valign='top'>

<table class="table table-bordered" width='100%'>
<tbody>
<tr>
<th width='20%' style='border:1px #ccc solid;'>Clinic</th>
<td width='20%' style='border:1px #ccc solid;'><? echo $row->name ?></td>
<th width='10%' style='border:1px #ccc solid;'>Location</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Location" 
value="<? echo $row->site_id ?>"  name='location'></td>
</tr>

<input type='hidden'  placeholder="Clinic" value="<? echo $row->name ?>"  style='size=5' name='clinic'>
<tr>
<th width='15%' style='border:1px #ccc solid;'>Address1</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Address1" 
value="<? echo $row->addr1 ?>"  name='addr1'></td>
<th width='15%' style='border:1px #ccc solid;'>Address2</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Address2" 
value="<? echo $row->addr2 ?>"  name='addr2'></td>
</tr>


<tr>
<th width='20%' style='border:1px #ccc solid;'>City</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="City" 
value="<? echo $row->city ?>"  name='city'></td>
<th width='10%' style='border:1px #ccc solid;'>State</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="State" 
value="<? echo $row->state ?>"  name='state'></td>
</tr>
<?

if(!empty($row))
{
$h_m=$row->phone;
if($h_m !='')
{	
$h=explode('-',$h_m);
}
else
{
	$h[0] ='';
	$h[1] ='';
	$h[2] ='';
	
}
$f_m=$row->fax;
if($f_m !='')
{
$f=explode('-',$f_m);
}
else
{
	
	$f[0] ='';
	$f[1] ='';
	$f[2] ='';
}
}
else
{
	$h_m= '';
	$h[0] ='';
	$h[1] ='';
	$h[2] ='';
	$f_m= '';
	$f[0] ='';
	$f[1] ='';
	$f[2] ='';
	
}
?>

<tr>
<th width='20%' style='border:1px #ccc solid;' >Zip Code</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="ZipCode" 
value="<? echo $row->zip ?>"  name='zip'></td>
<th width='20%' style='border:1px #ccc solid;'>Phone</th>
<td style='border:1px #ccc solid;'><input name="phone1" id="phone1" type="" value="<?=$h[0]?>" style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation(this,1)">&nbsp;-
<input name="phone2" id="phone2" type="" value="<?=$h[1]?>" 
style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation(this,2)"/>&nbsp;-<input name="phone3" id="phone3" type="" value="<?=$h[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation(this,3)"/>
</td>
</tr>

<tr>
<th width='20%' style='border:1px #ccc solid;'>Fax</th>
<td style='border:1px #ccc solid;'><input name="fax1" id="fax1" type="" value="<?=$f[0]?>" style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4fax(this,1)">&nbsp;-
<input name="fax2" id="fax2" type="" value="<?= $f[1]?>" 
style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4fax(this,2)"/>&nbsp;-<input name="fax3" id="fax3" type="" 
value="<?=$f[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4fax(this,3)"/>

<th width='20%' style='border:1px #ccc solid;'>Status</th>
<td width='20%' style='border:1px #ccc solid;'>
<?
$options=array(
"Active"=>"Active",
"Inactive"=>'Inactive');
$attributes = 'id="status"';
echo form_dropdown('status', $options,$row->status,"select");
?>
</td>
</tr>

<tr>
<th width='15%' style='border:1px #ccc solid;'>Website</th>
<td colspan=3 width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Website" 
value="<? echo $row->website ?>"  name='website' id='website'>
</td>
</tr>

</table></table>

<td width='30%' valign='top'>
<table class="table table-striped table-condensed" width='100%'>
<tr style='margin-right:30%'>
<th width='10%' style='border:1px #ccc solid;'>Sl.No</th>
<th style='border:1px #ccc solid;' >Operatory Name</th>
<?
$i=1;
$flag=0;
$last_id=0;
while ($i<=5)
{
    if($flag==0)
    {
	    foreach($op_row as $op)
	    {
		printf('<tr bgcolor="#FFFFFF">');
		$op_name="op_name" . $i;
		$prevlinenum="prevlinenum".$i;
		$lirecnum="lirecnum".$i;	
               echo form_hidden("$prevlinenum", "$op->recnum");
		echo form_hidden("$lirecnum", "$op->recnum");
	echo "<td width='10%' style='border:1px #ccc solid;'>$i</td>";
	echo "<td align='center' style='border:1px #ccc solid;' ><input type=\"text\"  placeholder='Name' 
value=\"$op->opname\"  name='$op_name' id='$op_name'></td></tr>";
$i++;
$last_id=$op->recnum;
	    }
    $flag=1;
    }
if($i <= 5 )
{
printf('<tr bgcolor="#FFFFFF">');
		$op_name="op_name" . $i;
		$prevlinenum="prevlinenum".$i;
		$lirecnum="lirecnum".$i;
		echo form_hidden("$prevlinenum", "");
		echo form_hidden("$lirecnum", "");
	echo "<td width='10%' style=\"color:#333333;padding:2px;border:1px #ccc solid;\">$i</td>";
	echo "<td   align='center' style=\"color:#333333;padding:2px;border:1px #ccc solid;\">
<input type=\"text\"  placeholder='Name' value=\"\"  name='$op_name' id='$op_name'></td></tr>";   
$i++;
}
}
echo form_hidden('recnum', "$recnum");
echo form_hidden('last_id', "$last_id");
?>
</table>
</td></tr>
</td></tr>

<tr>
<td width='100%' valign='top'>

<div class="container">
<ul class="tabs">
<li class="tab-link current" data-tab="tab-1">Left Navigation Menus</li>
<li class="tab-link" data-tab="tab-2">Add New Health His</li>
<li class="tab-link" data-tab="tab-3">Add New Consent</li>
</ul>


<div id="tab-1" class="tab-content current">
<div class="m-widget-header">
<h3>Left Navigation Menus</h3>
</div>
<?
$home='';$profile='';$appts='';$msg='';$report='';
$flag=0;
if(count($menu) >0)
{
$flag=1;
foreach($menu as $m)
{
	if($m->item_name == 'home')
	   $home=$m->item_name;
	if($m->item_name == 'profile')
	   $profile=$m->item_name;
	if($m->item_name == 'appts')
	   $appts=$m->item_name;
	if($m->item_name == 'msg')
	   $msg=$m->item_name;
	if($m->item_name == 'report')
	   $report=$m->item_name;

}
}
?>
<table class="table table-striped table-condensed"  style="width:50% !important">
<tr style='margin-right:30%'>
<th width=15%' style='border:1px #ccc solid;'>Check</th>
<th style='border:1px #ccc solid;' >Menu Items</th>
</tr>

<?
if($flag == 1)
{?>
	<tr style='margin-right:30%'>
	<th style='border:1px #ccc solid;' ><input type="checkbox"  name="home" value="home" checked onclick="return false"></th>
	<th style='border:1px #ccc solid;' >Home</th>
	</tr>
	<tr style='margin-right:30%'>
	<th style='border:1px #ccc solid;' ><input type="checkbox"  name="profile" value="profile" checked onclick="return false"></th>
	<th  style='border:1px #ccc solid;' >Profile</th>
	</tr>
	<tr style='margin-right:30%'>
	<th style='border:1px #ccc solid;' ><input type="checkbox" name="appts" value="appts" <?php echo ($appts != '')?"checked":"" ?>></th>
	<th  style='border:1px #ccc solid;' >Appointments</th>
	</tr>
	<tr style='margin-right:30%'>
	<th style='border:1px #ccc solid;'><input type="checkbox" name="msg" 
	value="msg"  <?php echo ($msg != '')?"checked":"" ?>></th>
	<th  style='border:1px #ccc solid;' >Messages</th>
	</tr>

	<tr style='margin-right:30%'>
	<th style='border:1px #ccc solid;'><input type="checkbox" name="report" value="report" <?php echo ($report !='')?"checked":"" ?>></th>
	<th  style='border:1px #ccc solid;' >Reports</th>
	</tr>
<?}
else
{?>
	<tr style='margin-right:30%'>
	<th style='border:1px #ccc solid;' ><input type="checkbox"  name="home" value="home" checked onclick="return false" ></th>
	<th  style='border:1px #ccc solid;' >Home</th>
	</tr>
	<tr style='margin-right:30%'>
	<th style='border:1px #ccc solid;' ><input type="checkbox"  name="profile" value="profile" checked onclick="return false"></th>
	<th  style='border:1px #ccc solid;' >Profile</th>
	</tr>
	<tr style='margin-right:30%'>
	<th style='border:1px #ccc solid;' ><input type="checkbox" name="appts" value="appts" checked onclick="return false"></th>
	<th  style='border:1px #ccc solid;' >Appointments</th>
	</tr>
	<tr style='margin-right:30%'>
	<th style='border:1px #ccc solid;'><input type="checkbox" name="msg" 
	value="msg"  ></th>
	<th  style='border:1px #ccc solid;' >Messages</th>
	</tr>

	<tr style='margin-right:30%'>
	<th style='border:1px #ccc solid;'><input type="checkbox" name="report" value="report"  ></th>
	<th  style='border:1px #ccc solid;' >Reports</th>
	</tr>
<?
}
?>
</table>
<button id='search' style="width:7%;" onclick="check_req_fields4clinic()"  class="btn btn-info" type="button"> 
<i></i>Submit</button>
</div>

<div id="tab-2" class="tab-content">
<div class="m-widget-header">
<h3>Edit Health History</h3>
</div>
<table width='100%' border=0 >
<tbody>
<tr>
<?
$main_menu='';
$j=0;$i=0;

foreach($master_meta as $r)
{   
	$sub_rec="name_".$j;
	$grp_rec="group_".$j;
	$name="cond_".$j;
	$dispseq="dispseq_".$j;
	$grouprec="grouprec_".$j;

	if($main_menu != $r->group || $main_menu == '')
	{ 
        if($j != 0)
         { 
		$i++;
                ?>		
		<td>
		<td width='20%'><b>&nbsp;</b></td>
		</td>
	      <?
	      }?>
<tr>
<td width='20%'><b><?= $r->group ?></b></td>
</tr>    
 <?
if($r->status == 'Active')
{?>
<tr>
<td width='20%'><input type="checkbox" data-attr="value" name="<?= $sub_rec ?>" id="<?= $sub_rec ?>"  value="yes" checked ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r->name ?></b></td>
</tr> 
<?}
else
{?>
<tr>
<td width='20%'><input type="checkbox" data-attr="value" name="<?= $sub_rec ?>" id="<?= $sub_rec ?>"  value="yes"  ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r->name ?></b></td>
</tr> 
<?}?>
	<?	
	}
	else
	{
if($r->status == 'Active')
{?>		
	<tr>
	<td width='20%'><input type="checkbox" data-attr="value" name="<?= $sub_rec ?>" id="<?= $sub_rec ?>"  value="yes" checked><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r->name ?></b></td>
	</tr>
<?}
else
{?>
	<tr>
	<td width='20%'><input type="checkbox" data-attr="value" name="<?= $sub_rec ?>" id="<?= $sub_rec ?>"  value="yes" ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r->name ?></b></td>
	</tr>
<?}?>
	<?
	}?>
<input type='hidden' name="<?= $name ?>" id="<?= $name ?>" value="<?= $r->name ?>">
<input type='hidden' name="<?= $grp_rec ?>" id="<?= $grp_rec ?>" value="<?= $r->group ?>">
<input type='hidden' name="<?= $dispseq ?>" id="<?= $dispseq ?>" value="<?= $r->disp_seq ?>">
<input type='hidden' name="<?= $grouprec ?>" id="<?= $grouprec ?>" value="<?= $r->recnum ?>">
<?
        $main_menu=$r->group;
        $j++;
}
?>
<input type='hidden' name='index' id='index' value="<?= $j ?>">
</table>
<button id='search' style="width:7%;" onclick="check_req_fields4clinic()"  class="btn btn-info" type="button"> 
<i></i>Submit</button>
</div>

<div id="tab-3" class="tab-content">
<div class="m-widget-header">
<h3>Edit Consent Details</h3>
</div>
<table width='100%' border=0 >
<tbody>

<tr style="background:#39F; color:#FFF;">
<th width='10%' style='border:1px #ccc solid;color:white'>Select</th>
<th width='20%' style='border:1px #ccc solid;color:white'>Name</th>
<th width='30%' style='border:1px #ccc solid;color:white'>Consent Text</hd>
<th width='10%' style='border:1px #ccc solid;color:white'>Tooth#</th>
<th width='10%' style='border:1px #ccc solid;color:white'>Shade</th>
</tr>
<tr>
<?
$main_menu='';
$j=0;$i=0;

foreach($patient_consent as $r)
{   
$sub_rec="consentrec_".$j;
$name="consentcond_".$j;
$dispseq="consentdispseq_".$j;
?>	
<tr>
<td width='20%' valign='top'><input type="checkbox" data-attr="value" name="<?= $sub_rec ?>" id="<?= $sub_rec ?>"  value="yes" checked><b></td>
<td valign='top'><input type='text' readonly name="<?= 'consentname_'.$j ?>" id="<?= 'consentname_'.$j ?>" value="<?= $r->name ?>"></td>
<td valign='top'><textarea name="<?= 'consenttext_'.$j ?>" id="<?= 'consenttext_'.$j ?>" 
rows=10 cols=30 style="background-color:#EEE;" readonly="readonly"><?= $r->consent_text ?></textarea></td>
<?
if($r->tooth_num_flag == 'yes')
{?>
<td valign='top'><div class="control-group">
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" name="<?= 'tooth_'.$j ?>" id="<?= 'tooth_'.$j ?>" value="<?= $r->tooth_num_flag ?>" checked onclick="return false">
</label>
</div></td>
<?}
else
{?>
<td valign='top'><div class="control-group">
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" name="<?= 'tooth_'.$j ?>" id="<?= 'tooth_'.$j ?>" value="<?= $r->tooth_num_flag ?>" onclick="return false">
</label>
</div></td>
<?}?>
<?
if($r->tooth_shade_flag == 'yes')
{?>
<td valign='top'><div class="control-group">
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" name="<?= 'shade_'.$j ?>" id="<?= 'shade_'.$j ?>" value="<?= $r->tooth_shade_flag ?>" checked onclick="return false">
</label>
</div></td>
<?}
else
{?>
<td valign='top'><div class="control-group">
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" name="<?= 'shade_'.$j ?>" id="<?= 'shade_'.$j ?>" value="<?= $r->tooth_shade_flag ?>"  onclick="return false"></label>
</div></td>
<?}?>
</tr>
	
<input type='hidden' name="<?= $name ?>" id="<?= $name ?>" value="<?= $r->name ?>">
<!--<input type='hidden' name="<?= $grp_rec ?>" id="<?= $grp_rec ?>" value="<?= $r->group ?>">-->
<input type='hidden' name="<?= 'consent_rec'.$j ?>" name="<?= 'consent_rec'.$j ?>" value="<?= $r->recnum ?>">
<?
        $j++;
}
?>
<input type='hidden' name='consent_index' id='consent_index' value="<?= $j ?>">
</table>
<td valign='top'>
<table>
</div>

</table>
</tbody>

</table>

<button id='search' style="width:7%;" onclick="check_req_fields4clinic()"  class="btn btn-info" type="button"> 
<i></i>Submit</button>

</form>
</html>
