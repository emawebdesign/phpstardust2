<?php

App::uses('ConnectionManager', 'Model');

class SettingsController extends PhpstardustAppController {
	
	private $entity = "Setting";
	
	
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
			
			if ($this->request->data[$this->entity]["ogimage"]["name"]!="") {
				
				$newfile = $this->Psd->upload($this->entity,'ogimage');
				$this->request->data[$this->entity]["ogimage"] = $newfile["name"];
				$this->Psd->deleteFile($row[$this->entity]["ogimage"]);
				
			}
			else $this->request->data[$this->entity]["ogimage"] = $row[$this->entity]["ogimage"];
			
			if ($this->{$this->entity}->save($this->request->data)) {
				 
				 $this->Session->setFlash(
					$this->Psd->text('Data has been modified.'), 'flash_success'
				);
				
				return $this->redirect(array('action' => 'edit', $id));
				
			}
			
		}
	
		if (!$this->request->data) $this->request->data = $row;
		
	}
	
	
	
	
	function backupDb($tables = '*') {
		
		//$tables Comma separated list of tables you want to download, or '*' for all tables.
		$return = '';
	
		$modelName = $this->modelClass;
	
		$dataSource = $this->{$modelName}->getDataSource();
		$databaseName = $dataSource->getSchemaName();
	
		$return .= '-- Database: `' . $databaseName . '`' . "\n";
		$return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";
	
		if ($tables == '*') {
			$tables = array();
			$result = $this->{$modelName}->query('SHOW TABLES');
			foreach($result as $resultKey => $resultValue){
				$tables[] = current($resultValue['TABLE_NAMES']);
			}
		} else {
			$tables = is_array($tables) ? $tables : explode(',', $tables);
		}
	
		foreach ($tables as $table) {
			$tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);
	
			$return .= 'DROP TABLE IF EXISTS ' . $table . ';';
			$createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
			$createTableEntry = current(current($createTableResult));
			$return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";
	
			foreach($tableData as $tableDataIndex => $tableDataDetails) {
	
				$return .= 'INSERT INTO ' . $table . ' VALUES(';
	
				foreach($tableDataDetails[$table] as $dataKey => $dataValue) {
	
					if(is_null($dataValue)){
						$escapedDataValue = 'NULL';
					}
					else {
	
						$escapedDataValue = mb_convert_encoding( $dataValue, "UTF-8", "ISO-8859-1" );
	
						$escapedDataValue = $this->{$modelName}->getDataSource()->value($escapedDataValue);
					}
	
					$tableDataDetails[$table][$dataKey] = $escapedDataValue;
				}
				$return .= implode(',', $tableDataDetails[$table]);
	
				$return .= ");\n";
			}
	
			$return .= "\n\n\n";
		}
	
		$dbName = strtolower(Inflector::slug(Configure::read('Psd.name'),'-'));
		
		$fileName = $dbName . '-backup-' . date('Y-m-d_H-i-s') . '.sql';
	
		$this->autoRender = false;
		$this->response->type('Content-Type: text/x-sql');
		$this->response->download($fileName);
		$this->response->body($return);
	}
	
	
	
	
	public function importDb() {
		
		$this->set('model', $this->entity);
		
        if ($this->request->is('post')) {
			
			if ($this->request->data[$this->entity]["file"]["name"]!="") {
				
				$newfile = $this->Psd->upload($this->entity,'file');
				
				$filename = Configure::read('Psd.uploads') .$newfile["name"];
				
				$pathinfo = pathinfo($filename);
				$ext = strtolower($pathinfo['extension']);
				
				if ($ext=="sql") {
				
				$sql = new File($filename);
				$code = $sql->read(true, 'r');
				
				$result = $this->{$this->entity}->query($code);
				
				if ($result) {
					
					$this->Psd->deleteFile($newfile["name"]);
					
					$this->Session->setFlash(
						$this->Psd->text('Database has been imported.'), 'flash_success'
					);
					
					return $this->redirect(array('controller' => 'pages', 'action' => 'dashboard'));
				
				}
				
				}
				else {
					
					$this->Psd->deleteFile($newfile["name"]);
					
					$this->Session->setFlash(
						$this->Psd->text('Choose SQL file.'), 'flash_warning'
					);
				
                	return $this->redirect(array('action' => 'importDb'));
					
				}
				
			}
			else {
				
				$this->Session->setFlash(
					$this->Psd->text('Choose SQL file.'), 'flash_warning'
				);
				
                return $this->redirect(array('action' => 'importDb'));
				
			}
			
        }
		
    }
	
	
}


?>