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

class Redirect {
	public static function to($location = null) {
		if($location) {
			if(is_numeric($location)) {
				switch($location) {
					case 404:
						header('HTTP/1.0 404 Not Found');
						include ('includes/errors/404.php');
						exit();
					break;
				}
			} else {
				header('Location: ' . $location);
				exit();
			}
		}
	}
}