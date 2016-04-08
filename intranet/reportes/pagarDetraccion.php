<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: ../index.html");
	}
	require("../../conexion/config.php");
	require("../../conexion/baseDatos.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--
<SCRIPT language="javascript"> 
	function imprimir() { 
	if ((navigator.appName == "Netscape"))
	{
		window.print() ; 
	}
	else
	{
		var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 	CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>'; 
		document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
		WebBrowser1.ExecWB(6, -1);
		WebBrowser1.outerHTML = ""; 
	} 
} 
</SCRIPT> -->
<style type="text/css">
<!--
.Estilo2 {font-weight: bold}
-->
</style>
<title>:: Transportes Marin Hermanos - Pago de Detracciones ::</title></head>

<body>
<table width="1003" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="156" background="../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="819">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="142"><table width="320" border="0" align="center">
          <tr>
            <td height="58" colspan="2"><div align="center"><strong>PAGO DE DETRACCIONES </strong></div></td>
            </tr>
			<?php
				$cod=$_GET["cod"];
				$num=$_GET["num"];
				$total=$_GET["total"];
				$detraccion=$total*0.04;
				//print(" paramtros".$cod." - ".$num." -  ".$total);
			?>
          <tr>
            <td width="152" height="21"><div align="justify"><em><strong>Codigo</strong></em></div></td>
            <td width="158">              <label>
              <div align="center"><?php print($cod);?></div>
            </label>            </td>
          </tr>
          <tr>
            <td height="21"><em><strong>Nro Comprobante : </strong></em></td>
            <td><div align="center"><?php print($num);?></div></td>
          </tr>
          <tr>
            <td height="21"><div align="justify"><em><strong>Total:</strong></em></div></td>
            <td>              <label>
              <div align="center"><?php print($total);?></div>
            </label>            </td>
          </tr>
          <tr>
            <td height="21"><em><strong>Detraccion:</strong></em></td>
            <td> <div align="center"><?php print($detraccion);?></div></td>
          </tr>
          <tr>
            <td height="35" colspan="2">&nbsp;</td>
            </tr>
          <tr>
            <td height="21"><em><strong>Fecha de Pago : </strong></em></td>
            <td><input name="txtFechaPago" type="text" id="txtFechaPago" /></td>
          </tr>
          <tr>
            <td height="21"><em><strong>Codigo Pago:</strong></em></td>
            <td><input name="txtCodigoPago" type="text" id="txtCodigoPago" /></td>
          </tr>
          <tr>
            <td height="21">&nbsp;</td>
            <td><?php print(date('Y-m-d'));?></td>
          </tr>
          <tr>
            <td height="21">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="21"><div align="center">
              <input name="btnPagar" type="button" id="btnPagar" value="Pagar" />
            </div></td>
            <td><div align="center">
              <input name="btnCancelar" type="button" id="btnCancelar" value="Cancelar" />
            </div></td>
          </tr>
          <tr>
            <td height="35">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
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

