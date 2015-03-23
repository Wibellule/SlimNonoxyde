<?php
namespace App\Controllers;

use App\Models\Stuff;

class StuffController extends Controller
{
	//protected $app;

	public function index() {
		echo "Stuff::index";

		$oLaboratory = new Stuff ();
		$stuffs = $oLaboratory->getStuffs();

		$this->app->contentType('application/json');
		echo json_encode($stuffs);

	}

	public function create() {
		echo "Stuff::create";

		$stuff = json_decode($app->request()->post('data'), true);
		$oStuff = new Stuff ();
		echo $oStuff->insertStuff($stuff);
	}

	public function put() {
		echo "Stuff::put";
	}

	public function delete() {
		echo "Stuff::delete";
	}


}
