<?php /* Template Name: Qui sommes nous */ ?>

<?php get_header(); ?>



<?php

$expressions = array(
    'post_type' => 'expression',
    'posts_per_page' => -1,
    'orderby'=> 'rand',
    'lang' => pll_current_language(),
);

$Expression = new WP_Query( $expressions );

if($Expression->have_posts()):
    ?>

    <div class="uk-section uk-section-large uk-background-custom uk-section-message">
        <div class="uk-container">
            <div class="uk-margin" uk-grid>
                <div class="uk-width-1-1 uk-text-center">
                    <div class="owl-carousel owl-theme" id="owl-carousel-message">
                        <?php while ( $Expression->have_posts() ) : $Expression->the_post(); ?>
                            <div class="item">
                                <div class="uk-text-lead">
                                    <?= the_content(); ?>
                                </div>

                                <div class="uk-message-name uk-margin-top">
                                    <?= the_title() ?>
                                </div>
                                <div class="uk-h6 uk-message-poste uk-margin-remove">
                                    <?= get_post_meta(get_the_ID(), 'poste', true); ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<?php $about = tr_posts_field('titleabout'); ?>
        <?php if($about): ?>
            <div class="uk-section uk-section-large uk-background-norepeat uk-background-cover uk-background-center-center uk-section-block" uk-scrollspy="target:[uk-scrollspy-class];cls:uk-animation-slide-right-small;delay:250;repeat:true" style="min-height: 600px; background-image: url('<?php echo wp_get_attachment_image_src(tr_posts_field('imageabout'), 'full')[0] ?>');">
                <div class="uk-container">
                    <div class="uk-margin" uk-grid>
                        <div class="uk-width-1-1 uk-flex <?= tr_posts_field('positionabout') ?>">
                            <div class="uk-width-2-5@m">
                                <h1 class="uk-margin-medium-bottom" uk-scrollspy-class><?= tr_posts_field('titleabout'); ?> </h1>
                                <div class="uk-text-justify" uk-scrollspy-class><?php the_content(); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

		<?php $kract = tr_posts_field('titleblockabout'); ?>
        <?php if ($kract): ?>

            <div class="uk-section uk-section-large uk-section-service">
                <div class="uk-container">
                    <div class="uk-width-1-1@m uk-margin-large-bottom uk-flex uk-flex-center">


                        <div class="uk-width-1-1">
                            <h2 class="uk-h1"><?= tr_posts_field('titleblockabout') ?></h2>
                            <div class="uk-text-home-abouts">
                                <?= tr_posts_field('descblockabout') ?>
                            </div>
                        </div>
                    </div>

                    <div class="uk-margin uk-grid-large uk-child-width-1-3@m uk-text-home-abouts" uk-grid>
                        <?php
                            $block_about = tr_posts_field('blockaboutcontent');
                        ?>
                        <?php foreach( $block_about as $item ):  ?>
                            <div class="uk-flex uk-flex-middle">
                                <div class="uk-width-1-1">
                                    <span class="uk-display-block uk-h3"><?= $item['blockabouttitle'] ?></span>
                                    <div class="uk-text-justify"><?= $item['blockaboutdesc'] ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

        <?php endif; ?>

        <?php

        $equipes = tr_posts_field('blockequipe');

        if($equipes):

		?>
        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-width-1-1 uk-margin-large-bottom uk-flex uk-flex-center">
                    <div class="uk-width-1-2 uk-text-center">
                        <h2 class="uk-h1"><?php pll_e('Notre équipe' , 'yoomee'); ?></h2>
                        <div class="uk-text-home-abouts">
                            <?= tr_posts_field('descequipe'); ?>
                        </div>
                    </div>
                </div>
                <div class="uk-margin uk-grid-large uk-child-width-1-4@l uk-child-width-1-3@m uk-child-width-1-2@s  uk-text-home-abouts" uk-grid>
                    <?php foreach ( tr_posts_field('blockequipe') as $empl ):  ?>
                    <div class="uk-flex uk-flex-middle">
                        <div class="uk-text-center uk-width-1-1 uk-background-default uk-padding-small uk-border-rounded">
                            <div class="uk-margin-small-bottom uk-inline-clip uk-transition-toggle">
                                <img src="<?php echo wp_get_attachment_image_src($empl['photoemp'], 'full')[0] ?>" alt="" class="uk-display-block uk-border-circle uk-margin-auto">


                                <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle uk-border-circle">
                                    <span class="uk-transition-fade" style="color: #ffffff;"><?= $empl['descemp']; ?></span>
                                </div>


                            </div>
                            <span class="uk-h3 uk-display-block uk-margin-small-bottom uk-margin-small-top"><?= $empl['nomemp'] ?></span>
                            <span class="uk-h6 uk-text-bold"><?= $empl['posteemp']; ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <?php endif; ?>


    <?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>
