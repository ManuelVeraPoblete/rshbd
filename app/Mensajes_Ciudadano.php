<?php
require_once("../Include/Rutinas.php")                 ;
require_once("../Paginacion/Logeo.php")                  ;
require_once("../Clases/ClaseUnidad.php")                ;
require_once("../Clases/ClasePoblacion.php")             ;
require_once("../Clases/ClaseCalle.php")                 ;
require_once("../Clases/ClasePersona.php")               ;
require_once("../Clases/ClaseDireccion.php")             ;
require_once("../Clases/ClaseMensaje.php")     ;
//require_once("../Include/Carga_Unidades.php")            ;
$titulo  = "Mensajes Ciudadano";
$Mensajes = new Mensajes();
$resultado="1";
if (isset($_POST["Rut_Ciudadano"])){ 
    $resultado = valida_rut($_POST["Rut_Ciudadano"]);
}
if ($resultado == "1" ) { 
    if (isset($_POST["Grabar"])) {
        if  ( $_POST["Grabar"] == "Grabar_Si_Existe") {
            $Mensajes->genera_mensaje_persona_existe();
        }
    }else {
        if(isset($_POST["Rut_Ciudadano"])){
            $tra=new Persona();
            $datos=$tra->get_persona_por_rut($_POST["Rut_Ciudadano"]);
            if(sizeof($datos)==0)
            {
                $existe_persona = "N";
                $titulo="Ciudadano no Existe";
            } else {
                $existe_persona = "S";
                $titulo="Ciudadano Existe";
            }
        } else {
                $titulo="Rut Ciudadano Incorrecto";
            }
    }
} else {
    $titulo="Rut Ciudadano Incorrecto";
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
                                <?php                                   
                                    require_once("form/Menu_Mensajes.php")   ;   
                                ?>
                            </ul>
                        </div>
                        <?php
                        if (!isset($existe_persona)) { ?>
                            <form class="form-horizontal" accept-charset="UTF-8" action="Mensajes_Ciudadano.php"  method="post">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="Rut_Ciudadano" id="Rut_Ciudadano" placeholder="Ingrese Rut Ciudadano..."   onblur='onRutBlur(this);' required>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary glyphicon glyphicon-search" type="button submit" ></button>
                                                    <input type="hidden" name="buscar" value="si">
                                                </span>
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                    </div><!-- /.row -->
                                </div>
                            </form>
                        <?php
                        } else {
                            if ($existe_persona == "S") {
                                require_once("form/Form_Muestra_Persona_Mensaje.php")              ;
                            } else {
                                echo "<h1> No Existe Informacion de Ciudadano <h1>";
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php Include("../Include/footer.php");?>
    </body>
</html>