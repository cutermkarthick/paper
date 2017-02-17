<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 30, 2014                 =
// Filename: ddb_messages_view.php             =
// Copyright of Fluent Technologies            =
// Displays mails for a doctor                 =
//==============================================
?>
<div class="main-container">
<div class="container-fluid">
<section>
<div style="margin-top:10px;" class="row-fluid">
<div class="m-widget-header">
<div class="span12  sub_title">
<h1><i class="fa fa-envelope-o"></i>Messages</h1>
</div>
<?php
$attributes = array('class' => 'form-horizontal_4', 
'name'=>'form-horizontal_4','id' => 'form-horizontal_4', 'style' => 'padding-top:0px;');
echo form_open_multipart('doctor_ctrl/messages', $attributes);
?>
<input type='hidden' name='parameter' id='parameter' value="<?= $parameter ?>">
<script type='text/javascript'>
var url=(window.location.href);
function edit_mail(inb_rec,type)
{
	if(type!='sent')
	var inb_id='inb_'+inb_rec;
	else
	var inb_id='sent_'+inb_rec;

	if(inb_rec == '')
	$('#maildetails').html('');
	else
	{
var id='inb_'+inb_rec;
$('#from'+id).css("font-weight", "normal");
$('#sub'+id).css("font-weight", "normal");
$('#date'+id).css("font-weight", "normal");


	$.get("<?php echo base_url();?>doctor_ctrl/edit_mail/"+inb_rec+"/"+type, function (msg) 
		{
		   $('#maildetails').html(msg);
		});
	}  
         $('.clickableRow').removeClass("highlight");
	$('#'+inb_id).addClass("highlight");
}
function replay_mail(inb_rec,type)
{
	if(inb_rec == '')
	$('#maildetails').html('');
	else
	{
		$.get("<?php echo base_url();?>doctor_ctrl/replay_mail/"+inb_rec+"/"+type, function (msg) 
		{
		   $('#maildetails').html(msg);
		});
	}
}

$(document).ready(function() 
{
var chk4sent =  url.split('/').pop();
var parameter=document.getElementById('parameter').value;
var inb_rec=document.getElementById('inb_rec').value;
var sent_rec=document.getElementById('sent_rec').value;

if(window.location.href.indexOf("sent") > -1)
{ 
       if(sent_rec == '')
	   $('#maildetails').html('');
	else
	{
		$.get("<?php echo base_url();?>doctor_ctrl/edit_mail/"+sent_rec+"/sent", function (msg) 
		{
		   $('#maildetails').html(msg);
		});
	}
}
else
{
       if(inb_rec == '')
	   $('#maildetails').html('');
	else
	{
		$.get("<?php echo base_url();?>doctor_ctrl/edit_mail/"+inb_rec+"/inbox", function (msg) 
		{
		   $('#maildetails').html(msg);
		});
	}
}
if(parameter == 'sends')
{
             $('#home1').removeClass("active");
             $('#sent1').addClass("active");
             $("#home").css({"display": "none"});
             $("#home").removeClass("active in");
	     $("#sends").css({"display": "block"});
	     $("#sends").addClass("active in");
}   
$('#myTab li').click(function()  
{
	param=this.id;
	$("#home").css({"display": "none"});
	$("#profile").css({"display": "none"});
	$("#sends").css({"display": "none"});
          if(param == 'home1')
	   {
                 var inb_rec=document.getElementById('inb_rec').value;
		if(inb_rec == '')
		   $('#maildetails').html('');
		else
		{
			$.get("<?php echo base_url();?>doctor_ctrl/edit_mail/"+inb_rec+"/inbox", function (msg) 
				{
				   $('#maildetails').html(msg);
				});
		}
		 $("#home").css({"display": "inline"});
		 $('#home').addClass("active in");
	   }
           else if(param == 'profile1')
	   {
		 $("#profile").css({"display": "inline"});
		 $('#profile').addClass("active in");
               
	   }
           else if(param == 'sent1')
	   {
		var sent_rec=document.getElementById('sent_rec').value;
		if(sent_rec == '')
		     $('#maildetails').html('');
		else
		{
			$.get("<?php echo base_url();?>doctor_ctrl/edit_mail/"+sent_rec+"/sent", function (msg) 
			{
			   $('#maildetails').html(msg);
			});
                }
		 $("#sends").css({"display": "inline"});
		 $('#sends').addClass("active in");
	   }
})

});
function delete_sent()
{
	var r = confirm("Are you sure you want to delete!");
var sent_index=document.getElementById('sent_index').value;
	if (r == true) 
	{
		$.get("<?php echo base_url();?>doctor_ctrl/delete_email/"+sent_index, function (msg)
		{ 
		})
	}
	else
	{
	   return false;
	}
}
</script>
</div>
</div>


<div style="margin-top:9px;" class="row-fluid">
<div class="span7 m-widget">


<div style="margin-top:0px;" class="row-fluid">

<div class="m-widget-body">


<ul style="margin-bottom:-1px;" class="nav nav-tabs" id="myTab">
<li class="active" id='home1'><a data-toggle="tab" href="#home">Inbox</a></li>
<li class="" id='profile1'><a data-toggle="tab" href="#profile"> Compose</a></li> 
<li class="" id='sent1'><a data-toggle="tab" href="#sends">  Sent </a></li> 
</ul>


<div class="tab-content" id="myTabContent">
<div  id="home" class="tab-pane fade active in">
<div class="row-fluid patient_history">
<div class="container-fluid">
<section>

<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Search Mails</h1>
<div style="margin-top:0px;" class="control-group">
<div class="controls" style='margin-left:0px'>
<?php
$attributes = array('class' => 'control-label');
$data = array(
	'class' => 'input-xlarge',
	'type' => "text",
	'id' => "sender",
	'name' => "sender",
        'value' =>"$inb_sender",
	'placeholder' => 'From',
	'maxlength'   => '100',
    'size'        => '20',
 'style'       => 'width:20%',
);
echo form_input($data);
?>
&nbsp;&nbsp;
<span class="date" id="dp4"  data-date="<?= date('Y-m-d') ?>"  data-date-format="yyyy-mm-dd">
<?
$data1 = array(
	'type' => "text",
	'name' => "from_date",
	'id'  => "from_date",
	'size' => '6',	
	'placeholder' => 'From Date',
	'value' =>"$inb_fromdate",
	'style'=>'width:100px;',
);
echo form_input($data1);
?>
<span style="position:relative; left:-30px; z-index:1;margin-top:-10px " class="add-on">
		<i class="icon-th"></i>
	</span>
</span>
<span class="date" id="dp5"  data-date="<?= date('Y-m-d') ?>"  data-date-format="yyyy-mm-dd" style='margin-left:-13px'>
<?
$data2 = array(
	'type' => "text",
	'name' => "to_date",
	'id'  => "to_date",
	'size' => '6',	
	'placeholder' => 'To Date',
	'value' =>"$inb_todate",
	'style'=>'width:100px;',
);
echo form_input($data2);
?>
<span style="position:relative; left:-30px; z-index:1;margin-top:-10px " class="add-on">
		<i class="icon-th"></i>
	</span>
</span>
<input type='hidden'  name='check_search' id='check_search' value=''>
<button id='search' style="width:15%;float:right;" onclick="search_inbox()" class="btn btn-info" type="button"> 
<i></i>Search</button>
</div>  
</form>


<table class="table table-condensed ">
<?
$attributes = array('class' => 'form-horizontal1', 'name'=>'form-horizontal1',
'id' => 'form-horizontal1','style' => 'padding-top:0px;');
echo form_open_multipart('doctor_ctrl/delete_email4inb', $attributes);
?>

<thead>
<tr>
<th colspan="6">
 <div class="btn-group">
	<button class="btn" onclick="javascript:return messages_from_patient('form-horizontal1')" > <i class="fa fa-trash-o"></i>  </button> 
</div>
</th>
</tr>

<tr>
<th><input name="inb_chk" id="inb_chk" type="checkbox" value=""   onclick="getinb_value()"></th>
<td></td>
<th></th>
<th>From</th>
<th>Subject</th>
<th>Date</th>
</tr>
</thead>
<tbody>

<?
date_default_timezone_set('America/Los_Angeles');
$i=1;
$flag=0;$rec='';
foreach($query_inbox as $q)
{
	$chk="chk_inb".$i;
        $recnum="recnum_inb".$i;
	$date=date_format(date_create($q->date), 'M j, Y h:i a');
	if($flag == 0)
	{
	  $rec=$q->recnum;
	  $flag=1;
	}
	$inb_id='inb_'.$q->recnum;

	if($q->read_flag =='0')
	{
	if($q->priority_flag == '1')
	{?>
		<tr class="clickableRow" id="<?= $inb_id?>" href="javascript:edit_mail('<?= $q->recnum ?>','inbox')" >
		<th ><input name="<?= $chk ?>" id="<?= $chk ?>"  type="checkbox" value="" onclick="javscript:geteach_inbval('<?= $i ?>')"></th>
			<td><i class="fa fa-exclamation-circle"></i> </td>
				<?
			 if($q->attachment !='')
			{?>
		<th><a href="#?"><i class="fa fa-paperclip"></i></a></th>
			<?}
			else
			{?>
			<th>&nbsp;</th>
			<?}?>
			<td  style="font-weight:bold" id="from<?= $inb_id?>"><?echo  $q->from_name?></td>
			<td style="font-weight:bold" id="sub<?= $inb_id?>"><?echo  $q->subject?></td>
			<td style="font-weight:bold" id="date<?= $inb_id?>"><?echo $date ?></td>
			</tr>
	<?}
	else
	{?>
		<tr  class='clickableRow'  id="<?= $inb_id?>" href="javascript:edit_mail('<?= $q->recnum ?>','inbox')" >
			<td> <input name="<?= $chk ?>" id="<?= $chk ?>"  type="checkbox" value="" onclick="javscript:geteach_inbval('<?= $i ?>')"></td>
			<td> &nbsp;</td>
			<?
		 if($q->attachment !='')
		{?>
		<th> <a href="#?"><i class="fa fa-paperclip"></i>  </a> </th>
		<?}
		else
		{?>
		<th>&nbsp;</th>
		<?}?>
			<td id="from<?= $inb_id?>" style="font-weight:bold"><?echo  $q->from_name?></td>
			<td id="sub<?= $inb_id?>" style="font-weight:bold"><?echo  $q->subject?></td>
			<td id="date<?= $inb_id?>" style="font-weight:bold"><?echo $date ?></td>
			</tr>
	<?
	}
}
else
{
	if($q->priority_flag == '1')
		{?>
	<tr class="clickableRow" id="<?= $inb_id?>" href="javascript:edit_mail('<?= $q->recnum ?>','inbox')" >
	<th> <input name="<?= $chk ?>" id="<?= $chk ?>"  type="checkbox" value="" onclick="javscript:geteach_inbval('<?= $i ?>')"></th>
			<td> <i class="fa fa-exclamation-circle"></i> </td>
			<?
		 if($q->attachment !='')
		{?>
				<th> <a href="#?"><i class="fa fa-paperclip"></i>  </a> </th>
		<?}
		else
		{?>
		<th>&nbsp;</th>
		<?}?>
			<td id="from<?= $inb_id?>"><?echo  $q->from_name?></td>
			<td id="sub<?= $inb_id?>"><?echo  $q->subject?></td>
			<td id="date<?= $inb_id?>"><?echo $date ?></td>
			</tr>
		<?}
		else
		{?>
		<tr  class='clickableRow'  id="<?= $inb_id?>" href="javascript:edit_mail('<?= $q->recnum ?>','inbox')" >
			<td> <input name="<?= $chk ?>" id="<?= $chk ?>"  type="checkbox" value="" onclick="javscript:geteach_inbval('<?= $i ?>')"></td>
			<td> &nbsp;</td>
			<?
		if($q->attachment !='')
		{?>
<th> <a href="#?"><i class="fa fa-paperclip"></i>  </a> </th>
		<?}
		else
		{?>
		<th>&nbsp;</th>
		<?}?>
			<td id="from<?= $inb_id?>"><?echo  $q->from_name?></td>
			<td id="sub<?= $inb_id?>"><?echo  $q->subject?></td>
			<td id="date<?= $inb_id?>"><?echo $date ?></td>
			</tr>
		<?
		}?>
	<input type='hidden' name="<?= $recnum ?>" id="<?= $recnum ?>" value="<?=$q->recnum ?>">
	<?
		$i++;
}
}
?>
<input type='hidden' name='inb_index' id='inb_index' value="<?= $i ?>">
<input type='hidden' name='date_view' id='date_view' value=''>
<input type='hidden' name='sender_view' id='sender_view' value="">
<input type='hidden' name='inb_rec' id='inb_rec' value="<?echo $rec ?>">
</form>
</tbody>
<tfoot>
<tr>
<td colspan="6">
<?
if($inb_totrows > 5)
{?>
<div class="pagination">
<ul>
<?php echo $inbox_links ?>
</ul>
</div>
<?}?>

</td>
</tr>
</tfoot>
</table>
</section>
</div>

</div>
</div>


<div id="profile" class="tab-pane fade">
<?
$attributes = array('class' => 'form-horizontal', 'name'=>'form-horizontal','id' => 'form-horizontal', 'style' => 'padding-top:0px;');
echo form_open_multipart('doctor_ctrl/insert_email', $attributes);
?>
<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Compose </h1>
<div class="clearfix"></div>
<div class="span11 m-widget">

<form  style="padding-top:20px;">
<div class="control-group">
<label class="control-label" for="inputEmail">Patient:</label>
<div class="controls">
<?php
$attributes = 'id="patient_name" class="input-xlarge" 
 onchange="getpatient_name4doc(this)" ';
$patientnames  = $this->patient_model->getpatientdetails();
echo form_dropdown('patient_name', $patientnames,'',$attributes);
?>
</div> 
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Subject: </label>
<div class="controls">
<input class="input-xlarge" type="text" placeholder="Subject" name='subject' id='subject'>
</div>
</div> 


<div class="control-group">
<label class="control-label" for="inputPassword"> Attachment </label>
<input type="file" name="userfile" id="userfile" onchange="this.style.width = '200px ';"><br/>

</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Message</label>
<div class="controls">
<textarea  class="input-xlarge" placeholder="Message" name='message' id='message' rows="3"></textarea>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Priority</label>
<div class="controls">
<?
$options=array(
"0" =>'Normal',
"1"=>'Urgent');
echo form_dropdown('priority', $options,'','');
?>
</div>
</div>

<div style="margin-top:25px;" class="control-group">
<input type='hidden' name='doctor_email' id='doctor_email' 
value="<?=$this->session->userdata('userid') ?>">
<input type='hidden' name='p_name' id='p_name' value="">
<?
$doc_name  = $this->doctor_model->getdocname($this->session->userdata('doctor_id'));
?>
<input type='hidden' name='d_name' id='d_name' value="<?echo  $doc_name->fullname ?>">
<div class="controls">
<button class="btn btn-large btn-success" type="button" onclick="check_req_fields4patientemail()">
Send  </button>
</div>
</div>

</form>
</div>
</div>
</div>

<div id="sends" class="tab-pane fade">
<div class="row-fluid patient_history">
<div class="container-fluid">
<section>
<h1 style="font-weight:bold">Search Mails</h1>
<?php
$attributes = array('class' => 'form-horizontal_5', 'name'=>'form-horizontal_5','id' => 'form-horizontal_5', 'style' => 'padding-top:0px;');
echo form_open_multipart('doctor_ctrl/messages/sent', $attributes);
?>
<div style="margin-top:0px;" class="control-group">
<div class="controls" style='margin-left:0px'>
<?php
$attributes = array('class' => 'control-label');
$data = array(
	'class' => 'input-xlarge',
	'type' => "text",
	'id' => "sender_sent",
	'name' => "sender_sent",
        'value' =>"$sent_sender",
	'placeholder' => 'To',
	'maxlength'   => '100',
    'size'        => '20',
 'style'       => 'width:20%',
);
echo form_input($data);
?>
&nbsp;&nbsp;
<span class="date" id="dp6"  data-date="<?= date('Y-m-d') ?>"  data-date-format="yyyy-mm-dd">
<?
$data = array(
	'type' => "text",
	'name' => "fromdate_sent",
	'id'  => "fromdate_sent",
	'size' => '6',	
	'placeholder' => 'From Date',
	'value' =>"$sent_fromdate",
	'style'=>'width:100px;',
);
echo form_input($data);
?>
<span style="position:relative; left:-30px; z-index:1;margin-top:-10px " class="add-on">
		<i class="icon-th"></i>
	</span>
</span>
&nbsp;&nbsp;
<span class="date" id="dp7"  data-date="<?= date('Y-m-d') ?>" data-date-format="yyyy-mm-dd" style="margin-left:-25px">
<?
$data = array(
	'type' => "text",
	'name' => "todate_sent",
	'id'  => "todate_sent",
	'size' => '6',	
	'placeholder' => 'To Date',
	'value' =>"$sent_todate",
	'style'=>'width:100px;',
);
echo form_input($data);
?>
<span style="position:relative; left:-30px; z-index:1;margin-top:-10px " class="add-on">
		<i class="icon-th"></i>
	</span>
</span>
<input type='hidden'  name='check_sent' id='check_sent' value=''>
<button id='search' style="width:15%;float:right;" onclick="search_sent()" class="btn btn-info" type="button"> 
<i></i>Search</button>
</div> 
</form>
</div> 



<table class="table  table-condensed">
<?
$attributes = array('class' => 'form-horizontal2', 'name'=>'form-horizontal2',
'id' => 'form-horizontal2', 'style' => 'padding-top:0px;');
echo form_open_multipart('doctor_ctrl/delete_email', $attributes);
?>
<thead>
<tr>
<th colspan="6">
 <div class="btn-group">
	<button class="btn" onclick="javascript:return messages_from_patient('form-horizontal2')" > <i class="fa fa-trash-o"></i>  </button> 
</div>
</th>
</tr>
<tr>
<th> <input name="sent_chk" id='sent_chk' type="checkbox" value=""  onclick="getsent_value()"></th>

<td>   </td>
<th>   </th>
<th>To</th>
<th>Subject</th>
<th>Date</th>
</tr>
</thead>
<tbody>
<?
date_default_timezone_set('America/Los_Angeles');
$i=1;
$flag=0;$rec1='';
foreach($query as $q)
{
     $sent_id='sent_'.$q->recnum;
        $chk="chk_sent".$i;
        $recnum="rec_sent".$i;
	$date=date_format(date_create($q->date), 'M j, Y h:i a');
	if($flag == 0)
	{
	  $rec1=$q->recnum;
	  $flag=1;
	}  
	if($q->priority_flag == '1')
	{?>
	<tr id="<?= $sent_id?>"  class="clickableRow" href="javascript:edit_mail('<?= $q->recnum ?>','sent')" >
		<th> <input name="<?= $chk ?>" id="<?= $chk ?>"  type="checkbox" value="" onclick="geteach_sentval('<?= $i ?>')"></th>
		<td> <i class="fa fa-exclamation-circle"></i> </td>
	<?
	if($q->attachment !='')
	{?>
		<th> <a href="#?"><i class="fa fa-paperclip"></i>  </a> </th>
	<?}
	else
	{?>
	<th>&nbsp;</th>
	<?}?>
		<td><?echo $q->to_name?></td>
		<td><?echo $q->subject?></td>
		<td><?echo $date ?></td>
		</tr>	
	<?}
	else
	{?>
		<tr id="<?= $sent_id?>"  class='clickableRow' href="javascript:edit_mail('<?= $q->recnum ?>','sent')" >
		<th><input name="<?= $chk?>" id="<?= $chk?>"  type="checkbox" value="" 
	onclick="geteach_sentval('<?= $i ?>')" ></th>
	<td>&nbsp;</td>
		<?
	 if($q->attachment != '')
	{?>
			<th> <a href="#?"><i class="fa fa-paperclip"></i>  </a> </th>
	<?}
	else
	{?>
	<th>&nbsp;</th>
	<?}?>
	<td><?echo  $q->to_name?></td>
	<td><?echo  $q->subject?></td>
	<td><?echo $date ?></td>
	</tr>	
	<?
	}?>
<input type='hidden' name="<?= $recnum ?>" id="<?= $recnum ?>" value="<?= $q->recnum ?>">
<?
$i++;
}
?>
<input type='hidden' name='sent_index' id='sent_index' value="<?= $i ?>">
<input type='hidden' name='sent_rec' id='sent_rec' value="<?echo $rec1 ?>">
</div>
</tbody>
<tfoot>
</form>
<tr>
<td colspan="6">
<?
if($sent_totrows >5)
{?>
	<div class="pagination">
	<ul>
	<?php echo $sent_links ?></a></li>
	</ul>
	</div>
<?}?>



</td>
</tr>
</tfoot>
</table>
</section>
</div>

</div>
</div>
</div>
</div>
</div>


</div>
<div  class="span5 m-widget appointment_right" id='mail_details'>

<div id='maildetails'>
<div style="background:#eee; padding:10px 10px; line-height:25px; margin:0px 5px;">
<h4><strong>Mail Subject: Tooth ache </strong>  
<i style="float:right; border:1px #666 solid; padding:5px;" class="fa fa-paperclip"></i> 
</h4> 

<p> 	06:23 PM 2012-07-22</p>
</div>
<ul style="margin:8px;" class="nav nav-tabs nav-stacked">
<li>  
<h2> Hello Dr,</h2> 
<p>I'm having toothache in my right jaw. It
started last week and Do I need to come in or can you please prescribe pain
mediation?</p> 
<p>Thanks, Diane.</p>
</li>
</ul>
</div>


<div class="clearfix"> </div>
</div>

</div>

</section>
</div>
</div>
<div class="clearfix"></div>
<div class="footer">

<span>Copyright &copy; 2017, Fluentsoft Technologies. All Rights Reserved	Terms Of Use </span>

</div>

</body>
</html>
