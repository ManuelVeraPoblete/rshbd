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
            </div>
            <div class="tab-pane" id="Ide_Atencion">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">Atenciones Realizadas</h3>      
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="filters">
                                <th>#</th>
                                <th>Ejecutor</th>
                                <th>Fecha Atencion</th>
                                <th>Folio Rsh</th>
                                <th>Numero Solicitud</th>
                                <th>Estado Atencion</th>
                                <th>Estado Revisora</th>
                                <th>Consulta</th>
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
                                        <td> <?php echo $datos_ate[$i]["est_revi"] ; ?> </td>
                                        <td><?php echo $datos_ate[$i]["Consulta"];?></td>
                                    </tr>
                                    <?php 
                                } else { ?>
                                    <tr> 
                                        <?php 
                                            for ($j=0; $j < 6 ; $j++) { 
                                                echo "<td></td>";
                                            }
                                        ?>
                                        <td> <?php echo $datos_ate[$i]["est_revi"] ; ?> </td>
                                        <td><?php echo $datos_ate[$i]["Consulta"];?></td>
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
                                <th>Numero Hoja de Ruta     </th>
                                <th>Encuestador             </th>
                                <th>Fecha Visita            </th>
                                <th>Respuesta               </th>
                                <th>Observacion             </th>
                                <th>Num. Solicitud          </th>
                                <th>Fecha de Atencion       </th>
                                <th>Consulta                </th>
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