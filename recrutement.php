<?php /* Template Name: Nos Recrutements */ ?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

<!--        <div class="uk-section uk-section-default uk-padding-remove-bottom uk-section-about">-->
<!--            <div class="uk-container">-->
<!--                <h1 class="uk-heading-line uk-margin-large-bottom"><span>--><?php //the_title() ?><!-- </span></h1>-->
<!--            </div>-->
<!--        </div>-->
        <div class="uk-section uk-section-map uk-section-service">
            <div class="uk-container">
                <?php the_content(); ?>
            </div>
        </div>
    
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>