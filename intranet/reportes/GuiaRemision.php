<?php
	require("../../conexion/config.php");
	require("../../conexion/baseDatos.php");
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}	
	if(!isset($_GET["codC"]))
	{
		header("Location: ../administrador.php");
	}
	$tipo = $_SESSION["tipo"];
	$totalEsc = $_GET["totalEsc"];
	$codComp = $_GET["codC"];
	$guiaRem = $_GET["guiaRem"];
?>
<script language="javascript" type="text/javascript">
	function direccionar()
	{
		tipo = document.getElementById("tipo").value;
		if(tipo=="adm")
		{
			location.href="../administrador.php";
		}
		else
		{
			location.href="../trabajador.php";
		}
	}
	
	function cancelar()
	{	
		direccionar();
	}

	function imprimir()
	{
		document.getElementById("imprimir").innerHTML = "";
		document.getElementById("noImprimir").innerHTML = "";
		print();		
		setTimeout("document.getElementById('form1').submit()", 1500);
		/*location.href="../frmGenerarFactura.php";
		window.location="../frmGenerarFactura.php";
		setTimeout("location.href='../frmGenerarFactura.php?totalEsc=$totalEsc&guiaRemision=$guiaRem&codC=$codComp'",2000);*/
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - GuiaRemision ::</title>
<style type="text/css">
<!--
.Estilo2 {font-size: 10px; }
.Estilo3 {font-size: 10px; font-weight: bold; }
.Estilo4 {font-size: 11px}
.Estilo5 {font-size: 9px}
.Estilo6 {font-size: 12px}
.Estilo7 {font-size: 14px}
.Estilo8 {font-size: 16px}
.Estilo9 {font-size: 18px}
.Estilo21 {font-weight: bold; font-size: 11px; }
-->
</style>
</head>

<body>
	
<div align="center">
  <table width="1105" height="584" border="0" align="left">
    <tr>
      <td width="1099" height="87"><?php
	  		//$codComp=7;
			$sql="SELECT C.Fecha, C.direccionOrigen, C.direccionDestino, C.total, C.docCli, A.Remitente, A.Destinatario, CL.DNI, CL.RUC, CL.TipoCliente, C.igv FROM (comprobante AS C INNER JOIN articulo AS A ON A.Comprobante_Codigo=C.codigo) INNER JOIN cliente AS CL  ON C.Cliente_CodigoCliente=CL.CodigoCliente WHERE C.codigo=$codComp;";
			$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
			$con=$bdx->conectar();
			$result=$bdx->crearConsulta($sql);
			if(mysql_num_rows($result)!=0)
			{	
				$reg=mysql_fetch_object($result);
				$dirOrigen = $reg->direccionOrigen;
				$dirDestino = $reg->direccionDestino;
				$total=$reg->total;
				$docCli=$reg->docCli;
				$IGV=$reg->igv;
				if($reg->TipoCliente=="Natural")
				{
					$docRem=$reg->DNI;
					//print($docRem);
				}
				else
				{
					$docRem=$reg->RUC;
					//print($docRem);
				}
				$sql2="Select RUC from cliente WHERE RazonSocial='$reg->Destinatario';";	
				$result2=$bdx->crearConsulta($sql2);
				if(mysql_num_rows($result2)!=0)
				{
					$reg2=mysql_fetch_object($result2);
					$docDes=$reg2->RUC;
				}
				else
				{
					$cad=split(" ", $reg->Destinatario);
					if(count($cad)==3)
					{
						$nom=$cad[0];
						$apeP=$cad[1];
						$apeM=$cad[2];
					}
					else if (count($cad)==4)
					{
						$nom=$cad[0]." ".$cad[1];
						$apeP=$cad[2];
						$apeM=$cad[3];
					}
					/*$nom=$reg->Destinatario;
					$len=strlen($nom);
					$i=0;
					for($i=$len;$i>=0;$i--)
					{
						if($nom[$i]==" ")
						{
							$pos=$i;
							break;
						}
					}
					$j=0;
					$ape="";
					for($j=$pos+1;$j<$len;$j++)
					{
						$ape=$ape.$nom[$j];
					}
					$nombre="";
					for($j=0;$j<$pos;$j++)
					{
						$nombre=$nombre.$nom[$j];
					}*/
					$sql3="select DNI from cliente where Nombres='$nom' OR ApellidoPaterno='$apeP' OR ApellidoMaterno='$apeM';";
					$result3=$bdx->crearConsulta($sql3);
					if(mysql_num_rows($result3)!=0)
					{
						$reg3=mysql_fetch_object($result3);
						$docDes=$reg3->DNI;
					}
					
				}
						
			}
			else
			{
				print(" Error: ");
			}
	   ?></td>
    </tr>
    <tr>
      <td height="96" align="left" valign="top"><table width="1125" border="0" align="left">
        <tr>		  
          <td width="170"><div align="left"></div></td>
          <td colspan="3">
		    <div align="justify" class="Estilo3 Estilo2">
		      <?php
			  	print($dirOrigen);
		  ?>
            </div></td>
        </tr>
        <tr>
          <td height="21"><div align="left"></div></td>
          <td width="706">
		    
              <div align="justify" class="Estilo3 Estilo2">
                <?php
		  		print($dirDestino);
		  ?>		  
            </div></td>
          <td width="108"><div align="left"><span class="Estilo2"><span class="Estilo2"><span class="Estilo4"><span class="Estilo5"><span class="Estilo2"><span class="Estilo6"><span class="Estilo7"><span class="Estilo8"><span class="Estilo9"><span class="Estilo4"><span class="Estilo5"><span class="Estilo2"><span class="Estilo2"></span></span></span></span></span></span></span></span></span></span></span></span></span></div></td>
          <td width="123"><div align="right" class="Estilo3 Estilo2"><?php print($reg->Fecha)?>
          </div></td>
        </tr>
        <tr>
          <td><div align="left"></div></td>
          <td><div align="justify" class="Estilo3 Estilo2"><?php print($reg->Remitente)?>
          </div></td>
          <td><div align="left"><span class="Estilo2"><span class="Estilo2"><span class="Estilo4"><span class="Estilo5"><span class="Estilo2"><span class="Estilo6"><span class="Estilo7"><span class="Estilo8"><span class="Estilo9"><span class="Estilo4"><span class="Estilo5"><span class="Estilo2"><span class="Estilo2"></span></span></span></span></span></span></span></span></span></span></span></span></span></div></td>
          <td><div align="justify" class="Estilo3 Estilo2"><?php print($docRem)?>
          </div></td>
        </tr>
        <tr>
          <td><div align="left"></div></td>
          <td><div align="justify" class="Estilo3 Estilo2"><?php print($reg->Destinatario)?>
          </div></td>
          <td><div align="left"><span class="Estilo2"><span class="Estilo2"><span class="Estilo4"><span class="Estilo5"><span class="Estilo2"><span class="Estilo6"><span class="Estilo7"><span class="Estilo8"><span class="Estilo9"><span class="Estilo4"><span class="Estilo5"><span class="Estilo2"><span class="Estilo2"></span></span></span></span></span></span></span></span></span></span></span></span></span></div></td>
          <td><div align="justify" class="Estilo3 Estilo2"><?php print($docDes)?></div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="139" align="left" valign="top"><div align="center">
        <table width="1131" border="0" align="left">
          <tr align="left">
            <td width="70" height="21">&nbsp;</td>
            <td width="900" align="center" valign="top">&nbsp;</td>
            <td width="91" align="center" valign="top"></td>
            <td width="52">&nbsp;</td>
          </tr>
		  <?php
				$sql4="Select CodigoArticulo, Descripcion, Peso, Viaje_CodViaje from articulo where Comprobante_Codigo=$codComp;";
				$con=$bdx->conectar();
				$result4=$bdx->crearConsulta($sql4);
				$i=0;
				if(mysql_num_rows($result4)!=0)
				{	
					while($reg4=mysql_fetch_object($result4))
					{
						$cad=split("\\-", $reg4->Descripcion);
						print("<tr><td> <div align=\"left\" class=\"Estilo21\"><strong>".$reg4->CodigoArticulo."</strong></div></td>");
						print("<td><div align=\"rigth\" class=\"Estilo21\"><strong>".$cad[1]."  -  ".$docCli."</strong></div></td>");
						print("<td width=\"91\" align=\"center\" class=\"Estilo21\"><strong>".$cad[0]."</strong></td>");
						print("<td><div align=\"left\" class=\"Estilo21\"><strong>".$reg4->Peso."</strong></div></td></tr>");
						$i++;
						$viaje=$reg4->Viaje_CodViaje;
				}
					}
					while($i<6)
					{
						print("<tr><td height=\"20\">"." "."</td>");
						print("<td height=\"20\">"." "."</td>");
						print("<td height=\"20\">"." "."</td></tr>");
						$i++;
					}		
					
			 ?>
        </table>
      </div></td>
    </tr>
    <tr>
      <td align="left" valign="top"><div align="center">
        <table width="1113" border="0" align="left">
          <tr>
            <td height="35" colspan="9"><?php
				$sql5="SELECT V.Vehiculo_placa, VE.Marca, VE.nCertificado, VE.NEjes, VE.pesoBruto, VE.Tara, VC.Carreta_placa, C.nEjes, C.tara, C.pesoBruto AS PB FROM (((viaje AS V INNER JOIN vehiculo AS VE ON  V.Vehiculo_placa=VE.placa) INNER JOIN vehiculocarreta AS VC ON VE.placa=VC.Vehiculo_placa) INNER JOIN carreta AS C ON VC.Carreta_placa=C.placa) WHERE V.CodViaje=$viaje;";
				$bdx->conectar();
				$result5=$bdx->crearConsulta($sql5);
				if(mysql_num_rows($result5)!=0)
				{	
					$reg5=mysql_fetch_object($result5);
				}
				$sql6="SELECT CV.Trbajador_DNI, T.LicenciaConducir FROM conductoresviaje  AS CV INNER JOIN trabajador  AS T ON CV.Trbajador_DNI=T.DNI WHERE Viaje_CodViaje=$viaje;";
				$result6=$bdx->crearConsulta($sql6);
				if(mysql_num_rows($result6)!=0)
				{	
					$reg6=mysql_fetch_object($result6);
				}
					
			 ?></td>
            </tr>
          <tr>
            <td height="21" colspan="4">&nbsp;</td>
            <td colspan="5">&nbsp;</td>
            </tr>
          <tr>
            <td width="66" height="21"><div align="left"></div></td>
            <td width="234"><div align="left" class="Estilo4"><strong><?php print($reg5->Marca)?></strong></div></td>
            <td width="60"><div align="left"><span class="Estilo5"><span class="Estilo4"></span></span></div></td>
            <td width="114"><div align="center" class="Estilo4"><strong><?php print($reg5->Vehiculo_placa)?></strong></div></td>
            <td colspan="2"><div align="center"><span class="Estilo5"><span class="Estilo4"></span></span></div></td>
            <td><span class="Estilo4"><strong><?php print($reg5->nCertificado)?></strong></span></td>
            <td width="99"><span class="Estilo4"><strong>Cod. Rem : </strong></span></td>
            <td width="137"><span class="Estilo4"><strong><?php echo $codComp ?></strong></span></td>
          </tr>
          <tr>
            <td height="21"><div align="left"><div align="right"></div>
            </div></td>
            <td><div align="center" class="Estilo21">
              <div align="right"><?php print("C".$reg5->NEjes."R".$reg5->nEjes)?></div>
            </div></td>
            <td><div align="left"><span class="Estilo5"><span class="Estilo4"></span></span></div></td>
            <td><div align="center" class="Estilo21">
              <div align="right">
                <?php $pesoBrutoT = (double)$reg5->pesoBruto + (double)$reg5->PB; 
								print($pesoBrutoT); ?>
              </div>
            </div></td>
            <td width="110"><div align="left"><span class="Estilo5"><span class="Estilo4"></span></span></div></td>
            <td width="123"><div align="right" class="Estilo4"><strong>
              <?php $taraT = (double)$reg5->Tara + (double)$reg5->tara; 
								print($taraT); ?>
            </strong></div></td>
            <td width="132"><div align="right"><span class="Estilo5"><span class="Estilo4"></span></span></div></td>
            <td colspan="2"><div align="rigth" class="Estilo21">
              <div align="right"><?php print($reg6->LicenciaConducir)?></div>
            </div>              </td>
          </tr>
          <?php
		  	$sqlIGV="select valor from igv where codigo='$IGV'";
			$src=$bdx->crearConsulta($sqlIGV);
			$igv=mysql_fetch_array($src);
          ?>
          <tr>
            <td height="25" colspan="3"><div align="left"></div></td>
            <td><div align="center" class="Estilo4"><strong><?php print($reg5->Carreta_placa)?></strong></div></td>
            <td colspan="3"><div align="center"><span class="Estilo5"><span class="Estilo4"></span></span></div></td>
            <td colspan="2"><div align="right" class="Estilo4"><strong>
              <?php $total = $total/$igv[0]; echo number_format($total, 2, '.', ''); ?>
            </strong></div></td>
          </tr>
          <tr>
            <td colspan="9">&nbsp;</td>
            </tr>
          <tr>
            <td colspan="9"><div align="center">
              <form action="../frmGenerarFactura.php" method="get" name="form1" id="form1">
                <table width="241" border="0" align="center">
                  <tr>
                    <td width="82"><div id="imprimir" align="center">
                        <input name="Imprimir" type="button" id="Imprimir" value="Imprimir"  onclick="imprimir()"/>
                    </div></td>
                    <td width="77"><label>
                      <input type="hidden" name="codC" value="<?php print($codComp); ?>"/>
                      <input type="hidden" name="guiaRemision" value="<?php print($guiaRem); ?>"/>
                      <input name="totalEsc" type="hidden" id="totalEsc" value="<?php print($totalEsc); ?>"/>
					  <input name="tipo" type="hidden" id="tipo" value="<?php print($tipo); ?>"/>					  
                    </label></td>
                    <td width="96"><div id="noImprimir" align="center">
                        <input name="Cancelar" type="button" id="Cancelar" value="Cancelar" onClick="cancelar()" />
                    </div></td>
                    </tr>
                </table>
                <label></label>
              </form>
            </div></td>
            </tr>
        </table>
      </div>
        <div align="right"></div></td>
    </tr>
  </table>
</div>
</body>
</html>
