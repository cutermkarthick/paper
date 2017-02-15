<?php class Cron extends CI_Controller 
{
 
    function __construct()
    {
        parent::__construct();
 	$this->load->model('smtp_model');
	$this->load->helper('date');

        // this controller can only be called from the command line
        //if (!$this->input->is_cli_request()) show_error('Either direct access is not allowed or you are not authorized');
    }
 
    function sendreminders($rem = 'executing')
    {
        echo $rem;
	$this->load->view('smtpfns');
	$this->smtp_model->appreminder();
	$this->smtp_model->bdayreminder();
    }
}


