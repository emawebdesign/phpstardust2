<?php


class Customrole extends PhpstardustAppModel {
	
	public $actsAs = array('Phpstardust.Psd');
	
	
	public $validate = array(
		'name' => array(
			  'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Name already exists.'
			  ),
			  'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Enter name.'
			  )
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
		
		if (isset($this->data[$this->alias]['name']) && !isset($this->data[$this->alias]['id'])) $this->data[$this->alias]['slug'] = $this->getSlug($this->data[$this->alias]['name']);
		
		if (isset($this->data[$this->alias]['name'])) $this->data[$this->alias]['name'] = strtolower($this->data[$this->alias]['name']);
		
		return true;
		
	}
	
	
	
	
	public $hasMany = array(
        'Specialpermission' => array(
            'className' => 'Specialpermission'
        )
    );
	
	
}

?>