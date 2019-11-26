<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <title><?php bloginfo('name'); ?> - <?php wp_title(); ?></title>
    <meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true);
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />
    <meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" />

    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
<!--    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700" rel="stylesheet">-->
<!--    <link href="https://fonts.googleapis.com/css?family=Amaranth:400,400i,700,700i|Josefin+Sans:400,400i,600,700,700i|Roboto:400,400i,500,700,700i" rel="stylesheet">-->
<!--    <link rel="stylesheet" href="--><?php //echo get_template_directory_uri(); ?><!--/css/bootstrap.min.css">-->
<!--    <link href="--><?php //echo get_template_directory_uri(); ?><!--/img/ico.png" rel="icon">-->

<!--    <link rel="stylesheet" href="--><?php //echo get_template_directory_uri(); ?><!--/css/mbr-additional.css">-->
<!--    <script src="--><?php //echo get_template_directory_uri(); ?><!--/js/jquery.min.js" type="text/javascript"></script>-->
    <?php
        wp_head();
    ?>
</head>

<body <?php body_class('uk-position-relative'); ?>>

<?php
    if(is_page(pll_get_post('8'))){
?>

        <div class="uk-position-relative" id="header">

            <div class="uk-position-relative">
                <?php if(is_language('fr')): ?>

                <?php echo do_shortcode(" [crellyslider alias=\"accueil\"]"); ?>

                <?php else: ?>

	                <?php echo do_shortcode("[crellyslider alias=\"home\"]"); ?>

                <?php endif; ?>
                <div class="uk-position-top uk-visible@l" style="z-index: 10">
                    <header class="">
                        <div class="uk-navbar uk-padding-large uk-padding-remove-vertical" uk-navbar style="padding-top: 35px; padding-bottom: 15px;">
                            <div class="uk-navbar-left">

                                <a class="uk-navbar-item uk-logo" href="<?php bloginfo('url'); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.png" alt="">
                                </a>



                            </div>
                            <div class="uk-navbar-right uk-subhome">
                                <ul class="uk-navbar-nav uk-subnav uk-subnav-divider uk-subnav-color">
                                    <li>
                                        <?php
                                        $infoline = pods( 'information_entreprise' );
                                        ?>
                                        Infoline : <span class="uk-margin-small-left"><?= $infoline->field('infoline') ?></span>
                                    </li>

<!--                                    --><?php //pll_the_languages(array('display_names_as'=> 'slug', 'hide_if_empty' => 0)); ?>
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>
            </div>

            <div class="uk-background-menu uk-box-shadow-medium" uk-sticky>
                <nav class="uk-navbar uk-padding-large uk-padding-remove-vertical uk-hidden@l" uk-navbar="mode: click;">
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-toggle" href="#" uk-toggle="target: #offcanvas-nav-primary">
                            <span uk-navbar-toggle-icon></span>
                        </a>
                        <a class="uk-navbar-item uk-logo" href="<?php bloginfo('url'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.png" alt="">
                        </a>
                    </div>
                    <div class="uk-navbar-right uk-subhome">
                        <div class="uk-hidden">
                            <ul class="uk-navbar-nav uk-subnav uk-subnav-divider uk-subnav-color uk-navbar-item  uk-visible@m">
                                <li>
						            <?php
						            $infoline = pods( 'information_entreprise' );
						            ?>
                                    Infoline : <span class="uk-margin-small-left"><?= $infoline->field('infoline') ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="uk-navbar-item">
                            <ul class="uk-navbar-nav uk-subnav uk-subnav-divider uk-subnav-color">
<!--		                        --><?php //pll_the_languages(array('display_names_as'=> 'slug', 'hide_if_empty' => 0)); ?>
                            </ul>
                        </div>
                    </div>
                </nav>
                <nav class="uk-navbar uk-padding-large uk-padding-remove-vertical uk-visible@l" uk-navbar="mode: click;">
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-item uk-logo" href="<?php bloginfo('url'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.png" alt="" class="uk-hidden">
                        </a>
                    </div>
                    <div class="uk-navbar-center uk-flex uk-flex-center uk-width-2-3">
                        <?php
                        $defaults = array(
                            'container'       => '',
                            'container_class' => '',
                            'menu_class' => 'uk-navbar-nav uk-subnav uk-subnav-menu',
                            'theme_location' => 'header',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker' => new CSS_Menu_Maker_Walker,
                            'menu' => ''
                        );
                        wp_nav_menu( $defaults );
                        ?>
                    </div>
                    <div class="uk-navbar-right uk-subhome">
                        <div class="uk-hidden">
                            <ul class="uk-navbar-nav uk-subnav uk-subnav-divider uk-subnav-color">
                                <li>
                                    <?php
                                    $infoline = pods( 'information_entreprise' );
                                    ?>
                                    Infoline : <span class="uk-margin-small-left"><?= $infoline->field('infoline') ?></span>
                                </li>

<!--                                --><?php //pll_the_languages(array('display_names_as'=> 'slug', 'hide_if_empty' => 0)); ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <div id="offcanvas-nav-primary" uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar uk-flex uk-flex-column">
                    <a class="uk-navbar-item uk-logo" href="<?php bloginfo('url'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.png" alt="">
                    </a>
	                <?php
	                $defaults = array(
		                'container'       => '',
		                'container_class' => '',
		                'menu_class' => 'uk-nav-primary uk-nav-default uk-nav-parent-icon uk-margin-auto-vertical',
		                'theme_location' => 'header',
		                'items_wrap' => '<ul id="%1$s" class="%2$s" uk-nav>%3$s</ul>',
		                'walker' => new CSS_Menu_Maker_Walker_mobile,
		                'menu' => ''
	                );
	                wp_nav_menu( $defaults );
	                ?>

                </div>
            </div>

        </div>

<?php
    }else{

        if(!is_front_page()){

?>
<div class="uk-position-relative " uk-height-viewport="expand: true" id="header">
        <?php if(is_single()): ?>
            <?php
                if ( get_post_type( get_the_ID() ) == 'post' ) {
	                $blog_page = new WP_Query( array( 'page_id' => pll_get_post('98') ) );
                    $blog_page_id = $blog_page->post->ID;
                }elseif (get_post_type( get_the_ID() ) == 'produit' ){
	                $blog_page = new WP_Query( array( 'page_id' => pll_get_post('62') ) );
	                $blog_page_id = $blog_page->post->ID;
                }elseif (get_post_type( get_the_ID() ) == 'job_listing' ){
	                $blog_page = new WP_Query( array( 'page_id' => pll_get_post('123') ) );
	                $blog_page_id = $blog_page->post->ID;
                }
            ?>
        <?php endif; ?>

        <?php if(is_page()): ?>
	        <?php $blog_page_id = get_the_ID();?>
            <?php
//                if(wp_get_post_parent_id( get_the_ID() )){
//	                $blog_page_id = wp_get_post_parent_id( get_the_ID() );
//                }
            ?>
        <?php endif; ?>

        <?php if(is_tax()):?>

	        <?php
                global $enhanced_category;
                //get enhanced category post and set it up as global current post
                $enhanced_category->setup_ec_data();

	        ?>

	        <?php $blog_page_id = get_the_ID();?>
	        <?php
	        if(wp_get_post_parent_id( get_the_ID() )){
		        $blog_page_id = wp_get_post_parent_id( get_the_ID() );
	        }
	        ?>

        <?php endif; ?>
        <div class="uk-position-relative uk-background-norepeat uk-background-cover uk-background-center-center uk-height-large" style="background-image: url('<?=  get_the_post_thumbnail_url($blog_page_id, 'full');?>');">

            <div class="uk-position-cover uk-flex uk-flex-middle" style="background-color: rgba(0, 0, 0, 0.4);">
                <div class="uk-text-center uk-width-1-1">
                    <h1 class="uk-text-yoomee-2 uk-h2"><?php the_title() ?></h1>
<!--                            --><?php //// Breadcrumb navigation
                            if (is_page() && !is_front_page() || is_single() || is_category() || is_tax()) {
                                ?>
                                <ul class="uk-subnav uk-subnav-divider uk-flex uk-flex-center uk-filariane">
                                <li><a title="Accueil" rel="nofollow" href=" <?= get_the_permalink(pll_get_post('8')) ?>" class="uk-link-text"> <?php pll_e('Accueil' , 'yoomee') ?></a></li>
                                <?php

                                if (is_page()) {
                                    $ancestors = get_post_ancestors($post);
                                    ?>
                                    <?php
                                    if ($ancestors) {
                                        $ancestors = array_reverse($ancestors);
                                        foreach ($ancestors as $crumb) {
                                            ?>
                                            <li><a href="<?= get_permalink($crumb) ?>" class="uk-link-text"><?= get_the_title($crumb) ?></a></li>
<!--                                            <li><a href="--><?//= get_permalink($crumb) ?><!--" class="uk-link-text">--><?//= get_the_title($crumb) ?><!--</a></li>-->
                                         <?php
                                        }
                                    }
                                }

                                if (is_single()) {
//                                    $category = get_the_category();
//                                    echo '<li><a href="'.get_category_link($category[0]->cat_ID).'" class="uk-link-text">'.$category[0]->cat_name.'</a></li>';

                                    $category = get_post_type(get_the_ID());
                                    if ($category == 'post'){
                                        $blog_page_post = new WP_Query( array( 'page_id' => pll_get_post('98') ) );
                                        ?>
                                            <li><a href="<?= get_the_permalink($blog_page_post->post->ID); ?>" class="uk-link-text"><?php pll_e('Actualité' , 'yoomee') ?></a></li>
                                        <?php
                                    }elseif($category == 'job_listing'){
                                        ?>
                                            <li><a href="<?= esc_url( get_page_link( pll_get_post('123') ) ) ?>" class="uk-link-text"> <?php pll_e('Postes' , 'yoomee') ?></a></li>
                                        <?php
                                    }elseif($category == 'produit'){
                                       ?>
	                                    <?php $term_custom = get_the_terms( get_the_ID(), 'type_produit' );?>

                                        <li><a href="<?php echo esc_url(get_page_link('62')); ?>" class="uk-link-text"> <?php pll_e('Shop' , 'yoomee') ?></a></li>

                                        <li><a href="<?= esc_url(get_term_link($term_custom[0])) ?>" class="uk-link-text"> <?= $term_custom[0]->name ?></a></li>
                                    <?php
                                    }

                                }

                                if (is_category()) {
                                    $category = get_the_category();
                                    echo '<li>'.$category[0]->cat_name.'</li>';
                                }

                                if (is_tax()) {

//	                                echo '<li>'.get_queried_object()->name.'</li>';
                                    ?>
	                                <li><?php pll_e('Shop' , 'yoomee') ?></li>
                                    <?php
                                }



                                // Current page
//                                if (is_page() || is_single()) {
//                                    echo '<li>'.get_the_title().'</li>';
//                                }
                                echo '</ul>';
                            } elseif (is_front_page()) {
                                // Front page
                                    ?>
                                        <ul>
                                            <li><a title="Accueil" rel="nofollow" href="<?= get_the_permalink(pll_get_post('8')) ?>" class="uk-link-text"><?php pll_e('Accueil' , 'yoomee') ?></a></li>
                                        </ul>
                                    <?php
                            }
//                            ?>
                </div>
            </div>
            <div class="uk-position-top" style="z-index: 10">

                <div class="" uk-sticky>
                    <nav class="uk-navbar uk-padding-large uk-padding-remove-vertical uk-hidden@l" uk-navbar="mode: click;">
                        <div class="uk-navbar-left uk-padding-small uk-padding-remove-horizontal">
                            <a class="uk-navbar-toggle" href="#" uk-toggle="target: #offcanvas-nav-primary">
                                <span uk-navbar-toggle-icon></span>
                            </a>
                            <a class="uk-navbar-item uk-logo" href="<?php bloginfo('url'); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.png" alt="">
                            </a>
                        </div>
                        <div class="uk-navbar-right uk-subhome uk-padding-small uk-padding-remove-horizontal">
                            <div class="uk-visible@m">
                                <ul class="uk-navbar-nav uk-subnav uk-subnav-divider uk-subnav-color uk-navbar-item">
                                    <li>
						                <?php
						                $infoline = pods( 'information_entreprise' );
						                ?>
                                        Infoline : <span class="uk-margin-small-left"><?= $infoline->field('infoline') ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="uk-navbar-item">
                                <ul class="uk-navbar-nav uk-subnav uk-subnav-divider uk-subnav-color">
<!--					                --><?php //pll_the_languages(array('display_names_as'=> 'slug', 'hide_if_empty' => 0)); ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <nav class="uk-navbar uk-padding-large uk-padding-remove-vertical uk-visible@l" uk-navbar="mode: click;">
                        <div class="uk-navbar-left uk-padding-small">
                            <a class="uk-navbar-item uk-logo" href="<?php bloginfo('url'); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.png" alt="">
                            </a>
                        </div>
                        <div class="uk-navbar-center uk-padding-small uk-flex uk-flex-center uk-width-2-3">
                            <?php
                            $defaults = array(
                                'container'       => '',
                                'container_class' => '',
                                'menu_class' => 'uk-navbar-nav uk-subnav uk-subnav-menu',
                                'theme_location' => 'header',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'walker' => new CSS_Menu_Maker_Walker,
                                'menu' => ''
                            );
                            wp_nav_menu( $defaults );
                            ?>
                        </div>
                        <div class="uk-navbar-right uk-padding-small">
                            <ul class="uk-navbar-nav uk-subnav uk-subnav-divider uk-subnav-color">
                                <li>
                                    <?php
                                    $infoline = pods( 'information_entreprise' );
                                    ?>
                                    Infoline : <span class="uk-margin-small-left"><?= $infoline->field('infoline') ?></span>
                                </li>

<!--                                --><?php //pll_the_languages(array('display_names_as'=> 'slug', 'hide_if_empty' => 0)); ?>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div id="offcanvas-nav-primary" uk-offcanvas="overlay: true">
                    <div class="uk-offcanvas-bar uk-flex uk-flex-column">
                        <a class="uk-navbar-item uk-logo" href="<?php bloginfo('url'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.png" alt="">
                        </a>
			            <?php
			            $defaults = array(
				            'container'       => '',
				            'container_class' => '',
				            'menu_class' => 'uk-nav-primary uk-nav-default uk-nav-parent-icon uk-margin-auto-vertical',
				            'theme_location' => 'header',
				            'items_wrap' => '<ul id="%1$s" class="%2$s" uk-nav>%3$s</ul>',
				            'walker' => new CSS_Menu_Maker_Walker_mobile,
				            'menu' => ''
			            );
			            wp_nav_menu( $defaults );
			            ?>

                    </div>
                </div>

            </div>
        </div>



</div>


<?php
        }
    }
?>

<div class="uk-position-center-left uk-position-fixed uk-float-menu uk-padding-remove-horizontal uk-padding-small uk-visible@m uk-box-shadow-medium">
    <ul class="uk-list uk-text-center uk-margin-remove" style="padding: 0 4px;">
        <li>
            <a href="<?php echo esc_url( get_page_link( pll_get_post('142') ) ); ?>" class="uk-display-block">
                <span uk-icon="icon: location; ratio: 1" class="uk-display-block"></span>
                <span class=""><?php pll_e('Agences' , 'yoomee'); ?></span>
            </a>
            <hr class="uk-margin-small-top">
        </li>
        <li>
            <a href="https://my.yoomee.cm/" class="uk-display-block" target="_blank">
                <span uk-icon="icon: users; ratio: 1" class="uk-display-block"></span>
                <span class=""><?php pll_e('Mon Compte' , 'yoomee'); ?></span>
            </a>
            <hr class="uk-margin-small-top">
        </li>
        <li>
            <a href="<?php echo esc_url( get_page_link( pll_get_post('98') ) ); ?>" class="uk-display-block">
                <span uk-icon="icon: world; ratio: 1" class="uk-display-block"></span>
                <span class=""><?php pll_e('Blog' , 'yoomee'); ?></span>
            </a>
            <hr class="uk-margin-small-top">
        </li>
        <li>
            <a href="<?php echo esc_url( get_page_link( pll_get_post('123') ) ); ?>" class="uk-display-block">
                <span  uk-icon="icon: album; ratio: 1" class="uk-display-block"></span>
                <span class=""><?php pll_e('Emploi' , 'yoomee'); ?></span>
            </a>
        </li>
    </ul>
</div>

