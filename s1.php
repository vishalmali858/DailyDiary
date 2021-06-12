<!DOCTYPE html>
<html>
<?php
ini_set("display_errors","on");
error_reporting(E_ERROR);
if(isset($_POST['submitted']))
{
$sub=$_POST['sub'];	  			
$un=$_POST['username'];
$ta=$_POST['t'];
$flag="1";
$to = "vishalmali858@gmail.com";
$subject = $sub;
$txt =$ta;
$headers = "From:" .$un . "\r\n";
mail($to,$subject,$txt,$headers);
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
	function CP()
	{
		var un=document.form1.username.value;
		var t1=document.form1.t.value;
		var s=document.form1.sub.value;
		var atpos=un.indexOf("@");
		var dotpos=un.lastIndexOf(".");
		var flag=0;
		if(un=="")
		{
			alert("ENTER USERNAME CREDENTAILS");
			return false;
		}
		if(t1=="")
		{
			alert("ENTER COMMENT");
			return false;
		}
		if(s=="")
		{
			alert("SUBJECT CANNOT BE EMPY");
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
	}
</script>
</head>
<body>
	<div class="loginForm">
		<div class="head">
			<img src="logo.png"  width="150" height="100" align="left"><br><br><br>
			<b><font color="blue" size="5" face="verdana">SUGGESTION</font></b>
		</div><br><br>
		<form name="form1" class="form1" onSubmit="return CP()" method="post" target="sug">
	<?php
		if($flag == "1")
		{
			echo "YOUR QUERY IS SEND TO ADMIN WILL SOON REPLY T0 IT";
			exit();
		}
	?>
	
				<font color="green" size="5"><b>USERNAME:</b></font><br>
				<input type="text"  name="username" placeholder="EMAIL_ID"><br>
				<font color="green" size="5"><b>SUBJECT:</b></font><br>
				<input type="text"  name="sub" placeholder="SUBJECT"><br>
				<font color="green" size="5"><b>COMMENTS:</b></font><br>
				<textarea name="t" placeholder="ANY QUERIES WRITE HERE" style="width:100%;";></textarea>
				<input type="hidden" name="submitted" value="true" />
					<center><input type="submit" value="SUBMIT QUERY"></center>
		</form>
		</div>
	</div>
</body>
</html>






</body>
</html>
