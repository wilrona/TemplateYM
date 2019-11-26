<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 03/10/2017
 * Time: 12:02
 */

add_theme_support( 'post-thumbnails' );

/* suppression de la barre d'administration sur le template */
add_filter('show_admin_bar','__return_false');

// action a faire pour activer une page d'option de theme
add_filter('tr_theme_options_page', function() {
	return get_template_directory() . '/app/theme/theme.options.php';
});

add_filter('tr_theme_options_name', function() {
	return 'ym_options';
});

/*
|-----------------------------------------------------------------------
| Sky Date in French by Matt - www.skyminds.net
|-----------------------------------------------------------------------
|
| Returns or echoes the date in French format (dd/mm/YYYY) for WordPress themes.
|
*/
function sky_date_french($format, $timestamp = null, $echo = null) {
	$param_D = array('', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim');
	$param_l = array('', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
	$param_F = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	$param_M = array('', 'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc');
	$return = '';
	if(is_null($timestamp)) { $timestamp = mktime(); }
	for($i = 0, $len = strlen($format); $i < $len; $i++) {
		switch($format[$i]) {
			case '\\' : // fix.slashes
				$i++;
				$return .= isset($format[$i]) ? $format[$i] : '';
				break;
			case 'D' :
				$return .= $param_D[date('N', $timestamp)];
				break;
			case 'l' :
				$return .= $param_l[date('N', $timestamp)];
				break;
			case 'F' :
				$return .= $param_F[date('n', $timestamp)];
				break;
			case 'M' :
				$return .= $param_M[date('n', $timestamp)];
				break;
			default :
				$return .= date($format[$i], $timestamp);
				break;
		}
	}
	if(is_null($echo)) { return $return;} else { echo $return;}
}


/**
 * Function to create and display error and success messages
 * @access public
 *
 * @param string $name
 * @param string $message
 * @param string $class
 * @param bool $card
 *
 */
function flash( $name = '', $message = '', $class = 'uk-alert-success')
{
	//We can only do something if the name isn't empty
	if( !empty( $name ) )
	{
		//No message, create it
		if( !empty( $message ) && empty( $_SESSION[$name] ) )
		{
			if( !empty( $_SESSION[$name] ) )
			{
				unset( $_SESSION[$name] );
			}
			if( !empty( $_SESSION[$name.'_class'] ) )
			{
				unset( $_SESSION[$name.'_class'] );
			}

			$_SESSION[$name] = $message;
			$_SESSION[$name.'_class'] = $class;
		}


		//Message exists, display it
		elseif( !empty( $_SESSION[$name] ) && empty( $message ) )
		{
			$text_button = __('Consulter le panier' , 'yoomee');

			$class = !empty( $_SESSION[$name.'_class'] ) ? $_SESSION[$name.'_class'] : 'uk-alert-success';

			$filter_class = explode(" ", $class);
			if(!in_array('uk-alert-empty', $filter_class)):
				echo '<div class="'.$class.'" style="border: 1px solid #d2d2d8" uk-alert> <a class="uk-alert-close" uk-close></a> <p> <a href="'.get_the_permalink(tr_options_field('ym_options.cart')).'" class="uk-button uk-button-yoomee-black uk-margin-medium-right">'.$text_button.'</a>'.$_SESSION[$name].'</p></div>';
			else:
				echo '<div class="'.$class.'" style="border: 1px solid #d2d2d8" uk-alert> <a class="uk-alert-close" uk-close></a> <p>'.$_SESSION[$name].'</p></div>';
			endif;

			unset($_SESSION[$name]);
			unset($_SESSION[$name.'_class']);
		}
	}
}