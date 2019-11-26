<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 07/12/2017
 * Time: 16:33
 */

$boxBlock = tr_meta_box('Bloc Description Yoomee');
$boxBlock->addScreen('page'); // updated
$boxBlock->setCallback(function(){
		$form = tr_form();
		echo $form->text('titleabout')->setLabel('Titre du block');
		echo $form->image('imageabout')->setLabel('Image de fond du block');
		echo $form->select('positionabout')->setOptions([
				'Position à gauche' => 'uk-flex-left@m',
				'Position à droite' => 'uk-flex-right@m',
				'position au centre' => 'uk-flex-center@m'
			])->setLabel('Position du texte par rapport à l\'image');

});


$About = tr_meta_box('Caracteristiques');
$About->addScreen('page'); // updated
$About->setCallback(function(){
	$form = tr_form();

	echo $form->text('titleblockabout')->setLabel('Titre');
	echo $form->editor('descblockabout')->setLabel('Description des caracteristiques');

	$repeater = $form->repeater('blockaboutcontent')->setFields([
		$form->text('blockabouttitle')->setLabel('Titre'),
		$form->textarea('blockaboutdesc')->setLabel('Information')
	])->setLabel('Block des valeurs');

	echo $repeater;

});

$Equipe = tr_meta_box('Equipe de Yoomee');
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

add_action('admin_head', function () use ($boxBlock, $About, $Equipe){
	if(get_page_template_slug(get_the_ID()) !== 'about.php'){
		remove_meta_box( $About->getId(), 'page', 'normal');
		remove_meta_box( $Equipe->getId(), 'page', 'normal');
		remove_meta_box( $boxBlock->getId(), 'page', 'normal');
	}

});
