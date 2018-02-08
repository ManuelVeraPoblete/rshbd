<?php
	require("../../Clases/ClaseInformes.php");
    $id = intval($_REQUEST['id']);
    $ate=new Informes(); 
    $d_a=$ate->Get_Atenciones_Acumuladas_Anio($id);
    $paso_atencion = 0; ?>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
            for($i=0;$i<sizeof($d_a);$i++)
            { 
                if ( $i == 0 )
                {
                    echo "<div class='panel panel-default'>";
                        echo "<div class='panel-heading' role='tab' id='heading".$i."'>";
                            echo "<h4 class='panel-title'>";
                               echo "<a data-toggle='collapse'
                                        data-parent='#accordion'
                                        href='#collapse".$i."'
                                        aria-expanded='true'
                                        aria-controls='collapse".$i."'>".$d_a[$i]['Requerimiento'].'-'.$d_a[$i]['Consulta']."</a>";
                            echo "</h4>";
                        echo "</div>";
                        echo "<div id='collapse".$i."' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='heading".$i."'>";
                           echo "<div class='panel-body'>"; 
                            ?>
                                <table class='table table-striped table-condensed '>
                                    <thead>
                                        <tr>
                                            <td >Enero</td>   <td>Febrero</td>   <td>Marzo</td>
                                            <td >Abril</td>   <td>Mayo</td>      <td>Junio</td>
                                            <td >Julio</td>   <td>Agosto</td>    <td>Septiembre</td>
                                            <td >Octubre</td> <td>Noviembre</td> <td>Diciembre</td>
                                            <td> Total </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <td><?php echo $d_a[$i]["Enero_Pendiente"]      + $d_a[$i]["Enero_Aprovado"]      +$d_a[$i]["Enero_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Febrero_Pendiente"]    + $d_a[$i]["Febrero_Aprovado"]    +$d_a[$i]["Febrero_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Marzo_Pendiente"]      + $d_a[$i]["Marzo_Aprovado"]      +$d_a[$i]["Marzo_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Abril_Pendiente"]      + $d_a[$i]["Abril_Aprovado"]      +$d_a[$i]["Abril_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Mayo_Pendiente"]       + $d_a[$i]["Mayo_Aprovado"]       +$d_a[$i]["Mayo_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Junio_Pendiente"]      + $d_a[$i]["Junio_Aprovado"]      +$d_a[$i]["Junio_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Julio_Pendiente"]      + $d_a[$i]["Julio_Aprovado"]      +$d_a[$i]["Julio_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Agosto_Pendiente"]     + $d_a[$i]["Agosto_Aprovado"]     +$d_a[$i]["Agosto_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Septiembre_Pendiente"] + $d_a[$i]["Septiembre_Aprovado"] +$d_a[$i]["Septiembre_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Octubre_Pendiente"]    + $d_a[$i]["Octubre_Aprovado"]    +$d_a[$i]["Octubre_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Noviembre_Pendiente"]  + $d_a[$i]["Noviembre_Aprovado"]  +$d_a[$i]["Noviembre_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Diciembre_Pendiente"]  + $d_a[$i]["Diciembre_Aprovado"]  +$d_a[$i]["Diciembre_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Enero_Pendiente"]      + $d_a[$i]["Enero_Aprovado"]      +$d_a[$i]["Enero_Anulado"]+
                                                           $d_a[$i]["Febrero_Pendiente"]    + $d_a[$i]["Febrero_Aprovado"]    +$d_a[$i]["Febrero_Anulado"]+
                                                           $d_a[$i]["Marzo_Pendiente"]      + $d_a[$i]["Marzo_Aprovado"]      +$d_a[$i]["Marzo_Anulado"]+
                                                           $d_a[$i]["Abril_Pendiente"]      + $d_a[$i]["Abril_Aprovado"]      +$d_a[$i]["Abril_Anulado"]+
                                                           $d_a[$i]["Mayo_Pendiente"]       + $d_a[$i]["Mayo_Aprovado"]       +$d_a[$i]["Mayo_Anulado"]+
                                                           $d_a[$i]["Junio_Pendiente"]      + $d_a[$i]["Junio_Aprovado"]      +$d_a[$i]["Junio_Anulado"]+
                                                           $d_a[$i]["Julio_Pendiente"]      + $d_a[$i]["Julio_Aprovado"]      +$d_a[$i]["Julio_Anulado"]+
                                                           $d_a[$i]["Agosto_Pendiente"]     + $d_a[$i]["Agosto_Aprovado"]     +$d_a[$i]["Agosto_Anulado"]+
                                                           $d_a[$i]["Septiembre_Pendiente"] + $d_a[$i]["Septiembre_Aprovado"] +$d_a[$i]["Septiembre_Anulado"]+
                                                           $d_a[$i]["Octubre_Pendiente"]    + $d_a[$i]["Octubre_Aprovado"]    +$d_a[$i]["Octubre_Anulado"]+
                                                           $d_a[$i]["Noviembre_Pendiente"]  + $d_a[$i]["Noviembre_Aprovado"]  +$d_a[$i]["Noviembre_Anulado"]+
                                                           $d_a[$i]["Diciembre_Pendiente"]  + $d_a[$i]["Diciembre_Aprovado"]  +$d_a[$i]["Diciembre_Anulado"] ;?></td>
                                            
                                        </tr>
                                    </tbody>
                                </table> <?php
                      
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    } else {
                        echo "<div class='panel panel-default'>";
                            echo "<div class='panel-heading' role='tab' id='heading".$i."'>";
                                echo "<h4 class='panel-title'>";
                                    echo "<a data-toggle='collapse'
                                                data-parent='#accordion'
                                                href='#collapse".$i."'
                                                aria-expanded='false'
                                                aria-controls='collapse".$i."'>".$d_a[$i]['Requerimiento'].'-'.$d_a[$i]['Consulta']."</a>";
                                echo "</h4>";
                            echo "</div>";
                            echo "<div id='collapse".$i."'
                                       class='panel-collapse collapse' 
                                       role='tabpanel' 
                                       aria-labelledby='heading".$i."'>";

                                echo "<div class='panel-body'>";
                                     ?>
                                    <table class='table table-striped table-condensed '>
                                    <thead>
                                        <tr>
                                            <td >Enero</td>   <td>Febrero</td>   <td>Marzo</td>
                                            <td >Abril</td>   <td>Mayo</td>      <td>Junio</td>
                                            <td >Julio</td>   <td>Agosto</td>    <td>Septiembre</td>
                                            <td >Octubre</td> <td>Noviembre</td> <td>Diciembre</td>
                                            <td> Total </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <td><?php echo $d_a[$i]["Enero_Pendiente"]      + $d_a[$i]["Enero_Aprovado"]      +$d_a[$i]["Enero_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Febrero_Pendiente"]    + $d_a[$i]["Febrero_Aprovado"]    +$d_a[$i]["Febrero_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Marzo_Pendiente"]      + $d_a[$i]["Marzo_Aprovado"]      +$d_a[$i]["Marzo_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Abril_Pendiente"]      + $d_a[$i]["Abril_Aprovado"]      +$d_a[$i]["Abril_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Mayo_Pendiente"]       + $d_a[$i]["Mayo_Aprovado"]       +$d_a[$i]["Mayo_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Junio_Pendiente"]      + $d_a[$i]["Junio_Aprovado"]      +$d_a[$i]["Junio_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Julio_Pendiente"]      + $d_a[$i]["Julio_Aprovado"]      +$d_a[$i]["Julio_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Agosto_Pendiente"]     + $d_a[$i]["Agosto_Aprovado"]     +$d_a[$i]["Agosto_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Septiembre_Pendiente"] + $d_a[$i]["Septiembre_Aprovado"] +$d_a[$i]["Septiembre_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Octubre_Pendiente"]    + $d_a[$i]["Octubre_Aprovado"]    +$d_a[$i]["Octubre_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Noviembre_Pendiente"]  + $d_a[$i]["Noviembre_Aprovado"]  +$d_a[$i]["Noviembre_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Diciembre_Pendiente"]  + $d_a[$i]["Diciembre_Aprovado"]  +$d_a[$i]["Diciembre_Anulado"];?></td>
                                            <td><?php echo $d_a[$i]["Enero_Pendiente"]      + $d_a[$i]["Enero_Aprovado"]      +$d_a[$i]["Enero_Anulado"]+
                                                           $d_a[$i]["Febrero_Pendiente"]    + $d_a[$i]["Febrero_Aprovado"]    +$d_a[$i]["Febrero_Anulado"]+
                                                           $d_a[$i]["Marzo_Pendiente"]      + $d_a[$i]["Marzo_Aprovado"]      +$d_a[$i]["Marzo_Anulado"]+
                                                           $d_a[$i]["Abril_Pendiente"]      + $d_a[$i]["Abril_Aprovado"]      +$d_a[$i]["Abril_Anulado"]+
                                                           $d_a[$i]["Mayo_Pendiente"]       + $d_a[$i]["Mayo_Aprovado"]       +$d_a[$i]["Mayo_Anulado"]+
                                                           $d_a[$i]["Junio_Pendiente"]      + $d_a[$i]["Junio_Aprovado"]      +$d_a[$i]["Junio_Anulado"]+
                                                           $d_a[$i]["Julio_Pendiente"]      + $d_a[$i]["Julio_Aprovado"]      +$d_a[$i]["Julio_Anulado"]+
                                                           $d_a[$i]["Agosto_Pendiente"]     + $d_a[$i]["Agosto_Aprovado"]     +$d_a[$i]["Agosto_Anulado"]+
                                                           $d_a[$i]["Septiembre_Pendiente"] + $d_a[$i]["Septiembre_Aprovado"] +$d_a[$i]["Septiembre_Anulado"]+
                                                           $d_a[$i]["Octubre_Pendiente"]    + $d_a[$i]["Octubre_Aprovado"]    +$d_a[$i]["Octubre_Anulado"]+
                                                           $d_a[$i]["Noviembre_Pendiente"]  + $d_a[$i]["Noviembre_Aprovado"]  +$d_a[$i]["Noviembre_Anulado"]+
                                                           $d_a[$i]["Diciembre_Pendiente"]  + $d_a[$i]["Diciembre_Aprovado"]  +$d_a[$i]["Diciembre_Anulado"] ;?></td>
                                            
                                        </tr>
                                    </tbody>
                                </table> <?php
                                    



                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                } ?>
            </div>
     