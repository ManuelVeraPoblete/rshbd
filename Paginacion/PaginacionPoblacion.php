<?php
require_once("../Clases/ClasePagina.php");
$u=new Paginas();
$busqueda = "";

$cantidad_resultados_por_pagina=15;

    if(isset($_GET["pagina"]))
    {
        if(is_numeric($_GET["pagina"]))
        {
            if($_GET["pagina"]==1){header("Location: Poblacion.php");
            }else { $pagina=$_GET["pagina"]; }
            }else { header("Location: Poblacion.php"); 
        }
    }else{$pagina=1;}


    $empezar_desde=($pagina-1 )*$cantidad_resultados_por_pagina;

    if (isset($_POST["busqueda"]))
    {
        $busqueda = $_POST["busqueda"];
        $sql1="SELECT count(*) as cuantos from poblacion WHERE Poblacion LIKE '%$busqueda%' ;";
    } else {
        $sql1="SELECT count(*) as cuantos from poblacion  ;";
    }
    
   
    $todos=$u->getDatos($sql1);
    if(isset($_POST["busqueda"])) {
        $busqueda = $_POST["busqueda"];
        $sql="SELECT * FROM poblacion WHERE Poblacion LIKE '%$busqueda%' ORDER BY id
            LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    } else {
        $sql="SELECT  poblacion.*                  
              FROM poblacion
            ORDER BY Poblacion ASC
            LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    }

    $datos=$u->getDatos($sql);
    $total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
?>