<?php
    require_once("../Paginacion/Logeo.php")                 ;      require_once("../Clases/ClaseUnidad.php")      ;
    require_once("../Clases/ClasePoblacion.php")            ;      require_once("../Clases/ClaseCalle.php")       ;
    require_once("../Clases/ClasePersona.php")              ;      require_once("../Clases/ClaseDireccion.php")   ;
    require_once("../Clases/ClaseLlamado.php")              ;      require_once("../Clases/ClaseEstado.php")      ;
    require_once("../Clases/ClaseAtencion.php")             ;      require_once("../Include/Rutinas.php")         ;
    require_once("../Clases/ClaseActualizaAtencion.php")    ;      require_once("../Clases/ClaseInformes.php")    ;
    require_once("../Clases/ClaseUsuario.php")              ;
    //require_once("../Include/Carga_Unidades.php")            ;
    $titulo  = "Atecniones Aculumadas"
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
                                <?php require_once("form/Menu_Resumen_Atencion_Acumulado.php") ;   ?>
                            </ul>
                        </div>
                        <?php
                        require_once("form/Muestra_Est_Atenciones.php")      ;  
                        ?>
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
                        url: 'Ajax/Get_Atenciones_Anio.php',
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