<?php
include('connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
//Load Composer's autoloader
require 'vendor/autoload.php';


if(isset($_POST['submit'])){
$name = $_POST['name'];
$message = $_POST['message'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$query = mysqli_query($conn, "INSERT INTO `tbl_contact`(`name`, `message`, `email`, `pass`) VALUES ('$name','$message','$email','$pass')");

if($query)
{
$mail = new PHPMailer();
try {
    $mail->SMTPDebug = 1;                
    $mail->isSMTP();                                         
    $mail->Host       = 'smtp.elasticemail.com';                     
    $mail->SMTPAuth   = true;                               
    $mail->Username   = 'vipindivakar4@gmail.com';                   
    $mail->Password   = 'D4C15AF5B44AF36A4AD96C6F6ACB577952AA';                   
    $mail->Port       = 2525;                                  
    $mail->SMTPAuth = true;
    $mail->SMTPDebug =1;
    $mail->Debugoutput = 'html';
    $mail->SMTPSecure = 'tls';
    $mail->setFrom("vipindivakar4@gmail.com","name");
    $mail->addAddress('vipindivakar4@gmail.com');
    $mail->Subject = 'First Mailer in Php';
    $mail->Body= $message;
    if(!$mail->send()){
       echo "Message cannot be send"."<br/>";
       echo "MailerError".$mail->ErrorInfo;
       exit;
   }else{
       echo "<script>window.alert('Message has been sent');</script>";
   }
}catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
 
 header('location:index.php');  
}
else
{
    echo "error";
}
}





?>