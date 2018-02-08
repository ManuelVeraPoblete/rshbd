<form  class="form-horizontal" name="muestra" id="muestra" accept-charset="UTF-8"   >
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <div class="form-group">
                    <label class="control-label col-lg-2" for="name">Rut:</label>
                    <div class="col-md-10">
                        <input type="text" disabled class="form-control" name="Rut" value="<?php echo $datos[0]["Rut"];?>" id="name" placeholder="Ingrese Rut Ciudadano" >
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
                                <th>#           </th> <th>Unidad      </th>
                                <th>Poblacion   </th> <th>Calle       </th>
                                <th>Numero      </th> <th>Block       </th>
                                <th>Departamento</th> <th>Casa        </th>
                                <th>Observacion </th> <th>Activo      </th>
                                <th>Fecha       </th> 
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
                                    <td valign="top" ><?php echo $dir[$i]["id"]             ?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Nom_Unidad"]     ?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Nom_Poblacion"]  ?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Nom_Calle"]      ?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Numero"]         ?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Block"]          ?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Departamento"]   ?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Casa"]           ?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Observacion"]    ?></td>
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
                                <th>#                   </th> <th>Ejecutor            </th>
                                <th>Fecha Atencion      </th> <th>Folio Rsh           </th>
                                <th>Numero Solicitud    </th> <th>Estado Atencion     </th>
                                <th>Fecha Cierre        </th> <th>Usuario             </th>
                                <th>Consulta            </th> <th>Estado Consulta     </th>
                                <th>Revisora            </th> <th> Fecha Revision  </th>
                                <th> Atencion vs Revision  </th> <th> Cierre vs Revision </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = $id_persona;
                            $ate=new Atencion(); 
                            $datos_ate=$ate->get_atencion_por_persona($id);
                            $paso_atencion = 0;
                            for($i=0;$i<sizeof($datos_ate);$i++)
                            {
                                if ($paso_atencion  != $datos_ate[$i]["id"] ) 
                                {
                                    $paso_atencion  = $datos_ate[$i]["id"]
                                    ?>
                                    <tr> 
                                        <td><?php echo $datos_ate[$i]["id"];?>                                      </td>
                                        <td><?php echo $datos_ate[$i]["Nombre"].' '.$datos_ate[$i]["Apellido"];?>   </td>
                                        <td><?php echo $datos_ate[$i]["Fecha_Atencion"];?>                          </td>
                                        <td><?php echo $datos_ate[$i]["Folio_Rsh"];?>                               </td>
                                        <td><?php echo $datos_ate[$i]["Numero_Solicitud"];?>                        </td>
                                        <?php 
                                        if ( $datos_ate[$i]["Estado_Atencion"] == 2 ) { ?>
                                            <td>Cerrada</td> <?php
                                        } else { ?>
                                            <td><a href="Atenciones.php" data-toggle="tab" class="btn btn-danger btn-xs ">Pendiente</a></td> <?php
                                            $pendientes = "S";
                                        } ?>
                                        <td> <?php echo $datos_ate[$i]["Fecha_Cierra"] ; ?> </td>
                                        <td> <?php echo $datos_ate[$i]["Nombre_Cierra"].' '.$datos_ate[$i]["Apellido_Cierra"] ; ?> </td>
                                        <td><?php echo $datos_ate[$i]["Consulta"];?></td>
                                        <td> <?php echo $datos_ate[$i]["est_revi"] ; ?> </td>

                                        <td><?php echo $datos_ate[$i]["Nom_Apr"].' '.$datos_ate[$i]["Ape_Apr"] ;?></td>
                                        <td><?php echo $datos_ate[$i]["Fecha_Rechazo"];?></td>
                                        <?php 
                                            if ( is_null($datos_ate[$i]["dif_A_A"] )) 
                                            { ?>
                                                <td></td>
                                                <td></td>
                                            <?php
                                            } else { ?>
                                                <td><?php echo $datos_ate[$i]["dif_A_A"].' Dias';?></td>
                                                <td><?php echo $datos_ate[$i]["dif_A_C"].' Dias';?></td>
                                            <?php
                                            }
                                        ?>

                                    </tr>
                                    <?php 
                                } else { ?>
                                    <tr> 
                                        <?php 
                                            for ($j=0; $j < 8 ; $j++) { 
                                                echo "<td></td>";
                                            }
                                        ?>
                                        
                                        <td><?php echo $datos_ate[$i]["Consulta"];?></td>
                                        <td> <?php echo $datos_ate[$i]["est_revi"] ; ?> </td>
                                        <td><?php echo $datos_ate[$i]["Nom_Apr"].' '.$datos_ate[$i]["Ape_Apr"] ;?></td>
                                        <td><?php echo $datos_ate[$i]["Fecha_Rechazo"];?></td>
                                        <td><?php echo $datos_ate[$i]["dif_A_A"].' Dias';?></td>
                                        <td><?php echo $datos_ate[$i]["dif_A_C"].' Dias';?></td>
                                    </tr> <?php
                                }
                            }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="Ide_Hojas_Ruta">
                <div class="panel panel-primary filterable">
                    <div class="panel-titulo">
                        <h3 class="panel-title">Detalle de Llamados</h3>      
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="filters">
                                <th>Numero Hoja de Ruta     </th> <th>Encuestador             </th>
                                <th>Fecha Visita            </th> <th>Respuesta               </th>
                                <th>Observacion             </th> <th>Num. Solicitud          </th>
                                <th>Fecha de Atencion       </th> <th>Consulta                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    $id = $id_persona;
                                    $ate=new ActualizaAtencion(); 
                                    $datos_his=$ate->get_historico_por_persona($id);
                                    for($h=0;$h<sizeof($datos_his);$h++)
                                    { ?>
                                        <tr> 
                                            <td> <?php echo $datos_his[$h]["HC_NumHoja"];?>                                 </td>
                                            <td> <?php echo $datos_his[$h]["U_Nombre"].' '.$datos_his[$h]["U_Apellido"];?>  </td>
                                            <td> <?php echo $datos_his[$h]["HH_FechaVisita"];?>                             </td>
                                            <td> <?php echo $datos_his[$h]["R_Respuesta_Larga"];?>                          </td>
                                            <td> <?php echo $datos_his[$h]["HH_Observacion"];?>                             </td>
                                            <td> <?php echo $datos_his[$h]["A_NSolicitud"];?>                               </td>
                                            <td> <?php echo $datos_his[$h]["A_FechaAtencion"];?>                            </td>
                                            <td> <?php echo $datos_his[$h]["C_Consulta"];?>                                 </td>
                                        </tr>
                                    <?php }?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="Llamados_Telefonicos">
                <div class="panel panel-primary filterable">
                    <div class="panel-titulo">
                        <h3 class="panel-title">Detalle de Llamados</h3>      
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="filters">
                                <th>#               </th>
                                <th>Fecha Lamado    </th>
                                <th>Usuario         </th>
                                <th>Ciudadano</th>
                                <th>Respuesta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    $consu = new llamados();
                                    $consulta=$consu->get_llamados_por_id($datos[0]["id"]);
                                    for($i=0;$i<sizeof($consulta);$i++)
                                    { ?>
                                        <tr> 
                                            <td><?php echo $consulta[$i]["id"];?>                                       </td>
                                            <td><?php echo $consulta[$i]["Fecha_Llamado"];?>                            </td>
                                            <td><?php echo $consulta[$i]["nom_usr"].' '.$consulta[$i]["ape_usr"];?>     </td>
                                            <td><?php echo $consulta[$i]["nom_per"].' '.$consulta[$i]["ape_per"];?>     </td>
                                            <td><?php echo $consulta[$i]["Respuesta"];?>                                </td>
                                        </tr>
                                        <?php 
                                    }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>