<?php /* Template Name: Formulaire LTE */ ?>

<?php get_header(); ?>

	<?php
$ErrorMessage = [];

if(isset($_POST['submitted'])) {

	$name = '';
	$age = '';
	$email = '';
	$phone = '';
	$ville = '';
	$equipement = '';

	if(trim($_POST['nom']) === '') {
		$ErrorMessage[] = pll__('Nom Obligatoire' , 'yoomee').'.';
		$hasError = true;
	} else {
		$name = trim($_POST['nom']);
	}

	if(trim($_POST['prenom']) === '') {
		$ErrorMessage[] = pll__('Nom Obligatoire' , 'yoomee').'.';
		$hasError = true;
	} else {
		$name .= ' ';
		$name .= trim($_POST['prenom']);
	}

	if(trim($_POST['email']) === '')  {
		$ErrorMessage[] = pll__('Email Obligatoire' , 'yoomee').'.';
		$hasError = true;
	} else if (!preg_match('/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+.[a-z]{2,4}$/i', trim($_POST['email']))) {
		$ErrorMessage[] = pll__('Votre adresse email n\'est pas valide' , 'yoomee').'.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['phone']) === '') {
		$ErrorMessage[] = pll__('Numero de telephone obligatoire' , 'yoomee').'.';
		$hasError = true;
	} else {
		if(is_numeric(trim($_POST['phone']))){
			$phone = trim($_POST['phone']);
		}else{
			$ErrorMessage[] = pll__('Entre votre un numéro de telephone valide' , 'yoomee').'.';
			$hasError = true;
		}

	}

	if(trim($_POST['ville']) === '') {
		$ErrorMessage[] = pll__('Information de la ville obligatoire' , 'yoomee').'.';
		$hasError = true;
	} else {
		$ville = trim($_POST['ville']);
	}

	if(trim($_POST['equipement']) === '') {
		$ErrorMessage[] = pll__('Choix equipement obligatoire' , 'yoomee').'.';
		$hasError = true;
	} else {
		$equipement = trim($_POST['equipement']);
	}

	if(!isset($hasError)) {

		$data_save = wp_insert_post(array(
			'post_type' => 'testlte',
			'post_title' => $name,
			'post_status' => 'publish'
		));

		update_post_meta($data_save,'age_test_lte', $age);
		update_post_meta($data_save,'email_test_lte', $email);
		update_post_meta($data_save,'phone_test_lte', $phone);
		update_post_meta($data_save,'ville_test_lte', $ville);
		update_post_meta($data_save,'equipement_test_lte', $equipement);

	}
}

	?>



	<?php if (have_posts()) : while (have_posts()) : the_post();

		$page_id = $post->ID;

	endwhile; endif; ?>

	<div class="uk-section uk-section-medium uk-section-service">
		<div class="uk-container uk-container-small">


			<?php the_content(); ?>


            <?php
                if(!isset($hasError) && $_POST['submitted']) {
                    ?>
                    <div class="uk-alert-success" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <h2 class="uk-h1">Bravo oooo !!!!</h2>
                        <p>Votre formulaire a été soumis avec succès !</p>
                    </div>
                <?php
                }
            ?>

			<?php
			if(isset($hasError) && $_POST['submitted']) {
				?>
                <div class="uk-width-1-1">
					<?php foreach ($ErrorMessage as $Error): ?>
                        <div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p><?= $Error ?></p>
                        </div>
					<?php endforeach; ?>
                </div>
				<?php
			}
			?>
            <br>

			<form action="<?php get_the_permalink($page_id) ?>" method="post" class="uk-form-horizontal uk-margin">
				<div class="uk-margin">
					<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Nom' , 'yoomee'); ?> : </label>
					<div class="uk-form-controls">
						<input type="text" class="uk-input" name="nom">
					</div>
				</div>
				<div class="uk-margin">
					<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Prenom' , 'yoomee'); ?> : </label>
					<div class="uk-form-controls">
						<input type="text" class="uk-input" name="prenom">
					</div>
				</div>

				<div class="uk-margin">
					<label class="uk-form-label" for="form-stacked-select"><?php pll_e('Age' , 'yoomee'); ?></label>
					<div class="uk-form-controls">
						<select class="uk-select" id="form-stacked-select" name="age">
							<option>-- Selection --</option>
							<option value="tranche_18_25">18 - 25</option>
							<option value="tranche_26_30">26 - 30</option>
							<option value="tranche_31_35">31 - 35</option>
							<option value="tranche_35_More"><?php pll_e('Plus 35' , 'yoomee'); ?></option>
						</select>
					</div>
				</div>

				<div class="uk-margin">
					<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Adresse Email' , 'yoomee'); ?> : </label>
					<div class="uk-form-controls">
						<input type="text" class="uk-input" name="email">
					</div>
				</div>

				<div class="uk-margin">
					<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Téléphone' , 'yoomee'); ?> : </label>
					<div class="uk-form-controls">
						<input type="text" class="uk-input" name="phone">
					</div>
				</div>
				<div class="uk-margin">
					<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Ville' , 'yoomee'); ?> : </label>
					<div class="uk-form-controls">
						<select class="uk-select" id="form-stacked-select" name="ville">
							<option>-- Selection --</option>
							<option value="Douala">Douala</option>
							<option value="Yaoundé">Yaoundé</option>
							<option value="Garoua">Garoua</option>
							<option value="Bafoussam">Bafoussam</option>
							<option value="Autres">Autres</option>
						</select>
					</div>
				</div>
				<div class="uk-margin">
					<label class="uk-form-label" for="form-horizontal-select"><?php pll_e('quelle equipement' , 'yoomee'); ?> : </label>
					<div class="uk-form-controls">
						<select class="uk-select" id="form-stacked-select" name="equipement">
							<option>-- Selection --</option>
							<option value="equipement_1">Smartphone, tablette</option>
							<option value="equipement_2">Routeur mobile Mi-Fi</option>
							<option value="equipement_3">Routeur fixe (Box)</option>
							<option value="equipement_4">Je n’ai pas d’équipement 4G</option>
						</select>
					</div>
				</div>

				<input type="hidden" name="submitted" id="submitted" value="true">

				<div class="uk-margin uk-margin-large-top uk-padding-small">
					<button type="submit" class="uk-button uk-button-yoomee uk-button-yoomee-shop"><?php pll_e('Valider' , 'yoomee'); ?></button>
				</div>
			</form>
		</div>
	</div>

<?php get_footer(); ?>