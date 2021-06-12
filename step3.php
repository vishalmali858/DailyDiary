<!DOCTYPE html>
<html>
<?php   
session_start();  
if(!isset($_SESSION["user_id"]))
{  
    header("location:step2.php");  
}
else
{  
	ini_set("display_errors","on");
	error_reporting(E_ERROR);
	if(isset($_POST['submitted']))
	{ 
		$conn=mysql_connect("localhost","root","") or die("could not connect to database");
		$select_db=mysql_select_db('diary') or die("could not find database");
	    	$sq=$_POST['recoveryQue'];
		$sa=$_POST['recoveryAns'];
		$dp=$_POST['dp'];
		$id=$_SESSION["user_id"];
		$two="1";
		$temp="2"; 
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
			$sqlinsert = "update user set sq='$sq' where id='$dbid';";
			mysql_query($sqlinsert) or die("error inserting in new record!!");
			$sqlinsert1 = "update user set sa='$sa' where id='$dbid';";
			mysql_query($sqlinsert1) or die("error inserting in new record!!");
			$sqlinsert2 = "update user set dp='$dp' where id='$dbid';";
			mysql_query($sqlinsert2) or die("error inserting in new record!!");
			$sqlinsert3 = "update user set i='$two' where id='$dbid';";
			mysql_query($sqlinsert3) or die("error inserting in new record!!");
			$flag="1";
			}
		}
		else
		{
			$flag="0";
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
		var ra=document.f1.recoveryAns.value;
		if(document.f1.recoveryQue.selectedIndex==0)
		{
			alert("PLEASE SELECT RECOVERY QUESTION");
			return false;
		}	
		if(ra=="")
		{
			alert("PLEASE ENTER YOUR RECOVERY ANSWER");
			return false;
		}
		var dp=document.f1.dp.value;
		var flag=0;	
		if(dp=="")
		{
			alert("PLEASE ENTER DIARY PIN");
			return false;
		}
		var i=dp.length;
		if(i==5 || i==0)
		{
			flag=1;
		}
		if(flag==0)
		{
			alert("ENTER THE PIN WITH 5 NUMERIC DIGITS ONLY");
			return false;
		}
		for(j=0;j<dp.length;j++)
		{
			var ch=dp.charAt(j);
			if((ch < "0")||(ch>"9"))
			{
				alert("PIN should consist of only digits");
				return false;
			}
		}
	alert("THANK YOU FOR REGISTERING WITH US PLZ RELOGIN");
	}
</script>
</head>
<body style=background-image:url("e2.jpg")>
		
		<div class="loginForm">
		<div class="head">
			<center><img src="logo.png"  width="150" height="100"><br><br>
			<?php
		if($flag=="1")
		{
			echo "<font size=5 color=red>ACCOUNT CREATED SUCCESSFULLY<br><br><a href=l.php target=Login>CLICK HERE</a>TO LOGIN";
			exit(); 
		}
		?>
			<b><font color="blue" size="5" face="verdana">USER REGISTER:<br><font color="black" size="3">STEP 3 OUT OF 3</font></font></b></center>
		</div>
		<br><br><br><br><br><br><br><br>
		<form name="f1" class="form1" onSubmit="return validate()" method="post" target="Login">
	
		<font color="black" size="5">
		Security Question :<font color="red" size="3">(USED WHILE RECOVERING YOUR ACCOUNT)</font><br>
			<select name="recoveryQue">
						<option selected disabled>Select</option>
						<option>1)WHAT IS YOUR FIRST PET NAME?</option>
						<option>2)WHAT IS YOUR FIRST CAR MODEL?</option>
						<option>3)WHAT IS YOUR FIRST CRUSH NAME?</option>
					    </select><br><br>
		Security Answer:<br><input type="text" name="recoveryAns" placeholder="Security Answer"><br><br>				
		DIARY PIN:<font color="red" size="3">(USED WHILE ACCESSING YOUR DIARY(5 DIGITS ONLY)<br>
		<input type="password" name="dp" placeholder="PIN" maxlength="5"><br><br>
		<input type="hidden" name="submitted" value="true"/>
		<center><input type="submit" value="REGISTER">
		</center>
		</form>
	</div></font>
	</div>

</body>
</html>