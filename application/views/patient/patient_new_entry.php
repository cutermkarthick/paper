<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 15, 2014                 =
// Filename: patient_new_entry.php             =
// Copyright of Fluent Technologies            =
// Creating new family member as patient       =
//==============================================
?>
<!doctype html>
<html>
<head>
<title>Paperless Dentists</title>
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
function getnextpage(param)
{		
	parameter=param;
	$("#home").css({"display": "none"});
	$("#profile").css({"display": "none"});
	$("#dropdown1").css({"display":  "none"});
	$("#dropdown2").css({"display": "none"});
	$("#dropdown3").css({"display": "none"});
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
	   $("#myTab li#home1").removeClass("active");
	   $("#myTab li#profile1").removeClass("active");
	   $("#myTab li#dropdown11").removeClass("active");
	   $("#myTab li#dropdown21").removeClass("active");
	   $("#myTab li#familymember").removeClass("active");

        if(parameter == 'home1'  || parameter == 'profile' )
        {
             $("#myTab li#home1").addClass("active");
        }
        else if(parameter == 'profile1' )
        {
             $("#myTab li#profile1").addClass("active");
        }
        else if(parameter == 'dropdown11' )
        {
              $("#myTab li#dropdown11").addClass("active");
        } 
		else if(parameter == 'dropdown21' )
        {
              $("#myTab li#dropdown21").addClass("active");
        }
		else if(parameter == 'familymember' )
        {
             $("#myTab li#familymember").addClass("active");
        } 
		$('html, body').animate({ scrollTop: 0 }, 20);
}
$(document).ready(function() 
{
       $("#home").css({"display": "block"});
	   $("#profile").css({"display": "none"});
	   $("#dropdown1").css({"display":  "none"});
	   $("#dropdown2").css({"display": "none"});
	   $("#dropdown3").css({"display": "none"});
});
</script>
<?
$style=' ';
?>
<link rel="stylesheet" type="text/css" href="css/font_awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font_awesome/css/font-awesome.css"/>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="main-container">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:10px 0px;"class="sub_title row-fluid">
<div class="span6"> <h1>Welcome to <?php echo $query->fullname ?> </h1></div> 

<div class="row-fluid">
<div class="span9">
<div class="m-widget dashbord_box">
<div class="row-fluid">
</div>
<?
$param=array();
$url=$_SERVER['REQUEST_URI'];
$str =array_pop( explode('/', $url) );
?>
<div>
<?
if($str == 'home' || $str == 'profile')
{?>
<h1 style='margin-top:4px;margin-right:4px'>Personal Info
<?}
elseif($str == 'profile1')
{?>
<h1>Emergency Info
<?}
elseif($str == 'dropdown11')
{?>
<h1>Health History
<?}
elseif($str == 'dropdown21')
{?>
<h1>Insurance Info
<?}
elseif($str == 'familymember')
{?>
<h1>Family Members
<?}?>
</h1>
</div>

<div class="m-widget-body"> 
<ul style="margin-bottom:-1px;" class="nav nav-tabs" id="myTab">
<li class="active" id='home1'><a   >Personal Info</a></li>
<li class="" id='profile1' ><a  >Emergency Info</a></li>
<li class="" id='dropdown11'><a   >Health History</a></li>
<li class="" id='dropdown21'><a  >Insurance Info</a></li>
</ul>

<div class="tab-content" id="myTabContent">
<?
$attr=array('class' => 'form-horizontal2');
echo form_open_multipart('patient_ctrl/insert_newfamily',$attr);
?>
<input type='hidden' name='param' id='param' value="familymember">
<input type='hidden' name='base_url' id='base_url' value="<?= base_url()  ?>">
<div  id="home" class="tab-pane fade active in">
<div class="row-fluid patient_history">
<h1>New Family Member Personal Details</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">

<div class="control-group">
<label class="control-label" for="inputEmail">Email :</label>
<div class="controls">
<?php echo form_input(array('id' => 'email', 'name' => 'email','placeholder' => 'Email','style'=>$style)); ?>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Photo: </label>
<div class="controls">
<ul class="thumbnails m-media-container">
<li class="span3">
<div class="caption">
<p style="margin-top:5px 0px;">
<img id="img1" src="">
<div class="caption">
<input type="file" name="userfile" class="ed" id="file1"><br/>
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
			 <?php echo form_input(array('id' => 'fname', 'name' => 'fname','placeholder' => 'Name','style'=>$style)); ?>
			</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
		<div class="controls">  
			 <?php echo form_input(array('id' => 'middle_initial', 'name' => 'middle_initial','placeholder' => 'Middle Initial Or Name','style'=>$style)); ?>
		</div>
	</div>
	
	<div class="control-group">
    <label class="control-label" for="inputEmail">Last Name</label>
    <div class="controls">
		 <?php echo form_input(array('id' => 'lname', 'name' => 'lname','placeholder' => 'Last Name','style'=>$style)); ?>
    </div>
	</div>
	<?
	$dddob=explode('-', $query->dob );
	$dob=$dddob[1].'/'.$dddob[2].'/'.$dddob[0];
$month='';
$day='';
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
<input type=text name=year style="width:60px" value="<?= $dddob[0] ?>">
</td>
</tr>
</table>

</div>

	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Gender</label>
		<div class="controls">
			<label class="radio inline">
			
					  <? echo form_radio('gender', $query->gender, TRUE);?>
					 Male
					  </label>
				
						<label class="radio inline">
					  <? echo form_radio('gender', $query->gender, FALSE);?>
					 Female</label> 
					
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
$h_m=$query->home_phone;
$h=explode('-',$h_m);
$c_m=$query->cell_phone;
$c=explode('-',$c_m);
$w_m=$query->work_phone;
$w=explode('-',$w_m);

$e_home=$query_emer->home_phone;
$e_h=explode('-',$e_home);

$e_cell=$query_emer->cell_phone;
$e_c=explode('-',$e_cell);

$e_work=$query_emer->work_phone;
$e_w=explode('-',$e_work);

?>		
	
	 <h1>What is your contact Info ? </h1>
	<div class="clearfix"></div>	 
   <div class="alert alert-info">At least one of threee phones is required </div>
   
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
		<label class="control-label" for="inputEmail">Referred By</label>
		<div class="controls">
		 <?php echo form_input(array('id' => 'referred_by', 'name' => 'referred_by','placeholder' => 'Referred By','style'=>$style)); ?>		
		</div>		
	</div>	

	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Preferred method of Contact</label>
		<div class="controls">
		 <?php echo form_input(array('id' => 'preferred_contact_mode', 'name' => 'preferred_contact_mode','placeholder' => 'NO','style'=>$style)); ?>		
		</div>		
	</div>	
</div> 
	<ul class="patients_rightnav">
<li>

<div class="btn-toolbar" style="float:left;position:relative;margin-left:50%;
text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:getnextpage('profile1')"> 
<i class="fa fa-arrow-right" ></i> Next</a>
</div>

</li>
</ul>

<!--</form>

		if ($pagename == 'patient_update')
		{ 
			echo form_submit(array('id' => 'submit', 'class' => 'btn btn-large btn-success', 'value' => 'Submit')); 
		} 
	-->
</div></div>

<div id="profile" class="tab-pane fade">
<div class="row-fluid patient_history">
 
<div style="margin-bottom:10px;" class="m-widget">
 <?
//$attr=array('class' => 'form-horizontal2');
//echo form_open('patient_ctrl/insert_profile',$attr);
?>
 
  <h1>Emergency Contact Person's Details for New Family Member</h1>
 <br>
	<div class="control-group">
		<label class="control-label" for="inputEmail">First Name</label>
		<div class="controls">
			<?php echo form_input(array('id' => 'emer_fname', 'name' => 'emer_fname','placeholder' => 'First Name','style'=>$style,'value'=>$query_emer->fname)); ?>
		</div>
	</div>
	
	
	  <div class="control-group">
		<label class="control-label" for="inputEmail"> Middle Initial Or Name</label>
		<div class="controls">
			<?php echo form_input(array('id' => 'emer_midname', 'name' => 'emer_midname','placeholder' => 'Middle Initial Or Name','style'=>$style,'value'=>$query_emer->middle_initial)); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Last Name</label>
		<div class="controls">
			<?php echo form_input(array('id' => 'emer_lname', 'name' => 'emer_lname','placeholder' => 'Last Name','style'=>$style,'value'=>$query_emer->lname)); ?>
		</div>
	</div>
	
	
	
	<h1> Emergency Contact Person's Contact Info for New Family Member </h1>
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
	<?php echo form_input(array('id' => 'emer_email', 'name' => 'emer_email','placeholder' => 'Email','style'=>$style,'value'=>$query_emer->email)); ?>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Relationship</label>
		<div class="controls">			
			<?php echo form_input(array('id' => 'emer_relation', 'name' => 'emer_relation','placeholder' => 'Relationship','style'=>$style)); ?>
		</div>
	</div>	
	 
	
	

	</div>
			<ul class="patients_rightnav">
<li>
<div class="btn-toolbar" style="float:left;position:relative;margin-left:40%;
text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:getnextpage('home1')"> 
<i class="fa fa-arrow-left"></i>  PREV</a>
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:getnextpage('dropdown11')"> 
<i class="fa fa-arrow-right" ></i> NEXT</a>
</div>
</li>
</ul>
 <!--</form>-->
	   
	
</div>
</div>
<div id="dropdown1" class="tab-pane fade">
<div class="row-fluid patient_history">




<h1>Your Weight and height </h1>
<div class="clearfix">  </div>
<div style="margin-bottom:10px;" class="m-widget">

 <!--<form class="form-horizontal2">-->
	<div class="control-group">
	<label class="control-label" for="inputEmail">Height (in inches)</label>
	<div class="controls">
	<input type="text" placeholder="00" name='height_inches' id='height_inches' value=''>
	</div>
	</div>
	<div class="control-group">
	<label class="control-label" for="inputPassword">Weight (in pounds)</label>
	<div class="controls">
		<input type="text" placeholder="00" name='weight_lbs' id='weight_lbs' value=''>
	</div>
	</div> 
	<!--</form>-->
	
	</div>
	
	
<div class="clearfix">  </div> 
	
 <h1>Your Health Status  </h1>

<div style="margin-bottom:10px;" class="m-widget">

 <!--<form class="form-horizontal2">-->
	<div class="control-group">
	<label class="control-label" for="inputEmail"> Are you in good health</label>
	<div class="controls">
	
					  <label class="radio inline">
					  <input type="radio" name="are_you_in_good_health" value="yes" id="goodhealth_0" checked>
					  Yes
					  </label>					
						<label class="radio inline">
					  <input type="radio" name="are_you_in_good_health" value="no" id="goodhealth_1" >
					  No</label>
					 		
	  
		 </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPassword">Are you now under the care of a physician ?</label>
		 <div class="controls">					
					
					  <label class="radio inline">
					  <input type="radio" name="under_physician_care" value="yes" id="under_physician_care" >
					  Yes
					  </label>					
						<label class="radio inline">
					  <input type="radio" name="under_physician_care" value="no" id="under_physician_care" checked>
					  No</label>	
					  
					  
	  
		 </div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputPassword">Physician's Telephone</label>
		<div class="controls">
		<input name="physician_phone1" id="physician_phone1"
 type="" value="" style="width:30px;height:20px" 
onkeypress="javascript:number_validation4physician(this,1)">&nbsp;-
<input name="physician_phone2" id="physician_phone2" type="" value=""  style="margin-left:10px;width:30px;height:20px" 
onkeypress="javascript:number_validation4physician(this,2)"/>&nbsp;-<input name="physician_phone3" id="physician_phone3" type="" 
value="" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4physician(this,3)"/>
		</div>
	</div>
	
	
	
	
	<div class="control-group">
		<label class="control-label" for="inputPassword"> Have you had any serious illness, operation or been hospitalized ? </label>
		 <div class="controls">
					<label class="radio inline">
					  <input type="radio" name="illness_operation_hospitalized"  id="illness_operation_hospitalized" value='yes' >
					  Yes
					  </label>	
				
						<label class="radio inline">
					  <input type="radio" name="illness_operation_hospitalized"  id="illness_operation_hospitalized" value='no' checked>
					  No</label>
					 
				
	  
		 </div>
	</div>
	
	<!--</form>-->
	
	</div>
	







<div class="clearfix">  </div> 
	
 <h1>Do you use alcohol, tobaco, drugs?  </h1>

<div style="margin-bottom:10px;" class="m-widget">

 <!--<form class="form-horizontal2">-->
	<div class="control-group">
	<label class="control-label" for="inputEmail">Do you drinks alcholic beverages ? </label>
	<div class="controls">
	
					<label class="radio inline">
					  <input type="radio" name="alcoholic_consumption" value="yes" id="alcoholic_consumption" >
					  Yes
					  </label>
				
						<label class="radio inline">
					  <input type="radio" name="alcoholic_consumption" value="no" id="alcoholic_consumption" checked>
					  No</label>				
	  
		 </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPassword">
Have you used any recreation drug in the last 6 months ?</label>
		<div class="controls">
		
					<label class="radio inline">
					  <input type="radio" name="recreation_drug_usage" value="yes" id="recreation_drug_usage" >
					  Yes
					  </label>				
						<label class="radio inline">
					  <input type="radio" name="recreation_drug_usage" value="no" id="recreation_drug_usage" checked>
					  No</label>
					  
				
	  
		 </div>
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="inputPassword">History of alcohol abuse ?</label>
		 <div class="controls">
		
					<label class="radio inline">
					  <input type="radio" name="alcohol_abuse" value="yes" id="alcohol_abuse" >
					  Yes
					  </label>				
						<label class="radio inline">
					  <input type="radio" name="alcohol_abuse" value="no" id="alcohol_abuse" checked>
					  No</label>
					  
	  
		 </div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputPassword"> 
		 Do you use smoke?  </label>
		<div class="controls">
		
					<label class="radio inline">
					  <input type="radio" name="smoke" value="yes" id="smoke" >
					  Yes
					  </label>
				
						<label class="radio inline">
					  <input type="radio" name="smoke" value="no" id="smoke" checked>
					  No</label>					 		
	  
		 </div>
	  </div>
	
	
	<div class="control-group">
		<label class="control-label" for="inputPassword"> 
		 Do you use tobacco?  </label>
		<div class="controls">
							<label class="radio inline">
					  <input type="radio" name="tobacco" value="yes" id="tobacco" >
					  Yes
					  </label>				
						<label class="radio inline">
					  <input type="radio" name="tobacco" value="no" id="tobacco" checked>
					  No</label>	
		 </div> 
	 </div>	
	<!--</form>-->
	</div>
<div class="clearfix">  </div> 
	
 <h1>Your medical condition  </h1>
 
 <p>Have you had currently have any of the following conditions? Check the ones that are applicable<br>
<table border=0>
<?
$prev_group='';$i=0;$j=0;
foreach($master_meta as $m)
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
<input type="checkbox" id="name_<?= $i?>" name="name_<?= $i?>" value="<?= $m->name ?>" ><?= $m->name ?>
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
<!--
	<strong>HEART CONDITION</strong>
 </p>

<div style="margin-bottom:10px;" class="m-widget">

	 
	<div class="control-group">
		 <label class="control-label">
	
			 <input type="checkbox" name="high_bp" id='high_bp' value="high_bp"		checked >
			   High Blood Pressure
			  
		  </label>
				
		<div class="controls">
			<label class="radio inline">
			
				 <input type="checkbox" name="low_bp" value="low_bp" id="low_bp" >
				 Low Blood Pressure				 
			</label>
		</div>
	</div>
	
	 
	
	<div class="control-group">
		 <label class="control-label">
		 
				 <input type="checkbox" name="angina_chest_pain" value="angina_chest_pain"  >
				Angina Chest Pain
		  </label>
				
		<div class="controls">
			<label class="radio inline">
			
					 <input type="checkbox" name="fainiting" value="fainiting" id='fainiting'  >
				 Fainting
			</label>
		</div>
	</div>
	
	
	
	<div class="control-group">
		 <label class="control-label">
		 
				<input type="checkbox" name="irregular_heartbeat" value="irregular_heartbeat" id='irregular_heartbeat' >
				Irregular Heartbeat
				
		  </label>
				
		<div class="controls">
			<label class="radio inline">
		
				 <input type="checkbox" name="heart_attack" id='heart_attack'  value="heart_attack">
				 Heart Attack
			</label>
		</div>
	</div>
	
	
	  <div class="control-group">
		 <label class="control-label">		
			   <input type="checkbox" name="heart_bypass" id='heart_bypass' value="heart_bypass" >
			   Heart Bypass			   
		  </label>
				
		<div class="controls">
			<label class="radio inline">
				<input type="checkbox" name="pacemaker" id='pacemaker' value="pacemaker" >
				Pacemaker
			</label>
		</div>
	</div>
	
	<div class="control-group">
		 <label class="control-label">	
			    <input type="checkbox" name="anemia" value="anemia" id='anemia' >
			   Anemla			  
		  </label>
				
	 
	</div>
	
	<div class="control-group">
		 <p><strong>LIVER DI & EA & E</strong></p>
			<label class="radio inline">
			  <input type="checkbox" name="hepatitis_a" value="hepatitis_a" id="hepatitis_a">
			  Hepatitis A
			  </label>

		
				<label class="checkbox inline">
			 <input type="checkbox" name="hepatitis_b" value="hepatitis_b" id="hepatitis_b " >
			 Hepatitis B
			 </label>
			 
			 <label class="radio inline">
			 <input type="checkbox" name="hepatitis_c" value="hepatitis_c" id="hepatitis_c" >
			 Hepatitis C
			 </label>
	</div>
	
	 <div class="control-group">
	 <p><strong>IMMUNOSUPPRESSED / BLOOD DISEASE</strong></p>
		 <label class="control-label">
			<input type="checkbox" name="hiv" id='hiv'  value="hiv" >
			  HIV-
		  </label>
				
		<div class="controls">
			<label class="radio inline">
				<input type="checkbox" name="aids"  id='aids' value="aids" >
				AIDS
			</label>
		</div>
	</div>
	
	<div class="control-group">
	  
		 <label class="control-label">
	  <input type="checkbox" name="std" value="std" id='std' >
			 Sexually Transmitted Disease
		  </label>
				
		<div class="controls">
			<label class="radio inline">
					<input type="checkbox" name="delay_in_healing" value="delay_in_healing"  id='delay_in_healing' >
				Delay in Healing
			</label>
		</div>
	</div>
	
	
	<div class="control-group">
			<p><strong>ORGAN CONDITION / DISEASE</strong></p>
		 <label class="control-label">
			  <input type="checkbox" name="pancreas_diabetes" value="ancreas_diabetes"  id='pancreas_diabetes' >
			 pancreas diabetes
		  </label>
				
		<div class="controls">
			<label class="radio inline">
				<input type="checkbox" name="kidney_dialysis" value="kidney_dialysis"  id='kidney_dialysis' >
				Kidney / Dialysis
			</label>
		</div>
	</div>
	
	<div class="control-group">		 
		 <label class="control-label">
			 <input type="checkbox" name="eyes_glaucoma" value="eyes_glaucoma"  id='eyes_glaucoma' >
			Eyes / Glaucoma
		  </label>
				
		<div class="controls">
			<label class="radio inline">
                  <input type="checkbox" name="thyroid" value="thyroid" id='thyroid'  >
				Thyroid

			</label>
		</div>
	</div>
	
	<div class="control-group">
		 
		 <label class="control-label">
		   <input type="checkbox" name="neurology_epilepsy" id='neurology_epilepsy' value="neurology_epilepsy">Neurology Epilepsy
		  </label>
   </div>
   
   
   <div class="control-group">
		 <p><strong>CANCER</strong></p>
		 <label class="control-label">
<input type="checkbox" name="cancer_location" id='cancer_location' value="cancer_location" >
		   Cancer Location
		  </label>
		  
				   
		<div class="controls">
		<div class='radio inline'>
			<input class="input-large" type="text" id='cancer_location_name'  name='cancer_location_name'  placeholder="Location" value='' >
			</div>
		</div>
   </div>
	<div class="control-group">
		 <label class="control-label">
<input type="checkbox" name="surgery" id='surgery'  value="surgery" >
			Surgery 
		  </label>
				
		<div class="controls">
			<label class="radio inline">
<input type="checkbox" name="radiation" value="radiation" id='radiation' >
				Radiation
			</label>
		</div>
	</div>
	
	
	 <div class="control-group">
		 <label class="control-label">
			<input type="checkbox" name="chemotherapy" value="chemotherapy"  id='chemotherapy' >
			Chemotherapy
		  </label>
				
		 
	</div>
	
	
	<div class="control-group">
		 <p><strong>JOINT CONDITION</strong></p>
		 <label class="control-label">
		  <input type="checkbox" name="jaw_joints_pain" value="jaw_joints_pain"  id='jaw_joints_pain' >
		  Clicking / Pain in jaw joints when eating
		  </label>
		<div class="controls">
			<label class="radio inline">
					<input type="checkbox" name="arthritis" id='arthritis'  value="arthritis" >
				Arthritis
			</label>
		</div>  
				   
		 
   </div>
	
	
	 <div class="control-group">
		 <label class="control-label">	
		 <input type="checkbox" name="arthritis_knee_replacement" value="arthritis_knee_replacement" >
		 Arthritis Knee Replacement
		  </label>
		<div class="controls">
			<label class="radio inline">
				<input type="checkbox" name="arthritis_hip_replacement" value="arthritis_hip_replacement"  id='arthritis_hip_replacement' >
				Arthritis Hip Replacement
			</label>
		</div>  
   </div>
	
	 <div class="control-group">
		 <label class="control-label">
         <input type="checkbox" name="swollen_ankles" id='swollen_ankles'  value="swollen_ankles" >
		Swollen Ankles
		  </label>
		
   </div>
   
	<div class="control-group">
		 <label class="control-label">
			 
		Other
		  </label>
		<div class="controls">
		<div class='radio inline'>
		  <input class="input-large" type="text" placeholder="..."  id='other' name='other'   value='' >
		  </div>
		</div>  





   </div>	

	</div>
-->
	
	   	<ul class="patients_rightnav">
<li>
<div class="btn-toolbar" style="float:left;position:relative;margin-left:40%;
text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:getnextpage('profile1')"> 
<i class="fa fa-arrow-left"></i>  PREV</a>
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:getnextpage('dropdown21')"> 
<i class="fa fa-arrow-right" ></i> NEXT</a>
</div>
</li>
</ul>
	   
	
</div>
</div>




	<div id="dropdown2" class="tab-pane fade">
	<div class="row-fluid patient_history">
	<div class="m-widget-body">

	<div class="row-fluid patient_history">
	<h1>Insurance Details of  Primary Insured</h1>
	<div class="clearfix"></div>
	<div style="margin-bottom:10px;" class="m-widget">
	
   <!--<form class="form-horizontal2">-->
	<div class="control-group">
	<label class="control-label" for="inputEmail">Name of Primary Insured</label>
	<div class="controls">
	<input type="text"  placeholder="Name" name='name_of_insured'  value="<?= $query_insur->name_of_insured ?>" >
	</div>
	</div>	
	
	<div class="control-group">
		<label class="control-label" for="inputPassword">Name Of The Patients </label>
		<div class="controls">
		<input type="text" placeholder="Name" value='<?= $query->fname ?>'   >
		</div>
	
	</div> 
	<!--</form>-->
	
	</div>
	
	
<div class="clearfix">  </div> 
	
 <h1>Primary Insurance  </h1>

<div style="margin-bottom:10px;" class="m-widget">

 <!--<form class="form-horizontal2">-->
	<div class="control-group">
	  <label class="control-label" for="inputPassword">Insurance Company </label>
   <div class="controls">
		<input type="text" placeholder=" Company Name"  value="<?= $query_insur->insurance_company ?>" name='insurance_company'>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPassword">Group ID</label>
		<div class="controls">
		<input type="text" placeholder="ID" value='<?= $query_insur->group_id ?>' name='group_id'>
		</div>
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="inputPassword">Member ID </label>
		<div class="controls">
		<input type="text" placeholder="ID" value='<?= $query_insur->member_id ?>' name='member_id'>
		</div>
	</div>	
	 
	
	<!--</form>-->
	
	</div></div>
	
<div class="clearfix">  </div> 

<div class="well">
	 <p>Upload photos/scanned image of insurance card
</p>
	<ul class="thumbnails m-media-container">
		<li class="span3" class='ed' >
<img id="img2"  src="">
<div class="caption">
<input type="file" name="ins1_userfile"   id="file2"><br/>
</div>
</li>
<li class="span3">
<ul class="thumbnails m-media-container">
<li class="span3">
<img id="img3"  src="">
<div class="caption">
<input type="file" name="ins2_userfile" id="file3"<br/>
</div>
</li>

	</ul>
</div>

<ul class="patients_rightnav">
<li>
<div class="btn-toolbar" style="float:left;position:relative;margin-left:40%;
text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:getnextpage('dropdown11')"> 
<i class="fa fa-arrow-left"></i>  PREV</a>
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:check_req_fields4newfamilymem()" > 
<i class="fa fa-arrow-right" ></i> SAVE</a>
</div>

</li>
</ul>	
	   
	</form>
</div>	</div>   
	
</div>
</div>

</div>
</div>

<div class="control-group">

</div>


<div class="clearfix"> </div>
</div>

<div class="span3 m-widget">
<ul class="patients_rightnav">
<li>
<button class="btn btn-large btn-warning" type="button" 
onClick='location.href="<?php echo base_url();?>patient_ctrl/appointments"' > <i class="fa fa-envelope-o"></i>  Request Appointment  </button>
</li>

<li>
<button class="btn btn-large btn-warning" type="button" onClick='location.href="<?php echo base_url();?>patient_ctrl/messages"' > <i class="fa fa-envelope-o"></i>  Send Message  </button>											
</li>
</ul>

<div class="clearfix"> </div>
<br>

<ul class="patients_rightnav">


<li>
<button onclick='location.href="<?php echo base_url();?>patient_ctrl/update_profile/home1"  '  class="btn btn-large btn-info" type="button"> <i class="fa fa-refresh"></i>Personal Info</button>
</li>

<li>
<button onclick='location.href="<?php echo base_url();?>patient_ctrl/update_profile/profile1" ' type="button" class="btn btn-large btn-info"> <i class="fa fa-refresh"></i>Emergency Info</button>
</li>

<li>
<button onclick='location.href="<?php echo base_url();?>patient_ctrl/update_profile/dropdown11" '  class="btn btn-large btn-info" type="button"><i class="fa fa-refresh"></i>Health History</button>											
</li>

<li>
<button onclick='location.href="<?php echo base_url();?>patient_ctrl/update_profile/dropdown21" '  class="btn btn-large btn-info" type="button"><i class="fa fa-refresh"></i>Insurance Info</button>											
</li>

<li>
<button onclick='location.href="<?php echo base_url();?>patient_ctrl/update_profile/familymember" ' class="btn btn-large btn-info" onclick=" location.href='profile.html#familymember'" type="button" ><i class="fa fa-refresh"></i> Family Member</button>
</li>

<li>
<button onclick='location.href="<?php echo base_url();?>patient_ctrl/update_profile/dental_history"' class="btn btn-large btn-info" onclick="location.href='profile.html#dental_history'" type="button" ><i class="fa fa-refresh"></i> Dental History</button>
</li>

</ul>


<div class="clearfix"> </div>
<div class="clearfix"> </div>
<div class="patients_social">

<a href="http://facebook.com/paperlessdentists" target="_blank"> <i class="fa fa-facebook"></i> </a> 


<a href="http://twitter.com/PaperlessD" target="_blank"><i class="fa fa-twitter"></i></a> 

</div>

</div>
</div>    





</section>
</div>
</div>
<div class="clearfix">
<div class="footer">
<span>Copyright &copy; 2017, Fluentsoft Technologies. All Rights Reserved	Terms Of Use </span>
</div>
</div>
</body>
<script>
function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img1').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img2').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img3').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#file1").change(function(){readURL1(this);});
$("#file2").change(function(){readURL2(this);});
$("#file3").change(function(){readURL3(this);});
</script>
</html>
