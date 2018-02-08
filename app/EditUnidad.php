<?php
require_once("../Paginacion/Logeo.php");
require_once("../Clases/ClaseUnidad.php");
require_once("../Clases/ClaseSector.php");
require_once("../Include/Rutinas.php")                  ;
$tra=new Unidad();
$datos=$tra->get_unidad_por_id($_GET["id"]);
if(sizeof($datos)==0)
{
    require_once("error.php");
    exit;
}
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->edit_unidad();
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
    </head>
    <body>
        <?php require_once("../Include/Menu.php");?>
            <div class="box-ingreso">
                <h2>Editar Unidad</h2>
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <a href="Unidades.php" title="Agregar Usuario">
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
                            <td>Codigo Unidad</td>
                            <td><input type='text' name='Codigo_Unidad' value="<?php echo $datos[0]["Codigo_Unidad"];?>" class='form-control'  required></td>
                        </tr>
                        <tr>
                            <td>Nombre Unidad</td>
                            <td><input type='text' name='Unidad' value="<?php echo $datos[0]["Unidad"];?>" class='form-control'  required></td>
                        </tr>
                        <tr> 
                            <td> Sector </td>
                            <td> 
                                <select name="Sector_Id" class="form-control">
                                <?php
                                $sect=new Sector();
                                $sec=$sect->get_sectores();
                                for($i=0;$i<sizeof($sec);$i++)
                                {
                                    if ( $sec[$i]["id"] == $datos[0]["Sector_Id"] )
                                    { ?>
                                        <option  value="<?php echo $sec[$i]["id"];?>" selected ><?php echo $sec[$i]["Sector"];?></option>
                                    <?php 
                                    } else { ?>
                                        <option  value="<?php echo $sec[$i]["id"];?>"><?php echo $sec[$i]["Sector"];?></option>
                                    <?php
                                    }
                                }?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="grabar" value="si">
                    <input type="hidden" name="id" value="<?php echo $_GET["id"]?>" />
                    <button class="form-control btn btn-primary">Actualizar</button>   
                </form>
            </div>
            <?php require_once("../Include/footer.php");?>
        </body>
    </html>