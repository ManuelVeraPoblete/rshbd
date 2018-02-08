<form  class="form-horizontal" name="muestra" method="post" id="muestra" accept-charset="UTF-8">
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <div class="form-group">
                    <label class="control-label col-lg-2" for="name">Rut:</label>
                    <div class="col-md-10">
                        <input type="text" disabled class="form-control" name="Rut" value="<?php echo $datos[0]["Rut"];?>" id="name" placeholder="Ingrese Rut Ciudadano">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2" for="email">Nombre:</label>
                    <div class="col-lg-10">
                        <input type="email" disabled class="form-control" name="Nombre" value="<?php echo $datos[0]["Nombre"];?>" placeholder="Ingrese Nombres">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2" for="email">Apellidos:</label>
                    <div class="col-lg-10">
                        <input type="email" disabled class="form-control" name="Apellido" value="<?php echo $datos[0]["Apellido"];?>" placeholder="Ingrese Apellidos">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2" for="email">Telefono:</label>
                    <div class="col-md-10">
                        <input type="email" disabled class="form-control" name="Telefono" value="<?php echo $datos[0]["Telefono"];?>" placeholder="Ingrese Apellidos">
                    </div>
                </div>
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">Direcciones</h3>      
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="filters">
                                <th>#                   </th>
                                <th>Unidad              </th>
                                <th>Poblacion           </th>
                                <th>Calle               </th>
                                <th>Numero              </th>
                                <th>Block               </th>
                                <th>Departamento        </th>
                                <th>Casa                </th>
                                <th>Observacion         </th>
                                <th>Activo              </th>
                                <th>Fecha               </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $id_persona = $datos[0]["id"];
                                $direc=new Direccion();
                                $dir=$direc->get_direccion($datos[0]["id"]);
                                for($i=0;$i<sizeof($dir);$i++)
                                {
                                ?>
                                <tr>
                                    <td valign="top" >      <?php echo $dir[$i]["id"]             ?>        </td>
                                    <td valign="top" >      <?php echo $dir[$i]["Nom_Unidad"]     ?>        </td>
                                    <td valign="top" >      <?php echo $dir[$i]["Nom_Poblacion"]  ?>        </td>
                                    <td valign="top" >      <?php echo $dir[$i]["Nom_Calle"]      ?>        </td>
                                    <td valign="top" >      <?php echo $dir[$i]["Numero"]         ?>        </td>
                                    <td valign="top" >      <?php echo $dir[$i]["Block"]          ?>        </td>
                                    <td valign="top" >      <?php echo $dir[$i]["Departamento"]   ?>        </td>
                                    <td valign="top" >      <?php echo $dir[$i]["Casa"]           ?>        </td>
                                    <td valign="top" >      <?php echo $dir[$i]["Observacion"]    ?>        </td>
                                    <?php 
                                    if ( $dir[$i]["Activa"] == '1' ) { ?>
                                        <td valign="top" >Activo                        </td>
                                        <td valign="top" ><?php echo $dir[$i]["Fecha"]?></td>    
                                    <?php } else { ?>
                                        <td valign="top" >Inactiva                      </td>
                                        <td valign="top" ><?php echo $dir[$i]["Fecha"]?></td>
                                    <?php }  ?>
                                </tr>
                                    <?php 
                                }?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="Ide_Atencion">
                <div class="panel panel-primary filterable">
                    <div class="panel-titulo">
                        <h3 class="panel-title">Atenciones Realizadas</h3>      
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="filters">
                                <th>#                   </th>
                                <th>Ejecutor            </th>
                                <th>Fecha Atencion      </th>
                                <th>Folio Rsh           </th>
                                <th>Numero Solicitud    </th>
                                <th>Estado Atencion     </th>
                                <th>Estado Revisora     </th>
                                <th>Consulta            </th>
                                <th>Accion              </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = $id_persona;
                            $ate=new Atencion(); 
                            $datos_ate=$ate->get_atencion_por_persona($id);
                            $paso_atencion = 0;
                            $arreglo_detalle[][] = array();
                            $ind_contenido=-1;
                            for($i=0;$i<sizeof($datos_ate);$i++)
                            {
                                if ($paso_atencion  != $datos_ate[$i]["id"] ) 
                                {
                                    $paso_atencion  = $datos_ate[$i]["id"]
                                    ?>
                                    <tr>
                                        <?php
                                            $ind_contenido++;
                                            $paso =  $datos_ate[$i]["id"]; 
                                            $arreglo_detalle[$ind_contenido][0] = $datos_ate[$i]["id"]; 
                                            $arreglo_detalle[$ind_contenido][1] = 0;
                                        ?>
                                        <td><?php echo $datos_ate[$i]["id"];?>                                      </td>
                                        <td><?php echo $datos_ate[$i]["Nombre"].' '.$datos_ate[$i]["Apellido"];?>   </td>
                                        <td><?php echo $datos_ate[$i]["Fecha_Atencion"];?>                          </td>
                                        <td><?php echo $datos_ate[$i]["Folio_Rsh"];?>                               </td>
                                        <td><?php echo $datos_ate[$i]["Numero_Solicitud"];?>                        </td>
                                        <?php 
                                        if ( $datos_ate[$i]["Estado_Atencion"] == 2 ) { ?>
                                            <td>Cerrada</td> <?php
                                        } else { ?>
                                            <td><a href="Atenciones.php" data-toggle="tab" class="btn btn-danger btn-xs ">Pendiente</a></td> 
                                            <?php

                                        } ?>
                                        <td> <?php echo $datos_ate[$i]["est_revi"] ; ?> </td>
                                        <td> <?php echo $datos_ate[$i]["Consulta"] ; ?> </td>
                                        <td>
                                            <?php
                                                echo "<select class='form-control' name='arreglo_detalle[$ind_contenido][1]'>";
                                            ?>

                                            <option  value='0'>Escojer Estado Revisora</option>
                                            <?php
                                            $est_revi=new Estado();
                                            $datos_rev=$est_revi->get_estados();
                                            for($j=0;$j<sizeof($datos_rev);$j++)
                                            {
                                                if ($datos_rev[$j]["id"] < 3 ) {
                                                    ?>
                                                    <option  value="<?php echo $datos_rev[$j]["id"];?>"><?php echo $datos_rev[$j]["Estado_Atencion"];?></option>
                                                    <?php 
                                                }
                                            }?>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php 
                                } else { ?>
                                    <tr> 
                                        <?php 
                                            for ($j=0; $j < 7 ; $j++) { 
                                                echo "<td></td>";
                                            }
                                        ?>
                                        <td><?php echo $datos_ate[$i]["Consulta"];?></td>
                                    </tr> <?php
                                }
                            }?>
                        </tbody>
                    </table>
                </div>
                
                <?php echo "<input type='hidden' name='datos_estado' value=".serialize($arreglo_detalle).">"; ?>
                <input type="hidden" name="Cambia_Atencion" value="Grabar_Si">
                <div class="col-md-10">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <button class="form-control btn btn-primary" type="button submit">Grabar</button>   
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>