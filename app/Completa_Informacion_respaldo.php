<?php
    require_once("../Clases/ClasePagina.php");
    require_once("../Paginacion/PaginacionLoteRecepcionArchivoCompleta.php");
    require_once("../Include/Rutinas.php")                       ;
    require_once("../Paginacion/Logeo.php")                      ;
    require_once("../Clases/ClaseLoteDigitacion.php")            ;
    $Titulo = "Completar Informaciion de Archivo"                ;
    if (isset($_GET["id_lote"])) {
        $Indentificador_Lote = $_GET["id_lote"]; 
    } else {
        $Indentificador_Lote = 0; 
    }
    
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
                        <h3 class="panel-title"><?php echo $Titulo ;?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <?php
                                    require_once("form/Menu_Inactivo_Archivo.php") ;   
                                ?>
                            </ul>
                        </div>
                        <form class="form-horizontal"  name="form_rut" id="form_rut" action="Atenciones.php" accept-charset="UTF-8" method="post"   >
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
                                                    <a href="Completa_Informacion.php?id_lote=<?php echo $dato->id;?>" title="Actualizar Lote">
                                                        <button type='button' class="btn btn-info" data-toggle="modal" >
                                                            <span class="glyphicon glyphicon-search" ></span>  
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
                                                    <li><a href="Completa_Informacion.php">&#60;&#60;&#60;&#60;</a></li>
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
                                                        <li><a href="Completa_Informacion.php?pagina=<?php echo $anterior?>">&#60;&#60;</a></li>
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
                                                                <a href="Completa_Informacion.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
                                                        <?php
                                                        } else {
                                                        if ( $i > ($total_paginas - 3) ) {
                                                            ?>
                                                                <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Completa_Informacion.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
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
                                                        <li><a href="Completa_Informacion.php?pagina=<?php echo $proximo?>">&#62;&#62;</a></li>
                                                        <?php
                                                    }else
                                                    {
                                                        ?>
                                                        <li class="disabled"><a href="javascript:void(0);">&#62;&#62;</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <li><a href="Completa_Informacion.php?pagina=<?php echo $total_paginas?>">&#62;&#62;&#62;&#62;</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php Include("../Include/footer.php");?>
    </body>
</html>