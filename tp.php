<html>
<head>

<link href="css/style.css" rel='stylesheet' type='text/css' /></head>
<title>
	WELCOME PAGE
</title>
<style>

*{
margin:0px;
padding:0px;
}

body{


}
/*Rules for navigation*/

ul#navmenu,ul.sub1,ul.sub2{
list-style-type:none;
}

ul#navmenu li{
width:200px;
text-align:center;

position:relative;
float:left;
margin-right:4px;
}


ul#navmenu a{
text-decoration:none;
display:block;
width:200px;
height:50px;
line-height:50px;
background-color:white;
border:5px solid black;
border-radius :5px;}


ul#navmenu .sub1 a{
margin-top:5px;
}

ul#navmenu .sub2 a{
margin-left:80px;
}

ul#navmenu li:hover>a{
background-color:black;
}


ul#navmenu li:hover a:hover{
background-color:#ffff00;
}


ul#navmenu ul.sub1{
display:none;
position:absolute;
top:26px;
left:0px;
}

ul#navmenu ul.sub2{
display:non>e;
position:absolute;
top:0px;
left:125px;

}


ul#navmenu li:hover .sub1{
display:block;
}

ul#navmenu .sub1 li:hover .sub2{
display:block;
}


.samediv{
float:left;
margin:5px;
padding:25px;
max-width:500px;
height:300px;
border:5px solid black;
background-color:white;
}

</style>



<body style=background-image:url("e1.jpg")>
	<div class="word">
		<font color="BLUE" size="5" face="verdana">
			<ul><marquee><br>||| "MEMORY IS THE DAIRY WE ALL CARRY ABOUT WITH US.. ~unknown" ||| "A POCKET DAIRY IS THE MOST CONVENIENT TO CARRY ABOUT 
					 EVERYWHERE !!" |||			
			</ul></marquee>
		</font>
	</div>

	<div class="txt-rt" 
		<div class="tophead">
			<b><font color="Black" size="2" face="verdana">
				Are YOU A NeW UseR ? REGISTER HERE
			</b></font><br>
			<a href="start1.html"><input type="submit" value="REGISTER"></a>
		</div>

	<div class="tophead">
		<div class="txt-center">
			<font color="BLACK" size="10" face="verdana">
				www.DailyDiary.com
				<font color="Blue" size="4" face="verdana">
					(HavE A LifE WortH WritinG DowN?)
				</font>
			</font>
		</div>
	</div>
	<br><br>
</h1></center>


<ul id="navmenu">

<li><a href="tp.php">HOME</a>
<ul class="sub1">
</li>


<ul  class="sub2" type="circle">

</li>
</ul>
</ul>

<li><a href="p.html">GALLERY</a></li>

<li><a href="c.html">CONTACT US</a></li>

<li><a href="s.php">FEEDBACK</a></li>

<li><a href="start1.html">LOG IN</a></li>


</ul>

<br>
<br>
<br><br><br><br>



<center><div class="slideshow-container" >
<center>
<div class="mySlides fade" style="float:center;">
<img src="d2.jpg">
</div>

<div class="mySlides fade">
  <img src="d3.jpg">
</div>

<div class="mySlides fade">
  <img src="d13.jpg">
</div>
</center>
</div></center>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<div class="samediv">

<font color="BLACK" size="4" face="verdana">
			<b>**QUOTE**</b><br><br>
			<font color="green" size="3" face="Sans">
				EVERY NEW DAY IS BLANK PAGE OF LIFE,<br>THE SECRET OF SUCCESS IS IN TURING<br>THAT DAIRY INTO BEST STORY !!<br>~Unknown
		  	</font>
			
	</font><br><br>
<a href="start1.html"><input type="button" value="LEARN MORE" style="width:auto;"></a>
</div>


<div class="samediv">

<font color="BLACK" size="4" face="verdana">
				<ul><b>WHY DD?</ul></b><img src="logo.png" width="130" height="100"><br>
				<font color="red" size="3" face="Sans">1)MORE SECURED<br>2)24*7 ACTIVE<br>3)USER-FREINDLY
				</font><br>
			</font><br>
<a href="start1.html"><input type="button" value="REGISTER NOW" style="width:auto;"></a>
</div><div class="samediv">

<font color="BLACK" size="4" face="verdana">
				<ul><b>ADVANTAGES</ul></b><br>
				<font color="red" size="3" face="Sans">1)YOU NEVER FEEL REALLY ALONE <br>2)POUR ALL YOUR FEELINGS WITHOUT BEING JUDGED <br>
									3)DAIRY CAN BE A CRITIC,IF YOU WRITE DAILY<BR>4)IT RECOLLECTS YOUR PASTS AND HELP TO AVOID MISTAKSES 
				</font><br>
			</font><br>
<a href="start1.html"><input type="button" value="TRY NOW" style="width:auto;"></a>
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 5000); // Change image every 2 seconds
}
</script>
</body>
</html>
