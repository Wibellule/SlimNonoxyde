<?php
namespace App\Controllers;

class IndexController extends Controller
{
	protected $app;

	public function index() {
		$this->app->render('front/pages/index.html');
	}

	public function contacts() {
		$this->app->render('front/pages/contacts.html');
	}

	public function contact() {
		$this->app->render('front/pages/contact.html');
	}

	public function contactPost() {
		echo "Index::contactPost";
	}

	public function faq() {
		$this->app->render('front/pages/faq.html');
	}

	public function terms() {
		$this->app->render('front/pages/terms.html');
	}


}
