<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location:../../index.html");
	}
	include("../../conexion/ajax.php");
	include("../../conexion/baseDatos.php");
	include("../../conexion/config.php");
?>
<script language="javascript" type="text/javascript">
function imprimir()
{		
	document.getElementById("imprimir").innerHTML = "";
	document.getElementById("noImprimir").innerHTML = "";
	print();
	//location.href="GuiaRemision.php";
	document.getElementById("form1").submit();		
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de Envios</title>
</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    <td height="195" align="center"><img src="../../imagenes/sup.jpg" width="780" height="193" /></td>
  </tr>
  <tr>
    <td height="47" align="center"><h1>Reporte de Envios</h1>
      <hr />
    </td>
  </tr>
  <tr>
    <td height="129">
    <form id="form1" name="form1" method="post" action="administrador.php">
    <table width="1145" border="1">
    <tr>
      <td height="35" colspan="9"><div align="center"><strong>DATOS DEL CLIENTE </strong></div></td>
    </tr>
    <?php
	  	$cod= $_POST["textNroIdent"];
		$tipo = $_POST["cbmIdent"];
		$cliente="";
		$sql="SELECT Nombres, ApellidoPaterno, ApellidoMaterno, direccionFiscal, RazonSocial, Telefono, Celular, email, CodigoCliente FROM cliente WHERE DNI='$cod' OR RUC='$cod';";
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();
		$result=$bd->crearConsulta($sql);
		if(mysql_num_rows($result)!=0)
		{
			$reg=mysql_fetch_object($result);
			$cliente=$reg->Nombres." ".$reg->ApellidoPaterno."".$cliente = $reg->RazonSocial;
			$cel=$reg->Telefono."-".$reg->Celular;
			$codigo=$reg->CodigoCliente;
		}
		else
		{
			print("CLIENTE CON $tipo numero $cod NO ESTA REGISTRADO EN EL SISTEMA .... POR LO TANTO NO TIENE CARGA REGISTRADA!!!!");
		}
	  ?>
    <tr>
      <table>
      <tr>
      <td width="10"><div align="center"><strong>DNI/RUC</strong></div></td>
      <td width="394"><div align="center"><strong>NOMBRE / RAZON SOCIAL </strong></div></td>
      <td colspan="300"><div align="center"><strong>DIR. FISCAL</strong></div></td>
      <td colspan="30"><div align="center"><strong>TELF</strong></div></td>
      <td width="30"><div align="center"><strong>EMAIL</strong></div></td>
    </tr>
    <tr>
      <td><div align="center"><?php print($cod)?></div></td>
      <td><div align="center"><?php print($cliente." ".$reg->ApellidoMaterno)?></div></td>
      <td colspan="3"><div align="center"><?php print($reg->direccionFiscal)?></div></td>
      <td colspan="2"><div align="center"><?php print($cel)?></div></td>
      <td><div align="center"><?php print($reg->email)?></div></td>
      <hr/>
    </tr>
    
   </table>
    <tr>
      <td height="38" colspan="9"><div align="center">
        <p><strong>MERCADERIA ENVIADA </strong></p><hr/>
        <table width="1116" border="0">
          <tr align="center">
            <td width="82" bgcolor="#00CC66"><strong>Cod Rem.</strong></td>
            <td width="268" bgcolor="#00CC66"><strong>Descripcion</strong></td>
            <td width="51" bgcolor="#00CC66"><strong>Total</strong></td>
            <td width="55" bgcolor="#00CC66"><strong>Viaje</strong></td>
            <td width="51" bgcolor="#00CC66"><strong>Fecha</strong></td>
            <td width="58" bgcolor="#00CC66"><strong>No Fact.</strong></td>
            <td width="63" bgcolor="#00CC66"><strong>No Guia</strong></td>
            <td width="454" bgcolor="#00CC66"><strong>Destinatario</strong></td>
          </tr>
           <?php
	  		$sql="SELECT A.Descripcion, A.Destinatario, A.Viaje_CodViaje, A.Comprobante_Codigo, C.Numero, C.nGuiaRemision, C.total, C.Fecha, CL.RUC, CL.DNI FROM ((articulo AS A INNER JOIN comprobante AS C ON A.Comprobante_Codigo=C.codigo) INNER JOIN cliente AS CL ON A.Cliente_CodigoCliente=CL.CodigoCliente) WHERE A.Cliente_CodigoCliente='$codigo' AND A.activo=1 ORDER BY A.Comprobante_Codigo DESC; ";
			$color="#ffffff";
			$result=$bd->crearConsulta($sql);
			if(mysql_num_rows($result)!=0)
			{
				while($reg=mysql_fetch_object($result))
				{
					/*$sql1="SELECT fecha FROM pago WHERE comprobante_codigo=$reg->Comprobante_Codigo ORDER BY fecha DESC;";
					$result1=$bd->crearConsulta($sql1);		
					if(mysql_num_rows($result1)!=0)
					{
						$reg1=mysql_fetch_object($result1);
						$fechaPago=$reg1->fecha;
					}
					else
					{
						$fechaPago="no pago";
					}
					$doc=$reg->DNI.$reg->RUC;*/
					print("<tr bgcolor=$color><td><div align=\"center\"><strong>".$reg->Comprobante_Codigo."</strong></div></td>");
					print("<td width=\"168\"><div align=\"center\"><strong>".$reg->Descripcion."</strong></div></td>");
					//print("<td width=\"70\"><div align=\"center\"><strong>".$fechaPago."</strong> </div></td>");
					//print("<td width=\"168\"><div align=\"center\"><strong>".$reg->EstadoPago."</strong></div></td>");
					print("<td width=\"168\"><div align=\"center\"><strong>".$reg->total."</strong></div></td>");
					print("<td width=\"168\"><div align=\"center\"><strong>".$reg->Viaje_CodViaje."</strong></div></td>");
					//print("<td width=\"168\"><div align=\"center\"><strong>".$reg->Vehiculo_placa."</strong></div></td>");
					print("<td width=\"78\"><div align=\"center\"><strong>".$reg->Fecha."</strong></div></td>");
					//print("<td width=\"168\"><div align=\"center\"><strong>".$reg->estadoViaje."</strong></div></td>");
					print("<td width=\"168\"><div align=\"center\"><strong>".$reg->Numero."</strong></div></td>");
					print("<td width=\"168\"><div align=\"center\"><strong>".$reg->nGuiaRemision."</strong></div></td>");
					print("<td><div align=\"center\"><strong>".$reg->Destinatario."-".$doc."</strong></div></td></tr>");
					if($color=="#ffffff")
						$color="#cccccc";
					else
						$color="#ffffff";
				}
			}
			else
			{
				print("No tiene Carga Registrada aun !!!");
			}
	  ?>
        </table>
        <p>&nbsp;</p>
      </div></td>
    </tr>
    <tr>
      <td width="34">&nbsp;</td>
      <td colspan="3"><input name="btnImprimir" type="button" id="btnImprimir" value="Imprimir" onClick="imprimir()"/>        <div  id="imprimir" align="center"></div></td>
      <td colspan="3"><div id="noImprimir" align="center">
        <input type="submit" name="Submit2" value="Exportar a Excel" />
      </div></td>
      <td width="950">&nbsp;</td>
      <td width="29">&nbsp;</td>
    </tr>
    </table>
  </form>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>