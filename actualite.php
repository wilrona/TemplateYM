<?php /* Template Name: Actualite */ ?>

<?php get_header(); ?>

    <div class="uk-section uk-section-large">
      <div class="uk-container">
        <div class="uk-grid" uk-grid>
            <?php
                
                    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                    
                    $custom_args = array(
                      'post_type' => 'post',
                      'posts_per_page' => 9,
                      'paged' => $paged
                    );
                    
                    $custom_query = new WP_Query( $custom_args ); 
                    
                    if ( $custom_query->have_posts() ) : 
                ?>

        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
          <div class="uk-width-1-3@m">
              <div class="uk-card uk-card-small">
                  <div class="uk-card-media-top uk-cover-container uk-margin-bottom">
                      <?php the_post_thumbnail('full', array('uk-cover' => '')); ?>
                      <canvas width="700" height="500"></canvas>
                  </div>
                  <div class="uk-card-body uk-padding-remove">
                      <div class="">
                          <h1 class="uk-h3 truncate" style="display: block !important;"> <?= the_title(); ?></h1>
                          <div class="dotdot uk-height-max-small uk-text-justify">
                              <?= the_excerpt(); ?>
                          </div>
                          <p class="uk-text-small"><strong><a href="<?= get_permalink() ?>" class="uk-button uk-button-link uk-link-reset uk-card-link"><?php pll_e('Lire plus' , 'yoomee'); ?></a></strong></p>
                          <p class="uk-text-small"><?php sky_date_french('d M Y', get_post_time('U', true), 1); ?></p>
                      </div>
                  </div>
              </div>

          </div>
        <?php endwhile; ?>
          <div class="uk-width-1-1@m uk-margin-medium-top">
              <?php
                  if (function_exists(kriesi_pagination)) {
                    kriesi_pagination($custom_query->max_num_pages);
                  }
                ?>
          </div>
          <?php else:  ?>
            <div class="uk-card uk-width-1-1 uk-card-small uk-text-center">
                <h1 class="uk-heading-primary"><?php pll_e('Aucune Actualite' , 'yoomee'); ?></h1>
                <p><?php pll_e('Veuillez revenir plutard' , 'yoomee'); ?></p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>


<?php get_footer(); ?>