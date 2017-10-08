<?php

class UsersController extends PhpstardustAppController {
	
	private $entity = "User";
	
	
	public function login() {
		
		$this->layout = 'public';
		
		if ($this->Psd->authCheck()) $this->redirect('/dashboard');
		
		$this->set('model', $this->entity);
		
		if ($this->request->is('post')) {
			
			if ($this->Auth->login()) {
				
				$this->Psd->checkRemember($this->request->data);
				
				$this->{$this->entity}->id = $this->Auth->user('id');
        		$this->{$this->entity}->saveField('last_login', date("Y-m-d H:i:s"));
			
				$this->redirect('/dashboard');
				
			}
			
			$this->Session->setFlash(
				$this->Psd->text('Your username or password are incorrect.'), 'flash_warning'
			);
				
		}
		
		
	}
	
	
	
	
	public function logout() {
		
		$this->Session->destroy();
		
		$this->Cookie->delete('remember_me_cookie');
		
		return $this->redirect($this->Auth->logout());
		
	}
	
	
	
	
	public function forgot() {
		
		$this->layout = 'public';
		
		$this->set('model', $this->entity);
		
		if ($this->request->is('post')) {
		
			$user = $this->{$this->entity}->findByEmail($this->request->data[$this->entity]["email"]);
			
			if (count($user)>0) {
				
				$this->Psd->sendNewPassword($user);
				
				$this->Session->setFlash(
					$this->Psd->text('Password sent.'), 'flash_success'
				);
				
				return $this->redirect('/forgot-password');
			
			}
			else {
				
				$this->Session->setFlash(
					$this->Psd->text('Email not found.'), 'flash_warning'
				);
					
				return $this->redirect('/forgot-password');
				
			}
		
		}
		
    }
	
	
	
	
	public function register() {
		
		$this->layout = 'public';
		
		$this->set('model', $this->entity);
		
        if ($this->request->is('post')) {
			
			$this->request->data[$this->entity]["activationcode"] = md5($this->Psd->generatePassword());
			$this->request->data[$this->entity]["token"] = $this->Psd->getJwt(array('username' => $this->request->data[$this->entity]["username"]));
			
            if ($this->{$this->entity}->save($this->request->data)) {
				
				$this->Psd->sendConfirmationEmail($this->request->data);
				
				$this->Session->setFlash(
					$this->Psd->text('Registration complete. We have sent you an email with a link to activate your account.'), 'flash_success'
				);
				
                return $this->redirect('/register');
				
            }
			
        }
		
    }
	
	
	
	
	public function activate($activationcode=NULL) {
		
		$this->autoRender = false;
		
		$data = $this->{$this->entity}->findByActivationcode($activationcode);
		
		if (count($data)>0) {
			
			$this->{$this->entity}->id = $data[$this->entity]["id"];
			$this->{$this->entity}->saveField('status', 1);
			
			$this->Session->setFlash(
				$this->Psd->text('Account activated.'), 'flash_success'
			);
			
			return $this->redirect('/login');
		
		}
		else {
			
			$this->Session->setFlash(
				$this->Psd->text('Activation code not found.'), 'flash_warning'
			);
				
            return $this->redirect('/register');
			
		}
		
    }
	
	
	
	
	public function index() {
		
		$conditions = array();
		
		if (isset($this->request->query['q']) && $this->request->query['q']!="") {
			
			$this->request->data[$this->entity]["q"] = addslashes(trim(strip_tags($this->request->query['q'])));
			
			$conditions[] = array(
				$this->entity .".username LIKE '%" .$this->request->data[$this->entity]["q"] ."%'"
			);
		}
		
		$this->Paginator->settings = array(
			'limit' => Configure::read('Psd.perPage'),
			'order' => array($this->entity .'.username' => 'ASC' ),
			'paramType' => 'querystring',
			'conditions' => $conditions
		);
		
		$rows = $this->Paginator->paginate($this->entity);
		
		$this->set('model', $this->entity);
		$this->set('rows', $rows);
		$this->set('count', count($rows));
		
	}
	
	
	
	
	public function add() {
		
		$this->set('model', $this->entity);
		
		$this->set('roles', $this->Psd->getRoles());
		
        if ($this->request->is('post')) {
			
			$this->request->data[$this->entity]["activationcode"] = md5($this->Psd->generatePassword());
			$this->request->data[$this->entity]["token"] = base64_encode(mcrypt_create_iv(32));
			
            $this->{$this->entity}->create();
			
            if ($this->{$this->entity}->save($this->request->data)) {
				
				$this->Session->setFlash(
					$this->Psd->text('Data has been saved.'), 'flash_success'
				);
				
                return $this->redirect(array('action' => 'index'));
				
            }
			
        }
		
    }
	
	
	
	
	public function edit($id = NULL) {
		
		if (!$id) {
			throw new NotFoundException($this->Psd->text('Element not found.'));
		}
	
		$row = $this->{$this->entity}->findById($id);
		
		if (!$row) {
			throw new NotFoundException($this->Psd->text('Element not found.'));
		}
		
		if (AuthComponent::user('role')!="admin" && AuthComponent::user('id')!=$id) {
			throw new NotFoundException($this->Psd->text('Element not found.'));
		}
		
		$this->set('model', $this->entity);
		
		$this->set('roles', $this->Psd->getRoles());
	
		if ($this->request->is(array('post', 'put'))) {
			
			$this->{$this->entity}->id = $id;
			
			if ($this->{$this->entity}->save($this->request->data)) {
				 
				 $this->Session->setFlash(
					$this->Psd->text('Data has been modified.'), 'flash_success'
				);
				
				return $this->redirect(array('action' => 'edit', $id));
				
			}
			
		}
	
		if (!$this->request->data) $this->request->data = $row;
		
	}
	
	
	
	
	public function delete($id = NULL) {
		
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException($this->Psd->text('Element not found.'));
		}
	
		if ($this->{$this->entity}->delete($id)) {
			
			$this->Session->setFlash(
				$this->Psd->text('Data has been deleted.'), 'flash_success'
			);
			
			return $this->redirect(array('action' => 'index'));
		}
		
	}
	
	
}


?>
