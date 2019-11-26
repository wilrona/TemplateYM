<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 17/07/2017
 * Time: 12:10
 */

?>
<?php /* Template Name: Page speciale */ ?>

<?php get_header(); ?>


<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <?php

        $promot_shop = array(
            'post_type' => 'promotion',
            'posts_per_page' => 1,
            'orderby'=> 'rand',
            'meta_query' => array(
                array(
                    'key' => 'active',
                    'value' => true,
                    'compare' => '=',
                )
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'position',
                    'field' => 'slug',
                    'terms' => 'right-ads',
                ),
            )
        );

        $shop = new WP_Query( $promot_shop );


            ?>

        <div class="uk-section uk-position-relative">
            <div class="uk-container  <?php if($shop->have_posts()): ?> uk-container-large <?php endif; ?>">
                <div class="uk-margin uk-grid-large" uk-grid>
                    <div class="<?php if($shop->have_posts()): ?>uk-width-3-4 <?php else: ?> uk-width-1-1 <?php endif; ?> uk-text-justify uk-text-home-abouts">
                        <h1 class="uk-text-center">
                            <?php the_title() ?>
                        </h1>
                        <div class="uk-padding uk-margin-small-bottom">
                            <?php the_content() ?>
                        </div>
                        <?php $term_custom = get_the_terms( $post->ID, 'type_produit' );?>

                        <?php if($term_custom): ?>
                            <div class="uk-section uk-section-small uk-section-service">


                                <div class="uk-padding-small uk-width-1-2 uk-text-center uk-margin-auto uk-margin-large-bottom uk-border-bottom">
                                    <h2 class="uk-text-yoomee uk-margin-remove"><?php pll_e('Services/Offres Correspondants' , 'yoomee'); ?></h2>
                                </div>
                                <?php
                                $terms = [];
                                foreach ($term_custom as $term){
                                    $terms[] = $term->slug;
                                }

                                $custom_args = array(
                                    'post_type' => 'produit',
                                    'posts_per_page' => 9,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'type_produit',
                                            'field' => 'slug',
                                            'terms' => $terms,
                                        ),
                                    )
                                );

                                $custom_query = new WP_Query( $custom_args );

                                if ( $custom_query->have_posts() ) :
                                    ?>
                                    <div class="owl-carousel owl-theme" id="owl-carousel-product">
                                        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                                            <div class="item uk-padding-small">
                                                <a href="<?php echo esc_url( get_page_link( $post->ID ) ); ?>" class="uk-display-block">
                                                    <div class="uk-inline uk-padding-small" style="background-color: #f6f6f6;">
                                                        <?=  get_the_post_thumbnail( $post->ID, 'medium');?>
                                                        <div class="uk-overlay uk-overlay-primary uk-position-bottom  uk-text-center">
                                                            <p><?php the_title(); ?> </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="uk-flex-center uk-text-center uk-padding-small uk-margin-medium-top">
                                    <a href="<?php echo esc_url( get_page_link( '62' ) ); ?>?type_produit=<?= $term_custom[0]->slug; ?>" class="uk-button uk-button-yoomee-shop"><?php pll_e('Voir toutes les offres' , 'yoomee'); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if($shop->have_posts()): ?>
                    <div class="uk-width-1-4">

                            <?php while ( $shop->have_posts() ) : $shop->the_post(); ?>
                            <?php $produit_id = get_post_meta($post->ID, 'produit_promotion', true) ?>
                            <a href="<?= get_permalink($produit_id['ID'])?>"><?=  get_the_post_thumbnail( $post->ID, 'full', array('class' => 'uk-margin-auto uk-display-block'));?></a>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>

                </div>


            </div>

        </div>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>
