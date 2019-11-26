<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 11/05/2018
 * Time: 15:42
 */


$cmd = tr_meta_box('Stati des commandes globales');

$cmd->addScreen('dashboard');


$cmd->setCallback(function() {

	$args = array(
		'post_type' => 'facture',
		'posts_per_page' => -1,
	);

	$commande = 0;
	$abandonne = 0;
	$vendus = 0;
	$encours = 0;

	$query = new WP_Query( $args );

	while ( $query->have_posts() ) : $query->the_post();

		if(tr_posts_field('etatfacture', get_the_ID()) === 'encours'):
			$encours += 1;
		endif;

		if(tr_posts_field('etatfacture', get_the_ID()) === 'abandonne'):
			$abandonne += 1;
		endif;

		if(tr_posts_field('etatfacture', get_the_ID()) === 'paye'):
			$vendus += 1;
		endif;

		$commande += 1;

	endwhile;

	?>

	<table class="uk-table uk-table-divider uk-table-small">

		<tbody>
		<tr>
			<th class="uk-text-small">
				Commandes
			</th>
			<td>
				<?= $commande ?>
			</td>
		</tr>
		<tr>
			<th class="uk-text-small">
				En cours
			</th>
			<td>
				<?= $encours ?>
			</td>
		</tr>
		<tr>
			<th class="uk-text-small">
				Vendues
			</th>
			<td>
				<?= $vendus ?>
			</td>
		</tr>
		<tr>
			<th class="uk-text-small">
				Abandonnées
			</th>
			<td>
				<?= $abandonne ?>
			</td>
		</tr>


		</tbody>
	</table>

	<?php
});

$cmd_liv = tr_meta_box('Stat des commandes à livrer');

$cmd_liv->addScreen('dashboard');


$cmd_liv->setCallback(function() {

	$args = array(
		'post_type' => 'facture',
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' => 'clepayment',
				'value' => 'cash',
				'compare' => '=',
			)
		)
	);

	$commande = 0;
	$abandonne = 0;
	$vendus = 0;
	$encours = 0;

	$query = new WP_Query( $args );

	while ( $query->have_posts() ) : $query->the_post();

		if(tr_posts_field('etatfacture', get_the_ID()) === 'encours'):
			$encours += 1;
		endif;

		if(tr_posts_field('etatfacture', get_the_ID()) === 'abandonne'):
			$abandonne += 1;
		endif;

		if(tr_posts_field('etatfacture', get_the_ID()) === 'paye'):
			$vendus += 1;
		endif;

		$commande += 1;

	endwhile;

	?>

	<table class="uk-table uk-table-divider uk-table-small">

		<tbody>
		<tr>
			<th class="uk-text-small">
				Commandes
			</th>
			<td>
				<?= $commande ?>
			</td>
		</tr>
		<tr>
			<th class="uk-text-small">
				En cours
			</th>
			<td>
				<?= $encours ?>
			</td>
		</tr>
		<tr>
			<th class="uk-text-small">
				Livrées
			</th>
			<td>
				<?= $vendus ?>
			</td>
		</tr>
		<tr>
			<th class="uk-text-small">
				Abandonnées
			</th>
			<td>
				<?= $abandonne ?>
			</td>
		</tr>


		</tbody>
	</table>

	<?php
});


$cmd_retrait = tr_meta_box('Stat des commandes à retirer');

$cmd_retrait->addScreen('dashboard');


$cmd_retrait->setCallback(function() {

	$args = array(
		'post_type' => 'facture',
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' => 'clepayment',
				'value' => 'retrait',
				'compare' => '=',
			)
		)
	);

	$commande = 0;
	$abandonne = 0;
	$vendus = 0;
	$encours = 0;

	$query = new WP_Query( $args );

	while ( $query->have_posts() ) : $query->the_post();

		if(tr_posts_field('etatfacture', get_the_ID()) === 'encours'):
			$encours += 1;
		endif;

		if(tr_posts_field('etatfacture', get_the_ID()) === 'abandonne'):
			$abandonne += 1;
		endif;

		if(tr_posts_field('etatfacture', get_the_ID()) === 'paye'):
			$vendus += 1;
		endif;

		$commande += 1;

	endwhile;

	?>

	<table class="uk-table uk-table-divider uk-table-small">

		<tbody>
		<tr>
			<th class="uk-text-small">
				Commandes
			</th>
			<td>
				<?= $commande ?>
			</td>
		</tr>
		<tr>
			<th class="uk-text-small">
				En cours
			</th>
			<td>
				<?= $encours ?>
			</td>
		</tr>
		<tr>
			<th class="uk-text-small">
				Retirées
			</th>
			<td>
				<?= $vendus ?>
			</td>
		</tr>
		<tr>
			<th class="uk-text-small">
				Abandonnées
			</th>
			<td>
				<?= $abandonne ?>
			</td>
		</tr>


		</tbody>
	</table>

	<?php
});
