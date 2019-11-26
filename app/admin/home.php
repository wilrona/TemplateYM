<?php

//$home = (int) get_option('page_on_front');


$boxBlock = tr_meta_box('Gestion des blocks de produits');
$boxBlock->addScreen('page'); // updated
$boxBlock->setCallback(function(){
	$form = tr_form();

	$repeater = $form->repeater('blockprod')->setFields([
		$form->text('titleblock')->setLabel('Titre du block'),
		$form->editor('descblock')->setLabel('Description du block'),
		$form->image('imageblock')->setLabel('Image de fond du block'),
		$form->image('imageblock2')->setLabel('Image illustration'),
		$form->text('linkblock')->setLabel('Lien vers la page')->setDefault('#'),
		$form->select('download')->setOptions([
			'nok' => 'Non',
			'ok' => 'Oui',
		])->setLabel('Lien téléchargarble ?'),
		$form->text('namelinkblock')->setLabel('Titre du bouton')->setDefault('Lire la suite'),
		$form->select('position')->setOptions([
			'Position à gauche' => '',
			'Position à droite' => 'uk-flex-last@m',
		])->setLabel('Position du texte par rapport à l\'image'),

	])->setLabel('Block de produit');

	echo $repeater;

});

$boxBlock2 = tr_meta_box('Gestion des blocks du pied de page');
$boxBlock2->addScreen('page'); // updated
$boxBlock2->setCallback(function(){
	$form = tr_form();

	$repeater = $form->repeater('blockprod2')->setFields([
		$form->text('titleblock')->setLabel('Titre du block'),
		$form->editor('descblock')->setLabel('Description du block'),
		$form->image('imageblock')->setLabel('Image de fond du block'),
		$form->image('imageblock2')->setLabel('Image illustration'),
		$form->text('linkblock')->setLabel('Lien vers la page')->setDefault('#'),
		$form->select('download')->setOptions([
			'nok' => 'Non',
			'ok' => 'Oui',
		])->setLabel('Lien téléchargarble ?'),
		$form->text('namelinkblock')->setLabel('Titre du bouton')->setDefault('Lire la suite'),
		$form->select('position')->setOptions([
			'Position à gauche' => '',
			'Position à droite' => 'uk-flex-last@m',
		])->setLabel('Position du texte par rapport à l\'image'),

	])->setLabel('Block de contenu');

	echo $repeater;

});

$boxAlbum = tr_meta_box('Information Album A l\'accueil');
$boxAlbum->addScreen('page'); // updated
$boxAlbum->setCallback(function(){
	$form = tr_form();
	echo $form->search('albumposthome')->setLabel('Selection album à mettre en valeur')->setPostType('album');

});


$boxValeur = tr_meta_box('Caracteristique de yoomee');
$boxValeur->addScreen('page'); // updated
$boxValeur->setCallback(function(){
	$form = tr_form();

	echo $form->text('titlevaleur')->setLabel('Titre');
	echo $form->editor('descvaleur')->setLabel('Description des caracteristiques');
	echo $form->image('imagefondblockvaleur')->setLabel('Image de fond du block');

	$repeater = $form->repeater('blockvaleur')->setFields([
		$form->text('titleblockvaleur')->setLabel('Titre'),
		$form->editor('descblockvaleur')->setLabel('Information'),
		$form->image('imageblockvaleur')->setLabel('Icone du caracteristique')
	])->setLabel('Block des valeurs');

	echo $repeater;

});

$boxShop = tr_meta_box('Affichage des produits dans le shop');
$boxShop->addScreen('page'); // updated
$boxShop->setCallback(function(){
	$form = tr_form();

	echo $form->text('titleshop')->setLabel('Titre');
	echo $form->editor('descshop')->setLabel('Description');

	$repeater = $form->repeater('produits')->setFields([
		$form->search('Selection du produit')->setPostType('produit')
	])->setLabel('Produits à afficher');

	echo $repeater;

});


add_action('admin_head', function () use ($boxBlock, $boxValeur, $boxShop, $boxAlbum, $boxBlock2) {

	if(get_page_template_slug(get_the_ID()) === 'home.php'):
		remove_post_type_support('page', 'editor');
	else:
		remove_meta_box( $boxBlock->getId(), 'page', 'normal');
		remove_meta_box( $boxBlock2->getId(), 'page', 'normal');
		remove_meta_box( $boxValeur->getId(), 'page', 'normal');
		remove_meta_box( $boxShop->getId(), 'page', 'normal');
		remove_meta_box( $boxAlbum->getId(), 'page', 'normal');
	endif;

});











