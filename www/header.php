<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200italic,300,300italic,400,400italic,600,600italic,700,700italic,900,900italic" rel="stylesheet" type="text/css"><?php wp_head(); ?>
  </head>
  <body class="<?php body_class(); ?>">
    <div class="wrapper">
      <header class="header">
        <div class="shell">
          <div class="header-inner clear">
            <nav class="nav">
              <?php wp_nav_menu( array(
                'menu' => 'pw30',
                'theme_location' => 'main-menu',
                'container' => false
              ) ); ?>
            </nav>
            <div class="header-body"><a class="btn-menu" href="#"><i class="ico-menu"></i></a><a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></div>
          </div>
        </div>
      </header>
      <div class="wrapper-inner"></div>
    </div>
  </body>
</html>