<?php

class CustomrolesController extends PhpstardustAppController {
	
	private $entity = "Customrole";
	
	
	
	
	public function index() {
		
		$conditions = array();
		
		if (isset($this->request->query['q']) && $this->request->query['q']!="") {
			
			$this->request->data[$this->entity]["q"] = addslashes(trim(strip_tags($this->request->query['q'])));
			
			$conditions[] = array(
				$this->entity .".name LIKE '%" .$this->request->data[$this->entity]["q"] ."%'"
			);
		}
		
		$this->Paginator->settings = array(
			'limit' => Configure::read('Psd.perPage'),
			'order' => array($this->entity .'.name' => 'ASC' ),
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
		
        if ($this->request->is('post')) {
			
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