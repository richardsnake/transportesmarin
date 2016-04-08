<?php
	//Validar op
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}
	
	require("../../conexion/ajax.php");
?>
<script language="javascript" type="text/javascript">
	var aux=false;
	
	function go()
	{
		location.href = "../administrador.php";
	}

	function manejoBuscar()
	{	
		//agregarCargando('cargando');
		codigo = document.getElementById('txtNumero').value;
		
		if(codigo.length==0)
		{
			alert("¡ Debe ingresar un numero !");
			return;		
		}
		document.getElementById("formArtComp").submit();				
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - DescuentoPersonal ::</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo2 {	font-size: 14px;
	color: #FFFFFF;
}
-->
</style></head>

<body>
<table width="1003" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="156" background="../conexion/Img/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="819">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td height="142"><form id="formArtComp" name="formArtComp" method="post" action="articulos.php">
          <p align="center"><strong>REPORTE DE ARTICULOS POR COMPROBANTE  </strong></p>
          <table width="239" height="123" border="0" align="center">
            <tr>
              <td height="28"><div align="center"><strong>Campo</strong></div></td>
              <td><select name="cmbCampo" size="1" id="cmbCampo">
                <option value="codigo">Cod. Remito</option>
                <option value="Numero">Numero</option>
                <option value="nGuiaRemision">N&ordm; Guia</option>
              </select>              </td>
            </tr>
            <tr>
              <td width="337" height="42"><div align="center"><strong>Numero</strong></div></td>
              <td width="189"><label>
                <input name="txtNumero" type="text" id="txtNumero" onKeyPress="delIntro(event)" />
                  </label></td>
            </tr>
            <tr>
              <td height="45">                
                <div align="center">
                  <input type="button" name="Submit" value="Buscar" onClick="manejoBuscar()"/>              
                  </div></td>
              <td><label>
                    
                    <div align="center">
                      <input type="button" name="Buscar" value="cancelar" onClick="go()"/>                    
                      </label>                  
                      </div></td>
            </tr>
          </table>
        </form>		   </td>
      </tr>
      <tr>
        <td bgcolor="#6DAA37">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#091549" class="Estilo2"><div align="center" class="Estilo2"></div></td>
      </tr>

    </table></td>
    <td width="67" background="../conexion/Img/bg1223.jpg">&nbsp;</td>
  </tr>
</table>
</body>
</html>