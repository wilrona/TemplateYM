<?php

require('custom/admin.php');

require ('typerocket/init.php');

require ('app/init.php');

tr_frontend();

$settings = ['capability' => 'administrator', 'position' => '50'];

$seat_index = tr_page('CV', 'index', 'Recherche CV', $settings);

$seat_index->setIcon('book')->useController();

//include 'custom/yoochat.backend.php';
//include 'custom/yoochat.frontend.php';

//include 'custom/facebook.php';
//include 'custom/test_lte.php';
//include 'custom/ajax.post.php';

// require('functions/page_for_archive.php');

function admin_script(){
	wp_register_script ( 'backend' , get_stylesheet_directory_uri() . '/js/backend.js', '', '1', true );
	wp_enqueue_script( 'backend' );
}

add_action( 'admin_enqueue_scripts', 'admin_script');


class My_Custom_Walker extends Walker
{
   public $tree_type = 'catalogue';

   public $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

   public function start_lvl( &$output, $depth = 0, $args = array() ) {
      $output .= "<div class=\"uk-accordion uk-scrollspy-inview uk-animation-slide-top-small\">\n";
   }

   public function end_lvl( &$output, $depth = 0, $args = array() ) {
      $output .= "</div>\n";
   }

   public function start_el( &$output, $catalogue, $depth = 0, $args = array(), $current_object_id = 0 ) {
      $output .= " <div class=\"el-item\"><h3 class=\"el-title uk-accordion-title\"><a href=\"".get_permalink($catalogue->ID)."\" style=\"color:#fff !important; display:inline-block;width:95%\">" . $catalogue->post_title . "\n";
   }

   public function end_el( &$output, $catalogue, $depth = 0, $args = array() ) {
      $output .= "</a></h3></div>\n";
   }
}

function kriesi_pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<ul class=\"uk-pagination uk-flex-center\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'><span uk-pagination-previous></span><span uk-pagination-previous></span></a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'><span uk-pagination-previous></span></a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class=\"uk-active\"><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'><span uk-pagination-next></span></a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'><span uk-pagination-next></span><span uk-pagination-next></span></a></li>";
         echo "</ul>\n";
     }
}

function get_child_pages_by_parent_title($pageId, $limit = -1)
{
    // needed to use $post
    global $post;
    // used to store the result
    $pages = array();

    // What to select
    $args = array(
        'post_type' => 'page',
        'post_parent' => $pageId,
        'posts_per_page' => $limit,
        'orderby' => 'ID',
        'order' => 'ASC'
    );

    $the_query = new WP_Query( $args );

    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $pages[] = $post;
    }
    wp_reset_postdata();
    return $pages;
}

function get_child_pages()
{
    // needed to use $post
    global $post;
    // used to store the result
    $pages = array();

    $terms = get_terms([
        'taxonomy' => 'type_produit',
        'hide_empty' => false,
        'posts_per_page' => 4,
        'orderby' => 'rand'
//        'order' => 'ASC'
    ]);
    $slug_page = array();
    foreach ($terms as $term):

        $slug_page[] = $term->slug;

    endforeach;

    // What to select
    $args = array(
        'post_type' => 'page',
        'tax_query' => array(
            array(
                'taxonomy' => 'type_produit',
                'field' => 'slug',
                'terms' => $slug_page,
            ),
        ),
    );

    $the_query = new WP_Query( $args );

    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        if(!empty($post->post_parent)){

            $pages[] = $post;
        }
    }
    wp_reset_postdata();
    return $pages;
}

/**
 * Get taxonomies terms links.
 *
 * @see get_object_taxonomies()
 */
function wpdocs_custom_taxonomies_terms_links() {
	// Get post by post ID.
	global $post;

	$post = get_post( $post->ID );

	// Get post type by post.
	$post_type = $post->post_type;

	// Get post type taxonomies.
	$taxonomies = get_object_taxonomies( $post_type, 'objects' );

	$out = array();

	foreach ( $taxonomies as $taxonomy_slug => $taxonomy ) {

		// Get the terms related to post.
		$terms = get_the_terms( $post->ID, $taxonomy_slug );

		if ( ! empty( $terms ) ) {
			$out[] = "<h2>" . $taxonomy->label . "</h2>\n<ul>";
			foreach ( $terms as $term ) {
				$out[] = sprintf( '<li><a href="%1$s">%2$s</a></li>',
					esc_url( get_term_link( $term->slug, $taxonomy_slug ) ),
					esc_html( $term->name )
				);
			}
			$out[] = "\n</ul>\n";
		}
	}

	return implode( '', $out );

}

if ( function_exists('pll_languages_list') ) {
	add_action('wpml_loaded', '__return_true', 10, 0);
	do_action('wpml_loaded');
}


add_action( 'template_redirect', 'wpse_128636_redirect_post' );

function wpse_128636_redirect_post() {
	$queried_post_type = get_query_var('post_type');
	if ( is_single() && 'resume' ==  $queried_post_type ) {
		wp_redirect( home_url(), 301 );
		exit;
	}
}


////Ensure that a session exists (just in case)
//if( !session_id() )
//{
//	session_start();
//}


add_filter ("wp_mail_content_type", "my_awesome_mail_content_type");
function my_awesome_mail_content_type() {
	return "text/html";
}

add_filter ("wp_mail_from", "my_awesome_mail_from");
function my_awesome_mail_from() {
	return "no_reply@yoomee.cm";
}

add_filter ("wp_mail_from_name", "my_awesome_mail_from_name");
function my_awesome_email_from_name() {
	return "Yoomee Mobile";
}



