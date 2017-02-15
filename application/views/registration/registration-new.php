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

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type='text/javascript'>
function getnextpage(param)
{	
	
	
	if(check_req_fields4newregistration(param))
	{	
	   parameter=param;
	   $("#home").css({"display": "none"});
	   $("#profile").css({"display": "none"});
	   $("#dropdown1").css({"display":  "none"});
	   $("#dropdown2").css({"display": "none"});
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
	   //$("#myTab li#home1").removeClass("active");
	   //$("#myTab li#profile1").removeClass("active");
	   //$("#myTab li#dropdown11").removeClass("active");
	   //$("#myTab li#dropdown21").removeClass("active");

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
	$('html, body').animate({ scrollTop: 0 }, 20);
	}
}
$(document).ready(function() 
{
           $("#home").css({"display": "block"});
	   $("#profile").css({"display": "none"});
	   $("#dropdown1").css({"display":  "none"});
	   $("#dropdown2").css({"display": "none"});
	   $('#profile1').attr('disabled', true);
	   var url=(window.location.href);
	   var parameter =  url.split('/').pop();
var parameter =  url.substring(0,url.lastIndexOf("/")).split('/').pop();

document.forms[0].clinicid.value=parameter;
});

function getLocation(obj)
{ 	
	
    var loc=obj.value;
	//document.getElementById('location_name').value=$("#loc  option[value='" + loc +"']").text();
	$.get("<?php echo base_url();?>registration_ctrl/getdoc/"+loc, function (msg)
	{		
		
		op_slots = msg;
		var $select = $("#dct_name");
		$select.removeAttr("disabled");
		$select.find('option').remove();
		$.each(op_slots, function (key, value) 
		{
			$('<option>').val(key).text(value).appendTo($select);
			
		})
	})
}

</script>

<style>

.nav-tabs  li a:hover {
    border-left: #fff !important;
    border-right: #fff !important;
	border-top: #fff !important;
border-bottom: 1px #eee solid !important; color:#428BCA;
}

.nav li a:hover {
    text-decoration: none;
    background-color: #fff !important; color:#428BCA;}

</style>
<?
$style=' ';
?>
<link rel="stylesheet" type="text/css" href="css/font_awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font_awesome/css/font-awesome.css"/>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
</head>
<body>

<div id="dialog" title="Attention!" style="display:none">
   
</div>


<div class="main-container" style="margin-left:0px !important">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:10px 0px;"class="sub_title row-fluid">
<div class="span6"> <h1>Welcome to New Patient</h1></div> 
<div class="row-fluid">
<div class="span9">
<div class="m-widget dashbord_box" style="width:110%;margin-left:60px">
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
<?}?>
</h1></div>

<div class="m-widget-body"> 
<ul style="margin-bottom:-1px;" class="nav nav-tabs" id="myTab">

</ul>

<div class="tab-content" id="myTabContent">
<?
$attr=array('class' => 'form-horizontal2');
echo form_open_multipart('registration_ctrl/insert_newpatient',$attr);
?>
<input type='hidden' name='base_url' id='base_url' value="<?= base_url()  ?>">
<input type='hidden' id='segment' name='segment' value="<?= $segment ?>">
<div  id="home" class="tab-pane fade active in">
<div class="row-fluid patient_history">
<h1>New Patient Personal Details</h1>
<div class="clearfix"></div>
<div style="margin-bottom:10px;" class="m-widget">

<!-------------------------------added on march 30th--------------->
<div class="control-group">
<label class="control-label" for="inputEmail"><span class='asterisk'>*</span>Clinic :</label>
<div class="controls">
<?php if(isset($clinics))
{

$attributes1 = 'id="loc" class="input-xlarge" onChange="getLocation(this)" ';
$locnames  = $this->admin_model->getAllClinics();

echo form_dropdown('clinicid', $locnames,'',$attributes1);

}
else{
?>
<input type='hidden' name='clinicid' id='clinicid' value="">
<b><?= $clinic_name ?></b>
<?php
}
?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail"><span class='asterisk'>*</span>Doctor :</label>
<div class="controls">
<b>
<?php
if(isset($clinic))
{
?>
<select name="dct_name" id="dct_name" class="input-xlarge">
<option value=""></option>
<?php
}
else
{

$attributes2 = 'id="dct_name" class="input-xlarge" ';
$docsss  = $this->admin_model->getAllDocs(1);

echo form_dropdown('dct_name', $docsss,'',$attributes2);
}
?>

</select>
</b>
</div>
</div>

<!------------------------------>


<div class="control-group">
<label class="control-label" for="inputEmail"><span class='asterisk'>*</span>Email :</label>
<div class="controls">
<?php echo form_input(array('id' => 'email', 'name' => 'email','placeholder' => 'Email','style'=>$style)); ?>
</div>
</div>

	
	<div class="control-group">
	<label class="control-label" for="inputEmail"> <span class='asterisk'>*</span>Name</label>
		<div class="controls"> 
			 <?php echo form_input(array('id' => 'fname', 'name' => 'fname','placeholder' => 'Name','style'=>$style)); ?>
			</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputEmail">Middle Initial Or Name</label>
		<div class="controls">  
			 <?php echo form_input(array('id' => 'middle_initial', 'name' => 'middle_initial','placeholder' => 'Middle Initial Or Name','style'=>$style)); ?>
		</div>
	</div>
	
	<div class="control-group">
    <label class="control-label" for="inputEmail"><span class='asterisk'>*</span>Last Name</label>
    <div class="controls">
		 <?php echo form_input(array('id' => 'lname', 'name' => 'lname','placeholder' => 'Last Name','style'=>$style)); ?>
    </div>
	</div>		

	<div class="control-group">
    <label class="control-label" for="inputEmail"><span class='asterisk'>*</span>Cell Phone</label>
    <div class="controls">
		 <input name="cell_phone4peronal1" id="cell_phone4peronal1" type="" value="" style="width:30px;height:20px" onkeypress="javascript:number_validation4cellphone(this,1)">
   		 <input name="cell_phone4peronal2" id="cell_phone4peronal2" type="" value="" style="margin-left:10px;width:30px;height:20px" onkeypress="javascript:number_validation4cellphone(this,2)">
		 <input name="cell_phone4peronal3" id="cell_phone4peronal3" type="" value="" style="margin-left:10px;width:45px;height:20px " onkeypress="javascript:number_validation4cellphone(this,3)">		
    </div>
	</div>		
</div> 


<ul class="patients_rightnav">
<li>
<div class="btn-toolbar" style="float:left;position:relative;margin-left:45%;
text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:check_req_fields4newregistration1()" > 
SAVE</a>
</div>
</li>
</ul>	


</div>   

</form>
	
</div>
</div>

</div>
</div>

</div>
</div>    
</div></div>
</section>
</div>
</div>
<div class="clearfix">
<div class="footer">
<span>Copyright &copy; 2014, Paperless Dentists. All Rights Reserved	Terms Of Use </span>
</div>
</div>
</body>
<script>
function readURLx(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img1').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img_1').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img_2').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#file1").change(function(){readURLx(this);});
    $("#file_1").change(function(){readURL(this);});
    $("#file_2").change(function(){readURL1(this);});



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
