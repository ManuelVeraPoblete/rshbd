<?php
    require_once("../Paginacion/Logeo.php")                 ;       require_once("../Clases/ClasePersona.php")              ;      
    require_once("../Clases/ClaseAtencion.php")             ;       require_once("../Include/Rutinas.php")                  ;
    require_once("../Clases/ClaseInformes.php")             ;       require_once("../Clases/ClaseUsuario.php")              ;
    require_once("../Clases/ClaseLoteDigitacion.php")              ;
    $titulo  = "Ingreso de Lotes a Digitacion"; 
    if ( isset($_POST["Grabar_Detalle"]) and $_POST["Grabar_Detalle"] == "SI" ) {
        $Num_Registro   = $_POST["Numero_Registro"]                             ;
        $Lote_Id        = $_POST["Lote_Id"]                                     ;
        $lote           = new LoteDigitacion                                    ;
        $Nuevo_Id       = $lote->add_lote_detalle($Num_Registro, $Lote_Id)      ;
        $_POST["Grabar_Detalle"] = "No";
        //-----------------------------------------------------------------------
        $Nuevo_Id       = $_POST["Lote_Id"]                                     ; 
        $lote           = new LoteDigitacion                                    ;
        $datos_lote=$lote->get_lote_por_id($Nuevo_Id)                           ;
    } else {
        if ( isset($_POST["Grabar"]) AND  $_POST["Grabar"] =="SI" ) {
            if ( isset($_POST["Numero_Lote"]) and 
                isset($_POST["Fecha_Lote"]) and 
                isset($_POST["Usuario_Id"]) ) {
                $lote = new LoteDigitacion ;
                $Nuevo_Id = $lote->add_lote_encabezado();
                $lote = new LoteDigitacion;
                $datos_lote=$lote->get_lote_por_id($Nuevo_Id);
            }
        } else {
            if (isset($_GET["id"])) {
                $Nuevo_Id   =   $_GET["id"] ;
                $lote       =   new LoteDigitacion;
                $datos_lote =   $lote->get_lote_por_id($Nuevo_Id);
            } else {
                if (isset($_GET["Elimina"]) ) {
                    $Id_Eliminar    =   $_GET["id_eli"] ;
                    $lote           =   new LoteDigitacion;
                    $datos_lote     =   $lote->Elimina_Lote_Por_Id($Id_Eliminar);
                    //-----------------------------------------------------------------------------------
                    $Nuevo_Id       =   $_GET["Id_Cab"] ;
                    $lote           =   new LoteDigitacion;
                    $datos_lote     =   $lote->get_lote_por_id($Nuevo_Id);
                } else {
                    $lote           =   new LoteDigitacion;
                    $datos_lote     =   $lote->get_ultimo_lote();
                    $Ultimo_lote = $datos_lote[0]["ultimo"];
                    $Ultimo_lote = $Ultimo_lote + 1;
                }
            } 
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
                                    <div class="col-sm-12">
                                        <div class="panel panel-primary filterable">
                                            <div class="panel-titulo">
                                                <?php 
                                                    if ( isset($datos_lote[0]["id"] ) ) { ?>
                                                        <h3 class="panel-title">Encabezado // <?php echo 'Numero Lote : '.
                                                                                                         $datos_lote[0]["Numero_Lote"].
                                                                                                         ' Fecha : '.
                                                                                                         $datos_lote[0]["Fecha"].
                                                                                                         ' Digitadora : '.
                                                                                                         $datos_lote[0]["Nombre"].' '.
                                                                                                         $datos_lote[0]["Apellido"] ;?> 
                                                        </h3> <?php
                                                    } else { ?>
                                                        <h3 class="panel-title">Encabezado </h3> <?php
                                                    } ?>
                                            </div>
                                            <form class="form-horizontal" accept-charset="UTF-8" action=""  method="post">
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <?php 
                                                        if ( isset($datos_lote[0]["id"] ) ) { ?>
                                                            <?php
                                                        } else  { ?>
                                                            <input type="hidden" name="Numero_Lote" value="<?php echo  $Ultimo_lote ;?>" >
                                                            <input type="hidden" name="Fecha_Lote" value="<?php echo date("Y-m-d");?>">
                                                            <label class="control-label col-lg-2" for="email">Numero Lote:</label>
                                                            <input type="text" class="form-control" name="N_Lote" required value="<?php echo  $Ultimo_lote ;?>" disabled >
                                                            <br>
                                                            <label class="control-label col-lg-2" for="email">Fecha :</label>
                                                            <input type="date" class="form-control" name="F_Lote" value="<?php echo date("Y-m-d");?>" placeholder="Fecha de Lote" disabled>
                                                            <br>
                                                            <label class="control-label col-lg-2" for="email">Digitador:</label>
                                                            <select name="Usuario_Id" class="form-control">
                                                                <?php
                                                                    $usr = new Usuario();
                                                                    $datos_usuario = $usr->get_usuarios();
                                                                    for($i=0;$i<sizeof($datos_usuario);$i++)
                                                                    {
                                                                        ?>
                                                                    <option  value="<?php echo $datos_usuario[$i]["id"];?>"><?php echo $datos_usuario[$i]["Nombre"].' '.$datos_usuario[$i]["Apellido"] ;?></option>
                                                                    <?php 
                                                                }?>
                                                            </select>
                                                            <input type="hidden" name="Grabar" value="SI">
                                                            <div class="panel-heading">
                                                                <div class="btn-group pull-right">
                                                                    <button type="button submit" class="btn btn-info" data-toggle="modal" >
                                                                        <span class="glyphicon glyphicon-plus" ></span> 
                                                                        Graba Encabezado
                                                                    </button>   
                                                                </div>
                                                            </div>  <?php  
                                                        } ?>
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
                                                    <form class="form-horizontal" accept-charset="UTF-8" action=""  method="post">
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                            <label class="control-label col-lg-2" for="email">Numero Registro:</label>
                                                            <input type="text" class="form-control" name="Numero_Registro" style="display: -webkit-inline-box;" autofocus>
                                                            <input type="hidden" name="Grabar_Detalle" value="SI">
                                                            <input type="hidden" name="Lote_Id" value="<?php echo $datos_lote[0]["id"];?>">
                                                            <button type="button submit" class="btn btn-info" data-toggle="modal" >
                                                                <span class="glyphicon glyphicon-plus-sign" ></span> 
                                                            </button>   
                                                            <br><br>
                                                        </div>
                                                    </form>
                                                    <ul class="col4"> 
                                                        <?php 
                                                        for ($i=0; $i < sizeof($datos_lote) ; $i++) { 
                                                            if ( $datos_lote[$i]["Numero_Registro"] > 0 ) { ?>
                                                                <li>
                                                                    <a href="AddLotes.php?id_eli=<?php echo $datos_lote[$i]['Ld_id'];?>&Elimina=Si&Id_Cab=<?php echo $datos_lote[0]['id'];?>" title="Elimina Item">
                                                                        <button type='button' class="btn btn-danger" data-toggle="modal" >
                                                                            <span class="glyphicon glyphicon-trash" ></span> 
                                                                        </button>                                                                                                   
                                                                    </a>
                                                                    <input type="text" class="form-control" name="Numero_Lote" value="<?php echo $datos_lote[$i]["Numero_Registro"];?>" disabled style="display: -webkit-inline-box;">
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