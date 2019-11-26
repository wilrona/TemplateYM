<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        
        <div class="uk-section uk-padding-remove-bottom">
            <div class="uk-container">
                <div class="" uk-grid>
                    <div class="uk-width-3-4@m">
                        <?php flash('flash_cart'); ?>
                        <div class="uk-margin" uk-grid>
                            <div class="uk-width-2-5@m">
                                <div class="owl-carousel owl-theme owl-carousel-produit">
                                    <?php
                                        if(get_the_post_thumbnail( get_the_ID())):
                                    ?>
                                    <div class="item uk-padding-small">
		                                <?=  get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'uk-responsive-height uk-responsive-width' ) );?>
                                    </div>
                                    <?php
                                        endif;
                                    ?>
				                    <?php $images = get_post_meta(get_the_ID(), 'gallerie', false);
				                    if($images[0]):
				                    foreach ($images as $image):
					                    ?>
                                        <div class="item uk-padding-small" >
                                            <img src="<?= $image['guid']; ?>" alt="" class="uk-responsive-height uk-responsive-width">
                                        </div>
				                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                            <div class="uk-width-3-5@m">
                                <h1 class="uk-h2">
				                    <?php the_title() ?>
                                </h1>


                                <div class="uk-width-1-1">
				                    <?php $promo = get_post_meta(get_the_ID(), 'activer_promotion', true) ?>
				                    <?php if($promo): ?>
                                        <span class="uk-h5 uk-margin-remove"><del><?= get_post_meta(get_the_ID(), 'prix', true) ?> FCFA</del></span> -
                                        <span class="uk-h3 uk-margin-remove uk-text-bold"><?= get_post_meta(get_the_ID(), 'prix_promo', true) ?> FCFA</span>
				                    <?php else: ?>
                                        <span class="uk-h3 uk-margin-remove uk-text-bold"> <?= get_post_meta(get_the_ID(), 'prix', true) ?> FCFA </span>
                                    <?php endif; ?>
                                </div>
                                <div class="uk-text-justify uk-family-normal">
		                            <?php the_content(); ?>
                                </div>
                                <div>
	                                <?php $obtenir = get_post_meta(get_the_ID(), 'type_service', true) ?>
	                                <?php
	                                if($obtenir == 'telephone' || $obtenir == 'modem' || $obtenir == 'carte'):
		                                ?>
                                        <a href="<?= get_the_permalink(get_the_ID()) ?>" class="uk-button uk-button-yoomee-black add_panier" id="<?= get_the_ID() ?>"><?php pll_e('Ajouter au panier' , 'yoomee'); ?></a>
                                        <?php
                                            else:
                                        ?>
                                                <a href="https://my.yoomee.cm/" target="_blank" class="uk-button uk-button-yoomee-black"><?php pll_e('Ajouter au panier' , 'yoomee'); ?></a>
	                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="uk-section uk-description-produit uk-padding-remove-top">
                            <div class="uk-width-1-1">
		                        <?php if(get_post_meta(get_the_ID(), 'desc_produit', true) || get_post_meta(get_the_ID(), 'caract_produit', true)): ?>
                                    <ul uk-tab="animation: uk-animation-fade">
				                        <?php if(get_post_meta(get_the_ID(), 'desc_produit', true)): ?>
                                            <li><a href="#"><?php pll_e('Description du produit' , 'yoomee'); ?></a></li>
				                        <?php endif; ?>
	                                    <?php if(get_post_meta(get_the_ID(), 'caract_produit', true)): ?>
                                            <li><a href="#"><?php pll_e('Caracteristique du produit' , 'yoomee'); ?></a></li>
	                                    <?php endif; ?>
                                    </ul>

                                    <ul class="uk-switcher uk-margin uk-text-justify uk-margin-medium-bottom">
			                            <?php if(get_post_meta(get_the_ID(), 'desc_produit', true)): ?>
                                        <li>
						                    <?= get_post_meta(get_the_ID(), 'desc_produit', true) ?>
                                        </li>
			                            <?php endif; ?>
	                                    <?php if(get_post_meta(get_the_ID(), 'caract_produit', true)): ?>
                                        <li>
		                                    <?= get_post_meta(get_the_ID(), 'caract_produit', true) ?>
                                        </li>
	                                    <?php endif; ?>

                                    </ul>
		                        <?php endif; ?>

                                <div class="uk-section-shopping">
                                    <hr>
				                    <?php $term_custom = get_the_terms( get_the_ID(), 'type_produit' );?>
				                    <?php
				                    $custom_args = array(
					                    'post_type' => 'produit',
					                    'posts_per_page' => 3,
					                    'post__not_in' => array(get_the_ID()),
					                    'orderby'=> 'rand',
					                    'lang' => pll_current_language(),
					                    'tax_query' => array(
						                    array(
							                    'taxonomy' => 'type_produit',
							                    'field' => 'slug',
							                    'terms' => $term_custom[0]->name,
						                    ),
					                    )
				                    );
				                    $custom_query = new WP_Query( $custom_args );

				                    if ( $custom_query->have_posts() ) :
					                    ?>
                                        <div class="uk-width-1-1">
                                            <h3 class="">
							                    <?php pll_e('Produits similaires' , 'yoomee'); ?>
                                            </h3>
                                        </div>
                                        <div class="uk-margin uk-child-width-1-3@m" uk-grid uk-height-match=".prorduit">
						                    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                                                <div class="produit">
                                                    <div class="uk-card uk-card-default uk-card-small">
                                                        <a href="<?php the_permalink() ?>" class="uk-display-block uk-link-reset">
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
				                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="uk-width-1-4@m">
		                <?php get_template_part( 'shop-menu' ); ?>
                    </div>
                </div>
            </div>
        </div>
            
    <?php endwhile; ?>
<?php endif; ?>        

<?php get_footer(); ?>