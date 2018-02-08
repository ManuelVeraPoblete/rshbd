<div class="panel-body">
    <div class="tab-content">
            <div class="row">
                <div class="col-lg-15">
                    <div class="panel panel-primary filterable">
                        <div class="panel-heading">
                            <?php
                                 $Mes_Actual =  date("n");
                                 $Anio_Actual =  date("Y");
                                 
                            ?>
                            <h3 class="panel-title">Actividades Diarias / <?php echo Nombre_Mes($Mes_Actual),' del '.$Anio_Actual;?></h3>      
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               
                                  $informe = new ActividadesDiarias();
                                  $datos_informe=$informe->get_actividades_diarias_por_meses_por_usuario($Usuario_Id);
                                 
                                  if (sizeof($datos_informe) == 0){
                                    echo "<h4> No Registra Actividades </h4>";
                                  } else{
                                    for ($i=0; $i < sizeof($datos_informe) ; $i++) { ?>
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