<?php
require_once('./config.php');


$mail = new PHPMailer;
$errors = array();

$token  = json_decode($_POST['stripeToken']);

$p1Amount = $_POST['p1amount'];
$p1Price = 3200;
$p2Amount = $_POST['p2amount'];
$p2Price = 12000;
$total = intval($_POST['total']) * 100;

$customer = \Stripe\Customer::create(array(
    'email' => $token->email,
    'source'  => $token->id
));

$charge = \Stripe\Charge::create(array(
    'customer' => $customer->id,
    'amount'   => $total,
    'currency' => $stripe['currency']
));

if ($charge->paid == true){

    // Store the order in the database.
    // Send Emails
    $details = [
        'total' => $total,
        'p1Amount' => $p1Amount,
        'p2Amount' => $p2Amount,
        'p1Price' => $p1Price,
        'p2Price' => $p2Price,
        'mail' => $token->email,
        'city' => $token->card->address_city,
        'country' => $token->card->address_country,
        'street' => $token->card->address_line1 . ' ' . $token->card->address_line2,
        'state' => $token->card->address_state,
        'zip' => $token->card->address_zip
    ];

    sendConfirmation($details);
    sendOrder();

    // Backup
    $file = fopen($config['backupfile'], "a");
    $message = "{$total}, {$p1Amount}, {$p1Price}, {$p2Amount}, {$p2Price}, {$token->email}\n";
    fwrite($file, $message);

} else {
    $message = 'Your payment could NOT be processed (i.e., you have not been charged) because the payment system rejected the transaction. You can try again or use another card.';
    array_push($errors, $message);
}

$_SESSION['errors'] = $errors;
$_SESSION['success'] = empty($errors);


header('Location: '.$_POST['page']);
exit();

function sendConfirmation($orderDetails){
    global $config;
    global $mail;

    $mail->From = $config['sellerEmail'];
    $mail->FromName = $config['sellerName'];

    $mail->addAddress($orderDetails['mail']);
    $mail->addReplyTo($config['sellerEmail'], "Reply");
    $mail->isHTML(true);

    $price = substr($orderDetails['total'], 0, -2);

    $message = "\n{$orderDetails['p1Amount']}, {$orderDetails['p1Price']}\n
    {$orderDetails['p2Amount']}, {$orderDetails['p2Price']}\n, {$price} {$config['currency']}\n";
    $address = "\n{$orderDetails['street']}\n
        {$orderDetails['zip']} {$orderDetails['city']}\n
        {$orderDetails['state']}
        {$orderDetails['country']}";

    $mail->Subject = $config['mailSubject'];
    $mail->Body = $config['mailBodyHTML'] . '<p>' . $message . '</p><p>' .$address . '</p>';
    $mail->AltBody = $config['mailBodyAlt'] . $message . $address;

    $mail->send();
}

function sendOrder(){
    global $config;
    global $mail;

    $mail->From = $config['sellerEmail'];

    $mail->addAddress($config['sellerEmail']);
    $mail->isHTML(true);

    $mail->Subject = "New Order";
    $mail->Body = "<i>Mail body in HTML</i>";
    $mail->AltBody = "This is the plain text version of the email content";

    $mail->send();
}

?>
