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
<title>:: Transportes Marin Hermanos - Repproductos</title>
<style type="text/css">
<!--
.Estilo2 {color: #0000FF}
.Estilo3 {
	color: #000000;
	font-weight: bold;
}
.Estilo4 {color: #0000FF; font-weight: bold; }
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
              <td height="35" colspan="7"><div align="center" class="Estilo3">REPORTE DE PRODUCTOS </div></td>
              </tr>
            <tr>
              <td height="23"><div align="center" class="Estilo2"><strong>Codigo</strong></div></td>
              <td><div align="center" class="Estilo4">Nombre</div></td>	
              <td><div align="center" class="Estilo4">Descripcion</div></td>
			  <td><div align="center" class="Estilo4">Stock</div></td>
			  <td><div align="center" class="Estilo4">Estado</div></td>
            </tr>

			  	<?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT * FROM producto order by codigoProducto desc;";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
						echo"<tr><td><div align=\"center\">".$registro->codigoProducto."</div></td>";
						echo"<td><div align=\"center\">".$registro->nombre."</div></td>";
					    echo"<td><div align=\"center\">".$registro->descripcion."</div></td>";
						echo"<td><div align=\"center\">".$registro->stock."</div></td>";
						echo"<td><div align=\"center\">".$registro->estado."</div></td>";
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