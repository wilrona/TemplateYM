<?php
/**
 * Created by IntelliJ IDEA.
 * User: macbookpro
 * Date: 12/02/2018
 * Time: 16:58
 */

$video = tr_post_type('facture', 'Factures');
$video->setIcon('images');
$video->setArgument('supports', ['title'] );

$box = tr_meta_box('Information de la facture');
$box->addPostType( $video->getId() );

$box->setCallback(function() {

    $client = tr_posts_field('panier')['user'];

	?>
    <div class="uk-form-horizontal">

        <div class="uk-margin">
            <label class="uk-form-label uk-text-bold uk-margin-remove" for="form-horizontal-text">Nom du client :</label>
            <div class="uk-form-controls">
                <?= $client['nom'] ?>
            </div>
        </div>
        <div class="uk-margin">
            <label class="uk-form-label uk-text-bold uk-margin-remove" for="form-horizontal-text">Adresse Email :</label>
            <div class="uk-form-controls">
			    <?= $client['email'] ?>
            </div>
        </div>
        <div class="uk-margin">
            <label class="uk-form-label uk-text-bold uk-margin-remove" for="form-horizontal-text">Téléphone :</label>
            <div class="uk-form-controls">
			    <?= $client['phone'] ?>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label uk-text-bold uk-margin-remove" for="form-horizontal-text">Ville :</label>
            <div class="uk-form-controls">
			    <?= $client['ville'] ?>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label uk-text-bold uk-margin-remove" for="form-horizontal-text">Adresse Complète :</label>
            <div class="uk-form-controls">
	            <?php if(!$client['adresse']): ?> Aucune <?php endif; ?> <?= $client['adresse'] ?>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label uk-text-bold uk-margin-remove" for="form-horizontal-text">Information supplémentaire :</label>
            <div class="uk-form-controls">
			   <?php if(!$client['comment']): ?> Aucune <?php endif; ?> <?= $client['comment'] ?>
            </div>
        </div>

    </div>
	<?php

});

$box = tr_meta_box('Information des produits');
$box->addPostType( $video->getId() );

$box->setCallback(function() {

	$produits = tr_posts_field('panier')['panier'];
	$code = tr_posts_field('panier')['coupon'];


	?>

    <div class="uk-overflow-auto">
        <table class="uk-table uk-table-divider uk-table-small">
            <thead>
            <tr>
                <th>Produits</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $total = 0;
                foreach ($produits as $prod):
            ?>
            <tr>
                <td><?= $prod['nom'] ?></td>
                <td><?= $prod['qte'] ?></td>
                <td><?= number_format($prod['prix'] , 0, '.', ' ') ?> XAF</td>
	            <?php
	            $montant = $prod['qte'] * $prod['prix'];
	            $total += $montant;
	            ?>
                <td><?= number_format($montant , 0, '.', ' ') ?> XAF</td>
            </tr>
            <?php
                endforeach;
            ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td colspan="1"><?= number_format($total , 0, '.', ' ') ?> XAF</td>
            </tr>
            <?php

            $montantcode = 0;

            if($code):
	            ?>
            <tr>

                <td colspan="3"><strong>Coupon</strong> : <br/> code promo : <?= $code['code'] ?></td>
                <td colspan="1">
	                <?php
	                if($code['type'] == 'pourcentage'):

		                $montantcode = ($total * intval($code['valeur'])) / 100;

	                else:

		                $montantcode = intval($code['valeur']);

	                endif;

	                ?>
	                <?= number_format($montantcode , 0, '.', ' ') ?> XAF
                </td>
            </tr>
            <?php
                endif;
            ?>
            <?php
            $totalttc = $total - $montantcode;
            ?>
            <tr>
                <td colspan="3"><strong>Total TTC</strong></td>
                <td colspan="1"><?= number_format($totalttc , 0, '.', ' ') ?> XAF</td>
            </tr>
            </tbody>
        </table>
    </div>
	<?php

});


$box = tr_meta_box('Etat de la facture');
$box->addPostType( $video->getId() );

$box->setCallback(function() {

	$form = tr_form();
	echo $form->text('clepayment')->setLabel('Type de paiement')->setAttribute('disabled', 'disabled');
	echo $form->text('etatfacture')->setLabel('Etat de la facture')->setAttribute('disabled', 'disabled');
	echo $form->text('datefin')->setLabel('Date de fin de validité')->setAttribute('disabled', 'disabled');

});


