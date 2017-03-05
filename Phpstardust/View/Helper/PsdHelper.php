<?php

App::uses('AppHelper', 'View/Helper');
App::uses('CakeTime', 'Utility');

class PsdHelper extends AppHelper {
	
	public $helpers = array('Html', 'Form', 'Session','Paginator','Time', 'Text');
	
	
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
	
	
	
	
	public function getLanguage() {
		
		$Setting = ClassRegistry::init('Setting');
		
		$Setting->id = 1;
		
		return $Setting->field('language');
		
	}
	
	
	
	
	public function frontend($element = NULL, $id = NULL, $model = NULL) {
		
		$Article = ClassRegistry::init('Article');
		
		$Categorie = ClassRegistry::init('Categorie');
		
		$Page = ClassRegistry::init('Page');
		
		$User = ClassRegistry::init('User');
		
		$Setting = ClassRegistry::init('Setting');
		
		if ($element=="siteurl") return Configure::read('Psd.url');
		
		if ($element=="sitename") return Configure::read('Psd.name');
		
		if ($element=="subtitle") return Configure::read('Psd.subtitle');
		
		if ($element=="menu") {
		
			$rows = $Page->find('all', array(
				'conditions' => array('Page.status' => 'public')
			));
			
			return $rows;
			
		}
		
		if ($element=="author") {
		
			$rows = $User->find('first', array(
				'conditions' => array('User.id' => $id)
			));
			
			return $this->text('Author:') .' ' .$rows["User"]["username"];
			
		}
		
		if ($element=="created") {
			
			return $this->Time->format(
			  'Y-m-d H:i:s',
			  $id,
			  null,
			  Configure::read('Config.timezone')
			);
				
		}
		
		if ($element=="image") {
		
			if ($model=="Page") $imageModel = $Page;
			else $imageModel = $Article;
			
			$image = $imageModel->find('first', array(
				'conditions' => array($model .'.id' => $id),
				'fields' => array($model .'.image')
			));
			
			return Configure::read('Psd.url') ."/files/uploads/" .$image[$model]["image"];
			
		}
		
		if ($element=="text") {
		
				$text = $Article->find('first', array(
					'conditions' => array('Article.id' => $id),
					'fields' => array('Article.text', 'Article.slug')
				));
			
			   if (strlen($text["Article"]["text"])>800) {
				
				   return $this->Text->truncate(
						$text["Article"]["text"],
						800,
						array(
							'ellipsis' => '...',
							'exact' => false
						)
					) .' <a href="' .$this->frontend('siteurl') .'/post/' .$text["Article"]["slug"] .'">' .$this->text('Read more') .'</a>';
					
			   }
			   else return $text["Article"]["text"];
			
		}
		
		if ($element=="tags") {
			
			$tags = $Article->find('first', array(
				'conditions' => array('Article.id' => $id),
				'fields' => array('Article.tags')
			));
			
			$arr = explode(",", $tags["Article"]["tags"]);
			
			return $arr;
			
		}
		
		if ($element=="latest") {
			
			$latest = $Article->find('all', array(
				'conditions' => array('Article.status' => 'published'),
				'order' => array('Article.id' => 'DESC' ),
				'limit' => 4,
				'fields' => array('Article.title', 'Article.slug')
			));
			
			return $latest;
			
		}
		
		if ($element=="categories") {
			
			$categories = $Categorie->find('all', array(
				'order' => array('Categorie.name' => 'ASC' ),
				'fields' => array('Categorie.name', 'Categorie.slug')
			));
			
			return $categories;
			
		}
		
		if ($element=="category") {
			
			$category = $Categorie->find('first', array(
				'conditions' => array('Categorie.id' => $id)
			));
			
			return '<a href="' .$this->frontend('siteurl') .'/category/' .$category["Categorie"]["slug"] .'">' .$category["Categorie"]["name"] .'</a>';
			
		}
		
		if ($element=="social") {
			
			$social = $Setting->find('first', array(
				'conditions' => array('Setting.id' => 1),
				'fields' => array('Setting.facebook_profile', 'Setting.googleplus_profile', 'Setting.instagram_profile', 'Setting.linkedin_profile', 'Setting.twitter_profile', 'Setting.youtube_profile')
			));
			
			return $social;
			
		}
		
	}
	
	
	
	
	public function getTitle($title = NULL) {
		
		if ($title!="error404" && $title!==NULL) return $title;
		else if ($title=="error404") return "Error 404 - " .Configure::read('Psd.name');
		else if ($title===NULL) return Configure::read('Psd.name');
		
	}
	
	
	
	
	public function getDescription($text = NULL) {
		
		if ($text!==NULL) return '<meta name="description" content="' .$text .'">';
		else return(false);
		
	}
	
	
	
	
	public function html() {
		
		$Setting = ClassRegistry::init('Setting');
		
		$og = $Setting->find('first', array(
			'conditions' => array('Setting.id' => 1)
		));
		
		if ($og["Setting"]["enableog"]==1) return '<html prefix="og: http://ogp.me/ns#">' ."\r\n";
		else return "<html>\r\n";
		
	}
	
	
	
	
	public function opengraph($params = array()) {
		
		$html = "";
		
		if (count($params)>0) {
			
			foreach($params as $param=>$value):
			
				$html .= '<meta property="og:' .$param .'" content="' .$value .'" />' ."\r\n";
			
			endforeach;
			
			return $html;
			
		}
		else return(false);
		
	}
	
	
	
	
	public function robots($type = NULL) {
	
		if ($type=="noindex") return '<meta name="robots" content="noindex">';
		if ($type=="nofollow") return '<meta name="robots" content="nofollow">';
		if ($type=="noindex,nofollow") return '<meta name="robots" content="noindex,nofollow">';
		
	}
	
	
}

?>