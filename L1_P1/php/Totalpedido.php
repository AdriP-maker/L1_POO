<?php

class TotalPedido {

    // Catálogo de precios
    private array $precios = [
        'sandwich_jamon' => ['nombre' => 'Sandwich Jamón y queso',       'precio' => 2.25],
        'sandwich_pollo' => ['nombre' => 'Sandwich Pollo a la plancha',  'precio' => 4.00],
        'cafe'           => ['nombre' => 'Café con leche',               'precio' => 1.00],
        'jugo'           => ['nombre' => 'Jugo natural',                 'precio' => 2.00],
        'brownie'        => ['nombre' => 'Brownie',                      'precio' => 1.50],
        'galleta'        => ['nombre' => 'Galleta de avena',             'precio' => 1.20],
        'pie'            => ['nombre' => 'Pie de limón',                 'precio' => 2.00],
    ];

    // Datos del cliente
    public int    $edad;
    public string $sexo;
    public string $jubilado;

    // Resultados calculados
    public array  $items         = [];
    public float  $subtotal      = 0.0;
    public float  $descuento     = 0.0;
    public string $descuento_txt = '';
    public float  $monto_gravado = 0.0;
    public float  $itbms         = 0.0;
    public float  $total         = 0.0;

    // Datos del comprobante
    public string $num_factura;
    public string $num_ticket;
    public string $fecha;
    public string $hora;

public function __construct(array $post) {

    // ── Validación de edad ─────────────────────────────
    if (!isset($post['edad']) || !is_numeric($post['edad'])) {
        throw new Exception("Edad no válida");
    }

    $this->edad = intval($post['edad']);

    if ($this->edad < 0 || $this->edad > 120) {
        throw new Exception("Edad fuera de rango (0-120)");
    }

    // ── Validación de sexo ─────────────────────────────
    if (!isset($post['sexo']) || ($post['sexo'] !== 'masculino' && $post['sexo'] !== 'femenino')) {
        throw new Exception("Sexo inválido");
    }

    $this->sexo = htmlspecialchars($post['sexo']);

    // ── Validación de jubilado ─────────────────────────
    if (!isset($post['jubilado']) || ($post['jubilado'] !== 'si' && $post['jubilado'] !== 'no')) {
        throw new Exception("Valor de jubilado inválido");
    }

    $this->jubilado = htmlspecialchars($post['jubilado']);

    // ── Procesamiento normal (NO TOCAR) ────────────────
    $this->calcularItems($post);

    // Validar que haya al menos un producto
    if ($this->subtotal <= 0) {
        throw new Exception("Debe seleccionar al menos un producto");
    }

    $this->calcularDescuento();
    $this->calcularTotales();
    $this->generarComprobante();
}

    // ── Recorre los productos del POST ───────────────────────
    private function calcularItems(array $post): void {
        foreach ($this->precios as $key => $info) {
            $cant = intval($post[$key] ?? 0);
            if ($cant > 0) {
                $importe        = $cant * $info['precio'];
                $this->subtotal += $importe;
                $this->items[]  = [
                    'nombre'   => $info['nombre'],
                    'cant'     => $cant,
                    'unitario' => $info['precio'],
                    'importe'  => $importe,
                ];
            }
        }
    }

    // ── Aplica descuento según perfil ────────────────────────
    // Prioridad: jubilado (20%) > adulto mayor por sexo (10%) > ninguno
    // Adulto mayor: mujer >= 55 años | hombre >= 60 años
    // Jubilado solo aplica si además cumple la edad mínima
    private function calcularDescuento(): void {
        $esMujer  = $this->sexo === 'femenino';
        $esHombre = $this->sexo === 'masculino';

        $esAdultoMayor = ($esMujer && $this->edad >= 55) 
                      || ($esHombre && $this->edad >= 60);

        $esJubilado = $this->jubilado === 'si';

        // Ley 6 de 1987 → 50% si cumple condición
        if ($esAdultoMayor || $esJubilado) {
            $this->descuento = $this->subtotal * 0.50;
            $this->descuento_txt = '50% Descuento Ley 6 de 1987';
        }
    }

    // ── Calcula monto gravado, ITBMS y total ─────────────────
    private function calcularTotales(): void {
        $this->monto_gravado = round($this->subtotal - $this->descuento, 2);
        $this->itbms         = round($this->monto_gravado * 0.07, 2);
        $this->total         = round($this->monto_gravado + $this->itbms, 2);
    }

    // ── Genera número de factura, ticket, fecha y hora ───────
    private function generarComprobante(): void {
        $this->num_factura = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        $this->num_ticket  = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        $this->fecha       = date('d/m/Y');
        $this->hora        = date('H:i');
    }
}