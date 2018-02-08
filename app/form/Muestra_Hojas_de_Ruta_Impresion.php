<div class="panel panel-primary filterable">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $Titulo_Genera; ?></h3>      
    </div>
    <table class='table'>
        <thead>
            <tr>
                <th>Num Hoja      </th>
                <th>Sector        </th>
                <th> #            </th>
                <th>Rut           </th>
                <th>Nombre        </th>
                <th>ult. Respuesta</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $Sector_Paso = '';
                $Numero_Hoja_Paso = 0;
                $hojas = new Informes();
                $datos_hojas=$hojas->Get_Hojas_de_Ruta( $Fecha_Generada, $Movimiento );
                if ( sizeof($datos_hojas) == 0 ) {
                    echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                } else { 
                    for($i=0;$i<sizeof($datos_hojas);$i++)
                    { 
    
                        ?>
                        <tr>
                            <?php 
                            if ( $datos_hojas[$i]["HC_Numero_Hoja"] != $Numero_Hoja_Paso or
                                $datos_hojas[$i]["SE_Sector"] != $Sector_Paso )
                            {?> 
                                <td><?php echo $datos_hojas[$i]["HC_Numero_Hoja"];?></td>
                                <td><?php echo $datos_hojas[$i]["SE_Sector"];?></td>
                                <?php
                                    $Numero_Hoja_Paso = $datos_hojas[$i]["HC_Numero_Hoja"];
                                    $Sector_Paso = $datos_hojas[$i]["SE_Sector"];
                                ?>
                            <?php } else { echo "<td></td>" ;
                                            echo "<td></td>";} ?>
                                <td><?php echo $datos_hojas[$i]["HD_Item"];?></td>
                                <td><?php echo $datos_hojas[$i]["PE_Rut"];?></td>
                                <td><?php echo $datos_hojas[$i]["PE_Nombre"].' '.$datos_hojas[$i]["PE_Apellido"];?></td>
    
                           
    
                            <td><?php echo $datos_hojas[$i]["RE_Respuesta_Corta"];?></td>
                        </tr>
                        <?php  
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<input type="hidden" name="Movimiento"  value="<?php echo $Movimiento;?>">
<input type="hidden" name="Fecha_Generada" value="<?php echo $Fecha_Generada;?>">
<input type="hidden" name="Imprime_Hoja" value="S">
<?php 
    $contenido ="Movimiento=$Movimiento&Fecha_Generada=$Fecha_Generada";
    echo "<center><a href='inf/Imprime_Hojas_De_Ruta.php?$contenido' target='_blank'><button type='button' class='btn btn-primary btn-lg'>Imprime Hojas de Ruta</button></a> </center>";
?>



