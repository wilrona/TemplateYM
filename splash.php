<?php /* Template Name: Splash page */ ?>

<?php get_header(); ?>

<div class="uk-position-relative uk-light " uk-height-viewport>
<!--    <div class="uk-position-top-right uk-height-large uk-visible@l">-->
<!--        <img class="uk-responsive-height" src="--><?php //echo get_template_directory_uri(); ?><!--/images/cone.png" alt="">-->
<!--    </div>-->
<!--    <nav class="uk-position-top uk-navbar-transparent uk-position-z-index uk-margin-small-top" uk-navbar>-->
<!--        <div class="uk-navbar-center">-->
<!--            <a class="uk-navbar-item uk-logo" href="--><?php //bloginfo('url'); ?><!--">-->
<!--                <img src="--><?php //echo get_template_directory_uri(); ?><!--/images/logo-2.png" alt="">-->
<!--            </a>-->
<!--        </div>-->
<!--    </nav>-->
    <video id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
        <source src="<?php echo get_template_directory_uri(); ?>/Yoomee-teaser-BUREAU.mp4" type="video/mp4">
    </video>
    <div class="uk-position-cover uk-flex uk-flex-center uk-flex-middle" style="background-color: rgba(0, 0, 0, .6);">

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

                <div style="">
                    <div class="uk-heading-primary uk-text-center uk-h1">
                        <?= the_content() ?>
                    </div>
                    <div class="uk-text-center uk-margin-medium-top">
                        <a href="<?php echo esc_url( get_page_link( pll_get_post('8') ) ); ?>" class="uk-button uk-button-yoomee uk-button-yoomee-shop"><?php pll_e('Acceder directement au site' , 'yoomee'); ?></a>
                    </div>
                </div>


            <?php endwhile; ?>
        <?php endif; ?>


    </div>
</div>


<?php get_footer(); ?>
