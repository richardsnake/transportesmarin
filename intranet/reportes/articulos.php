<?php
	require("../../conexion/config.php");
	require("../../conexion/baseDatos.php");
	
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}	
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
        <td align="center"><img src="../../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="142">
          <p align="center"><strong>DATOS COMPROBANTE </strong></p>
          <table width="767" border="0" align="center">
            <tr>
              <td height="70"><div align="center">
                <table width="914" border="0">
                  <tr>
                    <td width="55" bgcolor="#00CC66"><div align="center"><strong>Codigo</strong></div></td>
                    <td width="48" bgcolor="#00CC66"><div align="center"><strong>Tipo </strong></div></td>
                    <td width="46" bgcolor="#00CC66"><div align="center"><strong>Serie</strong></div></td>
                    <td width="69" bgcolor="#00CC66"><div align="center"><strong>Numero</strong></div></td>
                    <td width="61" bgcolor="#00CC66"><div align="center"><strong>Fecha</strong></div></td>
                    <td width="44" bgcolor="#00CC66"><div align="center"><strong>Total</strong></div></td>
                    <td width="150" bgcolor="#00CC66"><div align="center"><strong>Remitente</strong></div></td>
                    <td width="114" bgcolor="#00CC66"><div align="center"><strong>Destinatario</strong></div></td>
                    <td width="73" bgcolor="#00CC66"><div align="center"><strong>Estado</strong></div></td>
					<td width="67" bgcolor="#00CC66"><div align="center"><strong>Placa</strong></div></td>
					<td width="117" bgcolor="#00CC66"><div align="center"><strong>Fecha Salida</strong></div></td>
                    </tr>
				 <?php
				 	$num=$_POST["txtNumero"];
					$camp=$_POST["cmbCampo"];
					$sql="SELECT C.codigo, C.TipoComprobante, C.Serie, C.Numero, C.Fecha, C.total, A.Remitente, A.Destinatario, V.estadoViaje,  V. Vehiculo_placa, V.FechaSalida, A.Viaje_CodViaje FROM ((comprobante AS C INNER JOIN articulo AS A ON C.codigo=A.Comprobante_Codigo) INNER JOIN viaje AS V  ON A.Viaje_CodViaje=V.CodViaje) WHERE $camp='$num';";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					if(mysql_num_rows($result)!=0)
					{	
						$registro=mysql_fetch_object($result);
						echo"<tr><td>".$registro->codigo."</td>";
						echo"<td>".$registro->TipoComprobante."</td>";
						echo"<td>".$registro->Serie."</td>";
						echo"<td>".$registro->Numero."</td>";
						echo"<td>".fechaFormato($registro->Fecha)."</td>";
						echo"<td>".$registro->total."</td>";
						echo"<td>".$registro->Remitente."</td>";
						echo"<td>".$registro->Destinatario."</td>";
						echo"<td>".$registro->estadoViaje."</td>";
						echo"<td>".$registro->Vehiculo_placa."</td>";
						echo"<td>".fechaFormato($registro->FechaSalida)."</td></tr>";
						
						
						$cod=$registro->codigo;
						//echo"Codigo: ".$cod;
					}
					else
					{
						$band=0;
						echo"<tr> <div align=\"center\"> No existe Comprobante ... </div><tr>";
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
                <table width="928" border="0">
                  <tr>
                    <td width="62" bgcolor="#00CC66"><div align="center"><strong>Cod</strong></div></td>
                    <td width="177" bgcolor="#00CC66"> <div align="center"><strong>Descripcion</strong></div></td>
                    <td width="99" bgcolor="#00CC66"><div align="center"><strong>Peso</strong></div></td>
                    <td width="94" bgcolor="#00CC66"><div align="center"><strong>Flete</strong></div></td>
                    <td width="92" bgcolor="#00CC66"><div align="center"><strong>Tipo</strong></div></td>
                    <td width="105" bgcolor="#00CC66"><div align="center"><strong>Entrega</strong></div></td>
                    <td width="132" bgcolor="#00CC66"><div align="center"><strong>T. Pago </strong></div></td>
                    <td width="115" bgcolor="#00CC66"><div align="center"><strong>E. Pago </strong></div></td>
                  </tr>
				  <?php
				  	if($cod!=NULL)
					{
						//echo "viaje: ".$viaje;
						$sql="select * from articulo WHERE Comprobante_Codigo=$cod;";
						$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
						$con=$bdx->conectar();
						$result3=$bdx->crearConsulta($sql);
						while($reg3=mysql_fetch_object($result3))
						{
								echo"<tr><td>".$reg3->CodigoArticulo."</td>";
								echo"<td>".$reg3->Descripcion."</td>";
								echo"<td>".$reg3->Peso."</td>";
								echo"<td>".$reg3->Flete."</td>";
								echo"<td>".$reg3->TipoArticulo."</td>";
								echo"<td>".$reg3->TipoEntrega."</td>";	
								echo"<td>".$reg3->TipoPago."</td>";	
								echo"<td>".$reg3->EstadoPago."</td><tr>";	
							
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
            </div>
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