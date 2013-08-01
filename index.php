<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>DavidsClouds</title>

        <link href="css/main.css" rel="stylesheet" type="text/css" />
	    <link href="scripts/bubbletip/bubbletip.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="scripts/clouds_ajax.js" ></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="scripts/ui_draggable_cloudsay.js"></script>
    	<!--[if IE]>
    	<link href="scripts/bubbletip/bubbletip-IE.css" rel="stylesheet" type="text/css" />
    	<![endif]-->
		<link href="favicon.ico" rel="shortcut icon">

   <script type="text/javascript">
		$(document).ready(function() {
			$(".menu").draggable();
			bindbubble();
			$(".window").mouseover(function(){     $(".window").draggable();   });
			$(".menu b").hover(function(){$(this).animate({"opacity":"1"}, 200);}, function(){$(this).animate({"opacity":"0.7"}, 200);});
			$(".menu").click(function(){        $("#says").fadeOut(2200);	        });
				$('#topmenu li').click(function (){
						$('body').css({"background":$(this).attr("id")});
						 $('#title').css({"color":$(this).attr("id")});
						 $('.menu b').css({"text-shadow":  "0px 0px 10px "+$(this).attr("id")});
				});
			$('title').html('DavidsClouds');
		});// ends scripts
	</script> 
</head>
<body>
	<div id="topmenu"><b>How's your sky?</b>
	  <ul>
		<li id='aqua' class='btn'>b</li>
		<li id='orange' class='btn'>o</li>
		<li id='lightgreen' class='btn'>y</li>
		<li id='grey' class='btn'>g</li>
		<li id='darkorchid' class='btn'>d</li>
		<li id='violet' class='btn'>v</li>
	  </ul>
	</div>
	
	<span class="cloud menu" id="menu1"><img alt="c" src="graphics/cloud.png" /> <b id="homebtn" onclick="readcontent('home.php');"><i>Home</i></b> </span>
	<span class="cloud menu" id="menu2"><img alt="c" src="graphics/cloud.png" /> <b id="artbtn" onclick="readcontent('projects.php');"><i>Projects</i></b> </span>
	<span class="cloud menu" id="menu3"><img alt="c" src="graphics/cloud.png" /> <b id="downloadsbtn" onclick="readcontent('downloads/box.php');"><i>Downloads</i></b> </span>
	<span class="cloud menu" id="menu4"><img alt="c" src="graphics/cloud.png" /> <b id="contactbtn" onclick="readcontent('message.php');"><i>Message</i></b> </span>
	
	<span style="display:none;">
		<div id="menu1bubbletip">Home Sweet Home..</div>
		<div id="menu2bubbletip">Past projects</div>
		<div id="menu3bubbletip">Goodies and stuffs</div>
		<div id="menu4bubbletip">Leave a word :)</div>
	</span>

	
	<div id="page">
			<div id="downwhite"></div>
			<div id="boardwhite">
				<img src="graphics/loader.gif" alt="" id="loader" />
				<div id="says"></div> <!--ends says (ajax container) -->
			</div>
			<div id="masker"></div>
	</div>  <!--ends page -->

	<div id="title"><span id="david">David</span><span id="sclouds">sclouds</span></div>

	 <?php
	  if ($_GET){
		  if ($_GET['downloads']!=null){
			  echo "<script>readcontent('downloads/box.php'); </script>";
		  }
		}//Ends $_GET checking
	  ?>

<script>readcontent('home.php'); </script>
</body>
</html>