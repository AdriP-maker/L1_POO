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
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
			<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
				<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
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
							<div class="col-md-6">
								<div> <!-- INICIA OUTPUT -->
									<div class="panel panel-default">
										<div class="panel-body" id="panel-output">
											<legend><H1>Total</H1></legend>
											<div class="table-responsive"> <!-- INICIA TABLA -->
												<table class="table table-hover">
													<thead>
														<tr>
															<th>Articulo</th>
															<th>Cantidad</th>
															<th>Precio unitario</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
														<?php
														try {
															if (isset($articulos)) {
																foreach ($articulos as $fila) {
																	echo "<tr>";
																	echo "<td>" . $fila[0] . "</td>";
																	echo "<td>" . $fila[1] . "</td>";
																	echo "<td>" . number_format($fila[2], 2) . "</td>";
																	echo "<td>" . number_format($fila[3], 2) . "</td>";
																	echo "</tr>";
																}
																echo "<tr>";
																echo "<td><h4><strong>Sub total:</strong></h4>".number_format($subtotal, 2). "</td>";
																echo "<td><h4><strong>Total de compra:</strong></h4>".number_format($totalCompra, 2). "</td>";
																echo "</tr>";
															}
														} catch(Exception $e){ // Termina try catch
															echo $e->getMessage();
														}
														?>
													</tbody>
												</table>
											</div>  <!-- INICIA TABLA -->
										</div>
									</div>
								</div> <!-- TERMINA OUTPUT -->
							</div>
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