<?php
/**
 * Created by IntelliJ IDEA.
 * User: macbookpro
 * Date: 12/02/2018
 * Time: 16:58
 */

$video = tr_post_type('code', 'Code Promos');
$video->setIcon('images');
$video->setArgument('supports', ['title'] );
$video->setEditorForm(function() {
    $form = tr_form();

    echo $form->date('dateendcoupon')->setLabel('Date de fin du coupon')->setAttribute('class', 'datepicker');
    echo $form->text('nbrecoupon')->setLabel('Nombre de personne pour le coupon')->setHelp('Laissez 0 si vous voulez un infinité de personne')
                                                                                 ->setType('number')
                                                                                 ->setAttributes(['min' => '0'])->setSetting('default', 0);
    echo $form->text('Valeurcoupon')->setLabel('Valeur du coupon')->setType('number')->setAttributes(['min' => '0'])->setSetting('default', 0);
    echo $form->select('Typevaleur')->setLabel('Type de la valeur coupon')->setOptions([
	    'Montant fixe' => 'fixe',
	    'Pourcentage' => 'pourcentage',
    ]);

    echo $form->text('countcoupon')->setLabel('Nombre d\'utilisation du code promo')->setAttribute('disabled', 'disabled')->setSetting('default', 0);
});


