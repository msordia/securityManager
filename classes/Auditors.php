<?php
class Auditors {
	private $_db,
	$_data = array(),
	$_auditorTableName = 'auditor';

	public function __construct() {
		$this->_db = DB::getInstance();
		
			$db = $this->_db->get($this->_auditorTableName, array("1" ,"=", "1"));

			if($db->count()) {
				$this->_data = $db->results() ;
			}
		
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function create($fields = array()) {
		if(!$this->_db->insert($this->_auditorTableName, $fields)) {
			throw new Exception('There was a problem creating the auditor.');
		}
	}

	public function update($fields = array(), $id = null) {
		if(!$this->_db->update($this->_auditorTableName, $id, $fields)) {
			throw new Exception('There was a problem updating the auditor.');
		}
	}

	public function data() {
		return $this->_data;
	}
}