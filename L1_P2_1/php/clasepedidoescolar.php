<?php
// aqui se declara la clase de pedidos
class ClasePedidoEscolar {

    // se declaran los atributos privados
    private $productos;


    //inicia el contructor de la clase pedido
    public function __construct() {
        $this->productos = [];
    } // termina el constructor


    // inicia método para que se puedan agregar los productos escolares
    public function agregarProducto($nombre, $precio, $cantidad) {

        // validación para la cantidad si es menor o igual que 0
        if (!is_numeric($cantidad) || $cantidad <= 0) {
            throw new Exception("Cantidad inválida para el producto: $nombre");
        }// termina validación


        //se guardan los productos
        $this->productos[] = [
            "nombre" => $nombre,
            "precio" => $precio,
            "cantidad" => $cantidad,
            "total" => $precio * $cantidad
        ];
    }//termina el método 



    // inicia método para calcular el subtotal
    public function calcularSubtotal() {
        $subtotal = 0;

        foreach ($this->productos as $producto) {
            $subtotal += $producto["total"];
        }

        return $subtotal;
    }// termina el método



    // inicia el método para calcular el total de la compra con itbms
    public function calcularTotal() {
        $subtotal = $this->calcularSubtotal();
        $itbms = $subtotal * 0.07;
        return $subtotal + $itbms;
    }// termina el método



    // inicia método para obtener los productos
    public function getProductos() {
        return $this->productos;
    }//termina el método
}
//termina la clase de pedido escolar
?>