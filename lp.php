<!DOCTYPE html>
<html>
<?php
session_start();  
if(!isset($_SESSION["user_id"]))
{  
    header("Location:demo1.php");
	exit();  
}
else
{
	ini_set("display_errors","on");
	error_reporting(E_ERROR);
	if(isset($_POST['submitted']))
	{
		if(!empty($_POST['password']))
		{
	$conn=mysql_connect("localhost","root","") or die("could not connect to database");
	$select_db=mysql_select_db('diary') or die("could not find database");
    	$pwd=$_POST['password'];    
	$sid=$_SESSION["user_id"];
	$flag1="0";
    	$query=mysql_query("SELECT id FROM user Where id='$sid'");
	$numrows=mysql_num_rows($query);
	if($numrows!=0)  
    	{  
    		while($row=mysql_fetch_assoc($query))  
    		{
			$dbid=$row['id'];
		}
	}
	$query1=mysql_query("SELECT pwd FROM user WHERE id='$dbid'");
	$numrows1=mysql_num_rows($query1);  
    	if($numrows1!=0)  
    	{  
		while($row=mysql_fetch_assoc($query1))
		{  
    			$dbpwd=$row['pwd'];
		}  
    	}  
    	if($pwd == $dbpwd && $sid == $dbid)  
    	{
   		session_start();  
    		$_SESSION['user_id']="$dbid";   
    		header("Location:demo.php");
		exit();  
    	}
	else
	{  
		$flag1="1";
 	}
	}
	}  
  
}
?>
<head>
<title>DAILY DIARY</title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<script>
	function CP(it)
	{
		var pa=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?=.*[!@#\$%\^&\*])(?!.*\s).{10,20}$/;
		if(it.value.match(pa))
		{
			return true;
		}
		else
		{
			alert("ENTER YOUR PASSWORD CORRECTLY !!(Password with more than 10 character which includes atleast{'1 to 9'},atleast one{'a to z'},atleast one{'A to Z'},atleast one{'@,$,&,Symbols'})");
			return false;
		}
	}
</script>
</head>
<body>
	<div class="loginForm">
		
		<div class="head">
			<img src="logo.png"  width="150" height="100" align="left"><br><br><br>
			<font color="blue" size="5" face="verdana">USER LOGIN</font>
		</div>
		<br><br><br><br>
		<form name="f1" class="form1" onSubmit="return CP(document.f1.password)" method="post" target="_top">
		<input type="hidden" name="submitted" value="true"/>
				<font color="green" size="5"><b>PASSWORD:</b></font><br><br><br>
				<input type="password" name="password" placeholder="PassworD">
				<center><input type="submit" value="LOGIN" ></center>
			<?php if($flag1=="1")
				{
					echo "<font color=red size=5>INVALID PASSWORD</font>";
				}
			?>
			<div style="margin-top:5%">
				<a href="forgetPass.php"><label>FORGET PASSWORD/PIN</label></a><br>
				
				<p>(RESET YOUR PASSWORD OR PIN HERE)</p>
			</div>
		</form>
		</div>
	</div>
<!--//End-login-form-->
</body>
</html>-
