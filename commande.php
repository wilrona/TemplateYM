<?php /* Template Name: Formulaire de commande */ ?>

<?php get_header(); ?>


<?php

if(isset($_POST['submitted'])) {

    $name = '';
    $email = '';
    $phone = '';
    $ville = '';
    $adresse = '';
    $messages = '';

    $ErrorMessage = [];

    if(trim($_POST['nom']) === '') {
        $ErrorMessage[] = pll__('Nom Obligatoire' , 'yoomee').'.';
        $hasError = true;
    } else {
        $name = trim($_POST['nom']);
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

    if(trim($_POST['adresse']) === '') {
        $ErrorMessage[] = pll__('Adresse obligatoire' , 'yoomee').'.';
        $hasError = true;
    } else {
        $adresse = trim($_POST['adresse']);
    }

    if(trim($_POST['message']) !=='') {
        if(function_exists('stripslashes')) {
            $messages = stripslashes(trim($_POST['comments']));
        } else {
            $messages = trim($_POST['comments']);
        }
    }

    $type_livraison = $_POST['type_livraison'];

    $know = $_POST['know'];

    if(!isset($hasError)) {

        $infoline = pods( 'information_entreprise' );

        $emailTo = $infoline->field('email_commande');
        if (!isset($emailTo) || ($emailTo == '') ){
            $emailTo = get_option('admin_email');
        }
        $subject = '[Commande sur le site Yoomee] From '.$name;
        $body = "Nom du client : $name \n";
        $body .= "Adesse Email: $email \n";
        $body .= "Numero de telephone: $phone \n";
        $body .= "Ville : $ville \n";
        $body .= "Adresse complete : $adresse \n";
        $body .= "Message  : $messages \n";
        if($type_livraison == 'achat'){
            $body .= 'Le client viendra faire l\'achat en point de vente  \n';
        }else{
            $body .= 'Le client souhaite une livraison à domicile \n';
        }

        $body .= "Le client nous connais : $know \n";

        $headers = 'From: '.$name.' <'.$emailTo.'>' . 'rn' . 'Reply-To: ' . $email;

        wp_mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }
}


?>

<?php if (have_posts()) : while (have_posts()) : the_post();

    $page_id = $post->ID;

endwhile; endif; ?>

<?php

if(!isset($_GET['id_produit']) && empty($_GET['id_produit'])){

?>

<script>
    window.location.replace("<?= get_permalink('62') ?>");
</script>

<?php
    exit;
}

$post = get_post($_GET['id_produit'] );

?>




<div class="uk-section uk-section-medium uk-section-service">
    <div class="uk-container uk-container-small">
        <form class="uk-form-horizontal uk-margin-large" action="<?php get_the_permalink($page_id) ?>" method="post">

            <div class="uk-margin uk-margin-medium-bottom" uk-grid>
                <div class="uk-width-1-4">
                    <?=  get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => '' ) );?>
                </div>
                <div class="uk-width-3-4">
                    <h1 class=""><?= get_the_title(get_the_ID()) ?></h1>
                    <div class="uk-width-1-1 uk-height-small">

	                    <?= $post->post_content; ?>


                        <?php $promo = get_post_meta($post->ID, 'activer_promotion', true) ?>

                        <?php if($promo): ?>
                            <span class=" uk-display-block uk-h3 uk-margin-remove uk-text-yoomee">Prix promotionnel : <?= get_post_meta($post->ID, 'prix_promo', true) ?> FCFA</span>
                            <span class="uk-h4">Prix : <del><small><?= get_post_meta($post->ID, 'prix', true) ?> FCFA</small></del></span>
                        <?php else: ?>
                            <span class=" uk-display-block">Prix : <?= get_post_meta($post->ID, 'prix', true) ?> FCFA
                        <?php endif; ?>

                    </div>
                </div>
                <?php if(isset($emailSent) && $emailSent == true) { ?>
                    <div class="uk-width-1-1">
                        <div class="uk-alert-success" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p><?php pll_e('Votre Précommande a été pris en compte.' , 'yoomee'); ?></p>
                        </div>
                    </div>
                    <script>
                        setTimeout(function() {
                            window.location.replace("<?= get_permalink('62') ?>");
                        }, 2000);
                    </script>

                <?php } else { ?>
                    <?php if(isset($hasError)) { ?>
                        <div class="uk-width-1-1">
                            <?php foreach ($ErrorMessage as $Error): ?>
                            <div class="uk-alert-danger" uk-alert>
                                <a class="uk-alert-close" uk-close></a>
                                <p><?= $Error ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>

                    <?php } ?>
                <?php } ?>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Nom' , 'yoomee'); ?> : </label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" name="nom">
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
                    <input type="text" class="uk-input" name="ville">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Addresse complete' , 'yoomee'); ?> : </label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" name="adresse">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-horizontal-select"><?php pll_e('Message' , 'yoomee'); ?>  : </label>
                <div class="uk-form-controls">
                    <textarea name="message" id="" cols="30" rows="10" class="uk-textarea"></textarea>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-form-controls">
                    <label><input class="uk-radio" type="radio" name="type_livraison" value="achat" checked> <?php pll_e('Achat dans un point de vente' , 'yoomee'); ?> </label><br>
                    <label><input class="uk-radio" type="radio" name="type_livraison" value="livraison"> <?php pll_e('Livraison à domicile' , 'yoomee'); ?></label>
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-select"><?php pll_e('Comment connaissez vous yoomee ?' , 'yoomee'); ?></label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="form-stacked-select" name="know">
                        <option>-- Selection --</option>
                        <option value="Sur le web"><?php pll_e('Sur le web' , 'yoomee'); ?></option>
                        <option value="A la télévision"><?php pll_e('A la télévision' , 'yoomee'); ?></option>
                        <option value="Par la presse ecrite"><?php pll_e('Par la presse ecrite' , 'yoomee'); ?></option>
                        <option value="Par un ami"><?php pll_e('Par un ami' , 'yoomee'); ?></option>
                        <option value="Autres"><?php pll_e('Autres' , 'yoomee'); ?></option>
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
