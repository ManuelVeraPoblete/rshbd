<?php
require_once("../Clases/ClasePagina.php");
$u=new Paginas();
$cantidad_resultados_por_pagina=15;

    if(isset($_GET["pagina"]))
    {
        if(is_numeric($_GET["pagina"]))
        {
            if($_GET["pagina"]==1){header("Location: Anulacion.php");
            }else { $pagina=$_GET["pagina"]; }
            }else { header("Location: Anulacion.php"); 
        }
    }else{$pagina=1;}
    $empezar_desde=($pagina-1 )*$cantidad_resultados_por_pagina;
    $sql1="select count(*) as cuantos from anulacion;";
    $todos=$u->getDatos($sql1);
    $sql="SELECT  anulacion.*                  
          FROM anulacion
          ORDER BY id DESC
          LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    $datos=$u->getDatos($sql);
    $total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
?>