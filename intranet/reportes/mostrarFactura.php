<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.php");
	}	
	
	include("../../conexion/ajax.php");
	require("../../conexion/config.php");
	require("../../conexion/baseDatos.php");
	
	/*$guiaR = $_GET["guiaRemision"];	
	$codComp = $_GET["codC"];*/
?>
<script language="javascript" type="text/javascript">
	function buscarComp()
	{
		agregarCargando('cargando');		
		nroFactura = document.getElementById("txtNroFactura").value;
		if(nroFactura.length==0)
		{
			alert("¡ Debe ingresar un numero de Factura !");
			quitarCargando('cargando');		
			return;						
		}
		_obj = crearObjeto();			
		_url = "../ajaxManejador.php";
		_valores = "op=buscarCompFactura&nroFactura=" + nroFactura;
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
						alert("¡ No existe una Factura con tal número!");
						document.getElementById("txtNroFactura").value = "";
						document.getElementById("fecha").innerHTML = "";
						document.getElementById("total").innerHTML = "";
						document.getElementById("guia").innerHTML = "";
					}
					else
					{
						resp = resp.split("*");
						document.getElementById("fecha").innerHTML = resp[0];
						document.getElementById("total").innerHTML = resp[1];
						document.getElementById("guia").innerHTML = resp[2];
						/*document.getElementById("dirDestino").innerHTML = resp[3];
						document.getElementById("codC").value = resp[4];
						document.getElementById("guiaRemision").value = nroGuia;*/
					}
					quitarCargando('cargando');	
				}
			}
		}
	}
	function validar()
	{
		agregarCargando('cargando');		
		nroFactura = document.getElementById("txtNroFactura").value;
		//montoEsc = document.getElementById("txtMontoEscrito").value;
		//nroGuia = document.getElementById("textNroGuiaRem").value;
		
		if(nroFactura.length==0)
		{
			alert("¡ Todos los campos deben estar llenos !");
			quitarCargando('cargando');		
			return;	
		}
		document.getElementById("form1").submit();
	}
	
	function go()
	{
		location.href="../administrador.php";
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
º<table width="1003" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="156" background="../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="../../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="263"><div align="center">
          <form id="form1" name="form1" method="POST" action="mostrarCompFactura.php">
            <p>&nbsp;</p>
            <table width="410" border="0">
			<tr>
                <td height="52" colspan="3"><div align="center"><strong>GENERAR COMPROBANTE</strong></div></td>
                </tr>
              <tr>
                <td height="34"><em><strong>Nro de Factura:</strong></em></td>
                <td><label>
                  <input name="txtNroFactura" type="text" id="txtNroFactura" />
                </label></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26"><div align="center">(Serie-Numero)</div></td>
                <td><label>
                  <input name="Buscar" type="button" id="Buscar" value="Buscar" onClick="buscarComp()" />
                </label></td>
                <td><div align="center" id="cargando"></div></td>
              </tr>
              <tr>
                <td height="31"><em><strong>Nro Guia de Remision </strong></em></td>
                <td><div align="justify" id="guia"></div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="28"><em><strong>fecha:</strong></em></td>
                <td><div align="justify" id="fecha"></div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="32"><em><strong>Total</strong></em></td>
                <td><div align="justify" id="total"></div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="160">&nbsp;</td>
                <td width="157">&nbsp;</td>
                <td width="79">&nbsp;</td>
              </tr>
              <tr>
                <td height="21">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
			   <tr>
                <td>&nbsp;</td>
                <td><label></label></td>
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