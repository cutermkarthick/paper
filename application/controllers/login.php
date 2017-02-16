<?php
//==============================================
// Author: FSI                                 =
// Date-written = Dec 16, 2014                 =
// Filename: login.php                         =
// Copyright of Fluent Technologies            =
// Login Controller having login checks        =
// ,setting password/email etc                 =
//==============================================
class Login extends CI_Controller 
{
        function __construct()
	{
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('patient_model');
        $this->load->model('admin_model');
        $this->load->model('smtp_model');
        $this->load->library('session');
		$this->load->library('form_validation');
        }
	function index() 
	{
        $session_arr1=array('userid'=>'');
		$this->session->set_userdata($session_arr1);
		$this->load->view('login');
	}
	function forgot_password() 
		{
			$this->load->view('forgot_password');
		}
	function settings() 
		{
			$this->load->view('settings');
		}
        function forgotpassword() 
		{
        $email = $this->uri->segment(3);
	    $record=$this->admin_model->checkuser_exist4md5($email);
		$data['email']=$record->userid;
		$this->admin_model->updatemd54user($email);
		$this->load->view('forgotpassword',$data);
		}
	function fetch_data()
	{

		
		if($this->input->post('user_name') == '')
		{
		    $userid = $this->session->userdata('userid');
		    $password = $this->session->userdata('password');
		}
		else
		{
	        $userid   = $this->input->post('user_name');
		    $password = $this->input->post('password');
			$siteid   = $this->input->post('siteid');
		}
		
		if($siteid !='')
          $num_rows=$this->admin_model->checkuser_exist4admin($userid,$password,$siteid);
		else
		  $num_rows=$this->admin_model->checkuser_exist($userid,$password);

<<<<<<< HEAD
=======

>>>>>>> d76de39612d4bb9457d44d833305f6491bb4187b
		//for admin login
		if($siteid =='' && count($num_rows) != '0')
		{
			if($num_rows->type=='admin')
			{
		
			  $this->session->set_flashdata('flashMessage', 'Login Failed...Enter Site Id');			  
			  redirect('login');  
			}
		}	 
		  
		  
		
		  if(count($num_rows) == '0')
		  {
		  $this->session->set_flashdata('flashMessage', 'Login Failed...');			  
	      redirect('login');
		  }
		    
		  elseif($num_rows->type == 'patient'  && count($num_rows) >0)
		  {
			  //$query=$this->patient_model->patients_info($num_rows->link2patient);
			  //get data from patient_info, clinic, doctor table
			 
			 //added the below three query by udaya ON July 14th
			 $query=$this->patient_model->patients_infoDetails1($num_rows->link2patient);
			 //get data from insurance table
			 
			 $query1=$this->patient_model->insur_infoDetails($num_rows->link2patient);
			 
			 $query2=$this->patient_model->emer_infoDetails($num_rows->link2patient);
			 
			 $data['query']=$query;
			 $data['query1']=$query1;
			 $data['query2']=$query2;
			
			 $patient_name=$query->fullname;
			 $session_arr=array('recnum'=>$num_rows->link2patient);
			 $this->session->set_userdata($session_arr);

			 $session_arr2=array('patient_name'=>$patient_name);
			 $this->session->set_userdata($session_arr2);

			 $session_arr=array('recnum'=>$num_rows->link2patient);
			 $this->session->set_userdata($session_arr);
			 $session_arr1=array('userid'=>$userid);
			 $this->session->set_userdata($session_arr1);
			 $session_arr2=array('password'=>$password);
			 $this->session->set_userdata($session_arr2);

			 $session_arr3=array('clinicid'=>$num_rows->link2clinic);
			 $this->session->set_userdata($session_arr3);
             $session_arr4=array('user_type'=>'patient');	
			 $this->session->set_userdata($session_arr4);

			$data1['row']=$this->patient_model->patients_infoDetails1($num_rows->link2patient);
			foreach($data1 as $r)
			{
				$patient_email=$r->email;
			}
			//$session_arr4=array('doctor_id'=>$link2doctor);
			//$this->session->set_userdata($session_arr4);
            $session_arr5=array('patient_email'=>$patient_email);
			$this->session->set_userdata($session_arr5);
			$header['js_files'] = array();
			$clinic_id=$num_rows->link2clinic;
			$header['menu']=$this->admin_model->getmenudetails($clinic_id);
			$this->load->view("includes/pdbheader", $header);
			$data['history']=$this->patient_model->patients_visit_his($num_rows->link2patient);
			$this->load->view('patient/patient_dashboard_view',$data);
			$this->load->view("includes/footer");
		  }
		  elseif($num_rows->type == 'doctor' && count($num_rows) >0)
		  {
			   $session_arr=array('recnum'=>$num_rows->link2doctor);
			   $this->session->set_userdata($session_arr);
			   
			   $session_arr1=array('userid'=>$userid);
			   $this->session->set_userdata($session_arr1);

			   $session_arr3=array('user_type'=>'doctor');
			   $this->session->set_userdata($session_arr3);

			   $session_arr2=array('password'=>$password);
			   $this->session->set_userdata($session_arr2);
			   
			   $session_arr3=array('clinicid'=>$num_rows->link2clinic);
			   $data['menu']=$this->admin_model->getmenudetails($num_rows->link2clinic);
			   $this->session->set_userdata($session_arr3);
			   $session_arr4=array('doctor_id'=>$num_rows->link2doctor);
			   $this->session->set_userdata($session_arr4);

               redirect("doctor_ctrl/index");
			}
		   elseif($num_rows->type == 'admin' && count($num_rows) >0)
		  {
		   $session_arr=array('recnum'=>$num_rows->link2doctor);
		   $this->session->set_userdata($session_arr);		   
		   $session_arr1=array('userid'=>$userid);
		   $this->session->set_userdata($session_arr1);
		   //commented the below lines by udaya on July 8th
		   //$session_arr2=array('clinic'=>$num_rows->name);
		   //$this->session->set_userdata($session_arr2);
		   $session_arr3=array('clinicid'=>$num_rows->link2clinic);
		   $this->session->set_userdata($session_arr3);
		   $session_arr4=array('doctor_id'=>$num_rows->link2doctor);
		   $this->session->set_userdata($session_arr4);
		   $session_arr5=array('user_type'=>'admin');	
		   $this->session->set_userdata($session_arr5);
		   $session_arr6=array('siteid'=>$siteid);
		   $this->session->set_userdata($session_arr6);		   
		   
		   redirect("admin_ctrl/index");
        }
	}
function updatepassword()
{
$email=$this->input->post('email');
$password=md5($this->input->post('new_password'));
$this->admin_model->updatepassword($email,$password);
$this->session->set_flashdata('flashMessage', 'Password has been Updated ,Please Login ...');			  
	redirect('login');
}


function fetch_updatedpassword()
{
   $email=$this->input->post('email');
   $data=$this->admin_model->getpassworddetails($email);
   if(count($data) >0)
   {
       $new_password=$this->getRandomString(10);
       $password= md5($new_password); 
       $this->admin_model->updatepassword($email,$password);
       $this->session->set_flashdata('flashMessage', 'New Password has been sent to your mail, Please check your mail and SignIn.');	  
       $this->load->view('smtpfns');
$record=$this->admin_model->patientDetails4patient($data->link2patient);
$name=$record->fname." ".$record->lname;
$clinic=$record->name." ".$record->site_id;
$clinic_name=$record->name;

	$this->smtp_model->setemail($this->input->post('email'));
	$this->smtp_model->setpassword($new_password);
$this->smtp_model->setname($name);
$this->smtp_model->setclinicid($clinic);
$this->smtp_model->setclinic_name($clinic_name);
$this->admin_model->updatemd5_string($this->input->post('email'));
	$this->smtp_model->getpassword_details();
   }
   else
   {
	$this->session->set_flashdata('flashMessage', 'Email id is not registered');	
   }
   redirect('login');   
}
function getRandomString($length)
 {
    $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
    $validCharNumber = strlen($validCharacters);
    $result = "";
 
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
return $result;
}

function updatesetting()
{
    $email=$this->session->userdata('userid'); 
    $new_email=$this->input->post('new_email');
    $new_password=$this->input->post('new_password');
    $newpassword=md5($new_password); 
    $user_type=$this->session->userdata('user_type');

    if($new_email != '' && $user_type == 'doctor')
    {
      $this->admin_model->updateemail4doc($new_email,$email);
       $this->admin_model->updatepassword($new_email,$newpassword);
    }
    if($new_email != '' && $user_type == 'patient')
    {
      $this->admin_model->updateemail4dpatient($new_email,$email);
      $this->admin_model->updatepassword($new_email,$newpassword);
    }
    if($new_password != '')
    {
      $this->admin_model->updatepassword($email,$newpassword);
    }
$this->session->set_flashdata('flashMessage', 'Email Id/Password updates Sucessfully');	
    redirect('login');
}

}?>
