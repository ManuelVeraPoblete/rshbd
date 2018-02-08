<form class="form-horizontal" accept-charset="UTF-8" action="Imprime_Hojas_de_Ruta.php"  method="post">
    <div class="panel-body">
        <div class="form-group">
            <h4>
                <label class="control-label col-lg-2" for="email">Fecha de Proceso:</label>
                <div class="col-md-10">
                    <input type="date" class="form-control" name="Fecha_Generada" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Atencion">
                </div>
            </h4>
        </div>
        
        <div class="form-group">
            <div class="col-md-5">
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
            <div class="col-md-5">
                <div class="box-blue">
                    <h4>
                        Impresion de Hojas de Ruta
                        <br>
                        <div class="box-green">
                            <h4>- Se Imprimiran Hojas de Ruta del Dia de Proceso Ingresado</h4>
                            <h4>- Se Pueden Imprimir Hojas de Ruta Anteriores</h4>
                            <h4>- Las Hojas entariores que tengan respuesta se imprimirran con ellas</h4>
                        </div>
                    </h4>
                </div>
            </div>
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