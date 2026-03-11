<?php
    session_start();

    $TId=htmlspecialchars($_GET["name"]);
                    
    $conn = mysqli_connect("127.0.0.1", "root", "", "studentAllocation");
    $sql=" DELETE FROM Topic WHERE TId='".$TId."';";                
    mysqli_query($conn,$sql);
    
  ?>



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
        <br/>
         <p style="color:#1e58c6;font-size:40px">Topic deleted successfully!!</p>
 				
			<br>
 			</div>
 		</center>
 	</div>
 	</div>
 	<?php
	 session_start();
	 header("Refresh:1; url=Admin.html");
	?>
 </body>
 </html>

