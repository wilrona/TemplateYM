<?php

add_action('wp_ajax_load_album_by_ajax', 'load_album_by_ajax_callback');
add_action('wp_ajax_nopriv_load_album_by_ajax', 'load_album_by_ajax_callback');


function load_album_by_ajax_callback() {
        check_ajax_referer('load_more_album', 'security');

	    $current_post = $_POST['current_post'];

		$posts2 = get_post($current_post);

        if($posts2):

        foreach (tr_posts_field('photoalbum', $posts2->ID) as $images):
?>
                <a class="uk-inline" href="<?php echo wp_get_attachment_image_src($images, 'full')[0] ?>" data-type="image">
                    <img src="<?php echo wp_get_attachment_image_src($images, 'full')[0] ?>" alt="">
                </a>
<?php
        endforeach;
        endif;
        wp_die();
}



add_action('wp_ajax_load_media_by_ajax', 'load_media_by_ajax_callback');
add_action('wp_ajax_nopriv_load_media_by_ajax', 'load_media_by_ajax_callback');


function load_media_by_ajax_callback() {
	check_ajax_referer('load_more_media', 'security');

	$current_post = $_POST['current_post'];

	$posts2 = get_post($current_post);

	if($posts2):

	if(get_post_type($posts2->ID) == 'album'):

        foreach (tr_posts_field('photoalbum', $posts2->ID) as $images):
            ?>
            <a class="uk-inline" href="<?php echo wp_get_attachment_image_src($images, 'full')[0] ?>" data-type="image">
                <img src="<?php echo wp_get_attachment_image_src($images, 'full')[0] ?>" alt="">
            </a>
            <?php
        endforeach;

    else:
?>
        <a class="uk-inline" href="//www.youtube.com/watch?v=<?= get_post_meta($posts2->ID, 'youtubeid', true) ?>">
            <img src="http://img.youtube.com/vi/<?= get_post_meta($posts2->ID, 'youtubeid', true) ?>/0.jpg" alt="">
        </a>
<?php
	endif;
	endif;
	wp_die();
}