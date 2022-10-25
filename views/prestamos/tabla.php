<div class="area">
    <table>
        <thead>
            <tr>
                <td>Préstamo Resultados</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Pago Mensual
                </td>
                <td>
                    $<?php echo $this -> d['pago'];?>
                </td>
            </tr>
            <tr>
                <td>Cantidad del Préstamo</td>
                <td>$<?php echo $this -> d['cantidad'];?></td>
            </tr>
            <tr>
                <td>Tasa de interés</td>
                <td>7.5%</td>
            </tr>
            <tr>
                <td>Término</td>
                <td><?php echo $this -> d['termino'];?> Meses</td>
            </tr>
            <tr>
                <td>Total de los pagos</td>
                <td>$<?php echo $this -> d['total'];?></td>
            </tr>
            <tr>
                <td>Total de los intereses pagados</td>
                <td>$<?php echo $this -> d['totalIntereses'];?></td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <td>#</td>
                <td class="">Saldo Inicial</td>
                <td class="text-center">Cuota fija</td>
                <td class="text-center">Interes</td>
                <td class="text-center">Abono a capital</td>
                <td class="text-center">Saldo Final</td>
            </tr>
        </thead>
        <tbody>
            <?php echo $this -> d['tabla'];?>
        </tbody>
    </table>
</div>