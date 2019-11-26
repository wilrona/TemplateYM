<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 20/10/2017
 * Time: 10:45
 */

namespace App\Http\Middleware;

use \TypeRocket\Http\Middleware\Middleware;

/**
 * Class AuthAdmin
 *
 * Authenticate user as administrator and if the user is not
 * invalidate the response.
 *
 * @package TypeRocket\Http\Middleware
 */
class CanEditYooChat extends Middleware
{

	public function handle() {

		if ( ! current_user_can('yoo_op') && ! current_user_can('yoo_op_manager') && ! current_user_can('administrator') ) {
			$this->response->setError('auth', false);
			$this->response->flashNow( "Sorry, you don't have enough rights. test", 'error' );
			$this->response->exitAny(401);
		}

		$this->next->handle();
	}

}