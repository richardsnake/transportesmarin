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
	<title>:: Transportes Marin Hermanos - RepComprobantesCompra ::</title>
    <style type="text/css">
<!--
.Estilo1 {color: #0000FF}
-->
    </style>
</head>
<body>
<table width="1007" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="26" background="../../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="967"><table width="967" height="448" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="829">&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"><img src="../../imagenes/sup.jpg" width="780" height="193" /></div></td>
      </tr>
      <tr>
        <td height="174">&nbsp;
          <div align="center">
            <table width="817" height="79" border="1" align="center">
              <tr>
                <td colspan="12"><div align="center"><strong>REPORTE DE COMPROBANTES DE COMPRA </strong></div></td>
                </tr>
              <tr>
                <td width="65"><div align="center" class="Estilo1"><span class="Estilo1">Codigo</span></div></td>
                <td width="108"><div align="center" class="Estilo1">RUC</div></td>
                <td width="128"><div align="center" class="Estilo1">Razon Social</div></td>
                <td width="61"><div align="center" class="Estilo1">Serie</div></td>  
                <td width="65"><div align="center" class="Estilo1">Numero</div></td>
                <td width="66"><div align="center" class="Estilo1">Fecha</div></td>
                <td width="71"><div align="center" class="Estilo1">Monto</div></td>
                <td width="103"><div align="center" class="Estilo1">Descripcion</div></td>
                <td width="112"><div align="center" class="Estilo1">TipoComprobante</div></td>
                </tr>				
              <tr>
                <?php
					require("../../conexion/config.php");
					require("../../conexion/baseDatos.php");
					$sql="SELECT * FROM comprobantecompra where activo=1 ORDER BY razonSocial";
					$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
					$con=$bdx->conectar();
					$result=$bdx->crearConsulta($sql);
					//echo"<table border=\"1\">";
					while($registro=mysql_fetch_object($result))
					{
						//echo"<table><tr>";
							echo"<tr><td>".$registro->codigo."</td>";
							echo"<td>".$registro->RUC."</td>";
							echo"<td>".$registro->razonSocial."</td>";
							echo"<td>".$registro->serie."</td>";
							echo"<td>".$registro->numero."</td>";
							echo"<td>".fechaFormato($registro->fecha)."</td>";
							echo"<td>".$registro->monto."</td>";
							echo"<td>".$registro->descripcion."</td>";
							echo"<td>".$registro->tipoComprobante."</td></tr>";
						
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
    <td width="14" background="../../conexion/Img/bg1223.jpg"><div align="center"></div></td>
  </tr>
</table>
</body>
</html>			  