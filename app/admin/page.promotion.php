<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 13/02/2018
 * Time: 12:09
 */


$boxBlock = tr_meta_box('Gestion du slider de la promotion');
$boxBlock->addScreen('page'); // updated
$boxBlock->setCallback(function(){
	$form = tr_form();

	$repeater = $form->repeater('blockpromotion')->setFields([
		$form->image('imagepromotion')->setLabel('Image de la promotion'),
		$form->search('linkpromotion')->setLabel('lien vers la page')->setPostType('produit'),


	])->setLabel('Block de service');

	echo $repeater;

});

add_action('admin_head', function () use ($boxBlock) {

	if(get_page_template_slug(get_the_ID()) === 'promotion.php'):
		remove_post_type_support('page', 'editor');
	else:
		remove_meta_box( $boxBlock->getId(), 'page', 'normal');
	endif;

});