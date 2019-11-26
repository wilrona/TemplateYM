<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 03/10/2017
 * Time: 12:07
 */


# ajout des elements css et js dans mon template
function themeprefix_bootstrap_modals   () {


	wp_register_script ( 'uikit' , get_stylesheet_directory_uri() . '/js/uikit.js', array( 'jquery' ), '1.1', true );
	wp_register_script ( 'uikit-icons' , get_stylesheet_directory_uri() . '/js/uikit-icons.js', '', '1.1', true );
	wp_register_script ( 'owl.carousel' , get_stylesheet_directory_uri() . '/js/owl.carousel.js', '', '1', true );
	wp_register_script ( 'dotdot' , get_stylesheet_directory_uri() . '/js/jquery.dotdotdot.js', '', '1', true );
	wp_register_script ( 'waypoints' , get_stylesheet_directory_uri() . '/js/waypoints.js', '', '1', true );
	wp_register_script ( 'counterup' , get_stylesheet_directory_uri() . '/js/jquery.counterup.js', '', '1', true );
	wp_register_script ( 'hover-slider' , get_stylesheet_directory_uri() . '/js/hover-slider.js', '', '1', true );
	wp_register_script ( 'app' , get_stylesheet_directory_uri() . '/js/app.js', '', '1', true );


	wp_register_style ( 'uikit' , get_stylesheet_directory_uri() . '/css/uikit.css', '' , '1.1', 'all' );
	wp_register_style ( 'owl.carousel' , get_stylesheet_directory_uri() . '/css/owl.carousel.css', '' , '', 'all' );
	wp_register_style ( 'owl.carousel.default' , get_stylesheet_directory_uri() . '/css/owl.theme.default.css', '' , '', 'all' );
	wp_register_style ( 'app' , get_stylesheet_directory_uri() . '/css/app-custom.css', '' , '1.2', 'all' );

//    wp_enqueue_script( 'jquerymigration' );

	wp_enqueue_script( 'uikit' );
	wp_enqueue_script( 'uikit-icons' );
	wp_enqueue_script( 'owl.carousel' );
	wp_enqueue_script( 'dotdot' );
	wp_enqueue_script( 'waypoints' );
	wp_enqueue_script( 'counterup' );
	wp_enqueue_script( 'hover-slider' );
	wp_enqueue_script( 'app' );

	wp_enqueue_style( 'uikit' );
	wp_enqueue_style( 'owl.carousel' );
	wp_enqueue_style( 'owl.carousel.default' );
	wp_enqueue_style( 'app' );
}

add_action( 'wp_enqueue_scripts', 'themeprefix_bootstrap_modals');

function datepicker(){
	wp_register_script ( 'uikit' , get_stylesheet_directory_uri() . '/js/uikit.js', array( 'jquery' ), '1.1', true );
	wp_register_script ( 'uikit-icons' , get_stylesheet_directory_uri() . '/js/uikit-icons.js', '', '1.1', true );
	wp_register_script( 'datepicker', get_stylesheet_directory_uri().'/js/datepicker.js', '', '1.0', true );
	wp_register_script( 'datepicker.fr', get_stylesheet_directory_uri().'/js/datepicker.fr-FR.js', '', '1.0', true );


	wp_register_style ( 'uikit' , get_stylesheet_directory_uri() . '/css/uikit.css', '' , '1.1', 'all' );
	wp_register_style( 'datepickercss', get_stylesheet_directory_uri().'/css/datepicker.css', false, '1.0', 'all' );

	wp_enqueue_script( 'uikit' );
	wp_enqueue_script( 'uikit-icons' );

	wp_enqueue_script( 'datepicker' );
	wp_enqueue_script( 'datepicker.fr' );

	wp_enqueue_style( 'uikit' );
	wp_enqueue_style( 'datepickercss' );
}

add_action( 'wp_enqueue_scripts', 'datepicker');
add_action( 'admin_enqueue_scripts', 'datepicker');

function datepicker_script_admin(){
	?>

	<script type='text/javascript'>
        jQuery(document).ready(function ($) {
            if( $('.datepicker').length > 0 ) {
                $('.datepicker').datepicker({
                    language: 'fr-FR',
                    format: 'dd/mm/yyyy',
                    autoHide: true
                });
            }
        });
	</script>


	<?php

}

add_action( 'admin_footer', 'datepicker_script_admin');