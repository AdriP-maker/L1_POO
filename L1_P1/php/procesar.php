<?php
require_once 'TotalPedido.php';
 
// Recibe los datos del POST y los pasa a la clase
try {
    $pedido = new TotalPedido($_POST);
} catch (Exception $e) {
    echo "Error al procesar el pedido: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Cafetería UTP — <?= $pedido->num_factura ?></title>
    <link rel="stylesheet" href="factura.css">
</head>
<body>
 
<div class="ticket-wrap">
 
    <!-- Botón imprimir -->
    <button class="btn-print" onclick="window.print()">🖨️ Imprimir / Guardar PDF</button>
 
    <?php include 'factura.php'; ?>
 
    <a class="btn-volver" href="L1_P1.php">← Volver al menú</a>
 
</div>
 
</body>
</html>
 


