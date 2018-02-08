<?php
    require_once("../Paginacion/Logeo.php")                 ;      require_once("../Clases/ClaseUnidad.php")      ;
    require_once("../Clases/ClasePoblacion.php")            ;      require_once("../Clases/ClaseCalle.php")       ;
    require_once("../Clases/ClasePersona.php")              ;      require_once("../Clases/ClaseDireccion.php")   ;
    require_once("../Clases/ClaseLlamado.php")              ;      require_once("../Clases/ClaseEstado.php")      ;
    require_once("../Clases/ClaseAtencion.php")             ;      require_once("../Include/Rutinas.php")         ;
    require_once("../Clases/ClaseActualizaAtencion.php")    ;      require_once("../Clases/ClaseUsuario.php")     ;
    require_once("../Clases/ClaseConsulta.php")             ;      require_once("../Clases/ClaseRespuesta.php")   ;
    require_once("../Clases/ClaseSector.php")               ;      
    $titulo  = "Resultados Hojas de Ruta";
    $Hoja = new ActualizaAtencion();
 
    $Actualiza_Hojas_de_Ruta = "N";
    if (isset($_POST["Numero_Hoja"])){ 
       $datos=$Hoja->get_hoja_por_numero($_POST["Numero_Hoja"]);
       $Cantidad_Datos = count($datos);
       if ($Cantidad_Datos < 1 ) {
            $Muestra_Resultados = "N";
            $titulo = "Numero de Hoja no existe";
       } else {
         $Muestra_Resultados = "S";
       }
    } else 
        { 
            if (   isset($_POST["Actualiza"])    and
                         $_POST["Actualiza"]   == "S"              )
                    {

                        $Actualiza_Hojas_de_Ruta   =  "S";
                    }
            else { $Actualiza_Hojas_de_Ruta     =  "N";}
        }

if (isset($_POST["datos"])){
       $datos_grabar = $_POST["datos"];    
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
                                <?php require_once("form/Menu_Resultado_Hoja.php") ;   ?>
                            </ul>
                            <?php 
                            if ( $Actualiza_Hojas_de_Ruta == "S") {
                                require_once("form/Actualiza_Hojas_de_Ruta.php");
                            } else {
                                if (isset($Muestra_Resultados) and $Muestra_Resultados == "S") { 
                                    require_once("form/Form_Ingreso_Resultado_Hoja_Ruta.php");
                                } else { ?>
                                    <form class="form-horizontal" accept-charset="UTF-8" action="Ingreso_de_Respuestas_Hojas_de_Ruta.php"  method="post">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="control-label col-lg-2" for="email">Numero Hoja de Ruta:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="Numero_Hoja"  placeholder="Ingrese Numero Hoja">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php Include("../Include/footer.php");?>
    </body>

    <script>
    
        $(document).ready(function(){
                $(document).on('click', '#getHistorico', function(e){
                    e.preventDefault();
                    var uid = $(this).data('id');   // it will get id of clicked row
                    $('#dynamic-content').html(''); // leave it blank before ajax call
                    $('#modal-loader').show();      // load ajax loader
                    $.ajax({
                        url: 'Ajax/Get_Historico.php',
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
                    <i class="glyphicon glyphicon-user"></i> Historico de Encuestas
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