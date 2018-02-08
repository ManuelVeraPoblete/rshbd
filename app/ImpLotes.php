<?php
    require_once("../Paginacion/Logeo.php")        ;
    require_once("../Include/Rutinas.php")         ;
    require_once("../Clases/ClaseInformes.php")    ;
    require_once("../Clases/ClaseUsuario.php")     ;
    require_once("../Clases/ClaseLoteDigitacion.php")              ;
    $titulo  = "Imprimir Lotes Para Digitacion"
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
                        <?php
                            require_once("form/Muestra_Lote.php")      ;  
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php Include("../Include/footer.php");?>
    </body>
</html>



