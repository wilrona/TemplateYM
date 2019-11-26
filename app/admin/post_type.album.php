<?php
/**
 * Created by IntelliJ IDEA.
 * User: macbookpro
 * Date: 12/02/2018
 * Time: 16:58
 */

$video = tr_post_type('Album', 'Albums');
$video->setIcon('images');
$video->setArgument('supports', ['title', 'thumbnail'] );
$video->setEditorForm(function() {
    $form = tr_form();

	$repeater  = $form->gallery('photoalbum')->setLabel('Photo de Albums');

    echo $repeater;

    echo $form->date('datealbum')->setLabel('Date de l\album');
});


