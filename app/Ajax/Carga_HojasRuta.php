<?php
    require("../../Clases/ClaseAtencion.php");
    $Movimiento         = '10';
    $Fecha_Desde        = '2017-01-01';
    $ate                = new Atencion(); 
    $Ultimo_Numero_Hoja = $ate->get_ultima_hoja($Movimiento)
    $Numero_Hoja        = $Ultimo_Numero_Hoja[0]["Numero_Generado"] + 1;
?>
<table class='table table-striped table-condensed'>
    <thead>
        <tr>
            <th>Num Hoja</th>
            <th> # </th>
            <th>Rut</th>
            <th>Nombre</th>
            <th>Sector </th>
            <th>Unidad</th>
            <th>Poblacion</th>
            <th>Calle</th>
            <th>Numero</th>
            <th>Telefono</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $datos_ate=$ate->get_genera_hoja( $Movimiento, $Fecha_Desde )
            $paso_atencion = 0;
            for($i=0;$i<sizeof($datos_ate);$i++)
            { ?>
                <tr>
                    <td><?php echo $Numero_Hoja;?></td> 
                    <td><?php echo $i;?></td> 
                    <td><?php echo $datos_ate[$i]["Rut"];?></td>
                    <td><?php echo $datos_ate[$i]["Nombre"].' '.$datos_ate[$i]["Apellido"];?></td>
                    <td><?php echo $datos_ate[$i]["Sector"];?></td>
                    <td><?php echo $datos_ate[$i]["Unidad"];?></td>
                    <td><?php echo $datos_ate[$i]["Poblacion"];?></td>
                    <td><?php echo $datos_ate[$i]["Calle"];?></td>
                    <td><?php echo $datos_ate[$i]["Numero"];?></td>
                    <td><?php echo $datos_ate[$i]["Telefono"];?></td>                        
                </tr>
                <?php  
            }
        ?>
    </tbody>
</table>