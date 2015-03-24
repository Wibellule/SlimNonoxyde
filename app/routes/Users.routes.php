<?php

	//USER ROUTES
	$router->post('/login', 'User@login')->name('loginUser');
	$router->get('/user', 'User@index')->name('indexUser');
	$router->put('/user', 'User@put')->name('putUser');
	$router->post('/user', 'User@create')->name('createUser');
	$router->delete('/user', 'User@delete')->name('deleteUser');
	$router->get('/register', 'User@register')->name('registerUser');
	$router->post('/register', 'User@registerPost')->name('registerPostUser');
	$router->get('/catalog', 'User@catalog')->name('catalogUser');
