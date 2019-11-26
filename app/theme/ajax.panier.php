<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 04/05/2018
 * Time: 11:49
 */


add_action('wp_ajax_load_panier_by_ajax', 'load_panier_by_ajax_callback');
add_action('wp_ajax_nopriv_load_panier_by_ajax', 'load_panier_by_ajax_callback');



function load_panier_by_ajax_callback() {
	check_ajax_referer( 'load_more_panier', 'security' );

	if(!isset($_SESSION['panier'])){
		$_SESSION['panier'] = [];
		$produits = [];
	}else{
		$produits = $_SESSION['panier'];
	}
	$current_produit = get_post($_POST['current_post']);


	$exist_prod = false;
	$action_delete = false;

	if($_POST['type'] == 'remove_product'):
		foreach ($produits as $key => $prod){
			if($prod['id'] === $_POST['current_post']){
				unset($produits[$key]);
				$action_delete = true;

			}
		}
		if(count($produits)):
			flash('flash_cart', 'Le produit "'.$current_produit->post_title.'" a été supprimé de votre panier', 'uk-alert uk-padding-small uk-margin-medium-bottom');
		else:
			flash('flash_cart', 'Votre panier est vide', 'uk-alert uk-alert-empty uk-padding-small uk-margin-medium-bottom');
			unset($_SESSION['coupon']);
		endif;
	else:

		if($_POST['type'] == 'update_qte_product' ):

			foreach ($produits as &$prod){
				if(in_array($prod['id'], $_POST['id'])):

					$index = array_search($prod['id'], $_POST['id']);

					$prod['qte'] = $_POST['quantite'][$index];

					$exist_prod = true;
					flash('flash_cart', ' Votre panier a été mise à jour', 'uk-alert uk-alert-empty uk-padding-small uk-margin-medium-bottom');
				endif;
			};

		else:


			if($_POST['type'] == 'ckeck_coupon'):

				if(!isset($_SESSION['coupon'])){
					$_SESSION['coupon'] = [];
				}


				$arg_promo = array(
					'post_type' => 'code'
				);

				$custom_query = new WP_Query($arg_promo);

				$exist_prod = true;

				while ( $custom_query->have_posts() ) : $custom_query->the_post();

					if(strtolower(get_the_title()) == strtolower($_POST['input']) && strtotime(tr_posts_field('dateendcoupon', get_the_ID())) >= time()){
						$counter = tr_posts_field('countcoupon', get_the_ID());
						if(!isset($counter)){
							add_post_meta(get_the_ID(), 'countcoupon', 0, true);
						};

						$limite = false;

						if(tr_posts_field('nbrecoupon', get_the_ID()) > 0 ){
							if(tr_posts_field('countcoupon', get_the_ID()) >= tr_posts_field('nbrecoupon', get_the_ID())){
//								$count = tr_posts_field('countcoupon', get_the_ID());
//								$count += 1;
//								update_post_meta(get_the_ID(), 'countcoupon', $count, true);
//							}else{
								flash('flash_cart', 'Ce coupon a atteint son nombre limite d\'utilisation.', 'uk-alert uk-alert-empty uk-padding-small uk-margin-medium-bottom');
								$limite = true;
							}
						}

						if(!$limite):
							flash('flash_cart', 'Le coupon '.get_the_title().' a été ajouté dans votre panier.', 'uk-alert uk-alert-empty uk-padding-small uk-margin-medium-bottom');
							$_SESSION['coupon']['code'] = get_the_title();
							$_SESSION['coupon']['valeur'] = tr_posts_field('valeurcoupon', get_the_ID());
							$_SESSION['coupon']['type'] = tr_posts_field('typevaleur', get_the_ID());
						endif;
					}

				endwhile;

			else:
				foreach ($produits as &$prod){
					if($prod['id'] === $_POST['current_post']){
						$prod['qte'] += 1;
						$exist_prod = true;
						flash('flash_cart', 'Le produit "'.$current_produit->post_title.'" a été mise à jour dans votre panier', 'uk-alert uk-padding-small uk-margin-medium-bottom');
					}
				}

			endif;
		endif;
	endif;


	if(!$exist_prod && !$action_delete){


		$promo = get_post_meta($current_produit->ID, 'activer_promotion', true);

		$prix = get_post_meta($current_produit->ID, 'prix', true);
		if($promo):
			$prix = get_post_meta($current_produit->ID, 'prix_promo', true);
		endif;

		$produit = array(
			'qte' => 1,
			'prix' => $prix,
			'nom' => $current_produit->post_title,
			'img' => get_the_post_thumbnail_url($current_produit->ID),
			'id' => $_POST['current_post']
		);

		array_push($produits, $produit);

		flash('flash_cart', '"'.$current_produit->post_title.'" a été ajoutée à votre panier', 'uk-alert uk-padding-small uk-margin-medium-bottom', 'true');
	}


	$_SESSION['panier'] = $produits;


	if($_POST['type'] == 'other'){
		echo get_the_permalink($_POST['current_post']);
	}else{
		echo $_POST['current_url'];
	}
	wp_die();
}

