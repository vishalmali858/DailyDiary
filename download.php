<?php
$id= $_GET['nama'];
$ft= $_GET['file'];
$conn=mysql_connect("localhost","root","") or die("could not connect to database");
$select_db=mysql_select_db('diary') or die("could not find database");
$query=mysql_query("SELECT un FROM user WHERE id='$id'");
$numrows=mysql_num_rows($query);  
if($numrows!=0)  
{
	while($row=mysql_fetch_assoc($query))  
    	{
		$dbun=$row['un'];
	}
}
$to =$dbun;
$subject ="DIALY DIARY ATTACHMENTS";
$txt =$ft;
$headers = "From:" .$un . "\r\n";
mail($to,$subject,$txt,$headers);
exit;
?>