<?php
require_once("../Include/Rutinas.php")                  ;
require_once("../Paginacion/Logeo.php")                 ;
require_once("../Clases/ClaseUnidad.php")               ;
require_once("../Clases/ClasePoblacion.php")            ;
require_once("../Clases/ClaseCalle.php")                ;
require_once("../Clases/ClasePersona.php")              ;
require_once("../Clases/ClaseDireccion.php")            ;
require_once("../Clases/ClaseConsulta.php")             ;
require_once("../Clases/ClasePrograma.php")             ;
require_once("../Clases/ClaseDocumento.php")            ;
require_once("../Clases/ClaseAtencion.php")             ;
require_once("../Clases/ClaseActualizaAtencion.php")    ;
//require_once("../Include/Carga_Unidades.php")    ;
if (isset($_POST["PE_Nueva_Atencion"]) and isset($_POST["Persona_Id_VW"])) {
    $trabajo = new ActualizaAtencion();
    $trabajo->Genera_Atencion_Via_Web_Persona_Existe();
}

if (isset($_GET["Nueva"]) AND isset($_GET["Rut_Ciudadano"])) 
{ 
    $Nueva_Atencion = $_GET["Nueva"]                            ;
    $Rut_Ciudadano  = $_GET["Rut_Ciudadano"]                    ;
    $tra=new Persona()                                          ;
    $datos_per = $tra->get_persona_por_rut($Rut_Ciudadano)     ;
    $titulo="Atencion Via Web - Nueva";
    $Existe_Persona = "S";
} else {
    $combo_poblacion='';
    $pobla=new Poblacion();
    $pob=$pobla->get_poblaciones();
    for($i=0;$i<sizeof($pob);$i++)
    {
        $combo_poblacion.= "<option value='".$pob[$i]['id']."'>".$pob[$i]['Poblacion']."</option>";
    }
    $titulo  = "Atenciones Via Web ";
    $trabajo = new ActualizaAtencion();
    $resultado="1";
    if (isset($_POST["Rut_Ciudadano"])){ 
        $resultado = valida_rut($_POST["Rut_Ciudadano"]);
    }
    if ( $resultado == '1' ) {
        if (isset($_POST["Actualiza_Atencion"]) and $_POST["Actualiza_Si"] = "Grabar_Si") {
            $trabajo->Genera_Atencion_Via_Web();
            exit;
        } else {
            if(isset($_POST["Rut_Ciudadano"]))
            {
                $tra=new Persona();
                $datos_per = $tra->get_persona_por_rut($_POST["Rut_Ciudadano"]);
                if (sizeof($datos_per) == 0 ){
                    $Existe_Persona = "N";
                    $titulo="Atencion Persona no Existe";
                } else {
                    $id_persona         = $datos_per[0]["id"];
                    $Existe_Persona     = 'S';
                    $id_rut             = $_POST["Rut_Ciudadano"];
                }
                if ( $Existe_Persona == 'S')
                {
                    $tra=new Persona();
                    $datos=$tra->get_persona_por_rut_atencion($_POST["Rut_Ciudadano"]);
                    if ( sizeof($datos) == 0 ) {
                        $atencion_pendiente = 'N';
                    } else {
                        $atencion_pendiente = "S";
                        $id_ate             = $datos[0]["num_ate"];
                    }
                }
            }
        } 
    } else {
        $titulo = "Rut Ciudadano Erroneo";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
        <script>
            function pendiente(Atencion,Persona)
            {
                swal
                ({
                        title:                  'Atencion Pendiente!!?'         ,
                        text:                   "No se Genera Atencion Via Web" ,
                        type:                   'warning'                       ,
                        showCancelButton:       true                            ,
                        confirmButtonColor:     '#3085d6'                       ,
                        cancelButtonColor:      '#d33'                          ,
                        confirmButtonText:      'Actualiza Atencion'            ,
                        cancelButtonText:       'Salir'                         ,
                        confirmButtonClass:     'btn-lg btn-success'            ,
                        cancelButtonClass:      'btn-lg btn-danger'             ,
                        buttonsStyling:         false
                    })
                    .then(function () 
                    {
                        window.location = 'Atenciones.php?Atencion_Identificador='+Atencion+'&Persona_Identificador='+Persona;
                    }, 
                    function (dismiss) 
                    {
                        if (dismiss === 'cancel') 
                        {
                            window.location = 'Atencion_Via_Web.php' ;
                        }
                })
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
                                        if (!isset($Existe_Persona))                                 {  require_once("form/Menu_Inactivo_Atencion_Web.php") ;   } 
                                else { if ($Existe_Persona == "S" and isset($Nueva_Atencion)     )  { require_once("form/Menu_Activo_Atencion_Web.php")    ;   } 
                                else { if ($Existe_Persona == "S" and !isset($actualiza_atencion))  { require_once("form/Menu_Inactivo_Atencion_Web.php")  ;   }
                                else                                                                { require_once("form/Menu_Activo_Atencion_Web.php")    ;   }}}
                                ?>
                            </ul>
                        </div>
                        <?php                
                        if (!isset($Existe_Persona)) { ?>
                            <form class="form-horizontal" accept-charset="UTF-8" action="Atencion_Via_Web.php"  method="post">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="Rut_Ciudadano" placeholder="Ingrese Rut Ciudadano..." required>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary glyphicon glyphicon-search" type="button submit" ></button>
                                                    <input type="hidden" name="buscar" value="si">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php } else {
                            if ( $Existe_Persona == "N") 
                            {
                                require_once("form/Form_Persona_No_existe_Ingresa_Atencion_Via_Web.php");
                            } else { 
                                if (isset($Nueva_Atencion) ) {
                                    require_once("form/Form_Persona_Existe_Ingresa_Atencion_Via_Web.php");
                                } else {
                                    require_once("form/Form_Persona_Existe.php");
                                    ?>
                                    <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $datos_per[0]["id"];?>" id="getAtenciones" class="btn btn-sm btn-primary"> Desplegar Atenciones        </button>
                                    <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $datos_per[0]["id"];?>" id="getMensajes"   class="btn btn-sm btn-primary"> Desplegar Mensajes Atencion </button>
                                    <a href="Atencion_Via_Web.php?Nueva=S&Rut_Ciudadano=<?php echo $datos_per[0]["Rut"];?>" ><button type='button'       class='btn btn-success'>        Nueva Atencion              </button></a>
                                    <?php
                                }
                            }        
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php Include("../Include/footer.php");?>
    </body>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#getAtenciones', function(e){
                e.preventDefault();
                var uid = $(this).data('id');   // it will get id of clicked row
                $('#dynamic-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show();      // load ajax loader
                $.ajax({
                    url: 'Ajax/Get_Atenciones.php',
                    type: 'POST',
                    data: 'id='+uid,
                    dataType: 'html'
                })
                .done(function(data){
                    console.log(data);  
                    $('#dynamic-content').html('');    
                    $('#dynamic-content').html(data); // load response 
                    $('#modal-loader').hide();        // hide ajax loader   
                })
                .fail(function(){
                    $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader').hide();
                });
            });
        });
        $(document).ready(function(){
            $(document).on('click', '#getMensajes', function(e){
                e.preventDefault();
                var uid = $(this).data('id');   // it will get id of clicked row
                $('#dynamic-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show();      // load ajax loader
                $.ajax({
                    url: 'Ajax/Get_Mensajes.php',
                    type: 'POST',
                    data: 'id='+uid,
                    dataType: 'html'
                })
                .done(function(data){
                    console.log(data);  
                    $('#dynamic-content').html('');    
                    $('#dynamic-content').html(data); // load response 
                    $('#modal-loader').hide();        // hide ajax loader   
                })
                .fail(function(){
                    $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader').hide();
                });
            });
        });
    </script>
</html>
<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 80%;"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">
                    <i class="glyphicon glyphicon-user"></i> Historico Atenciones
                </h4> 
            </div> 
            <div class="modal-body"> 
                <div id="modal-loader" style="display: none; text-align: center;">
                    <img src="../img/ajax-loader.gif">
                </div>
                <!-- content will be load here -->                          
                <div id="dynamic-content"></div>
            </div> 
            <div class="modal-footer"> 
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>  
            </div> 
        </div> 
    </div>
</div><!-- /.modal -->