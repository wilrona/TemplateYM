<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 29/09/2017
 * Time: 11:19
 */


?>
<ul class="subsubsub">
	<li class="all"><a href="" class="current">Total résultat <span class="count">(<?= $result_count->post_count; ?>)</span></a> |</li>
</ul>
<div class="tablenav top">
	<form method="get" action="">
		<input type="hidden" name="page" value="cv_index">
		<input type="hidden" name="action" value="search">
		<div class="alignleft actions ">
			<label for="bulk-action-selector-top" class="screen-reader-text">Sélectionnez l’action groupée</label>
			<input type="text" name="application_name" placeholder="Nom" value="<?php echo $data['application_name']; ?>">
		</div>
		<div class="alignleft actions">
			<label for="bulk-action-selector-top" class="screen-reader-text">Sélectionnez l’action groupée</label>
			<input type="text" name="application_competence" placeholder="Compétence" value="<?php echo $data['application_competence']; ?>">
		</div>
		<div class="alignleft actions">
			<select name="resume_location">
				<option selected="selected" value="">Ville de residence</option>
				<option value="Douala" <?php if (esc_html(@$data['resume_location']) == 'Douala'): ?> selected <?php endif;?>>Douala</option>
				<option value="Kumba" <?php if (esc_html(@$data['resume_location']) == 'Kumba'): ?> selected <?php endif;?>>Kumba</option>
				<option value="Limbé" <?php if (esc_html(@$data['resume_location']) == 'Limbé'): ?> selected <?php endif;?>>Limbé</option>
				<option value="Buéa" <?php if (esc_html(@$data['resume_location']) == 'Buéa'): ?> selected <?php endif;?>>Buéa</option>
				<option value="Edéa" <?php if (esc_html(@$data['resume_location']) == 'Edéa'): ?> selected <?php endif;?>>Edéa</option>
				<option value="Kribi" <?php if (esc_html(@$data['resume_location']) == 'Kribi'): ?> selected <?php endif;?>>Kribi</option>
				<option value="Nkongsamba" <?php if (esc_html(@$data['resume_location']) == 'Nkongsamba'): ?> selected <?php endif;?>>Nkongsamba</option>
				<option value="Tiko" <?php if (esc_html(@$data['resume_location']) == 'Tiko'): ?> selected <?php endif;?>>Tiko</option>
				<option value="Loum" <?php if (esc_html(@$data['resume_location']) == 'Loum'): ?> selected <?php endif;?>>Loum</option>
				<option value="Manfe" <?php if (esc_html(@$data['resume_location']) == 'Manfe'): ?> selected <?php endif;?>>Manfe</option>
				<option value="Melong" <?php if (esc_html(@$data['resume_location']) == 'Melong'): ?> selected <?php endif;?>>Melong</option>
				<option value="Manjo" <?php if (esc_html(@$data['resume_location']) == 'Manjo'): ?> selected <?php endif;?>>Manjo</option>
				<option value="Mbanga" <?php if (esc_html(@$data['resume_location']) == 'Mbanga'): ?> selected <?php endif;?>>Mbanga</option>
				<option value="Muyuka" <?php if (esc_html(@$data['resume_location']) == 'Muyuka'): ?> selected <?php endif;?>>Muyuka</option>
				<option value="Tombel" <?php if (esc_html(@$data['resume_location']) == 'Tombel'): ?> selected <?php endif;?>>Tombel</option>
				<option value="Yaoundé" <?php if (esc_html(@$data['resume_location']) == 'Yaoundé'): ?> selected <?php endif;?>>Yaoundé</option>
				<option value="Bertoua" <?php if (esc_html(@$data['resume_location']) == 'Bertoua'): ?> selected <?php endif;?>>Bertoua</option>
				<option value="Bafia" <?php if (esc_html(@$data['resume_location']) == 'Bafia'): ?> selected <?php endif;?>>Bafia</option>
				<option value="Ebolowa" <?php if (esc_html(@$data['resume_location']) == 'Ebolowa'): ?> selected <?php endif;?>>Ebolowa</option>
				<option value="Eséka" <?php if (esc_html(@$data['resume_location']) == 'Eséka'): ?> selected <?php endif;?>>Eséka</option>
				<option value="Mbalmayo" <?php if (esc_html(@$data['resume_location']) == 'Mbalmayo'): ?> selected <?php endif;?>>Mbalmayo</option>
				<option value="Batouri" <?php if (esc_html(@$data['resume_location']) == 'Batouri'): ?> selected <?php endif;?>>Batouri</option>
				<option value="Garoua-Boulai" <?php if (esc_html(@$data['resume_location']) == 'Garoua-Boulai'): ?> selected <?php endif;?>>Garoua-Boulai</option>
				<option value="Abong Bang" <?php if (esc_html(@$data['resume_location']) == 'Abong Bang'): ?> selected <?php endif;?>>Abong Bang</option>
				<option value="Yokadouma" <?php if (esc_html(@$data['resume_location']) == 'Yokadouma'): ?> selected <?php endif;?>>Yokadouma</option>
				<option value="Akonolinga" <?php if (esc_html(@$data['resume_location']) == 'Akonolinga'): ?> selected <?php endif;?>>Akonolinga</option>
				<option value="Obala" <?php if (esc_html(@$data['resume_location']) == 'Obala'): ?> selected <?php endif;?>>Obala</option>
				<option value="Mbandjock" <?php if (esc_html(@$data['resume_location']) == 'Mbandjock'): ?> selected <?php endif;?>>Mbandjock</option>
				<option value="Nkoteng" <?php if (esc_html(@$data['resume_location']) == 'Nkoteng'): ?> selected <?php endif;?>>Nkoteng</option>
				<option value="Nanga Eboko" <?php if (esc_html(@$data['resume_location']) == 'Nanga Eboko'): ?> selected <?php endif;?>>Nanga Eboko</option>
				<option value="Sangmelima" <?php if (esc_html(@$data['resume_location']) == 'Sangmelima'): ?> selected <?php endif;?>>Sangmelima</option>
				<option value="Bafoussam" <?php if (esc_html(@$data['resume_location']) == 'Bafoussam'): ?> selected <?php endif;?>>Bafoussam</option>
				<option value="Bamenda" <?php if (esc_html(@$data['resume_location']) == 'Bamenda'): ?> selected <?php endif;?>>Bamenda</option>
				<option value="Kumbo" <?php if (esc_html(@$data['resume_location']) == 'Kumbo'): ?> selected <?php endif;?>>Kumbo</option>
				<option value="Foumban" <?php if (esc_html(@$data['resume_location']) == 'Foumban'): ?> selected <?php endif;?>>Foumban</option>
				<option value="Dschang" <?php if (esc_html(@$data['resume_location']) == 'Dschang'): ?> selected <?php endif;?>>Dschang</option>
				<option value="Mbouda" <?php if (esc_html(@$data['resume_location']) == 'Mbouda'): ?> selected <?php endif;?>>Mbouda</option>
				<option value="Bafang" <?php if (esc_html(@$data['resume_location']) == 'Bafang'): ?> selected <?php endif;?>>Bafang</option>
				<option value="Bangangté" <?php if (esc_html(@$data['resume_location']) == 'Bangangté'): ?> selected <?php endif;?>>Bangangté</option>
				<option value="Wum" <?php if (esc_html(@$data['resume_location']) == 'Wum'): ?> selected <?php endif;?>>Wum</option>
				<option value="Nkambe" <?php if (esc_html(@$data['resume_location']) == 'Nkambe'): ?> selected <?php endif;?>>Nkambe</option>
				<option value="Ndop" <?php if (esc_html(@$data['resume_location']) == 'Ndop'): ?> selected <?php endif;?>>Ndop</option>
				<option value="Fundong" <?php if (esc_html(@$data['resume_location']) == 'Fundong'): ?> selected <?php endif;?>>Fundong</option>
				<option value="Foumbot" <?php if (esc_html(@$data['resume_location']) == 'Foumbot'): ?> selected <?php endif;?>>Foumbot</option>
				<option value="Garoua" <?php if (esc_html(@$data['resume_location']) == 'Garoua'): ?> selected <?php endif;?>>Garoua</option>
				<option value="Ngaoundéré" <?php if (esc_html(@$data['resume_location']) == 'Ngaoundéré'): ?> selected <?php endif;?>>Ngaoundéré</option>
				<option value="Banyo" <?php if (esc_html(@$data['resume_location']) == 'Banyo'): ?> selected <?php endif;?>>Banyo</option>
				<option value="Meiganga" <?php if (esc_html(@$data['resume_location']) == 'Meiganga'): ?> selected <?php endif;?>>Meiganga</option>
				<option value="Maroua" <?php if (esc_html(@$data['resume_location']) == 'Maroua'): ?> selected <?php endif;?>>Maroua</option>
				<option value="Mokolo" <?php if (esc_html(@$data['resume_location']) == 'Mokolo'): ?> selected <?php endif;?>>Mokolo</option>
				<option value="Guider" <?php if (esc_html(@$data['resume_location']) == 'Guider'): ?> selected <?php endif;?>>Guider</option>
				<option value="Pitoa" <?php if (esc_html(@$data['resume_location']) == 'Pitoa'): ?> selected <?php endif;?>>Pitoa</option>
				<option value="Mora" <?php if (esc_html(@$data['resume_location']) == 'Mora'): ?> selected <?php endif;?>>Mora</option>
				<option value="Kousseri" <?php if (esc_html(@$data['resume_location']) == 'Kousseri'): ?> selected <?php endif;?>>Kousseri</option>
				<option value="Kaele" <?php if (esc_html(@$data['resume_location']) == 'Kaele'): ?> selected <?php endif;?>>Kaele</option>
				<option value="Yagoua" <?php if (esc_html(@$data['resume_location']) == 'Yagoua'): ?> selected <?php endif;?>>Yagoua</option>
				<option value="Tibati" <?php if (esc_html(@$data['resume_location']) == 'Tibati'): ?> selected <?php endif;?>>Tibati</option>
			</select>
			</select>
		</div>
		<div class="alignleft actions">
	        <select name="resume_role">
		        <option selected="selected" value="">Niveau d'étude</option>
		        <option value="Sans diplome" <?php if (esc_html(@$data['resume_role']) == 'Sans diplome'): ?> selected <?php endif;?>>Sans diplome</option>
		        <option value="CEP" <?php if (esc_html(@$data['resume_role']) == 'CEP'): ?> selected <?php endif;?>>CEP (ou équivalent)</option>
		        <option value="BEPC" <?php if (esc_html(@$data['resume_role']) == 'BEPC'): ?> selected <?php endif;?>>BEPC (ou équivalent)</option>
		        <option value="Probatoire" <?php if (esc_html(@$data['resume_role']) == 'Probatoire'): ?> selected <?php endif;?>>Probatoire (ou équivalent)</option>
		        <option value="Bac" <?php if (esc_html(@$data['resume_role']) == 'Bac'): ?> selected <?php endif;?>>Bac (ou équivalent)</option>
		        <option value="Bac +1" <?php if (esc_html(@$data['resume_role']) == 'Bac +1'): ?> selected <?php endif;?>>Bac +1 (ou équivalent)</option>
		        <option value="Bac +2" <?php if (esc_html(@$data['resume_role']) == 'Bac +2'): ?> selected <?php endif;?>>Bac +2 (ou équivalent)</option>
		        <option value="Bac +3" <?php if (esc_html(@$data['resume_role']) == 'Bac +3'): ?> selected <?php endif;?>>Bac +3 (ou équivalent)</option>
		        <option value="Bac +4" <?php if (esc_html(@$data['resume_role']) == 'Bac +4'): ?> selected <?php endif;?>>Bac +4 (ou équivalent)</option>
		        <option value="Bac +5" <?php if (esc_html(@$data['resume_role']) == 'Bac +5'): ?> selected <?php endif;?>>Bac +5 (ou équivalent)</option>
	        </select>
		</div>

        <div class="alignleft actions">
            <select name="job_id">
                <option selected="selected" value="">Par poste mise en ligne</option>
                <?php while ( $poste->have_posts() ) : $poste->the_post() ?>
                    <option <?php if (esc_html(@$data['job_id']) == get_the_ID()): ?> selected <?php endif;?>  value="<?= get_the_ID() ?>"><?= get_the_title() ?></option>
                <?php endwhile; ?>
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
				<span>Ville</span><span class="sorting-indicator"></span>
			</a>
		</th>
		<th scope="col" id="title" class="manage-column column-title column-primary sortable desc ui-sortable">
			<a href="" class="ui-sortable-handle">
				<span>Niveau de compétence</span><span class="sorting-indicator"></span>
			</a>
		</th>
		<th scope="col" id="title" class="manage-column column-title column-primary sortable desc ui-sortable">
			<a href="" class="ui-sortable-handle">
				<span>Télécharger le pdf</span><span class="sorting-indicator"></span>
			</a>
		</th>
        <th>
            <a href="" class="ui-sortable-handle">
                <span>Date de publication</span><span class="sorting-indicator"></span>
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
					<strong><a class="row-title" target="_blank" href="/wp-admin/post.php?post=<?= get_the_ID(); ?>&action=edit"><?= get_post_meta(get_the_ID(), 'first_name', true); ?></a></strong>

				</td>
				<td>
					<?= get_post_meta(get_the_ID(), 'location', true); ?>
				</td>
				<td>
					<?= get_post_meta(get_the_ID(), 'role', true); ?>
				</td>
				<td>
					<?php if(get_post_meta(get_the_ID(), 'file', true)): ?>
					<a href="<?= get_post_meta(get_the_ID(), 'file', true); ?>" download>CV du candidat</a>
					<?php endif; ?>
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




