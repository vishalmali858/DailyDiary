<!DOCTYPE html>
<html>
<?php   
session_start();  
if(!isset($_SESSION["user_id"]))
{  
    header("Location:demo3.php");
	exit();  
}
else
{  
	ini_set("display_errors","on");
	error_reporting(E_ERROR);
	if(isset($_POST['submitted']))
	{
		$conn=mysql_connect("localhost","root","") or die("could not connect to database");
		$select_db=mysql_select_db('diary') or die("could not find database");
		$m =$_POST['mood'];
		$id=$_SESSION["user_id"];
		$flag="1";
	echo "$id<br>$m";
	$sqlinsert = "update user set m='$m' where id='$id';";
	mysql_query($sqlinsert) or die("error inserting in new record!!");
	if($flag=="0")
	{
		header("Location:demo1.php");
		echo "ENTER VALUES AGAIN";
		exit();
	}
	else
	{
		header("Location:demo3.php");
		exit();
	}
}
}  
?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,intial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<script>
$(document).ready(function(){        
   $("#myModal").modal();
    }); 
</script>
<script>
function validate()
{
	if((document.f1.mood[0].checked==false)&&(document.f1.mood[1].checked==false)&&(document.f1.mood[2].checked==false)&&(document.f1.mood[3].checked==false)&&(document.f1.mood[4].checked==false)&&(document.f1.mood[5].checked==false))
	{
		alert("PLEASE SELECT YOUR MOOD");
		return false;
	}
	
}
</script>
</head>
<body style=background-image:url("d12.jpg")>
  <div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><center><img src="logo.png" width="150" height="100"></center></h4>
	<b><font color="blue" size="5" face="verdana">ALL ABOUT TODAY</font></b>
      </div>
      <div class="modal-body">
        <form name="f1" onSubmit="return validate()" method="post" target="_top">
	<input type="hidden" name="submitted" value="true"/>
		<b> <font size="5" color="black">HOW IS YOUR MOOD TODAY:</font><font size="3" color="red"><br>(WILL BE ASKED WHEN YOU ACCESS YOUR DIARY TOMORROW)</font>
			<div class="mood">
				<label><img src="happy.png" width="80" height="80"><input type="radio" name="mood" value="1">HAPPY
				<img src="sad.png" width="80" height="80"><input type="radio" name="mood" value="2">SAD
				<img src="Tired.png" width="80" height="80"><input type="radio" name="mood" value="3">TIRED<br><br>
				<img src="Love.png" width="80" height="80"><input type="radio" name="mood" value="4">LOVED
				<img src="Angry.png" width="80" height="80"><input type="radio" name="mood" value="5">ANGRY
				<img src="Fun.png" width="80" height="80"><input type="radio" name="mood" value="6">FUNNY</label>
			</div></b>
		<center><input type="Submit" value="SAVE">
			<a href="home.php"><input type="button" value="WRITE MORE"></a></center>
	</form>
      </div>
      
    </div>

  </div>
</div></body>
</html>

