<form class="form-horizontal" name="form_atencion" accept-charset="UTF-8" action="Atenciones.php"  method="post">
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <div class="container" ng-controller="PhoneCtrl">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="name">Rut:</label>
                        <div class="col-md-10">
                            <input type="text" disabled class="form-control" name="Rut" value="<?php echo $datos_per[0]["Rut"];?>" id="name" placeholder="Ingrese Rut Ciudadano" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="phone">Nombre:</label>
                        <div class="col-lg-10">
                            <input type="text" disabled class="form-control" name="Nombre" value="<?php echo $datos_per[0]["Nombre"];?>"  placeholder="Ingrese Nombre Ciudadano" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Apellidos:</label>
                        <div class="col-lg-10">
                            <input type="email" disabled class="form-control" name="Apellido" value="<?php echo $datos_per[0]["Apellido"];?>" placeholder="Ingrese Apellidos">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Telefono:</label>
                        <div class="col-md-10">
                            <input type="email" disabled class="form-control" name="Telefono" value="<?php echo $datos_per[0]["Telefono"];?>" placeholder="Ingrese Apellidos">
                        </div>
                    </div>
                    <div class="panel panel-primary filterable">
                        <div class="panel-heading">
                            <h3 class="panel-title">Direcciones</h3>      
                        </div>
                        <table class="table">
                            <thead>
                                <tr class="filters">
                                    <th>#</th>
                                    <th>Unidad</th>
                                    <th>Poblacion</th>
                                    <th>Calle</th>
                                    <th>Numero</th>
                                    <th>Block</th>
                                    <th>Departamento</th>
                                    <th>Casa</th>
                                    <th>Observacion</th>
                                    <th>Activo</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $direc=new Direccion();
                                    $dir=$direc->get_direccion($datos_per[0]["id"]);
                                    for($i=0;$i<sizeof($dir);$i++)
                                    {
                                    ?>
                                    <tr>
                                        <td valign="top" ><?php echo $dir[$i]["id"]?></td>                                            
                                        <td valign="top" ><?php echo $dir[$i]["Nom_Unidad"]?></td>
                                        <td valign="top" ><?php echo $dir[$i]["Nom_Poblacion"]?></td>
                                        <td valign="top" ><?php echo $dir[$i]["Nom_Calle"]?></td>
                                        <td valign="top" ><?php echo $dir[$i]["Numero"]?></td>
                                        <td valign="top" ><?php echo $dir[$i]["Block"]?></td>
                                        <td valign="top" ><?php echo $dir[$i]["Departamento"]?></td>
                                        <td valign="top" ><?php echo $dir[$i]["Casa"]?></td>
                                        <td valign="top" ><?php echo $dir[$i]["Observacion"]?></td>
                                        <?php 
                                        if ( $dir[$i]["Activa"] == '1' ) { ?>
                                            <td valign="top" >Activo</td>
                                            <td valign="top" ><?php echo $dir[$i]["Fecha"]?></td>    
                                        <?php } else { ?>
                                            <td valign="top" >Inactiva</td>
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
            </div>
            <div class="tab-pane fade" id="Ide_Atencion">
                <div class="container" ng-controller="PhoneCtrl">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="name">Folio RSH:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="Folio_Rsh" id="name" placeholder="Ingrese Folio RSH" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="phone">Numero de Solicitud:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="Numero_Solicitud"  placeholder="Ingrese Numero de Solicitud" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Fecha de Atencion:</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="Fecha_Atencion" placeholder="Fecha de Atencion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Hora de Atencion:</label>
                        <div class="col-md-10">
                            <input type="time" class="form-control" name="Hora_Atencion" placeholder="Hora de Atencion">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="Ide_Motivo">
                <div class="container" ng-controller="PhoneCtrl">
                    <div class="form-group">
                        <label class="control-label col-md-2"> Consultas:</label>
                        <div class="col-md-10">
                            <ul class="list-group">
                                <?php
                                    $consu=new Consulta();
                                    $con=$consu->get_consultas();
                                    for($i=0;$i<sizeof($con);$i++)
                                    { ?>
                                        <li class="list-group-item">
                                            <?php echo $con[$i]["Consulta"];?>
                                            <div class="material-switch pull-right">
                                                <input id="<?php echo 'con'.$i ;?>" value="<?php echo $con[$i]["id"];?>" name="consulta[]" type="checkbox"/>
                                                <label for="<?php echo 'con'.$i ;?>" class="label-success"></label>
                                            </div>
                                        </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <label class="control-label col-lg-2"> Programas:</label>
                        <div class="col-md-10">
                            <div class="panel panel-default">
                                <ul class="list-group">
                                    <?php
                                        $prog=new Programa();
                                        $prg=$prog->get_programas();
                                        for($i=0;$i<sizeof($prg);$i++)
                                        {
                                            ?>
                                            <li class="list-group-item">
                                                <?php echo $prg[$i]["Programa"];?>
                                                <div class="material-switch pull-right">
                                                    <input id="<?php echo 'prg'.$i ;?>" value="<?php echo $prg[$i]["id"];?>" name="programa[]" type="checkbox"/>
                                                    <label for="<?php echo 'prg'.$i ;?>" class="label-success"></label>
                                                </div>
                                            </li>
                                    <?php } ?>
                                </ul>
                            </div>         
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="Obs_Cierre">
                <div class="form-group">
                    <label class="control-label col-lg-2"> Documentos Faltantes:</label>
                    <div class="col-md-10">
                        <ul class="list-group">
                            <?php
                                $docum=new Documento();
                                $docu=$docum->get_documentos();
                                for($i=0;$i<sizeof($docu);$i++)
                                { ?>
                                    <li class="list-group-item">
                                        <?php echo $docu[$i]["Documento"];?>
                                        <div class="material-switch pull-right">
                                            <input id="<?php echo 'docu'.$i ;?>" value="<?php echo $docu[$i]["id"];?>" name="documento[]" type="checkbox"/>
                                            <label for="<?php echo 'docu'.$i ;?>" class="label-success"></label>
                                        </div>
                                    </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <textarea class="form-control" name="Observacion" type="textarea" id="message" placeholder="Observaciones" maxlength="140" rows="7"></textarea>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <ul class="list-group">
                            <li class="list-group-item">
                                Cierra Atencion
                                <div class="material-switch pull-right">
                                    <input id="Cerrar"  name="Cierra" type="checkbox"/>
                                    <label for="Cerrar" class="label-success"></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <ul class="list-group">
                            <li class="list-group-item">
                                Proxima Visita
                                <input type="date" class="form-control" name="Proxima_Visita" placeholder="Fecha Proxima Visita">
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <ul class="list-group">
                                <li class="list-group-item">
                                <button class="form-control btn btn-primary" onclick="valida_ing_atencion()">Grabar</button>   
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>