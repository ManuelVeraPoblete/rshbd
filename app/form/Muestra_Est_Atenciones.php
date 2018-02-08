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
                                    <th>Cerradas          </th>
                                    <th>Rechazadas        </th>
                                    <th>Total             </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Tot_Personas = 0 ; $Tot_Pendientes = 0 ; $Tot_Cerradas = 0 ; $Tot_Rechazadas = 0 ; $Tot_Total = 0;
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
                                        {?>
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
                                                <?php 
                                                    $Numero = sizeof($Total_Personas);
                                                    $Tot_Personas     = $Tot_Personas     + $Numero;
                                                    $Tot_Pendientes   = $Tot_Pendientes   + $datos_atenciones[$i]["Pendientes"];
                                                    $Tot_Cerradas     = $Tot_Cerradas     + $datos_atenciones[$i]["Aprovadas"];
                                                    $Tot_Rechazadas   = $Tot_Rechazadas   + $datos_atenciones[$i]["Anuladas"];
                                                    $Tot_Total        = $Tot_Total        + $datos_atenciones[$i]["Pendientes"]    +        
                                                                                                $datos_atenciones[$i]["Aprovadas"]     +        
                                                                                                $datos_atenciones[$i]["Anuladas"] ;
                                                ?>
                                                </td>

                                                <tr>
                                        <?php   
                                        } ?>
                                            <tr>
                                                <td> Total </td>
                                                <td><?php echo $Tot_Personas ;?>      </td>                                            
                                                <td><?php echo $Tot_Pendientes;?>     </td>
                                                <td><?php echo $Tot_Cerradas  ;?>     </td>
                                                <td><?php echo $Tot_Rechazadas ;?>    </td>
                                                <td><?php echo $Tot_Total ;?>         </td>
                                            </td>
                                        <?php

                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel panel-primary filterable">
                         <div class="panel-titulo">
                            <h3 class="panel-title">Totales Generales</h3>      
                        </div>
                        <?php
                         if (isset($Fecha_Desde)) {
                            $Visitas = 0;
                            $Promerdio = 0 ; $Total_Personas = 0;
                            $Cantidad_p = new Informes();
                            $Cant_Personas = $Cantidad_p->Cuenta_Personas_Periodo_fecha($Fecha_Desde, $Fecha_Hasta);
                            $Total_Personas = sizeof($Cant_Personas);
                            for ($i=0; $i < sizeof($Cant_Personas) ; $i++) { 
                                $Visitas = $Visitas + $Cant_Personas[$i]["Cantidad"];
                            }
                            $Tot_Atenciones = new Informes();
                            $T_Ate = $Tot_Atenciones->Cuenta_Atenciones_Periodo_fecha($Fecha_Desde, $Fecha_Hasta);
                            $Total_Atenciones = $T_Ate[0]["T_Atenciones"];
                            $c_personas = sizeof($Cant_Personas);
                        } else {
                            $Visitas = 0;
                            $Promerdio = 0 ; $Total_Personas = 0;
                            $Cantidad_p = new Informes();
                            $Cant_Personas = $Cantidad_p->Cuenta_Personas_Periodo();
                            $Total_Personas = sizeof($Cant_Personas);
                            for ($i=0; $i < sizeof($Cant_Personas) ; $i++) { 
                                $Visitas = $Visitas + $Cant_Personas[$i]["Cantidad"];
                            }
                            $Tot_Atenciones = new Informes();
                            $T_Ate = $Tot_Atenciones->Cuenta_Atenciones_Periodo();
                            $Total_Atenciones = $T_Ate[0]["T_Atenciones"];
                            $c_personas = sizeof($Cant_Personas);
                        }
                        ?>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Descripcion     </th>
                                    <th>Cantidad        </th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><h4> La Cantidad de Personas Atendidas en el Periodo </h4></td>
                                <td><h4> <?php echo sizeof($Cant_Personas);?> </h4></td>
                            </tr>
                            <tr>
                                <td><h4> La Cantidad de Atenciones en el Periodo </h4></td>
                                <td><h4> <?php echo $Total_Atenciones;?> </h4></td>
                            </tr>
                            <tr>
                                <td><h4> Promedio de Atenciones por Persona </h4></td>
                                <td><h4> <?php echo number_format(($Total_Atenciones / $c_personas), 2, '.', '') ;?> </h4></td>
                            </tr>
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
                                    $Tot_Personas = 0 ; $Tot_Pendientes = 0 ; $Tot_Cerradas = 0 ; $Tot_Rechazadas = 0 ; $Tot_Total = 0;
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
                                                           $datos_atenciones[$i]["Anuladas"];?></td>

                                            <?php 
                                                $Numero = sizeof($Total_Personas);
                                                $Tot_Personas     = $Tot_Personas     + $Numero;
                                                $Tot_Pendientes   = $Tot_Pendientes   + $datos_atenciones[$i]["Pendientes"];
                                                $Tot_Cerradas     = $Tot_Cerradas     + $datos_atenciones[$i]["Aprovadas"];
                                                $Tot_Rechazadas   = $Tot_Rechazadas   + $datos_atenciones[$i]["Anuladas"];
                                                $Tot_Total        = $Tot_Total        + $datos_atenciones[$i]["Pendientes"]         +        
                                                                                            $datos_atenciones[$i]["Aprovadas"]     +        
                                                                                            $datos_atenciones[$i]["Anuladas"] ;
                                            ?>
                                          <tr>
                                        <?php   

                                        }
                                        ?>
                                            <tr>
                                                <td> Total </td>
                                                <td>  </td>

                                                <td><?php echo $Tot_Personas ;?>      </td>                                            
                                                <td><?php echo $Tot_Pendientes;?>     </td>
                                                <td><?php echo $Tot_Cerradas  ;?>     </td>
                                                <td><?php echo $Tot_Rechazadas ;?>    </td>
                                                <td><?php echo $Tot_Total ;?>         </td>
                                            </td>
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
                                    $Total_Personas_General     = 0 ;
                                    $Total_Pendientes_General   = 0 ;
                                    $Total_Cerradas_General     = 0 ;
                                    $Total_Rechazadas_General   = 0 ;
                                    $Total_Total_General        = 0 ;
                                    $Total_Personas             = 0 ; 
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
                                                               $datos_atenciones[$i]["Anuladas"];?> </td>
                                                <?php
                                                    $Total_Personas_General     = $Total_Personas_General    + sizeof($Total_Personas)                  ;
                                                    $Total_Pendientes_General   = $Total_Pendientes_General  + $datos_atenciones[$i]["Pendientes"]      ;
                                                    $Total_Cerradas_General     = $Total_Cerradas_General    + $datos_atenciones[$i]["Aprovadas"]       ;
                                                    $Total_Rechazadas_General   = $Total_Rechazadas_General  + $datos_atenciones[$i]["Anuladas"]        ;
                                                    $Total_Total_General        = $Total_Total_General       + $datos_atenciones[$i]["Pendientes"] + $datos_atenciones[$i]["Aprovadas"] + $datos_atenciones[$i]["Anuladas"] ;
                                                ?>
                                            <tr>
                                        <?php   
                                        } ?>
                                            <tr>
                                                <td>Total</td>
                                                <td><?php echo $Total_Personas_General   ;?> </td>
                                                <td><?php echo $Total_Pendientes_General ;?> </td>
                                                <td><?php echo $Total_Cerradas_General   ;?> </td>
                                                <td><?php echo $Total_Rechazadas_General ;?> </td>
                                                <td><?php echo $Total_Total_General      ;?> </td>            
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
        <div class="tab-pane fade" id="Atenciones_Ejecutor">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Atenciones / Anuales / Ejecutor</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Ejecutor    </th>
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
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Llamados Telefonicos</h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Usuario    </th>
                                    <th>Cantidad    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Total_Llamados       = 0 ; 
                                    $llamados = new Informes();
                                    if (isset($Fecha_Desde)) {
                                        $datos_llamados=$llamados-> Get_Llamados_Telefonicos_Fecha( $Fecha_Desde, $Fecha_Hasta);    
                                    } else {
                                        $datos_llamados=$llamados-> Get_Llamados_Telefonicos();
                                    }
                                    
                                    if ( sizeof($datos_llamados) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_llamados);$i++)
                                        { 
                                          ?>
                                            <tr>

                                                <td><?php echo $datos_llamados[$i]["Nombre"].' '.$datos_llamados[$i]["Apellido"];?>      </td>
                                                <td><?php echo $datos_llamados[$i]["total"];?>       </td>
                                                <?php
                                                    $Total_Llamados = $Total_Llamados + $datos_llamados[$i]["total"];
                                                ?>
                                            <tr>
                                        <?php   
                                        } ?>
                                            <tr>
                                                <td>Total Llamados</td>
                                                <td><?php echo $Total_Llamados ;?> </td>
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
        <div class="tab-pane fade" id="Actividades_Diarias">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Actividades Diarias / <?php echo $Fecha_Desde,' al '.$Fecha_Hasta;?></h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Actividad</th>
                                    <?php 
                                        for ($mes=1; $mes < 32 ; $mes++) { 
                                            echo "<th>".$mes."</th>";   
                                    }
                                    ?>
                                    <th>Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                     $Total_1 = 0 ; $Total_2  = 0 ;  $Total_3 = 0 ; $Total_4  = 0 ; $Total_5  = 0 ; $Total_6  = 0 ;  $Total_7 = 0 ; $Total_8     = 0 ;
                                     $Total_9 = 0 ; $Total_10 = 0 ; $Total_11 = 0 ; $Total_12 = 0 ; $Total_13 = 0 ; $Total_14 = 0 ; $Total_15 = 0 ; $Total_16    = 0 ;
                                    $Total_17 = 0 ; $Total_18 = 0 ; $Total_19 = 0 ; $Total_20 = 0 ; $Total_21 = 0 ; $Total_22 = 0 ; $Total_23 = 0 ; $Total_24    = 0 ;
                                    $Total_25 = 0 ; $Total_26 = 0 ; $Total_27 = 0 ; $Total_28 = 0 ; $Total_29 = 0 ; $Total_30 = 0 ; $Total_31 = 0 ; $Total_Linea = 0 ;

                                    $informe = new ActividadesDiarias();
                                    $datos_informe=$informe->get_actividades_diarias_por_usuario_fecha($Fecha_Desde, $Fecha_Hasta);
                                  if (sizeof($datos_informe) == 0){
                                    echo "<h4> No Registra Actividades </h4>";
                                  } else{
                                    for ($i=0; $i < sizeof($datos_informe) ; $i++) { ?>
                                       <tr>
                                        <td> <?php echo $datos_informe[$i]["Nombre"].' '.$datos_informe[$i]["Apellido"] ; ?> </td>
                                        <td> <?php echo $datos_informe[$i]["Nombre_Actividad"]; ?> </td>
                                        <td> <?php if (  $datos_informe[$i]["1"] == 0 ) { echo '-' ; } else { echo   $datos_informe[$i]["1"]; }?> </td>
                                        <td> <?php if (  $datos_informe[$i]["2"] == 0 ) { echo '-' ; } else { echo   $datos_informe[$i]["2"]; }?> </td>
                                        <td> <?php if (  $datos_informe[$i]["3"] == 0 ) { echo '-' ; } else { echo   $datos_informe[$i]["3"]; }?> </td>
                                        <td> <?php if (  $datos_informe[$i]["4"] == 0 ) { echo '-' ; } else { echo   $datos_informe[$i]["4"]; }?> </td>
                                        <td> <?php if (  $datos_informe[$i]["5"] == 0 ) { echo '-' ; } else { echo   $datos_informe[$i]["5"]; }?> </td>
                                        <td> <?php if (  $datos_informe[$i]["6"] == 0 ) { echo '-' ; } else { echo   $datos_informe[$i]["6"]; }?> </td>
                                        <td> <?php if (  $datos_informe[$i]["7"] == 0 ) { echo '-' ; } else { echo   $datos_informe[$i]["7"]; }?> </td>
                                        <td> <?php if (  $datos_informe[$i]["8"] == 0 ) { echo '-' ; } else { echo   $datos_informe[$i]["8"]; }?> </td>
                                        <td> <?php if (  $datos_informe[$i]["9"] == 0 ) { echo '-' ; } else { echo   $datos_informe[$i]["9"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["10"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["10"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["11"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["11"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["12"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["12"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["13"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["13"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["14"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["14"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["15"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["15"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["16"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["16"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["17"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["17"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["18"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["18"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["19"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["19"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["20"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["20"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["21"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["21"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["22"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["22"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["23"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["23"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["24"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["24"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["25"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["25"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["26"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["26"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["27"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["27"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["28"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["28"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["29"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["29"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["30"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["30"]; }?> </td>
                                        <td> <?php if ( $datos_informe[$i]["31"] == 0 ) { echo '-' ; } else { echo  $datos_informe[$i]["31"]; }?> </td>

                                        <?php
                                             $Total_Linea =   $datos_informe[$i]["1"]  + $datos_informe[$i]["2"]  + $datos_informe[$i]["3"]  + $datos_informe[$i]["4"]  + $datos_informe[$i]["5"]  + 
                                                              $datos_informe[$i]["6"]  + $datos_informe[$i]["7"]  + $datos_informe[$i]["8"]  + $datos_informe[$i]["9"]  + $datos_informe[$i]["10"] +
                                                              $datos_informe[$i]["11"] + $datos_informe[$i]["12"] + $datos_informe[$i]["13"] + $datos_informe[$i]["14"] + $datos_informe[$i]["15"] +
                                                              $datos_informe[$i]["16"] + $datos_informe[$i]["17"] + $datos_informe[$i]["18"] + $datos_informe[$i]["19"] + $datos_informe[$i]["20"] +
                                                              $datos_informe[$i]["21"] + $datos_informe[$i]["22"] + $datos_informe[$i]["23"] + $datos_informe[$i]["24"] + $datos_informe[$i]["25"] +
                                                              $datos_informe[$i]["26"] + $datos_informe[$i]["27"] + $datos_informe[$i]["28"] + $datos_informe[$i]["29"] + $datos_informe[$i]["30"] +
                                                              $datos_informe[$i]["31"] ;
                                        ?>

                                            <td> <?php if ( $Total_Linea == 0 ) { echo '-' ; } else { echo  $Total_Linea; }?> </td>
                                        <?php
                                             $Total_1 =  $Total_1 +   $datos_informe[$i]["1"] ; $Total_2 =  $Total_2 +   $datos_informe[$i]["2"] ;
                                             $Total_3 =  $Total_3 +   $datos_informe[$i]["3"] ; $Total_4 =  $Total_4 +   $datos_informe[$i]["4"] ;
                                             $Total_5 =  $Total_5 +   $datos_informe[$i]["5"] ; $Total_6 =  $Total_6 +   $datos_informe[$i]["6"] ;
                                             $Total_7 =  $Total_7 +   $datos_informe[$i]["7"] ; $Total_8 =  $Total_8 +   $datos_informe[$i]["8"] ;
                                             $Total_9 =  $Total_9 +   $datos_informe[$i]["9"] ; $Total_10 = $Total_10 +  $datos_informe[$i]["10"] ;
                                            $Total_11 = $Total_11 +  $datos_informe[$i]["11"] ; $Total_12 = $Total_12 +  $datos_informe[$i]["12"] ;
                                            $Total_13 = $Total_13 +  $datos_informe[$i]["13"] ; $Total_14 = $Total_14 +  $datos_informe[$i]["14"] ;
                                            $Total_15 = $Total_15 +  $datos_informe[$i]["15"] ; $Total_16 = $Total_16 +  $datos_informe[$i]["16"] ;
                                            $Total_17 = $Total_17 +  $datos_informe[$i]["17"] ; $Total_18 = $Total_18 +  $datos_informe[$i]["18"] ;
                                            $Total_19 = $Total_19 +  $datos_informe[$i]["19"] ; $Total_20 = $Total_20 +  $datos_informe[$i]["20"] ;
                                            $Total_21 = $Total_21 +  $datos_informe[$i]["21"] ; $Total_22 = $Total_22 +  $datos_informe[$i]["22"] ;
                                            $Total_23 = $Total_23 +  $datos_informe[$i]["23"] ; $Total_24 = $Total_24 +  $datos_informe[$i]["24"] ;
                                            $Total_25 = $Total_25 +  $datos_informe[$i]["25"] ; $Total_26 = $Total_26 +  $datos_informe[$i]["26"] ;
                                            $Total_27 = $Total_27 +  $datos_informe[$i]["27"] ; $Total_28 = $Total_28 +  $datos_informe[$i]["28"] ;
                                            $Total_29 = $Total_29 +  $datos_informe[$i]["29"] ; $Total_30 = $Total_30 +  $datos_informe[$i]["30"] ;
                                            $Total_31 = $Total_31 +  $datos_informe[$i]["31"] ;
                                        ?> 
                                       
                                    </tr>
                                    <?php
                                    } 
                                        $Total_Linea =  $Total_1  + $Total_2  + $Total_3  + $Total_4  + $Total_5  + $Total_6  + $Total_7  + $Total_8  + $Total_9  + $Total_10 +
                                                        $Total_11 + $Total_12 + $Total_13 + $Total_14 + $Total_15 + $Total_16 + $Total_17 + $Total_18 + $Total_19 + $Total_20 +
                                                        $Total_21 + $Total_22 + $Total_23 + $Total_24 + $Total_25 + $Total_26 + $Total_27 + $Total_28 + $Total_29 + $Total_30 +
                                                        $Total_31 ;

                                    ?>
                                    <tr>
                                        <td> Total </td>
                                        <td> </td>
                                        <td> <?php  if ( $Total_1  == 0 )  { echo '-' ; } else { echo  $Total_1  ; } ?> </td>
                                        <td> <?php  if ( $Total_2  == 0 )  { echo '-' ; } else { echo  $Total_2  ; } ?> </td>
                                        <td> <?php  if ( $Total_3  == 0 )  { echo '-' ; } else { echo  $Total_3  ; } ?> </td>
                                        <td> <?php  if ( $Total_4  == 0 )  { echo '-' ; } else { echo  $Total_4  ; } ?> </td>
                                        <td> <?php  if ( $Total_5  == 0 )  { echo '-' ; } else { echo  $Total_5  ; } ?> </td>
                                        <td> <?php  if ( $Total_6  == 0 )  { echo '-' ; } else { echo  $Total_6  ; } ?> </td>
                                        <td> <?php  if ( $Total_7  == 0 )  { echo '-' ; } else { echo  $Total_7  ; } ?> </td>
                                        <td> <?php  if ( $Total_8  == 0 )  { echo '-' ; } else { echo  $Total_8  ; } ?> </td>
                                        <td> <?php  if ( $Total_9  == 0 )  { echo '-' ; } else { echo  $Total_9  ; } ?> </td>
                                        <td> <?php  if ( $Total_10 == 0 )  { echo '-' ; } else { echo  $Total_10 ; } ?> </td>
                                        <td> <?php  if ( $Total_11 == 0 )  { echo '-' ; } else { echo  $Total_11 ; } ?> </td>
                                        <td> <?php  if ( $Total_12 == 0 )  { echo '-' ; } else { echo  $Total_12 ; } ?> </td>
                                        <td> <?php  if ( $Total_13 == 0 )  { echo '-' ; } else { echo  $Total_13 ; } ?> </td>
                                        <td> <?php  if ( $Total_14 == 0 )  { echo '-' ; } else { echo  $Total_14 ; } ?> </td>
                                        <td> <?php  if ( $Total_15 == 0 )  { echo '-' ; } else { echo  $Total_15 ; } ?> </td>
                                        <td> <?php  if ( $Total_16 == 0 )  { echo '-' ; } else { echo  $Total_16 ; } ?> </td>
                                        <td> <?php  if ( $Total_17 == 0 )  { echo '-' ; } else { echo  $Total_17 ; } ?> </td>
                                        <td> <?php  if ( $Total_18 == 0 )  { echo '-' ; } else { echo  $Total_18 ; } ?> </td>
                                        <td> <?php  if ( $Total_19 == 0 )  { echo '-' ; } else { echo  $Total_19 ; } ?> </td>
                                        <td> <?php  if ( $Total_20 == 0 )  { echo '-' ; } else { echo  $Total_20 ; } ?> </td>
                                        <td> <?php  if ( $Total_21 == 0 )  { echo '-' ; } else { echo  $Total_21 ; } ?> </td>
                                        <td> <?php  if ( $Total_22 == 0 )  { echo '-' ; } else { echo  $Total_22 ; } ?> </td>
                                        <td> <?php  if ( $Total_23 == 0 )  { echo '-' ; } else { echo  $Total_23 ; } ?> </td>
                                        <td> <?php  if ( $Total_24 == 0 )  { echo '-' ; } else { echo  $Total_24 ; } ?> </td>
                                        <td> <?php  if ( $Total_25 == 0 )  { echo '-' ; } else { echo  $Total_25 ; } ?> </td>
                                        <td> <?php  if ( $Total_26 == 0 )  { echo '-' ; } else { echo  $Total_26 ; } ?> </td>
                                        <td> <?php  if ( $Total_27 == 0 )  { echo '-' ; } else { echo  $Total_27 ; } ?> </td>
                                        <td> <?php  if ( $Total_28 == 0 )  { echo '-' ; } else { echo  $Total_28 ; } ?> </td>
                                        <td> <?php  if ( $Total_29 == 0 )  { echo '-' ; } else { echo  $Total_29 ; } ?> </td>
                                        <td> <?php  if ( $Total_30 == 0 )  { echo '-' ; } else { echo  $Total_30 ; } ?> </td>
                                        <td> <?php  if ( $Total_31 == 0 )  { echo '-' ; } else { echo  $Total_31 ; } ?> </td>
                                        <td> <?php  if ( $Total_Linea == 0 )  { echo '-' ; } else { echo  $Total_Linea ; } ?> </td>
                                       
                                    </tr> <?php
                                  }
                                ?>    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Actividades_Acumuladas">
            <div class="row">
                <div class="col-sm-8">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Actividades Diarias / <?php echo $Fecha_Desde,' al '.$Fecha_Hasta;?></h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Cantidad</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $informe = new ActividadesDiarias();
                                    $datos_informe=$informe->get_actividades_acumuladas($Fecha_Desde, $Fecha_Hasta);
                                    if (sizeof($datos_informe) == 0){
                                        echo "<h4> No Registra Actividades </h4>";
                                    } else { 
                                        for ($i=0; $i < sizeof($datos_informe) ; $i++) 
                                        { ?>
                                            <tr>
                                                <td> <?php echo  $datos_informe[$i]["Nombre_Actividad"]; ?> </td>
                                                <td> <?php echo  $datos_informe[$i]["Total_Actividad"]; ?> </td>
                                            </tr>
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