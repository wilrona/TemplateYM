<?php /* Template Name: Contact */ ?>


<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

<!--    <div class="uk-section uk-section-default uk-padding-remove-bottom uk-section-about">-->
<!--        <div class="uk-container">-->
<!--            <h1 class="uk-heading-line uk-margin-large-bottom"><span>--><?php //the_title() ?><!-- </span></h1>-->
<!--        </div>-->
<!--    </div>-->
    
    <div class="uk-section-default uk-section uk-padding-remove uk-padding-remove-horizontal uk-section-map">
          <div class="uk-child-width-1-2@l uk-grid">
              <div>
                  <?php the_content() ?>
              </div>
              <div style="background: #eeeeee;" class="uk-padding uk-flex-middle uk-flex-center uk-flex">
                  <div>
                      <?php echo get_post_meta(get_the_ID(), 'presentation', true); ?>
                  </div>
              </div>

          </div>
    </div>
        <div class="uk-section uk-section-small">
            <div class="uk-container uk-container-small">
                <h1 class="uk-heading-line uk-margin-large-bottom uk-text-yoomee"><span><?php pll_e('Laissez nous un message' , 'yoomee'); ?></span></h1>
                <?php echo do_shortcode(get_post_meta(get_the_ID(), 'texte_illustration', true)); ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>