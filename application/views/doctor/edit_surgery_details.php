<form name="formhealth_history" id="formConsent"
  class="form-horizontal2 sigPad4health" action="<?echo base_url()?>doctor_ctrl/insert_healthhistory" method="post" novalidate="novalidate">


<?php

if(!empty($query_surgery))
{
  $surgeon_name = $query_surgery->surgeon_name;
  $surgery_date = $query_surgery->surgery_date;
  $surgery_location = $query_surgery->surgery_location;
  $surgeon_contact_no = $query_surgery->surgeon_contact_no ;
  $location_contact_no = $query_surgery->location_contact_no;
  $action_taken = $query_surgery->action_taken;
  $surgery_name = $query_surgery->surgery_name;
}
else
{
  $surgeon_name = '';  
  $surgery_date = '';  
  $surgery_location= '';  
  $surgeon_contact_no = ''; 
  $action_taken = ''; 
  $surgeon_name = ''; 
  $location_contact_no = ''; 
  $surgery_name = ''; 
  
  
}

// if(!empty($query_surgerynotes))
// {
// 	 $surgery_notes1 = $query_surgerynotes->surgery_notes;
// }
// else
// {
// $surgery_notes1 = '';

// }

?>
<div class="control-group">
<label class="control-label" for="inputPassword" style='float: left;
width:350px;  padding-top: 5px;  text-align: left;'>Name of Surgery</label>
<div class="controls">
<input type="text"  name='surgery_name' id='surgery_name' placeholder="Name" value="<?= $surgery_name ?>" >
</div>
</div>  

<div class="control-group">
<label class="control-label" for="inputPassword" 
style='float: left; width:350px;  padding-top: 5px;  text-align: left;'>Surgery Date</label>
<div class="controls">
<input type="text" placeholder="Name" name ='surgery_date' id='surgery_date' value='<?= $surgery_date ?>'  >
</div>
</div>

<div class="clearfix"></div> 
<div class="control-group">
<label class="control-label" for="inputPassword">Surgeon </label>
<div class="controls">
<input type="text" placeholder="Surgeron Name" value="<?= $surgeon_name ?>" name='surgeon_name' id='surgeon_name'>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword" 
style='float: left; width:350px;  padding-top: 5px;  text-align: left;'>Surgery Contact No.</label>
<div class="controls">
<input type="text" name="surgeon_contact_no" id="surgeon_contact_no" placeholder="Name" value='<?= $surgeon_contact_no ?>'  >
</div>
</div> 



<div class="control-group">
<label class="control-label" for="inputPassword">Location</label>
<div class="controls">
<input type="text" placeholder="Location of Surgery" name='surgery_location'  id='surgery_location' value="<?= $surgery_location ?>">
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Location Contact No. </label>
<div class="controls">
<input type="text" placeholder="Location Contact No"  name='location_contact_no' id='location_contact_no' value="<?= $location_contact_no ?>">
</div>
</div>


<div class="control-group">
<label class="control-label" for="inputPassword">Action Taken </label>
<div class="controls">
<textarea rows="5" cols=20 name='action_taken' id='action_taken'>
  <?=$action_taken ?>
</textarea>
</div>
</div>


<div class="row-fluid patient_history">
<h1 style="font-weight:bold">Preparation for Surgery</h1>
<div class="clearfix"></div>

<div class="control-group">
<div class="controls">
<textarea rows="5" cols=20 name='surgery_notes1' id='surgery_notes1' style="background-color='#DFDFDF'" readonly="readonly">
  <?php 
   foreach ($query_surgerynotes as $key => $value) {
    echo $value['surgery_notes']."\n";
  }
   ?>
</textarea>
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputPassword">Please adher to the following precautions prior to Surgery </label>
<div class="controls">
<textarea rows="5" cols=20 name='surgery_notes' id='surgery_notes'>

</textarea>
</div>
</div>


</div>



<div class="btn-toolbar" style="position:relative;text-align:center">
<a class="btn btn-success btn-lg" style="padding:8px 16px" id="btnNextContact" onclick="javascript:submitpatient_view('profile2')"> 
<i class="fa fa-arrow-right" ></i> SUBMIT</a>
</div>
</li>
</ul>
</div>
</div>
</div>
</form>