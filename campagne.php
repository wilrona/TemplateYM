<?php /* Template Name: Campagne 1 */ ?>


<?php get_header(); ?>



<div class="uk-section uk-section-medium uk-section-service">
    <div class="uk-container">




		<?php the_content(); ?>


		<?php
		    flash('success');
		?>
        <br>

        <div class="uk-flex uk-flex-center uk-margin-medium">
            <form action="<?= home_url('/campagne1/send'); ?>" method="post" class="uk-form-horizontal uk-margin uk-width-2-3">
                <?php
                wp_nonce_field("form_seed_59cdf94920d75", "_tr_nonce_form");
                ?>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Nom' , 'yoomee'); ?> : </label>
                    <div class="uk-form-controls">
                        <input type="text" class="uk-input" name="nom" required>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Prenom' , 'yoomee'); ?> : </label>
                    <div class="uk-form-controls">
                        <input type="text" class="uk-input" name="prenom" required>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Adresse Email' , 'yoomee'); ?> : </label>
                    <div class="uk-form-controls">
                        <input type="email" class="uk-input" name="email" required>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Téléphone' , 'yoomee'); ?> : </label>
                    <div class="uk-form-controls">
                        <input type="text" class="uk-input" name="phone" required>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select">Etes vous client yoomee ? : </label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select" name="client" required>
                            <option>-- Selectionnez votre reponse --</option>
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                </div>

                <div class="uk-margin uk-margin-large-top uk-padding-small uk-text-center">
                    <button type="submit" class="uk-button uk-button-yoomee uk-button-yoomee-shop">Validez</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>
