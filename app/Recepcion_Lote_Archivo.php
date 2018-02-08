<?php
require_once("../Paginacion/Logeo.php")                 ;
require_once("../Clases/ClaseLoteDigitacion.php")      ;

if ( isset($_GET["id"]) AND isset($_GET["Env"])) {
    $Estado = 1;
    $lote=new LoteDigitacion();
    $envia=$lote->Cambia_Estado_Lote_Id($_GET["id"],$Estado);
    $envia=$lote->Cambia_Estado_Lote_Detalle_Id($_GET["id"],$Estado);
} else { 
    if ( isset($_GET["id"]) AND isset($_GET["Rev"])) {
        $Estado = 2;
        $lote=new LoteDigitacion();
        $envia=$lote->cambia_estado_lote_id($_GET["id"],$Estado);
    }
}
require_once("../Clases/ClasePagina.php")               ;
require_once("../Paginacion/PaginacionLoteRecepcionArchivo.php")        ;
require_once("../Include/Rutinas.php")                  ;


?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
    </head>
    <body>
        <?php require_once("../Include/Menu.php");?>
        <div class="box-miniing">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lotes (<?php echo $todos[0]->cuantos?> en total)</h3>
                    </div>
                    <div class="panel-body">                            
                        <table class="table   table-striped table-hover">
                            <thead>
                                <tr>
                                    <td valign="top" >#</td>
                                    <td valign="top" >Numero Lote</td>
                                    <td valign="top" >Fecha</td>
                                    <td valign="top" >Digitador</td>
                                    <td valign="top" >Accion</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $impresos=0;
                                foreach($datos as $dato)
                                {
                                    $impresos++;
                                    if ( $dato->Estado_Lote_Id == 1 ) 
                                    {
                                    ?>
                                        <tr border=0>
                                            <td valign="top" ><?php echo $dato->id?></td>
                                            <td valign="top" ><?php echo $dato->Numero_Lote?></td>
                                            <td valign="top" ><?php echo $dato->Fecha?></td>
                                            <td valign="top" ><?php echo $dato->Nombre.' '.$dato->Apellido?></td>
                                            <td>
                                                <a href="RecepcionaLote.php?id=<?php echo $dato->id;?>" title="Actualizar Lote">
                                                    <button type='button' class="btn btn-info" data-toggle="modal" >
                                                        <span class="glyphicon glyphicon-edit" ></span> 
                                                   </button>   
                                                </a> 
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="9">
                                        <div class="pull-right">
                                            <ul class="pagination">
                                                <li><a href="Lote_Digitacion.php">&#60;&#60;&#60;&#60;</a></li>
                                                <?php
                                                if($pagina==1)
                                                {
                                                    ?>
                                                    <li class="disabled"><a href="javascript:void(0);">&#60;&#60;</a></li>
                                                    <?php
                                                }else
                                                {
                                                    $anterior=$pagina-1;
                                                    ?>
                                                    <li><a href="Lote_Digitacion.php?pagina=<?php echo $anterior?>">&#60;&#60;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                $contador = 0;
                                                for($i=$pagina;$i<=$total_paginas;$i++)
                                                {
                                                    if ( $contador < 10 ) {
                                                        $contador++;
                                                    ?>
                                                    <li <?php 
                                                        if($pagina==$i)
                                                            {
                                                                echo 'class="active"';
                                                            }?>>
                                                            <a href="Lote_Digitacion.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
                                                    <?php
                                                    } else {
                                                    if ( $i > ($total_paginas - 3) ) {
                                                        ?>
                                                            <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Lote_Digitacion.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
                                                        <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if($impresos==$cantidad_resultados_por_pagina and $pagina<$total_paginas)
                                                {
                                                    $proximo=$pagina+1;
                                                    ?>
                                                    <li><a href="Lote_Digitacion.php?pagina=<?php echo $proximo?>">&#62;&#62;</a></li>
                                                    <?php
                                                }else
                                                {
                                                    ?>
                                                    <li class="disabled"><a href="javascript:void(0);">&#62;&#62;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <li><a href="Lote_Digitacion.php?pagina=<?php echo $total_paginas?>">&#62;&#62;&#62;&#62;</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="panel-heading">
                            <div class="btn-group pull-right">
                                <a href="AddLotes.php" title="Agregar Cliente">
                                    <button type='button' class="btn btn-info" data-toggle="modal" >
                                        <span class="glyphicon glyphicon-plus" ></span> 
                                        Agregar Lote a Digitacion
                                    </button>   
                                </a>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php Include("../Include/footer.php");?>
</html>
