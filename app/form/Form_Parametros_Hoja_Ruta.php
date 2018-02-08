<form class="form-horizontal" accept-charset="UTF-8" action="Genera_Hojas_de_Ruta.php"  method="post">
    <div class="panel-body">
        <div class="form-group">
            <label class="control-label col-lg-2" for="email">Fecha de Generacion:</label>
            <div class="col-md-10">
                <input type="date" class="form-control" name="Fecha_Genera" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Atencion">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-2" for="email">Fecha Desde:</label>
            <div class="col-md-10">
                <input type="date" class="form-control" name="Fecha_Desde" value="<?php echo date("2017-01-01");?>" placeholder="Fecha de Atencion">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <div class="funkyradio">
                    <h4>
                        <div class="funkyradio-success">
                            <input type="radio" name="Movimiento" id="radio1" value='7' />
                            <label for="radio1">Ingreso al Registro</label>
                        </div>
                    
                        <div class="funkyradio-success">
                            <input type="radio" name="Movimiento" id="radio2" value ='5' />
                            <label for="radio2">Cambio de Domicilio</label>
                        </div>
                        <div class="funkyradio-success">
                            <input type="radio" name="Movimiento" id="radio3" value ='6'/>
                            <label for="radio3">Modulo de Vivienda</label>
                        </div>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-11">
        <center>
            <ul class="list-group">
                <li class="list-group-item">
                    <button class="form-control btn btn-primary">Genera Hojas de Ruta</button>   
                </li>
            </ul>
        </center>
    </div>
</form>