<?php
class Department {
	private $_db,
	$_data = array(),
	$_departmentTableName = 'departamentos';

	public function __construct($id = null) {
		$this->_db = DB::getInstance();
		
		if($id) {
			//$data = $this->_db->get($this->_departmentTableName, array('id', '=', $id));
			$query="SELECT d.id,titulo,frase,z.nombre as zona,noRecamaras,noBanos,precio,notas,idAmenidades,direccion,coordenadas,idFotos,
					activa,amueblado,servicios,u.nombre,apellido,mail,telefono,celular 
					FROM departamentos d JOIN usuarios u JOIN zonas z 
					WHERE z.id = d.idZona AND d.id = '$id' and d.username = u.mail";

			$data = $this->_db->query($query);

			if($data->count()) {
				$this->_data = $data->first();
			}
		} else {
			return false;
		}
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function create($fields = array()) {
		if(!$this->_db->insert($this->_departmentTableName, $fields)) {
			throw new Exception('There was a problem creating the department.');
		}
	}

	public function update($fields = array(), $id = null) {
		if(!$this->_db->update($this->_departmentTableName, $id, $fields)) {
			throw new Exception('There was a problem updating.');
		}
	}

	public function data() {
		return $this->_data;
	}
}