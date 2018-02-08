<?php
require_once("../Paginacion/Logeo.php");
require_once("../Clases/ClaseDireccion.php");
require_once("../Clases/ClaseUnidad.php");
require_once("../Clases/ClasePoblacion.php");
require_once("../Clases/ClaseCalle.php");
require_once("../Include/Rutinas.php")                  ;
$id_persona= $_GET["id_persona"];
$tra=new Direccion();
$datos=$tra->get_direccion_por_id($_GET["id"]);
if(sizeof($datos)==0)                                   {require_once("error.php")  ;exit;}
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")  {$tra->edit_direccion()     ;exit;}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
    </head>
    <body>
        <?php require_once("../Include/Menu.php");?>
        <div class="box-ingreso">
            <h2>Editar Direccion</h2>
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a href="AddDireccion.php?id=<?php echo $id_persona;?>" title="Agregar Usuario">
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
                            <h2 style="color: green;">El registro ha sido editado exitosamente.</h2>
                            <?php
                        break;
                    }
                }
            ?>
            <form method='post'>
                <table class='table  '>
                    <tr> 
                        <td> Unidad Vecinal </td>
                        <td> 
                            <select name="Unidad_Id" class="form-control">
                                <?php
                                    $unif=new Unidad();
                                    $uni=$unif->get_unidades();
                                    for($i=0;$i<sizeof($uni);$i++)
                                    {
                                    ?>
                                        <option  value="<?php echo $uni[$i]["id"];?>"><?php echo $uni[$i]["Unidad"];?></option>
                                    <?php 
                                }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> Poblacion </td>
                        <td> 
                            <select name="Poblacion_Id" class="form-control">
                            <?php
                            $pobla=new Poblacion();
                            $pob=$pobla->get_poblaciones();
                            for($i=0;$i<sizeof($pob);$i++)
                            {
                                ?>
                                <option  value="<?php echo $pob[$i]["id"];?>"><?php echo $pob[$i]["Poblacion"];?></option>
                                <?php 
                            }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> Calle </td>
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
                        <td><input type='text' name='Numero' value="<?php echo $datos[0]["Numero"];?>" class='form-control'  required></td>
                    </tr>
                    <tr>
                        <td>Block</td>
                        <td><input type='text' name='Block' value="<?php echo $datos[0]["Block"];?>" class='form-control'  required></td>
                    </tr>
                    <tr>
                        <td>Departamento</td>
                        <td><input type='text' name='Departamento' value="<?php echo $datos[0]["Departamento"];?>" class='form-control'  required></td>
                    </tr>                    
                    <tr>
                        <td>Casa</td>
                        <td><input type='text' name='Casa' value="<?php echo $datos[0]["Casa"];?>" class='form-control'  required></td>
                    </tr>   
                    <tr>
                        <td>Observacion</td>
                        <td><input type='text' name='Observacion' value="<?php echo $datos[0]["Observacion"];?>" class='form-control'  required></td>
                    </tr>
                </table>
                <input type="hidden" name="grabar" value="si">
                <input type="hidden" name="id" value="<?php echo $_GET["id"]?>" />
                <input type="hidden" name="id" value="<?php echo $_GET["id_persona"]?>" />
                <button class="form-control btn btn-primary">Actualizar</button>   
            </form>
        </div>
        <?php require_once("../Include/footer.php");?>
    </body>
</html>