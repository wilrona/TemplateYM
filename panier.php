<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 04/05/2018
 * Time: 18:04
 */
?>

<?php /* Template Name: Pages Panier */ ?>


<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<div class="uk-section uk-position-relative uk-section-shopping">

			<div class="uk-container">

				<?php flash('flash_cart'); ?>

				<?php

                $produits = $_SESSION['panier'];

				?>

                <?php
                    if($produits):
                ?>
				<form>
					<table class="uk-table uk-table-divider shop_table uk-table-middle">
						<thead  class="uk-background-yoomee-unique">
						<tr>
							<th class="uk-text-yoomee-2" style="width: 30px"></th>
							<th class="uk-text-yoomee-2" style="width: 70px"></th>
							<th class="uk-text-yoomee-2">Produits</th>
							<th class="uk-text-yoomee-2">Prix</th>
							<th class="uk-text-yoomee-2">Quantité</th>
							<th class="uk-text-yoomee-2">Total</th>
						</tr>
						</thead>
						<tbody>
                        <?php
                            $total = 0;
                            foreach ($produits as $prod):
                        ?>
						<tr>
							<td class="product-remove remove_product" id="<?= $prod['id'] ?>">
								<a class="remove">x</a>
							</td>
							<td class="product-thumbnail">
								<a href="<?= get_the_permalink($prod['id']) ?>" class="uk-link-reset">
									<img width="540" height="540" src="<?= $prod['img'] ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image uk-border-circle" alt="" >
								</a>
							</td>
							<td class="product-name"><a href="<?= get_the_permalink($prod['id']) ?>" class="uk-link-reset"><?= $prod['nom'] ?></a></td>
							<td class="product-price">
							<span class="woocommerce-Price-amount amount"><span><?= number_format($prod['prix'] , 0, '.', ' ') ?> XAF</span>
							</td>
							<td class="product-quantity">
								<div class="quantity">
									<!--								<label class="screen-reader-text" for="quantity_5aec94bdd26bf">Quantity</label>-->
									<input type="number" id="<?= $prod['id'] ?>" class="input-text uk-input qty text" step="1" min="1" max="" name="qty[]" value="<?= $prod['qte'] ?>" title="Qty">
								</div>
							</td>
							<?php
							$montant = $prod['qte'] * $prod['prix'];
							$total += $montant;
							?>
							<td class="product-subtotal">
							<span class="woocommerce-Price-amount amount">
								<?= number_format($montant , 0, '.', ' ') ?> XAF
							</span>
							</td>
						</tr>

                        <?php
                            endforeach;
                        ?>
						<tr>
							<td colspan="6" class="actions">

								<div class="uk-grid-small" uk-grid>
									<div class="uk-width-3-5@m">
										<input type="text" name="coupon_code" class="input-text uk-input uk-width-2-3@m uk-border-rounded " id="coupon_code" value="" placeholder="Coupon code">
										<input type="button" class="uk-button uk-button-yoomee-shop-2 apply_coupon" name="apply_coupon" value="<?php pll_e('Valider le coupon' , 'yoomee'); ?>">
									</div>

									<div class="uk-width-2-5@m uk-text-right">
										<button type="button" class="uk-button uk-button-yoomee-shop-2 update_cart" name="update_cart" value="Update cart"><?php pll_e('Modifier le panier' , 'yoomee'); ?></button>

									</div>
								</div>


							</td>

						</tr>
						</tbody>
					</table>
				</form>

				<div class="cart-collaterals uk-width-1-2@m">
					<div class="cart_totals ">


						<h2><?php pll_e('Total du panier' , 'yoomee'); ?></h2>

						<table cellspacing="0" class="shop_table shop_table_responsive uk-table uk-table-divider uk-table-middle">

							<tbody><tr class="cart-subtotal">
								<th>Total</th>
								<td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><?= number_format($total , 0, '.', ' ') ?> XAF</span></td>
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

							<tr class="order-total">
								<th>Total TTC</th>

                                <?php
                                    $totalttc = $total - $montantcode;
                                ?>
								<td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><?= number_format($totalttc , 0, '.', ' ') ?> XAF</span></strong> </td>
							</tr>


							</tbody>
						</table>

						<div class="wc-proceed-to-checkout">
                            <a href="<?= get_the_permalink(tr_options_field('ym_options.shop')) ?>" class="checkout-button uk-button uk-button-yoomee-shop-2 alt wc-forward">
								<?php pll_e('Retour à la boutique' , 'yoomee'); ?></a>
							<a href="<?= get_the_permalink(tr_options_field('ym_options.checkout')) ?>" class="checkout-button uk-button uk-button-yoomee-shop alt wc-forward">
								<?php pll_e('Proceder à l\'achat' , 'yoomee'); ?></a>

						</div>


					</div>
				</div>
                <?php else: ?>
                <div class="woocommerce">

                    <p class="cart-empty"><?php pll_e('Votre panier est vide' , 'yoomee'); ?></p>	<p class="return-to-shop">
                        <a class="uk-button uk-button-yoomee-shop-2" href="<?= get_the_permalink(tr_options_field('ym_options.shop')) ?>"> <?php pll_e('Retour à la boutique' , 'yoomee'); ?></a>
                    </p>
                </div>
                <?php endif; ?>
			</div>

		</div>


	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
