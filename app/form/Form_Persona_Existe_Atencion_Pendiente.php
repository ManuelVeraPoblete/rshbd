<form  class="form-horizontal" name="form_nueva_atencion" id="form_nueva_atencion" action="Atenciones.php" accept-charset="UTF-8" method="post"  onsubmit="return valida_nueva_atencion()" novalidate>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <div class="container" ng-controller="PhoneCtrl">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="name">Rut:</label>
                        <div class="col-md-10">
                            <input  type="text" 
                                    disabled class="form-control" 
                                    name="Rut" 
                                    value="<?php echo $datos_pen[0]["Rut"];?>" 
                                    id="name" 
                                    placeholder="Ingrese Rut Ciudadano" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="phone">Nombre:</label>
                        <div class="col-lg-10">
                            <input  type="text" 
                                    disabled class="form-control" 
                                    name="Nombre" 
                                    value="<?php echo $datos_pen[0]["Nombre"];?>"  
                                    placeholder="Ingrese Nombre Ciudadano" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Apellidos:</label>
                        <div class="col-lg-10">
                            <input  type="email" 
                                    disabled class="form-control" 
                                    name="Apellido" 
                                    value="<?php echo $datos_pen[0]["Apellido"];?>" 
                                    placeholder="Ingrese Apellidos">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Telefono:</label>
                        <div class="col-md-10">
                            <input  type="email" 
                                    disabled class="form-control" 
                                    name="Telefono" 
                                    value="<?php echo $datos_pen[0]["Telefono"];?>" 
                                    placeholder="Ingrese Apellidos">
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
                                        $dir=$direc->get_direccion($datos_pen[0]["id"]);
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
            <?php 
               
                $aten=new Atencion();
                $datos_ate=$aten->get_atencion_por_id($datos_pen[0]["num_ate"]);
            ?>
            <div class="tab-pane fade" id="Ide_Atencion">
                <div class="container" ng-controller="PhoneCtrl">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="name">Folio RSH:</label>
                        <div class="col-md-10">
                            <input  type="text" 
                                    class="form-control" 
                                    name="Folio_Rsh" 
                                    id="name" 
                                    value="<?php echo $datos_ate[0]["Folio_Rsh"];?>" 
                                    placeholder="Ingrese Folio RSH" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="phone">Numero de Solicitud:</label>
                        <div class="col-md-10">
                            <input  type="text" 
                                    class="form-control" 
                                    name="Numero_Solicitud"  
                                    value="<?php echo $datos_ate[0]["Numero_Solicitud"];?>" 
                                    placeholder="Ingrese Numero de Solicitud" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Fecha de Atencion:</label>
                        <div class="col-md-10">
                            <input  type="date" 
                                    class="form-control" 
                                    name="Fecha_Atencion" 
                                    value="<?php echo $datos_ate[0]["Fecha_Atencion"];?>" 
                                    placeholder="Fecha de Atencion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Hora de Atencion:</label>
                        <div class="col-md-10">
                            <input  type="time" 
                                    class="form-control" 
                                    name="Hora_Atencion" 
                                    value="<?php echo $datos_ate[0]["Hora_Atencion"];?>" 
                                    placeholder="Hora de Atencion">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="Ide_Motivo">
                <?php 
                   
                    $consulta   =   new Atencion();
                    $consul     =   $consulta->get_ate_consulta($datos_ate[0]["id"]);
                    
                    
                    for($i=0;$i<sizeof($ArrayConsulta);$i++) {
                       
                        for($j=0;$j<sizeof($consul);$j++) {

                            if ($ArrayConsulta[$i]["id"] == $consul[$j]["Consulta_Id"]) {
                                $ArrayConsulta[$i]["Estado"] = 1;
                                
                            }
                        }
                    }
                ?>
                <div class="col-lg-7 ">
                    <div class="panel panel-primary">
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
                                                                        
                                                                />
                                                            <?php
                                                            } else { ?>
                                                                <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                                        value="<?php echo $ArrayConsulta[$i]["id"];?>" 
                                                                        name="ArrayConsulta[]" 
                                                                        type="checkbox" 
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
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <ul class="list-group">
                            <?php
                                $ate_programa        =   new Atencion();
                                $con_ateprograma     =   $ate_programa->get_ate_programa($datos_ate[0]["id"]);
                                $prog=new Programa();
                                $prg=$prog->get_programas();
                                for($i=0;$i<sizeof($prg);$i++)
                                {
                                    $Existe_Programa = 0;
                                    for ($j=0;$j<sizeof($con_ateprograma);$j++)
                                    {
                                        if ( $con_ateprograma[$j]["Programa_Id"] == $prg[$i]["id"] ) {
                                            $Existe_Programa = 1;
                                        }
                                    }
                                    if ( $Existe_Programa == 0)
                                    {
                                        ?>
                                        <li class="list-group-item">
                                            <?php echo $prg[$i]["Programa"];?>
                                            <div class="material-switch pull-right">
                                                <input  id="<?php echo 'prg'.$i ;?>" 
                                                        value="<?php echo $prg[$i]["id"];?>" 
                                                        name="programa[]" 
                                                        type="checkbox"/>
                                                <label for="<?php echo 'prg'.$i ;?>" class="label-success"></label>
                                            </div>
                                        </li> <?php
                                    } else { ?>
                                        <li class="list-group-item">
                                            <?php echo $prg[$i]["Programa"];?>
                                            <div class="material-switch pull-right">
                                                <input  id="<?php echo 'prg'.$i ;?>" 
                                                        value="<?php echo $prg[$i]["id"];?>" 
                                                        name="programa[]" 
                                                        type="checkbox"
                                                        checked/>
                                                <label for="<?php echo 'prg'.$i ;?>" class="label-success"></label>
                                            </div>
                                        </li> <?php
                                    }
                                } ?>
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
                                $ate_documento = new Atencion();
                                $ate_docu= $ate_documento->get_ate_documento($datos_ate[0]["id"]);
                                $documento=new Documento();
                                $docu=$documento->get_documentos();
                                for($i=0;$i<sizeof($docu);$i++)
                                { ?>
                                    <li class="list-group-item">
                                        <?php echo $docu[$i]["Documento"];
                                        $existe ="";
                                        for($x=0;$x<sizeof($ate_docu);$x++)
                                        { 
                                            if ( $docu[$i]["id"] == $ate_docu[$x]["Documento_Id"])
                                            {?>
                                                <div class="material-switch pull-right">
                                                    <input  id="<?php echo 'doc'.$i ;?>" 
                                                            value="<?php echo $docu[$i]["id"];?>" 
                                                            checked 
                                                            name="documento[]" 
                                                            type="checkbox"/>
                                                    <label for="<?php echo 'doc'.$i ;?>" class="label-success"></label>
                                                </div> <?php
                                                $existe ="S";
                                            } 
                                        } 
                                        if ($existe == "") 
                                            { ?>
                                                <div class="material-switch pull-right">
                                                    <input  id="<?php echo 'doc'.$i ;?>" 
                                                            value="<?php echo $docu[$i]["id"];?>" 
                                                            name="documento[]" 
                                                            type="checkbox"/>
                                                    <label for="<?php echo 'doc'.$i ;?>" class="label-success"></label>
                                                </div> <?php
                                            }?>
                                    </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <textarea   class="form-control" 
                                        name="Observacion" 
                                        type="textarea" 
                                        id="message" 
                                        placeholder="Observaciones" 
                                        maxlength="140" 
                                        rows="7">
                                        <?php echo $datos_ate[0]["Observacion"];?>
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <ul class="list-group">
                            <li class="list-group-item">
                                Cierra Atencion
                                <div class="material-switch pull-right">
                                    <input onclick=aviso(this.value) id="Cerrar"  name="Cierra" type="checkbox"/>
                                    <label for="Cerrar" class="label-success"></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <ul class="list-group">
                            <li class="list-group-item">
                                Proxima Visita
                                <input  type="date" 
                                        class="form-control" 
                                        name="Proxima_Visita"  
                                        value="<?php echo $datos_ate[0]["Fecha_Cita"];?>" 
                                        placeholder="Fecha Proxima Visita">
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" name="Actualiza_Atencion"  value="Actualiza_Si">
                    <input type="hidden" name="Rut"                 value="<?php echo $datos_pen[0]["Rut"];?>">
                    <input type="hidden" name="id"                  value="<?php echo $datos_pen[0]["id"];?>">
                    <input type="hidden" name="id_usuario_act"      value="<?php echo $id_usuario_act;?>">
                    <input type="hidden" name="id_atencion"         value="<?php echo $datos_ate[0]["id"];?>">
                    <div class="col-md-10">
                        <ul class="list-group">
                                <li class="list-group-item">
                                <button class="form-control btn btn-primary">Grabar Pendiente</button>   
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
           