<?php
//==============================================
// Author: FSI                                 =
// Date-written = Dec 15, 2014                 =
// Filename: patient_model.php                   =
// Copyright of Fluent Technologies            =
// Database manipulation in Patient login for patient related data       =
//==============================================
/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
class patient_model extends CI_Model
{
function __construct()
{
parent::__construct();
$this->load->database("paperless");
}
function patients_info($patientlink) 
{
	$sql ="SELECT 
concat(p.fname,' ', p.lname) as fullname,
p.addr1,
p.addr2,
p.city, 
p.state, 
p.zip,
i.insurance_company as insurance,
i.group_id as groupid,
i.member_id as memberid,
concat(d.fname,' ', d.lname) as  docname,
d.phone as docphone,
d.addr1 as docaddr,
d.email as docemail,

c.name as clinicname,
c.phone as clinicphone,
e.fname as emergencyfname,
e.middle_initial as emergencymname,
e.lname as emergencylname,
e.cell_phone as emergencycell,
e.addr1 as emergencyaddress,
e.city as emergencycity,
e.state as emergencystate,
p.referred_by,p.img_location,p.link2doctor,p.email                                
from 
doctor d,
clinic c,
user u,
patient_emergency_info e,
patient_info p
left join patient_insurance i on p.recnum = i.link2patientinfo 
where						         
p.recnum = $patientlink and
c.recnum = p.link2clinic and
p.recnum = e.link2patientinfo
and d.recnum = p.link2doctor
";
$query = $this->db->query($sql);
//******* and d.recnum = p.link2doctor ****is added on march 18 2015*/
return $query->first_row();					
}
function checkpatient_exist($userid)
{
$query = $this->db->query("select  u.link2patient,u.link2doctor,u.link2clinic,c.name,u.type 
from patient_info p,user u,clinic c
where  u.userid='$userid'
and c.recnum=u.link2clinic");
return $query->first_row();		 
}
function insert_patient_to_db($data)
{
$this->db->insert('patient_info', $data);
return $this->db->insert_id();
}
function insert_dental_history($data)
{
$this->db->insert('dental_history', $data);
return $this->db->insert_id();
}
function insert_newuser($data)
{
$this->db->insert('user', $data);
return $this->db->insert_id();
}
function insert_health_info($data)
{
$this->db->insert('patient_health_info', $data);
}
function insert_patientmeta($data)
{
$this->db->insert('patient_medical_his', $data);
}
function patients_infoDetails($patientlink) 
{
$sql ="SELECT  concat(p.fname,' ', p.lname) as fullname,p.fname ,
p.middle_initial,
p.lname,
p.addr1,
p.addr2,
p.city,
p.state,
p.zip,
p.dob,
p.gender,
p.home_phone,
p.cell_phone,
p.work_phone,
p.email,
p.preferred_contact_mode,
p.recnum,
p.img_location,
p.link2doctor,
p.referred_by,
p.recnum,
p.link2clinic
from patient_info p
where p.recnum = $patientlink" ;
//echo $sql;
$query = $this->db->query($sql); 

return $query->first_row();					
}

//added by udaya on July 14th for details when patient logs in
function patients_infoDetails1($patientlink) 
{
	$sql ="SELECT  concat(p.fname,' ', p.lname) as fullname,p.fname ,
p.middle_initial,
p.lname,
p.addr1,
p.addr2,
p.city,
p.state,
p.zip,
p.dob,
p.gender,
p.home_phone,
p.cell_phone,
p.work_phone,
p.email,
p.preferred_contact_mode,
p.recnum,
p.img_location,
p.link2doctor,
p.referred_by,
p.recnum,
p.link2clinic,
concat(d.fname,' ', d.lname) as  docname,
d.phone as docphone,
d.addr1 as docaddr,
d.email as docemail,
c.name as clinicname,
c.phone as clinicphone
from clinic c ,
patient_info p
left join doctor d
on d.recnum = p.link2doctor 
where c.recnum = p.link2clinic and
p.recnum = $patientlink" ;
$query = $this->db->query($sql); 

return $query->first_row();					
}

function checkdataexists4consent($recnum)
{
$query = $this->db->query("select *
 from patient_consent 
 where link2patient=$recnum");
 return $query->result();
}
//removed this link2clinic=$clinicid 
function data_from_mastermeta($clinicid)
{
$query = $this->db->query("select *
 from master_meta 
 where type='patient_consent'");
 return $query->result();
}
function emer_infoDetails($recnum)
{
$query = $this->db->query("select 
fname,
middle_initial,
lname,
addr1,
addr2,
city,
state,
zip,
dob,
gender,
home_phone,
cell_phone,
work_phone,
email,
preferred_contact_mode,
link2patientinfo,
relationship
from patient_emergency_info 
where link2patientinfo=$recnum");
return $query->first_row();		
}
function insur_infoDetails($recnum)
{
$query = $this->db->query("select 
name_of_insured,
link2patientinfo,
insurance_company,
group_id,
member_id,
img1_location,
img2_location,
recnum
from patient_insurance  
where link2patientinfo=$recnum");
return $query->first_row();		
}
function cansent_Details($recnum,$type)
{
$query = $this->db->query("select 	*
from consent  
where link2patient=$recnum and type='$type' ");
return $query->first_row();	
}
public function update_health_info($data,$id)
{
$this->db->where('patient_health_info.recnum',$id);
return $this->db->update('patient_health_info', $data);
}
public function update_health_info4patient($data,$id)
{
$this->db->where('patient_health_info.link2patient',$id);
return $this->db->update('patient_health_info', $data);
}
public function update_personal($data,$id)
{
$this->db->where('patient_info.recnum',$id);
return $this->db->update('patient_info', $data);
}
public function update_emerg($data,$id)
{
$this->db->where('patient_emergency_info.link2patientinfo',$id);
return $this->db->update('patient_emergency_info', $data);
}
public function update_insur($data,$id)
{
$this->db->where('patient_insurance.link2patientinfo',$id);
return $this->db->update('patient_insurance', $data);
}
//added by udaya
public function update_medhis($data,$id)
{
$this->db->where('recnum',$id);
return $this->db->update('patient_medical_his', $data); //changed by udaya on July 10th

}
public function update_family($data,$id)
{
$this->db->where('family_info.recnum',$id);
return $this->db->update('family_info', $data);
}
function health_infoDetails($recnum)
{ 
	$query = $this->db->query("select 
	height_feet ,
	height_inches,
	weight_lbs,
	are_you_in_good_health,
	under_physician_care,
	physician_phone,
	illness_operation_hospitalized,
	alcoholic_consumption,
	recreation_drug_usage,
	alcohol_abuse,
	smoke,recnum,accept,tobacco,
	other,signature,accept,
        surgery_done
	from patient_health_info
	where link2patient =$recnum 
	order by recnum DESC limit 1");

	return $query->first_row();	
}

function family_infoDetails($recnum)
{
$patient_name=$this->session->userdata('patient_name');
$patient_name=($patient_name != '')?"'".$patient_name."%'":" '%' ";
$patient_lname=$this->session->userdata('patient_lname');
$patient_lname=($patient_name != '')?"'".$patient_lname."%'":" '%' ";

$sql ="select 
f.recnum as recnum,
f.fname,
f.lname,
f.middle_name,
f.home_phone,
f.cell_phone,
f.work_phone,
f.email,
f.relationship,
concat(p.fname,' ', p.lname) as fullname,
p.recnum as patient_recnum,
f.patient_id                         
from family_info f,patient_info p
where p.recnum=f.link2patientinfo and p.recnum=$recnum 
and f.fname like $patient_name and
f.lname like $patient_lname" ;
//echo $sql ;
$query = $this->db->query($sql);

return $query->result();
}
function family_details($recnum)
{
$query = $this->db->query("select 
f.recnum as recnum,
f.fname,
f.lname,
f.middle_name,
f.home_phone,
f.cell_phone,
f.work_phone,
f.email,
f.relationship
from family_info f
where f.recnum=$recnum ");

return $query->first_row();
}
//to get the operatory number which is not booked.
function getleastop($appt_date,$appt_time,$location)
{
$sql ="select o.recnum,o.operatory_num
from operatory o
left join appointments a on a.link2operatory = o.recnum and
a.appt_date='$appt_date' and a.appt_time='$appt_time'
where o.link2clinic='$location' and
a.link2operatory is null
order by a.appt_time,o.operatory_num ASC limit 1" ;
$query = $this->db->query($sql);
//echo $sql ;
$dropdowns = $query->first_row();

return $dropdowns;
}


//to get the operatory number which is booked for //waitlist
function getleastopwait($appt_date,$appt_time,$location)
{
$sql ="select o.recnum,o.operatory_num
from operatory o
left join appointments a on a.link2operatory = o.recnum and
a.appt_date='$appt_date' and a.appt_time='$appt_time'
where o.link2clinic='$location'
order by a.appt_time,o.operatory_num ASC limit 1" ;
$query = $this->db->query($sql);
//echo $sql ;
$dropdowns = $query->first_row();

return $dropdowns;
}

function insert_emerg_to_db($data)
{
	
$this->db->insert('patient_emergency_info', $data);
return $this->db->insert_id();
}

function insert_insur_to_db($data)
{
$this->db->insert('patient_insurance', $data);
return $this->db->insert_id();
}
function insert_family_to_db($data)
{
$this->db->insert('family_info', $data);

return $this->db->insert_id();
}
function insert_cansent_history($data)
{
	
$this->db->insert('consent', $data);
return $this->db->insert_id();
}
function getdocid($location)
{
$query = $this->db->query("select link2doctor from user
where link2clinic='$location' and type='doctor'");
$dropdowns = $query->result();
$dropDownList['0']='Select';
foreach($dropdowns as $dropdown)
{
$sql = $this->db->query("SELECT 
concat(d.fname,' ', d.lname) as fullname,
recnum
from doctor d 
where d.recnum='$dropdown->link2doctor'  ");
$query1 = $sql->first_row();
$dropDownList[$query1->recnum] = $query1->fullname;
}
$finalDropDown = $dropDownList;
return $finalDropDown;
}
function patients_visit_his($recnum)
{
$query = $this->db->query("SELECT * FROM appointments where link2patientinfo=$recnum 
order by recnum DESC  limit 2");
$result = $query->result();
return $result;
}
function getdocdetails4patient()
{
$patientlink=$this->session->userdata('recnum');
$clinicid=$this->session->userdata('clinicid');

$query = $this->db->query("select concat(d.fname,' ', d.lname) as  docname,
u.userid as email 
 from doctor d,user u where u.link2clinic=$clinicid and 
d.recnum=u.link2doctor and u.status='Active'");

$dropdowns = $query->result();
$dropDownList['select']='Select';
foreach($dropdowns as $dropdown)
{         
$dropDownList[$dropdown->email] = $dropdown->docname;
}
$finalDropDown = $dropDownList;
return $finalDropDown;
}
public function record_count4sent()
{
$sender=$this->session->userdata('sender');
$user_email=$this->session->userdata('userid');
$sender=($sender != '')?"'".$sender."%'":" '%' ";
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
$query = $this->db->query("select count(*) as numrows from email where to_name  like $sender and
sent_recd='sent' and $cond and from_emailid='$user_email' ");
return $query->first_row();
}
public function record_count4inbox()
{
$sender=$this->session->userdata('sender');
$sender=($sender != '')?"'".$sender."%'":" '%' ";
$user_email=$this->session->userdata('userid');		
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

$query = $this->db->query("select count(*) as numrows from email where from_name like $sender and
sent_recd='inbox' and $cond and to_emailid='$user_email' ");
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

if(isset ( $fromdate_sent ) || isset ( $todate_sent ) )
{
if(isset ( $fromdate_sent) &&  $fromdate_sent != '' )
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
$query = $this->db->query("select * from email where from_emailid='$user_email' and sent_recd='sent' and to_name like $sender_sent and  
$cond order by recnum desc limit $start,$limit");
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

$query = $this->db->query("select * from email where to_emailid='$user_email' and sent_recd='inbox' and from_name like $sender and $cond
order by recnum desc limit $start,$limit ");

}	
return $query->result();
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
function updateread_flag($recnum)
{
$query = $this->db->query("update email set read_flag=1 where recnum='$recnum'");
}
function getpatientdetails()
{
$doclink=$this->session->userdata('recnum');
$clinicid=$this->session->userdata('clinicid');

$query = $this->db->query("select concat(p.fname,' ', p.lname) as fullname,
p.link2doctor,u.userid as email   
from patient_info p
left join user u on u.link2patient=p.recnum
where p.link2clinic=$clinicid  and 
u.status='Active'");


$dropdowns = $query->result();
$dropDownList['select']='Select';
foreach($dropdowns as $dropdown)
{         
$dropDownList[$dropdown->email] = $dropdown->fullname;
}
$finalDropDown = $dropDownList;
return $finalDropDown;
}
function getalldoctors4clinic()
{
	$clinicid=$this->session->userdata('clinicid');

	$query = $this->db->query("(select d.recnum,d.fname,concat(d.fname,' ', d.lname) as fullname,d.addr1, d.addr2,d.city,d.state,d.zip,d.status,d.email,d.phone, d.created_by,  d.modified_by, d.created_date,d.modified_date,c.name, c.site_id
	from doctor d,user u, clinic c
	where d.recnum = u.link2doctor and u.link2clinic = c.recnum and
	c.recnum=$clinicid  and
	d.status like 'Active')
	UNION
	(select  d.recnum,d.fname,concat(d.fname,' ', d.lname) as fullname,d.addr1, d.addr2,d.city,  d.state,d.zip,d.status,d.email,
	d.phone,d.created_by,d.modified_by, d.created_date,d.modified_date, 
	'', ''
	from doctor d
	left join user u on d.recnum = u.link2doctor
	where  u.link2doctor is null and
	d.status like 'Active')
	order by  fname");

	$dropdowns = $query->result();
	$dropDownList['select']='Select';
	foreach($dropdowns as $dropdown)
	{         
	$dropDownList[$dropdown->recnum] = $dropdown->fullname;
	}
	$finalDropDown = $dropDownList;
	return $finalDropDown;
}
function health_infoDetails4check($recnum)
{ 
	$query = $this->db->query("select *
	from patient_medical_his 
	where link2patient =$recnum and 
    upd_num = (select max(m1.upd_num)
	from patient_medical_his m1 
	where m1.link2patient = $recnum limit 1)
	order by disp_seq ASC");
	$result = $query->result();
	return $result;
}
function health_infoDetails4patient($recnum)
{ 
$sql ="select 
h.height_feet,
h.height_inches,
h.weight_lbs,
h.are_you_in_good_health,
h.under_physician_care,
h.physician_phone,
h.illness_operation_hospitalized,
h.alcoholic_consumption,
h.recreation_drug_usage,
h.alcohol_abuse,
h.smoke,h.recnum as health_rec,h.accept,h.tobacco,
h.other,h.signature,h.surgery_done,m.*
from patient_health_info h
left join patient_medical_his m on m.link2patient=h.link2patient
where m.link2patient =$recnum 
order by m.upd_num DESC" ;
$query = $this->db->query($sql);

$result = $query->result();
return $result;
}

//added function by udaya to get patient history details to know when patient 
//medical details present in table or not.
function gethealthhistory($recnum)
{ 
$sql ="select 
count(*) as numrows
from patient_medical_his p
where p.link2patient =$recnum" ;
$query = $this->db->query($sql);
return $query->first_row();
}



function healthinfoDetails($recnum)
{ 
$sql ="select 
h.*
from patient_health_info h
where h.recnum =$recnum" ;
$query = $this->db->query($sql);


return $query->first_row();	
}
function getDoctorRecnum($recnum)
{
	$query=$this->db->query("select link2doctor from patient_info where recnum=$recnum");
	return $query->row();
}

function getDoctorEmail($recnum)
{

	$query=$this->db->query("select email from doctor where recnum=$recnum");
	return $query->row();
	
}
/*function getPatientRecnum($recnum)
{
echo "select link2patient from user where recnum=$recnum";
	$query=$this->db->query("select link2patient from user where recnum=$recnum");
	return $query->row();
	
}*/
function getFamilyRecnum($recnum)
{
	$query=$this->db->query("select recnum from family_info where link2patientinfo=$recnum");
	return $query->row();
	
}

//added by udaya on July 13th
function emer_infoRecnum($recnum)
{
	$query=$this->db->query("select count(*) as recnum_emergency from patient_emergency_info where link2patientinfo=$recnum");
	return $query->first_row();
	
}
//added by udaya on July 13th
function insur_infoRecnum($recnum)
{
	$query=$this->db->query("select count(*) as recnum_insur from patient_insurance where link2patientinfo=$recnum");
	return $query->first_row();
}

function health_infoRecnum($recnum)
{ 
	$query=$this->db->query("select count(*) as recnum_health from patient_health_info where link2patient=$recnum");
	return $query->first_row();
}


function getpatient_surgeryDetails($recnum)
{
	$query = $this->db->query("select 
	surgeon_name,
	surgeon_contact_no,
	location_contact_no,
	surgery_name,
	action_taken,
	surgery_date,
	surgery_location
	from patient_surgery
	where link2patient =$recnum 
	order by recnum DESC limit 1");

	return $query->first_row();	

}

   function getpatient_surgeryNotes($patientid)
  {
       $query = $this->db->query("select sn.surgery_notes, DATE_ADD(sn.create_date, INTERVAL '13:00' HOUR_MINUTE) as time
                  
                from surgery_notes sn
                where
                sn.link2patient=$patientid
                order by sn.create_date desc");
	return $query->result_array();	
  }


   function postsurgeryNotes($patientid)
  {
       $query = $this->db->query("select pp.notes, pp.to_do,
       					 pp.postop_day1,
       					pp.postop_day2 
		                from patient_postop pp where 
		                pp.link2patient=$patientid");
       
	return $query->first_row();	
  }

//added by udaya on Feb 14th
	function surgery_infoRecnum($recnum)
	{
		$query=$this->db->query("select count(*) as recnum_surgery from patient_surgery where link2patient=$recnum");
		return $query->first_row();
		
	}

	public function update_surgery_info4patient($data,$id)
	{
	$this->db->where('patient_surgery.link2patient',$id);
	return $this->db->update('patient_surgery', $data);
	}

	function insert_surgery_to_db($data)
	{
	$this->db->insert('patient_surgery', $data);
	return $this->db->insert_id();
	}



	function insert_surgerynotes($data)
	{
	$this->db->insert('surgery_notes', $data);
	return $this->db->insert_id();
	}


	//added by udaya on Feb 14th
	function postsurgery_infoRecnum($recnum)
	{
		$query=$this->db->query("select count(*) as recnum_postsurgery from patient_postop where link2patient=$recnum");
		return $query->first_row();
		
	}

	public function update_postsurgery_info4patient($data,$id)
	{
	$this->db->where('patient_postop.link2patient',$id);
	return $this->db->update('patient_postop', $data);
	}

	function insert_postsurgery_to_db($data)
	{

	$this->db->insert('patient_postop', $data);
	return $this->db->insert_id();
	}

	function insert_postsurgerynotes($data)
	{

	$this->db->insert('patient_postop_notes', $data);
	return $this->db->insert_id();
	}

	function insert_postsurgery_commnotes($data)
	{
	$this->db->insert('patient_postop_comm_notes', $data);
	return $this->db->insert_id();
	}



   function getpatient_postopNotes($patientid)
  {
       $query = $this->db->query("select p.postop_notes, DATE_ADD(				 p.create_date, INTERVAL '13:00' HOUR_MINUTE) as time
                from patient_postop_notes p
                where
                p.link2patient=$patientid
                order by p.create_date desc");
	return $query->result_array();	
  }



   function getpatient_postop_commNotes($patientid)
  {
       $query = $this->db->query("select p.postop_comm_notes, DATE_ADD(				 p.create_date, INTERVAL '13:00' HOUR_MINUTE) as time
                from patient_postop_comm_notes p
                where
                p.link2patient=$patientid
                order by p.create_date desc");
	return $query->result_array();	
  }


	public function update_surgerydetails($data,$id)
	{
	$this->db->where('patient_surgery.recnum',$id);
	return $this->db->update('patient_surgery', $data);
	}


}
?>
