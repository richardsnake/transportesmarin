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
	<title>:: Transportes Marin Hermanos - RepGradoInstruccion ::</title>
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
            <table width="837" height="78" border="1" align="center">
              <tr>
                <td colspan="13"><div align="center"><strong>REPORTE DE GRADOS DE INSTRUCCION </strong></div></td>
                </tr>
              <tr>
                <td width="46" height="26"><div align="center" class="Estilo2 Estilo1"><span class="Estilo1">Codigo</span></div></td>
                <td width="74"><div align="center" class="Estilo2 Estilo1">DNI</div></td>
                <td width="121"><div align="center" class="Estilo2 Estilo1">Nombre</div></td>
                <td width="136"><div align="center" class="Estilo2 Estilo1">Institucion</div></td>  
                <td width="73"><div align="center" class="Estilo2 Estilo1">A. Inicio</div></td>
                <td width="81"><div align="center" class="Estilo2 Estilo1">A. Termino</div></td>
                <td width="81"><div align="center" class="Estilo2 Estilo1">Nivel</div></td>
                <td width="94"><div align="center" class="Estilo2 Estilo1">Descripcion</div></td>
                <td width="93"><div align="center" class="Estilo2 Estilo1">Especialidad</div></td>
                </tr>				
                <?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT GI.codigo, GI.Trabajador_DNI, GI.institucion, GI.anhoInicio, GI.anhoTermino, GI.nivel, GI.descripcion, GI.especialidad, T.Nombre, T.ApellidoPaterno FROM gradoinstruccion AS GI INNER JOIN trabajador AS T ON GI.Trabajador_DNI=T.DNI ORDER BY Trabajador_DNI";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
							echo"<tr><td>".$registro->codigo."</td>";
							echo"<td>".$registro->Trabajador_DNI."</td>";
							echo"<td>".$registro->Nombre." ".$registro->ApellidoPaterno."</td>";
							echo"<td>".$registro->institucion."</td>";
							echo"<td>".$registro->anhoInicio."</td>";
							echo"<td>".$registro->anhoTermino."</td>";
							echo"<td>".$registro->nivel."</td>";
							echo"<td>".$registro->descripcion."</td>";
							echo"<td>".$registro->especialidad."</td></tr>";
						
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