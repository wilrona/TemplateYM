<?php get_header(); ?>




        <div class="uk-section">
            <div class="uk-container uk-container-small">
                    <div class="uk-margin" uk-grid>

                        <div class="uk-width-1-1">
                        <?php if (have_posts()) : ?>
                            <?php while (have_posts()) : the_post();?>
                            <?php $current_post = get_the_ID(); ?>
<!--                            <h1 class="uk-text-center">-->
<!--                                --><?php //the_title() ?>
<!--                            </h1>-->

                            <div class="uk-padding uk-padding-remove-horizontal">
                                <?=  get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'uk-margin-auto uk-display-block' ) );?>
                            </div>


                            <div class="uk-text-justify">
                                <?php the_content(); ?>
                            </div>

                            <?php endwhile; ?>
                        <?php endif; ?>
                            <div class="uk-section">
                                <?php
                                $custom_args = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 3,
                                    'post__not_in' => array($current_post),
                                    'orderby'=> 'rand'
                                );
                                $custom_query = new WP_Query( $custom_args );

                                if ( $custom_query->have_posts() ) :
                                    ?>
                                    <div class="uk-width-1-1">
                                        <h2 class="uk-text-yoomee uk-margin-remove uk-border-bottom">
	                                        <?php pll_e('Autres actualités' , 'yoomee'); ?>
                                        </h2>
                                    </div>
                                    <div class="uk-margin uk-child-width-1-3@m uk-grid-match" uk-grid>
                                        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                                                <div class="uk-card uk-card-small">
                                                    <div class="uk-card-media-top uk-cover-container uk-margin-bottom">
				                                        <?php the_post_thumbnail('full', array('uk-cover' => '')); ?>
                                                        <canvas width="700" height="500"></canvas>
                                                    </div>
                                                    <div class="uk-card-body uk-padding-remove">
                                                        <div class="">
                                                            <h1 class="uk-h3 truncate" style="display: block !important;"> <?= the_title(); ?></h1>
                                                            <p class="uk-text-small"><strong><a href="<?= get_permalink() ?>" class="uk-button uk-button-link uk-link-reset uk-card-link"><?php pll_e('Lire plus' , 'yoomee'); ?></a></strong></p>

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
        </div>



<?php get_footer(); ?>