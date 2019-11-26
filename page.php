<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 17/07/2017
 * Time: 12:10
 */

?>

<?php get_header(); ?>


<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>


    <div class="uk-section uk-section-about">
        <div class="uk-container uk-container-large ">

            <?php
            if (get_child_pages_by_parent_title($post->post_parent)):
                ?>

                <ul class="uk-subnav uk-subnav-divider uk-flex-center uk-subnav-color uk-subnav-content" uk-margin>
                    <?php  foreach (get_child_pages_by_parent_title($post->post_parent) as $child): ?>
                        <li <?php if($post->ID === $child->ID): ?> class="uk-active" <?php endif; ?>><a href="<?php echo esc_url( get_page_link( $child->ID ) ); ?>"><?= $child->post_title; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

    </div>

        <div class="uk-section uk-position-relative uk-section-service">
            <div class="uk-container">
                <div class="uk-margin uk-grid-large" uk-grid>
                    <div class="uk-width-1-1@m  uk-text-justify uk-text-home-abouts">

                        <div class="">
                            <?php the_content() ?>
                        </div>
	                    <?php flash('flash_cart'); ?>


                        <?php $term_custom_page = get_the_terms( $post->ID, 'type_produit' );?>


                        <?php if($term_custom_page): ?>
                            <div class="uk-section uk-section-small uk-section-shopping">




                            <div class="uk-padding-small uk-width-1-3@m uk-text-center uk-margin-auto uk-margin-large-bottom uk-border-bottom">
                                <h2 class="uk-text-yoomee uk-margin-remove"><?php pll_e('Offres correspondantes' , 'yoomee'); ?></h2>
                            </div>
                            <?php
                            $custom_args = array(
                                'post_type' => 'produit',
                                'posts_per_page' => 6,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'type_produit',
                                        'field' => 'slug',
                                        'terms' => $term_custom_page[0]->slug,
                                    ),
                                )
                            );

                            $custom_query = new WP_Query( $custom_args );

                            if ( $custom_query->have_posts() ) :
                                ?>
                                <div class="owl-carousel owl-theme" id="owl-carousel-product">
                                    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                                        <div class="item uk-padding-small">

                                            <div class="uk-card uk-card-default uk-card-small">
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
                            <?php endif; ?>
                            <div class="uk-flex-center uk-text-center uk-padding-small uk-margin-medium-top">
                                <a href="<?= esc_url(get_term_link($term_custom_page[0])); ?>" class="uk-button uk-button-yoomee-shop"><?php pll_e('Voir toutes les offres' , 'yoomee'); ?></a>
                            </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>


            </div>

        </div>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>
