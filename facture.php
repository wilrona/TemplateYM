<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 07/05/2018
 * Time: 17:17
 */
?>



<?php /* Template Name: Pages validation panier */ ?>

<?php get_header(); ?>
<?php

$produits = $_SESSION['panier'];

?>
<?php
    if(!$produits):
        wp_redirect(get_the_permalink(tr_options_field('ym_options.cart')));
    endif;
?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<div class="uk-section uk-position-relative uk-section-shopping">

			<div class="uk-container">

				<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?= home_url('/facture/send') ?>" enctype="multipart/form-data" novalidate="novalidate">

                    <?php
                        wp_nonce_field("form_seed_59cdf94920d75", "_tr_nonce_form");
                    ?>

					<?php flash('flash_checkout'); ?>

					<div class="uk-child-width-1-2@m uk-grid" id="customer_details" uk-grid>
						<div class="col-1">
							<div class="woocommerce-billing-fields">

								<h3>Détail de la facture</h3>


								<div class="woocommerce-billing-fields__field-wrapper">
									<p class=" form-row-first validate-required" id="billing_first_name_field" data-priority="10">
										<label for="billing_first_name" class=""><?php pll_e('Nom' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>

										<input type="text" class="input-text uk-input " name="billing_name" id="billing_name" placeholder="" value="" autofocus="autofocus"></p>
									<p class=" form-row-last validate-required" id="billing_last_name_field" data-priority="20">
										<label for="billing_last_name" class=""><?php pll_e('Adresse Email' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text uk-input" name="billing_email" id="billing_email" placeholder="" value="" >
									</p>
                                    <p class=" form-row-last validate-required" id="billing_last_name_field" data-priority="20">
										<label for="billing_last_name" class=""><?php pll_e('Téléphone' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text uk-input" name="billing_phone" id="billing_phone" placeholder="" value="">
									</p>

									<p class=" form-row-wide address-field update_totals_on_change validate-required woocommerce-validated" id="billing_country_field" data-priority="40">
										<label for="billing_ville" class=""><?php pll_e('Ville' , 'yoomee'); ?> <abbr class="required" title="required">*</abbr></label>
										<select name="billing_ville" id="billing_ville" class="country_to_state country_select  select2-hidden-accessible uk-select" autocomplete="country" tabindex="-1" aria-hidden="true">

											<option value="">Sélection de la ville</option>
                                            <?php

                                                if(tr_posts_field('listeville')):
                                                    foreach ( tr_posts_field( 'listeville' ) as $paiement ):
                                            ?>
                                                        <option value="<?= $paiement['slugville'] ?>"><span><?= $paiement['nomville'] ?></span></option>
                                            
                                            <?php
                                                    endforeach;
                                                endif;
                                            ?>
										</select>
									</p>
                                    <p class=" form-row-wide" id="billing_company_field" data-priority="30">
                                        <label for="billing_adresse" class=""><?php pll_e('Addresse complete' , 'yoomee'); ?></label>
                                        <textarea name="billing_adresse" class="input-text uk-textarea" id="billing_adresse" rows="2" cols="5" style="min-height: 100px;"></textarea>
                                    </p>
								</div>
							</div>
						</div>

						<div class="col-2">
							<div class="woocommerce-additional-fields">



								<h3>Informations Supplémentaires</h3>


								<div class="woocommerce-additional-fields__field-wrapper">
									<p class="notes" id="order_comments_field" data-priority="">
                                        <label for="order_comments" class="">Notes</label>
                                        <textarea name="order_comments" class="input-text uk-textarea" id="order_comments" placeholder="" rows="2" cols="5" style="min-height: 200px;"></textarea>
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
							$code = $_SESSION['coupon'];

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

						<div id="payment" class="woocommerce-checkout-payment uk-margin-large-top">
                            <?php
                                if(tr_posts_field('listpaiement')):

                            ?>
                            <div class="uk-arlert uk-alert-paiement uk-alert-danger uk-margin-medium-bottom" style="border: 1px solid #d2d2d8" uk-alert>
                                <p class="uk-margin-remove">
                                    Selectionnez un moyen de paiement
                                </p>
                            </div>
							<ul class="wc_payment_methods payment_methods methods uk-list">
                                <?php

                                    foreach (tr_posts_field('listpaiement') as $paiement):

                                        $split_paiement = explode(' ',$paiement['nompayment'] );
                                        $slug = "";

                                        foreach ($split_paiement as $split):
                                            $slug .= $split;
                                        endforeach;
                                ?>
								<li class="wc_payment_method <?php foreach ($paiement['villepayment'] as $ville): ?><?= $ville['cleville'] ?> <?php endforeach; ?> <?php if(!$paiement['villepayment']): ?> all-ville <?php endif; ?>">
									<input id="<?= $slug ?>" type="radio" class="input-radio" name="payment_method" value="<?= $paiement['clepayment'] ?>">

									<label for="<?= $slug ?>"><?= $paiement['nompayment'] ?></label>
									<div class="payment_box <?= $slug ?>" style="display: none">
										<p><?= $paiement['descrpayment'] ?></p>
									</div>
								</li>
                                <?php endforeach; ?>
							</ul>
                            <?php

                                endif;
                            ?>
							<div class="form-row place-order uk-margin-medium-top">
								<noscript>
									Since your browser does not support JavaScript, or it is disabled, please ensure you click the &lt;em&gt;Update Totals&lt;/em&gt; button before placing your order. You may be charged more than the amount stated above if you fail to do so.			<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Update totals</button>
								</noscript>

<!--								<p class="form-row terms wc-terms-and-conditions">-->
<!--									<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">-->
<!--										<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" id="terms"> <span>I’ve read and accept the <a href="http://startup-company.cmsmasters.net/terms-and-conditions/" target="_blank" class="woocommerce-terms-and-conditions-link">terms &amp; conditions</a></span> <span class="required">*</span>-->
<!--									</label>-->
<!--									<input type="hidden" name="terms-field" value="1">-->
<!--								</p>-->

                                <a href="<?= get_the_permalink(tr_options_field('ym_options.cart')) ?>" class="checkout-button uk-button uk-button-yoomee-shop-2 alt wc-forward">
									<?php pll_e('Retour au panier' , 'yoomee'); ?></a>

								<button type="submit" class="uk-button  uk-button-yoomee-shop alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order" disabled><?php pll_e('valider la commande' , 'yoomee'); ?></button>



						</div>

					</div>


				</form>
			</div>

		</div>


	<?php endwhile; ?>
<?php endif; ?>

<script>

    function check_radio(){
        var radio = false;
        jQuery('input.input-radio').each(function () {
            if(jQuery(this).is(':checked')){
                radio = true;
            }
        });
        if(radio){
            jQuery('.uk-alert-paiement').addClass('uk-hidden');
        }else{
            jQuery('.uk-alert-paiement').removeClass('uk-hidden');
        }
    }

    jQuery('input.input-radio').on('click', function () {
        var $id = jQuery(this).attr('id');
        jQuery('.payment_box').hide(300);
        jQuery('.'+$id).show(300);
        check_radio();
        jQuery('#place_order').attr('disabled', false);
    })

    jQuery('#billing_ville').on('change', function () {
        $current = jQuery(this).val();
        jQuery('.wc_payment_method').each(function () {
            jQuery(this).show();

            if(jQuery(this).hasClass(''+$current+'')){
                jQuery(this).hide();
                $radio = jQuery(this).find('input.input-radio').attr('id');
                jQuery('#'+$radio).attr('checked', false);
                jQuery('.payment_box.'+$radio).hide();

            }

            check_radio();
        })


    })



</script>

<?php get_footer(); ?>
