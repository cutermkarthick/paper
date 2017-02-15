<?php
//==============================================
// Author: FSI                                 
// Date-written = Dec 01, 2014                 
// Filename: doctor_ctrl.php                   
// Copyright of Fluent Technologies            
// Employee controller                       
//==============================================

class Employee extends CI_Controller
{ 
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('text');
        $this->load->model('doctor_model');
    } 
    function index()
    {
	    $pdata['TotalRec'] = $this->doctor_model->TotalEmp();
	    print_r($pdata);
        $pdata['perPage']     =$this->perPage();
        $pdata['ajax_function']    = 'employee_ajax';
 
        $subdata['paging']     = $this->parser->parse('paging', $pdata, TRUE);
        $subdata['all_employees']     = $this->doctor_model->all_employees($this->perPage());
 
        $data['body_content']     = $this->parser->parse('employee_list', $subdata, TRUE);    
        print_r($data); 
        $this->load->view('home',$data);        
    } 
    function employee_ajax()
    {
         $pdata['TotalEmp'] = $this->EmployeeModel->TotalEmp();
         $pdata['perPage']  = $this->perPage();
 
         $pdata['ajax_function'] =  'employee_ajax';
 
         $data['paging'] =  $this->parser->parse('paging', $pdata, TRUE);
         $data['all_employees'] = $this->EmployeeModel->all_employees($this->perPage());
 
         $this->load->view('employee_list',$data);
    }
 
    function PerPage()
    {
        return 5;
    }
 
}
