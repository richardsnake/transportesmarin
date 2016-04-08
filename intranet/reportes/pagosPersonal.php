<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: ../index.html");
	}
	require("../../conexion/config.php");
	require("../../conexion/baseDatos.php");
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
.Estilo2 {font-weight: bold}
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
        <td height="135"><div align="center">
			<?php
				$dni=$_POST["txtDNI"];
				$sql="SELECT Nombre, ApellidoPaterno, ApellidoMaterno, FechaNacimineto, TipoTrabajador FROM trabajador WHERE DNI=$dni;";
				$bdx=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
				$con=$bdx->conectar();
				$result=$bdx->crearConsulta($sql);
				if(mysql_num_rows($result)!=0)
				{	
						$reg=mysql_fetch_object($result);
					
				}
				else
				{
					$band=0;
					echo"<tr> <div align=\"center\"> No existe Trabajador ... </div><tr>";
					}
				
			?>
          <table width="854" border="0">
            <tr>
              <td height="32" colspan="7"><div align="center"><strong>PAGOS DE PERSONAL: </strong></div></td>
              </tr>
            <tr>
              <td width="190"><div align="right"><strong>Nombres : </strong></div></td>
              <td width="196"><?php echo $reg->Nombre?></td>
              <td width="114"><div align="right"><strong>Apellidos : </strong></div></td>
              <td colspan="4"><?php echo $reg->ApellidoPaterno." ".$reg->ApellidoMaterno ?></td>
              </tr>
            <tr>
              <td height="27"><div align="right"><strong>Fecha Nacimiento:</strong></div></td>
              <td><?php echo $reg->FechaNacimineto?></td>
              <td colspan="2"><div align="right"><strong>Tipo Trabajador : </strong></div></td>
              <td colspan="3"><?php echo $reg->TipoTrabajador?></td>
              </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td width="182">&nbsp;</td>
              <td width="108"><div align="left"></div></td>
            </tr>
            <tr>
              <td height="47" colspan="7"><div align="center">
                <table width="798" border="1">
                  <tr>
                    <td width="75" bgcolor="#66CCFF"><div align="center"><strong>CODIGO</strong></div></td>
                    <td width="77" bgcolor="#66CCFF"><div align="center"><strong>FECHA</strong></div></td>
                    <td width="182" bgcolor="#66CCFF"><div align="center"><strong>MONTO</strong></div></td>
                  </tr>
				  <?php
				  	$sql="SELECT codigo, monto, fecha FROM pagopersonal WHERE Trabajador_DNI='$dni' AND activo=1;";
					$result=$bdx->crearConsulta($sql);
					if(mysql_num_rows($result)!=0)
					{
						while($reg1=mysql_fetch_object($result))
						{
							echo"<tr><td>".$reg1->codigo."</td>";
							echo"<td>".fechaFormato($reg1->fecha)."</td>";
							echo"<td>".$reg1->monto."</td>";
						}
					}
				  ?>
                </table>
              </div></td>
              </tr>
          </table>
          <div align="center">
			<label>
              <input name="Imprimir" type="button" id="Imprimir" value="Imprimir" onClick="imprimir()" />
              </label>
            </div>
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