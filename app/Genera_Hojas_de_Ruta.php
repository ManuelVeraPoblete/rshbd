<?php
    require_once("../Paginacion/Logeo.php")                 ;      require_once("../Clases/ClaseUnidad.php")      ;
    require_once("../Clases/ClasePoblacion.php")            ;      require_once("../Clases/ClaseCalle.php")       ;
    require_once("../Clases/ClasePersona.php")              ;      require_once("../Clases/ClaseDireccion.php")   ;
    require_once("../Clases/ClaseLlamado.php")              ;      require_once("../Clases/ClaseEstado.php")      ;
    require_once("../Clases/ClaseAtencion.php")             ;      require_once("../Include/Rutinas.php")         ;
    require_once("../Clases/ClaseActualizaAtencion.php")   ;
    //require_once("../Include/Carga_Unidades.php")            ;
    $titulo  = "Genera Hojas de Ruta";$Genera  = "N"; $Grabar_Hojas = "N";
    if(isset($_POST["Genera_Hoja"]) and $_POST["Genera_Hoja"] == 'S' ) {
        $Grabar_Hojas = "S";
    } else {
        $Genera  = "N";
    }
    if ( isset($_POST["Fecha_Genera"], $_POST["Fecha_Desde"]) )
    {
        $titulo = "Hojas Generadas";
        if ( isset($_POST["Movimiento"]) ){ $Genera = "S" ;                                                     } 
        else                              { $Genera = "N" ;$titulo = "No se Ingresaron Movimientos a Generar";    }
    } else { $titulo  = "Genera Hojas de Ruta"; } 
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
                                <?php require_once("form/Menu_Genera_Ruta.php") ;   ?>
                            </ul>
                        </div>
                        <?php 
                            if ($Grabar_Hojas == "S")
                            {  require_once("form/Graba_Hojas_de_Ruta.php");
                            } else { if ($Genera == "N") { 
                                         require_once("form/Form_Parametros_Hoja_Ruta.php") ;  
                                      } else  {
                                                require_once("form/Form_Hojas_de_Ruta.php")        ;  
                                                }  
                                    }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php Include("../Include/footer.php");?>
    </body>
</html>