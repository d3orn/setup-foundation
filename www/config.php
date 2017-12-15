<?php
session_start();
//require_once('../vendor/autoload.php');
require_once('php/stripe-php/init.php');
require_once('php/phpmailer/phpmailer/PHPMailerAutoload.php');

$stripe = array(
  "secret_key"      => "sk_test_njOfVAa9KjaansAASizuwYPL",
  "publishable_key" => "pk_test_jO4BvaQpjfWOPpWMfPgHgisi",
  "currency"        => "chf"
); 

$config = [
    'backupfile' => 'purchases.backup.txt',
    'sellerEmail' => 'dr@oxon.ch',
    'sellerName' => 'Dominique Rahm',
    'mailSubject' => "Order Confirmation",
    'mailBodyHTML' => "<i>Mail body in HTML</i>",
    'mailBodyAlt' => "This is the plain text version of the email content",
    'currency' => $stripe['currency'],
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
