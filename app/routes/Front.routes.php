<?php

	//APP FRONT ROUTES
	$router->get('/', 'Index@index')->name('indexIndex');
	$router->get('/contacts', 'Index@contacts')->name('contactsIndex');
	$router->get('/contact', 'Index@contact')->name('contactIndex');
	$router->post('/contact', 'Index@contactPost')->name('contactPostIndex');
	$router->get('/faq', 'Index@faq')->name('faqIndex');
	$router->get('/terms', 'Index@terms')->name('termsIndex');
	$router->get('/notification', 'Notification@index')->name('indexNotification');
	$router->get('/message', 'Message@index')->name('indexMessage');
