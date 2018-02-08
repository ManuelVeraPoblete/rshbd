<form  class="form-horizontal" name="form_llamado" id="form_llamado" action="" accept-charset="UTF-8" method="post"  onsubmit="return valida_ing_llamado()" novalidate>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <?php
                    require_once("include/Despliega_Datos_Personas.php")              ;
                ?>
            </div>
            <div class="tab-pane fade" id="Ide_Respuesta">
                <div class="container" ng-controller="PhoneCtrl">
                    <div class="col-md-11">
                        <div class="form-group">
                            <textarea class="form-control" 
                                      name="Respuesta" 
                                      type="textarea" 
                                      id="message" 
                                      placeholder="Respuesta" 
                                      maxlength="600" 
                                      rows="10" style="width: 85%;">
                            </textarea>

                        </div>
                    </div>
                    <input type="hidden" name="Grabar" value="Grabar_Si_Existe">
                    <input type="hidden" name="id_usuario_act" value="<?php echo $id_usuario_act;?>">
                    <input type="hidden" name="id_persona_act" value="<?php echo $datos_per[0]["id"];?>">
                    <div class="col-md-11" >
                        <ul class="list-group">
                            <li class="list-group-item">
                                <button class="form-control btn btn-primary" type="button submit"  >Grabar</button>   
                            </li>
                        </ul>
                        <table class='table table-striped table-condensed'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha Lamado</th>
                                    <th>Usuario</th>
                                    <th>Ciudadano</th>
                                    <th>Respuesta</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $consu = new llamados();
                            $consulta=$consu->get_llamados_por_id($datos_per[0]["id"]);
                            for($i=0;$i<sizeof($consulta);$i++)
                            { ?>
                                <tr> 
                                    <td><?php echo $consulta[$i]["id"];?></td>
                                    <td><?php echo $consulta[$i]["Fecha_Llamado"];?></td>
                                    <td><?php echo $consulta[$i]["nom_usr"].' '.$consulta[$i]["ape_usr"];?></td>
                                    <td><?php echo $consulta[$i]["nom_per"].' '.$consulta[$i]["ape_per"];?></td>
                                    <td><?php echo $consulta[$i]["Respuesta"];?></td>
                                </tr>
                                <?php 
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</form>
