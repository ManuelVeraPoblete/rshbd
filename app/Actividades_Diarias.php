<?php
require_once("../Paginacion/Logeo.php");
require_once("../Clases/ClasePagina.php");
require_once("../Paginacion/PaginacionActividadesDiarias.php");
require_once("../Clases/ClaseActividadesDiaria.php");
require_once("../Include/Rutinas.php");
if (isset($_GET['Elimina'])) {
   $Elimina_Dato = $_GET['id'];
   $Eli = new ActividadesDiarias();
   $Elimina =  $Eli->Elimina_Actividad($Elimina_Dato);
}

?>
<!DOCTYPE html>
    <html>
        <head>
            <?php require_once("../Include/Header.php");?>
        </head>
        <body>
            <?php require_once("../Include/Menu.php");?>
            <div class="box-panta" style ="margin-right: 10% ; margin-left: 10%">

                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Actividades  de <?php echo $nombre.' '.$apellido.'  en el mes de '.Nombre_Mes($Mes_Actual).' del '.$Anio_Actual.' ';?>(<?php echo $todos[0]->cuantos?> en total)</h3>
                        </div>
                        <div class="panel-body">
                            
                            <table class="table  table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td valign="top" >#</td>
                                        <td valign="top" >Fecha</td>
                                        <td valign="top" >Actividad</td>
                                        <td valign="top" >Cantidad</td>
                                        <td valign="top" ></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $impresos=0;
                                    foreach($datos as $dato)
                                    {
                                        $impresos++;
                                        ?>
                                        <tr>
                                            <td valign="top" ><?php echo $dato->id?></td>
                                            <td valign="top" ><?php echo $dato->Fecha?></td>
                                            <td valign="top" ><?php echo $dato->Actividades?></td>
                                            <td valign="top" ><?php echo $dato->Cantidad?></td>

                                            <td>
                                                <a href="Actividades_Diarias.php?id=<?php echo $dato->id;?>&Elimina='S'" title="Eliminar Actividad Usuario">
                                                    <button type='button' class="btn btn-info" data-toggle="modal" >
                                                        <span class="glyphicon glyphicon-trash" ></span> 
                                                    </button>   
                                                </a>
                                                <a href="Consulta_Actividades.php?id=<?php echo $id_usuario_act;?>" title="Desplegar Actividades">
                                                    <button type='button' class="btn btn-info" data-toggle="modal" >
                                                        <span class="glyphicon glyphicon-search" ></span> 
                                                    </button>   
                                                </a>
                                            </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                <tr>
                                    <td colspan="9">
                                        <div class="pull-right">
                                            <ul class="pagination">
                                                <li><a href="Actividades_Diarias.php">&#60;&#60;&#60;&#60;</a></li>
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
                                                    <li><a href="Actividades_Diarias.php?pagina=<?php echo $anterior?>">&#60;&#60;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                
                                                <?php
                                                for($i=1;$i<=$total_paginas;$i++)
                                                {
                                                    ?>
                                                    <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Actividades_Diarias.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
                                                    <?php
                                                }
                                                ?>
                                                

                                                <?php
                                                if($impresos==$cantidad_resultados_por_pagina and $pagina<$total_paginas)
                                                {
                                                    $proximo=$pagina+1;
                                                    ?>
                                                    <li><a href="Actividades_Diarias.php?pagina=<?php echo $proximo?>">&#62;&#62;</a></li>
                                                    <?php
                                                }else
                                                {
                                                    ?>
                                                    <li class="disabled"><a href="javascript:void(0);">&#62;&#62;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <li><a href="Actividades_Diarias.php?pagina=<?php echo $total_paginas?>">&#62;&#62;&#62;&#62;</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="panel-heading">
                                <div class="btn-group pull-right">
                                    <a href="AgregaActividades.php?id=<?php echo $id_usuario_act;?>" title="Agregar Cliente">
                                        <button type='button' class="btn btn-info" data-toggle="modal" >
                                            <span class="glyphicon glyphicon-plus" ></span> 
                                            Agregar Actividad
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
