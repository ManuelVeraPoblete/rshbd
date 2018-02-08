<?php
require_once("../Paginacion/Logeo.php");
require_once("../Clases/ClaseCalle.php");
require_once("../Include/Rutinas.php");
$tra=new Calle();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->add_calle();
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
            <h2>Crear Calles</h2>
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a href="Calle.php" title="Agregar Usuario">
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
                            echo mysql_error();
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
                        <td>Nombre Calle</td>
                        <td><input type='text' name='Calle' class='form-control input-lg' required></td>
                    </tr>
                </table>
                <input type="hidden" name="grabar" value="si">
                <button class="form-control btn btn-primary">Crear</button>   
            </form>
        </div>
        <?php require_once("../Include/footer.php");?>
    </body>
</html>