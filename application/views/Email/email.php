<?php 

$host= gethostname();
$ip = gethostbyname($host);

$ruta = "http://".$ip.":8080/PhpCodeigniterPractica/public/uploads/".$foto;
//$ruta = "http://".$ip."/PhpCodeigniterPractica/public/uploads/".$foto;

?>

	<h3>Hola <?php echo $nombre.' '.$apellidos;?> este es un mensaje de prueba </h3><hr><br> prueba el siguiente
    enlace de descarga aqui: <br>
	<a href="<?php echo $ruta;?>" download>
		archivo
	</a>
