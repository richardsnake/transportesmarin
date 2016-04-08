<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: ../index.html");
	}
	else if($_SESSION["tipo"]=="trab")
	{
		header("Location: ../trabajador..php");
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 00000000"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - RepProductoCompCompra ::</title>
<style type="text/css">
<!--
.Estilo2 {color: #0000FF}
.Estilo3 {
	color: #000000;
	font-weight: bold;
}
-->
</style>
</head>
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
        <td height="124"><div align="center">
          <table width="712" border="1">
            <tr>
              <td height="35" colspan="15"><div align="center" class="Estilo3">REPORTE DE PRODUCTOS ASIGNADOS A TRABAJADORES</div></td>
              </tr>
            <tr>
              <td width="89" height="30"><div align="center" class="Estilo2">Comprobante</div></td>
              <td width="126"><div align="center" class="Estilo2">R. Social</div></td>	
              <td width="69"><div align="center" class="Estilo2">Monto</div></td>
			  <td width="108"><div align="center" class="Estilo2">Nom. Prod.</div></td>
			  <td width="101"><div align="center" class="Estilo2">P. Unitario</div></td>
			  <td width="86"><div align="center" class="Estilo2">Cantidad</div></td>
			  <td width="103"><div align="center" class="Estilo2">M. Parcial</div></td>
            </tr>
			  	<?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT PCC.precioUnitario, PCC.cantidad, PCC.montoParcial, P.nombre, CC.numero, CC.razonSocial, CC.monto FROM ((productocomprobantecompra AS PCC INNER JOIN comprobantecompra AS CC ON PCC. ComprobanteCompra_codigo=CC.codigo) INNER JOIN producto AS P ON (PCC.Producto_codigoProducto=P.codigoProducto)) ORDER BY razonSocial;";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
						echo"<tr><td><div align=\"center\">".$registro->numero."</div></td>";
						echo"<td><div align=\"center\">".$registro->razonSocial."</div></td>";
					    echo"<td><div align=\"center\">".$registro->monto."</div></td>";
						echo"<td><div align=\"center\">".$registro->nombre."</div></td>";
						echo"<td><div align=\"center\">".$registro->precioUnitario."</div></td>";
						echo"<td><div align=\"center\">".$registro->cantidad."</div></td>";
						echo"<td><div align=\"center\">".$registro->montoParcial."</div></td>";
						//echo"</tr></table>";
					}
					//echo"</table>";
					$bdx->cerrarConexion();			 
				?>		
				<tr>
                <td colspan="12"><div align="right">
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
    <td width="67" background="../conexion/Img/bg1223.jpg">&nbsp;</td>
  </tr>
</table>
</body>
</html>