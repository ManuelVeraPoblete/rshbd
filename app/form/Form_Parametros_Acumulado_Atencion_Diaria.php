<form class="form-horizontal" accept-charset="UTF-8" action="Acumulado_Atenciones.php"  method="post">
    <div class="panel-body">
        <div class="form-group">
            <h4>
                <label class="control-label col-lg-2" for="email">Fecha de Inicio:</label>
                <input type="date" class="form-control" name="Fecha_Desde" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Atencion">
            </h4>
            
        </div>
    </div>
    <center>
        <div class="col-md-11">
            <center>
                <ul class="list-group">
                    <li class="list-group-item">
                        <button class="form-control btn btn-primary">Buscar Datos</button>   
                    </li>
                </ul>
            </center>
        </div>
    </center>
</form>