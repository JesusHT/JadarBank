<table>
    <thead> 
        <tr>
            <td colspan="2" rowspan="2" class="text-center">Prestamos resultados</td>
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
            <td>Total de los intereses pagados</td>
            <td>$<?php echo $this -> d['totalIntereses'];?></td>
        </tr>
        <tr>
            <td>Total de los pagos</td>
            <td>$<?php echo $this -> d['total'];?></td>
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

<form action="<?php echo constant('URL'); ?>prestamos/solicitar" method="POST">
    <input type="hidden" name="cant"    id="cant"     value="<?php echo $this -> d['cantidad'];?>">
    <input type="hidden" name="termino" id="termino"  value="<?php echo $this -> d['termino']; ?>">
    <input type="text"   name="num_client" 
    <?php
        if (isset($_SESSION['prestamo'])) {
            echo 'value="'. $_SESSION['prestamo'] .'"';
        }   
    ?> placeholder="Número de cliente">
    <button type="submit" class="btn">Solicitar Prestamo</button>
</form>
<br>
<form action="<?php echo constant('URL'); ?>prestamos/descargarpdf" method="POST" target="print_popup" onsubmit="window.open('about:blank','print_popup','width=1000,height=800');">
    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo $this -> d['cantidad'];?>">
    <input type="hidden" name="plazo"    id="plazo"    value="<?php echo $this -> d['termino']; ?>">
    <button type="submit" class="btn"><i class="fa-solid fa-print"></i></button>
</form>
</section>
    </main>   
</body>
</html>