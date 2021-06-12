<!DOCTYPE html>
<html>
<?php   
session_start();  
if(!isset($_SESSION["user_id"])){  
    header("Location:demo.php");
	exit();  
} 
else
{  
	ini_set("display_errors","on");
	error_reporting(E_ERROR);
	if(isset($_POST['submitted']))
	{		
		if(!empty($_POST['dp']))
		{	  
			$conn=mysql_connect("localhost","root","") or die("could not connect to database");
			$select_db=mysql_select_db('diary') or die("could not find database");
    			$dp=$_POST['dp'];
			$id=$_SESSION["user_id"];  
			$flag1="0";
			$query=mysql_query("SELECT id FROM user WHERE id='$id'");
			$numrows=mysql_num_rows($query);
			$query1=mysql_query("SELECT dp FROM user WHERE id='$id'");
			$numrows1=mysql_num_rows($query1);  
    			if($numrows!=0 && $numrows1!=0)  
			{
	 			while($row=mysql_fetch_assoc($query))  
    				{
					$dbid=$row['id'];
				}
  				while($row=mysql_fetch_assoc($query1))
				{ 	 
    					$dbdp=$row['dp'];
				}
			}
    				if($dp == $dbdp && $id==$dbid)  
    				{  
    					session_start();  
   					$_SESSION['user_id']="$dbid";  
 					/* Redirect browser */  
   				 	header("Location:home.php");
					exit();  
 				}				  
				else
			 	{  
					$flag1="1";
				}

		}
		if(!empty($_POST['mood']))
		{
			$conn=mysql_connect("localhost","root","") or die("could not connect to database");
			$select_db=mysql_select_db('diary') or die("could not find database");
			$id=$_SESSION["user_id"]; 
			$st=$_POST['mood'];
			$query2=mysql_query("SELECT m FROM user WHERE id='$id'");
			$query3=mysql_query("SELECT id FROM user WHERE id='$id'");
			$numrows2=mysql_num_rows($query2);
			$numrows3=mysql_num_rows($query3);
			if($numrows2!=0 && $numrows3!=0)
			{
				while($row=mysql_fetch_assoc($query3))  
				{
					$dbid1=$row['id'];
				}
  				while($row=mysql_fetch_assoc($query2))
				{  
    					$dbmood=$row['m'];
				}
			}
    				if($st == $dbmood && $id==$dbid1)  
    				{  
    				session_start();  
   				 $_SESSION['user_id']="$dbid1";  
   				 header("Location:home.php");
					exit();  
    				}
				else
			 	{  
					$flag1="2";  
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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,intial-scale=1">
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
	var dp=document.f1.dp.value;
	var flag=0;
	var ddp=12345;
	if(dp=="" && ((document.f1.mood[0].checked==false)&&(document.f1.mood[1].checked==false)&&(document.f1.mood[2].checked==false)&&(document.f1.mood[3].checked==false)&&(document.f1.mood[4].checked==false)&&(document.f1.mood[5].checked==false)))
	{
		alert("PLEASE ENTER THE PIN OR SELECT YOUR YESTERDAY MOOD");
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
}
</script>
</head>
<body style=background-image:url("d14.jpg")>
  <div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><center><img src="logo.png" width="150" height="100"></center></h4>
	<b><font color="blue" size="5" face="verdana">ACCESS PASSWORD:</font></b>
      </div>
      <div class="modal-body">
        <form name="f1" onSubmit="return validate()" method="post" target="_self">
	<input type="hidden" name="submitted" value="true"/>
		<font size="5" color="black"><b>DAIRY PIN:</b></font><font size="3" color="red">(5 NUMERIC DIGITS ONLY)</font><br>
		<input type="password" name="dp" placeholder="DIARY PIN" maxlength="5">
		<?php if($flag1=="1")
				{
					echo "<br><br><font color=red size=5>INVALID PIN</font>";
				}
			?>
		<font size="5" color="black"><p><b><sup>__________</sup><font size="10" color="blue">OR</font><sup>__________</sup></p></font></b>
		<b> <font size="5" color="black">YESTERDAY's MOOD:</font><font size="3" color="red"><br>(IF FIRST LOGIN THEN SELECT "HAPPY" STICKER)</font>
			<div class="mood">
				<label><img src="happy.png" width="80" height="80"><input type="radio" name="mood" value="1">HAPPY
				<img src="sad.png" width="80" height="80"><input type="radio" name="mood" value="2">SAD
				<img src="Tired.png" width="80" height="80"><input type="radio" name="mood" value="3">TIRED<br><br>
				<img src="Love.png" width="80" height="80"><input type="radio" name="mood" value="4">LOVED
				<img src="Angry.png" width="80" height="80"><input type="radio" name="mood" value="5">ANGRY
				<img src="Fun.png" width="80" height="80"><input type="radio" name="mood" value="6">FUNNY</label>
			</div></b>
			<?php if($flag1=="2")
				{
					echo "<br><br><font color=red size=5>INVALID STICKER/PIN</font>";
				}
			?>
		<center><input type="Submit" value="LOGIN"></center>
	</form>
      </div>
      
    </div>

  </div>
</div></body>
-</html>