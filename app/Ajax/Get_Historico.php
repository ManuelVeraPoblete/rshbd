<?php
	require("../../Clases/ClaseActualizaAtencion.php");
    require("../../Clases/ClaseRespuesta.php");
    require("../../Clases/ClaseUsuario.php");
    $id = intval($_REQUEST['id']);
    $ate=new ActualizaAtencion(); 
    $datos_his=$ate->get_historico_por_id($id);
?>
<table class='table table-striped table-condensed'>
    <thead>
        <tr>
            <th>Encuestador     </th>
            <th>Fecha Visita    </th>
            <th>AM/PM           </th>
            <th>Respuesta       </th>
            <th>Observacion     </th>
        </tr>
    </thead>
    <tbody>
        <?php
        for($h=0;$h<sizeof($datos_his);$h++)
        { ?>
            <tr> 
                <?php 
                    $res = new Respuesta();
                    $respuesta = $res->get_respuestas_por_id($datos_his[$h]["Respuesta_Id"]);
                ?>
                <td> <?php echo $datos_his[$h]["Nombre"].' '.$datos_his[$h]["Apellido"];?>          </td>
                <td> <?php echo $datos_his[$h]["Fecha_Visita"];?>                                   </td>
                <td> <?php echo $datos_his[$h]["AmPm"];?>                                           </td>
                <td> <?php echo $respuesta[0]["Respuesta_Larga"];?>                                 </td>
                <td> <?php echo $datos_his[$h]["Observacion"];?>                                    </td>
             </tr>
        <?php }?>
    </tbody>
</table> 