<?php
	//Controladores.php
	ob_start();
	/**
	*Función para el controlador especifico de inicio.
	*Carga la vista inicio.php en template de base.php
	*/	
	function controlador_inicio(){				
		
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
		}			
		
		require 'templates/inicio.php';
		
	}
	/**
	*Función para el controlador especifico de productos.
	*Carga la vista productos.php en template de base.php
	*/
	function controlador_productos(){		
			
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];				
		}		
			
		//Creamos un objeto de gestionTienda 
		$o = new gestionTienda();
		//Ejecutamos el método conexion pasandole $servidor, $usuario, $contrasenia, $baseDatos		
		$mysqli = $o->conexion("localhost", "admProyecto", "Proyecto2022", "la_mejor_pedalada");
		//Ejecutamos los métodos consultarBicicletas y consultarEquipamiento pasandoles la conexion
		$resultado = $o->consultarBicicletas($mysqli);
		$resultado2 = $o->consultarEquipamiento($mysqli);			
		
		require 'templates/productos.php';
		//Cerramos la conexion
		$mysqli->close();
		
	}
	/**
	*Función para el controlador especifico de infoBicis.
	*@param $id_bici
	*Carga la vista detalleBici.php en template de base.php
	*/	
	function controlador_infoBicis($id_bici){
		
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
		}	
		
		//Creamos un objeto de gestionTienda
		$o = new gestionTienda();
		//Ejecutamos el método conexion pasandole $servidor, $usuario, $contrasenia, $baseDatos	
		$mysqli = $o->conexion("localhost", "admProyecto", "Proyecto2022", "la_mejor_pedalada");
		//Ejecutamos el método consultarBicicletas pasandole la conexión y el id_bici recogido 
		$resultado = $o->consultarBicicletas($mysqli,$id_bici);
			
		require 'templates/detalleBici.php';
		//Cerramos la conexion
		$mysqli->close();
		
	}
	/**
	*Función para el controlador especifico de infoEqui.
	*@param $id_equipamiento
	*Carga la vista detalleEquipamiento.php en template de base.php
	*/	
	function controlador_infoEqui($id_equipamiento){
		
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
		}	
			
		//Creamos un objeto de gestionTienda
		$o = new gestionTienda();
		//Ejecutamos el método conexion pasandole $servidor, $usuario, $contrasenia, $baseDatos
		$mysqli = $o->conexion("localhost", "admProyecto", "Proyecto2022", "la_mejor_pedalada");
		//Ejecutamos el método consultarEquipamiento pasandole la conexión y el id_equipamiento recogido 
		$resultado = $o->consultarEquipamiento($mysqli,$id_equipamiento);
			
		require 'templates/detalleEquipamiento.php';
		//Cerramos la conexion
		$mysqli->close();
		
	}
	/**
	*Función para el controlador especifico de cita.	
	*Carga la vista cita.php en template de base.php
	*Muestra el formulario y reedirige a citaCorrecta.php si es correcto o a citaIncorrecta.php si no es correcto
	*/
	function controlador_cita(){
		
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
		}	
			
		//requerimos el fichero validadores.php que contiene los metodos para validar es_texto y es_email
		require 'validarCita.php';
		//creamos los campos del formulario para poder registrarse
		$formulario = array(
			//Vamos a seguir el patrón ('label', 'type', 'name', 'value')
			array("Nombre: ", "text", "nombre", ""),
			array("Primer Apellido: ", "text", "primero", ""),
			array("Segundo Apellido: ", "text", "segundo", ""),
			array("Dirección: ", "text", "direccion", ""),
			array("Población: ", "text", "poblacion", ""),
			array("Ciudad: ", "text", "ciudad", ""),			
			array("Email: ", "email", "email", ""),
			array("Marca: ", "text", "marca", ""),
			array("Modelo: ", "text", "modelo", ""),
			array("¿Que necesitas? ", "textarea", "descripcion", ""),
			array("","submit", "cita", "Pedir cita")
		);		
			//si esta seteado cita
			if(isset($_POST["cita"])){
				//si todos los campos son correctos, llama a la funcion citar del modelo y carga la vista citaCorrecta
				if( 	es_texto($_POST["nombre"]) && es_texto($_POST["primero"]) && es_texto($_POST["segundo"])
						&& es_texto($_POST["direccion"]) && es_texto($_POST["poblacion"]) && es_texto($_POST["ciudad"])
						&& es_email($_POST["email"]) && es_texto($_POST["marca"]) && es_texto($_POST["modelo"]) 
						&& es_texto($_POST["descripcion"]))
						{
						//Creamos un objeto de gestionTienda
						$o = new gestionTienda();
						//Ejecutamos el método conexion pasandole $servidor, $usuario, $contrasenia, $baseDatos
						$mysqli = $o->conexion("localhost", "admProyecto", "Proyecto2022", "la_mejor_pedalada");
						//Ejecutamos el método citar pasandole la conexión y todos los campos recogidos en el formulario
						$resultado = $o->citar($mysqli,$_POST["nombre"], $_POST["primero"], $_POST["segundo"], $_POST["direccion"],
										$_POST["poblacion"], $_POST["ciudad"], $_POST["email"], $_POST["marca"], $_POST["modelo"],
										$_POST["descripcion"]);
						require 'templates/citaCorrecta.php';
						//Cerramos la conexion
						$mysqli->close();
				}
				//sino, algun campo estará mal y carga la vista citaIncorrecta
				else require 'templates/citaIncorrecta.php';	
			}
			else require 'templates/cita.php';
			
	}
	/**
	*Función para el controlador especifico de noticias.	
	*Carga la vista noticias.php en template de base.php	
	*/
	function controlador_noticias(){		
		
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
		}	
			
		require 'templates/noticias.php';		
	}
	/**
	*Función para el controlador especifico de contacto.	
	*Carga la vista contacto.php en template de base.php	
	*/
	function controlador_contacto(){				
		
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
		}	
			
		require 'templates/contacto.php';	
		
	}
	/**
	*Función para el controlador especifico de identificacion.	
	*Carga la vista identificacion.php en template de base.php	
	*/
	function controlador_identificacion(){
		
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//si está seteado el boton Acceder método POST
		if(isset($_POST["btn"])){		
			
			//Creamos un objeto de gestionTienda
			$o = new gestionTienda();
			//Ejecutamos el método conexion pasandole $servidor, $usuario, $contrasenia, $baseDatos
			$mysqli = $o->conexion("localhost", "admProyecto", "Proyecto2022", "la_mejor_pedalada");
			//Ejecutamos el método buscarUsuario pasandole la conexión y el usuario y la contraseña recibidos por POST del formulario
			$resultado = $o->buscarUsuario($mysqli, $_POST["usuario"], $_POST["contrasenia"]);
				
			//Si el valor guardado en la variable $resultado es distinto de null
			if($resultado != null){
				//mediante un blucle foreach recorremos $resultado y guardamos en $pass la contraseña enriptada
				foreach($resultado as $key=>$value){
					$pass = crypt ($value["contrasenia"], '$1$somethin$');					
				}
				//si el usuario está seteado, guardar su valor en la variable usuraio, sino usuario vacio	
				if(isset($_POST["usuario"])) $usuario = $_POST["usuario"];
				else $usuario = "";
				//si la contraseña está seteada, guardar su valor en la variable contrasenia, sino contrasenia vacia
				if(isset($_POST["contrasenia"])) $contrasenia = $_POST["contrasenia"];
				else $contrasenia = "";
					
				//Si usuario y contraseña NO están vacios 
				if($usuario != "" && $contrasenia != ""){
					/*si $usuario es true y el valor de encriptar la variable $contrasenia es igual al valor de la 
					variable $pass, se guarda en una variable de sesion el usuario y se reedirige a inicio.php*/							
					if($usuario && crypt($contrasenia, '$1$somethin$') == $pass){
						$_SESSION["usuario"] = $usuario;							
						header("Location: http://localhost/Proyecto/index.php/inicio");
						exit;
					}
					else{
						echo "<h2 style=\"color: red\";>Usuario y contraseña erroneos</h2>";
					}					
				}
			}
			else{
				echo "<h2 style=\"color: red\";>Usuario no registrado, registrese</h2>";
			}
			//Cerramos la conexion
			$mysqli->close();
		}		
		require 'templates/identificacion.php';
		
	}
	/**
	*Función para el controlador especifico de registro.	
	*Carga la vista registro.php en template de base.php	
	*/
	function controlador_registro(){
		
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//si está seteado el boton Registrar pr el método POST
		if(isset($_POST["btn"])){
				
		//Creamos un objeto de gestionTienda
		$o = new gestionTienda();
		//Ejecutamos el método conexion pasandole $servidor, $usuario, $contrasenia, $baseDatos
		$mysqli = $o->conexion("localhost", "admProyecto", "Proyecto2022", "la_mejor_pedalada");
		//Ejecutamos el método insertarUsuario pasandole la conexión y el usuario y la contraseña recibidos por POST del formulario
		$resultado = $o->insertarUsuario($mysqli, $_POST["usuario"], $_POST["contrasenia"]);
			//Si se inserta el usuario correctamente muestra  Usuario registrado con exito
			if($resultado){
				echo "<h2 style=\"color: green\";>Usuario registrado con exito, diríjase a Acceso a Clientes para comenzar</h2>";
			}
			else{//sino muestra Error al registrarse
				echo "<h2 style=\"color: red\";>Error al registrarse, intentelo de nuevo</h2>";
			}
		//Cerramos la conexion
		$mysqli->close();	
		}
		require 'templates/registro.php';
		
	}
	/**
	*Función para el controlador especifico de carrito.	
	*@param $id_bici, $id_equipamiento
	*Carga la vista registro.php en template de base.php	
	*/
	function controlador_carrito($id_bici, $id_equipamiento){
			
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
			$id_sesion = session_id();
		}		
			
		//Creamos un objeto de gestionTienda
		$o = new gestionTienda();
		//Ejecutamos el método conexion pasandole $servidor, $usuario, $contrasenia, $baseDatos
		$mysqli = $o->conexion("localhost", "admProyecto", "Proyecto2022", "la_mejor_pedalada");		
			//si está seteado add_bici y no esta seteado add_equipamiento
			if(isset($_GET["add_bici"]) && !isset($_GET["add_equipamiento"])){
				//Ejecutamos el método aniadirCarrito pasandole la conexión, el id de sesion, el id_bici del parametro y el id_equipamiento vacio	
				$resultadoI = $o->aniadirCarrito($mysqli, $id_sesion, $id_bici, -1);
				//También ejecutamos el método productoEnCarrito pasandole la conexión, el id de sesion, el id_bici del parametro y el id_equipamiento vacio
				$resultadoQuery = $o->productoEnCarrito($mysqli, $id_sesion, $id_bici, -1);
			}
			//sino si add_bici no está seteado y add_equipamiento si que está seteado
			else if(!isset($_GET["add_bici"]) && isset($_GET["add_equipamiento"])){
				//Ejecutamos el método aniadirCarrito pasandole la conexión, el id de sesion, el id_bici vacio y el id_equipamiento del parametro	
				$resultadoI = $o->aniadirCarrito($mysqli, $id_sesion, -1, $id_equipamiento);
				//También ejecutamos el método productoEnCarrito pasandole la conexión, el id de sesion, el id_bici vacio y el id_equipamiento del parametro
				$resultadoQuery = $o->productoEnCarrito($mysqli, $id_sesion, -1, $id_equipamiento);
			}
		require 'templates/carrito.php';
		//Cerramos la conexion
		$mysqli->close();	
		
	}
	/**
	*Función para el controlador especifico de carritoVer.		
	*Carga la vista carritoVer.php en template de base.php	
	*/
	function controlador_carritoVer(){
			
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
			$id_sesion = session_id();
		}		
			
		//Creamos un objeto de gestionTienda
		$o = new gestionTienda();
		//Ejecutamos el método conexion pasandole $servidor, $usuario, $contrasenia, $baseDatos
		$mysqli = $o->conexion("localhost", "admProyecto", "Proyecto2022", "la_mejor_pedalada");
		//Ejecutamos el método productoEnCarritoPrincipal pasandole la conexión y el id de sesion
		$resultadoQuery = $o->productoEnCarritoPrincipal($mysqli, $id_sesion);
		require 'templates/carritoVer.php';
		//Cerramos la conexion
		$mysqli->close();			
				
	}
	/**
	*Función para el controlador especifico de carritoBorrar.		
	*Carga la vista borrado.php en template de base.php	
	*/
	function controlador_carritoBorrar($id_bici, $id_equipamiento){
			
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
			$id_sesion = session_id();
		}		
			
		//Creamos un objeto de gestionTienda
		$o = new gestionTienda();
		//Ejecutamos el método conexion pasandole $servidor, $usuario, $contrasenia, $baseDatos
		$mysqli = $o->conexion("localhost", "admProyecto", "Proyecto2022", "la_mejor_pedalada");
			//si está seteado delete_bici y no esta seteado delete_equipamiento
			if(isset($_GET["delete_bici"]) && !isset($_GET["delete_equipamiento"])){
				//Ejecutamos el método quitarDelCarrito pasandole la conexión, el id de sesion, el id_bici del parametro y el id_equipamiento vacio	
				$resultado = $o->quitarDelCarrito($mysqli, $id_sesion, $id_bici, -1);
			}
			//sino si delete_bici no está seteado y delete_equipamiento si que está seteado
			else if(!isset($_GET["delete_bici"]) && isset($_GET["delete_equipamiento"])){
				//Ejecutamos el método quitarDelCarrito pasandole la conexión, el id de sesion, el id_bici vacio y el id_equipamiento del parametro	
				$resultado = $o->quitarDelCarrito($mysqli, $id_sesion, -1, $id_equipamiento);
			}
		require 'templates/borrado.php';
		//Cerramos la conexion
		$mysqli->close();	
		
	}
	/**
	*Función para el controlador especifico de compra.		
	*Carga la vista compra.php en template de base.php	
	*/
	function controlador_compra(){
		
		session_start();//iniciar sesión simpre es la primera sentencia del documento
		//Si la variable de sesion usuario está seteada, significa que existe la sesion
		//Guardo su valor en la variable $usuario y muestro un mensaje de bienvenida.
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
		}	
			
		require 'templates/compra.php';	
		
	}
	
	ob_end_flush();
?>