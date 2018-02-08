<form  class="form-horizontal" name="form_atencion" id="form_atencion" action="Imprime_Hojas_de_Ruta.php" accept-charset="UTF-8" method="post"  >
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <?php
                    if ( $_POST["Movimiento"] == '7') { $Titulo_Genera  = "Informe Hojas de Ruta para Ingreso al Registros el dia ".$_POST["Fecha_Generada"]; }
                    if ( $_POST["Movimiento"] == '5') { $Titulo_Genera  = "Informe Hojas de Ruta para Cambio de Domicilio el dia ".$_POST["Fecha_Generada"]; }
                    if ( $_POST["Movimiento"] == '6') { $Titulo_Genera  = "Informe Hojas de Ruta para Modulo de Vivienda el dia ".$_POST["Fecha_Generada"]; }

                    $Movimiento         = $_POST["Movimiento"];
                    $Fecha_Generada     = $_POST["Fecha_Generada"];
                    $ate                = new Informes(); 
                
                    require_once("Muestra_Hojas_de_Ruta_Impresion.php")      ;

                    
                ?>
            </div>
        </div>
    </div>
</form>