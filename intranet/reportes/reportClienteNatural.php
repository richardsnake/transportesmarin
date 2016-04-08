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
	<title>:: Transportes Marin Hermanos - RepClientesNaturales ::</title>
    <style type="text/css">
<!--
.Estilo2 {color: #0000FF}
-->
    </style>
</head>
<body>
<table width="1003" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="156" background="../../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="822" height="409" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="829">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="135">&nbsp;
          <div align="center">
            <table width="817" height="79" border="1" align="center">
              <tr>
                <td colspan="12"><div align="center"><strong>REPORTE DE CLIENTES NATURALES</strong></div></td>
                </tr>
              <tr>
                <td width="67"><div align="center" class="Estilo2"><span class="Estilo1">Codigo</span></div></td>
                <td width="90"><div align="center" class="Estilo2"><span class="Estilo1">DNI</span></div></td>
                <td width="103"><div align="center" class="Estilo2"><span class="Estilo1">A. Paterno</span></div></td>
                <td width="115"><div align="center" class="Estilo2"><span class="Estilo1">A. Materno</span></div></td>  
                <td width="171"><div align="center" class="Estilo2"><span class="Estilo1">Nombres</span></div></td>
                <td width="171"><div align="center" class="Estilo2"><span class="Estilo1">Dirección Fiscal</span></div></td>				
                <td width="96"><div align="center" class="Estilo2"><span class="Estilo1">E-mail</span></div></td>
                <td width="60"><div align="center" class="Estilo2"><span class="Estilo1">Celular</span></div></td>
                </tr>
                <?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT * FROM cliente where TipoCliente='Natural'";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
							echo"<tr><td>".$registro->CodigoCliente."</td>";
							echo"<td>".$registro->DNI."</td>";
							echo"<td>".$registro->ApellidoPaterno."</td>";
							echo"<td>".$registro->ApellidoMaterno."</td>";
							echo"<td>".$registro->Nombres."</td>";
							echo"<td>".$registro->direccionFiscal."</td>";							
							echo"<td>".$registro->email."</td>";
							echo"<td>".$registro->Celular."</td></tr>";
						
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
    <td width="67" background="../../conexion/Img/bg1223.jpg"><div align="center"></div></td>
  </tr>
</table>
</body>
</html>			  