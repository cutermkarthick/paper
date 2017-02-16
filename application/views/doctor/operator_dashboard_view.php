<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 07, 2014                 =
// Filename: doctor_dashborad_view.php        =
// Copyright of Fluent Technologies            =
// Displays list of patients.                  =
//==============================================
?>
<script type='text/javascript'>
function getdashboard_val(recnum)
{
    $.ajax({
        type: 'POST',
        url: "<?echo base_url() ?>doctor_ctrl/getapp_details/"+recnum,
        success:function(response){
           $('#ajax-content-container').html(response);
        }
});
}
</script>

<div class="main-container" style="margin-top:20px;height:100%">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:3px 0px;"class="page-header">
</div>

<div class="row-fluid">
<div class="span12">
<div class="m-widget dashbord_box">
<div class="m-widget-header">

</div>
<?php

    
 
?>
<h1><center>Welcome to the Clinic</center></h1>



</section>
</div>

<!--    <div class="clearfix">
<div style="position:fixed; bottom:0px;" class="footer">

<span>Copyright &copy; 2014, Paperless Dentists. All Rights Reserved	Terms Of Use </span>

</div>
</div>
</body>
</html>-->
