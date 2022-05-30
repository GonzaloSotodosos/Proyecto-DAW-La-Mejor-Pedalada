<?php
	//productos.php
	
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
				table {
					border: 1px solid black;
					text-align: center;
				}
				thead{
					border: 1px solid black;					
					background: #20B2AA;
				}
				tr {
					border: 1px solid black;
				}
				td {
					border: 1px solid black;
					padding: 10px;
				}
			</style>			
			<table>
				<thead>
					<tr>
						<th>Bicicletas</th>							
					</tr>
				</thead>
			<?php
			//Mediante un bucle foreach recorremos los resultados del array obtenido
			foreach($resultado as $key=>$value){			
			?>		
				<tbody>
					<tr>
						<td><?php echo $value["modelo"]?></td>
						<td><img src="<?php echo "../img/".$value["imagen"]?>"/></td>
						<td><a href="http://localhost/Proyecto/index.php/detalleBici?id_bici=<?php echo $value["id_bici"]?>">Mas info</a></td>
						<?php
						if(isset($_SESSION["usuario"])){
						?>
						<td><form action="carrito" method="get">
								<input type="hidden" name="add_bici" value="<?php echo $value["id_bici"] ?>">
								<button>Agregar al carrito</button>
							</form>
						</td>
						<td><form action="carritoBorrar" method="get">
								<input type="hidden" name="delete_bici" value="<?php echo $value["id_bici"] ?>">
								<button>Quitar del carrito</button>
							</form>
						</td>
						<?php 
						} 
						?>
					</tr>
				</tbody>					
				<?php				
			}
			?>
				<thead>
					<tr>
						<th>Equipamiento</th>							
					</tr>
				</thead>
			<?php
			foreach($resultado2 as $key=>$value){				
			?>
				<tbody>
					<tr>
						<td><?php echo $value["titulo"]?></td>
						<td><img src="<?php echo "../img/".$value["imagen"]?>"/></td>	
						<td><a href="http://localhost/Proyecto/index.php/detalleEquipamiento?id_equipamiento=<?php echo $value["id_equipamiento"]?>">Mas info</a></td>
						<?php
						if(isset($_SESSION["usuario"])){
						?>
						<td><form action="carrito" method="get">
									<input type="hidden" name="add_equipamiento" value="<?php echo $value["id_equipamiento"] ?>">
									<button>Agregar al carrito</button>
							</form>
						</td>
						<td><form action="carritoBorrar" method="get">
									<input type="hidden" name="delete_equipamiento" value="<?php echo $value["id_equipamiento"] ?>">
									<button>Quitar del carrito</button>
							</form>
						</td>
						<?php 
						}
						?>
					</tr>
				</tbody>	
			<?php		
			}
			?>
			</table>
			<?php
		endblock();//Finaliza el bloque template
	}
?>