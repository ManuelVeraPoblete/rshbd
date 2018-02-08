<?php
    require_once("../Paginacion/Logeo.php")                 ;       require_once("../Clases/ClasePersona.php")              ;      
    require_once("../Clases/ClaseAtencion.php")             ;       require_once("../Include/Rutinas.php")                  ;
    require_once("../Clases/ClaseInformes.php")             ;       require_once("../Clases/ClaseUsuario.php")              ;
    require_once("../Clases/ClaseLoteDigitacion.php")       ;
    $titulo  = "Cambio de Estados Detalle del Lote"; 
    if ( isset($_GET["Aprueba"] ) ) {
        $lote               =   new LoteDigitacion                                                  ;
        $Estado             =   6                                                                   ;
        $datos              =   $lote->Cambia_Estado_Lote_Detalle_Id($_GET["id_apr"], $Estado)      ;
        $Nuevo_Id           =   $_GET["Id_Cab"]                                                     ;
        $lote               =   new LoteDigitacion                                                  ;
        $datos_lote         =   $lote->get_lote_por_id($Nuevo_Id)                                   ;
    } else {
            $Nuevo_Id   =   $_GET["id"] ;
            $lote       =   new LoteDigitacion;
            $datos_lote =   $lote->get_lote_por_id($Nuevo_Id);
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
                                    <div class="col-sm-5">
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
                                            <div class="col-sm-12">
                                                <div class="panel panel-primary filterable">    
                                                    <div class="panel-titulo">
                                                        <h3 class="panel-title">Requerimientos</h3>      
                                                    </div>
                                                    <ul class="col4"> 
                                                        <?php 
                                                        for ($i=0; $i < sizeof($datos_lote) ; $i++) { 
                                                            if ( $datos_lote[$i]["Numero_Registro"] > 0 ) { ?>
                                                                <li> <?php
                                                                    if ( $datos_lote[$i]["Est_Detalle_Id"] == 4 ) 
                                                                    { ?>
                                                                        
                                                                        <input type="text" class="form-control" name="Numero_Lote" value="<?php echo $datos_lote[$i]["Numero_Registro"];?>" disabled style="display: -webkit-inline-box;">
                                                                        <a href="Aprueba_Lotes_Despacho.php?id_apr=<?php echo $datos_lote[$i]['Ld_id'];?>&Aprueba=Si&Id_Cab=<?php echo $datos_lote[0]['id'];?>" title="Aprueba Digitacion">
                                                                            <button type='button' class="btn btn-success" data-toggle="modal" >
                                                                                <span class="glyphicon glyphicon-ok" ></span> 
                                                                            </button>                                                                                                   
                                                                        </a> <?php
                                                                    } else { ?>
                                                                        
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