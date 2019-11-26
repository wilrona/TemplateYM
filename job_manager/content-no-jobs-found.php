<?php if ( defined( 'DOING_AJAX' ) ) : ?>
	<li class="no_job_listings_found"><?php pll_e( 'There are no listings matching your search.', 'wp-job-manager' ); ?></li>
<?php else : ?>
	<p class="no_job_listings_found"><?php pll_e( 'There are currently no vacancies.', 'wp-job-manager' ); ?></p>
<?php endif; ?>