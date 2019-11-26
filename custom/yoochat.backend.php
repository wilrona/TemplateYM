<?php

// Creation du menu du plugin yoochat
$chat = tr_page('yoochat', 'index', 'Yoo Live Tchat');
$chat->setIcon('send');
$chat->useController();
$chat->setArgument('capability', 'conversation');

$conversation = tr_page('yoochat', 'listing_operator', 'Vos opérateurs');
$conversation->setArgument('capability', 'list_operator');
$conversation->useController();
$conversation->setParent($chat);


$parametrage = tr_page('yoochat', 'parametrage', 'Parametres');
$parametrage->setArgument('capability', 'config');
$parametrage->useController();
$parametrage->setParent($chat);


// parametrage des assets qui seront utilisé dans le backend de l'application

function admin_script(){

	if($_GET["page"] == 'yoochat_index'){
		wp_register_script ( 'firebase' , 'https://www.gstatic.com/firebasejs/4.6.0/firebase.js', '', '1', true );
		wp_register_script ( 'uikit' , get_stylesheet_directory_uri() . '/js/uikit.js', array( 'jquery' ), '1', true );
		wp_register_script ( 'uikit-icons' , get_stylesheet_directory_uri() . '/js/uikit-icons.js', '', '1', true );
		wp_register_script ( 'ifvisible' , get_stylesheet_directory_uri() . '/js/ifvisible.js', '', '1', true );
		wp_register_script ( 'jquery.cookies' , get_stylesheet_directory_uri() . '/js/jquery.cookies.js', '', '1', true );
		wp_register_script ( 'yoochat.backend' , get_stylesheet_directory_uri() . '/js/yoochat.backend.js', '', '1', true );

		wp_enqueue_script( 'firebase' );
		wp_enqueue_script( 'uikit' );
		wp_enqueue_script( 'uikit-icons' );
		wp_enqueue_script( 'ifvisible' );
		wp_enqueue_script( 'jquery.cookies' );
		wp_enqueue_script( 'yoochat.backend' );

		wp_register_style ( 'uikit' , get_stylesheet_directory_uri() . '/css/uikit-apps.css', '' , '', 'all' );
		wp_register_style ( 'awesome' , get_stylesheet_directory_uri() . '/css/font-awesome.css', '' , '', 'all' );
		wp_register_style ( 'yoochat.backend' , get_stylesheet_directory_uri() . '/css/yoochat.backend.css', '' , '', 'all' );

		wp_enqueue_style( 'uikit' );
		wp_enqueue_style( 'awesome' );
		wp_enqueue_style( 'yoochat.backend' );

		$firebase = array(
			'apiKey' => tr_options_field('config_yoochat.apikey'),
			'authDomain' => tr_options_field('config_yoochat.authdomain'),
			'databaseURL' => tr_options_field('config_yoochat.databaseurl'),
			'projectId' => tr_options_field('config_yoochat.projectid'),
			'storageBucket' => tr_options_field('config_yoochat.storagebucket'),
			'messagingSenderId' => tr_options_field('config_yoochat.messagingsenderid'),
		);

		$data_array = array(
			'firebase' => $firebase,
			'current_user_id' => wp_get_current_user()->ID,
			'current_user' => wp_get_current_user()->display_name
		);

		wp_localize_script( 'yoochat.backend', 'data', $data_array );
	}

}

add_action( 'admin_enqueue_scripts', 'admin_script');

// Creattion des roles de yoo live chat
add_action('init', 'createUserRole');

function createUserRole()
{

	remove_role('yoo_op');
	remove_role('yoo_op_manager');

	// Adding a new role with all admin caps.
	add_role('yoo_op', 'Yoochat Operateur', array('read' => true, 'edit_users' => false, 'edit_posts' => false));
	add_role('yoo_op_manager', 'Yoochat Manager', array('read' => true, 'edit_users' => false, 'edit_posts' => false));

	$opetaror_role = get_role( 'yoo_op' );
	$opetaror_role->add_cap('conversation');
	$opetaror_role->add_cap('rapport');
	$opetaror_role->add_cap('phrase_predefinie');

	$manager_opetaror_role = get_role( 'yoo_op_manager' );
	$manager_opetaror_role->add_cap('historique');
	$manager_opetaror_role->add_cap('msq_hors_ligne');
	$manager_opetaror_role->add_cap('conversation');
	$manager_opetaror_role->add_cap('rapport');
	$manager_opetaror_role->add_cap('phrase_predefinie');
	$manager_opetaror_role->add_cap('list_operator');
	$manager_opetaror_role->add_cap('config');

	$administrator_role = get_role( 'administrator' );
	$administrator_role->add_cap('historique');
	$administrator_role->add_cap('msq_hors_ligne');
	$administrator_role->add_cap('conversation');
	$administrator_role->add_cap('rapport');
	$administrator_role->add_cap('phrase_predefinie');
	$administrator_role->add_cap('list_operator');
	$administrator_role->add_cap('config');
}

// Définition de la connexion et déconnexion de l'utilisateur

add_action('wp_login', 'store_last_login', 99);

function store_last_login($current_user) {
	$user = get_user_by('login', $current_user);
	update_user_meta($user->ID, 'logged', 1);
}

function users_last_login() {
	$cur_login = current_time('mysql', 1);
	$userinfo = wp_get_current_user();
	var_dump($userinfo);
	update_user_meta( $userinfo->ID, 'last_login', $cur_login );
	update_user_meta($userinfo->ID, 'logged', 0);
}
add_action('wp_logout', 'users_last_login', 10);
