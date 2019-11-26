
<?php
//if(!is_front_page()): ?>

<div class="uk-section uk-header-bottom-yoomee uk-padding-remove-bottom">
    <div class="uk-container">
        <div class="uk-child-width-1-4@s" uk-grid>
            <div>
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.png" alt="" class="uk-display-block uk-margin-auto">
            </div>
            <div>
                <h3 class="uk-margin-remove"><?php pll_e('Découvrez Yoomee' , 'yoomee'); ?></h3>

                <ul class="uk-list">
                    <li><a href="<?php echo esc_url( get_page_link( pll_get_post('12') ) ); ?>"><?php pll_e('Qui sommes nous ?' , 'yoomee'); ?></a></li>
                    <li><a href="<?php echo esc_url( get_page_link( pll_get_post('98') ) ); ?>"><?php pll_e('Blog' , 'yoomee'); ?></a></li>
                    <li><a href="<?php echo esc_url( get_page_link( pll_get_post('123') ) ); ?>"><?php pll_e('Emploi' , 'yoomee'); ?></a></li>
                    <li><a href="<?php echo esc_url( get_page_link( pll_get_post('96') ) ); ?>"><?php pll_e('Contactez-Nous' , 'yoomee'); ?></a></li>
                </ul>
            </div>
            <?php

                if (get_child_pages_by_parent_title(pll_get_post('21'))):

            ?>
            <div>
                <h3 class="uk-margin-remove"><?php pll_e('Internet' , 'yoomee'); ?></h3>

                <ul class="uk-list">
                    <?php foreach (get_child_pages_by_parent_title(pll_get_post('21')) as $page): ?>
                        <li><a href="<?php echo esc_url( get_page_link( pll_get_post($page->ID) ) ); ?>"><?= $page->post_title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
	        <?php

	        if (get_child_pages_by_parent_title(pll_get_post('23'))):

	        ?>
            <div>
                <h3 class="uk-margin-remove"><?php pll_e('Téléphonie' , 'yoomee'); ?></h3>

                <ul class="uk-list">
                    <?php foreach (get_child_pages_by_parent_title(pll_get_post('23')) as $page): ?>
                        <li><a href="<?php echo esc_url( get_page_link( pll_get_post($page->ID) ) ); ?>"><?= $page->post_title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php
                endif;
            ?>
        </div>
    </div>
    <div class="uk-container uk-container-large uk-margin-top uk-margin-bottom">
        <hr>
        <div class="uk-child-width-1-1" uk-grid>
            <div class="uk-width-1-1">
                <ul class="uk-subnav uk-flex-right" uk-margin>
                    <?php
                        $reseaux = pods( 'information_entreprise' );
                    ?>
                    <li>
                        <a href="<?= $reseaux->field('facebook') ?>" target="_blank" uk-icon="icon: facebook; ratio: 1"></a>
                    </li>
                    <li>
                        <a href="<?= $reseaux->field('twitter') ?>" target="_blank" uk-icon="icon: twitter; ratio: 1"></a>
                    </li>
                    <li>
                        <a href="<?= $reseaux->field('linkedin') ?>" target="_blank" uk-icon="icon: linkedin; ratio: 1"></a>
                    </li>
                    <li>
                        <a href="<?= $reseaux->field('instagram') ?>" target="_blank" uk-icon="icon: instagram; ratio: 1"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php //endif; ?>

<!-- This is the modal 1-->
<div id="modal" uk-modal="center: true">
    <div class="uk-modal-dialog" uk-overflow-auto>
        <div class="uk-body-custom">
                <div class="uk-text-center uk-height-1-1 uk-flex-middle uk-padding">
                    <div uk-spinner></div>
                    <h1 style="color: #000;" class="uk-margin-remove"><?php pll_e('Chargement' , 'yoomee'); ?></h1>
                </div>
        </div>
    </div>
</div>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-105342980-1', 'auto');
    ga('send', 'pageview');

</script>

<script>
    var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";

    jQuery(function($) {
        $('body').on('click', '.add_panier_other', function(e) {
            e.preventDefault();
            var data = {
                'action': 'load_panier_by_ajax',
                'security': '<?php echo wp_create_nonce("load_more_panier"); ?>',
                'current_post' : $(this).attr('id'),
                'type': 'other'
            };

            $.post(ajaxurl, data, function(response) {
                window.location.replace(response);
            });
        });


    });

    jQuery(function($) {
        $('body').on('click', '.add_panier', function(e) {
            e.preventDefault();
            var data = {
                'action': 'load_panier_by_ajax',
                'security': '<?php echo wp_create_nonce("load_more_panier"); ?>',
                'current_post' : $(this).attr('id'),
                'current_url' : window.location.href,
                'type': 'current'
            };

            $.post(ajaxurl, data, function(response) {
                window.location.replace(response);
            });
        });


    });

    jQuery(function($) {
        $('body').on('click', '.remove_product', function(e) {
            e.preventDefault();
            var data = {
                'action': 'load_panier_by_ajax',
                'security': '<?php echo wp_create_nonce("load_more_panier"); ?>',
                'current_post' : $(this).attr('id'),
                'current_url' : window.location.href,
                'type': 'remove_product'
            };

            $.post(ajaxurl, data, function(response) {
                window.location.replace(response);
            });
        });


    });

    jQuery(function($) {
        $('body').on('click', '.update_cart', function(e) {
            e.preventDefault();

            quantite = [];
            id = [];

            $("input.qty").each(function() {
                quantite.push($(this).val());
                id.push($(this).attr('id'))
            });

            var data = {
                'action': 'load_panier_by_ajax',
                'security': '<?php echo wp_create_nonce("load_more_panier"); ?>',
                'current_url' : window.location.href,
                'type': 'update_qte_product',
                'quantite' : quantite,
                'id': id
            };

            $.post(ajaxurl, data, function(response) {
                window.location.replace(response);
            });
        });


    });

    jQuery(function($) {
        $('body').on('click', '.apply_coupon', function(e) {
            e.preventDefault();

            $input = $("input#coupon_code").val();

            var data = {
                'action': 'load_panier_by_ajax',
                'security': '<?php echo wp_create_nonce("load_more_panier"); ?>',
                'current_url' : window.location.href,
                'type': 'ckeck_coupon',
                'input' : $input,
            };

            $.post(ajaxurl, data, function(response) {
                window.location.replace(response);
            });
        });


    });
</script>


<?php wp_footer(); ?>

</body>
</html>
