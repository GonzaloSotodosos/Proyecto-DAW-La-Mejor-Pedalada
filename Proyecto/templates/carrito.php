<?php
	//carrito.php
	
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
		endblock();//Finaliza el bloque template1
		startblock('template');	//Comienza el desarrollo del bloque template que se encuentra en base.php		
		?>			
			<table>
				<thead>
					<tr>
						<th><h3>Producto Seleccionado</h3></th>							
					</tr>
				</thead>
			<?php
			//Mediante un bucle foreach recorremos los resultados del array obtenido			
			foreach($resultadoQuery as $key=>$value){			
				if(isset($resultadoQuery[0]["marca"])){			
			?>		
					<tbody>
						<tr>
							<td><?php echo $value["marca"]?></td>
							<td><?php echo $value["modelo"]?></td>
							<td><img src="<?php echo "../img/".$value["imagen"]?>"/></td>
							<td><?php echo $value["precio"]?> €</td>
						</tr>
			<?php
				}
				else{
			?>
						<tr>
							<td><?php echo $value["titulo"]?></td>
							<td><img src="<?php echo "../img/".$value["imagen"]?>"/></td>
							<td><?php echo $value["precio"]?> €</td>
							</tr>
				<?php
				}
			}
			?>			
					</tbody>
			</table>
			<p><a href="http://localhost/Proyecto/index.php/productos">Volver</a></p>
		<?php
		endblock();//Finaliza el bloque template
	}
?>