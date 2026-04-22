<?php
// se incluye la clase
require_once("ClasePedidoEscolar.php");

try {

    // se crea el objeto de la clase
    $pedido = new ClasePedidoEscolar();

    // se validan y agregan los productos seleccionados
    if (!empty($_POST["libreta1"]))
        $pedido->agregarProducto("Libreta 1 materia", 2.60, $_POST["libreta1"]);

    if (!empty($_POST["libreta5"]))
        $pedido->agregarProducto("Libreta 5 materias", 5.60, $_POST["libreta5"]);

    if (!empty($_POST["boligrafoAzul"]))
        $pedido->agregarProducto("Bolígrafo azul", 2.25, $_POST["boligrafoAzul"]);

    if (!empty($_POST["neon"]))
        $pedido->agregarProducto("Bolígrafo Neon", 5.00, $_POST["neon"]);

    if (!empty($_POST["regla"]))
        $pedido->agregarProducto("Regla", 0.90, $_POST["regla"]);

    if (!empty($_POST["borrador"]))
        $pedido->agregarProducto("Borrador", 0.30, $_POST["borrador"]);

    if (!empty($_POST["sacapuntas"]))
        $pedido->agregarProducto("Sacapuntas", 0.45, $_POST["sacapuntas"]);

    // se obtienen los productos
    $productos = $pedido->getProductos();

    // validación: si no hay productos seleccionados
if (count($productos) == 0) {
    throw new Exception("Debe seleccionar al menos un producto.");
}
} catch (Exception $e) {
    echo "<script>
        alert('" . $e->getMessage() . "');
        window.location.href='index.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body class="container mt-5">

<h2> Resultado de la compra</h2>

<?php include("../html/migas.html"); ?> 

<div class="card p-4 shadow">

<!-- inicia la tabla de la compra de los utiles -->
    <?php include("../html/tablacompra.html"); ?> 
    <!-- termina la talba de la compra de los utiles -->


<!--subtotal y total con el formato de 2 decimales -->
<h4>Subtotal: $<?= number_format($pedido->calcularSubtotal(), 2); ?></h4>
<h4>Total con ITBMS (7%): $<?= number_format($pedido->calcularTotal(), 2); ?></h4>


<!--boton para volver al formulario principal-->
<a href="index.php" class="btn btn-secondary mt-3"> Volver a la tienda</a>

</div>

  <!-- inicia footer -->
    <?php include("../html/footer.html"); ?> 
    <!-- termina footer -->

</body>
</html>