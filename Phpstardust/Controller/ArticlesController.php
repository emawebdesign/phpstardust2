<?php

class ArticlesController extends PhpstardustAppController {
	
	private $entity = "Article";
	
	
	
	
	public function index() {
		
		$conditions = array();
		
		if (isset($this->request->query['q']) && $this->request->query['q']!="") {
			
			$this->request->data[$this->entity]["q"] = addslashes(trim(strip_tags($this->request->query['q'])));
			
			$conditions[] = array(
				$this->entity .".title LIKE '%" .$this->request->data[$this->entity]["q"] ."%'"
			);
		}
		
		if (AuthComponent::user('role')=="author") {
			$conditions[] = array($this->entity .'.user_id' => AuthComponent::user('id'));
		}
		
		$this->{$this->entity}->recursive = 1;
		
		$this->Paginator->settings = array(
			'limit' => Configure::read('Psd.perPage'),
			'order' => array($this->entity .'.title' => 'ASC' ),
			'paramType' => 'querystring',
			'conditions' => $conditions
		);
		
		$rows = $this->Paginator->paginate($this->entity);
		
		$this->set('model', $this->entity);
		$this->set('rows', $rows);
		$this->set('count', count($rows));
		
	}
	
	
	
	
	public function add() {
		
		$categories = $this->Categorie->find('list', array(
			'fields' => array('Categorie.id', 'Categorie.name')
		));
		
		$this->set('categories', $categories);
		
		$this->set('model', $this->entity);
		
        if ($this->request->is('post')) {
			
            $this->{$this->entity}->create();
			
			if ($this->request->data[$this->entity]["image"]["name"]!="") {
				
				$newfile = $this->Psd->upload($this->entity,'image');
				$this->request->data[$this->entity]["image"] = $newfile["name"];
				
			}
			else $this->request->data[$this->entity]["image"] = "";
			
            if ($this->{$this->entity}->save($this->request->data)) {
				
				$this->Session->setFlash(
					$this->Psd->text('Data has been saved.'), 'flash_success'
				);
				
                return $this->redirect(array('action' => 'index'));
				
            }
			
        }
		
    }
	
	
	
	
	public function edit($id = NULL) {
		
		$this->disableCache();
		
		if (!$id) {
			throw new NotFoundException($this->Psd->text('Element not found.'));
		}
	
		$row = $this->{$this->entity}->findById($id);
		
		if (!$row) {
			throw new NotFoundException($this->Psd->text('Element not found.'));
		}
		
		if ((AuthComponent::user('role')!="admin" && AuthComponent::user('role')!="editor") && AuthComponent::user('id')!=$row[$this->entity]["user_id"]) {
			
			$this->Session->setFlash(
				$this->Psd->text('Access denied!'), 'flash_success'
			);
			
			return $this->redirect(array('action' => 'index'));
			
		}
		
		$categories = $this->Categorie->find('list', array(
			'fields' => array('Categorie.id', 'Categorie.name')
		));
		
		$this->set('categories', $categories);
		
		$this->set('model', $this->entity);
	
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
	
	
	
	
	public function crop($id = NULL) {
		
		if (!$id) {
			throw new NotFoundException($this->Psd->text('Element not found.'));
		}
	
		$row = $this->{$this->entity}->findById($id);
		
		if (!$row) {
			throw new NotFoundException($this->Psd->text('Element not found.'));
		}
		
		$this->set('model', $this->entity);
	
		if ($this->request->is(array('post', 'put'))) {
			
			if ($this->Psd->crop($this->entity, $this->request->data, "image", $id)) {
			
				$this->Session->setFlash(
					$this->Psd->text('Image cropped.'), 'flash_success'
				);
				
				return $this->redirect(array('action' => 'edit', $id));
			
			} else {
				
				$this->Session->setFlash(
					$this->Psd->text('Crop error.'), 'flash_warning'
				);
				
				return $this->redirect(array('action' => 'crop', $id));
				
			}
			
		}
	
		if (!$this->request->data) $this->request->data = $row;
		
	}
	
	
	
	
	public function resize($id = NULL) {
		
		if (!$id) {
			throw new NotFoundException($this->Psd->text('Element not found.'));
		}
	
		$row = $this->{$this->entity}->findById($id);
		
		if (!$row) {
			throw new NotFoundException($this->Psd->text('Element not found.'));
		}
		
		$this->set('model', $this->entity);
		
		$size = getimagesize(Configure::read('Psd.uploads') .$row[$this->entity]["image"]);
		
		$this->set('sizes', "W: " .$size[0] ."<br>H: " .$size[1]);
	
		if ($this->request->is(array('post', 'put'))) {
			
			if ($this->Psd->resizeImage($row[$this->entity]["image"], $this->request->data[$this->entity]["size"], true)) {
			
				$this->Session->setFlash(
					$this->Psd->text('Image resized.'), 'flash_success'
				);
				
				return $this->redirect(array('action' => 'resize', $id));
			
			} else {
				
				$this->Session->setFlash(
					$this->Psd->text('Resize error.'), 'flash_warning'
				);
				
				return $this->redirect(array('action' => 'resize', $id));
				
			}
			
		}
	
		if (!$this->request->data) $this->request->data = $row;
		
	}
	
	
	
	
	public function delete($id = NULL) {
		
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException($this->Psd->text('Element not found.'));
		}
		
		$this->{$this->entity}->id = $id;
		$image = $this->{$this->entity}->field('image');
		if ($image!="") $this->Psd->deleteFile($image);
	
		if ($this->{$this->entity}->delete($id)) {
			
			$this->Session->setFlash(
				$this->Psd->text('Data has been deleted.'), 'flash_success'
			);
			
			return $this->redirect(array('action' => 'index'));
		}
		
	}
	
	
}


?>
