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
	<title>:: Transportes Marin Hermanos - RepArticulos</title>
	<style type="text/css">
<!--
.Estilo1 {color: #0000FF}
-->
    </style>
</head>
<body>
<table width="1003" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="156" background="../../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="819" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="829">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="135">&nbsp;
          <div align="center">
            <table width="823" height="98" border="1">
              <tr>
                <td colspan="15"><div align="center"><strong> REPORTE DE ARTICULOS </strong></div></td>
                </tr>
              <tr>
                <td width="34"><div align="center"><span class="Estilo1">Cod</span></div></td>
                <td width="110"><div align="center"><span class="Estilo1">Descripcion</span></div></td>
                <td width="30"><div align="center"><span class="Estilo1">Peso</span></div></td>
                <td width="37"><div align="center"><span class="Estilo1">Flete</span></div></td>
                <td width="32"><div align="center"><span class="Estilo1">Tipo </span></div></td>
                <td width="97"><div align="center"><span class="Estilo1">Remitente</span></div></td>
                <td width="85"><div align="center"><span class="Estilo1">Destinatiario</span></div></td>
                <td width="50"><div align="center"><span class="Estilo1">Entrega</span></div></td>
                <td width="48"><div align="center"><span class="Estilo1">Pago</span></div></td>
                <td width="42"><div align="center"><span class="Estilo1">Pago</span></div></td>
				<td width="48"><div align="center"><span class="Estilo1">Viaje</span></div></td>
				<td width="72"><div align="center"><span class="Estilo1">Cod. Rem.</span></div></td>
                <td width="84"><div align="center"><span class="Estilo1">Comprobante</span></div></td>
              </tr>				
              <tr>
                <?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT A.CodigoArticulo, A.Descripcion, A.Peso, A.Flete, A.TipoArticulo, A.Remitente, A.Destinatario, A.TipoEntrega, A.TipoPago, A.EstadoPago, A.Viaje_CodViaje, C.codigo, C.Numero FROM articulo AS A INNER JOIN comprobante AS C ON A.Comprobante_Codigo=C.codigo order by A.CodigoArticulo desc;";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
						echo"<tr><td>".$registro->CodigoArticulo."</td>";
						echo"<td>".$registro->Descripcion."</td>";
						echo"<td>".$registro->Peso."</td>";
						echo"<td>".$registro->Flete."</td>";
						echo"<td>".$registro->TipoArticulo."</td>";
						echo"<td>".$registro->Remitente."</td>";
						echo"<td>".$registro->Destinatario."</td>";
						echo"<td>".$registro->TipoEntrega."</td>";
						echo"<td>".$registro->TipoPago."</td>";
						echo"<td>".$registro->EstadoPago."</td>";
						echo"<td>".$registro->Viaje_CodViaje."</td>";
						echo"<td>".$registro->codigo."</td>";
						echo"<td>".$registro->Numero."</td></tr>";
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
        <td bgcolor="#091549" class="Estilo2"><div align="center" class="Estilo2">Desarrollado por </div></td>
      </tr>

    </table></td>
    <td width="67" background="../../conexion/Img/bg1223.jpg">&nbsp;</td>
  </tr>
</table>
</body>
</html>