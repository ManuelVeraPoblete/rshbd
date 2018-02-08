<?php
    require_once("../Paginacion/Logeo.php")                 ;
    require_once("../Clases/ClaseTerreno.php")              ;
    require_once("../Clases/ClasePagina.php")               ;    
    require_once("../Paginacion/PaginacionTerreno.php")     ;
    require_once("../Include/Rutinas.php")                  ;
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
    </head>
    <body>
        <?php require_once("../Include/Menu.php");?>
        <div class="box-panta">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Operativos (<?php echo $todos[0]->cuantos?> en total)</h3>
                    </div>
                    <div class="panel-body">                            
                        <table class="table   table-striped table-hover">
                            <thead>
                                <tr>
                                    <td valign="top">#           </td>
                                    <td valign="top">Fecha       </td>
                                    <td valign="top">Hora        </td>
                                    <td valign="top">Actividad   </td>
                                    <td valign="top">Descripcion </td>
                                    <td valign="top">Lugar       </td>
                                    <td valign="top">Responsable </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $impresos=0;
                                foreach($datos as $dato)
                                {
                                    $impresos++;
                                    ?>
                                    <tr border=0>
                                        <td valign="top" ><?php echo $dato->id?>                            </td>
                                        <td valign="top" ><?php echo $dato->Fecha_Operativo?>               </td>
                                        <td valign="top" ><?php echo $dato->Hora?>                          </td>
                                        <td valign="top" ><?php echo $dato->Operativo?>                     </td>
                                        <td valign="top" ><?php echo $dato->Descripcion?>                   </td>
                                        <td valign="top" ><?php echo $dato->Lugar?>                         </td>
                                        <td valign="top" ><?php echo $dato->Nombre.' '.$dato->Apellido?>    </td>
                                        <td>
                                            <a href="Personas.php?Rut_Persona=<?php echo $dato->Rut;?>" title="Consultar Historia">
                                                <button type='button' class="btn btn-info" data-toggle="modal" >
                                                        <span class="glyphicon glyphicon-search" ></span> 
                                                </button>   
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
                                                <li><a href="Actividad_Terreno.php">&#60;&#60;&#60;&#60;</a></li>
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
                                                    <li><a href="Actividad_Terreno.php?pagina=<?php echo $anterior?>">&#60;&#60;</a></li>
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
                                                            <a href="Actividad_Terreno.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
                                                    <?php
                                                    } else {
                                                    if ( $i > ($total_paginas - 3) ) {
                                                        ?>
                                                            <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Actividad_Terreno.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
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
                                                    <li><a href="Actividad_Terreno.php?pagina=<?php echo $proximo?>">&#62;&#62;</a></li>
                                                    <?php
                                                }else
                                                {
                                                    ?>
                                                    <li class="disabled"><a href="javascript:void(0);">&#62;&#62;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <li><a href="Actividad_Terreno.php?pagina=<?php echo $total_paginas?>">&#62;&#62;&#62;&#62;</a></li>
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