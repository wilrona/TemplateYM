<?php /* Template Name: buy */ ?>

<?php

if(!isset($_GET['id_produit']) && empty($_GET['id_produit'])){

    ?>
    <script>
        window.location.replace("<?= get_permalink(pll_get_post('62')) ?>");
    </script>

<?php
    exit;
}

$post = get_post( $_GET['id_produit'] );

?>

<button class="uk-modal-close-default" type="button" uk-close></button>
<div class="uk-modal-header uk-background-yoomee-black">
    <h2 class="uk-modal-title uk-text-yoomee-2"><?php pll_e('Obtenir ce produit' , 'yoomee'); ?> </h2>
</div>
<div class="uk-modal-body">
    <h1 class="uk-heading-bullet uk-heading-bullet uk-text-yoomee"><?= $post->post_title ?></h1>
    <?php $service = get_post_meta($post->ID, 'type_service', true) ?>
    <table class="uk-table uk-table-divider">
        <tbody>
        <?php if($service == 'code'): ?>
            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: credit-card;"></span> <a href="<?= get_permalink(pll_get_post('190')) ?>" class="uk-button uk-button-text uk-button-text-yoomee" target="_blank"> <?php pll_e('Comment recharger votre credit de communication ?' , 'yoomee'); ?></a></td>
            </tr>
            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: location;"></span> <a href="<?= get_permalink(pll_get_post('142')) ?>" class="uk-button uk-button-text uk-button-text-yoomee" target="_blank"> <?php pll_e('Besoin d\'aide : Localisez une agence' , 'yoomee'); ?></a></td>
            </tr>
            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: code;"></span> <strong class="uk-margin-large-left uk-text-lead"><?= get_post_meta($post->ID, 'code', true) ?></strong></td>
            </tr>
        <?php endif; ?>


        <?php if($service == 'carte'): ?>
            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: location;"></span> <a href="<?= get_permalink(pll_get_post('142')) ?>" class="uk-button uk-button-text uk-button-text-yoomee" target="_blank"> <?php pll_e('Ou obtenir votre carte de recharge ?' , 'yoomee'); ?></a></td>
            </tr>
            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: credit-card;"></span> <a href="<?= get_permalink(pll_get_post('192')) ?>" class="uk-button uk-button-text uk-button-text-yoomee" target="_blank"> <?php pll_e('Comment recharger votre connexion internet ?' , 'yoomee'); ?></a></td>
            </tr>
        <?php endif; ?>

        <?php if($service == 'modem'): ?>
            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: location;"></span> <a href="<?= get_permalink(pll_get_post('142')) ?>" class="uk-button uk-button-text uk-button-text-yoomee" target="_blank"> <?php pll_e('Ou obtenir votre modem ?' , 'yoomee'); ?></a></td>
            </tr>
            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: credit-card;"></span> <a href="<?= get_permalink(pll_get_post('192')) ?>" class="uk-button uk-button-text uk-button-text-yoomee" target="_blank"> <?php pll_e('Comment recharger votre connexion internet ?' , 'yoomee'); ?></a></td>
            </tr>
        <?php endif; ?>

        <?php if($service == 'telephone'): ?>
            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: location;"></span> <a href="<?= get_permalink(pll_get_post('142')) ?>" class="uk-button uk-button-text uk-button-text-yoomee" target="_blank"> <?php pll_e('Ou obtenir votre téléphone ?' , 'yoomee'); ?></a></td>
            </tr>
            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: credit-card;"></span> <a href="<?= get_permalink(pll_get_post('190')) ?>" class="uk-button uk-button-text uk-button-text-yoomee" target="_blank"> <?php pll_e('Comment recharger votre credit de communication ?' , 'yoomee'); ?></a></td>
            </tr>
        <?php endif; ?>

        <?php if($service == 'FI'): ?>
            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: credit-card;"></span> <a href="<?= get_permalink(pll_get_post('4734')) ?>" class="uk-button uk-button-text uk-button-text-yoomee" target="_blank"> <?php pll_e('Comment recharger votre forfait LTE de YooMee ?' , 'yoomee'); ?></a></td>
            </tr>

            <tr>
                <td><span class="uk-margin-medium-right" uk-icon="icon: location;"></span> <a href="<?= get_permalink(pll_get_post('142')) ?>" class="uk-button uk-button-text uk-button-text-yoomee" target="_blank"> <?php pll_e('Besoin d\'aide : Localisez une agence' , 'yoomee'); ?></a></td>
            </tr>

        <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="uk-modal-footer uk-text-right">
    <?php if($service != 'code' && $service != 'FI'): ?>
        <a href="<?php echo esc_url( get_page_link( pll_get_post('79')) ); ?>?id_produit=<?= $post->ID ?>" class="uk-button uk-button-yoomee uk-button-yoomee-shop"><?php pll_e('Précommander votre produit' , 'yoomee'); ?></a>
    <?php endif; ?>
    <button class="uk-button uk-button-text uk-button-text-yoomee uk-margin-right uk-margin-left uk-modal-close" type="button"><?php pll_e('Fermer' , 'yoomee'); ?></button>

</div>
