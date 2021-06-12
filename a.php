<!DOCTYPE html>
<html>
<?php   
session_start();  
if(!isset($_SESSION["user_id"])){  
    header("Location:home.php");
	exit();  
} 
else
{  
	ini_set("display_errors","on");
	error_reporting(E_ERROR);
	if(isset($_POST['submitted']))
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
					$flag1="0";  
  
 				}				  
				else
			 	{  
					$flag1="3";
				}

	}
}
?>
<head>
<script>
function validate()
{
var dob = document.getElementById("DOB").value;
	if(dob=="")
	{
		alert("PLEASE ENTER THE DATE OF DIARY");
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
				break;
			}
		}
}
</script>

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
</head>
<body style=background-image:url("l2.jpg")>
  <div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static" style=width:auto%;height:400%;>
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><center><img src="logo.png" width="150" height="100"></center></h4>
	<b><font color="blue" size="5" face="verdana">YOUR ATTACHMENTS:</font></b>
      </div>
      <div class="modal-body">
        <form name="f1"  method="post" onSubmit="return validate()" target="_self">
<?php
			if($flag1=="0")
			{
				$dateb=$_POST['dod'];
				$conn=mysql_connect("localhost","root","") or die("could not connect to database");
				$select_db=mysql_select_db('diary') or die("could not find database");
				$id=$_SESSION["user_id"];
				echo "<center><font color=red size=5>$dateb<font color=black size=3>(TO DOWNLOAD CLICK ON THE ATTACHMENT)</font></center>";
			$query2=mysql_query("SELECT path FROM upload WHERE cd='$dateb' AND id='$id'");
			$numrows2=mysql_num_rows($query2);
			if($numrows2!=0)
			{
				while($row=mysql_fetch_assoc($query2))
					{
						$pname=$row['path'];
						echo "<a href=$pname download><img src=$pname width=500 height=150></a><br>";
					}
			}
				echo "<a href=home.php><input type=button value=BACK></a>&nbsp&nbsp&nbsp&nbsp";
				echo "<a href=load.php><input type=button value=DIARY></a></center>";
				exit();
			}
			else if($flag1=="3")
			{
				echo "<font size=5 color=red >INVALID PIN <br><br></font>";
			}
?>		<font size="5" color="black"><b>DATE OF DIARY:</b></font>
			<input type="date" id="DOB" name="dod" placeholder="Diarys_Date">
		<br><br>	
		<font size="5" color="black"><b>DIARY PIN:</b></font><br>
			<input type="password" name="dp" placeholder="Diary PIN" maxlength=5">
		<center>
			<input type="Submit" value="READ DIARY">
			<input type="hidden" name="submitted" value="true"/>
			<a href="home.php"><input type="button" value="BACK"></a>
			<a href="load.php"><input type="button" value="DIARY"></a>
		</center>
	</form>
      </div>
      
    </div>

  </div>
</div>
</body>
</html>