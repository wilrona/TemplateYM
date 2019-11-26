
<div class="wrapper-whatsapp">

	<?php

	$form = tr_form('option')->disableAjax();

	echo $form->open();

	$config = function() use ($form, $login) {
		echo '<h1>Parametre Application Facebook</h1>';
		echo $form->text('appID')->setHelp('Coller ici l\'id de votre application facebook')->setLabel('Id de l\'app')->setAttribute('value', get_option('appID'));
		echo $form->text('appSecret')->setLabel('Clé secrète')->setAttribute('value', get_option('appSecret'));
		echo $form->text('tokenUser')->setLabel('Token Permanent pour une page')->setAttribute('value', get_option('tokenUser'))->setHelp('long live token (durée max 2 mois)');

	};


	$posts = function () use ($form, $post, $page){
		echo '<h1>Liste des postes</h1>';

		?>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/datatables.css">

		<table id="example" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Date post</th>
				<th>Message du post</th>
				<th>Suivre</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$count = 0;
				foreach ($post['data'] as $msg):
					$time = strtotime($msg->created_time);
					$date = date('d/m/Y', $time)
			?>
				<tr>
					<td><?= $date ?></td>
					<td><?= $msg->message ?></td>
					<td><?= $form->checkbox($count)->setGroup('postID')->setSetting('render', 'raw')->setLabel('')->setAttributes(array('value' => $msg->id)) ?></td>
				</tr>
			<?php
				$count++;
				endforeach;
			?>
			</tbody>

		</table>
		<script src="<?php echo get_template_directory_uri(); ?>/js/datatables.js"></script>
		<script>
            jQuery(document).ready(function() {
                jQuery('#example').DataTable();
            } );
		</script>

		<?php

	};

	$save .= $form->submit( 'Save' );


	$tabs = tr_tabs()->setSidebar( $save );

	if(get_option('appSecret') && get_option('appID') && get_option('tokenUser')){
		$tabs->addTab('Liste des postes', $posts);
	}

    $tabs->addTab( 'Paramètre Facebook', $config );
	$tabs->render( 'box' );


	echo $form->close();

	?>

</div>
