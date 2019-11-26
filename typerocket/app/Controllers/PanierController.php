<?php
namespace App\Controllers;

use Endroid\QrCode\QrCode;
use \TypeRocket\Controllers\Controller;
use WP_Query;

class PanierController extends Controller
{

	public function routing()
	{
		$this->setMiddleware('not_panier', ['only' => ['register']]);
	}

	public function register(){
		if(isset($_POST['_tr_nonce_form']) && wp_verify_nonce($_POST['_tr_nonce_form'], "form_seed_59cdf94920d75") ):

			if(empty($_POST['billing_name']) || empty($_POST['billing_email']) || empty($_POST['billing_phone']) || empty($_POST['billing_ville'])):

				flash('flash_checkout', 'Certaines informations obligatoires n\'ont pas été renseignée (Détail de la facture).', 'uk-alert uk-alert-empty uk-padding-small uk-margin-medium-bottom');
				return tr_redirect()->toUrl(get_the_permalink(tr_options_field('ym_options.checkout')));

			else:

				$user =  array();

				$user['nom'] = $_POST['billing_name'];
				$user['email'] = $_POST['billing_email'];
				$user['phone'] = $_POST['billing_phone'];
				$user['adresse'] = $_POST['billing_adresse'];
				$user['comment'] = $_POST['order_comments'];

				foreach (tr_posts_field('listeville', tr_options_field('ym_options.checkout')) as $ville):

					if($ville['slugville'] === $_POST['billing_ville']){
						$user['ville'] = $ville['nomville'];
					}

				endforeach;

				$car = 6;
				$string = "";
				$chaine = "1234567890";
				srand((double)microtime()*1000000);
				for($i=0; $i<$car; $i++) {
					$string .= $chaine[rand()%strlen($chaine)];
				}

				$new_post = array(
					'post_title'    => 'YO'.$string,
					'post_status'   => 'publish',
					'post_type'     => 'facture'
				);

				$pid = wp_insert_post($new_post);

				$panier = [];

				$panier['panier'] = $_SESSION['panier'];
				$panier['coupon'] = $_SESSION['coupon'];
				$panier['user'] = $user;

				if($panier['coupon']):

					$arg_promo = array(
						'post_type' => 'code'
					);

					$custom_query = new WP_Query($arg_promo);

					while ( $custom_query->have_posts() ) : $custom_query->the_post();

						if(strtolower(get_the_title()) == strtolower($panier['coupon']['code']) && strtotime(tr_posts_field('dateendcoupon', get_the_ID())) <= time()){
							$counter = tr_posts_field('countcoupon', get_the_ID());
							if(!isset($counter)){
								add_post_meta(get_the_ID(), 'countcoupon', 0, true);
							};

							if(tr_posts_field('nbrecoupon', get_the_ID()) > 0 ){
								if(tr_posts_field('countcoupon', get_the_ID()) <= tr_posts_field('nbrecoupon', get_the_ID())){
									$count = tr_posts_field('countcoupon', get_the_ID());
									$count += 1;
									update_post_meta(get_the_ID(), 'countcoupon', $count, true);
								}
							}else{
								$count = tr_posts_field('countcoupon', get_the_ID());
								$count += 1;
								update_post_meta(get_the_ID(), 'countcoupon', $count, true);
                            }
						}

					endwhile;

				endif;

				$nbreday = 0;
				$validite = tr_options_field('ym_options.validefacture');
				if(isset($validite) && !empty($validite)):
					$nbreday = tr_options_field('ym_options.validefacture');
				endif;

				update_post_meta($pid,'datefin',  date('d/m/Y', strtotime("+".$nbreday." days")));
				update_post_meta($pid,'datefinconvert',  date('Y-m-d H:i:s', strtotime("+".$nbreday." days")));

				update_post_meta($pid, 'etatfacture', 'encours');
				update_post_meta($pid, 'clepayment', $_POST['payment_method']);
				update_post_meta($pid, 'panier', $panier);

				$this->emailbilling($pid, $panier);

				unset($_SESSION['panier']);
				unset($_SESSION['coupon']);
				flash('flash_cart', 'Votre commande a été validé avec succès. Consultez votre adresse email pour imprimer votre facture.', 'uk-alert uk-alerte-success uk-alert-empty uk-padding-small uk-margin-medium-bottom');
				return tr_redirect()->toUrl(get_the_permalink(tr_options_field('ym_options.cart')));

			endif;

		endif;
	}


	public function emailbilling($idbill, $panier){

		$facture = get_post($idbill);

		$user_email = $panier['user']['email'];
		$email_subject = '[Yoomee Mobile] Votre facture #'.$facture->post_title.' de votre commande sur notre site';

		ob_start();

		?>

		<!doctype html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>[Yoomee Mobile] Votre facture #<?= $facture->post_title ?> de votre commande sur notre site</title>

			<style>
				.invoice-box {
					max-width: 800px;
					margin: auto;
					padding: 30px;
					border: 1px solid #eee;
					box-shadow: 0 0 10px rgba(0, 0, 0, .15);
					font-size: 16px;
					line-height: 24px;
					font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
					color: #555;
				}

				.invoice-box:before {
					content: "";
					position: absolute;
					width: 200%;
					height: 200%;
					top: -60%;
					left: -50%;
					z-index: -1;
					background: url('<?php echo get_template_directory_uri(); ?>/images/logo-fond.png') 0 0 no-repeat;
					background-position: center;
					background-size: 550px;
					-webkit-transform: rotate(30deg);
					transform: rotate(30deg);
					opacity: .2;
				}

				.invoice-box table {
					width: 100%;
					line-height: inherit;
					text-align: left;
				}

				.invoice-box table td {
					padding: 5px;
					vertical-align: top;
				}

				.invoice-box table tr td:nth-child(2) {
					text-align: right;
				}

				.invoice-box table tr.top table td {
					padding-bottom: 20px;
				}

				.invoice-box table tr.top table td.title {
					font-size: 45px;
					line-height: 45px;
					color: #333;
				}

				.invoice-box table tr.information table td {
					padding-bottom: 40px;
				}

				.invoice-box table tr.heading td {
					background: #e10430;
					border-bottom: 1px solid #ddd;
					font-weight: bold;
					color: #ffffff;
				}

				.invoice-box table tr.details td {
					padding-bottom: 20px;
				}

				.invoice-box table tr.item td{
					border-bottom: 1px solid #eee;
				}

				.invoice-box table tr.item.last td {
					border-bottom: none;
				}

				.invoice-box table tr.total td:nth-child(2) {
					border-top: 2px solid #eee;
					font-weight: bold;
				}

				@media only screen and (max-width: 600px) {
					.invoice-box table tr.top table td {
						width: 100%;
						display: block;
						text-align: center;
					}

					.invoice-box table tr.information table td {
						width: 100%;
						display: block;
						text-align: center;
					}
				}

				/** RTL **/
				.rtl {
					direction: rtl;
					font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				}

				.rtl table {
					text-align: right;
				}

				.rtl table tr td:nth-child(2) {
					text-align: left;
				}
			</style>
		</head>

		<body>
		<div class="invoice-box">

			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<?php
										$linkfact = get_the_permalink($facture->ID);
									?>
									<img src="<?= home_url('/facture/qrcode?link='.$linkfact) ?>" style="width:100%; max-width:150px;">
								</td>

								<td style="position:relative">
									<div>
										Facture en ligne #: <?= $facture->post_title ?><br>
										Date création: <?= sky_date_french('d/m/Y', get_post_time('U', true, $facture->ID), 1); ?><br>
										Fin de l'offre: <?= tr_posts_field('datefin', $facture->ID); ?>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									<img src="<?php echo get_template_directory_uri(); ?>/images/logo-3.png" style="width:100%; max-width:70px; float:left; margin-right:20px">
									Yoomee Mobile SA, Akwa, Salle des fêtes<br>
									Email: support@yoomee.cm <br>
									whatsapp: 651015951
								</td>

								<td>
									<?= $panier['user']['nom'] ?><br>
									<?= $panier['user']['email'] ?><br>
									<?= $panier['user']['phone'] ?> <br>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>
						Méthode de paiement
					</td>

					<td>
						Adresse Client
					</td>
				</tr>

				<tr class="details">
					<td>
						<?php
						if(get_post_meta($facture->ID, 'clepayment') == 'cash'):
							$moyen = 'Cash à la livraison';
						else:
							$moyen = 'Paiement et retrait en magasin';
						endif;

						echo $moyen;
						?>
					</td>

					<td>
						<?= $panier['user']['ville'] ?> <hr>
						<?= $panier['user']['adresse'] ?> <hr>
						<?= $panier['user']['comment'] ?>
					</td>
				</tr>

				<tr class="heading">
					<td>
						Produits
					</td>

					<td>
						Prix
					</td>
				</tr>

				<?php
					$produit = $panier['panier'];
					$count = count($produit);

					$total = 0;
					$incr = 0;

					$coupon = $panier['coupon'];


					foreach ($produit as $prod):
				?>

				<tr class="item <? if(!$coupon && $incr == $count): ?> last <?php endif ?>">
					<td>
						<?= $prod['nom'] ?> ( x <?= $prod['qte'] ?>)
					</td>

					<?php
						$montant = $prod['qte'] *  $prod['prix'];
						$total += $montant;
					?>

					<td>
						<?= number_format($montant , 0, '.', ' ') ?> XAF
					</td>
				</tr>

					<?php
						$incr += 1;
						endforeach;
					?>

				<?php

					$montantcode = 0;

					if($coupon):

				?>

				<tr class="item last">
					<td>
						Coupon Code : <?= $coupon['code'];  ?>
					</td>

					<td>
						<?php
						if($coupon['type'] == 'pourcentage'):

							$montantcode = ($total * intval($coupon['valeur'])) / 100;

						else:

							$montantcode = intval($coupon['valeur']);

						endif;

						?>

						<?= number_format($montantcode , 0, '.', ' ') ?> XAF
					</td>
				</tr>
					<?php endif; ?>

				<tr class="total">
					<td></td>

					<td>
						<?php $totalttc =  $total - $montantcode; ?>
						Total: <?= number_format($totalttc , 0, '.', ' ') ?> XAF
					</td>
				</tr>
			</table>
		</div>
		</body>
		</html>

		<?php

		$message = ob_get_contents();
		ob_end_clean();

		wp_mail( $user_email, $email_subject, $message );
//		wp_mail( 'showroom@yoomee.cm', $email_subject, $message );
	}

	public function generateQRcode(){

		$link = $_GET['link'];
		header('Content-Type: image/png');
		$qr = new QrCode();
		$qr->setText($link);
		$qr->setSize(150);
		echo $qr->writeString();
		die();
	}
}