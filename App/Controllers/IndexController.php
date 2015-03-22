<?php
namespace App\Controllers;

class IndexController extends Controller
{
	protected $app;

	public function index() {
		$this->app->render('Front/Pages/index.html');
	}

	public function contacts() {
		$this->app->render('Front/Pages/contacts.html');
	}

	public function contact() {
		$this->app->render('Front/Pages/contact.html');
	}

	public function contactPost() {
		echo "Index::contactPost";
	}

	public function faq() {
		$this->app->render('Front/Pages/faq.html');
	}

	public function terms() {
		$this->app->render('Front/Pages/terms.html');
	}


}
