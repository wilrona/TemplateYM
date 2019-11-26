<?php
namespace App\Controllers;

use \TypeRocket\Controllers\Controller;

class PromotionController extends Controller
{

	public function routing()
	{
		$this->setMiddleware('not_promotion', ['only' => ['sendcampagne1']]);
	}

	public function sendcampagne1(){

		if( isset($_POST['_tr_nonce_form']) && wp_verify_nonce($_POST['_tr_nonce_form'], "form_seed_59cdf94920d75")  ):

			$user_nom = $_POST['nom'];
			$user_prenom = $_POST['prenom'];
			$user_email = $_POST['email'];
			$user_phone = $_POST['phone'];
			$user_client = $_POST['client'];

			$email_subject = 'Confirmation de votre inscription à la vente flash';

			ob_start();

//			include("".get_template_directory_uri()."/email/email_header.php" );

			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>Happy Halloween!</title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0" />
				<style type="text/css">
					* {
						-ms-text-size-adjust:100%;
						-webkit-text-size-adjust:none;
						-webkit-text-resize:100%;
						text-resize:100%;
					}
					a{
						outline:none;
						color:#fff;
						text-decoration:underline;
					}
					a:hover{text-decoration:none !important;}
					a[x-apple-data-detectors]{
						color:inherit !important;
						text-decoration:none !important;
					}
					.active:hover{opacity:0.8;}
					.btn,
					.active{
						-webkit-transition:all 0.3s ease;
						-moz-transition:all 0.3s ease;
						-ms-transition:all 0.3s ease;
						transition:all 0.3s ease;
					}
					.btn:hover{background:rgba(255, 255, 255, 0.14);}
					table td{border-collapse:collapse !important; mso-line-height-rule:exactly;}
					.ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{line-height:inherit;}
					@media only screen and (max-width:500px) {
						/* default style */
						table[class="flexible"]{width:100% !important;}
						*[class="hide"]{
							display:none !important;
							width:0 !important;
							height:0 !important;
							padding:0 !important;
							font-size:0 !important;
							line-height:0 !important;
						}
						td[class="img-flex"] img{width:100% !important; height:auto !important;}
						td[class="aligncenter"]{text-align:center !important;}
						th[class="flex"]{display:block !important; width:100% !important;}
						tr[class="table-holder"]{display:table !important; width:100% !important;}
						th[class="thead"]{display:table-header-group !important; width:100% !important;}
						th[class="tfoot"]{display:table-footer-group !important; width:100% !important;}
						/* custom style */
						td[class="wrapper"]{padding:0 !important;}
						td[class="header"]{padding:20px 10px 30px !important;}
						td[class="indent-link"]{
							text-align:center !important;
							padding:0 0 30px !important;
						}
						td[class="h-auto"]{height:auto !important;}
						td[class="frame"]{padding:20px 10px !important;}
						td[class="p-0"]{padding:0 !important;}
						td[class="product-holder"]{padding:30px 10px !important;}
						td[class="cite-box"]{padding:20px 10px !important;}
						td[class="cite-box"] *{text-align:center !important;}
						td[class="btn-indent"]{padding:20px 0 0 !important;}
						td[class="w-10"]{width:10px !important;}
					}
				</style>
			</head>
			<body style="margin:0; padding:0;" bgcolor="#fff">
			<table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fff">
				<!-- fix for gmail -->
				<tr>
					<td style="line-height:0;"><div style="display:none; white-space:nowrap; font:15px/1px courier;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div></td>
				</tr>
				<tr>
					<td class="wrapper" style="padding:0 10px;">
						<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
							<!-- fix for gmail -->
							<tr>
								<td class="hide">
									<table width="600" cellpadding="0" cellspacing="0" style="width:600px !important;">
										<tr>
											<td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- header -->
							<tr>
								<td class="header" style="padding:14px 0 13px;">
									<table width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td height="74">
												<table width="100%" cellpadding="0" cellspacing="0">
													<tr class="table-holder">
														<th class="thead" align="left" style="padding:0;">
															<table width="100%" cellpadding="0" cellspacing="0">
																<tr>
																	<td class="indent-link" align="right" style="font:14px/16px Arial, Helvetica, sans-serif; color:#fff;"><a href="#" target="_blank" style="text-decoration:underline; color:#fff;">View this email in browser</a></td>
																</tr>
															</table>
														</th>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- section-01 -->
							<tr>
								<td class="img-flex"><a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/Ventes-Flash_600X346.jpg" height="346" width="600" border="0" style="vertical-align:top;" alt="" /></a></td>
							</tr>

							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td class="frame" bgcolor="#f9f9fa" style="padding:58px 50px 29px;">
												<table width="100%" cellpadding="0" cellspacing="0">
													<tr>
														<td class="cite-box" style="border-radius:3px; padding:24px; border:1px dashed #000;">
															<table width="100%" cellpadding="0" cellspacing="0">
																<tr>
																	<td align="center" style="padding:0 0 10px; font:bold 15px/21px Arial, Helvetica, sans-serif; color:#000; text-transform: uppercase;">Inscription réussi</td>
																</tr>
																<tr>
																	<td style="font:16px/18px Arial, Helvetica, sans-serif; color:#000; padding-bottom: 15px">Cher(e) Monsieur/Madame, <?= $user_nom ?> <?= $user_prenom ?></td>
																</tr>
																<tr>
																	<td style="font:14px/18px Arial, Helvetica, sans-serif; color:#000;">
																		Votre inscription est bien enregistrée. Nous vous remercions pour votre visite. Nous vous prions de vous rendre dans tous nos showrooms, pour bénéficier de votre offre spéciale. Jusqu’au 30 Avril 2018 profitez de <b>20% de remise sur vos recharges et 10% de remise sur l’achat des téléphones</b>.
																		<br> Vos informations complémentaires sont :
																		<ul style="display: block; margin: 15px 0">
																			<li><strong>Numéro de téléphone :</strong> <?= $user_phone ?></li>
																			<!--                                                            <li><strong>Adresse Email :</strong> <span style="color: #000 !important;">--><?//= $user_email ?><!--</span></li>-->
																			<li><strong>Etes-vous client Yoomee ? :</strong> <?= $user_client ?></li>
																		</ul>
																		<br> <span style="font-size: 16px">Yoomee, Overcome The Limit !!!</span>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>

									</table>
								</td>
							</tr>

							<tr>
								<td class="frame" bgcolor="#fff" style="padding:46px 74px;">
									<table width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td style="padding:0 0 32px;">
												<table align="center" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
													<tr>
														<td class="active" style="mso-padding-alt:14px 33px 15px; border-radius:3px; font:bold 14px/16px Arial, Helvetica, sans-serif; color:#fff;"><a href="https://yoomee.cm" target="_blank" style="text-decoration:none; color:#fff; display:block; padding:14px 33px 15px;"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.png" alt=""></a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="center" style="padding:0 0 23px; font:bold 18px/20px Arial, Helvetica, sans-serif; color:#000;">Vente Flash</td>
										</tr>
										<tr>
											<td class="aligncenter" style="padding:0 0 32px; font:15px/18px Arial, Helvetica, sans-serif; color:#000; text-align: justify">Le concept « Vente Flash » est une action promotionnelle «Vo/Po – Visit online Pay off line » qui vous offre l’opportunité d’avoir des réductions exceptionnelles de tarif sur vos achats dans nos boutiques durant la période de promotion. C’est simple, pratique et flexible pour vous.
												<br>Yoomee, Overcome The Limits !!!</td>
										</tr>

										<tr>
											<td align="center" style="font:12px/22px Arial, Helvetica, sans-serif; color:#000;">
												Copyright &copy; 2018. All rights reserved.
											</td>
										</tr>
									</table>
								</td>
							</tr>

						</table>
					</td>
				</tr>
			</table>
			</body>
			</html>


			<?php

//			include("".get_template_directory_uri()."/email/email_footer.php" );

			$message = ob_get_contents();
			ob_end_clean();

			wp_mail( $user_email, $email_subject, $message );
			wp_mail( 'showroom@yoomee.cm', $email_subject, $message );
//			wp_mail( 'laurynei.egbe@yoomee.cm', $email_subject, $message );





		endif;

		flash('success', 'Votre inscription a été pris en compte ', 'uk-alert-success');
		return tr_redirect()->back();

//		$to = $email;
//		$subject = 'Votre nouveau mot de passe sur Jess Assistance';
//		$sender = get_option('name');
//
//		$message = 'Votre nouveau mot de passe est : '.$random_password;
//
//		$headers[] = 'MIME-Version: 1.0' . "\r\n";
//		$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//		$headers[] = "X-Mailer: PHP \r\n";
//		$headers[] = 'From: '.$sender.' < '.$email.'>' . "\r\n";
//
//		$mail = wp_mail( $to, $subject, $message, $headers );

	}
}