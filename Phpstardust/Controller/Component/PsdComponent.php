<?php

App::uses('Component', 'Controller');


class PsdComponent extends Component {
	
	
	public $components = array('Session','Cookie', 'RequestHandler',
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
	
	public $helpers = array('Html', 'Form', 'Session');
	
	
	
	
	public function init() {
		
		Configure::write('Config.language', Configure::read('Psd.locale'));
		$this->Session->write('Config.language', Configure::read('Psd.locale'));
		CakeSession::write('Config.language', Configure::read('Psd.locale'));
		
		Configure::write('Config.timezone', Configure::read('Psd.timezone'));
		
		$this->setTimezone();
		
		$this->setLanguage();
		
		return(true);
		
	}
	
	
	
	
	public function databaseExists() {
		
		$db = ConnectionManager::getDataSource('default');
		
		$dbVars = $db->config;
		$prefix = $dbVars["prefix"];
		
		if (count($db->query('SHOW TABLES LIKE "' .$prefix .'settings"'))==1) return(true);
		else return(false);
		
	}
	
	
	
	
	public function authCheck() {
	
		if ($this->Session->read('Auth.User')) return(true);
		
		if ($this->Cookie->check('remember_me_cookie')) {
			
			$cookie = $this->Cookie->read('remember_me_cookie');
			
			$User = ClassRegistry::init('User');
			
			$checkuser = $User->find('first', array(
				'conditions' => array(
					'User.username' => $cookie['username']
				)
			));
			
			if ($this->Auth->login($checkuser["User"])) return(true);
			
		}
		
		return(false);
		
	}
	
	
	
	
	public function checkRemember($data = array()) {
	
		if ($data['User']['remember']==1) {
					
			unset($data['User']['remember']);
			unset($data['User']['password']);

			$this->Cookie->write('remember_me_cookie', $data['User'], true, '2 weeks');
			
		}
		
		return(true);
		
	}
	
	
	
	
	public function sendNewPassword($userdata = array()) {
		
		$password = $this->generatePassword();
		
		$User = ClassRegistry::init('User');
				
		$User->id = $userdata["User"]["id"];
		$User->saveField('password', $password);
		
		$msg = $this->text('Hi') .' <b>' .$userdata["User"]["username"] .'</b><br><br>';
		$msg .= $this->text('this is a new password') .': <b>' .$password .'</b><br><br>';
		$msg .= $this->text('Best regards') .', ' .Configure::read('Psd.name') .' staff.';
		
		$Email = new CakeEmail();
		$Email->config('default');
		$Email->emailFormat('html');
		$Email->from(array(Configure::read('Psd.email') => Configure::read('Psd.name')));
		$Email->to($userdata["User"]["email"]);
		$Email->subject($this->text('New password') .' - ' .Configure::read('Psd.name'));
		if ($Email->send($msg)) return(true);
		else return(false);
		
	}
	
	
	
	
	public function sendConfirmationEmail($data = array()) {
		
		$msg = $this->text('Hi') .' <b>' .$data["User"]["username"] .'</b>, ' .$this->text('welcome') .' in ' .Configure::read('Psd.name') .'.<br><br>';
		$msg .= $this->text('For activate your account') .' <a href="' .Configure::read('Psd.url') .'/activate/' .$data["User"]["activationcode"] .'" target="_blank">' .$this->text('click here') .'</a>.<br><br>';
		$msg .= $this->text('Best regards') .', ' .Configure::read('Psd.name') .' staff.';
		
		$Email = new CakeEmail();
		$Email->config('default');
		$Email->emailFormat('html');
		$Email->from(array(Configure::read('Psd.email') => Configure::read('Psd.name')));
		$Email->to($data["User"]["email"]);
		$Email->subject($this->text('Activation account') .' - ' .Configure::read('Psd.name'));
		if ($Email->send($msg)) return(true);
		else return(false);
		
	}
	
	
	
	
	public function generatePassword($length = 8) {
		
	  $password = "";
	  $characters = "0123456789bcdfghjkmnpqrstvwxyz";
	  $i = 0;
	  
	  while ($i<$length) {
		  
		$char = substr($characters, mt_rand(0, strlen($characters)-1), 1);
		
		if (!strstr($password, $char)) {
			
		  $password .= $char;
		  $i++;
		  
		}
		
	  }
	  
	  return($password);
	  
	}
	
	
	
	
	public function text($text = "", $lang = NULL) {
		
		$pluginPath = App::pluginPath('Phpstardust');
		require $pluginPath .'Config' .DS .'locale.php';
	
		if (!$this->Session->check('Config.language')) {
			Configure::write('Config.language', 'en');
			CakeSession::write('Config.language', 'en');	
		}
		
		if ($lang!==NULL) {
			
			Configure::write('Config.language', $lang);
			CakeSession::write('Config.language', $lang);
			
		}
		
		return $locale[$text][$this->Session->read('Config.language')];
		
	}
	
	
	
	
	public function setTimezone() {
		
		$Setting = ClassRegistry::init('Setting');
		
		$Setting->id = 1;
		
		(string)$timezone = $Setting->field('timezone');
		
		Configure::write('Config.timezone', $timezone);
		
		return(true);
	
	}
	
	
	
	
	public function setLanguage() {
		
		$Setting = ClassRegistry::init('Setting');
		
		$Setting->id = 1;
		
		(string)$language = $Setting->field('language');
		
		Configure::write('Config.language', $language);
		$this->Session->write('Config.language', $language);
		CakeSession::write('Config.language', $language);
		
		return(true);
		
	}
	
	
	
	
	public function upload($model, $field) {
		
		  if ($_FILES['data']['size'][$model][$field] == 0 || $_FILES['data']['error'][$model][$field]!== 0) return false;
		
		  if (is_uploaded_file($_FILES['data']['tmp_name'][$model][$field])) {
	
			  $uploadDir = Configure::read('Psd.uploads');
	  
			  $fileTmp = $_FILES['data']['tmp_name'][$model][$field];
			  
			  $fileName = $_FILES['data']['name'][$model][$field];
			  
			  $file = pathinfo($uploadDir . $fileName);
			  
			  $fileName = md5($file['filename'] .time()) ."." .$file['extension'];
		  
		  	  if (!file_exists($uploadDir)) {
				  
			  	mkdir($uploadDir);
				
			  }	
			
			  if (move_uploaded_file($fileTmp, $uploadDir . $fileName)) {
				  
				  if (Configure::read('Psd.resizeImage')>0) $this->resizeImage($fileName, Configure::read('Psd.resizeImage'));
				  
				  return array(
				  	'name'=>$fileName,
				  	'type'=>$file['extension'],
				  	'size'=>$_FILES['data']['size'][$model][$field]
				  );
				  
			  }
			  else return false;
		  
		  }
		  else return false;
		
	}
	
	
	
	
	public function deleteFile($file=NULL) {
		
		if (is_file(Configure::read('Psd.uploads') .$file) && file_exists(Configure::read('Psd.uploads') .$file)) {
			
			unlink(Configure::read('Psd.uploads') .$file);
			return(true);
			
		}
		else return(false);
		
	}
	
	
	
	
	public function isOffline($action=NULL) {
		
		if ($action=="maintenance" || $action=="login") return(false);
		
		$Setting = ClassRegistry::init('Setting');
		
		$Setting->id = 1;
		$status = $Setting->field('status');
		
		if ((!$this->Session->check('Auth.User') && $status==1)) return(true);
		else return(false);
		
	}
	
	
	
	
	public function dropzoneUpload($model = NULL, $field = NULL, $data = array(), $files = array()) {
		
		$entity = ClassRegistry::init($model);
		
		$row = $entity->findById($data["id"]);
		
		$uploadDir = Configure::read('Psd.uploads');
		$uploadfile = $uploadDir . basename($files['file']['name']);
		
		$file = pathinfo($uploadfile);
		
		$fileSlug = strtolower(Inflector::slug($file['filename'],'-'));
			  
		$fileName = md5($fileSlug ."_" .time()) ."." .$file['extension'];
		
		$savedata = array('id' => $data["id"], $field => $fileName);
		$entity->save($savedata);
	
		if (!file_exists($uploadDir)) {
			
		  mkdir($uploadDir);
		  
		}	
		
		if (move_uploaded_file($files['file']['tmp_name'], $uploadDir .$fileName)) {
			
			if (Configure::read('Psd.resizeImage')>0) $this->resizeImage($fileName, Configure::read('Psd.resizeImage'));
			
			$this->deleteFile($row[$model][$field]);
			
			echo $fileName;
			
		} else echo "ko";
		
	}
	
	
	
	
	public function deleteImage($model = NULL, $id = NULL) {
		
		$entity = ClassRegistry::init($model);
		
		$row = $entity->findById($id);
		
		$data = array('id' => $id, 'image' => '');
		$entity->save($data);
		
		if ($this->deleteFile($row[$model]["image"])) echo json_encode(array('response' => 'ok'));
		else echo json_encode(array('response' => 'ko'));
		
	}
	
	
	
	
	public function crop($entity = NULL, $data = array(), $field = NULL, $id = NULL) {
		
		$model = ClassRegistry::init($entity);
		
		$row = $model->findById($id);
		
		$targW = $targH = Configure::read('Psd.cropImageWidth');
	
		if (isset($data[$entity]["size"]) && $data[$entity]["size"]!="" && is_numeric($data[$entity]["size"])) $targW = $targH = $data[$entity]["size"];
			
		unset($data[$entity]["size"]);
		
		$src = Configure::read('Psd.uploads') .$row[$entity][$field];
		
		$file = pathinfo($src);
		
		if ($file['extension']=="png") $img = imagecreatefrompng($src);
		elseif ($file['extension']=="gif") $img = imagecreatefromgif($src);
		elseif ($file['extension']=="jpg") $img = imagecreatefromjpeg($src);
		elseif ($file['extension']=="jpeg") $img = imagecreatefromjpeg($src);
		
		$dst = imagecreatetruecolor( $targW, $targH );
		
		if ($file['extension']=="png") {
				
			imagealphablending($dst, false);
			imagesavealpha($dst, true);
		
		}
		
		imagecopyresampled($dst,$img,0,0,$data[$entity]["x"],$data[$entity]["y"],
			$targW,$targH,$data[$entity]["w"], $data[$entity]["h"]);
		
		if ($file['extension']=="png") header('Content-type: image/png');
		if ($file['extension']=="gif") header('Content-type: image/gif');
		if ($file['extension']=="jpg") header('Content-type: image/jpeg');
		if ($file['extension']=="jpeg") header('Content-type: image/jpeg');
		
		if ($file['extension']=="png") $result = imagepng($dst, $src, NULL, 0);
		if ($file['extension']=="gif") $result = imagegif($dst, $src);
		if ($file['extension']=="jpg") $result = imagejpeg($dst, $src, 100);
		if ($file['extension']=="jpeg") $result = imagejpeg($dst, $src, 100);
		
		if ($result) return(true);
		else return(false);
		
	}
	
	
	
	
	function resizeImage($filename = NULL, $newSize = NULL, $force = false) {
		
		$fn = Configure::read('Psd.uploads') .$filename;
		
		$file = pathinfo($fn);
		
		$size = getimagesize($fn);
		
		if ($force===true || ($size[0]>Configure::read('Psd.resizeImage') || $size[1]>Configure::read('Psd.resizeImage'))) {
			
			if ($newSize!="" && is_numeric($newSize)) {
		
				$ratio = $size[0]/$size[1]; // width/height
				if( $ratio > 1) {
					$width = $newSize;
					$height = $newSize/$ratio;
				}
				else {
					$width = $newSize*$ratio;
					$height = $newSize;
				}
				
				if ($file['extension']=="png") $src = imagecreatefrompng($fn);
				elseif ($file['extension']=="gif") $src = imagecreatefromgif($fn);
				elseif ($file['extension']=="jpg") $src = imagecreatefromjpeg($fn);
				elseif ($file['extension']=="jpeg") $src = imagecreatefromjpeg($fn);
				
				$dst = imagecreatetruecolor($width,$height);
				
				if ($file['extension']=="png") {
					
					imagealphablending($dst, false);
					imagesavealpha($dst, true);
				
				}
				
				imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
				
				if ($file['extension']=="png") $result = imagepng($dst, $fn, NULL, 0);
				if ($file['extension']=="gif") $result = imagegif($dst, $fn);
				if ($file['extension']=="jpg") $result = imagejpeg($dst, $fn, 100);
				if ($file['extension']=="jpeg") $result = imagejpeg($dst, $fn, 100);
				
				if ($result) return(true);
				else return(false);
			
			}
			else return(false);
		
		}
		else return(true);
		
	}
	
	
	
	
	public function getRoles() {
		
		$Customrole = ClassRegistry::init('Customrole');
		
		$roles = Configure::read('Psd.roles');
		
		$customroles = $Customrole->find('list', array(
			'fields' => array('Customrole.name', 'Customrole.name')
		));
		
		if (count($customroles)>0) $roles[] = $customroles;
		
		return $roles;
		
	}
	
	
	
	
	public function checkUserPermission($controller = NULL, $action = NULL, $plugin = NULL) {
		
		$return = false;
		
		if (AuthComponent::user('role')=="admin") $return = true;
		
		if (AuthComponent::user('role')=="editor" && ($controller=="articles" || $controller=="pages")) $return = true;
		
		if (AuthComponent::user('role')=="author" && $controller=="articles") $return = true;
		
		if (AuthComponent::user('role')!="admin" && AuthComponent::user('role')!="editor" && AuthComponent::user('role')!="author") {
			
			$Specialpermission = ClassRegistry::init('Specialpermission');
			
			$checkPermission = $Specialpermission->find('count', array(
				'conditions' => array(
					'AND' => array(
						array('Specialpermission.name' => AuthComponent::user('role')),
						array('Specialpermission.plugin' => $plugin),
						array('Specialpermission.controller' => $controller),
						array('Specialpermission.action' => $action),
						array('Specialpermission.permission' => 'allow')
					)
				)
			));
			
			if ($checkPermission>0 || ($controller=="pages" && $action=="dashboard")) $return = true;
			
		}
		
		if ($this->Auth->user() && ($controller=="pages" && $action=="dashboard")) $return = true;
		
		if ($this->Auth->user() && ($controller=="users" && $action=="logout")) $return = true;
		
		if ($this->Auth->user() && ($controller=="users" && $action=="edit")) $return = true;
		
		$actions = Configure::read('Psd.publicPages');
		
		if (isset($actions[$controller]) && in_array($action, $actions[$controller])) $return = true;
		
		return($return);
		
	}
	
	
	
	
	public function getPublicActions() {
		
		$actions = array();
		
		foreach(Configure::read('Psd.publicPages') as $item):
		
			foreach($item as $action):
			
				$actions[] = $action;
			
			endforeach;
		
		endforeach;

		return $actions;
		
	}
	
	
	
	
	public function setMetaTags($entity = NULL, $id = NULL) {
		
		$params = array();
		
		$Setting = ClassRegistry::init('Setting');
			
		$setting = $Setting->find('first', array(
			'conditions' => array('Setting.id' => 1)
		));
		
		if ($entity===NULL) {
			
			$params['title'] = $setting["Setting"]["title"];
			$params['description'] = $setting["Setting"]["description"];
			$params['noindex'] = $setting["Setting"]["noindex"];
			$params['nofollow'] = $setting["Setting"]["nofollow"];
			
			if ($setting["Setting"]["enableog"]==1) {
				
				$params["og"]['title'] = $setting["Setting"]["title"];
				
				$params["og"]['description'] = $setting["Setting"]["description"];
				
				$params["og"]['url'] = Configure::read('Psd.url');
				
				$params["og"]['type'] = $setting["Setting"]["ogtype"];
				
				if ($setting["Setting"]["ogimage"]!="") $params["og"]['image'] = Configure::read('Psd.url') .'/files/uploads/' .$setting["Setting"]["ogimage"];
				
			}
			else $params["og"] = array();
		
		} else {
			
			$model = ClassRegistry::init($entity);
			
			$row = $model->find('first', array(
				'conditions' => array($entity .'.id' => $id)
			));
			
			$params['title'] = $row[$entity]["title"] .' - ' .Configure::read('Psd.name');
			$params['description'] = $row[$entity]["description"];
			$params['noindex'] = $row[$entity]["noindex"];
			$params['nofollow'] = $row[$entity]["nofollow"];
			
			if ($setting["Setting"]["enableog"]==1) {
				
				$params["og"]['title'] = $row[$entity]["title"] .' - ' .Configure::read('Psd.name');
				
				$params["og"]['description'] = $row[$entity]["description"];
				
				if ($entity=="Article") $params["og"]['url'] = Configure::read('Psd.url') .'/post/' .$row[$entity]["slug"];
				else $params["og"]['url'] = Configure::read('Psd.url') .'/page/' .$row[$entity]["slug"];
				
				if ($entity=="Article") $params["og"]['type'] = "article";
				else $params["og"]['type'] = "website";
				
				if ($row[$entity]["image"]!="") $params["og"]['image'] = Configure::read('Psd.url') .'/files/uploads/' .$row[$entity]["image"];
				
			}
			else $params["og"] = array();
			
		}
		
		return $params;
		
	}
	
	
}


?>
