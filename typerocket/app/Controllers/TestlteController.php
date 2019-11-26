<?php
namespace App\Controllers;

use \TypeRocket\Controllers\Controller;
use WP_Query;

class TestlteController extends Controller
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
		    'post_type' => 'testlte',
		    'post_per_page' => '-1',
		    'posts_per_page' => 20,
		    'paged' => $paged
	    );

	    $arg_search = array(
		    'post_type' => 'testlte'
	    );

	    $data = [];

	    if($_GET['action'] == 'search'){

		    $args['meta_query'] = [];
		    $arg_search['meta_query'] = [];

		    if(!empty($_GET['age'])){
			    $data['age'] = $_GET['age'];
			    $arg = array(
				    'key'     => 'age_test_lte',
				    'value'   => $_GET['age'],
				    'compare' => 'LIKE',
			    );
			    array_push($args['meta_query'], $arg);
			    array_push($arg_search['meta_query'], $arg);
		    }
		    if(!empty($_GET['ville'])){
			    $data['ville'] = $_GET['ville'];
			    $arg = array(
				    'key'     => 'ville_test_lte',
				    'value'   => $_GET['ville'],
				    'compare' => '=',
			    );
			    array_push($args['meta_query'], $arg);
			    array_push($arg_search['meta_query'], $arg);
		    }
		    if(!empty($_GET['equipement'])){
			    $data['equipement'] = $_GET['equipement'];
			    $arg = array(
				    'key'     => 'equipement_test_lte',
				    'value'   => $_GET['equipement'],
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

			    $current['Nom du candidat'] = get_the_title();
			    $current['Numéro'] = get_post_meta(get_the_ID(), 'phone_test_lte', true);
			    $current['Email'] = get_post_meta(get_the_ID(), 'email_test_lte', true);
			    $current['Ville'] = get_post_meta(get_the_ID(), 'ville_test_lte', true);
			    $current['Equipement Utilisé'] = get_post_meta(get_the_ID(), 'equipement_test_lte', true);
			    array_push($export, $current);

		    }

		    $filename = "candidat_test_lte_data_" . date('Ymd') . ".xls";

//		    header("Content-Type: text/plain");

		    header("Content-Disposition: attachment; filename=\"$filename\"");
		    header("Content-Type: application/vnd.ms-excel");


		    $flag = false;


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

	    }else {
		    return tr_view( 'testlte.index', [ 'datas' => $query, 'data' => $data, 'result_count' => $query_search ] );
	    }
    }

    /**
     * The add page for admin
     *
     * @return mixed
     */
    public function add()
    {
        // TODO: Implement add() method.
    }

    /**
     * Create item
     *
     * AJAX requests and normal requests can be made to this action
     *
     * @return mixed
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * The edit page for admin
     *
     * @param $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    /**
     * Update item
     *
     * AJAX requests and normal requests can be made to this action
     *
     * @param $id
     *
     * @return mixed
     */
    public function update($id)
    {
        // TODO: Implement update() method.
    }

    /**
     * The show page for admin
     *
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        // TODO: Implement show() method.
    }

    /**
     * The delete page for admin
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Destroy item
     *
     * AJAX requests and normal requests can be made to this action
     *
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

	function cleanData(&$str)
	{
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	}
}