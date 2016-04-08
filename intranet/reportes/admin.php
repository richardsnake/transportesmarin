<?php
	require("../../conexion/config.php");
	require("../../conexion/baseDatos.php");
	
	if(!isset($_POST["op"]))
	{
		header("Location: ../index.html");
		die;
	}	
	
	$opc = $_POST["op"];	
	unset($_POST["op"]);
	
	switch($opc)
	{
		case 'loggin':	loggear();
						break;	
												
		case 'regComprobante':	registrarComprobante();
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
		$consulta = "select cuenta,password from administrador;";
		$result = $bd->crearConsulta($consulta);
		$band=false;
		
		while($registro = mysql_fetch_object($result))
		{
			$cuenta = $registro->cuenta;
			$password = $registro->password;			
			
			if($usuario==$cuenta && $clave==$password)
			{				
				session_start();
				$_SESSION["usuario"] = $usuario;
				$_SESSION["pass"] = $clave;
								
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
					$_SESSION["usuario"] = $usuario;
					$_SESSION["pass"] = $clave;
					header("Location: trabajador.php");
					die;
				}
			}			
		}
		?>	
		<script language="javascript" type="text/javascript">
			alert("¡ El par Usuario/Password  es incorrecto !");
			location.href="index.html";
		</script>
		<?php
	}
	
	function registrarComprobante()
	{
		$comp = $_POST["codComp"];
		$tipoComp = $_POST["selectTipo"];
		$serie = $_POST["textSerie"];
		$numero = $_POST["textNumero"];
		$detraccion = $_POST["detraccion"];
		$total = $_POST["total"];
		$total = number_format($total, 2, '.', '');
		
		if($detraccion!=0)
		{
			$detraccion = 1;
		}		
		$consult = "update comprobante set TipoComprobante='$tipoComp', Serie='$serie', Numero='$numero', Fecha='".date('Y-m-d')."', Detraccion='$detraccion', total='$total', nCheque='null', activo=1, usuario='null' where codigo='$comp';";
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();			
		$bd->crearConsulta($consult);
		header("Location: administrador.php");
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
				
		if($estadoR!="1")
		{
			if($estadoR=="nat")
			{
				$nombre = $_POST["txtNombre"];					
				$apeP = $_POST["txtAPaterno"];
				$apeM = $_POST["txtAMaterno"];			
				$cel = $_POST["txtCelular"];
				$email = $_POST["txtEmail"];							
				
				$consult = "insert into cliente(Nombres, ApellidoPaterno, ApellidoMaterno, DNI, Celular, email, TipoCliente, activo) values('$nombre', '$apeP', '$apeM', '$dni_rucR', '$cel', '$email', 'Natural', 1);";
				$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
				$bd->conectar();			
				$bd->crearConsulta($consult);					
				$claveClienteR = mysql_insert_id();			
				$rem = $nombre." ".$apeP;
			}
			else if($estadoR=="jur")
			{
				$razS = $_POST["textRaz"];								
				$tel = $_POST["textTel"];
				$email = $_POST["textMail"];
				
				$consult = "insert into cliente(RazonSocial, RUC, Telefono, email, TipoCliente, activo) values('$razS', '$dni_rucR', '$tel', '$email', 'Juridica', 1);";
				$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
				$bd->conectar();			
				$bd->crearConsulta($consult);				
				$claveClienteR = mysql_insert_id();	
				$rem = $razS;		
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
			if($estadoD=="nat")
			{
				$nombre = $_POST["txtNombres2"];		
				$apeP = $_POST["txtAPaterno2"];
				$apeM = $_POST["txtAMaterno2"];			
				$cel = $_POST["txtCelular2"];
				$email = $_POST["txtEmail2"];
			
				$consult = "insert into cliente(Nombres, ApellidoPaterno, ApellidoMaterno, DNI, Celular, email, TipoCliente, activo) values('$nombre', '$apeP', '$apeM', '$dni_rucD', '$cel', '$email', 'Natural', 1);";
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
			
				$consult = "insert into cliente(RazonSocial, RUC, Telefono, email, TipoCliente, activo) values('$razS', '$dni_rucD', '$tel', '$email', 'Juridica', 1);";
				$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
				$bd->conectar();			
				$bd->crearConsulta($consult);	
				$claveClienteD = mysql_insert_id();		
				$dest = $razS;
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
				$dest = $reg->Nombres." ".ApellidoPaterno;
			}
		}		
		
		$consult = "insert into comprobante(Sucursal_codigoSucursal, Cliente_CodigoCliente) values($codSucursal, $claveClienteR);";
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();			
		$bd->crearConsulta($consult);	
		$claveComp = mysql_insert_id();		
						
		$consult = "insert into articulo(Descripcion, Peso, Flete, TipoArticulo, Remitente, Destinatario, TipoEntrega, TipoPago, EstadoPago, activo, Viaje_CodViaje, Cliente_CodigoCliente, Comprobante_Codigo) values('$desc', $peso, $flete, '$tipoA', '$rem', '$dest', '$tipoE', '$tipoP', '$estadoP', 1, '$codViaje', '$claveClienteR', '$claveComp');";
		$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
		$bd->conectar();			
		$bd->crearConsulta($consult);	
		header("Location: formRegistrarNuevoArt.php?op=agregarArt&claveComp=$claveComp&Rem=$claveClienteR&Dest=$claveClienteD&CodViaje=$codViaje&CodCliente=$claveClienteR");	
	}
	
	function separarVehiculoCarreta()
	{
		$placas=$_POST["cmbVehiculoCarreta"];
		$cont=strlen($placas);
		$j=0;
		$k=0;
		for($i=0;$i<$cont;$i++)
		{
			if($placas[$i]!='*')
			{
				$cadena[$j]=$placas[$i];
				$j++;
			}
			else
			{
				$placa[$k]=$cadena;
				$k++;
				$j=0;
			}
		}
		$consulta="DELETE vehiculoCarreta WHERE Carreta_placa='$placa[0]' AND Vehiculo_placa='$placa[1]';";
		$bd= new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
		$bd->conectar();
		$bd->crearConsulta($consulta);
		header("Location: administrador.php");		
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
		$consulta="UPDATE viaje SET FechaLlegada='".$anho."-".$mes."-".$dia."', HoraLlegada='".$horas.":".$min."', estadoViaje='arrivado' WHERE CodViaje=$clave;";		
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
		
		$consulta=" insert into vehiculocarreta(Carreta_placa, Vehiculo_placa, fechaInicio, activo) values('$carreta', '$vehiculo', ".$anho.$mes.$dia.", 1)";
		$bd= new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
		$bd->conectar();
		$bd->crearConsulta($consulta);
		$sql="update vehiculo set estado='no disponible' where placa='$vehiculo';";
		$bd->crearConsulta($sql);
		$sql2="update carreta set estado='no disponible' where placa='$carreta';";
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
		
		$consult = "insert into viaje(FechaSalida, HoraSalida, estadoViaje, activo, Vehiculo_placa, Ruta_codigoRuta) values('".$anhoS."-".$mesS."-".$diaS."','".$hora.":".$min."', 'programado', 1, '$codVehi', '$codRuta')";
		$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
		$bd->conectar();
		$bd->crearConsulta($consult);
		$codViaje = mysql_insert_id();
		$consult = "insert into conductoresviaje values($codCond, $codViaje, 1, 1, null);";
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
		$montoTotal = number_format($montoTotal, 2, '.', '');
		$consult = "update comprobantecompra set monto=$montoTotal where codigo=$claveComp;";				
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
		
		$consulta = "insert into productotrabajador(Trabajador_DNI, Producto_codigoProducto, cantidad, fecha, activo, usuario) values('$dni', '$idProd', '$cant', '".date('Y-m-d')."', 1, null);";
		$result = $bd->crearConsulta($consulta);	

		$newStock = $stock-$cant;
		$consulta = "update producto set stock='$newStock' where codigoProducto='$idProd';";
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
		
		$consulta = "insert into comprobantecompra(RUC, razonSocial, numero, serie, monto, fecha, tipoComprobante, descripcion, activo, Ciudad_Clave) values('$ruc', '$razSocial', '$numero', '$serie', '$monto', ".$anho.$mes.$dia.", '$comp', '$desc', 1, '$claveCiud');";
		$bd->crearConsulta($consulta);
		$bd->cerrarConexion();		
		header("Location: administrador.php");
	}	
	
	function guardarRuta()
	{
		$origen = $_POST["listDistritoO"];
		$destino = $_POST["listDistritoD"];
		
		$consulta = "insert into ruta (CiudadOrigen, CiudadDestino, Nombre, activo) values ('$origen', '$destino', '".$origen." - ".$destino."', 1);";
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
		$consulta = "insert into descuentopersonal (monto, fecha, motivo, activo, Trabajador_DNI) values ('$monto', '".date('Y-m-d')."','$motivo', '1', '$dni');";		
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
		$consulta = "insert into pagopersonal (monto, fecha, tipoPago, activo, Trabajador_DNI) values ('$monto', '".date('Y-m-d')."','$tipoPago', '1', '$dni');";		
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