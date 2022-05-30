<?php
	//inicio.php
	
	/*Comprobacion de la constante EN_CONTROLADOR, si no está definida, finaliza la ejecucion y manda el mensaje.
	Si está definida es porque se accede mediante el controlador y se desarrolla todo el código.*/
	if(!defined("EN_CONTROLADOR"))die("No se puede llamar directamente");
	else {	
		//Se incluye el fichero base.php
		include 'base.php';
		//Comienza el desarrollo del bloque template1 que se encuentra en base.php
		startblock('template1');				
			if(isset($_SESSION["usuario"])){
				?>
				<form action="?" method="POST">
					<label>Bienvenido, <?php echo $usuario?></label>
					<br>
					<br>
					<input style="margin-right: 20px;" class="button" type="submit" name="cerrar" value="Cerrar Sesion"/>
					<input style="margin-right: 20px;" class="button" type="submit" name="verCarrito" value="Mi Carrito"/>
					<img src="../img/carrito.png" alt="carrito">
				</form>
				<?php
				//si está seteado el boton cierra sesion
				if(isset($_POST["cerrar"])){
					session_unset();//liberar las variables de sesion
					$_SESSION = array();//borrar las variables de sesion										
					session_destroy();//destruir la sesion
					header( "Location: http://localhost/Proyecto/index.php/inicio" );//redirige a inicio
				}	
			}
			else{
				echo "<a href=\"http://localhost/Proyecto/index.php/identificacion\"><img src=\"../img/usuario.png\" alt=\"usuario\"/></a>";
			}	
			if(isset($_POST["verCarrito"])){
					header("Location: http://localhost/Proyecto/index.php/carritoVer");
			}
		endblock();//Finaliza el bloque template1		
		startblock('template');//Comienza el desarrollo del bloque template que se encuentra en base.php
		?>
			<div style="width: 50%; height: 450px; float: left;">
				<img src="../img/principal.png" alt="grupo de ciclistas">
			</div>
			<div style="width: 50%; height: 450px; float: right;">
				<label style="font-family: cursive; font-size: 22px;  line-height: 120%;" >
					<p>Bienvenidos a La Mejor Pedalada, aquí podréis encontrar todo lo necesario para la practica de vuestra pasión: "La bicicleta".</p>
					
					<p>De nuestra pasión por la bicicleta y las ganas de compartirla con otros amantes de las dos ruedas, nace La Mejor Pedalada.</p>

					<p>Somos una tienda/taller de bicicletas, distribuidores oficiales de varias marcas y servicio técnico de las marcas de componentes más importantes.</p>

					<p>Trabajamos con las mejores marcas de repuestos, accesorios, componentes y ropa como Shimano, SRAM, Campagnolo, Rotor, Luck, SMP, Gobik y Santini entre otras. </p>
					
					<p>También hacemos ropa de ciclismo personalizada.</p>					
				</label>
			</div>			
		<?php endblock();//Finaliza el bloque template
	}
?>