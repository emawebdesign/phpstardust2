<?php
/**
 * Phpstardust 2
 * CMS based on CakePHP. A CakePHP plugin.
 *
 * @version       1.0
 * @link          http://www.phpstardust.org
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

Configure::write(
    'Psd',
    array(
		'version' => '1.0',
		'name' => 'Name website',
		'subtitle' => 'CMS based on CakePHP',
		'email' => 'your@email',
        'url' => 'http://www.example.com',
		'secretkey' => 'your_secret_key',
		'https' => false,
		'roles' => array(
			'admin' => 'Administrator',
			'editor' => 'Editor',
			'author' => 'Author'
		),
		'publicPages' => array(
			'users' => array('login', 'logout', 'forgot', 'register', 'activate'),
			'pages' => array('maintenance', 'homepage', 'single', 'page', 'category', 'feed', 'page404', 'infinitescroll'),
			'installers' => array('install')
		),
		'unlockedActions' => array(
			'add', 
			'edit', 
			'upload', 
			'deleteImage', 
			'crop',
			'resize',
			'install'
		),
		'csrfExpires' => '+1 hour',
		'locale' => 'en',
		'timezone' => 'Europe/Rome',
		'themeBackend' => 'Admin',
		'themeFrontend' => 'Frontend',
		'paginationType' => 'numbers', //numbers or prevnext
		'perPage' => 20,
        'uploads' => WWW_ROOT . 'files/uploads' . DS,
		'maintenanceMessage' => 'Maintenance mode',
		'feedLimit' => 20,
		'imageTypesAccepted' => '.jpg, .jpeg, .gif, .png',
		'cropImageWidth' => 150,
		'resizeImage' => 900, // 0 = disable resize
		'allowedHtmlTags' => '<p><div><br><a><b><strong><ol><ul><li><img><blockquote><table><th><td><tr><thead><tbody><em><s>'
    )
);
 
?>