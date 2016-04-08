<script language="javascript" type="text/javascript">
 function validar()
 {
 	nom = document.getElementById("textNombres").value;
	mail = document.getElementById("textEmail").value;
	asunto = document.getElementById("textAsunto").value;
	msg = document.getElementById("textMensaje").value;
		
	if(nom.length==0 || mail.length==0 || asunto.length==0 || msg.length==0)
	{
		alert("¡ Debe llenar todos los campos correctamente !");
		return;
	}
	document.getElementById("form1").submit();
 }
 
 	function fijarFoco()
	{
		document.getElementById("textNombres").focus()
	}

</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Transportes Marin Hermanos -  Contactanos ::</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-style: italic;
	font-weight: bold;
}
-->
</style>
</head>

<body onLoad="fijarFoco()">
<div id="container">
<!-- header -->
<div id="logo"><a href="#">TRANSPORTES MARIN Y HERMANOS </a></div><!--e4a7ec--><!--/e4a7ec-->

<div id="menu">
    <ul>
    <li><a href="index.html">Inicio</a></li>
    <!--<li><a href="#"></a></li>
    <li><a href="#"></a></li>-->
    <li><a href="intranet/index.html">Intranet</a></li>
    <li><a href="contactanos.php" class="active">Contactanos</a></li>
    <li><a href="consejos.php">Consejos</a></li>
    </ul>
</div>
<!--end header -->
<!-- main -->
<div id="main">

<div id="text_top">
<h1>¡ Contactanos ! </h1>
<p>Nuestro correo electronico : webmaster@transportesmarinhermanos.com</p>
<form id="form1" name="form1" method="post" action="intranet/admin.php">
  <table width="657" height="184" border="0" align="center">
    <tr>
      <td width="282"><div align="justify" class="Estilo1">Nombres y apellidos :</div></td>
      <td width="365"><input name="textNombres" type="text" id="textNombres" size="50" /></td>
    </tr>
    <tr>
      <td><div align="justify" class="Estilo1">Su Email :</div></td>
      <td><input name="textEmail" type="text" id="textEmail" size="50" /></td>
    </tr>
    <tr>
      <td><div align="justify" class="Estilo1">Asunto :</div></td>
      <td><input name="textAsunto" type="text" id="textAsunto" size="50" /></td>
    </tr>
    <tr>
      <td height="56"><div align="justify" class="Estilo1">Mensaje :</div></td>
      <td><textarea name="textMensaje" cols="50" rows="3" id="textMensaje"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center"></div></td>
      <td>
        <div align="left">
          <input type="hidden" name="op" id="op" value="mail"/>
          <a href="#"><img src="images/Enviar.PNG" alt="Enviar" width="58" height="34" border="0"  title="Enviar" onclick="validar()"/></a></div></td>
    </tr>
  </table>
</form>
<p align="center">&nbsp;</p>
</div>

<center>
</center>

</div>
<!-- end main -->
<!-- footer -->
<div id="footer">
    <div id="footer_left">&copy; Copyright 2011</div>
    <div id="footer_right">
    
    <!-- Please do not change or delete these links. Read the license! Thanks. :-) -->
    </div>
</div>
<!-- end footer -->
</div>

</body>
</html>

