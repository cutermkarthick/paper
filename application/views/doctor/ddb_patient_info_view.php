<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 06, 2014                 =
// Filename: ddb_patient_info_view.php         =
// Copyright of Fluent Technologies            =
// Displays patient information                =
//==============================================
?>
<script type='text/javascript'>
function getpatient_info(app_recnum)
{

    document.forms['form-horizontal120'].param.value='gp1';
    document.forms['form-horizontal120'].app_recnum.value=app_recnum;
// document.forms['form-horizontal120'].submit();
    
    
    $.ajax(
     {
       type: 'POST',
        url: "<?php echo base_url();?>doctor_ctrl/getpatient_info/",
        success:function(response)
        {
           $('#app_details').html(response);
        }
     });

}
function getnextpage()
{ 
document.forms['form-horizontal120'].param.value='dropdown1';
document.forms['form-horizontal120'].submit();
/*
window.location="<? echo base_url();?>doctor_ctrl/getpatient_info/"+document.getElementById('recnum').value+"/"+document.getElementById('health_iss').value+"/dropdown1";   
*/
}
var message="Sorry, right-click has been disabled!";

    function clickIE4(){
    if (event.button==2){
        alert(message);
        return false;
        }
    }

    function clickNS4(e){
        if (document.layers||document.getElementById&&!document.all){
            if (e.which==2||e.which==3){
                alert(message);
                return false;
                }
            }
        }
        if (document.layers){
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown=clickNS4;
            }
        else if (document.all&&!document.getElementById){
            document.onmousedown=clickIE4;
        }
        document.oncontextmenu=new Function("alert(message);return false");

</script>	
<div class="main-container">
<div class="container-fluid">
<section>
<div style="margin-top:10px;" class="row-fluid">
<div class="m-widget-header">
<div class="span12 sub_title">
<h1> Patients info   </h1>
</div>
</div>
</div>	

<?
$attr=array('class' => 'form-horizontal120','name' => 'form-horizontal120');
echo form_open('doctor_ctrl/getpatient_info',$attr);
?>
<input type='hidden' name='param' id='param' value=''>
<input type='hidden' name='app_recnum' id='app_recnum' value=''>

<div style="margin-top:9px;" class="row-fluid">
<div class="span9 m-widget">
<div class="row-fluid">
<div class="span2">
<div class="patients_pic">
<?
echo '<img id="img_switcher"  src="'.$query->img_location.'">';
?>
</div>
</div>

<div class="patients_info span5">
<h1 style=" margin-bottom:10px;"><?=$query->fullname ?></h1>
<p> Name: <?= $query->fullname ?></p>
<p> Address: <?= $query->addr1 ?></p>
<p> <?= $query->addr2 ?></p>
<p> <?= $query->city .' '.$query->state." ,". $query->zip ?></p>
</div>

<!-- <div class="patients_info span5">
<ul style=" text-align:right; margin:0px 10px 0px 0px;">
 <li>
<button class="btn btn-large btn-info" type="button" onClick="javscript:getpatient_info()"> <i class="fa fa-file-text-o"></i> View Details</button>
</li>
</ul>
</div> -->

</div>

<div style="margin-top:30px;" class="row-fluid">

    <div class="row-fluid">
<table class="table table-bordered patient_table" style="table-layout: fixed;width:100% !important;" id='csample'>
<thead style="width:100%; background:#43B5CB; color:#FFF;">
<tr>
<th>Seq #</th>
<th>Appt Date</th>
<th>Appt Time </th>
<th>Appt Duration</th>
<th>Status</th>
<th>Doctor</th>
</tr>

</thead>
</table>


<div width='100%' style="height:120px; overflow-x:hidden;overflow-y:scroll;border:;margin-top:-20px;width:100% !important;" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody style="width:100%;">
<input type='hidden' name='val' id='val' value=''>

<?php
    if (isset($app_lists))
    {  
        $i=1;                                             
        foreach($app_lists as $k=>$app) 
        {

        ?>

            <tr>     

            <th><a href="javascript:void(0);" onclick="javscript:getpatient_info('<?php echo $app["recnum"];?>')"><?php echo $i;?></a></th>
            <th><?php echo $app['appt_date'];?></th>
            <th><?php echo $app['appt_time'];?></th>
            <th><?php echo $app['appt_duration'];?></th>
            <th><?php echo $app['status'];?></th>
            <th><?php echo $app['doctor'];?></th>
            <input type='hidden' name="recnum<?= $i ?>" id="recnum<?= $i ?>"  
            value="<?php echo $app['recnum']; ?>">
            </tr>  

        <? $i++;
        }
    }
?>

</tbody>
</table>
</div>



</div>

</div>                        


</div>
<div style="background:#eee;" class="span3 m-widget">
		 
<ul class="patients_rightnav">
<?
if($this->session->userdata('msg_leftnav') != '')
{?>
<li>
<button class="btn btn-large btn-info" type="button" onclick='location.href="<?php echo base_url();?>doctor_ctrl/messages"'>  <i class="fa fa-envelope-o"></i>   Send Message  </button>
</li>    
<?}?> 

<li>
<button class="btn btn-large btn-warning" type="button" onClick="javscript:getnextpage()"> <i class="fa fa-exclamation-triangle" ></i> Medical Alert  </button>									</li>

<li>
<button class="btn btn-large btn-info" type="button"> <i class="fa fa-stethoscope"></i>  Refer Patient  </button>									
</li> 

</ul>






<div class="clearfix"> </div>
<div class="patients_social" id='patients_social'>
<a href="#"><i class="fa fa-tumblr"></i> </a> 

<a href="#"> <i class="fa fa-facebook"></i> </a> 


<a href="#"><i class="fa fa-twitter"></i></a> 

<a href="#"><i class="fa fa-google-plus"></i> </a>  

</div>
</div>

</div>

    <div id="app_details"> 
        
    </div>

</section>
</div>
<input type='hidden' name='recnum' id='recnum' value="<?echo $query->recnum ?>">
</div>
<div class="clearfix">
<div style="position:fixed; bottom:0px;" class="footer">

<span>Copyright &copy; 2017, Fluentsoft Technologies. All Rights Reserved   Terms Of Use </span>

</div>
</div>
<?
foreach($health as $key =>$h)
{
if($h == 'yes' && $key != 'under_physician_care')
{
echo "<input type='hidden' name='health_iss' id='health_iss' value='$key'>";
break;
}
}
?>
</form>
</body>
</html>
