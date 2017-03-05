<?php

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('File', 'Utility');


class PhpstardustAppController extends AppController {
	
	
	public $uses = array(
		'Phpstardust.Article',
		'Phpstardust.Categorie',
		'Phpstardust.Customrole',
		'Phpstardust.Page',
		'Phpstardust.Setting',
		'Phpstardust.Specialpermission',
		'Phpstardust.User'
	);
	
	
	public $components = array(
		'Session','Cookie','RequestHandler','Paginator', 'Security', 'Phpstardust.Psd',
		'Auth' => array(
			'loginRedirect' => array(
				'plugin' => 'phpstardust',
				'controller' => 'users',
				'action' => 'login'
			),
			'logoutRedirect' => array(
				'plugin' => 'phpstardust',
				'controller' => 'users',
				'action' => 'login'
			),
			'authenticate' => array(
                'Form' => array(
					'fields' => array('username' => 'username'),
                    'passwordHasher' => 'Blowfish',
					'scope' => array('status' => 1)
                )
            ),
			'flash' => array(
				'key'=>'auth',
				'element'=>'authError'
			  ),
			'loginAction' => array('plugin' => 'phpstardust', 'controller' => 'users', 'action' => 'login')
		)
	);
	
	
	public $helpers = array('Html', 'Form', 'Session', 'Phpstardust.Psd');
	
	
	public function forceSSL() {
        return $this->redirect('https://' . env('SERVER_NAME') . $this->here);
    }
	
	
	public function beforeFilter() {
		
		if (Configure::read('Psd.https')===true) {
			$this->Security->blackHoleCallback = 'forceSSL';
			$this->Security->requireSecure();
		}
		
		$this->Security->unlockedActions = Configure::read('Psd.unlockedActions');
		
		$this->Security->csrfExpires = Configure::read('Psd.csrfExpires');
		
		$this->theme = Configure::read('Psd.themeBackend');
		
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
    	$this->Cookie->httpOnly = true;
		
		if ($this->params["controller"]!="installers") {
		
			$this->Psd->init();
			
			$publicMethods = $this->Psd->getPublicActions();
			
			$this->Auth->allow($publicMethods);
			
			if ($this->Psd->isOffline($this->params["action"])) $this->redirect('/maintenance-mode');
			
			if (!$this->Psd->checkUserPermission($this->params["controller"], $this->params["action"], $this->params["plugin"])) {
				
				$this->Session->setFlash(
					$this->Psd->text('Access denied!'), 'flash_warning'
				);
				
				$this->redirect('/dashboard');
			
			}
			
			$this->set('metaTitle', NULL); 
			$this->set('metaDescription', NULL);
			$this->set('robots', NULL);
			
			$this->set('opengraph', array());
		
		} else $this->Auth->allow('install');
		
	}
	
	
}
