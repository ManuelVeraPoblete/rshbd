<?php
require_once("../Clases/ClasePagina.php");
$Id_Usuaruio = $_SESSION["id_usuario"]  ;
$Mes_Actual =  date("n");
$Anio_Actual =  date("Y");   
$u=new Paginas();
$cantidad_resultados_por_pagina=15;

    if(isset($_GET["pagina"]))
    {
        if(is_numeric($_GET["pagina"]))
        {
            if($_GET["pagina"]==1){header("Location: Actividades_Diarias.php");
            }else { $pagina=$_GET["pagina"]; }
            }else { header("Location: Actividades_Diarias.php"); 
        }
    }else{$pagina=1;}


    $empezar_desde=($pagina-1 )*$cantidad_resultados_por_pagina;
    $sql1=" SELECT  count(*) as cuantos 
            from    actividad_diaria
            where   month(actividad_diaria.Fecha) = $Mes_Actual AND
                    year(actividad_diaria.Fecha)  = $Anio_Actual AND
                    actividad_diaria.Usuario_Id   = $id_usuario_act
    ";
    $todos=$u->getDatos($sql1);
    $sql="SELECT actividad_diaria.id ,
                 actividad_diaria.Fecha,
                 actividades.Actividades,
                 actividad_diaria.Cantidad
          FROM actividad_diaria
          inner join actividades on actividades.id = actividad_diaria.Actividad_Id
          where   month(actividad_diaria.Fecha)    = $Mes_Actual AND
                    year(actividad_diaria.Fecha)   = $Anio_Actual AND
                  actividad_diaria.Usuario_Id      = $id_usuario_act
          ORDER BY actividad_diaria.Fecha ASC
          LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    $datos=$u->getDatos($sql);
    $total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
?>