<!DOCTYPE html>
<html>
<?php
ini_set("display_errors","on");
error_reporting(E_ERROR);
if(isset($_POST['submitted']))
{
	if(!empty($_POST['username']))
	{
	$conn=mysql_connect("localhost","root","") or die("could not connect to database");
	$select_db=mysql_select_db('diary') or die("could not find database");
    	$user=$_POST['username']; 
	$flag1="0";   
    	$query=mysql_query("SELECT id FROM user Where un='$user'");
	$numrows=mysql_num_rows($query);
	if($numrows!=0)  
    	{  
    		while($row=mysql_fetch_assoc($query))  
    		{
			$dbid=$row['id'];
		}
	}
	$query1=mysql_query("SELECT un FROM user WHERE id='$dbid'");
	$numrows1=mysql_num_rows($query1);  
    	if($numrows1!=0)  
    	{  
		while($row=mysql_fetch_assoc($query1))
		{  
    			$dbusername=$row['un'];
		}  
    	}  
    	if($user == $dbusername)  
    	{
   		session_start();  
    		$_SESSION['user_id']=$dbid;   
    		header("Location:lp.php");
		exit();  
    	}
	else
	{  
		$flag1="1";
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
function validate()
{
		var un=document.form1.username.value;

	var atpos=un.indexOf("@");
		var dotpos=un.lastIndexOf(".");
		var flag=0;
		if(un=="")
		{
			alert("ENTER USERNAME CREDENTAILS");
			return false;
		}
		for(i=0;i<=un.length;i++)
		{
			if(un.charAt(i)=='@')
			{
				flag++;
			}
		}
		if(atpos<1 || dotpos<atpos || (dotpos-atpos)<5)
		{
			alert("Enter a valid Email-Id");
			return false;
		}
		if(flag>1)
		{
			alert("Only 1 @ should be present");
			return false;
		}
}

</script>
</head>
<body>
	<div class="loginForm">
		<div class="head">
			<img src="logo.png"  width="150" height="100" align="left"><br><br><br>
			<b><font color="blue" size="5" face="verdana">USER LOGIN</font></b>
		</div>
		<br><br><br><br><br>
		<form name="f1" class="form1" onSubmit="return validate()" method="post" target="Login">
		<input type="hidden" name="submitted" value="true"/>
				<font color="green" size="5"><b>USERNAME:</b></font><br><br><br>
				<input type="text"  name="username" placeholder="EMAIL_ID"><br>
				<?php if($flag1=="1")
				{
					echo "<font color=red size=5><marquee>INVALID USERNAME</font></marquee>";
				}
				?>
				<center><input type="submit" value="LOGIN"></center>
	
			<div style="margin-top:5%">
				<a href="forgetPass.php" target="Login"><label>FORGET PASSWORD/PIN</label></a><br>
				<p>(RESET YOUR PASSWORD OR PIN HERE)</p>
				<a href="registration.php" target="Login"><label>NEW USER ?</label></a>
			</div>
		</form>
		</div>
	</div>
<!--//End-login-form-->
</body>
</html>
