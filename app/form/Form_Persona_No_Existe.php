<form  class="form-horizontal" name="form_atencion" id="form_atencion" action="" accept-charset="UTF-8" method="post"  onsubmit="return valida_ing_atencion()" novalidate>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <div class="container" ng-controller="PhoneCtrl">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="name">Rut:</label>
                        <div class="col-md-10">
                            <input type="text"  class="form-control" name="Rut"  value=<?php echo $_POST["Rut_Ciudadano"] ;?> id="name" disabled placeholder="Ingrese Rut Ciudadano" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="phone">Nombre:</label>
                        <div class="col-lg-10">
                            <input type="text"  class="form-control" name="Nombre"   placeholder="Ingrese Nombre Ciudadano" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Apellidos:</label>
                        <div class="col-lg-10">
                            <input type="text"  class="form-control" name="Apellido"  placeholder="Ingrese Apellidos">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Telefono:</label>
                        <div class="col-md-10">
                            <input type="text"  class="form-control" name="Telefono"  placeholder="Numero de Telefono">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Unidad Vecinal:</label>
                        <div class="col-md-10">
                            <select name="Unidad_Id" class="form-control">
                            <?php
                            $unif=new Unidad();
                            $uni=$unif->get_unidades();
                            for($i=0;$i<sizeof($uni);$i++)
                            {
                                ?>
                                <option  value="<?php echo $uni[$i]["id"];?>"><?php echo $uni[$i]["Unidad"];?></option>
                                <?php 
                            }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Poblacion:</label>
                        <div class="col-md-10">
                            <select name="Poblacion_Id" class="form-control">
                            <?php
                            $pobla=new Poblacion();
                            $pob=$pobla->get_poblaciones();
                            for($i=0;$i<sizeof($pob);$i++)
                            {
                                ?>
                                <option  value="<?php echo $pob[$i]["id"];?>"><?php echo $pob[$i]["Poblacion"];?></option>
                                <?php 
                            }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Calle:</label>
                        <div class="col-md-10">
                            <select name="Calle_Id" class="form-control">
                            <?php
                            $calle=new Calle();
                            $cal=$calle->get_calles();
                            for($i=0;$i<sizeof($cal);$i++)
                            {
                                ?>
                                <option  value="<?php echo $cal[$i]["id"];?>"><?php echo $cal[$i]["Calle"];?></option>
                                <?php 
                            }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Numero:</label>
                        <div class="col-md-10">
                            <input type='text' name='Numero' class='form-control'  required  placeholder="Numero ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Block:</label>
                        <div class="col-md-10">
                            <td><input type='text' name='Block'  class='form-control'  required  placeholder="Numero de Block"></td>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Departamento:</label>
                        <div class="col-md-10">
                            <input type='text' name='Departamento'  class='form-control'  required  placeholder="Numero de Departamento">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Casa:</label>
                        <div class="col-md-10">
                            <input type='text' name='Casa' class='form-control'  required  placeholder="Numero de Casa">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="phone">Referencia:</label>
                        <div class="col-lg-10">
                            <input type="text"  class="form-control" name="Observacion"   placeholder="Ingrese Referencia Direccion" >
                        </div>
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
                            <input type="date" class="form-control" name="Fecha_Atencion" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Atencion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Hora de Atencion:</label>
                        <div class="col-md-10">
                            <input type="time" class="form-control" name="Hora_Atencion" value="<?php echo date("H:i",time());?>" placeholder="Hora de Atencion">
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
                                                <input id="<?php echo 'con'.$i ;?>" value="<?php echo $con[$i]["id"];?>" name="consulta" type="checkbox"/>
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
                                                    <input id="<?php echo 'prg'.$i ;?>" value="<?php echo $prg[$i]["id"];?>" name="programa" type="checkbox"/>
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
                                            <input id="<?php echo 'docu'.$i ;?>" value="<?php echo $docu[$i]["id"];?>" name="documento" type="checkbox"/>
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
                                    <input onclick=aviso(this.value) id="cerrar"  name="cierra" type="checkbox"/>
                                    <label for="cerrar" class="label-success"></label>
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
                                <button class="form-control btn btn-primary" type="button submit"  >Grabar</button>   
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>