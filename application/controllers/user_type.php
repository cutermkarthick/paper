<?
if($this->session->userdata('user_type') != 'patient')
{
$this->session->set_flashdata('flashMessage', 'You are not Authorized to view this page ...');			  
redirect('login');
}
?>
