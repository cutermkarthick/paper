<?php
//==============================================
// Author: FSI                                 
// Date-written = Dec 01, 2014                 
// Filename: doctor_ctrl.php                   
// Copyright of Fluent Technologies            
// Patient Model                      
//==============================================

class EmployeeModel extends CI_Model
{
     function __construct() {
        parent::__construct();
//        $this->_ci =& get_instance();
    }
 
    function TotalEmp()
    {$this->load->database();
      $sql = "SELECT * FROM patient_info";
          $query = $this->db->query($sql);
          return $query->num_rows();
       }
 
    function all_employees($perPage)
    {
        $offset = $this->getOffset()
        $query ="SELECT * FROM  patient Order By recnum Desc LIMIT ".$offset.", ".$perPage;
        $q = $this->db->query($query);
        return $q->result();
    }
 
    function getOffset()
    {
        $page = $this->input->post('page');
        if(!$page):
        $offset = 0;
        else:
        $offset = $page;
        endif;
        return $offset;
    }
}
?>
