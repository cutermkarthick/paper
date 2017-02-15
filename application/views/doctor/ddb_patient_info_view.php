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
function getpatient_info()
{
document.forms['form-horizontal120'].param.value='home1';
document.forms['form-horizontal120'].submit();
/*
window.location="<?php echo base_url();?>doctor_ctrl/getpatient_info/"+document.getElementById('recnum').value+"/"+document.getElementById('health_iss').value+'/home1';
*/
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

<div class="patients_info span5">
<ul style=" text-align:right; margin:0px 10px 0px 0px;">
 <li>
<button class="btn btn-large btn-info" type="button" onClick="javscript:getpatient_info()"> <i class="fa fa-file-text-o"></i> View Details</button>
</li>
</ul>
</div>

</div>

<div style="margin-top:30px;" class="row-fluid">
<div class="span4 patients_info">
<h1>PERSONAL INFO </h1>
<?
$dddob=explode('-', $query->dob );
$dob=$dddob[1].'-'.$dddob[2].'-'.$dddob[0];

if(empty($query))
echo "NO DATA";
else
{?>
<UL>
<LI>Cell Phone:<?= $query->cell_phone ?></LI>
<LI>Home Phone: <?= $query->home_phone ?>
<LI>Work Phone: <?= $query->work_phone ?></LI>
<LI>Date of Birth: <?= $dob ?></LI>
<LI>Email: <?= $query->email ?></LI>
</UL>
<?}?>
</div>

<div class="span4 patients_info">
<h1>PRIMARY INSURANCE INFO </h1>
<?
if(empty($insur))
  echo "NO DATA";
else
{
?>
	<UL>
	<LI>Employer: <?= $insur->name_of_insured ?></LI>
	<LI>Company :<?= $insur->insurance_company ?></LI>
	<LI>Group Id: <?= $insur->group_id ?></LI>
	<LI>Member Id: <?= $insur->member_id  ?></LI>
	</UL>
<?}?>
</div>                            


<div class="span4 patients_info">
<h1>EMERGENCY  </h1>   
<?
if(empty($emer))
  echo "NO DATA";
else
{?>                             
<UL>                                	 
<LI>Emergency Contact: <?= $emer->home_phone ?> </LI>
<LI> Emergency Cell phone:  <?= $emer->cell_phone ?></LI>
<LI> Referred By: <?= $query->referred_by ?></LI>
</UL>
<?}?>
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
