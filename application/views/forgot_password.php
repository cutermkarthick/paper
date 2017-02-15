<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--  Bootstrap related -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forgot Password&nbsp;&middot;&nbsp; Paperless Dentists</title>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="/portal/libs/htmlshiv5/html5shiv.js"></script>
<script src="/portal/libs/respond/respond.min.js"></script>
<![endif]-->

<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/style.css" />
<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/centered-cols.css" />
<script language="javascript" src="<?echo base_url()?>js/crypt.js"></script>
<script type="text/javascript" src="<?echo base_url()?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?echo base_url()?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?echo base_url()?>js/ddb_patients_view.js"></script>

<style type="text/css">
html {
/*position: relative;*/
min-height: 100%;
}

body {
padding-top: 5px;
padding-bottom: 5px;
margin-top: 5px;
margin-bottom: 15px;
}

.well-color {
color: #5a5a5a;
}

.topbuffer {
margin-top: 15px;
}

.topslimbuffer {
margin-top: 5px;
}

.topbottombuffer {
margin-top: 5px;
margin-bottom: 20px;
}

.toppaddedbuffer {
margin-top: 15px;
padding: 3px 3px 3px 3px;
}

.topslimpaddedbuffer {
margin-top: 5px;
padding: 3px 3px 3px 3px;
}
.btn-success4forgot_password {
    color: #FFF;
    background-color: #43B5CB;
    border-color: #43B5CB;
}


.bottomslimbuffer {
margin-bottom: 5px;
}

.topbottompaddedbuffer {
margin-top: 5px;
margin-bottom: 15px;
padding: 3px 3px 3px 3px;
}

.twosidebuffer {
margin-top:0px;
margin-left: 2px;
margin-right:2px;
margin-bottom: 0px;
}
.error-block {
display: block;
margin-top: 5px;
margin-bottom: 10px;
color: #ff0000;
}

.alert-block {
display: block;
margin-top: 5px;
margin-bottom: 10px;
color: #a94442;
background-color: #f2dede;
border-color: #ebccd1;
}

.spaced {
margin: 10px 0;
}

#calendar {
width: 100%;
margin: 0 auto;
}

.icon-red {
color: #ff0000;
}

#message {
background-color: #FFFFFF;
border: 1px solid #CCCCCC;
border-collapse: separate;
border-radius: 3px;
box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.075) inset;
box-sizing: content-box;
height: 250px;
max-height: 250px;
outline: medium none;
overflow: scroll;
padding: 4px;
}

.ellipsis {
text-overflow: ellipsis !important;
overflow: hidden;
white-space: nowrap;
/*display: block;*/
max-width: 200px;
}

.bold {
font-weight: bold;
}

.medicalAlert {
color: red !important;
font-weight: bold !important;
}

.cursor-pointer:hover {
cursor: pointer;
cursor: hand;
}


td.highlight {
font-weight: bold;
color: black;
}

td.unhighlight {
font-weight: normal;
color: black;
}

/* Sticky footer styles
-------------------------------------------------- */
html,body {
height: 100%;
/* The html and body elements cannot have any padding or margin. */
}

/* Wrapper for page content to push down footer */
#wrap {
min-height: 100%;
height: auto !important;
height: 100%;
/* Negative indent footer by its height */
margin: 0 auto -50px;
/* Pad bottom by footer height */
padding: 0 0 50px;
}

#footer {
width: 100%;
height: 50px;
}

/* UNCOMMENT THIS SECTION TO SEE THE COLUMNS IN GREEN COLOR VISUALLY */

/* [class*="col-"] {
padding-top:5px;
padding-bottom:5px;
border:1px solid #80aa00;
background:#d6ec94;
}
[class*="col-"]:before {
display:block;position:relative;
content:"";
margin-bottom:4px;
font-family:sans-serif;
font-size:10px;
letter-spacing:1px;
color:#658600;
text-align:left;
}    */
</style>
</head>
<!-- <body style="margin-bottom: 70px;"> -->
<body>
<div id="wrap">











<div class="container">
<div class="row row-centered">
<div class="col-xs-10 col-md-10 col-lg-10 col-centered">
<div class="row-centered item">
<a href='/portal/'> 

<img src="<? echo base_url()?>img/logo.png">



</a>
</div>		
</div>
</div>
<div class="row row-centered topbuffer">
<div class="col-xs-10 col-md-10 col-lg-10 col-centered">
<div class="panel panel-primary">
<div class="panel-heading clearfix">

</div>
</div>
</div>
</div>

</div>
<div class="topslimbuffer">&nbsp;</div>

<script type="text/javascript">
$(document)
.ready(
function() {
/* Event handler for the MyDentist button. Take patient to the My Dentist tab */
$('#btnMyDentist').on('click', function() {
$('#patientProfileTabs a[href="#tabMYDENTIST"]').tab('show');
history.pushState(null, null, "#tabMYDENTIST");
});

count = 0;
try {
var familyMembers = JSON.parse('');
familyDropdown = $("#family_dropdown");
for ( var id in familyMembers) {
	var url = "/portal/userprofiles/showFamily/" + id + "";
	var classname = "fa fa-user";
	if ('' == id) {
		classname = "fa fa-check";
	}
	familyDropdown
			.append($("<li class='divider'></li><li><a href='"+url+"'><i class='" + classname + "'></i> "
					+ familyMembers[id] + "</a></li>"));
	count++;
}
} catch (exception) {
/*Ignore*/
}

if (count == 0) {
$("#family_button").addClass("hide");
}

});
</script>




<div class="container">
<div class="row row-centered" id="row-top-forgot-password">

<div class="col-xs-8 col-md-6 col-centered" id="col-top-forgot-password">

<?
$attr=array('class' => 'form-horizontal2');
echo form_open('login/fetch_updatedpassword',$attr);
$style='';
?>

<input type="hidden" name="action" value="sendResetPasswordEmail" />

<div class="panel panel-primary" id="panel-primary-forgot-password">
<div class="panel-heading text-center">
<h3 class="panel-title">Forgot Password?</h3>
</div>
<div class="panel-body" id="panel-body-forgot-password">
<p class="text-center">
<b>If you have forgotten your password, please enter your email below and click Submit.</b>
</p>
<div class="topbottombuffer">&nbsp;</div>
<div class="form-group">

<label for="oldpassword" class="col-sm-3 control-label">Email Id:</label>
<div class="col-sm-9">
	<input type="text" class="form-control input-sm" id="email" name="email" autofocus="autofocus" autocomplete="off" placeholder="Enter your email" required="required">
</div>
</div>
</div>

</div>


<div class="row row-centered topbottombuffer">
<div class="col-xs-6 col-md-4 col-centered">
<span class="alert-block" id="error-summary-bottom-emergency"></span>
<div class="row row-centered spaced">
<div class="col col-centered">


<a class="btn btn-success4forgot_password btn-lg"  style="padding:5px 14px" id="btnNextContact" onclick="javascript:check_req_fields4password()" > 
<i class="fa fa-arrow-right" ></i>Submit</a>

</div>
</div>
</div>
</div>

</form>

<script type="text/javascript">
var validatorPassword =  $("#formforgotpassword").validate({
onsubmit: true,
rules:	{
email: {
required: true,
email: true
}
},

messages: {
email:	"Enter a valid Email address"
},

highlight: function(element){
$(element).closest('.form-control').addClass('has-error');
}, 

unhighlight: function(element) {
$(element).closest('.form-control').removeClass('has-error');
},
errorElement: 'span',
errorClass: 'alert-block',
errorPlacement: function(error, element) {
if(element.parent('.form-control').length) {
error.insertAfter(element.parent());
} else {
error.insertAfter(element);
}
}
});
</script>

</div>

</div>

</div>
<div class="toprowbuffer">&nbsp;</div>
</div>
</div>
</div>
</div>

</body>

</html>
