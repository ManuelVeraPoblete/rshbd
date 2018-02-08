<?php
    require_once("../Clases/ClasePagina.php")               ;   require_once("../Paginacion/PaginacionAtencion.php")    ;
    require_once("../Paginacion/Logeo.php")                 ;   require_once("../Clases/ClaseUnidad.php")               ;
    require_once("../Clases/ClasePoblacion.php")            ;   require_once("../Clases/ClaseCalle.php")                ;
    require_once("../Clases/ClasePersona.php")              ;   require_once("../Clases/ClaseDireccion.php")            ;
    require_once("../Clases/ClaseConsulta.php")             ;   require_once("../Clases/ClasePrograma.php")             ;
    require_once("../Clases/ClaseDocumento.php")            ;   require_once("../Clases/ClaseAtencion.php")             ;
    require_once("../Clases/ClaseEstado.php")               ;   require_once("../Include/Rutinas.php")                  ;
    if (isset($_GET["id"])) {
        if ($_GET["Aprueba"] == "S") {
            $apru=new Atencion();
            $aprueba=$apru->aprueba_consulta($_GET["id"],$_GET["Atencion_Id"],$_GET["Usuario_Id"]);
        } else {
            $recha=new Atencion();
            $rechaza=$recha->rechaza_consulta($_GET["id"],$_GET["Atencion_Id"],$_GET["Usuario_Id"]);
        }
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
                        <h3 class="panel-title">Atenciones (<?php echo $todos[0]->cuantos?> en total )</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline" accept-charset="UTF-8" action="Revisa_Atencion.php"  method="post">
                            <div class="form-group">                                    
                                <div class="input-group">
                                    <input type="text" class="form-control" name="Rut_Ciudadano" id="Rut_Ciudadano" placeholder="Ingrese Rut Ciudadano..."   onblur='onRutBlur(this);' >
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                        <table class="table   table-striped table-hover">
                            <thead>
                                <tr>
                                    <td valign="top" >#</td>
                                    <td valign="top" >Ejecutor</td>
                                    <td valign="top" >Fecha Atencion</td>
                                    <td valign="top" >Dias de Antiguedad</td>
                                    <td valign="top" >Rut</td>
                                    <td valign="top" >Ciudadano</td>
                                    <td valign="top" >Folio Rsh</td>
                                    <td valign="top" >Numero Solicitud</td>
                                    <td valign="top" >Consulta</td>
                                    <td valign="top" >Accion</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $impresos=0;
                                $id_paso = 0;
                                foreach($datos as $dato)
                                {
                                    $impresos++;
                                    if ($id_paso <> $dato->id )
                                    {
                                        $id_paso = $dato->id;
                                        ?>
                                        <tr>
                                            <td valign="top" > <?php echo $dato->id?>                            </td>
                                            <td valign="top" > <?php echo $dato->nom_usr.' '.$dato->ape_usr?>    </td>
                                            <td valign="top" > <?php echo $dato->fate ?>                         </td>
                                            <td valign="top" > <?php echo $dato->Fecha_Dif.' Dias'?>             </td>
                                            <td valign="top" > <?php echo $dato->rut_per?>                       </td>
                                            <td valign="top" > <?php echo $dato->nom_per.' '.$dato->ape_per?>    </td>
                                            <td valign="top" > <?php echo $dato->Folio_Rsh?>                     </td>
                                            <td valign="top" > <?php echo $dato->Numero_Solicitud?>              </td>
                                            <td valign="top" > <?php echo $dato->nom_con?>                       </td>
                                            <td>
                                                <?php if ( $dato->est_con == "1" ) {
                                                } else { ?>
                                                    <a href="Revisa_Atencion.php?id=<?php echo $dato->ate_id;?>&Atencion_Id=<?php echo $dato->id;?>&Usuario_Id=<?php echo $_SESSION["id_usuario"];?>&Aprueba=S" title="Arueba">
                                                        <button type='button' class="btn btn-info" data-toggle="modal" >
                                                            <span class="glyphicon glyphicon-ok" ></span> 
                                                        </button>   
                                                    </a>
                                                    <!-- <a href="Revisa_Atencion.php?id=<?php echo $dato->ate_id;?>&Aprueba=N" title="Rechaza"> -->
                                                    <a href="Revisa_Atencion.php?id=<?php echo $dato->ate_id;?>&Atencion_Id=<?php echo $dato->id;?>&Usuario_Id=<?php echo $_SESSION["id_usuario"];?>&Aprueba=N" title="Rechaza">
                                                        <button type='button' class="btn btn-info" data-toggle="modal" >
                                                            <span class="glyphicon glyphicon-remove" ></span> 
                                                        </button>   
                                                    </a>
                                                <?php } ?>
                                            </td> 
                                        </tr>
                                        <?php
                                    } else { ?>
                                        </tr>
                                            <td valign="top" ></td> <td valign="top" ></td>
                                            <td valign="top" ></td> <td valign="top" ></td>
                                            <td valign="top" ></td> <td valign="top" ></td>
                                            <td valign="top" ></td> <td valign="top" ></td>
                                            <td valign="top" ><?php echo $dato->nom_con?></td>
                                            <td>
                                            <?php 
                                                if ( $dato->est_con == "1" ) {
                                                } else { ?>
                                                    <a href="Revisa_Atencion.php?id=<?php echo $dato->id;?>&Aprueba=S" title="Consultar Historia">
                                                        <button type='button' class="btn btn-info" data-toggle="modal" >
                                                            <span class="glyphicon glyphicon-ok" ></span> 
                                                        </button>   
                                                    </a>        
                                                    <a href="Revisa_Atencion.php?id=<?php echo $dato->ate_id;?>&Atencion_Id=<?php echo $dato->id;?>&Usuario_Id=<?php echo $_SESSION["id_usuario"];?>&Aprueba=N" title="Rechaza">
                                                        <button type='button' class="btn btn-info" data-toggle="modal" >
                                                            <span class="glyphicon glyphicon-remove" ></span> 
                                                        </button>   
                                                    </a>
                                            <?php } ?>
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
                                                <li><a href="Revisa_Atencion.php">&#60;&#60;&#60;&#60;</a></li>
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
                                                    <li><a href="Revisa_Atencion.php?pagina=<?php echo $anterior?>">&#60;&#60;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                $contador = 0;
                                                for($i=1;$i<=$total_paginas;$i++)
                                                {
                                                    if ( $i < 10 ) {
                                                    ?>
                                                    <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Revisa_Atencion.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
                                                    <?php
                                                    } else {
                                                    if ( $i > ($total_paginas - 3) ) {
                                                        ?>
                                                            <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Revisa_Atencion.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
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
                                                    <li><a href="Revisa_Atencion.php?pagina=<?php echo $proximo?>">&#62;&#62;</a></li>
                                                    <?php
                                                }else
                                                {
                                                    ?>
                                                    <li class="disabled"><a href="javascript:void(0);">&#62;&#62;</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <li><a href="Revisa_Atencion.php?pagina=<?php echo $total_paginas?>">&#62;&#62;&#62;&#62;</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php Include("../Include/footer.php");?>
</html>