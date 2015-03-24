<?php

	//STUFF ROUTES
	$router->get('/stuff', 'Stuff@index')->name('indexStuff');
	$router->post('/stuff', 'Stuff@create')->name('createStuff');
	$router->put('/stuff', 'Stuff@put')->name('putStuff');
	$router->delete('/stuff', 'Stuff@delete')->name('deleteStuff');
