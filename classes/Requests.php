<?php

/*
Octopus - Security Manager
Copyright (C) 2014 - ITESM

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.


Authors:
	
- ITESM representatives
   Ing. Martha Sordia Salinas <msordia@itesm.mx>
   Dr. Juan Arturo Nolazco Flores <jnolazco@itesm.mx>
   Ing. Maria Isabel Cabrera Cancino <marisa.cabrera@tecvirtual.mx>


- ITESM students
	Jose Leal 
	Alejandro Cristerna
	Raul Vanoye
*/

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
			$this->_data = $db->results();
		}
		return $this->_data;
	}

	public function getRequest($id = null) {
		if($id == null) 
			return;

		$db = $this->_db->get($this->_requestsTableName, array('id', '=', $id));

		if($db->count()) {
			$this->_data = $db->results();
		}
		return $this->_data;
	}

	public function getAllRequests() {
		$db = $this->_db->get($this->_requestsTableName, array('pending', '=', '1'));

		if($db->count()) {
			$this->_data = array_slice($db->results(), 0, 1);
		}
		return $this->_data;
	}

	public function getRequestReport($applicationToken, $dateFrom, $dateTo) {
		$sql = "SELECT r.id, r.date, r.reason, r.duration, r.username, r.usermail, r.approved FROM access r where r.applicationToken = '$applicationToken' AND r.date between '$dateFrom' and '$dateTo'";
		$db = $this->_db->query($sql);

		if($db->count()) {
			$this->_data = $db->results();
		}
		return $this->_data;
	}


	public function insert($fields = array()) {
		if(!$this->_db->insert($this->_requestsTableName, $fields)) {
			throw new Exception('There was a problem creating the request.');
		}else{
			return true;
		}
	}

	public function update($fields = array(), $id = null) {
		if(!$this->_db->update($this->_requestsTableName, $id, $fields)) {
			throw new Exception('There was a problem updating the request.');
		}
	}

	public function data() {
		return $this->_data;
	}
}