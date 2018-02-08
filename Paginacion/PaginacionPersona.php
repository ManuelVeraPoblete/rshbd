<?php
require_once("../Clases/ClasePagina.php");
$u=new Paginas();
$nombre = "";
$apellido = "";
$rut = "";

$cantidad_resultados_por_pagina=15;

    if(isset($_GET["pagina"]))
    {
        if(is_numeric($_GET["pagina"]))
        {
            if($_GET["pagina"]==1){header("Location: Calle.php");
            }else { $pagina=$_GET["pagina"]; }
            }else { header("Location: Calle.php"); 
        }
    }else{$pagina=1;}


    $empezar_desde=($pagina-1 )*$cantidad_resultados_por_pagina;

    if (isset($_POST["nombre"]))
    {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $rut = $_POST["rut"];
        $sql1="SELECT count(*) as cuantos from persona WHERE Nombre LIKE '%$nombre%' and Apellido LIKE '%$apellido%' and Rut Like '%$rut%' ;";
    } else {
        $sql1="SELECT count(*) as cuantos from persona  ;";
    }
    

   
    $todos=$u->getDatos($sql1);
    if(isset($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $rut = $_POST["rut"];
        $sql="SELECT persona.* from persona WHERE Nombre LIKE '%$nombre%' and Apellido LIKE '%$apellido%' and Rut Like '%$rut%' ORDER BY id
            LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    } else {
        $sql="SELECT  persona.* FROM persona ORDER BY Nombre ASC LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    }

    $datos=$u->getDatos($sql);
    $total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
?>