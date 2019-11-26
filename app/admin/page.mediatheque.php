<?php
/**
 * Created by IntelliJ IDEA.
 * User: macbookpro
 * Date: 12/02/2018
 * Time: 16:36
 */


$boxVideo = tr_meta_box('Information de la vidéo');
$boxVideo->addScreen('page'); // updated
$boxVideo->setCallback(function(){
    $form = tr_form();

    echo $form->text('videotitle')->setLabel('Titre du bloc video');
    echo $form->editor('videodesc')->setLabel('Description du block video');
    echo $form->search('videopost')->setLabel('Selection de la vidéo à mettre en valeur')->setPostType('video');
    echo $form->search('videolinkpage')->setLabel('lien vers la page')->setPostType('page');
    echo $form->image('imagefondvideo')->setLabel('Image de fond du bloc video');
    echo $form->color('colorfondvideo')->setLabel('Couleur de fond du bloc video');
    echo $form->color('colortextevideo')->setLabel('Couleur du texte du bloc video');

});

$boxAlbum = tr_meta_box('Information Album');
$boxAlbum->addScreen('page'); // updated
$boxAlbum->setCallback(function(){
    $form = tr_form();

    echo $form->text('albumtitre')->setLabel('Titre du bloc album');
    echo $form->editor('albumdescs')->setLabel('Description du block album');
    echo $form->search('albumpost')->setLabel('Selection album à mettre en valeur')->setPostType('album');
    echo $form->search('albumlinkpage')->setLabel('lien vers la page')->setPostType('page');
    echo $form->image('imagefondalbum')->setLabel('Image de fond du bloc album');
    echo $form->color('colorfondalbum')->setLabel('Couleur de fond du bloc album');
	echo $form->color('colortextealbum')->setLabel('Couleur du texte du bloc album');

});

add_action('admin_head', function () use ($boxVideo, $boxAlbum) {

    if(get_page_template_slug(get_the_ID()) === 'mediatheque.php'):
        remove_post_type_support('page', 'editor');
    else:
        remove_meta_box( $boxVideo->getId(), 'page', 'normal');
        remove_meta_box( $boxAlbum->getId(), 'page', 'normal');
    endif;

});