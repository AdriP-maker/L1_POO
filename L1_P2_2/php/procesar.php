<?php
include("ClasePedidoEscolar.php");
try {
    if($_POST['lib1']==0&&$_POST['lib5']==0&&$_POST['boliAzul']==0&&$_POST['boliNeon']==0&&$_POST['regla']==0&&$_POST['borrador']==0&&$_POST['sacPuntas']==0){
    throw new Exception("Debe seleccionar al menos un producto"); 
} else {
    $datos = [ // INICIALIZA ARREGLO 
        'libreta1' => $_POST['lib1'],
        'libreta5' => $_POST['lib5'],
        'boligrafoAzul' => $_POST['boliAzul'],
        'boligrafoNeon' => $_POST['boliNeon'],
        'regla' => $_POST['regla'],
        'borrador' => $_POST['borrador'],
        'sacapuntas' => $_POST['sacPuntas']
    ];

    $calcular = new calculo($datos); // Declarar objetos para los calculos
    
    
    $instanciaCal = $calcular -> contadorDeProductosSeleccionados();
    $a = $calcular  -> calcularSubTotal();
    $b = $calcular  -> totalConItbms(); 
    // Metodos importantes
    $articulos = $calcular  -> obtenerArtcSelect(); //Obtener la matriz
    $subtotal = $calcular -> obtenerSubtotal(); // obtener subtotal
    $totalCompra = $calcular -> obtenerTotalCompra(); // obtener total compra

    include("../../L1_P2_2.php");
}
} catch(Exception $e){ // Termina try catch
        echo "<script>alert('" . $e->getMessage() . "');</script>";
        // 3. Si ocurre un error, guardamos el mensaje en una variable
        include("../../L1_P2_2.php");
    }

?>