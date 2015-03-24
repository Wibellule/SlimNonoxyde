<?php

	//APP ADMIN ROUTES
	$router->get('/admin/index', 'Admin@index')->name('indexAdmin');
	$router->get('/admin/users', 'Admin@users')->name('usersAdmin');
	$router->get('/admin/stuffs', 'Admin@stuffs')->name('stuffsAdmin');
