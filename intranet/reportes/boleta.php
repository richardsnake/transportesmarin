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
	$codComp = $_GET["codC"];
	$totalEsc = $_GET["totalEsc"];
	$guiaR = $_GET["guiaRemision"];
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
<title>:: Transportes Marin Hermanos - Boleta ::</title>
<style type="text/css">
<!--
.Estilo2 {font-size: 11px}
-->
</style>
</head>

<body>
<div align="center">
  <table width="1218" height="460" border="0">
    <tr>
      <td height="115" colspan="5"><?php
			//$codComp=7;
			$sql="SELECT C.Fecha, A.Remitente, A.Destinatario, C.total, C.direccionOrigen, CL.DNI, CL.RUC, CL.TipoCliente FROM (comprobante AS C INNER JOIN articulo AS A ON A.Comprobante_Codigo=C.codigo) INNER JOIN cliente AS CL  ON C.Cliente_CodigoCliente=CL.CodigoCliente WHERE C.codigo=$codComp;";
			$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
			$con=$bdx->conectar();
			$result=$bdx->crearConsulta($sql);
			if(mysql_num_rows($result)!=0)
			{	
				$reg=mysql_fetch_object($result);
				$dirOrigen = $reg->direccionOrigen;
				
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
				$sql2="Select RUC, direccionFiscal from cliente WHERE RazonSocial='$reg->Destinatario';";	
				$result2=$bdx->crearConsulta($sql2);
				if(mysql_num_rows($result2)!=0)
				{
					$reg2=mysql_fetch_object($result2);
					$docDes=$reg2->RUC;
					$dirFiscal = $reg2->direccionFiscal;
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
					$sql3="select DNI, direccionFiscal from cliente where Nombres='$nombre' OR ApellidoPaterno='$apeP' OR ApellidoMaterno='$apeM';";
					$result3=$bdx->crearConsulta($sql3);
					if(mysql_num_rows($result3)!=0)
					{
						$reg3=mysql_fetch_object($result3);
						$docDes=$reg3->DNI;
						$dirFiscal = $reg3->direccionFiscal;
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
      <td height="73" colspan="5" align="left" valign="top"><table width="1209" height="71" border="0" align="center">
        <tr>
          <td width="159" height="32">&nbsp;</td>
          <td colspan="3"><div align="justify" class="Estilo2"><?php print($reg->Destinatario)?></div></td>
          <td width="99">&nbsp;</td>
          <td colspan="3"><div align="justify" class="Estilo2"><?php print($docDes)?></div></td>
        </tr>
        <tr>
          <td height="33">&nbsp;</td>
          <td width="489">
		    
		      <div align="justify" class="Estilo2">
		        <?php
			  	print($dirFiscal);
		  ?>		  
              </div></td>
          <td width="82"><div align="center"><em class="Estilo2"><strong>Cod. Rem </strong></em></div></td>
          <td width="96"><span class="Estilo2"><?php echo $codComp ?></span></td>
          <td>&nbsp;</td>
          <td width="120"><div align="justify" class="Estilo2">
            <div align="center"><?php print($reg->Fecha)?></div>
          </div></td>
          <td width="71">&nbsp;</td>
          <td width="59">&nbsp;</td>
        </tr>
      </table>	  </td>
    </tr>
    <tr>
      <td height="233" colspan="5" align="left" valign="top"><div align="center">
        <table width="1232" height="46" border="0">
          <tr>
            <td width="199" height="42"><div align="center"></div></td>
            <td width="710"><div align="center"></div></td>
            <td width="114"><div align="center"></div></td>
            <td width="191"><div align="center"></div></td>
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
					print("<td><div align=\"left\" class=\"Estilo2\">".$cad[0]."</div></td>");
					print("<td><div align=\"left\" class=\"Estilo2\">".$cad[1]."</div></td>");
					print("<td><div align=\"center\" class=\"Estilo2\">".$reg1->Peso."</div></td>");
					print("<td><div align=\"center\" class=\"Estilo2\">".$reg1->Flete."</div></td></tr>");
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
		<td width="157" height="29">
		  <div align="right">
		    <table width="153" border="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
	  </div></td>
	    <td width="801">
		  <div align="left"><span class="Estilo2">
	      <?php 
			echo numerotexto($reg->total);
		?>
      </span></div></td>
      <td width="56"><div align="center"></div></td>
      <td width="27"><div align="center"></div></td>
	    <td width="175"><div align="left" class="Estilo2">
	      <div align="center"><?php print("<div align=\"center\">".$reg->total)."</div>"?></div>
      </div></td>
	</tr>
  </table>
</div>
<div align="center">
  <form id="form1" name="form1" method="get" action="../administrador.php">
    <table width="324" border="0" align="center">
      <tr>
        <td><div id="imprimir" align="center">
          <input name="Imprimir" type="button" id="Imprimir" value="Imprimir"  onclick="imprimir()"/>
        </div></td>
        <td><div id="noImprimir" align="center">
          <input type="submit" name="No Imprimir" id="No Imprimir" value="No Imprimir"/>
        </div></td>
		<td>
			<input name="codC" type="hidden" id="codC" value="<?php print($codComp); ?>"/>
		</td>
      </tr>
    </table>
    <label></label>
  </form>
</div>
</body>
</html>
