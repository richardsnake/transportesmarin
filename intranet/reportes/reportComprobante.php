<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: ../index.html");
	}
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
	<title>:: Transportes Marin Hermanos - RepComprobantes ::</title>
	<style type="text/css">
<!--
.Estilo1 {color: #0000FF}
.Estilo2 {color: #0000CC}
-->
    </style>
</head>
<body>
<table width="1080" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="156" background="../../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="1011" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="985">&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"><img src="../../imagenes/sup.jpg" width="780" height="193" /></div></td>
      </tr>
      <tr>
        <td height="135">&nbsp;
          <div align="center">
            <table width="978" border="1">
              <tr>
                <td colspan="14"><div align="center"><strong>REPORTE DE COMPROBANTE </strong></div></td>
                </tr>
              <tr>
                <td width="76"><div align="center"><span class="Estilo1">Cod. Rem. </span></div></td>
                <td width="35"><div align="center"><span class="Estilo1">Tipo</span></div></td>
                <td width="44"><div align="center"><span class="Estilo1">Serie</span></div></td>
                <td width="64"><div align="center"><span class="Estilo1">Numero</span></div></td>
                <td width="43"><div align="center"><span class="Estilo2">Guia</span></div></td>
                <td width="50"><div align="center"><span class="Estilo2">CodCli</span></div></td>
                <td width="47"><div align="center"><span class="Estilo1">Fecha</span></div></td>
                <td width="40"><div align="center"><span class="Estilo1">Total</span></div></td>
				<td width="79"><div align="center"><span class="Estilo1">Dir. Origen</span></div></td>
				<td width="85"><div align="center"><span class="Estilo1">Dir. Destino</span></div></td>
                <td width="65"><div align="center"><span class="Estilo1">Sucursal</span></div></td>
                <td width="130"><div align="center"><span class="Estilo1">Remitente </span></div></td>
				<td width="138"><div align="center"><span class="Estilo1">Destinatario</span></div></td>
                </tr>
				
              <tr>
                <?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT C.codigo, C.TipoComprobante, C.Serie, C.Numero, C.nGuiaRemision, C.Cliente_CodigoCliente, C.Fecha, C.total, C.direccionOrigen, C.direccionDestino, A.Destinatario, S.RazonSocial, CL.Nombres, CL.ApellidoPaterno, CL.RazonSocial as juridica, CL.TipoCliente FROM (((comprobante AS C INNER JOIN  articulo as A ON C.codigo=A.Comprobante_Codigo) INNER JOIN sucursal AS S ON C.Sucursal_codigoSucursal=S.codigoSucursal) INNER JOIN cliente  AS CL ON C.Cliente_CodigoCliente=CL.codigoCliente) order by C.codigo desc;";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
//					$reg=mysql_fetch_object($result);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
						if($registro->TipoComprobante!=null)
						{
							echo"<tr><td>".$registro->codigo."</td>";
							echo"<td>".$registro->TipoComprobante."</td>";
							echo"<td>".$registro->Serie."</td>";
							echo"<td>".$registro->Numero."</td>";
							echo"<td>".$registro->nGuiaRemision."</td>";
							echo"<td>".$registro->Cliente_CodigoCliente."</td>";
							echo"<td>".fechaFormato($registro->Fecha)."</td>";
							echo"<td>".$registro->total."</td>";
							echo"<td>".$registro->direccionOrigen."</td>";
							echo"<td>".$registro->direccionDestino."</td>";
							echo"<td>".$registro->RazonSocial."</td>";
							if($registro->TipoCliente=="Natural")
								$cliente=$registro->Nombres." ".$registro->ApellidoPaterno;
							else
								$cliente=$registro->juridica;
							echo"<td>".$cliente."</td>";
							echo"<td>".$registro->Destinatario."</td></tr>";
							//echo"</tr></table>";
						}
					}
					//echo"</table>";
					$bdx->cerrarConexion();			 
				?>
				<tr>
                <td colspan="14"><div align="right">
                    <label></label>
                  <input type="button" onClick="imprimir()" value="Imprimir"/>
                </div></td>
                </tr>
            </table>
          </div></td>
      </tr>
      <tr>
        <td bgcolor="#6DAA37">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#091549" class="Estilo2"><div align="center" class="Estilo2"></div></td>
      </tr>

    </table></td>
    <td width="144" background="../../conexion/Img/bg1223.jpg">&nbsp;</td>
  </tr>
</table>
</body>
</html>			  