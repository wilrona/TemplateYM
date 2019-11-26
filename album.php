<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 13/02/2018
 * Time: 16:58
 */
?>

<?php /* Template Name: Pages Album */ ?>

<?php get_header(); ?>
	<?php while ( have_posts() ) : the_post(); ?>
    <div class="uk-section uk-section-service uk-position-relative">
        <div class="uk-container">
            <?php if(get_the_content()):  ?>
                <div class="uk-width-1-1 uk-margin-large-bottom">
                    <?php the_content(); ?>
                    <hr>
                </div>
            <?php endif; ?>

            <div class="lightbox uk-hidden uk-child-width-1-3@m" uk-grid>
                <a class="uk-inline" href="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_108886664_original-860x575.jpg" data-caption="Caption 1" data-type="image">
                    <img src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_108886664_original-860x575.jpg" alt="">
                </a>
            </div>

	        <?php

	        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

	        $custom_args = array(
		        'post_type' => 'album',
		        'posts_per_page' => 8,
		        'paged' => $paged,
//			'lang' => pll_current_language(),
	        );

	        $custom_query = new WP_Query( $custom_args );

	        if ( $custom_query->have_posts() ) :

		        ?>
                <div class="uk-child-width-1-4@m" uk-grid uk-height-match=".my-class">
			        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                        <div class="my-class">
                            <div class="uk-box-shadow-medium show-album" id="<?= $post->ID; ?>">
                                <div class="uk-cover-container">
                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full') ?>" alt="" uk-cover>
                                    <canvas width="370" height="250"></canvas>
                                </div>
                                <div class="uk-background-default uk-padding-small">
                                    <h4><?= $post->post_title; ?></h4>
                                </div>
                            </div>
                        </div>
			        <?php endwhile; ?>
                </div>


		        <?php
		        if (function_exists(kriesi_pagination)) {
			        kriesi_pagination($custom_query->max_num_pages);
		        }
		        ?>
	        <?php else: ?>
                <div class="uk-height-small">
                    <h1 class="uk-heading-primary"><?php pll_e('Aucune vidéo enregistrée' , 'yoomee'); ?></h1>
                </div>
	        <?php endif; ?>

<!--            <div id="cmsmasters_hover_slider_5794d42aeb" class="cmsmasters_hover_slider" data-thumb-width="100" data-thumb-height="60" data-active-slide="1" data-pause-time="5000" data-pause-on-hover="true">-->
<!--                <ul class="cmsmasters_hover_slider_items">-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_108886664_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_101092230_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_115470704_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_115469886_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_115469886_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_115469886_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_115469886_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_115469886_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_115469886_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_115469886_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_115469886_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <figure class="cmsmasters_hover_slider_full_img">-->
<!--                            <img width="860" height="575" src="http://startup-company.cmsmasters.net/wp-content/uploads/2015/04/Depositphotos_115469886_original-860x575.jpg" class="attachment-post-thumbnail size-post-thumbnail" alt="">-->
<!--                        </figure>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->


        </div>
    </div>

	<?php endwhile; ?>

<script>
    var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";

    jQuery(function($) {
        $('body').on('click', '.show-album', function(e) {
            e.preventDefault();
            var data = {
                'action': 'load_album_by_ajax',
                'security': '<?php echo wp_create_nonce("load_more_album"); ?>',
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
