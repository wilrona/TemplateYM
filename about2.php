<?php /* Template Name: Qui sommes nous2 */ ?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>


        <?php $blocks = tr_posts_field('blockabout'); ?>

		<?php foreach ($blocks as $block):?>

			<?php
			if(!empty($block['classresponsive'])):
				?>
                <style>
                    @media screen and (max-width: 815px) {
                        .<?= $block['classresponsive'] ?>{
                            background-color: <?= $block['bgresponsiveabout'] ?> !important;
                        }
                        .<?= $block['classresponsive'] ?> .title-about{
                            color: <?= $block['titlecolorresponsiveabout'] ?> !important;
                        }
                        .<?= $block['classresponsive'] ?> .content-about{
                            color: <?= $block['desccolorresponsiveabout'] ?> !important;
                        }
                    }

                </style>

				<?php
			endif;
			?>


            <div class="uk-section-service uk-background-norepeat uk-background-cover uk-background-center-center uk-section-block" uk-scrollspy="target:[uk-scrollspy-class];cls:uk-animation-slide-right-small;delay:350;repeat:true" style="background-image: url('<?php echo wp_get_attachment_image_src($block['imageblockabout'], 'full')[0] ?>');">
                <div class="uk-flex uk-flex-middle uk-width-1-1 uk-background-responsive <?= $block['classresponsive'] ?>" style="min-height: 800px;">
                    <div class="uk-padding-large uk-padding-remove-vertical uk-width-1-1">
                        <div class="uk-grid-collapse uk-flex <?= $block['positionabout'] ?> uk-flex-middle" uk-grid>
                            <!--                    <div class="uk-width-1-1 uk-flex uk-flex-middle --><?//= $block['position'] ?><!--  ">-->

                            <div class="uk-width-1-2@m uk-margin-remove">
                                <div class="uk-padding uk-padding-remove-horizontal uk-height-1-1 uk-flex uk-flex-middle uk-flex-center">
                                    <div class="uk-padding uk-padding-remove-horizontal">
                                        <h1 class="uk-margin-medium-bottom title-about" uk-scrollspy-class style="color: <?= $block['couleurtitle'] ?>; font-weight: bolder;"><?= $block['titleblockabout']; ?> </h1>
                                        <div class="uk-text-justify content-about" uk-scrollspy-class style="color: <?= $block['couleurtexte'] ?>; font-size: 20px; font-weight: lighter;"><?= $block['descblockabout']; ?></div>
                                    </div>
                                </div>

                            </div>
                            <!--                    </div>-->
                        </div>
                    </div>
                </div>

            </div>


		<?php endforeach; ?>

		<?php

		$equipes = tr_posts_field('blockequipe');

		if($equipes):

			?>
            <div class="uk-section">
                <div class="uk-container">
                    <div class="uk-width-1-1 uk-margin-large-bottom uk-flex uk-flex-center">
                        <div class="uk-width-1-2 uk-text-center">
                            <h2 class="uk-h1"><?php pll_e('Notre équipe' , 'yoomee'); ?></h2>
                            <div class="uk-text-home-abouts">
								<?= tr_posts_field('descequipe'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="uk-margin uk-grid-large uk-child-width-1-4@l uk-child-width-1-3@m uk-child-width-1-2@s  uk-text-home-abouts" uk-grid>
						<?php foreach ( tr_posts_field('blockequipe') as $empl ):  ?>
                            <div class="uk-flex uk-flex-middle">
                                <div class="uk-text-center uk-width-1-1 uk-background-default uk-padding-small uk-border-rounded">
                                    <div class="uk-margin-small-bottom uk-inline-clip uk-transition-toggle">
                                        <img src="<?php echo wp_get_attachment_image_src($empl['photoemp'], 'full')[0] ?>" alt="" class="uk-display-block uk-border-circle uk-margin-auto">


                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle uk-border-circle">
                                            <span class="uk-transition-fade" style="color: #ffffff;"><?= $empl['descemp']; ?></span>
                                        </div>


                                    </div>
                                    <span class="uk-h3 uk-display-block uk-margin-small-bottom uk-margin-small-top"><?= $empl['nomemp'] ?></span>
                                    <span class="uk-h6 uk-text-bold"><?= $empl['posteemp']; ?></span>
                                </div>
                            </div>
						<?php endforeach; ?>

                    </div>
                </div>
            </div>
		<?php endif; ?>


    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
