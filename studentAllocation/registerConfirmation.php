<!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link rel="stylesheet" type="text/css" href="cform1.css"/>
 </head>
 
 <body style="overflow: hidden;">  
 	<div class="container">
 		<div id="header"> 
 		<center>
 			<div id="nav">
 			<br>
 				<p style="color:#1e58c6;font-size:40px">Thank you!!!!</p>
 				<p style="font-size: 25px">Registration is Completed Successfully !!</p>
			<br>
 			</div>
 		</center>
 	</div>
 	</div>
 	<?php
	 session_start();
	 if($_SESSION['type']=="A"){
		header("Refresh:2; url=Admin.html");
	  }
	  if($_SESSION['type']=="s2"){
		header("Refresh:2; url=supervisor.html");
	  }
	 
	?>
 </body>
 </html>
