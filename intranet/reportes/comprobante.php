<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: ../index.html");
	}
	require("../../conexion/config.php");
	require("../../conexion/baseDatos.php");
?>
<script language="javascript" type="text/javascript">
	function imprimir()
	{
		print();
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - DescuentoPersonal ::</title>
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
        <td><img src="../../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="142">
          <p align="center"><strong>DATOS VIAJE </strong></p>
          <table width="767" border="0" align="center">
            <tr>
              <td height="70"><div align="center">
                <table width="733" border="0">
                  <tr>
                    <td bgcolor="#00CC66"><div align="center"><strong>F. Salida </strong></div></td>
                    <td bgcolor="#00CC66"><div align="center"><strong>H. Llegada </strong></div></td>
                    <td bgcolor="#00CC66"><div align="center"><strong>F. Llegada </strong></div></td>
                    <td bgcolor="#00CC66"><div align="center"><strong>H. Llegada </strong></div></td>
                    <td bgcolor="#00CC66"><div align="center"><strong>Estado</strong></div></td>
                    <td bgcolor="#00CC66"><div align="center"><strong>Vehiculo</strong></div></td>
                    <td bgcolor="#00CC66"><div align="center"><strong>Ruta</strong></div></td>
                  </tr>
				 <?php
				 	$cod=$_POST["txtCodViaje"];
					$sql="SELECT V.FechaSalida, V.FechaLlegada, V.HoraSalida, V.HoraLlegada, V.estadoViaje, V.Vehiculo_placa, R.Nombre FROM viaje AS V INNER JOIN ruta AS R ON V.Ruta_CodigoRuta =R.CodigoRuta WHERE CodViaje=$cod;";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					if(mysql_num_rows($result)!=0)
					{
						$registro=mysql_fetch_object($result);
						//echo"<table><tr>";
						echo"<tr><td>".fechaFormato($registro->FechaSalida)."</td>";
						echo"<td>".$registro->HoraSalida."</td>";
						echo"<td>".fechaFormato($registro->FechaLlegada)."</td>";
						echo"<td>".$registro->HoraLlegada."</td>";
						echo"<td>".$registro->estadoViaje."</td>";
						echo"<td>".$registro->Vehiculo_placa."</td>";
						echo"<td>".$registro->Nombre."</td></tr>";
						//echo"</table>";
					}
					else
					{
						$band=0;
						echo"<tr> <div align=\"center\"> No existe Viaje registrado ... </div><tr>";
					}
				?>
                </table>
              </div></td>
              </tr>
            <tr>
              <td height="40"><div align="center"><strong>REPORTE DE COMPROBANTES POR VIAJE CON DETRACCION </strong></div></td>
              </tr>
            <tr>
              <td height="58"><div align="center">
                <table width="757" border="0">
                  <tr>
                    <td width="96" bgcolor="#00CC66"><div align="center"><strong>Cod Remito </strong></div></td>
                    <td width="89" bgcolor="#00CC66"> <div align="center"><strong>Tipo </strong></div></td>
                    <td width="59" bgcolor="#00CC66"><div align="center"><strong>Serie</strong></div></td>
                    <td width="110" bgcolor="#00CC66"><div align="center"><strong>Numero</strong></div></td>
                    <td width="124" bgcolor="#00CC66"><div align="center"><strong>Fecha</strong></div></td>
                    <td width="68" bgcolor="#00CC66"><div align="center"><strong>Total</strong></div></td>
                    <td width="165" bgcolor="#00CC66"><div align="center"><strong>Detraccion</strong></div></td>
					<td width="165" bgcolor="#00CC66"><div align="center"><strong>  </strong></div></td>
				</tr>
				  <?php
				  	$color="#ffffff";
					$sql="select distinct Comprobante_Codigo from articulo where Viaje_CodViaje=$cod;";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result3=$bdx->crearConsulta($sql);
					//echo"cod".$cod;
					while($reg3=mysql_fetch_object($result3))
					{
						//echo" Mensaje".$reg3->Comprobante_Codigo;
						$sql2="SELECT C.codigo, C.TipoComprobante, C.Serie, C.Numero, C.Fecha, C.total, S.RazonSocial, CL.Nombres, CL.ApellidoPaterno, CL.RazonSocial AS empresa, CL.TipoCliente  FROM ((comprobante AS C INNER JOIN sucursal AS S ON C.Sucursal_codigoSucursal=S.codigoSucursal) INNER JOIN cliente  AS CL ON C.Cliente_CodigoCliente=CL.codigoCliente) WHERE C.codigo=$reg3->Comprobante_Codigo AND C.Detraccion=1 AND C.TipoComprobante='Factura';";	
						$result4=$bdx->crearConsulta($sql2);
						$registro=mysql_fetch_object($result4);
						if($registro->codigo!=NULL)
						{
							echo"<tr bgcolor=$color><td>".$registro->codigo."</td>";
							echo"<td>".$registro->TipoComprobante."</td>";
							echo"<td>".$registro->Serie."</td>";
							echo"<td>".$registro->Numero."</td>";
							echo"<td>".fechaFormato($registro->Fecha)."</td>";
							echo"<td>".$registro->total."</td>";	
							echo"<td>".($registro->total*0.04)."</td>";
							echo"<td><a href=\"pagarDetraccion.php?cod=".$registro->codigo."&num=".$registro->Numero."&total=".$registro->total."\" target=\"blank\">Pagar detraccion</a></td>";		
							if($color=="#ffffff")
								$color="#cccccc";
							else
								$color="#ffffff";
						}
					}			
				  ?>
                </table>
              </div></td>
              </tr>
            <tr>
              <td height="37"><div align="center"><strong>REPORTE DE COMPROBANTES POR VIAJE SIN DETRACCION </strong></div></td>
              </tr>
            <tr>
              <td height="56"><div align="center">
                <table width="725" border="0">
                  <tr>
                    <td width="145" bgcolor="#00CC66"><div align="center"><strong>Cod Remito </strong></div></td>
                    <td width="131" bgcolor="#00CC66"><div align="center"><strong>Tipo</strong></div></td>
                    <td width="131" bgcolor="#00CC66"><div align="center"><strong>Numero</strong></div></td>
                    <td width="88" bgcolor="#00CC66"><div align="center"><strong>Serie</strong></div></td>
                    <td width="99" bgcolor="#00CC66"><div align="center"><strong>Fecha</strong></div></td>
                    <td width="91" bgcolor="#00CC66"><div align="center"><strong>Total</strong></div></td>
                  </tr>
				  <?php
				  		$color="#ffffff";
						 $sql="select distinct Comprobante_Codigo from articulo where Viaje_CodViaje=$cod;";
							$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
							$con=$bdx->conectar();
							$result3=$bdx->crearConsulta($sql);
							//echo"cod".$cod;
							while($reg3=mysql_fetch_object($result3))
							{
								//echo" Mensaje".$reg3->Comprobante_Codigo;
								$sql2="SELECT C.codigo, C.TipoComprobante, C.Serie, C.Numero, C.Fecha, C.total, S.RazonSocial, CL.Nombres, CL.ApellidoPaterno, CL.RazonSocial AS empresa, CL.TipoCliente  FROM ((comprobante AS C INNER JOIN sucursal AS S ON C.Sucursal_codigoSucursal=S.codigoSucursal) INNER JOIN cliente  AS CL ON C.Cliente_CodigoCliente=CL.codigoCliente) WHERE C.codigo=$reg3->Comprobante_Codigo AND C.Detraccion=0 AND C.TipoComprobante='Factura';";	
								$result4=$bdx->crearConsulta($sql2);
								$registro=mysql_fetch_object($result4);
								if($registro->codigo!=NULL)
								{	
									echo"<tr bgcolor=$color><td>".$registro->codigo."</td>";
									echo"<td>".$registro->TipoComprobante."</td>";
									echo"<td>".$registro->Numero."</td>";
									echo"<td>".$registro->Serie."</td>";
									echo"<td>".fechaFormato($registro->Fecha)."</td>";
									echo"<td>".$registro->total."</td>";	
									if($color=="#ffffff")
										$color="#cccccc";
									else
										$color="#ffffff";
								}
							}			
				  ?>
                </table>
              </div></td>
              </tr>
          </table>
          <div align="center">
			<label>
              <input name="Imprimir" type="button" id="Imprimir" value="Imprimir" onClick="imprimir()"/>
              </label>
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