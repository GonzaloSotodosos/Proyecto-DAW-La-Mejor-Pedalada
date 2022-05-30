<?php require_once 'ti.php' ?>
<!-- base.php  -->
<html>
    <head>        
		<style>
			header {				
				height: 150px;
				text-align: center;
				font-size: 50px;			
			}
			h1 {
				margin-top: 20px;
				font-family: Brush Script MT;
				font-style: italic;
			}
			#logo {
				float: left;
				margin-left: 20px;				
			}
			#botones {
				float: right;
				margin-top: 20px;
				margin-right: 40px;
				font-size: 28px;
				font-family: Arial;
				color: green;
			}
			nav {
				height: 30px;				
				margin-top: 20px;
			}
			.anav{					
				display: inline;
				border: solid 1px gray;
				background-color: #2175bc;
				text-align: center;
				margin-right: 3px;				
				padding-top: 10px;
				padding-bottom: 10px;
				padding-right: 15px;
				padding-left:15px;
				color: #FFFFFF;
				text-decoration: none;
			}
			article{
				margin-top: 20px;
				
			}
			footer{
				text-align:center;
				line-height: 5px;

				font-family: cursive;
			}			
		</style>
    </head>
    <body>
		<header>							
			<img id="logo" src="../img/bielas.png" alt="logo web"/>
			<h1>La mejor pedalada
				<div id="botones">
					<a><?php startblock('template1'); ?><!-- En este bloque se cargará el contenido --> <?php endblock()?></a>
					<a href="https://www.facebook.com/"><img src="../img/face.png" alt="facebook"></a>
					<a href="https://twitter.com/?lang=es"><img src="../img/twit.png" alt="twiter"></a>
					<a href="https://www.instagram.com/?hl=es"><img src="../img/insta.png" alt="instagram"></a>
				</div>
			<h1>			
		</header>
		<hr>	
		<nav>
			<a class="anav" href="http://localhost/Proyecto/index.php/inicio">Inicio</a>
			<a class="anav" href="http://localhost/Proyecto/index.php/productos">Productos</a>
			<a class="anav" href="http://localhost/Proyecto/index.php/cita">Cita Taller</a>
			<a class="anav" href="http://localhost/Proyecto/index.php/noticias">Noticias</a>
			<a class="anav" href="http://localhost/Proyecto/index.php/contacto">Contacto</a>
		</nav>				
		<section>
			<article>
				<!-- En este bloque se cargará el contenido -->
				<?php startblock('template'); ?> <?php endblock()?>
			</article>
        </section>		
        <footer>
			<br>
			<hr/>
            <p>La mejor pedalada, S.L.</p>
			<p>C/ Estonia, 4</p>
			<p>Meco - Madrid</p>
			<p><b>Telefono</b> 666 777 8888</p>
			<p><b>Email</b> lamejorpedalada@outlook.com</p>
			<div class="redes">
				<a href="https://www.facebook.com/"><img src="../img/facebook.png" alt="facebook"></a>			
				<a href="https://twitter.com/?lang=es"><img src="../img/twiter.png" alt="twiter"></a>
				<a href="https://www.instagram.com/?hl=es"><img src="../img/instagram.png" alt="instagram"></a>
			</div>
        </footer>
    </body>
</html>
