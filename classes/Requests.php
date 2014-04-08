<?php
class Requests {
	private $_db,
	$_data = array(),
	$_requestsTableName = 'access',
	$_applicationTableName = 'application';

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function getAllPendingRequests() {
		$sql = "SELECT r.id, a.name as appName, r.date, r.reason, r.duration, r.username, r.usermail, r.applicationToken FROM access r JOIN application a where r.pending = '1' AND a.token = r.applicationToken";
		$db = $this->_db->query($sql);

		if($db->count()) {
			$this->_data = $db->results() ;
		}
		return $this->_data;
	}



	public function getAllRequests() {
		$db = $this->_db->get($this->_requestsTableName, array('pending', '=', '1'));

		if($db->count()) {
			$this->_data = $db->results() ;
		}
		return $this->_data;
	}


	public function insert($fields = array()) {
		if(!$this->_db->insert($this->_requestsTableName, $fields)) {
			throw new Exception('There was a problem creating the application.');
		}else{
			return true;
		}
	}

	public function update($fields = array(), $id = null) {
		if(!$this->_db->update($this->_requestsTableName, $id, $fields)) {
			throw new Exception('There was a problem updating the application.');
		}
	}

	public function data() {
		return $this->_data;
	}
}