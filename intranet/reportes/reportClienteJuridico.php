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
	<title>:: Transportes Marin Hermanos - RepClientesJuridicos ::</title>
    <style type="text/css">
<!--
.Estilo1 {color: #0000FF}
-->
    </style>
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
            <table width="765" border="1" align="center">
              <tr>
                <td colspan="17"><div align="center"><strong>REPORTE DE CLIENTES JURIDICAS </strong></div></td>
                </tr>
              <tr>
                <td width="75"><div align="center"><span class="Estilo1">Codigo</span></div></td>
                <td width="106"><div align="center"><span class="Estilo1">RUC</span></div></td>
                <td width="189"><div align="center"><span class="Estilo1">Razon Social</span></div></td>
                <td width="169"><div align="center"><span class="Estilo1">Dirección Fiscal</span></div></td>				
                <td width="98"><div align="center"><span class="Estilo1">Telefono</span></div></td>
                <td width="88"><div align="center"><span class="Estilo1">E-mail</span></div></td> 
                </tr>				
                <?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT * FROM cliente where TipoCliente='Juridica'";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
							echo"<tr><td>".$registro->CodigoCliente."</td>";
							echo"<td>".$registro->RUC."</td>";
							echo"<td>".$registro->RazonSocial."</td>";
							echo"<td>".$registro->direccionFiscal."</td>";							
							echo"<td>".$registro->Telefono."</td>";
							echo"<td>".$registro->email."</td></tr>";
						
					}
					//echo"</table>";
					$bdx->cerrarConexion();			 
				?>
				<tr>
                <td colspan="17"><div align="right">
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