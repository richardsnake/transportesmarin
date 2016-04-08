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
	<title>:: Transportes Marin Hermanos - RepViajes ::</title>
    <style type="text/css">
<!--
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
.Estilo3 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #615343;
}
.Estilo4 {font-size: 12px}
.Estilo6 {color: #615343}
-->
    </style>
</head>
<body>
<table width="955" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="89" background="../../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="865"><table width="837" height="409" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="837">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><div align="center"><img src="../../imagenes/sup.jpg" width="780" height="193" /></div></td>
      </tr>
      <tr>
        <td height="135">&nbsp;
          <div align="center">
            <table width="837" height="78" border="0" align="center">
              <tr>
                <td colspan="13" bgcolor="#F4F4FB"><div align="center" class="Estilo3">REPORTE DE VIAJES </div></td>
                </tr>
              <tr>
                <td width="51" height="26" bgcolor="#F0F3F4"><div align="center" class="Estilo4 Estilo2 Estilo6"><strong>Codigo</strong></div></td>
                <td width="88" bgcolor="#F0F3F4"><div align="center" class="Estilo4 Estilo2 Estilo6"><strong>F, Salida</strong></div></td>
                <td width="74" bgcolor="#F0F3F4"><div align="center" class="Estilo4 Estilo2 Estilo6"><strong>H. Salida</strong></div></td>
                <td width="93" bgcolor="#F0F3F4"><div align="center" class="Estilo4 Estilo2 Estilo6"><strong>F. Llegada</strong></div></td>  
                <td width="88" bgcolor="#F0F3F4"><div align="center" class="Estilo4 Estilo2 Estilo6"><strong>H. Llgada</strong></div></td>
                <td width="92" bgcolor="#F0F3F4"><div align="center" class="Estilo4 Estilo2 Estilo6"><strong>E. Viaje</strong></div></td>
                <td width="87" bgcolor="#F0F3F4"><div align="center" class="Estilo4 Estilo2 Estilo6"><strong>Vehiculo</strong></div></td>
                <td width="212" bgcolor="#F0F3F4"><div align="center" class="Estilo4 Estilo6 Estilo2"><strong>Ruta</strong></div></td>
                </tr>		
                <?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT V.codViaje, V.FechaSalida, V.FechaLlegada, V.HoraSalida, V.HoraLlegada, V.estadoViaje, V.Vehiculo_placa, R.Nombre FROM viaje AS V INNER JOIN ruta AS R ON V.Ruta_CodigoRuta =R.CodigoRuta ORDER BY CODVIAJE DESC";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
							echo"<tr><td bgcolor=\"#F5F5EF\">".$registro->codViaje."</td>";
							echo"<td bgcolor=\"#F5F5EF\">".fechaFormato($registro->FechaSalida)."</td>";
							echo"<td bgcolor=\"#F5F5EF\">".$registro->HoraSalida."</td>";
							echo"<td bgcolor=\"#F5F5EF\">".fechaFormato($registro->FechaLlegada)."</td>";
							echo"<td bgcolor=\"#F5F5EF\">".$registro->HoraLlegada."</td>";
							echo"<td bgcolor=\"#F5F5EF\">".strtoupper($registro->estadoViaje)."</td>";
							echo"<td bgcolor=\"#F5F5EF\">".strtoupper($registro->Vehiculo_placa)."</td>";
							echo"<td bgcolor=\"#F5F5EF\">".strtoupper($registro->Nombre)."</td></tr>";
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
    <td width="1" background="../../conexion/Img/bg1223.jpg"><div align="center"></div></td>
  </tr>
</table>
</body>
</html>	