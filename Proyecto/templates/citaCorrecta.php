<?php
	//citaCorrecta.php
	
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
		startblock('template');	//Comienza el desarrollo del bloque template que se encuentra en base.php	
		?>
			<style>
			h2, p{
				font-family: cursive;
			}
			</style>
			<img src="../img/taller.png" alt="logo taller"/>
			<h2>Cita Correcta</h2>
			<p>En breve contactaremos con usted, para asignarle una cita para nuestro taller.</p>
			<p>Gracias, por su confianza.</p>
		<?php	
		endblock();//Finaliza el bloque template
	}
?>