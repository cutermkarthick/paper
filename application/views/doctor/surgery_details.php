<script src="<?echo base_url()?>js/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="<?echo base_url()?>css/style.css" />

<link rel="stylesheet" href="<?echo base_url()?>signature-pad/build/jquery.signaturepad.css">
<script src="<?echo base_url()?>signature-pad/build/flashcanvas.js"></script>
<script src="<?echo base_url()?>signature-pad/build/json2.min.js"></script>
<script src="<?echo base_url()?>signature-pad/jquery.signaturepad.js"></script>
<script src="<?echo base_url()?>signature-pad/build/jquery.signaturepad.min.js">
</script>

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
<input type="text" placeholder="Name" name ='surgery_date' id='surgery_date' style="background-color='#DFDFDF'" readonly="readonly" value='<?= $surgery_date ?>'  >
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
   foreach ($surgery_notes as $key => $value) {
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