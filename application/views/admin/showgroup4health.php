<?
$attributes='id="group_pos"';
$docnames  = 
$this->admin_model->getgroup4healthdetails($link2clinic,'sorting');?>
<?php 
         echo form_dropdown('group_pos',$docnames, '',$attributes);
?>
