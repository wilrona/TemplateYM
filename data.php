<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 04/12/2017
 * Time: 14:32
 */

?>


<?php /* Template Name: Calcul Data */ ?>

<?php get_header(); ?>







		<!--    <div class="uk-section uk-section-default uk-padding-remove-bottom uk-section-about">-->
		<!--        <div class="uk-container">-->
		<!--            <h1 class="uk-heading-line uk-margin-large-bottom"><span>--><?php //the_title() ?><!-- </span></h1>-->
		<!--        </div>-->
		<!--    </div>-->

		<div class="uk-section-map uk-section-service">
			<div class="uk-container  uk-padding">
				<?php $page_id = ""; ?>
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<?php the_content() ?>
						<?php $page_id = $post->ID; ?>
					<?php endwhile; ?>
				<?php endif; ?>

				<div class="uk-card uk-card-default">
					<div class="uk-card-header">
						<h3 class="uk-card-title uk-text-uppercase">Calcul de la consommation de vos datas</h3>
					</div>
					<div class="uk-card-body">
						<div class="" uk-grid>
							<div class="uk-width-3-5">
								<div class="uk-card uk-card-small uk-card-default uk-card-body">
									<form class="uk-form-stacked uk-margin" id="formulaire">
										<div class="uk-margin">
											<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Nombre Email' , 'yoomee'); ?> : </label>
											<div class="uk-form-controls">
												<input type="number" class="uk-input uk-form-small" min="0" name="nbreEmail">
											</div>
										</div>
										<div class="uk-margin">
											<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Nombre Email avec fichier' , 'yoomee'); ?> : </label>
											<div class="uk-form-controls">
												<input type="number" class="uk-input uk-form-small" min="0" name="nbreEmailFichier">
											</div>
										</div>
										<div class="uk-margin">
											<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('video streaming' , 'yoomee'); ?> : </label>
											<div class="uk-form-controls">
                                                <div class="uk-grid-collapse" uk-grid>
                                                    <div class="uk-width-5-6">
                                                        <input type="number" class="uk-input uk-form-small" min="0" name="videoStreaming">
                                                    </div>
                                                    <div class="uk-width-1-6">
                                                        <button class="uk-button uk-button-default uk-button-small uk-width-1-1 uk-text-capitalize" disabled style="color: #000;">Heure (s)</button>
                                                    </div>
                                                </div>

											</div>
										</div>
										<div class="uk-margin">
											<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Réseaux sociaux' , 'yoomee'); ?> : </label>
											<div class="uk-form-controls">
												<input type="number" class="uk-input uk-form-small" min="0" name="chatRS">
											</div>
										</div>
										<div class="uk-margin">
											<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Musique' , 'yoomee'); ?> : </label>
											<div class="uk-form-controls">
												<input type="number" class="uk-input uk-form-small" min="0" name="musique">
											</div>
										</div>
										<div class="uk-margin">
											<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Documents Presentation' , 'yoomee'); ?> : </label>
											<div class="uk-form-controls">
												<input type="number" class="uk-input uk-form-small" min="0" name="docPresentation">
											</div>
										</div>
										<div class="uk-margin">
											<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Photos Envoyées' , 'yoomee'); ?> : </label>
											<div class="uk-form-controls">
												<input type="number" class="uk-input uk-form-small" min="0" name="photos">
											</div>
										</div>
										<div class="uk-margin">
											<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Sauvegardes' , 'yoomee'); ?> : </label>
											<div class="uk-form-controls">
                                                <div class="uk-grid-collapse" uk-grid>
                                                    <div class="uk-width-5-6">
                                                        <input type="number" class="uk-input uk-form-small" min="0" name="sauvagarde">
                                                    </div>
                                                    <div class="uk-width-1-6">
                                                        <button class="uk-button uk-button-default uk-button-small uk-width-1-1 uk-text-capitalize" disabled style="color: #000;">Go</button>
                                                    </div>
                                                </div>

											</div>
										</div>
										<div class="uk-margin">
											<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Applications' , 'yoomee'); ?> : </label>
											<div class="uk-form-controls">
                                                <div class="uk-grid-collapse" uk-grid>
                                                    <div class="uk-width-5-6">
                                                        <input type="number" class="uk-input uk-form-small" min="0" name="application">
                                                    </div>
                                                    <div class="uk-width-1-6">
                                                        <button class="uk-button uk-button-default uk-button-small uk-width-1-1 uk-text-capitalize" disabled style="color: #000;">Go</button>
                                                    </div>
                                                </div>

											</div>
										</div>
										<div class="uk-margin">
											<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Jeux' , 'yoomee'); ?> : </label>
											<div class="uk-form-controls">
												<input type="number" class="uk-input uk-form-small" min="0" name="jeux">
											</div>
										</div>

										<div class="uk-margin uk-margin-top uk-padding-small">
											<button type="button" class="uk-button uk-button-yoomee uk-button-yoomee-shop" id="submitted"><?php pll_e('Calculer' , 'yoomee'); ?></button>
										</div>
									</form>
								</div>
							</div>
							<div class="uk-width-2-5">
								<div class="uk-card uk-card-default uk-card-small">
									<div class="uk-card-header uk-background-primary">
										<h3 class="uk-card-title" style="color: #ffffff;">Estimation</h3>
									</div>
									<div id="resultat">
                                        <div class="uk-card-body uk-text-center">
                                            <h6 class="uk-heading-primary">30 Go</h6>


                                            <hr>
                                            <h5>le forfait adapté pour vous</h5>
                                        </div>

                                        <div class="uk-card-media-top uk-padding-small" style="background-color: #f6f6f6;">
                                            <img src="https://yoomee.cm/wp-content/uploads/2017/11/75GO.png" alt="" class="uk-margin-auto uk-display-block">
                                            <div class="uk-overlay uk-light uk-position-bottom">
                                                <a href="" class="uk-button"></a>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>



			</div>
		</div>


<script>
    var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
    jQuery(function($) {
        $('body').on('click', '#submitted', function(e) {
            e.preventDefault();
            var $this = $(this);
//            $this.prop('disabled', true).text('<?php //pll_e('Chargement' , 'yoomee');  ?>//');

            var data = {
                'action': 'load_data_by_ajax',
                'security': '<?php echo wp_create_nonce("load_more_data"); ?>',
	            'nbreEmail': $('input[name="nbreEmail"]').val(),
	            'nbreEmailFichier': $('input[name="nbreEmailFichier"]').val(),
	            'videoStreaming': $('input[name="videoStreaming"]').val(),
	            'chatRS': $('input[name="chatRS"]').val(),
	            'musique': $('input[name="musique"]').val(),
	            'docPresentation': $('input[name="docPresentation"]').val(),
	            'photos': $('input[name="photos"]').val(),
	            'sauvagarde': $('input[name="sauvagarde"]').val(),
	            'application': $('input[name="application"]').val(),
	            'jeux': $('input[name="jeux"]').val(),
                'lang' : '<?php pll_current_language() ?>'

            };

            $.post(ajaxurl, data, function(response) {
                console.log(response);
                if(response === ''){
//                    $this.prop('disabled', false).text('<?php //pll_e( 'Calculer' , 'yoomee'); ?>//');

                }else{
//                    $this.prop('disabled', false).text('<?php //pll_e( 'Calculer' , 'yoomee'); ?>//');
                }
            });
        });
    });
</script>



<?php get_footer(); ?>
