<!doctype html>
<html>
<head>
<title>paperlessdentists</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<script language="javascript" src="./js/crypt.js"></script>
<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type='text/javascript'>
function check_req_fields()
{
    var errmsg = '';
    if (document.forms[0].user_name.value.length == 0 || 
        document.forms[0].password.value.length == 0) 
    {
         errmsg = 'Missing UserName/Password\n';
    }
    document.forms[0].password.value = calcMD5(document.forms[0].password.value);
    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}
</script>
<script type="text/javascript" src="./js/main.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body style="" onload="document.getElementById('user_name').focus();">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span4"></div>
			<div class="span4">
				<div style="margin-top:200px;" class="container-fluid m-login-container">
					<div class="page-header">
						<h2 style="text-align:center;"> <img src="img/logo.png"> </h2>
				  </div>
<?
$attr=array('class' => 'form-horizontal2');
echo form_open('login/fetch_data',$attr);
$style='';
?>
						<input type="text" placeholder="Enter Email Id" class="span12" id="user_name" name="user_name" />
						<label></label><br>

						<input type="password" placeholder="Enter password" class="span12" id="password"
						name="password" />
						<label></label><br>
						
						<input type="text" placeholder="Enter Site ID" class="span12" id="siteid"
						name="siteid" />
						
						<div style="margin:0px;" class="span12">
			            <button type="submit" style="margin-top: 15px" class="btn btn-primary" onclick="javascript: return check_req_fields()">Login</button>  
			            <a style="margin-top:10px; position:relative; top:+10px;" href="<?php echo base_url();?>login/forgot_password">Forgot your password?</a>
                        </div>
<br>
<br>
<div align='center' style='margin-top:30px'>
Not a Member?&nbsp;&nbsp;SIGNUP
<!-- <a href="<?php echo base_url();?>registration_ctrl/">SIGNUP  -->
</a>
</div>
<div align='center' style='margin-top:10px'>
Sign up as Admin !! &nbsp;&nbsp;SIGNUP
<!-- <a href="<?php echo base_url();?>registration_ctrl/index1">SIGNUP </a> -->
</div>
</form>				
<?php 
$flash_message=$this->session->flashdata('flashMessage');
if(isset($flash_message))
{
   echo "<div style='color:red;'>$flash_message<div>";
}
?>

				</div>	

			</div>
			<div class="span4"></div>
		</div>
	</div>
</body>
</html>
