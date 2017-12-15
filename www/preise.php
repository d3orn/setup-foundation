<?php require_once('./config.php'); ?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pw30</title>
    <link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico">
    <!-- Vendor Styles-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200italic,300,300italic,400,400italic,600,600italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">
    <!-- App Styles-->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Vendor JS-->
    <script src="vendor/jquery-1.11.3.min.js"></script>
    <!-- App JS-->
    <script src="js/functions.js"></script>
  </head>
  <body>
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
        <p>Das Formular wurde nicht kortekt ausgefüllt.</p>
        <p>Bitte versuche es nochmals.</p>
      </div>
    </div>
    <div class="overlay">
      <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
      </svg>
    </div>
    <div class="wrapper">
      <header class="header">
        <div class="shell">
          <div class="header-inner clear">
            <nav class="nav">
              <ul>
                <li class="link-mobile link-danger"><a href="#">STARTSEITE</a></li>
                <li class="link-danger"><a href="default.html#gritplyo">GRIT PLYO</a></li>
                <li class="link-danger"><a href="default.html#cxworx">CXWORX</a></li>
                <li class="link-danger"><a href="default.html#standort">STANDORT</a></li>
                <li><a href="calendar.html">KALENDER</a></li>
                <li><a href="preise.php">TICKETS</a></li>
              </ul>
            </nav>
            <!-- /.nav-->
            <div class="header-body"><a class="btn-menu" href="#"><i class="ico-menu"></i></a><a class="logo" href="default.html">pw30</a></div>
            <!-- /.header-body-->
          </div>
          <!-- /.header-inner-->
        </div>
        <!-- /.shell-->
      </header>
      <!-- /.header-->
      <div class="wrapper-inner">
        <div class="main">
          <div class="shell">
            <div class="form">
              <form id="payment-form" action="charge.php" method="post">
                <section class="section-plans">
                  <div class="form-body">
                    <div class="row">
                      <div class="col">
                        <div class="section-body">
                          <h2 class="section-title">Aktuelle Ticketpreise</h2>
                          <!-- /.section-title-->
                          <div class="section-content flex-content">
                            <div class="product">
                              <input class="amount" id="p1amount" type="number" min="0" max="99" name="p1amount">
                              <label for="p1amount" data-value="32">
                                <div class="lead">
                                  <div class="name">2er-Ticket</div>
                                  <div class="price">(32.00 CHF)</div>
                                </div>
                                <div class="description">(berechtigt zum Besuch von zwei beliebigen Lektionen)</div>
                              </label>
                              <input class="sum" disalbed tabindex="-1">
                            </div>
                            <div class="product">
                              <input class="amount" id="p2amount" type="number" min="0" max="99" name="p2amount">
                              <label for="p2amount" data-value="120">
                                <div class="lead">
                                  <div class="name">10er-Ticket</div>
                                  <div class="price">(120.00 anstatt 160.00 CHF)</div>
                                </div>
                                <div class="description">(berechtigt zum Besuch von zehn beliebigen Lektionen)</div>
                                <div class="sale">Sommeraktion: bis August 2016 bieten wir dir die tickets zu günstigen 120.00 anstelle von 160.00 CHF an</div>
                              </label>
                              <input class="sum" disabled tabindex="-1">
                            </div>
                            <div class="total">
                              <h2>gesamttotal</h2>
                              <input disabled tabindex="-1">
                            </div>
                            <input type="hidden" name="total">
                            <input type="hidden" name="page" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>">
                            <button class="button" id="customButton" disabled>Tickets bestellen</button>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="section-image"><img src="css/images/image-1.png" alt=""></div>
                        <!-- /.section-image-->
                      </div>
                      <!-- /.col-->
                    </div>
                    <!-- /.row-->
                  </div>
                  <!-- /.form-body-->
                </section>
                <!-- /.section-plans-->
                <section class="section-outro">
                  <h5 class="section-title">Tickets</h5>
                  <!-- /.section-title-->
                  <div class="section-body">
                    <div class="row">
                      <div class="col">
                        <p>Ein Einzelticket berechtigt zum Besuch einer Lektion. Um einen Kurs besuchen zu können, ist vorgängig ein gültiges Ticket zu beziehen. Diese können bei Tatkraft Creative Training in der Felsenau oder online auf PW30.CH gekauft werden. Es gibt 2er- und 10er-Karten.</p>
                        <p>Wichtig: wir verkaufen keine Tickets vor Ort. Wenn Du Tickets kaufen möchtest kannst Du diese Online bestellen. Wir schicken Dir diese dann umgehend mit A-Post zu, sodass Du diese am nächsten Tag im Briefkasten hast.</p>
                        <p>Wenn Du einen Kurs besuchst, nimmst Du Dein Ticket mit an den Platz. Der Kursleiter wird die Tickets jeweils vor Kursstart entwerten.</p>
                      </div>
                      <!-- /.col-->
                      <div class="col">
                        <p>Im Ticketpreis enthalten ist die Nutzung der für den jeweiligen Kurs notwendigen Geräte. Es ist lediglich passende Sportbekleidung, sowie ein Handtuch und eine Trinkflasche erforderlich. Die PW30.CH stellt modernstes, hochwertiges Trainingsmaterial zur Verfügung u.a. die von Les Mills angebotenen Produkte.</p>
                        <p>Ein Ticket berechtigt Dich, einen beliebigen Kurs (ohne Voranmeldung) zu besuchen.</p>
                        <p>Tickets sind 12 Monate ab Kaufdatum gültig und können nicht umgetauscht werden.</p>
                      </div>
                      <!-- /.col-->
                    </div>
                    <!-- /.row-->
                  </div>
                  <!-- /.section-body-->
                </section>
                <!-- /.section-outro-->
              </form>
            </div>
            <!-- /.shell-->
          </div>
          <!-- /.main-->
          <footer class="footer">
            <div class="footer-body">
              <div class="shell">
                <h5 class="footer-title">Kurse</h5>
                <div class="footer-content">
                  <div class="footer-cols clear">
                    <div class="footer-col">
                      <p>Unsere Instruktoren präsentieren Dir die Top-Programme des Weltmarktführers „Les Mills“. Diese bestehend aus effizient zusammengestellten Übungen, kombiniert mit motivierender Musik. Jedes Programm verfolgt hierbei jeweils einen anderen Schwerpunkt. Alle 3 Monate wechseln die Programme und werden durch neue ersetzt.</p>
                      <p>Wir bieten Dir die besten Group-Fitness-Instruktoren im Raum Bern, die Dich nicht nur motivieren, sondern Dich auch sportlich in kurzer Zeit weiter bringen und herausfordern.</p>
                    </div>
                    <!-- /.footer-col-->
                    <div class="footer-col">
                      <p>Der Kurskalender wird innerhalb der nächsten Monate schrittweise ausgebaut. Der aktuelle Plan ist jeweils auf unserer Webseite PW30.CH ersichtlich.</p>
                      <p>Die Dauer einer Lektion haben wir nach unserem Konzept auf 30 Minuten beschränkt und hierfür spezielle Programme zusammengestellt, die in diesem Zeitrahmen ein intensives Training erlauben. Mit diesen Programmen erreichst Du schneller Resultate, wirst fit und dies mit weniger Zeitaufwand pro Training.</p>
                    </div>
                    <!-- /.footer-col-->
                  </div>
                  <!-- /.footer-cols-->
                </div>
                <!-- /.footer-content-->
              </div>
              <!-- /.shell-->
            </div>
            <!-- /.footer-body-->
            <div class="footer-foot">
              <div class="shell"><a class="logo-footer" href="#"></a>
                <p class="copyright">© 2016  –  Powered by Tatkraft Creative Training</p>
                <!-- /.copyright-->
                <p>TATKRAFT-werk GmbH  –<a href="http://tatkraft-training.ch/">tatkraft-training.ch/</a>  - +41 79 344 65 14</p>
              </div>
              <!-- /.shell-->
            </div>
            <!-- /.footer-foot-->
          </footer>
          <!-- /.footer-->
        </div>
        <!-- /.wrapper-inner-->
      </div>
      <!-- /.wrapper-->
    </div>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="js/libs.js"></script>
    <script src="js/app.js"></script><?php if(isset($_SESSION['success']) or !empty($_SESSION['errors'])) session_unset() ?>
  </body>
</html>