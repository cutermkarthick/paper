<style>
.black_overlay
{
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1050;

	-moz-opacity: 0.7;
	opacity:.70;
	filter: alpha(opacity=70);
}
.white_content
{
	position: absolute;
	top: 25%;
	left: 25%;
	width: 50%;
	height: 50%;
	padding: 10px;
	background-color: white;
	z-index:1051;
	overflow: auto;
}
.white_content1 
{
	position: absolute;
	top: 8%;      
	width: 95%;
	height: 80%;
	background-color: white;
	z-index:1051;
	overflow: auto;
}
#close
{
     float:right;
}
</style>
<div>
<?php 
$attach=$_GET['attach'];
$base=$_GET['base'];
?>

<div id="light" class="white_content"><img class="white_content1" src=<?php echo $base."/application/attachments/".$attach;?>>
<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" id="close">Close</a>
</div>
    <div id="fade" class="black_overlay"></div>
</div>
