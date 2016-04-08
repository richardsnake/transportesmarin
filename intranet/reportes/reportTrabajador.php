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
	<title>:: Transportes Marin Hermanos - RepTrabajadores ::</title>
    <style type="text/css">
<!--
.Estilo1 {color: #0000FF}
-->
    </style>
<body>
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" background="../../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="822" height="409" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="829">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><img src="../../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="135">&nbsp;
          <div align="center">
            <table width="840" border="0" align="center">
              <tr>
                <td colspan="12"><div align="center"><strong>REPORTE DE TRABAJADORES</strong></div></td>
                </tr>
              <tr>
                <td width="51" bgcolor="#00CC66"><div align="center">DNI</div></td>
                <td width="89" bgcolor="#00CC66"><div align="center">Nombre</div></td>
                <td width="77" bgcolor="#00CC66"><div align="center">A. Paterno</div></td>
                <td width="78" bgcolor="#00CC66"><div align="center">A. Materno</div></td>  
                <td width="62" bgcolor="#00CC66"><div align="center">F. Nacim.</div></td>
				<td width="66" bgcolor="#00CC66"><div align="center">Direccion</div></td>
                <td width="61" bgcolor="#00CC66"><div align="center">Telefono</div></td>
                <td width="93" bgcolor="#00CC66"><div align="center">T. Trabajador</div></td>
                <td width="51" bgcolor="#00CC66"><div align="center">E. Civil</div></td>
				<td width="78" bgcolor="#00CC66"><div align="center">G. Instruc.</div></td>
				<td width="70" bgcolor="#00CC66"><div align="center">Sucursal</div></td>
                </tr>
                <?php
					$color="#ffffff";
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT T.DNI, T.Nombre, T.ApellidoPaterno, T.ApellidoMaterno, T.FechaNacimineto, T.Direccion, T.Telefono, T.TipoTrabajador, T.estadoCivil, T.gradoInstruccion, S.RazonSocial FROM trabajador AS T INNER JOIN sucursal AS S ON T.Sucursal_codigoSucursal=S.codigoSucursal;";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
							echo"<tr bgcolor=$color><td>".$registro->DNI."</td>";
							echo"<td>".$registro->Nombre."</td>";
							echo"<td>".$registro->ApellidoPaterno."</td>";
							echo"<td>".$registro->ApellidoMaterno."</td>";
							echo"<td>".$registro->FechaNacimineto."</td>";
							echo"<td>".$registro->Direccion."</td>";
							echo"<td>".$registro->Telefono."</td>";
							echo"<td>".$registro->TipoTrabajador."</td>";
							echo"<td>".$registro->estadoCivil."</td>";
							echo"<td>".$registro->gradoInstruccion."</td>";
							echo"<td>".$registro->RazonSocial."</td></tr>";
							
						if($color=="#ffffff")
							$color="#cccccc";
						else
							$color="#ffffff";
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
    <td width="67" background="../../conexion/Img/bg1223.jpg"><div align="center"></div></td>
  </tr>
</table>
</body>
</html>	