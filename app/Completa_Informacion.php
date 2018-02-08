<?php
    require_once("../Include/Rutinas.php")                  ;
    require_once("../Paginacion/Logeo.php")                 ;
    require_once("../Clases/ClaseLoteDigitacion.php")       ;   
    require_once("../Clases/ClaseAtencion.php")             ;
    require_once("../Clases/ClasePersona.php")             ;
    
    $Requerimiento_Existe = "N";

    if (isset($_POST["Numero_Requerimiento"])) {
        $Nreq=new LoteDigitacion();
        $datos_req=$Nreq->get_numero_requerimiento($_POST["Numero_Requerimiento"]);
        if ( sizeof($datos_req)  == 0 ) {
            $Titulo_App           = "Numero Requerimiento No Existe";
            $Indentificador_Lote  =  0;
        } else {
            $Indentificador_Lote  = 1;
            $Titulo_App           = "Numero de Requerimiento : ".$_POST["Numero_Requerimiento"];
            $Requerimiento_Existe = "S";
        }
    } else {
        $Titulo_App="Nueva Conulta";
        $Indentificador_Lote = 0;   
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
                            <h3 class="panel-title"><?php echo $Titulo_App ;?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                    <?php
                                        require_once("form/Menu_Inactivo_Archivo.php") ;   
                                    ?>
                                </ul>
                            </div>

                            <?php

                                if ($Requerimiento_Existe == "N" ) {?>
                                    <form class="form-horizontal"  name="form_registro" id="form_registro" action="Completa_Informacion.php" accept-charset="UTF-8" method="post"   >
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="Numero_Requerimiento" id="Numero_Requerimiento" placeholder="Ingrese Numero Requerimiento..."   onblur='onRutBlur(this);' required>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm btn-primary glyphicon glyphicon-search" type="button submit" ></button>
                                                            <input type="hidden" name="buscar" value="si">
                                                        </span>
                                                    </div><!-- /input-group -->
                                                </div><!-- /.col-lg-6 -->
                                            </div><!-- /.row -->
                                        </div>
                                    </form> <?php
                                } else  { 
                                    require_once("form/Form_Completa_Datos_Archivo.php") ;   
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php Include("../Include/footer.php");?>
        </body>
    </html>