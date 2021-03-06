<form  class="form-horizontal" name="form_nueva_atencion" id="form_nueva_atencion" action="Atenciones.php" accept-charset="UTF-8" method="post"   novalidate>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Requerimiento">
                <div class="col-md-5">
                    <div class="box-blue">
                        <h4>Destalle Lote</h4>
                        <div class="box-green">
                            <form class="col-md-5">
                                <h3> Numero de Lote :           <?php echo $datos_req[0]["Numero_Lote"]     ?> </h3>
                                <h3> Fecha de Generacion Lote : <?php echo $datos_req[0]["Fecha_Lote"]      ?> </h3>
                                <h3> Fecha de Recepcion:        <?php echo $datos_req[0]["Fecha_Detalle"]   ?> </h3>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="box-blue">
                        <?php 
                             $Ate_Dat = new Atencion();
                             $datos_ate = $Ate_Dat-> get_atencion_por_id($datos_req[0]["Atencion_Id"]);

                             $Per_Dat = new Persona();
                             $datos_per = $Per_Dat->get_persona_por_id($datos_ate[0]["Persona_Id"] );
                        ?>
                        <h4>Detalle de Atencion</h4>
                        <div class="box-green">
                            <ul class="list-group">
                                <li class="list-group-item"> Rut</li>
                                <li class="list-group-item"> Solicitante</li>
                                <li class="list-group-item"> Fecha de Atencion</li>
                                <li class="list-group-item"> Requerimiento</li>
                                <li class="list-group-item"> Consulta</li>
                            </ul>
                            <h5> Rut : <?php echo $datos_per[0]["Rut"];?></h5>
                            <h5> Solicitante : <?php echo $datos_per[0]["Nombre"].' '.$datos_per[0]["Apellido"] ;?> </h5>
                            <h5> Fecha Atencion : <?php echo $datos_ate[0]["Fecha_Atencion"];?></h5>
                            <h5> Requerimiento : <?php echo $datos_ate[0]["Consulta"];?></h5>
                            <h5> Consulta      : <?php echo $datos_ate[0]["Consulta"];?></h5>
                            
                        </div>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade" id="Ide_Atencion">
                <div class="container" ng-controller="PhoneCtrl">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="name">Numero Registro:</label>
                        <div class="col-lg-10">
                            <input  type="text" 
                                    class="form-control" 
                                    name="Folio_Rsh" 
                                    placeholder="Ingrese Numero de Registro" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="phone">Numero de Requerimiento:</label>
                        <div class="col-lg-10">
                            <input  type="text" 
                                    class="form-control" 
                                    name="Numero_Solicitud"  
                                    id="Numero_Solicitud"
                                    placeholder="Ingrese Numero de Requerimiento" 
                                    onblur='BuscaRequerimiento(this)'>
                            <span>
                                     <strong><div id="Info"></div></strong>
                                     </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Fecha de Atencion:</label>
                        <div class="col-md-10">
                            <input  type="date" 
                                    class="form-control" 
                                    name="Fecha_Atencion" 
                                    value="<?php echo date("Y-m-d");?>" 
                                    placeholder="Fecha de Atencion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Hora de Atencion:</label>
                        <div class="col-md-10">
                            <input  type="time" 
                                    class="form-control" 
                                    name="Hora_Atencion" 
                                    value="<?php echo date("H:i",time());?>" 
                                    placeholder="Hora de Atencion">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="Ide_Motivo">
                <div class="col-lg-8 ">
                    <div class="panel panel-primary col-lt-3">
                        <div class="panel-heading">
                            <h1 class="panel-title"> 
                                <a href="#Requerimiento_1" data-toggle="tab"><button type="button" class="btn btn-info"><strong>Ingreso al Registro</strong></button> </a>
                                <a href="#Requerimiento_2" data-toggle="tab"><button type="button" class="btn btn-info"><strong>Act. Datos Administrativos</strong></button></a>
                                <a href="#Requerimiento_3" data-toggle="tab"><button type="button" class="btn btn-info"><strong>Act. Formulario</strong></button></a>
                                <a href="#Requerimiento_4" data-toggle="tab"><button type="button" class="btn btn-info"><strong>Reqtificacion</strong></button></a>
                                <a href="#Requerimiento_5" data-toggle="tab"><button type="button" class="btn btn-info"><strong>Complemento</strong></button></a>
                                <a href="#Requerimiento_6" data-toggle="tab"><button type="button" class="btn btn-info"><strong>Otros Rquerimientos</strong></button></a>
                            </h1>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="Requerimiento_1">
                                    <?php
                                    for($i=0;$i<sizeof($ArrayConsulta);$i++)
                                        {
                                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 1)
                                            {
                                                ?>
                                                    <li class="list-group-item">
                                                        <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                                        <div class="material-switch pull-right">
                                                            <?php
                                                            if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                                            {  ?>
                                                                <input id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox"  
                                                                        onclik="CambiaEstado()"
                                                                />
                                                            <?php
                                                            } else { ?>
                                                                <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" 
                                                                        onclik="CambiaEstado()"
                                                                        checked
                                                                />
                                                                <?php } ?>
                                                            <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                                        </div>
                                                    </li>
                                                <?php 
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="tab-pane" id="Requerimiento_2">
                                    <?php
                                    for($i=0;$i<sizeof($ArrayConsulta);$i++)
                                        {
                                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 2)
                                            {
                                                ?>
                                                    <li class="list-group-item">
                                                        <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                                        <div class="material-switch pull-right">
                                                            <?php
                                                            if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                                            {  ?>
                                                                <input id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" />
                                                            <?php
                                                            } else { ?>
                                                                <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" 
                                                                        checked/>
                                                                <?php } ?>
                                                            <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                                        </div>
                                                    </li>
                                                <?php 
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="tab-pane" id="Requerimiento_3">
                                    <?php
                                    for($i=0;$i<sizeof($ArrayConsulta);$i++)
                                        {
                                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 3)
                                            {
                                                ?>
                                                    <li class="list-group-item">
                                                        <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                                        <div class="material-switch pull-right">
                                                            <?php
                                                            if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                                            {  ?>
                                                                <input id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" />
                                                            <?php
                                                            } else { ?>
                                                                <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" 
                                                                        checked/>
                                                                <?php } ?>
                                                            <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                                        </div>
                                                    </li>
                                                <?php 
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="tab-pane" id="Requerimiento_4">
                                    <?php
                                    for($i=0;$i<sizeof($ArrayConsulta);$i++)
                                        {
                                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 4)
                                            {
                                                ?>
                                                    <li class="list-group-item">
                                                        <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                                        <div class="material-switch pull-right">
                                                            <?php
                                                            if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                                            {  ?>
                                                                <input id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" />
                                                            <?php
                                                            } else { ?>
                                                                <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" 
                                                                        checked/>
                                                                <?php } ?>
                                                            <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                                        </div>
                                                    </li>
                                                <?php 
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="tab-pane" id="Requerimiento_5">
                                    <?php
                                    for($i=0;$i<sizeof($ArrayConsulta);$i++)
                                        {
                                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 5)
                                            {
                                                ?>
                                                    <li class="list-group-item">
                                                        <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                                        <div class="material-switch pull-right">
                                                            <?php
                                                            if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                                            {  ?>
                                                                <input id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" />
                                                            <?php
                                                            } else { ?>
                                                                <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" 
                                                                        checked/>
                                                                <?php } ?>
                                                            <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                                        </div>
                                                    </li>
                                                <?php 
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="tab-pane" id="Requerimiento_6">
                                    <?php
                                    for($i=0;$i<sizeof($ArrayConsulta);$i++)
                                        {
                                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 6)
                                            {
                                                ?>
                                                    <li class="list-group-item">
                                                        <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                                        <div class="material-switch pull-right">
                                                            <?php
                                                            if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                                            {  ?>
                                                                <input id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" />
                                                            <?php
                                                            } else { ?>
                                                                <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" 
                                                                        checked/>
                                                                <?php } ?>
                                                            <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                                        </div>
                                                    </li>
                                                <?php 
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
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
                                    <input onclick=aviso(this.value) id="cerrar"  name="Cierra" type="checkbox"/>
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
                    <input type="hidden" name="Grabar_Nueva"    value="Grabar_Si">
                    <input type="hidden" name="Rut"             value="<?php echo $datos_per[0]["Rut"];?>">
                    <input type="hidden" name="id"              value="<?php echo $datos_per[0]["id"];?>">
                    <input type="hidden" name="id_usuario_act"  value="<?php echo $id_usuario_act;?>">
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
    </div>
</form>