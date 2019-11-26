<?php
if ( ! function_exists( 'add_action' )) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// Setup Form
$form = tr_form()->useJson()->setGroup( $this->getName() );
?>

<h1>Theme Options</h1>
<div class="typerocket-container">
	<?php
	echo $form->open();

	// Information sur les réseaux sociaux
	$configshop = function() use ($form) {
		echo $form->search('shop')->setLabel('Lien de la page shop')->setPostType('page');
		echo $form->search('cart')->setLabel('Lien de la page panier')->setPostType('page');
		echo $form->search('checkout')->setLabel('Lien de la page achat')->setPostType('page');
		echo $form->text('adminemail')->setLabel('Email Commerciaux')->setHelp('Ce mail est utilisé pour le moyen de paiement cash à la livraion');
        echo $form->text('validefacture')->setLabel('Nombre de jour de validité d\'une facture')->setType('number')->setAttribute('min', 0)->setSetting('default', 0);

	};
	// Save
	$save = $form->submit( 'Enregistrement' );

	// Layout
	tr_tabs()->setSidebar( $save )
	         ->addTab( 'Configuration des pages du shop', $configshop )
	         ->render( 'box' );
	echo $form->close();
	?>

</div>