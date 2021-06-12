<!DOCTYPE html>
<html>
<?php   
ini_set("display_errors","on");
error_reporting(E_ERROR);
if(isset($_POST['submitted']))
{		
	if(!empty($_POST['email']) && !empty($_POST['recoveryAns']) && !empty($_POST['recoveryQue']))
	{	  
			$conn=mysql_connect("localhost","root","") or die("could not connect to database");
			$select_db=mysql_select_db('diary') or die("could not find database");
    			$un=$_POST['email']; 
			$sq=$_POST['recoveryQue'];
			$sa=$_POST['recoveryAns'];
			$flag1="0";
			$temp="3";
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
			$query2=mysql_query("SELECT sq FROM user WHERE id='$dbid'");
			$query3=mysql_query("SELECT sa FROM user WHERE id='$dbid'");
			$numrows1=mysql_num_rows($query1); 
			$numrows2=mysql_num_rows($query2);
			$numrows3=mysql_num_rows($query3);
    			if(($numrows1!=0) && ($numrows2!=0) && ($numrows3!=0))  
			{
  					while($row=mysql_fetch_assoc($query1))
					{ 	 
    						$dbun=$row['un'];
					}
				while($row=mysql_fetch_assoc($query2))  
    				{
					$dbsq=$row['sq'];
				}
  					while($row=mysql_fetch_assoc($query3))
					{ 	 
    					$dbsa=$row['sa'];
					}
			}
    				if($un == $dbun)  
    				{  
    					$flag1="3";  
 				}
				else
				{
					$flag="2";
				}
				if($sq==$dbsq && $sa==$dbsa && $flag1 == $temp)  
    				{  
    					session_start();  
   					$_SESSION['user_id']=$dbid;  
 					/* Redirect browser */  
   				 	header("Location:f.php");
					exit();  
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
<title>DailyDiaryRESET</title>
<meta charset="utf-8">
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
	function validate()
	{
		var ra=document.f1.recoveryAns.value;
		var un=document.f1.email.value;
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
	}
</script>

</head>
<body style=background-image:url("e2.jpg")>
	<div class="loginForm">
		<div class="head">
			<center><img src="logo.png"  width="150" height="100"><br><br>
			<b><font color="blue" size="5" face="verdana">PASSWORD RECOVERY:<br><font color="black" size="3">STEP 1 OUT OF 2</font></font></b></center>
		</div>
		<br><br><br><br><br><br><br><br>
		<form name="f1" class="form1" onSubmit="return validate()" method="post" target="Login">
		<input type="hidden" name="submitted" value="true"/>
		<font color="black" size="5">
		USERNAME:<br><input type="text" name="email" placeholder="E-Mail ID"><br><br>
		<?php if($flag=="2")
				{
					echo "<font color=red size=5>INVALID USERNAME</font><br>";
				}
			?>
		Security Question:<br><select name="recoveryQue">
						<option selected disabled>Select</option>
						<option value="1">1)WHAT IS YOUR FIRST PET NAME</option>
						<option value="2">2)WHAT IS YOUR FIRST CAR MODEL</option>
						<option value="3">3)WHAT IS YOUR FIRST CRUSH NAME</option>
					    </select><br><br>
		Security Answer :<br><input type="text" name="recoveryAns" placeholder="Security Answer"><br><br>
		<?php if($flag1=="1")
				{
					echo "<font color=red size=5>INVALID SECURITY QUESTION OR ANSWER</font>";
				}
			?>
		<center><input type="submit" value="CHANGE">
		<a href="pr.php" target="Login"><input type="button" value="PIN?"></a>
		<a href="start1.html" target="_top"><input type="button" value="HOME"></a>
		<center>
		</form>
	</div></font>
	</div>	
</body>
</html>