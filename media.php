<?php /* Template Name: Pages media */ ?>

<?php
/**
 * Created by IntelliJ IDEA.
 * User: macbookpro
 * Date: 12/02/2018
 * Time: 16:39
 */
?>


<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>


    <div class="uk-section uk-position-relative">
        <div class="uk-container">

            <div class="lightbox uk-hidden uk-child-width-1-3@m" uk-grid>
                <a class="uk-inline" href="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_108886664_original-860x575.jpg" data-caption="Caption 1" data-type="image">
                    <img src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_108886664_original-860x575.jpg" alt="">
                </a>
            </div>

			<?php

			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

			$custom_args = array(
				'post_type' => array('album', 'video'),
				'posts_per_page' => 12,
				'paged' => $paged,
//			'lang' => pll_current_language(),
			);

			$custom_query = new WP_Query( $custom_args );

			if ( $custom_query->have_posts() ) :

				?>
                <div class="uk-child-width-1-3@m" uk-grid uk-height-match=".my-class">
					<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                        <div class="my-class">
                            <div class="uk-inline-clip uk-transition-toggle uk-light show-album" id="<?= $post->ID; ?>" tabindex="0" style="background-color: #f6f6f6; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);">
                                <div class="uk-cover-container">
	                                <?php
	                                    if(get_post_type($post->ID) === 'album'):
	                                ?>
	                                    <?=  get_the_post_thumbnail( $post->ID, 'full', array('uk-cover' => ''));?>
                                    <?php else: ?>
                                            <img src="http://img.youtube.com/vi/<?= tr_posts_field('youtubeid', $post->ID) ?>/0.jpg" alt="" uk-cover>
                                    <?php endif; ?>
                                    <canvas width="370" height="250"></canvas>
                                </div>
                                <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle">
                                    <div class="uk-text-center">
                                        <div class="uk-transition-slide-top-small"><h3 class="uk-margin-remove"><?= get_the_title() ?></h3></div>
                                        <?php
                                            if(get_post_type($post->ID) === 'album'):
                                        ?>
                                            <div class="uk-transition-slide-bottom-small uk-text-center"><h4 class="uk-margin-remove"><strong>ALBUM PHOTO</strong></h4></div>
                                            <div class="uk-transition-slide-bottom-small uk-text-center"><h4 class="uk-margin-remove"><?= tr_posts_field('datealbum'); ?></h4></div>
                                        <?php else: ?>
                                            <div class="uk-transition-slide-bottom-small uk-text-center"><h4 class="uk-margin-remove"><strong>VIDEO</strong></h4></div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
					<?php endwhile; ?>
                </div>

                <div class="uk-margin-top">

                    <?php
                    if (function_exists(kriesi_pagination)) {
                        kriesi_pagination($custom_query->max_num_pages);
                    }
                    ?>
                </div>
			<?php else: ?>
                <div class="uk-height-small">
                    <h1 class="uk-heading-primary"><?php pll_e('Aucun média enregistré' , 'yoomee'); ?></h1>
                </div>
			<?php endif; ?>



        </div>
    </div>





<?php endwhile; ?>

<script>
    var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";

    jQuery(function($) {
        $('body').on('click', '.show-album', function(e) {
            e.preventDefault();
            var data = {
                'action': 'load_media_by_ajax',
                'security': '<?php echo wp_create_nonce("load_more_media"); ?>',
                'current_post' : $(this).attr('id')
            };

            $.post(ajaxurl, data, function(response) {
                if(response !== ''){
                    $('body .lightbox').html(response);
                    UIkit.lightbox('body .lightbox', {
                        animation: 'slide'
                    });
                    UIkit.lightbox('body .lightbox').show(0);

                }
            });
        });


    });
</script>

<?php get_footer(); ?>
