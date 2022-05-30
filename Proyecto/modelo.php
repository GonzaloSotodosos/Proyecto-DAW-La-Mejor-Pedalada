<?php
	//modelo.php
	
	/*Comprobacion de la constante EN_CONTROLADOR, si no está definida, finaliza la ejecucion y manda el mensaje.
	Si está definida es porque se accede mediante el controlador y se desarrolla todo el código.*/
	if(!defined("EN_CONTROLADOR"))die("No se puede llamar directamente");
	else{
		class gestionTienda{			
			
			/**
			*Función conexion
			*Guarda en la variable $mysqli la conexion 
			*@param $servidor, $usuario, $contrasenia, $baseDatos
			*@return $mysqli si la conexion esta ok, sino null
			*/
				function conexion($servidor, $usuario, $contrasenia, $baseDatos){
					@$mysqli = mysqli_connect($servidor, $usuario, $contrasenia, $baseDatos);
					if(!$mysqli){
						return null;
					}
					else{
						$mysqli->set_charset("utf8");					
						return $mysqli;
					}				
				}			
		
			/**
			*Función consultarBicicletas
			*Primero comprueba si se le pasa una bici o no
			*Ejecuta la query según el resultado del anterior if
			*Si la query implica a mas de 0 filas y no hay error, guarda el resultado 
			*en un array asociativo mediante fetch_all.
			*@param $mysqli, $bici=-1
			*@return $resultado si la conexion esta ok, sino null
			*/
				function consultarBicicletas($mysqli, $id_bici=-1){
					if($id_bici == -1){
						$sql = "SELECT * FROM bicicletas";
					}
					else{
						$sql = "SELECT * FROM bicicletas WHERE id_bici = '$id_bici'";
					}					
					
					$resultset = $mysqli->query($sql);
					if($resultset->num_rows > 0 && !$mysqli->error){
						$resultado = $resultset->fetch_all(MYSQLI_ASSOC);
						return $resultado;
					}
					else{
						return null;
					}
				}
		
			/**
			*Función consultarEquipamiento
			*Primero comprueba si se le pasa un equipamiento o no
			*Ejecuta la query según el resultado del anterior if
			*Si la query implica a mas de 0 filas y no hay error, guarda el resultado
			*en un array asociativo mediante fetch_all.
			*@param $mysqli, $id_equipamiento=-1
			*@return $resultado si la conexion esta ok, sino null
			*/
				function consultarEquipamiento($mysqli, $id_equipamiento=-1){
					if($id_equipamiento == -1){
						$sql = "SELECT * FROM equipamiento";
					}
					else{
						$sql = "SELECT * FROM equipamiento WHERE id_equipamiento = '$id_equipamiento'";
					}					
					
					$resultset = $mysqli->query($sql);
					if($resultset->num_rows > 0 && !$mysqli->error){
						$resultado = $resultset->fetch_all(MYSQLI_ASSOC);
						return $resultado;
					}
					else{
						return null;
					}
				}	
			/**
			*Función citar
			*@param $nombre, $primerAp, $segundoAp, $direccion, $poblacion, $ciudad, $email
			*Si la el resultado de ejecutar la query es distinto de null, se ha insertado correctamente, 
			*sino devuelve null
			*@return null
			*/		
				function citar($mysqli, $nombre, $primerAp, $segundoAp, $direccion, $poblacion, $ciudad, $email, $marca, 
								$modelo, $descripcion){
					$sql = "INSERT INTO cita_taller (nombre, primer_apellido, segundo_apellido, direccion, poblacion, ciudad, email, marca, 
														modelo, detalles) 
							VALUES ('$nombre', '$primerAp', '$segundoAp', '$direccion', '$poblacion', '$ciudad', '$email', '$marca', 
									'$modelo', '$descripcion');";		
					$resultado = $mysqli->query($sql);
					if(!$resultado){						
						return null;
					}					
				}		
			/**
			*Funcion buscarUsuario
			*@param $mysqli, $usuario, $contrasenia
			*Si el resultado de ejecutar la query implica a mas de 0 filas y no hay error, guarda el resultado
			*en un array asociativo mediante fetch_all.
			*@return $resultado si hay elementos en el array, sino return null
			*/
				function buscarUsuario($mysqli, $usuario, $contrasenia){
					
					$sql = "SELECT nombre, contrasenia FROM usuarios WHERE contrasenia = '$contrasenia' AND nombre = '$usuario'";

					$resultset = $mysqli->query($sql);
					if($resultset->num_rows > 0 && !$mysqli->error){
						$resultado = $resultset->fetch_all(MYSQLI_ASSOC);
						return $resultado;
					}
					else{
						return null;
					}
				}
			/**
			*Funcion insertarUsuario
			*@param $mysqli, $usuario, $contrasenia
			*Si el resultado de ejecutar la query implica a mas de 0 filas y no hay error devuelve true, sino false
			*@return true o false
			*/
				function insertarUsuario($mysqli, $usuario, $contrasenia){
					
					$sql = "INSERT INTO usuarios (nombre, contrasenia) VALUES ('$usuario', '$contrasenia')";
					
					$resultado = $mysqli->query($sql);
						if($mysqli->affected_rows > 0 && !$mysqli->error){
							return true;
						}
						else{
							return false;
						}					
				}
			
				/**
				*Funcion aniadirCarrito
				*@param $mysqli, $id_sesion, $id_bici, $id_equipamiento
				*segun los parametros recibidos ejecuta una query u otra
				*Si el resultado de ejecutar la query implica a mas de 0 filas y no hay error devuelve true, sino false
				*@return true o false
				*/
				function aniadirCarrito($mysqli, $id_sesion, $id_bici = -1, $id_equipamiento = -1){
					
					if($id_bici == -1 || $id_bici == null){
						$sql = "INSERT INTO carrito (id_sesion, id_equipamiento) VALUES ('$id_sesion', '$id_equipamiento')";
					}
					else if($id_equipamiento == -1 || $id_equipamiento == null){
						$sql = "INSERT INTO carrito (id_sesion, id_bici) VALUES ('$id_sesion', '$id_bici')";
					}
					else{
						$sql = "INSERT INTO carrito (id_sesion, id_bici, id_equipamiento) VALUES ('$id_sesion', '$id_bici', '$id_equipamiento')";
					}
					
					
					
					$resultado = $mysqli->query($sql);
						if($mysqli->affected_rows > 0 && !$mysqli->error){
							return true;
						}
						else{
							return false;
						}					
				}
				/**
				*Funcion productoEnCarrito
				*@param $mysqli, $id_sesion, $id_bici, $id_equipamiento
				*segun los parametros recibidos ejecuta una query u otra
				*Si el resultado de ejecutar la query implica a mas de 0 filas y no hay error guarda el resultado
				*en un array asociativo mediante fetch_all.
				*@return $resultado si hay elementos en el array, sino return null
				*/
				function productoEnCarrito($mysqli, $id_sesion, $id_bici = -1, $id_equipamiento = -1){
					
					if($id_bici == -1 || $id_bici == null){
						$sql = "SELECT e.titulo, e.precio, e.imagen 
								FROM equipamiento e
								INNER JOIN carrito c 
								ON c.id_equipamiento = e.id_equipamiento
								WHERE c.id_sesion = '$id_sesion' && e.id_equipamiento = '$id_equipamiento'";
					}
					else if($id_equipamiento == -1 || $id_equipamiento == null){
						$sql = "SELECT b.marca, b.modelo, b.precio, b.imagen 
								FROM bicicletas b
								INNER JOIN carrito c 
								ON c.id_bici = b.id_bici
								WHERE c.id_sesion = '$id_sesion' && b.id_bici = '$id_bici'";
					}
					
					$resultset = $mysqli->query($sql);
					if($resultset->num_rows > 0 && !$mysqli->error){
						$resultado = $resultset->fetch_all(MYSQLI_ASSOC);
						return $resultado;
					}
					else{
						return null;
					}
				}
				/**
				*Funcion productoEnCarritoPrincipal
				*@param $mysqli, $id_sesion
				*Como los productos están divididos en dos tablas (bicis y equipamiento) se hacen dos consultas
				*Si el resultado de ejecutar las querys implica a mas de 0 filas y no hay errores se guarda el resultado
				*de cada ejecucion en un array asociativo ($resultado y $resultado2) mediante fetch_all.
				*Evalua si los arrays anteriores están seteados o no y según el resultado mete los datos en otro array llamado
				*$resultadoFinal. Este array podría contener un varios arrays de bicis, de equipamientos o de ambos.
				*@return $resultadoFinal
				*/
				function productoEnCarritoPrincipal($mysqli, $id_sesion){
					
						$sql = "SELECT b.marca, b.modelo, b.precio, b.imagen
								FROM bicicletas b  								
								INNER JOIN carrito c 
								ON b.id_bici = c.id_bici								
								WHERE id_sesion = '$id_sesion'";
						
						$sql2 = "SELECT e.titulo, e.precio, e.imagen
								FROM equipamiento e								
								INNER JOIN carrito c 
								ON e.id_equipamiento = c.id_equipamiento								
								WHERE id_sesion = '$id_sesion'";
					
					$resultset = $mysqli->query($sql);					
					if($resultset->num_rows > 0 && !$mysqli->error){
						$resultado = $resultset->fetch_all(MYSQLI_ASSOC);						
					}
					
					$resultset2 = $mysqli->query($sql2);					
					if($resultset2->num_rows > 0 && !$mysqli->error){
						$resultado2 = $resultset2->fetch_all(MYSQLI_ASSOC);						
					}
					
					if(isset($resultado) && !isset($resultado2)){
						$resultadoFinal = [$resultado];
						return $resultadoFinal;
					}
					else if(isset($resultado2) && !isset($resultado)){
						$resultadoFinal = [$resultado2];
						return $resultadoFinal;
					}
					else if(isset($resultado) && isset($resultado2)){
						$resultadoFinal = [$resultado,$resultado2];
						return $resultadoFinal;
					}			
					
				}	
				/**
				*Funcion quitarDelCarrito
				*@param $mysqli, $id_sesion, $id_bici, $id_equipamiento
				*segun los parametros recibidos ejecuta una query u otra
				*Si el resultado de ejecutar la query implica a mas de 0 filas y no hay error devuelve true, sino false
				*@return true o false
				*/
				function quitarDelCarrito($mysqli, $id_sesion, $id_bici, $id_equipamiento){

					if($id_bici == -1 || $id_bici == null){
						$sql = "DELETE FROM carrito WHERE id_sesion = '$id_sesion' AND id_equipamiento = '$id_equipamiento'";							
					}
					else if($id_equipamiento == -1 || $id_equipamiento == null){
						$sql = "DELETE FROM carrito WHERE id_sesion = '$id_sesion' AND id_bici = '$id_bici'";						
					}											
								
					$resultado = $mysqli->query($sql);
						if($mysqli->affected_rows > 0 && !$mysqli->error){
							return true;
						}
						else{
							return false;
						}					
				}				
		}		
	}
?>