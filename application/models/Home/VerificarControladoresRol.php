<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class VerificarControladoresRol extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function VerifyControlesRol($id_rol)
		{

			if($id_rol != "3")
			{
					$sql =	"select  CONCAT('Home,',ifnull(group_concat(me.controlador),'')) as controladores
							from menus me
							join rel_menu_usuarios rmu on me.id_elemento_menu = rmu.id_elemento_menu
							join cat_roles rol on rmu.id_rol = rol.id_rol 
							where me.controlador is not null and rol.id_rol = ?";
			}
			else
			{
				$sql =	"select  CONCAT(ifnull(group_concat(me.controlador),'')) as controladores
							from menus me
							join rel_menu_usuarios rmu on me.id_elemento_menu = rmu.id_elemento_menu
							join cat_roles rol on rmu.id_rol = rol.id_rol 
							where me.controlador is not null and rol.id_rol = ?";
			}

		

					$query = $this->db->query($sql,array($id_rol));


			$datos = array("msjCantidadRegistros" => 0, "msjNoHayRegistros" => '' ,"controllers" => array());


				$datos["msjCantidadRegistros"] = $query->num_rows(); 

				if($datos["msjCantidadRegistros"] > 0)
				{
					$datos["controllers"] = $query->result(); 
					
				}
				else{
					$datos["msjNoHayRegistros"] = "No hay ningun controlador para ese rol";
				}

				return $datos;


		}



	}
?>