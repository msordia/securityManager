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

class User {
	private $_db,
	$_sessionName = null,
	$_cookieName = null,
	$_data = array(),
	$_isLoggedIn = false,
	$_userTableName = 'user';

	public function __construct($user = null) {
		$this->_db = DB::getInstance();
		
		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		// Check if a session exists and set user if so.
		if(Session::exists($this->_sessionName) && !$user) {
			$user = Session::get($this->_sessionName);

			if($this->find($user)) {
				$this->_isLoggedIn = true;
			} else {
				$this->logout();
			}
		} else {
			$this->find($user);
		}
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function find($user = null) {
		// Check if user_id specified and grab details
		if($user) {
			$field = (is_numeric($user)) ? 'id' : 'mail';
			$data = $this->_db->get($this->_userTableName, array($field, '=', $user));

			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function create($fields = array()) {
		if(!$this->_db->insert('usuarios', $fields)) {
			throw new Exception('There was a problem creating an account.');
		}
	}

	public function checkIsLoggedIn(){
		//el usuario no esta logeado
		if(!$this->isLoggedIn()) {  
			Redirect::to('index.php');
			exit();
		}

		return true;
	}

	public function checkIsValidUser(){
		//no exste usuario para ese mail o el usuario si existe pero no esta logeado
		if(!$this->exists() || !$this->isLoggedIn()) {  
			Redirect::to('index.php');
			exit();
		}
		return true;
	}

	public function update($fields = array(), $id = null) {
		if(!$id && $this->isLoggedIn()) {
			$id = $this->data()->id;
		}

		if(!$this->_db->update($this->_userTableName, $id, $fields)) {
			throw new Exception('There was a problem updating.');
		}
	}

	public function login($username = null, $password = null, $remember = false) {
		if(!$username && !$password && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->id);
		} else {
			$user = $this->find($username);
			if($user) {
				if($this->data()->password === Hash::make($password, $this->data()->salt)) {
					Session::put($this->_sessionName, $this->data()->mail);
					$this->_isLoggedIn = true;

					if($remember) {
						$hash = Hash::unique();
						$hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

						if(!$hashCheck->count()) {
							$this->_db->insert('users_session', array(
								'user_id' => $this->data()->id,
								'hash' => $hash
								));
						} else {
							$hash = $hashCheck->first()->hash;
						}

						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}

					return true;
				}
			}
		}

		return false;
	}

	public function hasPermission($key) {
		$group = $this->_db->query("SELECT * FROM groups WHERE id = ?", array($this->data()->group));

		if($group->count()) {
			$permissions = json_decode($group->first()->permissions, true);

			if($permissions[$key] === 1) {
				return true;
			}
		}

		return false;
	}

	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}

	public function data() {
		return $this->_data;
	}

	public function logout() {
		$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

		Cookie::delete($this->_cookieName);
		Session::delete($this->_sessionName);
	}
}