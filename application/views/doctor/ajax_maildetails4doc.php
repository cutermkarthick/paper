<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 20, 2015                 =
// Filename: ajax_maildetais.php        =
// Copyright of Fluent Technologies            =
// Displaying reply messages                  =
//==============================================
?>
<div  class=" row-fluid">
<div class="input-append">

<div style="margin:0px 5px 10px 0px;"  class="btn-group pull-right">
<?
if($type == 'inbox')
{?>
<button tabindex="-1" class="btn" 
onclick="javascript:replay_mail('<?= $recnum ?>','<?= $type ?>')">Reply</button>
<!--<button tabindex="-1" data-toggle="dropdown" class="btn dropdown-toggle">
<span class="caret"></span>
</button> 
<ul class="dropdown-menu">
<li><a href="javascript:replay_mail('<?= $recnum ?>','<?= $type ?>')">Reply</a></li>	
</ul>-->
</div>
<?}?>
</div>
</div>

<div style="background:#eee; padding:10px 10px; line-height:25px; margin:0px 5px;">
<h4><strong>Message Subject: <?echo $row->subject?></strong>  
<?
if($row->attachment != '')
{?>
<div id="attachmentloader"></div>
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
<br>
<?php
$attributes = array('class' => 'form-horizontal_11', 'name'=>'form-horizontal_1','id' => 'form-horizontal_11', 'style' => 'padding-top:0px;');
echo form_open_multipart('doctor_ctrl/replay_msg', $attributes);


$txt='';
if($replay == 1)
{
$txt='';?>

<br>
<div class="control-group">
<input type="file" id="browse" name="userfile1" style="float:right;display: none" class='' onChange="Handlechange();" >

<input type="text" id="filename" readonly="true" style="width:150px"/>
<input type="button" value="Select Attachment" id="fakeBrowse" onclick="HandleBrowseClick();" style="margin-top:-10px;height:30px"/>
</div>


<br>
<div class="control-group">
<div>
<pre><textarea name="replay_mail" id='replay_mail' rows=10 cols=300 style="width:500px;margin-left:15px"></textarea></pre>
<br>
<button id='search' style="width:15%;float:left;margin-left:15px"
onclick="document.forms['form-horizontal_11'].submit()" class="btn btn-info" type="button"><i></i>Send</button>
<button onclick="document.getElementById('form-horizontal_11').remove();" id='clear' style="width:15%;float:left;margin-left:15px"
onclick="" class="btn btn-info" type="button"><i></i>Cancel</button>

	</div>
	</div>
<br>
<input type='hidden' name='patient_name' id='patient_name' value="<?echo $row->from_name?>">
<input type='hidden' name='patient_email' id='patient_email' value="<?echo $row->from_emailid?>">

<input type='hidden' name='d_name' id='d_name' value="<?echo $row->to_name ?>">
<input type='hidden' name='doctor_email' id='doctor_email' value="<?echo $row->to_emailid ?>">

<input type='hidden' name='subject' id='subject' value="<?echo $row->subject?>">
<input type='hidden' name='priority' id='priority' value="<?echo $row->priority_flag?>">
<input type='hidden' name='message' id='message' value="<?echo $row->message?>">
<?php
	$txt  = ">>>>>>>>>>><br>";
	$txt .= "From:".$row->from_emailid."<br>";
	$txt .="Subject:".$row->subject."<br>";
	$txt .=  $date."<br><br>";
	$txt .=$row->message."<br>";
}?>
<input type='hidden' name='attach' id='attach' value="<?echo $row->attachment?>">
<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
<input type='hidden' name='recnum' id='recnum' value="<?echo $recnum ?>">
<input type='hidden' name='type' id='type' value="<?echo $type ?>">
<input type='hidden' name='replay_msg' id='replay_msg' value="<?echo $txt ?>">
</form>
<ul style="margin:8px;" class="nav nav-tabs nav-stacked">
<?
if($replay ==1)
{?>
<li>
<p><pre><?echo $txt ?></pre></p> 
</li>
<?}
else
{?>
<li>  
<p><?echo "<pre>$row->message</pre>" ?></p> 
</li>
<?}?>
</ul>
