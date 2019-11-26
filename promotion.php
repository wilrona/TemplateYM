<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 17/07/2017
 * Time: 15:17
 */

?>

<?php /* Template Name: Pages Promotion */ ?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php $page_id = get_the_ID(); ?>
		<?php $blocks = tr_posts_field('blockpromotion'); ?>

        <?php if($blocks): ?>
        <div class="uk-section uk-padding-remove-bottom">
            <div class="uk-container">
                <div class="">
                    <div class="uk-margin" uk-grid>
                        <div class="uk-width-1-1">
        <!--                    <h1 class="uk-text-yoomee uk-border-bottom">-->
        <!--                        Promotion du mois-->
        <!--                    </h1>-->
                            <div class="owl-carousel owl-theme owl-carousel-produit">
                                <?php foreach ($blocks as $block):?>
                                    <div class="item">

                                        <a href="<?= get_permalink($block['linkpromotion'])?>" class="uk-display-block">
                                            <img src="<?php echo wp_get_attachment_image_src($block['imagepromotion'], 'full')[0] ?>" alt="" class="uk-responsive-width">

                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-box-shadow-large uk-margin-bottom" style="height: 70px">

            </div>
        </div>
        <?php endif; ?>

	<?php endwhile; ?>
<?php endif; ?>


<div class="uk-section uk-section-about">
    <div class="uk-container uk-container-large ">
<!--        <h1 class="uk-heading-line uk-text-uppercase"><span>Promotion Online</span></h1>-->
        <ul class="uk-subnav uk-subnav-divider uk-flex-center uk-subnav-color uk-subnav-content" uk-margin>
            <?php $get = $_GET['type_produit']; ?>
            <li <?php if(empty($get)): ?> class="uk-active" <?php endif; ?>><a href="<?php echo esc_url( get_page_link( $page_id ) ); ?>"><?php pll_e('Tous' , 'yoomee'); ?></a></li>
            <?php

                $terms = get_terms([
                    'taxonomy' => 'type_produit',
                    'hide_empty' => true,
                    'orderby' => 'ID',
                    'order' => 'ASC'
                ]);


                foreach ($terms as $term):
            ?>

                <li <?php if($get == $term->slug): ?> class="uk-active" <?php endif; ?>><a href="<?php echo esc_url( get_page_link( $page_id ) ); ?>?type_produit=<?= $term->slug ?>"><?= $term->name ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class="uk-section uk-section-large uk-section-service uk-position-relative uk-section-shopping">
    <div class="uk-container">
	    <?php flash('flash_cart'); ?>
        <?php

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        if($get):

            $custom_args = array(
                'post_type' => 'produit',
                'posts_per_page' => 10,
                'paged' => $paged,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'type_produit',
                        'field' => 'slug',
                        'terms' => $get,
                    ),
                ),
                'meta_query' => array(
                    array(
                        'key' => 'activer_promotion',
                        'value' => true,
                        'compare' => '=',
                    )
                )
            );

        else:

            $custom_args = array(
                'post_type' => 'produit',
                'posts_per_page' => 10,
                'paged' => $paged,
                'meta_query' => array(
                    array(
                        'key' => 'activer_promotion',
                        'value' => true,
                        'compare' => '=',
                    )
                )
            );

        endif;



        $custom_query = new WP_Query( $custom_args );

        if ( $custom_query->have_posts() ) :
        ?>
        <div class="uk-margin-small uk-child-width-1-4@m" uk-grid>
            <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
            <div>
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
                            <a href="<?= get_the_permalink($post->ID) ?>" class="uk-button uk-button-yoomee uk-width-1-1 uk-display-block uk-padding-remove uk-float-right add_panier_other" id="<?= $post->ID ?>"><?php pll_e('Ajouter au panier' , 'yoomee'); ?></a>
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
            <div class="uk-height-small uk-text-center">
                <h1 class="uk-heading-primary">Aucun produit/offre en promotion </h1>
            </div>
        <?php endif; ?>


    </div>

</div>

<?php get_footer(); ?>
