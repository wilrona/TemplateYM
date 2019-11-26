<?php
/**
 * Created by IntelliJ IDEA.
 * User: macbookpro
 * Date: 12/02/2018
 * Time: 01:20
 */


$boxBlock = tr_meta_box('Gestion des blocks de services');
$boxBlock->addScreen('page'); // updated
$boxBlock->setCallback(function(){
    $form = tr_form();

    $repeater = $form->repeater('blockservice')->setFields([
        $form->text('titleblockservice')->setLabel('Titre du block'),
        $form->editor('descblockservice')->setLabel('Description du block'),
        $form->image('imageblockservice')->setLabel('Image de fond du block'),
	    $form->image('imageblock2service')->setLabel('Image illustration'),
        $form->text('linkblockservice')->setLabel('lien vers la page'),
	    $form->select('downloadservice')->setOptions([
		    'nok' => 'Non',
		    'ok' => 'Oui',
	    ])->setLabel('Lien téléchargarble ?'),
	    $form->text('namelinkblockservice')->setLabel('Titre du bouton')->setDefault('Lire la suite'),
        $form->select('positionservice')->setOptions([
	        'Position à gauche' => '',
	        'Position à droite' => 'uk-flex-last@m',
        ])->setLabel('Position du texte par rapport à l\'image'),
        $form->color('couleurtitle')->setLabel('Couleur du titre'),
        $form->color('couleurtexte')->setLabel('Couleur du texte'),

    ])->setLabel('Block de service');

    echo $repeater;

});

add_action('admin_head', function () use ($boxBlock) {

    if(get_page_template_slug(get_the_ID()) === 'services.v2.php'):
        remove_post_type_support('page', 'editor');
    else:
        remove_meta_box( $boxBlock->getId(), 'page', 'normal');
    endif;

});