<?php


class Setting extends PhpstardustAppModel {
	
	public $actsAs = array('Phpstardust.Psd');
	
	public $validate = array(
		'title' => array(
			'rule' => 'notBlank',
			'message' => 'Enter title.',
			'required' => true,
			'on' => 'update'
		),
		'image' => array(
			'rule' => array(
				'extension',
				array('gif', 'jpeg', 'png', 'jpg')
			),
			'message' => 'Please supply a valid image format.',
			'allowEmpty' => true
		),
		'file' => array(
			'rule' => array(
				'extension',
				array('sql')
			),
			'message' => 'Please supply a SQL format.',
			'allowEmpty' => true
		)
    );
	
	
	
	
	public function cleanVars($data) {
		if (is_array($data)) {
			foreach ($data as $key => $var) {
				$data[$key] = $this->cleanVars($var);
			}
		} else {
			$data = strip_tags($data, Configure::read('Psd.allowedHtmlTags'));
			$data = trim($data);
		}
		
		return $data;
	}
	
	
	
	
	public function beforeSave($options = array()) {
		
		if (!empty($this->data)) {
			$this->data = $this->cleanVars($this->data);
		}
		
		return true;
		
	}
	
	
}

?>