<?php
    require_once("../Paginacion/Logeo.php")                 ;      require_once("../Clases/ClaseUnidad.php")      ;
    require_once("../Clases/ClasePoblacion.php")            ;      require_once("../Clases/ClaseCalle.php")       ;
    require_once("../Clases/ClasePersona.php")              ;      require_once("../Clases/ClaseDireccion.php")   ;
    require_once("../Clases/ClaseLlamado.php")              ;      require_once("../Clases/ClaseEstado.php")      ;
    require_once("../Clases/ClaseAtencion.php")             ;      require_once("../Include/Rutinas.php")         ;
    require_once("../Clases/ClaseActualizaAtencion.php")    ;      require_once("../Clases/ClaseInformes.php")    ;
    require_once("../Clases/ClaseUsuario.php");
    //require_once("../Include/Carga_Unidades.php")            ;
    $titulo  = "Estadisticas Atenciones por Fecha";$Genera  = "N"; $Grabar_Hojas = "N"; $Imp_Hoja = "N";


    
    if (isset($_POST["Fecha_Desde"]) && isset($_POST["Fecha_Hasta"]))
    {
        $Fecha_Desde = $_POST["Fecha_Desde"] ; $Fecha_Hasta = $_POST["Fecha_Hasta"] ;
        $titulo  = "Estadisticas Atenciones desde el ".$Fecha_Desde." al ".$Fecha_Hasta;
        $Genera ="S";
    }

    if (isset($_POST["Usuario_Id"]) ) {
        $Usuario_Busqueda = $_POST["Usuario_Id"];
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
    </head>
    <body>
        <?php require_once("../Include/Menu.php");?>
        <div class="box-panta">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $titulo ;?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <?php require_once("form/Menu_Actividades_Usuario.php") ;   ?>
                            </ul>
                        </div>
                        <?php 
                            if ($Genera == "N") { require_once("form/Form_Parametros_Actividades_Usuario.php") ;  } 
                            else                { require_once("form/Muestra_Actividades_Usuario.php")      ;  }  
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php Include("../Include/footer.php");?>
    </body>
</html>