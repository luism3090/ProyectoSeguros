<!DOCTYPE html>
<html>
<head>
	<title>¿Olvidaste Tu Contraseña? </title>
</head>
<body>
<?php 
		date_default_timezone_set('America/Mexico_City');

		$fechaHoy = date('j-m-y');
		$horaHoy = date('h:i a');

		$fechayHora =  $fechaHoy." a las ".$horaHoy;
?>
	<h2>¿Olvidaste Tu Contraseña?</h2>
	<p>Hemos recibió una solicitud para restablecer la contraseña de tu cuenta <?php echo $email ?> el <?php echo $fechayHora; ?></p>
	<br><br>
	Si deseas restablecer tu contraseña, por favor pulsa el siguiente enlace, o cópialo y pégalo en tu navegador:
	<br><br>
	<?php 
		$url = base_url()."index.php/OlvidarPassword/cambiarContrasena?token=".$token;
	?>
	<a href="<?php echo base_url();?>index.php/OlvidarPassword/cambiarContrasena?token=<?php echo $token; ?>"><?php echo $url; ?></a>
	<br><br>
	<p>Por favor ten en cuenta que solo puedes usar este enlace una vez. Si necesitas restablecer tu contraseña nuevamente, por favor pulsa aquí: 
		<a href="<?php echo base_url();?>index.php/OlvidarPassword" class="forgot-password" >
          Restablece tu contraseña.
        </a> 
	</p>
	<br><br>
	<p>
		Si no quieres restablecer tu contraseña, por favor ignora este mensaje y tu contraseña no se cambiará. Si tienes alguna pregunta o inquietud, por favor ponte en contacto con nosotros a través del Soporte.
	</p>
	<br><br><br><br>

</body>
</html>