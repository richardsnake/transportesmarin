<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: ../index.html");
	}
	if(!isset($_POST["txtCodViaje"]))
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
		document.getElementById("imprimir").innerHTML="";
		print();
		//document.getElementById("form1").submit();
    location.href="../administrador.php";
    window.location="../administrador.php";
    setTimeout("location.href='../administrador.php'",2000);
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--
.Estilo10 {font-size: 14px}
.Estilo12 {font-size: 10px}
-->
</style>
<<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>:: Transportes Marin Hermanos - RepViajes ::</title>
    <style type="text/css">
<!--
.Estilo13 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo14 {font-size: 12px}
-->
    </style>
</head>

<body>
<div align="center">
  <form id="form1" name="form1" method="post" action="../administrador.php">
    <div align="center">
      <table width="1278" border="0">
        <tr>
          <td height="93" colspan="14"><?php
				$codViaje=$_POST["txtCodViaje"];
				$sql="Select V.Vehiculo_placa, V.FechaSalida, VE.Marca, CV.Trbajador_DNI, T.Nombre, T.ApellidoPaterno, T.ApellidoMaterno, T.Direccion, T.LicenciaConducir, R.Nombre as ruta from ((((viaje as V INNER JOIN vehiculo AS VE ON V.Vehiculo_placa=VE.placa) INNER JOIN conductoresviaje AS CV ON V.CodViaje=CV.viaje_CodViaje) INNER JOIN  trabajador AS T ON CV.Trbajador_DNI=T.DNI) INNER JOIN ruta AS R ON V.Ruta_CodigoRuta=R.CodigoRuta) WHERE  CodViaje=$codViaje;";
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
				
			?>          </td>
        </tr>
        <tr>
          <td height="49" colspan="10">&nbsp;</td>
          <td colspan="3"><div align="center"><strong><strong> <?php echo $codViaje?> </strong></strong></div></td>
          <td width="105">&nbsp;</td>
        </tr>
        <tr>
          <td height="36" colspan="5">&nbsp;</td>
          <td colspan="4"><div align="center" class="Estilo12"><?php echo $reg->ruta."		(".$reg->FechaSalida.")" ?></div></td>
          <td colspan="5">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="14">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td colspan="4"><span class="Estilo10"><?php echo $reg->Nombre." ".$reg->ApellidoPaterno." ".$reg->ApellidoMaterno?></span></td>
          <td colspan="2"><div align="center"><span class="Estilo10"><?php echo $reg->Marca ?></span></div></td>
          <td colspan="3"><div align="center"><span class="Estilo10"><?php echo $reg->Vehiculo_placa?></span></div></td>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td height="25" colspan="2">&nbsp;</td>
          <td colspan="3"><span class="Estilo10"><?php echo $reg->LicenciaConducir?></span></td>
          <td colspan="3"><div align="center"><span class="Estilo10"><?php echo $reg->Direccion?></span></div></td>
          <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
          <td width="57" height="141"><div align="center"></div></td>
          <td colspan="2"><div align="center"></div></td>
          <td width="94"><div align="center"></div></td>
          <td colspan="2"><div align="center"></div></td>
          <td width="343"><div align="center"></div></td>
          <td colspan="3"><div align="center"></div></td>
          <td width="84"><div align="center"></div></td>
          <td colspan="2"><div align="center"></div></td>
          <td><div align="center"></div></td>
        </tr>
        <?php
					$sql="SELECT distinct A.Remitente, A.Destinatario, C.codigo, C.Numero, C.total, C.nGuiaRemision, C.docCli, C.destino FROM (articulo AS A INNER JOIN comprobante AS C ON A.Comprobante_codigo=C.codigo) WHERE C.activo=1 AND A.Viaje_CodViaje=$codViaje ORDER BY C.nGuiaRemision ASC ;";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$i=1;
					$result=$bdx->crearConsulta($sql);
					if(mysql_num_rows($result)!=0)
					{
						while($reg=mysql_fetch_object($result))
						{
						    if($reg->destino!="")
							{
							
							echo"<tr><td width=\"81\"><div align=\"left\"><span class=\"Estilo12\"><strong>".$i."</strong></span></div></td>";
						    echo"<td width=\"2\"><div align=\"left\"><span class=\"Estilo12\"><strong>".$reg->destino."</strong></span></div></td>";
							echo"<td <td width=\"104\"><div align=\"center\"><span class=\"Estilo12\"><strong>".$reg->nGuiaRemision."</strong></span></div></td>";
							echo"<td width=\"2\"><div align=\"center\"><span class=\"Estilo12\"><strong>".$reg->docCli."</strong></span></div></td>";
							echo"<td width=\"289\"><div align=\"left\"><span class=\"Estilo12\"><strong>".$reg->Remitente."</strong></span></div></td>";
							echo"<td width=\"3\"><div align=\"left\"><span class=\"Estilo12\"><strong>".$reg->Destinatario."</strong></span></div></td>";
							echo"<td width=\"101\"><div align=\"left\"><span class=\"Estilo12\"><strong>".$reg->codigo."</strong></span></div></td>";
							echo"<td colspan=\"2\"><div align=\"center\"><span class=\"Estilo12\"><strong>".$reg->Numero."</strong></span></div></td>";
							print("<td><div align=\"center\"><span class=\"Estilo12\"><strong>".number_format($reg->total/1.19, 2, '.', ''))."</strong></span></td></tr>";
							$i++;
							$total=$total+$reg->total;
							}
						}
					}
				  ?>
        <tr>
          <td colspan="14">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4"><div align="center" class="Estilo13">SUB TOTAL (S/.) </div></td>
          <td width="97"><div align="center" class="Estilo13">
              <?PHP $tot= $total/1.18; print(number_format($tot, 2, '.', '')) ?>
          </div></td>
          <td width="5"><div align="center"><span class="Estilo14"></span></div></td>
          <td><div align="center" class="Estilo14"><strong>IGV (S/.) </strong></div></td>
          <td colspan="2"><div align="left" class="Estilo14"><strong><?php print(number_format($total-$tot, 2, '.', '')) ?></strong></div></td>
          <td width="69"><div align="center" class="Estilo14"><strong>TOTAL (S/.) </strong></div></td>
          <td colspan="2"><div align="center" class="Estilo14"><strong><?php print(number_format($total, 2, '.', ''))?></strong></div></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="14">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
          <td colspan="5"><div id="imprimir"align="center">
            <input name="Imprimir" type="button" id="Imprimir" value="Imprimir" onClick="imprimir()" />
          </div></td>
          <td colspan="5">&nbsp;</td>
        </tr>
      </table>
    </div>
    </form>
</div>
</body>
</html>
