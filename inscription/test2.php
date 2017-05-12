<?php require_once "../PHPMailer-FE_v4.11/_lib/class.phpmailer.php";

$mail = new phpmailer();
$mail->IsSMTP();
$mail->SMTPDdebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->username = "pingstudychoice@gmail.com";
$mail->password = "projetesilv";
$mail->SetFrom = "pingstudychoice@gmail.com";
$mail->setTo = "maxime.martinez@hotmail.fr";
$mail->Subject = "mail par php";
$mail->body = "succes !       ";
$mail->AddAddress = "pingstudychoice@gmail.com";

if (!$mail->send())
{
    echo $mail->ErrorInfo;
} else { echo"message sent"; }

?>