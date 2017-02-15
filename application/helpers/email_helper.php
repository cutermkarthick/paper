<?php

function sendMail()
{
	echo "REAched" ;
    $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => 'udayaprabhu123@gmail.com', // change it to yours
  'smtp_pass' => 'Uhgar***123', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
);

      $message = '';
      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
      $this->email->from('udaya@abaq.us'); // change it to yours
      $this->email->to('udayaprabhu123@gmail.com');// change it to yours
      $this->email->subject('Resume from JobsBuddy for your Job posting');
      $this->email->message($message);
      if($this->email->send())
     {
      echo 'Email sent.';
     }
     else
    {
     show_error($this->email->print_debugger());
    }


}
?>