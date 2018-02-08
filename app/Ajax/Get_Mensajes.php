<?php
	require("../../Clases/ClaseMensaje.php");
?>
    <table class='table table-striped table-condensed'>
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha Generado</th>
                <th>Usuario</th>
                <th>Mensaje</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $id = intval($_REQUEST['id']);
            $consu = new Mensajes();
            $consulta=$consu->get_mensajes_por_id($id);
            for($i=0;$i<sizeof($consulta);$i++)
            { ?>
                <tr> 
                    <td><?php echo $consulta[$i]["id"];?></td>
                    <td><?php echo $consulta[$i]["Fecha_Generada"];?></td>
                    <td><?php echo $consulta[$i]["nom_usr_g"].' '.$consulta[$i]["ape_usr_g"];?></td>
                    <td><?php echo $consulta[$i]["Mensaje"];?></td>
                    <td>
                        <a href="<?php  $marca=$consu->get_mensajes_por_id($consulta[$i]["id"]);?>" title="Consultar Historia">
                            <button type='button' class="btn btn-info" data-toggle="modal" >
                                <span class="glyphicon glyphicon-ok" ></span> 
                            </button>   
                        </a>
                    </td>
                </tr>
                <?php 
            }?>
        </tbody>
    </table>

    