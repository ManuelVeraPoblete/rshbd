<form   action="Ingreso_de_Respuestas_Hojas_de_Ruta.php" accept-charset="UTF-8" method="post">
    <div class="panel-body">
        <div class="tab-content">
            <table class='table  '>
                <tr>
                    <td>Numero Hoja de Ruta:</td>
                    <td>
                        <input  type        = "text" 
                                disabled 
                                class       ="form-control" 
                                name        ="Numero_Hoja" 
                                value       ="<?php echo $datos[0]["HC_Numero_Hoja"];?>" id="name">
                    </td>
                    <?php
                        $Sector = new Sector();
                        $Sec=$Sector->get_sector_por_id($datos[0]["HC_Sector_Id"]);
                    ?>
                    <td>Sector:</td>
                    <td>
                        <input  type        ="Text" 
                                disabled 
                                class       ="form-control" 
                                name        ="Sector" 
                                value       ="<?php echo $Sec[0]["Sector"];?>">
                        </td>
                </tr>
                <tr>
                    <td>Fecha Entrega:</td>
                    <td>
                        <input  type        ="date"  
                                class       ="form-control" 
                                name        ="Fecha_Entrega" 
                                value       ="<?php echo $datos[0]["HC_Fecha_Entrega"];?>" >
                    </td>
                    <td>Fecha Devolucion:</td>
                    <td>
                        <input  type        ="date"  
                                class       ="form-control" 
                                name        ="Fecha_Devolucion" 
                                value       ="<?php echo $datos[0]["HC_Fecha_Devolucion"];?>" >
                    </td>
                    <td>Fecha Generada:</td>
                    <td>
                        <input  type        ="date" 
                                disabled 
                                class       ="form-control" 
                                name        ="Telefono" 
                                value       ="<?php echo $datos[0]["HC_Fecha_Generada"];?>">
                    </td>
                </tr>
                <tr>
                    <td>Usuario Asignada:</td>
                    <td>
                        <select name="Usuario_Asignada" class="form-control">
                            <?php
                                $usr=new Usuario();
                                $usuario=$usr->get_usuarios();
                                for($i=0;$i<sizeof($usuario);$i++)
                                {
                                    if ( $datos[0]["HC_Usuario_Asignada"] == $usuario[$i]["id"] ) { ?>
                                        <option 
                                                value="<?php echo $usuario[$i]["id"];?>" selected >
                                                <?php echo $usuario[$i]["Nombre"].' '.$usuario[$i]["Apellido"];?>
                                        </option>
                                    <?php } else { ?>
                                        <option 
                                             value="<?php echo $usuario[$i]["id"];?>" >
                                             <?php echo $usuario[$i]["Nombre"].' '.$usuario[$i]["Apellido"];?>
                                         </option>
                                    <?php }
                                }?>
                        </select>
                    </td>
                    <?php
                        $Consulta = new Consulta();
                        $Consu=$Consulta->get_consulta_por_id($datos[0]["HC_Consulta_Id"]);
                    ?>
                    <td>Tipo Movimiento:</td>
                    <td>
                        <input  type="text"  
                                disabled 
                                class="form-control" 
                                name="Telefono" 
                                value="<?php echo $Consu[0]["Consulta"];?>" >
                    </td>
                </tr>
            </table>
            <table class="table table table-striped">
                <thead>
                    <tr class="filters">
                        <th>#                 </th>
                        <th>Rut               </th>
                        <th>Nombre            </th>
                        <th>Encuestador       </th>
                        <th>Fecha Visita      </th>
                        <th>AM/PM             </th>
                        <th>Respuesta Anterior</th>
                        <th>Respuesta Actual  </th>
                        <th>Observacion       </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                             for($i=0;$i<sizeof($datos);$i++)
                            {  
                                ?>
                                <tr>
                                    
                                    <?php 
                                        echo "<input 
                                                type='hidden'  
                                                class='form-control'
                                                name='datos[$i][HD_id]'
                                                value='".$datos[$i]["HD_id"]."'>";
                                        echo "<input 
                                                type='hidden'  
                                                class='form-control'
                                                name='datos[$i][Per_Rut]'
                                                value='".$datos[$i]["Per_Rut"]."'>" ;
                                        echo "<input 
                                                type='hidden'  
                                                class='form-control'
                                                name='datos[$i][Per_Nombre]'
                                                value='".$datos[$i]["Per_Nombre"]."'>" ;
                                        echo "<input 
                                                type='hidden'  
                                                class='form-control'
                                                name='datos[$i][Per_Apellido]'
                                                value='".$datos[$i]["Per_Apellido"]."'>"; 
                                    ?>
                                    
                                    <td><?php echo $datos[$i]["HD_Item"];?>                                   </td> 
                                    <td><?php echo $datos[$i]["Per_Rut"];?>                                   </td>
                                    <td><?php echo $datos[$i]["Per_Nombre"].' '.$datos[$i]["Per_Apellido"];?> </td>
                                    <?php
                                        if ($datos[$i]["HD_Respuesta_Id"] == 2 ){
                                            echo "<td> Encuestado </td>";
                                            echo "<input type='hidden'class='form-control' name='datos[$i][HD_Respuesta_Id]' value='0'>"; 
                                            echo "<input type='hidden'class='form-control' name='datos[$i][HD_Usuario_Id]' value='0'>"; 
                                            echo "<input type='hidden'class='form-control' 'datos[$i][HD_Fecha_Visita]' value '0'>";
                                            echo "<input type='hidden'class='form-control' 'datos[$i][HD_AmPm]' value '0'>";
                                            echo "<input type='hidden'class='form-control' 'datos[$i][HD_Respuesta_Id]' value '0'>";
                                            echo "<input type='hidden'class='form-control' 'datos[$i][HD_Observacion]' value '0'>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            
                                        } else { ?>
                                            <td>
                                                <?php
                                                echo "<select name=datos[$i][HD_Usuario_Id] class='form-control'>";
                                                ?>
                                                    <?php
                                                        $usrd=new Usuario();
                                                        $usuariod=$usrd->get_usuarios();
                                                        ?>
                                                        <option  value="0">Ingrese Encuestador...</option>
                                                        <?php
                                                        for($hdu=0;$hdu<sizeof($usuario);$hdu++)
                                                        {
                                                            ?>
                                                            <option  value="<?php echo $usuario[$hdu]["id"];?>"><?php echo $usuario[$hdu]["Nombre"].' '.$usuario[$hdu]["Apellido"];?></option>
                                                            <?php 
                                                        }?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php 
                                                echo "<input 
                                                        type='date'  
                                                        class='form-control'
                                                        name='datos[$i][HD_Fecha_Visita]'
                                                        value='".$datos[$i]["HD_Fecha_Visita"]."'>" 
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                echo "<select class='form-control' name='datos[$i][HD_AmPm]'>";
                                                ?>
                                                                <option  value="AM">AM</option>
                                                                <option  value="PM">PM</option>
                                                </select>
                                            </td>
                                            <td>
                                                <?php
                                                    if ($datos[$i]["HD_Respuesta_Id"] == 0 or is_null($datos[$i]["HD_Respuesta_Id"])) {
                                                        echo "No tiene Visitas Anteriosres";
                                                    } else {
                                                        $respu = new Respuesta();
                                                        $res=$respu->get_respuestas_por_id($datos[$i]["HD_Respuesta_Id"]);
                                                        echo $res[0]["Respuesta_Corta"];
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo "<select  class='form-control' name='datos[$i][HD_Respuesta_Id]'>";
                                                ?>
                                                    <option  value="0">Respuesta...</option>
                                                    <?php
                                                        $resp=new Respuesta();
                                                        $re=$resp->get_respuestas();
                                                        for($r=0;$r<sizeof($re);$r++)
                                                        {
                                                            ?>
                                                            <option  value="<?php echo $re[$r]["id"];?>"><?php echo $re[$r]["Respuesta_Corta"];?></option>
                                                            <?php 
                                                        }?>
                                                </select>
                                            </td>
                                            
                                            <td>
                                                <?php
                                                echo "<input  type    ='text' 
                                                            class   ='form-control' 
                                                            name    ='datos[$i][HD_Observacion]'
                                                            title   ='".$datos[$i]["HD_Observacion"]."'>";
                                                ?>
                                            </td>
                                    <?php } ?>
        
                                            <td>
                                                <button 
                                                    data-toggle="modal" 
                                                    data-target="#view-modal" 
                                                    data-id="<?php echo $datos[$i]['HD_id'];?>" 
                                                    id="getHistorico" 
                                                    class="btn btn-sm btn btn-success"> 
                                                        Historia
                                                </button>
                                            </td>
                                    
                                </tr>
                                <?php 
                            }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--  Input Ocultos Para no perder datos -->
    <input type="hidden" name="arreglo" value="<?php echo serialize($datos);?>">
    <input type="hidden" name="Numero_Hoja_Grabar" value="<?php echo $datos[0]["HC_Numero_Hoja"];?>" />
    <input type="hidden" name="Actualiza" value="S" />
    <div clas="form-actions">
        <center><button type="submit" >Actualizar</button>   </center>
    </div>
</form>