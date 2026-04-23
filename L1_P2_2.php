	<?php
		session_start();
		$articulos   = $_SESSION['articulos']   ?? null;
		$subtotal    = $_SESSION['subtotal']    ?? null;
		$totalCompra = $_SESSION['totalCompra'] ?? null;
		$error       = $_SESSION['error']       ?? null;

// Limpiar sesión tras leer los datos
unset($_SESSION['articulos'], $_SESSION['subtotal'], $_SESSION['totalCompra'], $_SESSION['error']);
?>
	<!DOCTYPE html>
	<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>L1_P2_2</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="./L1_P2_2/css/estilos.css">
			</head>
			<body>
				<!-- INICIA HEADER-->
				<div class="page-header">
					<img src="./L1_P2_2/img/logo-utp.png" class="img-logo-header">
				</div>
				<!-- INICIA HEADER-->
				<!-- INICIA NAV-->
				<?php include("L1_P2_2/html/navEscolarP2_2.html"); ?>
				<!-- TERMINA NAV-->
				
				<!-- INICIA MAIN-->
				<main>
					<!-- INICIO: Contenedor principal -->
					<div class="container">

						<!-- INICIO: Fila -->
						<div class="row">

							<!-- INICIO: Columna 1 -->
							<?php include("L1_P2_2/html/menu_p2_2.html"); ?>
							<!-- FIN: Columna 1 -->

							<!-- INICIO: Columna 2 -->
												<?php include("L1_P2_2/html/formp2_2.html"); ?>
							<!-- FIN: Columna 2 -->
						</div>
						<!-- FIN: Fila -->

					</div>
					<!-- FIN: Contenedor principal -->


					<div class="container-fluid"> <!-- INICIA CONTENEDOR-->
						
					</div> <!-- TERMINA CONTENEDOR-->
				</main>
				<!-- TERMINA MAIN-->

				<!-- INICIA FOOTER-->
				<?php include("L1_P2_2/html/footerP2_2.html"); ?>
				<!-- TERMINA FOOTER-->
				
				<!-- jQuery -->
				<script src="./code.jquery.com/jquery.js"></script>
				<!-- Bootstrap JavaScript -->
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
				<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
				<script src="Hello World"></script>
			</body>
			
			</html>