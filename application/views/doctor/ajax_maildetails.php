<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 05, 2015                 =
// Filename: ajax_maildetails.php              =
// Copyright of Fluent Technologies            =
// Displaying the  mail details                  =
//==============================================
?>
<div  class=" row-fluid">
<div class="input-append">

<div style="margin:0px 5px 10px 0px;"  class="btn-group pull-right">
<?
if($replay == 0)
{?>
	<button tabindex="-1" class="btn" onclick="javascript:replay_mail('<?= $recnum ?>','<?= $type ?>')">Reply</button>

	<!--<button tabindex="-1" data-toggle="dropdown" class="btn dropdown-toggle">
	<span class="caret"></span>
	</button> 
	<ul class="dropdown-menu">
	<li><a href="javascript:replay_mail('<?= $recnum ?>','<?= $type ?>')">Reply</a></li>	
	</ul>
-->
	</div>
<?}?>
</div>
</div>

<div style="background:#eee; padding:10px 10px; line-height:25px; margin:0px 5px;">
<h4><strong>Message Subject: <?echo $row->subject?></strong>  
<?
if($row->attachment != '')
{?>
<a href='#' onclick='javscript:getattachment_details()'><i style="float:right; border:1px #666 solid; padding:5px;" class="fa fa-paperclip">
</i></a>
<?
}?>
</h4> 
<?
date_default_timezone_set('America/Los_Angeles');
$date=date_format(date_create($row->date), 'M j, Y h:i a');
?>
<p><?= $date ?></p>
</div>
<?php
$attributes = array('class' => 'form-horizontal_11', 'name'=>'form-horizontal_1','id' => 'form-horizontal_11', 'style' => 'padding-top:0px;');
echo form_open('patient_ctrl/replay_msg', $attributes);

$txt='';
if($replay == 1)
{
$txt='';?>
<br>
<div class="control-group">
<div>
<textarea name="replay_mail" id='replay_mail' rows=10 cols=350 style="width:350px;margin-left:15px"></textarea>
<br>
<button id='search' style="width:15%;float:left;margin-left:15px"
onclick="document.forms['form-horizontal_11'].submit()" class="btn btn-info" type="button"><i></i>Send</button>
	</div>
	</div>
	<br>
	<?
	$txt = ">>>>>>>>>>><br>";
	$txt .= "From:".$row->from_emailid."<br>";
	$txt .="Subject:".$row->subject."<br>";
	$txt .=  $date."<br>";
	$txt .="Hello ".$row->to_name."<br>";
	$txt .=$row->message."<br>";
}?>
<input type='hidden' name='attach' id='attach' value="<?echo $row->attachment?>">
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
<input type='hidden' name='replay_msg' id='replay_msg' value="<?echo $txt ?>">
<input type='hidden' name='recnum' id='recnum' value="<?echo $recnum ?>">
<input type='hidden' name='type' id='type' value="<?echo $type ?>">
</form>
<ul style="margin:8px;" class="nav nav-tabs nav-stacked">
<li>  
<h2> Hello <?= $row->to_name ?>,</h2> 
<p><?echo $row->message ?></p> 
<p>Thanks, <?= $row->from_name ?>.</p>
</li>
</ul>
<?

?>
