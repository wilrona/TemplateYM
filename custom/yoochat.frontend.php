<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 19/10/2017
 * Time: 15:05
 */


function frontend_script() {


	wp_register_script ( 'firebase' , 'https://www.gstatic.com/firebasejs/4.6.0/firebase.js', '', '1', true );
	wp_register_script ( 'yoochat.frontend' , get_stylesheet_directory_uri() . '/js/yoochat.frontend.js', array( 'jquery' ), '1', true );
	wp_register_script ( 'ifvisible' , get_stylesheet_directory_uri() . '/js/ifvisible.js', '', '1', true );
	wp_register_script ( 'jquery.cookies' , get_stylesheet_directory_uri() . '/js/jquery.cookies.js', '', '1', true );

	wp_register_style ( 'yoochat.frontend' , get_stylesheet_directory_uri() . '/css/yoochat.frontend.css', '' , '', 'all' );


	wp_enqueue_script( 'firebase' );
	wp_enqueue_script( 'yoochat.frontend' );
	wp_enqueue_script( 'ifvisible' );
	wp_enqueue_script( 'jquery.cookies' );

	wp_enqueue_style( 'yoochat.frontend' );

	$firebase = array(
		'apiKey' => tr_options_field('config_yoochat.apikey'),
		'authDomain' => tr_options_field('config_yoochat.authdomain'),
		'databaseURL' => tr_options_field('config_yoochat.databaseurl'),
		'projectId' => tr_options_field('config_yoochat.projectid'),
		'storageBucket' => tr_options_field('config_yoochat.storagebucket'),
		'messagingSenderId' => tr_options_field('config_yoochat.messagingsenderid'),
	);

	$data_array = array(
		'url_admin' =>  admin_url( 'admin-ajax.php' ),
		'secur' => wp_create_nonce("load_yoochat"),
		'firebase' => $firebase

	);
	wp_localize_script( 'yoochat.frontend', 'data', $data_array );
}

add_action( 'wp_enqueue_scripts', 'frontend_script');


add_action('wp_ajax_load_yoochat_frontend', 'load_yoochat_frontend_callback');
add_action('wp_ajax_nopriv_load_yoochat_frontend', 'load_yoochat_frontend_callback');


function load_yoochat_frontend_callback() {
	check_ajax_referer( 'load_yoochat', 'security' );

	include 'chatbox.php';

	wp_die();
}