<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 13/02/2018
 * Time: 16:04
 */
?>

<?php /* Template Name: Pages vidéo */ ?>
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

		<?php

		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

		$custom_args = array(
			'post_type' => 'video',
			'posts_per_page' => 8,
			'paged' => $paged,
//			'lang' => pll_current_language(),
		);

		$custom_query = new WP_Query( $custom_args );

		if ( $custom_query->have_posts() ) :

		?>
			<div uk-lightbox class="uk-child-width-1-4@m" uk-grid>
				<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
					<div>
						<a href="//www.youtube.com/watch?v=<?= tr_posts_field('youtubeid', $post->ID) ?>" caption="<?= $post->post_title; ?>" class="uk-display-block uk-cover-container">
							<img src="http://img.youtube.com/vi/<?= tr_posts_field('youtubeid', $post->ID) ?>/0.jpg" alt="" uk-cover>
                            <canvas width="370" height="250"></canvas>
						</a>
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
	</div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
