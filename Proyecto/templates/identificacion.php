<?php
	//identificacion.php
	
	/*Comprobacion de la constante EN_CONTROLADOR, si no está definida, finaliza la ejecucion y manda el mensaje.
	Si está definida es porque se accede mediante el controlador y se desarrolla todo el código.*/	
	if(!defined("EN_CONTROLADOR"))die("No se puede llamar directamente");
	else {	
		//Se incluye el fichero base.php
		include 'base.php';
		startblock('template');	//Comienza el desarrollo del bloque template que se encuentra en base.php				
		?>
			<script src="../validarUsuario.js"></script>
			<style>
				@import url(../estiloIdentificacion.css)				
			</style>
			<h2>Acceso a Clientes</h2>
			<form action="" method="post" onsubmit="return validar();">
				<div id="divUsuario">
					<label for="usuario">Usuario</label>
					<input type="text" placeholder="usuario"  name="usuario" id="usuario"/>
					<label class="error"></<label>
				</div>		
				<div id="divContrasenia">
					<label for="contrasena">Contraseña</label>
					<input type="password" placeholder="contraseña" name="contrasenia" id="contrasenia"/>
					<label class="error"></<label>
				</div>		
				<div>
					<input type="submit" name="btn" value="Acceder" id="btn"/>
				</div>
			</form>	
			<br>
			<br>
			<a href="http://localhost/Proyecto/index.php/registro">Registro de nuevo Cliente</a>
			<br>
			<br>			
		<?php			
		endblock();//Finaliza el bloque template
	}
?>