<?php


App::uses('ModelBehavior', 'Model');


class PsdBehavior extends ModelBehavior {


	public function text($text = "", $lang = NULL) {
		
		//require Configure::read('Psd.rootPath') .DS .'app' .DS .'Plugin' . DS . 'Phpstardust' .DS .'Config' .DS .'locale.php';
		$pluginPath = App::pluginPath('Phpstardust');
		require $pluginPath .'Config' .DS .'locale.php';
	
		if (!CakeSession::check('Config.language')) {
			Configure::write('Config.language', 'en');
			CakeSession::write('Config.language', 'en');	
		}
		
		if ($lang!==NULL) {
			
			Configure::write('Config.language', $lang);
			CakeSession::write('Config.language', $lang);
			
		}
		
		return $locale[$text][CakeSession::read('Config.language')];
		
	}
	
	
	
	
	public function getSlug(Model $Model, $text = "") {
		
		return strtolower(Inflector::slug($text,'-'));
		
	}
	
	
	
	
	public function prepareTags(Model $Model, $tags = "") {
		
		$arr = explode(",", $tags);
		
		$text = implode(" ", $arr);
		
		return $text;
		
	}
	
	
	
	
	public function afterValidate(Model $Model, $options = array()) {
		
		$translation = array();
		
		foreach($Model->validationErrors as $key => $value):
		
			$translation[$key][] = $this->text($value[0]);
		
		endforeach; 
		
		unset($Model->validationErrors);
		
		$Model->validationErrors = $translation;
	
	}


}

?>