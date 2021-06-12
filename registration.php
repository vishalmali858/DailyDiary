<!DOCTYPE html>
<html>
<?php         
ini_set("display_errors","on");
error_reporting(E_ERROR);
if(isset($_POST['submitted']))
{
	if((!empty($_POST['email'])) && (!empty($_POST['password'])))
	{
	$conn=mysql_connect("localhost","root","") or die("could not connect to database");
	$select_db=mysql_select_db('diary') or die("could not find database");
	$un =$_POST['email'];
	$pwd =$_POST['password'];
	$query1=mysql_query("SELECT un FROM user where un='$un'");
	$numrows1=mysql_num_rows($query1);
	$temp="3";
	$one="1";
	$two="2";
	if($numrows1!=0)  
	{
		while($row=mysql_fetch_assoc($query1))
		{
			$dbun=$row['un'];
		}
  	}
	$query2=mysql_query("SELECT i FROM user where un='$un'");
	$numrows2=mysql_num_rows($query2);
	if($numrows2!=0)  
	{
		while($row=mysql_fetch_assoc($query2))
		{
			$di=$row['i'];
		}
  	}
	if($di == $temp)
	{
		$query2=mysql_query("SELECT id FROM user WHERE un='$un'");
		$numrows2=mysql_num_rows($query2);
		if($numrows2!=0)  
		{
			while($row=mysql_fetch_assoc($query2))
			{
				$dbid=$row['id'];
			}
		}
		$flag="1";
		session_start();  
   		$_SESSION['user_id']="$dbid";  
		header("Location:step2.php");
		exit();
	}
	else if($di == $two)
	{
		$query2=mysql_query("SELECT id FROM user WHERE un='$un'");
		$numrows2=mysql_num_rows($query2);
		if($numrows2!=0)  
		{
			while($row=mysql_fetch_assoc($query2))
			{
				$dbid=$row['id'];
			}
		}
		$flag="2";
		session_start();  
   		$_SESSION['user_id']="$dbid";
		header("Location:step3.php");
		exit();
	}
	else if($di == $one)
	{
		$flag1="0";
	}
	else
	{
		$sqlinsert =  "INSERT INTO user(un,pwd,dob,fn,ln,sq,sa,dp,m,i) VALUES ('$un','$pwd','0','0','0','0','0','0','1','3');";
		mysql_query($sqlinsert) or die("error inserting in new record!!");
		$query2=mysql_query("SELECT id FROM user WHERE un='$un'");
		$numrows2=mysql_num_rows($query2);
		if($numrows2!=0)  
		{
			while($row=mysql_fetch_assoc($query2))
			{
				$dbid=$row['id'];
			}
		}
		$flag1="1";
		session_start();  
   		$_SESSION['user_id']="$dbid";  
		header("Location:step2.php");
		exit();
	}
	}
}?>
<head>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<title>
	DAILY_DAIRY-Register User
</title>
<script>
	function CP(it)
	{
		var un=document.form1.email.value;
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
		if(atpos<1 || dotpos<atpos || (dotpos-atpos)<2)
		{
			alert("Enter a valid Email-Id");
			return false;
		}
		if(flag>1)
		{
			alert("Only 1 @ should be present");
			return false;
		}	
		var p=document.form1.password.value;
		var rp=document.form1.rePassword.value;
		if(p=="" || rp=="")
		{
			alert("ENTER YOUR PASSWORD");
			return false;
		}
		if(p!=rp)
		{
			alert("PASSWORD AND RE_PASSWORD DOESNOT MATCH");
			return false;
		}
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
		if(p==rp)
		{
			return true;
		}
	}
</script>
</head>
<body style=background-image:url("e2.jpg")>
	<div class="loginForm">
		<div class="head">
			<center><img src="logo.png"  width="150" height="100"><br><br>
			<b><font color="blue" size="5" face="verdana">USER REGISTER:<br><font color="black" size="3">STEP 1 OUT OF 3</font></font></b></center>
		</div>
		<br><br><br><br><br><br><br><br>
		<form name="form1" class="form1" onSubmit="return CP(document.form1.password)" method="post" target="Login">
		<input type="hidden" name="submitted" value="true"/>
		<font color="black" size="5">
		EMAIL ID:<font color="red" size="3">(USE DURING LOGIN AS USERNAME)</font><br><input type="text" name="email" placeholder="E-Mail ID">
		<?php
			 if($flag1=="0")
				{
					echo "<font color=red size=5><br>USER ALREADY REGISTERED.FOR LOGIN<br><a href=l.php target=Login>CLICK HERE</a></font>";
				}
		?>
		<br><br>
		PASSWORD:<font color="red" size="3">(Password with more than 10 character which includes atleast{'1 to 9'},atleast one{'a to z'},atleast one{'A 		to Z'},atleast one{'@,$,&,Symbols'})</font><br>
		<input type="password" name="password" placeholder="Password"><br><br>
		RE-ENTER Password:<br><input type="password" id="rePassword" name="rePassword" placeholder="Retype Password"><br><br>
		<center><input type="submit" value="NEXT">
		<a href="start1.html" target="_top"><input type="button" value="HOME"></a>
		</center>
		</form>
	</div></font>
</body>
</html>


