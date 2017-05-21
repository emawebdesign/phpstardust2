<?php


class Page extends PhpstardustAppModel {
	
	public $actsAs = array('Phpstardust.Psd');
	
	
	public $validate = array(
		'title' => array(
			  'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'Title already exists.'
			  ),
			  'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Enter title.'
			  )
		),
		'image' => array(
			'rule' => array(
				'extension',
				array('gif', 'jpeg', 'png', 'jpg')
			),
			'message' => 'Please supply a valid image format.',
			'allowEmpty' => true
		),
		'status' => array(
            'valid' => array(
                'rule' => array('inList', array('public', 'private')),
                'message' => 'Select status.',
                'allowEmpty' => false
            )
        ),
		'size' => array(
			'rule' => 'notBlank',
			'message' => 'Enter size.',
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
	
	
	
	
	public function afterFind($results, $primary = false) {
		
		foreach ($results as $key => $val) {
			
			if (isset($val['Page']['tags'])) {
				
				$results[$key]['Page']['tags'] = $this->setTags(
					$val['Page']['tags']
				);
				
			}
			
		}
		
		return $results;
	}
	
	
	
	
	public function setTags($tags) {
		
		$arr = explode(" ", $tags);
		
		return implode(',', $arr);
		
	}
	
	
	
	
	public function beforeSave($options = array()) {
		
		if (!empty($this->data)) {
			$this->data = $this->cleanVars($this->data);
		}
		
		$this->data[$this->alias]['user_id'] = AuthComponent::user('id');
		if (isset($this->data[$this->alias]['title']) && !isset($this->data[$this->alias]['id'])) $this->data[$this->alias]['slug'] = $this->getSlug($this->data[$this->alias]['title']);
		
		if (isset($this->data[$this->alias]['tags'])) $this->data[$this->alias]['tags'] = $this->prepareTags($this->data[$this->alias]['tags']);
		
		if (isset($this->data[$this->alias]['noindex']) && $this->data[$this->alias]['noindex']=="N") $this->data[$this->alias]['noindex'] = 0;
			
		if (isset($this->data[$this->alias]['nofollow']) && $this->data[$this->alias]['nofollow']=="N") $this->data[$this->alias]['nofollow'] = 0;
		
		return true;
		
	}
	
	
	
	
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
	
	
}

?>
