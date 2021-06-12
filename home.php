<!DOCTYPE>
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
			 
			$conn=mysql_connect("localhost","root","") or die("could not connect to database");
			$select_db=mysql_select_db('diary') or die("could not find database");
			$name=$_FILES['ftu1']['name'];
			$ta1=$_POST['t1'];
			$date2=date('Y-m-d');
			$time=date('H:i:s');
			$id=$_SESSION["user_id"];
			$name1="C:/wamp/www/DailyDiary/uploads/".$id.'_'.$date2;
			$name1=$name1.'.txt';
			$fp = fopen($name1, 'a');  
			fwrite($fp,$ta1);  
			fclose($fp);    
			$target_path = "C:/wamp/www/DailyDiary/uploads/";  
			$target_path = $target_path.basename( $_FILES['ftu1']['name']);
			$p="uploads/";
			$p=$p.basename( $_FILES['ftu1']['name']);   
  			if(move_uploaded_file($_FILES['ftu1']['tmp_name'], $target_path))
			{  
				$flag1="0";  
			}
			if($flag1=="0")
			{
			$date1=date('Y-m-d');	 			 
			$query2="insert into upload(id,name,cd,path) values('$id','$name','$date1','$p');";
			mysql_query($query2) or die("error inserting in new record!!");
			}
			session_start();  
   			$_SESSION['user_id']="$id";  
			header("Location:demo1.php");
			exit();
}
}
?>
<head>
<title>DAILY DIARY-Home Page</title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
</head>		
<body style=background-image:url("e1.jpg")>
	<div class="word">
		<font color="BLUE" size="5" face="verdana">
		<ul><marquee><br>||| "MEMORY IS THE DAIRY WE ALL CARRY ABOUT WITH US.. ~unknown" ||| "A POCKET DAIRY IS THE MOST CONVENIENT TO CARRY ABOUT 
					 EVERYWHERE !!" |||			
			</ul></marquee>
	</font>
	</div>
	<div class="tophead">
		<div class="txt-center">
			<font color="BLACK" size="10" face="verdana">
				<font size="5">WELCOME TO </font>DailyDiary</font>
				<font color="Blue" size="4" face="verdana">
					(HavE A LifE WortH WritinG DowN?)
			</font>
			<div class="logout">
				<a href="start1.html" target="_self"><input type="button" value="Logout"></button></a>
			</div>
		</div>
	</div>
	

<br><br><br><br><br><br><br>
	<form name="f1"  class="book" enctype="multipart/form-data" method="post" onSubmit="return validate()" target="_self" >
		<input type="hidden" name="submitted" value="true"/>
			<textarea rows="12" cols="80" name="t1" placeholder="HOW WAS YOUR DAY??"></textarea>
			<div class="upload">
				<label for="ftu1">
        				<div class="tooltip"><img src="a.png"/>
  						<span class="tooltiptext">WANT TO ATTACH SOME FILES ?(ADD HERE)</span>
					</div>
				</label>
				<input type="file" name="ftu1" id="ftu1">	
			</div><div class="upload1">
				<label for="b1">
        				<div class="tooltip">
  						<span class="tooltiptext">READ YOUR DIARY HERE</span>
					</div>
				</label>
				<a href="load.php"><img src="d9.png" width="80" height="90" name="b1"></a>
				</div>
						<div class="date">
					<script>
				 		var now = new Date();
                                       		var days = new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
						var months = new Array												('January','February','March','April','May','June','July','August','September','October','November','December');
						var date = ((now.getDate()<10) ? "0" : "")+ now.getDate();
						function fourdigits(number)	{
							return (number < 1000) ? number + 1900 : number;
						}
						today =days[now.getDay()] + ", "+date +" " +months[now.getMonth()] + "," +(fourdigits(now.getYear()));
						document.write(today);		
						//  End -->
					</script>
				</div>
			<div class="txt-center" style=margin:auto; width:200%;>
				<input type="submit" value="SAVE">
			</div>
		</form>

</body>
</html>