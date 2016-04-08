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
	<title>:: Transportes Marin Hermanos - RepExperienciaLaboral ::</title>
    <style type="text/css">
<!--
.Estilo2 {color: #0000FF}
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
            <table width="837" height="98" border="1" align="center">
              <tr>
                <td colspan="13"><div align="center"><strong>REPORTE DE EXPERIENCIAS LABORALES </strong></div></td>
                </tr>
              <tr>
                <td width="70"><div align="center" class="Estilo2"><span class="Estilo1">Codigo</span></div></td>
                <td width="65"><div align="center" class="Estilo2"><span class="Estilo1">DNI</span></div></td>
                <td width="140"><div align="center" class="Estilo2">Nombre</div></td>
                <td width="85"><div align="center" class="Estilo2">Institucion</div></td>  
                <td width="63"><div align="center" class="Estilo2"><span class="Estilo1">Rubro</span></div></td>
                <td width="86"><div align="center" class="Estilo2"><span class="Estilo1">Cargo</span></div></td>
                <td width="70"><div align="center" class="Estilo2"><span class="Estilo1">F. Inicion </span></div></td>
                <td width="58"><div align="center" class="Estilo2"><span class="Estilo1">F. Fin </span></div></td>
                <td width="76"><div align="center" class="Estilo2"><span class="Estilo1">Mot. Sece </span></div></td>
                <td width="82"><span class="Estilo2">Descripcion</span></td>
                </tr>				
                <?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT EL.clave, EL.Trabajador_DNI, EL.institucion, EL.rubro, EL.cargo, EL.fechaInicio, EL.fechaFin, EL.motivoSece, EL.descripcion, T.Nombre, T.ApellidoPaterno FROM experiencialaboral AS EL INNER JOIN trabajador AS T ON EL.Trabajador_DNI=T.DNI";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
							echo"<tr><td>".$registro->clave."</td>";
							echo"<td>".$registro->Trabajador_DNI."</td>";
							echo"<td>".$registro->Nombre." ".$registro->ApellidoPaterno."</td>";
							echo"<td>".$registro->institucion."</td>";
							echo"<td>".$registro->rubro."</td>";
							echo"<td>".$registro->cargo."</td>";
							echo"<td>".fechaFormato($registro->fechaInicio)."</td>";
							echo"<td>".fechaFormato($registro->fechaFin)."</td>";
							echo"<td>".$registro->motivoSece."</td>";
							echo"<td>".$registro->descripcion."</td></tr>";
						
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
    <td width="1" background="../../conexion/Img/bg1223.jpg"><div align="center"></div></td>
  </tr>
</table>
</body>
</html>			  