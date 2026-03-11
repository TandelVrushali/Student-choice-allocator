<?php
//Include required phpmailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

//define namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//create instance of phpmailer
$mail = new PHPMailer();

//set mailer to use smtp
$mail->isSMTP();

//define smtp host
$mail->Host = "smtp.gmail.com";

//enable smtp authentication
$mail->SMTPAuth = "true";

//set type of encryption(ssl/tls)
$mail->SMTPSecure = "tls";

//set port to connect smtp
$mail->Port = "587";

//set gmail username
$mail->Username = "demo@gmail.com";

//set gmail password
$mail->Password = "xyz";

//set email subject
$mail->Subject = "Testing of email";

//set sender email
$mail->setFrom("demo@gmail.com");

//email body
$mail->Body = "Allocation is Published";

$conn = mysqli_connect("127.0.0.1", "root", "", "studentAllocation");
$sql="SELECT * FROM Login;";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
    //Add recipient
    $mail->addAddress($row['Id']);

}

//Finally sent email
if($mail->send()){
    echo "Sent...!";
}
else{
    echo "Not Sent...!";
}

//Closing smtp connection
$mail->smtpClose();


header("Location:Admin.html");
?>
