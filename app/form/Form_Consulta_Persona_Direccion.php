        <div class="box-panta">
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ciudadanos (<?php echo $todos[0]->cuantos?> en total)</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-inline" accept-charset="UTF-8" action="Personas.php"  method="post">
                                <div class="form-group">

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nombre"  placeholder="Nombre">
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="apellido"  placeholder="Apellido">
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="rut"  placeholder="Rut">
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </form>
                            <table class="table   table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td valign="top" >#        </td>
                                        <td valign="top" >Rut      </td>
                                        <td valign="top" >Nombre   </td>
                                        <td valign="top" >Telefono </td>
                                        
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
                                            <td valign="top" ><?php echo $dato->Rut?></td>
                                            <td valign="top" ><?php echo $dato->Nombre.' '.$dato->Apellido?></td>
                                            <td valign="top" ><?php echo $dato->Telefono?></td>
                                            <td>
                                                
                                                <a href="Personas.php?Rut_Persona=<?php echo $dato->Rut;?>" title="Actualiza Direccion">
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
                                                                <a href="Personas.php?pagina=<?php echo $i;?>"><?php echo $i?></a></li>
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