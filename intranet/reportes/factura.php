<?php
	require("../../conexion/config.php");
	require("../../conexion/baseDatos.php");
	require("numeros.php");
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}
	if(!isset($_GET["codC"]))
	{
		header("Location: ../administrador.php");
	}
	/*
	$factura= $_POST["txtNroFactura"];
	$totalEsc = $_POST["txtMontoEscrito"];
	$guiaR ="";
	*/
	
	
	$totalEsc = $_GET["totalEsc"]; //ACA ESTA WEBADA DE MELA, COLOCALO NOMAS
	
	$codComp = $_GET["codC"];
	$guiaR = $_GET["guiaRemision"];	
?>
<script language="javascript" type="text/javascript">

	function imprimir()
	{		
		document.getElementById("imprimir").innerHTML = "";
		document.getElementById("noImprimir").innerHTML = "";
		print();
		//location.hrefD="GuiaRemision.php";
		//document.getElementById("form1").submit();		
		location.href="../administrador.php";
		window.location="../administrador.php";
		setTimeout("location.href='../administrador.php'",2000);
	}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - Factura ::</title>
<style type="text/css">
<!--
.Estilo2 {font-size: 11px}
.Estilo3 {font-size: 11px; font-weight: bold; }
.Estilo4 {font-size: 12px; font-weight: bold; }
-->
</style>
</head>

<body>
<div align="center">
  <table width="1127" height="480" border="0">
    <tr>
      <td height="117" colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td height="95" colspan="3" align="left"><div align="center">
        <table width="1222" height="93" border="0" align="center">
		<?php
			//$codComp=31;
			$sql="SELECT C.codigo, C.nGuiaRemision, C.Fecha, A.Remitente, A.Destinatario, C.direccionOrigen, C.direccionDestino, C.total, C.destino, C.docCli, CL.DNI, CL.RUC, CL.TipoCliente, CL.direccionFiscal, C.igv FROM (comprobante AS C INNER JOIN articulo AS A ON A.Comprobante_Codigo=C.codigo) INNER JOIN cliente AS CL  ON C.Cliente_CodigoCliente=CL.CodigoCliente WHERE C.nGuiaRemision='$guiaR';";
			$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
			$con=$bdx->conectar();
			$result=$bdx->crearConsulta($sql);
			if(mysql_num_rows($result)!=0)
			{	
				$reg=mysql_fetch_object($result);
				$codComp=$reg->codigo;
				$dirFiscal= $reg->direccionFiscal;
				$dirOrigen = $reg->direccionOrigen;
				$dirDestino = $reg->direccionDestino;
				$docCli=$reg->docCli;
				$IGV=$reg->igv;
				//$guiaR=$reg->nGuiaRemision;
				if($reg->destino=="CJ")
					$destino="CAJAMARCA";
				else if($reg->destino=="SM")
					$destino="SAN MARCOS";
				else if($reg->destino=="LM")
					$destino="LIMA";
				else if($reg->destino=="MG")
					$destino="MAGDALENA";
				else if($reg->destino=="CH")
					$destino="CHILETE";
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
				$sql2="Select RUC, direccionFiscal  from cliente WHERE RazonSocial='$reg->Destinatario';";	
				$result2=$bdx->crearConsulta($sql2);
				if(mysql_num_rows($result2)!=0)
				{
					$reg2=mysql_fetch_object($result2);
					$docDes=$reg2->RUC;
					$dirFiscal=$reg2->direccionFiscal;
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
					$sql3="select DNI, direccionFiscal from cliente where Nombres='$nom' OR ApellidoPaterno='$apeP' OR ApellidoMaterno='$apeM';";
					$result3=$bdx->crearConsulta($sql3);
					if(mysql_num_rows($result3)!=0)
					{
						$reg3=mysql_fetch_object($result3);
						$docDes=$reg3->DNI;
						$dirFiscal=$reg3->direccionFiscal;
					}
					
				}
				/*$sql4="select direccionFiscal from cliente where CodigoCliente='$reg->Remitente';";
				$result4=$bdx->crearConsulta($sql4);
				if(mysql_num_rows($result4)!=0)
				{
					$reg4=mysql_fetch_object($result3);
					$dirFiscal=$reg4->direccionFiscal;
				}*/		
			}
			else
			{
				print(" Error: ");
			}
		?>
		
          <tr>
            <td width="136" rowspan="4">&nbsp;</td>
            <td height="20" colspan="3"><div align="justify" class="Estilo2"><strong><?php print("<div align=\"left\">".$reg->Destinatario)."<div"?>
            </strong></div></td>
            <td><div align="center" class="Estilo3">Cod. Rem : </div></td>
            <td><span class="Estilo3"><?php echo $codComp; ?></span></td>
          </tr>
          <tr>
            <td height="21" colspan="3">
			  
		        <div align="justify" class="Estilo3">
		          <?php 
				print($dirFiscal);
			?>
              </div></td>
            <td width="113"><div align="left"></div></td>
            <td width="224"><div align="left" class="Estilo3"><?php print("<div align=\"left\">".$reg->Fecha)."</div>" ?></div></td>
          </tr>
          <tr>
            <td width="422" height="21"><div align="justify" class="Estilo3"><?php print($docDes)?></div></td>
            <td width="66"><div align="center"></div></td>
            <td width="235"><div align="justify" class="Estilo3">
			  <div align="center">
			    <?php
				print($guiaR);
			?>
			      </div>
            </div></td>
            <td><div align="left"></div></td>
            <td>
			  <div align="left" class="Estilo3">
			    <?php 
				print($destino);
			?>
	          </div></td>
          </tr>
          <tr>
            <td height="21" colspan="3"><div align="justify" class="Estilo3"><?php print("<div align=\"left\">".$reg->Remitente)."</div>" ?>
            </div></td>
            <td><div align="left"></div></td>
            <td><div align="left" class="Estilo3"><?php print("<div align=\"left\">".$docRem."</div>")?></div></td>
          </tr>
        </table>
      </div></td>
    </tr>
    <tr>
      <td height="105" colspan="3" valign="top"><div align="center">
        <table width="1241" height="25" border="0">
          <tr>
            <td width="234" height="21"><div align="rigth"></div></td>
            <td width="658"><div align="center"></div></td>
            <td width="101" height="21"><div align="center"></div></td>
            <td width="230"><div align="center"></div></td>
          </tr>
          <?php
		  	$sql="SELECT Descripcion, Peso, Flete FROM articulo WHERE Comprobante_codigo=$codComp";
			$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
			$con=$bdx->conectar();
			$result=$bdx->crearConsulta($sql);
			$i=0;
			if(mysql_num_rows($result)!=0)
			{	
				while($reg1=mysql_fetch_object($result))
				{
					$cad=split("\\-", $reg1->Descripcion);
					print("<tr><td width=\"234\" height=\"21\"><div align=\"rigth\" class=\"Estilo2\"><strong>´´".$cad[0]."</strong></div></td>");
					print("<td><div align=\"rigth\" class=\"Estilo2\"><strong>".$cad[1]."    ".$docCli."</strong></div></td>");
					print("<td><div align=\"center\" class=\"Estilo2\"><strong>".$reg1->Peso."</strong></div></td>");
					print("<td><div align=\"center\" class=\"Estilo2\"><strong>".$reg1->Flete."</strong></div></td></tr>");
					$i++;
				}
				while($i<6)
				{
					print("<tr><td height=\"20\">"." "."</td>");
					print("<td height=\"20\">"." "."</td>");
					print("<td height=\"20\">"." "."</td></tr>");
					$i++;
				}		
			}
		  ?>
        </table>
      </div></td>
    </tr>
    <tr>
      <td width="174" height="48" valign="top">&nbsp;</td>
      <td width="757" align="center" valign="middle" class="Estilo2"><div align="left"><strong><span class="Estilo2"><?php echo numerotexto($reg->total)?></span></strong></div></td>
      <td width="283" valign="top">&nbsp;</td>
    </tr>
    <?php
    $sqlIGV="select valor from igv where codigo='$IGV'";
			$src=$bdx->crearConsulta($sqlIGV);
			$igv=mysql_fetch_array($src);
    ?>
	<tr>
      <td height="101" colspan="3" valign="top"><div align="center">
        <table width="281" height="78" border="0" align="right">
          <tr>
            <td width="47" height="21"><div align="left"></div></td>
            <td width="224"><div align="center" class="Estilo4"><?php $tot = ($reg->total/$igv[0]); print("<div align=\"center\">".number_format($tot, 2, '.', '')."</div>")?></div></td>
          </tr>
          <tr>
            <td height="21"><div align="left"></div></td>
            <td><div align="center" class="Estilo4"><?php print("<div align=\"center\">".number_format(($reg->total-$tot), 2, '.', '')."</div>")?></div></td>
          </tr>
          <tr>
            <td height="28"><div align="left"></div></td>
            <td><div align="center" class="Estilo4"><?php print("<div align=\"center\">".number_format(($reg->total), 2, '.', '')."</div>")?></div></td>
            </tr>
        </table>
      </div></td>
    </tr>
  </table>
   <div align="center"><form id="form1" name="form1" method="get" action="../administrador.php">
    <table width="313" border="0" align="center">
        <tr>
          <td width="118"><div id="imprimir" align="center">
              <input name="Imprimir" type="button" id="Imprimir" value="Imprimir"  onclick="imprimir()"/>
          </div></td>
          <td width="151"><div id="noImprimir" align="center">
              <input type="submit" name="No Imprimir" id="No Imprimir" value="No Imprimir" />
          </div></td>
		  <td width="30">
			<input name="codC" type="hidden" id="codC" value="<?php print($codComp); ?>"/>
		  </td>
        </tr>
      </table>
      <label></label>
    </form>
  </div>
</div>
</body>
</html>
