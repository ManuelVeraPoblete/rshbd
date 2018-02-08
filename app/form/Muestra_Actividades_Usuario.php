<div class="panel-body">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="Atenciones_Abiertas">
            <?php
                $Usuario_Nombre = new Usuario();
                $Nom = $Usuario_Nombre->get_usuario_por_id($Usuario_Busqueda);
                $Nombre_Usr = $Nom[0]["Nombre"].' '.$Nom[0]["Apellido"];
                $Por1 = $Nom[0]["po1"] ; $Por2 = $Nom[0]["po2"];
                $Tot_Per  = 0 ; $Tot_Pen  = 0 ; $Tot_Cer  = 0 ; $Tot_Rec  = 0 ; $Tot_Tot  = 0 ; $Tot_P1   = 0 ; $Tot_P2   = 0 ;
            ?>

            <div class="row">
                <div class="col-lg-15">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Atenciones Abiertas / <?php echo $Nombre_Usr;?> </h3>      
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
                                    <th><?php echo $Por1.' %' ; ?></th>
                                    <th><?php echo $Por2.' %' ; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Tot_Personas = 0 ; $Tot_Pendientes = 0 ; $Tot_Cerradas = 0 ; $Tot_Rechazadas = 0 ; $Tot_Total = 0;
                                    $Pendientes = 0 ; $Cerradas = 0;
                                    $Total_Personas = 0;
                                    $Numero_Hoja_Paso = 0;
                                    $atenciones = new Informes();
                                    $datos_atenciones=$atenciones->Get_Atenciones_Abiertas_Consulta($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
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
                                            <td><?php echo round ( ( ( ( $datos_atenciones[$i]["Pendientes"]+        
                                                           $datos_atenciones[$i]["Aprovadas"]+        
                                                           $datos_atenciones[$i]["Anuladas"] ) * $Por1 )/ 100) , 0);?></td>
                                            <td><?php echo round ( ( ( ( $datos_atenciones[$i]["Pendientes"]+        
                                                           $datos_atenciones[$i]["Aprovadas"]+        
                                                           $datos_atenciones[$i]["Anuladas"] ) * $Por2 )/ 100) , 0);?></td>
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
                                            $Tot_Per  = $Tot_Per + $Tot_Personas ;
                                            $Tot_Pen  = $Tot_Pen + $Tot_Pendientes;
                                            $Tot_Cer  = $Tot_Cer + $Tot_Cerradas;
                                            $Tot_Rec  = $Tot_Rec + $Tot_Rechazadas;
                                            $Tot_Tot  = $Tot_Tot + $Tot_Total;
                                            $Tot_P1   = $Tot_P1  + ( $Tot_Total  * $Por1 ) / 100 ;
                                            $Tot_P2   = $Tot_P2  + ( $Tot_Total  * $Por2 ) / 100 ;    
                                        ?>
                                            <tr>
                                                <td> Total </td>
                                                <td>  </td>
                                                <td><?php echo $Tot_Personas ;?>      </td>                                            
                                                <td><?php echo $Tot_Pendientes;?>     </td>
                                                <td><?php echo $Tot_Cerradas  ;?>     </td>
                                                <td><?php echo $Tot_Rechazadas ;?>    </td>
                                                <td><?php echo $Tot_Total ;?>         </td>
                                                <td><?php echo round( ( ( $Tot_Total  * $Por1 ) / 100) ,0) ;?>         </td>
                                                <td><?php echo round( ( ( $Tot_Total  * $Por2 ) / 100),0) ;?>         </td>
                                            </td>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-15">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Atenciones Cerradas / <?php echo $Nombre_Usr;?> </h3>      
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
                                    <th><?php echo $Por1.' %' ; ?></th>
                                    <th><?php echo $Por2.' %' ; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Tot_Personas = 0 ; $Tot_Pendientes = 0 ; $Tot_Cerradas = 0 ; $Tot_Rechazadas = 0 ; $Tot_Total = 0;
                                    $Pendientes = 0 ; $Cerradas = 0;
                                    $Total_Personas = 0;
                                    $Numero_Hoja_Paso = 0;
                                    $atenciones = new Informes();
                                    $datos_atenciones=$atenciones->Get_Atenciones_Cerradas_Consulta($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
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
                                                //$Total_Personas = $Personas->Get_Atenciones_Personas_Consultas_Fecha_Usuario($datos_atenciones[$i]["Consulta_Id"], $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda);
                                                $Total_Personas = $Personas->Get_Atenciones_Cerradas_Personas_Consultas_Fecha_Usuario($datos_atenciones[$i]["Consulta_Id"], $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda);
                                                
                                            ?>
                                            <td><?php echo sizeof($Total_Personas);?>     </td>
                                            <td><?php echo $datos_atenciones[$i]["Pendientes"];?></td>
                                            <td><?php echo $datos_atenciones[$i]["Aprovadas"];?></td>
                                            <td><?php echo $datos_atenciones[$i]["Anuladas"];?></td>
                                            <td><?php echo $datos_atenciones[$i]["Pendientes"]+        
                                                           $datos_atenciones[$i]["Aprovadas"]+        
                                                           $datos_atenciones[$i]["Anuladas"];?></td>
                                             <td><?php echo round ( ( ( ( $datos_atenciones[$i]["Pendientes"]+        
                                                           $datos_atenciones[$i]["Aprovadas"]+        
                                                           $datos_atenciones[$i]["Anuladas"] ) * $Por1 )/ 100) , 0);?></td>
                                            <td><?php echo round ( ( ( ( $datos_atenciones[$i]["Pendientes"]+        
                                                           $datos_atenciones[$i]["Aprovadas"]+        
                                                           $datos_atenciones[$i]["Anuladas"] ) * $Por2 )/ 100) , 0);?></td>
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
                                                <?php 
                                                    $Tot_Per  = $Tot_Per + $Tot_Personas ;
                                                    $Tot_Pen  = $Tot_Pen + $Tot_Pendientes;
                                                    $Tot_Cer  = $Tot_Cer + $Tot_Cerradas;
                                                    $Tot_Rec  = $Tot_Rec + $Tot_Rechazadas;
                                                    $Tot_Tot  = $Tot_Tot + $Tot_Total;
                                                    $Tot_P1   = $Tot_P1  + ( $Tot_Total  * $Por1 ) / 100 ;
                                                    $Tot_P2   = $Tot_P2  + ( $Tot_Total  * $Por2 ) / 100 ;
                                                ?>
                                                <td>  </td>
                                                <td><?php echo $Tot_Personas ;?>      </td>                                            
                                                <td><?php echo $Tot_Pendientes;?>     </td>
                                                <td><?php echo $Tot_Cerradas  ;?>     </td>
                                                <td><?php echo $Tot_Rechazadas ;?>    </td>
                                                <td><?php echo $Tot_Total ;?>         </td>
                                                <td><?php echo round( ( ( $Tot_Total  * $Por1 ) / 100) ,0) ;?>         </td>
                                                <td><?php echo round( ( ( $Tot_Total  * $Por2 ) / 100),0) ;?>         </td>
                                            </td>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="saltopagina">
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Resumen Abiertas Cerradas / <?php echo $Nombre_Usr;?> </h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th>Personas</th>
                                    <th>Pendientes</th>
                                    <th>Cerradas</th>
                                    <th>Rechazadas</th>
                                    <th>Total</th>
                                    <th><?php echo $Por1.' %' ; ?></th>
                                    <th><?php echo $Por2.' %' ; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Total </td>
                                    <td>  </td>
                                    <td><?php echo $Tot_Per ;?> </td>                                            
                                    <td><?php echo $Tot_Pen ;?> </td>
                                    <td><?php echo $Tot_Cer ;?> </td>
                                    <td><?php echo $Tot_Rec ;?> </td>
                                    <td><?php echo $Tot_Tot ;?> </td>
                                    <td><?php echo  round($Tot_P1 ,0 ) ;?> </td>
                                    <td><?php echo  round($Tot_P2 ,0 ) ;?> </td>
                                </tr>
                                <tr>
                                    <td> <?php echo $Por1.' %' ; ?> </td>
                                    <td>  </td>
                                    <td><?php echo round( ( ( $Tot_Per * $Por1 ) / 100 ),0) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Pen * $Por1 ) / 100 ),0) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Cer * $Por1 ) / 100 ),0) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Rec * $Por1 ) / 100 ),0) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Tot * $Por1 ) / 100 ),0) ;?> </td>
                                    <td> </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td> <?php echo $Por2.' %' ; ?> </td>
                                    <td>  </td>
                                    <td><?php echo round( ( ( $Tot_Per * $Por2 ) / 100 ),0) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Pen * $Por2 ) / 100 ),0) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Cer * $Por2 ) / 100 ),0) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Rec * $Por2 ) / 100 ),0) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Tot * $Por2 ) / 100 ),0) ;?> </td>
                                    <td> </td>
                                    <td></td>
                                </tr>
                                  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="Resumen_Atenciones">
            <?php
                $Usuario_Nombre = new Usuario();
                $Nom = $Usuario_Nombre->get_usuario_por_id($Usuario_Busqueda);
                $Nombre_Usr = $Nom[0]["Nombre"].' '.$Nom[0]["Apellido"];
                $Por1 = $Nom[0]["po1"] ; $Por2 = $Nom[0]["po2"];
                $Tot_Per  = 0 ; $Tot_Pen  = 0 ; $Tot_Cer  = 0 ; $Tot_Rec  = 0 ; $Tot_Tot  = 0 ; $Tot_P1   = 0 ; $Tot_P2   = 0 ;
            ?>
            <div class="row">
                <div class="col-lg-15">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Acumulado Atenciones / <?php echo $Nombre_Usr;?> </h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Consulta</th>
                                    <th>Personas</th>
                                    <th>Pendientes</th>
                                    <th>Cerradas</th>
                                    <th>Rechazadas</th>
                                    <th>Total</th>
                                    <th><?php echo $Por1.' %' ; ?></th>
                                    <th><?php echo $Por2.' %' ; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $Tot_Personas = 0 ; $Tot_Pendientes = 0 ; $Tot_Cerradas = 0 ; $Tot_Rechazadas = 0 ; $Tot_Total = 0;
                                    $Pendientes = 0 ; $Cerradas = 0;
                                    $Total_Personas = 0;
                                    $Numero_Hoja_Paso = 0;
                                    $atenciones = new Informes();
                                    //$datos_atenciones=$atenciones->Get_Atenciones_Acumuladas_Fecha_Usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
                                    $datos_atenciones=$atenciones->Get_Atenciones_Acumuladas_Consulta($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
                                    if ( sizeof($datos_atenciones) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_atenciones);$i++)
                                        { 
                                        ?>
                                          <tr>
                                            <td><?php echo $datos_atenciones[$i]["Consulta"];?></td>
                                            <?php
                                                $Personas = new Informes();
                                                $Total_Personas = $Personas-> Get_Atenciones_Acumulada_Personas_Consultas_Fecha_Usuario($datos_atenciones[$i]["Consulta_Id"], $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda);
                                            ?>
                                            <td><?php echo sizeof($Total_Personas);?>     </td>
                                            <td><?php echo $datos_atenciones[$i]["Pendientes"];?></td>
                                            <td><?php echo $datos_atenciones[$i]["Aprovadas"];?></td>
                                            <td><?php echo $datos_atenciones[$i]["Anuladas"];?></td>
                                            <td><?php echo $datos_atenciones[$i]["Pendientes"]+        
                                                           $datos_atenciones[$i]["Aprovadas"]+        
                                                           $datos_atenciones[$i]["Anuladas"];?></td>
                                            <td><?php echo round ( ( ( ( $datos_atenciones[$i]["Pendientes"]+        
                                                           $datos_atenciones[$i]["Aprovadas"]+        
                                                           $datos_atenciones[$i]["Anuladas"] ) * $Por1 )/ 100) , 0);?></td>
                                            <td><?php echo round ( ( ( ( $datos_atenciones[$i]["Pendientes"]+        
                                                           $datos_atenciones[$i]["Aprovadas"]+        
                                                           $datos_atenciones[$i]["Anuladas"] ) * $Por2 )/ 100) , 0);?></td>
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
                                 
                                                <?php 
                                                    $Tot_Per  = $Tot_Per + $Tot_Personas ;
                                                    $Tot_Pen  = $Tot_Pen + $Tot_Pendientes;
                                                    $Tot_Cer  = $Tot_Cer + $Tot_Cerradas;
                                                    $Tot_Rec  = $Tot_Rec + $Tot_Rechazadas;
                                                    $Tot_Tot  = $Tot_Tot + $Tot_Total;
                                                    $Tot_P1   = $Tot_P1  + ( $Tot_Total  * $Por1 ) / 100 ;
                                                    $Tot_P2   = $Tot_P2  + ( $Tot_Total  * $Por2 ) / 100 ;
                                                ?>

                                                <td><?php echo $Tot_Personas ;?>      </td>                                            
                                                <td><?php echo $Tot_Pendientes;?>     </td>
                                                <td><?php echo $Tot_Cerradas  ;?>     </td>
                                                <td><?php echo $Tot_Rechazadas ;?>    </td>
                                                <td><?php echo $Tot_Total ;?>         </td>
                                                <td><?php echo round( ( ( $Tot_Total  * $Por1 ) / 100) ,0) ;?>         </td>
                                                <td><?php echo round( ( ( $Tot_Total  * $Por2 ) / 100),0) ;?>         </td>
                                            </td>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="saltopagina">
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Resumen Abiertas Cerradas / <?php echo $Nombre_Usr;?> </h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th>Personas</th>
                                    <th>Pendientes</th>
                                    <th>Cerradas</th>
                                    <th>Rechazadas</th>
                                    <th>Total</th>
                                    <th><?php echo $Por1.' %' ; ?></th>
                                    <th><?php echo $Por2.' %' ; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Total </td>
                                    <td>  </td>
                                    <td><?php echo $Tot_Per ;?> </td>                                            
                                    <td><?php echo $Tot_Pen ;?> </td>
                                    <td><?php echo $Tot_Cer ;?> </td>
                                    <td><?php echo $Tot_Rec ;?> </td>
                                    <td><?php echo $Tot_Tot ;?> </td>
                                    <td><?php echo  round($Tot_P1 ,0 ) ;?> </td>
                                    <td><?php echo  round($Tot_P2 ,0 ) ;?> </td>
                                </tr>
                                <tr>
                                    <td> <?php echo $Por1.' %' ; ?> </td>
                                    <td>  </td>
                                    <td><?php echo round( ( ( $Tot_Per * $Por1 ) / 100 ) , 0 ) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Pen * $Por1 ) / 100 ) , 0 ) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Cer * $Por1 ) / 100 ) , 0 ) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Rec * $Por1 ) / 100 ) , 0 ) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Tot * $Por1 ) / 100 ) , 0 ) ;?> </td>
                                    <td> </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td> <?php echo $Por2.' %' ; ?> </td>
                                    <td>  </td>
                                    <td><?php echo round( ( ( $Tot_Per * $Por2 ) / 100 ), 0 ) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Pen * $Por2 ) / 100 ), 0 ) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Cer * $Por2 ) / 100 ), 0 ) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Rec * $Por2 ) / 100 ), 0 ) ;?> </td>
                                    <td><?php echo round( ( ( $Tot_Tot * $Por2 ) / 100 ), 0 ) ;?> </td>
                                    <td> </td>
                                    <td></td>
                                </tr>
                                  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Llamados_Telefonicos">
            <div class="row">
                <div class="col-lg6">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Llamados Telefonicos/ <?php echo $Nombre_Usr ; ?> </h3>      
                        </div>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>1 </th> <th>2 </th> <th>3 </th> <th>4 </th> <th>5 </th> <th>6 </th> <th>7 </th> <th>8 </th> <th>9 </th> <th>10</th>
                                    <th>11</th> <th>12</th> <th>13</th> <th>14</th> <th>15</th> <th>16</th> <th>17</th> <th>18</th> <th>19</th> <th>20</th>
                                    <th>21</th> <th>22</th> <th>23</th> <th>24</th> <th>25</th> <th>26</th> <th>27</th> <th>28</th> <th>29</th> <th>30</th>
                                    <th>31</th> <th> Total </th> <th> <?php echo $Por1.'%' ;?> </th> <th> <?php echo $Por2.'%' ;?> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    $llamados = new Informes();
                                    $datos_llamados=$llamados-> Get_llamados_usuario( $Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
                                    
                                    if ( sizeof($datos_llamados) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_llamados);$i++)
                                        { 
                                          ?>
                                            <tr>
                                                <?php 
                                                    $Total_Llamados =    $datos_llamados[$i]["1"]  + $datos_llamados[$i]["2"] +  $datos_llamados[$i]["3"] + 
                                                                         $datos_llamados[$i]["4"]  + $datos_llamados[$i]["5"] +  $datos_llamados[$i]["6"] + 
                                                                         $datos_llamados[$i]["7"]  + $datos_llamados[$i]["8"] +  $datos_llamados[$i]["9"] + 
                                                                        $datos_llamados[$i]["10"] + $datos_llamados[$i]["11"] + $datos_llamados[$i]["12"] + 
                                                                        $datos_llamados[$i]["13"] + $datos_llamados[$i]["14"] + $datos_llamados[$i]["15"] + 
                                                                        $datos_llamados[$i]["16"] + $datos_llamados[$i]["17"] + $datos_llamados[$i]["18"] + 
                                                                        $datos_llamados[$i]["19"] + $datos_llamados[$i]["20"] + $datos_llamados[$i]["21"] + 
                                                                        $datos_llamados[$i]["22"] + $datos_llamados[$i]["23"] + $datos_llamados[$i]["24"] + 
                                                                        $datos_llamados[$i]["25"] + $datos_llamados[$i]["26"] + $datos_llamados[$i]["27"] + 
                                                                        $datos_llamados[$i]["28"] + $datos_llamados[$i]["29"] + $datos_llamados[$i]["30"] + 
                                                                        $datos_llamados[$i]["31"] ;
                                                ?>
                                                <td><?php if ( $datos_llamados[$i]["1"]  > 0 ) { echo $datos_llamados[$i]["1"];   } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["2"]  > 0 ) { echo $datos_llamados[$i]["2"];   } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["3"]  > 0 ) { echo $datos_llamados[$i]["3"];   } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["4"]  > 0 ) { echo $datos_llamados[$i]["4"];   } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["5"]  > 0 ) { echo $datos_llamados[$i]["5"];   } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["6"]  > 0 ) { echo $datos_llamados[$i]["6"];   } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["7"]  > 0 ) { echo $datos_llamados[$i]["7"];   } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["8"]  > 0 ) { echo $datos_llamados[$i]["8"];   } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["9"]  > 0 ) { echo $datos_llamados[$i]["9"];   } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["10"] > 0 ) { echo $datos_llamados[$i]["10"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["11"] > 0 ) { echo $datos_llamados[$i]["11"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["12"] > 0 ) { echo $datos_llamados[$i]["12"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["13"] > 0 ) { echo $datos_llamados[$i]["13"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["14"] > 0 ) { echo $datos_llamados[$i]["14"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["15"] > 0 ) { echo $datos_llamados[$i]["15"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["16"] > 0 ) { echo $datos_llamados[$i]["16"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["17"] > 0 ) { echo $datos_llamados[$i]["17"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["18"] > 0 ) { echo $datos_llamados[$i]["18"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["19"] > 0 ) { echo $datos_llamados[$i]["19"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["20"] > 0 ) { echo $datos_llamados[$i]["20"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["21"] > 0 ) { echo $datos_llamados[$i]["21"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["22"] > 0 ) { echo $datos_llamados[$i]["22"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["23"] > 0 ) { echo $datos_llamados[$i]["23"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["24"] > 0 ) { echo $datos_llamados[$i]["24"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["25"] > 0 ) { echo $datos_llamados[$i]["25"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["26"] > 0 ) { echo $datos_llamados[$i]["26"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["27"] > 0 ) { echo $datos_llamados[$i]["27"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["28"] > 0 ) { echo $datos_llamados[$i]["28"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["29"] > 0 ) { echo $datos_llamados[$i]["29"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["30"] > 0 ) { echo $datos_llamados[$i]["30"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php if ( $datos_llamados[$i]["31"] > 0 ) { echo $datos_llamados[$i]["31"];  } else {  echo '-'; } ;?> </td>    
                                                <td><?php echo $Total_Llamados  ;?>  </td>
                                                <td><?php echo round( ( ( $Total_Llamados * $Por1) /100 ), 0);?>  </td> 
                                                <td><?php echo round( ( ( $Total_Llamados * $Por2) /100 ), 0);?>  </td> 
                                                ?>
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
        <div class="tab-pane fade" id="Resumen_Encuestas">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary filterable">
                        <div class="panel-titulo">
                            <h3 class="panel-title">Hojas de Ruta  / Encuestador : <?php echo $Nombre_Usr;?> </h3>      
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
                                    <th>Total </th>
                                    <th><?php echo $Por1.' %' ; ?></th>
                                    <th><?php echo $Por2.' %' ; ?></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $Hojas = new Informes();
                                    $datos_hojas=$Hojas->Get_Hojas_Ruta_Encuestador_Acumuladas_Fecha_usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);
                                    if ( sizeof($datos_hojas) == 0 ) {
                                        echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                                    } else { 
                                        for($i=0;$i<sizeof($datos_hojas);$i++)
                                        { 
                                                $Total_Encuestas  = $datos_hojas[$i]["A2"]      + $datos_hojas[$i]["E"]       + $datos_hojas[$i]["ERROR"]   + $datos_hojas[$i]["NOENC"]   +
                                                                    $datos_hojas[$i]["NV"]      + $datos_hojas[$i]["P1"]      + $datos_hojas[$i]["P2"]      + $datos_hojas[$i]["P3"]      +
                                                                    $datos_hojas[$i]["P4"]      + $datos_hojas[$i]["P5"]      + $datos_hojas[$i]["P6"]      + $datos_hojas[$i]["P7"]      +
                                                                    $datos_hojas[$i]["P8"]      + $datos_hojas[$i]["R2"]      + $datos_hojas[$i]["ANUL"]    + $datos_hojas[$i]["DES"]     
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
                                                <td><?php echo $Total_Encuestas ;?>   </td>
                                                <td><?php echo round( ( ( $Total_Encuestas * $Por1) / 100 ), 0);?>   </td>
                                                <td><?php echo round( ( ( $Total_Encuestas * $Por2) / 100 ), 0);?>   </td>
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
        <div class="tab-pane fade" id="Actividades_Diarias">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="row">
                        <div class="col-lg-15">
                            <div class="panel panel-primary filterable">
                                <div class="panel-titulo">
                                    <h3 class="panel-title">Actividades Diarias / <?php echo $Nombre_Usr;?> </h3>      
                                </div>
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th>Actividad</th>
                                            <?php 
                                                for ($mes=1; $mes < 32 ; $mes++) { 
                                                    echo "<th>".$mes."</th>";   
                                            }
                                            ?>
                                            <th> Total </th>
                                            <th><?php echo $Por1.' %' ; ?></th>
                                            <th><?php echo $Por2.' %' ; ?></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php                               
                                            $informe = new Informes();
                                            $datos_informe=$informe->get_actividades_diarias_usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda);                         
                                            if (sizeof($datos_informe) == 0){
                                            echo "<h4> No Registra Actividades </h4>";
                                            } else{
                                            for ($i=0; $i < sizeof($datos_informe) ; $i++) { 
                                                $Total_Actividad =    $datos_informe[$i]["1"] + $datos_informe[$i]["2"]  + $datos_informe[$i]["3"]  +
                                                                      $datos_informe[$i]["4"] + $datos_informe[$i]["5"]  + $datos_informe[$i]["6"]  +
                                                                      $datos_informe[$i]["7"] + $datos_informe[$i]["8"]  + $datos_informe[$i]["9"]  +
                                                                     $datos_informe[$i]["10"] + $datos_informe[$i]["11"] + $datos_informe[$i]["12"] +
                                                                     $datos_informe[$i]["13"] + $datos_informe[$i]["14"] + $datos_informe[$i]["15"] +
                                                                     $datos_informe[$i]["16"] + $datos_informe[$i]["17"] + $datos_informe[$i]["18"] +
                                                                     $datos_informe[$i]["19"] + $datos_informe[$i]["20"] + $datos_informe[$i]["21"] +
                                                                     $datos_informe[$i]["22"] + $datos_informe[$i]["23"] + $datos_informe[$i]["24"] +
                                                                     $datos_informe[$i]["25"] + $datos_informe[$i]["26"] + $datos_informe[$i]["27"] +
                                                                     $datos_informe[$i]["28"] + $datos_informe[$i]["29"] + $datos_informe[$i]["30"] +
                                                                     $datos_informe[$i]["31"] 
                                                ?>
                                                <tr>
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
                                                <td> <?php echo $Total_Actividad ; ?> </td>
                                                <td><?php echo round ( ( ( $Total_Actividad * $Por1) / 100 ), 0 );?>   </td>
                                                <td><?php echo round ( ( ( $Total_Actividad * $Por2) / 100 ), 0 );?>   </td>
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
    </div>
</div>