        <div class="box-panta">
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Atenciones (<?php echo $todos[0]->cuantos?> en total)</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-inline" accept-charset="UTF-8" action="Personas.php"  method="post">
                                <div class="form-group">
                                    <label class="control-label col-lg-2" for="email">Fecha desde:</label>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" name="Fecha_Desde" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Atencion">
                                    </div>
                                    <label class="control-label col-lg-2" for="email">Fecha Hasta:</label>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" name="Fecha_Hasta" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Atencion">
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
                                        <td valign="top" >Folio Rsh</td>
                                        <td valign="top" >Numero Solicitud</td>
                                        <td valign="top" >Estado Atencion</td>
                                        <td valign="top" >Estado Revisora</td>
                                        <td valign="top" >Consulta</td>
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
                                            <td valign="top" ><?php echo $dato_->id?></td>
                                            <td valign="top" ><?php echo $dato_->Nombre.' '.$datos->Apellido?></td>
                                            <td valign="top" ><?php echo $dato_->Fecha_Atencion?></td>
                                            <td valign="top" ><?php echo $dato_->Folio_Rsh?></td>
                                            <td valign="top" ><?php echo $dato_->Numero_Solicitud?></td>
                                            <?php 
                                            if ( $dato->Estado_Atencion == 2 ) { ?>
                                                <td>Cerrada</td> <?php
                                            } else { ?>
                                                <td><a href="#" data-toggle="tab" class="btn btn-danger btn-xs ">Pendiente</a></td> <?php
                                                $pendientes = "S";
                                            } ?>
                                            <?php 
                                            if ( $dato->Estado_Revisora == 2 ) { ?>
                                                <td>Aprobada</td> <?php
                                            } else { ?>
                                                <td>Pendiente</td> <?php
                                            } ?>
                                            <td><?php echo $dato->Consulta;?></td>
                                            <td>
                                                <a href="AddDireccion.php?id=<?php echo $dato->id;?>" title="Cambia Estado">
                                                    <button type='button' class="btn btn-info" data-toggle="modal" >
                                                        <span class="glyphicon glyphicon-home" ></span> 
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
                                                    <li><a href="Personas.php">&#60;&#60;&#60;&#60;</a></li>
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
                                                        <li><a href="Personas.php?pagina=<?php echo $anterior?>">&#60;&#60;</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $contador = 0;
                                                    for($i=1;$i<=$total_paginas;$i++)
                                                    {
                                                        if ( $i < 10 ) {
                                                        ?>
                                                        <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Personas.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
                                                        <?php
                                                        } else {
                                                        if ( $i > ($total_paginas - 3) ) {
                                                            ?>
                                                                <li <?php if($pagina==$i){echo 'class="active"';}?>><a href="Personas.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
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
                                                        <li><a href="Personas.php?pagina=<?php echo $proximo?>">&#62;&#62;</a></li>
                                                        <?php
                                                    }else
                                                    {
                                                        ?>
                                                        <li class="disabled"><a href="javascript:void(0);">&#62;&#62;</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <li><a href="Personas.php?pagina=<?php echo $total_paginas?>">&#62;&#62;&#62;&#62;</a></li>
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