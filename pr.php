<!DOCTYPE html>
<html>
<?php
	ini_set("display_errors","on");
	error_reporting(E_ERROR);
	if(isset($_POST['submitted']))
	{
	if(!empty($_POST['dob']) && !empty($_POST['password']))
	{  
		$conn=mysql_connect("localhost","root","") or die("could not connect to database");
		$select_db=mysql_select_db('diary') or die("could not find database");
	    	$un=$_POST['dob'];
		$pwd=$_POST['password'];
		$dp=$_POST['diarypassword'];   
		$query=mysql_query("SELECT id FROM user WHERE un='$un'");
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
		$query2=mysql_query("SELECT pwd FROM user WHERE id='$dbid'");
		$numrows2=mysql_num_rows($query2); 	
    		if($numrows1!=0 && $numrows2!=0)  
		{
			while($row=mysql_fetch_assoc($query1))
				{
					$dbun=$row['un'];
				}
			while($row=mysql_fetch_assoc($query2))
				{
					$dbpwd=$row['pwd'];
				}
		}
    			if($un == $dbun && $pwd == $dbpwd)  
    			{    
				$sqlinsert = "update user set dp='$dp' where id='$dbid';";
				mysql_query($sqlinsert) or die("error inserting in new record!!");
    				$flag="1";  
   			 }  
			else
			 {  
				$flag1="1";  
    			} 
	} 
	else
	 {  
    			echo "All fields are required!";  
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
	function CP(it)
	{
		var dp=document.form1.diarypassword.value;
		var p=document.form1.password.value;
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
		if(p=="")
		{
			alert("ENTER YOUR PASSWORD");
			return false;
		}
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
				break;
			}
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
	}
</script>

</head>
<body style=background-image:url("e2.jpg")>

<div class="loginForm">
		<div class="head">
			<center><img src="logo.png"  width="150" height="100"><br><br>
			<?php if($flag =="1")
				{
					echo "<font color=red size=5>pin updated successfully<br><a href=l.php target=Login>CLICK HERE</a></font>";
					exit();
				}
			?>
			<b><font color="blue" size="5" face="verdana">PIN RECOVERY:<br><font color="black" size="3">STEP 1 OUT OF 1</font></font></b></center>
		</div>
		<br><br><br><br><br><br><br><br>
		<form name="form1" class="form1" onSubmit="return validate()"method="post" target="Login">
		<input type="hidden" name="submitted" value="true"/>
		<font color="black" size="5">
		USERNAME:<br><input type="text" name="dob" placeholder="email"><br><br>
		PASSWORD:<font color="red" size="3">(Password with more than 10 character which includes atleast{'1 to 9'},atleast one{'a to z'},atleast one{'A 		to Z'},atleast one{'@,$,&,Symbols'})</font><br>
		<input type="password" name="password" placeholder="Password"><br><br>
		
		<?php if($flag1 =="1")
				{
					echo "<font color=red size=5>INVALID PASSWORD OR USER NAME<br></font>";
				}
			?>
		DIARY PIN:<font color="red" size="3">(USED WHILE ACCESSING YOUR DIARY)<br>
		<input type="password" name="diarypassword" placeholder="DIARY PIN" maxlength="5"><br><br>
		<center><input type="submit" onclick="return CP(document.form1.password)" value="CHANGE PIN">
		<a href="forgetPass.php" target="Login"><input type="button" value="PASSWORD ?"></a>
		<a href="start1.html" target="_top"><input type="button" value="HOME"></a>
		<center>
		</form>
	</div></font>
	</div>
</body>
</html>