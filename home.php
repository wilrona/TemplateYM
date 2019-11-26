<?php
/**
 * Created by PhpStorm.
 * User: Ndi Ronald Steve
 * Date: 03/01/2017
 * Time: 11:38
 */

?>

<?php /* Template Name: Accueil */ ?>

<?php get_header(); ?>


    <?php while ( have_posts() ) : the_post(); ?>

        <?php $blocks = tr_posts_field('blockprod'); ?>

        <?php foreach ($blocks as $block):?>
        <div class="uk-section-service uk-background-norepeat uk-background-cover uk-background-center-center uk-section-block" uk-scrollspy="target:[uk-scrollspy-class];cls:uk-animation-slide-right-medium;delay:300;repeat:true" style="background-image: url('<?php echo wp_get_attachment_image_src($block['imageblock'], 'full')[0] ?>');">
<!--            <div class="uk-container">-->
                <div class="uk-grid-collapse uk-flex" uk-grid>
<!--                    <div class="uk-width-1-1 uk-flex uk-flex-middle --><?//= $block['position'] ?><!--  ">-->
                        <div class="uk-width-1-2@m  <?= $block['position'] ?> uk-margin-remove">
                            <div class="uk-height-1-1 uk-inline-clip uk-transition-toggle uk-flex uk-flex-middle uk-flex-center">
                                <img src="<?php echo wp_get_attachment_image_src($block['imageblock2'], 'full')[0] ?>" alt="" class="uk-transition-scale-up uk-transition-opaque uk-responsive-height uk-responsive-width">
<!--                                <canvas height="750" width="950"></canvas>-->
                            </div>

                        </div>
                        <div class="uk-width-1-2@m uk-height-1-1 uk-margin-remove">
                            <div class="uk-padding-large uk-height-1-1 uk-flex uk-flex-middle uk-flex-center">
                                <div class="uk-padding uk-padding-remove-horizontal uk-width-4-5">
                                    <h1 class="uk-margin-medium-bottom" uk-scrollspy-class><?= $block['titleblock']; ?> </h1>
                                    <div class="uk-text-justify" uk-scrollspy-class><?= $block['descblock']; ?></div>
                                    <div class=" uk-text-left uk-margin-large uk-margin-remove-bottom" uk-scrollspy="cls:uk-animation-slide-bottom;delay:250;repeat:true">
                                        <a href="<?php echo esc_url( $block['linkblock'] ); ?>" class="uk-button uk-button-yoomee uk-button-yoomee-shop" <?php if ($block['download'] == 'ok'): ?>download<?php endif; ?>><?php echo $block['namelinkblock'] ?></a>
                                    </div>
                                </div>
                            </div>

                        </div>
<!--                    </div>-->
                </div>
<!--            </div>-->
        </div>
        <?php endforeach; ?>

    <?php endwhile; ?>

<!--    <div class="uk-section uk-actualite uk-padding-remove">-->
<!--        <div class="">-->
<!--            --><?php //$posting = tr_posts_field('albumposthome'); ?>
<!---->
<!--            <div class="uk-child-width-1-2@m uk-flex uk-flex-center uk-grid-collapse" uk-grid>-->
<!--                --><?php
//
//                if($posting):
//
//                    $albumpost = get_post(tr_posts_field('albumposthome'));
//
//                    ?>
<!---->
<!--                <div>-->
<!--                    <div class="uk-width-1-1">-->
<!--                        <div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="animation: slide; min-height: 600; autoplay: true">-->
<!---->
<!--                            <ul class="uk-slideshow-items">-->
<!--                                --><?php //foreach (tr_posts_field('photoalbum', $albumpost->ID) as $block):?>
<!--                                    <li>-->
<!--                                        <img src="--><?php //echo wp_get_attachment_image_src($block, 'full')[0] ?><!--" alt="" uk-cover>-->
<!--                                    </li>-->
<!--                                --><?php //endforeach; ?>
<!--                            </ul>-->
<!---->
<!--                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>-->
<!--                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>-->
<!---->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--                    --><?php
//                        endif;
//                    ?>
<!--                <div>-->
<!--                    <div class="uk-height-1-1">-->
<!--                        <div class="uk-width-1-1">-->
<!--                            <div class="owl-carousel owl-theme owl-custom-dotted" id="owl-carousel-actu" style="height: 600px;">-->
<!--								--><?php
//								$custom_args = array(
//									'post_type' => 'post',
//									'posts_per_page' => 3,
//									'lang' => pll_current_language()
//								);
//								$custom_query = new WP_Query( $custom_args );
//
//								if ( $custom_query->have_posts() ) :
//									?>
<!--									--><?php //while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
<!--                                    <div class="item uk-height-1-1">-->
<!--                                        <div class="uk-padding-large">-->
<!--                                            <div class="" style="height: 500px;">-->
<!--                                                <div class="uk-padding-large">-->
<!--                                                    <h1 class="uk-text-yoomee truncate2 uk-display-block">--><?//= get_the_title() ?><!--</h1>-->
<!--                                                    <div class="uk-text-justify uk-text-yoomee uk-text-home-abouts" style="font-size: 16px"> <div class="dotdot" style="max-height: 50px;">--><?//= the_content() ?><!--</div> </div>-->
<!--                                                    <div class="uk-margin-medium-top">-->
<!--                                                        <a href="--><?//= the_permalink(); ?><!-- " class="uk-button uk-button-yoomee-actu">--><?php //pll_e('Lire la suite' , 'yoomee'); ?><!--</a>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                    </div>-->
<!--								--><?php //endwhile; ?>
<!--								--><?php //endif; ?>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </div>-->

    <?php while ( have_posts() ) : the_post(); ?>
	    <?php $valeur = tr_posts_field('titlevaleur'); ?>
        <?php if($valeur): ?>
            <div class="uk-section uk-section-large uk-background-norepeat uk-background-cover uk-background-center-center" style="min-height: 800px; background-image: url('<?php echo wp_get_attachment_image_src(tr_posts_field('imagefondblockvaleur'), 'full')[0] ?>');">
                <div class="uk-container">
                    <div class="uk-width-1-1@m uk-margin-large-bottom uk-flex uk-flex-center">
                        <div class="uk-width-1-1">
                            <div class="" uk-grid>
                                <div class="uk-width-1-3@m">
                                    <span class="uk-h1"><?= tr_posts_field('titlevaleur'); ?></span>
                                </div>
                                <div class="uk-width-2-3@m uk-padding-large uk-padding-remove-vertical uk-padding-remove-right">
                                    <?php $texte = tr_posts_field('descvaleur'); ?>
                                    <?= preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $texte); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-margin uk-grid-large uk-child-width-1-3@m uk-grid" uk-grid="" uk-height-match=".uk-column">
                        <?php foreach (tr_posts_field('blockvaleur') as $content): ?>
                        <div class="uk-column">
                            <div class="uk-width-1-1">
                                <img src="<?php echo wp_get_attachment_image_src($content['imageblockvaleur'], 'full')[0] ?>" alt="" class="uk-display-block" style="width: 25px;">
                                <span class="uk-display-block uk-h3 uk-margin-small-top"><?= $content['titleblockvaleur'] ?></span>
                                <div class="uk-text-justify"><?= $content['descblockvaleur'] ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        <?php endif; ?>

	<?php $shop = tr_posts_field('titleshop'); ?>
    <?php if($shop): ?>
    <div class="uk-section uk-section-large uk-position-relative uk-section-shopping" uk-scrollspy="target:[uk-scrollspy-class];cls:uk-animation-fade;delay:250;repeat:true">
        <div class="uk-container">
            <div class="uk-margin" uk-grid>
                <div class="uk-width-1-2@m" >
                    <h1 class="uk-margin-medium-bottom" uk-scrollspy-class><?= tr_posts_field('titleshop'); ?></h1>
                    <div class="uk-text-justify" uk-scrollspy-class><?= tr_posts_field('descshop'); ?></div>

                </div>
                <div class="uk-width-1-2@m">
                    <div class="owl-carousel owl-theme" id="owl-carousel-service">
		                <?php foreach (tr_posts_field('produits') as $posting): ?>
                            <?php $shopitem = get_post($posting['selection_du_produit']); ?>
                            <div class="item uk-padding-small">
                                <div class="uk-card uk-card-default uk-card-small">
                                    <a href="<?= get_the_permalink($shopitem->ID) ?>" class="uk-display-block uk-link-reset">
                                        <div class="uk-card-media-top uk-cover-container uk-text-center" style="background-color: #f6f6f6;">
                                            <div class="uk-height-1-1 uk-inline-clip uk-transition-toggle uk-flex uk-flex-middle uk-flex-center">
                                                <?=  get_the_post_thumbnail( $shopitem->ID, 'medium', array('style' => 'height: 100%; width: 300px;', 'class' => 'uk-transition-scale-up uk-transition-opaque uk-responsive-height uk-responsive-width'));?>
                                            </div>

                                            <canvas width="300" height="20"></canvas>
                                        </div>
                                        <div class="uk-card-body uk-height-small">
                                            <h3 class="uk-card-title uk-text-yoomee uk-text-truncate"><?= $shopitem->post_title; ?></h3>
                                            <?php $term_custom = get_the_terms( $shopitem->ID, 'type_produit' );?>
                                            <span class="uk-label uk-card-label"><?= $term_custom[0]->name; ?></span>
                                            <?php $promo = get_post_meta($shopitem->ID, 'activer_promotion', true) ?>
                                            <?php if($promo): ?>
                                                <span class=" uk-display-block"><span class="uk-promotion"><?= get_post_meta($post->ID, 'prix_promo', true) ?> FCFA</span>
                                            <del><small><?= get_post_meta($shopitem->ID, 'prix', true) ?> FCFA</small></del></span>
                                            <?php else: ?>
                                            <span class=" uk-display-block"><?= get_post_meta($shopitem->ID, 'prix', true) ?> FCFA
                                                <?php endif; ?>
                                        </div>
                                    </a>
                                    <div class="uk-card-footer uk-padding-remove">
	                                    <?php $obtenir = get_post_meta($shopitem->ID, 'type_service', true) ?>
	                                    <?php
	                                    if($obtenir == 'telephone' || $obtenir == 'modem' || $obtenir == 'carte'):
		                                    ?>
                                            <a href="<?= get_the_permalink($shopitem->ID) ?>" class="uk-button uk-button-yoomee uk-width-1-1 uk-display-block uk-padding-remove uk-float-right add_panier_other" id="<?= $shopitem->ID ?>"><?php pll_e('Ajouter au panier' , 'yoomee'); ?></a>
		                                    <?php
                                        else:
		                                    ?>
                                            <a href="https://my.yoomee.cm/" target="_blank" class="uk-button uk-button-yoomee uk-width-1-1 uk-display-block uk-padding-remove uk-float-right"><?php pll_e('Ajouter au panier' , 'yoomee'); ?></a>
	                                    <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


<?php endwhile; ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php $blocks = tr_posts_field('blockprod2'); ?>

        <?php foreach ($blocks as $block):?>
            <div class="uk-section-service uk-background-norepeat uk-background-cover uk-background-center-center uk-section-block" uk-scrollspy="target:[uk-scrollspy-class];cls:uk-animation-slide-right-medium;delay:300;repeat:true" style="background-image: url('<?php echo wp_get_attachment_image_src($block['imageblock'], 'full')[0] ?>');">
                <!--            <div class="uk-container">-->
                <div class="uk-grid-collapse uk-flex" uk-grid>
                    <!--                    <div class="uk-width-1-1 uk-flex uk-flex-middle --><?//= $block['position'] ?><!--  ">-->
                    <div class="uk-width-1-2@m  <?= $block['position'] ?> uk-margin-remove">
                        <div class="uk-height-1-1 uk-inline-clip uk-transition-toggle uk-flex uk-flex-middle uk-flex-center">
                            <img src="<?php echo wp_get_attachment_image_src($block['imageblock2'], 'full')[0] ?>" alt="" class="uk-transition-scale-up uk-transition-opaque uk-responsive-height uk-responsive-width">
                            <!--                                <canvas height="750" width="950"></canvas>-->
                        </div>

                    </div>
                    <div class="uk-width-1-2@m uk-height-1-1 uk-margin-remove">
                        <div class="uk-padding-large uk-height-1-1 uk-flex uk-flex-middle uk-flex-center">
                            <div class="uk-padding uk-padding-remove-horizontal uk-width-4-5">
                                <h1 class="uk-margin-medium-bottom" uk-scrollspy-class><?= $block['titleblock']; ?> </h1>
                                <div class="uk-text-justify" uk-scrollspy-class><?= $block['descblock']; ?></div>
                                <div class=" uk-text-left uk-margin-large uk-margin-remove-bottom" uk-scrollspy="cls:uk-animation-slide-bottom;delay:250;repeat:true">
                                    <a href="<?php echo esc_url( $block['linkblock'] ); ?>" class="uk-button uk-button-yoomee uk-button-yoomee-shop" <?php if ($block['download'] == 'ok'): ?>download<?php endif; ?>><?php echo $block['namelinkblock'] ?></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--                    </div>-->
                </div>
                <!--            </div>-->
            </div>
        <?php endforeach; ?>

    <?php endwhile; ?>






<?php get_footer(); ?>