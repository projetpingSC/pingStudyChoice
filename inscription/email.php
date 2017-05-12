<?php
// Pear Mail Library
require_once "../../../../../bin/php/php5.6.25/pear/Mail/mail.php";

/* $argnom = 
$argprenom = $_GET['prenom'];
$argtel = $_GET['tel'];
$argsociete = $_GET['societe'];
$argmessage = $_GET['message'];
$argemail = $_GET['email']; */


$from = '<pingstudychoice@gmail.com>';
$to = '<maxime.martinez@hotmail.fr>';
$subject = 'PHP ';
//$body = "Nom : ".$argnom." | Email : ".$argemail." | Societe : ".$argsociete." | Telephone : ".$argtel." | Message : ".$argmessage;
$body = "PHP";

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$smtp = Mail::factory('smtp', array(
	'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'pingstudychoice@gmail.com',
        'password' => 'projetesilv'
    ));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    echo('<p>' . $mail->getMessage() . '</p>');
} else {
    echo('<p>Message successfully sent!</p>');
}?>

