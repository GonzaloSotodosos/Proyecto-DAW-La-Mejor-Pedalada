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
		if(!isset($resultadoQuery)){				
			echo "<h3>Todavía no hay productos en el carrito</h3>";	
		}
		else{	
		?>			
			<table>
				<thead>
					<tr>
						<th><h2>Productos en Carrito</h2></th>							
					</tr>
				</thead>
		<?php
			$total = 0;
			$totalBicis = 0;
			$totalEquipamiento = 0;
			//Guardamos en la variable $resultadoBicis el array que contiene las bicis del carrito
			if(isset($resultadoQuery[0][0]["marca"]) && !isset($resultadoQuery[1][0]["titulo"])){				
				$resultadoBicis = $resultadoQuery[0];
				//Mediante un bucle foreach recorremos los resultados del array obtenido
				foreach($resultadoBicis as $key=>$value){					
				?>		
				<tbody>
						<tr>
							<td><?php echo $value["marca"]?></td>
							<td><?php echo $value["modelo"]?></td>
							<td><img src="<?php echo "../img/".$value["imagen"]?>"/></td>
							<td><?php echo $value["precio"]?> €</td>
						</tr>
				<?php
				$total += $value["precio"];
				}						
			}
			else if(isset($resultadoQuery[0][0]["titulo"])){				
				$resultadoEquipamiento = $resultadoQuery[0];
				foreach($resultadoEquipamiento as $key=>$value){	
				?>
						<tr>
							<td><?php echo $value["titulo"]?></td>
							<td><img src="<?php echo "../img/".$value["imagen"]?>"/></td>
							<td><?php echo $value["precio"]?> €</td>								
						</tr>
				<?php
				$total += $value["precio"];
				}					
			}
			else if(isset($resultadoQuery[0][0]["marca"]) && isset($resultadoQuery[1][0]["titulo"])){				
				$resultadoBicis = $resultadoQuery[0];
				foreach($resultadoBicis as $key=>$value){					
				?>							
						<tr>
							<td><?php echo $value["marca"]?></td>
							<td><?php echo $value["modelo"]?></td>
							<td><img src="<?php echo "../img/".$value["imagen"]?>"/></td>
							<td><?php echo $value["precio"]?> €</td>								
						</tr>
				<?php
				$totalBicis += $value["precio"];
				}				
				$resultadoEquipamiento = $resultadoQuery[1];
				foreach($resultadoEquipamiento as $key=>$value){	
				?>
						<tr>
								<td><?php echo $value["titulo"]?></td>
								<td></td>
								<td><img src="<?php echo "../img/".$value["imagen"]?>"/></td>									
								<td><?php echo $value["precio"]?> €</td>								
						</tr>
				<?php
				$totalEquipamiento += $value["precio"];
				}
				$total = $totalBicis + $totalEquipamiento;					;
			}
			?>			
				</tbody>				
			</table>					
			<?php
			echo "<h2>Total a pagar: $total € &emsp; <a class=\"anav\" href=\"http://localhost/Proyecto/index.php/compra\">Comprar</a></h2>";
			echo "";
		}
		endblock();//Finaliza el bloque template
	}
?>