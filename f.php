<!DOCTYPE html>
<html>
<?php   
session_start();  
if(!isset($_SESSION["user_id"]))
{  
    header("location:l.php");  
}
else
{  
	ini_set("display_errors","on");
	error_reporting(E_ERROR);
	if(isset($_POST['submitted']))
	{
	if(!empty($_POST['dob']))
	{  
		$conn=mysql_connect("localhost","root","") or die("could not connect to database");
		$select_db=mysql_select_db('diary') or die("could not find database");
	    	$dob=$_POST['dob'];
		$pwd=$_POST['password'];
		$id=$_SESSION["user_id"];  
	    	$query=mysql_query("SELECT dob FROM user WHERE id='$id'");
		$numrows=mysql_num_rows($query); 	
    		if($numrows!=0)  
		{
			while($row=mysql_fetch_assoc($query))
				{
					$dbdob=$row['dob'];
				}
		}
		if($dob == $dbdob)  
    			{    
				$sqlinsert = "update user set pwd='$pwd' where id='$id';";
				mysql_query($sqlinsert) or die("error inserting in new record!!");
    				$flag1="2";  
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
</head>
<script>
	function validate()
	{
		var p=document.form1.password.value;
		var rp=document.form1.rePassword.value;
		var dob = document.getElementById("DOB").value;
		if(dob=="")
		{
			alert("PLEASE ENTER THE DATE OF BIRTH");
			return false;
		}
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
	}
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


<body style=background-image:url("e2.jpg")>

<div class="loginForm">
		<div class="head">

			<center><img src="logo.png"  width="150" height="100"><br><br>
					<?php if($flag1 =="2")
				{
					echo "<font color=red size=5>PASSWORD RESET SUCCESSFULLY<br><br><a href=l.php target=Login>CLICK HERE</a>TO LOGIN</font>";
					exit();
				}
			?>
			<b><font color="blue" size="5" face="verdana">PASSWORD RECOVERY:<br><font color="black" size="3">STEP 2 OUT OF 2</font></font></b></center>
		</div>
		<br><br><br><br><br><br><br><br>
		<form name="form1" class="form1" onSubmit="return validate()"method="post" target="Login">
		<input type="hidden" name="submitted" value="true"/>
		<font color="black" size="5">
		DATE OF BIRTH:<br><input type="date" name="dob" placeholder="Date Of Birth"><br><br>
		<?php if($flag1 =="1")
				{
					echo "<font color=red size=5>INVALID DATE OF BIRTH<br></font>";
				}
			?>
		PASSWORD:<font color="red" size="3">(Password with more than 10 character which includes atleast{'1 to 9'},atleast one{'a to z'},atleast one{'A 		to Z'},atleast one{'@,$,&,Symbols'})</font><br>
		<input type="password" name="password" placeholder="Password"><br><br>
		RE-ENTER Password:<br><input type="password" id="rePassword" name="rePassword" placeholder="Retype Password"><br><br>
			
		<center><input type="submit" onclick="return CP(document.form1.password)" value="CHANGE">
		<a href="pr.php" target="Login"><input type="button" value="PIN?"></a>
		<a href="start1.html" target="_top"><input type="button" value="HOME"></a>
		<center>
		</form>
	</div></font>
	</div>
</body>
</html>
