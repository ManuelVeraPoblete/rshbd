<?php
    require_once("../Paginacion/Logeo.php")                 ;       require_once("../Clases/ClasePersona.php")              ;      
    require_once("../Clases/ClaseAtencion.php")             ;       require_once("../Include/Rutinas.php")                  ;
    require_once("../Clases/ClaseInformes.php")             ;       require_once("../Clases/ClaseUsuario.php")              ;
    require_once("../Clases/ClaseLoteDigitacion.php")              ;
    $titulo  = "Cambio de Estados Detalle del Lote"; 
    if ( isset($_GET["Revision"] ) ) {
            $Estado = 3;
            $lote           = new LoteDigitacion                                    ;
            $datos   = $lote->Cambia_Estado_Lote_Detalle_Id($_GET["id_rev"], $Estado)    ;
            $Nuevo_Id   =   $_GET["Id_Cab"] ;
            $lote       =   new LoteDigitacion;
            $datos_lote =   $lote->get_lote_por_id($Nuevo_Id);
    } else {
        if ( isset($_GET["Aprueba"] ) ) {
            $Estado = 2;
            $lote           = new LoteDigitacion                                    ;
            $datos   = $lote->Cambia_Estado_Lote_Detalle_Id($_GET["id_apr"], $Estado)    ;
            $Nuevo_Id   =   $_GET["Id_Cab"] ;
            $lote       =   new LoteDigitacion;
            $datos_lote =   $lote->get_lote_por_id($Nuevo_Id);
        } else {
            $Nuevo_Id   =   $_GET["id"] ;
            $lote       =   new LoteDigitacion;
            $datos_lote =   $lote->get_lote_por_id($Nuevo_Id);
        }
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
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="Atenciones_Acumuladas">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="panel panel-primary filterable">
                                            <div class="panel-titulo">
                                                <h3 class="panel-title">Ingreso Encabezado</h3>      
                                            </div>
                                            <form class="form-horizontal" accept-charset="UTF-8" action=""  method="post">
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <?php 
                                                        if ( isset($datos_lote[0]["id"] ) ) { ?>
                                                            
                                                            <label class="control-label col-lg-2" for="email">Numero Lote:</label>
                                                            <input type="text" class="form-control" name="Numero_Lote" value="<?php echo $datos_lote[0]["Numero_Lote"];?>"   disabled>
                                                            <br>
                                                            <label class="control-label col-lg-2" for="email">Fecha :</label>
                                                            <input type="date" class="form-control" name="Fecha_Lote" value="<?php echo $datos_lote[0]["Fecha"];?>" placeholder="Fecha de Lote" disabled>
                                                            <br>
                                                            <label class="control-label col-lg-2" for="email">Digitador:</label>
                                                            <input type="text" class="form-control" name="Nombre" value="<?php echo  $datos_lote[0]["Nombre"].' '.$datos_lote[0]["Apellido"] ;?>"  disabled>
                                                            <?php
                                                        }  ?>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>    
                                    </div>
                                    <?php
                                        if ( isset($datos_lote[0]["id"] ) ) { ?>
                                            <div class="col-sm-8">
                                                <div class="panel panel-primary filterable">    
                                                    <div class="panel-titulo">
                                                        <h3 class="panel-title">Requerimientos</h3>      
                                                    </div>
                                                    <ul class="col3"> 
                                                        <?php 
                                                        for ($i=0; $i < sizeof($datos_lote) ; $i++) { 
                                                            if ( $datos_lote[$i]["Numero_Registro"] > 0 ) { ?>
                                                                <li> <?php
                                                                    if ( $datos_lote[$i]["Est_Detalle_Id"] == 1 ) 
                                                                    { ?>
                                                                        <a href="Aprueba_Lotes.php?id_rev=<?php echo $datos_lote[$i]['Ld_id'];?>&Revision=Si&Id_Cab=<?php echo $datos_lote[0]['id'];?>" title="Envia a Revision">
                                                                            <button type='button' class="btn btn-danger" data-toggle="modal" >
                                                                                <span class="glyphicon glyphicon-remove" ></span> 
                                                                            </button>                                                                                                   
                                                                        </a>

                                                                        <input type="text" class="form-control" name="Numero_Lote" value="<?php echo $datos_lote[$i]["Numero_Registro"];?>" disabled style="display: -webkit-inline-box;">
    
                                                                        <a href="Aprueba_Lotes.php?id_apr=<?php echo $datos_lote[$i]['Ld_id'];?>&Aprueba=Si&Id_Cab=<?php echo $datos_lote[0]['id'];?>" title="Envia a Aprobacion">
                                                                            <button type='button' class="btn btn-success" data-toggle="modal" >
                                                                                <span class="glyphicon glyphicon-ok" ></span> 
                                                                            </button>                                                                                                   
                                                                        </a> <?php
                                                                    } else { ?>
                                                                        <button type='button' class="btn " data-toggle="modal" >
                                                                            <span class="glyphicon glyphicon-remove" ></span> 
                                                                        </button>                                                                                                   
                                                                        <input type="text" class="form-control" name="Numero_Lote" value="<?php echo $datos_lote[$i]["Numero_Registro"];?>" disabled style="display: -webkit-inline-box;">
                                                                        <button type='button' class="btn " data-toggle="modal" >
                                                                            <span class="glyphicon glyphicon-ok" ></span> 
                                                                        </button>                                                                                                   
                                                                         <?php
                                                                        
                                                                    } ?>
                                                                </li> <?php
                                                            }
                                                        } ?>
                                                    </ul>
                                                </div>    
                                            </div> <?php
                                        } ?>
                                </div>
                            </div>
                        </div>
                        <center>
                            <div class="col-md-6">
                                <ul class="list-group">
                                    <a href="Lote_Digitacion.php" title="Elimina Item">
                                        <button class="form-control btn btn-primary">Regresar</button>   
                                    </a>

                                </ul>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <?php Include("../Include/footer.php");?>
    </body>
</html>