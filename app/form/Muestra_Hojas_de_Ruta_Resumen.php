<div class="panel panel-primary filterable">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $Titulo_Genera; ?></h3>      
    </div>
    <table class='table'>
        <thead>
            <tr>
                <th>Encuestador   </th>
                <th>Personas      </th>
                <th> A2  </th>
                <th> E </th>
                <th> NO </th>
                <th> NOT </th>
                <th> NV </th>
                <th> P1 </th>
                <th> P2 </th>
                <th> P3 </th>
                <th> P4 </th>
                <th> P5 </th>
                <th> P6 </th>
                <th> P7 </th>
                <th> P8 </th>
                <th> R2 </th>
                <th> X </th>
                <th> Total </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $Sector_Paso = '';
                $Tot_A2        = 0;$Tot_E         = 0;$Tot_NO        = 0;$Tot_NOT       = 0;
                $Tot_NV        = 0;$Tot_P1        = 0;$Tot_P2        = 0;$Tot_P3        = 0;
                $Tot_P4        = 0;$Tot_P5        = 0;$Tot_P6        = 0;$Tot_P7        = 0;
                $Tot_P8        = 0;$Tot_R2        = 0;$Tot_X         = 0;$Tot_Tot_Linea = 0;
                $Total_Personas = 0;
                $Numero_Hoja_Paso = 0;
                $hojas = new Informes();
                $datos_hojas=$hojas->Get_Hojas_de_Ruta_Resumen( $Fecha_Desde, $Fecha_Hasta );
                if ( sizeof($datos_hojas) == 0 ) {
                    echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                } else { 
                    for($i=0;$i<sizeof($datos_hojas);$i++)
                    { 
                        $Tot_A2        = $Tot_A2           + $datos_hojas[$i]["A2"]; $Tot_E         = $Tot_E            + $datos_hojas[$i]["E"];
                        $Tot_NO        = $Tot_NO           + $datos_hojas[$i]["NO"]; $Tot_NOT       = $Tot_NOT          + $datos_hojas[$i]["NOT"];
                        $Tot_NV        = $Tot_NV           + $datos_hojas[$i]["NV"]; $Tot_P1        = $Tot_P1           + $datos_hojas[$i]["P1"];
                        $Tot_P2        = $Tot_P2           + $datos_hojas[$i]["P2"]; $Tot_P3        = $Tot_P3           + $datos_hojas[$i]["P3"];
                        $Tot_P4        = $Tot_P4           + $datos_hojas[$i]["P4"]; $Tot_P5        = $Tot_P5           + $datos_hojas[$i]["P5"];
                        $Tot_P6        = $Tot_P6           + $datos_hojas[$i]["P6"]; $Tot_P7        = $Tot_P7           + $datos_hojas[$i]["P7"];
                        $Tot_P8        = $Tot_P8           + $datos_hojas[$i]["P8"]; $Tot_R2        = $Tot_R2           + $datos_hojas[$i]["R2"];
                        $Tot_X         = $Tot_X            + $datos_hojas[$i]["X"] ; $Tot_Tot_Linea = $Tot_Tot_Linea    +  $datos_hojas[$i]["Tot_Linea"];
                        $personas = new Informes();
                        $cant_personas = $personas->Get_Cantidad_de_Personas($Fecha_Desde, $Fecha_Hasta, $datos_hojas[$i]["HH_Usuario_Id"] );
                        $Total_Personas = $Total_Personas + sizeof($cant_personas);
                        ?>
                        <tr>
                            <td><?php echo $datos_hojas[$i]["USR_Nombre"].' '.$datos_hojas[$i]["USR_Apellido"];?></td>
                            <td><?php echo sizeof($cant_personas);?></td>
                            <td><?php echo $datos_hojas[$i]["A2"];?></td>
                            <td><?php echo $datos_hojas[$i]["E"];?></td>
                            <td><?php echo $datos_hojas[$i]["NO"];?></td>
                            <td><?php echo $datos_hojas[$i]["NOT"];?></td>
                            <td><?php echo $datos_hojas[$i]["NV"];?></td>
                            <td><?php echo $datos_hojas[$i]["P1"];?></td>
                            <td><?php echo $datos_hojas[$i]["P2"];?></td>
                            <td><?php echo $datos_hojas[$i]["P3"];?></td>
                            <td><?php echo $datos_hojas[$i]["P4"];?></td>
                            <td><?php echo $datos_hojas[$i]["P5"];?></td>
                            <td><?php echo $datos_hojas[$i]["P6"];?></td>
                            <td><?php echo $datos_hojas[$i]["P7"];?></td>
                            <td><?php echo $datos_hojas[$i]["P8"];?></td>
                            <td><?php echo $datos_hojas[$i]["R2"];?></td>
                            <td><?php echo $datos_hojas[$i]["X"];?></td>
                            <td><?php echo $datos_hojas[$i]["Tot_Linea"];?></td>
                        <tr>
                     <?php   
                    }
                    ?>
                        <tr>
                            <td><?php echo " Total ";?></td> <td><?php echo $Total_Personas;?></td>
                            <td><?php echo $Tot_A2;?></td> <td><?php echo $Tot_E;?></td>
                            <td><?php echo $Tot_NO;?></td> <td><?php echo $Tot_NOT;?></td>
                            <td><?php echo $Tot_NV;?></td> <td><?php echo $Tot_P1;?></td>
                            <td><?php echo $Tot_P2;?></td> <td><?php echo $Tot_P3;?></td>
                            <td><?php echo $Tot_P4;?></td> <td><?php echo $Tot_P5;?></td>
                            <td><?php echo $Tot_P6;?></td> <td><?php echo $Tot_P7;?></td>
                            <td><?php echo $Tot_P8;?></td> <td><?php echo $Tot_R2;?></td>
                            <td><?php echo $Tot_X;?></td> <td><?php echo $Tot_Tot_Linea;?></td>
                        <tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>


<?php 
   // $contenido ="Movimiento=$Movimiento&Fecha_Generada=$Fecha_Generada";
    echo "<center><a href='#' target='_blank'><button type='button' class='btn btn-primary btn-lg'>Imprime Hojas de Ruta</button></a> </center>";
?>



