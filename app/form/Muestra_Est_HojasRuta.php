<div class="panel-body">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="HojasRuta_Acumuladas">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                         <div class="panel-titulo">
                            <h3 class="panel-title">Hojas de Ruta</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Consulta         </th>
                                    <th>Generadas        </th>
                                    <th>Personas         </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Total_Generada_General = 0 ;
                                    $Total_Personas_General = 0 ;

                                    $hojas = new Informes();
                                    if ( isset($Fecha_Desde)) {
                                        $datos_hojas=$hojas->Get_Hojas_Ruta_Acumuladas_Fecha($Fecha_Desde , $Fecha_Hasta);
                                    } else {
                                        $datos_hojas=$hojas->Get_Hojas_Ruta_Acumuladas();
                                    }

                                    if ( sizeof($datos_hojas) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_hojas);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                <td><?php echo $datos_hojas[$i]["Consulta"];?>  </td>
                                                <td><?php echo $datos_hojas[$i]["Cantidad"];?>  </td>
                                                <?php 
                                                    $Personas = New Informes();
                                                    if (isset($Fecha_Desde)){
                                                        $Total_Personas = $Personas->Get_Hojas_Ruta_Acumuladas_Persona_Fecha($datos_hojas[$i]["Consulta_Id"], $Fecha_Desde, $Fecha_Hasta);
                                                    } else {
                                                        $Total_Personas = $Personas->Get_Hojas_Ruta_Acumuladas_Persona($datos_hojas[$i]["Consulta_Id"]);
                                                    }
                                                ?>
                                                <td><?php echo sizeof($Total_Personas);?>  </td>
                                                <?php 

                                                    $Total_Generada_General  = $Total_Generada_General + $datos_hojas[$i]["Cantidad"];
                                                    $Total_Personas_General  = $Total_Personas_General + sizeof($Total_Personas) ;
                                                ?>

                                              
                                            </tr>
                                        <?php   
                                        }
                                        ?>
                                        <tr>
                                            <td>Total </td>
                                            <td><?php echo $Total_Generada_General;?>  </td>
                                            <td><?php echo $Total_Personas_General;?>  </td>
                                        <tr> 
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Hojas de Ruta / Estados</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Consultas</th>
                                    <th>Encuestadas</th>
                                    <th>Pendientes</th>
                                    <th>Personas  </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  $Total_Encuestadas_General  = 0 ; $Total_Pendientes_General = 0 ; $Total_Personas_General  = 0 ;
                                  $detalle_Hojas = new Informes();
                                  if (isset($Fecha_Desde)) {
                                        $d_deta=$detalle_Hojas->Get_Hojas_Ruta_Detalle_Acumuladas_Fecha($Fecha_Desde , $Fecha_Hasta);
                                    } else {
                                        $d_deta=$detalle_Hojas->Get_Hojas_Ruta_Detalle_Acumuladas();
                                    }
                                    if ( sizeof($d_deta) == 0 ) {
                                    echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($d_deta);$i++)
                                        {    
                                        ?>
                                          <tr>
                                            <td><?php echo $d_deta[$i]["Consulta"];?></td>
                                            <td><?php echo $d_deta[$i]["Encuestadas"];?></td>
                                            <td><?php echo $d_deta[$i]["Pendientes"];?></td>
                                            <?php 
                                                $Personas = New Informes();
                                                if (isset($Fecha_Desde)) {
                                                    $Total_Personas = $Personas->Get_Hojas_Ruta_Acumuladas_Persona_Fecha($d_deta[$i]["Consulta_Id"], $Fecha_Desde, $Fecha_Hasta);
                                                } else {
                                                    $Total_Personas = $Personas->Get_Hojas_Ruta_Acumuladas_Persona($d_deta[$i]["Consulta_Id"]);
                                                }
                                            ?>
                                            <td><?php echo sizeof($Total_Personas);?>  </td>
                                            <?php 
                                                $Total_Encuestadas_General  =  $Total_Encuestadas_General   + $d_deta[$i]["Encuestadas"];
                                                $Total_Pendientes_General   =  $Total_Pendientes_General    + $d_deta[$i]["Pendientes"];
                                                $Total_Personas_General     =  $Total_Personas_General      + sizeof($Total_Personas) ;
                                            ?>
                                          <tr>
                                        <?php   
                                        } ?>
                                        <tr>
                                            <td> Total </td>
                                            <td><?php echo $Total_Encuestadas_General;?></td>
                                            <td><?php echo $Total_Pendientes_General ;?></td>
                                            <td><?php echo $Total_Personas_General   ;?></td>
                                        </tr>

                                        <?php
                                     }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Atenciones_Sector">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Hojas de Ruta  / Sector</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Sector            </th>
                                    <th>Personas          </th>
                                    <th>Encuestadas       </th>
                                    <th>Pendientes        </th>
                                    <th>Total             </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Total_Personas_General         = 0 ;
                                    $Total_Encuestadas_General      = 0 ;
                                    $Total_Pendientes_General       = 0 ;
                                    $Total_Total_General            = 0 ;
                                    
                                    $atenciones = new Informes();
                                    if (isset($Fecha_Desde))
                                    {
                                        $datos_atenciones=$atenciones->Get_Hoja_Resumen_Sector_Fecha($Fecha_Desde , $Fecha_Hasta);
                                    } else {
                                        $datos_atenciones=$atenciones->Get_Hoja_Resumen_Sector();
                                    }
                                    if ( sizeof($datos_atenciones) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_atenciones);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                <td><?php echo $datos_atenciones[$i]["Sector"];?>       </td>
                                                <?php 
                                                    $Personas = New Informes();
                                                    if (isset($Fecha_Desde)) {
                                                        $Total_Personas = $Personas->Get_Hoja_Resumen_Sector_Persona_Fecha($datos_atenciones[$i]["Sector_Id"], $Fecha_Desde , $Fecha_Hasta);
                                                    } else {
                                                        $Total_Personas = $Personas->Get_Hoja_Resumen_Sector_Persona($datos_atenciones[$i]["Sector_Id"]);
                                                    }
                                                ?>
                                                <td><?php echo sizeof($Total_Personas);?>  </td>
                                                <td><?php echo $datos_atenciones[$i]["Encuestadas"];?>  </td>
                                                <td><?php echo $datos_atenciones[$i]["Pendientes"];?>   </td>
                                                <td><?php echo $datos_atenciones[$i]["Encuestadas"]  +        
                                                               $datos_atenciones[$i]["Pendientes"] ;?>
                                                </td>

                                                <?php
                                                    $Total_Personas_General     = $Total_Personas_General       + sizeof($Total_Personas);
                                                    $Total_Encuestadas_General  = $Total_Encuestadas_General    + $datos_atenciones[$i]["Encuestadas"];
                                                    $Total_Pendientes_General   = $Total_Pendientes_General     + $datos_atenciones[$i]["Pendientes"];
                                                    $Total_Total_General        = $Total_Total_General          + $datos_atenciones[$i]["Encuestadas"]  + 
                                                                                                                  $datos_atenciones[$i]["Pendientes"]   ;
                                                ?>

                                            <tr>
                                        <?php   
                                       }?>
                                        <tr>
                                            <td>Total</td>
                                            <td><?php echo $Total_Personas_General    ;?>   </td>
                                            <td><?php echo $Total_Encuestadas_General ;?>   </td>
                                            <td><?php echo $Total_Pendientes_General  ;?>   </td>
                                            <td><?php echo $Total_Total_General       ;?>   </td>
                                        </tr> <?php
                                  }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Hojas de Ruta  / Sector / Detalle</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Sector            </th>
                                    <th>Tipo              </th>
                                    <th>Encuestadas       </th>
                                    <th>Pendientes        </th>
                                    <th>Total             </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Total_Encuestadas_General  = 0;
                                    $Total_Pendientes_General   = 0;
                                    $Total_Total_General        = 0;
                                    
                                    $atenciones = new Informes();
                                    if (isset($Fecha_Desde)) {
                                        $datos_atenciones=$atenciones->Get_Hoja_Detalle_Sector_Fecha($Fecha_Desde, $Fecha_Hasta);
                                    } else {
                                        $datos_atenciones=$atenciones->Get_Hoja_Detalle_Sector();
                                    }
                                    if ( sizeof($datos_atenciones) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_atenciones);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                <td><?php echo $datos_atenciones[$i]["Sector"];?>       </td>
                                                <td><?php echo $datos_atenciones[$i]["Consulta"];?>     </td>
                                                <td><?php echo $datos_atenciones[$i]["Encuestadas"];?>  </td>
                                                <td><?php echo $datos_atenciones[$i]["Pendientes"];?>   </td>
                                                <td><?php echo $datos_atenciones[$i]["Encuestadas"]  +        
                                                               $datos_atenciones[$i]["Pendientes"] ;?>  </td>

                                                <?php 
                                                    $Total_Encuestadas_General  = $Total_Encuestadas_General + $datos_atenciones[$i]["Encuestadas"] ;
                                                    $Total_Pendientes_General   = $Total_Pendientes_General  + $datos_atenciones[$i]["Pendientes"]  ;
                                                    $Total_Total_General        = $Total_Total_General       + $datos_atenciones[$i]["Encuestadas"] + $datos_atenciones[$i]["Pendientes"] ;
                                                ?>


                                            <tr>
                                        <?php   
                                        } ?>
                                        <tr>
                                            <td>Total</td>
                                            <td></td>
                                            <td><?php echo $Total_Encuestadas_General ;?> </td>
                                            <td><?php echo $Total_Pendientes_General  ;?> </td>
                                            <td><?php echo $Total_Total_General       ;?> </td>
                                        </tr> <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Atenciones_Mensuales">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Hojas de Ruta  / Encuestador</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Encuestador </th>
                                    <th>Personas    </th>
                                    <th>A2 </th>
                                    <th>E </th>
                                    <th>ERROR </th>
                                    <th>NOENC </th>
                                    <th>NV </th>
                                    <th>P1 </th>
                                    <th>P2 </th>
                                    <th>P3 </th>
                                    <th>P4 </th>
                                    <th>P5 </th>
                                    <th>P6 </th>
                                    <th>P7 </th>
                                    <th>P8 </th>
                                    <th>R2 </th>
                                    <th>ANUL </th>
                                    <th>DES </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Pendientes           = 0 ; $Cerradas             = 0 ;
                                    $Total_Personas       = 0 ; $Numero_Hoja_Paso     = 0 ;

                                    $Total_Persona_Hoja_Ruta        = 0 ; $Total_A2                       = 0 ; $Total_E                        = 0 ;
                                    $Total_ERROR                    = 0 ;$Total_NOENC                     = 0 ; $Total_NV                       = 0 ;
                                    $Total_P1                       = 0 ; $Total_P2                       = 0 ; $Total_P3                       = 0 ;
                                    $Total_P4                       = 0 ; $Total_P5                       = 0 ; $Total_P6                       = 0 ;
                                    $Total_P7                       = 0 ; $Total_P8                       = 0 ; $Total_R2                       = 0 ;
                                    $Total_ANUL                     = 0 ; $Total_DES                      = 0 ;
                                    $Total_ERROR = 0 ;$Total_NOENV = 0;


                                    $Hojas = new Informes();
                                    if (isset($Fecha_Desde)){
                                        $datos_hojas=$Hojas->Get_Hojas_Ruta_Encuestador_Acumuladas_Fecha($Fecha_Desde, $Fecha_Hasta);
                                    } else {
                                        $datos_hojas=$Hojas->Get_Hojas_Ruta_Encuestador_Acumuladas();
                                    }
                                    if ( sizeof($datos_atenciones) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_hojas);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                
                                                <td><?php echo $datos_hojas[$i]["Nombre"].' '.$datos_hojas[$i]["Apellido"] ;?>     </td>
                                                <?php 
                                                    $Persona = new Informes();
                                                    if (isset($Fecha_Desde)) {
                                                        $Cuenta_Personas_HR=$Persona-> Get_Personas_Hojas_Ruta_Acumuladas_Fecha($datos_hojas[$i]["Usuario_Id"], $Fecha_Desde, $Fecha_Hasta);
                                                    } else {
                                                        $Cuenta_Personas_HR=$Persona-> Get_Personas_Hojas_Ruta_Acumuladas($datos_hojas[$i]["Usuario_Id"]);
                                                    }
                                                ?>
                                                <td><?php echo $Cuenta_Personas_HR[0]["Persona_Hoja_Ruta"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["A2"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["E"];?>     </td>
                                                <td><?php echo $datos_hojas[$i]["ERROR"];?> </td>
                                                <td><?php echo $datos_hojas[$i]["NOENC"];?> </td>
                                                <td><?php echo $datos_hojas[$i]["NV"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P1"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P2"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P3"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P4"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P5"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P6"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P7"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P8"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["R2"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["ANUL"];?>  </td>
                                                <td><?php echo $datos_hojas[$i]["DES"];?>   </td>

                                                <?php 
                                                    $Total_Persona_Hoja_Ruta  =   $Total_Persona_Hoja_Ruta  + $Cuenta_Personas_HR[0]["Persona_Hoja_Ruta"];
                                                    $Total_A2           =   $Total_A2           +  $datos_hojas[$i]["A2"];
                                                    $Total_E            =   $Total_E            +  $datos_hojas[$i]["E"];
                                                    $Total_ERROR        =   $Total_ERROR          +  $datos_hojas[$i]["ERROR"];
                                                    $Total_NOENC        =   $Total_NOENC          +  $datos_hojas[$i]["NOENC"];
                                                    $Total_NV           =   $Total_NV           +  $datos_hojas[$i]["NV"];
                                                    $Total_P1           =   $Total_P1           +  $datos_hojas[$i]["P1"];
                                                    $Total_P2           =   $Total_P2           +  $datos_hojas[$i]["P2"];
                                                    $Total_P3           =   $Total_P3           +  $datos_hojas[$i]["P3"];
                                                    $Total_P4           =   $Total_P4           +  $datos_hojas[$i]["P4"];
                                                    $Total_P5           =   $Total_P5           +  $datos_hojas[$i]["P5"];
                                                    $Total_P6           =   $Total_P6           +  $datos_hojas[$i]["P6"];
                                                    $Total_P7           =   $Total_P7           +  $datos_hojas[$i]["P7"];
                                                    $Total_P8           =   $Total_P8           +  $datos_hojas[$i]["P8"];
                                                    $Total_R2           =   $Total_R2           +  $datos_hojas[$i]["R2"];
                                                    $Total_ANUL         =   $Total_ANUL         +  $datos_hojas[$i]["ANUL"];
                                                    $Total_DES          =   $Total_DES          +  $datos_hojas[$i]["DES"];
                                                ?>
                                            <tr>
                                        <?php   
                                        }
                                        ?>
                                        <tr>
                                                <td>Total </td>
                                                <td><?php echo $Total_Persona_Hoja_Ruta;?>    </td>
                                                <td><?php echo $Total_A2 ;?>    </td>
                                                <td><?php echo $Total_E ;?>     </td>
                                                <td><?php echo $Total_ERROR ;?>   </td>
                                                <td><?php echo $Total_NOENC ;?>   </td>
                                                <td><?php echo $Total_NV ;?>    </td>
                                                <td><?php echo $Total_P1 ;?>    </td>
                                                <td><?php echo $Total_P2 ;?>    </td>
                                                <td><?php echo $Total_P3 ;?>    </td>
                                                <td><?php echo $Total_P4 ;?>    </td>
                                                <td><?php echo $Total_P5 ;?>    </td>
                                                <td><?php echo $Total_P6 ;?>    </td>
                                                <td><?php echo $Total_P7 ;?>    </td>
                                                <td><?php echo $Total_P8 ;?>    </td>
                                                <td><?php echo $Total_R2 ;?>    </td>
                                                <td><?php echo $Total_ANUL ;?>  </td>
                                                <td><?php echo $Total_DES ;?>   </td>

                                        </tr> <?php
                                  }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Acumulado_Atenciones">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Hojas de Ruta  / Encuestador</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Año         </th>
                                    <th>Mes         </th>
                                    <th>Encuestador </th>
                                    <th>Personas    </th>
                                    <th>Logradas    </th>
                                    <th>No Logradas </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Pendientes           = 0 ; $Cerradas             = 0 ;
                                    $Total_Personas       = 0 ; $Numero_Hoja_Paso     = 0 ;

                                              


                                    $Hojas = new Informes();
                                    if (isset($Fecha_Desde)){
                                        $datos_hojas=$Hojas->Get_Hojas_Ruta_Encuestador_Acumuladas_Fecha_Resumen($Fecha_Desde, $Fecha_Hasta);
                                    } else {
                                        $datos_hojas=$Hojas->Get_Hojas_Ruta_Encuestador_Acumuladas_Resumen();
                                    }
                                    if ( sizeof($datos_atenciones) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_hojas);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                <td><?php echo $datos_hojas[$i]["Ano_Proceso"] ;?></td>
                                                <td><?php echo $datos_hojas[$i]["Mes_Proceso"] ;?></td>
                                                <td><?php echo $datos_hojas[$i]["Nombre"].' '.$datos_hojas[$i]["Apellido"] ;?>     </td>
                                                <?php 
                                                    $Persona = new Informes();
                                                    if (isset($Fecha_Desde)) {
                                                        $Cuenta_Personas_HR=$Persona-> Get_Personas_Hojas_Ruta_Acumuladas_Fecha_Resumen($datos_hojas[$i]["Usuario_Id"], $datos_hojas[$i]["Ano_Proceso"] , $datos_hojas[$i]["Mes_Proceso"]);
                                                    } else {
                                                        $Cuenta_Personas_HR=$Persona-> Get_Personas_Hojas_Ruta_Acumuladas($datos_hojas[$i]["Usuario_Id"]);
                                                    }
                                                ?>
                                                <td><?php echo $Cuenta_Personas_HR[0]["Persona_Hoja_Ruta"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["Logradas"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["Resto"];?>     </td>
                                            
                                            <tr>
                                        <?php   
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>