<?php
//==============================================
// Author: FSI                                 =
// Date-written = Dec 25, 2014                 =
// Filename: registration_ctrl.php             =
// Copyright of Fluent Technologies            =
// New patient Registration Controller         =
//==============================================
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Registration_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('patient_model');
        $this->load->model('admin_model');
        $this->load->library('session');
        $this->load->model('smtp_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
    }
    function index() 
    {
        $data=array();
        $data['segment']=$this->uri->segment(3);
	//echo $data['segment'];
		if($data['segment']==1)
		{
			$clinic=$this->admin_model->getclinic_details(1);
			$data['clinic_name']=$clinic->name.' '.$clinic->site_id;
		}
		else
		{
			$data['clinics']=$this->admin_model->getAllClinics();
		}
        date_default_timezone_set('America/Los_Angeles');
        $header['js_files'] = array(); 
		$this->load->helper(array('form'));
		$data['pagename']='registration';			
		$header['js_files'] = array('js/ddb_appointments_view.js');
		$this->load->helper(array('form'));	
        $clinic_id=$this->uri->segment(4);

        array_push($header['js_files'], 'js/ddb_patients_view.js');
        array_push($header['js_files'], 'js/helper.js');
		array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
        array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
        array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
        $this->load->view("includes/registrationhelper", $header);
		$data['master_meta']=$this->admin_model->getallname4group($clinic_id,'health_history');

		//$this->load->view('registration/registration',$data);
		$this->load->view('registration/registration-new',$data);
    }
	
	 function index1() 
    {
        $data=array();
        $data['segment']=$this->uri->segment(3);

        date_default_timezone_set('America/Los_Angeles');
        $header['js_files'] = array(); 
		$this->load->helper(array('form'));
		$data['pagename']='admin-registration';			
		$header['js_files'] = array('js/ddb_appointments_view.js');
		$this->load->helper(array('form'));	

        array_push($header['js_files'], 'js/ddb_patients_view.js');
        array_push($header['js_files'], 'js/helper.js');
		array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
        array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
        array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
        $this->load->view("includes/registrationhelper", $header);
		//$data['master_meta']=$this->admin_model->getallname4group($clinic_id,'health_history');

		//$this->load->view('registration/registration',$data);
		$this->load->view('registration/admin-registration',$data);
    }
	
    function insert_newpatient()
    {
			 date_default_timezone_set('America/Los_Angeles');
		     $udata['email'] = $this->input->post('email');		 
			 $udata['fname'] = $this->input->post('fname');
			 $udata['middle_initial'] = $this->input->post('middle_initial');
			 $udata['lname'] = $this->input->post('lname');
			 $dob=$this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('dt');
			
			 $udata['dob'] = $dob;
			 //$udata['dob'] = $this->input->post('dob');
			 $udata['gender'] = $this->input->post('gender');
			 $udata['addr1'] = $this->input->post('addr');
			 $udata['addr2'] = $this->input->post('addr2');
			 $udata['city'] = $this->input->post('city');
			 $udata['state'] = $this->input->post('state');
			 $udata['zip'] = $this->input->post('zip');
			 $home_phone=$this->input->post('home_phone1').'-'.$this->input->post('home_phone2').'-'.$this->input->post('home_phone3');
			 $udata['home_phone'] = $home_phone;
			 $cell_phone4peronal=$this->input->post('cell_phone4peronal1').'-'.$this->input->post('cell_phone4peronal2').'-'.$this->input->post('cell_phone4peronal3');
			 $udata['cell_phone'] = $cell_phone4peronal;
			 $work_phone4peronal=$this->input->post('work_phone4peronal1').'-'.$this->input->post('work_phone4peronal2').'-'.$this->input->post('work_phone4peronal3');
			 $udata['work_phone'] = $work_phone4peronal;
			 $udata['referred_by'] = $this->input->post('referred_by');

			 $name=$this->input->post('fname').' '. $this->input->post('middle_initial')." ".$this->input->post('lname');

			 $udata['preferred_contact_mode'] = $this->input->post('preferred_contact_mode');

			 $config['upload_path'] = 'application/uploads/';
		
			 $config['allowed_types'] = 'gif|jpg|png';		
			 //load the upload library
			 $this->load->library('upload', $config);
			 if (!$this->upload->do_upload('userfile'))
			 {
				$data = array('msg' => $this->upload->display_errors());
			 }
			else 
			{   
			$data['upload_data'] = $this->upload->data();
			$udata['img_location']= base_url()."application/uploads/" .$data['upload_data']['file_name'];
			}

			$udata['link2clinic'] = $this->input->post('clinicid');
			$udata['link2doctor'] = $this->input->post('dct_name');

			$count=$this->admin_model->getpassworddetails($this->input->post('email'));
			if(count($count) >0)
			{
				$this->session->set_flashdata('flashMessage', "Registration Failed!!..");
				redirect('login');
			}
			$patient_id=$this->patient_model->insert_patient_to_db($udata);
			$udata1['userid'] = $this->input->post('email');

			$new_password=$this->getRandomString(10);
			$password= md5($new_password);
			$udata1['password'] = $password;
			$udata1['link2clinic'] = $this->input->post('clinicid');
			$udata1['type'] = 'patient';
			$udata1['link2patient'] = $patient_id;
			$udata1['status'] = 'Active';

			$udata1['created_date'] = date('Y-m-d');
			$udata1['created_by'] = 'regn_by_patient';

			$this->patient_model->insert_newuser($udata1);
			$this->session->set_flashdata('flashMessage', "Thanks for your registration !! Please check the email for login Credentials");
			$this->load->view('smtpfns');
			$clinic_name=$this->admin_model->getclinicdetails($this->input->post('clinicid'));

			$this->smtp_model->setclinicid($clinic_name->name);
			$this->smtp_model->setsite_id($clinic_name->site_id);
			$this->smtp_model->setdocid($this->input->post('dct_name'));
			$this->smtp_model->setemail($this->input->post('email'));
			$this->smtp_model->setpassword($new_password);
			$this->smtp_model->setname($name);
			$this->smtp_model->getregisted_details();


			$recnum=$this->session->userdata('recnum');
			$udata=array();
			$udata['fname'] = $this->input->post('emer_fname');		 
			$udata['middle_initial'] = $this->input->post('emer_midname');		 
			$udata['lname'] = $this->input->post('emer_lname');	
			$home_phone=$this->input->post('emer_homenum1').'-'.$this->input->post('emer_homenum2').'-'.$this->input->post('emer_homenum3');
			$udata['home_phone'] = $home_phone;
			$work_phone=$this->input->post('emer_worknum1').'-'.$this->input->post('emer_worknum2').'-'.$this->input->post('emer_worknum3');
			$udata['work_phone'] = $work_phone;
			$cell_phone=$this->input->post('emer_cellnum1').'-'.$this->input->post('emer_cellnum2').'-'.$this->input->post('emer_cellnum3');
			$udata['cell_phone'] = $cell_phone;
			$udata['email'] = $this->input->post('emer_email');
			$udata['relationship'] = $this->input->post('emer_relation');
			$udata['link2patientinfo'] = $patient_id;
	
			$this->patient_model->insert_emerg_to_db($udata);

			$udata=array();
			$udata['height_feet'] =0;	
			$udata['height_inches'] = $this->input->post('height_inches');	
			$udata['weight_lbs'] = $this->input->post('weight_lbs');	
			$udata['are_you_in_good_health'] = $this->input->post('are_you_in_good_health');				
			$udata['under_physician_care'] = $this->input->post('under_physician_care');	
			$physician_phone=$this->input->post('physician_phone1').'-'.$this->input->post('physician_phone2').'-'.$this->input->post('physician_phone3');
			$udata['physician_phone'] = $physician_phone;
			$udata['illness_operation_hospitalized'] = $this->input->post('illness_operation_hospitalized');	
			$udata['alcoholic_consumption'] = $this->input->post('alcoholic_consumption');	
			$udata['recreation_drug_usage'] = $this->input->post('recreation_drug_usage');	
			$udata['alcohol_abuse'] = $this->input->post('alcohol_abuse');	
			$udata['smoke'] = $this->input->post('smoke');	
			$udata['tobacco'] = $this->input->post('tobacco');
			$udata['link2patient'] = $patient_id;
			$udata['created_by'] = 'Doctor';
			$udata['created_date'] = date('Y-m-d');
			$this->patient_model->insert_health_info($udata);

			$udata1=array();
			$udata['link2patient'] = $patient_id;

			$index=$this->input->post('index');
			for($i=0;$i<$index;$i++)
			{         
				  $name= $this->input->post('name_'.$i)?"yes":"no";	
				  $udata1['link2patient']=$patient_id;
				  $udata1['group'] = $this->input->post('group'.$i);	
				  $udata1['medical_condition'] = $this->input->post('name'.$i);	
				  $udata1['condition_status'] = $name;
				  $udata1['disp_seq'] = $this->input->post('dispseq_'.$i);
				  $udata1['created_by'] = 'Doctor';
				  $udata1['created_date'] = date('Y-m-d');
				  $udata1['upd_num']=1;
				  $this->patient_model->insert_patientmeta($udata1);
			} 

			  $udata=array();

			 $udata['name_of_insured'] = $this->input->post('name_of_insured');	
			 $udata['insurance_company'] = $this->input->post('insurance_company');
			 $udata['group_id'] = $this->input->post('group_id');
			 $udata['member_id'] = $this->input->post('member_id');
			 $config['upload_path'] = 'application/uploads/';
		
			$config['allowed_types'] = 'gif|jpg|png';		
			//load the upload library
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('ins1_userfile'))
			{
				$data = array('msg' => $this->upload->display_errors());
			}
			else 
			{   
				$data['upload_data'] = $this->upload->data();
				$udata['img1_location']= base_url()."application/uploads/" .$data['upload_data']['file_name'];
			}
			if (!$this->upload->do_upload('ins2_userfile'))
			{
				$data = array('msg' => $this->upload->display_errors());
			}
			else 
			{   
				$data['upload_data'] = $this->upload->data();
				$udata['img2_location']= base_url()."application/uploads/" .$data['upload_data']['file_name'];
			}

			 $udata['link2patientinfo'] = $patient_id;

			 $this->patient_model->insert_insur_to_db($udata);
			 $udata=array();

			 $udata['fname'] = $this->input->post('fname');	
			 $udata['middle_name'] = $this->input->post('middle_initial');	
			 $udata['lname'] = $this->input->post('lname');	
			 $udata['home_phone'] = $this->input->post('home_phone');	
			 $udata['cell_phone'] = $this->input->post('cell_phone');	
			 $udata['work_phone'] = $this->input->post('work_phone');
			 $udata['email'] = $this->input->post('email');
			 $udata['relationship'] = $this->input->post('emer_relation');
			 $udata['link2patientinfo'] = $recnum;
			 $udata['patient_id'] = $patient_id;

			 $this->patient_model->insert_family_to_db($udata);

			 
			if($this->input->post('segment') == 'newpatient')
			redirect('doctor_ctrl/patients');
			else
			redirect('login');
		}
		
		
		function insert_newadmin()
		{
			 date_default_timezone_set('America/Los_Angeles');	
			 $udata['name'] = $this->input->post('clinicname');		
		     $udata1['userid'] = $this->input->post('email');		 
			 //$udata1['fname'] = $this->input->post('fname');
			 //$udata1['middle_initial'] = $this->input->post('middle_initial');
			// $udata1['lname'] = $this->input->post('lname');
	
			 $cell_phone4peronal=$this->input->post('cell_phone4peronal1').'-'.$this->input->post('cell_phone4peronal2').'-'.$this->input->post('cell_phone4peronal3');
			 $udata2['cell_phone'] = $cell_phone4peronal;

			 $new_password=$this->getRandomString(10);
			 $password= md5($new_password);
			 $udata1['password'] = $password;
	 
			 $udata1['type'] = 'admin';
			 $udata1['status'] = 'Active';

			 $udata1['created_date'] = date('Y-m-d');
			 $udata1['created_by'] = 'regn_by_admin';

			 $clinicid = $this->admin_model->insert_clinicinfo($udata);
			 $udata1['link2clinic'] = $clinicid ;
			 
			 $this->admin_model->insert_userinfo($udata1);
			 
		 
			 $this->load->view('smtpfns');
			 $clinic_name=$this->admin_model->getclinicdetails($this->input->post('clinicid'));

			 $this->smtp_model->setclinicid($this->input->post('clinicname'));		
			
			 $this->smtp_model->setemail($this->input->post('email'));
			 $this->smtp_model->setpassword($new_password);
			 $this->smtp_model->setmailtoadmin();
			 
			 /*
			 $this->session->set_flashdata('flashMessage', "Thanks for your registration !! Please check your email for login Credentials");		 
			 redirect("login") ;
			 */
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



		function getdoc()
		{
		$loc = $this->uri->segment(3);
		$finalDropDown=$this->patient_model->getdocid($loc);
		header('Content-Type: application/json');
		echo json_encode($finalDropDown);
		}




}
?>
