<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 09/05/2018
 * Time: 15:21
 */
?>

<?php get_header(); ?>

<?php

$produits = tr_posts_field('panier')['panier'];
$user = tr_posts_field('panier')['user'];

?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<?php
			if(isset($_POST) && isset($_POST['code']) && !empty($_POST['code'])):

					if(strtolower($_POST['code']) === 'promo_online'):

						update_post_meta(get_the_ID(), 'etatfacture', 'paye');

						flash('flash_change', 'Votre facture a été enregistré comme payé avec succès', 'uk-alert uk-alert-success uk-alert-empty uk-padding-small uk-margin-medium-bottom');

					else:

						flash('flash_change', 'Le code de validation n\'est pas correct. Veuillez prendre contact avec l\'administrateur. ', 'uk-alert uk-alert-danger uk-alert-empty uk-padding-small uk-margin-medium-bottom');

					endif;

					wp_redirect(get_the_permalink());

			endif;

			if( time() >= strtotime(tr_posts_field('datefin')) && tr_posts_field('etatfacture') != 'paye' && tr_posts_field('etatfacture') != 'abandonne'):
				update_post_meta(get_the_ID(), 'etatfacture', 'abandonne');
			endif;
		?>

		<div class="uk-section uk-position-relative uk-section-shopping">

			<div class="uk-container">

				<form name="checkout" class="checkout woocommerce-checkout" method="post" enctype="multipart/form-data" novalidate="novalidate">



					<?php flash('flash_change'); ?>

					<div class="uk-child-width-1-2@m uk-grid" id="customer_details" uk-grid>
						<div class="col-1">
							<div class="woocommerce-billing-fields">

								<h3>Information du client</h3>


								<div class="woocommerce-billing-fields__field-wrapper">
									<p class=" form-row-first validate-required" id="billing_name_field" data-priority="10">
										<label for="billing_name" class=""><?php pll_e('Nom' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>

										<input type="text" class="input-text uk-input " name="billing_name" id="billing_name" disabled value="<?= $user['nom'] ?>">
									</p>
									<p class=" form-row-last validate-required" id="billing_email_field" data-priority="20">
										<label for="billing_email" class=""><?php pll_e('Adresse Email' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text uk-input" name="billing_email" id="billing_email" disabled value="<?= $user['email'] ?>" >
									</p>
									<p class=" form-row-last validate-required" id="billing_phone_field" data-priority="20">
										<label for="billing_phone" class=""><?php pll_e('Téléphone' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text uk-input" name="billing_phone" id="billing_phone" disabled value="<?= $user['phone'] ?>">
									</p>

									<p class=" form-row-wide address-field update_totals_on_change validate-required woocommerce-validated" id="billing_ville_field" data-priority="40">
										<label for="billing_ville" class=""><?php pll_e('Ville' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text uk-input" name="billing_ville" id="billing_ville" disabled value="<?= $user['ville'] ?>">
									</p>
									<p class=" form-row-wide" id="billing_adresse_field" data-priority="30">
										<label for="billing_adresse" class=""><?php pll_e('Addresse complete' , 'yoomee'); ?></label>
										<textarea name="billing_adresse" class="input-text uk-textarea" id="billing_adresse" rows="2" cols="5" style="min-height: 100px;" disabled ><?= $user['adresse'] ?></textarea>
									</p>
								</div>
							</div>

							<div class="woocommerce-additional-fields">



								<h3>Informations Supplémentaires</h3>


								<div class="woocommerce-additional-fields__field-wrapper">
									<p class="notes" id="order_comments_field" data-priority="">
										<label for="order_comments" class="">Notes</label>
										<textarea name="order_comments" class="input-text uk-textarea" id="order_comments" disabled cols="5" style="min-height: 200px;"><?= $user['comment'] ?></textarea>
									</p>
								</div>


							</div>


						</div>

						<div class="col-2">
							<div class="woocommerce-billing-fields">

								<h3>Détail de la facture</h3>


								<div class="woocommerce-billing-fields__field-wrapper">

									<p class=" form-row-first validate-required" id="billing_number" data-priority="10">
										<label for="billing_number" class=""><?php pll_e('Facture' , 'yoomee'); ?> # <abbr class="required" title="required">*</abbr></label>

										<input type="text" class="input-text uk-input "  id="billing_number" disabled value="<?= get_the_title(); ?>">
									</p>
									<p class=" form-row-last validate-required" id="billing_created_field" data-priority="20">
										<label for="billing_created" class=""><?php pll_e('Date de création' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text uk-input" id="billing_created" disabled value="<?= sky_date_french('d/m/Y', get_post_time('U', true), 1); ?>" >
									</p>
									<p class=" form-row-last validate-required" id="billing_etat_field" data-priority="20">
										<label for="billing_etat" class=""><?php pll_e('Date de fin' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text uk-input uk-form-danger"  id="billing_end_date" disabled value="<?= tr_posts_field('datefin') ?>">
									</p>

									<p class=" form-row-wide address-field update_totals_on_change validate-required woocommerce-validated" id="billing_country_field" data-priority="40">
										<label for="billing_ville" class=""><?php pll_e('Etat de la facture' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text uk-input" id="billing_etat" disabled value="<?= tr_posts_field('etatfacture') ?>">
									</p>
									<p class=" form-row-wide address-field update_totals_on_change validate-required woocommerce-validated" id="billing_etat_field" data-priority="40">
										<label for="billing_etat" class=""><?php pll_e('Moyens de paiement' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>

										<?php
										if(tr_posts_field('clepayment') == 'cash'):
											$moyen = 'Cash à la livraison';
										else:
											$moyen = 'Paiement et retrait en magasin';
										endif;
										?>
										<input type="text" class="input-text uk-input" id="billing_etat" disabled value="<?= $moyen ?>">
									</p>
									<p class=" form-row-wide address-field update_totals_on_change validate-required woocommerce-validated" id="billing_country_field" data-priority="40">

										<?php
										$linkfact = get_the_permalink();
										?>
										<img src="<?= home_url('/facture/qrcode?link='.$linkfact) ?>" alt="">
									</p>

								</div>
							</div>

						</div>
					</div>



					<h3 id="order_review_heading">Votre commande</h3>


					<div id="order_review" class="woocommerce-checkout-review-order">
						<table class="uk-table uk-table-divider shop_table uk-table-middle">
							<thead class="uk-background-yoomee-unique">
							<tr>
								<th class="product-name uk-text-yoomee-2" >Produit</th>
								<th class="product-total uk-text-yoomee-2">Total</th>
							</tr>
							</thead>
							<tbody>


							<?php
							$total = 0;
							foreach ($produits as $prod):
								?>

								<tr class="cart_item">
									<td class="product-name">
										<?= $prod['nom'] ?>
										<strong class="product-quantity">× <?= $prod['qte'] ?></strong>
									</td>
									<?php
									$montant = $prod['qte'] * $prod['prix'];
									$total += $montant;
									?>
									<td class="product-total">
										<span class="woocommerce-Price-amount amount"><?= number_format($montant , 0, '.', ' ') ?> XAF</span>
									</td>
								</tr>

								<?php
							endforeach;
							?>
							</tbody>
							<tfoot>

							<tr class="cart-subtotal">
								<th>Total</th>
								<td>
									<span class="woocommerce-Price-amount amount"><?= number_format($total , 0, '.', ' ') ?> XAF</span>
								</td>
							</tr>

							<?php
							$code = tr_posts_field('panier')['coupon'];

							$montantcode = 0;

							if($code):
								?>
								<tr class="cart-subtotal">
									<th>Coupon : <br/> code promo : <?= $code['code'] ?> </th>
									<?php
									if($code['type'] == 'pourcentage'):

										$montantcode = ($total * intval($code['valeur'])) / 100;

									else:

										$montantcode = intval($code['valeur']);

									endif;

									?>
									<td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><?= number_format($montantcode , 0, '.', ' ') ?> XAF</span></td>
								</tr>

								<?php
							endif;
							?>

							<?php
							$totalttc = $total - $montantcode;
							?>


							<tr class="order-total uk-text-yoomee">
								<th class="uk-text-yoomee">Total TTC</th>
								<td><strong><span class="woocommerce-Price-amount amount"><?= number_format($totalttc , 0, '.', ' ') ?> XAF</span></strong> </td>
							</tr>


							</tfoot>
						</table>

						<?php
							if(tr_posts_field('etatfacture') == 'encours'):
						?>

						<div id="payment" class="woocommerce-checkout-payment uk-margin-large-top">
							<div class="form-row place-order uk-margin-medium-top">


								<input type="text" name="code" class="input-text uk-input uk-width-1-3@m uk-border-rounded " id="coupon_code" value="" placeholder="Code validation du paiement">

								<button type="submit" class="uk-button  uk-button-yoomee-shop alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order" disabled><?php pll_e('valider' , 'yoomee'); ?></button>



							</div>

						</div>

						<?php

							endif;

                        ?>


				</form>
			</div>

		</div>


	<?php endwhile; ?>
<?php endif; ?>



<?php get_footer(); ?>

