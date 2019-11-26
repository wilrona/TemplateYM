<?php /* Template Name: Pages mediatheque */ ?>

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

<div class="uk-section uk-background-norepeat uk-background-cover uk-background-center-center" style="background-color: <?= tr_posts_field('colorfondvideo') ?>; min-height: 800px; background-image: url('<?php echo wp_get_attachment_image_src(tr_posts_field('imagefondvideo'), 'full')[0] ?>');">
	<div class="uk-container">
		<div class="uk-width-1-1 uk-margin-large-bottom uk-flex uk-flex-center">
			<div class="uk-width-1-2 uk-text-center">
				<h2 class="uk-h1"><?= tr_posts_field('videotitle'); ?></h2>
			</div>
		</div>
		<div class="uk-margin" uk-grid>
			<div class="uk-width-1-1 uk-flex uk-flex-middle uk-flex-center">
				<div class="uk-width-5-6">
					<?php $videopst = get_post(tr_posts_field('videopost')); ?>
					<?php if (tr_posts_field('youtubeid', $videopst->ID)): ?>
					<div class="video-container">
						<iframe src="https://www.youtube.com/embed/<?= tr_posts_field('youtubeid', $videopst->ID) ?>" frameborder="0" width="560" height="315" allowfullscreen></iframe>
					</div>
					<?php endif; ?>


					<div class="uk-text-center uk-margin-large-top" uk-scrollspy-class><?= tr_posts_field('videodesc'); ?></div>
					<div class=" uk-text-center uk-margin-medium" uk-scrollspy="cls:uk-animation-slide-bottom;delay:250;repeat:true">
						<a href="<?php echo get_permalink( tr_posts_field('videolinkpage') ); ?>" class="uk-button uk-button-yoomee uk-button-yoomee-shop"><?php pll_e('Consultez nos vidéos' , 'yoomee'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="uk-section uk-background-norepeat uk-background-cover uk-background-center-center" style="background-color: <?= tr_posts_field('colorfondalbum') ?>; min-height: 100%; background-image: url('<?php echo wp_get_attachment_image_src(tr_posts_field('imagefondalbum'), 'full')[0] ?>');">
	<div class="uk-container">
		<div class="uk-grid-large" uk-grid>
			<div class="uk-width-1-2 uk-flex uk-flex-middle uk-flex-center">
				<div class="uk-width-1-1">
					<?php $posting = tr_posts_field('albumpost'); ?>
                    <?php

                    if($posting):

	                    $albumpost = get_post(tr_posts_field('albumpost'));

                    ?>
                        <div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="animation: slide; min-height: 400; autoplay: true">

                            <ul class="uk-slideshow-items">
	                            <?php foreach (tr_posts_field('photoalbum', $albumpost->ID) as $block):?>
                                    <li>
                                        <img src="<?php echo wp_get_attachment_image_src($block, 'full')[0] ?>" alt="" uk-cover>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                        </div>
                        <h3 class="uk-h3 uk-margin-small-top uk-margin-bottom-remove uk-text-center uk-text-bold"> <?= $albumpost->post_title ?></h3>

                    <?php endif; ?>




				</div>
			</div>
			<div class="uk-width-1-2 uk-margin-large-bottom uk-flex uk-flex-center uk-flex-middle">
				<div class="uk-width-1-1">
					<h2 class="uk-h1 uk-margin-bottom-remove"><?= tr_posts_field('albumtitre'); ?></h2>
					<div class="uk-margin-top" uk-scrollspy-class><?= tr_posts_field('albumdescs'); ?></div>
					<div class=" uk-margin-medium" uk-scrollspy="cls:uk-animation-slide-bottom;delay:250;repeat:true">
						<a href="<?php echo get_permalink( tr_posts_field('albumlinkpage') ); ?>" class="uk-button uk-button-yoomee uk-button-yoomee-shop"><?php pll_e('Consultez nos albums' , 'yoomee'); ?></a>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<?php endwhile; ?>

<?php get_footer(); ?>
