<?
//==============================================
// Author: FSI                                 =
// Date-written = Jan 20, 2015                 =
// Filename: patient_dashborad_view.php        =
// Copyright of Fluent Technologies            =
// Displays list of patients.                  =
//==============================================
?>
<script type='text/javascript'>

function getparam_value(param)
{
  document.forms['form-hor150'].param.value=param;
  document.forms['form-hor150'].submit();
}

/*
function getparam_value(param)
{


//updated on 27 march 2015

document.getElementById('param').value=param;
if(param!='familymember' && param!='dental_history')
{
	document.getElementById('param1').value=param;
	document.forms['form-horizontal130'].submit();
}
else
{
	document.forms['form-hor150'].submit();
}
}
*/
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

<?php 

// 	echo "<pre>";
// print_r($query); exit;

?>

<div style=" border:0px; margin:10px 0px;"class="sub_title row-fluid">
<div class="span6"> <h1>Welcome to <?php echo $query->fullname ?> </h1></div> 

<div class="row-fluid">

<div class="span9">
<div class="m-widget dashbord_box">
<div class="row-fluid">
<div class="span2">
<div class="patients_pic">
<?

if (!empty($query->img_location)) 
{
	echo '<img id="img_switcher"  src="'.$query->img_location.'">';
}
else
{ ?>
	
	<img src="<?php echo base_url();?>img/profile_pic.png" id="img_switcher">
<?php
}?>
</div>
</div>
<!-- http://localhost/paperless/img/profile.jpg -->
<!---------------------changed on march 27 2015 ------------------------------------->

<?
$attr1 = array('class' => 'form-hor150','name'=>'form-hor150','id'=>'form-hor150');
echo form_open_multipart('patient_ctrl/update_profile', $attr1);
?>
<input type='hidden' name='param' id='param' value=''>
</form>


<?php
$attr=array('class' => 'form-horizontal2','id'=>'form-hor150','name'=>'form-hor150');
echo form_open_multipart('patient_ctrl/update_profile',$attr);
?>
<input type='hidden' name='param' id='param' value=''>
<input type='hidden' name='base_url' id='base_url' value="<?php echo base_url (); ?>">

</form>


<?
$attr=array('class' => 'form-horizontal2','id'=>'form-horizontal130','name'=>'form-horizontal130');
echo form_open('patient_ctrl/update_patient',$attr);
?>

<input type='hidden' name='param' id='param1' value=''>
<div style=" float:left; margin:0px 0px 0px 10px;" class="patients_info span5">
<?php
    if (count($query) > 0)
    {
		echo "<p> Name :". $query->fullname."</p>";
		echo "<p> Address:". $query->addr1,' ',$query->addr2."</p>";
		echo "<p> City : ".$query->city."</p>";
		echo "<p> State :". $query->state."</p>";
		echo "<p> Zip : ".$query->zip."</p>";
	}
else
{
	
}	
?>
<!--<p><a href="#?">Updates </a></p>-->
</div>
<?
date_default_timezone_set('America/Los_Angeles');
$z=1;
if(!empty($history))
{
$rec_appt = '';
$next_appt = '';

	foreach($history as $h)
	{
	  if($z== 1)
	  {
		$next_apt=$h->appt_date;
		if($next_apt != '' &&  $next_apt != '0000-00-00' )
		{
		$d=substr($next_apt,8,2);
		$m=substr($next_apt,5,2);
		$y=substr($next_apt,0,4);
		$x=mktime(0,0,0,$m,$d,$y);
		$next_appt=date("M j, Y",$x);
		}
	  $z++;
	  }
	else
	{
	  $rec_apt=$h->appt_date;
	  if($rec_apt != '' &&  $rec_apt != '0000-00-00' )
		{
		$d=substr($rec_apt,8,2);
		$m=substr($rec_apt,5,2);
		$y=substr($rec_apt,0,4);
		$x=mktime(0,0,0,$m,$d,$y);
		$rec_appt=date("M j, Y",$x);
		}
	}
	}
?>
<div style=" float:right; margin:15px 20px 0px 10px;">
<p>My Recent Visit  :<?= $rec_appt ?> </p> 
<p>Next Appointment: <?= $next_appt ?></p>
</div>
<?}?>

</div>

<div style="margin-top:30px;" class="row-fluid">
<div class="span4 patients_info">
<h1>My Dentist :   </h1>
<UL>
<?php
    if (count($query) > 0)
    {
  	  echo "<LI>".$query->docname."</LI>";
	  echo "<LI>".$query->clinicname."</LI>";
	  echo "<LI>".$query->clinicphone."</LI>";
  }
  else
  {
	  
	  
  }
?>
<!--   <LI>Dr Smile </LI>
   <LI> Smiles Dental </LI>
	<LI>SmilesWay </LI>-->
   <LI><?php echo $query->docaddr;?> </LI>
   <LI> Phone : <span><?php echo $query->docphone; ?> </span></LI>
   <LI> Email: <span> <?php echo $query->docemail; ?></span>  </LI>
	<LI>Office Hours : M-F 10 am - 2pm</LI> 


</UL>
</div>

<div class="span4 patients_info">
<h1>Insurance Details  </h1>
<UL>

<?php
    if (count($query1) > 0)
    {
	  echo "<LI>".$query1->insurance_company."</LI>";
	  echo "<LI>".$query1->group_id."</LI>";
	  echo "<LI>".$query1->member_id."</LI>";
	}
	else
	{
	  echo "<LI></LI>";
	  echo "<LI></LI>";
	  echo "<LI></LI>";
		
	}
?>


</UL>
</div>


<div class="span4 patients_info">
<h1>EMERGENCY  </h1>

<UL>
<?php
    if (count($query2) > 0)
    {
	  echo "<LI>".$query2->fname.' '.$query->middle_initial.' '.$query->lname."</LI>";
	  
	  echo "<LI>".$query2->addr1.', '.$query->city.', '.$query->state."</LI>";
	  echo "<LI>".$query2->cell_phone."</LI>";
	}
else
{
	 echo "<LI></LI>" ;
	 echo "<LI></LI>" ;
	 echo "<LI></LI>" ;
	
}	
?>

	    <LI> Referred By: <?= $query->referred_by?></LI>
		<LI>Referred To: </LI>

</UL>
</div> 
</div>
<div style="margin-top:8px;" class="row-fluid"> <hr></div>
<div class="clearfix"> </div>
</div>

</div>

<div class="span3 m-widget">

<ul class="patients_rightnav">
<?
if($this->session->userdata('appts_leftnav') != '')
{?>
<li>
<button onclick=" location.href='<?php echo base_url();?>patient_ctrl/appointments' " type="button" class="btn btn-large btn-info"> <i class="fa fa-file-text"></i>Request Appointment   </button>
</li>
<?}
if($this->session->userdata('msg_leftnav') != '')
{?>
<li>
 <button onclick=" location.href='<?php echo base_url();?>patient_ctrl/messages'" type="button" class="btn btn-large btn-info"> <i class="fa fa-file-text"></i>   Send Message  </button>											
</li>
<?}?> 
</ul>


<div class="clearfix"> </div>

<br>

<ul class="patients_rightnav">

<li>
<button onclick="javascript:getparam_value('gp1')"   class="btn btn-large btn-info" type="button"> <i class="fa fa-refresh"></i>General Practise</button>
</li>

<li>
<button onclick="javascript:getparam_value('surgery1')"  type="button" class="btn btn-large btn-info"> <i class="fa fa-refresh"></i>Surgery</button>
</li>

<li>
<button onclick="javascript:getparam_value('postsurgery1')"  type="button" class="btn btn-large btn-info"> <i class="fa fa-refresh"></i>Post Surgery</button>
</li>

<li>
<button onclick="javascript:getparam_value('home1')"   class="btn btn-large btn-info" type="button"> <i class="fa fa-refresh"></i>Personal Info</button>
</li>

<li>
<button onclick="javascript:getparam_value('profile1')"  type="button" class="btn btn-large btn-info"> <i class="fa fa-refresh"></i>Emergency Info</button>
</li>

<li>
<button onclick="javascript:getparam_value('dropdown11')"  class="btn btn-large btn-info" type="button"><i class="fa fa-refresh"></i>Health History</button>											
</li>

<li>
<button onclick="javascript:getparam_value('dropdown21')"   class="btn btn-large btn-info" type="button"><i class="fa fa-refresh"></i>Insurance Info</button>											
</li>
<li>
<button onclick="javascript:getparam_value('familymember')"  class="btn btn-large btn-info" onclick=" location.href='profile.html#familymember'" type="button" ><i class="fa fa-refresh"></i> Family Member</button>
</li>

</ul>


<div class="clearfix"> </div>
<div class="patients_social">

<a href="http://facebook.com/fluentsoftinc" target="_blank"> <i class="fa fa-facebook"></i> </a> 


<a href="http://twitter.com/fluentsoftinc" target="_blank"><i class="fa fa-twitter"></i></a> 

</div>

</div>
</div>    


</form>


</section>
</div>
</div>

<!--    <div class="clearfix">
<div style="position:fixed; bottom:0px;" class="footer">

<span>Copyright &copy; 2014, Paperless Dentists. All Rights Reserved	Terms Of Use </span>

</div>
</div>
</body>
</html>-->
