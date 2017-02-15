<?
$attributes='id="newgroup_pos"';
$docnames  = 
$this->admin_model->showcond4healthdetails($link2clinic,$link2group);?>
<?php 
         echo form_dropdown('newgroup_pos',$docnames, '',$attributes);
?>
