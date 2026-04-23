<link rel="stylesheet" href="./css/estilos.css">

<?php
class calculo{
    // Constantes
    const PRECIOS = [
        "libreta1" => 2.60,
        "libreta5" => 5.60,
        "boligrafoAzul" => 2.25,
        "boligrafoNeon" => 5.00,
        "regla" => 0.90,
        "borrador" => 0.30,
        "sacapuntas" => 0.45
    ];

    const itbms = 0.07; // Constante de los ITBMS

    // Atributos
    private $articulosPrecio; // Arreglo con los valores del formulario (producto => cantidad de ese producto)
    private $selectAritculos; // Arreglo con articulo - cantidad - precio - total (solo productos seleccionados)
    private $subTotal; // Subtotal
    private $totalCompra; // total con itbms

    public function __construct($datos) { // Metodo constructor 
        $this -> articulosPrecio = $datos;
    }

    function contadorDeProductosSeleccionados(){ // funcion que ordena solo los arictulos seleccionado en otra matriz 
        $contadorArticulos=0;
        try {
            foreach($this -> articulosPrecio as $producto => $cantidad){ // ordamiento de solo cantidades mayores a 0
                if($cantidad > 0){
                    $this -> selectAritculos[$contadorArticulos][0] = $producto;
                    $this -> selectAritculos[$contadorArticulos][1] = $cantidad;
                    foreach (calculo::PRECIOS as $productoC => $precioC) {
                        if($producto == $productoC){ // Compara el articulo y el articulo de la constante
                            $this -> selectAritculos[$contadorArticulos][2] = $precioC; 
                            $this -> selectAritculos[$contadorArticulos][3] = $precioC * $cantidad; // Calculo del total de ese articulo
                        }
                    }
                    $contadorArticulos++;
                }
            }

        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    function calcularSubTotal(){ // Funcion para calcular el subtota
        $acumu =0;
        try {
            for($i=0;$i<count($this -> selectAritculos);$i++){
                $acumu = $acumu + $this -> selectAritculos[$i][3];
            }
            $this -> subTotal = $acumu;
        }catch (Exception $e){
            echo $e->getMessage();
        }       
    }

    function totalConItbms(){ //Total de la compra con itbms
        try {
            $this -> totalCompra = $this -> subTotal * (1+calculo::itbms);
        } catch (Exception $e){
            echo $e->getMessage();
        }       
    }

    function obtenerTotalCompra(){ // Para obtener total con itbms
        return $this -> totalCompra;
    }

    function obtenerSubtotal(){ // Obtener sub total
        return $this -> subTotal;
    }

    function obtenerArtcSelect(){// Obtener los articulos ya selecionado con sus totales unitarios
        return $this -> selectAritculos;
    }

}
?>