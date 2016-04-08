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
	function exportar()
	{
		alert("¡ Exportar a PDF !");
	}
	
	function imprimir()
	{
		print();
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>:: Transportes Marin Hermanos - RepViajes ::</title>
    <style type="text/css">
<!--
.Estilo2 {font-weight: bold}
.Estilo4 {font-size: 12px; font-weight: bold; }
-->
    </style>
</head>
<body>
<table width="1031" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="89" background="../../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="994"><table width="994" height="409" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="994">&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"></div></td>
      </tr>
      <tr>
        <td height="135"><div align="center">
			<?php
				$codViaje=$_POST["txtCodViaje"];
				$sql="Select V.Vehiculo_placa, VE.Marca, CV.Trbajador_DNI, T.Nombre, T.ApellidoPaterno, T.ApellidoMaterno, T.Direccion, T.LicenciaConducir, R.Nombre as ruta from ((((viaje as V INNER JOIN vehiculo AS VE ON V.Vehiculo_placa=VE.placa) INNER JOIN conductoresviaje AS CV ON V.CodViaje=CV.viaje_CodViaje) INNER JOIN  trabajador AS T ON CV.Trbajador_DNI=T.DNI) INNER JOIN ruta AS R ON V.Ruta_CodigoRuta=R.CodigoRuta) WHERE CodViaje=$codViaje;";
				$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
				$con=$bdx->conectar();
				$result=$bdx->crearConsulta($sql);
				if(mysql_num_rows($result)!=0)
				{	
						$reg=mysql_fetch_object($result);
					
				}
				else
				{
					$band=0;
					echo"<tr> <div align=\"center\"> No existe Comprobante ... </div><tr>";
					}
				
			?>
          <table width="986" border="0">
            <tr>
              <td height="32" colspan="7"><div align="center"><strong>BALANZA DE VIAJE  : </strong><?php echo $reg->ruta ?> </div></td>
              </tr>
            <tr>
              <td width="113"><div align="right"><strong>Chofer:</strong></div></td>
              <td width="206"><?php echo $reg->Nombre." ".$reg->ApellidoPaterno." ".$reg->ApellidoMaterno?></td>
              <td width="96"><strong>Del Camion </strong></td>
              <td width="147"><?php echo $reg->Marca ?></td>
              <td width="50"><strong>Nro.</strong></td>
              <td width="155"><?php echo $reg->Vehiculo_placa?></td>
              <td width="205">&nbsp;</td>
            </tr>
            <tr>
              <td><div align="right"><strong>Brevete N&ordm;</strong></div></td>
              <td><?php echo $reg->LicenciaConducir?></td>
              <td colspan="2"><div align="right"><strong>y residencia en : </strong></div></td>
              <td colspan="3"><?php echo $reg->Direccion?></td>
              </tr>
            <tr>
              <td colspan="3"><div align="center"></div></td>
              <td colspan="2">&nbsp;</td>
              <td><strong>Cod Viaje : <?php echo $codViaje?></strong></td>
              <td><div align="left"></div></td>
            </tr>
            <tr>
              <td height="47" colspan="7"><div align="center">
                <p><strong>PAGOS</strong></p>
                <table width="660" border="0">
                  <tr>
                    <td width="98" bgcolor="#66CCFF"><div align="center" class="Estilo4">CODIGO</div></td>
                    <td width="95" bgcolor="#66CCFF"><div align="center" class="Estilo4">FECHA</div></td>
                    <td width="122" bgcolor="#66CCFF"><div align="center" class="Estilo4">MONTO</div></td>
                    <td width="317" bgcolor="#66CCFF"><div align="center" class="Estilo4">DESCRIPCION</div></td>
                    </tr>
				  <?php
				  	$color="#ffffff";
				  	$sql="SELECT codigopago, monto, fecha, descripcion FROM pagos WHERE Viaje_CodViaje=$codViaje;";
					$result1=$bdx->crearConsulta($sql);
					$pagos=0;
					if(mysql_num_rows($result1)!=0)
					{
						while($reg=mysql_fetch_object($result1))
						{
							echo"<tr bgcolor=$color><td>".$reg->codigopago."</td>";
							echo"<td>".fechaFormato($reg->fecha)."</td>";
							echo"<td>".$reg->monto."</td>";
							echo"<td>".$reg->descripcion."</td>";													
							$pagos=$pagos+$reg->monto;
							
						if($color=="#ffffff")
							$color="#cccccc";
						else
							$color="#ffffff";
						}
					}
				  ?>
                </table>
                <p><strong>GASTOS</strong></p>
                <table width="982" border="0">
                  <tr>
                    <td width="51" bgcolor="#66CCFF"><div align="center" class="Estilo4">COD</div></td>
                    <td width="77" bgcolor="#66CCFF"><div align="center" class="Estilo4">FECHA</div></td>
                    <td width="88" bgcolor="#66CCFF"><div align="center" class="Estilo4">MONTO</div></td>
                    <td width="177" bgcolor="#66CCFF"><div align="center" class="Estilo4">DESCRIPCION</div></td>
                    <td width="173" bgcolor="#66CCFF"><div align="center" class="Estilo4">RAZON SOCIAL </div></td>
                    <td width="108" bgcolor="#66CCFF"><div align="center" class="Estilo4">COMPROBANTE</div></td>
                    <td width="109" bgcolor="#66CCFF"><div align="center" class="Estilo4">S/. x GALON </div></td>
                    <td width="175" bgcolor="#66CCFF"><div align="center" class="Estilo4">N&deg; GALONES </div></td>
                  </tr>
                  <?php
				  	$color="#ffffff";
				  	$sql="SELECT codigo, monto, fecha, descripcion, razonSocial, nroComprobante, precioGalon, nroGalones FROM gastos WHERE Viaje_CodViaje=$codViaje;";
				    $result2=$bdx->crearConsulta($sql);
					$gastos=0;
					if(mysql_num_rows($result2)!=0)
					{
						while($reg=mysql_fetch_object($result2))
						{
							echo"<tr bgcolor=$color><td>".$reg->codigo."</td>";
							echo"<td>".fechaFormato($reg->fecha)."</td>";
							echo"<td>".$reg->monto."</td>";
							echo"<td>".$reg->descripcion."</td>";
							echo"<td>".$reg->razonSocial."</td>";
							echo"<td>".$reg->nroComprobante."</td>";
							echo"<td>".$reg->precioGalon."</td>";
							echo"<td>".$reg->nroGalones."</td></tr>";
							$gastos=$gastos + $reg->monto;					
							
						if($color=="#ffffff")
							$color="#cccccc";
						else
							$color="#ffffff";
						}
					}
				  ?>
                </table>
                <p>&nbsp;</p>
                <table width="179" border="0">
                  <tr>
                    <td width="169" bgcolor="#66CCFF"><div align="center"><strong>TOTAL A DEVOLVER</strong></div></td>
                  </tr>
                  <tr>
                    <td><div align="center"><?php echo $pagos - $gastos?></div></td>
                  </tr>
                </table>
                </div></td>
              </tr>
          </table>
          <div align="center">
			<label>
              <input name="Imprimir" type="button" id="Imprimir" value="Imprimir" onClick="imprimir()" />
              </label>
            </div>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#6DAA37">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#091549" class="Estilo2"><div align="center" class="Estilo2"></div></td>
      </tr>

    </table></td>
    <td width="44" background="../../conexion/Img/bg1223.jpg"><div align="center"></div></td>
  </tr>
</table>
</body>
</html>	