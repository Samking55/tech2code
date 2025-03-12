<?php
// set email service
require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "ndris219@gmail.com";
$mail->Password = "efzeeqtxipifivmq";
$mail->SMTPSecure = "tls";
$mail->Port = 587;

// recipient
// set from variables in the imported file
$mail->setFrom("do-not-replay@learnskillnow.space", $mail_service); //email to send from
$mail->addAddress($recipient_addrr, $recipient_name); //recipient addrr
// content
$mail->isHTML(true);
$mail->Subject = $mail_subject;
$mail->Body = $mail_body;
$mail->AltBody = $mail_altbody;

// send email with $mail->send();


// variable list to set before exporting script
// $mail_service = "";
//$recipient_addrr = "";
// $recipient_name = "";
// $mail_subject = "";
// $mail_body = "";
// $mail_altbody = "";
