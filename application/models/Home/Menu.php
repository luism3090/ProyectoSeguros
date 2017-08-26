<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Menu extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function getElmentosMenu($id_rol)
		{

			

			$sql =	"select distinct
					me.id_elemento_menu,
					me.id_tipo_menu,
					me.hijos,
					me.descripcion,
					me.icono,
					me.id_elemento_padre_menu,
					me.controlador
					from usuarios usu
					join rel_usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
					join cat_roles rol on (usu_ro.id_rol = rol.id_rol)
					join rel_menu_usuarios rel_mu on (rol.id_rol = rel_mu.id_rol)
					join menus me on (rel_mu.id_elemento_menu = me.id_elemento_menu)
					where rol.id_rol = ? and me.id_tipo_menu = 1 and usu.estado = '1'
					order by id_elemento_menu";

					$query = $this->db->query($sql,array($id_rol));


			return $query->result();


		}


		public function getHijosElmentosMenu($id_elemento_menu,$id_rol)
		{
			$sql =	"select distinct
					me.id_elemento_menu,
					me.id_tipo_menu,
					me.hijos,
					me.descripcion,
					me.icono,
					me.id_elemento_padre_menu,
					me.controlador
					from usuarios usu
					join rel_usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
					join cat_roles rol on (usu_ro.id_rol = rol.id_rol)
					join rel_menu_usuarios rel_mu on (rol.id_rol = rel_mu.id_rol)
					join menus me on (rel_mu.id_elemento_menu = me.id_elemento_menu)
					where me.id_elemento_padre_menu = ? and rol.id_rol = ? and usu.estado = '1' ";

					$query = $this->db->query($sql,array($id_elemento_menu,$id_rol)); 


			return $query->result();
		}

	}
?>