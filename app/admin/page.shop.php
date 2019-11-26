<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 13/02/2018
 * Time: 12:09
 */


$boxBlock = tr_meta_box('Gestion du slider du shop');
$boxBlock->addScreen('page'); // updated
$boxBlock->setCallback(function(){
	$form = tr_form();

	$repeater = $form->repeater('blockshop')->setFields([
		$form->image('imageshop')->setLabel('Image de la promotion'),
		$form->search('linkshop')->setLabel('lien vers la page')->setPostType('produit'),


	])->setLabel('Block de slider');

	echo $repeater;

});

add_action('admin_head', function () use ($boxBlock) {

	if(get_page_template_slug(get_the_ID()) === 'shop.php'):
		remove_post_type_support('page', 'editor');
	else:
		remove_meta_box( $boxBlock->getId(), 'page', 'normal');
	endif;

});