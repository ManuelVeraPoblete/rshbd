<?php
require_once("../Clases/ClasePagina.php");
require_once("../Paginacion/PaginacionPersona.php");
require_once("../Paginacion/Logeo.php");
require_once("../Clases/ClaseUnidad.php")               ;
require_once("../Clases/ClasePoblacion.php")            ;
require_once("../Clases/ClaseCalle.php")                ;
require_once("../Clases/ClasePersona.php")              ;
require_once("../Clases/ClaseDireccion.php")            ;
require_once("../Clases/ClaseConsulta.php")             ;
require_once("../Clases/ClasePrograma.php")             ;
require_once("../Clases/ClaseDocumento.php")            ;
require_once("../Clases/ClaseAtencion.php")             ;
require_once("../Clases/ClaseLlamado.php")              ;
require_once("../Clases/ClaseActualizaAtencion.php")              ;
require_once("../Include/Rutinas.php")                  ;
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
    </head>
    <body>
        <?php require_once("../Include/Menu.php");?>
        <?php
        if (isset($_GET["Rut_Persona"])) 
        {
            $tra=new Persona();
            $datos=$tra->get_persona_por_rut($_GET["Rut_Persona"]);
        ?>
            <div class="box-panta">
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Consulta Ciudadano</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">  
                                    <?php  require_once("form/Menu_Activo_Consulta.php")   ;  ?>
                                </ul>
                            </div>
                            <?php require_once("form/Form_Muestra_Persona_Existe_Consulta.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
            Include("form/Form_Consulta_Persona.php");
        }
        ?>
    </body>
    <?php Include("../Include/footer.php");?>
</html>