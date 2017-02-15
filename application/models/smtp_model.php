<?php
//==============================================
// Author: FSI                                 
// Date-written = Feb 07, 2015                 
// Filename: smtp_model.php                   
// Copyright of Fluent Technologies           
// Sending mail during registration,
//  appointment should be done here      
//==============================================

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class smtp_model extends CI_Model
{
    function __construct()
	{
		parent::__construct();
		$this->load->database("paperless");		
		//include("Twilio.php");
	}
    var   $appt_date,
          $appt_time,
          $dct_name,
          $location,
	      $email,
	      $password,
          $name,
          $clinicid,
          $site_id,
          $appt,
          $duration,
          $purpose,
          $clinic_name,
          $patient_insur,
		  $docid,
          $remarks;
   function smtp_model() 
   {
        $this->appt_date = '';
        $this->appt_time = '';
        $this->dct_name = '';
        $this->location='';
		$this->email='';
		$this->password='';
        $this->name='';
        $this->clinicid='';
        $this->site_id='';
		$this->appt='';
        $this->clinic_name='';
        $this->patient_insur='';
        $this->remarks='';
		$this->docid='';
   }
	function setdocid($docid)
	{
		$this->docid=$docid;
	}
	function getdocid()
	{
		return $this->docid;
	}
	function setremarks($remarks)
   {
           $this->remarks = $remarks;
   }  
   function setpatient_insur($patient_insur)
   {
           $this->patient_insur = $patient_insur;
   } 
   function setclinic_name($clinic_name)
   {
           $this->clinic_name = $clinic_name;
   } 
   function setsite_id($site_id)
   {
           $this->site_id = $site_id;
   }
   function setappt($appt)
   {
	   $this->appt = $appt;
   }
   function setclinicid($clinicid)
   {
           $this->clinicid = $clinicid;
   }
   function setname($name)
   {
           $this->name = $name;
   }
   function setemail($email)
   {
           $this->email = $email;
   }
   function setpassword($password) 
   {
           $this->password = $password;
   }
   function setappt_date  ($appt_date )
	{
	$appt_date=date("mm/dd/yyyy",$appt_date);
           $this->appt_date  = $appt_date ;
	   }
	function setappt_time($appt_time) {
			   $this->appt_time = $appt_time;
		}
	function setdct_name($dct_name) {
			   $this->dct_name = $dct_name;
		}
	function setlocation($location) {
			   $this->location = $location;
		}
   function setduration($duration)
   {
           $this->duration = $duration;
   }
	function setpurpose($purpose)
	{
	$this->purpose=$purpose;
	}

   function getmail_details($recnum)
   {
	$appt_date = "'" . $this->appt_date . "'";
	$appt_time = "'" . $this->appt_time . "'";
	$dct_name = "'" . $this->dct_name . "'";
	$location = "'" . $this->location . "'";
	date_default_timezone_set('America/Los_Angeles');
	$date=date_format(date_create($this->appt_date ), 'M j, Y');
	$sql=mysql_query("select * from appointments where recnum=$recnum");
	$row=mysql_fetch_array($sql);
	$sql1=mysql_query("select * from patient_info where recnum=$row[11]");
	$row1=mysql_fetch_array($sql1);
	$sql2=mysql_query("select * from clinic where recnum=$row[16]");
	$row2=mysql_fetch_array($sql2);
        //$userid=$this->session->userdata('userid');
	$Hospitaldentist=$row['doctor'];
	$appdate=$row['appt_date'];
	$apptime=$row['appt_time'].' , '.$row['appt_duration'].' minutes duration';
	$clinicname=$row2[2];
	$dentistname='Dentist name';
	$name=$row1[1].' '.$row1[2].' '.$row1[3];
	//$Hospitaldentist=$row[1].'<br>'.$row2[2];
	$loc=$row['location'];
	$reason=$row['reason'];
        $email=$row1['email'];

$clinic_loc=$row2['name'].' '.$row2['site_id'];
$dentist_URL="http://".$_SERVER['SERVER_NAME'];

$loc=$row2['site_id'].'<br>'.$row2['addr1'].' '.$row2['addr2'].'<br> '.$row2['city'].'<br>'.$row2['state'];

$msg="We are pleased to confirm your appointment as requested. 
<br><b><u>Patient Information</u></b>
 <br>
$name
 <br>
<b><u>Your appointment</u></b>
 <br>
Date: $appdate
<br>
Time: $apptime
<br>
With:  $row[1]
<br>
Location:  $loc
<br>
Type: $reason
<br>

 <b><u>Cancellation Information </u></b>
 <br>
To cancel this appointment click <a href='http://www.paperlessdoctor.com/login'>here</a> to login to your patient portal.
<br>To cancel or reschedule by phone call your dentist at (xxx)nxxx-xxxx<br>
As a reminder, we are here for you and you can always send Secure Messages to us by logging on to http://www.paperlessdentists.com/portal";

	//ob_start();  
	$tt = file_get_contents('template.template',true);
	//echo $contactStr = ob_get_clean();
	$tt = str_replace("{{clinicname}}",$clinicname,$tt);
	$tt = str_replace("{{dentistname}}",$dentistname,$tt);
	$tt = str_replace("{{name}}",$name,$tt);
        $tt = str_replace("{{clinic_location}}",$clinic_loc,$tt);
        $tt = str_replace("{{dentist_URL}}",$dentist_URL,$tt);
	$tt = str_replace("{{msg}}",$msg,$tt);
	$tt= str_replace("{{Hospitaldentist}}",$Hospitaldentist,$tt);
	$tt=str_replace("{{basePath}}",$dentist_URL,$tt);
        //echo $email;
        //echo $tt;
        //exit();
        $header="Your appointment confirmation";
        $headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
        $headers .= "MIME-Version: 1.0" . " \r\n";
        $headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($this->email, 'Your New Password...', $tt))
	if(mail($email, 'Your Appt Confirmation', $tt,$headers))
	{
		    
	}
        else
        {
           echo "Email Error....Call Sysadmin";
        }
    }
	function getpassword_details()
	{
	$clinicname=$this->clinicid;
	$dentistname='Dentist name';
	$Hospitaldentist=$this->clinic_name;
	$name=$this->name;
        $email=$this->email;
        $new_email=md5($email);

        $email=($email);
        //$base_email=base_convert($value[1],16,2);
        $host_name=$_SERVER['SERVER_NAME'];
	
		$msg="
Please click on the URL below or copy and paste the URL into the address bar of your browser to change your password :
<a href='http://$host_name/paperless/login/forgotpassword/$new_email'>http://$host_name/paperless/login/forgotpassword/$new_email</a>
If you have not requested a password reset, please let us know at info@paperlessdentists.com";
	
	$tt = file_get_contents('template.template',true);
	//echo $contactStr = ob_get_clean();
	$tt = str_replace("{{clinicname}}",$clinicname,$tt);
	$tt = str_replace("{{dentistname}}",$dentistname,$tt);
    $tt = str_replace("{{clinic_location}}",$clinicname,$tt);
    $tt = str_replace("{{dentist_URL}}",$host_name,$tt);
	$tt = str_replace("{{name}}",$name,$tt);
	$tt = str_replace("{{msg}}",$msg,$tt);
	$tt= str_replace("{{Hospitaldentist}}",$Hospitaldentist,$tt);
	$tt=str_replace("{{basePath}}",$host_name,$tt);

        $headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
        $headers .= "MIME-Version: 1.0" . " \r\n";
        $headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($this->email, 'Your New Password...', $tt))
	if(mail($email, 'Your New Password...', $tt,$headers))
	{
		    
	}
        else
        {
           echo "Email Error....Call Sysadmin";
        }
}

	function setmailtoadmin()
	{
		$clinicid=$this->clinicid;
		
		$email = $this->email ;
		$dentist_URL="http://".$_SERVER['SERVER_NAME'];
		$clinicloc ="";
		$dentistname ="";
		$name ="Sir";

		$msg="
	
	We welcome you to our Paperless office. <Br>
	You are the admin.<Br>
	Go ahead, check it out http://www.paperlessdentists.com/portal <br>
	Your password : $this->password  and  <br>E-mail: $this->email. <br>Now you can login with this email and password";
	
	$dentist_URL="http://".$_SERVER['SERVER_NAME'];
	$tt = file_get_contents('template.template',true);
	$tt = str_replace("{{clinicname}}",$clinicid,$tt);
    $tt = str_replace("{{clinic_location}}",$clinicloc,$tt);
	$tt = str_replace("{{dentistname}}",$dentistname,$tt);
	$tt = str_replace("{{name}}",$name,$tt);
	$tt= str_replace("{{dentist_URL}}",$dentist_URL,$tt);	
	
	$tt = str_replace("{{msg}}",$msg,$tt);
	echo $tt ;
	exit ;
	$subject="Welcome To ".$this->site_id;
	$headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
	$headers .= "MIME-Version: 1.0" . " \r\n";
	$headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($email, 'Your New Password...', $tt))
	//{
	if(mail($this->email, $subject, $tt,$headers))
	{
		    
	}
	
        else
        {
           echo "Email Error....Call Sysadmin";
        }
		
	}
	
     function getregisted_details()
	{
	$clinicname=$this->clinicid;
	$docid=$this->docid;
	$email = $this->email ;
	$query = $this->db->query("select * from doctor where recnum=$docid");
	$res = $query->first_row();
	$dentistemail=$res->email;	
	$dentistname=$res->fname.' '.$res->lname;
	$name=$this->name;
    $clinicloc=$this->site_id." ".$this->clinicid;
	$Hospitaldentist=$dentistname.'<br>'.$clinicname;
	$dentist_URL="http://".$_SERVER['SERVER_NAME'];
	$msg="
	
	We welcome you to our Paperless office.
	You now have the power to communicate with us online around the clock – 24 by 7.<br>
	You can now:<br>
	Manage your Personal profile online.<br>
	Update Medical History, Insurance info anytime.<br>
	Request appointments online<br>
	Receive Email and SMS appointment Reminder<br>
	Send Secure Messages <br>
	and more…<br><br>
	Go ahead, check it out http://www.paperlessdentists.com/portal <br>
	We are here for you should you have any questions.<br>
	Your password : $this->password  and  <br>E-mail: $this->email. <br>Now you can login with this email and password";

	//ob_start();  
	$tt = file_get_contents('template.template',true);
	//echo $contactStr = ob_get_clean();
	$tt = str_replace("{{clinicname}}",$clinicname,$tt);
    $tt = str_replace("{{clinic_location}}",$clinicloc,$tt);
	$tt = str_replace("{{dentistname}}",$dentistname,$tt);
	$tt = str_replace("{{name}}",$name,$tt);
	$tt = str_replace("{{msg}}",$msg,$tt);
	$tt= str_replace("{{Hospitaldentist}}",$Hospitaldentist,$tt);
	$tt= str_replace("{{dentist_URL}}",$dentist_URL,$tt);
//	echo $tt=str_replace("{{basePath}}",$dentist_URL,$tt);


	$subject="Welcome To ".$this->site_id;
	$headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
	$headers .= "MIME-Version: 1.0" . " \r\n";
	$headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($email, 'Your New Password...', $tt))
	//{
	if(mail($this->email, $subject, $tt,$headers))
	{
		    
	}
	
        else
        {
           echo "Email Error....Call Sysadmin";
        }
/*********8888sending message to doctor****************/

	$Hospitaldentist=$clinicname;
	$msg="

	New Patient $name is Registered Under the clinic $clinicloc . Login to view the details of registered patient.";
	$tt = file_get_contents('template.template',true);
	//echo $contactStr = ob_get_clean();
	$tt = str_replace("{{clinicname}}",$clinicname,$tt);
    $tt = str_replace("{{clinic_location}}",$clinicloc,$tt);
	$tt = str_replace("{{dentistname}}",$dentistname,$tt);
	$tt = str_replace("{{name}}",$dentistname,$tt);
	$tt = str_replace("{{msg}}",$msg,$tt);
	$tt= str_replace("{{Hospitaldentist}}",$Hospitaldentist,$tt);
	$tt= str_replace("{{dentist_URL}}",$dentist_URL,$tt);
	$tt=str_replace("{{basePath}}",$dentist_URL,$tt);


	$subject="New Patient Registration in ".$this->site_id;
	$headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
	$headers .= "MIME-Version: 1.0" . " \r\n";
	$headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($this->email, 'Your New Password...', $tt))
	
	if(mail($dentistemail, $subject, $tt,$headers))
	{
		    
	}
	
	
        else
        {
           echo "Email Error....Call Sysadmin";
        }

    }
    function getappt_details()
	{
	date_default_timezone_set('America/Los_Angeles');
	$date=date_format(date_create($this->appt), 'M j, Y');
	$clinicname=$this->clinicid;
	$dentistname=$this->dct_name;
        $location=$this->site_id;
	$name=$this->name;
	$Hospitaldentist=$dentistname.'<br>'.$clinicname;
	$durl="http://".$_SERVER['SERVER_NAME'];
	$dentist_URL="<a href='$durl/portal'>$durl/portal</a>";
	$msg="Your Appointment request with $this->clinicid on $date is received";
	//ob_start();  
	$tt = file_get_contents('template.template',true);
	//echo $contactStr = ob_get_clean();
	$tt = str_replace("{{clinicname}}",$clinicname,$tt);
	$tt = str_replace("{{dentistname}}",$dentistname,$tt);
       $tt = str_replace("{{clinic_location}}",$location,$tt);
	$tt = str_replace("{{name}}",$name,$tt);
	$tt = str_replace("{{msg}}",$msg,$tt);
	$tt = str_replace("{{Hospitaldentist}}",$Hospitaldentist,$tt);
	$tt = str_replace("{{dentist_URL}}",$dentist_URL,$tt);
	$tt=str_replace("{{basePath}}",$durl,$tt);

        $subject="Appointment request with ".$this->site_id;
        $headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
        $headers .= "MIME-Version: 1.0" . " \r\n";
        $headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($this->email, 'Your New Password...', $tt))
	if(mail($this->email, $subject, $tt,$headers))
	{
		    
	}
        else
        {
           echo "Email Error....Call Sysadmin";
        }
    }
    function getappt_details2doctor()
	{
	date_default_timezone_set('America/Los_Angeles');
	$date=date_format(date_create($this->appt), 'M j, Y');
	$clinicname=$this->clinicid;
	$dentistname=$this->dct_name;
	$Hospitaldentist=$clinicname;
	$name=$this->name;
	$time=$this->appt_time;
	$duration=$this->duration;
	$location=$this->site_id;
	$purpose=$this->purpose;
$patient_insur=$this->patient_insur;
$remarks=$this->remarks;
	$durl="http://".$_SERVER['SERVER_NAME'];
	$dentist_URL="<a href='$durl/portal'>$durl/portal</a>";



	$msg="You have a new appointment to confirm. Once you confirm, we will send a confirmation to the patient. You may also want to mark this appointment confirmed in the practice management system.<br>
Patient: $name
<br>
Appointment With:  Dr $dentistname
<br>
Date: $date
<br>
Time: $time.' , '$duration.' minutes duration'
<br>
Location: 
 $location
<br>
Type: $purpose
<br>
Reason: $remarks
<br>
Insurance: $patient_insur
<br>
<Confirm Button> 
Please click here to confirm.
<br>
If you cannot confirm, you can cancel the request.";
	//ob_start();  
	$tt = file_get_contents('template.template',true);
	//echo $contactStr = ob_get_clean();
	$tt = str_replace("{{clinicname}}",$clinicname,$tt);
        $tt = str_replace("{{clinic_location}}",$this->site_id,$tt); 
	$tt = str_replace("{{dentistname}}",$dentistname,$tt);
	$tt = str_replace("{{name}}",$dentistname,$tt);
	$tt = str_replace("{{msg}}",$msg,$tt);
	$tt= str_replace("{{Hospitaldentist}}",$Hospitaldentist,$tt);
	$tt = str_replace("{{dentist_URL}}",$dentist_URL,$tt);
	$tt=str_replace("{{basePath}}",$durl,$tt);
        $subject="You have a new appointment to confirm!";
        $headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
        $headers .= "MIME-Version: 1.0" . " \r\n";
        $headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($this->email, 'Your New Password...', $tt))
	if(mail($this->email, $subject, $tt,$headers))
	{
		    
	}
        else
        {
           echo "Email Error....Call Sysadmin";
exit();
        }
  }
function getmessagedetails()
	{
	date_default_timezone_set('America/Los_Angeles');
	$date=date_format(date_create($this->appt), 'M j, Y');
	$clinicname="Paperless Dentist";
	$dentistname='Dentist name';
	$Hospitaldentist='Paperless Dentist';
	$name=$this->name;
	$durl="http://".$_SERVER['SERVER_NAME'];
	$dentist_URL="<a href='$durl/portal'>$durl/portal</a>";


	$msg="This is a notification that there is a new message for you.
Please login to <a href='https://PaperlessDentists.com/portal'>https://PaperlessDentists.com/login</a> and click on Messages to view.";
	//ob_start();  
	$tt = file_get_contents('template.template',true);
	//echo $contactStr = ob_get_clean();
	$tt = str_replace("{{clinicname}}",$clinicname,$tt);
	$tt = str_replace("{{dentistname}}",$dentistname,$tt);
	$tt = str_replace("{{name}}",$name,$tt);
	$tt = str_replace("{{msg}}",$msg,$tt);
	$tt= str_replace("{{Hospitaldentist}}",$Hospitaldentist,$tt);
	$tt= str_replace("{{dentist_URL}}",$dentist_URL,$tt);
	$tt=str_replace("{{basePath}}",$durl,$tt);

        $subject="You have a new Message!";
        $headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
        $headers .= "MIME-Version: 1.0" . " \r\n";
        $headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($this->email, 'Your New Password...', $tt))
	if(mail($this->email, $subject, $tt,$headers))
	{
		    
	}
        else
        {
           echo "Email Error....Call Sysadmin";
        }
}
function appreminder()
	{

$d=date('Y-m-d');

	$qury="select * from appointments where appt_date='$d'";
	$sql=mysql_query($qury);
	while($row=mysql_fetch_array($sql))
	{

	if($row[9]==1)//mail reminder is on
	{
	$query="select * from patient_info where recnum=$row[11]";
	$result1=mysql_query($query);
	if($row1=mysql_fetch_array($result1))
	{
	$name=$row1[1].' '.$row1[2].' '.$row1[3];	
	}
	$query2="select * from clinic where recnum=$row[16]";
	$result2=mysql_query($query2);
	if($row2=mysql_fetch_array($result2))
	{
	$clinicname=$row2[2];
	}
	
	date_default_timezone_set('America/Los_Angeles');
	$date=date_format(date_create($this->appt), 'M j, Y');
	$dentistname=$row[1];
	$Hospitaldentist=$row[1].'<br>'.$clinicname;

	$durl="http://".$_SERVER['SERVER_NAME'];
	$dentist_URL="<a href='$durl/portal'>$durl/portal</a>";


	$msg="This is friendly reminder that you have a following appointment:

 <br>
Patient Information:
 <br>
$name
 <br>
Your appointment
 <br>
Date: $row[2]
Time: $row[3]
With:  $row[1]
<br>
Location: 
 $row[7]
<br>
Reason: $row[5]
<br>
<Confirm Button> 
Please click here to confirm.


 Cancellation Information 
 
To cancel this appointment click here to login to your patient portal.
To cancel or reschedule by phone call your dentist at (xxx)nxxx-xxxx
As a reminder, we are here for you and you can always send Secure Messages to us by logging on to http://www.paperlessdentists.com/portal";
	//ob_start();  
	$tt = file_get_contents('template.template',true);
	//echo $contactStr = ob_get_clean();
	$tt = str_replace("{{clinicname}}",$clinicname,$tt);
	$tt = str_replace("{{dentistname}}",$dentistname,$tt);
	$tt = str_replace("{{name}}",$name,$tt);
	$tt = str_replace("{{msg}}",$msg,$tt);
	$tt= str_replace("{{Hospitaldentist}}",$Hospitaldentist,$tt);
	$tt= str_replace("{{dentist_URL}}",$dentist_URL,$tt);
	$tt=str_replace("{{basePath}}",$durl,$tt);

        $subject="Your Appointment Reminder";
        $headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
        $headers .= "MIME-Version: 1.0" . " \r\n";
        $headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($this->email, 'Your New Password...', $tt))
	if(mail($this->email, $subject, $tt,$headers))
	{
		    
	}
        else
        {
           echo "Email Error....Call Sysadmin";
        }
}
	if($row[8]==1)//sms reminder is on
	{
	try{
		//$sid = id for msg servie;// these two variables are set from external file.
		//$token = "{{ auth_token }}";
	echo $account_sid = $GLOBALS['sid'];
	echo $auth_token = $GLOBALS['token'];
	$client = new Services_Twilio($account_sid, $auth_token); 
	 
	$client->account->messages->create(array( 
		'To' => "+919562629750", 
		'From' => "+14848134926", 
		'Body' => "You have an appointment today",   
	));
	}
	catch(Exception $e)
	{
		echo "Error: ".$e->getMessage();
		exit();
	}	
	}

	}
	}

function bdayreminder()
{

	$d=date('m-d');

	$qury="select * from patient_info";
	$sql=mysql_query($qury);
	while($row=mysql_fetch_array($sql))
	{
	
	if(date('m-d') == substr($row[9],5,5))
	{

	$query1=mysql_query("select name from clinic where recnum=$row[17]");
	if($row1=mysql_fetch_array($query1))
	{
	$clinicname=$row1[0];
	}	
	$query2=mysql_query("select fname from doctor where recnum=$row[16]");
	
	if($row2=mysql_fetch_array($query2))
	{
	   $dentistname=$row2[0];
	}

	$Hospitaldentist=$dentistname.'<br>'.$clinicname;
	$name=$row[1].' '.$row[2].' '.$row[3];
	$durl="http://".$_SERVER['SERVER_NAME'];
	$dentist_URL="<a href='$durl/portal'>$durl/portal</a>";


	$msg="Have a wonderful Birthday ! We hope that you have a great day and we look forward to seeing you soon !";
	//ob_start();  
	$tt = file_get_contents('template.template',true);
	//echo $contactStr = ob_get_clean();
	$tt = str_replace("{{clinicname}}",$clinicname,$tt);
	$tt = str_replace("{{dentistname}}",$dentistname,$tt);
	$tt = str_replace("{{name}}",$name,$tt);
	$tt = str_replace("{{msg}}",$msg,$tt);
	$tt = str_replace("{{Hospitaldentist}}",$Hospitaldentist,$tt);
	$tt = str_replace("{{dentist_URL}}",$dentist_URL,$tt);
        $subject="Happy Birthday";
        $headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
        $headers .= "MIME-Version: 1.0" . " \r\n";
        $headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($this->email, 'Your New Password...', $tt))
	if(mail($this->email, $subject, $tt,$headers))
	{
		    
	}
        else
        {
           echo "Email Error....Call Sysadmin";
        }
	}
      }
}

function send_updates($doctormail,$infos,$healths,$additional)
{
	$durl="http://".$_SERVER['SERVER_NAME'];
	$dentist_URL="<a href='$durl/portal'>$durl/portal</a>";


	$msg="<br> Your Patient <b>".$infos->fullname."'s</b> Health History has been updated. Details below<br><br>";
	$msg.="<b>Name:</b>\t\t".$infos->fullname."<br>";
	$msg.="<b>Address:</b>\t\t".$infos->addr1.", ".$infos->city.", ".$infos->state.", ".$infos->zip."<br>";
	$msg.="<b>Date Of Birth:</b>\t\t".$infos->dob."\t<b>Gender:</b>".$infos->gender."<br><br>";
	$msg.="<b>Health Summary</b><br><br>";
	$msg.="<b>Is Health Condition good:</b>?: ".$healths->are_you_in_good_health."<br>";
	$msg.="<b>Still under physicians care</b>?: ".$healths->under_physician_care."<br>";
	$msg.="<br> Logon to our website to check more updations from ".$infos->fullname;
	//ob_start();  
	$tt = file_get_contents('template.template',true);
	//echo $contactStr = ob_get_clean();
	$tt = str_replace("{{clinicname}}",$additional->clinicname,$tt);
	$tt = str_replace("{{dentistname}}",$additional->docname,$tt);
	$tt = str_replace("{{name}}",$additional->docname,$tt);
	$tt = str_replace("{{msg}}",$msg,$tt);
	$tt = str_replace("{{Hospitaldentist}}",$additional->clinicname,$tt);
	$tt = str_replace("{{dentist_URL}}",$dentist_URL,$tt);
        $subject="Patient Health History Updated";
        $headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
        $headers .= "MIME-Version: 1.0" . " \r\n";
        $headers .= "Content-type:text/html" . " \r\n";
	//if(smtp_mail($this->email, 'Your New Password...', $tt))

	if(mail($this->email, $subject, $tt,$headers))
	{
		    
	}
        else
        {
           echo "Email Error....Call Sysadmin";
        }
	
}


function preventivecheckupmail()
{
	$today = date('Y-m-d') ;
	$qury="select * from appointments a where a.status IN ('Closed', 'Confirmed') group by a.link2patientinfo order by a.appt_date asc";
	$sql=mysql_query($qury);
	$appdate1 ='';
	$appdate2 = '';
	while($row=mysql_fetch_array($sql))
	{
		$link2patient = $row[11] ;
		$link2clinic  = $row[16] ;
		$link2doctor  = $row[19] ;
		$appdate      = $row[2]  ;
		$appdate1 = date('Y-m-d', strtotime("+6 months", strtotime($appdate)));
		$appdate2 = date('Y-m-d', strtotime("-1 day", strtotime($appdate1)));		
	
		if($today == $appdate1)
		{
		$sql1 ="select fname, middle_initial, lname, email from patient_info where recnum='$link2patient'";	
		$query3=mysql_query($sql1);
		if($row3=mysql_fetch_array($query3))
		{
		$patientname=$row3['fname'] ." " . $row3['middle_initial'] . " ". $row3['middle_initial'] ;
		$patient_email = $row3['email'] ;
		}		
			
			
		$query1=mysql_query("select name from clinic where recnum='$link2clinic'");
		if($row1=mysql_fetch_array($query1))
		{
		$clinicname=$row1[0];
		}	
		$query2=mysql_query("select fname from doctor where recnum='$link2doctor'");
		if($row2=mysql_fetch_array($query2))
		{
		   $dentistname=$row2[0];
		}
				
		$Hospitaldentist=$dentistname.'<br>'.$clinicname;
		$name=$patientname;
		$durl="http://".$_SERVER['SERVER_NAME'];
		$dentist_URL="<a href='$durl/portal'>$durl/portal</a>";	
	
		$msg="Your appointment is due today.";
		//ob_start();  
		$tt = file_get_contents('template.template',true);
		//echo $contactStr = ob_get_clean();
		$tt = str_replace("{{clinicname}}",$clinicname,$tt);
		$tt = str_replace("{{dentistname}}",$dentistname,$tt);
		$tt = str_replace("{{name}}",$name,$tt);
		$tt = str_replace("{{msg}}",$msg,$tt);
		$tt = str_replace("{{Hospitaldentist}}",$Hospitaldentist,$tt);
		$tt = str_replace("{{dentist_URL}}",$dentist_URL,$tt);
		$subject="Preventive Check up ";
		$headers = 'From: <admin@paperlessdentists.com>' . " \r\n";
		$headers .= "MIME-Version: 1.0" . " \r\n";
		$headers .= "Content-type:text/html" . " \r\n";
		//if(smtp_mail($this->email, 'Your New Password...', $tt))
		if(mail($this->patient_email, $subject, $tt,$headers))
		{
				
		}
		else
		{
		   echo "Email Error....Call Sysadmin";
		}
		
		}			
	}
}	
}
