<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 27/04/2018
 * Time: 10:58
 */

?>

<?php

    $produits = $_SESSION['panier'];

?>

<h2>Votre panier</h2>
<?php
    if($produits):
?>
    <ul class="uk-list uk-cart-list">
        <?php
            $total = 0;
            foreach ($produits as $prod):
        ?>
        <li>
            <a class="remove remove_product" id="<?= $prod['id'] ?>">x</a>
            <a href="<?= get_the_permalink($prod['id']) ?>" class="uk-cart-content">
                <img width="50" height="50" src="<?= $prod['img'] ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="">
                <span><?= $prod['nom'] ?></span>
            </a>
            <span class="quantity"> <?= $prod['qte'] ?> x <?= $prod['prix'] ?> XAF</span>

        </li>
                <?php
                    $montant = $prod['qte'] * $prod['prix'];
                    $total += $montant;
                ?>
        <?php endforeach; ?>
    </ul>
    <p class="woocommerce-mini-cart__total total">
        <strong>Total :</strong>
        <span class="woocommerce-Price-amount amount"><span>
        <span class="woocommerce-Price-currencySymbol"><?= $total ?> XAF</span>
    </p>

<p class="woocommerce-mini-cart__buttons buttons">
    <a href="<?= get_the_permalink(tr_options_field('ym_options.cart')); ?>" class="uk-button uk-button-yoomee-shop-2 uk-button-small"><?php pll_e('Panier' , 'yoomee'); ?></a>
    <a href="<?= get_the_permalink(tr_options_field('ym_options.checkout')); ?>" class="uk-button uk-button-yoomee-shop-2 uk-button-small"><?php pll_e('Payez' , 'yoomee'); ?></a>
</p>
<?php else: ?>
    <div class="widget_shopping_cart_content">
        <p class="woocommerce-mini-cart__empty-message"><?php pll_e('Aucun produit dans votre panier' , 'yoomee'); ?></p>
    </div>
<?php endif; ?>



<h2>Catégories</h2>

<ul class="uk-list uk-list-shop">
	<li class="uk-margin-bottom"><a href="<?php echo esc_url(get_page_link('62')); ?>"  class="uk-link-reset">Tous</a></li>
	<?php

	$terms = get_terms([
		'taxonomy' => 'type_produit',
		'hide_empty' => true,
		'orderby' => 'ID',
		'order' => 'ASC'
	]);


	foreach ($terms as $term):
		?>
		<li class="uk-margin-bottom"><a href="<?php echo get_term_link($term) ?>" class="uk-link-reset"><?= $term->name ?></a></li>
	<?php endforeach; ?>
</ul>



<?php
$promot_shop = array(
	'post_type' => 'produit',
	'posts_per_page' => 2,
	'orderby'=> 'rand',
	'lang' => pll_current_language(),
	'meta_query' => array(
		array(
			'key' => 'activer_promotion',
			'value' => true,
			'compare' => '=',
		)
	)
);

$shop = new WP_Query( $promot_shop );

if($shop->have_posts()):

	?>
	<h2>Promotions</h2>

	<?php while ( $shop->have_posts() ) : $shop->the_post(); ?>

    <a href="<?= get_the_permalink(); ?>" class="uk-link-reset uk-display-block">
        <div class="uk-text-center">

            <div class="uk-inline-clip uk-width-1-1 uk-transition-toggle uk-light" tabindex="0" style="background-color: #f6f6f6; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);">
                <?=  get_the_post_thumbnail( $post->ID, 'medium');?>
                <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle">
                    <div>
                        <div class="uk-transition-slide-top-small"><h3 class="uk-margin-remove"><?= get_post_meta($post->ID, 'prix_promo', true) ?> FCFA</h3></div>
                        <div class="uk-transition-slide-bottom-small"><h3 class="uk-margin-remove"><del><?= get_post_meta($post->ID, 'prix', true) ?> FCFA</del></h3></div>
                    </div>
                </div>
            </div>
        </div>
    </a> <br>
<?php endwhile; ?>

<?php endif; ?>
