<?php
session_start();

$STRIPE_PRIVAT_KEY = "sk_test_njOfVAa9KjaansAASizuwYPL";
$STRIPE_PUBLIC_KEY = "pk_test_jO4BvaQpjfWOPpWMfPgHgisi";
$email = "dr@oxon.ch";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array();

    if (isset($_POST['stripeToken'])) {

        $token = $_POST['stripeToken'];

        // Check for a duplicate submission, just in case:
        if (isset($_SESSION['token']) && ($_SESSION['token'] == $token)) {
            $message = 'You have apparently resubmitted the form. Please do not do that.';
            array_push($errors, $message);
        } else { // New submission.
            $_SESSION['token'] = $token;
        }

    } else {
        $message = 'The order cannot be processed. Please make sure you have JavaScript enabled and try again.';
        array_push($errors, $message);
    }

    // Set the order amount somehow:
    $amount = 3; // $30, in cents
    $price = 1000; // $30, in cents

    // Validate other form data!

    // If no errors, process the order:
    if (empty($errors)) {

        try {
            // Include the Stripe library:
            require_once('../vendor/autoload.php');

            // set your secret key: remember to change this to your live secret key in production
            \Stripe\Stripe::setApiKey($STRIPE_PRIVAT_KEY);

            $charge = \Stripe\Charge::create(array(
                    "amount" => $amount*$price,
                    "currency" => "usd",
                    "source" => $token,
                    "description" => $email
                )
            );

            // Check that it was paid:
            if ($charge->paid == true) {

                // Store the order in the database.
                // Send the email.
                // Celebrate!
                // mail an vendor & customer

                $file = fopen('purchases.backup.txt', "w");

                $email= $_POST['email'];
                $item = $_POST['item'];

                $message = "{$amount}, {$item}, {$price}, {$email}\n";

                fwrite($file, $message);
            } else { // Charge was not paid!
                $message = 'Your payment could NOT be processed (i.e., you have not been charged) because the payment system rejected the transaction. You can try again or use another card.';
                array_push($errors, $message);
            }

        } catch (\Stripe\Error\Card $e) {
            // Card was declined.
            $e_json = $e->getJsonBody();
            $err = $e_json['error'];
            array_push($errors, $err['message']);
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network problem, perhaps try again.
        } catch (\Stripe\Error\InvalidRequest $e) {
            // You screwed up in your programming. Shouldn't happen!
        } catch (\Stripe\Error\Api $e) {
            // Stripe's servers are down!
            $message = 'Our payment server cannot be reached. Try again later.';
            array_push($errors, $message);
        } catch (\Stripe\Error\Base $e) {
            // Something else that's not the customer's fault.
        }

    } // A user form submission error occurred, handled below.


    $message = 'Our payment server cannot be reached. Try again later.';
    array_push($errors, $message);

    $_SESSION['errors'] = $errors;

    header("Location: index.php"); /* Redirect browser */
    exit();

} // Form submission.
?>
