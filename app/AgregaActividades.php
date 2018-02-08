<?php
require_once("../Paginacion/Logeo.php")         ;
require_once("../Clases/ClaseUsuario.php")      ;
require_once("../Clases/ClaseActividad.php")    ;
require_once("../Include/Rutinas.php")          ;
if (isset($_GET["id"])) {
    $id_usuario = $_GET["id"];
}
$tra=new Actividades();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->add_actividades_diarias();
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
            <h2>Agregar Actividad</h2>
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a href="Ingreso_Actividades.php" title="Agregar Usuario">
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
                        <td>Usuario</td>
                        <?php
                           $usr= new Usuario();
                           $usr_act = $usr->get_usuario_por_id($id_usuario)
                        ?>
                        <td>
                            <input type='text' name='Nombre' class='form-control'  value="<?php echo $usr_act[0]["Nombre"].' '.$usr_act[0]["Apellido"] ;?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha Activacion</td>
                        <td><input type='date' name='Fecha_Actividad' class='form-control'  value="<?php echo date("Y-m-d");?>" required></td>
                    </tr>
                    <tr> 
                        <td> Actividad </td>
                        <td> 
                            <select name="Actividad_Id" class="form-control">
                            <?php
                            $perf=new Actividades();
                            $per=$perf->get_actividades();
                            for($i=0;$i<sizeof($per);$i++)
                            {
                                ?>
                                <option  value="<?php echo $per[$i]["id"];?>"><?php echo $per[$i]["Actividades"];?></option>
                                <?php 
                            }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Cantidad</td>
                        <td>
                            <input type='text' name='Cantidad' class='form-control'  required  >
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="grabar" value="si">
                <input type="hidden" name="Usuario_Id" value="<?php echo $id_usuario;?>">
                <button class="form-control btn btn-primary">Crear</button>   
            </form>
        </div>
        <?php require_once("../Include/footer.php");?>
    </body>
</html>