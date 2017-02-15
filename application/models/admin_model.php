<?php
//==============================================
// Author: FSI                                 =
// Date-written = Dec 15, 2014                 =
// Filename: admin_model.php                   =
// Copyright of Fluent Technologies            =
// Database manipulation in admin login        =
//==============================================

/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
class admin_model extends CI_Model 
{
	function __construct() 
        {
		parent::__construct(); 
                $this->status='';
                $this->disp_seq='';
				$this->name='';
				$this->consent_text='';
	}
        function setstatus($status)
        {
           $this->status=$status;
        }
        function setdisp_seq($disp_seq)
        {
           $this->disp_seq=$disp_seq;
        }
		
        function setname($name)
        {
           $this->name=$name;
        }
        function setconsent_text($consent_text)
        {
           $this->consent_text=$consent_text;
        }		
		
		//added by udaya for admin login on July 16th	
	function getclinic4admin($siteid)
	{
	    $sql ="select * from clinic where recnum = '$siteid'";			
		$query=$this->db->query($sql);
		//$query = $this->db->get();
		$result = $query->result();
		return $result;      
	}
	
	function getallclinic() 
        {
	$clinicname=$this->session->userdata('clinicname');
	$clinicname=($clinicname != '')?"'".$clinicname."%'":" '%' ";

	$status=$this->session->userdata('status');
	$status=($status != '')?"'".$status."%'":" '%' ";

	if($this->session->userdata('status')  == '')
	   $status=" 'Active' ";
		elseif($this->session->userdata('status') == 'all')
		$status=" '%' ";
		
		$query=$this->db->query("select * from clinic where name like $clinicname and 
		status like $status order by recnum DESC ");
		//$query = $this->db->get();
		$result = $query->result();
		return $result;        
	}
        function getalldoctors($siteid) 
        {
        $docname=$this->session->userdata('docname');
	    $docname=($docname != '')?"'".$docname."%'":" '%' ";
       
/*	   $clinicname=$this->session->userdata('clinicname');
	    $clinicname=($clinicname != '')?"'".$clinicname."%'":" '%' ";
		*/

	    $status=$this->session->userdata('status');

	    $status=($status != '')?"'".$status."%'":"'%' ";

        if($this->session->userdata('status')  == '')
		   $status=" 'Active' ";
		elseif($this->session->userdata('status') == 'all')
		$status=" '%' ";
		$sql ="(select d.recnum,d.fname,d.lname,d.addr1, d.addr2,d.city,d.state,d.zip,d.status,d.email,d.phone, d.created_by,  d.modified_by, d.created_date,d.modified_date,c.name, c.site_id
		from doctor d,user u, clinic c
		where d.recnum = u.link2doctor and
			u.link2clinic = c.recnum and
		c.recnum = $siteid and
		d.status like $status and
		CONCAT(d.fname, ' ',d.lname)  like $docname) 
		UNION
		(select  d.recnum,d.fname,d.lname,d.addr1, d.addr2,d.city,  d.state,d.zip,d.status,d.email,
		d.phone,d.created_by,d.modified_by, d.created_date,d.modified_date, 
		  '', ''
		from doctor d
		left join user u on d.recnum = u.link2doctor
		 where  u.link2doctor is null and
		d.status like $status and
		CONCAT(d.fname, ' ',d.lname)  like $docname) 
		order by  fname " ;
		$query=$this->db->query($sql);
		$result = $query->result();
		return $result;        
	}
        function getallusers($siteid) 
        {
			
        $user_id=$this->session->userdata('user_id');
		$userid=($user_id != '')?"'".$user_id."%'":" '%' ";
        $type=$this->session->userdata('type');
		$type=($type != '')?"'".$type."%'":" '%' ";
		/*
        $clinicname=$this->session->userdata('clinicname');
		$clinicname=($clinicname != '')?"'".$clinicname."%'":" '%' "; */
		$status=$this->session->userdata('status');
		$status=($status != '')?"'".$status."%'":"'%' ";

       if($this->session->userdata('status')  == '')
		   $status=" 'Active' ";
		elseif($this->session->userdata('status') == 'all')
		$status=" '%' ";

		$sql ="(select u.recnum,u.type,u.userid,d.fname,d.lname,d.city,d.state, c.name,c.site_id as site_id,u.status
		from doctor d,
         user u, clinic c
		where d.recnum = u.link2doctor and
          u.link2clinic = c.recnum and u.userid like $userid 
		and c.recnum =$siteid and u.type like $type and u.status like $status)
		UNION
		(select u.recnum,u.type,u.userid,p.fname ,p.lname, p.city,p.state,c.name,c.site_id as site_id,u.status
		from patient_info p,user u, clinic c
		 where   p.recnum = u.link2patient and
		u.link2clinic = c.recnum and u.userid like $userid 
		and c.recnum= $siteid and type like $type and u.status like $status)
		UNION
		(select u.recnum,u.type,u.userid,'','', '','','','' as site_id,u.status
		from user u
		 where   link2admin !='' and link2admin != 0 and u.userid like $userid 
		and u.type like $type and u.status like $status)
		order by userid" ;
		$query=$this->db->query($sql);
		//echo $sql;
 
		$result = $query->result();
		return $result;        
	}
    function getuserdetails($recnum) 
     {
		$query=$this->db->query("select u.recnum,u.link2patient,u.link2doctor,u.type,u.userid,u.link2clinic,u.password,u.status
		from user u where  u.recnum=$recnum");
		$result = $query->first_row();
		return $result;        
		}

    function getdoctordetails($recnum) 
        {
		$query=$this->db->query("select       u.recnum,u.link2patient,u.link2doctor,u.type,u.userid,d.fname,d.lname,
		d.city,d.state, c.name,c.site_id as site_id
		from doctor d, user u, clinic c
		where  u.recnum=$recnum");
		$result = $query->first_row();
		return $result;        
		}
	function getclinicdetails($recnum)
	{
		$this->db->select('*');
		$this->db->from('clinic');
		$this->db->where('recnum', $recnum);
		$this->db->order_by('name', 'asc');
		$query = $this->db->get();
		$result = $query->first_row();
		return $result;
	}
	function getopdetails($recnum)
	{
		$this->db->select('*');
		$this->db->from('operatory');
		$this->db->where('link2clinic', $recnum);
		$this->db->order_by('opname', 'asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function update_clinicinfo($data,$id)
	{
		$this->db->where('recnum',$id);
		return $this->db->update('clinic', $data);   
	}
        function update_operatory($data,$id)
	{
		$this->db->where('recnum',$id);
		$this->db->update('operatory', $data); 
	}
        function update_docinfo($data,$id)
	{
		$this->db->where('recnum',$id);
		$this->db->update('doctor', $data); 
	}
	function update_clinicid4patient($data,$recnum)
	{
	    $this->db->where('recnum',$recnum);
		$this->db->update('patient_info', $data); 
	}
	function getpatient_id($recnum)
	{
	$query=$this->db->query("select u.recnum,u.link2patient,u.link2doctor,u.type,u.userid
		from  user u
		where  u.recnum=$recnum");
		$result = $query->first_row();
		return $result;
	}
        function update_userinfo($data,$id)
	{
		$this->db->where('recnum',$id);
		$this->db->update('user', $data); 
	}
        function insert_operatory($data)
		{
         $this->db->insert('operatory', $data);
		$this->db->insert_id();
        }
        function insert_clinicinfo($data)
		{
        $this->db->insert('clinic', $data);
		return $this->db->insert_id();
        }
        function insert_meta($data)
        { 
         $this->db->insert('master_meta', $data);
		return $this->db->insert_id();
        }
        function insert_docinfo($data)
		{
        $this->db->insert('doctor', $data);
		return $this->db->insert_id();
        }
        function insert_userinfo($data)
		{
        $this->db->insert('user', $data);
		return $this->db->insert_id();
        }
		function delete_operatory($recnum)
		{
			$this->db->query("delete from operatory where recnum=$recnum");
		}
		function insert_menuitems($data)
		{
		   $this->db->insert('menu_items', $data);	   
		}
        function getclinicdetails4doc($recnum)
        {
            $query=$this->db->query("select d.*, c.name,c.site_id
			from doctor d,
			user u, clinic c
			where d.recnum = u.link2doctor and
			u.link2clinic = c.recnum and d.recnum=$recnum
			UNION
			select d.* ,'',''
				from doctor d
			 left join user u on d.recnum = u.link2doctor
			 where d.recnum = $recnum and
				   u.link2doctor is null");
//echo $query;
            $result = $query->result();
	    return $result;
        }
	function getmed_his4patient($link2patient)
	{
		/*$sql ="select m.recnum,m.upd_num,m.*
		from patient_health_info h,patient_medical_his m
		where m.link2patient=h.link2patient and h.link2patient=$link2patient
		and m.upd_num = (select max(m1.upd_num) from patient_medical_his m1 where
		m1.link2patient = $link2patient limit 1)
		order by m.disp_seq" ; */
		
		$sql ="select * from patient_medical_his m1 where
		m1.link2patient = $link2patient ";
		
		$query=$this->db->query($sql); 
  
		$result = $query->result();
		return $result;
	}
	function gethealth_info($patient_id)
	{
			$query=$this->db->query("select *
		from patient_health_info h
		where h.link2patient=$patient_id"); 
	  
		$result = $query->first_row();
		return $result;
	}
	function getmed_his4selpatient($link2patient,$upd_num)
	{
		/*$sql ="select m.recnum,m.upd_num,m.*
		from patient_health_info h,patient_medical_his m
		where m.link2patient=h.link2patient and h.link2patient=$link2patient
		and m.upd_num = $upd_num
		order by m.disp_seq" ; */
		
		//changed by udaya on July 14th
		$sql ="select m.recnum,m.upd_num,m.* from patient_medical_his m
				where m.link2patient=$link2patient and m.upd_num = $upd_num 
				order by m.disp_seq";
		//echo $sql;
		$query=$this->db->query($sql);       
		$result = $query->result();
		return $result;
	}
	function patients_infoDetails($patientlink) 
	{
	$query = $this->db->query("SELECT  concat(p.fname,' ', p.lname) as fullname,p.fname,
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
	  p.img_location
	  from patient_info p
	  where p.recnum like '$patientlink' "); 
        $dropdowns = $query->result();
        foreach($dropdowns as $dropdown)
        {
		 $dropDownList[$dropdown->recnum] = $dropdown->fullname;
		}
		  $finalDropDown = $dropDownList;
		  return $finalDropDown;
	}
        function clinic_infoDetails($cliniclink) 
		{
		$query = $this->db->query("SELECT  recnum,site_id,name,addr1,addr2,city,state,zip 
		from clinic  where recnum like '$cliniclink' and status='Active'"); 
			$dropdowns = $query->result();
        foreach($dropdowns as $dropdown)
        {
          $dropDownList[$dropdown->recnum] = $dropdown->name . " (" . $dropdown->site_id . ")";
		}
		  $finalDropDown = $dropDownList;
		  return $finalDropDown;
		}
       function doc_infoDetails($recnum) 
		{
		$query = $this->db->query("SELECT  *
		from doctor  where recnum like '$recnum' "); 

        $dropdowns = $query->result();
		$dropDownList['select']="Select";
        foreach($dropdowns as $dropdown)
        {
		 $dropDownList[$dropdown->recnum] = $dropdown->fname." ".$dropdown->lname;
		}
		  $finalDropDown = $dropDownList;
		  return $finalDropDown;
	}
	function checkdoc_exist4clinic($clini_id,$doc_id)
	{
	$query = $this->db->query("select * from user where link2clinic=$clini_id and link2doctor=$doc_id");
	return $query->num_rows(); 
	}
	function doc_infoDetails4user() 
	{
		$query = $this->db->query("select d.* from doctor d");
		$dropdowns = $query->result();
		$dropDownList['select']="Select";
		foreach($dropdowns as $dropdown)
		{
		 $dropDownList[$dropdown->recnum] = $dropdown->fname." ".$dropdown->lname;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	function emailDetails($recnum) 
	{
		$query = $this->db->query("SELECT  *
		from doctor where recnum like '$recnum' "); 
		return $query->first_row();	
	}
	function emailDetails4patient($recnum)
	{
		$query = $this->db->query("SELECT  *
		from patient_info  where recnum like '$recnum' "); 
		return $query->first_row();	
	}
	function patientDetails4patient($recnum)
	{
	$query = $this->db->query("SELECT  p.*,c.name,c.site_id
		from patient_info p,clinic c where p.recnum ='$recnum' and 
	p.link2clinic=c.recnum"); 
			return $query->first_row();
	}
        function checkuser_exist($userid,$password)
	{
		 $query = $this->db->query("select  u.link2patient,u.link2doctor,u.link2clinic,u.type,u.recnum 
		 from user u,clinic c 
		 where  u.userid='$userid' and u.password='$password'
		 and c.recnum=u.link2clinic and c.status='Active'");

         return $query->first_row();		 
	}
	function checkuser_exist4admin($userid,$password, $siteid)
	{
		 $sql ="select u.link2patient,u.link2doctor,u.link2clinic,u.type 
				from user u
				where  u.userid='$userid' and u.password='$password' and u.link2clinic='$siteid'" ;
		 //echo $sql ;				
		 $query = $this->db->query($sql);
		 
         return $query->first_row();		 
	}
        function checkadmin_exist()
        {
          $query = $this->db->query("select * from user where type='admin' ");
          return $query->first_row();	
        }	
        function clinic_infoDetails4disp($cliniclink) 
	{
		$query = $this->db->query("SELECT  recnum,site_id,name,addr1,addr2,city,state,zip 
	from clinic  where recnum like '$cliniclink'"); 
       return $query->first_row();	
}
    function updat_userinfo($status,$recnum) 
		{
		$query = $this->db->query("update user set status='$status' where link2doctor=$recnum"); 
        }
	function updatemd54user($md5_string)
	{
	$query = $this->db->query("update user set md5_string='' 
	where md5_string='$md5_string' "); 
	}
	function checkuser_exist4md5($md5_string)
	{
	$query = $this->db->query("select * from user where md5_string='$md5_string' ");
	return $query->first_row(); 
	}
	function updatemd5_string($email)
	{
	$new_email=md5($email);
	$query = $this->db->query("update user set md5_string='$new_email' where userid='$email' "); 
	}	
   function getpassworddetails($userid) 
     {
	 $query=$this->db->query("select u.recnum,u.link2patient,u.link2doctor,u.type,u.userid,u.link2clinic,u.password,u.status,u.password
     from user u
     where  u.userid='$userid'");
	 return $query->first_row();      
	} 	
	 function updatepassword($userid,$password) 
	 {
		$query=$this->db->query("update user set password='$password'
		where userid='$userid'");      
	 }
	 function updateemail($userid,$new_userid) 
		 {
		$query=$this->db->query("update user set userid='$new_userid'
		where userid='$userid'");      
		}
	 function updateemail4doc($new_userid,$email) 
		{
		$query=$this->db->query("update user set userid='$new_userid'
		where userid='$email' ");      
		}
	 function updateemail4dpatient($new_userid,$email) 
		 {
		 $query=$this->db->query("update user set userid='$new_userid'
		 where userid='$email' ");      
	     }
	function deletemenu($recnum)
	{
	  $this->db->query("delete from menu_items where link2clinic=$recnum");
	}

	function getmenudetails($recnum)
	{
		$query=$this->db->query("select recnum,item_name from menu_items where link2clinic=$recnum");
		$result = $query->result();
		return $result;
	} 

function patients_infoDetails4clinic($recnum)
{
 $query=$this->db->query("select u.recnum,u.type,u.userid,p.fname ,p.lname, p.city,
       p.state,c.name,c.site_id as site_id,u.status,p.recnum as patient_recnum
from patient_info p,user u, clinic c
where  p.recnum = u.link2patient and
       u.link2clinic = c.recnum 
       and c.recnum = $recnum");
	  //echo $query;		  
   return $query->result();
/*
        foreach($dropdowns as $dropdown)
        {
	 $dropDownList[$dropdown->patient_recnum] = $dropdown->fname." ".$dropdown->lname;
	}
	$finalDropDown = $dropDownList;
	return $finalDropDown;
*/
} 
function getpatients4newuser($recnum)
{
		$sql ="select p.fname ,p.lname, p.city,
        p.state,p.recnum as patient_recnum
		from patient_info p
		where  p.recnum not in (select link2patient from  user) and
		p.link2clinic=$recnum" ;
		//echo $sql ;
        $query=$this->db->query($sql);
	
	
	    return $query->result();
/*
        foreach($dropdowns as $dropdown)
        {
		$dropDownList[$dropdown->patient_recnum] = $dropdown->fname." ".$dropdown->lname;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
*/
}
function getallmaster_meta()
{
        $grpname=$this->session->userdata('grpname');
	$grpname=($grpname != '')?"'".$grpname."%'":" '%' ";
        $name=$this->session->userdata('name');
	$name=($name != '')?"'".$name."%'":" '%' ";

	$status=$this->session->userdata('status');

if($status == 'all')
$status='';
elseif($status == '')
$status='Active';
	$status=($status != '')?"'".$status."%'":"'%' ";

	$query=$this->db->query("select    
                                m.recnum,m.`name`,m.`group`,m.status,m.disp_seq,
m.consent_text,m.tooth_num_flag,m.tooth_shade_flag,                               c.name as clinic,c.recnum as clinic_rec        
                                from master_meta m
                                left join clinic c on m.link2clinic=c.recnum
                                where m.type='health_history' and 
                                m.status like $status and 
                               m.`group` like $grpname and 
                               m.`name` like $name
                                order by c.name,m.`group`,m.disp_seq");

	 //echo $query;		  
	 return $query->result();
}
function getdefaultmaster_meta()
{
$query=$this->db->query("select    
                                m.recnum,m.`name`,m.`group`,m.status,
                                m.disp_seq,m.type,m.consent_text,
                                m.tooth_num_flag,m.tooth_shade_flag
                                from master_meta m                                
                                where 
                                m.status ='Active' and
                                (m.link2clinic ='' || 
                                 m.link2clinic =0 || 
                                 m.link2clinic is NULL)     
                                order by m.disp_seq");
	 //echo $query;		  
	 return $query->result();
}
function getmaster_meta4each($recnum)
{
	$status='%';
	$query=$this->db->query("select recnum,`name`,`group`,status from master_meta where recnum=$recnum");
	 return $query->first_row();
}
function updatemastermeta($recnum)
{
	$status=$this->status;
	$disp_seq=$this->disp_seq;
	$name=$this->name;
	$consent_text=$this->consent_text;	
	$sql ="update master_meta set name='$name',
								 consent_text = '$consent_text',							  
                                  status='$status',
                                  disp_seq=$disp_seq
                                  where recnum=$recnum" ;
								  
        $query=$this->db->query($sql);
}
function check4dup_seq($link2clinic,$disp_seq,$type)
{
   $query=$this->db->query("select * from master_meta where link2clinic=$link2clinic and disp_seq=$disp_seq and type='$type'");
	 return $query->num_rows();
}
function updatestatus4health_meta($status,$recnum)
{
$query=$this->db->query("update master_meta set status='$status' where recnum=$recnum");
}
function getclinic_details($recnum)
{
$query=$this->db->query("select * from clinic where recnum=$recnum");
return $query->first_row();
}

function getallname4group($link2clinic,$type)
{
	if($link2clinic == 0)
	 $cond="(link2clinic='' || link2clinic is NULL)";
	else
	$cond="link2clinic=$link2clinic";

	$sql ="select m.recnum,m.`name`,m.`group`,m.status,m.disp_seq,c.name as clinic,m.link2clinic,
		m.consent_text,m.tooth_num_flag,m.tooth_shade_flag
		from master_meta m
		left join clinic c on m.link2clinic=c.recnum
		where $cond  and
        m.type='$type'
        order by m.`group`,m.disp_seq";
		$query=$this->db->query($sql);
		return $query->result();
}
function getallname4groupedit($link2clinic,$type)
{
		if($link2clinic == 0)
		 $cond="(link2clinic='' || link2clinic is NULL)";
		else
		$cond="link2clinic=$link2clinic";

	$sql ="select m.recnum,m.`name`,m.`group`,m.status,m.disp_seq,m.consent_text,
	m.tooth_num_flag,m.tooth_shade_flag,c.name as clinic,
	m.link2clinic 
	from master_meta m
	left join clinic c on m.link2clinic=c.recnum
	 where $cond and type='$type' order by m.`group`,m.disp_seq" ;
	
		$query=$this->db->query($sql);
	
		 return $query->result();

}
function getclinic_name($recnum) 
	{
			$query = $this->db->query("SELECT  *
		from clinic  where recnum like '$recnum' "); 
		return $query->first_row();	
	}
function getAllClinics()
{
	$query = $this->db->query("SELECT recnum,name,site_id FROM clinic");
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
function getAllDocs($recnum)
{

	$query = $this->db->query("SELECT d.recnum,d.fname,d.lname FROM doctor d,user u where u.link2clinic=$recnum and u.link2doctor=d.recnum");
	$dropdowns = $query->result();
	$dropDownList['0'] ='Select';
	foreach($dropdowns as $dropdown)
	{
		$dropDownList[$dropdown->recnum] = $dropdown->fname.'('.$dropdown->lname.')';
	}
	//var_dump($dropDownList);
	$finalDropDown = $dropDownList;
	return $finalDropDown;
	
}
//ADDED BY UDAYA ON jULY 17TH
        function clinic_name($clinicid) 
		{
		$sql ="SELECT  name as clinicname
		from clinic  where recnum = '$clinicid' and status='Active'" ;	
		$query = $this->db->query($sql); 
	
		$arr = $query->result_array();
		return $arr;	
		}
		
		/*
		function doc_details($clinicid)
		{
			$sql = "select d.fname as fname, d.lname as lname , d.recnum as recnum, c.name as clinicname from doctor d inner join user u on 
				d.recnum = u.link2doctor inner join 
				clinic c on 
				c.recnum = u.link2clinic and u.link2clinic = '$clinicid' and u.status ='active'";
				
				//echo $sql;
		    $query = $this->db->query($sql);
			$docnames = $query->result_array();
			return $docnames ;
			//print_r($docnames);
			//echo $docnames;

		}
		*/
		
		function doc_details($clinicid)
		{
			$sql = "select d.fname as fname, d.lname as lname , d.recnum as recnum from doctor d";
			//echo $sql;
		    $query = $this->db->query($sql);
			$docnames = $query->result_array();
			//print_r($docnames);
			return $docnames ;
			
			//echo $docnames;

		}
		
		
}

?>
