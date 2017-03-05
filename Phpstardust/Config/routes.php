<?php

//Generic urls
Router::connect('/', array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'homepage'));
Router::promote();
Router::connect('/maintenance-mode', array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'maintenance'));
Router::connect('/upload', array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'upload'));
Router::connect('/install', array('plugin'=>'phpstardust', 'controller' => 'installers', 'action' => 'install'));
Router::connect('/check', array('controller' => 'pages', 'action' => 'display', 'home'));

Router::connect(
	'/delete-image/:model/:id',
	array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'deleteImage'),
	array(
		'pass' => array('model', 'id')
	)
);

//Frontend

Router::connect('/feed', array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'feed'));
Router::connect('/404', array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'page404'));
Router::connect('/infinitescroll', array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'infinitescroll'));

Router::connect(
	'/page/:slug',
	array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'page'),
	array(
		'pass' => array('slug')
	)
);

Router::connect(
	'/post/:slug',
	array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'single'),
	array(
		'pass' => array('slug')
	)
);

Router::connect(
	'/category/:slug',
	array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'category'),
	array(
		'pass' => array('slug')
	)
);

//Users
Router::connect('/dashboard', array('plugin'=>'phpstardust', 'controller' => 'pages', 'action' => 'dashboard'));
Router::connect('/login', array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'logout'));
Router::connect('/forgot-password', array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'forgot'));
Router::connect('/register', array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'register'));

Router::connect(
	'/activate/:activationcode',
	array('plugin'=>'phpstardust', 'controller' => 'users', 'action' => 'activate'),
	array(
		'pass' => array('activationcode')
	)
);

?>