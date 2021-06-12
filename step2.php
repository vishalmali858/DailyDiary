<!DOCTYPE html>
<html>
<?php   
session_start();  
if(!isset($_SESSION["user_id"]))
{  
    header("location:registration.php");  
}
else
{  
	ini_set("display_errors","on");
	error_reporting(E_ERROR);
	if(isset($_POST['submitted']))
	{ 
		$conn=mysql_connect("localhost","root","") or die("could not connect to database");
		$select_db=mysql_select_db('diary') or die("could not find database");
	    	$dob=$_POST['dob'];
		$fn=$_POST['fname'];
		$ln=$_POST['lname'];
		$one="2";
		$temp="3";
		$flag="0";
		$id=$_SESSION["user_id"];  
		$query=mysql_query("SELECT id FROM user WHERE id='$id'");
		$numrows=mysql_num_rows($query);
		if($numrows!=0)  
		{
			while($row=mysql_fetch_assoc($query))
			{
				$dbid=$row['id'];
			}
  		}
		$query2=mysql_query("SELECT i FROM user WHERE id='$dbid'");
		$numrows2=mysql_num_rows($query2);
		if($numrows2!=0)  
		{
			while($row=mysql_fetch_assoc($query2))
			{
				$di=$row['i'];
			 }
		}
		if($id==$dbid)
		{
		if($di == $temp)
		{
			$sqlinsert = "update user set dob='$dob' where id='$dbid';";
			mysql_query($sqlinsert) or die("error inserting in new record!!");
			$sqlinsert1 = "update user set fn='$fn' where id='$dbid';";
			mysql_query($sqlinsert1) or die("error inserting in new record!!");
			$sqlinsert2 = "update user set ln='$ln' where id='$dbid';";
			mysql_query($sqlinsert2) or die("error inserting in new record!!");
			$sqlinsert3 = "update user set i='$one' where id='$dbid';";
			mysql_query($sqlinsert3) or die("error inserting in new record!!");
			$flag="1";
		}
		else
		{
			$sqlinsert = "update user set dob='$dob' where id='$dbid';";
			mysql_query($sqlinsert) or die("error inserting in new record!!");
			$sqlinsert1 = "update user set fn='$fn' where id='$dbid';";
			mysql_query($sqlinsert1) or die("error inserting in new record!!");
			$sqlinsert2 = "update user set ln='$ln' where id='$dbid';";
			mysql_query($sqlinsert2) or die("error inserting in new record!!");
			$sqlinsert3 = "update user set i='$one' where id='$dbid';";
			mysql_query($sqlinsert3) or die("error inserting in new record!!");
			$flag="1";
		}  
		} 
		if($flag=="1")
		{
			session_start();  
   			$_SESSION['user_id']="$dbid";
    			header("Location:step3.php");
			exit(); 
		}
	}  
}  
?>
<head>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<title>
	DAILY_DAIRY-Register User
</title>
<script>
function validate()
{
	var fname1=document.f1.fname.value;
	var lname1=document.f1.lname.value;
	var dob = document.getElementById("DOB").value;
	if(dob=="")
	{
		alert("PLEASE ENTER THE DATE OF BIRTH");
		return false;
	}
	if(fname1=="")
	{
		alert("Please enter the first name");
		return false;
	}
	if(fname1.length<=2 || fname1.length>16)
	{
		alert("First Name should be between 2 & 16 characters");
		return false;
	}
	if(lname1=="")
	{
		alert("Please enter the Last name");
		return false;
	}
	if(lname1.length<=2 || lname1.length>16)
	{
		alert("Last Name should be between 2 & 16 characters");
		return false;
	}
}
</script>
</head>
<body style=background-image:url("e2.jpg")>
	<div class="loginForm">
		<div class="head">
			<center><img src="logo.png"  width="150" height="100"><br><br>
			<b><font color="blue" size="5" face="verdana">USER REGISTER:<br><font color="black" size="3">STEP 2 OUT OF 3</font></font></b></center>
		</div>
		<br><br><br><br><br><br><br><br>
		<form name="f1" class="form1" method="post" target="Login" onSubmit="return validate()">
		<input type="hidden" name="submitted" value="true"/>
		<font color="black" size="5" face="verdana">
		FIRST NAME:<br><input type="text" name="fname" placeholder="First name"><br><br>
		Last Name:<br><input type="text" name="lname" placeholder="Last Name"><br><br>
		DATE OF BIRTH:<br><input type="date"  id="DOB" name="dob" placeholder="Date Of Birth"><br><br></font>
		<center><input type="submit" value="NEXT"></center>
		</form>
	</div>
	</div>	
</body>
</html>