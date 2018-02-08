<div class="panel-body">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="Atenciones_Acumuladas">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary filterable">
                        <?php
                            $Nuevo_Id   =   $_GET["id"] ;
                            $lote       =   new LoteDigitacion;
                            $datos_lote =   $lote->get_lote_por_id($Nuevo_Id);

                            $Titulo = 'Impresion Lote Nro : '. $datos_lote[0]["Numero_Lote"] .' con Fecha : '.$datos_lote[0]["Fecha"].' Digitador : '.$datos_lote[0]["Nombre"].' '.$datos_lote[0]["Apellido"] ;
                        ?>
                        <div class="panel-titulo">
                            <h3 class="panel-title"><?php echo $Titulo ; ?> </h3>      
                            <h5> Nro. Registro </h5>
                        </div>
                            <ul class="col4"> 
                                <?php 
                                for ($i=0; $i < sizeof($datos_lote) ; $i++) { 
                                    if ( $datos_lote[$i]["Numero_Registro"] > 0 ) { ?>
                                        <li>
                                            <input type="text" class="form-control" name="Numero_Lote" value="<?php echo $datos_lote[$i]["Numero_Registro"];?>" disabled style="display: -webkit-inline-box;">
                                        </li> <?php
                                    }
                                } ?>
                            </ul>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>