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