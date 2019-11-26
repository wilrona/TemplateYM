<?php
namespace App\Controllers;

use App\Models\User;
use \TypeRocket\Controllers\Controller;

class YoochatController extends Controller
{
	public function routing()
	{
		$this->setMiddleware('yoochat');
	}

    /**
     * The index page for admin
     *
     * @return mixed
     */
    public function index()
    {
	    return tr_view('yoochat.index');
    }

    /**
     * Consulter a liste des opérateurs
     *
     * @return mixed
     */
    public function listing_operator()
    {

    	$user = tr_query()->table('wp_users')->setIdColumn('ID');

    	$user = $user->select('wp_users.display_name', 'wp_users.ID')
		    ->distinct()
		    ->join('wp_usermeta', 'wp_usermeta.user_id','wp_users.ID')
		    ->where('wp_usermeta.meta_key','=', 'logged' )
		    ->where('wp_usermeta.meta_value', '=', 1)
		    ->get();

	    return tr_view('yoochat.operator', ['user' => $user]);
    }

	/**
	 * Page de parametrage
	 *
	 * @return mixed
	 */
	public function parametrage()
	{
		return tr_view('yoochat.config');
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
     *:
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
}