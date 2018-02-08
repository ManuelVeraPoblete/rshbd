<?php
    require_once("../Clases/ClaseActividadesDiaria.php");
    require_once("../Clases/ClaseUsuario.php");
    require_once("../Include/Rutinas.php");
    require_once("../Paginacion/Logeo.php");
$Usuario_Id = $_SESSION["id_usuario"];
$Per_Id     = $_SESSION["per_id"];
$Niv_Id     = $_SESSION["niv_id"];

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once("../Include/Header.php");?>
    </head>
    <body>
        <?php require_once("../Include/Menu.php");?>
        <?php
        if (isset($_GET["id"])) 
        {
            $Usuario_Id = $_GET["id"];
            Include("form/Form_Consulta_Actividad_Diaria.php");
        }
        ?>
    </body>
    <?php Include("../Include/footer.php");?>
</html>