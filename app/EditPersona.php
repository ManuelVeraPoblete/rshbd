<?php
require_once("../Paginacion/Logeo.php");
require_once("../Clases/ClasePersona.php");
require_once("../Clases/ClasePoblacion.php");
require_once("../Clases/ClaseCalle.php");
require_once("../Clases/ClaseUnidad.php");
require_once("../Clases/ClaseDireccion.php");
require_once("../Include/Rutinas.php")                  ;
$tra=new Persona();
$datos=$tra->get_persona_por_id($_GET["id"]);
$id_persona = $_GET["id"];
if(sizeof($datos)==0)
{
    require_once("error.php");
    exit;
}
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->edit_persona();
    exit;
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
            <h2>Editar Ciudadano</h2>
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
                        case '1': ?><h2 style="color: red;">Los datos est&aacute;n vac&iacute;os.</h2><?php break;
                        case '2':?><h2 style="color: green;">El registro ha sido editado exitosamente.</h2><?php break;
                    }
                }
            ?>
            <form method='post'>
                <table class='table  '>
                    <input type="hidden" name="Rut"            value=<?php echo $datos[0]['Rut']            ;   ?>  >
                    <input type="hidden" name="id_usuario_act" value=<?php echo $id_usuario_act             ;   ?>  >
                    <tr>
                        <td>Rut</td>
                        <td>
                            <input type="text"  
                                class="form-control" 
                                name="Rut"  
                                value="<?php echo $datos[0]['Rut'];?> "
                                id="name" 
                                disabled placeholder="Nuevo Ingrese Rut Ciudadano" >
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input  type="text"  
                                    class="form-control" 
                                    name="Nombre" 
                                    value="<?php echo $datos[0]['Nombre'];?>"
                                    placeholder="Ingrese Nombre Ciudadano" >
                        </td>                            
                        <td>Apellido</td>
                        <td><input  type="text"  
                                    class="form-control" 
                                    name="Apellido"  
                                    value="<?php echo $datos[0]['Apellido'];?>"
                                    placeholder="Ingrese Apellidos">
                        </td>
                    </tr>
                    <tr>
                        <td>Telefono</td>
                        <td><input  type="text"  
                                    class="form-control" 
                                    name="Telefono"  
                                    value="<?php echo $datos[0]['Telefono'];?>"
                                    placeholder="Numero de Telefono">
                        </td>
                    </tr>
                    
                </table>
                <h3> Direccion Anterior</h3>
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">Direcciones</h3>      
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="filters">
                                <th>#</th>
                                <th>Unidad</th>
                                <th>Poblacion</th>
                                <th>Calle</th>
                                <th>Numero</th>
                                <th>Block</th>
                                <th>Departamento</th>
                                <th>Casa</th>
                                <th>Observacion</th>
                                <th>Activo</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $direc=new Direccion();
                                $dir=$direc->get_direccion($id_persona);
                                for($i=0;$i<sizeof($dir);$i++)
                                {
                                ?>
                                <tr>
                                    <td valign="top" ><?php echo $dir[$i]["id"]?></td>                                            
                                    <td valign="top" ><?php echo $dir[$i]["Nom_Unidad"]?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Nom_Poblacion"]?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Nom_Calle"]?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Numero"]?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Block"]?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Departamento"]?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Casa"]?></td>
                                    <td valign="top" ><?php echo $dir[$i]["Observacion"]?></td>
                                    <?php 
                                    if ( $dir[$i]["Activa"] == '1' ) { ?>
                                        <td valign="top" >Activo</td>
                                        <td valign="top" ><?php echo $dir[$i]["Fecha"]?></td>    
                                    <?php } else { ?>
                                        <td valign="top" >Inactiva</td>
                                        <td valign="top" ><?php echo $dir[$i]["Fecha"]?></td>
                                    <?php }  ?>
                                </tr>
                                    <?php 
                                }?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="grabar" value="si">
                <input type="hidden" name="id" value="<?php echo $_GET["id"]?>" />
                <button class="form-control btn btn-primary">Actualizar</button>   
            </form> 
        </div>
        <?php require_once("../Include/footer.php");?>
    </body>
</html>