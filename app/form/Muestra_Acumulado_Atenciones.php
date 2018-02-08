<div class="panel-body">
  <div class="tab-content">
    <div class="tab-pane fade in active" id="Atenciones">
      <div class="panel panel-primary filterable">
        <div class="panel-heading">
          <h3 class="panel-title">Atenciones Diarias</h3>      
        </div>
        <table class='table'>
          <thead>
            <tr>
                <th>#</th>
                <th>Rut</th>
                <th>Nombre</th>
                <th>Fecha Atencion</th>
                <th>Hora Atencion</th>
                <th>Estado</th>
                <th>Observacion</th>
                <th>Consultas</th>
                <th>Programa</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $Fecha_Desde    = $_POST["Fecha_Desde"] ;
              $Pendientes = 0 ; $Cerradas = 0;
              $Total_Personas = 0;
              $Numero_Hoja_Paso = 0;
              $atenciones = new Informes();
              $datos_atenciones=$atenciones->Get_Atenciones_Diarias_Resumen( $Fecha_Desde);
              if ( sizeof($datos_atenciones) == 0 ) 
              {
                echo "<center><h4> No Existen Registros a Imprimir </h4></center";
              } else 
                { 
                  $Total_Cerradas = 0 ; $Total_Abiertas = 0;
                  for($i=0;$i<sizeof($datos_atenciones);$i++)
                    { 
                      ?>
                        <tr>
                          <td><?php echo $datos_atenciones[$i]["AT_id"];?></td>
                          <td><?php echo $datos_atenciones[$i]["PE_Rut"];?></td>
                          <td><?php echo $datos_atenciones[$i]["PE_Nombre"].' '.$datos_atenciones[$i]["PE_Apellido"];?></td>
                          <td><?php echo $datos_atenciones[$i]["AT_Fecha_Atencion"];?></td>
                          <td><?php echo $datos_atenciones[$i]["AT_Hora_Atencion"];?></td>
                          <?php
                            if ($datos_atenciones[$i]["AT_Estado_Atencion"] == 1 ) {
                              echo "<td>Pendiente</td>";
                              $Pendientes++;
                            } else 
                              {
                                echo "<td>Cerrada</td>";
                                $Cerradas++;
                              }
                            ?>
                              <td><?php echo $datos_atenciones[$i]["AT_Observacion"];?></td>
                              <?php 
                                $consu = new Informes();
                                $datos_consultas = $consu->Get_Consultas($datos_atenciones[$i]["AT_id"]);
                                $cantidad_vacios = 5 - sizeof($datos_consultas);
                                $campo_consulta  = ' ';
                                for($h=0;$h<sizeof($datos_consultas);$h++)
                                {
                                  $campo_consulta = $campo_consulta.'  '.$datos_consultas[$h]["Resu"];
                                }
                                for($v=0;$v<$cantidad_vacios;$v++)
                                {
                                  $campo_consulta = $campo_consulta . '     ';
                                }
                              ?>
                              <td><?php echo $campo_consulta ; ?></td>
                              <?php 
                                $prog = new Informes();
                                $datos_programa = $prog->Get_Programas($datos_atenciones[$i]["AT_id"]);
                                $cantidad_vacios = 5 - sizeof($datos_programa);
                                $campo_programa  = ' ';
                                for($j=0;$j<sizeof($datos_programa);$j++)
                                {
                                  $campo_programa = $campo_programa.'  '.$datos_programa[$j]["Resu_Prog"];
                                }
                                for($v=0;$v<$cantidad_vacios;$v++)
                                {
                                  $campo_programa = $campo_programa . '     ';
                                }
                              ?>
                              <td><?php echo $campo_programa ; ?></td>
                        <tr>
                    <?php   
                    }
                }
                ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane" id="Acumulado">
      <div class="panel panel-primary filterable">
        <div class="panel-heading">
          <h3 class="panel-title">Atenciones Diarias Acumuladas</h3>      
        </div>
        <table class='table'>
          <thead>
            <tr>
              <th>Consulta</th>
              <th>Pendientes</th>
              <th>Cerradas</th>
              <th>Anuladas</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $Total_Pendientes = 0 ; $Total_Cerradas = 0; $Total_Anuladas = 0;
              $Fecha_Desde    = $_POST["Fecha_Desde"] ;
              $Pendientes = 0 ; $Cerradas = 0;
              $Total_Personas = 0;
              $Numero_Hoja_Paso = 0;
              $atenciones = new Informes();
              $datos_atenciones=$atenciones->Get_Atenciones_Diarias_Acumulado( $Fecha_Desde);
              if ( sizeof($datos_atenciones) == 0 ) 
              {
                echo "<center><h4> No Existen Registros a Imprimir </h4></center";
              } else 
                { 
                  for($i=0;$i<sizeof($datos_atenciones);$i++)
                    { 
                      $Total_Pendientes = $Total_Pendientes + $datos_atenciones[$i]["Pendientes"];
                      $Total_Cerradas = $Total_Cerradas + $datos_atenciones[$i]["Cerradas"];
                      $Total_Anuladas = $Total_Anuladas + $datos_atenciones[$i]["Anuladas"];
                      ?>
                        <tr>
                          <td><?php echo $datos_atenciones[$i]["Consulta"];?></td>
                          <td><?php echo $datos_atenciones[$i]["Pendientes"];?></td>
                          <td><?php echo $datos_atenciones[$i]["Cerradas"];?></td>
                          <td><?php echo $datos_atenciones[$i]["Anuladas"];?></td>
                          <td><?php echo $datos_atenciones[$i]["Pendientes"] + 
                                         $datos_atenciones[$i]["Cerradas"] +
                                         $datos_atenciones[$i]["Anuladas"] ; ?> </td>
                        </tr>
                    <?php   
                    } ?>
                        <tr style="background-color: rgba(244, 67, 54, 0.37);">
                          <td><strong>Total</strong></td>
                          <td><strong><?php echo $Total_Pendientes;?></strong></td>
                          <td><strong><?php echo $Total_Cerradas;?></strong></td>
                          <td><strong><?php echo $Total_Anuladas;?></strong></td>
                          <td><strong><?php echo $Total_Pendientes +
                                         $Total_Cerradas +
                                         $Total_Anuladas ?></strong></td>
                        </tr>
                      
                        <?php
                }
                ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane" id="Acumulado_Total">
      <div class="panel panel-primary filterable">
        <div class="panel-heading">
          <h3 class="panel-title">Acumulado</h3>      
        </div>
        <table class='table'>
          <thead>
            <tr>
              <th>Año</th>
              <th>Mes</th>
              <th>Personas</th>
              <th>Desvinculacion</th>
              <th>Recien Nacidos</th>
              <th>Otro Integrante</th>
              <th>Cambio Domicilio</th>
              <th>Cartola</th>
              <th>Educacion</th>
              <th>Parentesco</th>
              <th>Ocupacion / Ingreso</th>
              <th>Salud</th>
              <th>Ingreso Registro RSH</th>
              <th>Actualizacion / Rectificacion</th>
              <th>Complemento Educacion</th>
              <th>Otra Consulta</th>
              <th>Modulo Vivienda</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $Total_Linea = 0;
              $atenciones = new Informes();
              $datos_atenciones=$atenciones->Get_Atenciones_Total();
              if ( sizeof($datos_atenciones) == 0 ) 
              {
                echo "<center><h4> No Existen Registros a Imprimir </h4></center";
              } else 
                { 
                  for($i=0;$i<sizeof($datos_atenciones);$i++)
                    { 
                      
                      ?>
                        <tr>
                          <td><?php echo $datos_atenciones[$i]["Ano_Proceso"]              ;?></td>
                          <td><?php echo Nombre_Mes($datos_atenciones[$i]["Mes_Proceso"])   ;?></td>
                          <td>Personas</td>
                          <td><?php echo $datos_atenciones[$i]["Desvinculacion"]              ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Recien_Nacidos"]              ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Otro_Integrante"]             ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Cambio_Domicilio"]            ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Cartola"]                     ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Educacion"]                   ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Parentesco"]                  ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Ocupacion_Ingreso"]           ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Salud"]                       ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Ingreso_Registro_RSH"]        ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Actualizacion_Rectificacion"] ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Complemento_Educacion"]       ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Otra_Consulta"]               ;?></td>
                          <td><?php echo $datos_atenciones[$i]["Modulo_Vivienda"]             ;?></td>

                          <td><?php echo $datos_atenciones[$i]["Desvinculacion"]              +
                                         $datos_atenciones[$i]["Recien_Nacidos"]              +
                                         $datos_atenciones[$i]["Otro_Integrante"]             +
                                         $datos_atenciones[$i]["Cambio_Domicilio"]            +
                                         $datos_atenciones[$i]["Cartola"]                     +
                                         $datos_atenciones[$i]["Educacion"]                   +
                                         $datos_atenciones[$i]["Parentesco"]                  +
                                         $datos_atenciones[$i]["Ocupacion_Ingreso"]           +
                                         $datos_atenciones[$i]["Salud"]                       +
                                         $datos_atenciones[$i]["Ingreso_Registro_RSH"]        +
                                         $datos_atenciones[$i]["Actualizacion_Rectificacion"] +
                                         $datos_atenciones[$i]["Complemento_Educacion"]       +
                                         $datos_atenciones[$i]["Otra_Consulta"]               +
                                         $datos_atenciones[$i]["Modulo_Vivienda"]             ;?></td>



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