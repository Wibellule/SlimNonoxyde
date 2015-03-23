<?php
namespace App\Models;

class Router {
	//  Slim Framework
	protected $app;

	protected $controllersNamespace = 'App\Controllers\\';

	/*
	**  Constructeur
	*/
	public function __construct($app)
	{
		$this->app = $app;

		//APP FRONT ROUTES
		$this->get('/', 'Index@index')->name('indexIndex');
		$this->get('/contacts', 'Index@contacts')->name('contactsIndex');
		$this->get('/contact', 'Index@contact')->name('contactIndex');
		$this->post('/contact', 'Index@contactPost')->name('contactPostIndex');
		$this->get('/faq', 'Index@faq')->name('faqIndex');
		$this->get('/terms', 'Index@terms')->name('termsIndex');

		//APP ADMIN ROUTES
		$this->get('/admin/index', 'Admin@index')->name('indexAdmin');
		$this->get('/admin/users', 'Admin@users')->name('usersAdmin');
		$this->get('/admin/stuffs', 'Admin@stuffs')->name('stuffsAdmin');

		//USER ROUTES
		$this->post('/login', 'User@login')->name('loginUser');
		$this->get('/user', 'User@index')->name('indexUser');
		$this->put('/user', 'User@put')->name('putUser');
		$this->put('/user', 'User@create')->name('createUser');
		$this->delete('/user', 'User@delete')->name('deleteUser');
		$this->get('/register', 'User@register')->name('registerUser');
		$this->post('/register', 'User@registerPost')->name('registerPostUser');
		$this->get('/catalog', 'User@catalog')->name('catalogUser');

		//NOTIFICATION ROUTES
		$this->get('/notification', 'Notification@index')->name('indexNotification');

		//MESSAGES ROUTES
		$this->get('/message', 'Message@index')->name('indexMessage');

		//STUFF ROUTES
		$this->get('/stuff', 'Stuff@index')->name('indexStuff');
		$this->post('/stuff', 'Stuff@create')->name('createStuff');
		$this->put('/stuff', 'Stuff@put')->name('putStuff');
		$this->delete('/stuff', 'Stuff@delete')->name('deleteStuff');
	}

	/*
	**  Function permettant d'apper une méthode du router, et
	**  de retourner le controller associé
	**  ------------
	**  @method : méthode utilisée de Slim (post|get)
	**  @$url : url de l'action (controller)
	**  @$action : action du controller
	**  @$param : paramètre variable (id, etc)
	*/
	public function call($method, $url, $action, $param = NULL)
	{
		if( $param == NULL )
		{
			return $this->app->$method($url, function() use ($action)
			{
				$action = explode('@', $action);
				$controller_name = $action[0] . 'Controller';
				$method = $action[1];

				$class = $this->controllersNamespace.$controller_name;

				$controller = new $class($this->app);
				call_user_func_array(array($controller, $method), func_get_args());
			});
		}
		else
		{
			return $this->app->$method($url, function($param) use ($action)
			{
				$action = explode('@', $action);
				$controller_name = $action[0] . 'Controller';
				$method = $action[1];

				$class = $this->controllersNamespace.$controller_name;

				$controller = new $class($this->app);
				call_user_func_array(array($controller, $method), func_get_args($param));
			});
		}
	}

	/*
	**  Alias GET de la fonction call
	*/
	public function get($url, $action, $param = NULL)
	{
		return $this->call('get', $url, $action, $param);
	}

	/*
	**  Alias POST de la fonction call
	*/
	public function post($url, $action, $param = NULL)
	{
		return $this->call('post', $url, $action, $param);
	}

	/*
	**  Alias POST de la fonction call
	*/
	public function put($url, $action, $param = NULL)
	{
		return $this->call('put', $url, $action, $param);
	}

	/*
	**  Alias POST de la fonction call
	*/
	public function delete($url, $action, $param = NULL)
	{
		return $this->call('delete', $url, $action, $param);
	}

}
