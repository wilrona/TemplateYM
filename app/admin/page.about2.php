<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 07/12/2017
 * Time: 16:33
 */

$boxBlock = tr_meta_box('Gestion des blocks About');
$boxBlock->addScreen('page'); // updated
$boxBlock->setCallback(function(){
	$form = tr_form();

	$repeater = $form->repeater('blockabout')->setFields([
		$form->text('titleblockabout')->setLabel('Titre du block'),
		$form->editor('descblockabout')->setLabel('Description du block'),
		$form->image('imageblockabout')->setLabel('Image de fond du block'),
		$form->select('positionabout')->setOptions([
			'Position à gauche' => 'uk-flex-left@m',
			'Position à droite' => 'uk-flex-right@m',
		])->setLabel('Position du texte par rapport à l\'image'),
		$form->color('couleurtitle')->setLabel('Couleur du titre'),
		$form->color('couleurtexte')->setLabel('Couleur du texte'),
		$form->text('classresponsive')->setLabel('Nom de la classe')->setHelp('Le nom de la class pour applique le responsive'),
		$form->color('bgresponsiveabout')->setLabel('Couleur du fond en mode responsive'),
		$form->color('titlecolorresponsiveabout')->setLabel('Couleur du titre en mode responsive'),
		$form->color('desccolorresponsiveabout')->setLabel('Couleur desc en mode responsive'),

	])->setLabel('Block de About');

	echo $repeater;

});

$Equipe = tr_meta_box('Equipe Yoomee');
$Equipe->addScreen('page'); // updated
$Equipe->setCallback(function(){
	$form = tr_form();

	echo $form->editor('descequipe')->setLabel('Description de l\'ensemble de l\'equipe :');

	$repeater = $form->repeater('blockequipe')->setFields([
		$form->image('photoemp')->setLabel('Photo de employé'),
		$form->text('nomemp')->setLabel('Nom de employé'),
		$form->text('posteemp')->setLabel('Poste employé'),
		$form->text('descemp')->setLabel('Description employé'),
	])->setLabel('Block des valeurs');

	echo $repeater;

});

add_action('admin_head', function () use ($boxBlock, $Equipe){
	if(get_page_template_slug(get_the_ID()) === 'about2.php'):
		remove_post_type_support('page', 'editor');
	else:
		remove_meta_box( $boxBlock->getId(), 'page', 'normal');

		remove_meta_box( $Equipe->getId(), 'page', 'normal');
	endif;

});
