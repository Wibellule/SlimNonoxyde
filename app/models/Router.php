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
