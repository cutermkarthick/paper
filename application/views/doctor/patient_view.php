<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 20, 2015                 =
// Filename: patient_view.php                  =
// Copyright of Fluent Technologies            =
// Displays patient information                =
//==============================================
?>
<!DOCTYPE html>
<html>
<head>
<body>

<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/style.css" />
<link rel="stylesheet"  href="<?echo base_url()?>signature-pad/build/jquery.signaturepad.css">
<script src="<?echo base_url()?>signature-pad/build/flashcanvas.js"></script>
<script src="<?echo base_url()?>signature-pad/build/json2.min.js"></script>
<script src="<?echo base_url()?>signature-pad/jquery.signaturepad.js"></script>
<script src="<?echo base_url()?>signature-pad/build/jquery.signaturepad.min.js"></script>

<script type='text/javascript'>
$(document).ready(function() 
{    
	$('.clickableRow').removeClass("highlight");
	<?
  	if(count($den_his)  > 0)
  	{?>	
  	    var dental_his="his_<?echo $den_his->recnum ?>";
  	    $('#'+dental_his).addClass("highlight");
  	<?}

    if(count($health_info)>0)
	  {?> 
      var health_his="hel_0";
	    $("#"+health_his).addClass("highlight");
	  <?}?>

    var parameter ="<?echo $param  ?>";
    $("#home").css({"display": "none"});
    $("#surgery").css({"display": "none"});
    $("#postsurgery").css({"display": "none"});
    $("#profile").css({"display": "none"});
    $("#dropdown1").css({"display":  "none"});
    $("#dropdown2").css({"display": "none"});
    $("#dropdown3").css({"display": "none"});

    // $("#dental_history").css({"display": "none"});

    $("#home").removeClass("active in");
    $("#profile").removeClass("active in");
    $("#surgery").removeClass("active in");
    $("#postsurgery").removeClass("active in");
    $("#dropdown1").removeClass("active in");
    $("#dropdown2").removeClass("active in");
    $("#dropdown3").removeClass("active in");

    // $("#dental_history").removeClass("active in");

    $("#home1").removeClass("active");
    $("#surgery1").removeClass("active");
    $("#postsurgery1").removeClass("active");
    $("#profile1").removeClass("active");
    $("#dropdown11").removeClass("active");
    $("#dropdown21").removeClass("active");
    $("#dropdown31").removeClass("active");

    var health_iss = document.getElementById('health_iss').value;
    if(parameter =='dropdown1')
    {
      var new_val=health_iss.replace(/\s/g, '');
      var new_match=$('#'+new_val).attr("value");

      $("#dropdown11").addClass("active");
      $("#dropdown1").addClass("active in");
      $("#dropdown1").css({"display": "inline"});

      var index=document.getElementById('index').value;
      for(var i=0;i<index;i++)
      {
        var doc_name="name_"+i;
        var chk=$("input[name="+doc_name+"]:checked").length;
        if(chk != 0)
        {
           $("input[name="+doc_name+"]").parent().css("color", "#FF0000");
        }
      }

      var offset=($("#"+new_match.replace(/\s/g, '')).offset().top-150);
      if(new_val == new_match.replace(/\s/g, ''))
    	{
        $('html,body').animate({scrollTop: offset},'slow');
    	}
    }
    else
    {
      $("#home1").addClass("active");
      $("#home").addClass("active in")
      $("#home").css({"display": "inline"});
    }

});

$(document).ready(function () 
{
  <?
  if(count($query_health) >0)
  {
  	if($query_health->signature != '')
  	{?>
  	   var sig = '<?php echo $query_health->signature ?>';
  	   $('.sigPad4doc').signaturePad({displayOnly : true}).regenerate(sig);
  		<?}	  
  }
  ?>

  $("#home").css({"display": "none"});
  $("#surgery").css({"display": "none"});
  $("#postsurgery").css({"display": "none"});
  $("#gp").css({"display": "none"});
  $("#profile").css({"display": "none"});
  $("#dropdown1").css({"display":  "none"});
  $("#dropdown2").css({"display": "none"});
  $("#dropdown3").css({"display": "none"});

  // $("#dental_history").css({"display": "none"});

  $("#home").removeClass("active in");
  $("#profile").removeClass("active in");
  $("#surgery").removeClass("active in");
  $("#postsurgery").removeClass("active in");
  $("#gp").removeClass("active in");
  $("#dropdown1").removeClass("active in");
  $("#dropdown2").removeClass("active in");
  $("#dropdown3").removeClass("active in");

  // $("#dental_history").removeClass("active in");

  $("#home1").removeClass("active");
  $("#surgery1").removeClass("active");
  $("#postsurgery1").removeClass("active");
  $("#gp1").removeClass("active");
  $("#profile1").removeClass("active");
  $("#dropdown11").removeClass("active");
  $("#dropdown21").removeClass("active");
  $("#dropdown31").removeClass("active");

  var url=(window.location.href);
  var parameter ="<? echo $param  ?>";
    if(parameter == 'home1'  || parameter == 'profile' )
    {
      
      $("#myTab li#home1").addClass("active");
      $("#home").css({"display": "inline"});
      $("#home").addClass("active in");
    }
    else if(parameter == 'profile1' )
    {
      $("#myTab li#profile1").addClass("active");
      $("#profile").css({"display":"inline"});
      $("#profile").addClass("active in"); 
    }
    else if(parameter == 'dropdown11'  || parameter == 'dropdown1' )
    {
      $("#myTab li#dropdown11").addClass("active");
  	  $("#dropdown1").css({"display" : "inline"});	
  	  $("#dropdown1").addClass("active in");
    } 
	  else if(parameter == 'dropdown21' )
    {
      $("#myTab li#dropdown21").addClass("active");
      $("#dropdown2").css({"display" : "inline"});
      $("#dropdown2").addClass("active in");
    }
    else if(parameter == 'dropdown41' )
    {
      $("#myTab li#dropdown41").addClass("active");
      $("#dental_history").css({"display" : "inline"});
      $("#dental_history").addClass("active in");
    }
	  else if(parameter == 'dropdown3' )
    {
     $("#myTab li#dropdown31").addClass("active");
     $("#dropdown3").css({"display" :"inline" });
     $("#dropdown3").addClass("active in");
    }
    else if(parameter == 'surgery1' )
    {
      $("#myTab li#surgery1").addClass("active");
      $("#surgery").css({"display" : "inline"});  
      $("#surgery").addClass("active in");
    }   
    else if(parameter == 'postsurgery1' )
    {
      $("#myTab li#postsurgery1").addClass("active");
      $("#postsurgery").css({"display" : "inline"});  
      $("#postsurgery").addClass("active in");
    }
    else if(parameter == 'gp1' || parameter == '')
    {
      $("#myTab li#gp1").addClass("active");
      $("#gp").css({"display" : "inline"});  
      $("#gp").addClass("active in");
    }

});


  var url=(window.location.href);
  var parameter ="<? echo $param  ?>";
  function getpatient_info()
  {
     // window.location="<?php echo base_url();?>doctor_ctrl/getpatient_info";
  }

  function getaccordian(divid)
  {
  	if($('#'+divid).css("display") == "inline")
  	{
  	$('#'+divid).css({"display" :"none" });
  	 $('#'+divid).removeClass("in");
  	}
  	else
  	{
  	 $('#'+divid).css({"display" :"inline" });
  	 $('#'+divid).addClass("in");
  	}
  }

  function editdentalhis_details(recnum)
  {
     $.ajax(
     {
       type: 'POST',
        url: "<?php echo base_url();?>doctor_ctrl/update_dentalhistory/"+recnum+"/"+document.forms[0].recnum.value+"/"+document.getElementById('health_iss').value,
        success:function(response)
        {
           $('#dental_historydetails').html(response);
        }
     });
  }

  function editconsent_details(recnum)
  {
     $.ajax(
     {
        type: 'POST',
        url: "<?php echo base_url();?>doctor_ctrl/update_consent/"+recnum,
        success:function(response)
        {
           $('#consent_details').html(response);
        }
     });
  }


  function getdentalhis_details(recnum)
  {
  	var dental_his='his_'+recnum;
  	var consent_his='con_'+recnum;
  	$('.clickableRow').removeClass("highlight");
  	$('#'+dental_his).addClass("highlight");
  	$('#'+consent_his).addClass("highlight");

  	var dental_history_rec=document.getElementById('dental_history_rec').value;
  	var health_iss=document.getElementById('health_iss').value;

  	  $.ajax(
  	  {
      	type: 'POST',
      	url: "<?php echo base_url();?>doctor_ctrl/dental_historydetails/"+recnum+"/"+dental_history_rec+'/'+health_iss,
    		success:function(response)
    		{
    		   $('#dental_historydetails').html(response);
    		   $('#'+dental_his).addClass("highlight");
    	           $('#'+consent_his).addClass("highlight");
    		}
  	 });
  }


    function gethealth_details(recnum,upd_num,val)
    {
    	
      var health_iss=document.getElementById('health_iss').value;
      var health_id='hel_'+val;
      $('.clickableRow').removeClass("highlight");
      $('#'+health_id).addClass("highlight");
      var med_history_rec=document.getElementById('med_history_rec').value;

      $.ajax(
      {
        type: 'POST',
        url: "<?php echo base_url();?>doctor_ctrl/gethealth_details/"+recnum+"/"+med_history_rec+"/"+upd_num+'/'+health_iss,
        success:function(response)
        {
           $('#health_details').html(response);
           $('#'+health_id).addClass("highlight");
        }
      });
    }


    function edithealth_details(recnum)
    {
      var med_history_rec=document.getElementById('med_history_rec').value;
      var health_iss=document.getElementById('health_iss').value;
       $.ajax(
       {
          type: 'POST',
          url: "<?php echo base_url();?>doctor_ctrl/edit_health_history/"+recnum+"/"+document.forms[0].recnum.value+"/"+med_history_rec+'/'+health_iss,
          success:function(response)
          {
             $('#health_details').html(response);
          }
       });
    }


    function editsurgery_details(recnum)
    {
       $.ajax(
       {
          type: 'POST',
          url: "<?php echo base_url();?>doctor_ctrl/edit_surgery_details/"+recnum,
          success:function(response)
          {
             $('#surgery_details').html(response);
          }
       });
    }


    function save_acceptedval()
    {
      document.getElementById('dental_history_accept').value='accept';
      document.forms['formdental_history'].param.value='dropdown41';
      document.forms['formdental_history'].submit();
    }


    function save_acceptedhealthval()
    {
      document.getElementById('health_history_accept').value='accept';
      document.forms['formhealth_history'].param.value='dropdown11';
      if(document.getElementById('output').value == '')
      {
        alert("Please draw your Signature");
        return false;
      }
      else
        document.forms['formhealth_history'].submit();
    }


</script> 
	
<?
$style=' ';
$formal_dentist_style=' margin-right:350px;"background-color:#DFDFDF;" readonly ;';
?>


<div class="main-container" style="margin-left: 0px;">
<div class="container-fluid">
<div style="margin-top:30px;" class="row-fluid">

<div class="m-widget-body">                                   

<ul style="margin-bottom:-1px;" class="nav nav-tabs" id="myTab">
  <li id='gp1' class="active" onclick="getPaging('#gp')"><a data-toggle="tab" href="#gp">General Practice</a></li>
  <li id='surgery1' class="" onclick="getPaging('#surgery')"><a data-toggle="tab" href="#surgery">Surgery</a></li>
  <li id='postsurgery1' class="" onclick="getPaging('#postsurgery')"><a data-toggle="tab" href="#postsurgery">Post Surgery</a></li>
  <li id='home1' class="" onclick="getPaging('#home')"><a data-toggle="tab" href="#home">Personal Info</a></li>
  <li id='profile1' class="" onclick="getPaging('#profile')"><a data-toggle="tab" href="#profile">Emergency Info</a></li>
  <li id='dropdown11' class="" onclick="getPaging('#dropdown1')"><a data-toggle="tab" href="#dropdown1">Health History</a></li>
  <li id='dropdown21' class="" onclick="getPaging('#dropdown2')"><a data-toggle="tab" href="#dropdown2">Insurance Info</a></li>
  <li id='dropdown31' class="" onclick="getPaging('#dropdown3')"><a data-toggle="tab" href="#dropdown3">Consent Info</a></li>
  
  <!-- <li id='dropdown41' class="" onclick="getPaging('#dental_history')"><a data-toggle="tab" href="#dental_history">Dental History</a></li>-->
  
</ul>
<div class="tab-content" id="myTabContent">
<?
$attr=array('class' => 'form-horizontal2','name' => 'form-horizontal2');
echo form_open_multipart('doctor_ctrl/update_profile',$attr);
?>

<div  id="home" class="tab-pane fade">
<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Personal Details </h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">

<div class="control-group">
<label class="control-label" for="inputEmail"><span class='asterisk'>*</span>Clinic :</label>
<div class="controls">
<b><?= $clinic_name ?></b>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail"><span class='asterisk'>*</span>Doctor :</label>
<div class="controls">
<b><?= $doctor_name ?></b>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Email :</label>
<div class="controls">
<?php echo form_input(array('id' => 'email', 'name' => 'email','placeholder' => 'Email','readonly' => 'readonly','style'=>$style,'value'=>"$query->email")); ?>
</div>
</div>
<input type='hidden' name='param' id='param' value=''>

<div class="control-group">
<label class="control-label" for="inputPassword">Photo: </label>
<div class="controls">
<ul class="thumbnails m-media-container">
<li class="span3">
<div class="caption">
<p style="margin-top:5px 0px;">
<?
echo '<img id="blah" src="'.$query->img_location.'">';
?>
<div class="caption">
<input type="file" name="userfile" class="ed" id="imgInp"><br/>
</div>
</p>
</div>
</li>
</ul>
</div>
</div> 


<div class="control-group">
<label class="control-label" for="inputEmail"> Name</label>
<div class="controls"> 
<?php echo form_input(array('id' => 'fname', 'name' => 'fname','placeholder' => 'Name','readonly' => 'readonly','style'=>$style,'value'=>$query->fname)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
<div class="controls">  
<?php echo form_input(array('id' => 'middle_initial', 'name' => 'middle_initial','readonly' => 'readonly','placeholder' => 'Middle Initial Or Name','style'=>$style,'value'=>$query->middle_initial)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Last Name</label>
<div class="controls">
<?php echo form_input(array('id' => 'lname', 'name' => 'lname','placeholder' => 'Last Name','readonly' => 'readonly','style'=>$style,'value'=>$query->lname)); ?>
</div>
</div>
<?
$dddob=explode('-', $query->dob );
$dob=$dddob[1].'-'.$dddob[2].'-'.$dddob[0];
?>
<?
	$dddob=explode('-', $query->dob );
	$dob=$dddob[1].'/'.$dddob[2].'/'.$dddob[0];
	$month=$dddob[1];
	$day=$dddob[2];
	?>
	<div class="control-group">
	<label class="control-label" for="inputEmail"><span class='asterisk'>*</span>Date of Birth</label>
	<div class="controls">
<table>
<tr><td>
<select name="month">
<option <?php echo (($month=='01')?"selected":"")?> value="01">January</option>
<option <?php echo (($month=='02')?"selected":"")?> value="02">February</option>
<option <?php echo (($month=='03')?"selected":"")?> value="03">March</option>
<option <?php echo (($month=='04')?"selected":"")?> value="04">April</option>
<option <?php echo (($month=='05')?"selected":"")?> value="05">May</option>
<option <?php echo (($month=='06')?"selected":"")?> value="06">June</option>
<option <?php echo (($month=='07')?"selected":"")?> value="07">July</option>
<option <?php echo (($month=='08')?"selected":"")?>  value="08">August</option>
<option <?php echo (($month=='09')?"selected":"")?> value="09">September</option>
<option <?php echo (($month=='10')?"selected":"")?> value="10">October</option>
<option <?php echo (($month=='11')?"selected":"")?> value="11">November</option>
<option <?php echo (($month=='12')?"selected":"")?> value="12">December</option>
</select>

</td>

<td  align=left  >   
<select name=dt >
<option <?php echo (($day=='01')?"selected":"")?> value="01">01</option>
<option <?php echo (($day=='02')?"selected":"")?> value="02">02</option>
<option <?php echo (($day=='03')?"selected":"")?> value="03">03</option>
<option <?php echo (($day=='04')?"selected":"")?> value="04">04</option>
<option <?php echo (($day=='05')?"selected":"")?> value="05">05</option>
<option <?php echo (($day=='06')?"selected":"")?> value="06">06</option>
<option <?php echo (($day=='07')?"selected":"")?> value="07">07</option>
<option <?php echo (($day=='08')?"selected":"")?> value="08">08</option>
<option <?php echo (($day=='09')?"selected":"")?> value="09">09</option>
<option <?php echo (($day=='10')?"selected":"")?> value="10">10</option>
<option <?php echo (($day=='11')?"selected":"")?> value="11">11</option>
<option <?php echo (($day=='12')?"selected":"")?> value="12">12</option>
<option <?php echo (($day=='13')?"selected":"")?> value="13">13</option>
<option <?php echo (($day=='14')?"selected":"")?> value="14">14</option>
<option <?php echo (($day=='15')?"selected":"")?> value="15">15</option>
<option <?php echo (($day=='16')?"selected":"")?> value="16">16</option>
<option <?php echo (($day=='17')?"selected":"")?> value="17">17</option>
<option <?php echo (($day=='18')?"selected":"")?> value="18">18</option>
<option <?php echo (($day=='19')?"selected":"")?> value="19">19</option>
<option <?php echo (($day=='20')?"selected":"")?> value="20">20</option>
<option <?php echo (($day=='21')?"selected":"")?> value="21">21</option>
<option <?php echo (($day=='22')?"selected":"")?> value="22">22</option>
<option <?php echo (($day=='23')?"selected":"")?> value="23">23</option>
<option <?php echo (($day=='24')?"selected":"")?> value="24">24</option>
<option <?php echo (($day=='25')?"selected":"")?> value="25">25</option>
<option <?php echo (($day=='26')?"selected":"")?> value="26">26</option>
<option <?php echo (($day=='27')?"selected":"")?> value="27">27</option>
<option <?php echo (($day=='28')?"selected":"")?> value="28">28</option>
<option <?php echo (($day=='29')?"selected":"")?> value="29">29</option>
<option <?php echo (($day=='30')?"selected":"")?> value="30">30</option>
<option <?php echo (($day=='31')?"selected":"")?> value="31">31</option>
</select>
</td>

<td  align=left  > 

<select name=year id="year">

<!---------this will be filled dynamically from js. added on march 26-2015-------->
<option selected value="<?= $dddob[0] ?>"><?= $dddob[0] ?></option>
</select>

</td>
</tr>
</table>

</div>

</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Gender</label>
<div class="controls">
<label class="radio inline">
<?php
if( $query->gender  == 'M' ||  $query->gender == 'm')
{?>
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" checked>
Male
</label>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false">
Female</label> 
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false">
Other</label> 
<?}
else if( $query->gender  == 'F' ||  $query->gender == 'f')
{?>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false">
Male
</label>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" checked>
Female</label> 
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" onclick="return false">
Other</label> 
<?}
else if($query->gender  == '0' ||  $query->gender == 'o')
{?>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" >
Male
</label>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>"  >
Female</label> 
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="<?= $query->gender ?>" checked>
Other</label> 

<?php
}	
else
{?>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="M">
Male
</label>
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="F" >
Female</label> 
<label class="radio inline">
<input type="radio" name="gender" id='gender' value="O">
Other</label> 	
<?php

}
?>
</div>
</div>

<h1 style="font-weight:bold">Where do you live? </h1>
<div class="clearfix">  </div>

<br>
<div class="control-group">
<label class="control-label" for="inputEmail">Address:</label>
<div class="controls">
<?php echo form_input(array('id' => 'addr', 'name' => 'addr','placeholder' => 'Address','readonly' => 'readonly','style'=>$style,'value'=>$query->addr1)); ?>
</div>
</div>



<div class="control-group">
<label class="control-label" for="inputEmail">Address2:</label>
<div class="controls">
<?php echo form_input(array('id' => 'addr2', 'name' => 'addr2','placeholder' => 'Address2','readonly' => 'readonly','style'=>$style,'value'=>$query->addr2)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">City:</label>
<div class="controls">
<?php echo form_input(array('id' => 'city', 'name' => 'city','placeholder' => 'City Name','readonly' => 'readonly','style'=>$style,'value'=>$query->city)); ?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">State:</label>
<div class="controls">  
<?php echo form_input(array('id' => 'state', 'name' => 'state','placeholder' => 'State','readonly' => 'readonly','style'=>$style,'value'=>$query->state)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Zip:</label>
<div class="controls">
<?php echo form_input(array('id' => 'zip', 'name' => 'zip','placeholder' => 'ZIP','readonly' => 'readonly','style'=>$style,'value'=>$query->zip)); ?>
</div>
</div>
<?
echo form_hidden('recnum', "$query->recnum");
$h_m=$query->home_phone;
$h=explode('-',$h_m);
$c_m=$query->cell_phone;
$c=explode('-',$c_m);
$w_m=$query->work_phone;
$w=explode('-',$w_m);

//added by udaya on July 8,2015
if(!empty($emer))
{
$e_home=$emer->home_phone;
$e_h=explode('-',$e_home);

$e_cell=$emer->cell_phone;
$e_c=explode('-',$e_cell);

$e_work=$emer->work_phone;
$e_w=explode('-',$e_work);
}
else{
	$e_h ='';
	$e_h[0] ='';
	$e_h[1] ='';
	$e_h[2] ='';
	$e_c ='';
	$e_c[0] ='';
	$e_c[1] ='';
	$e_c[2] ='';
	$e_w ='';
	$e_w[0] ='';
	$e_w[1] ='';
	$e_w[2] ='';
	
}		
		
?>


<h1 style="font-weight:bold">What is your contact Info ? </h1>
<div class="clearfix"></div>	 
<div class="alert alert-info">At least one of threee phones is required </div>
<div class="control-group">
<label class="control-label" for="inputEmail">Home Phone:</label>
<div class="controls">
<input name="home_phone1" id="home_phone1" readonly type="" value="<?=$h[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation(this,1)">&nbsp;-
<input name="home_phone2" id="home_phone2" type="" value="<?=$h[1]?>" readonly style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation(this,2)"/>&nbsp;-<input name="home_phone3" readonly id="home_phone3" type="" value="<?=$h[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation(this,3)"/>
		</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Cell Phone:</label>
<div class="controls">
<input name="cell_phone4peronal1" id="cell_phone4peronal1" type="" value="<?=$c[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4cellphone(this,1)" readonly>&nbsp;-
<input name="cell_phone4peronal2" id="cell_phone4peronal2" type="" value="<?=$c[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4cellphone(this,2)" readonly/>&nbsp;-
<input name="cell_phone4peronal3" id="cell_phone4peronal3" type="" value="<?=$c[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4cellphone(this,3)" readonly/>
		</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Work Phone:</label>
<div class="controls"> 
<input name="work_phone4peronal1" id="work_phone4peronal1" type="" value="<?=$w[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4workphone(this,1)" readonly>&nbsp;-
<input name="work_phone4peronal2" id="work_phone4peronal2" type="" value="<?=$w[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4workphone(this,2)" readonly/>&nbsp;-
<input name="work_phone4peronal3" id="work_phone4peronal3" type="" value="<?=$w[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4workphone(this,3)" readonly/>
		</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Preferred method of Contact</label>
<div class="controls">
<?php echo form_input(array('id' => 'preferred_contact_mode', 'name' => 'preferred_contact_mode','placeholder' => 'NO','readonly' => 'readonly','style'=>$style,'value'=>$query->preferred_contact_mode)); ?>		
</div>		
</div>	
</div> 

</div>
<ul class="patients_rightnav">
<li>
<!-- <div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:submitpatient_view('home1')"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div> -->
</li>
</ul>
</div>


<div id="surgery" class="tab-pane fade">
<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Patient's Surgery Details </h1>
<div>
<h1>
<!-- <img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" onclick="editsurgery_details(<?echo $recnum ?>)"> -->
</h1>
</div>
<div class="row-fluid patient_history" id='surgery_details'>

<div class="clearfix"></div>

<div style="margin-bottom:10px;" class="m-widget">
<?php
if(!empty($surgery))
{
  $surgeon_name = $surgery->surgeon_name;
  $surgery_date = $surgery->surgery_date;
  $surgery_location = $surgery->surgery_location;
  $surgeon_contact_no = $surgery->surgeon_contact_no ;
  $location_contact_no = $surgery->location_contact_no;
  $action_taken = $surgery->action_taken;
  $surgery_name = $surgery->surgery_name;
}
else
{
  $surgeon_name = '';  
  $surgery_date = '';  
  $surgery_location= '';  
  $surgeon_contact_no = ''; 
  $action_taken = ''; 
  $surgeon_name = ''; 
  $location_contact_no = ''; 
  $surgery_name = ''; 

}
?>


<div class="control-group">
<label class="control-label" for="inputPassword" style='float: left;
width:350px;  padding-top: 5px;  text-align: left;'>Name of Surgery</label>
<div class="controls">
<input type="text"  name='surgery_name' id='surgery_name' placeholder="Name" value="<?= $surgery_name ?>" style="background-color='#DFDFDF'" readonly="readonly">
</div>
</div>  

<div class="control-group">
<label class="control-label" for="inputPassword" 
style='float: left; width:350px;  padding-top: 5px;  text-align: left;'>Surgery Date</label>
<div class="controls">
<input type="text" placeholder="Name" name ='surgery_date' id='surgery_date' style="background-color='#DFDFDF'" readonly="readonly" value='<?= $surgery_date ?>'  >
</div>
</div>

<div class="clearfix"></div> 
<div class="control-group">
<label class="control-label" for="inputPassword">Surgeon </label>
<div class="controls">
<input type="text" placeholder="Surgeron Name" value="<?= $surgeon_name ?>" name='surgeon_name' id='surgeon_name' style="background-color='#DFDFDF'" readonly="readonly">
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword" 
style='float: left; width:350px;  padding-top: 5px;  text-align: left;'>Surgery Contact No.</label>
<div class="controls">
<input type="text" name="surgeon_contact_no" id="surgeon_contact_no" placeholder="Name" value='<?= $surgeon_contact_no ?>'  style="background-color='#DFDFDF'" readonly="readonly">
</div>
</div> 



<div class="control-group">
<label class="control-label" for="inputPassword">Location</label>
<div class="controls">
<input type="text" placeholder="Location of Surgery" name='surgery_location'  id='surgery_location' value="<?= $surgery_location ?>" style="background-color='#DFDFDF'" readonly="readonly">
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Location Contact No. </label>
<div class="controls">
<input type="text" placeholder="Location Contact No"  name='location_contact_no' id='location_contact_no' value="<?= $location_contact_no ?>" style="background-color='#DFDFDF'" readonly="readonly">
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Action Taken </label>
<div class="controls">
<textarea rows="5" cols=20 name='action_taken' id='action_taken' style="background-color='#DFDFDF'" readonly="readonly">
  <?=$action_taken ?>
</textarea>
</div>
</div>


<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Preparation for Surgery</h1>
<div class="clearfix"></div>

<div class="control-group">
<label class="control-label" for="inputPassword">Please adher to the following precautions prior to Surgery </label>
<div class="controls">
<textarea rows="5" cols=20 name='surgery_notes1' id='surgery_notes1' style="background-color='#DFDFDF'" readonly="readonly">
  <?php 
   foreach ($surgery_notes as $key => $value) {
    echo $value['surgery_notes']."\n";
  }
   ?>
</textarea>
</div>
</div>


</div>

</div>

<!-- <div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:submitpatient_view('profile2')"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div> -->
</li>
</ul>
</div>
</div>
</div>


<div id="postsurgery" class="tab-pane fade">
<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Patient's Post Surgery Details </h1>
<div class="clearfix"></div>

<div style="margin-bottom:10px;" class="m-widget">

<?php
if(!empty($post_surgery_notes))
{

    $notes = $post_surgery_notes->notes;
    $to_do = $post_surgery_notes->to_do;

  }
else
{
  $notes = '';  
  $to_do = '';  
  
}




?>


<div class="control-group">
<label class="control-label" for="inputPassword" style='float: left;
width:350px;  padding-top: 5px;  text-align: left;'>Post Surgery Communication (Day of Surgery) for family  </label>
<div class="controls">
<textarea rows="5" cols=20 name='notes' id='notes' readonly="readonly"><?=$notes ?></textarea>
</div> 
</div>  

<div class="control-group">
<label class="control-label" for="inputPassword" style='float: left; width:350px;  padding-top: 5px;  text-align: left;'>Post Surgery Communication To Do List(day of Surgery) for Patient </label>
<div class="controls">
<textarea rows="5" cols=20 name='to_do' id='to_do' readonly="readonly">
  <?=$to_do ?></textarea>
</div>
</div>

<div class="clearfix"></div> 
<div class="control-group">
<label class="control-label" for="inputPassword">Post Op Communication </label>
<div class="controls">
<!-- <textarea rows="5" cols=20 name='postop_day1' id='postop_day1'></textarea> -->
  <textarea rows="5" cols=20 name='postop_day1a' id='postop_day1a' style="background-color='#DFDFDF'" readonly="readonly" >
  <?php 
    foreach ($postopnotes as $key => $po_notes) {
     echo $po_notes['postop_notes']."\n";
    }
 ?></textarea>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword" 
style='float: left; width:350px;  padding-top: 5px;  text-align: left;'>Post Surgery Communication</label>
<div class="controls">
<!-- <textarea rows="5" cols=20 name='postop_day2' id='postop_day2' ></textarea> -->
<textarea rows="5" cols=20 name='postop_day2a' id='postop_day2a'  style="background-color='#DFDFDF'" readonly="readonly" >
<?php

   foreach ($postop_commnotes as $key => $pocomm_notes) {
     echo $pocomm_notes['postop_comm_notes']."\n";
    }

?></textarea>

</div>
</div> 
</div>


<ul class="patients_rightnav">
<li>
<!-- <div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:submitpatient_view('profile3')"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div> -->
</li>
</ul>

</div>
</div>


<div id="gp" class="tab-pane fade active in">
<div class="row-fluid patient_history">
<h1 style="font-weight:bold">General Practise </h1>
<div class="clearfix"></div>

<div style="margin-bottom:10px;" class="m-widget">

<?php
if(!empty($post_surgery_notes))
{

    $notes = $post_surgery_notes->notes;
    $to_do = $post_surgery_notes->to_do;

  }
else
{
  $notes = '';  
  $to_do = '';  
  
}




?>


<div class="control-group">
<label class="control-label" for="inputPassword" style='float: left;
width:350px;  padding-top: 5px;  text-align: left;'>Post Surgery Communication (Day of Surgery) for family  </label>
<div class="controls">
<textarea rows="5" cols=20 name='notes' id='notes' readonly="readonly"><?=$notes ?></textarea>
</div> 
</div>  

<div class="control-group">
<label class="control-label" for="inputPassword" style='float: left; width:350px;  padding-top: 5px;  text-align: left;'>Post Surgery Communication To Do List(day of Surgery) for Patient </label>
<div class="controls">
<textarea rows="5" cols=20 name='to_do' id='to_do' readonly="readonly">
  <?=$to_do ?></textarea>
</div>
</div>

<div class="clearfix"></div> 
<div class="control-group">
<label class="control-label" for="inputPassword">Post Op Communication </label>
<div class="controls">
<!-- <textarea rows="5" cols=20 name='postop_day1' id='postop_day1'></textarea> -->
  <textarea rows="5" cols=20 name='postop_day1a' id='postop_day1a' style="background-color='#DFDFDF'" readonly="readonly" >
  <?php 
    foreach ($postopnotes as $key => $po_notes) {
     echo $po_notes['postop_notes']."\n";
    }
 ?></textarea>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword" 
style='float: left; width:350px;  padding-top: 5px;  text-align: left;'>Post Surgery Communication</label>
<div class="controls">
<!-- <textarea rows="5" cols=20 name='postop_day2' id='postop_day2' ></textarea> -->
<textarea rows="5" cols=20 name='postop_day2a' id='postop_day2a'  style="background-color='#DFDFDF'" readonly="readonly" >
<?php

   foreach ($postop_commnotes as $key => $pocomm_notes) {
     echo $pocomm_notes['postop_comm_notes']."\n";
    }

?></textarea>

</div>
</div> 
</div>


<ul class="patients_rightnav">
<li>
<!-- <div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:submitpatient_view('profile3')"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div> -->
</li>
</ul>

</div>
</div>

<div id="profile" class="tab-pane fade">

<div class="row-fluid patient_history">

<div style="margin-bottom:10px;" class="m-widget">

<?php

if(!empty($emer))
{
$fname = $emer->fname ;
$middle_initial = $emer->middle_initial ;
$lname = $emer->lname ;
$email = $emer->email ;
$relationship = $emer->relationship ;
}
else
{
$fname ='' ;
$lname ='' ;
$middle_initial ='';  
$email ='';
$relationship='';
  
}

?>

<h1 style="font-weight:bold"> Emergency Contact Person's Details</h1>
<br>
<div class="control-group">
<label class="control-label" for="inputEmail">First Name </label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_fname', 'name' => 'emer_fname','placeholder' => 'First Name','readonly' => 'readonly','style'=>$style,'value'=>$fname)); ?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_midname', 'name' => 'emer_midname','placeholder' => 'Middle Initial Or Name','readonly' => 'readonly','style'=>$style,'value'=>$middle_initial)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Last Name</label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_lname', 'name' => 'emer_lname','placeholder' => 'Last Name','readonly' => 'readonly','style'=>$style,'value'=>$lname)); ?>
</div>
</div>



<h1 style="font-weight:bold"> Emergency Contact Person's Contact Info </h1>
<div class="alert alert-info">  At least one of three phones is required </div>
<div class="control-group">
<label class="control-label" for="inputEmail">Home phone </label>
<div class="controls">
<input name="emer_homenum1" id="emer_homenum1" type="" value="<?=$e_h[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4emer_homephone(this,1)" readonly="readonly">&nbsp;-
<input name="emer_homenum2" id="emer_homenum2" type="" value="<?=$e_h[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4emer_homephone(this,2)" readonly="readonly"/>&nbsp;-
<input name="emer_homenum3" id="emer_homenum3" type="" value="<?=$e_h[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4emer_homephone(this,3)" readonly="readonly"/>
    </div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Cell  phone</label>
<div class="controls">
  <input name="emer_cellnum1" id="emer_cellnum1" type="" value="<?=$e_c[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4emer_cellphone(this,1)" readonly="readonly">&nbsp;-
<input name="emer_cellnum2" id="emer_cellnum2" type="" value="<?=$e_c[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4emer_cellphone(this,2)" readonly="readonly"/>&nbsp;-
<input name="emer_cellnum3" id="emer_cellnum3" type="" value="<?=$e_c[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4emer_cellphone(this,3)" readonly="readonly"/>
    </div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Work phone</label>
<div class="controls"> 
<input name="emer_worknum1" id="emer_worknum1" type="" value="<?=$e_w[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4emer_workphone(this,1)" readonly="readonly">&nbsp;-
<input name="emer_worknum2" id="emer_worknum2" type="" value="<?=$e_w[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4emer_workphone(this,2)" readonly="readonly"/>&nbsp;-
<input name="emer_worknum3" id="emer_worknum3" type="" value="<?=$e_w[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4emer_workphone(this,3)" readonly="readonly"/>
    </div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Email</label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_email', 'name' => 'emer_email','placeholder' => 'Email','readonly' => 'readonly','style'=>$style,'value'=>$email)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Relationship</label>
<div class="controls">      
<?php echo form_input(array('id' => 'emer_relation', 'name' => 'emer_relation','placeholder' => 'Relationship','readonly' => 'readonly','style'=>$style,'value'=>$relationship)); ?>
</div>
</div>  
</div>

</div>

<ul class="patients_rightnav">
<li>

<!-- <div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:submitpatient_view('profile1')"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div> -->

</li>
</ul>
</div>



<div id="dropdown2" class="tab-pane fade">
<div class="row-fluid patient_history">
<div class="m-widget-body">

<?php
if(!empty($insur))
{
	$name_of_insured = $insur->name_of_insured;
	$fname = $query->fname;
	$lname = $query->lname;
	$middle_initial = $query->middle_initial ;
	$fullname = $fname ." " . $middle_initial . " ". $lname ;
	$insurance_company = $insur->insurance_company;
	$group_id = $insur->group_id;
	$member_id = $insur->member_id;
	$img1_location = $insur->img1_location;
	$img2_location = $insur->img2_location;
}
else
{
	$name_of_insured = '';
	$fname = '';	
	$lname = '';	
	$fullname = '';	
	$middle_initial = '';	
	$insurance_company ='';
	$group_id = '';
	$member_id = '';
	$img1_location ='';
	$img2_location ='';
}

?>


<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Insurance Details of  Primary Insured</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">

<div class="control-group">
<label class="control-label" for="inputPassword" style='float: left;
width:350px;  padding-top: 5px;  text-align: left;'>Name of Primary Insured</label>
<div class="controls">
<input type="text"  name='name_of_insured' id='name_of_insured' placeholder="Name" readonly="readonly" value="<?= $name_of_insured ?>" >
</div>
</div>	

<div class="control-group">
<label class="control-label" for="inputPassword" 
style='float: left; width:350px;  padding-top: 5px;  text-align: left;'>Name of the Patients</label>
<div class="controls">
<input type="text" placeholder="Name" style="background-color='#DFDFDF'" readonly="readonly" value='<?= $fullname ?>'  >
</div>
</div> 
</div> 

<div class="clearfix"></div> 
<h1 style="font-weight:bold">Primary Insurance</h1>
<div style="margin-bottom:10px;" class="m-widget">
<div class="control-group">
<label class="control-label" for="inputPassword">Insurance Company </label>
<div class="controls">
<input type="text" placeholder="Company Name" value="<?= $insurance_company ?>" readonly="readonly" name='insurance_company' id='insurance_company'>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Group ID</label>
<div class="controls">
<input type="text" placeholder="ID" name='group_id'  id='group_id' readonly="readonly" value="<?= $group_id ?>">
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Member ID </label>
<div class="controls">
<input type="text" placeholder="ID"  name='member_id' id='member_id' readonly="readonly" value="<?= $member_id ?>">
</div>
</div>

</div>

<div class="clearfix">  </div> 

<div class="well">
	 <p>Upload photos/scanned image of insurance card
</p>
	<ul class="thumbnails m-media-container">
		<li class="span3">
<?
echo '<img id="insureoneimg"  src="'.$img1_location.'">';
?>
<div class="caption">
<input type="file" name="ins1_userfile" class="" id="insureonebrowse"><br/>
<b>Upload Front</b>
</div>
</li>
<li>&nbsp;</li>
<li class="span3">
<?
echo '<img id="insuretwoimg"  src="'.$img2_location.'">';
?>
<div class="caption">
<input type="file" name="ins2_userfile" class="" id="insuretwobrowse"><br/>
<b>Upload Back</b>
</div>
</li>
	</ul>
</div>
</div></div>
</div>
<ul class="patients_rightnav">
<li>

<!-- <div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:submitpatient_view('dropdown21')"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div> -->
</li>
</ul>
</div>
</form>


<div id="dropdown1" class="tab-pane fade">
<br>
<table class="table table-bordered patient_table" style="table-layout: fixed" id='csample' width='98%' border=1>
<thead style="width:100%; background:#43B5CB; color:#FFF;">
<tr>
<th>Doctor Name</th>
<th>Physician Phone</th>
<th>Have High BP?</th>
<th>Have Low BP?</th>
</tr>
</thead>
</table>

<div width='100%' style="height:150px; overflow-x:hidden;overflow-y:scroll;border:;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>

<tbody style="width:100%;">
<?
$doctornames  = $this->doctor_model->getdocname($this->session->userdata('doctor_id'));
$dcname=$doctornames->fullname;

$i=0;
$doc='';
$medhigh_con=array();
$medlow_con=array();
$health_rec=array();

$flag=0;
$prev_upd='';
$k=0;
foreach($health as $p)
{
   $recnum=$p->health_rec;  
   
   $recnum1=$p->link2patient;  //added by udaya on July 10th
   
   if($flag == 0)
   {
      $phone=$p->physician_phone;
      $sur_done=$p->surgery_done;    
   } 
   if($p->medical_condition == 'High Blood Pressure')
   {
     $medhigh_con[$k]=$p->condition_status;
   }
   if($p->medical_condition == 'Low Blood Pressure')
   {
     $medlow_con[$k]=$p->condition_status;
   }
   $mod[$i]=$p->modified_date;
   if($p->upd_num != $prev_upd)
   {
		
          sort($medhigh_con);
          sort($medlow_con);
          $health_rec[]=$recnum;
          $upd_num[]=$p->upd_num;
	      $i++; 
          $k++; $flag=0;  
  		  
   }

   $prev_upd=$p->upd_num;
}

$medhigh_con=array_values($medhigh_con);
$medlow_con=array_values($medlow_con);

for($j=0;$j<$i;$j++)
{
   $health_id='hel_'.$j;
?>
	
	<tr id="<?= $health_id?>" class='clickableRow' 
	onclick="javascript:gethealth_details('<?echo $health_rec[$j] ?>','<?echo $upd_num[$j] ?>','<?= $j ?>')">  
	<th><?php echo $dcname?></th>
	<th><?php echo $phone?></th>
	<th><?php echo $medhigh_con[$j]?></th>
	<th><?php echo $medlow_con[$j]?></th>
    </tr>
<?}?>
</tbody>
</table>
</div>
</table>
<?
if(!empty($consent[0]))
{?>
<input name="consent_rec" id="consent_rec" type="hidden" value="<? echo $consent[0]->recnum ?>">
<?}
else
{?>
<input name="consent_rec" id="consent_rec" type="hidden" value="">
<?
}
?>
<div class="row-fluid patient_history" id='health_details'>
<?

if(count($query_health) >0)
{
	if($query_health->accept != 'accept')
	{
		
		?>
		<div>
		<h1>
	<!-- 	<img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" onclick="edithealth_details(<?echo $recnum ?>)"> -->
		</h1>
		</div>
<?
}
?>
<br>
<br>
<h1 style="font-weight:bold">Your Weight and height</h1>
<div class="clearfix">
</div>
<div style="margin-bottom:10px;" class="m-widget">
<form name="formConsent" id="formConsent" class="form-horizontal2 sigPad4doc" action="<?echo base_url()?>doctor_ctrl/gethealth_details/<?=$recnum?>" method="post" novalidate="novalidate">
<div class="control-group">
<label class="control-label" for="inputEmail">Height (in inches)</label>
<div class="controls">
<input type="text" placeholder="00" style=";background-color:#DDDDDD;" readonly="readonly"
style=";background-color:#DDDDDD;" readonly="readonly" name='height_inches' id='height_inches' value='<?= $query_health->height_inches?>'>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Weight (in pounds)</label>
<div class="controls">
<input type="text" placeholder="00" name='weight_lbs' id='weight_lbs' style=";background-color:#DDDDDD;" readonly="readonly" style=";background-color:#DDDDDD;" readonly="readonly" value='<?= $query_health->weight_lbs?>'>
</div>
</div>


<div class="clearfix">  </div> 

<h1 style="font-weight:bold">Your Health Status  </h1>

<div style="margin-bottom:10px;" class="m-widget">

<div class="control-group">
<label class="control-label" for="inputEmail"> Are you in good health</label>
<div class="controls">
<? 
if($query_health->are_you_in_good_health  == 'yes')
{?>
<label class="radio inline">
<input type="radio"  data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="yes" id="goodhealth_0" checked>
Yes
</label>					
<label class="radio inline">
<input type="radio" data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="no" id="goodhealth_1" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="yes" id="are_you_in_good_health" onclick="return false">
Yes
</label>					
<label class="radio inline">
<input type="radio" data-attr="are_you_in_good_health"  name="are_you_in_good_health" value="no" id="are_you_in_good_health" checked>
No</label>
<?}?>				

</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Are you now under the care of a physician ?</label>
<div class="controls">					
<? 
if($query_health->under_physician_care   == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="yes" id="under_physician_care" checked>
Yes
</label>					
<label class="radio inline">
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="no" id="under_physician_care" onclick="return false">
No</label>	
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="yes" id="under_physician_care" onclick="return false">
Yes
</label>					
<label class="radio inline">
<input type="radio" data-attr="under_physician_care"  name="under_physician_care" value="no" id="under_physician_care" checked>
No</label>
<?}?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Physician's Telephone</label>
<div class="controls">

<input class="input-large" type="text" placeholder="Pnone No" style=";background-color:#DDDDDD;" readonly="readonly" name='physician_phone' id='physician_phone'  value='<?=$query_health->physician_phone   ?>'>
</div>
</div>




<div class="control-group">
<label class="control-label" for="inputPassword"> Have you had any serious illness, operation or been hospitalized ? </label>
<div class="controls">
<?
if($query_health->illness_operation_hospitalized  == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='yes' checked>
Yes
</label>	

<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='no' onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='yes' onclick="return false">
Yes
</label>	

<label class="radio inline">
<input type="radio" data-attr="illness_operation_hospitalized"  name="illness_operation_hospitalized" value="radio" id="illness_operation_hospitalized" value='no' checked>
No</label>
<?}?>


</div>
</div>



</div>               	
<div class="clearfix">  </div> 

<h1 style="font-weight:bold">Do you use alcohol, tobaco, drugs?  </h1>

<div style="margin-bottom:10px;" class="m-widget">

<form class="form-horizontal2 sigPad1">
<div class="control-group">
<label class="control-label" for="inputEmail">Do you drinks alcholic beverages ? </label>
<div class="controls">
<?
if($query_health->alcoholic_consumption   == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" checked>
Yes
</label>

<label class="radio inline">
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="no" id="alcoholic_consumption" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" onclick="return false">
Yes
</label>

<label class="radio inline">
<input type="radio" data-attr="alcoholic_consumption" name="alcoholic_consumption" value="no" id="alcoholic_consumption" checked>
No</label>
<?}?>

</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">
Have you used any recreation drug in the last 6 months ?</label>
<div class="controls">
<?
if($query_health->recreation_drug_usage    == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="yes" id="recreation_drug_usage" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="no" id="recreation_drug_usage" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="yes" id="recreation_drug_usage" onclick="return false">
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="recreation_drug_usage" name="recreation_drug_usage" value="no" id="recreation_drug_usage" checked>
No</label>
<?}?>


</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">History of alcohol abuse ?</label>
<div class="controls">
<?
if($query_health->alcohol_abuse   == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="yes" id="alcohol_abuse" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="no" id="alcohol_abuse" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="yes" id="alcohol_abuse" onclick="return false">
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="alcohol_abuse" name="alcohol_abuse" value="no" id="alcohol_abuse" checked>
No</label>
<? }?>	

</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword"> 
Do you use smoke?  </label>
<div class="controls">
<?
if($query_health->smoke   == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="smoke" name="smoke" value="yes" id="smoke" checked>
Yes
</label>

<label class="radio inline">
<input type="radio" data-attr="smoke" name="smoke" value="no" id="smoke" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="smoke" name="smoke" value="yes" id="smoke" onclick="return false">
Yes
</label>

<label class="radio inline">
<input type="radio" data-attr="smoke" name="smoke" value="no" id="smoke" checked>
No</label>
<?}?>			

</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword"> 
Do you use tobacco?  </label>
<div class="controls">
<?
if($query_health->tobacco    == 'yes')
{?>
<label class="radio inline">
<input type="radio" data-attr="tobacco" name="tobacco" value="yes" id="tobacco" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="tobacco" name="tobacco" value="no" id="tobacco" onclick="return false">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" data-attr="tobacco" name="tobacco" value="yes" id="tobacco" onclick="return false">
Yes
</label>				
<label class="radio inline">
<input type="radio" data-attr="tobacco" name="tobacco" value="no" id="tobacco" checked>
No</label>
<? }?>		

</div> 
</div>




</div>
<div class="clearfix">  </div> 

<h1 style="font-weight:bold">Your medical conditionYour medical condition</h1>

<p>Have you had currently have any of the following conditions? Check the ones that are applicable<br>

<div style="margin-bottom:10px;" class="m-widget" >
<form class="form-horizontal2 sigPad1" name='formConsent1'>
<div class="control-group">
<label class="control-label">
<?
if(!empty($med_his))
{
$prev_group='';$i=0;$j=0;
?>

<table border=0>
<?php

foreach($med_his as $m)
{
        if($prev_group == '' || $prev_group != $m->group)
	{?>
           <tr><td><strong><?= $m->group ?></strong></p></td></tr>
           <?$j=0;
        }
        if($j%2 == 0)
	{
	  echo "</tr><tr>";
	}
	$m_cond=str_replace(' ', '', $m->medical_condition);
	if($m->condition_status == 'yes')
	{
?>
		<td><div class="control-group">
		<label class="control-label" style="margin-left:20px !important">
		<input type="checkbox" id="<?= $m_cond ?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>" checked onclick="return false"
 >&nbsp;&nbsp;<?= $m->medical_condition ?>
		</label>
		</div></td>
	<?
	}
	else
	{?>
		<td><div class="control-group">
		<label class="control-label" style="margin-left:20px !important">
		<input type="checkbox" id="<?= $m_cond ?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>"  onclick="return false">&nbsp;&nbsp;<?= $m->medical_condition ?>
		</label>
		</div></td>
	<?
        }?>
	<input type='hidden'  style="width:100px !important" name="group<?= $i?>" 
	value="<?= $m->group ?>" id="group<?= $i?>"
	<input type='hidden'  style="width:100px !important" name="dispseq_<?= $i?>" 
	value="<?= $i ?>" id="dispseq_<?= $i?>">
<?
        $prev_group=$m->group;
        $i++;
		$j++;
		$upd_num=$m->upd_num;
}

?>

</table>
<input type='hidden' name='index' id='index' value="<?= $i ?>">
<?php
}
?>

</div>
<div class="control-group">
<label class="control-label">

Other
</label>
<div class="controls">
<div class='radio inline'>
<input class="input-large" type="text" placeholder="..."  id='other' name='other' readonly="readonly" data-attr="other" value='<?= $query_health->other ?>' onclick="return false">
</div>
</div>  

<div class="form-group">
<label for="treatment_signature" class="control-label" style="float:left;width:25%">Your signature</label>
<div id="treatment_signature_div">
    <div class="sig sigWrapper"  style=" margin-left:380px;display:block;clear:none;width:400px">
    <div class="typed"></div>
    <canvas class="pad" width="400" height="55" readonly="readonly"></canvas>
    <input type="hidden" name="output" class="output" >
  </div>
 </div>
</div>
</div>
<?}
else
{?>
<div>
<h1>
<img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" onclick="edithealth_details(<?echo $recnum ?>)">
</h1>
</div>
<?}
if(!empty($med_his))
{?>
<input type='hidden' name='med_history_rec' id='med_history_rec'  value="<?= $upd_num; ?>">
<!--value ="<?= $upd_num; ?>" -->
<?}
else
{?>
<input type='hidden' name='med_history_rec' id='med_history_rec' value="">
<?}?>

</div>	
</div>	
</form>
</div>
</div>



<div id="dropdown3" class="tab-pane fade">
<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal100','name'=>'form-horizontal130');
echo form_open_multipart('doctor_ctrl/insert_consent',$attr);
?>

	<div class="row-fluid patient_history">
	<div class="m-widget-body">

	<div class="row-fluid patient_history">
	<h1 style="font-weight:bold">Patient Information/Informed Consent Form</h1>
	<div class="clearfix"></div>
	<div style="margin-bottom:10px;" class="m-widget">
<br>
<table class="table table-bordered patient_table" style="table-layout: fixed" id='csample' width='98%' border=1>
<thead style="width:100%; background:#43B5CB; color:#FFF;">
<tr>
<th>Doctor Name</th>
<th>Consent for</th>
<th>Patient Name</th>
<th>Consent Date</th>
</tr>
</thead>
</table>

<div width='100%' style="height:150px; overflow-x:hidden;overflow-y:scroll;border:;margin-top:-20px;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>

<tbody style="width:100%;">
<?
$i=0;


foreach($consent as $p)
{
$data=array();
$consent_id='con_'.$p->recnum;
	$data['treatment_to_be_done']='Treatment to be Done';
	$data['drugs_and_medication']='Drugs and Medication';
	$data['changes_to_treatment_plan']='Changes to treatment plan';
	$data['extraction']="Extraction";
	$data['crowns']="Crowns";
	$data['dentures']="Dentures";
	$data['endodontic_treatment']="Endodontic Treatment";
	$data['periodontal_loss']="Periodontal Loss";
	$data['fillings']="Fillings";
	$data['pedodontics']="Pedodontics";

	$date =date_format(date_create($p->date), 'M j, Y');
	?>
	<tr class='clickableRow' id="<?= $consent_id ?>"
	onclick="javascript:getdentalhis_details(<?echo $p->recnum ?>)">                                  
	<th><?php echo $p->doctor_fullname;?></th>
	<th><?php echo $p->type;?></th>
	<th><?php echo $p->patient_fullname?></th>
	<th><?php echo $date?></th>
	</tr>
	<?php
	$i++;
}
?>
</tbody>
</table>
</div>
</table>
<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal90','name'=>'form-horizontal90');
echo form_open_multipart('patient_ctrl/insert_dental_history',$attr);
?>
<div class="row-fluid patient_history" id='consent_details'>
<?
if(count($consent) > 0 )
{?>
<div><h1>
<img style='float:right;margin-right:10px' src="<?php echo base_url();?>img/edit.png" width="34" height="34" 
 onclick="javascript:editconsent_details(<?echo $query->recnum ?>)">
</h1>
</div>
<?}
else
{?>
<div><h1>
<!-- <button id='search' style="width:7%;float:right;text-align:center" onclick="javascript:editconsent_details(<?echo $query->recnum ?>)"
 class="btn  btn-info" type="button"> 
<i ></i>ADD</button> -->

</h1>
</div>
<?}?>
<br><br>

<input name="link2patient" id="link2patient" type="hidden" value="<? echo $query->recnum ?>">

	
</div>
</div>
</div>
</div>
</div>
</div>





											
</div>
</div>
</div>
</body>
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function readURLForInsureOne(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#insureoneimg').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function readURLForInsureTwo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#insuretwoimg').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){readURL(this);});
    $("#insureonebrowse").change(function(){readURLForInsureOne(this);});
    $("#insuretwobrowse").change(function(){readURLForInsureTwo(this);});


$( document ).ready(function() 
{
	var target=document.getElementById('year'); 
	var today=new Date();
	var thisyear=today.getFullYear();
	for (var y=0; y<100; y++)
	{
		target.options[y]=new Option(thisyear, thisyear);
		thisyear-=1;
	}   
	target.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true);
});

</script>
</html>

