<?php

set_include_path(get_include_path() . ':' . '.');
require_once('MailGun/Email.php');
use \MailGun\Email;

$subjectEmail = $_POST['email'];

$Body = 
        '<label><b>Full Name: </b></label>'.$_POST['name'].'<br>'.
        '<label><b>Phone: </b></label>'.$_POST['phone_prefix']. ' ' .$_POST['phone'].'<br>'.
        '<label><b>Email: </b></label>'.$_POST['email'].'<br>'.
        '<label><b>Message: </b></label>'.$_POST['message'].'<br>';
    
$mailgun = require __DIR__ . '/mailgun.config.php';
$email = new Email((string) $mailgun['domain'], (string) $mailgun['api_key']);
//Populate the object
$response = $email->setFrom('postmaster@pozhegu.com', 'Cellar Studio FORM')
    ->addTo('sacha@cellar-studio.com')
    ->addTo('florian@cellar-studio.com')
    ->addTo('rilindp@gmail.com')
    ->setSubject($subjectEmail)
    ->setHtml($Body)
    ->setTestMode(false)
    ->send();
if ($response->getHttpCode() !== 200) {
    throw new \Exception('Mail failed !');
} else {
    echo 'Email sent successfully';
}