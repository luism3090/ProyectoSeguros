<?php 
	class ValidaLogin extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function verificarLogin($usuario)
		{
			
			$sql =	"select us.id_usuario,
							us.nombre,
							us.apellido_paterno,
							us.apellido_materno,
							ro.id_rol,
							ro.descripcion as rol,
							us.foto,
							us.correo
					from   
				    		usuarios us
				 	join rel_usuarios_roles usr 
				 				on(us.id_usuario = usr.id_usuario) 
					join cat_roles ro 
								on(usr.id_rol = ro.id_rol)
		         	where us.correo = ? and 
		         		  us.password = ? and 
		         		  us.estado = '1' ";


			$query = $this->db->query($sql,array($usuario["email"],$usuario["password"]));


			$datosLogin = array("msjCantidadRegistros" => 0, "msjNoHayRegistros" => '',"loginUsuario" => array());

			$datosLogin["msjCantidadRegistros"] = $query->num_rows(); 

			if($datosLogin["msjCantidadRegistros"] > 0)
			{
				$datosLogin["loginUsuario"] = $query->result(); 
			}
			else{
				$datosLogin["msjNoHayRegistros"] = "El nombre de usuario o contraseña son incorrectos";
			}
			

			return $datosLogin;



			// foreach ($query->result_array() as $row)
			// {
			//         echo $row['title'];
			//         echo $row['name'];
			//         echo $row['body'];
			// }

		}
	}
?>