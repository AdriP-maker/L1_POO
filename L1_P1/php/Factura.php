<?php
// Este archivo espera que $pedido sea una instancia de TotalPedido
// Se incluye desde procesar.php con: include 'factura.php';
?>

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

    <!-- Meta del ticket -->
    <div class="ticket-meta">
        <span><span class="meta-label">Caja:</span> 01</span>
        <span><span class="meta-label">Fecha:</span> <?= $pedido->fecha ?></span>
        <span><span class="meta-label">Ticket:</span> <?= $pedido->num_ticket ?></span>
        <span><span class="meta-label">Hora:</span> <?= $pedido->hora ?></span>
        <span><span class="meta-label">Factura:</span> <?= $pedido->num_factura ?></span>
        <span><span class="meta-label">Cajero:</span> Sistema</span>
    </div>

    <!-- Datos del cliente -->
    <div class="cliente-box">
        <strong>Datos del cliente</strong><br>
        Edad: <?= $pedido->edad ?> años &nbsp;|&nbsp;
        Sexo: <?= ucfirst($pedido->sexo) ?> &nbsp;|&nbsp;
        Jubilado: <?= $pedido->jubilado === 'si' ? 'Sí' : 'No' ?><br>
        Tipo Receptor: <strong>Consumidor Final</strong>
    </div>

    <!-- Artículos -->
    <div class="articulos">
        <div class="art-header">
            <span>Artículo</span>
            <span style="text-align:right">V. Unit.</span>
            <span style="text-align:right">Importe</span>
        </div>

        <?php if (empty($pedido->items)): ?>
            <div class="sin-items">⚠️ No se seleccionaron productos.</div>
        <?php else: ?>
            <?php foreach ($pedido->items as $item): ?>
                <div class="art-row">
                    <span class="art-nombre">
                        <?= htmlspecialchars($item['nombre']) ?><br>
                        <small style="color:#888"><?= $item['cant'] ?> uni(s)</small>
                    </span>
                    <span class="art-num">$<?= number_format($item['unitario'], 2) ?></span>
                    <span class="art-num">$<?= number_format($item['importe'],  2) ?></span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Totales -->
    <div class="totales">
        <div class="total-row">
            <span>Total Importe</span>
            <span>$<?= number_format($pedido->subtotal, 2) ?></span>
        </div>
        <?php if ($pedido->descuento > 0): ?>
        <div class="total-row">
            <span><?= $pedido->descuento_txt ?></span>
            <span>-$<?= number_format($pedido->descuento, 2) ?></span>
        </div>
        <?php endif; ?>
        <div class="total-row">
            <span>Monto Exento</span>
            <span>$0.00</span>
        </div>
        <div class="total-row">
            <span>Monto Gravado</span>
            <span>$<?= number_format($pedido->monto_gravado, 2) ?></span>
        </div>
        <div class="total-row">
            <span>ITBMS (7%)</span>
            <span>$<?= number_format($pedido->itbms, 2) ?></span>
        </div>
        <div class="total-row grande">
            <span>TOTAL</span>
            <span>$<?= number_format($pedido->total, 2) ?></span>
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
                <td>$<?= number_format($pedido->monto_gravado, 2) ?></td>
                <td>7%</td>
                <td>$<?= number_format($pedido->itbms, 2) ?></td>
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
        Recuento de artículos: <?= array_sum(array_column($pedido->items, 'cant')) ?><br>
        Documento generado el <?= date('d/m/Y \a \l\a\s H:i:s') ?>
    </div>

</div>