<?
//==============================================
// Author: FSI                                 =
// Date-written = Feb 04, 2015                 =
// Filename: user_type4doctor.php             =
// Copyright of Fluent Technologies            =
// Based on the user type ,the page will redirecting to login(if we login as patient without logout ,if we login as doctor ,the controll will move to login )                      =
//==============================================

if($this->session->userdata('user_type') != 'admin')
{
$this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
redirect('login');
}
?>
