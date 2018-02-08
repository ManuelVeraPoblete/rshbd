<?php
require_once("../Clases/ClasePagina.php");
$u=new Paginas();
$cantidad_resultados_por_pagina=15;

    if(isset($_GET["pagina"]))
    {
        if(is_numeric($_GET["pagina"]))
        {
            if($_GET["pagina"]==1){header("Location: Consulta_Hojas_Ruta.php");
            }else { $pagina=$_GET["pagina"]; }
            }else { header("Location: Consulta_Hojas_Ruta.php"); 
        }
    }else{$pagina=1;}


    $empezar_desde=($pagina-1 )*$cantidad_resultados_por_pagina;
    $sql1="
        select count(*) as cuantos from hojas_generadas;
    ";
    $todos=$u->getDatos($sql1);
    $sql="SELECT  hojas_generadas.* ,   consulta.Consulta                 
          FROM hojas_generadas
          inner join consulta on consulta.id = hojas_generadas.Consulta_Id
          ORDER BY id DESC
          LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    $datos=$u->getDatos($sql);
    $total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
?>