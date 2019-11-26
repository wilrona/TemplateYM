<?php
/**
 * Created by IntelliJ IDEA.
 * User: macbookpro
 * Date: 12/02/2018
 * Time: 16:58
 */

$video = tr_post_type('Video', 'Videos');
$video->setIcon('video-camera');
$video->setArgument('supports', ['title'] );
$video->setEditorForm(function() {
    $form = tr_form();
    echo $form->text('youtubeid')->setLabel('Id de la vidéo youtube');
});


