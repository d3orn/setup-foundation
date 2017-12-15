<?php
    /* ------------------------------------------------ */
    /* 1. CONSTANTS */
    /* ------------------------------------------------ */
    define( 'THEMEROOT', get_stylesheet_directory_uri() );
    define( 'IMAGES', THEMEROOT . '/img' );
    define( 'JS', THEMEROOT . '/js' );

    /* ------------------------------------------------ */
    /* 6. SCRIPTS */
    /* ------------------------------------------------ */
    if ( ! function_exists( 'tuts_scripts' ) ) {
        function tuts_scripts() {
            /* Register scripts. */
            wp_register_script( 'functions', JS . '/functions.js', false, false, true );

            /* Load the custom scripts. */
            wp_enqueue_script( 'functions' );

            /* Load the stylesheets. */
            wp_enqueue_style( 'main-css', THEMEROOT . '/css/style.css' );
        }

        add_action( 'wp_enqueue_scripts', 'tuts_scripts' );
    }


    function register_my_menus() {
        register_nav_menus(
            array(
                'new-menu' => __( 'New Menu' ),
                'another-menu' => __( 'Another Menu' ),
                'an-extra-menu' => __( 'An Extra Menu' )
            )
        );
    }
    add_action( 'init', 'register_my_menus' );

?>
