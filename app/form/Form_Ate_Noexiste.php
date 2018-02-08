<form  class="form-horizontal" name="form_atencion" id="form_atencion" action="" accept-charset="UTF-8" method="post"  onsubmit="return valida_ing_atencion()" validate>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <div class="container" ng-controller="PhoneCtrl">
                     <?php require_once("form/Form_Persona_Existe.php");?>
                </div>
            </div>
            <div class="tab-pane fade" id="Ide_Atencion">
                <div class="container" ng-controller="PhoneCtrl">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="name">Folio RSH:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="Rut" id="name" placeholder="Ingrese Folio RSH" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="phone">Numero de Solicitud:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="Nombre"  placeholder="Ingrese Numero de Solicitud" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Fecha de Atencion:</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="Apellido" placeholder="Fecha de Atencion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Hora de Atencion:</label>
                        <div class="col-md-10">
                            <input type="time" class="form-control" name="Apellido" placeholder="Hora de Atencion">
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
                    <label class="control-label col-lg-2"> Programas:</label>
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
                            <textarea class="form-control" type="textarea" id="message" placeholder="Observaciones" maxlength="140" rows="7"></textarea>
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
                                <input type="date" class="form-control" name="Apellido" placeholder="Fecha Proxima Visita">
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <ul class="list-group">
                                <li class="list-group-item">
                                <button class="form-control btn btn-primary">Grabar</button>   
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
