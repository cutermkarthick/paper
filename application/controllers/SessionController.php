<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 30, 2014                 =
// Filename: sessionController.php             =
// Copyright of Fluent Technologies            =
// Check userid available or not,if not it will redirect to login page                                           =
//==============================================

if($this->session->userdata('userid') == '')	
{
		     redirect('/login','refresh');
}
?>
