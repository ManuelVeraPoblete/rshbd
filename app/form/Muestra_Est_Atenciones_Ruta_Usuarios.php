<div class="panel-body">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="Atenciones_Acumuladas">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Atenciones / Requerimiento</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Requerimiento     </th>
                                    <th>Personas          </th>
                                    <th>Pendientes        </th>
                                    <th>Aprobadas          </th>
                                    <th>Rechazadas        </th>
                                    <th>Total           aa  </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $atenciones = new Informes();
                                    if (isset($Usuario_Busqueda)) {
                                        $datos_atenciones=$atenciones->Get_Atenciones_Acumuladas_Requerimiento_Fecha_Usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
                                    } 
                                    else 
                                    {
                                        if (isset($Fecha_Desde)) {
                                            $datos_atenciones=$atenciones->Get_Atenciones_Acumuladas_Requerimiento_Fecha($Fecha_Desde , $Fecha_Hasta);
                                        } 
                                        else 
                                        {
                                            $datos_atenciones=$atenciones->Get_Atenciones_Acumuladas_Requerimiento();
                                        }
                                    }
                                    if ( sizeof($datos_atenciones) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_atenciones);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                <td><?php echo $datos_atenciones[$i]["Requerimiento"];?>  </td>
                                                <?php
                                                    $Personas = new Informes();
                                                    if (isset($Usuario_Busqueda)) {
                                                        $Total_Personas = $Personas->Get_Atenciones_Personas_Requerimiento_Fecha_Usuario($datos_atenciones[$i]["Requerimiento_Id"] , $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda);
                                                    } else { 
                                                        if (isset($Fecha_Desde)) {
                                                            $Total_Personas = $Personas->Get_Atenciones_Personas_Requerimiento_Fecha($datos_atenciones[$i]["Requerimiento_Id"] , $Fecha_Desde, $Fecha_Hasta);
                                                        } else {
                                                            $Total_Personas = $Personas->Get_Atenciones_Personas_Requerimiento($datos_atenciones[$i]["Requerimiento_Id"]);
                                                        }
                                                    }
                                                ?>
                                                <td><?php echo sizeof($Total_Personas);?>     </td>                                            
                                                <td><?php echo $datos_atenciones[$i]["Pendientes"];?>     </td>
                                                <td><?php echo $datos_atenciones[$i]["Aprovadas"];?>      </td>
                                                <td><?php echo $datos_atenciones[$i]["Anuladas"];?>       </td>
                                                <td><?php echo $datos_atenciones[$i]["Pendientes"]    +        
                                                               $datos_atenciones[$i]["Aprovadas"]     +        
                                                               $datos_atenciones[$i]["Anuladas"];?>
                                                </td>
                                            <tr>
                                        <?php   
                                      }
                                  }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Atenciones / Requerimiento / Consultas</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Requerimiento</th>
                                    <th>Consulta</th>
                                    <th>Personas</th>
                                    <th>Pendientes</th>
                                    <th>Cerradas</th>
                                    <th>Rechazadas</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Pendientes = 0 ; $Cerradas = 0;
                                    $Total_Personas = 0;
                                    $Numero_Hoja_Paso = 0;
                                    $atenciones = new Informes();
                                    if (isset($Usuario_Busqueda)) {
                                        $datos_atenciones=$atenciones->Get_Atenciones_Acumuladas_Fecha_Usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
                                    } else {
                                        if (isset($Fecha_Desde)) {
                                            $datos_atenciones=$atenciones->Get_Atenciones_Acumuladas_Fecha($Fecha_Desde , $Fecha_Hasta);
                                        } else {
                                            $datos_atenciones=$atenciones->Get_Atenciones_Acumuladas();
                                        }
                                    }
                                    if ( sizeof($datos_atenciones) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_atenciones);$i++)
                                        { 
                                        ?>
                                          <tr>
                                            <td><?php echo $datos_atenciones[$i]["Requerimiento"];?></td>
                                            <td><?php echo $datos_atenciones[$i]["Consulta"];?></td>
                                            <?php
                                                $Personas = new Informes();
                                                if (isset($Usuario_Busqueda)) {
                                                    $Total_Personas = $Personas->Get_Atenciones_Personas_Consultas_Fecha_Usuario($datos_atenciones[$i]["Consulta_Id"], $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda);
                                                } else {
                                                    if (isset($Fecha_Desde)) {
                                                        $Total_Personas = $Personas->Get_Atenciones_Personas_Consultas_Fecha($datos_atenciones[$i]["Consulta_Id"], $Fecha_Desde, $Fecha_Hasta);
                                                    } else {
                                                        $Total_Personas = $Personas->Get_Atenciones_Personas_Consultas($datos_atenciones[$i]["Consulta_Id"]);
                                                    }
                                                }
                                            ?>
                                            <td><?php echo sizeof($Total_Personas);?>     </td>
                                            <td><?php echo $datos_atenciones[$i]["Pendientes"];?></td>
                                            <td><?php echo $datos_atenciones[$i]["Aprovadas"];?></td>
                                            <td><?php echo $datos_atenciones[$i]["Anuladas"];?></td>
                                            <td><?php echo $datos_atenciones[$i]["Pendientes"]+        
                                                           $datos_atenciones[$i]["Aprovadas"]+        
                                                           $datos_atenciones[$i]["Anuladas"];?>
                                            </td>
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
        <div class="tab-pane fade" id="Atenciones_Sector">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Atenciones / Sector</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Sector            </th>
                                    <th>Personas          </th>
                                    <th>Pendientes        </th>
                                    <th>Cerradas          </th>
                                    <th>Rechazadas        </th>
                                    <th>Total             </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Pendientes           = 0 ; $Cerradas             = 0 ;
                                    $Total_Personas       = 0 ; $Numero_Hoja_Paso     = 0 ;
                                    $atenciones = new Informes();
                                    if (isset($Usuario_Busqueda)) {
                                        $datos_atenciones=$atenciones-> Get_Atenciones_Acumuladas_Sector_Fecha_Usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
                                    } else {
                                        if (isset($Fecha_Desde)) {
                                            $datos_atenciones=$atenciones-> Get_Atenciones_Acumuladas_Sector_Fecha($Fecha_Desde , $Fecha_Hasta);
                                        } else { 
                                            $datos_atenciones=$atenciones-> Get_Atenciones_Acumuladas_Sector();
                                        }
                                    }
                                    if ( sizeof($datos_atenciones) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_atenciones);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                <td><?php echo $datos_atenciones[$i]["Sector"];?>  </td>
                                                <?php
                                                    $Personas = new Informes();
                                                    if (isset($Usuario_Busqueda)) {
                                                        $Total_Personas = $Personas->Get_Atenciones_Personas_Sector_Fecha_Usuario($datos_atenciones[$i]["Sector_Id"], $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda);
                                                    } else  {
                                                        if (isset($Fecha_Desde)) {
                                                            $Total_Personas = $Personas->Get_Atenciones_Personas_Sector_Fecha($datos_atenciones[$i]["Sector_Id"], $Fecha_Desde, $Fecha_Hasta);
                                                        } else {
                                                            $Total_Personas = $Personas->Get_Atenciones_Personas_Sector($datos_atenciones[$i]["Sector_Id"]);
                                                        }
                                                    }
                                                ?>
                                                <td><?php echo sizeof($Total_Personas);?>     </td>
                                                <td><?php echo $datos_atenciones[$i]["Pendientes"];?>     </td>
                                                <td><?php echo $datos_atenciones[$i]["Aprovadas"];?>      </td>
                                                <td><?php echo $datos_atenciones[$i]["Anuladas"];?>       </td>
                                                <td><?php echo $datos_atenciones[$i]["Pendientes"]    +        
                                                               $datos_atenciones[$i]["Aprovadas"]     +        
                                                               $datos_atenciones[$i]["Anuladas"];?>
                                                </td>
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
        <div class="tab-pane fade" id="Atenciones_Mensuales">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Atenciones / Anuales</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Año         </th>
                                    <th>Personas    </th>
                                    <th>Pendiente   </th>
                                    <th>Aprobadas   </th>
                                    <th>Rechazadas  </th>
                                    <th>Total       </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Pendientes           = 0 ; $Cerradas             = 0 ;
                                    $Total_Personas       = 0 ; $Numero_Hoja_Paso     = 0 ;
                                    $atenciones = new Informes();
                                    if (isset($Usuario_Busqueda)) {
                                        $datos_atenciones=$atenciones-> Get_Atenciones_Acumuladas_Anual_Fecha_Usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
                                    } else {
                                        if (isset($Fecha_Desde)) {
                                            $datos_atenciones=$atenciones-> Get_Atenciones_Acumuladas_Anual_Fecha($Fecha_Desde , $Fecha_Hasta);
                                        } else {
                                            $datos_atenciones=$atenciones-> Get_Atenciones_Acumuladas_Anual();
                                        }
                                    }
                                    if ( sizeof($datos_atenciones) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_atenciones);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                <?php 
                                                if (isset($Usuario_Busqueda) or isset($Fecha_Desde)) 
                                                { ?>
                                                    <td><?php echo $datos_atenciones[$i]["Anio"];?> </td>
                                                <?php
                                                } else { ?>
                                                    <td>
                                                        <button data-toggle ="modal" 
                                                                data-target ="#view-modal" 
                                                                data-id     ="<?php echo $datos_atenciones[$i]["Anio"];?>" 
                                                                id          ="getAtenciones" 
                                                                class       ="btn btn-sm btn-primary">
                                                                <?php echo $datos_atenciones[$i]["Anio"];?>
                                                        </button>
                                                    </td>
                                                <?php
                                                } ?>
                                                <?php
                                                    $Personas = new Informes();
                                                    if (isset($Usuario_Busqueda)) {
                                                        $Total_Personas = $Personas->Get_Atenciones_Acumuladas_Anual_Persona_Fecha_Usuario($datos_atenciones[$i]["Anio"], $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda);
                                                    } else { 
                                                        if ( isset($Fecha_Desde)) {
                                                            $Total_Personas = $Personas->Get_Atenciones_Acumuladas_Anual_Persona_Fecha($datos_atenciones[$i]["Anio"], $Fecha_Desde, $Fecha_Hasta);
                                                        } else {
                                                            $Total_Personas = $Personas->Get_Atenciones_Acumuladas_Anual_Persona($datos_atenciones[$i]["Anio"]);
                                                        }
                                                    }
                                                ?>
                                                <td><?php echo sizeof($Total_Personas);?>     </td>
                                                <td><?php echo $datos_atenciones[$i]["Pendientes"];?>     </td>
                                                <td><?php echo $datos_atenciones[$i]["Aprovadas"];?>      </td>
                                                <td><?php echo $datos_atenciones[$i]["Anuladas"];?>       </td>
                                                <td><?php echo $datos_atenciones[$i]["Pendientes"]    +        
                                                               $datos_atenciones[$i]["Aprovadas"]     +        
                                                               $datos_atenciones[$i]["Anuladas"];?>
                                                </td>
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
        <div class="tab-pane fade" id="Llamados_Telefonicos">
            <div class="row">
                <div class="col-xl-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Llamados Telefonicos</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th> Mes </th>
                                    <?php
                                        $i=0;
                                        for ($i = 1; $i <= 31; $i++) { echo "<th>".$i."</th>"; }
                                    ?>
                                     <th> Total </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   
                                    $llamados = new Informes();
                                    $datos_llamados=$llamados-> Get_llamados_usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
                                    if ( sizeof($datos_llamados) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_llamados);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                <td><?php echo Nombre_Mes($datos_llamados[$i]["Mes"]);?></td>
                                                <?php if (  $datos_llamados[$i]["1"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo  $datos_llamados[$i]["1"];?> </td><?php } ?>
                                                <?php if (  $datos_llamados[$i]["2"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo  $datos_llamados[$i]["2"];?> </td><?php } ?>
                                                <?php if (  $datos_llamados[$i]["3"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo  $datos_llamados[$i]["3"];?> </td><?php } ?>
                                                <?php if (  $datos_llamados[$i]["4"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo  $datos_llamados[$i]["4"];?> </td><?php } ?>
                                                <?php if (  $datos_llamados[$i]["5"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo  $datos_llamados[$i]["5"];?> </td><?php } ?>
                                                <?php if (  $datos_llamados[$i]["6"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo  $datos_llamados[$i]["6"];?> </td><?php } ?>
                                                <?php if (  $datos_llamados[$i]["7"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo  $datos_llamados[$i]["7"];?> </td><?php } ?>
                                                <?php if (  $datos_llamados[$i]["8"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo  $datos_llamados[$i]["8"];?> </td><?php } ?>
                                                <?php if (  $datos_llamados[$i]["9"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo  $datos_llamados[$i]["9"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["10"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["10"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["11"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["11"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["12"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["12"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["13"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["13"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["14"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["14"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["15"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["15"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["16"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["16"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["17"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["17"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["18"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["18"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["19"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["19"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["20"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["20"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["21"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["21"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["22"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["22"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["23"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["23"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["24"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["24"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["25"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["25"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["26"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["26"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["27"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["27"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["28"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["28"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["29"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["29"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["30"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["30"];?> </td><?php } ?>
                                                <?php if ( $datos_llamados[$i]["31"] == 0 ) { ?><td>-</td><?php } else { ?><td><?php echo $datos_llamados[$i]["31"];?> </td><?php } ?>
                                                <td>  
                                                    <?php
                                                        echo 
                                                        $datos_llamados[$i]["1"]  + $datos_llamados[$i]["2"]  + $datos_llamados[$i]["3"]  + $datos_llamados[$i]["4"]  + $datos_llamados[$i]["5"]  + $datos_llamados[$i]["6"]  +
                                                        $datos_llamados[$i]["7"]  + $datos_llamados[$i]["8"]  + $datos_llamados[$i]["9"]  + $datos_llamados[$i]["10"] + $datos_llamados[$i]["11"] + $datos_llamados[$i]["12"] +
                                                        $datos_llamados[$i]["13"] + $datos_llamados[$i]["14"] + $datos_llamados[$i]["15"] + $datos_llamados[$i]["16"] + $datos_llamados[$i]["17"] + $datos_llamados[$i]["18"] +
                                                        $datos_llamados[$i]["19"] + $datos_llamados[$i]["20"] + $datos_llamados[$i]["21"] + $datos_llamados[$i]["22"] + $datos_llamados[$i]["23"] + $datos_llamados[$i]["24"] +
                                                        $datos_llamados[$i]["25"] + $datos_llamados[$i]["26"] + $datos_llamados[$i]["27"] + $datos_llamados[$i]["28"] + $datos_llamados[$i]["29"] + $datos_llamados[$i]["30"] +
                                                        $datos_llamados[$i]["31"] ;
                                                    ?>
                                                </td>
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
        <div class="tab-pane fade" id="Encuestas">
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
                                    <th> Total </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Pendientes           = 0 ; $Cerradas             = 0 ;
                                    $Total_Personas       = 0 ; $Numero_Hoja_Paso     = 0 ;
                                    $Hojas = new Informes();
                                    
                                    $datos_hojas=$Hojas->Get_Hojas_Ruta_Encuestador_Acumuladas_Fecha_Usuario($Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda);
                                    
                                    if ( sizeof($datos_hojas) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_hojas);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                
                                                <td><?php echo $datos_hojas[$i]["Nombre"].' '.$datos_hojas[$i]["Apellido"] ;?>     </td>
                                                <?php 
                                                    $Persona = new Informes();
                                                    $Cuenta_Personas_HR=$Persona-> Get_Personas_Hojas_Ruta_Acumuladas_Fecha($datos_hojas[$i]["Usuario_Id"], $Fecha_Desde, $Fecha_Hasta);
                                                ?>
                                                <td><?php echo $Cuenta_Personas_HR[0]["Persona_Hoja_Ruta"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["A2"];?>    </td> <td><?php echo $datos_hojas[$i]["E"];?>     </td>
                                                <td><?php echo $datos_hojas[$i]["ERROR"];?> </td> <td><?php echo $datos_hojas[$i]["NOENC"];?> </td>
                                                <td><?php echo $datos_hojas[$i]["NV"];?>    </td> <td><?php echo $datos_hojas[$i]["P1"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P2"];?>    </td> <td><?php echo $datos_hojas[$i]["P3"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P4"];?>    </td> <td><?php echo $datos_hojas[$i]["P5"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P6"];?>    </td> <td><?php echo $datos_hojas[$i]["P7"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["P8"];?>    </td> <td><?php echo $datos_hojas[$i]["R2"];?>    </td>
                                                <td><?php echo $datos_hojas[$i]["ANUL"];?>  </td> <td><?php echo $datos_hojas[$i]["DES"];?>   </td>
                                                <td>
                                                    <?php echo $datos_hojas[$i]["A2"] + $datos_hojas[$i]["E"]   + $datos_hojas[$i]["ERROR"] + $datos_hojas[$i]["NOENC"] +
                                                               $datos_hojas[$i]["NV"] + $datos_hojas[$i]["P1"]  + $datos_hojas[$i]["P2"]    + $datos_hojas[$i]["P3"]    +
                                                               $datos_hojas[$i]["P4"] + $datos_hojas[$i]["P5"]  + $datos_hojas[$i]["P6"]    + $datos_hojas[$i]["P7"]    +
                                                               $datos_hojas[$i]["P8"] + $datos_hojas[$i]["R2"]  + $datos_hojas[$i]["ANUL"]  + $datos_hojas[$i]["DES"]      
                                                    ?>
                                                </td>
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

        <div class="tab-pane fade" id="ApruebaRechazo">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Aprobación / Rechazo</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Consulta    </th> 
                                    <th>Fecha de Atencion    </th>
                                    <th>Fecha de Cierre      </th> 
                                    <th>Fecha de Revision    </th>
                                    <th>Resultado Revision   </th> 
                                    <th>Cantidad             </th>
                                    <th>Cierre - Revision    </th>
                                    <th>Atencion - Revision  </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Hojas = new Informes();
                                    $datos_hojas=$Hojas->Get_Historia_de_Aprobacion($Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda);
                                    
                                    if ( sizeof($datos_hojas) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_hojas);$i++)
                                        { 
                                          ?>
                                            <tr>      
                                                <td><?php echo $datos_hojas[$i]["Consulta"]             ;?>     </td>
                                                <td><?php echo $datos_hojas[$i]["F_Atencion"]           ;?>     </td>
                                                <td><?php echo $datos_hojas[$i]["F_Cierre"]             ;?>     </td>
                                                <td><?php echo $datos_hojas[$i]["F_Revision"]           ;?>     </td>
                                                <td><?php echo $datos_hojas[$i]["H_Tipo"]               ;?>     </td>
                                                <td><?php echo $datos_hojas[$i]["Cantidad"]             ;?>     </td>
                                                <td><?php echo $datos_hojas[$i]["Dif_Rev_Cierre"].' Dias'       ;?>     </td>
                                                <td><?php echo $datos_hojas[$i]["Dif_Rev_Atencion"].' Dias'     ;?>     </td>
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