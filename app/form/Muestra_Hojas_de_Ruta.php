<div class="panel panel-primary filterable">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $Titulo_Genera; ?></h3>      
    </div>
    <table class='table'>
        <thead>
            <tr>
                <th>Num Hoja  </th>
                <th> #        </th>
                <th>Rut       </th>
                <th>Nombre    </th>
                <th>Sector    </th>
                <th>Unidad    </th>
                <th>Poblacion </th>
                <th>Calle     </th>
                <th>Numero    </th>
                <th>Telefono  </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $hojas = new Atencion();
                $contador = 0;
                $Numero_Hoja_Paso = 0;
                $Sector_Paso      = ' ';
                $datos_hojas=$hojas->get_genera_hoja( $Movimiento, $Fecha_Desde );
                for($i=0;$i<sizeof($datos_hojas);$i++)
                { 
                    $contador++; 
                    if ($datos_hojas[$i]["Sector"] <> $Sector_Paso  or 
                        $contador > 15 ) {
                            $Sector_Paso = $datos_hojas[$i]["Sector"];
                            $Numero_Hoja++;
                            $Numero_Hoja_Paso = $Numero_Hoja;
                            $contador = 1;
                    }
                    ?>
                    <tr>
                        <?php if ($contador == 1 ) { ?>
                            <td><?php echo $Numero_Hoja;?></td> 
                        <?php } else  { ?>
                            <td></td> 
                         <?php } ?>
                        <td><?php echo $contador;?></td> 
                        <td><?php echo $datos_hojas[$i]["Rut"];?></td>
                        <td><?php echo $datos_hojas[$i]["Nombre"].' '.$datos_hojas[$i]["Apellido"];?></td>
                        <td><?php echo $datos_hojas[$i]["Sector"];?></td>
                        <td><?php echo $datos_hojas[$i]["Unidad"];?></td>
                        <td><?php echo $datos_hojas[$i]["Poblacion"];?></td>
                        <td><?php echo $datos_hojas[$i]["Calle"];?></td>
                        <td><?php echo $datos_hojas[$i]["Numero"];?></td>
                        <td><?php echo $datos_hojas[$i]["Telefono"];?></td>                        
                    </tr>
                    <?php  
                }
            ?>
        </tbody>
    </table>
</div>

<input type="hidden" name="Movimiento"  value="<?php echo $Movimiento;?>">
<input type="hidden" name="Fecha_Desde" value="<?php echo $Fecha_Desde;?>">
<input type="hidden" name="Genera_Hoja" value="S">

<center><button type="button submit" class="btn btn-primary btn-lg">Grabar Hojas de Ruta</button></center>

