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
	$totalEsc = $_GET["totalEsc"];
	$codComp = $_GET["codC"];
?>
<script language="javascript" type="text/javascript">
	function imprimir()
	{
		document.getElementById("imprimir").innerHTML = "";
		document.getElementById("noImprimir").innerHTML = "";
		print();
		document.getElementById("form1").submit();
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - Almacen ::</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 11px}
-->
</style>
</head>

<body>
<div align="center">
  <table width="1195" height="458" border="0">
    <tr>
      <td height="92" colspan="4"><?php
			//$codComp=7;
			$sql="SELECT C.Fecha, A.Remitente, A.Destinatario, C.total, C.direccionOrigen, C.direccionDestino, CL.DNI, CL.RUC, CL.TipoCliente FROM (comprobante AS C INNER JOIN articulo AS A ON A.Comprobante_Codigo=C.codigo) INNER JOIN cliente AS CL  ON C.Cliente_CodigoCliente=CL.CodigoCliente WHERE C.codigo=$codComp;";
			$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
			$con=$bdx->conectar();
			$result=$bdx->crearConsulta($sql);
			if(mysql_num_rows($result)!=0)
			{	
				$reg=mysql_fetch_object($result);
				$dirOrigen = $reg->direccionOrigen;
				$dirDestino = $reg->direccionDestino;
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
					$nom=$reg->Destinatario;
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
					}
					$sql3="select DNI from cliente where Nombres='$nombre' AND ApellidoPaterno='$ape';";
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
      <td height="81" colspan="4" valign="top"><table width="1179" border="0" align="center">
            <tr>
              <td height="21">&nbsp;</td>
              <td><div align="justify" class="Estilo1"><?php print($reg->Remitente)?></div></td>
              <td><div align="right"><span class="Estilo1">Cod Rem : </span></div></td>
              <td colspan="2"><div align="center"><span class="Estilo1"><?php echo $codComp ?></span></div></td>
            </tr>
            <tr>
              <td width="209" height="26">&nbsp;</td>
              <td width="513"><div align="justify" class="Estilo1"><?php print($reg->Destinatario)?></div></td>
              <td width="182">&nbsp;</td>
              <td colspan="2"><div align="center" class="Estilo1">
                <div align="center"><?php print($docRem)?></div>
              </div></td>
            </tr>
            <tr>
              <td height="21">&nbsp;</td>
              <td><div align="justify" class="Estilo1">
                  <?php
			  	print($dirDestino);
		  ?>
              </div></td>
              <td>&nbsp;</td>
              <td width="231"><div align="center" class="Estilo1">
                <div align="center"><?php print($reg->Fecha)?></div>
              </div>                <div align="center" class="Estilo1"></div></td>
              <td width="22"><div align="center" class="Estilo1"></div></td>
            </tr>
      </table></td>
    </tr>
    <tr>
      <td height="240" colspan="4" align="left" valign="top"><div align="center">
          <table width="1175" border="0">
            <tr>
              <td width="179" height="29"><div align="center"></div></td>
              <td width="750"><div align="center"></div></td>
              <td width="124"><div align="center"></div></td>
              <td width="104"><div align="center"></div></td>
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
					print("<tr><td><div align=\"center\" class=\"Estilo1\">".$cad[0]."</div></td>");
					print("<td><div align=\"left\" class=\"Estilo1\">".$cad[1]."</div></td>");
					print("<td><div align=\"center\" class=\"Estilo1\">".$reg1->Peso."</div></td>");
					print("<td><div align=\"center\" class=\"Estilo1\">".$reg1->Flete."</div></td></tr>");
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
      <td width="71" height="29"><div align="right" class="Estilo1">
          <table width="61" border="0">
            <tr>
              <td width="55">&nbsp;</td>
            </tr>
          </table>
      </div></td>
      <td width="731"><div align="center" class="Estilo1"><?php echo numerotexto($reg->total)?></div></td>
      <td width="250"><span class="Estilo1"></span></td>
      <td width="125"><div align="center" class="Estilo1"><?php print("<div align=\"center\">".$reg->total)."</div>"?></div></td>
    </tr>
  </table>
</div>
<div align="center">
  <div align="center">
    <form id="form1" name="form1" method="get" action="../administrador.php">
      <table width="324" border="0" align="center">
        <tr>
          <td><div id="imprimir" align="center">
              <input name="Imprimir2" type="button" id="Imprimir2" value="Imprimir"  onclick="imprimir()"/>
          </div></td>
          <td><div id="noImprimir" align="center">
              <input type="submit" name="No Imprimir" id="No Imprimir" value="No Imprimir" />
          </div></td>
        </tr>
      </table>
      <label></label>
    </form>
  </div>
</div>
</body>
</html>
