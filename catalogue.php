<?php /* Template Name: Catalogue */ ?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    
    <div class="uk-section-muted uk-section uk-background-norepeat uk-background-cover uk-position-relative uk-background-center-center uk-light" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/photo-els.jpg);">
    <div class="uk-position-cover uk-gradien"></div>
    <div class="uk-container uk-container-small uk-position-relative">
      <div class="uk-grid-margin uk-grid" uk-grid="">
        <div class="uk-width-1-1@m">
          <h1 class="uk-text-center uk-h2 uk-margin-remove uk-heading-primary">
            <?php the_title() ?>    </h1>
            <div class="uk-width-xxlarge uk-margin-auto uk-text-center uk-text-lead">
                <?php
                $logan = pods( 'information_entreprise' );
                ?>
                <?=
                    $logan->field('slogan')
                    ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php endwhile; ?>
<?php endif; ?>

	<?php
	wp_reset_postdata();

	$arg = array(
		'post_type' => 'catalogue',
		'posts_per_page' => -1,
		'post_parent' => 0,
		'order' => 'asc'
	);

	$catalogue = new WP_query($arg);

	if($catalogue->have_posts()):

	?>

	<div class="uk-section-default uk-section">
		<div class="uk-container">
			<div class="uk-grid-margin uk-grid" uk-grid uk-height-match uk-scrollspy="target:[uk-scrollspy-class];cls:uk-animation-slide-left-medium;delay:250;repeat:true">
				<?php
					while ($catalogue->have_posts()) :
						$catalogue->the_post();
						global $post;

				?>
				<div class="uk-width-1-2@m">
					<div class="uk-margin uk-card uk-box-shadow-small uk-padding-small" uk-scrollspy-class>
						<h3 class="el-title uk-margin">
							<a href="<?= get_permalink() ?>"><?= the_title(); ?></a>
						</h3>
						<div class="el-content uk-margin uk-truncate uk-height-small uk-flex uk-flex-middle">
							<?= get_post_meta($post->ID, 'presentation', true) ?>
						</div>
					</div>
				</div>

				<?php
				    endwhile;
				?>
			</div>
		</div>
	</div>

	<?php

		endif;
	?>

<?php get_footer(); ?>