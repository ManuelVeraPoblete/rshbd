<form  class="form-horizontal" name="form_atencion" id="form_atencion" action="Genera_Hojas_de_Ruta.php" accept-charset="UTF-8" method="post"  >
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <?php
                    if ( $_POST["Movimiento"] == '7') { $Titulo_Genera  = "Generando Hojas de Ruta para Ingreso al Registros desde ".$_POST["Fecha_Desde"]; }
                    if ( $_POST["Movimiento"] == '6' ) { $Titulo_Genera  = "Generando Hojas de Ruta para Cambio de Domicilio desde ".$_POST["Fecha_Desde"]; }
                    if ( $_POST["Movimiento"] == '5') { $Titulo_Genera  = "Generando Hojas de Ruta para Modulo de Vivienda desde ".$_POST["Fecha_Desde"]; }

                    $Movimiento         = $_POST["Movimiento"];
                    $Fecha_Desde        = $_POST["Fecha_Desde"];
                    $ate                = new Atencion(); 
                    $Ultimo_Numero_Hoja = $ate->get_ultima_hoja();
                    $Numero_Hoja = 0;
                    $Numero_Hoja = $Ultimo_Numero_Hoja[0]["Numero_Final"] ;
                    require_once("Muestra_Hojas_de_Ruta.php")      ;
                ?>
            </div>
        </div>
    </div>
</form>