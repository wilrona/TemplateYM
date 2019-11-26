<?php
namespace App\Controllers;

use \TypeRocket\Controllers\Controller;
use WP_Query;

class CvController extends Controller
{



    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function index()
    {
        // TODO: Implement index() method.

	    $paged = $_GET['paged'];

	    $args = array(
	    	'post_type' => 'resume',
		    'post_per_page' => '-1',
		    'posts_per_page' => 20,
		    'paged' => $paged
	    );

	    $arg_search = array(
		    'post_type' => 'resume'
	    );

		$data = [];

	    if($_GET['action'] == 'search'){

	    	$args['meta_query'] = [];
		    $arg_search['meta_query'] = [];

		    if(!empty($_GET['application_name'])){
			    $data['application_name'] = $_GET['application_name'];
		    	$arg = array(
				    'key'     => 'first_name',
				    'value'   => $_GET['application_name'],
				    'compare' => 'LIKE',
			    );
			    array_push($args['meta_query'], $arg);
			    array_push($arg_search['meta_query'], $arg);
		    }
		    if(!empty($_GET['application_competence'])){
			    $data['application_competence'] = $_GET['application_competence'];
			    $arg = array(
				    'key'     => 'skills',
				    'value'   => $_GET['application_competence'],
				    'compare' => 'LIKE',
			    );
			    array_push($args['meta_query'], $arg);
			    array_push($arg_search['meta_query'], $arg);
		    }
		    if(!empty($_GET['resume_location'])){
		    	$data['resume_location'] = $_GET['resume_location'];
			    $arg = array(
				    'key'     => 'location',
				    'value'   => $_GET['resume_location'],
				    'compare' => '=',
			    );
			    array_push($args['meta_query'], $arg);
			    array_push($arg_search['meta_query'], $arg);
		    }
		    if(!empty($_GET['resume_role'])){
			    $data['resume_role'] = $_GET['resume_role'];
			    $arg = array(
				    'key'     => 'role',
				    'value'   => $_GET['resume_role'],
				    'compare' => '=',
			    );

			    array_push($args['meta_query'], $arg);
			    array_push($arg_search['meta_query'], $arg);
		    }
		    if(!empty($_GET['job_id'])){
			    $data['job_id'] = $_GET['job_id'];
			    $arg = array(
				    'key'     => 'job_id',
				    'value'   => $_GET['job_id'],
				    'compare' => '=',
			    );

			    array_push($args['meta_query'], $arg);
			    array_push($arg_search['meta_query'], $arg);
		    }
	    }

	    $query = new WP_Query( $args );

	    $query_search = new WP_Query( $arg_search );

	    if($_GET['export']){

	    	$export = [];




			while ( $query_search->have_posts() ) {

					$query_search->the_post();
					$current = [];

					$current['Nom du candidat'] = get_post_meta(get_the_ID(), 'first_name', true);
					$current['Numéro'] = get_post_meta(get_the_ID(), 'last_name', true);
					$current['Email'] = get_post_meta(get_the_ID(), 'email', true);
					$current['Ville'] = get_post_meta(get_the_ID(), 'location', true);
					$current['Niveau de compétence'] = get_post_meta(get_the_ID(), 'role', true);
					array_push($export, $current);

			}

		    $filename = "candidat_data_" . date('Ymd') . ".xls";

//		    header("Content-Type: text/plain");

		    header("Content-Disposition: attachment; filename=\"$filename\"");
		    header("Content-Type: application/vnd.ms-excel");


		    $flag = false;
		    if(!empty($_GET['job_id'])){
		    	$le_poste = get_post($_GET['job_id']);

			    echo "POSTE : ".$le_poste->post_title."\r\n";
		    }

		    foreach($export as $row) {
			    if(!$flag) {
				    // display field/column names as first row
				    echo implode("\t", array_keys($row)) . "\r\n";
				    $flag = true;
			    }
			    array_walk($row, $this->cleanData());
			    echo implode("\t", array_values($row)) . "\r\n";
		    }
		    exit;

	    }else{

		    $args_poste = array(
			    'post_type' => 'job_listing',
			    'post_per_page' => '-1',
		    );
		    $query_poste = new WP_Query( $args_poste );


		    return tr_view('CV.index', ['datas' => $query, 'data' => $data, 'result_count' => $query_search, 'poste' => $query_poste]);

	    }



    }

	function cleanData(&$str)
	{
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	}





}