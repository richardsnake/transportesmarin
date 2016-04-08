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
	<title>:: Transportes Marin Hermanos - RepSucursales ::</title>
    <style type="text/css">
<!--
.Estilo1 {color: #0000FF}
-->
    </style>
</head>
<body>
<table width="955" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="89" background="../../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="865"><table width="837" height="409" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="837">&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"><img src="../../imagenes/sup.jpg" width="780" height="193" /></div></td>
      </tr>
      <tr>
        <td height="135">&nbsp;
          <div align="center">
            <table width="837" height="79" border="1" align="center">
              <tr>
                <td colspan="13"><div align="center"><strong>REPORTE DE SUCURSALES </strong></div></td>
              </tr>
              <tr>
                <td width="45" height="27"><div align="center" class="Estilo2 Estilo1"><span class="Estilo1">Codigo</span></div></td>
                <td width="137"><div align="center" class="Estilo2 Estilo1">R. Social</div></td>
                <td width="66"><div align="center" class="Estilo2 Estilo1">RUC</div></td>
                <td width="171"><div align="center" class="Estilo2 Estilo1">Direccion</div></td>
                <td width="62"><div align="center" class="Estilo2 Estilo1">Zona</div></td>
                <td width="76"><div align="center" class="Estilo2 Estilo1">Telefono</div></td>
                <td width="68"><div align="center" class="Estilo2 Estilo1">Celular</div></td>
                <td width="103"><div align="center" class="Estilo2 Estilo1">Email</div></td>
                <td width="71"><div align="center" class="Estilo2 Estilo1">Ciudad</div></td>
              </tr>
                <?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT S.codigoSucursal, S.RazonSocial, S.RUC, S.Direccion, S.Zona, S.Telefono, S.celular, S.email, C.Distrito FROM sucursal AS S INNER JOIN ciudad AS C ON S.Ciudad_clave=C.Clave";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
							echo"<tr><td>".$registro->codigoSucursal."</td>";
							echo"<td>".$registro->RazonSocial."</td>";
							echo"<td>".$registro->RUC."</td>";
							echo"<td>".$registro->Direccion."</td>";
							echo"<td>".$registro->Zona."</td>";
							echo"<td>".$registro->Telefono."</td>";
							echo"<td>".$registro->celular."</td>";
							echo"<td>".$registro->email."</td>";
							echo"<td>".$registro->Distrito."</td></tr>";
						
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