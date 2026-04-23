<?php
<<<<<<< HEAD
require_once 'TotalPedido.php';
 
// Recibe los datos del POST y los pasa a la clase
try {
    $pedido = new TotalPedido($_POST);
} catch (Exception $e) {
    echo "Error al procesar el pedido: " . $e->getMessage();
}

=======
/**
 * procesar.php — Genera la factura PDF de la Cafetería UTP
 * Requiere: composer require tecnickcom/tcpdf
 * O instalar vía: composer require dompdf/dompdf
 * 
 * Este archivo usa TCPDF si está disponible, o genera HTML+CSS 
 * con print-to-PDF como fallback universal.
 */

// ── Precios ──────────────────────────────────────────────
$precios = [
    'sandwich_jamon' => ['nombre' => 'Sandwich Jamón y queso',  'precio' => 2.25],
    'sandwich_pollo' => ['nombre' => 'Sandwich Pollo a la plancha', 'precio' => 4.00],
    'cafe'           => ['nombre' => 'Café con leche',           'precio' => 1.00],
    'jugo'           => ['nombre' => 'Jugo natural',             'precio' => 2.00],
    'brownie'        => ['nombre' => 'Brownie',                  'precio' => 1.50],
    'galleta'        => ['nombre' => 'Galleta de avena',         'precio' => 1.20],
    'pie'            => ['nombre' => 'Pie de limón',             'precio' => 2.00],
];

// ── Datos del POST ────────────────────────────────────────
$edad     = intval($_POST['edad']     ?? 0);
$sexo     = htmlspecialchars($_POST['sexo']     ?? '');
$jubilado = htmlspecialchars($_POST['jubilado'] ?? 'no');

// ── Calcular items del pedido ─────────────────────────────
$items       = [];
$subtotal    = 0.0;

foreach ($precios as $key => $info) {
    $cant = intval($_POST[$key] ?? 0);
    if ($cant > 0) {
        $importe   = $cant * $info['precio'];
        $subtotal += $importe;
        $items[]   = [
            'nombre'  => $info['nombre'],
            'cant'    => $cant,
            'unitario'=> $info['precio'],
            'importe' => $importe,
        ];
    }
}

// ── Descuentos ────────────────────────────────────────────
$descuento     = 0.0;
$descuento_txt = '';

if ($jubilado === 'si') {
    $descuento     = round($subtotal * 0.20, 2);
    $descuento_txt = '20% Descuento jubilado';
} elseif ($edad >= 60) {
    $descuento     = round($subtotal * 0.10, 2);
    $descuento_txt = '10% Descuento adulto mayor';
} elseif ($sexo === 'femenino') {
    $descuento     = round($subtotal * 0.05, 2);
    $descuento_txt = '5% Descuento especial';
}

$monto_gravado = round($subtotal - $descuento, 2);
$itbms         = round($monto_gravado * 0.07, 2);  // ITBMS 7%
$total         = round($monto_gravado + $itbms, 2);

// ── Número de factura aleatorio ───────────────────────────
$num_factura = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
$num_ticket  = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
$fecha       = date('d/m/Y');
$hora        = date('H:i');

>>>>>>> 9b72e940ca1032229bfc17d50a1fbd5f9061859c
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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
 


=======
    <title>Factura Cafetería UTP — <?= $num_factura ?></title>
    <style>
        /* ── Reset ── */
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Courier New', Courier, monospace;
            background: #e8e8e8;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 30px 16px;
        }

        /* ── Ticket wrapper ── */
        .ticket-wrap {
            width: 100%;
            max-width: 420px;
        }

        /* ── Botón imprimir (no se imprime) ── */
        .btn-print {
            display: block;
            width: 100%;
            padding: 14px;
            background: #8B0000;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            margin-bottom: 20px;
            letter-spacing: 1px;
            transition: background .2s;
        }
        .btn-print:hover { background: #6a0000; }

        .btn-volver {
            display: block;
            width: 100%;
            padding: 12px;
            background: #2E7D32;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 12px;
            text-decoration: none;
            text-align: center;
            transition: background .2s;
        }
        .btn-volver:hover { background: #1B5E20; }

        /* ── Ticket ── */
        .ticket {
            background: #fff;
            border-radius: 4px;
            box-shadow: 0 4px 24px rgba(0,0,0,.18);
            overflow: hidden;
            position: relative;
        }

        /* Perforación superior */
        .ticket::before,
        .ticket::after {
            content: '';
            display: block;
            height: 12px;
            background: repeating-linear-gradient(
                90deg,
                #e8e8e8 0 14px,
                transparent 14px 24px
            );
        }

        /* ── Cabecera DGI ── */
        .dgi-header {
            text-align: center;
            padding: 16px 20px 10px;
            border-bottom: 1px dashed #ccc;
        }
        .dgi-label {
            font-size: .75rem;
            letter-spacing: 3px;
            color: #555;
            margin-bottom: 4px;
        }
        .dgi-title {
            font-size: .7rem;
            color: #555;
            margin-bottom: 12px;
        }
        .empresa-nombre {
            font-size: 1.15rem;
            font-weight: 900;
            letter-spacing: 2px;
            color: #8B0000;
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .empresa-sub {
            font-size: .72rem;
            color: #444;
            line-height: 1.6;
        }

        /* ── Meta del ticket ── */
        .ticket-meta {
            padding: 10px 20px;
            font-size: .75rem;
            color: #333;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px 10px;
            border-bottom: 1px dashed #ccc;
        }
        .ticket-meta span { display: block; }
        .meta-label { color: #666; }

        /* ── Datos cliente ── */
        .cliente-box {
            padding: 8px 20px;
            font-size: .75rem;
            border-bottom: 1px dashed #ccc;
            line-height: 1.7;
        }
        .cliente-box strong { color: #8B0000; }

        /* ── Tabla de artículos ── */
        .articulos {
            padding: 10px 20px;
            border-bottom: 1px dashed #ccc;
        }
        .art-header {
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 4px;
            font-size: .7rem;
            font-weight: 700;
            color: #555;
            padding-bottom: 6px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 6px;
        }
        .art-row {
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 4px;
            font-size: .75rem;
            color: #222;
            padding: 5px 0;
            border-bottom: 1px dotted #eee;
        }
        .art-row:last-child { border-bottom: none; }
        .art-nombre { line-height: 1.3; }
        .art-num { text-align: right; white-space: nowrap; }

        /* ── Totales ── */
        .totales {
            padding: 10px 20px;
            font-size: .78rem;
            border-bottom: 1px dashed #ccc;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            color: #333;
        }
        .total-row.grande {
            font-size: 1.05rem;
            font-weight: 900;
            color: #8B0000;
            padding-top: 8px;
            border-top: 2px solid #8B0000;
            margin-top: 4px;
        }

        /* ── Desglose ITBMS ── */
        .itbms-box {
            padding: 8px 20px;
            font-size: .72rem;
            color: #555;
            border-bottom: 1px dashed #ccc;
        }
        .itbms-box table {
            width: 100%;
            border-collapse: collapse;
        }
        .itbms-box th, .itbms-box td {
            padding: 2px 4px;
            text-align: center;
        }
        .itbms-box th { font-weight: 700; color: #444; border-bottom: 1px solid #ddd; }

        /* ── Pie de ticket ── */
        .ticket-footer {
            padding: 14px 20px;
            text-align: center;
            font-size: .7rem;
            color: #666;
            line-height: 1.7;
        }
        .ticket-footer .gracias {
            font-size: .85rem;
            font-weight: 700;
            color: #8B0000;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }
        .separador {
            border: none;
            border-top: 1px dashed #ccc;
            margin: 8px 0;
        }

        /* ── Sin items ── */
        .sin-items {
            padding: 20px;
            text-align: center;
            color: #888;
            font-size: .85rem;
        }

        /* ── Print ── */
        @media print {
            body { background: none; padding: 0; }
            .btn-print, .btn-volver { display: none !important; }
            .ticket { box-shadow: none; }
        }
    </style>
</head>
<body>

<div class="ticket-wrap">

    <!-- Botones (no se imprimen) -->
    <button class="btn-print" onclick="window.print()">🖨️ Imprimir / Guardar PDF</button>

    <!-- ── TICKET ── -->
    <div class="ticket">

        <!-- DGI Header -->
        <div class="dgi-header">
            <div class="dgi-label">DGI</div>
            <div class="dgi-title">Comprobante de Factura Electrónica<br>Factura de operación interna</div>
            <div class="empresa-nombre">☕ Cafetería UTP</div>
            <div class="empresa-sub">
                Universidad Tecnológica de Panamá<br>
                Centro Regional de Coclé<br>
                Penonomé, Coclé, Panamá<br>
                Tel: (507) 997-0000
            </div>
        </div>

        <!-- Meta -->
        <div class="ticket-meta">
            <span><span class="meta-label">Caja:</span> 01</span>
            <span><span class="meta-label">Fecha:</span> <?= $fecha ?></span>
            <span><span class="meta-label">Ticket:</span> <?= $num_ticket ?></span>
            <span><span class="meta-label">Hora:</span> <?= $hora ?></span>
            <span><span class="meta-label">Factura:</span> <?= $num_factura ?></span>
            <span><span class="meta-label">Cajero:</span> Sistema</span>
        </div>

        <!-- Datos cliente -->
        <div class="cliente-box">
            <strong>Datos del cliente</strong><br>
            Edad: <?= $edad ?> años &nbsp;|&nbsp; 
            Sexo: <?= ucfirst($sexo) ?> &nbsp;|&nbsp;
            Jubilado: <?= $jubilado === 'si' ? 'Sí' : 'No' ?><br>
            Tipo Receptor: <strong>Consumidor Final</strong>
        </div>

        <!-- Artículos -->
        <div class="articulos">
            <div class="art-header">
                <span>Artículo</span>
                <span style="text-align:right">V. Unit.</span>
                <span style="text-align:right">Importe</span>
            </div>

            <?php if (empty($items)): ?>
                <div class="sin-items">⚠️ No se seleccionaron productos.</div>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                    <div class="art-row">
                        <span class="art-nombre">
                            <?= htmlspecialchars($item['nombre']) ?><br>
                            <small style="color:#888"><?= $item['cant'] ?> uni(s)</small>
                        </span>
                        <span class="art-num">$<?= number_format($item['unitario'], 2) ?></span>
                        <span class="art-num">$<?= number_format($item['importe'], 2) ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Totales -->
        <div class="totales">
            <div class="total-row">
                <span>Total Importe</span>
                <span>$<?= number_format($subtotal, 2) ?></span>
            </div>
            <?php if ($descuento > 0): ?>
            <div class="total-row">
                <span><?= $descuento_txt ?></span>
                <span>-$<?= number_format($descuento, 2) ?></span>
            </div>
            <?php endif; ?>
            <div class="total-row">
                <span>Monto Exento</span>
                <span>$0.00</span>
            </div>
            <div class="total-row">
                <span>Monto Gravado</span>
                <span>$<?= number_format($monto_gravado, 2) ?></span>
            </div>
            <div class="total-row">
                <span>ITBMS (7%)</span>
                <span>$<?= number_format($itbms, 2) ?></span>
            </div>
            <div class="total-row grande">
                <span>TOTAL</span>
                <span>$<?= number_format($total, 2) ?></span>
            </div>
        </div>

        <!-- Desglose ITBMS -->
        <div class="itbms-box">
            <strong>Desglose ITBMS</strong>
            <table>
                <tr>
                    <th>Monto Base</th>
                    <th>Porcentaje</th>
                    <th>Impuesto</th>
                </tr>
                <tr>
                    <td>$<?= number_format($monto_gravado, 2) ?></td>
                    <td>7%</td>
                    <td>$<?= number_format($itbms, 2) ?></td>
                </tr>
            </table>
        </div>

        <!-- Footer del ticket -->
        <div class="ticket-footer">
            <div class="gracias">¡Gracias por su compra!</div>
            <hr class="separador">
            Para cambios o devoluciones, presente este comprobante<br>
            antes de 30 días de la fecha de compra.<br>
            <hr class="separador">
            <strong>Facultad de Ingeniería en Sistemas</strong><br>
            Desarrollo de Software VII<br>
            Facilitadora: Ing. María Y. Tejedor M. de Fernández<br>
            <hr class="separador">
            Desarrollado por: Zurita Josael, Flores Josué,<br>
            Pérez Celeste, Pérez Adrian<br>
            <hr class="separador">
            Recuento de artículos: <?= array_sum(array_column($items, 'cant')) ?><br>
            Documento generado el <?= date('d/m/Y \a \l\a\s H:i:s') ?>
        </div>

    </div>
    <!-- Fin ticket -->

    <a class="btn-volver" href="L1_P1.php">← Volver al menú</a>
</div>

</body>
</html>
>>>>>>> 9b72e940ca1032229bfc17d50a1fbd5f9061859c
