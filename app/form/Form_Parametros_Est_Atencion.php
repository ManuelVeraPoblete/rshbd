<form class="form-horizontal" accept-charset="UTF-8" action="Est_Atenciones_Fecha.php"  method="post">
    <div class="panel-body">
        <div class="form-group">
            <h4>
                <label class="control-label col-lg-2" for="email">Fecha de Inicio:</label>
                <div class="col-md-10">
                    <input type="date" class="form-control" name="Fecha_Desde" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Atencion">
                </div>
            </h4>
            <h4>
                <label class="control-label col-lg-2" for="email">Fecha de Termino:</label>
                <div class="col-md-10">
                    <input type="date" class="form-control" name="Fecha_Hasta" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Atencion">
                </div>
            </h4>
        </div>
    </div>
    <center>
        <div class="col-md-11">
            <center>
                <ul class="list-group">
                    <li class="list-group-item">
                        <button class="form-control btn btn-primary">Genera Estadisticas</button>   
                    </li>
                </ul>
            </center>
        </div>
    </center>
</form>