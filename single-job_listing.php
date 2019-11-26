<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post();?>

        <div class="uk-section uk-section-about">
            <div class="uk-container uk-container-large">
<!--                <h1 class="uk-heading-line uk-margin-bottom-remove"><span>Poste : <small>--><?php //the_title() ?><!--</small> </span></h1>-->
                <ul class="uk-subnav uk-subnav-divider uk-flex-right uk-subnav-color uk-subnav-content" uk-margin>

                    <li  class="uk-active" ><a href="<?php echo esc_url( get_page_link( '123' ) ); ?>"><?php pll_e('Toutes les offres d\'emploi' , 'yoomee'); ?></a></li>

                </ul>
            </div>
        </div>
        

      <div class="uk-section uk-section-service">
          <div class="uk-container">

                  <div property="text">
                      <?php the_content() ?>
                  </div>

          </div>
      </div>
            
    <?php endwhile; ?>
<?php endif; ?>  


<?php get_footer(); ?>