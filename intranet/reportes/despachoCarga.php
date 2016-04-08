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
		document.getElementById("imp").innerHTML="";
		print();
		document.getElementById("form1").submit();
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
.Estilo6 {font-size: 12px}
.Estilo8 {font-size: 16px}
.Estilo9 {
	font-size: 20px;
	font-style: italic;
}
.Estilo10 {font-size: 14px}
.Estilo11 {font-size: 14px; font-weight: bold; }
.Estilo14 {font-size: 24px; font-weight: bold; }
.Estilo16 {font-size: 10px}
.Estilo17 {font-size: 30px; font-weight: bold; }
-->
    </style>
</head>
<body>
<table width="1202" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="4" background="../../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="1197"><table width="1196" height="541" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="1196" height="18"><?php
				$codViaje=$_POST["txtCodViaje"];
				$sql="Select V.Vehiculo_placa, V.FechaSalida, VE.Marca, CV.Trbajador_DNI, T.Nombre, T.ApellidoPaterno, T.ApellidoMaterno, T.Direccion, T.LicenciaConducir, R.Nombre as ruta from ((((viaje as V INNER JOIN vehiculo AS VE ON V.Vehiculo_placa=VE.placa) INNER JOIN conductoresviaje AS CV ON V.CodViaje=CV.viaje_CodViaje) INNER JOIN  trabajador AS T ON CV.Trbajador_DNI=T.DNI) INNER JOIN ruta AS R ON V.Ruta_CodigoRuta=R.CodigoRuta) WHERE CodViaje=$codViaje;";
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
				
			?></td>
      </tr>
      <tr>
        <td height="158" valign="bottom"><div align="center">
          <table width="985" height="89" border="0" align="center">
            <tr>
              <td colspan="2" rowspan="3" align="center" valign="top"><div align="center"></div></td>
              <td height="32">&nbsp;</td>
              <td colspan="3" align="left" valign="top"><div align="center">
                <p class="Estilo14">&nbsp;</p>
                </div></td>
            </tr>
            <tr>
              <td height="21">&nbsp;</td>
              <td colspan="3" align="left" valign="top"><div align="center"><span class="Estilo14"><strong><strong><?php //echo $codViaje?></strong></strong></span></div></td>
            </tr>
            <tr>
              <td width="417" height="28">&nbsp;</td>
              <td width="47">&nbsp;</td>
              <td width="89"><div align="right" class="Estilo14"></div></td>
              <td width="30"><div align="center" class="Estilo14"></div></td>
            </tr>
          </table>
        </div>
          <div align="right"></div></td>
      </tr>
      <tr>
        <td height="135"><div align="center">
          <table width="1196" border="0">
            <tr>
              <td height="54" colspan="6"><div align="center">
                <div align="center"><?php echo $reg->ruta."		(".$reg->FechaSalida.")" ?> </div>
              </div></td>
              <td height="54">&nbsp;</td>
            </tr>
            <tr>
              <td width="129" height="21"><div align="right" class="Estilo10">
                <div align="left"></div>
              </div></td>
              <td width="394"><span class="Estilo10"><?php echo $reg->Nombre." ".$reg->ApellidoPaterno." ".$reg->ApellidoMaterno?></span></td>
              <td width="167">&nbsp;</td>
              <td width="95"><span class="Estilo10"><?php echo $reg->Marca ?></span></td>
              <td width="197">&nbsp;</td>
              <td width="74"><span class="Estilo10"><?php echo $reg->Vehiculo_placa?></span></td>
              <td width="110"><span class="Estilo10"></span></td>
            </tr>
            <tr>
              <td height="21"><div align="right" class="Estilo10">
                <div align="left"></div>
              </div></td>
              <td><span class="Estilo10"><?php echo $reg->LicenciaConducir?></span></td>
              <td colspan="2"><div align="right" class="Estilo10">
                <div align="left"></div>
              </div></td>
              <td colspan="3"><div align="left"><span class="Estilo10"><?php echo $reg->Direccion?></span></div></td>
            </tr>
            <tr>
              <td height="75" colspan="3"><div align="center" class="Estilo10"></div></td>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
              <td><div align="left"><span class="Estilo6"><span class="Estilo10"><span class="Estilo10"></span></span></span></div></td>
            </tr>
            <tr>
              <td height="206" colspan="7"><div align="center">
                <table width="1185" border="0">
                  <tr>
                    <td width="58" height="81" bgcolor="#FFFFFF"><div align="center" class="Estilo16"></div></td>
                    <td width="84" bgcolor="#FFFFFF"><div align="center" class="Estilo16"></div></td>
                    <td width="105" bgcolor="#FFFFFF">&nbsp;</td>
                    <td width="146" bgcolor="#FFFFFF">&nbsp;</td>
                    <td width="287" bgcolor="#FFFFFF"><div align="center" class="Estilo16"></div></td>
                    <td width="227" bgcolor="#FFFFFF"><div align="center" class="Estilo16"></div></td>
                    <td width="79" bgcolor="#FFFFFF"><div align="center" class="Estilo16"><strong>. </strong></div></td>
                    <td width="90" bgcolor="#FFFFFF"><div align="center" class="Estilo16"></div></td>
                    <td width="71" bgcolor="#FFFFFF"><div align="center" class="Estilo16"></div></td>
                  </tr>
                  <?php
				  	$sql="SELECT distinct A.Remitente, A.Destinatario, C.codigo, C.Numero, C.total, C.nGuiaRemision, C.docCli, C.destino FROM (articulo AS A INNER JOIN comprobante AS C ON A.Comprobante_codigo=C.codigo) WHERE A.Viaje_CodViaje=$codViaje ORDER BY C.nGuiaRemision ASC ;";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$i=1;
					$result=$bdx->crearConsulta($sql);
					if(mysql_num_rows($result)!=0)
					{
						while($reg=mysql_fetch_object($result))
						{
						    echo"<tr><td><div align=\"left\" class=\"Estilo16\"><strong>".$i."</strong></div></td>";
						    echo"<td><div align=\"left\" class=\"Estilo16\"><strong>".$reg->destino."</strong></div></td>";
							echo"<td><div align=\"center\" class=\"Estilo16\"><strong>".$reg->nGuiaRemision."</strong></div></td>";
							echo"<td><div align=\"center\" class=\"Estilo16\"><strong>".$reg->docCli."</strong></div></td>";
							echo"<td><div align=\"left\" class=\"Estilo16\"><strong>".$reg->Remitente."</strong></div></td>";
							echo"<td><div align=\"left\" class=\"Estilo16\"><strong>".$reg->Destinatario."</strong></div></td>";
							echo"<td><div align=\"center\" class=\"Estilo16\"><strong>".$reg->codigo."</strong></div></td>";
							echo"<td><div align=\"center\" class=\"Estilo16\"><strong>".$reg->Numero."</strong></div></td>";
							print("<td><div align=\"left\" class=\"Estilo16\"><strong>".number_format($reg->total/1.19, 2, '.', ''))."</strong></td></tr>";
							$i++;
							$total=$total+$reg->total;
						}
					}
				  ?>
                </table>
                <p>&nbsp;</p>
                <table width="791" border="0" align="center">
                  <tr>
                    <td width="190" class="Estilo4"><div align="center"><span class="Estilo11">SUB TOTAL (S/.) </span></div></td>
                    <td width="90" class="Estilo4"><div align="center">
                      <?PHP $tot= $total/1.18; print(number_format($tot, 2, '.', '')) ?>
                    </div></td>
                    <td width="127"><div align="center" class="Estilo11">
                      <div align="center"><span class="Estilo10">IGV (S/.) </span></div>
                    </div></td>
                    <td width="100"><div align="center"><strong><?php print(number_format($total-$tot, 2, '.', '')) ?></strong></div></td>
                    <td width="134"><div align="right" class="Estilo11">
                      <div align="center">TOTAL (S/.) </div>
                    </div></td>
                    <td width="124"><div align="center"><strong><?php print(number_format($total, 2, '.', ''))?></strong></div></td>
                  </tr>
                </table>
                <p>&nbsp;</p>
              </div></td>
            </tr>
          </table>
          <div align="center">
            <input name="Imprimir" type="button" id="Imprimir" value="Imprimir" onClick="imprimir()" />
          </div>
          <form id="form1" name="form1" method="post" action="../administrador.php">
				<div align="center" id="imp">
				<label></label>
				</div>
	    </form>      </tr>
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><div align="center" class="Estilo2"></div></td>
      </tr>
    </table></td>
    <td width="1" background="../../conexion/Img/bg1223.jpg"><div align="center"></div></td>
  </tr>
</table>
</body>
</html>	