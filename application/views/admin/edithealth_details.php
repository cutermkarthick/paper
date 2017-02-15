<?
//==============================================
// Author: FSI                                 =
// Date-written = Feb 13, 2015                 =
// Filename: edithealth_details.php            =
// Copyright of Fluent Technologies            =
// Edit Health History                         =
//==============================================
?>
<html>
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
<script language="javascript" src="<?php echo base_url();?>js/admin.js"></script>
<div class="m-widget-header">
<h3>Edit Health History Details for <?= $clinic_name->clinic_name ?></h3>
</div>

<form method='POST' action="<?php echo base_url();?>admin_ctrl/updatehealth_history"  name='form-horizontal2' >
<table  border=0>
<tr>
<td width='50%' valign='top'>

<table class="table table-bordered" width='100%'>
<tbody>
<input type='hidden'  placeholder="Clinic" value="<? echo $link2clinic?>"  style='size=5' name='link2clinic' id='link2clinic'>
<?
$main_menu='';$j=0;
foreach($query as $r)
{   
        $sub_rec="subrec_".$r->subitem_recnum;
	if($main_menu != $r->main_menu || $main_menu == '')
	{ 
             if($j != 0)
             {?>
	        <tr>
		<td width='20%'><b>&nbsp;</b></td>
		</tr>
	     <?}?>
		<tr>
		<td width='20%' ><b><?= $r->main_menu ?></b></td>
		</tr>     
	        <tr>
<td width='20%'><input type="checkbox" data-attr="value" name="<?= $sub_rec ?>" id="<?= $sub_rec ?>"  value="yes" checked ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r->sub_item ?></b></td>
		</tr> 
	<?	
	}
	else
	{?>		
	<tr>
	<td width='20%'><input type="checkbox" data-attr="value" name="<?= $sub_rec ?>" id="<?= $sub_rec ?>"  value="yes" checked><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r->sub_item ?></b></td>
	</tr>
	<?
	}
        $main_menu=$r->main_menu;
$j++;
}
?>
</table>

</tbody>
</table>
<button id='search' style="width:7%;" onclick="document.forms['form-horizontal2'].submit()"  class="btn btn-info" type="button"> 
<i></i>Submit</button>
</form>
</html>
