<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 08/05/2018
 * Time: 10:08
 */

$boxPaiement = tr_meta_box('Gestions paiements');
$boxPaiement->addScreen('page'); // updated
$boxPaiement->setCallback(function(){
	$form = tr_form();

	$ville = [];

	foreach ( tr_posts_field( 'listeville' ) as $paiement ):
		$ville[$paiement['nomville']] = $paiement['slugville'];
	endforeach;

	$repeater = $form->repeater('listpaiement')->setFields([
		$form->text('nompayment')->setLabel('Nom du paiement'),
		$form->editor('descrpayment')->setLabel('Description du moyen de paiement'),
		$form->select('clepayment')->setOptions([
		'Cash à la livraison' => 'cash',
		'Paiement et retrait' => 'retrait',
				])->setLabel('Clé du moyen de paiement'),

		$form->repeater('villepayment')->setFields([
			$form->select('cleville')->setOptions($ville)->setLabel('Selection de la ville')
		])->setLabel('Liste des villes à exclure du moyen de paiement'),


	])->setLabel('Liste des paiements');

	echo $repeater;
});

$boxVille = tr_meta_box('Gestion des villes');
$boxVille->addScreen('page'); // updated
$boxVille->setCallback(function(){
	$form = tr_form();

	$repeater = $form->repeater('listeville')->setFields([
		$form->text('nomville')->setLabel('Nom de la ville'),
		$form->text('slugville')->setLabel('slug de la ville')->setHelp('Ce slug va être utilisé pour activer certain moyen de paiement'),
	])->setLabel('Liste des villes');

	echo $repeater;

});

add_action('admin_head', function () use ($boxPaiement, $boxVille) {

	if(get_page_template_slug(get_the_ID()) === 'facture.php'):
		remove_post_type_support('page', 'editor');
	else:
		remove_meta_box( $boxPaiement->getId(), 'page', 'normal');
		remove_meta_box( $boxVille->getId(), 'page', 'normal');
	endif;

});


