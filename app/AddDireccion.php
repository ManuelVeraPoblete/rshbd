<?php
require_once("../Paginacion/Logeo.php")             ;
require_once("../Clases/ClasePersona.php")          ;
require_once("../Clases/ClaseDireccion.php")        ;
require_once("../Clases/ClasePoblacion.php")        ;
require_once("../Clases/ClaseCalle.php")            ;
require_once("../Clases/ClaseUnidad.php")           ;
require_once("../Include/Rutinas.php")              ;
$tra=new Persona();
$datos=$tra->get_persona_por_id($_GET["id"]);
$dir=new Direccion();
$datos_dir=$dir->get_direccion($_GET["id"]);

if(isset($_POST["grabar_direccion"]) and $_POST["grabar_direccion"]=="si")
{
    $Direccion = new Direccion();
    $Direccion->edit_direccion();
}
//--------------------------------------------------------------------------------------------
    $combo_poblacion='';
    $pobla=new Poblacion();
    $pob=$pobla->get_poblaciones();
    for($i=0;$i<sizeof($pob);$i++)
    {
        $combo_poblacion.= "<option value='".$pob[$i]['id']."'>".$pob[$i]['Poblacion']."</option>";
    }
    //---------------------------------------------------------------------------------------------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
    </head>
     <script>
        $(document).ready(function() {
        // Parametros para el combo
            $("#Poblacion").change(function () {
                $("#Poblacion option:selected").each(function () {
                    elegido=$(this).val();
                    $.post("Ajax/Carga_Unidades.php", { elegido: elegido }, function(data){
                        $("#Unidad").html(data);
                    });     
                });
            });    
        });       
        </script>
    <body>
        <?php require_once("../Include/Menu.php");?>
        <div class="box-ingreso">
            <h4>Historial de Direcciones : <?php echo $datos[0]["Nombre"].' '.$datos[0]["Apellido"];?> </h4>
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a href="Personas.php" title="Agregar Usuario">
                    <button type='button' class="btn btn-info" data-toggle="modal" >
                        <span class="glyphicon glyphicon-step-backward" ></span> 
                        Regresar
                    </button>   
                    </a>
                </div>
                
            </div>  
            <?php
            if(isset($_GET["m"]))
            {
                switch($_GET["m"])
                {
                    case '1':
                        ?>
                        <h2 style="color: red;">Los datos est&aacute;n vac&iacute;os.</h2>
                        <?php
                    break;
                    case '2':
                        ?>
                        <h2 style="color: green;">El registro ha sido editado e
                            xitosamente.</h2>
                        <?php
                    break;
                }
            }
            ?>
            <table class="table   table-striped table-hover">
                <thead>
                    <tr>
                        <td valign="top" >#                 </td>
                        <td valign="top" >Unidad            </td>
                        <td valign="top" >Poblacion         </td>
                        <td valign="top" >Calle             </td>
                        <td valign="top" >Numero            </td>
                        <td valign="top" >Block             </td>
                        <td valign="top" >Departamento      </td>
                        <td valign="top" >Casa              </td>
                        <td valign="top" >Observacion       </td>
                        <td valign="top" >Activa            </td>
                        <td valign="top" >Fecha             </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $impresos=0;
                    foreach($datos_dir as $dato_dir)
                    {
                        ?>
                            <tr>
                                <td valign="top" ><?php echo $datos_dir[$impresos]["id"]?>                  </td>
                                <td valign="top" ><?php echo $datos_dir[$impresos]["Nom_Unidad"]?>          </td>
                                <td valign="top" ><?php echo $datos_dir[$impresos]["Nom_Poblacion"]?>       </td>
                                <td valign="top" ><?php echo $datos_dir[$impresos]["Nom_Calle"]?>           </td>
                                <td valign="top" ><?php echo $datos_dir[$impresos]["Numero"]?>              </td>
                                <td valign="top" ><?php echo $datos_dir[$impresos]["Block"]?>               </td>
                                <td valign="top" ><?php echo $datos_dir[$impresos]["Departamento"]?>        </td>
                                <td valign="top" ><?php echo $datos_dir[$impresos]["Casa"]?>                </td>
                                <td valign="top" ><?php echo $datos_dir[$impresos]["Observacion"]?>         </td>
                                <?php 
                                   if ( $datos_dir[$impresos]["Activa"] == '1' ) { ?>
                                      <td valign="top" >Activo</td>
                                      <td valign="top" ><?php echo $datos_dir[$impresos]["Fecha"]?></td>
                                   <?php } else { ?>
                                       <td valign="top" >Inactiva</td>
                                       <td valign="top" ><?php echo $datos_dir[$impresos]["Fecha"]?></td>
                                   <?php }  ?>
                            </tr>
                        <?php
                        $impresos++;
                    }
                    ?>
                </tbody>
            </table>
            <form method='post'>
                <table class='table  '>
                    <input type="hidden" name="id_usuario_act" value=<?php echo $id_usuario_act             ;   ?>  >
                    <tr>
                        <td>Poblacion</td>
                        <td>
                            <select name="Poblacion_Id" class="form-control" id="Poblacion" >
                                <option value='0'>Seleccione Poblacion <option>
                                <?php 
                                    echo $combo_poblacion;
                                ?>
                            </select>
                        </td>                            
                        <td>Unidad Vecinal</td>
                        <td>
                            <select name="Unidad_Id" id="Unidad" class="form-control" id="Unidad_Vecinal">                            
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Calle</td>
                        <td>
                            <select name="Calle_Id" class="form-control">
                            <?php
                                $calle=new Calle();
                                $cal=$calle->get_calles();
                                for($i=0;$i<sizeof($cal);$i++)
                                {
                                    ?>
                                    <option  value="<?php echo $cal[$i]["id"];?>"><?php echo $cal[$i]["Calle"];?></option>
                                    <?php 
                                }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Numero</td>
                        <td><input  type='text' 
                                    name='Numero' 
                                    class='form-control'  
                                    required  
                                    placeholder="Numero ">
                        </td>
                        <td>Block</td>
                        <td><input  type='text' 
                                    name='Block'  
                                    class='form-control'  
                                    required  
                                    placeholder="Numero de Block"></td>
                    </tr>
                    <tr>
                        <td>Departamento</td>
                        <td><input  type='text' 
                                    name='Departamento'  
                                    class='form-control'  
                                    required  
                                    placeholder="Numero de Departamento">
                        </td>
                        <td>Casa</td>
                        <td><input  type='text' 
                                    name='Casa' 
                                    class='form-control'  
                                    required  
                                    placeholder="Numero de Casa"></td>
                    </tr>
                    <tr>
                        <td>Referencia</td>
                        <td><input  type="text"  
                                    class="form-control" 
                                    name="Referencia"   
                                    placeholder="Ingrese Referencia Direccion" >
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="grabar_direccion" value="si">
                <input type="hidden" name="id_persona" value="<?php echo $_GET["id"]?>" />
                <button class="form-control btn btn-primary">Actualizar</button>   
            </form>
        </div>
        <?php require_once("../Include/footer.php");?>
    </body>
</html>