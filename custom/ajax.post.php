<?php

add_action('wp_ajax_load_data_by_ajax', 'load_data_by_ajax_callback');
add_action('wp_ajax_nopriv_load_data_by_ajax', 'load_data_by_ajax_callback');



function load_data_by_ajax_callback() {
	check_ajax_referer('load_more_data', 'security');
	$total = 0;

//	if(isset($_POST['nbreEmail'])){
//		$nbreEmail = $_POST['nbreEmail'];
//		$nbreEmail_Coef = 0.00001430511474609375;
//
//		$value = $nbreEmail * $nbreEmail_Coef * 1000;
//		$nbreEmail_total = ceil($value) / 1000;
//
//		$total += $nbreEmail_total;
//    }


	if(isset($_POST['nbreEmailFichier'])){
		$nbreEmailFichier = $_POST['nbreEmailFichier'];
		$nbreEmailFichier_Coef = 0.0100095367431640625;

		$value = $nbreEmailFichier * $nbreEmailFichier_Coef * 1000;
		$nbreEmailFichier_total = ceil($value) / 1000;

		$total += $nbreEmailFichier_total;
	}

	if(isset($_POST['videoStreaming'])){
		$videoStreaming = $_POST['videoStreaming'];
		$videoStreaming_Coef = 0.21;

		$value = $videoStreaming * $videoStreaming_Coef * 1000;
		$videoStreaming_total = ceil($value) / 1000;

		$total += $videoStreaming_total;
	}

	if(isset($_POST['chatRS'])){
		$chatRS = $_POST['chatRS'];
		$chatRS_Coef = 0.0005859375;

		$value = $chatRS * $chatRS_Coef * 1000;
		$chatRS_total = ceil($value) / 1000;

		$total += $chatRS_total;
	}

	if(isset($_POST['musique'])){
		$musique = $_POST['musique'];
		$musique_Coef = 0.00361328125;

		$value = $musique * $musique_Coef * 1000;
		$musique_total = ceil($value) / 1000;

		$total += $musique_total;
	}

    if(isset($_POST['docPresentation'])){
	    $docPresentation = $_POST['docPresentation'];
	    $docPresentation_Coef = 0.0009765625;

	    $value = $docPresentation * $docPresentation_Coef * 1000;
	    $docPresentation_total = ceil($value) / 1000;

	    $total += $docPresentation_total;
    }

    if(isset($_POST['photos'])){
	    $photos = $_POST['photos'];
	    $photos_Coef = 0.0009765625;

	    $value = $photos * $photos_Coef * 1000;
	    $photos_total = ceil($value) / 1000;

	    $total += $photos_total;
    }

    if(isset($_POST['sauvagarde'])){
	    $sauvagarde = $_POST['sauvagarde'];
	    $sauvagarde_Coef = 1;

	    $value = $sauvagarde * $sauvagarde_Coef * 1000;
	    $sauvagarde_total = ceil($value) / 1000;

	    $total += $sauvagarde_total;
    }

    if(isset($_POST['application'])){
	    $application = $_POST['application'];
	    $application_Coef = 0.48828125;

	    $value = $application * $application_Coef * 1000;
	    $application_total = ceil($value) / 1000;

	    $total += $application_total;
    }

    if(isset($_POST['jeux'])){
	    $jeux = $_POST['jeux'];
	    $jeux_Coef = 0.01025390625;

	    $value = $jeux * $jeux_Coef * 1000;
	    $jeux_total = ceil($value) / 1000;

	    $total += $jeux_total;
    }


    if($total > 0){

	    $custom_args = array(
		    'post_type' => 'produit',
		    'posts_per_page' => 1,
		    'lang' => $_POST['lang'],
		    'meta_key' => 'capacite',
		    'orderby' => 'meta_key',
		    'order' => 'ASC',
		    'tax_query' => array(
			    array(
				    'taxonomy' => 'type_produit',
				    'field' => 'slug',
				    'terms' => 'forfait-internet',
			    ),
		    ),
		    'meta_query' => array(
			    array(
				    'key' => 'capacite',
				    'value' => $total,
				    'compare' => '>='
			    )
		    )


	    );

	    $custom_query = new WP_Query( $custom_args );

	    if ( $custom_query->have_posts() ) :


    ?>
            <div class="uk-card-body uk-text-center">
                <h6 class="uk-heading-primary"><?= $total ?> Go</h6>
            </div>

		    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

                     <h3><?php the_title() ?></h3>

            <?php endwhile;  ?>


    <?php

        endif;
    }



wp_die();
}