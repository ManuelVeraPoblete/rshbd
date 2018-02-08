<?php
    require_once("../Include/Rutinas.php")                      ;
    require_once("../Paginacion/Logeo.php")                     ;
    require_once("../Clases/ClaseUnidad.php")                   ;
    require_once("../Clases/ClasePoblacion.php")                ;
    require_once("../Clases/ClaseCalle.php")                    ;
    require_once("../Clases/ClasePersona.php")                  ;
    require_once("../Clases/ClaseDireccion.php")                ;
    require_once("../Clases/ClaseLlamado.php")                  ;
    $combo_poblacion='';
    $pobla=new Poblacion();
    $pob=$pobla->get_poblaciones();
    $combo_poblacion= "<option value='".$pob[0]['id']."'>".$pob[0]['Poblacion']."</option>";
    for($i=1;$i<sizeof($pob);$i++)
    {
        $combo_poblacion.= "<option value='".$pob[$i]['id']."'>".$pob[$i]['Poblacion']."</option>";
    }
    $titulo  = "Llamados Telefonicos";
    $llamado = new Llamados();
    if (isset($_POST["Grabar"])) 
    {
    if  ( $_POST["Grabar"] == "Grabar_Si") {
            $llamado->genera_llamado_persona_no_existe();
        } else {
            if  ( $_POST["Grabar"] == "Grabar_Si_Existe") {
                $llamado->genera_llamado_persona_existe();
            }
        }
    }else {
        if(isset($_POST["Rut_Ciudadano"])){
            $resultado="1";
            if (isset($_POST["Rut_Ciudadano"])){ 
                $resultado = valida_rut($_POST["Rut_Ciudadano"]);
            }
            if ($resultado =='1') {
                $tra=new Persona();
                $datos_per=$tra->get_persona_por_rut($_POST["Rut_Ciudadano"]);
                if(sizeof($datos_per)==0)
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
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
        <script>
                function onRutBlur(obj) 
                {
                    if (VerificaRut(obj.value)) {
                        return true;
                    } else {
                        swal("El rut Ingresado es Erroneo!");
                    }
                }
                $(document).ready(function() {
                // Parametros para el combo
                    $("#Poblacion").change(function () {
                        $("#Poblacion option:selected").each(function () {
                            elegido=$(this).val();
                            $.post("Ajax/Carga_Unidades.php", { elegido: elegido }, function(data){
                                $("#Unidad").html(data);
                            });     
                        });
                    });    
                });            
        </script>
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
                                    require_once("form/Menu_Llamado.php")   ;   
                                ?>
                            </ul>
                        </div>
                        <?php
                        if (!isset($existe_persona)) { ?>
                            <form class="form-horizontal" accept-charset="UTF-8" action="Llamados_Telefonicos.php"  method="post">
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
                                require_once("form/Form_Muestra_Persona_llamados.php")              ;
                            } else {
                                require_once("form/Form_Persona_No_Existe_Ingresa_Llamado.php")     ;
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php Include("../Include/footer.php");?>
    </body>
</html>