<?php
/**
 * Single view Job meta box
 *
 * Hooked into single_job_listing_start priority 20
 *
 * @since 1.14.0
 * @version 1.27.0
 *
 * @package WP Job Manager
 * @category Template
 * @author Automattic
 */

global $post;

do_action( 'single_job_listing_meta_before' ); ?>

<div class="uk-width-1-1 uk-flex-last uk-flex-right">
    <ul class="job-listing-meta meta uk-flex uk-flex-right ">
        <?php do_action( 'single_job_listing_meta_start' ); ?>

        <?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
            <?php $types = wpjm_get_the_job_types(); ?>
            <?php if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>

                <li class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>" itemprop="employmentType" class="uk-background-yoomee"><?php echo esc_html( $type->name ); ?></li>

            <?php endforeach; endif; ?>
        <?php } ?>

        <li class="location" itemprop="jobLocation"><?php the_job_location(); ?></li>

        <li class="date-posted" itemprop="datePosted"><?php the_job_publish_date(); ?></li>

        <?php if ( is_position_filled() ) : ?>
            <li class="position-filled"><?php pll_e( 'This position has been filled', 'wp-job-manager' ); ?></li>
        <?php elseif ( ! candidates_can_apply() && 'preview' !== $post->post_status ) : ?>
            <li class="listing-expired"><?php pll_e( 'Applications have closed', 'wp-job-manager' ); ?></li>
        <?php endif; ?>

        <?php do_action( 'single_job_listing_meta_end' ); ?>
    </ul>
</div>

<?php do_action( 'single_job_listing_meta_after' ); ?>
