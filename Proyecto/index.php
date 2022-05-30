<?php
	//Se define la constante EN_CONTROLADOR	
	const EN_CONTROLADOR = true;

	/*Controlador index.php
	*Se requiere de controladores.php y modelo.php
	*/
	require_once 'controladores.php';
	require_once 'modelo.php';

	//Obtenemos de la url el ultimo segmento introducido desde la ultima / y lo guardamos en $URI
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$segments = explode('/', $path);
	$URI = $segments[count($segments)-1];


	//Evaluación del parámetro guardado en $URI para el diferente funcionamiento de nuestra página
	
	//Si $URI es igual a inicio
	if($URI == "inicio"){
		//cargamos el controlador_inicio
		controlador_inicio();
	}
	//sino si $URI es igual a productos
	else if($URI == "productos"){
		//cargamos el controlador_productos
		controlador_productos();
	}		
	//Sino si $URI es igual a detalleBici y el id_bici está seteado por get
	else if($URI == "detalleBici" && isset($_GET["id_bici"])){
		//cargamos el controlador_infoBicis pasandole el id obtenido por get
		controlador_infoBicis($_GET["id_bici"]);
	}
	//Sino si $URI es igual a detalleEquipamiento y el id_equipamiento está seteado por get
	else if($URI == "detalleEquipamiento" && isset($_GET["id_equipamiento"])){
		//cargamos el controlador_infoEqui pasandole el id obtenido por el get
		controlador_infoEqui($_GET["id_equipamiento"]);
	}	
	//sino si $URI es igual a cita
	else if($URI == "cita"){
		//cargamos el controlador_cita
		controlador_cita();
	}	
	//sino si $URI es igual a noticias
	else if($URI == "noticias"){
		//cargamos el controlador_noticias
		controlador_noticias();
	}
	//sino si $URI es igual a contacto
	else if($URI == "contacto"){
		//cargamos el controlador_contacto
		controlador_contacto();
	}
	//sino si $URI es igual a identificacion
	else if($URI == "identificacion"){
		//cargamos el controlador_identificacion
		controlador_identificacion();
	}		
	//sino si $URI es igual a registro
	else if($URI == "registro"){
		//cargamos el controlador_registro
		controlador_registro();
	}	
	//Sino si $URI es igual a carrito y está seteado por get id_bici o id_equipamiento
	else if($URI == "carrito" && (isset($_GET["add_bici"]) || isset($_GET["add_equipamiento"]))){		
		/*si esta seteado add_bici cargamos el controlador_carrito pasando el id_bici con el valor de add_bici 
		y el id_equipamiento con valor -1*/
		if(isset($_GET["add_bici"])){
			controlador_carrito($_GET["add_bici"], -1);
		}
		else{/*sino, está seteado add_equipamiento cargamos el controlador_carrito pasando el id_bici con valor -1 
		y el id_equipamiento con el valor de add_equipamiento*/
			controlador_carrito(-1, $_GET["add_equipamiento"]);
		}		
	}	
	//Sino si $URI es igual a carritoVer 
	else if($URI == "carritoVer"){
		//cargamos el controlador_carritoVer 
		controlador_carritoVer();
	}
	//Sino si $URI es igual a carritoBorrar y está seteado por get delete_bici o delete_equipamiento
	else if($URI == "carritoBorrar" && (isset($_GET["delete_bici"]) || isset($_GET["delete_equipamiento"]))){		
		/*si esta seteado delete_bici cargamos el controlador_carritoBorrar pasando el id_bici con el valor de delete_bici 
		y el id_equipamiento con valor -1*/
		if(isset($_GET["delete_bici"])){
			controlador_carritoBorrar($_GET["delete_bici"], -1);
		}/*sino, está seteado delete_equipamiento cargamos el controlador_carritoBorrar pasando el id_bici con valor -1 
		y el id_equipamiento con el valor de delete_equipamiento*/
		else{
			controlador_carritoBorrar(-1, $_GET["delete_equipamiento"]);
		}			
	}
	//sino si $URI es igual a compra
	else if($URI == "compra"){
		//cargamos el controlador_compra
		controlador_compra();
	}	
	else{//sino es ninguna de las anteriores, mandamos el aviso
		//header("Status: 404 Not Found");
		echo '<html><body><h1>La página a la que intenta acceder no existe</h1></body></html>';
	}



?>