<?php
namespace App\Controllers;

use App\Models\User;

class UserController extends Controller
{
	//protected $app;

	public function index() {
		echo "User::index";

		$oLaboratory = new User ();
		$users = $oLaboratory->getUsers();

		$this->app->contentType('application/json');
		echo json_encode($users);

	}

	public function create() {

		$user = $this->app->request()->post('data');
		$error = false;

		foreach ($user as $fieldValue) {
			if (empty($fieldValue)) {
				$this->app->flash('error', 'all fields are required');
				$error = true;
				break;
			}
		}

		if (!$error) {
			$user['password'] = hash("sha1", $user['password']);

			$oUser = new User ();
			if ($oUser->insertUser($user)) {
				$this->app->flash('success', 'user successfully added');
			} else {
				$this->app->flash('error', 'error when addind a user');
			}
		}

		$this->app->response->redirect($this->app->urlFor('usersAdmin'), 303);
	}

	public function login() {
		echo "User::login";

		//var_dump($app->request()->post('data'));
		$data = json_decode($app->request()->post('data'), true);

		//echo $data['password'];
		$email = $data['email'];
		$pass = hash("sha1", $data['password']);
		//echo "  despues: ".$pass. "   ";

		$oUser = new User();

		echo json_encode($oUser->getUserByLogin($email, $pass), true);
	}

	public function update() {
		echo "User::update";
	}

	public function delete() {
		$idUser = $this->app->request()->get('id');
		$error = false;

		if (empty($idUser)) {
			$this->app->flash('error', 'wrong request');
			$error = true;
		}

		if (!$error) {
			$oUser = new User ();
			if ($oUser->deleteUser($idUser)) {
				$this->app->flash('success', 'user successfully removed');
			} else {
				$this->app->flash('error', 'error when removing a user');
			}
		}


		$this->app->response->redirect($this->app->urlFor('usersAdmin'), 303);
	}

	public function register() {
		$this->app->render('Front/User/Register.html', array(
			'actionUrl' => $this->app->urlFor('registerPostUser')
		));
	}


}
