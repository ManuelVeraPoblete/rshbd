<form  class="form-horizontal" name="form_atencion" id="form_atencion" action="Imprime_Hojas_de_Ruta.php" accept-charset="UTF-8" method="post"  >
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <?php
                    $Titulo_Genera  = "Resumen Hojas de Ruta por Encuestador"; 
                    $Fecha_Desde        = $_POST["Fecha_Desde"];
                    $Fecha_Hasta        = $_POST["Fecha_Hasta"];
                    $ate                = new Informes(); 
                    require_once("Muestra_Hojas_de_Ruta_Resumen.php")      ;
                ?>
            </div>
        </div>
    </div>
</form>