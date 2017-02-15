<?php
//==============================================
// Author: FSI                                 =
// Date-written = Dec 16, 2014                 =
// Filename: doctor_model.php                  =
// Copyright of Fluent Technologies            =
// Database manipulation in Doctor login       =
//==============================================
/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
class doctor_model extends CI_Model 
{
function __construct() 
{
parent::__construct();
$this->patientname = '';
$this->status = '';
$this->reason = '';
$this->appt_date = '';
}
function setpatientname ($patientname) {
$this->patientname = $patientname;
}
function setstatus($status) {
$this->status = $status;
}
function setreason($reason) {
$this->reason = $reason;
}
function setappt_date($appt_date) {
$this->appt_date = $appt_date;
}
function insert_appointment($data) 
{
	$dbRet = $this->db->insert('appointments', $data);
	if (!$dbRet) 
        {
	$ret['ErrorMessage'] = $this->db->_error_message();
	$ret['ErrorNumber'] = $this->db->_error_number();
	echo 'error', "DB Error: (" . $ret['ErrorNumber'] . ") " . $ret['ErrorMessage'];
	log_message('error', "DB Error: (" . $ret['ErrorNumber'] . ") " . $ret['ErrorMessage']);
	}
}
function check4dup($link2patient)
{
$this->load->database();
$query = $this->db->query("SELECT 
concat(p.fname,' ', p.lname) as fullname,p.email,
pi.insurance_company,p.cell_phone
FROM appointments a, 
patient_info p,patient_insurance pi
where a.link2patientinfo = p.recnum and
a.link2patientinfo = '$link2patient' and
(a.status = 'Pending' or 
  a.status = 'Confirmed' ) limit 1");
return $query->first_row();
}

function check4duptime($app_date, $app_time)
{
$this->load->database();
$sql ="SELECT 
count(*) as appcount from appointments where appt_date ='$app_date'
and 
appt_time ='$app_time' and status IN('pending', 'confirmed')" ;
$query = $this->db->query($sql);
return $query->first_row();
}

function check4waitlistnumber($appt_date,$location)
{
	$this->load->database();
	/*$sql ="SELECT waitlistnumber,link2patientinfo,appt_duration, appt_time from appointments
	where appt_date	='$app_date'
	and status ='Waitlist' order by waitlistnumber DESC LIMIT 1" ; */
	
	$sql ="select a.waitlistnumber,a.link2patientinfo, a.appt_duration, a.appt_time, a.appt_date from appointments a,operatory o
		where a.link2clinic='$location' and 
		a.appt_date='$appt_date' and a.status = 'Waitlist' order by waitlistnumber DESC LIMIT 1 "; 
		
	//echo $sql ;
	$query = $this->db->query($sql);
	return $query->first_row();
	
}

function getappointmentsfordday($appt_date, $location, $operatory)
{
	$this->load->database();
	/*$sql ="SELECT appt_time, appt_duration  from appointments
	where appt_date	='$app_date'
	and status IN ('Confirmed','Pending') ORDER BY appt_time asc ";
	echo $sql ;*/
	
	$sql ="select a.appt_time,o.operatory_num,o.recnum,
		a.link2operatory,a.appt_duration
		from appointments a,operatory o
		where a.link2clinic='$location' and o.link2clinic=a.link2clinic and 
		a.appt_date='$appt_date' and o.recnum='$operatory' and
		o.recnum=a.link2operatory and a.status IN('Pending' , 'Confirmed')
		order by a.appt_time,o.operatory_num" ; 
	$query = $this->db->query($sql);
	$result = $query->result();
	return $result;
	
}

function check4waitlist($appt_date,$clinicid)
{
	$this->load->database();
	/*$sql ="SELECT appt_time, appt_duration, waitlistnumber,link2patientinfo,recnum from appointments
		where appt_date	='$app_date'
		and status ='Waitlist' ORDER BY waitlistnumber ASC" ;
		echo $sql ; */
		
	$sql ="select a.recnum, a.appt_date, a.appt_time,a.link2patientinfo, a.appt_duration, a.waitlistnumber  from appointments a
		where a.link2clinic='$clinicid' and 
		a.appt_date='$appt_date' and a.status = 'Waitlist' order by waitlistnumber ASC"; 
		
	//echo $sql ;
	
	$query = $this->db->query($sql);
	$result = $query->result();
	return $result;

}


function check4email_in_doc($recnum)
{
$this->load->database();
$query = $this->db->query("SELECT 
* from doctor where recnum=$recnum");
return $query->first_row();
}

function apt_info() {
$this->db->select('appt_time,');
$this->db->from('appointments');
$this->db->where('appt_date', $date);
$this->db->order_by('appt_time', 'asc');
$query = $this->db->get();
$result = $query->result();
return $result;

}
function currday_appointment_info() {

$docid= $this->session->userdata('doctor_id');
//changed on april 2nd 2015//
$this->load->database();
$query = $this->db->query("SELECT 
a.appt_date,
a.appt_time,
a.link2patientinfo, 
a.reason, 
a.doctor,
concat(p.fname,' ', p.lname) as fullname,
a.appt_duration,
a.status,
a.recnum
FROM appointments a, 
patient_info p
where a.link2patientinfo = p.recnum and
a.appt_time != '' and
date(a.appt_date) = date(curdate())
and a.link2doctor='$docid'");

return $query->result();
}

function apptcount($inpday) 
{   
$this->load->database();
$days = $inpday;

$clinicid = $this->session->userdata('clinicid');
$doc_id = $this->session->userdata('doctor_id');

$sql="SELECT 
a.status as status, a.doctor,
count(*) as apptcount
FROM appointments a,
clinic c
where a.appt_date = curdate() and
c.recnum = $clinicid and
c.recnum = a.link2clinic and
a.link2doctor = $doc_id
group by a.status" ;

$query = $this->db->query($sql);
return $query->result();
}
function totpendapptcount()
{   
$this->load->database();
$query = $this->db->query("SELECT  count(*) as pendapptcount
FROM appointments a
where a.status = 'Pending'");
return $query->first_row();
}
function nextday_appointment_info()
{   
$this->load->database();
$query = $this->db->query('SELECT 
a.appt_date,
a.appt_time,
a.link2patientinfo, 
a.reason, 
a.doctor,
concat(p.fname," ", p.lname) as fullname,
a.appt_duration,
a.status,
a.recnum
FROM appointments a, 
patient_info p
where a.link2patientinfo = p.recnum and
a.appt_time != "" and
date(a.appt_date) = curdate()+INTERVAL 1 DAY');
return $query->result();
}
function nextplusday_appointment_info() 
{

$this->load->database();
$query = $this->db->query('SELECT 
a.appt_date,
a.appt_time,
a.link2patientinfo, 
a.reason, 
a.doctor,
concat(p.fname," ", p.lname) as fullname,
a.appt_duration,
a.status,a.recnum
FROM appointments a, 
patient_info p
where a.link2patientinfo = p.recnum and
a.appt_time != "" and
date(a.appt_date) = curdate()+INTERVAL 2 DAY');

return $query->result();
}
function get_calendar_events() 
{
//        [
//                                {
//                                        title: 'Checkup john',
//                                        start: '2014-09-01'
//                                },
//                                {
//                                        title: 'Checkup',
//                                        start: '2014-09-07',
//                                        end: '2014-09-10'
//                                },
//                                {
//                                        id: 999,
//                                        title: 'Repeating Event',
//                                        start: '2014-09-09T16:00:00'
//                                },
//                                {
//                                        id: 999,
//                                        title: 'Repeating Event',
//                                        start: '2014-09-16T16:00:00'
//                                },
//                                {
//                                        title: 'Filling',
//                                        start: '2014-09-11',
//                                        end: '2014-09-13'
//                                },
//                                {
//                                        title: 'Preventive',
//                                        start: '2014-09-12T10:30:00',
//                                        end: '2014-09-12T12:30:00'
//                                },
//                                {
//                                        title: 'Consultation',
//                                        start: '2014-09-12T12:00:00'
//                                },
//                                {
//                                        title: 'Deep Cleaning',
//                                        start: '2014-09-12T14:30:00'
//                                },
//                                {
//                                        title: 'Checkup',
//                                        start: '2014-09-12T17:30:00'
//                                },
//                                {
//                                        title: 'Jeff Coxwell, Consultation',
//                                        start: '2014-09-12T20:00:00'
//                                },
//                                {
//                                        title: 'Diane Dexter, Root Canal',
//                                        start: '2014-09-13T07:00:00'
//                                },
//                                {
//                                        title: 'New appt',
//                                        start: '2014-10-13T07:00:00'
//                                },
//                                {
//                                        title: 'Sam Bower, Filling',
//                                        url: 'http://google.com/',
//                                        start: '2014-09-28'
//                                }
//                        ]
$l = (object) array(
'title' => 'Checkup john',
'start' => '2014-09-16T16:00:00'
);
$l1 = (object) array(
'title' => 'Diane Dexter',
'start' => '2014-12-19T07:00:00'
);
$result = array($l);
array_push($result, $l1);
return $result;
}

function get_cal() 
{
//        $this->output->enable_profiler(TRUE);
$this->db->select('reason as title,concat(appt_date,"T",appt_time)as start', false);
$this->db->from('appointments');
$query = $this->db->get();
$result = $query->result();
//print_r($result);
return $result;
}
function getcalender()
{
//added a.link2doctor = $docid on July 24th by udaya
$clinic_id=$this->session->userdata('clinicid');
$doc_id=$this->session->userdata('doctor_id');
$query=$this->db->query("SELECT a.reason as title,concat(a.appt_date,'T',a.appt_time)as start,false
	FROM appointments a,patient_info p,clinic c
	where a.link2patientinfo=p.recnum and 
	 a.link2clinic=c.recnum and  a.link2doctor =$doc_id and 	 
c.recnum=$clinic_id");
$result = $query->result();
//print_r($result);
return $result;
}

/***added on march31 2015***/
function getcalender4patient()
{
	
$clinic_id=$this->session->userdata('clinicid');
//added recnum on July 24th by udaya
//added a.link2patientinfo = patientid
$patientid=$this->session->userdata('recnum');
$sql="SELECT concat(a.appt_date,'T',a.appt_time)as start,false
	FROM appointments a,patient_info p,clinic c
	where a.link2patientinfo=p.recnum and 
	 a.link2clinic=c.recnum and 	 
c.recnum=$clinic_id
and a.link2patientinfo = $patientid " ;
$query=$this->db->query($sql);
$result = $query->result();
//print_r($result);
return $result;
}

function get_slots($date) 
{
$this->db->select('appt_time,appt_duration');
$this->db->from('appointments');
$this->db->where('appt_date', $date);
$this->db->order_by('appt_time', 'asc');
$query = $this->db->get();
$result = $query->result();
return $result;
}

function patients_t1() 
{
$query = $this->db->query('SELECT appt_date,reason,status, link2patientinfo
FROM `appointments` a1
WHERE  appt_date=(SELECT MAX(a2.appt_date)
FROM `appointments` a2
WHERE a1.link2patientinfo = a2.link2patientinfo
AND a2.status="Completed"
)');
return $query->result();
}
function patients_t() 
{
$patient=$this->session->userdata('patient');
$clinicid=$this->session->userdata('clinicid');
$patient=($patient != '')?"'".$patient."%'":" '%' ";
$patient_lastname=$this->session->userdata('patient_lastname');
$insurance =$this->session->userdata('insurance');
$cond='';
$patient_lastname=($patient_lastname != '')?"'".$patient_lastname."%'":" '%' ";

$commonsearch=$this->session->userdata('commonsearch');
$keyword="'%$commonsearch%'";

if($insurance == 'insurance' || $insurance == '' )
$cond=" and pi.name_of_insured !='' and pi.insurance_company != '' ";
else if($insurance == 'no_insurance')
	//added null by udaya on July 9th
$cond=" and (pi.name_of_insured ='' || pi.name_of_insured IS NULL) and (pi.insurance_company = '' || pi.insurance_company IS NULL) ";
else if($insurance == 'all')
$cond='';
$recnum=$this->session->userdata('recnum');
if($commonsearch=='')
{
	$recnum=$this->session->userdata('recnum');
	$sql ="select p.recnum, p.fname, p.lname, p.gender, a.status, a.reason,
	MIN( a.appt_date) AS min_date,MAX( a.appt_date ) AS max_date,
	pi.insurance_company as insurance
	from patient_info as p
	left join appointments a on a.link2patientinfo = p.recnum
	AND a.status in ('Pending', 'Confirmed')
	left join patient_insurance pi on  pi.link2patientinfo = p.recnum
	where p.fname like $patient and p.lname like $patient_lastname and
	p.link2clinic=$clinicid and p.link2doctor=$recnum  $cond
	group by p.recnum,a.status order by p.fname" ;
	$query = $this->db->query($sql);
}
else
{
	$sql ="select p.recnum, p.fname, p.lname, p.gender, a.status, a.reason,
	MIN( a.appt_date) AS min_date,MAX( a.appt_date ) AS max_date,
	pi.insurance_company as insurance
	from patient_info as p
	left join appointments a on a.link2patientinfo = p.recnum
	AND a.status in ('Pending', 'Confirmed')
	left join patient_insurance pi on  pi.link2patientinfo = p.recnum
	where p.fname like $keyword or p.lname like $keyword or pi.insurance_company like $keyword or
	a.reason like $keyword and
	p.link2clinic=$clinicid and p.link2doctor=$recnum $cond
	group by p.recnum,a.status order by p.fname" ;
	
	$query = $this->db->query($sql);
}


//$query = $this->db->get();
$result = array();
$patients_info = array();
foreach ($query->result() as $item) 
{
	if (!array_key_exists($item->recnum, $patients_info))
        {
	$patients_info[$item->recnum] = array("first_name" => $item->fname,
	"last_name" => $item->lname,"insurance" => $item->insurance,
	"gender" => $item->gender,"patient_since"=>"","last_visit"=>"",
	"reason_last_visit"=>"", "next_visit_due"=>"");
	}
	if ($item->status == 'Completed')
	{
	  $patients_info[$item->recnum]["patient_since"] = $item->min_date;
	  $patients_info[$item->recnum]["last_visit"] = $item->max_date;
	}
	elseif ($item->status == 'Pending') 
	{
	  $patients_info[$item->recnum]["next_visit_due"] = $item->min_date;
	}
}
$reason_result = $this->patients_t1();
foreach ($reason_result as $reason) 
{
$patients_info[$reason->link2patientinfo]["reason_last_visit"] = $reason->reason;
}
return $patients_info;
}

function new_patients_info()
{
$this->load->database();
$clinic_id=$this->session->userdata('clinicid');
$sql ="SELECT 
a.appt_date,
a.appt_time,
a.link2patientinfo, 
a.reason, 
a.doctor,
concat(p.fname,' ', p.lname) as fullname,
a.appt_duration as appt_duration,
a.status
from appointments a, patient_info p
where a.link2patientinfo = p.recnum and
 a.link2clinic=$clinic_id and

a.status ='Pending'
group by a.link2patientinfo 
having count(*) = 1 
order by a.appt_date, a.appt_time" ;
//echo $sql ;
$query = $this->db->query($sql);
return $query->result();
}

function patient_info4appt()
{
	$recnum=$this->session->userdata('recnum');

	$query = $this->db->query("SELECT 
	a.appt_date,
	a.appt_time,
	a.link2patientinfo, 
	a.reason, 
	a.doctor,
	p.fname,
        p.lname,
	a.appt_duration as appt_duration,
	a.status
	from appointments a, patient_info p
	where a.link2patientinfo = p.recnum  and
	p.recnum='$recnum'
	group by a.link2patientinfo 	
	order by a.appt_date, a.appt_time");

	return $query->result();
}
function fillPatientlist($link2doctor)
{
$query = $this->db->query("SELECT 
   recnum,
   concat(p.fname,' ', p.lname) as fullname
  from patient_info p 
  where link2doctor = '$link2doctor'");
$dropdowns = $query->result();

$dropDownList[''] ='Select';

if(!empty($dropdowns))
{
foreach($dropdowns as $dropdown)
{
$dropDownList[$dropdown->recnum] = $dropdown->fullname;
}
//var_dump($dropDownList);
$finalDropDown = $dropDownList;
return $finalDropDown;
}
else
{

}
}

function fillDoctorlist($recnum) {
$query = $this->db->query("SELECT 
concat(d.fname,' ', d.lname) as fullname,
d.recnum as recnum
from doctor d 
where d.recnum='$recnum'  ");
$dropdowns = $query->result();
$dropDownList[''] ='Select';
if(count($dropdowns) >0)
{
foreach($dropdowns as $dropdown)
{
$dropDownList[$dropdown->recnum] = $dropdown->fullname;
}

//var_dump($dropDownList);
$finalDropDown = $dropDownList;
return $finalDropDown;
}
else
return 0;
}

function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) 
{
if ( empty($format)) 
{
$format = 'g:i a';
}
$numItems = $upper;
$i = 0;
foreach ( range( $lower, $upper, $step ) as $increment ) 
{
$increment1 = gmdate( 'g.i', $increment );

$times[(string) $increment1] =   (string)($increment1);		
}
//print_r($times);
return $times;
}

function check4op($link2clinic) 
{
$query = $this->db->query("SELECT operatory_num,recnum FROM operatory  
where link2clinic=$link2clinic");
$dropdowns = $query->result();
return $dropdowns;
}
function getappt_details($location,$appt_date,$operatory)
{
/*	
$sql ="select a.appt_time,o.operatory_num,o.recnum,
a.link2operatory,a.appt_duration
from appointments a,operatory o
where a.link2clinic='$location' and o.link2clinic=a.link2clinic and
a.appt_date='$appt_date' and o.recnum='$operatory' and
o.recnum=a.link2operatory
order by a.appt_time,o.operatory_num" ; */

$sql ="select a.appt_time,o.operatory_num,o.recnum,
a.link2operatory,a.appt_duration
from appointments a,operatory o
where a.link2clinic='$location' and o.link2clinic=a.link2clinic and 
a.appt_date='$appt_date' and o.recnum='$operatory' and
o.recnum=a.link2operatory and a.status IN('Pending' , 'Confirmed')
order by a.appt_time,o.operatory_num" ;


//echo $sql ;
$query = $this->db->query($sql);

$dropdowns = $query->result();
return $dropdowns;
}
function fillLoclist($clinicid,$type)
{

/* modified clinic id in corresponding view page-(previously was userrecnum)*/

  $cond='where recnum='.$clinicid;
//echo "SELECT recnum,name,site_id FROM clinic $cond";
$query = $this->db->query("SELECT recnum,name,site_id FROM clinic $cond");
$dropdowns = $query->result();
$dropDownList['0'] ='Select';
foreach($dropdowns as $dropdown)
{
$dropDownList[$dropdown->recnum] = $dropdown->name.'('.$dropdown->site_id.')';
}
//var_dump($dropDownList);
$finalDropDown = $dropDownList;
return $finalDropDown;
}
function getOperatory($link2clinic)
{
$query = $this->db->query("SELECT recnum,operatory_num,opname FROM operatory  where link2clinic=$link2clinic order by recnum asc");	

$dropdowns = $query->result();
return $dropdowns;
}
function getpatientDetails()
{
	$docid=$this->session->userdata('doctor_id');

	$this->load->database();
	$patientname = "'" . $this->patientname . "%'";
	$status = "'" . $this->status ."'";
	if($this->reason == 'all' || $this->reason == '')
	$reason = " '%' ";
	else         
	$reason = "'" . $this->reason . "%'";
	$appt_date = "'" . $this->appt_date . "'";
    $clinic_id=$this->session->userdata('clinicid');

	if($this->status  == '')
	$status=" 'Pending' ";
	elseif($this->status == 'all')
	$status=" '%' ";

	if($this->appt_date  == '')
	$appt_date=" '%' ";

/*
	added in the query on July 23rd
	a.link2doctor = '$docid' 
	$sql ="SELECT p.fname,p.lname,a.reason,a.status,a.recnum as recnum,a.*,
	c.site_id as site_id,o.operatory_num
	FROM appointments a,patient_info p,clinic c,operatory o
	where a.link2patientinfo=p.recnum and p.fname like $patientname and p.link2doctor='$docid' and
	a.reason like $reason and a.status like $status and a.link2clinic=c.recnum and 
	a.link2operatory=o.recnum and  a.appt_date like $appt_date and
    a.link2clinic=$clinic_id" ; */
	
	//changed the sql query on July 20th by udaya	
	//p.link2doctor='$docid'
	$sql ="SELECT p.fname,p.lname, a.doctor, a.reason,a.status,a.recnum as recnum,a.*,
	c.site_id as site_id,o.operatory_num
	FROM appointments a,patient_info p,clinic c,operatory o, doctor d
	where a.link2patientinfo=p.recnum and p.fname like $patientname and a.reason like $reason and a.status like $status and a.link2clinic=c.recnum and 
	a.link2doctor = '$docid' and 
	a.link2operatory=o.recnum and  a.appt_date like $appt_date and d.recnum =p.link2doctor and 
    a.link2clinic=$clinic_id " ;
	//echo $sql;
	$query = $this->db->query($sql);

	$dropdowns = $query->result();
	return $dropdowns;
}
function getpatientDetails4appt()
{
	$this->load->database();
	$recnum=$this->session->userdata('recnum');
	$status = "'" . $this->status ."'";
	if($this->reason == 'all' || $this->reason == '')
	$reason = " '%' ";
	else         
	$reason = "'" . $this->reason . "%'";
	$appt_date = "'" . $this->appt_date . "'";

	if($this->status  == '')
	   $status=" 'Pending' ";
	elseif($this->status == 'all')
	   $status=" '%' ";
	if($this->appt_date  == '')
	   $appt_date=" '%' ";

	$sql ="SELECT p.fname,p.lname,a.reason,a.status,a.recnum as recnum,a.*,
	c.site_id as site_id,o.operatory_num,a.doctor
	FROM appointments a,patient_info p,clinic c,operatory o
	where a.link2patientinfo=p.recnum and p.recnum= $recnum and 
	a.reason like $reason and a.status like $status and a.link2clinic=c.recnum and 
	a.link2operatory=o.recnum and a.appt_date like $appt_date" ;
	//echo $sql ;
	$query = $this->db->query($sql);


	$dropdowns = $query->result();
	return $dropdowns;
}
function getapptdata4update($recnum)
{	
$query = $this->db->query(
"SELECT p.fname,p.lname,a.reason,a.status,a.recnum as recnum,a.*,
c.site_id as site_id,o.operatory_num
FROM appointments a,patient_info p,clinic c,operatory o
where a.link2patientinfo=p.recnum  and a.link2clinic=c.recnum and a.link2operatory=o.recnum and
 a.recnum=$recnum ");
return $query->first_row();
}
public function update_Appt($data,$id)
{
$this->db->where('appointments.recnum',$id);
return $this->db->update('appointments', $data);
}

function fillPatientlist4email()
{
$link2doctor=$this->session->userdata('doctor_id');
$clinicid=$this->session->userdata('clinicid');
$query = $this->db->query("SELECT p.recnum, 
concat(p.fname,' ', p.lname) as fullname,u.userid as email
from patient_info p, 
user u
where u.link2clinic=$clinicid and  
p.link2doctor = $link2doctor and
u.link2patient = p.recnum");
// echo "<br>Here in fillpatientlist";
$dropdowns = $query->result();
$dropDownList['select']="Select";
foreach($dropdowns as $dropdown)
{
$dropDownList[$dropdown->email] = $dropdown->fullname;
}
//var_dump($dropDownList);
$finalDropDown = $dropDownList;
return $finalDropDown;
}
function getdocname($link2doctor)
{
$query = $this->db->query("SELECT recnum, concat(d.fname,' ', d.lname) as fullname,
addr1,addr2,city,state,zip,status,email,phone
from doctor d where recnum='$link2doctor' ");

// echo "<br>Here in fillpatientlist";
return $query->first_row();
}
function insert_msg($data) 
{
//print_r($data);
$dbRet = $this->db->insert('email', $data);
if (!$dbRet) {
$ret['ErrorMessage'] = $this->db->_error_message();
$ret['ErrorNumber'] = $this->db->_error_number();
echo 'error', "DB Error: (" . $ret['ErrorNumber'] . ") " . $ret['ErrorMessage'];
log_message('error', "DB Error: (" . $ret['ErrorNumber'] . ") " . $ret['ErrorMessage']);
}
}

function totunreadcount()
{
$email=$this->session->userdata('userid');
$query=$this->db->query("SELECT count(read_flag) as count
from email 
where to_emailid='$email' and read_flag=0 and sent_recd='inbox'");
return $query->first_row();
}

function totunread_patientcount()
{
$clinicid=$this->session->userdata('clinicid');
$recnum=$this->session->userdata('recnum');
$query=$this->db->query("select p.recnum, p.fname, p.lname, p.gender, a.status, a.reason,
	MIN( a.appt_date) AS min_date,MAX( a.appt_date ) AS max_date,
	pi.insurance_company as insurance
	from patient_info as p
	left join appointments a on a.link2patientinfo = p.recnum
	AND a.status in ('Pending', 'Confirmed')
	left join patient_insurance pi on  pi.link2patientinfo = p.recnum
	where p.link2clinic=$clinicid and p.link2doctor=$recnum
	group by p.recnum");
 return $query->num_rows();
}

function totprioritycount()
{
$email=$this->session->userdata('userid');
$query=$this->db->query("SELECT count(read_flag) as count
from email 
where to_emailid='$email' and priority_flag=1 and sent_recd='inbox'");
return $query->first_row();
}

function getallMsg4sent($type,$user_email,$limit, $start)
{
if($type == 'sent')
{ 
$sender_sent=$this->session->userdata('sender_sent');
$sender_sent=($sender_sent != '')?"'".$sender_sent."%'":" '%' ";
$date_sent=$this->session->userdata('date_sent');
$date_sent=($date_sent != '')?"'".$date_sent."%'":" '%' ";

$fromdate_sent=$this->session->userdata('fromdate_sent');
$todate_sent=$this->session->userdata('todate_sent');

if ( isset ( $fromdate_sent ) || isset ( $todate_sent ) )
{

if ( isset ( $fromdate_sent) &&  $fromdate_sent != '' )
{
$date1 = $fromdate_sent;
$cond11 = "to_days(date) " . "> to_days('" . $date1 . "')";
}
else
{
$cond11 = "(to_days(date)-to_days('1582-01-01') > 0 || date = 'NULL' || date = '0000-00-00')";
}

if ( isset ( $todate_sent )  &&  $todate_sent != '')
{
$date2 = $todate_sent;
$cond12 = "to_days(date) " . "< to_days('" . $date2 . "')";
}
else
{
$cond12 = "(to_days(date)-to_days('2050-12-31') < 0 || date = 'NULL' || date = '0000-00-00')";
}
$cond = $cond11 . ' and ' . $cond12;
}
else
{
$cond =  "(to_days(date)-to_days('1582-01-01') > 0 ||
date = '0000-00-00' ||
date = 'NULL' ) and
(to_days(date)-to_days('2050-12-31') < 0 ||
date = '0000-00-00' ||
date = 'NULL')";
}
$query = $this->db->query("select * from email where from_emailid='$user_email' and sent_recd='sent' and 
to_name like $sender_sent and  $cond 
order by recnum desc limit $start,$limit");

}
else
{
$sender=$this->session->userdata('sender');
$sender=($sender != '')?"'".$sender."%'":" '%' ";
$from_date=$this->session->userdata('from_date');
$to_date=$this->session->userdata('to_date');
if ( isset ( $from_date ) || isset ( $to_date ) )
{     
if ( isset ( $from_date) &&  $from_date != '' )
{
$date1 = $from_date;
$cond11 = "to_days(date) " . "> to_days('" . $date1 . "')";
}
else
{
$cond11 = "(to_days(date)-to_days('1582-01-01') > 0 || date = 'NULL' || date = '0000-00-00')";
}
if ( isset ( $to_date )  &&  $to_date != '')
{
$date2 = $to_date;
$cond12 = "to_days(date) " . "< to_days('" . $date2 . "')";
}
else
{
$cond12 = "(to_days(date)-to_days('2050-12-31') < 0 || date = 'NULL' || date = '0000-00-00')";
}
$cond = $cond11 . ' and ' . $cond12;
}
else
{
$cond =  "(to_days(date)-to_days('1582-01-01') > 0 ||
date = '0000-00-00' ||
date = 'NULL' ) and
(to_days(date)-to_days('2050-12-31') < 0 ||
date = '0000-00-00' ||
date = 'NULL')";
}
$query = $this->db->query("select * from email where to_emailid='$user_email' and sent_recd='inbox' and from_name like $sender and $cond order by recnum desc limit $start,$limit ");
}	
return $query->result();
}   
public function record_count4sent()
{
$sender=$this->session->userdata('sender');
$sender=($sender != '')?"'".$sender."%'":" '%' ";
$fromdate_sent=$this->session->userdata('fromdate_sent');
$todate_sent=$this->session->userdata('todate_sent');
$user_email=$this->session->userdata('userid');	
if ( isset ( $fromdate_sent ) || isset ( $todate_sent ) )
{	     
if ( isset ( $fromdate_sent) &&  $fromdate_sent != '' )
{
$date1 = $fromdate_sent;
$cond11 = "to_days(date) " . "> to_days('" . $date1 . "')";
}
else
{
$cond11 = "(to_days(date)-to_days('1582-01-01') > 0 || date = 'NULL' || date = '0000-00-00')";
}
if ( isset ( $todate_sent )  &&  $todate_sent != '')
{
$date2 = $todate_sent;
$cond12 = "to_days(date) " . "< to_days('" . $date2 . "')";
}
else
{
$cond12 = "(to_days(date)-to_days('2050-12-31') < 0 || date = 'NULL' || date = '0000-00-00')";
}
$cond = $cond11 . ' and ' . $cond12;
}
else
{
$cond =  "(to_days(date)-to_days('1582-01-01') > 0 ||
date = '0000-00-00' ||
date = 'NULL' ) and
(to_days(date)-to_days('2050-12-31') < 0 ||
date = '0000-00-00' ||
date = 'NULL')";
}
$query = $this->db->query("select count(*) as numrows from email where to_name  like $sender and
sent_recd='sent' and $cond and from_emailid='$user_email' ");
return $query->first_row();
}
public function record_count4inbox()
{
$sender=$this->session->userdata('sender');
$sender=($sender != '')?"'".$sender."%'":" '%' ";
$from_date=$this->session->userdata('from_date');
$to_date=$this->session->userdata('to_date');
$user_email=$this->session->userdata('userid');	
if ( isset ( $from_date ) || isset ( $to_date ) )
{

if ( isset ( $from_date) &&  $from_date != '' )
{
$date1 = $from_date;
$cond11 = "to_days(date) " . "> to_days('" . $date1 . "')";
}
else
{
$cond11 = "(to_days(date)-to_days('1582-01-01') > 0 || date = 'NULL' || date = '0000-00-00')";
}

if ( isset ( $to_date )  &&  $to_date != '')
{
$date2 = $to_date;
$cond12 = "to_days(date) " . "< to_days('" . $date2 . "')";
}
else
{
$cond12 = "(to_days(date)-to_days('2050-12-31') < 0 || date = 'NULL' || date = '0000-00-00')";
}
$cond = $cond11 . ' and ' . $cond12;
}
else
{
$cond =  "(to_days(date)-to_days('1582-01-01') > 0 ||
date = '0000-00-00' ||
date = 'NULL' ) and
(to_days(date)-to_days('2050-12-31') < 0 ||
date = '0000-00-00' ||
date = 'NULL')";
}

$query = $this->db->query("select count(*) as numrows from email where from_name like $sender and
sent_recd='inbox' and $cond and to_emailid='$user_email'");
return $query->first_row();
}
function delete_msg($recnum)
{
$query = $this->db->query("delete from email where recnum='$recnum' and sent_recd='sent'");
}
function delete_msg4inb($recnum)
{
$query = $this->db->query("delete from email where recnum='$recnum' and sent_recd='inbox'");
}
function getemail_details($recnum)
{
$query = $this->db->query("select * from email where recnum='$recnum'");
return $query->first_row();   
}
function update_Msg($data,$recnum)
{
$this->db->where('recnum',$recnum);
return $this->db->update('email', $data);
}
function getdental_historydetails($recnum)
{
$query = $this->db->query("select dh.*  from dental_history dh where link2patient='$recnum' order by recnum DESC limit 1");
return $query->first_row();
return $dropdowns;  
}
function getdental_history($recnum)
{
$query = $this->db->query("select dh.*  from dental_history dh  where dh.recnum='$recnum' ");
$dropdowns = $query->first_row();
return $dropdowns;  
}
function update_dental_history($data,$recnum)
{
$this->db->where('recnum',$recnum);
return $this->db->update('dental_history', $data);
}
function getdental_historydetails4patient($recnum)
{
$query = $this->db->query("select dh.*  from dental_history dh where link2patient='$recnum' order by recnum DESC ");
$result = $query->result();
return $result;
}
function getconsentdetails($recnum)
{
	$sql ="select c.*,
	concat(p.fname,' ', p.lname) as patient_fullname,
	concat(d.fname,' ' , d.lname) as doctor_fullname 
	from patient_info p,consent c,doctor d
	where c.link2patient=$recnum and p.recnum=c.link2patient 
	and d.recnum = c.link2doctor" 	;
	//echo $sql ;
	$query = $this->db->query($sql);

	$result = $query->result();
	return $result;		
}
function getconsentdetails4patient($recnum)
{
$query = $this->db->query("select c.recnum,
signature,
type,
link2patient,
date,
toothnum1
toothnum2,
shade,
c.link2doctor,
witness_name,
patient_signature,
dentist_signature,
witness_signature,
concat(p.fname,' ', p.lname) as patient_fullname,
concat(d.fname,' ', d.lname) as doc_fullname
from patient_info p,consent c
left join doctor d on d.recnum=c.link2doctor 
where link2patient=$recnum and p.recnum=c.link2patient 
order by recnum DESC limit 1");
$result = $query->first_row();
return $result;	
}
function appointment_info($date) 
{
$query = $this->db->query("SELECT 
a.appt_date,
a.appt_time,
a.link2patientinfo, 
a.reason, 
a.doctor,
concat(p.fname,' ', p.lname) as fullname,
a.appt_duration,
a.status,a.recnum
FROM appointments a, 
patient_info p
where a.link2patientinfo = p.recnum and
a.appt_time != '' and
date(a.appt_date) = '$date' ");

return $query->result();
}
function getappointment_info($date) 
{
//changed on 2nd april 2015// 
//changed to a.link2doctor from p.link2doctor on July24th //by udaya
$docid=$docid= $this->session->userdata('doctor_id');
$sql ="SELECT 
a.appt_date,
a.appt_time,
a.link2patientinfo, 
a.reason, 
a.doctor,
concat(p.fname,' ', p.lname) as fullname,
a.appt_duration,
a.status,a.recnum
FROM appointments a, 
patient_info p,clinic c
where a.link2patientinfo = p.recnum and
a.appt_time != '' and 
a.link2clinic=c.recnum and
a.link2doctor='$docid' and

date(a.appt_date) = '$date' " ;
$query = $this->db->query($sql);
//echo $sql ;

return $query->result();
}
function getpatient_name($recnum)
{
$query = $this->db->query("SELECT 
   recnum,
   concat(p.fname,' ', p.lname) as fullname
  from patient_info p 
  where recnum='$recnum' ");
return $query->first_row();
}
function insurance_count()
{
$clinicid=$this->session->userdata('clinicid');
$doc_id =$this->session->userdata('doctor_id');
//made changes on July 23rd added doctor_id
$sql ="select p.fname
from patient_info p,patient_insurance pi
where p.link2clinic=$clinicid   and 
pi.name_of_insured !='' and 
pi.insurance_company != ''  and
p.link2doctor =$doc_id and 
pi.link2patientinfo = p.recnum" ;
$query = $this->db->query($sql);

 return $query->num_rows();
}
function noinsurance_count()
{
$clinicid=$this->session->userdata('clinicid');
$doc_id=$this->session->userdata('doctor_id');
/*$query = $this->db->query("select p.fname
from patient_info p,patient_insurance pi 
where p.link2clinic=$clinicid  and 
pi.name_of_insured ='' and 
pi.insurance_company ='' and
pi.link2doctor = $doc_id and
pi.link2patientinfo = p.recnum"); */
//added by udaya on July 23rd 
$query =$this->db->query("select count(*) as numrows from patient_info  where  link2clinic= $clinicid and link2doctor  = $doc_id
and recnum NOT IN (select p.recnum
from patient_info p,patient_insurance pi
where p.link2clinic=$clinicid  and 
pi.name_of_insured !='' and
pi.insurance_company !='' and
p.link2doctor =$doc_id and
pi.link2patientinfo = p.recnum)
");

 return $query->row();
}
function getPatientPhone($recnum)
{
	
	$query=$this->db->query("select cell_phone from patient_info where recnum=$recnum");
	return $query->row();
}

//udayanew and a.link2doctor =$doc_id removed
//and a.status ='Pending'
function new_patients_appointment_info($doc_id)
{
$this->load->database();
$clinic_id=$this->session->userdata('clinicid');
$sql ="SELECT 
a.appt_date,
a.appt_time,
a.link2patientinfo, 
a.reason, 
a.doctor,
concat(p.fname,' ', p.lname) as fullname,
a.appt_duration as appt_duration,
a.status
from appointments a, patient_info p
where a.link2patientinfo = p.recnum and
 a.link2clinic=$clinic_id  and
 a.link2doctor =$doc_id
group by a.link2patientinfo 
having count(*) = 1 
order by a.appt_date, a.appt_time" ;
//echo $sql ;
$query = $this->db->query($sql);
return $query->result();
}


}
