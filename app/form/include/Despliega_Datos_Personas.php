
    <div class="container">
        <div class="form-group">
            <label class="control-label col-lg-2" for="name">Rut:</label>
            <div class="col-md-10">
                <input  type="text" 
                        disabled 
                        class="form-control" 
                        name="Rut" 
                        value="<?php echo $datos_per[0]["Rut"];?>" 
                        id="name" 
                        placeholder="Ingrese Rut Ciudadano" >
            </div>
        </div>
        <div class="form-group">
            <label  class="control-label col-lg-2" for="phone">Nombre:</label>
            <div class="col-lg-10">
                <input  type="text" 
                        disabled class="form-control" 
                        name="Nombre" 
                        value="<?php echo $datos_per[0]["Nombre"];?>"  
                        placeholder="Ingrese Nombre Ciudadano" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-2" for="email">Apellidos:</label>
            <div class="col-lg-10">
                <input  type="email" 
                        disabled class="form-control" 
                        name="Apellido" 
                        value="<?php echo $datos_per[0]["Apellido"];?>" 
                        placeholder="Ingrese Apellidos">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-2" for="email">Telefono:</label>
            <div class="col-md-10">
                <input  type="email" 
                        disabled class="form-control" 
                        name="Telefono" 
                        value="<?php echo $datos_per[0]["Telefono"];?>" 
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
                        $dir=$direc->get_direccion($datos_per[0]["id"]);
                        for($i=0;$i<sizeof($dir);$i++)
                        {
                        ?>
                        <tr>
                            <td valign="top" ><?php echo $dir[$i]["id"]?>               </td>
                            <td valign="top" ><?php echo $dir[$i]["Nom_Unidad"]?>       </td>
                            <td valign="top" ><?php echo $dir[$i]["Nom_Poblacion"]?>    </td>
                            <td valign="top" ><?php echo $dir[$i]["Nom_Calle"]?>        </td>
                            <td valign="top" ><?php echo $dir[$i]["Numero"]?>           </td>
                            <td valign="top" ><?php echo $dir[$i]["Block"]?>            </td>
                            <td valign="top" ><?php echo $dir[$i]["Departamento"]?>     </td>
                            <td valign="top" ><?php echo $dir[$i]["Casa"]?>             </td>
                            <td valign="top" ><?php echo $dir[$i]["Observacion"]?>      </td>
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
            