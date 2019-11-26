
<div class="wrapper-whatsapp">

<?php

$form = tr_form()->useJson()->setGroup('config_yoochat');

echo $form->open();

$config = function() use ($form) {
	echo '<div class="uk-card uk-card-default uk-card-body uk-card-small uk-margin-medium-bottom">
		<h3 class="uk-card-title">Comment installer firebase ?</h3>
		<ul>
			<li>Creer un nouveau projet avec <a href="https://console.firebase.google.com/" target="_blank">Google Firebase API</a></li>
			<li>Cliquer sur le lien <strong>Ajouter Firebase à votre application web</strong> et mettrer à jour les champs ci-dessous (*)</li>
			<li>Aller sur <strong>Authentification -> Mode de connexion</strong> et activer à la fois <strong>"Adresse Email/Mot de passe"</strong> et <strong>"Anonyme"</strong></li>
			<li>Ajouter <strong>'.$_SERVER['SERVER_NAME'].'</strong> dans la section <strong>Domaine Autorisé</strong> de la même page</li>
		</ul>
		<small class="uk-text-danger">* Toutes les informations ci-dessous sont obligatoires pour le bon fonctionnement de ce module</small>
	</div>';
	echo $form->text('apiKey')->setHelp('Coller ici l\'api key')->setLabel('Api Key');
	echo $form->text('authDomain')->setHelp('PROJECT_ID.firebaseapp.com')->setLabel('Auth Domain');
	echo $form->text('databaseURL')->setHelp('https://DATABASE_NAME.firebaseio.com')->setLabel('Database URL');
	echo $form->text('projectid')->setHelp('PROJECT_ID')->setLabel('Projet ID');
	echo $form->text('storageBucket')->setHelp('BUCKET.appspot.com')->setLabel('Storage Bucket');
	echo $form->text('messagingSenderId')->setHelp('coller ici le messagingSenderId')->setLabel('Sender ID');
};


$save .= $form->submit( 'Save' );


tr_tabs()->setSidebar( $save )
         ->addTab( 'Firebase', $config )
         ->render( 'box' );


echo $form->close();

?>

</div>

