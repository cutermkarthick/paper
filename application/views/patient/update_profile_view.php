<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 18, 2014                 =
// Filename: update_profile_view.php           =
// Copyright of Fluent Technologies            =
// updating patient info                       =
//==============================================
?>
<!doctype html>
<html>
<head>
<title>paperlessdentists</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<link rel="stylesheet" type="text/css" href="css/meda.css" />
<script type='text/javascript' src='https://www.google.com/jsapi'></script>

<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>

<script type="text/javascript" src="./js/chart.js"></script>
<script type='text/javascript'>
var url=(window.location.href);
var parameter = "<?echo $param  ?>";

$(document).ready(function () 
{
document.getElementById('param').value=parameter;
$('#myTab li').click(function()  
{
$("#home").css({"display": "none"});
$("#profile").css({"display": "none"});
$("#dropdown1").css({"display":  "none"});
$("#dropdown2").css({"display": "none"});
$("#dropdown3").css({"display": "none"});

param=this.id;
if(param == 'home1')
{
$("#home").css({"display": "block"});
$('#home').addClass('active in');
}
else if(param == 'profile1')
{
$("#profile").css({"display": "block"});
$('#profile').addClass('active in');
}
else if(param == 'dropdown11')
{
$("#dropdown1").css({"display": "block"});
$('#dropdown1').addClass('active in');
}
else if(param == 'dropdown21')
{
$("#dropdown2").css({"display": "block"});
$('#dropdown2').addClass('active in');
}
else if(param == 'familymember')
{
$("#dropdown3").css({"display": "block"});
$('#dropdown3').addClass('active in');
}      
});

$("#myTab li#home1").removeClass("active");
$("#home").css({"display": "none"});
$("#profile").css({"display": "none"});
$("#dropdown1").css({"display":  "none"});
$("#dropdown2").css({"display": "none"});
$("#dropdown3").css({"display": "none"});

if(parameter == 'home1'  || parameter == 'profile' || parameter == '')
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
else if(parameter == 'dropdown11' )
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
else if(parameter == 'familymember' )
{
$("#myTab li#familymember").addClass("active");
$("#dropdown3").css({"display" :"inline" });
$("#dropdown3").addClass("active in");
} 
$('html, body').animate({ scrollTop: 0 }, 20);	
});

function switcher()
{
  var img;
  img=document.getElementbyId('img_switcher');
}
function getparam_value(param)
{
  document.forms['form-hor150'].param.value=param;
  document.forms['form-hor150'].submit();
}
</script>

<link rel="stylesheet" type="text/css" href="css/font_awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font_awesome/css/font-awesome.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
</head>
<body>
<?
$attr1 = array('class' => 'form-hor150','name'=>'form-hor150','id'=>'form-hor150');
echo form_open_multipart('patient_ctrl/update_profile', $attr1);
?>
<input type='hidden' name='param' id='param' value=''>
</form>


<!---------------------changed on march 27 2015------------------------------------->


<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal2','name'=>'form-horizontal2');
echo form_open_multipart('patient_ctrl/insert_profile',$attr);
$style='';
?>
<input type='hidden' name='param' id='param' value="<?echo $param ?>">
<div class="main-container">
<div class="container-fluid">

<div class="span6"> <h1>Welcome to <?php echo $query->fullname ?> </h1></div> 

<div class="row-fluid">
<div class="span9">
<div class="m-widget dashbord_box">
<div class="row-fluid">
</div>

<div style="margin-top:30px;" class="row-fluid">
<!--<div class="m-widget-body">
<!--<ul style="margin-bottom:-1px;margin:0px" class="nav nav-tabs" id="myTab">
<li class="active" id='home1'><a data-toggle="tab" onclick="javascript: check_li('home')">Personal Info</a></li>
<li class="" id='profile1'><a data-toggle="tab" onclick="javascript: check_li('profile')">Emergency</a></li>
<li class="" id='dropdown11'><a data-toggle="tab" onclick="javascript: check_li('dropdown1')">Medical History </a></li>
<li class="" id='dropdown21'><a data-toggle="tab"onclick="javascript: check_li('dropdown2')"> Insurance Info</a></li>
<li class="" id='dropdown31'><a data	-toggle="tab" onclick="javascript: check_li('dropdown3')">Family Member</a></li>  
</ul>-->

<div class="tab-content" id="myTabContent">
<div  id="home" class="tab-pane fade active in">
<div class="row-fluid patient_history">
<h1>Personal Details</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">

<!--<form class="form-horizontal2">-->



<div class="control-group">
<label class="control-label" for="inputEmail">Email :</label>
<div class="controls">
<?php echo form_input(array('id' => 'email', 'name' => 'email','placeholder' => 'Email','style'=>$style,'value'=>"$query->email")); ?>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Photo: </label>

<div class="controls">
<ul class="thumbnails m-media-container">
<li class="span3">
<?
echo '<img id="img_changer"  src="'.$query->img_location.'">';
?>
<div class="caption">
<input type="file" name="userfile" class="ed" id="img_browser"><br/>
</div>

</li>
</ul>
</div>

</div> 

<div class="control-group">
<label class="control-label" for="inputEmail"> Name</label>
<div class="controls"> 
<?php echo form_input(array('id' => 'fname', 'name' => 'fname','placeholder' => 'Name','style'=>$style,'value'=>"$query->fname")); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
<div class="controls">  
<?php echo form_input(array('id' => 'middle_initial', 'name' => 'middle_initial','placeholder' => 'Middle Initial Or Name','style'=>$style,'value'=>$query->middle_initial)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Last Name</label>
<div class="controls">
<?php echo form_input(array('id' => 'lname', 'name' => 'lname','placeholder' => 'Last Name','style'=>$style,'value'=>$query->lname)); ?>
</div>
</div>
<?
$dddob=explode('-', $query->dob );
$dob=$dddob[1].'-'.$dddob[2].'-'.$dddob[0];
$month=$dddob[1];
$day=$dddob[2];
?>
<div class="control-group">
<label class="control-label" for="inputEmail">Date of Birth</label>
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
<? echo form_radio('gender', $query->gender, TRUE);?>
Male
</label>

<label class="radio inline">
<? echo form_radio('gender', 'F', FALSE);?>
Female</label> 
<?}
else 
{
     echo form_radio('gender', 'M', FALSE);?>
	 Male
	  </label>

		<label class="radio inline">
	 <? echo form_radio('gender', $query->gender, TRUE);?>
	 Female</label> 
<?}?>
<label class="radio inline">
	<? echo form_radio('gender', 'Other', FALSE);?>
	Other</label> 
</div>
</div>

<h1>Where do you live? </h1>
<div class="clearfix">  </div>

<br>
<div class="control-group">
<label class="control-label" for="inputEmail">Address:</label>
<div class="controls">
<?php echo form_input(array('id' => 'addr', 'name' => 'addr','placeholder' => 'Address','style'=>$style,'value'=>$query->addr1)); ?>
</div>
</div>



<div class="control-group">
<label class="control-label" for="inputEmail">Address2:</label>
<div class="controls">
<?php echo form_input(array('id' => 'addr2', 'name' => 'addr2','placeholder' => 'Address2','style'=>$style,'value'=>$query->addr2)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">City:</label>
<div class="controls">
<?php echo form_input(array('id' => 'city', 'name' => 'city','placeholder' => 'City Name','style'=>$style,'value'=>$query->city)); ?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">State:</label>
<div class="controls">  
<?php echo form_input(array('id' => 'state', 'name' => 'state','placeholder' => 'State','style'=>$style,'value'=>$query->state)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Zip:</label>
<div class="controls">
<?php echo form_input(array('id' => 'zip', 'name' => 'zip','placeholder' => 'ZIP','style'=>$style,'value'=>$query->zip)); ?>
</div>
</div>
<?
echo form_hidden('recnum', "$query->recnum");

?>

<?
	
$h_m=$query->home_phone;
$h=explode('-',$h_m);
$c_m=$query->cell_phone;
$c=explode('-',$c_m);
$w_m=$query->work_phone;
$w=explode('-',$w_m);

if(!empty($query_emer))
{
$e_home=$query_emer->home_phone;
$e_h=explode('-',$e_home);

$e_cell=$query_emer->cell_phone;
$e_c=explode('-',$e_cell);

$e_work=$query_emer->work_phone;
$e_w=explode('-',$e_work);

}
else
{
	$e_home ='';
	$e_h[0] ='';
	$e_h[1] ='';
	$e_h[2] ='';
	$e_cell ='';
	$e_c[0] ='';
	$e_c[1] ='';
	$e_c[2] ='';
	$e_work ='';
	$e_w[0] ='';
	$e_w[1] ='';
	$e_w[2] ='';
	
	
	
	
}	
?>	
<h1>What is your contact Info ? </h1>
<div class="clearfix"></div>	 
<div class="alert alert-info">At least one of three phones is required </div>

<div class="control-group">
<label class="control-label" for="inputEmail">Home Phone:</label>
<div class="controls">
<input name="home_phone1" id="home_phone1" type="" value="<?=$h[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation(this,1)">&nbsp;-
<input name="home_phone2" id="home_phone2" type="" value="<?=$h[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation(this,2)"/>&nbsp;-<input name="home_phone3" id="home_phone3" type="" value="<?=$h[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation(this,3)"/>

</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Cell Phone:</label>
<div class="controls">
<input name="cell_phone4peronal1" id="cell_phone4peronal1" type="" value="<?=$c[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4cellphone(this,1)">&nbsp;-
<input name="cell_phone4peronal2" id="cell_phone4peronal2" type="" value="<?=$c[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4cellphone(this,2)"/>&nbsp;-<input name="cell_phone4peronal3" id="cell_phone4peronal3" type="" value="<?=$c[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4cellphone(this,3)"/>

</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Work Phone:</label>
<div class="controls"> 
<input name="work_phone4peronal1" id="work_phone4peronal1" type="" value="<?=$w[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4workphone(this,1)">&nbsp;-
<input name="work_phone4peronal2" id="work_phone4peronal2" type="" value="<?=$w[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4workphone(this,2)"/>&nbsp;-<input name="work_phone4peronal3" id="work_phone4peronal3" type="" value="<?=$w[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4workphone(this,3)"/>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Preferred method of Contact</label>
<div class="controls">
<?php echo form_input(array('id' => 'preferred_contact_mode', 'name' => 'preferred_contact_mode','placeholder' => 'NO','style'=>$style,'value'=>$query->preferred_contact_mode)); ?>		
</div>		
</div>	
</div> 
<?
if ($pagename == 'patient_update')
{
//echo form_submit(array('id' => 'submit', 'class' => 'btn btn-large btn-success', 'value' => 'Submit')); 
?>
<div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="document.forms['form-horizontal2'].submit()"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div>
<?}?>	
</div></div>

<div id="profile" class="tab-pane fade">
<div class="row-fluid patient_history">

<div style="margin-bottom:10px;" class="m-widget">


<?php

if(!empty($query_emer))
{
	$fname = $query_emer->fname ;
	$middle_initial = $query_emer->middle_initial ;
	$lname = $query_emer->lname;
	$email = $query_emer->email;
	$relationship = $query_emer->relationship;	
}
else
{
	$fname ='';
	$middle_initial ='';
	$lname ='';
	$email ='';
	$relationship ='';
	
}	
	
?>
<h1> Emergency Contact Person's Details</h1>
<br>
<div class="control-group">
<label class="control-label" for="inputEmail">First Name </label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_fname', 'name' => 'emer_fname','placeholder' => 'First Name','style'=>$style,'value'=>$fname)); ?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_midname', 'name' => 'emer_midname','placeholder' => 'Middle Initial Or Name','style'=>$style,'value'=>$middle_initial )); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Last Name</label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_lname', 'name' => 'emer_lname','placeholder' => 'Last Name','style'=>$style,'value'=>$lname)); ?>
</div>
</div>



<h1> Emergency Contact Person's Contact Info </h1>
<div class="alert alert-info">  At least one of three phones is required </div>
<div class="control-group">
<label class="control-label" for="inputEmail">Home phone </label>
<div class="controls">
<input name="emer_homenum1" id="emer_homenum1" type="" value="<?=$e_h[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4emer_homephone(this,1)">&nbsp;-
<input name="emer_homenum2" id="emer_homenum2" type="" value="<?=$e_h[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4emer_homephone(this,2)"/>&nbsp;-<input name="emer_homenum3" id="emer_homenum3" type="" value="<?=$e_h[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4emer_homephone(this,3)"/>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Cell  phone</label>
<div class="controls">
<input name="emer_cellnum1" id="emer_cellnum1" type="" value="<?=$e_c[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4emer_cellphone(this,1)">&nbsp;-
<input name="emer_cellnum2" id="emer_cellnum2" type="" value="<?=$e_c[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4emer_cellphone(this,2)"/>&nbsp;-<input name="emer_cellnum3" id="emer_cellnum3" type="" value="<?=$e_c[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4emer_cellphone(this,3)"/>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Work phone</label>
<div class="controls"> 
<input name="emer_worknum1" id="emer_worknum1" type="" value="<?=$e_w[0]?>" 
style="width:30px;height:20px" onkeypress="javascript:number_validation4emer_workphone(this,1)">&nbsp;-
<input name="emer_worknum2" id="emer_worknum2" type="" value="<?=$e_w[1]?>"  style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4emer_workphone(this,2)"/>&nbsp;-<input name="emer_worknum3" id="emer_worknum3" type="" value="<?=$e_w[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4emer_workphone(this,3)"/>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Email</label>
<div class="controls">
<?php echo form_input(array('id' => 'emer_email', 'name' => 'emer_email','placeholder' => 'Email','style'=>$style,'value'=>$email)); ?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Relationship</label>
<div class="controls">			
<?php echo form_input(array('id' => 'emer_relation', 'name' => 'emer_relation','placeholder' => 'Relationship','style'=>$style,'value'=>$relationship)); ?>
</div>
</div>	

<?
echo form_hidden('recnum', $recnum);
?>


</div>
<?
if ($pagename == 'patient_update')
{ 

//echo form_submit(array('id' => 'submit', 'class' => 'btn btn-large btn-success', 'value' => 'Submit')); 
?>
<div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="document.forms['form-horizontal2'].submit()"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div>
<?}      
?>	

</div>
</div>


<div id="dropdown1" class="tab-pane fade">
<div class="row-fluid patient_history">

<?php

if(!empty($query_health))
{
	$height_inches = $query_health->height_inches ;
	$weight_lbs    = $query_health->weight_lbs ;
	$are_you_in_good_health  = $query_health->are_you_in_good_health ;
	$under_physician_care = $query_health->under_physician_care;
	$illness_operation_hospitalized = $query_health->illness_operation_hospitalized ;
	
		
}
else
{
	$height_inches ='' ;
	$weight_lbs ='' ;
	$are_you_in_good_health ='' ;
	$under_physician_care ='' ;
	$illness_operation_hospitalized ='' ;
	
	
}	
?>
<h1>Your Weight and height</h1>
<div class="clearfix">  </div>
<div style="margin-bottom:10px;" class="m-widget">
<div class="control-group">
<label class="control-label" for="inputEmail">Height (in inches)</label>
<div class="controls">
<input type="text" placeholder="00"  id='height_inches' name='height_inches'
value='<?= $height_inches?>'>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Weight (in pounds)</label>
<div class="controls">
<input type="text" placeholder="00" id='weight_lbs'
name='weight_lbs' value='<?= $weight_lbs?>'>
</div>
</div> 
</div>
<div class="clearfix">  </div> 
<h1>Your Health Status  </h1>

<div style="margin-bottom:10px;" class="m-widget">

<!--<form class="form-horizontal2">-->
<div class="control-group">
<label class="control-label" for="inputEmail"> Are you in good health</label>
<div class="controls">

<? 
if($are_you_in_good_health  == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="are_you_in_good_health" value="yes" id="are_you_in_good_health" checked >
Yes
</label>					
<label class="radio inline">
<input type="radio" name="are_you_in_good_health" value="no" id="are_you_in_good_health">
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="are_you_in_good_health" value="yes" id="are_you_in_good_health">
Yes
</label>					
<label class="radio inline">
<input type="radio" name="are_you_in_good_health" value="no" id="are_you_in_good_health" checked>
No</label>
<?}?>				

</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Are you now under the care of a physician ?</label>
<div class="controls">					
<? if($under_physician_care   == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="under_physician_care" value="yes" id="under_physician_care" checked>
Yes
</label>					
<label class="radio inline">
<input type="radio" name="under_physician_care" value="no" id="under_physician_care" >
No</label>	
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="under_physician_care" value="yes" id="under_physician_care" >
Yes
</label>					
<label class="radio inline">
<input type="radio" name="under_physician_care" value="no" id="under_physician_care" checked>
No</label>
<?}


if(!empty($query_health))
{
$p_m=$query_health->physician_phone;
$p_h=explode('-',$p_m);
}
else
{
	$p_m ='';
	$p_h[0] ='';
	$p_h[1] ='';
	$p_h[2] ='';
	
	
	
}
?>

</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Physician's Telephone</label>
<div class="controls">
<input name="physician_phone1" id="physician_phone1" type="" value="<?=$p_h[0]?>" 
style="width:30px;height:20px" 
onkeypress="javascript:number_validation4physician(this,1)">&nbsp;-
<input name="physician_phone2" id="physician_phone2" type="" value="<?=$p_h[1]?>"  style="margin-left:10px;width:30px;height:20px" 
onkeypress="javascript:number_validation4physician(this,2)"/>&nbsp;-<input name="physician_phone3" id="physician_phone3" type="" 
value="<?=$p_h[2]?>" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4physician(this,3)"/>

</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword"> Have you had any serious illness, operation or been hospitalized ? </label>
<div class="controls">
<?
if($illness_operation_hospitalized  == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="illness_operation_hospitalized" id="illness_operation_hospitalized" value='yes' checked>
Yes
</label>	

<label class="radio inline">
<input type="radio" name="illness_operation_hospitalized"id="illness_operation_hospitalized" value='no' >
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="illness_operation_hospitalized" id="illness_operation_hospitalized" value='yes' >
Yes
</label>	

<label class="radio inline">
<input type="radio" name="illness_operation_hospitalized" id="illness_operation_hospitalized" value='no' checked>
No</label>
<?}?>


</div>
</div>



</div>








<div class="clearfix">  </div> 

<h1>Do you use alcohol, tobaco, drugs?  </h1>
<?php
if(!empty($query_health))
{
	$alcoholic_consumption = $query_health->alcoholic_consumption;
	$recreation_drug_usage = $query_health->recreation_drug_usage ;
	$alcohol_abuse  = $query_health->alcohol_abuse ;
	$smoke = $query_health->smoke ;
	$tobacco = $query_health->tobacco ;
	$other = $query_health->other ;
}
else
{
	$alcoholic_consumption ='';
	$recreation_drug_usage  ='';
	$alcohol_abuse ='';
	$smoke ='';
	$tobacco  ='';
	$other ='';
}	
?>
<div style="margin-bottom:10px;" class="m-widget">
<!--<form class="form-horizontal2">-->
<div class="control-group">
<label class="control-label" for="inputEmail">Do you drinks alcholic beverages ? </label>
<div class="controls">
<?
if($alcoholic_consumption   == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" checked>
Yes
</label>

<label class="radio inline">
<input type="radio" name="alcoholic_consumption" value="no" id="alcoholic_consumption" >
No</label>
<?}
else
{?>
<label class="radio inline">
<input type="radio" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" >
Yes
</label>

<label class="radio inline">
<input type="radio" name="alcoholic_consumption" value="no" id="alcoholic_consumption" checked>
No</label>
<?}?>

</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">
Have you used any recreation drug in the last 6 months ?</label>
<div class="controls">
<?
if($recreation_drug_usage    == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="recreation_drug_usage" value="yes" id="recreation_drug_usage" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" name="recreation_drug_usage" value="no" id="recreation_drug_usage" >
No</label>
<?}
else
{?>
	<label class="radio inline">
<input type="radio" name="recreation_drug_usage" value="yes" 
id="recreation_drug_usage " >
Yes
</label>				
<label class="radio inline">
<input type="radio" name="recreation_drug_usage" value="no" id="recreation_drug_usage" checked>
No</label>
<?}?>


</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">History of alcohol abuse ?</label>
<div class="controls">
<?
if($alcohol_abuse   == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="alcohol_abuse" value="yes" id="alcohol_abuse" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" name="alcohol_abuse" value="no" id="alcohol_abuse" >
No</label>
<?}
else
{?>
  <label class="radio inline">
<input type="radio" name="alcohol_abuse" value="yes" id="alcohol_abuse" >
Yes
</label>				
<label class="radio inline">
<input type="radio" name="alcohol_abuse" value="no" id="alcohol_abuse" checked>
No</label>
<? }?>	

</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword"> 
Do you use smoke?  </label>
<div class="controls">
<?
if($smoke   == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="smoke" value="yes" id="smoke" checked>
Yes
</label>

<label class="radio inline">
<input type="radio" name="smoke" value="no" id="smoke" >
No</label>
<?}
else
{?>
	<label class="radio inline">
<input type="radio" name="smoke" value="yes" id="smoke" >
Yes
</label>

<label class="radio inline">
<input type="radio" name="smoke" value="no" id="smoke" checked>
No</label>
<?}?>			

</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword"> 
Do you use tobacco?  </label>
<div class="controls">
<?
if($tobacco    == 'yes')
{?>
<label class="radio inline">
<input type="radio" name="tobacco" value="yes" id="tobacco" checked>
Yes
</label>				
<label class="radio inline">
<input type="radio" name="tobacco" value="no" id="tobacco" >
No</label>
<?}
else
{?>
  <label class="radio inline">
<input type="radio" name="tobacco" value="yes" id="tobacco" >
Yes
</label>				
<label class="radio inline">
<input type="radio" name="tobacco" value="no" id="tobacco" checked>
No</label>
<? }?>		

</div> 
</div>
</div>

<div class="clearfix">  </div> 
<h1>Your medical condition  </h1>

<p>Have you had currently have any of the following conditions? Check the ones that are applicable<br>
</p>

<div style="margin-bottom:10px;" class="m-widget" >
<div class="control-group">
<label class="control-label">
<?
$prev_group='';$i=0;$j=0;
if(!empty($master_meta))
{
	?>
<table>
<?php 
foreach($master_meta as $m)
{
        if($prev_group == '' || $prev_group != $m->group)
	{?>
           <tr><td><strong><?= $m->group ?></strong></p><td></tr>
        <?$j=0;}
if($j%2 == 0 )
	{
	  echo "</tr><tr>";
	}
if($m->condition_status == 'yes')
{?>
<td>
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" id="name_<?= $i?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>" checked >&nbsp;&nbsp;<?= $m->medical_condition ?>
</label>
</td>
<?
}
else
{?>
<td>
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" id="name_<?= $i?>" name="name_<?= $i?>" value="<?= $m->medical_condition ?>"  >&nbsp;&nbsp;<?= $m->medical_condition ?>
</label>
</td>
<?}?>

<input type='hidden'  style="width:100px !important" name="group<?= $i?>" 
value="<?= $m->group ?>" id="group<?= $i?>">
<input type='hidden'  style="width:100px !important" name="name<?= $i?>" 
value="<?= $m->medical_condition ?>" id="name<?= $i?>" >
<input type='hidden'  style="width:100px !important" name="dispseq_<?= $i?>" 
value="<?= $i ?>" id="dispseq_<?= $i?>">
<?
        $prev_group=$m->group;
        $upd_num=$m->upd_num;
        $i++;$j++;
}?>
</table>
<input type='hidden'  style="width:100px !important" name="upd_num" 
value="<?= $upd_num ?>" id="upd_num">
<input type='hidden' name='base_url' id='base_url' value="<?= base_url()  ?>">
<input type ='hidden' name='index' id='index' value="<?= $i?>">
<input type ='hidden' name='recnum' id='recnum' value="<?= $recnum?>">

<?php  } 
else 
{
	
$prev_group='';$i=0;$j=0;
foreach($master_meta1 as $m)
{
	if($prev_group == '' || $prev_group != $m->group)
	{?>
	    <tr><td><strong><?= $m->group ?></strong></td></tr>
        <? $j=0;}
        if($j%2 == 0 )
	{
	  echo "</tr><tr>";
	}?>
	 </p>		 
<td><div class="control-group">
<label class="control-label" style="margin-left:20px !important">
<input type="checkbox" id="name_<?= $i?>" name="name_<?= $i?>" value="<?= $m->name ?>" >&nbsp;&nbsp;<?= $m->name ?>
</label>
</div></td>

<input type='hidden'  style="width:100px !important" name="group<?= $i?>" 
value="<?= $m->group ?>" id="group<?= $i?>" >
<input type='hidden'  style="width:100px !important" name="name<?= $i?>" 
value="<?= $m->name ?>" id="name<?= $i?>" >
<input type='hidden'  style="width:100px !important" name="dispseq_<?= $i?>" 
value="<?= $i ?>" id="dispseq_<?= $i?>" >

	<?
	$prev_group=$m->group;
$i++;$j++;
}?>
</table>
<input type ='hidden' name='index' id='index' value="<?= $i?>">
<?php }?>	

</div></div></div>	
<!--
<div style="margin-bottom:10px;" class="m-widget">
<div class="control-group">
<label class="control-label">
<?
if($query_health->high_bp== 'yes')
{?>
<input type="checkbox" name="high_bp" id='high_bp' value="yes" checked>
High Blood Pressure
<?}
else
{?>
<input type="checkbox" name="high_bp" id='high_bp' value="no" >
High Blood Pressure
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->low_bp== 'yes')
{?>
<input type="checkbox" name="low_bp" value="yes" id="low_bp" checked>
Low Blood Pressure
<?}
else
{?>
<input type="checkbox" name="low_bp" value="no" id="low_bp">
Low Blood Pressure
<?}?>
</label>
</div>
</div>



<div class="control-group">
<label class="control-label">
<?
if($query_health->angina_chest_pain== 'yes')
{?>
<input type="checkbox" name="angina_chest_pain" value="yes" checked>
Angina Chest Pain
<?}
else
{?>
<input type="checkbox" name="angina_chest_pain" value="no" >
Angina Chest Pain
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->fainiting == 'yes')
{?>
<input type="checkbox" name="fainiting" value="yes" id='fainiting'  checked>
Fainting
<?}
else
{ ?>
<input type="checkbox" name="fainiting" value="no" id='fainiting'  >
Fainting
<?}?>
</label>
</div>
</div>



<div class="control-group">
<label class="control-label">
<?
if($query_health->irregular_heartbeat== 'yes')
{?>
<input type="checkbox" name="irregular_heartbeat" value="yes" id='irregular_heartbeat' checked>
Irregular Heartbeat
<?}
else
{?>
<input type="checkbox" name="irregular_heartbeat" value="no" id='irregular_heartbeat' >
Irregular Heartbeat
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->heart_attack== 'yes')
{?>
<input type="checkbox" name="heart_attack" id='heart_attack'  value="yes" checked>
Heart Attack
<?}
else
{?>
<input type="checkbox" name="heart_attack" id='heart_attack'  value="no" >
Heart Attack
<?}?>
</label>
</div>
</div>


<div class="control-group">
<label class="control-label">
<?
if($query_health->heart_bypass== 'yes')
{?>
<input type="checkbox" name="heart_bypass" id='heart_bypass' value="yes" checked>
Heart Bypass
<?}
else
{?>
<input type="checkbox" name="heart_bypass" id='heart_bypass' value="no">
Heart Bypass
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->pacemaker== 'yes')
{?>
<input type="checkbox" name="pacemaker" id='pacemaker' value="yes" checked>
Pacemaker
<?}
else
{?>
<input type="checkbox" name="pacemaker" id='pacemaker' value="no"  >
Pacemaker
<?}?>
</label>
</div>
</div>

<div class="control-group">
<label class="control-label">
<?
if($query_health->anemia== 'yes')
{?>
<input type="checkbox" name="anemia" value="yes" id='anemia'  checked>
Anemla
<?}
else
{?>
<input type="checkbox" name="anemia" value="no" id='anemia' >
Anemla
<?}?>
</label>


</div>

<div class="control-group">
<p><strong>LIVER DI & EA & E</strong></p>
<label class="radio inline">
<?
if($query_health->hepatitis_a == 'yes')
{?>
<input type="checkbox" name="hepatitis_a" value="yes" id="hepatitis_a" checked>
Hepatitis A
<?}
else
{?>
<input type="checkbox" name="hepatitis_a" value="no" id="hepatitis_a" >
Hepatitis A
<?}?>
</label>


<label class="radio inline">
<?
if($query_health->hepatitis_b == 'yes')
{?>
<input type="checkbox" name="hepatitis_b" value="yes" id="hepatitis_b" checked>
Hepatitis B
<?}
else
{?>
<input type="checkbox" name="hepatitis_b" value="no" id="hepatitis_b" >
Hepatitis B
<?}?>
</label>

<label class="radio inline">
<?
if($query_health->hepatitis_c == 'yes')
{?>
<input type="checkbox" name="hepatitis_c" value="yes" id="hepatitis_c" checked>
Hepatitis C
<?}
else
{?>
<input type="checkbox" name="hepatitis_c" value="no" id="hepatitis_c" >
Hepatitis C
<?}?>
</label>
</div>

<div class="control-group">
<p><strong>IMMUNOSUPPRESSED / BLOOD DISEASE</strong></p>
<label class="control-label">
<?
if($query_health->hiv == 'yes')
{?>
<input type="checkbox" name="hiv" id='hiv'  value="yes" checked>
HIV-
<?}
else
{?>
<input type="checkbox" name="hiv" id='hiv'  value="no" >
HIV-
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->aids == 'yes')
{?>
<input type="checkbox" name="aids"  id='aids' value="yes" checked>
AIDS
<?}
else
{?>
<input type="checkbox" name="aids"  id='aids' value="no" >
AIDS
<?}?>

</label>
</div>
</div>

<div class="control-group">

<label class="control-label">
<?
if($query_health->std == 'yes')
{?>
<input type="checkbox" name="std" value="yes" id='std' checked>
Sexually Transmitted Disease
<?}
else
{?>
<input type="checkbox" name="std" value="no" id='std' >
Sexually Transmitted Disease
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->delay_in_healing == 'yes')
{?>
<input type="checkbox" name="delay_in_healing" value="yes"  id='delay_in_healing' checked>
Delay in Healing
<?}
else
{?>
<input type="checkbox" name="delay_in_healing" value="no"  
id='delay_in_healing' >
Delay in Healing
<?}?>
</label>
</div>
</div>


<div class="control-group">
<p><strong>ORGAN CONDITION / DISEASE</strong></p>
<label class="control-label">
<?
if($query_health->pancreas_diabetes == 'yes')
{?>
<input type="checkbox" name="pancreas_diabetes" value="yes"  id='pancreas_diabetes' checked>
pancreas diabetes
<?}
else
{?>
<input type="checkbox" name="pancreas_diabetes" value="no"  id='pancreas_diabetes' >
pancreas diabetes
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->kidney_dialysis == 'yes')
{?>
<input type="checkbox" name="kidney_dialysis" value="yes"  id='kidney_dialysis' checked>
Kidney / Dialysis
<?}
else
{?>
<input type="checkbox" name="kidney_dialysis" value="no"  id='kidney_dialysis' >
Kidney / Dialysis
<?}?>
</label>
</div>
</div>

<div class="control-group">		 
<label class="control-label">
<?
if($query_health->eyes_glaucoma == 'yes')
{?>
<input type="checkbox" name="eyes_glaucoma" value="yes" checked id='eyes_glaucoma'>
Eyes / Glaucoma
<?}
else
{?>
<input type="checkbox" name="eyes_glaucoma" value="no"  id='eyes_glaucoma'>
Eyes / Glaucoma
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->thyroid == 'yes')
{?>
<input type="checkbox" name="thyroid" value="yes" id='thyroid' checked>
Thyroid
<?}
else
{?>
<input type="checkbox" name="thyroid" value="no" id='thyroid' >
Thyroid
<?}?>

</label>
</div>
</div>

<div class="control-group">

<label class="control-label">
<?
if($query_health->neurology_epilepsy == 'yes')
{?>
<input type="checkbox" name="neurology_epilepsy" id='neurology_epilepsy' value="yes" checked>
Neurology Epilepsy
<?}
else
{?>
<input type="checkbox" name="neurology_epilepsy" id='neurology_epilepsy' value="no">
Neurology Epilepsy
<?}?>
</label>
</div>


<div class="control-group">
<p><strong>CANCER</strong></p>
<label class="control-label">
<?
if($query_health->cancer_location == 'yes')
{?>
<input type="checkbox" name="cancer_location" id='cancer_location' value="yes" checked>
Cancer Location
<?}
else
{?>
<input type="checkbox" name="cancer_location" id='cancer_location' value="no" >
Cancer Location
<?}?>
</label>


<div class="controls">
<div class='radio inline'>
<input class="input-large" type="text" placeholder="Location"  name='cancer_location_name'
value='<?= $query_health->cancer_location_name ?>'>
</div>
</div>
</div>
<div class="control-group">
<label class="control-label">
<?
if($query_health->surgery == 'yes')
{?>
<input type="checkbox" name="surgery" id='surgery'  value="yes" checked>
Surgery 
<?}
else
{?>
<input type="checkbox" name="surgery" id='surgery'  value="no" >
Surgery 
<?}?>
</label>

<div class="controls">
<label class="radio inline">
<?
if($query_health->radiation  == 'yes')
{?>
<input type="checkbox" name="radiation" value="yes" id='radiation' checked>
Radiation
<?}
else
{?>
<input type="checkbox" name="radiation" value="no" id='radiation' >
Radiation
<?}?>

</label>
</div>
</div>


<div class="control-group">
<label class="control-label">
<?
if($query_health->chemotherapy  == 'yes')
{?>
<input type="checkbox" name="chemotherapy" value="yes" checked id='chemotherapy'>
Chemotherapy
<?}
else
{?>
<input type="checkbox" name="chemotherapy" value="no"  id='chemotherapy'>
Chemotherapy
<?}?>
</label>


</div>


<div class="control-group">
<p><strong>JOINT CONDITION</strong></p>
<label class="control-label">
<?
if($query_health->jaw_joints_pain  == 'yes')
{?>
<input type="checkbox" name="jaw_joints_pain" value="yes"  id='jaw_joints_pain' checked>
Clicking / Pain in jaw joints when eating
<?}
else
{?>	 
<input type="checkbox" name="jaw_joints_pain" value="no"  id='jaw_joints_pain' >
Clicking / Pain in jaw joints when eating
<?}?>
</label>
<div class="controls">
<label class="radio inline">
<?
if($query_health->arthritis  == 'yes')
{?>
<input type="checkbox" name="arthritis" id='arthritis'  value="yes" checked>
Arthritis
<?}
else
{?>
<input type="checkbox" name="arthritis" id='arthritis'  value="no" >
Arthritis
<?}?>
</label>
</div>  


</div>


<div class="control-group">
<label class="control-label">
<?
if($query_health->arthritis_knee_replacement  == 'yes')
{?>
<input type="checkbox" name="arthritis_knee_replacement" value="yes" checked>
Arthritis Knee Replacement
<?}
else
{?>
<input type="checkbox" name="arthritis_knee_replacement" value="no" >
Arthritis Knee Replacement
<?}?>
</label>
<div class="controls">
<label class="radio inline">
<?
if($query_health->arthritis_hip_replacement  == 'yes')
{?>
<input type="checkbox" name="arthritis_hip_replacement" value="yes" checked id='arthritis_hip_replacement'>
Arthritis Hip Replacement
<?}
else
{?>
<input type="checkbox" name="arthritis_hip_replacement" value="no"  id='arthritis_hip_replacement'>
Arthritis Hip Replacement
<?}?>
</label>
</div>  
</div>

<div class="control-group">
<label class="control-label">
<?
if($query_health->swollen_ankles  == 'yes')
{?>
<input type="checkbox" name="swollen_ankles" id='swollen_ankles'  value="yes" checked>
Swollen Ankles
<?}
else
{?>
<input type="checkbox" name="swollen_ankles" id='swollen_ankles '  value="no">
Swollen Ankles
<?}?>
</label>

</div>
-->

<div class="control-group">
<label class="control-label">

Other
</label>
<div class="controls">	
<div class='radio inline'>
<input class="input-large" type="text" placeholder="..."  id='other' name='other'  checked value='<?= $other ?>'>
</div>

</div>  </div> 





<?
//echo form_submit(array('id' => 'submit', 'class' => 'btn btn-large btn-success', 'value' => 'Submit')); 

?>	
<div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact"  onclick="document.forms['form-horizontal2'].submit()" > 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div>
</div>
</div>


<div id="dropdown3" class="tab-pane fade">
<div class="row-fluid patient_history">

<div style="margin-bottom:10px;" class="m-widget">

<h1>Family Member Details</h1>
<br>
<div class="control-group">
<label class="control-label" for="inputEmail">First Name </label>
<div class="controls">
<input class="input-xlarge" type="text" placeholder="First Name "  value="<?= $family_mem->fname ?>" name='family_fname' id='family_fname'>   
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
<div class="controls">
<input class="input-xlarge" type="text" placeholder=" Middle Initial Or Name"  value='<?= $family_mem->middle_name ?>' name='family_mname' id='family_mname'>   
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Last Name</label>
<div class="controls">
<input class="input-xlarge" type="text" placeholder=" Last Name"  value='<?= $family_mem->lname ?>' name='family_lname' id='family_lname'>   
</div>
</div>


<h1> Family Member Contact Info </h1>
<div class="alert alert-info">  At least one of three phones is required </div>
<div class="control-group">
<label class="control-label" for="inputEmail">Home phone1 </label>
<div class="controls">
<input class="input-xlarge" type="text" placeholder="Home phone " value='<?= $family_mem->home_phone ?>' name='home_phone' name='home_phone'>   
</div>
</div>	

<div class="control-group">
<label class="control-label" for="inputEmail">Cell phone</label>
<div class="controls">
<input class="input-xlarge" type="text" placeholder=" Middle Initial Or Name" value='<?= $family_mem->cell_phone ?>' name='cell_phone' id='cell_phone'>    
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Work phone</label>
<div class="controls">
<input class="input-xlarge" type="text" placeholder="Work phone"  value='<?= $family_mem->work_phone ?>' name='work_phone' id='work_phone'>   
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputEmail">Email</label>
<div class="controls">
<input class="input-xlarge" type="text" placeholder="Email" value='<?= $family_mem->email ?>' name='family_email'  id='family_email'>   
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Relationship</label>
<div class="controls">
<input class="input-xlarge" type="text" placeholder="Relationship" value='<?= $family_mem->relationship ?>' name='fam_relationship' id='fam_relationship'>   
</div>
</div>	
</div>
<input type='hidden' name='family_recnum' id='family_recnum' value='<?=$family_mem->recnum ?>'>
<?
//echo form_submit(array('id' => 'submit', 'class' => 'btn btn-large btn-success', 'value' => 'Submit')); 
?>	
<div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="document.forms['form-horizontal2'].submit()"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div>
</div>
</div>

<div id="dropdown2" class="tab-pane fade">
<div class="row-fluid patient_history">
<div class="m-widget-body">

<div class="row-fluid patient_history">
<h1>Insurance Details of  Primary Insured</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">
<?php

if(!empty($query_insur))
{
	$name_of_insured = $query_insur->name_of_insured  ;
	$insurance_company = $query_insur->insurance_company ;
	$group_id = $query_insur->group_id ;
	$member_id = $query_insur->member_id ;
	$img1_location = $query_insur->img1_location;
	$img2_location = $query_insur->img2_location;
}
else
{
	$name_of_insured ='';
	$insurance_company ='';
	$group_id ='';
	$member_id ='';
	$img1_location ='';
	$img2_location ='';
	
}
?>

<div class="control-group">
<label class="control-label" for="inputEmail">Name of Primary Insured</label>
<div class="controls">
<input type="text" name='name_of_insured' placeholder="Name" value="<?= $name_of_insured ?>" >
</div>
</div>	

<div class="control-group">
<label class="control-label" for="inputPassword">Name Of The Patients </label>
<div class="controls">
<input type="text" name='patient_fname' style=";background-color:#DDDDDD;" readonly="readonly" placeholder="Name" value='<?= $query->fname ?>' >
</div>

</div> 

</div>


<div class="clearfix">  </div> 

<h1>Primary Insurance  </h1>

<div style="margin-bottom:10px;" class="m-widget">

<div class="control-group">
<label class="control-label" for="inputPassword">Insurance Company </label>
<div class="controls">
<input type="text" name='insurance_company' id='insurance_company' placeholder=" Company Name"  value='<?= $insurance_company ?>'>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Group ID</label>
<div class="controls">
<input type="text" name='group_id' id='group_id' placeholder="ID" value='<?= $group_id ?>'>
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Member ID </label>
<div class="controls">
<input type="text" id='member_id' name='member_id' placeholder="ID" value='<?= $member_id ?>'>
</div>
</div>


</div>

<div class="clearfix">  </div> 

<div class="well">
<p>Upload photos/scanned image of insurance card
</p>
<ul class="thumbnails m-media-container">
<li class="span3" class='ed' >
<ul class="thumbnails m-media-container">
<li class="span3" class='ed' >
<?
echo '<img id="img_1"  src="'.$img1_location.'">';
?>
<div class="caption">
<input type="file" name="ins1_userfile"   id="img_browse1"><br/>
</div>
</li>

</ul>
</li>
<li class="span3">
<ul class="thumbnails m-media-container">
<li class="span3">
<?
echo '<img id="img_2"  src="'.$img2_location.'">';
?>
<div class="caption">
<input type="file" name="ins2_userfile" id="img_browse2"><br/>
</div>



</li>
</ul>

</li>
</ul>
</div>



<?

//echo form_submit(array('id' => 'submit', 'class' => 'btn btn-large btn-success', 'value' => 'Submit')); 

?>	
<div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="document.forms['form-horizontal2'].submit()"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div>
</div>
          </div>
        </div>
      </div>


   </div>
   </div>


<div class="span3 m-widget">
<ul class="patients_rightnav">
<?
if($this->session->userdata('appts_leftnav') != '')
{?>
<li>
<button class="btn btn-large btn-warning" type="button" 
onClick='location.href="<?php echo base_url();?>patient_ctrl/appointments" '> <i class="fa fa-envelo	pe-o"></i>  Request Appointment  </button>
</li>
<?}
if($this->session->userdata('msg_leftnav') != '')
{?>
<li>
<button class="btn btn-large btn-warning" type="button" onClick='location.href="<?php echo base_url();?>patient_ctrl/messages" '> <i class="fa fa-envelope-o"></i>  Send Message  </button>											
</li>
<?}?> 
</ul>

<div class="clearfix"> </div>
<br>
<ul class="patients_rightnav">

<li>
<button onclick="javascript:getparam_value('home1')"   class="btn btn-large btn-info" type="button"> <i class="fa fa-refresh"></i>Personal Info</button>
</li>

<li>
<button onclick="javascript:getparam_value('profile1')"  type="button" class="btn btn-large btn-info"> <i class="fa fa-refresh"></i>Emergency Info</button>
</li>

<li>
<button onclick="javascript:getparam_value('dropdown11')"  class="btn btn-large btn-info" type="button"><i class="fa fa-refresh"></i>Health History</button>											
</li>

<li>
<button onclick="javascript:getparam_value('dropdown21')"   class="btn btn-large btn-info" type="button"><i class="fa fa-refresh"></i>Insurance Info</button>											
</li>
<li>
<button onclick="javascript:getparam_value('familymember')"  class="btn btn-large btn-info" onclick=" location.href='profile.html#familymember'" type="button" ><i class="fa fa-refresh"></i> Family Member</button>
</li>

<li>
<button onclick="javascript:getparam_value('dental_history')" class="btn btn-large btn-info" onclick=" location.href='profile.html#dental_history'" type="button" ><i class="fa fa-refresh"></i> Dental History</button>
</li>

</ul>

<div class="clearfix"> </div>
<div class="patients_social">
<a href="http://facebook.com/paperlessdentists" target="_blank"> <i class="fa fa-facebook"></i> </a> 
<a href="http://twitter.com/PaperlessD" target="_blank"><i class="fa fa-twitter"></i></a> 
</div>

</div>

</div>


</form>
<!--
<div class="clearfix">
<div class="footer">

<span>Copyright &copy; 2014, Paperless Dentists. All Rights Reserved	Terms Of Use </span>

</div>
</div>-->

</div>
</div>
</div>
</body>
<script>
function imgChanger(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img_changer').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function imgChanger1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img_1').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function imgChanger2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img_2').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#img_browser").change(function(){imgChanger(this);});
    $("#img_browse1").change(function(){imgChanger1(this);});
    $("#img_browse2").change(function(){imgChanger2(this);});
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
