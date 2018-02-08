<?php
require_once("../Clases/ClasePagina.php");
require_once("../Paginacion/PaginacionCalle.php");
require_once("../Paginacion/Logeo.php");
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
                        <h3 class="panel-title">Calles (<?php echo $todos[0]->cuantos?> en total)</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline" accept-charset="UTF-8" action="Calle.php"  method="post">
                            <div class="form-group">
                                <div class="input-group">
                                        <input type="text" class="form-control" name="busqueda"  placeholder="Nombre Calle">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                        <table class="table   table-striped table-hover">
                            <thead>
                                <tr>
                                    <td valign="top" >#</td>
                                    <td valign="top" >Calle</td>
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
                                        <td valign="top" ><?php echo $dato->Calle?></td>
                                        <td>
                                            <a href="EditCalle.php?id=<?php echo $dato->id;?>" title="Agregar Usuario">
                                                <button type='button' class="btn btn-info" data-toggle="modal" >
                                                    <span class="glyphicon glyphicon-edit" ></span> 
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
                                                <li><a href="Calle.php">&#60;&#60;&#60;&#60;</a></li>
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
                                                    <li><a href="Calle.php?pagina=<?php echo $anterior?>">&#60;&#60;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                $contador = 0;
                                                for($i=1;$i<=$total_paginas;$i++)
                                                {
                                                    if ( $i < 10 ) {
                                                    ?>
                                                    <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Calle.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
                                                    <?php
                                                    } else {
                                                    if ( $i > ($total_paginas - 3) ) {
                                                        ?>
                                                            <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Calle.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
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
                                                    <li><a href="Calle.php?pagina=<?php echo $proximo?>">&#62;&#62;</a></li>
                                                    <?php
                                                }else
                                                {
                                                    ?>
                                                    <li class="disabled"><a href="javascript:void(0);">&#62;&#62;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <li><a href="Calle.php?pagina=<?php echo $total_paginas?>">&#62;&#62;&#62;&#62;</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="panel-heading">
                            <div class="btn-group pull-right">
                                <a href="AddCalle.php" title="Agregar Cliente">
                                    <button type='button' class="btn btn-info" data-toggle="modal" >
                                        <span class="glyphicon glyphicon-plus" ></span> 
                                        Agregar Calle
                                    </button>   
                                </a>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include("../Include/footer.php");?>
</html>