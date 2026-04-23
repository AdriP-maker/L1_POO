<?php
session_start(); // Inicia la sesión para poder almacenar y recuperar datos entre páginas

include("ClasePedidoEscolar.php"); // Incluye la clase donde se realiza la lógica del cálculo

try {
    // Verifica si todos los productos están en 0 (ninguno seleccionado)
    if($_POST['lib1']==0&&$_POST['lib5']==0&&$_POST['boliAzul']==0&&$_POST['boliNeon']==0&&$_POST['regla']==0&&$_POST['borrador']==0&&$_POST['sacPuntas']==0){
        throw new Exception("Debe seleccionar al menos un producto"); // Lanza una excepción si no se selecciona nada
    } else {
        // Guarda los datos recibidos del formulario en un arreglo asociativo
        $datos = [
            'libreta1'     => $_POST['lib1'],
            'libreta5'     => $_POST['lib5'],
            'boligrafoAzul'=> $_POST['boliAzul'],
            'boligrafoNeon'=> $_POST['boliNeon'],
            'regla'        => $_POST['regla'],
            'borrador'     => $_POST['borrador'],
            'sacapuntas'   => $_POST['sacPuntas']
        ];

        // Crea una instancia de la clase calculo y le pasa los datos del formulario
        $calcular = new calculo($datos);

        // Llama a los métodos para procesar la información
        $calcular->contadorDeProductosSeleccionados(); // Cuenta los productos seleccionados
        $calcular->calcularSubTotal(); // Calcula el subtotal de la compra
        $calcular->totalConItbms(); // Calcula el total con impuesto (ITBMS)

        // Guarda los resultados en variables de sesión para usarlos en otra página
        $_SESSION['articulos']    = $calcular->obtenerArtcSelect(); // Lista de artículos seleccionados
        $_SESSION['subtotal']     = $calcular->obtenerSubtotal(); // Subtotal de la compra
        $_SESSION['totalCompra']  = $calcular->obtenerTotalCompra(); // Total final con impuestos
    }
} catch(Exception $e){
    // Si ocurre un error, guarda el mensaje en la sesión
    $_SESSION['error'] = $e->getMessage();
}

// Redirige a la página donde se mostrarán los resultados
header("Location: ../../L1_P2_2.php");
exit(); // Finaliza la ejecución del script
?>
