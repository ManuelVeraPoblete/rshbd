<?php
require_once("../Paginacion/Logeo.php");
$Usuario_Id = $_SESSION["id_usuario"];
$Per_Id     = $_SESSION["per_id"];
$Niv_Id     = $_SESSION["niv_id"];
require_once("../Clases/ClasePagina.php");
require_once("../Paginacion/PaginacionUsuario.php");
require_once("../Include/Rutinas.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
    </head>
    <body>
        <?php require_once("../Include/Menu.php"); ?>
        <div class="box-miniing">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Usuarios (<?php echo $todos[0]->cuantos?> en total)</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table   table-striped table-hover">
                            <thead>
                                <tr>
                                    <td valign="top" >Rut</td>
                                    <td valign="top" >Nombre</td>
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
                                        <td valign="top" ><?php echo $dato->Rut?></td>
                                        <td valign="top" ><?php echo $dato->Nombre.' '.$dato->Apellido?></td>
                                        <td>
                                            <a href="AgregaActividades.php?id=<?php echo $dato->id;?>" title="Agregar Actividad">
                                                <button type='button' class="btn btn-info" data-toggle="modal" >
                                                    <span class="glyphicon glyphicon-edit" ></span> 
                                                </button>   
                                            </a>

                                            <a href="Consulta_Actividades.php?id=<?php echo $dato->id;?>" title="Desplegar Actividades">
                                                <button type='button' class="btn btn-info" data-toggle="modal" >
                                                    <span class="glyphicon glyphicon-search" ></span> 
                                                </button>   
                                            </a>

                                              <a href="Consulta_Actividades.php?id=<?php echo $dato->id;?>" title="Actulizar Actividades">
                                                <button type='button' class="btn btn-info" data-toggle="modal" >
                                                    <span class="glyphicon glyphicon-play" ></span> 
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
                                                <li><a href="Ingreso_Actividades.php">&#60;&#60;&#60;&#60;</a></li>
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
                                                    <li><a href="Ingreso_Actividades.php?pagina=<?php echo $anterior?>">&#60;&#60;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                
                                                <?php
                                                for($i=1;$i<=$total_paginas;$i++)
                                                {
                                                    ?>
                                                    <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Ingreso_Actividades.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if($impresos==$cantidad_resultados_por_pagina and $pagina<$total_paginas)
                                                {
                                                    $proximo=$pagina+1;
                                                    ?>
                                                    <li><a href="Ingreso_Actividades.php?pagina=<?php echo $proximo?>">&#62;&#62;</a></li>
                                                    <?php
                                                }else
                                                {
                                                    ?>
                                                    <li class="disabled"><a href="javascript:void(0);">&#62;&#62;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <li><a href="Ingreso_Actividades.php?pagina=<?php echo $total_paginas?>">&#62;&#62;&#62;&#62;</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>        
                        </table>
                        <div class="panel-heading">
                            <div class="btn-group pull-right">
                                <a href="AddIngerso_Actividades.php" title="Agregar Cliente">
                                    <button type='button' class="btn btn-info" data-toggle="modal" >
                                        <span class="glyphicon glyphicon-plus" ></span> 
                                        Agregar Usuario
                                    </button>   
                                </a>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <?php Include("../Include/footer.php");?>
    </body>
</html>
