<?php
require_once("../Paginacion/Logeo.php");
require_once("../Clases/ClaseUnidad.php");
require_once("../Clases/ClaseSector.php");
require_once("../Include/Rutinas.php")                  ;
$tra=new Unidad();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->add_unidad();
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
            <h2>Crear Unidad Vecinal</h2>
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
                        <h2 style="color: green;">El registro ha sido creado exitosamente.</h2>
                        <?php
                    break;
                }
            }
            ?>
            <form name="form" action="" method='post' enctype="multipart/form-data">
                <table class='table  '>
                    <tr>
                        <td>Codigo Unidad</td>
                        <td><input type='text' name='Codigo_Unidad' class='form-control'   required></td>
                    </tr>
                    <tr>
                        <td>Nombre Unidad</td>
                        <td><input type='text' name='Unidad' class='form-control'  required></td>
                    </tr>
                    <tr> 
                        <td> Sector </td>
                        <td> 
                            <select name="Sector_Id" class="form-control">
                            <?php
                            $perf=new Sector();
                            $per=$perf->get_sectores();
                            for($i=0;$i<sizeof($per);$i++)
                            {
                                ?>
                                <option  value="<?php echo $per[$i]["id"];?>"><?php echo $per[$i]["Sector"];?></option>
                                <?php 
                            }?>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="grabar" value="si">
                <button class="form-control btn btn-primary">Crear</button>   
            </form>
        </div>
        <?php require_once("../Include/footer.php");?>
    </body>
</html>