<?php
	require("../../Clases/ClaseAtencion.php");
    $id = intval($_REQUEST['id']);
    $ate=new Atencion(); ?>
    <table class='table table-striped table-condensed'>
        <thead>
            <tr>
                <th>#</th>
                                <th>Ejecutor</th>
                                <th>Fecha Atencion</th>
                                <th>Folio Rsh</th>
                                <th>Numero Solicitud</th>
                                <th>Estado Atencion</th>
                                <th>Fecha Cierre</th>
                                <th>Usuario </th>
                                <th>Consulta</th>
                                <th>Estado Consulta</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $datos_ate=$ate->get_atencion_por_persona($id);
        $paso_atencion = 0;
        for($i=0;$i<sizeof($datos_ate);$i++)
        {
            if ($paso_atencion  != $datos_ate[$i]["id"] ) 
            {
                $paso_atencion  = $datos_ate[$i]["id"]
                ?>
                <tr> 
                    <td><?php echo $datos_ate[$i]["id"];?>                                      </td>
                                        <td><?php echo $datos_ate[$i]["Nombre"].' '.$datos_ate[$i]["Apellido"];?>   </td>
                                        <td><?php echo $datos_ate[$i]["Fecha_Atencion"];?>                          </td>
                                        <td><?php echo $datos_ate[$i]["Folio_Rsh"];?>                               </td>
                                        <td><?php echo $datos_ate[$i]["Numero_Solicitud"];?>                        </td>
                                        <?php 
                                        if ( $datos_ate[$i]["Estado_Atencion"] == 2 ) { ?>
                                            <td>Cerrada</td> <?php
                                        } else { ?>
                                            <td><a href="Atenciones.php" data-toggle="tab" class="btn btn-danger btn-xs ">Pendiente</a></td> <?php
                                            $pendientes = "S";
                                        } ?>
                                        <td> <?php echo $datos_ate[$i]["Fecha_Cierra"] ; ?> </td>
                                        <td> <?php echo $datos_ate[$i]["Nombre_Cierra"].' '.$datos_ate[$i]["Apellido_Cierra"] ; ?> </td>
                                        <td><?php echo $datos_ate[$i]["Consulta"];?></td>
                                        <td><?php echo $datos_ate[$i]["est_ate"];?></td>
                </tr>
                <?php 
            } else { ?>
                <tr> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> 
                    <td><?php echo $datos_ate[$i]["Consulta"];?></td>
                </tr> <?php
            }
        }?>
        </tbody>
    </table>

    