<?php
namespace App\Controllers;

use Facebook\Facebook;
use Facebook\HttpClients\FacebookGuzzleHttpClient;
use \TypeRocket\Controllers\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class ChatbotController extends Controller
{
	function index(){

		return tr_view('chatbot.index');
	}


	/**
	 * Page de parametrage
	 *
	 * @return mixed
	 */
	public function param()
	{
		$request = new \TypeRocket\Http\Request();

		if($request->getFormMethod() === 'PUT'){
			$id = $request->getFields('appid');
			$secret = $request->getFields('appsecret');
			$tokenUser = $request->getFields('tokenuser');
			$post_id = serialize($request->getFields('postID'));

//			var_dump($request->getFields('postID'));
//			die();
			delete_option('postID');
			update_option('postID', $post_id);

			update_option('appID', $id);
			update_option('appSecret', $secret);
			update_option('tokenUser', $tokenUser);
		}

		$me = null;
		$page = null;
		$post = null;

		if(get_option('appSecret') && get_option('appID') && get_option('tokenUser')){

//			$redirectURL = admin_url('admin.php?page=chatbot_param');

			$fb = new Facebook([
				'app_id' => get_option('appID'),
				'app_secret' => get_option('appSecret'),
				'default_graph_version' => 'v2.10'
			]);

//			$helper = $fb->getRedirectLoginHelper();
//			$permissions = ['email'];
//			$loginUrl = $helper->getLoginUrl($redirectURL, $permissions);

			try {
				// Get the \Facebook\GraphNodes\GraphUser object for the current user.
				// If you provided a 'default_access_token', the '{access-token}' is optional.

				$response = $fb->get('/me', get_option('tokenUser'));


//				$res = $client->get('https://graph.facebook.com/v2.10/oauth/access_token?grant_type=fb_exchange_token&client_id='.get_option('appID').'&client_secret='.get_option('appSecret').'&fb_exchange_token='.get_option('tokenUser').'', ['headers' => $header]);


			} catch(\Facebook\Exceptions\FacebookResponseException $e) {
				// When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			} catch(\Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}

			$me = $response->getGraphUser();

			if($me){
				$response_page = $fb->get('/'.$me->getId(), get_option('tokenUser'));

				$page = (array) \GuzzleHttp\json_decode($response_page->getBody());


				$response_post_page = $fb->get('/'.$page['id'].'/posts', get_option('tokenUser'));

				$post = (array) \GuzzleHttp\json_decode($response_post_page->getBody());

//				var_dump($post);
//				die();

			}

		}

		return tr_view('chatbot.config', ['post' => $post, 'page' => $page]);
	}



	/**
	 * Callback appelé par le webhook Facebook
	 *
	 * @return mixed
	 */
	public function webhook(){

		$fb = new Facebook([
			'app_id' => get_option('appID'),
			'app_secret' => get_option('appSecret'),
			'default_graph_version' => 'v2.10'
		]);


		$posts = unserialize(get_option('postID'));

		$test_post = null;
		foreach ($posts as $post){
			if($post != '0'){

				try {
					// Get the \Facebook\GraphNodes\GraphUser object for the current user.
					// If you provided a 'default_access_token', the '{access-token}' is optional.

					$response = $fb->get('/'.$post.'/comments', get_option('tokenUser'));


				} catch(\Facebook\Exceptions\FacebookResponseException $e) {
					// When Graph returns an error
					echo 'Graph returned an error: ' . $e->getMessage();
					exit;
				} catch(\Facebook\Exceptions\FacebookSDKException $e) {
					// When validation fails or other local issues
					echo 'Facebook SDK returned an error: ' . $e->getMessage();
					exit;
				}

				$graphNode_comments = (array) \GuzzleHttp\json_decode($response->getBody());


				foreach ($graphNode_comments['data'] as $comment){

					$user = $comment->from->id;

					var_dump($user);
					try {
						// Get the \Facebook\GraphNodes\GraphUser object for the current user.
						// If you provided a 'default_access_token', the '{access-token}' is optional.
						$messager =['recipient' => ['id' => $user], 'message' => ['text' => 'Mon message frere']];

						$response = $fb->post('/me/messages', $messager, get_option('tokenUser'));


					} catch(\Facebook\Exceptions\FacebookResponseException $e) {
						// When Graph returns an error
						echo 'Graph returned an error: ' . $e->getMessage();
						exit;
					} catch(\Facebook\Exceptions\FacebookSDKException $e) {
						// When validation fails or other local issues
						echo 'Facebook SDK returned an error: ' . $e->getMessage();
						exit;
					}

				}


			}
		}



		return 'true';


	}


}