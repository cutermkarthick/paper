<?php
//==============================================
// Author: FSI                                 =
// Date-written = Dec 15, 2014                 =
// Filename: patient_ctrl.php                  =
// Copyright of Fluent Technologies            =
//==============================================

include("sms_credentials.php");
/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
class Patient_ctrl extends CI_Controller
{
function __construct()
{
	parent::__construct();
	$this->load->helper('url');
	$this->load->model('patient_model');
	$this->load->model('doctor_model');
	$this->load->model('admin_model');
	$this->load->library('session');
	$this->load->helper('form');
	$this->load->library("pagination");
	$this->load->library('form_validation');
	include("SessionController.php");  
	include("user_type4patient.php");         

	$this->load->model('smtp_model');
	include("Twilio.php");
	$this->mob_prefix='+1';
}
function index() 
{
	if($this->session->userdata('userid') == '')
	   redirect('/login');
	$clinic_id=$this->session->userdata('clinicid');


	$header['menu']=$this->admin_model->getmenudetails($clinic_id);
	$this->load->view("includes/pdbheader", $header);
	if($this->session->userdata('home_leftnav') == '')
	{
		$this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
		redirect('login');
	}
	$recnum=$this->session->userdata('recnum');
	//$data['query']=$this->patient_model->patients_info($recnum);
	//changed by udaya on July 14th

  	 $query=$this->patient_model->patients_infoDetails1($recnum);
	 //get data from insurance table
	 $query1=$this->patient_model->insur_infoDetails($recnum);
	 $query2=$this->patient_model->emer_infoDetails($recnum);
	 $data['query']=$query;
	 $data['query1']=$query1;
	 $data['query2']=$query2;
	 
		
	$data['history']=$this->patient_model->patients_visit_his($recnum);
	$this->load->view('patient/patient_dashboard_view',$data);		 
	$this->load->view("includes/footer");
}    
function profile() 
{

	date_default_timezone_set('America/Los_Angeles');
	$header['js_files'] = array();	

	$clinic_id=$this->session->userdata('clinicid');
	$header['menu']=$this->admin_model->getmenudetails($clinic_id);	
	$recnum=$this->session->userdata('recnum');

	$treat_type = 'treatment_to_be_done';
	$drugs_type = 'drugs_and_medication';
	$changes_type = 'changes_to_treatment_plan';
	$extract_type= 'extraction';
	$crown_type = 'crowns';
	$denture_type = 'dentures';
	$endendodontic_type= 'endodontic_treatment';
	$perio_type = 'periodontal_loss';
	$filling_type= 'fillings';
	$pedodon_type = 'pedodontics';

	$data['treatment_to_be']=$this->patient_model->cansent_Details($recnum,$treat_type);
	$data['drugs_med']=$this->patient_model->cansent_Details($recnum,$drugs_type);
	$data['changes_treat']=$this->patient_model->cansent_Details
	($recnum,$changes_type);

	$data['extact']=$this->patient_model->cansent_Details($recnum,$extract_type);
	$data['crown']=$this->patient_model->cansent_Details($recnum,$crown_type);
	$data['denture']=$this->patient_model->cansent_Details($recnum,$denture_type);
	$data['endendontic']=$this->patient_model->cansent_Details($recnum,$endendodontic_type);
	$data['perio']=$this->patient_model->cansent_Details($recnum,$perio_type);
	$data['filling']=$this->patient_model->cansent_Details($recnum,$filling_type);
	$data['pedodontic']=$this->patient_model->cansent_Details($recnum,$pedodon_type);



	$header['js_files'] = array('js/ddb_patients_view.js');	
	$this->load->view("includes/pdbheader4profile", $header);

	if($this->session->userdata('profile_leftnav') == '')
	{
	    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
	    redirect('login');
	}

	$data['page']='profile';
	$userid=$this->session->userdata('userid');
	$num_rows=$this->patient_model->checkpatient_exist($userid);	
	if (count($num_rows) > 0)
	{

		$data['query']=$this->patient_model->patients_infoDetails($num_rows->link2patient);	
		$data['query_emer']=$this->patient_model->emer_infoDetails($num_rows->link2patient);	
		$data['query_insur']=$this->patient_model->insur_infoDetails($num_rows->link2patient);
		$data['pagename']='patient_details';
		$data['param']='home1';

		$this->load->view('patient/patient_profile_view',$data);
	}
	
	$this->load->view("includes/footer");
}

function update_patient()
{

date_default_timezone_set('America/Los_Angeles');
if($this->input->post('param') == 'familymember')
{
//$family_recnum=$this->uri->segment(3);

$userrecnum=$this->session->userdata('recnum');	
//$patient_recnum=$this->patient_model->getPatientRecnum($userrecnum);
//echo $patient_recnum->link2patient;
$family_recnum=$this->patient_model->getFamilyRecnum($userrecnum);
$data['family_mem']=$this->patient_model->family_details($family_recnum->recnum);
}
$header['js_files'] = array('js/ddb_patients_view.js');		
array_push($header['js_files'], 'js/helper.js');

array_push($header['js_files'], 'js/ddb_message4date.js');
array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);
$this->load->view("includes/pdbheader4profile", $header);			   
$data['page']='profile';
$recnum=$this->session->userdata('recnum');


$data['query']=$this->patient_model->patients_infoDetails($recnum);

$data['query_emer']=$this->patient_model->emer_infoDetails($recnum);	
$data['query_insur']=$this->patient_model->insur_infoDetails($recnum);
$data['query_health']=$this->patient_model->health_infoDetails($recnum);
$data['pagename']='patient_update';
$data['param']=$this->input->post('param');
$data['master_meta'] = $this->admin_model->getmed_his4patient($recnum);
$data['master_meta1'] = $this->admin_model->getdefaultmaster_meta(); //added by udaya
$data['recnum']=$recnum;

$this->load->view('patient/update_profile_view',$data);		
$this->load->view("includes/footer");
} 
function insert_profile()
{
date_default_timezone_set('America/Los_Angeles');
$type = $this->input->post('param');
date_default_timezone_set('America/Los_Angeles');
$recnum = $this->input->post('recnum');
if($type == 'home1' || $type == 'profile' || $type == '')
{
$udata['email'] = $this->input->post('email');		 
$udata['fname'] = $this->input->post('fname');
$udata['middle_initial'] = $this->input->post('middle_initial');
$udata['lname'] = $this->input->post('lname');
$year=($this->input->post('year')=='')?'2000':$this->input->post('year');
$dob = $year."-".$this->input->post('month').'-'.$this->input->post('dt');
$udata['dob'] = $dob;
$udata['gender'] = $this->input->post('gender');
$udata['addr1'] = $this->input->post('addr');
$udata['addr2'] = $this->input->post('addr2');
$udata['city'] = $this->input->post('city');
$udata['state'] = $this->input->post('state');
$udata['zip'] = $this->input->post('zip');
//$udata['home_phone'] = $this->input->post('home_phone4peronal');
//$udata['cell_phone'] = $this->input->post('cell_phone4peronal');
//$udata['work_phone'] = $this->input->post('work_phone4peronal');

$home_phone=$this->input->post('home_phone1').'-'.$this->input->post('home_phone2').'-'.$this->input->post('home_phone3');
$udata['home_phone'] = $home_phone;
$cell_phone4peronal=$this->input->post('cell_phone4peronal1').'-'.$this->input->post('cell_phone4peronal2').'-'.$this->input->post('cell_phone4peronal3');
$udata['cell_phone'] = $cell_phone4peronal;
$work_phone4peronal=$this->input->post('work_phone4peronal1').'-'.$this->input->post('work_phone4peronal2').'-'.$this->input->post('work_phone4peronal3');
$udata['work_phone'] = $work_phone4peronal;

$udata['preferred_contact_mode'] = $this->input->post('preferred_contact_mode');
$config=array();
//$config['upload_path'] =  "application/";
$config['upload_path'] =  "application/uploads/";
$config['allowed_types'] = 'gif|jpg|png|jpeg';		

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
$this->patient_model->update_personal($udata,$recnum);
$param='home1';
$this->update_profile();
}
elseif($type == 'profile1')
{
$udata['fname'] = $this->input->post('emer_fname');		 
$udata['middle_initial'] = $this->input->post('emer_midname');		 
$udata['lname'] = $this->input->post('emer_lname');		 
//$udata['home_phone'] = $this->input->post('emer_homenum');		 
//$udata['work_phone'] = $this->input->post('emer_worknum');	
//$udata['cell_phone'] = $this->input->post('emer_cellnum');
$home_phone=$this->input->post('emer_homenum1').'-'.$this->input->post('emer_homenum2').'-'.$this->input->post('emer_homenum3');
$udata['home_phone'] = $home_phone;
$work_phone=$this->input->post('emer_worknum1').'-'.$this->input->post('emer_worknum2').'-'.$this->input->post('emer_worknum3');
$udata['work_phone'] = $work_phone;
$cell_phone=$this->input->post('emer_cellnum1').'-'.$this->input->post('emer_cellnum2').'-'.$this->input->post('emer_cellnum3');
$udata['cell_phone'] = $cell_phone;
$udata['email'] = $this->input->post('emer_email');
$udata['relationship'] = $this->input->post('emer_relation');
$udata['link2patientinfo']  = $this->input->post('recnum');

//added by udaya on July 15th
$res = $this->patient_model->emer_infoRecnum($recnum) ;
$rec_emer = $res->recnum_emergency;

if($rec_emer > 0)
{
$this->patient_model->update_emerg($udata,$recnum);
}
else
{
$this->patient_model->insert_emerg_to_db($udata);
}

$param='profile1';
$this->update_profile();
}
elseif($type == 'dropdown11')
{
$udata=array();
$udata['height_feet'] =0;	
$udata['height_inches'] = $this->input->post('height_inches');	
$udata['weight_lbs'] = $this->input->post('weight_lbs');	
$udata['are_you_in_good_health'] = $this->input->post('are_you_in_good_health');				
$udata['under_physician_care'] = $this->input->post('under_physician_care');

$physician_phone=$this->input->post('physician_phone1').'-'.$this->input->post('physician_phone2').'-'.$this->input->post('physician_phone3');
$udata['physician_phone'] = $physician_phone;
$udata['illness_operation_hospitalized'] = 
$this->input->post('illness_operation_hospitalized');

$udata['alcoholic_consumption'] = $this->input->post('alcoholic_consumption');	
$udata['recreation_drug_usage'] = $this->input->post('recreation_drug_usage');	
$udata['alcohol_abuse'] = $this->input->post('alcohol_abuse');	
$udata['smoke'] = $this->input->post('smoke');	
$udata['tobacco'] = $this->input->post('tobacco');
$udata['other'] = $this->input->post('other');
$udata['signature'] = $this->input->post('output');
$udata['accept'] = $this->input->post('health_history_accept');
$udata['link2patient'] = $recnum;
$udata['created_by'] = 'Doctor';
$udata['created_date'] = date('Y-m-d');
$recnum=$this->input->post('recnum');

//added by udaya on July 15th
$res1 = $this->patient_model->health_infoRecnum($recnum) ;
$rec_health = $res1->recnum_health;
if($rec_health > 0)
{
$this->patient_model->update_health_info($udata,$recnum);
}
else
{
$this->patient_model->insert_health_info($udata);
}

/**********************send notifn for patient updations********/

$doctor_link=$this->patient_model->getDoctorRecnum($recnum);
$doctoremail=$doctormailid=$this->patient_model->getDoctorEmail($doctor_link->link2doctor);
$add['addinfo']=$this->patient_model->patients_info($recnum);
 $add['query']=$this->patient_model->patients_infoDetails($recnum);

$add['query_emer']=$this->patient_model->emer_infoDetails($recnum);	
$add['query_health']=$this->patient_model->health_infoDetails($recnum);
$this->load->view('smtpfns');
$this->smtp_model->send_updates($doctoremail->email,$add['query'],$add['query_health'],$add['addinfo']);




/*
$udata['high_bp'] = $this->input->post('high_bp')? "yes" : "no";
$udata['low_bp'] = $this->input->post('low_bp')? "yes" : "no";
$udata['angina_chest_pain'] = $this->input->post('angina_chest_pain')? "yes" : "no";

$udata['fainiting'] = $this->input->post('fainiting')? "yes" : "no";
$udata['irregular_heartbeat'] = $this->input->post('irregular_heartbeat')? "yes" : "no";
$udata['heart_attack'] = $this->input->post('heart_attack')? "yes" : "no";
$udata['heart_bypass'] = $this->input->post('heart_bypass')? "yes" : "no";
$udata['pacemaker'] = $this->input->post('pacemaker')? "yes" : "no";
$udata['anemia'] = $this->input->post('anemia')? "yes" : "no";
$udata['hepatitis_a'] = $this->input->post('hepatitis_a')? "yes" : "no";
$udata['hepatitis_b'] = $this->input->post('hepatitis_b')? "yes" : "no";
$udata['hepatitis_c'] = $this->input->post('hepatitis_c')? "yes" : "no";
$udata['hiv'] = $this->input->post('hiv')? "yes" : "no";
$udata['aids'] = $this->input->post('aids')? "yes" : "no";
$udata['std'] = $this->input->post('std')? "yes" : "no";
$udata['delay_in_healing'] = $this->input->post('delay_in_healing')? "yes" : "no";
$udata['pancreas_diabetes'] = $this->input->post('pancreas_diabetes')? "yes" : "no";
$udata['kidney_dialysis'] = $this->input->post('kidney_dialysis')? "yes" : "no";
$udata['eyes_glaucoma'] = $this->input->post('eyes_glaucoma')? "yes" : "no";
$udata['thyroid'] = $this->input->post('thyroid')? "yes" : "no";
$udata['neurology_epilepsy'] = $this->input->post('neurology_epilepsy')? "yes" : "no";
$udata['cancer_location'] = $this->input->post('cancer_location')? "yes" : "no";
$udata['cancer_location_name'] = $this->input->post('cancer_location_name')? "yes" : "no";
$udata['surgery'] = $this->input->post('surgery')? "yes" : "no";
$udata['radiation'] = $this->input->post('radiation')? "yes" : "no";
$udata['chemotherapy'] = $this->input->post('chemotherapy')? "yes" : "no";
$udata['jaw_joints_pain'] = $this->input->post('jaw_joints_pain')? "yes" : "no";
$udata['arthritis'] = $this->input->post('arthritis')? "yes" : "no";
$udata['arthritis_knee_replacement'] = $this->input->post('arthritis_knee_replacement')? "yes" : "no";
$udata['arthritis_hip_replacement'] = $this->input->post('arthritis_hip_replacement')? "yes" : "no";
$udata['swollen_ankles'] = $this->input->post('swollen_ankles')? "yes" : "no";
$udata['other'] = $this->input->post('other');
$udata['link2patient'] = $recnum;

//$this->patient_model->update_medhis($udata,$recnum);
$this->patient_model->insert_history_to_db($udata);*/
$udata1=array();
$udata1['link2patient'] = $recnum;
$upd_num=$this->input->post('upd_num');
$new_upd=$upd_num+1;
$index=$this->input->post('index');


$res = $this->patient_model->gethealthhistory($recnum); //added by udaya
$numrows1 = $res->numrows;
if($numrows1 >0)
{
for($i=0;$i<$index;$i++)
{         
      $name= $this->input->post('name_'.$i)?"yes":"no";	
	  $rec= $this->input->post($recnum);	   
 	  $this->patient_model->update_medhis($name, $recnum);
}	
}
else
{
for($i=0;$i<$index;$i++)
{         
      $name= $this->input->post('name_'.$i)?"yes":"no";	
	  $udata1['group'] = $this->input->post('group'.$i);	
	  $udata1['medical_condition'] = $this->input->post('name'.$i);	
	  $udata1['condition_status'] = $name;
	  $udata1['disp_seq'] = $this->input->post('dispseq_'.$i);
      $udata1['created_by'] = 'Doctor';
      $udata1['created_date'] = date('Y-m-d');
      $udata1['upd_num']=$new_upd;
	  	 
	  $this->patient_model->insert_patientmeta($udata1);
}
}
	


//$this->patient_model->update_medicalhis($udata1);
$param='dropdown11';
 $this->update_profile();
}
elseif($type == 'dropdown21')
{
$udata['name_of_insured'] = $this->input->post('name_of_insured');	
$udata['insurance_company'] = $this->input->post('insurance_company');
$udata['group_id'] = $this->input->post('group_id');
$udata['member_id'] = $this->input->post('member_id');
$config['upload_path'] = 'application/uploads/';

$config['allowed_types'] = 'gif|jpg|png|jpeg';		
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

$udata['link2patientinfo'] =$this->input->post('recnum');
//added by udaya on July 15th
$res2 = $this->patient_model->insur_infoRecnum($recnum) ;
$rec_insur = $res2->recnum_insur;

if($rec_insur > 0)
{
$this->patient_model->update_insur($udata,$recnum);
}
else
{
$this->patient_model->insert_insur_to_db($udata);
}

$param='dropdown21';
$this->update_profile();

}
elseif($type == 'familymember')
{
$udata['fname'] = $this->input->post('family_fname');	
$udata['middle_name'] = $this->input->post('family_mname');	
$udata['lname'] = $this->input->post('family_lname');	
$udata['home_phone'] = $this->input->post('home_phone');	
$udata['cell_phone'] = $this->input->post('cell_phone');	
$udata['work_phone'] = $this->input->post('work_phone');
$udata['email'] = $this->input->post('family_email');
$udata['relationship'] = $this->input->post('fam_relationship');
$family_recnum = $this->input->post('family_recnum');
$this->patient_model->update_family($udata,$family_recnum);
$param='familymember';
$this->update_profile();
}
}

	function update_profile()
	{

		date_default_timezone_set('America/Los_Angeles');
		$header['js_files'] = array();
		$header['js_files'] = array('js/ddb_patients_view.js');
		$recnum=$this->session->userdata('recnum');
		$data['pagename']='patient_details'; 
		$data['param']=$this->input->post('param');

		array_push($header['js_files'], 'js/ddb_appointments_view.js');
		array_push($header['js_files'], 'js/ddb_message4date.js');
		array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
		array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
		array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');

		$clinic_id=$this->session->userdata('clinicid');
		$header['menu']=$this->admin_model->getmenudetails($clinic_id);
		$data['search_patients']='';
		$data['search_patients_lname']='';
		$data['query']=$this->patient_model->patients_infoDetails($recnum);	
		$data['query_emer']=$this->patient_model->emer_infoDetails($recnum);	
		$data['query_health']=$this->patient_model->health_infoDetails($recnum);	
		$data['query_insur']=$this->patient_model->insur_infoDetails($recnum,$data['pagename']);	

		$treat_type = 'treatment_to_be_done';
		$drugs_type = 'drugs_and_medication';
		$changes_type = 'changes_to_treatment_plan';
		$extract_type= 'extraction';
		$crown_type = 'crowns';
		$denture_type = 'dentures';
		$endendodontic_type= 'endodontic_treatment';
		$perio_type = 'periodontal_loss';
		$filling_type= 'fillings';
		$pedodon_type = 'pedodontics';

		$data['treatment_to_be']=$this->patient_model->cansent_Details($recnum,$treat_type);
		$data['drugs_med']=$this->patient_model->cansent_Details($recnum,$drugs_type);
		$data['changes_treat']=$this->patient_model->cansent_Details
		($recnum,$changes_type);

		$data['extact']=$this->patient_model->cansent_Details($recnum,$extract_type);
		$data['crown']=$this->patient_model->cansent_Details($recnum,$crown_type);
		$data['denture']=$this->patient_model->cansent_Details($recnum,$denture_type);
		$data['endendontic']=$this->patient_model->cansent_Details($recnum,$endendodontic_type);
		$data['perio']=$this->patient_model->cansent_Details($recnum,$perio_type);
		$data['filling']=$this->patient_model->cansent_Details($recnum,$filling_type);
		$data['pedodontic']=$this->patient_model->cansent_Details($recnum,$pedodon_type);

		$clinic_id=$this->session->userdata('clinicid');
		$header['menu']=$this->admin_model->getmenudetails($clinic_id);

		$this->load->view("includes/pdbheader4profile", $header);

		if($this->session->userdata('profile_leftnav') == '')
		{
		    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
		    redirect('login');
		}

		if($this->session->userdata('profile_leftnav') == '')
		{
		    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
		    redirect('login');
		}

		if ($this->input->post('patient_name') != '' &&  $this->input->post('check_search') == 1 )
		{
			$senderarr=array('patient_name'=>$this->input->post('patient_name'));  
			$this->session->set_userdata($senderarr);
			$data['search_patients']=$this->session->userdata('patient_name');
		}
		else if (($this->session->userdata('patient_name') != '') && $this->input->post('check_search') == 1 )
		{  
			$senderarr=array('patient_name'=>$this->input->post('patient_name'));  
			$this->session->set_userdata($senderarr);
			$data['search_patients']=$this->session->userdata('patient_name');
		}
		else if (($this->session->userdata('patient_name') != '') && $this->input->post('check_search') == '' )
		{ 
			$data['search_patients']=$this->session->userdata('patient_name');
		}
		else if ($this->input->post('patient_name') == '' )
		{ 
			$senderarr=array('patient_name'=>$this->input->post('patient_name'));  
			$this->session->set_userdata($senderarr);
			$data['search_patients']=$this->session->userdata('patient_name');
		}

		if ($this->input->post('patient_lname') != '' &&  $this->input->post('check_search') == 1 )
		{
			$senderarr=array('patient_lname'=>$this->input->post('patient_lname'));  
			$this->session->set_userdata($senderarr);
			$data['search_patients_lname']=$this->session->userdata('patient_lname');
		}
		else if (($this->session->userdata('patient_lname') != '') && $this->input->post('check_search') == 1 )
		{  
			$senderarr=array('patient_lname'=>$this->input->post('patient_lname'));  
			$this->session->set_userdata($senderarr);
			$data['search_patients_lname']=$this->session->userdata('patient_lname');
		}
		else if (($this->session->userdata('patient_lname') != '') && $this->input->post('check_search') == '' )
		{ 
			$data['search_patients_lname']=$this->session->userdata('patient_lname');
		}
		else if ($this->input->post('patient_lname') == '' )
		{ 
			$senderarr=array('patient_lname'=>$this->input->post('patient_lname'));  
			$this->session->set_userdata($senderarr);
			$data['search_patients_lname']=$this->session->userdata('patient_lname');
		}

		$data['family_mem']=$this->patient_model->family_infoDetails($recnum);
		$data['med_his'] = $this->admin_model->getmed_his4patient($recnum);
		$data['health_info'] = $this->admin_model->gethealth_info($recnum);

		$data['surgery']=$this->patient_model->getpatient_surgeryDetails($recnum);

	  	$data['surgery_notes']=$this->patient_model->getpatient_surgeryNotes($recnum);

	  	$data['post_surgery_notes']=$this->patient_model->postsurgeryNotes($recnum);

	  	$data['postopnotes']=$this->patient_model->getpatient_postopNotes($recnum);

	  	$data['postop_commnotes']=$this->patient_model->getpatient_postop_commNotes($recnum);


		//print_r($data) ;

		$this->load->view('patient/patient_profile_view',$data);

	}

function insert_new_patient() 
{
date_default_timezone_set('America/Los_Angeles');
$segment = $this->uri->segment(3);
if($segment == 'personal')
{
$udata['email'] = $this->input->post('email');
$udata['fname'] = $this->input->post('name');
$udata['middle_initial'] = $this->input->post('mid_name');
$udata['lname'] = $this->input->post('last_name');
$year=($this->input->post('year')=='')?'2000':$this->input->post('year');
$dob = $year."-".$this->input->post('month').'-'.$this->input->post('dt');

$udata['dob'] = $dob;
$udata['gender'] = $this->input->post('gender');
$udata['addr1'] = $this->input->post('address');
$udata['addr2'] = $this->input->post('address2');
$udata['city'] = $this->input->post('city');
$udata['state'] = $this->input->post('state');
$udata['zip'] = $this->input->post('zip');
$udata['home_phone'] = $this->input->post('home_phone');
$udata['cell_phone'] = $this->input->post('cell_phone');
$udata['work_phone'] = $this->input->post('work_phone');
$udata['preferred_contact_mode'] = $this->input->post('prefered_contact');
$udata['home_phone'] = $this->input->post('home_phone');

$recnum=$this->patient_model->insert_patient_to_db($udata);
$data['query']=$this->patient_model->patients_infoDetails($recnum);
$header['js_files'] = array();
$this->load->view("includes/pdbheader4profile", $header);
$this->load->view('patient/patient_profile_view',$data);
}
}	

/*
function appointments() {
$this->load->helper(array('form'));
$this->load->library('form_validation');
$header['js_files'] = array();
$this->load->view("includes/pdbheader4appts", $header);
$header['js_files'] = array('js/ddb_appointments_view.js');
array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
$this->load->view("includes/pdbheader4appts", $header);
$data['query'] = $this->doctor_model->patients_info();
$this->load->view("patient/pdb_appointments_view",$data);
}
*/

function listapts()
{
	date_default_timezone_set('America/Los_Angeles');
	$patientname = $this->input->post('patientname');
	$status =$this->input->post('status');
	$reason= $this->input->post('reason');
	$appt_date= $this->input->post('appt_date');

	$this->doctor_model->setpatientname($patientname);
	$this->doctor_model->setstatus($status);
	$this->doctor_model->setreason($reason);
	$this->doctor_model->setappt_date($appt_date);

	$this->load->helper(array('form'));
	$this->load->library('form_validation');
	$header['js_files'] = array('js/pdb_appointment_view.js');
	array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
	array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
	array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
	$clinic_id=$this->session->userdata('clinicid');
	$header['menu']=$this->admin_model->getmenudetails($clinic_id);

	$this->load->view("includes/pdbheader4appts", $header);
	$data['query'] = $this->doctor_model->new_patients_info();
	$data['status']=$status;
	$data['patientname']=$patientname;
	$data['reason']=$reason;
	$data['apptdate']=$appt_date;
	$data['query_search'] = $this->doctor_model->getpatientDetails4appt();
	$this->load->view("patient/pdb_appointments_view",$data);    
}

function getappointment()
{
$recnum =$this->uri->segment(3);
$data['row'] = $this->doctor_model->getapptdata4update($recnum);
$data['recnum']=$recnum;
$this->load->view('patient/patient_appt',$data);
}
function getappts4date()
{
date_default_timezone_set('America/Los_Angeles');
$inpdate = $this->uri->segment(3);
$data['query']=$this->doctor_model->appointment_info($inpdate);
$data['date']=$inpdate;
$this->load->view('doctor/hello',$data);
}

function cal_events() 
{
$events = $this->doctor_model->getcalender4patient();
header('Content-Type: application/json');
echo json_encode($events);
}

function appointments()
{
date_default_timezone_set('America/Los_Angeles');
$header['js_files'] = array();
$this->load->helper(array('form'));
$this->load->library('form_validation');

$header['js_files'] = array('js/pdb_appointment_view.js');
array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);
$this->load->view("includes/pdbheader4appts", $header);
if($this->session->userdata('appts_leftnav') == '')
{
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
}
$data['status']='';
$data['reason']='';
$data['apptdate']='';

$data['query_search'] = $this->doctor_model->getpatientDetails4appt();
$this->load->view("patient/pdb_appointments_view",$data);
}
function family_info()
{
date_default_timezone_set('America/Los_Angeles');

if ($this->input->post('value') != '')
{
$senderarr=array('family_rec'=>$this->input->post('value'));  
$this->session->set_userdata($senderarr);
$recnum=$this->input->post('value');
}
else
{
$recnum=$this->session->userdata('family_rec'); 
}

//$recnum =$this->session->userdata('recnum');

$header['js_files'] = array();
$this->load->helper(array('form'));
$data['pagename']='patient_details';			
$header['js_files'] = array('js/ddb_appointments_view.js');
array_push($header['js_files'], 'js/helper.js');
//$header['js_files'] = array('js/ddb_patients_view.js');
array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);
$this->load->view("includes/pdbheader4profile", $header);
$data['query']=$this->patient_model->patients_infoDetails($recnum);	
$data['query_emer']=$this->patient_model->emer_infoDetails($recnum);		
$data['query_health']=$this->patient_model->health_infoDetails($recnum);
$data['query_insur']=$this->patient_model->insur_infoDetails($recnum,$data['pagename']);
$data['family_mem']=$this->patient_model->family_infoDetails($recnum);
$data['param']='home1';

$data['master_meta'] = $this->admin_model->getmed_his4patient($recnum);
$data['recnum']=$recnum;


$this->load->view('patient/update_patiententry',$data);
}

function messages()
{
$this->load->helper(array('form'));  
$header['js_files'] = array('js/ddb_message4date.js'); 
array_push($header['js_files'], 'js/ddb_patients_view.js');
array_push($header['js_files'], 'js/ddb_messages.js');
array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
// array_push($header['js_files'], 'js/jquery-1.7.1.min.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);

$this->load->view("includes/pdbheader4msgs", $header);

if($this->session->userdata('msg_leftnav') == '')
{
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
}
$data['inb_fromsender']='';
$data['inb_tosender']='';
$data['inb_date']='';
$data['sent_sender']='';
$data['sent_date']='';

if ($this->input->post('sender') != '' &&  $this->input->post('check_search') == 1 )
{
$senderarr=array('sender'=>$this->input->post('sender'));  
$this->session->set_userdata($senderarr);
$data['inb_sender']=$this->session->userdata('sender');
}
else if (($this->session->userdata('sender') != '') && 
$this->input->post('check_search') == 1 )
{  
$senderarr=array('sender'=>$this->input->post('sender'));  
$this->session->set_userdata($senderarr);
$data['inb_sender']=$this->session->userdata('sender');
}
else if (($this->session->userdata('sender') != '') && 
$this->input->post('check_search') == '' )
{ 
$data['inb_sender']=$this->session->userdata('sender');
}
else if ($this->input->post('sender') == '' )
{ 
$senderarr=array('sender'=>$this->input->post('sender'));  
$this->session->set_userdata($senderarr);
$data['inb_sender']=$this->session->userdata('sender');
}        
if ($this->input->post('from_date') != '' &&  $this->input->post('check_search') == 1 )
{
$senderarr=array('from_date'=>$this->input->post('from_date'));  
$this->session->set_userdata($senderarr);
$data['inb_fromdate']=$this->session->userdata('from_date');
}
else if (($this->session->userdata('from_date') != '') && 
$this->input->post('check_search') == 1 )
{  
$senderarr=array('from_date'=>$this->input->post('from_date'));  
$this->session->set_userdata($senderarr);
$data['inb_fromdate']=$this->session->userdata('from_date');
}
else if (($this->session->userdata('from_date') != '') && 
$this->input->post('check_search') == '' )
{ 
$data['inb_fromdate']=$this->session->userdata('from_date');
}
else if ($this->input->post('from_date') == '' )
{ 
$senderarr=array('from_date'=>$this->input->post('from_date'));  
$this->session->set_userdata($senderarr);
$data['inb_fromdate']=$this->session->userdata('from_date');
}


if ($this->input->post('to_date') != '' &&  $this->input->post('check_search') == 1 )
{
$senderarr=array('to_date'=>$this->input->post('to_date'));  
$this->session->set_userdata($senderarr);
$data['inb_todate']=$this->session->userdata('to_date');
}
else if (($this->session->userdata('to_date') != '') && 
$this->input->post('check_search') == 1 )
{  
$senderarr=array('to_date'=>$this->input->post('to_date'));  
$this->session->set_userdata($senderarr);
$data['inb_todate']=$this->session->userdata('to_date');
}
else if (($this->session->userdata('to_date') != '') && 
$this->input->post('check_search') == '' )
{ 
$data['inb_todate']=$this->session->userdata('to_date');
}
else if ($this->input->post('to_date') == '' )
{ 
$senderarr=array('to_date'=>$this->input->post('to_date'));  
$this->session->set_userdata($senderarr);
$data['inb_todate']=$this->session->userdata('to_date');
}



if ($this->input->post('sender_sent') != '' &&  $this->input->post('check_sent') == 1 )
{
$senderarr=array('sender_sent'=>$this->input->post('sender_sent'));  
$this->session->set_userdata($senderarr);
$data['sent_sender']=$this->session->userdata('sender_sent');
}
else if (($this->session->userdata('sender_sent') != '') && 
$this->input->post('check_sent') == 1 )
{  
$senderarr=array('sender_sent'=>$this->input->post('sender_sent'));  
$this->session->set_userdata($senderarr);
$data['sent_sender']=$this->session->userdata('sender_sent');
}
else if (($this->session->userdata('sender_sent') != '') && 
$this->input->post('check_sent') == '' )
{ 
$data['sent_sender']=$this->session->userdata('sender_sent');
}
else if ($this->input->post('sender_sent') == '' )
{ 
$senderarr=array('sender_sent'=>$this->input->post('sender_sent'));  
$this->session->set_userdata($senderarr);
$data['sent_sender']=$this->session->userdata('sender_sent');
}   

if ($this->input->post('fromdate_sent') != '' &&  $this->input->post('check_sent') == 1 )
{
$senderarr=array('fromdate_sent'=>$this->input->post('fromdate_sent'));  
$this->session->set_userdata($senderarr);
$data['sent_fromdate']=$this->session->userdata('fromdate_sent');
}
else if (($this->session->userdata('fromdate_sent') != '') && 
$this->input->post('check_sent') == 1 )
{  
$senderarr=array('fromdate_sent'=>$this->input->post('fromdate_sent'));  
$this->session->set_userdata($senderarr);
$data['sent_fromdate']=$this->session->userdata('fromdate_sent');
}
else if (($this->session->userdata('fromdate_sent') != '') && 
$this->input->post('check_sent') == '' )
{ 
$data['sent_fromdate']=$this->session->userdata('fromdate_sent');
}
else if ($this->input->post('fromdate_sent') == '' )
{ 
$senderarr=array('fromdate_sent'=>$this->input->post('fromdate_sent'));  
$this->session->set_userdata($senderarr);
$data['sent_fromdate']=$this->session->userdata('fromdate_sent');
}

if ($this->input->post('todate_sent') != '' &&  $this->input->post('check_sent') == 1 )
{
$senderarr=array('todate_sent'=>$this->input->post('todate_sent'));  
$this->session->set_userdata($senderarr);
$data['sent_todate']=$this->session->userdata('todate_sent');
}
else if (($this->session->userdata('todate_sent') != '') && 
$this->input->post('check_sent') == 1 )
{  
$senderarr=array('todate_sent'=>$this->input->post('todate_sent'));  
$this->session->set_userdata($senderarr);
$data['sent_todate']=$this->session->userdata('todate_sent');
}
else if (($this->session->userdata('todate_sent') != '') && 
$this->input->post('check_sent') == '' )
{ 
$data['sent_todate']=$this->session->userdata('todate_sent');
}
else if ($this->input->post('todate_sent') == '' )
{ 
$senderarr=array('todate_sent'=>$this->input->post('todate_sent'));  
$this->session->set_userdata($senderarr);
$data['sent_todate']=$this->session->userdata('todate_sent');
}
$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
$sent_or_recd = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';

$config = array();

$config["base_url"] = base_url() . "patient_ctrl/messages/sent/";
$res= $this->patient_model->record_count4sent();
$data['sent_totrows']=$res->numrows;
$config["total_rows"] = $res->numrows;       

$config['num_links'] = ($page == 0 ? 4 : ($page == 5 ? 3 : 2));
$config["per_page"] = 10;
$config["uri_segment"] = 4;	
$config['cur_tag_open'] = "<a style='background-color: #ccc; color: #333;'><b>";
$config['cur_tag_close'] = "</b></a>"; 	 


if($this->uri->segment(3) != 'sent')
{
$page=0;
$config["uri_segment"] = 0;
}
$this->pagination->initialize($config);    
$data['query'] = $this->patient_model->getallMsg4sent('sent',$this->session->userdata('userid'), 
$config["per_page"], $page);
$data['page']=$page;
$data["sent_links"] = $this->pagination->create_links(); 

$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
$res1= $this->patient_model->record_count4inbox();        
$config = array();
$config['num_links'] = ($page == 0 ? 4 : ($page == 5 ? 3 : 2));
$config["per_page"] = 10;
$config["uri_segment"] = 4;	
$config['cur_tag_open'] = "<a style='background-color: #ccc; color: #333;'><b>";
$config['cur_tag_close'] = "</b></a>"; 

$config["base_url"] = base_url() . "patient_ctrl/messages/inbox/";
$config["total_rows"] = $res1->numrows;
$data['inb_totrows']=$res1->numrows;



$data['page']=$page;
if($this->uri->segment(3) != 'inbox')
{
$page=0;
$config["uri_segment"] = 0;
}
$this->pagination->initialize($config);
$data['query_inbox'] = $this->patient_model->getallMsg4sent('inbox',
$this->session->userdata('userid'),$config["per_page"], $page);
$data["inbox_links"] = $this->pagination->create_links();   

if($sent_or_recd == 'sent')
{
$data['parameter'] = 'sends';
$this->load->view("patient/pdb_messages_view",$data);
}
else
{
$data['parameter'] = 'inbox';         
$this->load->view("patient/pdb_messages_view",$data);
}
$this->load->view("includes/footer");
}
function reports()
{
//        $header['css_files']=array('css/update.css');
$header['js_files'] = array();
$this->load->view("includes/pdbheader4reports", $header);
$patientlink = 1;
$data['query']=$this->patient_model->patients_info($patientlink);	   
//$data['query']=$this->doctor_model->currday_appointment_info();
//$this->load->view('patient/doctor_dashboard_view',$data);
$this->load->view('patient/patient_dashboard_view',$data);
$this->load->view("includes/footer");
}
function new_profile()
{
$header['js_files'] = array(); 
$this->load->helper(array('form'));
$data['pagename']='patient_details';			
$header['js_files'] = array('js/ddb_appointments_view.js');
array_push($header['js_files'], 'js/ddb_patients_view.js');
array_push($header['js_files'], 'js/helper.js');
array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);

$this->load->view("includes/pdbheader4profile", $header);
$recnum=$this->session->userdata('recnum');
$data['query']=$this->patient_model->patients_infoDetails($recnum);	
$data['query_emer']=$this->patient_model->emer_infoDetails($recnum);		
$data['query_insur']=$this->patient_model->insur_infoDetails($recnum,$data['pagename']);
$data['master_meta']=$this->admin_model->getallname4group($clinic_id,'health_history');
$this->load->view('patient/patient_new_entry',$data);
}

function temp() 
{
$this->load->helper(array('form', 'url'));
$this->load->library('form_validation');
$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
$chkdupret = 0;
$this->form_validation->set_rules('location', 'Location', 'required');

if ($this->form_validation->run() == FALSE) 
{
$this->session->set_flashdata('flashMessage', 'Failed to update appointment.');
redirect('/doctor_ctrl/appointments/', 'refresh');
} 
else
{
$appt_date=$this->input->post('appt_date');
$appt_time=$this->input->post('appt_time');
$location=$this->input->post('location');

$link2op=$this->patient_model->getleastop($appt_date,$appt_time,$location);

if(count($link2op) !=0)
{
$link2operatory=$link2op->recnum;
}
else
{
$link2operatory ='';	
}	
$data = array(
'doctor' => $this->input->post('doc_name'),
'link2patientinfo' => $this->input->post('patient_name'),
'appt_date' => $this->input->post('appt_date'),
'location' => $this->input->post('location_name'),
'appt_time' => $this->input->post('appt_time'),
'appt_duration' => $this->input->post('appt_duration'),
'reason' => $this->input->post('purpose'),
'remarks' => $this->input->post('remarks'),
'status' => $this->input->post('status'),
'sms_reminder' =>  $this->input->post('sms_email'),
'email_reminder' => $this->input->post('email'),
'link2clinic' => $this->input->post('location'),
'link2operatory' => $link2operatory,
'created_by' => "Need to Implement",
'modified_by' => "Need to Implement",
'created_date' => $this->input->post('appt_date'),
'modified_date' => $this->input->post('appt_date'),
'link2doctor'=>$this->input->post('doc_id'),
);
// Checking for duplicates
$patientlinkarr = $this->input->post('patient_name');
$patientlink = $patientlinkarr[0];
$location       = $this->input->post('location_name');
$record = $this->doctor_model->check4dup($this->input->post('patient_name'));
	$clinic_id=$this->session->userdata('clinicid');

if (count($record) == '0')
{
	//If waitlist get the waitlist number 
	if($this->input->post('status')== 'Waitlist')
	{
	$record1 = $this->doctor_model->check4waitlistnumber(
	$this->input->post('appt_date'),$clinic_id);
	
	if(count($record1) == 0 )
	{
		$waitlist = 0 ;
		$data['waitlistnumber'] = $waitlist + 1  ;
	}
	else
	{
	$waitlist = $record1->waitlistnumber ;
	$data['waitlistnumber'] = $waitlist + 1  ;
	}	
	}	
	
	$this->doctor_model->insert_appointment($data);
	$clinic_id=$this->session->userdata('clinicid');
	$clinic_name=$this->admin_model->getclinicdetails($clinic_id);

	$sms_rem=$this->input->post('sms_email');//default value= 1;
	$email=$this->input->post('email');

/*...............SMS stuff................................*/
if($sms_rem==1)
try{
	//$sid = id for msg servie;// these two variables are set from external file.
	//$token = "{{ auth_token }}";
	$account_sid = $GLOBALS['sid'];
	$auth_token = $GLOBALS['token'];
	$client = new Services_Twilio($account_sid, $auth_token); 
	 $mobile_arr=explode('-',$record1->cell_phone);
	//$mobile_num=$this->mob_prefix.$mobile_arr[0].$mobile_arr[1].$mobile_arr[2]; 
	$mobile_num=$mobile_arr[0].$mobile_arr[1].$mobile_arr[2];  
	$clinic_details=$clinic_name->name.' '.$clinic_name->site_id;
	$appt_date=$this->input->post('appt_date');
	$appttime = $this->input->post('appt_time');
	$client->account->messages->create(array( 
		'To' => "$mobile_num", 
		'From' => "+18317091518", 
		'Body' => "You have an appointment at $clinic_details on 
	$appt_date at $appttime.  Any questions, please contact 408-835-0724.",   
	));
	}
	catch(Exception $e)
	{
		echo "Error: ".$e->getMessage();
		
	}

if($email == 1)
{
$this->load->view('smtpfns');

$this->smtp_model->setclinicid($clinic_name->name);
$this->smtp_model->setpatient_insur($record1->insurance_company);
$this->smtp_model->setremarks($this->input->post('remarks'));

$this->smtp_model->setsite_id($clinic_name->site_id);
$dd=$this->doctor_model->getpatient_name($this->input->post('patient_name'));
$this->smtp_model->setname($dd->fullname);
$this->smtp_model->setappt($this->input->post('appt_date'));
//$this->smtp_model->setclinicid($this->input->post('location'));
$this->smtp_model->setdct_name($this->input->post('doc_name'));
$this->smtp_model->setappt_date($this->input->post('appt_date'));
$this->smtp_model->setappt_time($this->input->post('appt_time'));
$this->smtp_model->setduration($this->input->post('appt_duration'));
$this->smtp_model->setpurpose($this->input->post('purpose'));
$this->smtp_model->getappt_details();

$this->smtp_model->setemail($record1->email);
$this->smtp_model->getappt_details();
$record2 = $this->doctor_model->check4email_in_doc($this->input->post('doc_id'));

$this->smtp_model->setemail($record2->email);
$this->smtp_model->getappt_details2doctor();
}
}
else
{
$this->session->set_flashdata('flashMessage', "Duplicate appointment for $chkdupret");
redirect('/patient_ctrl/appointments/', 'refresh');
}
$this->session->set_flashdata('flashMessage', 'Your Appointment Successfully Registered...!');
redirect('/patient_ctrl/appointments/', 'refresh');
}
}

function getlocdetails()
{
date_default_timezone_set('America/Los_Angeles');
$options = array(
"08:00:00" ,
"08:30:00",
"09:00:00",
"09:30:00",
"10:00:00",
"10:30:00",
"11:00:00" ,
"11:30:00",
"12:00:00",
"12:30:00",
"13:00:00",
"13:30:00" ,
"14:00:00",
"14:30:00" ,
"15:00:00",
"15:30:00",
"16:00:00",
"16:30:00",
);
$options_disp = array(
"8.00" => 'true',
"8.30" => 'true',
"9.00" => 'true',
"9.30" =>'true',
"10.00" => 'true',
"10.30" => 'true',
"11.00" => 'true',
"11.30" => 'true',
"12.00" => 'true',
"12.30" => 'true',
"1.00" => 'true',
"1.30" =>'true',
"2.00" => 'true',
"2.30" => 'true',
"3.00" => 'true',
"3.30" =>'true',
"4.00" =>'true',
"4.30" =>'true',
);
$location=$this->uri->segment(3);
$appt_date=$this->uri->segment(4);
$chkdupret = $this->doctor_model->check4op($location);	

foreach($chkdupret as $op)
{		
$operatory=$op->recnum;
$all_det[$operatory]=$options;		
$chkdb = $this->doctor_model->getappt_details($location,$appt_date,$operatory);
$in_db=array();			
foreach($chkdb  as $in)
{
$in_db[]=$in->appt_time;
}
$indb[$operatory]=$in_db;			
}
//print_r($all_det);
//echo '<br><br>';
//print_r($indb);echo '<br><br>';
$new_array=array();
foreach($indb as $key=> $res) 
{
foreach($res as $val) 
{
$ind = array_search($val,$all_det[$key]);
//unset($all_det[$key][$ind]);	

if($ind == $all_det[$key][$ind])
{
unset($all_det[$key]);				
}
			
}
foreach($all_det[$key] as $v1)
{
array_push($new_array,$v1);
}
}
$new_arr=array_values(array_unique($new_array));
sort($new_arr);
//print_r($new_arr);

foreach($options_disp as  $key => $value)
{
list($hour, $minute) = explode('.',$key);		

if($hour <= '4')
$acc='PM';
elseif($hour == '12')
$acc='PM';
else
$acc='AM';

$cov_time=sprintf('%02d',$hour).":".$minute." ".$acc;
$date =date("H:i:s", strtotime($cov_time));

if(!in_array($date, $new_arr))
{
$options_disp[$key] = 0;				
}		
}

foreach($chkdb  as $t)
{
list($hour, $minute) = explode(':',$t->appt_time);
$start_time=$hour* 3600 + $minute*60;
$end_time=($start_time+($t->appt_duration*60));		
$end=$end_time-(60*30);
$time_sl = $this->doctor_model->hoursRange( $start_time, $end, 60 * 30, 'h:i a' );
foreach ($time_sl as $t1) 
{	
$options_disp[$t1] = '0';
}
}

$count=0;
$reverse=array_reverse($options_disp);
foreach($reverse as  $key => $value)
{
if($reverse[$key] != '0' )
{
$count=$count+30;
$options_disp[$key] = $count;				
}
else
$count=0;
}

header('Content-Type: application/json');
echo json_encode($options_disp);
}

function insert_newfamily()
{
date_default_timezone_set('America/Los_Angeles');
$udata['email'] = $this->input->post('email');		 
$udata['fname'] = $this->input->post('fname');
$udata['middle_initial'] = $this->input->post('middle_initial');
$udata['lname'] = $this->input->post('lname');
$udata['link2clinic'] = $this->session->userdata('clinicid');
$year=($this->input->post('year')=='')?'2000':$this->input->post('year');
$dob = $year."-".$this->input->post('month').'-'.$this->input->post('dt');
$udata['dob'] = $dob;
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

$udata['preferred_contact_mode'] = $this->input->post('preferred_contact_mode');

$config['upload_path'] = 'application/uploads/';

$config['allowed_types'] = 'gif|jpg|png|jpeg';		
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
$count=$this->admin_model->getpassworddetails($this->input->post('email'));
if(count($count) >0)
{
	$this->session->set_flashdata('flashMessage', "Registration Failed!!..");
	redirect('login');
}	
$patient_id=$this->patient_model->insert_patient_to_db($udata);

$udata1=array();
$udata1['userid'] = $this->input->post('email');
$new_password=$this->getRandomString(10);
$password= md5($new_password); 
$udata1['password'] = $password;
$udata1['link2clinic'] = $this->session->userdata('clinicid');
$udata1['type'] = 'patient';
$udata1['link2patient'] = $patient_id;
$udata1['status'] = 'Active';
$udata1['created_date'] = date('Y-m-d');
$udata1['created_by'] = 'regn_by_clinic';

$this->patient_model->insert_newuser($udata1);

$this->session->set_flashdata('flashMessage', "Thanks for your registration !! Please check the email for login Cridentials");	  
$this->load->view('smtpfns');
$clinic_name=$this->admin_model->getclinicdetails($this->session->userdata('clinicid'));
$name=$this->input->post('fname').' '. $this->input->post('middle_initial')." ".$this->input->post('lname');

$this->smtp_model->setclinicid($clinic_name->name);
$this->smtp_model->setsite_id($clinic_name->site_id);
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

/*
$udata['high_bp'] = $this->input->post('high_bp') ? "yes" : "no";

$udata['low_bp'] = ($this->input->post('low_bp')== 'low_bp')  ? "yes" : "no";
$udata['angina_chest_pain'] =  ($this->input->post('angina_chest_pain') == 'angina_chest_pain')  ? "yes" : "no";
$udata['fainiting'] =  $this->input->post('fainiting')  ? "yes" : "no";
$udata['irregular_heartbeat'] = $this->input->post('irregular_heartbeat')  ? "yes" : "no";
$udata['heart_attack'] = $this->input->post('heart_attack')  ? "yes" : "no";
$udata['heart_bypass'] =  $this->input->post('heart_bypass')  ? "yes" : "no";
$udata['pacemaker'] =  $this->input->post('pacemaker')  ? "yes" : "no";
$udata['anemia'] =$this->input->post('anemia')  ? "yes" : "no";
$udata['hepatitis_a'] = $this->input->post('hepatitis_a')  ? "yes" : "no";
$udata['hepatitis_b'] = $this->input->post('hepatitis_b')  ? "yes" : "no";
$udata['hepatitis_c'] =  $this->input->post('hepatitis_c')  ? "yes" : "no";
$udata['hiv'] =   $this->input->post('hiv')  ? "yes" : "no";
$udata['aids'] =  $this->input->post('aids')  ? "yes" : "no";
$udata['std'] =  $this->input->post('std')  ? "yes" : "no";
$udata['delay_in_healing'] =   $this->input->post('delay_in_healing')  ? "yes" : "no";
$udata['pancreas_diabetes'] =   $this->input->post('pancreas_diabetes')  ? "yes" : "no";
$udata['kidney_dialysis'] =  $this->input->post('kidney_dialysis')  ? "yes" : "no";
$udata['eyes_glaucoma'] =  $this->input->post('eyes_glaucoma')  ? "yes" : "no";			  
$udata['thyroid'] =  $this->input->post('thyroid')  ? "yes" : "no";
$udata['neurology_epilepsy'] =   $this->input->post('neurology_epilepsy')  ? "yes" : "no";
$udata['cancer_location'] =  $this->input->post('cancer_location')  ? "yes" : "no";
$udata['surgery'] = $this->input->post('surgery')  ? "yes" : "no";
$udata['radiation'] =  $this->input->post('radiation')  ? "yes" : "no";
$udata['chemotherapy'] =   $this->input->post('chemotherapy')  ? "yes" : "no";
$udata['jaw_joints_pain'] =  $this->input->post('jaw_joints_pain')  ? "yes" : "no";
$udata['arthritis'] =   $this->input->post('arthritis')  ? "yes" : "no";
$udata['arthritis_knee_replacement'] =  $this->input->post('arthritis_knee_replacement')  ? "yes" : "no";
$udata['arthritis_hip_replacement'] =  $this->input->post('arthritis_hip_replacement')  ? "yes" : "no";
$udata['swollen_ankles'] =  $this->input->post('swollen_ankles')  ? "yes" : "no";

$udata['link2patient'] = $patient_id;

$this->patient_model->insert_history_to_db($udata);
*/
$udata=array();

$udata['name_of_insured'] = $this->input->post('name_of_insured');	
$udata['insurance_company'] = $this->input->post('insurance_company');
$udata['group_id'] = $this->input->post('group_id');
$udata['member_id'] = $this->input->post('member_id');
$config['upload_path'] = 'application/uploads/';

$config['allowed_types'] = 'gif|jpg|png|jpeg';		
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
$this->update_profile();
}
function update_familymem()
{
$recnum = $this->input->post('recnum');
$udata=array();

$udata['email'] = $this->input->post('email');		 
$udata['fname'] = $this->input->post('fname');
$udata['middle_initial'] = $this->input->post('middle_initial');
$udata['lname'] = $this->input->post('lname');
 $year=($this->input->post('year')=='')?'2000':$this->input->post('year');
$dob = $year."-".$this->input->post('month').'-'.$this->input->post('dt');
$udata['dob'] = $dob;
$udata['gender'] = $this->input->post('gender');
$udata['addr1'] = $this->input->post('addr');
$udata['addr2'] = $this->input->post('addr2');
$udata['city'] = $this->input->post('city');
$udata['state'] = $this->input->post('state');
$udata['zip'] = $this->input->post('zip');
$udata['referred_by'] = $this->input->post('referred_by');
// $udata['cell_phone'] = $this->input->post('cell_phone');
//$udata['work_phone'] = $this->input->post('work_phone');

$home_phone=$this->input->post('home_phone1').'-'.$this->input->post('home_phone2').'-'.$this->input->post('home_phone3');
$udata['home_phone'] = $home_phone;
$cell_phone=$this->input->post('cell_phone4peronal1').'-'.$this->input->post('cell_phone4peronal2').'-'.$this->input->post('cell_phone4peronal3');
$udata['cell_phone'] = $cell_phone;
$work_phone=$this->input->post('work_phone4peronal1').'-'.$this->input->post('work_phone4peronal2').'-'.$this->input->post('work_phone4peronal3');
$udata['work_phone'] = $work_phone;

$udata['preferred_contact_mode'] = $this->input->post('preferred_contact_mode');
$config['upload_path'] = 'application/uploads/';

$config['allowed_types'] = 'gif|jpg|png|jpeg';		
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
$this->patient_model->update_personal($udata,$recnum);
$udata=array();

$udata['fname'] = $this->input->post('emer_fname');		 
$udata['middle_initial'] = $this->input->post('emer_midname');		 
$udata['lname'] = $this->input->post('emer_lname');		 
//$udata['home_phone'] = $this->input->post('emer_homenum');		 
//$udata['work_phone'] = $this->input->post('emer_worknum');	
//$udata['cell_phone'] = $this->input->post('emer_cellnum');
$emer_homenum=$this->input->post('emer_homenum1').'-'.$this->input->post('emer_homenum2').'-'.$this->input->post('emer_homenum3');
$udata['home_phone'] = $emer_homenum;
$emer_cellnum=$this->input->post('emer_cellnum1').'-'.$this->input->post('emer_cellnum2').'-'.$this->input->post('emer_cellnum3');
$udata['cell_phone'] = $emer_cellnum;
$emer_worknum=$this->input->post('emer_worknum1').'-'.$this->input->post('emer_worknum2').'-'.$this->input->post('emer_worknum3');
$udata['work_phone'] = $emer_worknum;

$udata['email'] = $this->input->post('emer_email');
$udata['relationship'] = $this->input->post('emer_relation');

$this->patient_model->update_emerg($udata,$recnum);
$udata=array();

$udata['height_feet'] = $this->input->post('height_feet');	
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
$udata['other'] = $this->input->post('other');
$udata['signature'] = $this->input->post('output');
$udata['accept'] = 'save';
$udata['link2patient'] = $recnum;
$udata['created_by'] = 'Doctor';
$udata['created_date'] = date('Y-m-d');
$recnum=$this->input->post('recnum');
$this->patient_model->update_health_info4patient($udata,$recnum);

$udata1=array();
$udata1['link2patient'] = $recnum;
$upd_num=$this->input->post('upd_num');
$new_upd=$upd_num+1;
$index=$this->input->post('index');
for($i=0;$i<$index;$i++)
{         
          $name= $this->input->post('name_'.$i)?"yes":"no";	
	  $udata1['group'] = $this->input->post('group'.$i);	
	  $udata1['medical_condition'] = $this->input->post('name'.$i);	
	  $udata1['condition_status'] = $name;
	  $udata1['disp_seq'] = $this->input->post('dispseq_'.$i);
          $udata1['created_by'] = 'Doctor';
          $udata1['created_date'] = date('Y-m-d');
          $udata1['upd_num']=$new_upd;
	  $this->patient_model->insert_patientmeta($udata1);
} 

/*
$udata['high_bp'] = $this->input->post('high_bp')? "yes" : "no";
$udata['low_bp'] = $this->input->post('low_bp')? "yes" : "no";
$udata['angina_chest_pain'] = $this->input->post('angina_chest_pain')? "yes" : "no";

$udata['fainiting'] = $this->input->post('fainiting')? "yes" : "no";
$udata['irregular_heartbeat'] = $this->input->post('irregular_heartbeat')? "yes" : "no";
$udata['heart_attack'] = $this->input->post('heart_attack')? "yes" : "no";
$udata['heart_bypass'] = $this->input->post('heart_bypass')? "yes" : "no";
$udata['pacemaker'] = $this->input->post('pacemaker')? "yes" : "no";
$udata['anemia'] = $this->input->post('anemia')? "yes" : "no";
$udata['hepatitis_a'] = $this->input->post('hepatitis_a')? "yes" : "no";
$udata['hepatitis_b'] = $this->input->post('hepatitis_b')? "yes" : "no";
$udata['hepatitis_c'] = $this->input->post('hepatitis_c')? "yes" : "no";
$udata['hiv'] = $this->input->post('hiv')? "yes" : "no";
$udata['aids'] = $this->input->post('aids')? "yes" : "no";
$udata['std'] = $this->input->post('std')? "yes" : "no";
$udata['delay_in_healing'] = $this->input->post('delay_in_healing')? "yes" : "no";
$udata['pancreas_diabetes'] = $this->input->post('pancreas_diabetes')? "yes" : "no";
$udata['kidney_dialysis'] = $this->input->post('kidney_dialysis')? "yes" : "no";
$udata['eyes_glaucoma'] = $this->input->post('eyes_glaucoma')? "yes" : "no";
$udata['thyroid'] = $this->input->post('thyroid')? "yes" : "no";
$udata['neurology_epilepsy'] = $this->input->post('neurology_epilepsy')? "yes" : "no";
$udata['cancer_location'] = $this->input->post('cancer_location')? "yes" : "no";
$udata['cancer_location_name'] = $this->input->post('cancer_location_name');
$udata['surgery'] = $this->input->post('surgery')? "yes" : "no";
$udata['radiation'] = $this->input->post('radiation')? "yes" : "no";
$udata['chemotherapy'] = $this->input->post('chemotherapy')? "yes" : "no";
$udata['jaw_joints_pain'] = $this->input->post('jaw_joints_pain')? "yes" : "no";
$udata['arthritis'] = $this->input->post('arthritis')? "yes" : "no";
$udata['arthritis_knee_replacement'] = $this->input->post('arthritis_knee_replacement')? "yes" : "no";
$udata['arthritis_hip_replacement'] = $this->input->post('arthritis_hip_replacement')? "yes" : "no";
$udata['swollen_ankles'] = $this->input->post('swollen_ankles')? "yes" : "no";
$udata['other'] = $this->input->post('other');
$this->patient_model->update_medhis($udata,$recnum);
*/

$udata=array();

$udata['name_of_insured'] = $this->input->post('name_of_insured');	
$udata['insurance_company'] = $this->input->post('insurance_company');
$udata['group_id'] = $this->input->post('group_id');
$udata['member_id'] = $this->input->post('member_id');
$config=array();
$config['upload_path'] = 'application/uploads/';
$config['allowed_types'] = 'gif|jpg|png|jpeg';		
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

$this->patient_model->update_insur($udata,$recnum);
$data['param']='familymember';

//redirect("patient_ctrl/update_profile");

$this->update_profile();

}

function getdoc()
{
$loc = $this->uri->segment(3);
$finalDropDown=$this->patient_model->getdocid($loc);
header('Content-Type: application/json');
echo json_encode($finalDropDown);
}
function edit_mail()
{
$recnum =$this->uri->segment(3);
$type =$this->uri->segment(4);
$this->patient_model->updateread_flag($recnum);
$data['row'] = $this->patient_model->getemail_details($recnum);
$data['recnum']=$recnum;
$data['type']=$type;
$data['replay']=0;
$this->load->view('patient/ajax_maildetails4patient.php',$data);
}
function replay_mail()
{
$recnum =$this->uri->segment(3);
$data['row'] = $this->patient_model->getemail_details($recnum);
$data['recnum']=$recnum;
$data['replay']=1;
$type =$this->uri->segment(4);
$data['type']=$type;

$this->load->view('patient/ajax_maildetails4patient.php',$data);
}
function delete_email()
{
$index =$this->input->post('sent_index');
$i=1;
if($index != '')
{
while($i < $index)
{
if( $this->input->post('chk_sent'.$i) != '')
{
$recnum=$this->input->post('rec_sent'.$i);
$this->doctor_model->delete_msg($recnum);
}
$i++;
}
}
//$this->redirec_sent();
redirect('/patient_ctrl/messages/sent');
}
function delete_email4inb()
{
$index =$this->input->post('inb_index');
$i=1;
if($index != '')
{
while($i < $index)
{
if( $this->input->post('chk_inb'.$i) != '')
{
$recnum=$this->input->post('recnum_inb'.$i);
$this->doctor_model->delete_msg4inb($recnum);
}
$i++;
}
}
$this->messages();
}
function insert_email()
{
$data['to_emailid'] = $this->input->post('patient_name');
$data['to_name'] = $this->input->post('d_name');  
$data['from_emailid'] =$this->input->post('doctor_email');
$data['from_name'] =$this->input->post('p_name'); 
$data['subject'] =$this->input->post('subject');
$data['message'] =$this->input->post('message');
$data['date'] =date('Y-m-d H:i:s'); 
$data['priority_flag'] =$this->input->post('priority'); 
$data['read_flag'] = 0; 
$data['sent_recd']='sent';
$config['upload_path'] = 'application/attachments/';
$config['allowed_types'] = "doc|docx|pdf|zip|jpeg|jpg|txt|gif|png";		
$this->load->library('upload', $config);	
if (!$this->upload->do_upload('userfile'))
{
$udata = array('msg' => $this->upload->display_errors());
}
else 
{
$udata['upload_data'] = $this->upload->data();
$data['attachment']= $udata['upload_data']['file_name'];
}
$this->doctor_model->insert_msg($data);
$data1['to_emailid'] = $this->input->post('patient_name');
$data1['to_name'] = $this->input->post('p_name');  
$data1['from_emailid'] =$this->input->post('doctor_email');
$data1['from_name'] =$this->input->post('d_name'); 
$data1['subject'] =$this->input->post('subject');
$data1['message'] =$this->input->post('message');
$data1['date'] =date('Y-m-d H:i:s'); 
$data1['priority_flag'] =$this->input->post('priority'); 
$data1['read_flag'] = 0; 
$data1['sent_recd']='inbox';
$data1['attachment']= $udata['upload_data']['file_name'];
$this->doctor_model->insert_msg($data1);
/* mail for message****************/

$this->load->view('smtpfns');
$this->smtp_model->setname($this->input->post('p_name'));
$this->smtp_model->getmessagedetails();


/*******8ends*************/
redirect('/patient_ctrl/messages/sent');
}
function replay_msg()
{
$data['message'] = $this->input->post('replay_mail').'<br/><br>'.$this->input->post('replay_msg');
$data['to_name'] = $this->input->post('patient_name');
$data['to_emailid'] = $this->input->post('patient_email'); 
$data['from_name'] =$this->input->post('d_name');
$data['from_emailid'] =$this->input->post('doctor_email');
$data['subject'] ='RE:'.$this->input->post('subject');
$data['date'] =date('Y-m-d H:i:s'); 
$data['priority_flag'] =$this->input->post('priority'); 
$data['read_flag'] = 0; 
$data['sent_recd']='sent'; 

$config=array();
$udata=array();
$config['upload_path'] = 'application/attachments/';
$config['allowed_types'] = "doc|docx|pdf|zip|jpeg|jpg|txt|gif|png";		
$this->load->library('upload', $config);	
if(!$this->upload->do_upload('userfile1'))
{
$udata = array('msg' => $this->upload->display_errors());
}
else 
{
$udata['upload_data'] = $this->upload->data();
$data['attachment']= $udata['upload_data']['file_name'];
}

$this->doctor_model->insert_msg($data);
$data=array();

$data['message'] = $this->input->post('replay_mail').'<br/><br>'.$this->input->post('replay_msg');	

$data['to_name'] = $this->input->post('patient_name');
$data['to_emailid'] = $this->input->post('patient_email'); 
$data['from_name'] =$this->input->post('d_name');
$data['from_emailid'] =$this->input->post('doctor_email');
$data['attachment']= $udata['upload_data']['file_name'];
$data['subject'] ='RE:'.$this->input->post('subject');
$data['date'] =date('Y-m-d H:i:s'); 
$data['priority_flag'] =$this->input->post('priority'); 
$data['read_flag'] = 0; 
$data['sent_recd']='inbox'; 
$this->doctor_model->insert_msg($data);
if($this->input->post('type') == 'inbox' )
redirect('/patient_ctrl/messages');
else
redirect('/patient_ctrl/messages/sent');
}
function insert_dental_history()
{
$data['reason_today_visit'] = $this->input->post('reason_text');
$data['formal_dentist'] = $this->input->post('former_dentist_name');
$data['last_dental_visit'] = $this->input->post('last_dental_date');
$data['last_dental_xray'] = $this->input->post('last_dental_xray_date');
$data['bad_breath'] = $this->input->post('bad_breadth');

$data['bleeding_gums'] = $this->input->post('bleeding_gums');
$data['blisters_teeth'] = $this->input->post('blisters');
$data['burning_sensation'] = $this->input->post('burning');
$data['chew_one_side'] = $this->input->post('chew_side');
$data['popping_jaws'] = $this->input->post('click_pop');
$data['dry_mouth'] = $this->input->post('dry_mouth');
$data['fingar_bitting'] = $this->input->post('finger_bite');
$data['foreign_object'] = $this->input->post('foreign');
$data['grinding_teeth'] = $this->input->post('grind');
$data['gum_swollen'] = $this->input->post('gums');
$data['jaw_pain'] = $this->input->post('jaw_pain');
$data['lip_cheek_bitting'] = $this->input->post('lip_cheek');
$data['loose_teeth'] = $this->input->post('lose');
$data['mouth_breathing'] = $this->input->post('mouth_breath');
$data['mouth_pain'] = $this->input->post('mouth_pain');
$data['orthodontic_treatment'] = $this->input->post('ortho');
$data['pain_around_ears'] = $this->input->post('pain_ear');
$data['perio_treatment'] = $this->input->post('perio');
$data['sensitivity_cold'] = $this->input->post('cold');
$data['sensitivity_heat'] = $this->input->post('heat');
$data['sensitivity_sweet'] = $this->input->post('sweets');
$data['sensitivity_bite'] = $this->input->post('biting');
$data['sores_growth'] = $this->input->post('sores');
$data['brush_time'] = $this->input->post('brush_frequency');
$data['other'] = $this->input->post('anything_else_dental');
$data['link2patient'] = $this->session->userdata('recnum');

$this->patient_model->insert_dental_history($data);

redirect('/patient_ctrl/profile');
}

function insert_consent()
{
date_default_timezone_set('America/Los_Angeles');
$data['link2patient'] = $this->input->post('link2patient');
$data['date'] = date('Y-m-d');
if($this->input->post('output4treatment') != '')
{
$data['type'] = 'treatment_to_be_done';
$data['signature'] = $this->input->post('output4treatment');
$data['patient_signature'] = $this->input->post('output4patientsign');
$data['dentist_signature'] = $this->input->post('output4dentistsign');
$data['link2doctor'] = $this->input->post('consent_doctor_name');
$data['witness_signature'] = $this->input->post('output4witnesssign');
$data['witness_name'] = $this->input->post('witness');
$this->patient_model->insert_cansent_history($data);
}
if($this->input->post('output4drug_med') != '')
{
$data['type'] = 'drugs_and_medication';
$data['signature'] = $this->input->post('output4drug_med');
$data['patient_signature'] = $this->input->post('output4patientsign');
$data['dentist_signature'] = $this->input->post('output4dentistsign');
$data['link2doctor'] = $this->input->post('consent_doctor_name');
$data['witness_signature'] = $this->input->post('output4witnesssign');
$data['witness_name'] = $this->input->post('witness');
$this->patient_model->insert_cansent_history($data);
}
if($this->input->post('output4treat_plan') != '')
{
$data['type'] = 'changes_to_treatment_plan';
$data['signature'] = $this->input->post('output4treat_plan');
$data['patient_signature'] = $this->input->post('output4patientsign');
$data['dentist_signature'] = $this->input->post('output4dentistsign');
$data['link2doctor'] = $this->input->post('consent_doctor_name');
$data['witness_signature'] = $this->input->post('output4witnesssign');
$data['witness_name'] = $this->input->post('witness');
$this->patient_model->insert_cansent_history($data);
}
if($this->input->post('output4extraction') != '')
{
$data['type'] = 'extraction';
$data['toothnum1'] = $this->input->post('extract_tooth1');
$data['toothnum1'] = $this->input->post('extract_tooth2');
$data['signature'] = $this->input->post('output4extraction');
$data['patient_signature'] = $this->input->post('output4patientsign');
$data['dentist_signature'] = $this->input->post('output4dentistsign');
$data['link2doctor'] = $this->input->post('consent_doctor_name');
$data['witness_signature'] = $this->input->post('output4witnesssign');
$data['witness_name'] = $this->input->post('witness');
$this->patient_model->insert_cansent_history($data);
}
if($this->input->post('output4crown') != '')
{
$data['type'] = 'crowns';
$data['toothnum1'] = $this->input->post('crown_tooth');
$data['shade'] = $this->input->post('shade_tooth4crown');
$data['signature'] = $this->input->post('output4crown');
$data['patient_signature'] = $this->input->post('output4patientsign');
$data['dentist_signature'] = $this->input->post('output4dentistsign');
$data['link2doctor'] = $this->input->post('consent_doctor_name');
$data['witness_signature'] = $this->input->post('output4witnesssign');
$data['witness_name'] = $this->input->post('witness');
$this->patient_model->insert_cansent_history($data);
}
if($this->input->post('output4denture') != '')
{
$data['type'] = 'dentures';
$data['shade'] = $this->input->post('denture_shade');
$data['signature'] = $this->input->post('output4denture');
$data['patient_signature'] = $this->input->post('output4patientsign');
$data['dentist_signature'] = $this->input->post('output4dentistsign');
$data['link2doctor'] = $this->input->post('consent_doctor_name');
$data['witness_signature'] = $this->input->post('output4witnesssign');
$data['witness_name'] = $this->input->post('witness');
$this->patient_model->insert_cansent_history($data);
}
if($this->input->post('output4endodontic') != '')
{
$data['type'] = 'endodontic_treatment';
$data['toothnum1'] = $this->input->post('endodontic_tooth');
$data['signature'] = $this->input->post('output4endodontic');
$data['patient_signature'] = $this->input->post('output4patientsign');
$data['dentist_signature'] = $this->input->post('output4dentistsign');
$data['link2doctor'] = $this->input->post('consent_doctor_name');
$data['witness_signature'] = $this->input->post('output4witnesssign');
$data['witness_name'] = $this->input->post('witness');
$this->patient_model->insert_cansent_history($data);
}
if($this->input->post('output4peridontal') != '')
{
$data['type'] = 'periodontal_loss';
$data['signature'] = $this->input->post('output4peridontal');
$data['patient_signature'] = $this->input->post('output4patientsign');
$data['dentist_signature'] = $this->input->post('output4dentistsign');
$data['link2doctor'] = $this->input->post('consent_doctor_name');
$data['witness_signature'] = $this->input->post('output4witnesssign');
$data['witness_name'] = $this->input->post('witness');
$this->patient_model->insert_cansent_history($data);
}
if($this->input->post('output4filling') != '')
{
$data['type'] = 'fillings';
$data['signature'] = $this->input->post('output4filling');
$data['patient_signature'] = $this->input->post('output4patientsign');
$data['dentist_signature'] = $this->input->post('output4dentistsign');
$data['link2doctor'] = $this->input->post('consent_doctor_name');
$data['witness_signature'] = $this->input->post('output4witnesssign');
$data['witness_name'] = $this->input->post('witness');
$this->patient_model->insert_cansent_history($data);
}
if($this->input->post('output4pedodontic') != '')
{
$data['type'] = 'pedodontics';
$data['signature'] = $this->input->post('output4pedodontic');
$data['patient_signature'] = $this->input->post('output4patientsign');
$data['dentist_signature'] = $this->input->post('output4dentistsign');
$data['link2doctor'] = $this->input->post('consent_doctor_name');
$data['witness_signature'] = $this->input->post('output4witnesssign');
$data['witness_name'] = $this->input->post('witness');
$this->patient_model->insert_cansent_history($data);
}
redirect('/patient_ctrl/profile');
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
}    
