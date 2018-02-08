<?php
    require_once("../Include/Rutinas.php")                 ;
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
    require_once("../Clases/ClaseRequerimiento.php")    ;
    //require_once("../Include/Carga_Unidades.php")    ;
   
    if ( isset($ArrayConsulta)   ) 
    {} else {
        //----------------------------------------------------------------------------------------------
        //---------- Carga Consultas Para desplegar por tipo de requerimiento---------------------------
        //----------------------------------------------------------------------------------------------
        $ArrayConsulta = array();
        $consu=new Consulta();
        $con=$consu->get_consultas();
        for($i=0;$i<sizeof($con);$i++)
        { 
            $ArrayConsulta[$i]["id"]                    =   $con[$i]["id"]                 ;
            $ArrayConsulta[$i]["Consulta"]              =   $con[$i]["Consulta"]           ;
            $ArrayConsulta[$i]["Requerimiento_Id"]      =   $con[$i]["Requerimiento_Id"]   ;
            $ArrayConsulta[$i]["Estado"]                =   0                              ;
        } 
        //---------------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------------
    }
    //--------------------------------------------------------------------------------------------
    $combo_poblacion='';
    $pobla=new Poblacion();
    $pob=$pobla->get_poblaciones();
    for($i=0;$i<sizeof($pob);$i++)
    {
        $combo_poblacion.= "<option value='".$pob[$i]['id']."'>".$pob[$i]['Poblacion']."</option>";
    }
    //---------------------------------------------------------------------------------------------

    //---------------------------------------------------------------------------------------------
    $titulo  = "Ingreso de Atenciones";
    $trabajo = new ActualizaAtencion();
    $resultado="1";
    if (isset($_POST["Rut_Ciudadano"])){ 
        $resultado = valida_rut($_POST["Rut_Ciudadano"]);
    }
    if ($resultado == "1" ) { 
        if (isset($_POST["Actualiza_Atencion"]) and $_POST["Actualiza_Si"] = "Grabar_Si") {
            $trabajo->Actualiza_Atencion_persona_existe();
            exit;
        } else {
            if (isset($_POST["Grabar_Nueva"]) and $_POST["Grabar_Nueva"] = "Grabar_Si") {
                $trabajo->Genera_Atencion_persona_existe();
                exit;
            } else {
                if (isset($_POST["Grabar"])) {
                    $trabajo->Genera_Atencion();
                    exit;
                } else {
                    if (isset($_GET["nueva"]) AND isset($_GET["Rut_Ciudadano"])) {
                        $existe_persona ="S";
                        $nueva_atencion ="S";
                        $tra=new Persona();
                        $datos_per=$tra->get_persona_por_rut($_GET["Rut_Ciudadano"]);
                        $titulo="Nueva Atencion";
                    } else {
                        if (isset($_GET["Atencion_Identificador"]) AND isset($_GET["Persona_Identificador"])) {
                            $actualiza_atencion = "S";
                            $existe_persona     = "S";
                            $tra                = new Persona();
                            $datos_pen=$tra->get_persona_por_id_atencion($_GET["Atencion_Identificador"]);
                            $titulo="Actualizacion Atencion Pendientea";
                        } else {
                            if(isset($_POST["Rut_Ciudadano"])){
                                $tra=new Persona();
                                $datos_per = $tra->get_persona_por_rut($_POST["Rut_Ciudadano"]);
                                if (sizeof($datos_per) == 0 ){
                                    $existe_persona = "N";
                                    $titulo="Atencion Persona no Existe";
                                } else {
                                    $id_persona         = $datos_per[0]["id"];
                                    $existe_persona     = 'S';
                                    $id_rut             = $_POST["Rut_Ciudadano"];
                                }
                                if ( $existe_persona == 'S')
                                {
                                    $tra=new Persona();
                                    $datos=$tra->get_persona_por_rut_atencion($_POST["Rut_Ciudadano"]);
                                    if ( sizeof($datos) == 0 ) 
                                    {
                                        $atencion_pendiente = 'N' ;
                                    } else {
                                        if ($datos[0]["Est_Ate"] == 1)
                                        {
                                            $atencion_pendiente_Atencion = "S"                  ;
                                            $atencion_pendiente_Consulta = "N"                  ;
                                            $atencion_pendiente          = "S"                  ;
                                            $id_ate                      = $datos[0]["num_ate"] ;
                                        } else {
                                            $atencion_pendiente_Consulta = "S"                  ;
                                            $atencion_pendiente_Atencion = "N"                  ;
                                            $atencion_pendiente          = "S"                  ;
                                            $id_ate             = $datos[0]["num_ate"]          ;
                                        }
                                        
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        $titulo = "Rut Ingresado es Erroneo";
    }
?>
<!DOCTYPE html>
    <html>
        <head>
            <?php require_once("../Include/Header.php");?>
            <script>

                function BuscaRequerimiento(Req)
                {
                    var Requerimiento = Req.value;
                    var dataString = 'Requerimiento='+Requerimiento;
                    $.ajax({
                        type: "POST",
                        url: "Ajax/Verifica_Requerimiento.php",
                        data: dataString,
                        success: function(data) {
                        $('#Info').fadeIn(1000).html(data);
                    }
                    });
                }

                function VerificaEstado()
                {
                    var elem_consulta = document.getElementsByName("ArrayConsulta[]");
                    if (elem_consulta[0].checked == true) 
                    {
                        for (x=1;x<elem_consulta.length;x++) 
                        {
                            elem_consulta[x].checked = false;
                        }
                    }
                }
                function onRutBlur(obj) 
                {
                    if (VerificaRut(obj.value)) {
                        return true;
                    } else {
                        swal("El rut Ingresado es Erroneo!");
                       }
                }
                function pendiente(Atencion,Persona)
                {
                    swal
                    ({
                            title:                  'Atencion Pendientes !!!'            ,
                            text:                   "Se detecto para ciudadano Atencion Pendiente"  ,
                            type:                   'warning'                                       ,
                            showCancelButton:        true                                           ,
                            confirmButtonColor:     '#3085d6'                                       ,
                            cancelButtonColor:      '#d33'                                          ,
                            confirmButtonText:      'Actualiza Atencion'                            ,
                            cancelButtonText:       'Salir'                                         ,
                            confirmButtonClass:     'btn-lg btn-success'                            ,
                            cancelButtonClass:      'btn-lg btn-danger'                             ,
                            buttonsStyling:          false
                        })
                        .then(function () 
                        {
                            window.location = 'Atenciones.php?Atencion_Identificador='+Atencion+'&Persona_Identificador='+Persona;
                        }, 
                        function (dismiss) 
                        {
                            if (dismiss === 'cancel') 
                            {
                                window.location = 'Atenciones.php' ;
                            }
                    })
                }

                function Consulta_Pendiente()
                {
                    swal({
                        title: "Consultas Pendientes!",
                        text: "Se detectaron Consultas Pendientes de Aprobacion.",
                        imageUrl: "../img/Pulgar.jpg"
                    });
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
                                    if (!isset($existe_persona))                                       {  require_once("form/Menu_Inactivo.php") ;   } 
                                    else { if ($existe_persona == "S" and isset($nueva_atencion)     ) {  require_once("form/Menu_Activo.php")   ;   } 
                                    else { if ($existe_persona == "S" and !isset($actualiza_atencion)) {  require_once("form/Menu_Inactivo.php") ;   } 
                                           else                                                        {  require_once("form/Menu_Activo.php")   ;   } 
                                         }}
                                        ?>
                                </ul>
                            </div>
                            <?php                
                            if (!isset($existe_persona)) { ?>
                                <form class="form-horizontal"  name="form_rut" id="form_rut" action="Atenciones.php" accept-charset="UTF-8" method="post"   >
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
                            <?php } else {
                                if ( $existe_persona == "N") 
                                {
                                    require_once("form/Form_Persona_No_Existe_Ingresa_Atencion.php");
                                } else {
                                    if (isset($actualiza_atencion)){
                                         require_once("form/Form_Persona_Existe_Atencion_Pendiente.php");
                                    } else {
                                        if (isset($nueva_atencion)) {
                                            require_once("form/Form_Persona_Existe_Nueva_Atencion.php");    
                                        } else {
                                            require_once("form/Form_Muestra_Persona_Existe_Atencion.php");
                                            if ( $atencion_pendiente == "S") {
                                                if ($atencion_pendiente_Atencion == 'S')
                                                {
                                                    echo "<script>"                         ;
                                                    echo "pendiente($id_ate,$id_persona)"   ;
                                                    echo "</script>";
                                                } else {
                                                    echo "<script>";
                                                    echo "Consulta_Pendiente()";
                                                    echo "</script>";
                                                }
                                            } ?>
                                            <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $datos_per[0]["id"];?>" id="getAtenciones" class="btn btn-sm btn-primary"> Desplegar Atenciones</button>
                                            <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $datos_per[0]["id"];?>" id="getMensajes" class="btn btn-sm btn-primary"> Desplegar Mensajes Atencion</button>
                                            <?php 
                                            if ($atencion_pendiente == "S") {} else { ?>
                                                <a href="Atenciones.php?nueva=S&Rut_Ciudadano=<?php echo $datos_per[0]["Rut"];?>" ><button type='button' class='btn btn-success'>Nueva Atencion</button></a>        
                                            <?php
                                            }
                                            
                                        }
                                        ?>                                        
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
<!-- ***************************************************************************************************** -->    
<!-- ***************************************************************************************************** -->    
<!-- ***************************************************************************************************** -->    
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
<!-- ***************************************************************************************************** -->    
<!-- ***************************************************************************************************** -->    
<!-- ***************************************************************************************************** -->    
