<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post();?>
        
        <div class="uk-section-muted uk-section uk-background-norepeat uk-background-cover uk-position-relative uk-background-center-center uk-light" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/photo-els.jpg);">
         <div class="uk-position-cover" style="background-color: rgba(0, 0, 0, 0.44);"></div>
          <div class="uk-container uk-container-small uk-position-relative">
           <div class="uk-grid-margin uk-grid" uk-grid="">
            <div class="uk-width-1-1@m">
              <h1 class="uk-text-center uk-h2 uk-margin-remove uk-heading-primary uk-text-capitalize">
	              <?php pll_e('Evènements' , 'yoomee'); ?>  </h1>
                <div class="uk-width-xxlarge uk-margin-auto uk-text-center uk-text-lead">
                  <?php the_title() ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
    <div id="tm-main" class="tm-main uk-section" uk-height-viewport="expand: true" style="box-sizing: border-box;">
      <div class="uk-container">


        <div class="uk-grid uk-grid-large uk-grid-divider" uk-grid="">
          <div class="uk-width-expand@m">



            <article id="post-2" class="uk-article">

                  <div class="uk-margin-medium-bottom uk-container uk-container-small uk-text-center">


                    <h1 class="uk-article-title uk-margin-remove-top"><?php the_title() ?></h1>
                    <p class="uk-article-meta uk-text-lead uk-text-danger">
                      <?= get_post_meta($post->ID, 'date_evenement', true) ?> à <?= get_post_meta($post->ID, 'heure_event', true) ?>
                    </p>

                  </div>


                  <div class="uk-container uk-container-small  uk-text-justify">

                    <div property="text">
                        <?php the_content() ?>
                    </div>



                    <ul class="uk-pagination uk-margin-medium">
                        
                        <?php
                        $prev_post = get_previous_post();
                        if($prev_post) {
                           $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
                           
                        ?>
                        <li>
                            <a href="<?= get_permalink($prev_post->ID) ?>"><span class="uk-margin-small-right" uk-pagination-previous></span> <?= $prev_title ?></a>
                        </li>
                        <?php
                        }
                        ?>
                            
                        
                        <?php 
                        $next_post = get_next_post();
                        if($next_post) {
                            $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
                        ?>
                        <li class="uk-margin-auto-left">
                            <a href="<?= get_permalink($next_post->ID) ?>"><?= $next_title ?> <span class="uk-margin-small-left" uk-pagination-next></span></a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>


                  </div>

                </article>
                </div>


              </div>

            </div>
      </div>
        
        
            
    <?php endwhile; ?>
<?php endif; ?>  



<?php get_footer(); ?>