<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafetería UTP - L1_P1</title>
    <!-- Bootstrap 3.4.1 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="L1_P1/css/estilos.css">
    <link rel="stylesheet" href="L1_P1/css/Factura.css">
</head>
<body>
       
    <div class="container contenedor">
         <?php include("L1_P1/html/nav.html"); ?>
        <?php include("L1_P1/html/header.html"); ?>

        <main>
            <?php include("L1_P1/html/menu.html"); ?>
            <?php include("L1_P1/html/form.html"); ?>
        </main>

        <!-- Factura aparece aquí si se envió el formulario -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'L1_P1/php/TotalPedido.php';
            $pedido = new TotalPedido($_POST);
            include 'L1_P1/php/Factura.php';
        }
        ?>

        <?php include("L1_P1/html/footer.html"); ?>

    </div>

    <!-- jQuery (obligatorio para Bootstrap 3) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap 3.4.1 JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>