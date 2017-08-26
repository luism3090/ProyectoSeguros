<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class InsertarPermisosRoles extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function insertElementsPermisosRoles($datosElementosMenu,$id_rol)
		{

			$this->db->trans_begin();


			$id_elemento_menu = "";


				$sql1 = "Delete from rel_menu_usuarios where id_rol = ? ";
				

					$query1 = $this->db->query($sql1,array($id_rol));


		

					$sql2 = "insert into rel_menu_usuarios 
																	(
																		id_elemento_menu,
																		id_rol
																	) 
																		values
																	(
																		?,
																		?
																	)
																	";

					foreach ($datosElementosMenu as $clave => $valor) 
					{
					    
					     $id_elemento_menu = $valor["id_elemento_menu"];

					     $query2 = $this->db->query($sql2,array($id_elemento_menu,$id_rol));
					    
					}

			
				   $datos = array("msjConsulta" => '');

					if ($this->db->trans_status() === FALSE)
					{
							$datos["msjConsulta"] = "Falló al ingresar los datos intente de nuevo";

					        $this->db->trans_rollback();
					}
					else
					{
						$datos["msjConsulta"] = "Los datos han sido guardados correctamente";

					    $this->db->trans_commit();
					}

				   return $datos;


			// return $query->result();


		}


	}
?>