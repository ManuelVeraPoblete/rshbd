<?php
require_once("../Clases/ClasePagina.php");
$u=new Paginas();
$busqueda = "";

$cantidad_resultados_por_pagina=15;

    if(isset($_GET["pagina"]))
    {
        if(is_numeric($_GET["pagina"]))
        {
            if($_GET["pagina"]==1){header("Location: Actividades.php");
            }else { $pagina=$_GET["pagina"]; }
            }else { header("Location: Actividades.php"); 
        }
    }else{$pagina=1;}


    $empezar_desde=($pagina-1 )*$cantidad_resultados_por_pagina;

    if (isset($_POST["busqueda"]))
    {
        $busqueda = $_POST["busqueda"];
        $sql1="SELECT count(*) as cuantos from actividades WHERE Actividades LIKE '%$busqueda%' ;";
    } else {
        $sql1="SELECT count(*) as cuantos from actividades  ;";
    }
    
   
    $todos=$u->getDatos($sql1);
    if(isset($_POST["busqueda"])) {
        $busqueda = $_POST["busqueda"];
        $sql="SELECT * FROM actividades WHERE Actividades LIKE '%$busqueda%' ORDER BY id
            LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    } else {
        $sql="SELECT  actividades.*                  
              FROM actividades
            ORDER BY Actividades ASC
            LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    }

    $datos=$u->getDatos($sql);
    $total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
?>