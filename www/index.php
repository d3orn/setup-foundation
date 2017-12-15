<?php require_once('./config.php'); ?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dominique Rahm | d3orn | Foundation Setup</title>
    <meta name="description" content="description">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <meta property="og:site_name" content="d3orn">
    <meta property="og:type" content="Website">
    <meta property="og:image" content="">
    <meta property="og:url" content="https://github.com/d3orn">
    <meta property="og:description" content="Dominique Rahm | d3orn | Foundation Setup">
  </head>
  <body>
    <header></header>
    <div class="callout success <?php echo (isset($_SESSION["success"])) ? "" : "hidden" ?>" data-closable="fade-out">
      <button class="close-button" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button>
      <div class="content">
        <h2>Besten dank für deine Bestellung!</h2>
        <p>Deine Bestellung wurde erfolgreich abgeschickt.</p>
        <p>Sie wird dir umgehend per A Post zugestellt.</p>
      </div>
    </div>
    <div class="callout alert <?php echo (empty($_SESSION["errors"])) ? "hidden" : "" ?>">
      <button class="close-button" aria-label="Close alert" type="button"><span aria-hidden="true">&times;</span></button>
      <div class="content">
        <h2>Uppps</h2>
      </div>
    </div>
    <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
      <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
    </svg>
    <main class="row">
      <div class="columns">
        <h1>Buy This Thing</h1>
        <form id="payment-form" action="charge.php" method="post">
          <input type="hidden" name="amount" value="2">
          <input type="hidden" name="item" value="Super Shorts">
          <input type="hidden" name="price" value="2000">
          <input type="hidden" name="page" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
          <button class="button" id="customButton">Purchase</button>
        </form>
      </div>
    </main>
    <footer></footer>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="js/libs.js"></script>
    <script src="js/app.js"></script><?php if(isset($_SESSION['success']) or !empty($_SESSION['errors'])) session_unset() ?>
  </body>
</html>