<?php

class PagesController extends PhpstardustAppController {
	
	private $entity = "Page";
	
	
	
	
	public function dashboard() {
		
		$this->set('welcomeMessage', 'Welcome on Phpstardust version ' .Configure::read('Psd.version') .'.');
		
		$users = $this->User->find('count');
		
		$administrators = $this->User->find('count', array(
			'conditions' => array('User.role' => 'admin')
		));
		
		$editors = $this->User->find('count', array(
			'conditions' => array('User.role' => 'editor')
		));
		
		$authors = $this->User->find('count', array(
			'conditions' => array('User.role' => 'author')
		));
		
		$customroles = $this->Customrole->find('count');
		
		$pages = $this->Page->find('count');
		
		$articles = $this->Article->find('count');
		
		$categories = $this->Categorie->find('count');
		
		$this->set('users', $users);
		$this->set('administrators', $administrators);
		$this->set('editors', $editors);
		$this->set('authors', $authors);
		$this->set('customroles', $customroles);
		$this->set('pages', $pages);
		$this->set('articles', $articles);
		$this->set('categories', $categories);
				
	}
	
	
	
	
	public function maintenance() {
		
		$this->layout = 'public';
		
		$this->set('message', 'maintenance mode.');
				
	}
	
	
	
	
	public function page404() {
		
		$this->theme = Configure::read('Psd.themeFrontend');
		
		$this->set('message', $this->Psd->text('Page not found!'));
		$this->set('error404', true);
		$this->set('metaTitle', "error404");
				
	}
	
	
	
	
	public function homepage() {
		
		$this->entity = "Article";
		
		$this->theme = Configure::read('Psd.themeFrontend');
		
		$conditions = array();
		
		$conditions[] = array($this->entity .'.status' => 'published');
		
		if (isset($this->request->query['q']) && $this->request->query['q']!="") {
			
			$this->request->data[$this->entity]["q"] = addslashes(trim(strip_tags($this->request->query['q'])));
			
			$conditions[] = array(
				'OR' => array(
					array($this->entity .".title LIKE '%" .$this->request->data[$this->entity]["q"] ."%'"),
					array($this->entity .".description LIKE '%" .$this->request->data[$this->entity]["q"] ."%'"),
					array($this->entity .".tags LIKE '%" .$this->request->data[$this->entity]["q"] ."%'"),
					array($this->entity .".text LIKE '%" .$this->request->data[$this->entity]["q"] ."%'")
				)
			);
		}
		
		$this->{$this->entity}->recursive = 1;
		
		$this->Paginator->settings = array(
			'limit' => Configure::read('Psd.perPage'),
			'order' => array($this->entity .'.id' => 'DESC' ),
			'paramType' => 'querystring',
			'conditions' => $conditions
		);
		
		$rows = $this->Paginator->paginate($this->entity);
		
		$this->set('model', $this->entity);
		$this->set('rows', $rows);
		$this->set('count', count($rows));
		
		$metaTags = $this->Psd->setMetaTags();
		
		$this->set('metaTitle', $metaTags["title"]);
		$this->set('metaDescription', $metaTags["description"]);
		if ($metaTags["noindex"]==1 && $metaTags["nofollow"]==0) $this->set('robots', 'noindex');
		if ($metaTags["nofollow"]==1 && $metaTags["noindex"]==0) $this->set('robots', 'nofollow');
		if ($metaTags["nofollow"]==1 && $metaTags["noindex"]==1) $this->set('robots', 'noindex,nofollow');
		
		$this->set('opengraph', $metaTags["og"]);
				
	}
	
	
	
	
	public function infinitescroll() {
		
		$this->theme = Configure::read('Psd.themeFrontend');
		
		$total = $this->{$this->entity}->find('count');
		
		$maxPage = ceil($total / (int)Configure::read('Psd.perPage'));
		
		$this->set('maxPage', $maxPage);
		
		$this->set('model', $this->entity);
	}
	
	
	
	
	public function infiniteloader() {
		
		$this->autoRender = false;
		
		$this->entity = "Article";
		
		$conditions = array();
		
		if (isset($this->request->query['q']) && $this->request->query['q']!="") {
			
			$this->request->data[$this->entity]["q"] = addslashes(trim(strip_tags(urldecode($this->request->query['q']))));
			
			$conditions[] = array(
				'OR' => array(
					array($this->entity .".title LIKE '%" .$this->request->data[$this->entity]["q"] ."%'"),
					array($this->entity .".text LIKE '%" .$this->request->data[$this->entity]["q"] ."%'")
				)
			);
			
		}
		
		$this->{$this->entity}->recursive = 1;
		
		$this->Paginator->settings = array(
			'limit' => Configure::read('Psd.perPage'),
			'order' => array($this->entity .'.id' => 'DESC' ),
			'paramType' => 'querystring',
			'conditions' => $conditions
		);
		
		$rows = $this->Paginator->paginate($this->entity);
		
		$html = "";
		
		if (count($rows)>0) {
		
			foreach($rows as $row):
			
				$html .= '<h2><a href="' .Configure::read('Psd.url') .'/post/' .$row[$this->entity]["slug"] .'">' .$row[$this->entity]["title"] .'</a></h2>';
				$html .= $row[$this->entity]["text"];
			
			endforeach;
			
			echo json_encode(array('response' => 'ok', 'html' => $html));
		
		} else {
			echo json_encode(array('response' => 'ko', 'html' => $this->Psd->text('No data.')));
		}
		
	}
	
	
	
	
	public function category($slug = NULL) {
		
		if (!$slug) {
			return $this->redirect('/404');
		}
		
		$this->entity = "Article";
		
		$this->theme = Configure::read('Psd.themeFrontend');
		
		$category = $this->Categorie->find('first', array(
			'conditions' => array('Categorie.slug' => $slug)
		));
		
		if (!$category) {
			return $this->redirect('/404');
		}
		
		$conditions = array();
		
		$conditions[] = array($this->entity .'.status' => 'published');
		
		$conditions[] = array($this->entity .'.categorie_id' => $category["Categorie"]["id"]);
		
		$this->{$this->entity}->recursive = 1;
		
		$this->Paginator->settings = array(
			'limit' => Configure::read('Psd.perPage'),
			'order' => array($this->entity .'.id' => 'DESC' ),
			'paramType' => 'querystring',
			'conditions' => $conditions
		);
		
		$rows = $this->Paginator->paginate($this->entity);
		
		$this->set('model', $this->entity);
		$this->set('rows', $rows);
		$this->set('category', $category);
		$this->set('count', count($rows));
		$this->set('metaTitle', $category["Categorie"]["name"] ." - " .Configure::read('Psd.name'));
				
	}
	
	
	
	
	public function single($slug = NULL) {
		
		if (!$slug) {
			return $this->redirect('/404');
		}
		
		$this->entity = "Article";
		
		$this->theme = Configure::read('Psd.themeFrontend');
		
		$conditions = array();
		
		$conditions[] = array($this->entity .'.slug' => $slug);
		
		$conditions[] = array($this->entity .'.status' => 'published');
		
		$this->{$this->entity}->recursive = 1;
		
		$row = $this->{$this->entity}->find('first', array(
			'conditions' => $conditions
		));
		
		if (!$row) {
			return $this->redirect('/404');
		}
		
		$this->set('model', $this->entity);
		$this->set('row', $row); 
		
		$metaTags = $this->Psd->setMetaTags($this->entity, $row[$this->entity]["id"]);
		
		$this->set('metaTitle', $metaTags["title"]);
		$this->set('metaDescription', $metaTags["description"]);
		if ($metaTags["noindex"]==1 && $metaTags["nofollow"]==0) $this->set('robots', 'noindex');
		if ($metaTags["nofollow"]==1 && $metaTags["noindex"]==0) $this->set('robots', 'nofollow');
		if ($metaTags["nofollow"]==1 && $metaTags["noindex"]==1) $this->set('robots', 'noindex,nofollow');
		
		$this->set('opengraph', $metaTags["og"]);
				
	}
	
	
	
	
	public function page($slug = NULL) {
		
		if (!$slug) {
			return $this->redirect('/404');
		}
		
		$this->theme = Configure::read('Psd.themeFrontend');
		
		$conditions = array();
		
		$conditions[] = array($this->entity .'.slug' => $slug);
		
		$conditions[] = array($this->entity .'.status' => 'public');
		
		$this->{$this->entity}->recursive = 1;
		
		$row = $this->{$this->entity}->find('first', array(
			'conditions' => $conditions
		));
		
		if (!$row) {
			return $this->redirect('/404');
		}
		
		$this->set('model', $this->entity);
		$this->set('row', $row);
		
		$metaTags = $this->Psd->setMetaTags($this->entity, $row[$this->entity]["id"]);
		
		$this->set('metaTitle', $metaTags["title"]);
		$this->set('metaDescription', $metaTags["description"]);
		if ($metaTags["noindex"]==1 && $metaTags["nofollow"]==0) $this->set('robots', 'noindex');
		if ($metaTags["nofollow"]==1 && $metaTags["noindex"]==0) $this->set('robots', 'nofollow');
		if ($metaTags["nofollow"]==1 && $metaTags["noindex"]==1) $this->set('robots', 'noindex,nofollow');
		
		$this->set('opengraph', $metaTags["og"]);
				
	}
	
	
	
	
	public function feed() {
	
		$this->theme = Configure::read('Psd.themeFrontend');
		$this->layout = 'rss';
		
		$this->set('title', 'Feed RSS');
		
		if ($this->RequestHandler->isRss()) {
			
			$articles = $this->Article->find(
				'all',
				array(
					'limit' => Configure::read('Psd.feedLimit'), 
					'conditions' => array('Article.status' => 'published'),
					'order' => 'Article.created DESC'
				)
			);
			
			return $this->set(compact('articles'));
		
		}
		
		$this->paginate = array(
			'order' => 'Article.created DESC',
			'limit' => Configure::read('Psd.feedLimit'),
			'conditions' => array('Article.status' => 'published'),
		);
		
		$articles = $this->paginate('Article');
		
		$this->set(compact('articles'));
	
	}
	
	
	
	
	public function upload() {
		
		$this->autoRender = false;
		
		$this->Psd->dropzoneUpload($this->request->data["model"], $this->request->data["field"], $this->request->data, $_FILES);
				
	}
	
	
	
	
	public function deleteImage($model = NULL, $id = NULL) {
		
		$this->autoRender = false;
		
		if (!$id) {
			throw new NotFoundException($this->Psd->text('Element not found.'));
		}
		
		$this->Psd->deleteImage($model, $id);
		
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
	
	
	
	
	public function index() {
		
		$conditions = array();
		
		if (isset($this->request->query['q']) && $this->request->query['q']!="") {
			
			$this->request->data[$this->entity]["q"] = addslashes(trim(strip_tags($this->request->query['q'])));
			
			$conditions[] = array(
				$this->entity .".title LIKE '%" .$this->request->data[$this->entity]["q"] ."%'"
			);
		}
		
		$this->{$this->entity}->recursive = 1;
		
		$this->Paginator->settings = array(
			'limit' => Configure::read('Psd.perPage'),
			'order' => array($this->entity .'.title' => 'ASC' ),
			'paramType' => 'querystring',
			'conditions' => $conditions
		);
		
		$rows = $this->Paginator->paginate($this->entity);
		
		$count = $this->{$this->entity}->find('count', array(
			'conditions' => $conditions
		));
		
		$this->set('model', $this->entity);
		$this->set('rows', $rows);
		$this->set('count', $count);
		
	}
	
	
	
	
	public function add() {
		
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
