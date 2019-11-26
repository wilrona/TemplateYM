<?php /* Template Name: Pages Services */ ?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <div class="uk-section uk-section-about uk-section-small">
            <div class="uk-container">

                <?php

                if (get_child_pages_by_parent_title($post->ID)):
                    ?>

                    <ul class="uk-subnav uk-subnav-divider uk-flex-right uk-subnav-color uk-subnav-content" uk-margin>
                        <?php  foreach (get_child_pages_by_parent_title($post->ID) as $child):                            ?>
                            <li><a href="<?php echo esc_url( get_page_link( $child->ID ) ); ?>"><?= $child->post_title; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif;


                ?>

            </div>
        </div>

<?php



if (get_child_pages_by_parent_title($post->ID)):
    ?>

    <?php
        $item = 0;
        foreach (get_child_pages_by_parent_title($post->ID) as $child):
    ?>
        <div class="uk-section uk-section-large <?php if($item % 2 == 1): ?> uk-section-service <?php endif; ?> uk-background-norepeat uk-background-cover uk-background-center-center uk-section-home-about" style="background-image: url('<?php echo get_post_meta($child->ID, 'image_illustration', true)['guid']; ?>');">
            <div class="uk-container">
                <div class="uk-margin" uk-grid>
                    <?php if($item % 2 == 1): ?>
                        <div class="uk-width-1-1 uk-flex uk-flex-right">
                            <div class="uk-width-1-3@l">
                                <div class="uk-height-1-1 uk-text-right">
                                    <h1 class=""><?= $child->post_title; ?></h1>
                                    <?php echo get_post_meta($child->ID, 'texte_illustration', true); ?>
                                    <a href="<?php echo esc_url( get_page_link( $child->ID ) ); ?>" class="uk-button uk-button-yoomee uk-button-yoomee-shop uk-margin-medium-top"><?php pll_e('Plus information' , 'yoomee'); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($item % 2 == 0): ?>
                    <div class="uk-width-1-1">
                        <div class="uk-width-1-3@l">
                            <div class="uk-height-1-1">
                                <h1 class=""><?= $child->post_title; ?></h1>
                                <?php echo get_post_meta($child->ID, 'texte_illustration', true); ?>
                                <a href="<?php echo esc_url( get_page_link( $child->ID ) ); ?>" class="uk-button uk-button-yoomee uk-button-yoomee-shop uk-margin-medium-top"><?php pll_e('Plus information' , 'yoomee'); ?></a>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
        $item++;
        endforeach;
    ?>
<?php endif; ?>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
