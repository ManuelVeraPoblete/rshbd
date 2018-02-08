<?php
require_once("../Paginacion/Logeo.php");
require_once("../Clases/ClaseUsuario.php");
require_once("../Clases/ClasePerfil.php");
require_once("../Clases/ClaseNivel.php");
require_once("../Include/Rutinas.php")                  ;
$tra=new Usuario();
$datos=$tra->get_usuario_por_id($_GET["id"]);
if(sizeof($datos)==0)
{
    require_once("error.php");
    exit;
}
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->edit_usuario();
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
           <h2>Editar Usuarios</h2>
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <a href="Usuarios.php" title="Agregar Usuario">
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
                        <td>Rut</td>
                        <td><input type='text' name='Rut' value="<?php echo $datos[0]["Rut"];?>" class='form-control'  onblur="onRutBlur(this)" required></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input type='text' name='Nombre' value="<?php echo $datos[0]["Nombre"];?>" class='form-control'  required></td>
                    
                        <td>Apellido</td>
                        <td><input type='text' name='Apellido' value="<?php echo $datos[0]["Apellido"];?>" class='form-control'  required></td>
                    </tr>
                    <tr>
                        <td>Usuario</td>
                        <td><input type='text' name='Usuario' value="<?php echo $datos[0]["Usuario"];?>" class='form-control'  required></td>
                    
                        <td>Email</td>
                        <td><input type='text' name='Email' value="<?php echo $datos[0]["Email"];?>" class='form-control'  required></td>
                    </tr>                    
                    <tr>
                        <td>Fecha Activacion</td>
                        <td><input type='date' name='Fecha_Activacion' value="<?php echo $datos[0]["Fecha_Activacion"];?>" class='form-control'  required></td>
                    </tr>                  
                    <tr> 
                        <td> Perfil </td>
                        <td> 
                            <select name="Perfil_Id" class="form-control">
                            <?php
                            $perf=new Perfil();
                            $per=$perf->get_perfiles();
                            for($i=0;$i<sizeof($per);$i++)
                            {
                                ?>
                                <option  value="<?php echo $per[$i]["id"];?>"><?php echo $per[$i]["Perfil"];?></option>
                                <?php 
                            }?>
                            </select>
                        </td>
                    
                        <td> Nivel </td>
                        <td> 
                            <select name="Nivel_Id" class="form-control">
                            <?php
                            $nive=new Nivel();
                            $niv=$nive->get_niveles();
                            for($i=0;$i<sizeof($per);$i++)
                            {
                                ?>
                                <option  value="<?php echo $niv[$i]["id"];?>"><?php echo $niv[$i]["Nivel"];?></option>
                                <?php 
                            }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Activo</td>
                        <td>
                            <select name="Estado" class="form-control">
                                <option  value="1">ACTIVO</option>
                                <option  value="2">NO ACTIVO</option>
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