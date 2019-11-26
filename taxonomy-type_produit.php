<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 26/10/2017
 * Time: 11:22
 */
?>

<?php get_header(); ?>


<div class="uk-section uk-section-large uk-position-relative uk-section-shopping">
	<div class="uk-container">
		<?php
		global $enhanced_category;
		//get enhanced category post and set it up as global current post
		$enhanced_category->setup_ec_data();

		?>
		<div class="uk-width-1-1 uk-margin-large-bottom">
			<?php the_content(); ?>
			<hr>
		</div>

        <div class="uk-gruid-large" uk-grid>
            <div class="uk-width-3-4@m">

	            <?php flash('flash_cart'); ?>

	            <?php

	            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;



	            //        if (empty($get)) :
	            //            $custom_args = array(
	            //                'post_type' => 'produit',
	            //                'posts_per_page' => 10,
	            //                'paged' => $paged,
	            //                'lang' => pll_current_language()
	            //            );
	            //        else:
	            $custom_args = array(
		            'post_type' => 'produit',
		            'posts_per_page' => 10,
		            'paged' => $paged,
		            'lang' => pll_current_language(),
		            'tax_query' => array(
			            array(
				            'taxonomy' => 'type_produit',
				            'field' => 'slug',
				            'terms' => get_queried_object()->slug,
			            ),
		            )
	            );

	            //        endif;
	            $custom_query = new WP_Query( $custom_args );


	            if ( $custom_query->have_posts() ) :
		            ?>
                    <div class="uk-margin-small uk-child-width-1-3@l" uk-grid>
			            <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                            <div>
                                <div class="uk-card uk-card-default uk-card-small">
                                    <a href="<?= get_the_permalink($post->ID) ?>" class="uk-display-block uk-link-reset">
                                        <div class="uk-card-media-top uk-cover-container uk-text-center" style="background-color: #f6f6f6;">
                                            <div class="uk-height-1-1 uk-inline-clip uk-transition-toggle uk-flex uk-flex-middle uk-flex-center">
                                                <?=  get_the_post_thumbnail( $post->ID, 'medium', array('style' => 'height: 100%; width: 300px;', 'class' => 'uk-transition-scale-up uk-transition-opaque uk-responsive-height uk-responsive-width'));?>
                                            </div>

                                            <canvas width="300" height="20"></canvas>
                                        </div>
                                        <div class="uk-card-body uk-height-small">
                                            <h3 class="uk-card-title uk-text-yoomee uk-text-truncate"><?= the_title(); ?></h3>
                                            <?php $term_custom = get_the_terms( $post->ID, 'type_produit' );?>
                                            <span class="uk-label uk-card-label"><?= $term_custom[0]->name; ?></span>
                                            <?php $promo = get_post_meta($post->ID, 'activer_promotion', true) ?>
                                            <?php if($promo): ?>
                                                <span class=" uk-display-block"><span class="uk-promotion"><?= get_post_meta($post->ID, 'prix_promo', true) ?> FCFA</span>
                                                <del><small><?= get_post_meta($post->ID, 'prix', true) ?> FCFA</small></del></span>
                                            <?php else: ?>
                                            <span class=" uk-display-block"><?= get_post_meta($post->ID, 'prix', true) ?> FCFA
                                                <?php endif; ?>
                                        </div>
                                    </a>
                                    <div class="uk-card-footer uk-padding-remove">
	                                    <?php $obtenir = get_post_meta($post->ID, 'type_service', true) ?>
	                                    <?php
	                                    if($obtenir == 'telephone' || $obtenir == 'modem' || $obtenir == 'carte'):
		                                    ?>
                                            <a href="<?= get_the_permalink($post->ID) ?>" class="uk-button uk-button-yoomee uk-width-1-1 uk-display-block uk-padding-remove uk-float-right add_panier" id="<?= $post->ID ?>"><?php pll_e('Ajouter au panier' , 'yoomee'); ?></a>
		                                    <?php
                                        else:
		                                    ?>
                                            <a href="https://my.yoomee.cm/" target="_blank" class="uk-button uk-button-yoomee uk-width-1-1 uk-display-block uk-padding-remove uk-float-right"><?php pll_e('Ajouter au panier' , 'yoomee'); ?></a>
	                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
			            <?php endwhile; ?>
                    </div>

		            <?php
		            if (function_exists(kriesi_pagination)) {
			            kriesi_pagination($custom_query->max_num_pages);
		            }
		            ?>
	            <?php else: ?>
                    <div class="uk-height-small">
                        <h1 class="uk-heading-primary"><?php pll_e('Aucun produit/offre en cours' , 'yoomee'); ?></h1>
                    </div>
	            <?php endif; ?>

            </div>
            <div class="uk-width-1-4@m">

	            <?php set_query_var( 'get_queried_object', get_queried_object() ) ?>

		        <?php get_template_part( 'shop-menu' ); ?>


            </div>
        </div>

	</div>

</div>

<?php get_footer(); ?>
