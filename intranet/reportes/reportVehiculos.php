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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>:: Transportes Marin Hermanos - RepVehiculos ::</title>
	<style type="text/css">
<!--
.Estilo1 {color: #0000FF}
-->
    </style>
</head>
<body>
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" background="../../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="800">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><img src="../../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="135">&nbsp;
          <div align="center">
            <table width="810" border="0">
              <tr>
                <td colspan="12" align="center"><div align="center"><strong>REPORTE DE VEHICULOS </strong></div></td>
                </tr>
              <tr>
                <td width="39" align="center" bgcolor="#00CC66"><strong>Placa</strong></td>
                <td width="47" align="center" bgcolor="#00CC66"><strong>Marca</strong></td>
                <td width="58" align="center" bgcolor="#00CC66"><strong>Modelo</strong></td>
                <td width="72" align="center" bgcolor="#00CC66"><strong>N. Certif. </strong></td>
                <td width="80" align="center" bgcolor="#00CC66"><strong>No Regist. </strong></td>
                <td width="41" align="center" bgcolor="#00CC66"><strong>Tara</strong></td>
                <td width="67" align="center" bgcolor="#00CC66"><strong>P. Bruto </strong></td>
                <td width="61" align="center" bgcolor="#00CC66"><strong>P. Util </strong></td>
                <td width="42" align="center" bgcolor="#00CC66"><strong>A&ntilde;o</strong></td>
                <td width="99" align="center" bgcolor="#00CC66"><strong>T. Vehic. </strong></td>
                <td width="89" align="center" bgcolor="#00CC66"><strong>T. Combust. </strong></td>
                <td width="65" align="center" bgcolor="#00CC66"><strong>N. Ejes </strong></td>
                </tr>				
                <?php
					$color="#ffffff";
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT * FROM vehiculo;";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
						echo"<tr bgcolor=$color><td>".$registro->placa."</td>";
						echo"<td>".$registro->Marca."</td>";
						echo"<td>".$registro->Modelo."</td>";
						echo"<td>".$registro->nCertificado."</td>";
						echo"<td>".$registro->nRegistro."</td>";
						echo"<td>".$registro->Tara."</td>";
						echo"<td>".$registro->pesoBruto."</td>";
						echo"<td>".$registro->cargaUtil."</td>";
						echo"<td>".$registro->Anho."</td>";
						echo"<td>".$registro->tipoVehiculo."</td>";
						echo"<td>".$registro->TipoCombustible."</td>";
						echo"<td>".$registro->NEjes."</td></tr>";
						if($color=="#ffffff")
							$color="#cccccc";
						else
							$color="#ffffff";
						//echo"</tr></table>";
					}
					//echo"</table>";
					$bdx->cerrarConexion();			 
				?>
				<tr>
                <td colspan="12"><div align="right">
                    <strong>
                  <input type="button" onClick="imprimir()" value="Imprimir"/>
                  </strong></div></td>
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