<?php
namespace App\Controllers;

use App\Models\User;

class AdminController extends Controller
{
	protected $app;

	public function index() {
		$this->app->render('Pages/index.html');
	}

	public function users() {

		$page = 1;

		if (!is_null($this->app->request()->get('page'))) {
			$page = $this->app->request()->get('page');
		}

		$oLaboratory = new User ();

		$this->app->render('Admin/User/users.html', array(
			'users' 	=> $oLaboratory->getUsers($page)
		));
	}

	public function contacts() {
		$this->app->render('Pages/contact.html');
	}

	public function contact() {
		$this->app->render('Pages/contact.html');
	}

	public function contactPost() {
		echo "Index::contactPost";
	}


}
