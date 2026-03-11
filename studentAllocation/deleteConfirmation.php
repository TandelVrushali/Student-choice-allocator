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
 				<?php echo "<center><br><br>Data of the person <b>".$_SESSION['Id']."</b></center><br>has been removed successfully!!"; ?>
			<br>
 			</div>
 		</center>
 	</div>
 	</div>
 	<?php
	 session_start();

	 $conn = mysqli_connect("127.0.0.1", "root", "", "studentAllocation");
     $sql="SELECT * FROM Login WHERE Id='".$_SESSION['id']."';";
     $result = mysqli_query($conn,$sql);
     $count=mysqli_num_rows($result);

	 if($count>0){
		while($row = mysqli_fetch_assoc($result)){
			$type = $row['Type'];
		}
	 }

	 if($type=="s1"){
		header("Refresh:2; url=student.html");
	 }
	 if($type=="s2"){
		header("Refresh:2; url=supervisor.html");
	 }
	?>
 </body>
 </html>
