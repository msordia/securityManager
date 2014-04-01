<?php
class Applications {
	private $_db,
	$_data = array(),
	$_applicationTableName = 'application';

	public function __construct() {
		$this->_db = DB::getInstance();
		
			$db = $this->_db->get($this->_applicationTableName, array('active', '=', '1'));

			if($db->count()) {
				$this->_data = $db->results() ;
			}
		
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function create($fields = array()) {
		if(!$this->_db->insert($this->_applicationTableName, $fields)) {
			throw new Exception('There was a problem creating the application.');
		}
	}

	public function update($fields = array(), $id = null) {
		if(!$this->_db->update($this->_applicationTableName, $id, $fields)) {
			throw new Exception('There was a problem updating the application.');
		}
	}

	public function data() {
		return $this->_data;
	}
}