<?php


class Specialpermission extends PhpstardustAppModel {
	
	public $actsAs = array('Phpstardust.Psd');
	
	
	public $validate = array(
		'customrole_id' => array(
			'rule' => 'notBlank',
			'message' => 'Select role.'
		),
		'controller' => array(
			'rule' => 'notBlank',
			'message' => 'Enter controller.'
		),
		'action' => array(
			'rule' => 'notBlank',
			'message' => 'Enter action.'
		),
		'permission' => array(
			'rule' => 'notBlank',
			'message' => 'Enter permission.'
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
		
		if (isset($this->data[$this->alias]['controller'])) {
			$this->data[$this->alias]['controller'] = str_replace(' ','',$this->data[$this->alias]['controller']);
			$this->data[$this->alias]['controller'] = strtolower($this->data[$this->alias]['controller']);
		}
		
		if (isset($this->data[$this->alias]['action'])) {
			$this->data[$this->alias]['action'] = str_replace(' ','',$this->data[$this->alias]['action']);
			$this->data[$this->alias]['action'] = strtolower($this->data[$this->alias]['action']);
		}
		
		if (isset($this->data[$this->alias]['customrole_id'])) {
			
			$name = $this->Customrole->find("first", array(
				"conditions" => array("Customrole.id" => $this->data[$this->alias]['customrole_id']),
				'fields' => array('Customrole.name')
			));
			
			$this->data[$this->alias]['name'] = $name["Customrole"]["name"];
		
		}
		
		return true;
		
	}
	
	
	
	
	public $belongsTo = array(
        'Customrole' => array(
            'className' => 'Customrole',
            'foreignKey' => 'customrole_id'
        )
    );
	
	
}

?>