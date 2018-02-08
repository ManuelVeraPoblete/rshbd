<form  class="form-horizontal" name="form_llamado" id="form_mensaje" action="" accept-charset="UTF-8" method="post"  onsubmit="return valida_ing_llamado()" novalidate>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <div class="container" ng-controller="PhoneCtrl">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="name">Rut:</label>
                        <div class="col-md-10">
                            <input type="text" disabled class="form-control" name="Rut" value="<?php echo $datos[0]["Rut"];?>" id="name" placeholder="Ingrese Rut Ciudadano" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Nombre:</label>
                        <div class="col-lg-10">
                            <input type="email" disabled class="form-control" name="Nombre" value="<?php echo $datos[0]["Nombre"];?>"  placeholder="Ingrese Nombre Ciudadano" >
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
                                    $dir=$direc->get_direccion($datos[0]["id"]);
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
            <div class="tab-pane fade" id="Ide_Mensaje">
                <div class="col-md-4">
                    <div class="form-group">
                        <textarea class="form-control" name="Mensaje" type="textarea" id="message" placeholder="Mensaje"  rows="10"></textarea>
                    </div>
                </div>
                <input type="hidden" name="Grabar" value="Grabar_Si_Existe">
                <input type="hidden" name="id_usuario_act" value="<?php echo $id_usuario_act;?>">
                <input type="hidden" name="id_persona_act" value="<?php echo $datos[0]["id"];?>">
                <div class="col-md-8" >
                    <ul class="list-group">
                        <li class="list-group-item">
                            <button class="form-control btn btn-primary" type="button submit"  >Grabar</button>   
                        </li>
                    </ul>
                    <table class='table table-striped table-condensed'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha Generado</th>
                                <th>Usuario</th>
                                <th>Mensaje</th>
                                <th>Fecha Leido</th>
                                <th>Destinatario</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $consu = new Mensajes();
                        $consulta=$consu->get_mensajes_por_id($datos[0]["id"]);
                        for($i=0;$i<sizeof($consulta);$i++)
                        { ?>
                            <tr> 
                                <td><?php echo $consulta[$i]["id"];?></td>
                                <td><?php echo $consulta[$i]["Fecha_Generada"];?></td>
                                <td><?php echo $consulta[$i]["nom_usr_g"].' '.$consulta[$i]["ape_usr_g"];?></td>
                                <td><?php echo $consulta[$i]["Mensaje"];?></td>
                                <td><?php echo $consulta[$i]["Fecha_Leido"];?></td>
                                <td><?php echo $consulta[$i]["nom_usr_l"].' '.$consulta[$i]["ape_usr_l"];?></td>
                            </tr>
                            <?php 
                        }?>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</form>