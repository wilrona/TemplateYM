<?php /* Template Name: Pages des services */ ?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>


        <?php $blocks = tr_posts_field('blockservice'); ?>

		<?php foreach ($blocks as $block):?>
            <div class="uk-section-service uk-background-norepeat uk-background-cover uk-background-center-center uk-section-block" uk-scrollspy="target:[uk-scrollspy-class];cls:uk-animation-slide-right-small;delay:250;repeat:true" style="background-image: url('<?php echo wp_get_attachment_image_src($block['imageblockservice'], 'full')[0] ?>');">
                <!--            <div class="uk-container">-->
                <div class="uk-grid-collapse uk-flex" uk-grid>
                    <!--                    <div class="uk-width-1-1 uk-flex uk-flex-middle --><?//= $block['position'] ?><!--  ">-->
                    <div class="uk-width-1-2@m <?= $block['positionservice'] ?> uk-margin-remove">
                        <div class="uk-height-1-1 uk-inline-clip uk-transition-toggle uk-flex uk-flex-middle uk-flex-center">
                            <img src="<?php echo wp_get_attachment_image_src($block['imageblock2service'], 'full')[0] ?>" alt="" class="uk-transition-scale-up uk-transition-opaque uk-responsive-width uk-responsive-height">
<!--                            <canvas height="750" width="950"></canvas>-->
                        </div>
                    </div>
                    <div class="uk-width-1-2@m uk-margin-remove">
                        <div class="uk-padding-large uk-height-1-1 uk-flex uk-flex-middle uk-flex-center">
                            <div class="uk-padding uk-padding-remove-horizontal uk-width-4-5">
                                <h1 class="uk-margin-medium-bottom" uk-scrollspy-class style="color: <?= $block['couleurtitle'] ?>"><?= $block['titleblockservice']; ?> </h1>
                                <div class="uk-text-justify" uk-scrollspy-class style="color: <?= $block['couleurtexte'] ?>"><?= $block['descblockservice']; ?></div>
                                <div class=" uk-text-left uk-margin-large uk-margin-remove-bottom" uk-scrollspy="cls:uk-animation-slide-bottom;delay:250;repeat:true">
                                    <a href="<?php echo esc_url( $block['linkblockservice'] ); ?>" class="uk-button uk-button-yoomee uk-button-yoomee-shop" <?php if ($block['downloadservice'] == 'ok'): ?>download<?php endif; ?>><?php echo $block['namelinkblockservice'] ?></a>
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
<?php endif; ?>

<?php get_footer(); ?>
