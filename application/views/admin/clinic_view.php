<?
//==============================================
// Author: FSI                                 =
// Date-written = Dec 09, 2014                 =
// Filename: clini_view.php                    =
// Copyright of Fluent Technologies            =
// Displaying all clinic                      =
//==============================================
?>
<script type='text/javascript'>
function getajaxdetails(recnum)
{
  $.ajax({
        type: 'POST',
        url: "<?php echo base_url();?>admin_ctrl/getclinic/"+recnum,
        success:function(response){
           $('#ajax-content-container').html(response);
        }
    });
}
function getlocdetails(recnum)
{
  $.ajax({
        type: 'POST',
        url: "<?php echo base_url();?>admin_ctrl/addloc/"+recnum,
        success:function(response){
           $('#ajax-content-container').html(response);
        }
});
}
</script>

<style>
.container{
			width: 'auto';
			margin: 0 auto;
		}
		ul.tabs{
			margin: 0px;
			padding: 0px;
			list-style: none;
		}
		ul.tabs li{
			background: none;
			color: #222;
			display: inline-block;
			padding: 10px 15px;
			cursor: pointer;
		}

		ul.tabs li.current{
			background: #ededed;
			color: #222;
		}

		.tab-content{
			display: none;
			background: #ededed;
			padding: 15px;
		}

		.tab-content.current{
			display: inherit;
		}
.main-container {height: auto !important;}
</style>
<div class="main-container" style="margin-top:20px">
<div class="container-fluid">
<section>
<div style=" border:0px; margin:3px 0px;"class="page-header">

</div>

<div class="row-fluid">
<div class="m-widget dashbord_box" >
<!--
<div class="m-widget-header" style="padding:0px">
<h3>
<button id='search' style="width:7%;float:right;" class="btn btn-info" type="button" 
onclick="window.location='<?php echo base_url()?>admin_ctrl/addclinic' "> 
<i></i>NEW</button>
</h3>
</div> -->

<div class="row-fluid patient_history">
<?php
$attributes = array('class' => 'form-horizontal_4', 'name'=>'form-horizontal_4','id' => 'listappts', 'style' => 'padding-top:0px;');
echo form_open('admin_ctrl/index', $attributes);
?>
<div style="margin-top:0px;" class="control-group">
<div class="controls" style='margin-left:0px'>

</div>             
</div>   

<table class="table patient_table" style="table-layout: fixed" id='csample'>
<tr>
<td>

<table class="table table-bordered patient_table" style="table-layout: fixed;width:98.8% !important;" id='csample'>
<tr style=" background:#39F; color:#FFF;">
<th width='20%' style="border:1px #ccc solid;color:white">Name</td>
<th width='20%' style="border:1px #ccc solid;color:white">Location</td>
<th width='15%' style="border:1px #ccc solid;color:white">Phone</td>
<th width='15%' style="border:1px #ccc solid;color:white">City</td>
<th width='15%' style="border:1px #ccc solid;color:white">State</td>
<th width='10%' style="border:1px #ccc solid;color:white">Status</td>
</tr>
</table>
<div width='100%' style="height:200px; overflow-x:hidden;overflow-y:scroll;
margin-top:-20px;border: 1px solid #CCC" id="dataList">
<table  class="table table-bordered patoent_table"  style="table-layout: fixed;width:100%" >
<tbody>
<?php   
$prevname='';
foreach($query as $row)
{
echo "<tr>";
if($row->name !=  $prevname || $prevname == '')
echo "<td width='20%' style='border:1px #ccc solid;' nowrap><a href='#' onclick='getajaxdetails($row->recnum)'>$row->name
<img src=".base_url()."img/loc.jpeg height=25 onclick='getlocdetails(\"$row->name\")' ></img></td>";
else
echo "<td width='20%'style='border:1px #ccc solid;'>&nbsp;</td>";

echo "<td width='20%' style='border:1px #ccc solid;'>$row->site_id</td>";
echo "<td style='border:1px #ccc solid;' width='15%'>$row->phone</td>";
echo "<td style='border:1px #ccc solid;' width='15%'>$row->city</td>";
echo "<td style='border:1px #ccc solid;' width=15%'>$row->state</td>";
echo "<td style='border:1px #ccc solid;' width='10%'>$row->status</td>";
echo "</tr>";
$prevname=$row->name;
}?>	

</tbody>

</table>
</div>

</td></tr>
</table>

<input type='hidden' name='base_url' id='base_url' value="<?echo base_url() ?>">
<div id='ajax-content-container'>
</div>

</div>    
</section>
</div>
</div></div></div>
<div class="clearfix">
<div style="position:fixed; bottom:0px;" class="footer">

<span>Copyright &copy; 2017, Fluentsoft Technologies. All Rights Reserved	Terms Of Use </span>

</div>
</div>
</body>
</html>
