<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 04, 2014                 =
// Filename: add_clinic.php                    =
// Copyright of Fluent Technologies            =
// Entry for new clinic                        =
//==============================================
?>
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
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css"/>

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
function GetAllEmps(rt)
{
	var param = 'user';
	var winWidth = 300;
	var winHeight = 200;
	var winLeft = (screen.width-winWidth)/2;
	var winTop = (screen.height-winHeight)/2;
        var base_url=document.getElementById('base_url').value;
	var ind='doctor';
      $("#attachmentloader").load(base_url+"admin_ctrl/getallemp/"+ind+'/'+rt);
      document.getElementById('light').style.display='block';
      document.getElementById('fade').style.display='block';	
}
function SetEmp(emp,emparr,type) 
{
	var empdet = emparr.split("|");
	if(type == 'doctor')
	{
		document.forms[0].doctor.value = emp;
		document.forms[0].link2doctor.value = empdet[0];
	}
	else if(type == 'patient')
	{
		document.forms[0].patient.value = emp;
		document.forms[0].link2patient.value = empdet[0];
	}
	else if(type == 'clinic')
	{
		document.forms[0].clinic.value = emp;
		document.forms[0].link2clinic.value = empdet[0];
	}
}
</script>
<div class="main-container">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:3px 0px;"class="page-header">
</div>
<div class="row-fluid">
<div class="m-widget dashbord_box" >
<div class="m-widget-header">
<h3>Add New Clinic</h3>
</div>

<form method='POST' action="<?php echo base_url();?>admin_ctrl/enterclinic"  name='form-horizontal2' >
<table  border=0 >
<tr><td width='50%' valign='top'>

<table class="table table-bordered"  >
<tbody>
<tr>
<th width='20%' style='border:1px #ccc solid;'>Clinic</th>
<td width='20%' ><input type='text'  placeholder="Clinic Name" value=""  style='size=5' name='clinic'></td>
<th width='10%' style='border:1px #ccc solid;'>Location</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Clinic Location" 
value=""  name='location'></td>
</tr>

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
<td style='border:1px #ccc solid;'><input name="phone1" id="phone1" type="" value='' style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation(this,1)">&nbsp;-
<input name="phone2" id="phone2" type="" value='' style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation(this,2)"/>&nbsp;-<input name="phone3" id="phone3" type="" value='' style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation(this,3)"/>
</td>
</tr>

<tr>
<th width='20%' style='border:1px #ccc solid;'>Fax</th>
<td style='border:1px #ccc solid;'><input name="fax1" id="fax1" type="" value='' style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4fax(this,1)">&nbsp;-
<input name="fax2" id="fax2" type="" value='' style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4fax(this,2)"/>&nbsp;-<input name="fax3" id="fax3" type="" value='' style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4fax(this,3)"/>

<th width='20%' style='border:1px #ccc solid;'>Website</th>
<td width='20%' style='border:1px #ccc solid;'><input type='text'  placeholder="Website" 
value=""  name='website' id='website'></td>
</tr>
</table>

<td width='30%' valign='top'>
<table class="table table-striped table-condensed"  width='100%'>
<tr style='margin-right:30%'>
<th width=10%' style='border:1px #ccc solid;'>Sl.No</th>
<th style='border:1px #ccc solid;'>Operatory Name</th>
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
	<input type=\"text\"  placeholder='Name' value='$op'  name='$op_name' id='$op_name'></td></tr>";   
	$i++;
}
?>
</table>
</td></tr>

</table>


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
<table class="table table-striped table-condensed"  style="width:50% !important">
<tr style='margin-right:30%'>
<th width=15%' style='border:1px #ccc solid;'>Check</th>
<th style='border:1px #ccc solid;'>Menu Items</th>
</tr>
<tr style='margin-right:30%'>
<th style='border:1px #ccc solid;' ><input type="checkbox" name="home" value="home" checked onclick="return false" ></th>
<th  style='border:1px #ccc solid;'>Home</th>
</tr>
<tr style='margin-right:30%'>
<th style='border:1px #ccc solid;'><input type="checkbox" name="profile" value="profile" checked onclick="return false" ></th>
<th  style='border:1px #ccc solid;'>Profile</th>
</tr>
<tr style='margin-right:30%'>
<th style='border:1px #ccc solid;'><input type="checkbox" name="appts" value="appts" checked onclick="return false" ></th>
<th  style='border:1px #ccc solid;'>Appointments</th>
</tr>
<tr style='margin-right:30%'>
<th style='border:1px #ccc solid;'><input type="checkbox" name="msg" value="msg" ></th>
<th  style='border:1px #ccc solid;'>Messages</th>
</tr>
<tr style='margin-right:30%'>
<th style='border:1px #ccc solid;'><input type="checkbox" name="report" value="report"></th>
<th  style='border:1px #ccc solid;'>Reports</th>
</tr>
</table>
</div>


<div id="tab-2" class="tab-content">

<div class="m-widget-header">
<h3>Add New Health History</h3>
</div>
<table width='100%' border=0 >
<tbody>
<tr>
<?
$main_menu='';
$j=0;$i=0;
foreach($query as $r)
{   
if($r->type == 'health_history')
{
        $sub_rec="name_".$j;
        $grp_rec="group_".$j;
        $name="cond_".$j;
        $dispseq="dispseq_".$j;
	if($main_menu != $r->group || $main_menu == '')
	{ 
             if($i != 0)
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
 
<?$i=0; 
 if($i%2 == 0 )
	{
	  echo "</tr><tr>";
	}?>
<td width='20%'><input type="checkbox" data-attr="value" name="<?= $sub_rec ?>" id="<?= $sub_rec ?>"  value="yes" checked ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r->name ?></b></td>
 	<?	
	}
	else
	{?>
	<td width='20%'><input type="checkbox" data-attr="value" name="<?= $sub_rec ?>" id="<?= $sub_rec ?>"  value="yes" checked><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r->name ?></b></td>
	<?
	}?>
<input type='hidden' name="<?= $name ?>" id="<?= $name ?>" value="<?= $r->name ?>">
<input type='hidden' name="<?= $grp_rec ?>" id="<?= $grp_rec ?>" value="<?= $r->group ?>">
<input type='hidden' name="<?= $dispseq ?>" id="<?= $dispseq ?>" value="<?= $r->disp_seq ?>">
<?
        $main_menu=$r->group;
        $j++;
}
}
?>
<input type='hidden' name='index' id='index' value="<?= $j ?>">
</table>
</div>

<div id="tab-3" class="tab-content">
<div class="m-widget-header">
<h3>Add New Consent</h3>
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
$k=0;$i=0;
foreach($query as $r)
{   
	if($r->type == 'patient_consent')
	{  
	  $sub_rec="rec_".$k;
          $dispseq="dispseq_".$k;
          ?>	 
	  <tr>
<td valign='top'><input type="checkbox"  name="<?= $sub_rec ?>" id="<?= $sub_rec ?>"  value="yes"  ></td>
<td valign='top'><input type='text' readonly name="<?= 'name_'.$k ?>" id="<?= 'name_'.$k ?>" value="<?= $r->name ?>"></td>
<td>
<table>
<tr>
<td valign='top'><textarea name="<?= 'text_'.$k ?>" id="<?= 'text_'.$k ?>" 
rows=10 cols=30 style="background-color:#EEE;" readonly="readonly"><?= $r->consent_text ?></textarea></td>
</tr>
</table>
</td>
<?
if($r->tooth_num_flag == 'yes')
{?>
<td valign='top'><div class="control-group">
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" name="<?= 'tooth_'.$k ?>" id="<?= 'tooth_'.$k ?>" value="<?= $r->tooth_num_flag ?>" checked onclick="return false"><?= $r->tooth_num_flag  ?>
</label>
</div></td>
<?}
else
{?>
<td valign='top'><div class="control-group">
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" name="<?= 'tooth_'.$k ?>" id="<?= 'tooth_'.$k ?>" value="<?= $r->tooth_num_flag ?>" onclick="return false"><?= $r->tooth_num_flag  ?>
</label>
</div></td>
<?}
if($r->tooth_shade_flag == 'yes')
{?>
<td valign='top'><div class="control-group">
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" name="<?= 'shade_'.$k ?>" id="<?= 'shade_'.$k ?>" value="<?= $r->tooth_shade_flag ?>" checked onclick="return false"><?= $r->tooth_shade_flag  ?>
</label>
</div></td>
<?}
else
{?>
<td valign='top'><div class="control-group">
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" name="<?= 'shade_'.$k ?>" id="<?= 'shade_'.$k ?>" value="<?= $r->tooth_shade_flag ?>" onclick="return false"><?= $r->tooth_shade_flag  ?>
</label>
</div></td>
<?}
?>
<input type='hidden' name="<?= $dispseq ?>" id="<?= $dispseq ?>" value="<?= $r->disp_seq ?>">

	  </tr>
	<?	
	$k++;
  }
}
?>
<input type='hidden' name='index4consent' id='index4consent' value="<?= $k ?>">
</table>
</div>


</tbody>
</table>
<button id='search' style="width:7%;" onclick="check_req_fields4clinic()" class="btn btn-info" type="button"> 
<i></i>Submit</button>
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
</form>
</html>
