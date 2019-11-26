<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 08/11/2017
 * Time: 11:41
 */
?>


<ul class="subsubsub">
	<li class="all"><a href="" class="current">Total résultat <span class="count">(<?= $result_count->post_count; ?>)</span></a> |</li>
</ul>
<div class="tablenav top">
	<form method="get" action="">
		<input type="hidden" name="page" value="testlte_index">
		<input type="hidden" name="action" value="search">
		<div class="alignleft actions">
			<select name="age">
				<option selected="selected" value="">Tranche d'age</option>
				<option value="tranche_18_25" <?php if (esc_html(@$data['age']) == 'tranche_18_25'): ?> selected <?php endif;?>>18 - 25</option>
				<option value="tranche_26_30" <?php if (esc_html(@$data['age']) == 'tranche_26_30'): ?> selected <?php endif;?>>26 - 30</option>
				<option value="tranche_31_35" <?php if (esc_html(@$data['age']) == 'tranche_31_35'): ?> selected <?php endif;?>>31 - 35</option>
				<option value="tranche_35_More" <?php if (esc_html(@$data['age']) == 'tranche_35_More'): ?> selected <?php endif;?>>Plus de 35</option>

			</select>
		</div>
		<div class="alignleft actions">
			<select name="ville">
				<option selected="selected" value="">Ville de residence</option>
				<option value="Douala" <?php if (esc_html(@$data['ville']) == 'Douala'): ?> selected <?php endif;?>>Douala</option>
				<option value="Yaoundé" <?php if (esc_html(@$data['ville']) == 'Yaoundé'): ?> selected <?php endif;?>>Yaoundé</option>
				<option value="Garoua" <?php if (esc_html(@$data['ville']) == 'Garoua'): ?> selected <?php endif;?>>Garoua</option>
				<option value="Bafoussam" <?php if (esc_html(@$data['ville']) == 'Bafoussam'): ?> selected <?php endif;?>>Bafoussam</option>
				<option value="Autres" <?php if (esc_html(@$data['ville']) == 'Autres'): ?> selected <?php endif;?>>Autres</option>
			</select>
		</div>

		<div class="alignleft actions">
			<select name="equipement">
				<option selected="selected" value="">Type d'equipement</option>
				<option value="equipement_1" <?php if (esc_html(@$data['equipement']) == 'equipement_1'): ?> selected <?php endif;?>>Smartphone, tablette</option>
				<option value="equipement_2" <?php if (esc_html(@$data['equipement']) == 'equipement_2'): ?> selected <?php endif;?>>Routeur mobile Mi-Fi</option>
				<option value="equipement_3" <?php if (esc_html(@$data['equipement']) == 'equipement_3'): ?> selected <?php endif;?>>Routeur fixe (Box)</option>
				<option value="equipement_4" <?php if (esc_html(@$data['equipement']) == 'equipement_4'): ?> selected <?php endif;?>>Je n’ai pas d’équipement 4G</option>
			</select>
		</div>

		<div class="alignleft actions">
			<button type="submit" class="button">Filter</button>
		</div>
	</form>

</div>

<div class="tablenav top">

	<div class="alignleft actions">
		<a class="button" href="<?= $_SERVER['REQUEST_URI']; ?>&export=1" target="_blank">Expoter le resultat</a>
	</div>

</div>


<table class="wp-list-table widefat fixed striped pages">
	<thead>
	<tr>
		<td id="cb" class="manage-column column-cb check-column">
			<label class="screen-reader-text" for="cb-select-all-1">Tout sélectionner</label>
			<input id="cb-select-all-1" type="checkbox">
		</td>
		<th scope="col" id="title" class="manage-column column-title column-primary sortable desc ui-sortable">
			<a href="" class="ui-sortable-handle">
				<span>Nom du candidat</span><span class="sorting-indicator"></span>
			</a>
		</th>
		<th scope="col" id="title" class="manage-column column-title column-primary sortable desc ui-sortable">
			<a href="" class="ui-sortable-handle">
				<span>Email</span><span class="sorting-indicator"></span>
			</a>
		</th>
		<th scope="col" id="title" class="manage-column column-title column-primary sortable desc ui-sortable">
			<a href="" class="ui-sortable-handle">
				<span>Téléphone</span><span class="sorting-indicator"></span>
			</a>
		</th>
		<th scope="col" id="title" class="manage-column column-title column-primary sortable desc ui-sortable">
			<a href="" class="ui-sortable-handle">
				<span>Date de soumission</span><span class="sorting-indicator"></span>
			</a>
		</th>
	</tr>
	</thead>
	<tbody>
	<?php
	if($datas->have_posts()):
		while ( $datas->have_posts() ) : $datas->the_post(); ?>

			<tr id="post-<?php the_ID() ?>" class="iedit author-self level-0 post-<?php the_ID() ?> type-page status-publish hentry">
				<th scope="row" class="check-column">
					<input id="cb-select-<?php the_ID() ?>" type="checkbox" name="post[]" value="<?php the_ID() ?>">
				</th>
				<td class="title column-title has-row-actions column-primary page-title" data-colname="Titre">
					<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
					<strong><?= get_the_title(); ?></strong>

				</td>
				<td>
					<?= get_post_meta(get_the_ID(), 'email_test_lte', true); ?>
				</td>
				<td>
					<?= get_post_meta(get_the_ID(), 'phone_test_lte', true); ?>
				</td>
				<td>
					<?php
					$date = get_the_date('Y-m-d H:i:s');
					if(!ctype_digit($date))
						$date = strtotime($date);
					if(date('Ymd', $date) == date('Ymd')){
						$diff = time() - $date;
						if($diff < 60) /* moins de 60 secondes */
							echo 'Il y a quelque instant';
						else if($diff < 3600) /* moins d'une heure */
							echo 'Il y a '.round($diff/60, 0).' min';
						else if($diff < 10800) /* moins de 3 heures */
							echo 'Il y a '.round($diff/3600, 0).' heures';
						else /*  plus de 3 heures ont affiche ajourd'hui à HH:MM:SS */
							echo 'Aujourd\'hui à '.date('H:i:s', $date);
					}
					else if(date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY')))
						echo 'Hier à '.date('H:i:s', $date);
					else if(date('Ymd', $date) == date('Ymd', strtotime('- 2 DAY')))
						echo 'Il y a 2 jours à '.date('H:i:s', $date);
					else
						echo 'Le '.date('d/m/Y à H:i:s', $date);
					?>
				</td>
			<tr>
		<?php endwhile;?>

	<?php else: ?>
		<tr>
			<td colspan="6">
				<h1 style="text-align: center;">Aucun CV trouvé</h1>
			</td>
		</tr>

	<?php endif; ?>
	</tbody>
</table>
<?php
$paged = isset( $_GET['paged'] ) ? absint( $_GET['paged'] ) : 1;

$page_links = paginate_links( array(
	'base' => add_query_arg( 'paged', '%#%' ),
	'format' => '',
	'prev_text' => __( '&laquo;', 'text-domain' ),
	'next_text' => __( '&raquo;', 'text-domain' ),
	'total' => $datas->max_num_pages,
	'current' => $paged
) );

if ( $page_links ) {
	echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
}

?>
