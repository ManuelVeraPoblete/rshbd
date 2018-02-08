<form  class="form-horizontal" name="muestra" id="muestra" accept-charset="UTF-8"   >
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
                    
                </div>  
            </div>
        </div>
    </div>
</form>