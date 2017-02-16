<?php
//==============================================
// Author: FSI                                 
// Date-written = Dec 01, 2014                 
// Filename: doctor_ctrl.php                   
// Copyright of Fluent Technologies            
// Doctor Controller                        
//==============================================
include("sms_credentials.php");
/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
class doctor_ctrl extends CI_Controller 
{
function __construct()
{
	parent::__construct();
	$this->load->helper('url');
	$this->load->model('patient_model');
	$this->load->model('doctor_model');
	$this->load->model('smtp_model');
	$this->load->model('admin_model');
	$this->load->library('session');
	$this->load->helper('form');
	$this->load->library("pagination");
	$this->load->library('form_validation');
	include("SessionController.php"); 
    include("user_type4doctor.php"); 
	include("Twilio.php");
    $this->mob_prefix='+1';
}
function index() 
{
date_default_timezone_set('Asia/Kolkata');
$header['js_files'] = array();

$clinic_id=$this->session->userdata('clinicid');
$userid=$this->session->userdata('userid');
$doctor_id=$this->session->userdata('doctor_id');
$operator_id=$this->session->userdata('operator_id');

$header['menu']=$this->admin_model->getmenudetails($clinic_id);
$header['count_read']=$this->doctor_model->totunread_patientcount();

$this->load->view("includes/header", $header);
if($this->session->userdata('home_leftnav') == '')
{
    //$this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    //redirect('login');
}
$sessdata = array(
'dayofappt' => 'curr'      
);
$this->session->set_userdata($sessdata);
//List of appointments (table)home page
$data['query']=$this->doctor_model->currday_appointment_info();
//List of appointments (status)home page
$data['appt']=$this->doctor_model->apptcount(0);
$data['totpend']=$this->doctor_model->totpendapptcount();
$data['menu']=$this->admin_model->getmenudetails($clinic_id);

$data['count_read']=$this->doctor_model->totunreadcount();
$data['priority']=$this->doctor_model->totprioritycount();
$insur=$this->doctor_model->insurance_count();
$data['insurance']=$insur;
$no_insur=$this->doctor_model->noinsurance_count();
$data['no_insurance']=$no_insur->numrows;
$data['pend_appt']=$this->doctor_model->getpatientDetails();


$type =  $this->session->userdata('type');
if($type =='doctor')
{
$this->load->view('doctor/doctor_dashboard_view',$data);
}
else
{
$this->load->view('doctor/operator_dashboard_view',$data);
}
$this->load->view("includes/footer");
}

function getappts4date()
{
	date_default_timezone_set('Asia/Kolkata');
	$inpdate = $this->uri->segment(3);
	$data['query']=$this->doctor_model->getappointment_info($inpdate);
	$data['date']=$inpdate;
	$this->load->view('doctor/hello',$data);
}
function nextday()
{
		
//$header['css_files']=array('css/update.css');
$header['js_files'] = array();
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);
$header['count_read']=$this->doctor_model->totunread_patientcount();

$this->load->view("includes/header", $header);
if($this->session->userdata('home_leftnav') == '')
{
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
}
$sessdata = array(
'dayofappt' => 'next'      
);
$this->session->set_userdata($sessdata);
$data['appt']=$this->doctor_model->apptcount(1);
$data['query']=$this->doctor_model->nextday_appointment_info();
$data['totpend']=$this->doctor_model->totpendapptcount();
$data['count_read']=$this->doctor_model->totunreadcount();
$insur=$this->doctor_model->insurance_count();
$data['insurance']=$insur;
$no_insur=$this->doctor_model->noinsurance_count();
$data['no_insurance']=$no_insur->numrows;
$data['pend_appt']=$this->doctor_model->getpatientDetails();
$data['priority']=$this->doctor_model->totprioritycount();
$this->load->view('doctor/doctor_dashboard_view',$data);
$this->load->view("includes/footer");
}
function nextplusday()
{ 
//$header['css_files']=array('css/update.css');
$header['js_files'] = array();
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);
$header['count_read']=$this->doctor_model->totunread_patientcount();
$this->load->view("includes/header", $header);
if($this->session->userdata('home_leftnav') == '')
{
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
}
$sessdata = array(
'dayofappt' => 'nextplus'
);
$this->session->set_userdata($sessdata);
$data['appt']=$this->doctor_model->apptcount(2);
$data['query']=$this->doctor_model->nextplusday_appointment_info();
$data['totpend']=$this->doctor_model->totpendapptcount();
$data['count_read']=$this->doctor_model->totunreadcount();
$insur=$this->doctor_model->insurance_count();
$data['insurance']=$insur;
$no_insur=$this->doctor_model->noinsurance_count();
$data['no_insurance']=$no_insur->numrows;
$data['pend_appt']=$this->doctor_model->getpatientDetails();
$data['priority']=$this->doctor_model->totprioritycount();

$this->load->view('doctor/doctor_dashboard_view',$data);
$this->load->view("includes/footer");
}
function slots() 
{
echo "<br>Here in slots";
$date = $this->uri->segment(3);
$time_slots = $this->doctor_model->get_slots($date);
$options = array(
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
$count=0;
foreach ($time_slots as $t) 
{
list($hour, $minute) = explode(':',$t->appt_time);
$start_time=$hour* 3600 + $minute*60;
$end_time=($start_time+($t->appt_duration*60));		
$end=$end_time-(60*60*30);
$time_sl = $this->doctor_model->hoursRange( $start_time, $end, 60 * 30, 'h:i a' );
foreach ($time_sl as $t1) 
{	
$options[$t1] = '0';
}
}	
$reverse=array_reverse($options);
foreach($reverse as  $key => $value)
{
if($reverse[$key] != '0' )
{
$count=$count+30;
$options[$key] = $count;				
}
else
$count=0;
}
//header('Content-Type: application/json');
$options = array('8:00' => 1, '9:00' => 2, '10:00' => 3, '11:00' => 4, '15:00' => 5);
echo json_encode($options);
}
function patients() 
{
	//$this->smtp_model->preventivecheckupmail();
$header['js_files'] = array('js/ddb_patients_view.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);
$header['count_read']=$this->doctor_model->totunread_patientcount();

$this->load->view("includes/header4patients", $header);
if($this->session->userdata('profile_leftnav') == '')
{
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
}
$data['search_patient']='';
$data['search_patient_lname']='';

if($this->uri->segment(3) == 'insurance' )
{
  $senderarr=array('insurance'=>'insurance');  
  $this->session->set_userdata($senderarr);
}
else if($this->uri->segment(3) == 'no_insurance')
{
  $senderarr=array('insurance'=>'no_insurance');  
  $this->session->set_userdata($senderarr);
}
else if($this->uri->segment(3) == '')
{
  $senderarr=array('insurance'=>'all');  
  $this->session->set_userdata($senderarr);
}

if($this->input->post('commonsearch') != '' &&  $this->input->post('check_search') == 1 )
{

$senderarr=array('commonsearch'=>$this->input->post('commonsearch'));  
$this->session->set_userdata($senderarr);
$data['commonsearch']=$this->session->userdata('commonsearch');
}
else if(($this->session->userdata('commonsearch') != '') && 
$this->input->post('check_search') == 1 )
{

$senderarr=array('commonsearch'=>$this->input->post('commonsearch'));  
$this->session->set_userdata($senderarr);
$data['commonsearch']=$this->session->userdata('commonsearch');
}
else if (($this->session->userdata('commonsearch') != '') && 
$this->input->post('check_search') == '' )
{ 
$data['commonsearch']=$this->session->userdata('commonsearch');
}
else if ($this->input->post('commonsearch') == '' )
{ 
$senderarr=array('commonsearch'=>$this->input->post('commonsearch'));  
$this->session->set_userdata($senderarr);
$data['commonsearch']=$this->session->userdata('commonsearch');
}

if($this->input->post('patient') != '' &&  $this->input->post('check_search') == 1 )
{
$senderarr=array('patient'=>$this->input->post('patient'));  
$this->session->set_userdata($senderarr);
$data['search_patient']=$this->session->userdata('patient');
}
else if (($this->session->userdata('patient') != '') && 
$this->input->post('check_search') == 1 )
{  
$senderarr=array('patient'=>$this->input->post('patient'));  
$this->session->set_userdata($senderarr);
$data['search_patient']=$this->session->userdata('patient');
}
else if (($this->session->userdata('patient') != '') && 
$this->input->post('check_search') == '' )
{ 
$data['search_patient']=$this->session->userdata('patient');
}
else if ($this->input->post('patient') == '' )
{ 
$senderarr=array('patient'=>$this->input->post('patient'));  
$this->session->set_userdata($senderarr);
$data['search_patient']=$this->session->userdata('patient');
}

if ($this->input->post('patient_lastname') != '' &&  $this->input->post('check_search') == 1 )
{
$senderarr=array('patient_lastname'=>$this->input->post('patient_lastname'));  
$this->session->set_userdata($senderarr);
$data['search_patient_lname']=$this->session->userdata('patient_lastname');
}
else if (($this->session->userdata('patient_lastname') != '') && 
$this->input->post('check_search') == 1 )
{  
$senderarr=array('patient_lastname'=>$this->input->post('patient_lastname'));  
$this->session->set_userdata($senderarr);
$data['search_patient_lname']=$this->session->userdata('patient_lastname');
}
else if (($this->session->userdata('patient_lastname') != '') && 
$this->input->post('check_search') == '' )
{ 
$data['search_patient_lname']=$this->session->userdata('patient_lastname');
}
else if ($this->input->post('patient_lastname') == '' )
{ 
$senderarr=array('patient_lastname'=>$this->input->post('patient_lastname'));  
$this->session->set_userdata($senderarr);
$data['search_patient_lname']=$this->session->userdata('patient_lastname');
}

if ($this->input->post('insurance') != '' &&  $this->input->post('check_search') == 1 )
{
$senderarr=array('insurance'=>$this->input->post('insurance'));  
$this->session->set_userdata($senderarr);
$data['insurance']=$this->session->userdata('insurance');
}
else if (($this->session->userdata('from_date') != '') && 
$this->input->post('check_search') == 1 )
{  
$senderarr=array('insurance'=>$this->input->post('insurance'));  
$this->session->set_userdata($senderarr);
$data['insurance']=$this->session->userdata('insurance');
}
else if (($this->session->userdata('insurance') != '') && 
$this->input->post('check_search') == '' )
{ 
$data['insurance']=$this->session->userdata('insurance');
}
else if ($this->input->post('insurance') == '' )
{ 
$senderarr=array('insurance'=>$this->input->post('insurance'));  
$this->session->set_userdata($senderarr);
$data['insurance']=$this->session->userdata('insurance');
}

$data['patients'] = $this->doctor_model->patients_t();

$this->load->view("doctor/ddb_patients_view", $data);
$this->load->view("includes/footer");

}
function pt()
{
$data1['patients'] = $this->doctor_model->patients_t();


$data['patients'] = $this->doctor_model->patients_info();

}

function patients_info() 
{
  date_default_timezone_set('Asia/Kolkata');
  $header['js_files'] = array('js/ddb_patient_info.js');
  $clinic_id=$this->session->userdata('clinicid');
  $header['menu']=$this->admin_model->getmenudetails($clinic_id);
  $val= $this->input->post('val');

  if($val != '')
  {
    $patient_id =$this->input->post("recnum$val");
    $senderarr=array('patient_id'=>$patient_id);  
    $this->session->set_userdata($senderarr);
  }
  else
  {
    $patient_id =$this->session->userdata('patient_id');
  }

  $header['count_read']=$this->doctor_model->totunread_patientcount();
  $this->load->view("includes/header4patients", $header);

  if($this->session->userdata('profile_leftnav') == '')
  {
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
  }

  $data['query'] = $this->patient_model->patients_infoDetails($patient_id);
  foreach($data as $q)
  {	
    $link2doctor = $q->link2doctor;
    $clinicid=$q->link2clinic;
  }

  $data['insur'] = $this->patient_model->insur_infoDetails($patient_id);
  $data['emer'] = $this->patient_model->emer_infoDetails($patient_id);
  $data['help'] = $this->doctor_model->getdocname($link2doctor);
  $data['recnum']=$this->uri->segment(3);
  $data['health'] = $this->patient_model->health_infoDetails($patient_id);

  $data['app_lists'] = $this->patient_model->get_appointment_lists($patient_id);

  $this->load->view("doctor/ddb_patient_info_view",$data);
  $this->load->view("includes/footer");
}

function appointments() 
{
  date_default_timezone_set('Asia/Kolkata');
  $this->load->helper(array('form'));
  $this->load->library('form_validation');
  $header['js_files'] = array('js/ddb_appointments_view.js');
  array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
  array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
  array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
  $clinic_id=$this->session->userdata('clinicid');
  $doctor_id=$this->session->userdata('doctor_id');
  $header['menu']=$this->admin_model->getmenudetails($clinic_id);
  $header['count_read']=$this->doctor_model->totunread_patientcount();

  $this->load->view("includes/header4appts", $header);
  if($this->session->userdata('appts_leftnav') == '')
  {
      $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
      redirect('login');
  }
  //$data['query'] = $this->doctor_model->new_patients_info();
  //new patients appt requests
  $data['query'] = $this->doctor_model->new_patients_appointment_info($doctor_id);

  $data['status']='';
  $data['patientname']='';
  $data['reason']='';
  $data['apptdate']='';

  //search appointments
  $data['query_search'] = $this->doctor_model->getpatientDetails();
  $this->load->view("doctor/ddb_appointments_view",$data);
}
function messages()
{
date_default_timezone_set('Asia/Kolkata');
$this->load->helper(array('form'));  
$header['js_files'] = array('js/ddb_message4date.js'); 
array_push($header['js_files'], 'js/ddb_patients_view.js');
array_push($header['js_files'], 'js/ddb_messages.js');
array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);
$header['count_read']=$this->doctor_model->totunread_patientcount();

$this->load->view("includes/header4msgs", $header);
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
$sent_or_recd = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
$config = array();
$config["base_url"] = base_url() . "doctor_ctrl/messages/sent/";
$res= $this->doctor_model->record_count4sent();
$data['sent_totrows']=$res->numrows;
$res= $this->doctor_model->record_count4sent();
$config["total_rows"] = $res->numrows;    $config["uri_segment"] = 4;   
if($this->uri->segment(3) != 'sent')
{
$page=0;
$config["uri_segment"] = 0;
}
$config['num_links'] = ($page == 0 ? 4 : ($page == 5 ? 3 : 2));

$config["per_page"] = 10;

$config['cur_tag_open'] = "<a style='background-color: #ccc; color: #333;'><b>";
$config['cur_tag_close'] = "</b></a>"; 
$this->pagination->initialize($config); 



$data['query'] = $this->doctor_model->getallMsg4sent('sent',$this->session->userdata('userid'), 
$config["per_page"], $page);
$data['page']=$page;
$data["sent_links"] = $this->pagination->create_links(); 


$res1= $this->doctor_model->record_count4inbox();     
$data['inb_totrows']=$res1->numrows;   
$config1 = array();
$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
$config1["uri_segment"] = 4;
if($this->uri->segment(3) != 'inbox')
{
$page=0;
$config1["uri_segment"] = 0;
}
$config1['num_links'] = ($page == 0 ? 4 : ($page == 5 ? 3 : 2));
$config1["per_page"] = 10;

$config1["base_url"] = base_url() . "doctor_ctrl/messages/inbox/";
$config1["total_rows"] = $res1->numrows;
$config1['cur_tag_open'] = "<a style='background-color: #ccc; color: #333;'><b>";
$config1['cur_tag_close'] = "</b></a>";

$this->pagination->initialize($config1);

$data['query_inbox'] = $this->doctor_model->getallMsg4sent('inbox',
$this->session->userdata('userid'),$config1["per_page"], $page);

$data["inbox_links"] = $this->pagination->create_links();   

if($sent_or_recd == 'sent')
{
$data['parameter'] = 'sends';
$this->load->view("doctor/ddb_messages_view",$data);
}
else
{
$data['parameter'] = 'inbox';         
$this->load->view("doctor/ddb_messages_view",$data);
}
$this->load->view("includes/footer");
}
function reports()
{
$header['js_files'] = array('js/ddb_messages.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);

$this->load->view("includes/header4reports", $header);
if($this->session->userdata('report_leftnav') == '')
{
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
}
$this->load->view("doctor/ddb_reports_view");
$this->load->view("includes/footer");
}
function cal_events() 
{
$events = $this->doctor_model->getcalender();
//  print_r($events);
header('Content-Type: application/json');
echo json_encode($events);
}

function temp() 
{
  
  $this->load->helper(array('form', 'url'));
  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
  $chkdupret = 0;

  $this->form_validation->set_rules('location', 'Location', 'required');
  $this->form_validation->set_rules('appt_time', 'Time', 'required');
  if ($this->form_validation->run() == FALSE) 
  {
    $this->session->set_flashdata('flashMessage', 'Failed to update appointment.');			  
    redirect('/doctor_ctrl/appointments/profile');
  } 
  else 
  {
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
    'sms_reminder' => $this->input->post('sms_email'),
    'email_reminder' => $this->input->post('email'),
    'link2operatory' => $this->input->post('operatory'),
    'link2clinic' => $this->input->post('location'),
    'created_by' => "Need to Implement",
    'modified_by' => "Need to Implement",
    'created_date' =>$this->input->post('appt_date'),
    'modified_date' => $this->input->post('appt_date'),
    'link2doctor' => $this->input->post('doc_id'),

    );

    // Checking for duplicates
    $patientlinkarr = $this->input->post('patient_name');
    $location       = $this->input->post('location');
    $operatory      = $this->input->post('operatory');
    $patientlink    = $patientlinkarr[0];
    $record = $this->doctor_model->check4dup($this->input->post('patient_name'));

    if (count($record) == '0')
    {
    		//IF waitlist get the waitlist number 
    	if($this->input->post('status')== 'Waitlist')
    	{
      	$record2 = $this->doctor_model->check4waitlistnumber(
      	$this->input->post('appt_date'),$location,$operatory);
    		if(count($record2) == 0 )
    		{
    			$waitlist = 0 ;
    			$data['waitlistnumber'] = $waitlist + 1  ;
    		}
    		else
    		{
    			$waitlist = $record2->waitlistnumber ;
    			$data['waitlistnumber'] = $waitlist + 1  ;
    		}	
    	
    	}	

    	$this->doctor_model->insert_appointment($data);
    	$record1 = $this->doctor_model->check4dup($this->input->post('patient_name'));

    	$clinic_id=$this->session->userdata('clinicid');
    	$clinic_name=$this->admin_model->getclinicdetails($clinic_id);
    	$sms_rem=$this->input->post('sms_email');//default value= 1;
    	$email=$this->input->post('email');

    	/*...............SMS stuff................................*/
    	if($sms_rem==1)
      	try
        {
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
        	$appttime=$this->input->post('appt_time');
        	
        	$client->account->messages->create(array( 
        	'To' => "$mobile_num", 
        	'From' => "+18317091518", 
        	 'Body' => "You have an appointment at $clinic_details on
               $appt_date at $appttime.  Any questions, please contact bmandyam@fluentsoft.com.", 
        	));
      	}
      	catch(Exception $e)
      	{
      	 echo "Sending SMS Failed: ".$e->getMessage();
      	//exit();
      	}

    	if($email == 1)
    	{
      	$this->load->view('smtpfns');
      		
      	$this->smtp_model->setemail($record1->email);	
      	$this->smtp_model->setclinicid($clinic_name->name);
      	$this->smtp_model->setsite_id($clinic_name->site_id);
      	$this->smtp_model->setdct_name($this->input->post('doc_name'));

      	$dd=$this->doctor_model->getpatient_name($this->input->post('patient_name'));
      	$this->smtp_model->setname($dd->fullname);
      	$this->smtp_model->setappt($this->input->post('appt_date'));
      	$this->smtp_model->getappt_details();
    	}
    }
    else
    {
    	$this->session->set_flashdata('flashMessage', "Duplicate appointment for 
    	$record->fullname");
    	redirect('/doctor_ctrl/appointments/', 'refresh');
    }

  	$this->session->set_flashdata('flashMessage', 'Successfully Updated...!');
  	redirect('/doctor_ctrl/appointments/', 'refresh');
  }

}

function getlocdetails()
{
date_default_timezone_set('Asia/Kolkata');
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
$operatory=$this->uri->segment(5);

$all_det[$operatory]=$options;		
$chkdb = $this->doctor_model->getappt_details($location,$appt_date,$operatory);
$in_db=array();			

foreach($chkdb  as $in)
{
$in_db[]=$in->appt_time;
}
$indb[$operatory]=$in_db;			

$new_array=array();
foreach($indb as $key=> $res) 
{
foreach($res as $val) 
{
$ind = array_search($val,$all_det[$key]);
//removed the below code because it was greying out the first value also
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
//print_r($new_array) ;

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

//echo $date ."<br>";
//print_r($new_arr) ;
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
//$key ='5.30' ; 
//$value ='900';
//array_push($options_disp,array($key=>$value)) ;

header('Content-Type: application/json');
echo json_encode($options_disp);
}



function getoperatory()
{
$chkdb1=array();
$link2clinic=$this->uri->segment(3);
$chkdb = $this->doctor_model->getOperatory($link2clinic);
$chkdb1['0']='Select';
foreach($chkdb as $val)
{
$recnum=(int)$val->recnum;
$chkdb1[$recnum]=$val->opname;
}
header('Content-Type: application/json');
echo json_encode($chkdb1);
}


function listappts()
{
date_default_timezone_set('Asia/Kolkata');
$patientname = $this->input->post('patientname');
$status =$this->input->post('status');
$reason= $this->input->post('reason');
$appt_date= $this->input->post('appt_date');
$doc_id= $this->session->userdata('doctor_id');

$this->doctor_model->setpatientname($patientname);
$this->doctor_model->setstatus($status);
$this->doctor_model->setreason($reason);
$this->doctor_model->setappt_date($appt_date);


$this->load->helper(array('form'));
$this->load->library('form_validation');
$header['js_files'] = array('js/ddb_appointments_view.js');
array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);
$header['count_read']=$this->doctor_model->totunread_patientcount();

$this->load->view("includes/header4appts", $header);
if($this->session->userdata('appts_leftnav') == '')
{
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
}
//$data['query'] = $this->doctor_model->new_patients_info();
$data['query'] = $this->doctor_model->new_patients_appointment_info($doc_id);


$data['status']=$status;
$data['patientname']=$patientname;
$data['reason']=$reason;
$data['apptdate']=$appt_date;
$data['query_search'] = $this->doctor_model->getpatientDetails();
$this->load->view("doctor/ddb_appointments_view",$data);    
}
function getappointment()
{
$recnum =$this->uri->segment(3);
$data['row'] = $this->doctor_model->getapptdata4update($recnum);
$data['recnum']=$recnum;
$this->load->view('doctor/ajax_index',$data);
}
function update_appointment()
{
	
$udata['reason'] = $this->input->post('reason');
$udata['status'] = $this->input->post('status');


$this->doctor_model->update_Appt($udata,$this->input->post('recnum'));


$stts=$this->input->post('status');
$email=$this->input->post('email');
$this->load->view('smtpfns');
$rec=$this->input->post('recnum');

//added by udaya ON july 21st
$capptdate1    =$this->input->post('appt_date1');
$cappttime     =$this->input->post('appt_time');
$capptdur      =$this->input->post('appt_duration');
$doc_id        = $this->input->post('doc_id');
$clinicid      = $this->input->post('clinicid');
$operatory     = $this->input->post('operatory');

$appt_arr  = array();
$arrdiff   = array();
$arrdiff1  = array();
$optionsk  = array(
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
	
$optionsk1 = array(
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
if($this->input->post('status')=='Cancelled')
{
	$chknumber = $this->doctor_model->check4waitlist($capptdate1, $clinicid);
	$app     = $this->doctor_model->getappointmentsfordday($capptdate1, $clinicid, $operatory);

	$apdur1 =0;
	$apptime  = "";
	
	//to remove appointments slots for the day 
	foreach($app as $valk)
	{			
	$aptime = $valk->appt_time       ;
	$apdur  = $valk->appt_duration   ;
	if($apdur >=60)
	{
	$apdur1 =  $apdur - 30 ;
	$aptime1 = strtotime("+" . $apdur1."minutes", strtotime($aptime));
	$apptime = date('h:i:s', $aptime1);			
	}
	else
	{
	$apptime ="";	
	}	
	
	array_push($appt_arr, $aptime, $apptime) ;
	
	}		
	$arrdiff = array_diff($optionsk, $appt_arr) ;
	

	$apdur2  =0;
	$aptime2 =0;
	$apptime1=0;
	
	foreach($chknumber as $val)
	{
		$cond ='';
	
		$flag = 0 ;
		$waitarr = array();
		$waitlistnum   = $val->waitlistnumber;		
		$link2patient1 = $val->link2patientinfo;
		
		$aptime        = $val->appt_time     ;
		$apdur2        = $val->appt_duration ;
		
		if($apdur2 >=60)
		{
		$apdur2 =  $apdur2 - 30 ;
		$aptime2 = strtotime("+" . $apdur2."minutes", strtotime($aptime));
		$apptime1 = date('h:i:s', $aptime2);			
		}
		else
		{
		$apptime1 ="";
		}

		if($apptime1 !='')
		{
		$flag = 1 ;		
		array_push($waitarr, $aptime, $apptime1) ;
		}
		else
		{
		$flag = 0; 
		array_push($waitarr, $aptime) ;	
		}	

		
		if($flag == 1)
		{
		$cond = in_array($aptime,$arrdiff) && in_array($apptime1, $arrdiff) ;
		}
		else
		{
		$cond = in_array($aptime,$arrdiff) ;	
		}	
		if($cond)
		{
		$arrdiff = array_diff($arrdiff, $waitarr) ;
		
		$patientid = $val->link2patientinfo ;
		$appid     = $val->recnum           ;	
		$pdate     = $val->appt_date        ;	
		$ptime     = $val->appt_time        ;	
		$udata1['status']         = 'Pending';
		$udata1['waitlistnumber'] = '';
		$udata1['link2operatory'] = $operatory;
		$this->doctor_model->update_Appt($udata1,$appid);
		
	
		
		$clinic_id=$this->session->userdata('clinicid');
		
		$clinic1=$this->admin_model->getclinicdetails($clinic_id);
		$record2 = $this->doctor_model->getPatientPhone($patientid);
		
	//echo "clinicid" ."--". $clinic1->name ."--" . $patientid ." //---" . $clinic_name ."--" . $record2->cell_phone ." --" . //$pdate ." --" . $ptime ."<BR>" ;
	
	
		
			try{
			//$sid = id for msg servie;// these two variables are set from external file.
			//$token = "{{ auth_token }}";
			$account_sid = $GLOBALS['sid'];
			$auth_token = $GLOBALS['token'];
			$client = new Services_Twilio($account_sid, $auth_token); 
			$mobile_arr=explode('-',$record2->cell_phone);
			
			$mobile_num=$mobile_arr[0].$mobile_arr[1].$mobile_arr[2];  
			$clinic_details=$clinic1->name.' '.$clinic1->site_id;
			$appt_date=$this->input->post('appt_date');
			$appt_time=$this->input->post('appt_time');
			
			$client->account->messages->create(array( 
			'To' => "$mobile_num", 
			'From' => "+18317091518", 
			 'Body' => "Your appointment request has been confirmed to $stts for  $clinic_details on
			   $pdate at $ptime . Any questions, please contact 4116 1302.",  
			));
			}
			catch(Exception $e)
			{
			echo "Error: ".$e->getMessage();
			//exit();
			}
		
		}
	}

	/*
	
	if(count($chknumber ) > 0)
	{
		$patientid = $chknumber->link2patientinfo ;
		$appid     = $chknumber->recnum   ;
		$udata1['status']         = 'Pending';
		$udata1['waitlistnumber'] = '';
		$this->doctor_model->update_Appt($udata1,$appid);
	

	$clinic_id=$this->session->userdata('clinicid');
	$clinic_name=$this->admin_model->getclinicdetails($clinic_id);
	$record2 = $this->doctor_model->getPatientPhone($patientid);
	

	try{
	//$sid = id for msg servie;// these two variables are set from external file.
	//$token = "{{ auth_token }}";
	$account_sid = $GLOBALS['sid'];
	$auth_token = $GLOBALS['token'];
	$client = new Services_Twilio($account_sid, $auth_token); 
	$mobile_arr=explode('-',$record2->cell_phone);
	
	$mobile_num=$mobile_arr[0].$mobile_arr[1].$mobile_arr[2];  
	$clinic_details=$clinic_name->name.' '.$clinic_name->site_id;
	$appt_date=$this->input->post('appt_date');
	$appt_time=$this->input->post('appt_time');
	
	$client->account->messages->create(array( 
	'To' => "$mobile_num", 
	'From' => "+18317091518", 
	 'Body' => "Your appointment request has been changed to $stts for  $clinic_details on
       $appt_date at $appt_time . Any questions, please contact 408-835-0724.",  
	));
	}
	catch(Exception $e)
	{
	echo "Error: ".$e->getMessage();
	//exit();
	}
	}
	*/

}
if($this->input->post('status')=='Confirmed')
{
if($email==1)
{
	$this->smtp_model->getmail_details($this->input->post('recnum'));
}
}

	$sms_rem=$this->input->post('sms_email');
	/*...............SMS stuff................................*/
	if($sms_rem==1)
	{
	$clinic_id=$this->session->userdata('clinicid');
	$clinic_name=$this->admin_model->getclinicdetails($clinic_id);
	$record1 = $this->doctor_model->getPatientPhone($this->input->post('recnum'));

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
	$appt_time=$this->input->post('appt_time');
	
	
	$client->account->messages->create(array( 
	'To' => "$mobile_num", 
	'From' => "+18317091518", 
	 'Body' => "Your appointment request has been changed to $stts for  $clinic_details on
       $appt_date at $appt_time . Any questions, please contact 408-835-0724.",  
	));
	}
	catch(Exception $e)
	{
	echo "Error: ".$e->getMessage();
	//exit();
	}
	}



$this->appointments();
}
function update_status()
{
$udata['status'] = $this->input->post('status');	
$this->doctor_model->update_Appt($udata,$this->input->post('recnum'));
$this->index();
}
/*function redirec_sent()
{
$res= $this->doctor_model->record_count4sent();
$config = array();
$config["base_url"] = base_url() . "doctor_ctrl/messages/sent/";
$config["total_rows"] = $res->numrows;        

$config['num_links']=2;
$config["per_page"] = 5;
$config["uri_segment"] = 3;	 
$this->pagination->initialize($config);
$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
$sent_or_recd = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';

$data['query'] = $this->doctor_model->getallMsg4sent('sent',$this->session->userdata('userid'), 
$config["per_page"], $page);
$data['config']=$config;
$data["sent_links"] = $this->pagination->create_links(); 
$data['parameter'] = 'sends';
$header['js_files'] = array('js/ddb_messages.js');
$header['js_files1'] = array('js/jquery-1.7.1.min.js');
$this->load->view("includes/header4msgs", $header);

$senderarr=array('sender_sent'=>$this->input->post('sender_sent'));  
$this->session->set_userdata($senderarr);
$senderarr1=array('date_sent'=>$this->input->post('date_sent'));  
$this->session->set_userdata($senderarr1);


$data['sent_sender']=$this->session->userdata('sender_sent');
$data['sent_date']=$this->session->userdata('date_sent');

$data['inb_sender']=$this->session->userdata('sender');
$data['inb_date']=$this->session->userdata('date');
$data['query_inbox'] = $this->doctor_model->getallMsg4sent('inbox',$this->session->userdata('userid'),5, 0);

$this->load->view("doctor/ddb_messages_view",$data);         
}*/
function insert_email()
{
$data['to_emailid'] = $this->input->post('patient_name');
$data['to_name'] = $this->input->post('p_name');  
$data['from_emailid'] =$this->input->post('doctor_email');
$data['from_name'] =$this->input->post('d_name'); 
$data['subject'] =$this->input->post('subject');
$data['message'] =$this->input->post('message');
$data['date'] =date('Y-m-d H:i:s'); 
$data['priority_flag'] =$this->input->post('priority'); 

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

$data['read_flag'] = 0;
$data['sent_recd']='sent';
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

redirect('/doctor_ctrl/messages/sent');
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
redirect('/doctor_ctrl/messages/sent');
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
function edit_mail()
{
$recnum =$this->uri->segment(3);
$type =$this->uri->segment(4);
$data['type']=$type;
$this->patient_model->updateread_flag($recnum);
$data['row'] = $this->patient_model->getemail_details($recnum);
$data['recnum']=$recnum;
$data['replay']=0;
$this->load->view('doctor/ajax_maildetails4doc',$data);
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
redirect('/doctor_ctrl/messages');
else
redirect('/doctor_ctrl/messages/sent');


}
function replay_mail()
{
	$recnum =$this->uri->segment(3);
	$data['row'] = $this->patient_model->getemail_details($recnum);
	$data['recnum']=$recnum;
	$data['replay']=1;
	$type =$this->uri->segment(4);
	$data['type']=$type;
	$this->load->view('doctor/ajax_maildetails4doc',$data);
}

function getpatient_info()
{  
  
  $patient_id=$this->session->userdata('patient_id');
  $val='';
  $res = $this->patient_model->health_infoDetails4check($patient_id);  
  foreach($res as $h)
  {
	   if($h->condition_status == 'yes')
	   {
		$val=$h->medical_condition;
                $health_rec=$h->recnum;
		break;
	   }
  }
  $health_iss=$val;
  $header['js_files'] = array();
  $data['health_info'] = $this->admin_model->gethealth_info($patient_id);
  date_default_timezone_set('Asia/Kolkata');
  // $header['js_files'] = array('js/ddb_patient_info.js');

  // array_push($header['js_files'], 'js/ddb_appointments_view.js');
  // array_push($header['js_files'], 'js/helper.js');

  // array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');

  // array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
  // array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');

  $clinic_id=$this->session->userdata('clinicid');
  $header['menu']=$this->admin_model->getmenudetails($clinic_id);
  $header['count_read']=$this->doctor_model->totunread_patientcount();
  // $this->load->view("includes/header4patients", $header);
  // if($this->session->userdata('profile_leftnav') == '')
  // {
  //     $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
  //     redirect('login');
  // }
  $data['query'] = $this->patient_model->patients_infoDetails($patient_id);
  $data['insur'] = $this->patient_model->insur_infoDetails($patient_id);
  $data['emer'] = $this->patient_model->emer_infoDetails($patient_id);
  $data['query_health']=$this->patient_model->health_infoDetails($patient_id);


  $data['surgery']=$this->patient_model->getpatient_surgeryDetails($patient_id);


  $data['surgery_notes']=$this->patient_model->getpatient_surgeryNotes($patient_id);


  $data['post_surgery_notes']=$this->patient_model->postsurgeryNotes($patient_id);


  $data['postopnotes']=$this->patient_model->getpatient_postopNotes($patient_id);

  // echo "<pre>";
  // print_r($data['postopnotes']);exit;

  $data['postop_commnotes']=$this->patient_model->getpatient_postop_commNotes($patient_id);


  $data['health']=$this->patient_model->health_infoDetails4patient($patient_id);
  $data['den_his'] = $this->doctor_model->getdental_historydetails($patient_id);
  $data['consent'] = $this->doctor_model->getconsentdetails($patient_id);
  $data['patient_sig'] = $this->doctor_model->getconsentdetails4patient($patient_id);
  $recnum=$patient_id;



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

  $data['denhisory']=$this->doctor_model->getdental_historydetails4patient($patient_id);
  $data['health_iss']=$health_iss;
  $data['recnum']=$recnum;

  $data['param']=$this->input->post('param');
  $data['med_his'] = $this->admin_model->getmed_his4patient($patient_id);
  $clinic=$this->admin_model->getclinic_details($clinic_id);
  $data['clinic_name']=$clinic->name.' '.$clinic->site_id;
  $doctor_id=$this->session->userdata('doctor_id');
  $doctor=$this->admin_model->emailDetails($doctor_id);
  $data['doctor_name']=$doctor->fname.' '.$doctor->lname;

  $data['param']=$this->input->post('app_recnum');

  $this->load->view('doctor/patient_view',$data);
}

function update_patient()
{
date_default_timezone_set('Asia/Kolkata');
$header['js_files'] = array('js/ddb_patient_info.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);

$this->load->view("includes/header4patients", $header);
if($this->session->userdata('profile_leftnav') == '')
{
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
}
$recnum=$this->uri->segment(3);
$data['query'] = $this->patient_model->patients_infoDetails($this->uri->segment(3));
foreach($data as $q)	
$link2doctor=$q->link2doctor;
$data['insur'] = $this->patient_model->insur_infoDetails($this->uri->segment(3));
$data['emer'] = $this->patient_model->emer_infoDetails($this->uri->segment(3));
$data['pagename']='patient_update';
$data['health_iss']='';
$data['recnum']=$recnum;

$this->load->view('doctor/update_profile',$data);		
$this->load->view("includes/footer");
}

function getattachment_details()
{
$data['attachment'] =$this->uri->segment(3);
$this->load->view('doctor/getattachment',$data);
}
function dental_historydetails()
{   
date_default_timezone_set('Asia/Kolkata');
$header['js_files'] = array();

$data['den_his'] = $this->doctor_model->getdental_history($this->uri->segment(3));	
$data['recnum']=$this->uri->segment(3);
$data['dental_history_rec'] = $this->uri->segment(4);
$data['health_iss'] = $this->uri->segment(5);
$this->load->view('doctor/dental_historydetails',$data);
}
function update_dentalhistory()
{
date_default_timezone_set('Asia/Kolkata');

$data['den_his'] = $this->doctor_model->getdental_history($this->uri->segment(3));	
$data['recnum']=$this->uri->segment(4);
$data['link2patient'] = $this->uri->segment(4);
$data['dental_history_rec'] = $this->uri->segment(3);
$data['health_iss']=$this->uri->segment(5);
$this->load->view('doctor/edit_dental_history',$data);
}
function getapp_details()
{
$recnum =$this->uri->segment(3);
date_default_timezone_set('Asia/Kolkata');
$data['row'] = $this->doctor_model->getapptdata4update($recnum);
$data['recnum']=$recnum;
$this->load->view('doctor/update_dashboard',$data); 
}

function showdental_history()
{
date_default_timezone_set('America/Los_Angeles');	
$data['link2patient'] = $this->uri->segment(3);
$this->load->view('doctor/edit_dental_history',$data);
}
function add_dental_history()
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
$data['link2patient'] = $this->input->post('link2patient');
$link2patient=$this->input->post('link2patient');
$health_iss=$this->input->post('health_iss');
$data['accept']=$this->input->post('dental_history_accept');

$this->patient_model->insert_dental_history($data);

//redirect("doctor_ctrl/getpatient_info/$link2patient/$health_iss/dropdown41");
$this->getpatient_info();
}

function update_healthhistory()
{
$recnum =$this->uri->segment(3);
date_default_timezone_set('Asia/Kolkata');
$header['js_files'] = array();
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);

$this->load->view("includes/header4patients", $header);
if($this->session->userdata('profile_leftnav') == '')
{
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
}
$data['query_health']=$this->patient_model->health_infoDetails($recnum);
$data['recnum']=$recnum;
$this->load->view('doctor/update_healthhistory',$data); 
}
function update_medicalhistory()
{
date_default_timezone_set('America/Los_Angeles');
$header['js_files'] = array();
array_push($header['js_files'], 'js/ddb_appointments_view.js');
array_push($header['js_files'], 'js/ddb_patients_view.js');
array_push($header['js_files'], 'js/ddb_message4date.js');
array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
$clinic_id=$this->session->userdata('clinicid');
$header['menu']=$this->admin_model->getmenudetails($clinic_id);

$this->load->view("includes/header4patients", $header);
if($this->session->userdata('profile_leftnav') == '')
{
    $this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
    redirect('login');
}
$data['query_health']=$this->patient_model->health_infoDetails($this->uri->segment(3));
$data['recnum']=$this->uri->segment(3);
$this->load->view('doctor/edit_medical_history',$data);
}

function update_profile()
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
$emer_homenum=$this->input->post('emer_homenum1').'-'.$this->input->post('emer_homenum2').'-'.$this->input->post('emer_homenum3');
$udata['home_phone'] = $emer_homenum;
$emer_cellnum=$this->input->post('emer_cellnum1').'-'.$this->input->post('emer_cellnum2').'-'.$this->input->post('emer_cellnum3');
$udata['cell_phone'] = $emer_cellnum;
$emer_worknum=$this->input->post('emer_worknum1').'-'.$this->input->post('emer_worknum2').'-'.$this->input->post('emer_worknum3');
$udata['work_phone'] = $emer_worknum;

$udata['email'] = $this->input->post('emer_email');
$udata['relationship'] = $this->input->post('emer_relation');

//added by udaya on July 13th
$res = $this->patient_model->emer_infoRecnum($recnum) ;
$recnum_emergency1 = $res->recnum_emergency;
if($recnum_emergency1 !='' && $recnum_emergency1 !=0)
{
$this->patient_model->update_emerg($udata,$recnum);
}
else
{
$udata['link2patientinfo'] = $recnum;	
$this->patient_model->insert_emerg_to_db($udata);	
}

$udata=array();
$udata['surgery_name'] = $this->input->post('surgery_name');  
$udata['surgeon_name'] = $this->input->post('surgeon_name');

$udata['surgeon_contact_no'] = $this->input->post('surgeon_contact_no');

$udata['location_contact_no'] = $this->input->post('location_contact_no');
$udata['surgery_location'] = $this->input->post('surgery_location');
$udata['action_taken'] = $this->input->post('action_taken');



$res = $this->patient_model->surgery_infoRecnum($recnum) ;
$recnum_surgery1 = $res->recnum_surgery;
;
if($recnum_surgery1 !='' && $recnum_surgery1 !=0)
{
$this->patient_model->update_surgery_info4patient($udata,$recnum);
}
else
{
$udata['link2patient'] = $recnum; 
$this->patient_model->insert_surgery_to_db($udata); 
}


$udata=array();
$udata['surgery_notes'] = $this->input->post('surgery_notes');
if($this->input->post('surgery_notes') !='')
{
$udata['link2patient'] = $recnum; 
$this->patient_model->insert_surgerynotes($udata); 
}


$udata=array();
$udata['notes'] = $this->input->post('notes');
$udata['to_do'] = $this->input->post('to_do');

$res = $this->patient_model->postsurgery_infoRecnum($recnum) ;

$recnum_postsurgery1 = $res->recnum_postsurgery;

if($recnum_postsurgery1 !='' && $recnum_postsurgery1 != 0)
{

$this->patient_model->update_postsurgery_info4patient($udata,$recnum);
}
else
{

$udata['link2patient'] = $recnum; 
$this->patient_model->insert_postsurgery_to_db($udata); 
}


$udata=array();
$udata['postop_notes'] = $this->input->post('postop_day1');
if($this->input->post('postop_day1') != '')
{  

  $udata['link2patient'] = $recnum; 
  $this->patient_model->insert_postsurgerynotes($udata); 
}



$udata=array();
$udata['postop_comm_notes'] = $this->input->post('postop_day2');
if($this->input->post('postop_day2') != '')
{  
$udata['link2patient'] = $recnum;   
$this->patient_model->insert_postsurgery_commnotes($udata); 
}



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

if(!$this->upload->do_upload('ins2_userfile'))
{
$data = array('msg' => $this->upload->display_errors());
}
else 
{  
$data['upload_data'] = $this->upload->data();
$udata['img2_location']= base_url()."application/uploads/" .$data['upload_data']['file_name'];
}

$recnum_insur1 ='';

//added by udaya on July 13th
$res = $this->patient_model->insur_infoRecnum($recnum) ;
$recnum_insur1 = $res->recnum_insur;

if($recnum_insur1 !='' && $recnum_insur1 !=0)
{
$this->patient_model->update_insur($udata,$recnum);
}
else
{
$udata['link2patientinfo'] = $recnum;	
$this->patient_model->insert_insur_to_db($udata);	
}

//redirect("doctor_ctrl/getpatient_info/$recnum/home1");
//redirect("doctor_ctrl/getpatient_info");
$this->getpatient_info();
}

//on click on each row
function gethealth_details()
{
	$recnum = $this->uri->segment(3);
	$data['med_history_rec'] = $this->uri->segment(4);
	date_default_timezone_set('America/Los_Angeles');
	$data['query_health']=$this->patient_model->healthinfoDetails($recnum);
	$clinic_id=$this->session->userdata('clinicid');
	$patient_id =$this->session->userdata('patient_id');
	$data['master_meta'] = $this->admin_model->getmed_his4selpatient($patient_id,
	$this->uri->segment(5));
    $data['upd_num']=$this->uri->segment(5);
	$data['recnum']=$this->uri->segment(3);
	$data['health_iss'] = $this->uri->segment(6);
	$this->load->view('doctor/gethealth_details',$data);
}
function edit_health_history()
{  
$recnum = $this->uri->segment(3);
$patient_id=$this->session->userdata('patient_id');
$data['link2patient'] = $this->uri->segment(4);

$data['med_history_rec'] = $this->uri->segment(5);
date_default_timezone_set('America/Los_Angeles');
$data['query_health']=$this->patient_model->health_infoDetails($recnum);

$data['master_meta'] = $this->admin_model->getmed_his4patient($patient_id);
$data['master_meta1'] = $this->admin_model->getdefaultmaster_meta(); //added by udaya
$data['recnum']=$this->uri->segment(3);
$data['health_iss'] = $this->uri->segment(6);

$this->load->view('doctor/edit_health_history',$data);
}
function update_consent()
{
	$clinicid=$this->session->userdata('clinicid');
	date_default_timezone_set('America/Los_Angeles');
	$header['js_files'] = array();
    $header['js_files'] = array('js/ddb_patients_view.js');
	$recnum=$this->uri->segment(3);
	$data['pagename']='patient_details'; 

    array_push($header['js_files'], 'js/ddb_appointments_view.js');
	array_push($header['js_files'], 'js/ddb_message4date.js');
    array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
    array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
    array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');

	$data['link2patient']=$this->uri->segment(3);
	$data['query']=$this->patient_model->patients_infoDetails($this->uri->segment(3));
	$consent=$this->patient_model->checkdataexists4consent($this->uri->segment(3));
	if(count($consent)>0)
	{
	   $data['patient_consent']=$consent;
	   $data['signature']=$consent;
	}
	else
	{
	  $data['patient_consent']=$this->patient_model->data_from_mastermeta($clinicid);
	  $data['signature']=array();
	}
/*
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
*/
$this->load->view('doctor/edit_consent_history',$data);
}

function insert_healthhistory()
{    
date_default_timezone_set('America/Los_Angeles');
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
$udata['link2patient'] = $this->input->post('link2patient');
$udata['created_by'] = 'Doctor';
$udata['created_date'] = date('Y-m-d');
$recnum=$this->input->post('recnum');
$recnum1 = $this->input->post('link2patient');
/*
$res = $this->patient_model->health_infoRecnum($recnum1); //added by udaya
$recnum_health1 = $res->recnum_health;
if($recnum_health1 >0)
{
	$this->patient_model->update_health_info($udata,$recnum);
}
else{	
*/
$this->patient_model->insert_health_info($udata);



/*
$udata['high_bp'] = $this->input->post('high_bp') ? "yes" : "no";
$udata['low_bp'] = $this->input->post('low_bp')  ? "yes" : "no";
$udata['angina_chest_pain'] = 
 $this->input->post('angina_chest_pain') ? "yes" : "no";
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
$udata['delay_in_healing'] = $this->input->post('delay_in_healing')  ? "yes" : "no";
$udata['pancreas_diabetes'] = $this->input->post('pancreas_diabetes')  ? "yes" : "no";
$udata['kidney_dialysis'] = $this->input->post('kidney_dialysis')  ? "yes" : "no";
$udata['eyes_glaucoma'] = $this->input->post('eyes_glaucoma')  ? "yes" : "no";			  
$udata['thyroid'] = $this->input->post('thyroid')  ? "yes" : "no";
$udata['neurology_epilepsy'] = $this->input->post('neurology_epilepsy')  ? "yes" : "no";
$udata['cancer_location'] = $this->input->post('cancer_location')  ? "yes" : "no";
$udata['cancer_location_name'] = $this->input->post('cancer_location_name');
$udata['surgery'] = $this->input->post('surgery')  ? "yes" : "no";
$udata['radiation'] =  $this->input->post('radiation')  ? "yes" : "no";
$udata['chemotherapy'] =   $this->input->post('chemotherapy')  ? "yes" : "no";
$udata['jaw_joints_pain'] =  $this->input->post('jaw_joints_pain')  ? "yes" : "no";
$udata['arthritis'] =   $this->input->post('arthritis')  ? "yes" : "no";
$udata['arthritis_knee_replacement'] =  $this->input->post('arthritis_knee_replacement')  ? "yes" : "no";
$udata['arthritis_hip_replacement'] =  $this->input->post('arthritis_hip_replacement')  ? "yes" : "no";
$udata['swollen_ankles'] =  $this->input->post('swollen_ankles')  ? "yes" : "no";
$udata['link2patient'] = $this->input->post('link2patient');

$this->patient_model->insert_history_to_db($udata);
*/
$udata1=array();
$udata1['link2patient'] = $this->input->post('link2patient');

$rec =  $this->input->post('link2patient');
$upd_num=$this->input->post('upd_num');
$new_upd=$upd_num+1;
$index=$this->input->post('index');

$res = $this->patient_model->gethealthhistory($rec); //added by udaya
$numrows1 = $res->numrows;

if($numrows1 >0)
{
for($i=0;$i<$index;$i++)
{         
      $name= $this->input->post('name_'.$i)?"yes":"no";	
	  $data = array('condition_status'=>$name) ;
	  $rec1= $this->input->post('recnum'.$i);
  	  $this->patient_model->update_medhis($data, $rec1);
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
	  $udata1['link2patient'] = $this->input->post('link2patient');
	  $this->patient_model->insert_patientmeta($udata1);
}
}
	
	
$link2patient=$this->input->post('link2patient');

//redirect("doctor_ctrl/getpatient_info/$link2patient/$val/dropdown11");

$this->getpatient_info();
}

function gethealth_iss()
{
    $patient_id =$this->session->userdata('patient_id');
	$res = $this->patient_model->health_infoDetails($patient_id);
	foreach($res as $key =>$h)
	{
	   if($h == 'yes' && $key != 'under_physician_care')
	   {
		$val=$key;
		break;
	   }
	}
	$healthiss=$val;
	echo $healthiss;
}

function insert_consent()
{
    date_default_timezone_set('America/Los_Angeles');
	$data['link2patient'] = $this->input->post('link2patient');
	$data['date'] = date('Y-m-d');

	$signarr  = "";
	$typearr  = "";
	$tootharr = "";
	$shadearr = "";
	
	// $count = 0;
	// if(	$signarr = $_POST['output4treatment'])
	// {
		// $count++;
		// echo "REAcd" . $count ++;
		
	// }
	for($i=1;$i<=10;$i++)
	{
		$signarr = $_POST['output4treatment' . $i] ;
		if($signarr !='')
		{
		$typearr = $_POST['type' . $i] ;

		$data['type'] = $typearr ; 	
		$data['signature'] = $signarr ;
		
		if(isset($_POST['shade' . $i])) 
		{
		$shadearr 	= $_POST['shade' . $i] ;
		$data['shade'] = $shadearr ;
		}
		
		if(isset($_POST['tooth' . $i])) 
		{
		$tootharr 	= $_POST['tooth' . $i] ;
		$data['toothnum1'] = $tootharr ;
		}
		
		$data['patient_signature'] = $this->input->post('output4patientsign');
		$data['dentist_signature'] = $this->input->post('output4dentistsign');
		$data['link2doctor'] = $this->input->post('consent_doctor_name');
		$data['witness_signature'] = $this->input->post('output4witnesssign');
		$data['witness_name'] = $this->input->post('witness');
		$this->patient_model->insert_cansent_history($data);
		}
	}
	/*
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
*/

/*$link2patient = $this->input->post('link2patient');
$res = $this->patient_model->health_infoDetails($link2patient);

foreach($res as $key =>$h)
{
   if($h == 'yes' && $key != 'under_physician_care')
   {
$val=$key;
break;
   }
}
redirect("doctor_ctrl/getpatient_info/$link2patient/$val/dropdown3");
*/
$this->getpatient_info();
}

function checkEmail()
{
$email=$this->input->post('email');


	$count=$this->admin_model->getpassworddetails($email);
	if(count($count) >0)
	{
		echo "<span style='color:red'>This Email is already registered</span>";
	}	
}

	function getnew_patient() 
	{
		$data=array();
		$data['segment']=$this->uri->segment(4);
		date_default_timezone_set('America/Los_Angeles');
		$header['js_files'] = array(); 
		$this->load->helper(array('form'));
		$data['pagename']='registration';			
		$header['js_files'] = array('js/ddb_appointments_view.js');
		array_push($header['js_files'], 'js/ddb_message4date.js');
		$this->load->helper(array('form'));	
		

		array_push($header['js_files'], 'js/ddb_patients_view.js');
		array_push($header['js_files'], 'js/helper.js');
		array_push($header['js_files'], 'fullcalendar/lib/moment.min.js');
		array_push($header['js_files'], 'fullcalendar/fullcalendar.min.js');
		array_push($header['js_files'], 'datepicker/js/bootstrap-datepicker.js');
		//$this->load->view("includes/registrationhelper", $header);
		$clinic_id=$this->session->userdata('clinicid');
		$header['menu']=$this->admin_model->getmenudetails($clinic_id);
		$header['count_read']=$this->doctor_model->totunread_patientcount();
		$clinic=$this->admin_model->getclinic_details($clinic_id);
		$data['clinic_name']=$clinic->name.' '.$clinic->site_id;
		$doctor_id=$this->session->userdata('doctor_id');
		$doctor=$this->admin_model->emailDetails($doctor_id);
		$data['doctor_name']=$doctor->fname.' '.$doctor->lname;

		$this->load->view("includes/header4patients", $header);
		if($this->session->userdata('profile_leftnav') == '')
		{
			$this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
			redirect('login');
		}

		$data['master_meta']=$this->admin_model->getallname4group($clinic_id,'health_history');
		$data['patient_consent']=$this->admin_model->getallname4group($clinic_id,'patient_consent');
		$this->load->view('doctor/new_patient',$data);
		$this->load->view("includes/footer");
	}

	function insert_newpatient()
	{

		 date_default_timezone_set('America/Los_Angeles');

     

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

			$udata['link2clinic'] = $this->input->post('clinicid');
			$count=$this->admin_model->getpassworddetails($this->input->post('email'));
			if(count($count) >0)
			{
				// $this->session->set_flashdata('flashMessage', "Registration Failed, Duplicate Email found!!..");
				// redirect('login');
			}
			$clinicid=$this->session->userdata('clinicid');
			$udata['link2clinic'] = $this->session->userdata('clinicid');
			$udata['link2doctor'] = $this->session->userdata('doctor_id');

      $patient_id=$this->patient_model->insert_patient_to_db($udata);
			// $patient_id= 19 ;
      
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

      

			// $this->session->set_flashdata('flashMessage', "Thanks for your registration !! Please check the email for login Credentials");	  
			// $this->load->view('smtpfns');
			// $clinic_name=$this->admin_model->getclinicdetails($this->session->userdata('clinicid'));

			// $this->smtp_model->setclinicid($clinic_name->name);
			// $this->smtp_model->setsite_id($clinic_name->site_id);
			// $this->smtp_model->setemail($this->input->post('email'));
			// $this->smtp_model->setpassword($new_password);
			// $this->smtp_model->setname($name);
			// $this->smtp_model->getregisted_details();

			$recnum=$patient_id;
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

			  

             // $this->patient_model->insert_history_to_db($udata);
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

			$data=array();
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
			$data['link2patient'] = $patient_id;

			$this->patient_model->insert_dental_history($data);

      /*--------------- insert surgery -------------------- */
      $surgery = array();
      $surgery['surgery_name'] = $this->input->post('surgery_name');
      $surgery['surgery_date'] = $this->input->post('surgery_date');
      $surgery['surgeon_name'] = $this->input->post('doctor_name');
      $surgery['surgeon_contact_no'] = $this->input->post('surgeon_contact');
      $surgery['surgery_location'] = $this->input->post('surgery_location');
      $surgery['location_contact_no'] = $this->input->post('surloc_ctno');
      $surgery['action_taken'] = $this->input->post('action_taken');
      $surgery['link2patient'] = $patient_id;
      $this->patient_model->insert_patient_surgery($surgery);

      /*--------------- insert surgery notes-------------------- */
      $surgery_notes = array();
      $surgery_notes['surgery_notes'] = $this->input->post('surgery_notes');
      $surgery_notes['link2patient'] = $patient_id;
      $this->patient_model->insert_surgerynotes($surgery_notes);

      /*--------------- insert post surgery -------------------- */
      $po_surgery = array();
      $po_surgery['notes'] = $this->input->post('post_notes');
      $po_surgery['to_do'] = $this->input->post('to_do');
      $po_surgery['link2patient'] = $patient_id;
      $this->patient_model->insert_post_surgery($po_surgery);

      /*--------------- insert postop notes -------------------- */
      $po_notes = array();
      $po_notes['postop_notes'] = $this->input->post('postop_day1');
      $po_notes['link2patient'] = $patient_id;
      $this->patient_model->insert_postsurgerynotes($po_notes);

      /*--------------- insert postop comm notes -------------------- */
      $po_commnotes = array();
      $po_commnotes['postop_comm_notes'] = $this->input->post('postop_day2');
      $po_commnotes['link2patient'] = $patient_id;
      $this->patient_model->insert_postsurgery_commnotes($po_commnotes);

			redirect('doctor_ctrl/patients');
				
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
function newpage()
{
  $this->load->view("doctor/new");
}


function edit_surgery_details()
{  
$recnum = $this->uri->segment(3);

$data['query_surgery']=$this->patient_model->getpatient_surgeryDetails($recnum);
$data['query_surgerynotes']=$this->patient_model->getpatient_surgeryNotes($recnum);


$data['recnum']=$this->uri->segment(3);
$this->load->view('doctor/edit_surgery_details',$data);
}


function insert_surgerydetails()
{    

$udata=array();
$udata['surgeon_name'] = $this->input->post('surgeon_name');  
$udata['surgery_location'] = $this->input->post('surgery_location');  
$udata['surgery_name'] = $this->input->post('surgery_name');        
$udata['surgeon_contact_no'] = $this->input->post('surgeon_contact_no');
$udata['location_contact_no'] = $this->input->post('location_contact_no');
$udata['action_taken'] = $this->input->post('action_taken');
$link2patient=$this->input->post('link2patient');

$this->patient_model->update_surgerydetails($udata,$link2patient) ;
$this->load->view('doctor/edit_surgery_details',$data);
}

}
