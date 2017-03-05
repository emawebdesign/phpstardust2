<?php

App::uses('ConnectionManager', 'Model');

class InstallersController extends PhpstardustAppController {
	
	private $entity = "Installer";
	
	public $uses = array('Phpstardust.Installer');
	
	
	
	
	public function install() {
		
		$this->layout = 'public';
		
		if ($this->Psd->databaseExists()) {
					
			if (AuthComponent::user('id')) $this->redirect('/dashboard');
			else $this->redirect('/login');
			
		}
		
		$db = ConnectionManager::getDataSource('default');
		
		$dbVars = $db->config;
		$prefix = $dbVars["prefix"];
		
		$this->set('model', $this->entity);
	
		if ($this->request->is('post')) {
			
				if ($this->Psd->databaseExists()) {
					
					if (AuthComponent::user('id')) $this->redirect('/dashboard');
					else $this->redirect('/login');
					
				} else {
					
					$this->loadModel('Phpstardust.User');
					
					$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'articles` (
					  `id` bigint(64) NOT NULL auto_increment,
					  `user_id` bigint(64) NOT NULL,
					  `title` varchar(255) collate utf8_unicode_ci default NULL,
					  `slug` varchar(255) collate utf8_unicode_ci default NULL,
					  `image` varchar(255) collate utf8_unicode_ci default NULL,
					  `description` varchar(255) collate utf8_unicode_ci default NULL,
					  `categorie_id` bigint(64) NOT NULL,
					  `tags` varchar(255) collate utf8_unicode_ci default NULL,
					  `text` longtext collate utf8_unicode_ci,
					  `status` varchar(255) collate utf8_unicode_ci default NULL,
					  `noindex` int(11) NOT NULL,
					  `nofollow` int(11) NOT NULL,
					  `created` datetime NOT NULL,
					  `modified` datetime NOT NULL,
					  PRIMARY KEY  (`id`),
					  KEY `user_id` (`user_id`),
					  KEY `categorie_id` (`categorie_id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
					
					$db->query($sql);
					
					$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'categories` (
					  `id` bigint(64) NOT NULL auto_increment,
					  `name` varchar(255) collate utf8_unicode_ci default NULL,
					  `slug` varchar(255) collate utf8_unicode_ci default NULL,
					  `created` datetime NOT NULL,
					  `modified` datetime NOT NULL,
					  PRIMARY KEY  (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
					
					$db->query($sql);
					
					$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'customroles` (
					  `id` bigint(64) NOT NULL auto_increment,
					  `name` varchar(255) collate utf8_unicode_ci default NULL,
					  `slug` varchar(255) collate utf8_unicode_ci default NULL,
					  `created` datetime NOT NULL,
					  `modified` datetime NOT NULL,
					  PRIMARY KEY  (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
					
					$db->query($sql);
					
					$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'pages` (
					  `id` bigint(64) NOT NULL auto_increment,
					  `user_id` bigint(64) NOT NULL,
					  `title` varchar(255) collate utf8_unicode_ci default NULL,
					  `slug` varchar(255) collate utf8_unicode_ci default NULL,
					  `image` varchar(255) collate utf8_unicode_ci default NULL,
					  `description` varchar(255) collate utf8_unicode_ci default NULL,
					  `tags` varchar(255) collate utf8_unicode_ci default NULL,
					  `text` longtext collate utf8_unicode_ci,
					  `status` varchar(255) collate utf8_unicode_ci default NULL,
					  `noindex` int(11) NOT NULL,
					  `nofollow` int(11) NOT NULL,
					  `created` datetime NOT NULL,
					  `modified` datetime NOT NULL,
					  PRIMARY KEY  (`id`),
					  KEY `user_id` (`user_id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
					
					$db->query($sql);
					
					$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'settings` (
					  `id` bigint(64) NOT NULL auto_increment,
					  `title` varchar(255) collate utf8_unicode_ci default NULL,
					  `description` varchar(255) collate utf8_unicode_ci default NULL,
					  `timezone` varchar(255) collate utf8_unicode_ci default NULL,
					  `language` varchar(255) collate utf8_unicode_ci default NULL,
					  `enableog` int(11) NOT NULL,
					  `ogtype` varchar(255) collate utf8_unicode_ci default NULL,
					  `ogimage` varchar(255) collate utf8_unicode_ci default NULL,
					  `status` int(11) NOT NULL,
					  `noindex` int(11) NOT NULL,
					  `nofollow` int(11) NOT NULL,
					  `facebook_profile` varchar(255) collate utf8_unicode_ci default NULL,
					  `googleplus_profile` varchar(255) collate utf8_unicode_ci default NULL,
					  `instagram_profile` varchar(255) collate utf8_unicode_ci default NULL,
					  `linkedin_profile` varchar(255) collate utf8_unicode_ci default NULL,
					  `twitter_profile` varchar(255) collate utf8_unicode_ci default NULL,
					  `youtube_profile` varchar(255) collate utf8_unicode_ci default NULL,
					  `modified` datetime NOT NULL,
					  PRIMARY KEY  (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
					
					$db->query($sql);
					
					$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'specialpermissions` (
					  `id` bigint(64) NOT NULL auto_increment,
					  `customrole_id` bigint(64) NOT NULL,
					  `name` varchar(255) collate utf8_unicode_ci default NULL,
					  `plugin` varchar(255) collate utf8_unicode_ci default NULL,
					  `controller` varchar(255) collate utf8_unicode_ci default NULL,
					  `action` varchar(255) collate utf8_unicode_ci default NULL,
					  `permission` varchar(255) collate utf8_unicode_ci default NULL,
					  `created` datetime NOT NULL,
					  `modified` datetime NOT NULL,
					  PRIMARY KEY  (`id`),
					  KEY `customrole_id` (`customrole_id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
					
					$db->query($sql);
					
					$sql = 'CREATE TABLE IF NOT EXISTS `' .$prefix .'users` (
					  `id` bigint(64) NOT NULL auto_increment,
					  `token` varchar(255) collate utf8_unicode_ci default NULL,
					  `email` varchar(255) collate utf8_unicode_ci default NULL,
					  `username` varchar(255) collate utf8_unicode_ci default NULL,
					  `password` varchar(255) collate utf8_unicode_ci default NULL,
					  `role` varchar(255) collate utf8_unicode_ci default NULL,
					  `status` int(11) NOT NULL,
					  `last_login` datetime NOT NULL,
					  `activationcode` varchar(255) collate utf8_unicode_ci default NULL,
					  `created` datetime NOT NULL,
					  `modified` datetime NOT NULL,
					  PRIMARY KEY  (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
					
					$db->query($sql);
					
					$date = date("Y-m-d H:i:s");
			
					$sql = "INSERT INTO `" .$prefix ."settings` (`id`, `title`, `description`, `timezone`, `language`, `enableog`, `ogtype`, `ogimage`, `status`, `noindex`, `nofollow`, `facebook_profile`, `googleplus_profile`, `instagram_profile`, `linkedin_profile`, `twitter_profile`, `youtube_profile`, `modified`) VALUES
(1, '" .$this->request->data[$this->entity]["title"] ."', '" .$this->request->data[$this->entity]["description"] ."', '" .$this->request->data[$this->entity]["timezone"] ."', '" .$this->request->data[$this->entity]["language"] ."', 0, 'website', '', 0, 0, 0, '', '', '', '', '', '', '" .$date ."');";
					
					$db->query($sql);
					
					$this->request->data[$this->entity]["activationcode"] = md5($this->Psd->generatePassword());
					$this->request->data[$this->entity]["token"] = base64_encode(mcrypt_create_iv(32));
					
					$this->User->create();
					
					$saveUser = array(
						'token' => $this->request->data[$this->entity]["token"],
						'email' => $this->request->data[$this->entity]["email"],
						'username' => $this->request->data[$this->entity]["username"],
						'password' => $this->request->data[$this->entity]["password"],
						'role' => 'admin',
						'status' => 1,
						'last_login' => $date,
						'activationcode' => $this->request->data[$this->entity]["activationcode"],
						'created' => $date,
						'modified' => $date
					);
					
					if ($this->User->save($saveUser)) {
						
						$this->Session->setFlash(
							$this->Psd->text('Installation completed.'), 'flash_success'
						);
						
						return $this->redirect('/login');
						
					}
				
				}
		
		}
		
    }
	
	
}


?>