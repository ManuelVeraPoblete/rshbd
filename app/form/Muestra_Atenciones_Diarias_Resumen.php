<div class="panel-body">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="Atenciones">
            <div class="panel panel-primary filterable">
                <div class="panel-titulo">
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
                            $Fecha_Hasta    = $_POST["Fecha_Hasta"] ;
                            $Usuario_Id     = $_POST["Usuario_Id"]  ;
                            $Pendientes = 0 ; $Cerradas = 0;
                            $Total_Personas = 0;
                            $Numero_Hoja_Paso = 0;
                            $atenciones = new Informes();
                            $datos_atenciones=$atenciones->Get_Atenciones_Diarias( $Fecha_Desde, $Fecha_Hasta ,$Usuario_Id);
                            if ( sizeof($datos_atenciones) == 0 ) {
                                echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                            } else { 
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
                                            } else {
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
        <div class="tab-pane" id="Atenciones_Cerradas">
            <div class="panel panel-primary filterable">
                <div class="panel-titulo">
                    <h3 class="panel-title">Atenciones Cerradas</h3>      
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
                            $Fecha_Hasta    = $_POST["Fecha_Hasta"] ;
                            $Usuario_Id     = $_POST["Usuario_Id"]  ;
                            $Pendientes = 0 ; $Cerradas = 0;
                            $Total_Personas = 0;
                            $Numero_Hoja_Paso = 0;
                            $atenciones = new Informes();
                            $datos_atenciones=$atenciones->Get_Atenciones_Diarias_Cerradas( $Fecha_Desde, $Fecha_Hasta ,$Usuario_Id);
                            if ( sizeof($datos_atenciones) == 0 ) {
                                echo "<center><h4> No Existen Registros a Imprimir </h4></center";
                            } else { 
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
                                            } else {
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
    </div>
</div>