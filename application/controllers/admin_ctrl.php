<?php
//==============================================
// Author: FSI                                 
// Date-written = Dec 01, 2014                
// Filename: admin_ctrl.php                   
// Copyright of Fluent Technologies            
// Doctor Controller                        
//==============================================

class admin_ctrl extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin_model');
        $this->load->model('patient_model');
        $this->load->library('session');
	    $this->load->library('form_validation');
        include("SessionController.php");  
        include("user_type4admin.php");  
    }
    function index() 
    {
        $header['js_files'] = array();
        array_push($header['js_files'], 'js/admin.js');
		
		$siteid = $this->session->userdata('siteid') ;
		/*
        $data['clinicname']='';
        $data['status']='';
        if ($this->input->post('clinicname') != '' &&  $this->input->post('check_search') == 1 )
        {
 	       $senderarr=array('clinicname'=>$this->input->post('clinicname'));  
	       $this->session->set_userdata($senderarr);
           $data['clinicname']=$this->session->userdata('clinicname');
        }
        else if (($this->session->userdata('clinicname') != '') && 
             $this->input->post('check_search') == 1 )
		{  
           $senderarr=array('clinicname'=>$this->input->post('clinicname'));  
	       $this->session->set_userdata($senderarr);
           $data['clinicname']=$this->session->userdata('clinicname');
        }
        else if (($this->session->userdata('clinicname') != '') && 
                $this->input->post('check_search') == '' )
		{ 
             $data['clinicname']=$this->session->userdata('clinicname');
        }
        else if ($this->input->post('clinicname') == '' )
        { 
 	       $senderarr=array('sender'=>$this->input->post('clinicname'));  
	       $this->session->set_userdata($senderarr);
           $data['clinicname']=$this->session->userdata('clinicname');
        } 
		$senderarr1=array('status'=>$this->input->post('status'));  
		$this->session->set_userdata($senderarr1);
		$data['status']=$this->session->userdata('status');
      
	  */
        $this->load->view("includes/header4admin4home", $header);
        //$data['query']=$this->admin_model->getallclinic();
		
		$data['query']=$this->admin_model->getclinic4Admin($siteid);
        $this->load->view('admin/clinic_view',$data);
        $this->load->view("includes/footer");
    }
    function doctor() 
    {
        $header['js_files'] = array('js/ddb_patients_view.js');
        $header['js_files'] = array('js/admin.js');
        $this->load->view("includes/header4admin4doctor", $header);
        $data['docname']='';
        $data['clinicname']='';
        $data['status']='';

		$siteid =$this->session->userdata('siteid') ;
		$data['siteid'] = $siteid ; 
        $senderarr=array('docname'=>$this->input->post('docname'));  
        $this->session->set_userdata($senderarr);
        $data['docname']=$this->session->userdata('docname');

		/*
		$senderarr=array('clinicname'=>$this->input->post('clinicname'));  
		$this->session->set_userdata($senderarr);
        $data['clinicname']=$this->session->userdata('clinicname');
		*/
        
        $senderarr1=array('status'=>$this->input->post('status'));  
		$this->session->set_userdata($senderarr1);
        $data['status']=$this->session->userdata('status');

        $data['query'] = $this->admin_model->getalldoctors($siteid);
        $this->load->view("admin/doctor_view", $data);
        $this->load->view("includes/footer");
    }
    function user() 
    {
        $header['js_files'] = array('js/ddb_patients_view.js');
		$header['js_files'] = array('js/admin.js');
        $this->load->view("includes/header4admin4user", $header);
        $data['user_id']='';
        $data['type']='';
        $data['clinicname']='';
        $data['status']='';
		$data['clinicid']='';

		//added by udaya on July 20th
        $data['clinicid']  =$this->session->userdata('clinicid');

		$siteid =$this->session->userdata('siteid') ;	
        $senderarr=array('user_id'=>$this->input->post('user_id'));  
		$this->session->set_userdata($senderarr);
        $data['user_id']=$this->session->userdata('user_id');

		$senderarr=array('type'=>$this->input->post('type'));  
		$this->session->set_userdata($senderarr);
        $data['type']=$this->session->userdata('type');

		/*
        $senderarr=array('clinicname'=>$this->input->post('clinicname'));  
		$this->session->set_userdata($senderarr);
        $data['clinicname']=$this->session->userdata('clinicname'); */
		
        
		$senderarr1=array('status'=>$this->input->post('status'));  
	    $this->session->set_userdata($senderarr1);
        $data['status']=$this->session->userdata('status');
		
        $data['query'] = $this->admin_model->getallusers($siteid);
		//print_r($data) ;
        $this->load->view("admin/user_view", $data);
        $this->load->view("includes/footer");
    }   
    function getclinic()
    {
       $recnum =$this->uri->segment(3);  
       $data['row'] = $this->admin_model->getclinicdetails($recnum);
       $data['op_row'] = $this->admin_model->getopdetails($recnum);
       $data['menu'] = $this->admin_model->getmenudetails($recnum);
       $data['recnum']=$recnum;
	   $data['master_meta'] = $this->admin_model->getallname4group($recnum,'health_history');
	   $data['patient_consent'] = $this->admin_model->getallname4group($recnum,'patient_consent');	  
       $this->load->view('admin/editclinic_details',$data);   
    }   
  function getdoctordetails()
    {
       $recnum =$this->uri->segment(3);  
       $header['js_files'] = array('js/admin.js');
       $data['query'] = $this->admin_model->getclinicdetails4doc($recnum);
       $data['recnum']=$recnum;
       $this->load->view('admin/editdoc_details',$data);   
    }
  function getuserdetails()
    {
       $recnum =$this->uri->segment(3);  
	   $data['clinicid'] = $this->session->userdata('clinicid') ;
       $data['row'] = $this->admin_model->getuserdetails($recnum);
       $data['recnum']=$recnum;

       $this->load->view('admin/edituser_details',$data);   
    }
    function updateclinic()
    {
        date_default_timezone_set('America/Los_Angeles');

        $udata=array();
        $recnum = $this->input->post('recnum');	
		$udata['name'] = $this->input->post('clinic');	
		$udata['site_id'] = $this->input->post('location');	
		$udata['addr1'] = $this->input->post('addr1');	
		$udata['addr2'] = $this->input->post('addr2');	
		$udata['city'] = $this->input->post('city');	
		$udata['state'] = $this->input->post('state');	
		$udata['zip'] = $this->input->post('zip');
        $fax=$this->input->post('fax1').'-'.$this->input->post('fax2').'-'.$this->input->post('fax3');
		$udata['fax'] = $fax;
        $udata['status'] = $this->input->post('status');
        $phone=$this->input->post('phone1').'-'.$this->input->post('phone2').'-'.$this->input->post('phone3');
		$udata['phone'] = $phone;
        $udata['website'] = $this->input->post('website');

		$this->admin_model->update_clinicinfo($udata,$recnum);

		$udata=array();
		$this->admin_model->deletemenu($recnum);
		$udata['link2clinic'] = $recnum;
		if($this->input->post('home') != '')
			{
			  $udata['item_name'] = 'home';	 
			  $this->admin_model->insert_menuitems($udata);
			}
		if($this->input->post('profile')!= '')
			{
			  $udata['item_name'] = 'profile';	 
			  $this->admin_model->insert_menuitems($udata);
			}
		if($this->input->post('appts')!= '')
			{
			  $udata['item_name'] = 'appts';	 
			  $this->admin_model->insert_menuitems($udata);
			}
		if($this->input->post('msg')!= '')
			{
			  $udata['item_name'] = 'msg';	 
			  $this->admin_model->insert_menuitems($udata);
			}
		if($this->input->post('report')!= '')
			{
			  $udata['item_name'] = 'report';	 
			  $this->admin_model->insert_menuitems($udata);
			}

	$udata='';
	for($i=1;$i<=5;$i++)
	{
		if($this->input->post('prevlinenum'.$i) != '' && $this->input->post('op_name'.$i) != '')
		{
			$udata['opname'] = $this->input->post('op_name'.$i);
			$udata['modified_date'] = date('Y-m-d');
			$this->admin_model->update_operatory($udata,$this->input->post('lirecnum'.$i));	
		}
		elseif($this->input->post('prevlinenum'.$i) == '' && $this->input->post('op_name'.$i) != '')
		{
                       // var $id=$this->input->post('last_id')+1;
			$udata['opname'] = $this->input->post('op_name'.$i);	
			$udata['operatory_num'] = 'op'.$this->input->post('last_id')+1;
			$udata['link2clinic'] = $recnum;
			$udata['status'] = 'Open';
			$udata['create_date'] = date('Y-m-d');
			$udata['created_by'] = 'Admin';
			$this->admin_model->insert_operatory($udata);
		}
                elseif($this->input->post('prevlinenum'.$i) != '' && $this->input->post('op_name'.$i) == '')
		{
          $this->admin_model->delete_operatory($this->input->post('lirecnum'.$i));
                }	
	}
	$index=$this->input->post('index');
	for($i=0;$i<$index;$i++)
	{
	   $name= $this->input->post('name_'.$i) ? "yes" : "no";
       $status=($name == 'yes')?'Active':'Inactive';
	  
	   $recnum = $this->input->post('grouprec_'.$i);	
	   $this->admin_model->updatestatus4health_meta($status,$recnum);	  
	}
	   $consent_index=$this->input->post('consent_index');
	for($i=0;$i<$consent_index;$i++)
	{
	  $name= $this->input->post('consentrec_'.$i) ? "yes" : "no";
	  if($name == 'no')
	  {
	    $recnum = $this->input->post('consent_rec'.$i);	
	    $this->admin_model->updatestatus4health_meta($recnum);
	  }
	}

        $this->index();
   }
   function addclinic()
   {    
        $header['js_files'] = array();        
        $header['js_files'] = array('js/jquery.js');
         array_push($header['js_files'], 'js/admin.js');
        $this->load->view("includes/header4admin4home", $header);
        $health_details = $this->admin_model->getdefaultmaster_meta();
        $data['query']=$health_details;  

        $this->load->view('admin/add_clinic',$data);
        $this->load->view("includes/footer"); 
   }
   function adddoctor()
   {    
        $header['js_files'] = array();
        $header['js_files'] = array('js/admin.js');
        $this->load->view("includes/header4admin4doctor", $header);
		$clinicid = $this->session->userdata('siteid') ;
		$data['clinicid'] = $clinicid  ;
        $this->load->view('admin/add_doctor', $data);
        $this->load->view("includes/footer"); 
   }
	function master_health()
	{
        $header['js_files'] = array('js/ddb_patients_view.js');
        $header['js_files'] = array('js/admin.js');
        $this->load->view("includes/header4admin4health", $header);        

        
        $data['grpname']='';
        $data['name']='';
        $data['status']='Active';

        $senderarr=array('grpname'=>$this->input->post('grpname'));  
        $this->session->set_userdata($senderarr);
        $data['grpname']=$this->session->userdata('grpname');

		$senderarr=array('name'=>$this->input->post('name'));  
		$this->session->set_userdata($senderarr);
        $data['name']=$this->session->userdata('name');
        
        $senderarr1=array('status'=>$this->input->post('status'));  
		$this->session->set_userdata($senderarr1);
        $data['status']=$this->session->userdata('status');

        $data['query'] = $this->admin_model->getallmaster_meta();

        $this->load->view("admin/master_meta", $data);
        $this->load->view("includes/footer");
	}
	function enterdoctor() 
	{
		$udata=array();
		$udata['fname'] = $this->input->post('fname');	
		$udata['lname'] = $this->input->post('lname');	
		$udata['addr1'] = $this->input->post('addr1');	
		$udata['addr2'] = $this->input->post('addr2');	
		$udata['city'] = $this->input->post('city');	
		$udata['state'] = $this->input->post('state');	
		$udata['email'] = $this->input->post('email');
		//$udata['link2clinic'] = $this->input->post('clinicid');
		$phone=$this->input->post('phone1').'-'.$this->input->post('phone2').'-'.$this->input->post('phone3');
		$udata['phone'] = $phone;
		$udata['status']='Active';
		$udata['zip'] = $this->input->post('zip');
	
		$recnum=$this->admin_model->insert_docinfo($udata);
		$this->doctor();
	}
	function addnewname()
	{
	  $recnum=$this->uri->segment(3); 
	  $q=$this->admin_model->getmaster_meta4each($recnum);
	  $data['group_name']=$q->group;
	  $this->load->view('admin/addnewname4group',$data); 
	}

	function getmaster_meta()
	{
	$link2clinic=$this->uri->segment(3); 
	$data['query']=$this->admin_model->getallname4groupedit($link2clinic,'health_history');
	
	
	$data['query_consent']=$this->admin_model->getallname4groupedit($link2clinic,'patient_consent');

	$data['clinic_name']=$this->admin_model->getclinic_name($link2clinic);
	$data['link2clinic']=$link2clinic; 
	$this->load->view('admin/editmaster_meta',$data); 
	}
	function addmaster_meta()
	{
	  $header['js_files'] = array();
	  $header['js_files'] = array('js/admin.js');
	  $this->load->view("includes/header4admin4health", $header);
	  $this->load->view('admin/addmaster_meta');
	  $this->load->view("includes/footer"); 
	}
	function addnewmaster_meta()
	{
		$header['js_files'] = array('js/ddb_patients_view.js');
		$header['js_files'] = array('js/admin.js');
		$this->load->view("includes/header4admin4health", $header);  
		$data['type']=$this->uri->segment(4); 
		$link2clinic=$this->uri->segment(3);  
		$data['link2clinic']=$link2clinic;
		$data['query']=$this->admin_model->getallname4group($link2clinic,$this->uri->segment(4));
		$this->load->view('admin/addmaster_meta',$data); 
		$this->load->view("includes/footer");
	}
	
	function enterconsent_meta()
	{
		$count=$this->admin_model->check4dup_seq($this->input->post('link2clinic'),$this->input->post('disp_seq'),'patient_consent');
		$link2clinic=$this->input->post('link2clinic');
		if($count == '0')
		{
			 $data['link2clinic']=$this->input->post('link2clinic');
			 $data['disp_seq']=$this->input->post('disp_seq');
			 $data['name']=$this->input->post('cond_name');
			 $data['consent_text']=$this->input->post('consent_text');
			 $data['status']='Active';
			 $data['type']='patient_consent';
			 $data['tooth_num_flag']= $this->input->post('tooth_flag') ? "yes" : "no";
			 $data['tooth_shade_flag']=$this->input->post('shade_flag') ? "yes" : "no";
			 $this->admin_model->insert_meta($data);    
			 $this->master_health();         
		}
		else
		{
			 $this->session->set_flashdata('flashMessage', 'Please Enter different Display Sequence');
			 $data['type']='consent_info';
			 redirect("admin_ctrl/addnewmaster_meta/$link2clinic ");
		}
	}
	function addnewmaster_consent()
	{
		$header['js_files'] = array('js/ddb_patients_view.js');
		$header['js_files'] = array('js/admin.js');
		$this->load->view("includes/header4admin4health", $header);  
		$data['type']='consent_info';
		$link2clinic=$this->uri->segment(3);  
		$data['link2clinic']=$link2clinic;
		$data['query']=$this->admin_model->getallname4groupedit($link2clinic,'patient_consent');
		$this->load->view('admin/addmaster_meta',$data); 
		$this->load->view("includes/footer");
	}
	function entermaster_meta()
	{
		$count=$this->admin_model->check4dup_seq($this->input->post('link2clinic'),$this->input->post('disp_seq'),'health_history');
		$link2clinic=$this->input->post('link2clinic');
		if($count == '0')
		{
			 $data['link2clinic']=$this->input->post('link2clinic');
			 $data['disp_seq']=$this->input->post('disp_seq');
			 $data['name']=$this->input->post('cond_name');
			 $data['group']=$this->input->post('group_name');
			 $data['status']='Active';
			 $data['type']='health_history';
			 $this->admin_model->insert_meta($data);    
			 $this->master_health();         
		}
		else
		{
			$this->session->set_flashdata('flashMessage', 'Please Enter different Display Sequence');
			redirect("admin_ctrl/addnewmaster_meta/$link2clinic ");
		}
	}
	function updatemaster_meta()
	{ 
	$index=$this->input->post('index');
	for($i=0;$i<$index;$i++)
	{
		 $recnum=$this->input->post('rec'.$i);
		 $disp_seq=$this->input->post('disp_seq'.$i);
		 $status=$this->input->post('status'.$recnum);
		 
		 $name=$this->input->post('name'.$i);	
     	 $consent_text =$this->input->post('consent_text'.$i);		 
    	 $this->admin_model->setname($name);
		 $this->admin_model->setconsent_text($consent_text);
		 $this->admin_model->setdisp_seq($disp_seq);
		 $this->admin_model->setstatus($status);
		 $this->admin_model->updatemastermeta($recnum);
	}
	$this->master_health();
	}
	function enterclinic() 
	{
		date_default_timezone_set('America/Los_Angeles');
		$udata=array();
		$udata['name'] = $this->input->post('clinic');	
		$udata['site_id'] = $this->input->post('location');	
		$udata['addr1'] = $this->input->post('addr1');	
		$udata['addr2'] = $this->input->post('addr2');	
		$udata['city'] = $this->input->post('city');	
		$udata['state'] = $this->input->post('state');	
		$udata['zip'] = $this->input->post('zip');
		$udata['website'] = $this->input->post('website');
		$udata['status'] = 'Active';
		$phone=$this->input->post('phone1').'-'.$this->input->post('phone2').'-'.$this->input->post('phone3');
		$udata['phone'] = $phone;
		$fax=$this->input->post('fax1').'-'.$this->input->post('fax2').'-'.$this->input->post('fax3');	
		$udata['fax'] = $fax;

		$recnum=$this->admin_model->insert_clinicinfo($udata);

		$udata=array();
			$udata['link2clinic'] = $recnum;

		if($this->input->post('home') != '')
		{
		  $udata['item_name'] = 'home';	 
		  $this->admin_model->insert_menuitems($udata);
		}
		if($this->input->post('profile')!= '')
			{
			  $udata['item_name'] = 'profile';	 
			  $this->admin_model->insert_menuitems($udata);
			}
		if($this->input->post('appts')!= '')
			{
			  $udata['item_name'] = 'appts';	 
			  $this->admin_model->insert_menuitems($udata);
			}
		if($this->input->post('msg')!= '')
			{
			  $udata['item_name'] = 'msg';	 
			  $this->admin_model->insert_menuitems($udata);
			}
		if($this->input->post('report')!= '')
			{
			  $udata['item_name'] = 'report';	 
			  $this->admin_model->insert_menuitems($udata);
			}

		$udata=array();
		for($i=1;$i<=5;$i++)
		{
			if($this->input->post('op_name'.$i) != '')
			{
				$udata['opname'] = $this->input->post('op_name'.$i);	
				$udata['operatory_num'] = 'op'.$i;
				$udata['link2clinic'] = $recnum;
				$udata['status'] = 'Open';
				$udata['create_date'] = date('Y-m-d');
				$udata['created_by'] = 'Admin';
				$this->admin_model->insert_operatory($udata);
			}
		}
		$index=$this->input->post('index');

		for($i=0;$i<$index;$i++)
		{
		  $name= $this->input->post('name_'.$i) ? "yes" : "no";
			if($name == 'yes')
			{
			$udata1['link2clinic']=$recnum;
			$udata1['group'] = $this->input->post('group_'.$i);	
			$udata1['name'] = $this->input->post('cond_'.$i);
			$udata1['type'] = 'health_history';
			$udata1['status'] = 'Active';
			$udata1['disp_seq'] = $this->input->post('dispseq_'.$i);
			$this->admin_model->insert_meta($udata1);
			}
		}  

		$index4consent=$this->input->post('index4consent');

		for($j=0;$j<$index4consent;$j++)
		{
		 $name= $this->input->post('rec_'.$j) ? "yes" : "no";
		 $tooth= $this->input->post('tooth_'.$j) ? "yes" : "no";
		 $shade= $this->input->post('shade_'.$j) ? "yes" : "no";
		if($name == 'yes')
		{
		$udata1['link2clinic']=$recnum;
		$udata1['group'] = '';	
		$udata1['name'] = $this->input->post('name_'.$j);
		$udata1['consent_text'] = $this->input->post('text_'.$j);
		$udata1['tooth_num_flag'] = $tooth;
		$udata1['tooth_shade_flag'] = $shade;
		$udata1['type'] = 'patient_consent';
		$udata1['status'] = 'Active';
		$udata1['disp_seq'] = $this->input->post('dispseq_'.$j);
		$this->admin_model->insert_meta($udata1);
			}
		} 
 
		$this->index();
	}
	function updatedoctor()
	{
		date_default_timezone_set('America/Los_Angeles');
		$udata=array();

		$recnum = $this->input->post('recnum');	
		$udata['status'] = $this->input->post('status');
		$udata['modified_date'] =date('Y-m-d');	
		$udata['modified_by'] = 'Admin';
		$phone=$this->input->post('phone1').'-'.$this->input->post('phone2').'-'.$this->input->post('phone3');
		$udata['phone'] = $phone;

		$this->admin_model->update_docinfo($udata,$recnum);
		$this->admin_model->updat_userinfo($this->input->post('status'),$recnum);
			
		$this->doctor();
	}
	function updateuser()
	  {
		date_default_timezone_set('America/Los_Angeles');
		$udata=array();
		$recnum = $this->input->post('recnum');	
		$udata['status'] = $this->input->post('status');
		$udata['link2clinic'] = $this->input->post('link2clinic');

		$udata['modified_date'] =date('Y-m-d');	
		$udata['modified_by'] = 'Admin';
		$this->admin_model->update_userinfo($udata,$recnum);
		$pwd=$this->input->post('password');
		if($pwd!='')
		{
		$pdata['password']=md5($this->input->post('password'));
		$this->admin_model->update_userinfo($pdata,$recnum);
		
		}
        $record=$this->admin_model->getpatient_id($recnum);
        $patient_id=$record->link2patient;

		$udata1['link2clinic'] = $this->input->post('link2clinic');
		$this->admin_model->update_clinicid4patient($udata1,$patient_id);
		$this->user();
   }
   
   function adduser()
   {    
        $header['js_files'] = array();
		$header['js_files'] = array('js/admin.js');
		$clinicid = $this->session->userdata('siteid') ;
		$data['clinicid'] = $clinicid  ;
		
        $this->load->view("includes/header4admin4user", $header);
        $this->load->view('admin/add_user', $data);
        $this->load->view("includes/footer"); 
   }
	function checkdoc4clinic()
	{
        $clinic_id =$this->uri->segment(3);  
	    $doc_id =$this->uri->segment(4); 
	    $num_rows=$this->admin_model->checkdoc_exist4clinic($clinic_id,$doc_id);
	    echo $num_rows;
	}
	function getallemp()
	{
	    $type =$this->uri->segment(3);  
	    $sel_type =$this->uri->segment(4); 
	    $link2clinic =$this->uri->segment(5); 
		$clinicid=$this->uri->segment(6); 
		
		$clinicid = $this->session->userdata('siteid') ;
	    $data['type']=$type;
	    $data['sel_type']=$sel_type;
	    $data['link2clinic']=$link2clinic;
		$data['recnum'] = $clinicid ;
		$data['clinicid'] = $clinicid ;

		
	    //$this->load->view('admin/getallemps',$data);  
		$this->load->view('admin/getallclinic',$data);  
	}
	function enterhealth_history()
	{
		date_default_timezone_set('America/Los_Angeles');
		$udata=array();
		$group_id = $this->input->post('group_id');	
		$cond_name = $this->input->post('cond_name');
		$newgroup_name = $this->input->post('newgroup_name');

		if($newgroup_name != '')
		{
			$grp_pos=$this->input->post('group_pos');
			$pos_list=$this->admin_model->gethealthdetails_groupwise($this->input->post('link2clinic'));
			$gr_flag=0;
			foreach($pos_list as $gr)
			{
			$link2group='';
			if($gr->group_recnum == $grp_pos)
			{
			$data['group_level']=$gr->group_level;
			$data['link2clinic'] = $this->input->post('link2clinic');
			$data['main_menu'] = $this->input->post('newgroup_name');
			$link2group=$this->admin_model->insert_healthhistory($data);
			}
			if($link2group != '')
			{
					$udata=array();
					$udata['sub_item']=$cond_name;
					$udata['link2group']=$link2group;
					$sub_list=$this->admin_model->gethealthdetailwithgrpitem($this->input->post('link2clinic'));
					foreach($sub_list as $sub)
					{
					$subitem_level=$sub->subitem_level;
					}
					$udata['subitem_level']=$subitem_level;
					$this->admin_model->insert_healthhistory4subitem($udata);
					$gr_flag=1;
			}
			if($gr_flag==1)
				{
				  $data=array();
				  $recnum=$gr->group_recnum;
				  $data['group_level']=$gr->group_level+1;
				  $this->admin_model->update_healthhistory4group($data,$recnum);
				}
			}

		}
		else
		{
		$data['sub_item']=$cond_name;
		$data['link2group']=  $group_id;
		$pos=$this->input->post('newgroup_pos');
		$link2group=$this->admin_model->gethealthdetailwithgrp($this->input->post('link2clinic'),$group_id);
		$flag=0;
			foreach($link2group as $gr)
			{
				if($gr->subitem_recnum == $pos)
				{
				  $data['subitem_level']=$gr->subitem_level;
				  $this->admin_model->insert_healthhistory4subitem($data);
				  $flag=1;
				}
				if($flag==1)
				{
				  $data=array();
				  $recnum=$gr->subitem_recnum;
				  $data['subitem_level']=$gr->subitem_level+1;
				  $this->admin_model->update_healthhistory($data,$recnum);
				}
			}
		}
		$this->health_history();
	}
	function enteruser() 
	{
		date_default_timezone_set('America/Los_Angeles');
		$udata=array();
		$udata['userid'] = $this->input->post('userid');	
		$udata['password'] = $this->input->post('password');	
		$udata['status'] = $this->input->post('status');	
		$udata['link2doctor'] = $this->input->post('listofdocs');	
		//$udata['link2patient'] = $this->input->post('link2patient');	
		//$udata['link2clinic'] = $this->input->post('link2clinic');	
		$udata['link2clinic'] = $this->input->post('clinicid');	
		$udata['type'] = $this->input->post('type');	
		if($this->input->post('type') == 'admin')
		   $udata['link2admin'] = 1;
		else
		$udata['link2admin'] = '';
		$udata['created_date'] = date('Y-m-d');
		$udata['created_by'] = 'Admin';
		if($this->input->post('type') == 'admin')
		{
		 $numrow=$this->admin_model->checkadmin_exist();
		 if(count($numrow) > '0')
			{
			
			$this->session->set_flashdata('flashMessage', 'Admin Already Exists...');			  
			redirect('admin_ctrl/adduser');
			}
		}
			$num_rows=$this->admin_model->getpassworddetails($this->input->post('userid'));
			if(count($num_rows) > 0)
		{
			$userid=$this->input->post('userid');
			 $this->session->set_flashdata('flashMessage',
			 "UserId: $userid Already Exists...");			  
			 redirect('admin_ctrl/adduser');
		}
		else
		{
			$this->admin_model->insert_userinfo($udata);            
			$this->user();
		}
	}
	function addloc()
	{
		   $name =$this->uri->segment(3);  
		   $data['name'] = urldecode($name);
		   $this->load->view('admin/addloc4clinic',$data);  
	}
   function health_history() 
   {
        //$header['js_files'] = array('js/ddb_patients_view.js');
        $header['js_files'] = array('js/admin.js');
        $this->load->view("includes/header4admin4health", $header);

        $data['query'] = $this->admin_model->getallhealth_history();
        $this->load->view("admin/health_history", $data);
        $this->load->view("includes/footer");
   } 
   function gethealth_details()
   {
       $recnum =$this->uri->segment(3);  
       //$data['row'] = $this->admin_model->gethealthdetails($recnum);
       $health_details = $this->admin_model->gethealthdetails4all($recnum);
	   $data['query']=$health_details;
       $data['link2clinic']=$this->uri->segment(4);
		foreach($health_details as $h)
		{
			   $data['clinic']=$h->clinic;
		}
       $this->load->view('admin/edithealth_details',$data);   
   }
   function updatehealth_history()
   {
		date_default_timezone_set('America/Los_Angeles');
		$link2clinic = $this->input->post('link2clinic');
        $query = $this->admin_model->gethealthdetails4all($link2clinic);
        foreach($query as $q)
		{
		   $rec=$q->subitem_recnum;
		   $recnum='subrec_'.$rec;
		   $value= $this->input->post($recnum) ? "yes" : "no";
			
		   if($value == 'no')
			$this->admin_model->deletesubitem($rec);
		}
		$this->health_history(); 
    }
	function addhealth_history()
	{
		$header['js_files'] = array('js/admin.js');
		$this->load->view("includes/header4admin4health", $header);
		$this->load->view("admin/add_healthhistory");
		$this->load->view("includes/footer");
	}
	function showgroup()
	{
	  $data['link2clinic']=$this->uri->segment(3); 
	  $data['link2group']=$this->uri->segment(4); 
	  $this->load->view('admin/showsubgroup4health',$data);  
	}
	function showgrouppos()
	{
	  $data['link2clinic']=$this->uri->segment(3); 
	  $this->load->view('admin/showgroup4health',$data); 
	}
/*	
	function getclinicdetails()
	{
        $clinic_id =$this->uri->segment(3);  
	    $arr=$this->admin_model->clinic_name($clinic_id);
		
		$clinicname = $arr[0]['name'] ;
		$arrval = $clinicname ; 
		echo $arrval;
		
		//    echo $arr->name;
	}
	/*
	function getdocdetails()
	{
        $clinic_id =$this->uri->segment(3);  
	    $docnames=$this->admin_model->doc_details($clinic_id);
		/*$list='';
		$listofdocs=array();
		if(count($docnames)>0)
		{
			//echo "<Select name='docname' id='docname'>";
			//echo "<option value=''>Select</option>" ;
			
			for($i=0;$i<count($docnames);$i++)
			{
				$rec[$i] = $docnames[$i]['recnum'] ;
				$fullname[$i]  = $docnames[$i]['fname'] ." ". $docnames[$i]['lname'] ;
			
				$list[$rec[$i]] = $fullname[$i] ;
				//echo "<option value='$rec[$i]'>$fullname[$i]</option>";	
			}
			$listofdocs = $list;
			//echo "</select>" ;
		}		
		*/
		//print_r($docnames) ;
		
		//echo json_encode($docnames) ;
		//print_r($docnames) ;
		
		//    echo $arr->name;
	//}*/	

	
	function getdocdetails()
	{
        $clinic_id =$this->uri->segment(3);  
	    $docnames   =$this->admin_model->doc_details($clinic_id);
		//$clinicname =$this->admin_model->clinic_name($clinic_id);
			
		//echo json_encode($clinicname) ;	
		echo json_encode($docnames) ;
		//print_r($docnames) ;
		
		//    echo $arr->name;
	}
	
	function getclinicdetails()
	{
        $clinic_id =$this->uri->segment(3);  
	    //$docnames   =$this->admin_model->doc_details($clinic_id);
		$clinicname =$this->admin_model->clinic_name($clinic_id);
			
		echo json_encode($clinicname) ;	
		//echo json_encode($docnames) ;
		//print_r($docnames) ;
		
		//    echo $arr->name;
	}
	
	
}
