<form class="form-horizontal" accept-charset="UTF-8" action="Resumen_Diario_Atenciones.php"  method="post">
    <div class="panel-body">
        <div class="form-group">
            <h4>
                <label class="control-label col-lg-2" for="email">Fecha de Inicio:</label>
                <input type="date" class="form-control" name="Fecha_Desde" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Atencion">
            </h4>
            <h4>
                <label class="control-label col-lg-2" for="email">Fecha de Termino:</label>
                <input type="date" class="form-control" name="Fecha_Hasta" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Atencion">
            </h4>
            <h4>
                <label class="control-label col-lg-2" for="email">Ejecutor:</label>
                <select name="Usuario_Id" class="form-control">
                <?php
                    $usr = new Usuario();
                    $datos_usuario = $usr->get_usuarios();
                    for($i=0;$i<sizeof($datos_usuario);$i++)
                    {
                        ?>
                        <option  value="<?php echo $datos_usuario[$i]["id"];?>"><?php echo $datos_usuario[$i]["Nombre"].' '.$datos_usuario[$i]["Apellido"] ;?></option>
                        <?php 
                    }?>
                </select>
            </h4>
        </div>
    </div>
    <center>
        <div class="col-md-11">
            <center>
                <ul class="list-group">
                    <li class="list-group-item">
                        <button class="form-control btn btn-primary">Genera Impresion Hojas de Ruta</button>   
                    </li>
                </ul>
            </center>
        </div>
    </center>
</form>